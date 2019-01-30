<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;
use App\Table\menu;
use App\Table\orderan;
use DB;
use Input;
use Redirect;
use Alert;

class mainController extends Controller
{
	function login(Request $request){
		$username = Input::get('username');
		$password = Input::get('password');

		$account = DB::table('account')
			->where('username', $username)
			->get();
		
		$pos = $account->values();
		
		if($password == $pos[0]->password){
			if($pos[0]->type == 0){
				$request->session()->put(['name' => $pos[0]->name, 'credit' => $pos[0]->credit]);
				return redirect()->route('userHome');
			}
			else{
				return redirect()->route('restaurantHome')->withCookie(cookie('restaurant_id', $pos[0]->restaurant_id));
			}
		}
	}

	function userHome(Request $request){
		$name = $request->session()->get('name');
		$credit = $request->session()->get('credit');
		
		$restaurant = DB::table('restaurant')
			->get();
		
		$posRestaurant = $restaurant->values();
		$countRestaurant = $restaurant->count();
		
		return view('User/homepage', compact('posRestaurant', 'countRestaurant', 'name', 'credit'));
	}

	function restaurantHome(Request $request){
		$id = $request->cookie('restaurant_id');
		
		$restaurant = DB::table('restaurant')
			->where('id', $id)
			->get();

		$pos = $restaurant->values();
		$pos = $pos[0];

		$listReserve = orderan::select('account_id')
			->where([
				['restaurant_id', '=', $id],
				['is_arrive', '=', '0']
			])
			->groupBy('account_id')
			->get();

		$countReserve = $listReserve->count();
		$posReserve = $listReserve->values();

		$sorts = orderan::select('account_id')
			->where([
				['paid', '=', '0'],
				['cooking', '=', '0'],
				['is_arrive', '=', '1']
			])
			->groupBy('account_id')
			->get();

		$orders = DB::table('orderan')
			->where([
				['paid', '=', '0'],
				['cooking', '=', '0']
			])
			->get();

		$countOrder = $orders->count();
		$posOrder = $orders->values();

		$pay = orderan::select('account_id')
			->where([
				['paid', '=', '0'],
				['cooking', '=', '1'],
				['is_arrive', '=', '1']
			])
			->groupBy('account_id')
			->get();

		$posPay = $pay->values();

		return view('Restaurant/homepage', compact('pos', 'posReserve', 'countOrder', 'posOrder', 'sorts', 'posPay'	));
	}

    function getMenu(Request $request){
		$menu = DB::table('menu')
			->orderBy('jenis', 'asc')
			->where('restaurant_id', $request->restaurant_id)
			->get();
			
		$countMenu = $menu->count();
		$posMenu = $menu->values();

		$id = $request->cookie('account_id');
		$account = DB::table('account')
			->where('id', $id)
			->get();

		$pos = $account->values();
		
		return view('pemesanan', compact('posMenu', 'countMenu', 'pos'))->withCookie(cookie('restaurant_id', $request->restaurant_id));;
	}

	function pesan(Request $request){
		$menu = DB::table('menu')
			->orderBy('jenis', 'asc')
			->get();

		$account = $request->cookie('account_id');
		$restaurant = $request->cookie('restaurant_id');

		$order = orderan::all();
		$a = 0;

		foreach ($menu as $item) {

			$jenis = Input::get('jenisMenu'.$a);
			$jumlah = Input::get('jumlahMenu'.$a);
			$order = new orderan();

			$a += 1;

			if($jumlah != 0 )
			{
				$order->menu = $jenis;
				$order->jumlah = $jumlah;
				$order->account_id = $account;
				$order->restaurant_id = $restaurant;
				$order->save();
			}
		}

		return redirect()->route('pay', ['restaurant_id' => $restaurant, 'account_id' => $account])->with('alert', 'Your order has been saved');
	}

	function doneCook(Request $request){
		$accountId = $request->account_id;
		$restaurant_id = $request->restaurant_id;
		$menuId = $request->id;

		DB::table('orderan')
			->where([
				['id', '=', $menuId],
				['account_id', '=', $accountId],
				['restaurant_id', '=', $restaurant_id],
				['cooking', '=', '0'],
				['paid', '=', '0'],
				['is_arrive', '=', '1']
			])
			->update(['cooking' => '1']);

		return redirect()->route('restaurantHome');
	}

	function pay(Request $request){
		$order = DB::table('orderan')
			->where([
				['account_id', '=', $request->account_id],
				['restaurant_id', '=', $request->restaurant_id]
			])
			->get();

		$count = $order->count();
		$pos = $order->values();

		return view('payment', compact('pos', 'total', 'order'));
	}

  function paid(Request $request){
	$accountId = $request->account_id;
	$restaurantId = $request->restaurant_id;

	$accountCookies = $request->cookie('account_id');
	$total = 0;

	$transaction = DB::table('orderan')
		->leftJoin('menu', 'orderan.menu', '=', 'menu.menu')
		->where([
			['account_id', '=', $accountId],
			// ['restaurant_id', '=', $restaurantId],
			['cooking', '=', '1'],
			['paid', '=', '0']
		])
		->get();
	
	$posTransaxtion = $transaction->values();

	foreach ($posTransaxtion as $item) {
		$total += ($item->jumlah * $item->harga);
	}

	if($accountCookies)
	{
		$account = DB::table('account')
			->where('id', $accountCookies)
			->get();

		$posAccount = $account->values();

		$balance = $posAccount[0]->credit;

		if($balance >= $total){
			$balance -= $total;

			DB::table('account')
				->where('id', $accountCookies)
				->update(['credit' => $balance]);
		}
	}

    DB::table('orderan')
		->where([
				['account_id', '=', $accountId],
				['restaurant_id', '=', $restaurant_id],
				['cooking', '=', '1'],
				['paid', '=', '0'],
				['is_arrive', '=', '1']
		])
		->update(['paid' => '1']);

	return redirect()->route('userHome');
  }

  function arrive(Request $request){
    DB::table('orderan')
		->where([
			['account_id', '=', $request->account_id],
			['is_arrive', '=', '0']
		])
		->update(['is_arrive' => '1']);

		return redirect()->route('restaurantHome');
  }
}

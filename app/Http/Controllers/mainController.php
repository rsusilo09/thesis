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
				return redirect()->route('userHome')->withCookie(cookie('account_id', $pos[0]->id));
			}
			else{
				$request->session()->put('name', $pos[0]->name);
				return redirect()->route('restaurantHome')->withCookie(cookie('restaurant_id', $pos[0]->restaurant_id));
			}
		}
	}

	function restaurantHome(Request $request){
		$name = $request->session()->get('name');
		$id = $request->cookie('restaurant_id');
		
		$account = DB::table('account')
			->get();

		$posAccount = $account->Values();

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

		return view('Restaurant/homepage', compact('posAccount', 'posReserve', 'countOrder', 'posOrder', 'sorts', 'posPay', 'name'));
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
		$name = $request->session()->get('name');
		$credit = $request->session()->get('credit');
		$restaurant = $request->session()->get('restaurant_id');
		$id = $request->cookie('account_id');

		$order = DB::table('orderan')
			->where([
				['account_id', '=', $request->account_id],
				['restaurant_id', '=', $request->restaurant_id]
			])
			->get();

		$detail = DB::table('menu')
			->where('restaurant_id', '=', $request->restaurant_id)
			->get();

		$countOrder = $order->count();
		$countDetail = $detail->count();
		$posOrder = $order->values();
		$posDetail = $detail->values();

		$response = [];
		foreach ($posOrder as $order) {
			foreach($posDetail as $detail) {
				if($order->menu == $detail->menu){
					$result = $order;
					$result->harga = $detail->harga;

					array_push($response, $result);
				}
			}
		}
		dd($response);
		return view('payment', compact('response', 'total', 'order', 'name', 'credit', 'restaurant', 'id'));
	}

  function paid(Request $request){
	$accountId = $request->account_id;
	$restaurantId = $request->restaurant_id;

	$accountCookies = $request->cookie('account_id');
	$total = 0;

	$transaction = DB::table('orderan')
		->leftJoin('menu', function($join){
			$join->on('orderan.menu', '=', 'menu.menu');
			$join->on('orderan.restaurant_id', '=', 'menu.restaurant_id');
		})
		->where([
			['account_id', '=', $accountId],
			['restaurant_id', '=', $restaurantId],
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

	if($request->cookie('restaurant_id')){
		return redirect()->route('restaurantHome')->with('alert', 'Payment Success');
	}
	else{
		return redirect()->route('userHome')->with('alert', 'Payment Success');
	}
	
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

  function signOut(Request $request){
	  $request->session()->flush();
	  
	  return redirect()->route('/')->withCookie(cookie::forget(['restaurant_id', 'account_id']));
  }
}

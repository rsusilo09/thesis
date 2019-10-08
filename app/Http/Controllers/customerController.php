<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Table\menu;
use App\Table\orderan;
use DB;
use Input;
use Redirect;
use Alert;

class customerController extends Controller
{
    function userHome(Request $request){
		$name = $request->session()->get('name');
		$credit = $request->session()->get('credit');
		
		$restaurant = DB::table('restaurant')
			->get();
		
		$posRestaurant = $restaurant->values();
		$countRestaurant = $restaurant->count();
		
		return view('User/homepage', compact('posRestaurant', 'countRestaurant', 'name', 'credit'));
    }
    
    function getMenu(Request $request){
		$name = $request->session()->get('name');
		$credit = $request->session()->get('credit');

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
		
		$request->session()->put('restaurant_id', $request->restaurant_id);
		return view('pemesanan', compact('posMenu', 'countMenu', 'pos', 'name', 'credit'));
    }
    
    function pesan(Request $request){
		$restaurant = $request->session()->get('restaurant_id');

		$menu = DB::table('menu')
			->orderBy('jenis', 'asc')
			->get();

		$account = $request->cookie('account_id');
		
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

	function search(Request $request){
		$name = $request->session()->get('name');
		$credit = $request->session()->get('credit');
		$key = Input::get('s');

		$menu = DB::table('menu')
			->orderBy('jenis', 'asc')
			->where('menu', 'LIKE', '%'.$key.'%')
			->get();
			
		$countMenu = $menu->count();
		$posMenu = $menu->values();

		$restaurant = DB::table('restaurant')
			->where('name', 'LIKE', '%'.$key.'%')
			->get();
			
		$countRest = $restaurant->count();
		$posRest = $restaurant->values();

		$id = $request->cookie('account_id');
		$account = DB::table('account')
			->where('id', $id)
			->get();

		$pos = $account->values();
		
		$request->session()->put('restaurant_id', $request->restaurant_id);
		
		return view('pemesanan', compact('posMenu', 'countMenu', 'pos', 'name', 'credit', 'posRest', 'countRest'));
	}
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Table\menu;
use App\Table\orderan;
use DB;
use Input;
use Redirect;

class mainController extends Controller
{
    function order()
	{
		$food = DB::table('menu')
			->where('jenis', 'makanan')
			->get();
		$drink = DB::table('menu')
			->where('jenis', 'minuman')
			->get();
		$countFood = $food->count();
		$countDrink = $drink->count();
		$posFood = $food->values();
		$posDrink = $drink->values();

		return view('pemesanan', compact('countFood', 'countDrink', 'posFood', 'posDrink'));
	}

	function pesan()
	{
		$food = DB::table('menu')
			->where('jenis', 'makanan')
			->get();
		$drink = DB::table('menu')
			->where('jenis', 'minuman')
			->get();
		$countFood = $food->count();
		$countDrink = $drink->count();
		$posFood = $food->values();
		$posDrink = $drink->values();
		$meja = 'Table 1';

		$order = orderan::all();

		for($a=0; $a<$countFood; $a++)
		{
			$jenis = Input::get('jenisFood'.$a);
			$jumlah = Input::get('jumlahFood'.$a);

			$order = new orderan();

			if($jumlah != 0 )
			{
				$order->menu = $jenis;
				$order->jumlah = $jumlah;
				$order->meja = $meja;
				$order->paid = '0';
				$order->cooking = '0';
				$order->save();
			}
		}

		for($a=0; $a<$countDrink; $a++)
		{
			$jenis = Input::get('jenisDrink'.$a);
			$jumlah = Input::get('jumlahDrink'.$a);

			$order = new orderan();

			$order->menu = $jenis;
			$order->jumlah = $jumlah;
			$order->meja = $meja;
			$order->paid = '0';
			$order->cooking = '0';
			$order->save();
		}

		return view('pemesanan', compact('countFood', 'countDrink', 'posFood', 'posDrink'));
	}

	function cook()
	{
		$sorts = orderan::select('meja')
			->where('paid', '0')
			->where('cooking', '0')
			->groupBy('meja')
			->get();

		$orders = DB::table('orderan')
			->where('paid', '0')
			->where('cooking', '0')
			->get();

		$count = $orders->count();
		$pos = $orders->values();

		return view('cooking', compact('pos', 'orders', 'sorts', 'count'));
	}

	function doneCook($a)
	{
		$sorts = orderan::select('meja')
			->where('paid', '0')
			->where('cooking', '0')
			->groupBy('meja')
			->get();

		$orders = DB::table('orderan')
			->where('paid', '0')
			->where('cooking', '0')
			->get();

		$count = $orders->count();
		$pos = $orders->values();

		$id = $orders[$a]->id;

		DB::table('orderan')
		->where('id', $id)
		->where('cooking', '0')
		->where('paid', '0')
		->update(['cooking' => '1']);

		return redirect()->to('cooking');
	}

	function bills()
	{
		$bill = orderan::select('meja')
			->where('paid', '0')
			->groupBy('meja')
			->get();

		$count = $bill->count();
		$pos = $bill->values();


		return view ('bills', compact('count', 'pos', 'test'));
	}

	function pay($a)
	{
		$all = orderan::select('meja')
      ->where('paid', '0')
      ->groupBy('meja')
      ->get();

    $values = $all->values();
    $meja = $values[$a]->meja;

    $sort = DB::table('orderan')
      ->leftJoin('menu', 'orderan.menu', '=', 'menu.menu')
      ->where('meja', $meja)
      ->where('paid', '0')
      ->get();

    $count = $sort->count();
    $pos = $sort->values();

    $total = 0;

    for($b=0; $b<$count; $b++)
    {
      $harga = $pos[$b]->harga;
      $jumlah = $pos[$b]->jumlah;
      $temp = $harga * $jumlah;

      $total = $total + $temp;
    }

		return view('payment', compact('meja', 'count', 'pos', 'total'));
	}

  function paid($meja)
  {
    DB::table('orderan')
		->where('meja', $meja)
		->where('paid', '0')
		->update(['paid' => '1']);

		return redirect()->to('bills');
  }
}

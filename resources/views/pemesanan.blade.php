<html>

<body>
	<div style='text-align:right'>
		<h2>Table 1</h2>
	</div>

	<div class="content-wrapper">
	<section class="content-header">
		<h1>Daftar Menu <small><?= date('l, d F Y');?></small></h1>
	</section>
		{!! Form::open(array('route' => 'pesan', 'method' => 'POST')) !!}
		<table style="width:30%">
		<tr>
			<th>Makanan</th>
		</tr>
		@for($a=0;$a<$countFood; $a++)
		<tr>
			<td>{{$posFood[$a]->menu}}{!! Form::hidden('jenisFood'.$a, $posFood[$a]->menu) !!}</td>
			<td>{{$posFood[$a]->harga}}</td>
			<td>{!! Form::text('jumlahFood'.$a, '') !!}</td>
		</tr>
		@endfor<tr>
			<th>Minuman</th>
		</tr>
		@for($b=0;$b<$countDrink; $b++)
		<tr>
			<td>{{$posDrink[$b]->menu}}{!! Form::hidden('jenisDrink'.$b, $posDrink[$b]->menu) !!}</td>
			<td>{{$posDrink[$b]->harga}}</td>
			<td>{!! Form::text('jumlahDrink'.$b, '') !!}</td>
		</tr>
		@endfor
		<input type="submit" value="Pesan" style="text-align:right">
		</table>
		{!! Form::close() !!}
	</div>
</body>

</html>
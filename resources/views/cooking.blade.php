<html>

<head>
<h1><center>Incoming Order</center></h1>
</head>
<body>
	<div class="menu">
		@foreach($sorts as $sort)
		<table width="200px">
			<tr>
				<th>{{$sort->meja}}</th>
			</tr>
			@for($a=0; $a<$count; $a++)
				@if($pos[$a]->meja == $sort->meja && $pos[$a]->jumlah != 0)
				<tr>
					<td>{{$pos[$a]->menu}}</td>
					<td>{{$pos[$a]->jumlah}}</td>
					<td><button onclick="location.href='{{route('doneCook', $a)}}'">Done</button></td>
				</tr>
				@endif
			@endfor
		</table>
		@endforeach
	</div>
</body>
</html>

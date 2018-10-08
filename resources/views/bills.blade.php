<html>
<head>
	<h1>
		<center>Bills</center>
	</h1>
</head>
<body>
	<div class="bills">
	<center>
		<table width="400px">
		@for($a=0;$a<$count;$a++)
			<tr>
				<td><button onclick="location.href='{{route('pay', $a)}}'">{{$pos[$a]->meja}}</button></td>
			</tr>
		@endfor
		</table>
	</center>
	</div>
</body>
</html>

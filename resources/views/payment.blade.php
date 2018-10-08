<html>
<head>
<h1>Tagihan</h1>
</head>
<body>
  <table>
    <tr>
      <td>{{$meja}}</td>
    </tr>
    @for($a=0; $a<$count; $a++)
    <tr>
      <td>{{$pos[$a]->menu}}</td>
      <td>{{$pos[$a]->jumlah}}</td>
      <td>{{$pos[$a]->harga}}</td>
      <td>Rp {{($pos[$a]->harga * $pos[$a]->jumlah)}}
    </tr>
    @endfor
    <tr>
      <td>Total</td>
      <td></td>
      <td></td>
      <td>Rp {{$total}}</td>
    </tr>
  </table>
  <button onclick="location.href='{{route('paid', $meja)}}'" type="button">Pay</button>
</body>
</html>

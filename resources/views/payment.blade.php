<html>
<head>
<h1>Your Order</h1>
</head>
<body>
  <table>
    @foreach ($pos as $item)
      <tr>
        <td>{{$item->menu}}</td>
        <td>{{$item->jumlah}}</td>
        {{-- <td>{{$item->harga}}</td> --}}
        {{-- <td>Rp {{($item->harga * $item->jumlah)}} --}}
      </tr>
    @endforeach
  </table>
  <button onclick="location.href='{{route('paid', [$item->restaurant_id, $item->account_id])}}'" type="button">Pay</button>
</body>
</html>

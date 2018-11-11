<html>
@extends('script')
<body class="hold-transition skin-blue layout-top-nav">
<div class="content-wrapper">
    <div class="col-sm-offset-1 col-md-10">
    <section class="content-header">
      <h1>
        My Restaurant
        <small><?= date('l, d F Y');?></small>
      </h1>
    </section>
	<section class="content">
	<div class="box">
        <div class="box-header with-border">
          <h3 class="box-title">Daftar Menu</h3>

          <div class="box-tools pull-right">
				Table 1
		  </div>
        </div>
        <div class="box-body">
			{!! Form::open(array('route' => 'pesan', 'method' => 'POST')) !!}
			<div class="form-group">
				<div class="col-md-9">
				<h5>Menu</h5>
				</div>
				<div class="col-md-2">
				Harga
				</div>
				<div class="col-md-1">
                Jumlah
                </div>
			</div>
			@for($a=0;$a<$countFood; $a++)
			<div class="form-group">
				<div class="col-md-9">
				{{$posFood[$a]->menu}}{!! Form::hidden('jenisFood'.$a, $posFood[$a]->menu) !!}
				</div>
				<div class="col-md-2">
				Rp. {{$posFood[$a]->harga}}
				</div>
				<div class="col-md-1">
                    <input type="text" class="form-control" id="jumlahFood{{$a}}">
                </div>
			</div>
			@endfor

			@for($b=0;$b<$countDrink; $b++)
			<div class="form-group">
				<div class="col-md-9">
				{{$posDrink[$b]->menu}}{!! Form::hidden('jenisDrink'.$b, $posDrink[$b]->menu) !!}
				</div>
				<div class="col-md-2">
				Rp. {{$posDrink[$b]->harga}}
				</div>
				<div class="col-md-1">
                    <input type="text" class="form-control" id="jumlahDrink{{$b}}">
                </div>
			</div>
			@endfor
			<div class="form-group col-sm-offset-4 col-md-4">
				<button type="submit" class="btn btn-primary form-control">Submit</button>
			</div>
		</table>
		{!! Form::close() !!}
			</div>
		</div>
    </div>
	</div>
</div>
</body>

</html>
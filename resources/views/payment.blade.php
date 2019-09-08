@extends('script')
<!-- ADD THE CLASS layout-top-nav TO REMOVE THE SIDEBAR. -->
<body class="hold-transition skin-blue layout-top-nav">
<div class="wrapper">

  <header class="main-header">
    <nav class="navbar navbar-static-top">
      <div class="container">
        <div class="navbar-custom-menu">
          <ul class="nav navbar-nav">
            <li class="dropdown user user-menu">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                <span class="hidden-xs">{{$name}}tes</span>
              </a>
              <ul class="dropdown-menu">
                <li class="user-body">
                  <div class="row">
                    <div class="col-xs-12 text-center">
                      <a href="#">Credit: Rp {{$credit}}</a>
                    </div>
                  </div>
                </li>
                
                <li class="user-footer">
                  <div class="pull-right">
                    <a href="#" class="btn btn-default btn-flat">Sign out</a>
                  </div>
                </li>
              </ul>
            </li>
          </ul>
        </div>
      </div>
    </nav>
  </header>
  <!-- Full Width Column -->
  <div class="content-wrapper">
    <div class="container">
      
      <!-- Main content -->
        <div>
            <div class="box">
                  @if(session('alert'))
                  <div class="alert alert-success alert-dismissible">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                    <h4><i class="icon fa fa-check"></i> SUCCESS!</h4>
                    {{session('alert')}}
                  </div>
                  @endif
              <div class="box-header">
                <h3 class="box-title">Your Order</h3>
              </div>
              <!-- /.box-header -->
              <div class="box-body no-padding">
                <table class="table">
                  @foreach ($pos as $item)
                    <tr>
                      <td>{{$item->menu}}</td>
                      <td>{{$item->jumlah}}</td>
                      {{-- <td>{{$item->harga}}</td>
                      <td>Rp {{($item->harga * $item->jumlah)}} --}}
                    </tr>
                  @endforeach
                </table>
                <button onclick="location.href='{{route('paid', [$restaurant, $id])}}'" type="button" class="btn btn-info col-md-3 col-md-offset-5">Pay</button>
              </div>
              <!-- /.box-body -->
            </div>
      </section>
      <!-- /.content -->
    </div>
    <!-- /.container -->
  </div>
  <!-- /.content-wrapper -->
  
</div>
<!-- ./wrapper -->

</body>
</html>

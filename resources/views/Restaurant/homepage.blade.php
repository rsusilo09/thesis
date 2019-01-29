<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>MyRestaurantReservation</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <link rel="stylesheet" href="../node_modules/admin-lte/bower_components/bootstrap/dist/css/bootstrap.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="../node_modules/admin-lte/bower_components/font-awesome/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="../node_modules/admin-lte/bower_components/Ionicons/css/ionicons.min.css">
  <!-- DataTables -->
  <link rel="stylesheet" href="../node_modules/admin-lte/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="../node_modules/admin-lte/dist/css/AdminLTE.min.css">
  <!-- AdminLTE Skins. Choose a skin from the css/skins folder instead of downloading all of them to reduce the load. -->
  <link rel="stylesheet" href="../node_modules/admin-lte/dist/css/skins/_all-skins.min.css">
  <!-- jQuery 3 -->
  <script src="../node_modules/admin-lte/bower_components/jquery/dist/jquery.min.js"></script>
  <!-- Bootstrap 3.3.7 -->
  <script src="../node_modules/admin-lte/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
  <!-- Slimscroll -->
  <script src="../node_modules/admin-lte/bower_components/jquery-slimscroll/jquery.slimscroll.min.js"></script>
  <!-- FastClick -->
  <script src="../node_modules/admin-lte/bower_components/fastclick/lib/fastclick.js"></script>
  <!-- AdminLTE App -->
  <script src="../node_modules/admin-lte/dist/js/adminlte.min.js"></script>
  <!-- iCheck -->
  <script src="../node_modules/admin-lte/plugins/iCheck/icheck.min.js"></script>
  <!-- AdminLTE for demo purposes -->
  <script src="../node_modules/admin-lte/dist/js/demo.js"></script>
</head>
<!-- ADD THE CLASS layout-top-nav TO REMOVE THE SIDEBAR. -->
<body class="hold-transition skin-blue layout-top-nav">
<div class="wrapper">

  <header class="main-header">
    <nav class="navbar navbar-static-top">
      <div class="container">
        <!-- Navbar Right Menu -->
        <div class="navbar-custom-menu">
          <ul class="nav navbar-nav">
            <!-- User Account Menu -->
            <li class="dropdown user user-menu">
              <!-- Menu Toggle Button -->
              <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                <!-- The user image in the navbar-->
                {{-- <img src="../../dist/img/user2-160x160.jpg" class="user-image" alt="User Image"> --}}
                <!-- hidden-xs hides the username on small devices so only the image appears. -->
                <span class="hidden-xs">{{$pos->name}}</span>
              </a>
              <ul class="dropdown-menu">
                <!-- Menu Footer-->
                <li class="user-footer">
                  <div class="pull-right">
                    <a href="#" class="btn btn-default btn-flat">Sign out</a>
                  </div>
                </li>
              </ul>
            </li>
          </ul>
        </div>
        <!-- /.navbar-custom-menu -->
      </div>
      <!-- /.container-fluid -->
    </nav>
  </header>
  <!-- Full Width Column -->
  <div class="content-wrapper">
    <div class="container">
      
      <!-- Main content -->
      <div class="col-md-12">
            <div class="nav-tabs-custom">
              <ul class="nav nav-tabs">
                <li class="active"><a href="#reservation" data-toggle="tab">Reservation</a></li>
                <li><a href="#cooking" data-toggle="tab">Cooking</a></li>
                <li><a href="#payment" data-toggle="tab">Payment</a></li>
              </ul>
              <div class="tab-content">
                <div class="active tab-pane" id="reservation">
                        <div class="bills">
                            <center>
                                <table width="400px">
                                @foreach ($posReserve as $item)
                                    <tr>
                                        <td>
                                            {{-- <button onclick="location.href='{{url('arrive', $item->account_id)}}'">{{$item->account_id}}</button> --}}
                                        <a href="{{URL::route('arrive', $item->account_id)}}" class="btn btn-default">{{$item->account_id}}</a>
                                        </td>
                                    </tr>
                                @endforeach
                                </table>
                            </center>
                        </div>
                  
                </div>
                <!-- /.tab-pane -->
                <div class="tab-pane" id="cooking">
                        <div class="menu">
                                @foreach($sorts as $sort)
                                <table width="200px">
                                    <tr>
                                        <th>{{$sort->account_id}}</th>
                                    </tr>
                                    @foreach ($posOrder as $item)
                                        @if($item->account_id == $sort->account_id && $item->jumlah != 0)
                                        <tr>
                                            <td>{{$item->menu}}</td>
                                            <td>{{$item->jumlah}}</td>
                                            <td><a href="{{URL::route('doneCook', [$item->restaurant_id, $item->account_id, $item->id])}}" class="btn btn-default">Done</a></td>
                                        </tr>
                                        @endif
                                    @endforeach
                                </table>
                                @endforeach
                        </div>
                </div>
                <!-- /.tab-pane -->
  
                <div class="tab-pane" id="payment">
                        <div class="bills">
                                <center>
                                    <table width="400px">
                                    @foreach ($posPay as $item)
                                        <tr>
                                            <td><a href="{{URL::route('pay', [$item->restaurant_id, $item->account_id])}}" class="btn btn-default">{{$item->account_id}}</a></td>
                                        </tr>
                                    @endforeach
                                    </table>
                                </center>
                            </div>
                </div>
                <!-- /.tab-pane -->
              </div>
              <!-- /.tab-content -->
            </div>
            <!-- /.nav-tabs-custom -->
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

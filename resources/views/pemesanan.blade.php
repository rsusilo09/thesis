<!DOCTYPE html>
<html>
    <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>MyRestaurantReservation</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <link rel="stylesheet" href="../../node_modules/admin-lte/bower_components/bootstrap/dist/css/bootstrap.min.css">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="../../node_modules/admin-lte/bower_components/font-awesome/css/font-awesome.min.css">
    <!-- Ionicons -->
    <link rel="stylesheet" href="../../node_modules/admin-lte/bower_components/Ionicons/css/ionicons.min.css">
    <!-- DataTables -->
    <link rel="stylesheet" href="../../node_modules/admin-lte/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="../../node_modules/admin-lte/dist/css/AdminLTE.min.css">
    <!-- AdminLTE Skins. Choose a skin from the css/skins folder instead of downloading all of them to reduce the load. -->
    <link rel="stylesheet" href="../../node_modules/admin-lte/dist/css/skins/_all-skins.min.css">
    <!-- jQuery 3 -->
    <script src="../../node_modules/admin-lte/bower_components/jquery/dist/jquery.min.js"></script>
    <!-- Bootstrap 3.3.7 -->
    <script src="../../node_modules/admin-lte/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
    <!-- Slimscroll -->
    <script src="../../node_modules/admin-lte/bower_components/jquery-slimscroll/jquery.slimscroll.min.js"></script>
    <!-- FastClick -->
    <script src="../../node_modules/admin-lte/bower_components/fastclick/lib/fastclick.js"></script>
    <!-- AdminLTE App -->
    <script src="../../node_modules/admin-lte/dist/js/adminlte.min.js"></script>
    <!-- iCheck -->
    <script src="../../node_modules/admin-lte/plugins/iCheck/icheck.min.js"></script>
    <!-- AdminLTE for demo purposes -->
    <script src="../../node_modules/admin-lte/dist/js/demo.js"></script>
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
                            <span class="hidden-xs">{{$name}}</span>
                        </a>
                        <ul class="dropdown-menu">
                            <!-- Menu Body -->
                            <li class="user-body">
                            <div class="row">
                                <div class="col-xs-12 text-center">
                                <a href="#">Credit: Rp {{$credit}}</a>
                                </div>
                            </div>
                            <!-- /.row -->
                            </li>
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
    
            <div class="content-wrapper">
                <div class="content">
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
														</div>
														<div class="box-body">
													{!! Form::open(array('route' => 'pesan', 'method' => 'POST')) !!}
													<div class="form-group">
														<div class="col-md-offset-9 col-md-2">
														Harga
														</div>
														<div class="col-md-1">
																		Jumlah
																		</div>
													</div>
													@for($a=0;$a<$countMenu; $a++)
													<div class="form-group">
														<div class="col-md-9">
														{{$posMenu[$a]->menu}}{!! Form::hidden('jenisMenu'.$a, $posMenu[$a]->menu) !!}
														</div>
														<div class="col-md-2">
														Rp. {{$posMenu[$a]->harga}}
														</div>
														<div class="col-md-1">
															{!! Form::text('jumlahMenu'. $a, null, ['class' => 'form-control']) !!}
																		</div>
													</div>
													@endfor
										
													<div class="form-group col-sm-offset-4 col-md-4">
														<button type="submit" class="btn btn-primary form-control">Order</button>
													</div>
												</table>
												{!! Form::close() !!}
													</div>
												</div>
												</div>
											</div>
                </div>
            </div>

        </div>
    </body>
</html>

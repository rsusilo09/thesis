@extends('script')    
    <body class="hold-transition skin-blue layout-top-nav">
        <div class="wrapper">

            <header class="main-header">
                <nav class="navbar navbar-static-top">
                <div class="container">
                    <div class="navbar-custom-menu">
                        <ul class="nav navbar-nav">
                            <li class="dropdown user user-menu">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                <span class="hidden-xs">{{$name}}</span>
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
    
            <div class="content-wrapper">
                <div class="content">
                    <div class="col-sm-offset-1 col-md-10">
						<section class="content-header">
							<h1>My Restaurant<small><?= date('l, d F Y');?></small></h1>
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
								{!! Form::close() !!}
							</div>
						</div>
					</div>
                </div>
            </div>
        </div>
    </body>


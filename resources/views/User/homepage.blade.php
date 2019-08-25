@extends('script')
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
  <!-- Full Width Column -->
  <div class="content-wrapper">
    <div class="container">
      
      <!-- Main content -->
        <div>
            <div class="box">
              <div class="box-header">
                <h3 class="box-title">Restaurant List</h3>
              </div>
              <!-- /.box-header -->
              <div class="box-body no-padding">
                <table class="table">
                  <tr>
                    <th>
                      <form>
                        <div class="input-group col-sm-5">
                          <input type="text" name="s" class="form-control" placeholder="Enter keywords..">
                          <span class="input-group-btn">
                            <button type="submit" class="btn btn-flat" name="search">Search</button>
                          </span>
                        </div>
                      </form>
                    </th>
                  </tr>
                  <tr>
                    <th style="width: 10px">#</th>
                    <th>Name</th>
                    <th>Address</th>
                  </tr>
                  @for($a=0;$a<$countRestaurant;$a++)
                  <tr>
                    <td>{{$a+1}}</td>
                    <td><a href= "{{ url ('menu', $posRestaurant[$a]->id) }}">{{$posRestaurant[$a]->name}}</a></td>
                    <td>{{$posRestaurant[$a]->address}}</td>
                  </tr>
                  @endfor
                </table>
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

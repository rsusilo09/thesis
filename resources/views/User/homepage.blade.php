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
    <div class="container">
      <div>
        <div class="box">
          <div class="box-header">
            <h3 class="box-title">Restaurant List</h3>
          </div>
          <div class="box-body no-padding">
            <table class="table">
              <tr>
                <th>
                  {!! Form::open(array('route' => 'cari', 'method' => 'POST')) !!} 
                  <div class="input-group col-sm-5">
                    <input type="text" name="s" class="form-control" placeholder="Enter keywords..">
                    <span class="input-group-btn">
                      <button type="submit" class="btn btn-flat" name="search">Search</button>
                    </span>
                  </div>
                  {!! Form::close() !!}
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
        </div>
      </div>
    </div>
  </div>
</div>
</body>

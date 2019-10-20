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
      <div class="nav-tabs-custom">
        <ul class="nav nav-tabs">
          <li class="active"><a href="#restaurant" data-toggle="tab">Restaurant</a></li>
          <li><a href="#menu" data-toggle="tab">Menu</a></li>
        </ul>
        <div class="tab-content">
          <div class="active tab-pane" id="Restaurant">
            <div class="restaurant">
                <table class="table">
                    <tr>
                      <th style="width: 10px">#</th>
                      <th>Name</th>
                      <th>Address</th>
                    </tr>
                    @for($a=0;$a<$countRest;$a++)
                    <tr>
                      <td>{{$a+1}}</td>
                      <td><a href= "{{ url ('menu', $posRest[$a]->id) }}">{{$posRest[$a]->name}}</a></td>
                      <td>{{$posRest[$a]->address}}</td>
                    </tr>
                    @endfor
                  </table>
            </div>
          </div>

          <div class="tab-pane" id="Menu">
            <div class="menu">
                <table class="table">
                    <tr>
                      <th style="width: 10px">#</th>
                      <th>Name</th>
                      <th>Restaurant</th>
                    </tr>
                    @for($a=0;$a<$countRest;$a++)
                    <tr>
                      <td>{{$a+1}}</td>
                      <td><a href= "{{ url ('menu', $posRest[$a]->id) }}">{{$posRest[$a]->name}}</a></td>
                      <td>{{$posRest[$a]->address}}</td>
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

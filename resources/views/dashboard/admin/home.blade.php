@extends('dashboard.admin.layout')
@section('content')
        <div class="right_col" role="main">
          <div class="">
            <div class="row" style="display: inline-block;">
            <div class="top_tiles">
              <div class="animated flipInY col-lg-6 col-md-6 col-sm-6 ">
                <div class="tile-stats">
                  <div class="icon"><i class="fa fa-home"></i></div>
                  <div class="count">{{$country}}</div>
                  <h3>No of Countries</h3>
                </div>
              </div>
              <div class="animated flipInY col-lg-6 col-md-6 col-sm-6 ">
                <div class="tile-stats">
                  <div class="icon"><i class="fa fa-lock"></i></div>
                  <div class="count">{{$safe}}</div>
                  <h3>No of Safes</h3>
                </div>
              </div>
              <div class="animated flipInY col-lg-4 col-md-4 col-sm-6 ">
                <div class="tile-stats">
                  <div class="icon"><i class="fa fa-info"></i></div>
                  <div class="count">{{$safetype}}</div>
                  <h3>No of Types</h3>
                </div>
              </div>
              <div class="animated flipInY col-lg-4 col-md-4 col-sm-6 ">
                <div class="tile-stats">
                  <div class="icon"><i class="fa fa-cube"></i></div>
                  <div class="count">{{$goldbar}}</div>
                  <h3>No of GoldBars</h3>
                </div>
              </div>
              <div class="animated flipInY col-lg-4 col-md-4 col-sm-6 ">
                <div class="tile-stats">
                  <div class="icon"><i class="fa fa-clone"></i></div>
                  <div class="count">{{$weight}}</div>
                  <h3>No of Weights</h3>
                </div>
              </div>
            </div>
          </div>
</div>
</div>

@endsection
@extends('main')
@section('title','| Homepage')
@section('stylesheet')
  {!! Html::style('css/dashboard.css') !!}
  {!! Html::style('css/circle.css') !!}
@stop
@section('content')
<div class="row">
    <div class="col-md-12">
          <h1 class="page-header">Dashboard</h1>

         <div class="clearfix">
              <div class="inner-content text-center">
                <div class="c100 p{{$percentage[0]}} big">
                    <span><a href="/pages/students/1" title="Current MCA">mca</a></span>
                    <div class="slice">
                        <div class="bar"></div>
                        <div class="fill"></div>
                    </div>
              </div>

                </div>

                 <div class="c100 p{{$percentage[1]}} big green">
                    <span><a href="/pages/students/2" title="Current BCA">bca</a></span>
                    <div class="slice">
                        <div class="bar"></div>
                        <div class="fill"></div>
                    </div>
                </div>

                <div class="c100 p{{$percentage[2]}} big orange">
                    <span><a href="/pages/students/3" title="Current Diploma (DCSE/DETE)">diploma</a></span>
                    <div class="slice">
                        <div class="bar"></div>
                        <div class="fill"></div>
                    </div>
                </div>

                <div class="c100 p{{$percentage[3]}} big yellow">
                    <span><a href="/pages/students/4" title="Current Short Term Courses">short</a></span>
                    <div class="slice">
                        <div class="bar"></div>
                        <div class="fill"></div>
                    </div>
                </div>

            </div>
    </div>  
</div>
<div class="row">
    <div class="col-md-4">
          <h2 class="sub-header text-center">Community</h2>
          <div class="table-responsive">
            <table class="table table-striped">
              <thead>
                <tr>
                  <th>Christian</th>
                  <th>Hindu</th>
                  <th>Mushlim</th>
                  <th>Buddhist</th>
                  <th>Others</th>
                </tr>
              </thead>
              <tbody>
                <tr>
                  <td>{{$community[0]}}</td>
                  <td>{{$community[1]}}</td>
                  <td>{{$community[2]}}</td>
                  <td>{{$community[3]}}</td>
                  <td>{{$community[4]}}</td>
                </tr>
              </tbody>
            </table>
          </div>
    </div>
    <div class="col-md-4">
          <h2 class="sub-header text-center">Category</h2>
          <div class="table-responsive">
            <table class="table table-striped">
              <thead>
                <tr>
                  <th>ST</th>
                  <th>SC</th>
                  <th>OBC</th>
                  <th>Gen</th>
                </tr>
              </thead>
              <tbody>
                <tr>
                  <td>{{$category[0]}}</td>
                  <td>{{$category[1]}}</td>
                  <td>{{$category[2]}}</td>
                  <td>{{$category[3]}}</td>
                </tr>
              </tbody>
            </table>
          </div>
    </div>
    <div class="col-md-4 ">
          <h2 class="sub-header text-center">Status</h2>
          <div class="table-responsive">
            <table class="table table-striped">
              <thead>
                <tr>
                  <th>Ong</th>
                  <th>Comp</th>
                  <th>Drop</th>
                  <th>Disc</th>
                  <th>Unkn</th>
                </tr>
              </thead>
              <tbody>
                <tr>
                  <td>{{$status[0]}}</td>
                  <td>{{$status[1]}}</td>
                  <td>{{$status[2]}}</td>
                  <td>{{$status[3]}}</td>
                  <td>{{$status[4]}}</td>
                </tr>
              </tbody>
            </table>
          </div>
    </div>
</div>            
@stop
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
                  <th>Year</th>
                  <th>Christ</th>
                  <th>Hindu</th>
                  <th>Mush</th>
                  <th>Buddh</th>
                  <th>Other</th>
                </tr>
              </thead>
              <tbody>
              @foreach($community as $comm)
                <tr>
                  <td>{{$comm[0]}}</td>
                  <td>{{$comm[1]}}</td>
                  <td>{{$comm[2]}}</td>
                  <td>{{$comm[3]}}</td>
                  <td>{{$comm[4]}}</td>
                  <td>{{$comm[5]}}</td>
                </tr>
                
              @endforeach
              <tr>
                  <td><b>TOTAL</b></td>
                  <td><b>{{$comm[6]}}</b></td>
                  <td><b>{{$comm[7]}}</b></td>
                  <td><b>{{$comm[8]}}</b></td>
                  <td><b>{{$comm[9]}}</b></td>
                  <td><b>{{$comm[10]}}</b></td>
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
                  <th>Year</th>
                  <th>ST</th>
                  <th>SC</th>
                  <th>OBC</th>
                  <th>Gen</th>
                </tr>
              </thead>
              <tbody>
               @foreach($category as $cat)
                <tr>
                  <td>{{$cat[0]}}</td>
                  <td>{{$cat[1]}}</td>
                  <td>{{$cat[2]}}</td>
                  <td>{{$cat[3]}}</td>
                  <td>{{$cat[4]}}</td>
                </tr>
                @endforeach
                 <tr>
                  <td><b>TOTAL</b></td>
                  <td><b>{{$cat[5]}}</b></td>
                  <td><b>{{$cat[6]}}</b></td>
                  <td><b>{{$cat[7]}}</b></td>
                  <td><b>{{$cat[8]}}</b></td>
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
                  <th>Year</th>
                  <th>Ong</th>
                  <th>Comp</th>
                  <th>Drop</th>
                  <th>Disc</th>
                  <th>Unkn</th>
                </tr>
              </thead>
              <tbody>
               @foreach($status as $stat)
                <tr>
                  <td>{{$stat[0]}}</td>
                  <td>{{$stat[1]}}</td>
                  <td>{{$stat[2]}}</td>
                  <td>{{$stat[3]}}</td>
                  <td>{{$stat[4]}}</td>
                  <td>{{$stat[5]}}</td>
                </tr>
                @endforeach
                <tr>
                  <td><b>TOTAL</b></td>
                  <td><b>{{$stat[6]}}</b></td>
                  <td><b>{{$stat[7]}}</b></td>
                  <td><b>{{$stat[8]}}</b></td>
                  <td><b>{{$stat[9]}}</b></td>
                  <td><b>{{$stat[10]}}</b></td>
                </tr>
              </tbody>
            </table>
          </div>
    </div>
</div>            
@stop
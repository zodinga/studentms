@extends('main')
@section('title','| Homepage')
    <script type="text/javascript" src="js/loader.js"></script>
    <script type="text/javascript">
      google.charts.load('current', {'packages':['bar']});
      google.charts.setOnLoadCallback(drawChart);
      function drawChart() {
        var data = google.visualization.arrayToDataTable([
          ['Year', 'MCA', 'BCA', 'Diploma','Short'],
          ['2001', 0, 0, 0,0],
          @foreach($studentChart as $std)
            [{{$std[0]}},{{$std[1]}},{{$std[2]}},{{$std[3]}},{{$std[4]}}],
          @endforeach
          
        ]);

        var options = {
          chart: {
            title: 'NIELIT Student Management System',
            subtitle: 'Student Statistics',
          },

          bars: 'vertical' // Required for Material Bar Charts.
        };

        var chart = new google.charts.Bar(document.getElementById('barchart_material'));

        chart.draw(data, options);
      }
    </script>
@section('content')
        <div class="row">
          <div class="col-md-12">
               <div id="barchart_material" style="width: 1200px; height: 500px;"></div>
          </div>
        </div>

        <div class="row">
            <div class="col-md-6">
                <div class="jumbotron">
                  <h2>Welcome to SMS NIELIT!</h2>
                  <img src="/img/poster.jpg" height="50%" width="100%">
                </div>
            </div>
            <div class="col-md-6">
                <div class="jumbotron">
                     <p class="lead">
            <p>The thrust area of NIELIT, Aizawl is Information, Electronics and Information Technology (IECT)</p>
            <p>Objectives</p>
            <ul>
            <li>Disseminate knowledge on all aspects of IT and Electronics.</li>
            <li>Provide Quality Education and Training to prepare individuals for technology driven business environment effectively.</li>
            <li>Provide quality education to participants for upgrading their technical skills in an environment that is conducive to learning by providing good infrastructure.</li>
            <li>Provide continuing support to learners and trainers through design and development of innovative curricula for meeting the dynamically changing IECT scenarios.</li>
            <li>To impart continuing education for upgradation of knowledge and skills in view of high obsolesce in the area of IECT. </li>
            </ul>
</p>
                </div>
            </div>
        </div>
      


 @stop

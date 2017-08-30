@extends ('layout3')

@section ('title') Reportes @stop
@section ('breadcrumbs')

                <ul class="breadcrumb a">
                  <li class="active">
                    <p>Inicio</p>
                  </li>
                  <li><a href="" class="active">Asistencia Mensual </a>
                  </li>
                </ul>
 @stop
@section ('content')
 <h1> Asistencia Trabajadores </h1>


  <canvas id="graph" width="400" height="400"></canvas>

  <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/1.0.2/Chart.min.js"></script>
<script type="text/javascript">
var data = {
  labels: ['January', 'February', 'March'],
  
  datasets: [
    {
      fillColor: "rgba(220,220,220,0.2)",
      strokeColor: "rgba(220,220,220,1)",
      pointColor: "rgba(220,220,220,1)",
      pointStrokeColor: "#fff",
      pointHighlightFill: "#fff",
      pointHighlightStroke: "rgba(220,220,220,1)",
      data: [30, 122, 90]
    },
    {
      fillColor: "rgba(100,220,220,0.7)",
      strokeColor: "rgba(220,220,220,1)",
      pointColor: "rgba(220,220,220,1)",
      pointStrokeColor: "#fff",
      pointHighlightFill: "#fff",
      pointHighlightStroke: "rgba(220,220,220,1)",
      data: [10, 52, 2]
    }
  ]
};

var context = document.querySelector('#graph').getContext('2d');

new Chart(context).Line(data);

	

</script>

@stop




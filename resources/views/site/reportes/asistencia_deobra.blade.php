@extends ('layout3')

@section ('title') Asistencia Trabajadores @stop

@section ('breadcrumbs')

                <ul class="breadcrumb a">
                  <li class="active">
                    <p>Inicio</p>
                  </li>
                  <li><a href="" class="active">Asistencia Trabajadores</a>
                  </li>
                </ul>
 @stop

@section ('content')

<div  class="panel panel-transparent">
              <div class="panel-heading">
                <div class="panel-title"> Asistencia de {{ $trabajador->nombre }} {{ $trabajador->ap_paterno }}
                </div>
                <div class="export-options-container pull-right"></div>
                <div class="clearfix"></div>
              </div>
              <div  class="panel-body">
              </div>
          <div class="row">      	
        <br>	
</div>

<canvas id="projects-graph" width="1000" height="400"></canvas>

<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.1.3/Chart.bundle.min.js"></script>
<script type="text/javascript" src="{{ URL::asset('assets/plugins/bootstrap-datepicker/js/bootstrap-datepicker.js') }}"></script>
<script type="text/javascript" src="{{ URL::asset('assets/plugins/bootstrap-datepicker/js/bootstrap-datepicker.es.min.js') }}"></script>
<script type="text/javascript" src="{{ URL::asset('assets/plugins/moment/moment-with-locales.min.js') }}"></script>
<script type="text/javascript">



$(document).ready(function() {
alert("La asistencia mostrada cuenta del 1er día del mes hasta la fecha de hoy")
var id_trabajador = "<?php echo $trabajador->id ?>";

var url =  'https://aragonltda.cl/reportes/graficoAsistenciaObra/'+ id_trabajador; //asistencia desde obra
  $.getJSON(url, function (result) {
      console.log(result);

new Chart(document.getElementById("projects-graph"), {
    type: 'pie',
    data: {
      labels: ["Días Presente", "Días Atraso"],
      datasets: [{
        label: "Asistencia",
        backgroundColor: ["#3e95cd", "#8e5ea2"],
        data: [result.presente, result.atraso]
      }]
    },
    options: {
      title: {
        display: true,
        text: 'Asistencia de este Mes'
      },
      scales: {
        ticks: {
          beginAtZero: true,
          min: 0,
        },
      },
    },
    legend: {
                display: true,
                labels: {
                    fontColor: "#000080",
                }
            }
    });


  });


});

</script>
@stop

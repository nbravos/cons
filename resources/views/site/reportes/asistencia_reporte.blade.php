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
                <div class="panel-title"> Asistencia de Trabajadores
                </div>
                <div class="export-options-container pull-right"></div>
                <div class="clearfix"></div>
              </div>
              <div  class="panel-body">
              </div>
            
       <div class="form-group">
    <label>Seleccionar Trabajador
        <select name="trabajador" id="trabajador" class="form-control input-sm">
            @foreach($trabajadores as $trabajador)
          <option value="{{$trabajador->id}}">{{$trabajador->nombre}} {{$trabajador->ap_paterno}}</option>            @endforeach
           </select>
    </label>
</div>
          <div class="row">
          <div class= "col-xs-6 col-md-4">
          	<div class="form-group">
           		<label class="control-label" for="inicio">Desde</label>
          		<input class="form-control" id="datepicker1" name="inicio" placeholder="DD/MM/AA" type="text">
      		</div>
      	  </div>
      	  <div class ="col-xs-6 col-md-4">
      		<div class="form-group">
           		<label class="control-label" for="fin">Hasta</label>
          		<input class="form-control" id="datepicker2" name="fin" placeholder="DD/MM/AA" type="text">
      	  	</div>
      	  </div>
      <div class="col-xs-6 col-md-4"> <br> <p  id="button" class="btn btn-primary btn-sm m-t-10" >Filtrar </p></div>
      </div>
      <br>	
</div>

<canvas id="projects-graph" width="1000" height="400"></canvas>

<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.1.3/Chart.bundle.min.js"></script>
<script type="text/javascript" src="{{ URL::asset('assets/plugins/bootstrap-datepicker/js/bootstrap-datepicker.js') }}"></script>
<script type="text/javascript" src="{{ URL::asset('assets/plugins/bootstrap-datepicker/js/bootstrap-datepicker.es.min.js') }}"></script>
<script type="text/javascript" src="{{ URL::asset('assets/plugins/moment/moment-with-locales.min.js') }}"></script>
<script type="text/javascript">

$( "#datepicker1" ).datepicker({
        format: 'dd-mm-yy',
        language: 'es',
        autoclose: true

  });

  $( "#datepicker2" ).datepicker({
        format: 'dd-mm-yy',
        language: 'es',
        autoclose: true

  });

$(document).ready(function() {

        $('#button').click(function() {

//        $('#projects-graph').replaceWith('<canvas id="projects-graph"></canvas>');

        var e = document.getElementById("trabajador");
        var valorid = e.options[e.selectedIndex].value;
        var from = $("#datepicker1").val();
        var to = $("#datepicker2").val();     
        var url = 'https://aragonltda.cl/reportes/graficoAsistenciaDiaria/'+ valorid +'/'+ from +'/'+ to;
        moment.locale('es');

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
        text: 'Asistencia'
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

});

</script>
@stop

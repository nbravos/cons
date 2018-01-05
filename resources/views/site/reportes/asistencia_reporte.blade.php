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
      <div class="col-xs-6 col-md-4"> <br> <p  id="button" class="btn btn-default btn-sm m-t-10" >Filtrar </p></div>
      </div>
      <br>	
</div>

<canvas id="projects-graph" width="1000" height="400"></canvas>

<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.1.3/Chart.bundle.min.js"></script>
<script type="text/javascript" src="{{ URL::asset('assets/plugins/bootstrap-datepicker/js/bootstrap-datepicker.js') }}"></script>
<script type="text/javascript" src="{{ URL::asset('assets/plugins/bootstrap-datepicker/js/bootstrap-datepicker.es.min.js') }}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.17.1/moment-with-locales.min.js"></script>
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
$('#trabajador').on('change', function(e) {
	 
        var e = document.getElementById("trabajador");
        var valorid = e.options[e.selectedIndex].value;
        $('#button').click(function() {
        var from = $("#datepicker1").val();
        var to = $("#datepicker2").val();     
        var url = 'https://aragonltda.cl/reportes/graficoAsistenciaDiaria/'+ valorid +'/'+ from +'/'+ to;
	moment.locale('es');
        
  $.getJSON(url, function (result) {

    var data1=[], data2=[], data3=[], data4=[], data5=[];
    for (var i = 0; i < result.length; i++) {

        data1.push(result[i].nombre);
        data2.push(result[i].apellido);
        data3.push(moment((result[i].fecha)).format('L'));
        data4.push(result[i].presente);
        data5.push(result[i].obra);
    }

    function getColorArray(data, colorLow, colorHigh) {
      var colors = [];
      for(var i = 0; i < result.length; i++) {
      if(data[i] == 1) {
       colors.push(colorHigh);
      } else {
        colors.push(colorLow);
      }
    }
    return colors;
  }
  
    var backgroundColor = getColorArray(data4, 'rgba(179,181,198,0.2)', 'rgba(185, 70, 228, 1)');
    var buyerData = {
      labels : data3,
      datasets : [

        {
          label: "Asistencia Semanal "+data1[0]+" "+data2[0],
          backgroundColors: backgroundColor,
          borderColor: "rgba(179,181,198,1)",
          data : data4
        }
      ]
    };
    var buyers = document.getElementById('projects-graph').getContext('2d');
    
    var chartInstance = new Chart(buyers, {
    type: 'pie',
    data: buyerData, 
    options: {
       scales: {
        ticks: {
          beginAtZero: true,
          min: 0,
          max: 1,
      },
    },
    legend: {
                display: true,
                labels: {
                    fontColor: "#000080",
                }
            }
  },
    
    });

  });

});

});
});

</script>
@stop

@extends ('layout3')

@section ('title') Reportes @stop
@section ('breadcrumbs')

                <ul class="breadcrumb a">
                  <li class="active">
                    <p>Inicio</p>
                  </li>
                  <li><a href="" class="active">Avances Partida </a>
                  </li>
                </ul>
 @stop
@section ('content')

<div  class="panel panel-transparent">
              <div class="panel-heading">
                <div class="panel-title"> Avances por Partida
                </div>
                <div class="export-options-container pull-right"></div>
                <div class="clearfix"></div>
              </div>
              <div  class="panel-body">
              </div>
            
     @php
	$role = App\Models\Proyecto::where('estado', '=', 'obra')->pluck('nombre', 'id');
	$role['0'] = 'Todos';	
	@endphp	
	<div class="form-group">
           {!! Form::label('proy', 'Filtrar por: Obra') !!}
           {!! Form::select('proy', $role, ['0' => 'Todas'], array('class' => 'form-control', 'id' => 'proy')) !!}
     </div>
      <br>
      	<div class="form-group">
                <label for="title">Partidas:</label>
                <select name="partida" class="form-control">
                </select>
        </div>
</div>

<canvas id="projects-graph" width="1000" height="400"></canvas>

<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.1.3/Chart.bundle.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.17.1/moment-with-locales.min.js"></script>


<script type="text/javascript">
$(document).ready(function() {
moment.locale('es');
 $('#proy').change(function() {
 	
 	var e = document.getElementById("proy");
    var id_obra = e.options[e.selectedIndex].value;
 	var url = "https://aragonltda.cl/reportes/selectObraAvance/" +id_obra;
              $.ajax({
                    url: url,
                    type: "GET",
                    dataType: "json",
                    success:function(data) {
			console.log(data);
                        $.each(data, function(id, nombre) {
                            $('select[name="partida"]').append('<option value="'+ id +'">'+ nombre +'</option>');
                        });
                    }
                });
  });

 $('#button').click(function() {
 	var a = document.getElementById("partida");
    var id_partida = a.options[a.selectedIndex].value;
 	var url = "https://aragonltda.cl/reportes/avanceObra/"+id_partida;
 	$.getJSON(url, function (result) {

    var  data2=[], data3=[], data4=[], data5=[];
    for (var i = 0; i < result.length; i++) {

        data2.push(result[i].cantidad);
        data3.push(moment((result[i].inicio)).format('L'));
        data4.push(result[i].porcentaje);
        data5.push(moment((result[i].termino)).format('L'));
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
      labels : data4,
      datasets : [

        {
          label: "Avances Porncentuales",
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

</script>
@stop



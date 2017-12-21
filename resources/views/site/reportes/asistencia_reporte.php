@extends ('layout3')
@section ('title')  @stop
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

           <div class="form-group">
    <label>Trabajadores
        <select name="id_trabajador" id="id_trabajador" class="form-control input-sm">
            @foreach($trabajadores as $trabajador)
          <option value="{{$trabajador->id}}">{{$trabajador->nombre}} {{$trabajador->ap_paterno}}</option>            @endforeach
           </select>
    </label>
</div>	

<canvas id="projects-graph1" width="1000" height="400"></canvas>

<script type="text/javascript" src="{{ URL::asset('assets/plugins/bootstrap-datepicker/js/bootstrap-datepicker.js') }}"></script>
<script type="text/javascript" src="{{ URL::asset('assets/plugins/bootstrap-datepicker/js/bootstrap-datepicker.es.min.js') }}"></script>

<script type="text/javascript">

$( "#datepicker1" ).datepicker({
        format: 'yy-mm-dd',
        language: 'es',
        autoclose: true

  });

  $( "#datepicker2" ).datepicker({
        format: 'yy-mm-dd',
        language: 'es',
        autoclose: true

  });

	 $('#button').click(function() {
         

	 $('#trabajador').on('change', function(e) {
        var e = document.getElementById("trabajador");
        var valorid = e.options[e.selectedIndex].value;
        var from = $("#datepicker1").val();
        var to = $("#datepicker2").val();     
        var url = 'https://aragonltda.cl/partidas/graficoAsistenciaDiaria/'+ valorid +'/'+ from +'/'+ to;

        
  $.getJSON(url, function (result) {

    var data1=[], data2=[], data3=[], data4=[], data5=[];
    for (var i = 0; i < result.length; i++) {

        data1.push(result[i].nombre);
        data2.push(result[i].apellido);
        data3.push(result[i].fecha);
        data4.push(result[i].presente);
        data5.push(result[i].obra);
    }
  
    var buyerData = {
      labels : data3,
      datasets : [

        {
          label: "Asistencia Semanal "+data1[0]+" "+data2[0],
          backgroundColor: ["#3e95cd", "#8e5ea2","#3cba9f","#e8c3b9","#c45850", "#99ff33", "#660033"],
          borderColor : 'rgba(75, 192, 192, 1)',
          data : data4
        }
      ]
    };
    var buyers = document.getElementById('projects-graph').getContext('2d');
    
    var chartInstance = new Chart(buyers, {
    type: 'polarArea',
    data: buyerData, 
    options: {
       scales: {

          xAxes: [{
            gridLines:{
              display: false
            }
            
      }],
    }
  },
    
    });

  });

});

});

</script>
@stop
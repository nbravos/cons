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

 

<div class="form-group">
           {!! Form::label('proyecto', 'Seleccionar Proyecto:') !!}
          {!! Form::select('proyecto', App\Models\Proyecto::pluck('nombre', 'id'), null, array('class' => 'form-control', 'id' => 'proyecto')) !!}
</div>
<div class="form-group">
    <label> Seleccionar Trabajador:
        <select id="trabajadores" class="form-control" name="trabajadores">
            <option value=""></option>
       </select>
    </label>
</div>
<button class="btn btn-primary" id="button1" name="button1">Gráfico</button>
<button class="btn btn-primary" id="button2" name="button2">Tabla</button>

<div class="panel panel-transparent">
              <div class="panel-heading">
                <div class="panel-title">
                </div>
                <div class="export-options-container pull-right"></div>
                <div class="clearfix"></div>
              </div>
              <div class="panel-body">
  <table id="listaTrabProy" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
              <thead>
                <tr>
                <th>Número</th>
                <th>Nombre</th>
               <th>Apellido</th>
                <th>Presente</th>
                 <th>Atraso</th>
                 <th>Fecha</th>
                 </tr>
              </thead>
                  <tfoot>
                    <tr>
                    <td class="non_searchable"></td>
                      <td></td>
                      <td></td>
                      <td></td>
                      <td></td>
                      <td></td>
                    </tr>
                  </tfoot>
              </table>


              <canvas id="projects-graph" width="800" height="400"></canvas>

              </div>
            </div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js">
  
</script>
 <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/1.0.2/Chart.min.js"></script>

<script type="text/javascript">
 $('#proyecto').on('change', function(e){
 console.log(e);
 var proyecto_id = e.target.value;
 $.get('getTrabajadores/' + proyecto_id, function(data) { //The value of item will be passed to ajaxCategory Function. 
 console.log(data);
 $('#trabajadores').empty();
 $.each(data, function(index, CatObj){
 $('#trabajadores').append($('<option>', { 
 	value: CatObj.id,
 	text : CatObj.nombre    +  CatObj.ap_paterno,
 			}));
 		});
 	});
 });


   $('#trabajadores').on('change', function(e){
   	 var e = document.getElementById("trabajadores");
     var valorTrab = e.options[e.selectedIndex].value;
     
        $('#button1').click(function() {
           $.getJSON('./getChartTrab/'+ valorTrab, function (result) {
            var labels = [],data=[];
           for (var i = 0; i < result.length; i++) {
            labels.push(result[i].fecha);
            data.push(result[i].presente);
            
              }
        
      var buyerData = {
      labels : labels,
      datasets : [
        {
          fillColor : "rgba(240, 127, 110, 0.3)",
          strokeColor : "#f56954",
          pointColor : "#A62121",
          pointStrokeColor : "#741F1F",
          data : data
        }
      ]
    };
    var buyers = document.getElementById('projects-graph').getContext('2d');
    
    var chartInstance = new Chart(buyers, {
    type: 'line',
    data: buyerData,
});
});

});

     $('#button2').click(function(){
      var url = 'https://aragonltda.cl/reportes/getTablaTrab/'+ valorTrab;
        $('#listaTrabProy').DataTable({
            processing: false,
            serverSide: true,
            ajax: url,
            order: [[2, "desc"]], 
            lengthMenu: [[10, 25, 50, -1], [10, 25, 50, 'TODO']],
            "sDom": 'TRfrtlip',
            "oTableTools": {
          "sSwfPath": "//cdn.datatables.net/tabletools/2.2.2/swf/copy_csv_xls_pdf.swf",
          "aButtons": [
            {
              "sExtends": "xls",
              "sButtonText": 'Exportar ',
              "sFileName": "Asistencia_Trabajadores - *.csv",
               "mColumns": [1, 3, 4, 5],
              "aButtons": [ "xls" ]
            }
            ]
        },
           
              language: {
              url: 'https://cdn.datatables.net/plug-ins/1.10.12/i18n/Spanish.json'
          },
            columns: [
                {data: 'id', name: 'id', visible: false},
                {data: 'nombre', render : function ( data, type, full ) { 
        return full['nombre'] +' '+ full['apellido'];}
      },
                {data: 'apellido', name: 'trabajador.ap_paterno', visible: false},
                {data: 'presente', render:  function(data, type, row) {
                                if (data === '1') {
                                return 'Si';
                                  } else {
                                return 'No';
                              }}, name: 'asistencia.presente'},
                {data: 'ausente', render:  function(data, type, row) {
                                if (data === '1') {
                                return 'Si';
                                  } else {
                                return 'No';
                              }}, name: 'asistencia.ausente'},
                {data: 'fecha', name: 'asistencia.fecha'},
    
            ],

        });
              $('#listaTrabProy tfoot tr').appendTo('#listaTrabProy thead');
     });
 });
 </script>


@stop





@extends ('layout3')

@section ('title') Lista de Licitaciones @stop

@section ('breadcrumbs')

                <ul class="breadcrumb a">
                  <li class="active">
                    <p>Inicio</p>
                  </li>
                  <li><a href="" class="active">Licitaciones</a>
                  </li>
                </ul>
 @stop

@section ('content')


  <a href="{{ route('proyectos.create') }}" class="btn btn-primary" >Agregar nuevo</a>
  
  
<!--  <div class="container-fluid container-fixed-lg bg-white"> -->
            <!-- START PANEL -->
            <div  class="panel panel-transparent">
              <div class="panel-heading">
                <div class="panel-title">Listado de Licitaciones
                </div>
                <div class="export-options-container pull-right"></div>
                <div class="clearfix"></div>
              </div>
              <div  class="panel-body">
	  @php
	$role = App\Models\Comuna::where('id', '>', '5000')->pluck('nombre', 'id');
	$role['0'] = 'Todos';	
	$emp =  App\Models\Empresa::pluck('nombre', 'id');
	$emp['0'] = 'Todos'; 
	@endphp	
           {!! Form::label('com', 'Filtrar por: Comuna') !!}
           {!! Form::select('com',  $role, null, array('class' => 'form-control', 'id' => 'com')) !!}

           {!! Form::label('mand', 'Filtrar por: Mandante') !!}
           {!! Form::select('mand', $emp, ['0' => 'Todos'], array('class' => 'form-control', 'id' => 'mand')) !!}
          <br>
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
	<br>
  <table id="listaPro" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
              <thead>
                <tr>
                <th>Número</th>
                <th>Nombre</th>
                 <th>Comuna</th>
		<th>Mandante</th>	
                 <th>Fecha</th>
                 <th>Acciones</th>
                 </tr>
              </thead>
              <tfoot>
                    <tr>
                      <td class="non_searchable"></td>
                      <td></td>
                      <td></td>
                      <td></td>
		      <td></td>	
                      <td  class="non_searchable"></td>
                    </tr>
                  </tfoot>
              </table>
              </div>
            </div>
<!--          </div> -->

<script type="text/javascript">
             $(document).ready(function() {

              
               $('#listaPro').DataTable({
            processing: false,
            serverSide: true,
            ajax: '{!! route("proyectos.index") !!}',
	    order: [[4, "desc"]], 
            lengthMenu: [[10, 25, 50, -1], [10, 25, 50, 'TODO']],
            "sDom": 'Rfrtlip',
            language: {
              url: 'https://cdn.datatables.net/plug-ins/1.10.12/i18n/Spanish.json'
          },
            columns: [
                {data: 'id', name: 'proyecto.id', visible: false},
                {data: 'proNombre', name: 'proyecto.nombre'},
                {data: 'comu', name: 'comuna.nombre'},
                {data: 'mand', name:'empresa.nombre'},
                {data: 'fecha_licitacion', name: 'proyecto.fecha_licitacion'},
                {data: 'action', name: 'action', orderable: false, searchable: false}
    
            ],
            
        });
              $('#listaPro tfoot tr').appendTo('#listaPro thead');
            
       });


          </script>


      <script type="text/javascript">

        $('#com').on('change', function(e) {
        var e = document.getElementById("com");
        var valorCom = e.options[e.selectedIndex].value;
	var url = 'https://aragonltda.cl/proyectos/getcom/'+ valorCom;
      $('#listaPro').dataTable( {

         "bDestroy": true   
});
   $('#listaPro').dataTable().fnDestroy();
   $('#listaPro').empty();

        $('#listaPro').DataTable({
            processing: false,
            serverSide: true,
            ajax: url,
      order: [[4, "desc"]], 
            lengthMenu: [[10, 25, 50, -1], [10, 25, 50, 'TODO']],
            "sDom": 'TRfrtlip',
            "oTableTools": {
          "sSwfPath": "//cdn.datatables.net/tabletools/2.2.2/swf/copy_csv_xls_pdf.swf",
          "aButtons": [
            {
              "sExtends": "xls",
              "sButtonText": 'Exportar ',
              "sFileName": "Proyectos - *.csv",
               "mColumns": [ 1, 2, 3],
              "aButtons": [ "xls" ]
            }
            ]
        },
            language: {
              url: 'https://cdn.datatables.net/plug-ins/1.10.12/i18n/Spanish.json'
          },
            columns: [
                {data: 'id', name: 'proyecto.id', visible: false},
                {data: 'proNombre', name: 'proyecto.nombre', title: 'Proyecto'},
                {data: 'comu', name: 'comuna.nombre', title: 'Comuna'},
                {data: 'mand', name:'empresa.nombre', title: 'Mandante'},
                {data: 'fecha_licitacion', name: 'proyecto.fecha_licitacion', title: 'Fecha Licitación'},
                {data: 'action', name: 'action', orderable: false, searchable: false, title: 'Acción'}
    
            ],
            
        });

          $('#listaPro tfoot tr').appendTo('#listaPro thead');
         
            
        });


	
        $('#mand').on('change', function(e) {
        var e = document.getElementById("mand");
        var valorMand = e.options[e.selectedIndex].value;
  var url = 'https://aragonltda.cl/proyectos/getman/'+ valorMand;
      $('#listaPro').dataTable( {

         "bDestroy": true   
});
   $('#listaPro').dataTable().fnDestroy();
   $('#listaPro').empty();

        $('#listaPro').DataTable({
            processing: false,
            serverSide: true,
            ajax: url,
      order: [[4, "desc"]], 
            lengthMenu: [[10, 25, 50, -1], [10, 25, 50, 'TODO']],
            "sDom": 'TRfrtlip',
            "oTableTools": {
          "sSwfPath": "//cdn.datatables.net/tabletools/2.2.2/swf/copy_csv_xls_pdf.swf",
          "aButtons": [
            {
              "sExtends": "xls",
              "sButtonText": 'Exportar ',
              "sFileName": "Proyectos - *.csv",
               "mColumns": [ 1, 2, 3],
              "aButtons": [ "xls" ]
            }
            ]
        },
            language: {
              url: 'https://cdn.datatables.net/plug-ins/1.10.12/i18n/Spanish.json'
          },
            columns: [
                {data: 'id', name: 'proyecto.id', visible: false},
                {data: 'proNombre', name: 'proyecto.nombre', title: 'Proyecto'},
                {data: 'comu', name: 'comuna.nombre', title: 'Comuna'},
                {data: 'mand', name:'empresa.nombre', title: 'Mandante'},
                {data: 'fecha_licitacion', name: 'proyecto.fecha_licitacion', title: 'Fecha Licitación'},
                {data: 'action', name: 'action', orderable: false, searchable: false, title: 'Acción'}
    
            ],
            
            
        });

          $('#listaPro tfoot tr').appendTo('#listaPro thead');
         
            
        });

    </script>

   <script src="https://aragonltda.cl/assets/plugins/bootstrap-datepicker/js/bootstrap-datepicker.js"></script>
   <script src="https://aragonltda.cl/assets/plugins/bootstrap-datepicker/js/bootstrap-datepicker.es.min.js"></script>
    <script type="text/javascript">
$(document).ready(function () {
       
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

$("#button").click(function() {
   var from = $("#datepicker1").val();
   var to = $("#datepicker2").val();
   
   var url = 'https://aragonltda.cl/proyectos/getfilFecha/'+ from +'/' + to;

  
    $('#listaPro').dataTable( {

         "bDestroy": true   
});
   $('#listaPro').dataTable().fnDestroy();
   $('#listaPro').empty();
         $('#listaPro').DataTable({
            processing: false,
            serverSide: true,
            ajax: url,
            order: [4, "asc"], 
            lengthMenu: [[10, 25, 50, -1], [10, 25, 50, 'TODO']],
            "sDom": 'TRfrtlip',
            "oTableTools": {
          "sSwfPath": "//cdn.datatables.net/tabletools/2.2.2/swf/copy_csv_xls_pdf.swf",
          "aButtons": [
            {
              "sExtends": "xls",
              "sButtonText": 'Exportar ',
              "sFileName": "Proyectos - *.csv",
               "mColumns": [ 1, 2, 3],
              "aButtons": [ "xls" ]
            }
            ]
        },
            language: {
              url: 'https://cdn.datatables.net/plug-ins/1.10.12/i18n/Spanish.json'
          },
            columns: [
                {data: 'id', name: 'proyecto.id', visible: false},
                {data: 'proNombre', name: 'proyecto.nombre', title: 'Proyecto'},
                {data: 'comu', name: 'comuna.nombre', title: 'Comuna'},
                {data: 'mand', name:'empresa.nombre', title: 'Mandante'},
                {data: 'fecha_licitacion', name: 'proyecto.fecha_licitacion', title: 'Fecha Licitación'},
                {data: 'action', name: 'action', orderable: false, searchable: false, title: 'Acción'}
    
            ],

         
        });
              $('#listaPro tfoot tr').appendTo('#listaPro thead');
        });

});

</script>  

 
@stop

@extends ('layout3')
@section ('title') Listado Partidas  @stop
@section ('breadcrumbs')

                <ul class="breadcrumb a">
                  <li class="active">
                    <p>Inicio</p>
                  </li>
                  <li><a href="" class="active">Obras</a>
                  </li>
                </ul>
 @stop
@section ('content')

  <!-- <div class="container-fluid container-fixed-lg bg-white">-->
            <!-- START PANEL -->
            <div class="panel panel-transparent">
              <div class="panel-heading">
                <div class="panel-title">Obras
                </div>
                <div class="export-options-container pull-right"></div>
                <div class="clearfix"></div>
              </div>
              <div class="panel-body">
              <div class="form-group">
          <div class="form-group">
      {!!Form::label('select1', 'Filtro')!!}
      {!!Form::select('select1', array(
          '1' => 'Activos',
          '0' => 'Todos',
          '2' => 'No Activos'), null, ['id' =>'select1', 'class' => 'form-control']) !!}
  </div>
    </div>
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
<script type="text/javascript">
$(document).ready(function(){

  var url = 'https://aragonltda.cl/partidas/getIndex/1';
  $('#listaPro').dataTable({

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
            "sDom": 'Rfrtlip',
            language: {
              url: 'https://cdn.datatables.net/plug-ins/1.10.12/i18n/Spanish.json'
            },
            columns: [
                {data: 'id', name: 'proyecto.id', visible: false},
                {data: 'proNombre', name: 'proyecto.nombre', title: 'Nombre'},
                {data: 'comu', name: 'comuna.nombre', title: 'Comuna'},
                {data: 'mand', name:'empresa.nombre', title: 'Mandante'},
                {data: 'fecha_licitacion', name: 'proyecto.fecha_licitacion', title: 'Fecha'},
                {data: 'action', name: 'action', orderable: false, searchable: false, title: 'Acciones'}
    
            ],
            
    });


	$('#select1').on('change', function(e){
    console.log(e); 
     var e = document.getElementById("select1");
     var estado = e.options[e.selectedIndex].value;
     var url = 'https://aragonltda.cl/partidas/getIndex/'+ estado; 

     $('#listaPro').dataTable({

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
            "sDom": 'Rfrtlip',
            language: {
            	url: 'https://cdn.datatables.net/plug-ins/1.10.12/i18n/Spanish.json'
          	},
            columns: [
                {data: 'id', name: 'proyecto.id', visible: false},
                {data: 'proNombre', name: 'proyecto.nombre', title: 'Nombre'},
                {data: 'comu', name: 'comuna.nombre', title: 'Comuna'},
                {data: 'mand', name:'empresa.nombre', title: 'Mandante'},
                {data: 'fecha_licitacion', name: 'proyecto.fecha_licitacion', title: 'Fecha'},
                {data: 'action', name: 'action', orderable: false, searchable: false, title: 'Acciones'}
    
            ],
            
        });
              $('#listaPro tfoot tr').appendTo('#listaPro thead');

 });
});	
</script>
@stop

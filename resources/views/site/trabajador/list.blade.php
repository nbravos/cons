 
@extends ('layout3')

@section ('title') Listado de Trabajadores @stop
@section ('breadcrumbs')

                <ul class="breadcrumb a">
                  <li class="active">
                    <p>Inicio</p>
                  </li>
                  <li><a href="" class="active">Trabajadores</a>
                  </li>
                </ul>
 @stop
@section ('content')

<p>
  <a href="{!! route('trabajador.create') !!}" class="btn btn-primary">Agregar nuevo </a>
  </p>
<!-- <div class="container-fluid container-fixed-lg bg-white"> -->
            <!-- START PANEL -->
            <div class="panel panel-transparent">
              <div class="panel-heading">
                <div class="panel-title">Listado de Trabajadores
                </div>
                <div class="export-options-container pull-right"></div>
                <div class="clearfix"></div>
              </div>
              <div class="panel-body">

          {!! Form::label('filtro', 'Filtrar por: ') !!}
          {!!Form::select('filtroTrab', array(
          '0' => 'Todos',
          '1' => 'Contrato Vigente', 
          '2' => 'Finiquitado'), null, ['id' =>'filtroTrab', 'class' => 'form-control']) !!}

<br>
          @php
  $role = App\Models\Proyecto::pluck('nombre', 'id');
  $role['0'] = 'Todos'; 
  
  @endphp 
           {!! Form::label('proyecto', 'Filtrar por: Proyecto') !!}
           {!! Form::select('proyecto', $role, ['0' => 'Todos'], array('class' => 'form-control', 'id' => 'proyecto')) !!}

          <br>

          <div class="row">
          <div class= "col-xs-6 col-md-4">
          <div class="form-group">
           <label class="control-label" for="inicio">Desde</label>
          <input class="form-control" id="datepicker1" name="inicio" placeholder="AA/MM/DD" type="text">
      </div>
      </div>
      <div class ="col-xs-6 col-md-4">
      <div class="form-group">
           <label class="control-label" for="fin">Hasta</label>
          <input class="form-control" id="datepicker2" name="fin" placeholder="AA/MM/DD" type="text">
      </div>
      </div>
      <div class="col-xs-6 col-md-4"> <br> <p  id="button" class="btn btn-default btn-sm m-t-10" >Filtrar </p></div>
      </div>
      <br>
            <table id="listaTra" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
              <thead>
                <tr>
                <th>Número</th>
                <th>Nombre</th>
                <th>Apellido</th>
                <th>Fecha Término Contrato</th>
                 <th>Acciones</th>
                 </tr>
              </thead>
                  <tfoot>
                    <tr>
                      <td class="non_searchable"></td>
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
               $('#listaTra').DataTable({
            processing: false,
            serverSide: true,
            ajax: '{!! route("trabajador.index") !!}',
	          order: [4, "asc"], 
            lengthMenu: [[10, 25, 50, -1], [10, 25, 50, 'TODO']],
            "sDom": 'Rfrtlip',
            language: {
              url: 'https://cdn.datatables.net/plug-ins/1.10.12/i18n/Spanish.json'
          },
            columns: [
                {data: 'id', name: 'id', visible: false},
                {data: 'nombre', name: 'nombre'},
                {data: 'ap_paterno', name: 'ap_paterno'},
                {data: 'fecha_termino', render: function(data, type, row){
                  if (data === '01-01-1970'){
                    return 'Contrato Indefinido';
                  } else {
                    return data;
                  }}, name: 'fecha_termino', title: 'Fecha Término Contrato'},
                {data: 'action', name: 'action', orderable: false, searchable: false}
    
            ],

         
        });
              $('#listaTra tfoot tr').appendTo('#listaTra thead');
       });

          </script>

<script type="text/javascript">

        $('#filtroTrab').on('change', function(e) {
        var e = document.getElementById("filtroTrab");
        var filtroTrabajador = e.options[e.selectedIndex].value;
        var url = 'https://aragonltda.cl/trabajador/getfil/'+ filtroTrabajador;

         $('#listaTra').dataTable( {

         "bDestroy": true   
});
   $('#listaTra').dataTable().fnDestroy();
   $('#listaTra').empty();




         $('#listaTra').DataTable({
            processing: false,
            serverSide: true,
            ajax: url,
            order: [4, "asc"], 
            lengthMenu: [[10, 25, 50, -1], [10, 25, 50, 'TODO']],
            "sDom": 'Rfrtlip',
            language: {
              url: 'https://cdn.datatables.net/plug-ins/1.10.12/i18n/Spanish.json'
          },
            columns: [
                {data: 'id', name: 'id', visible: false},
                {data: 'nombre', name: 'nombre', title: 'Nombre'},
                {data: 'ap_paterno', name: 'ap_paterno', title: 'Apellido'},
                {data: 'fecha_termino', render: function(data, type, row){
                  if (data === '01-01-1970'){
                    return 'Contrato Indefinido';
                  } else {
                    return data;
                  }}, name: 'fecha_termino', title: 'Fecha Término Contrato'},
                {data: 'action', name: 'action', orderable: false, searchable: false, title: 'Acciones' }
    
            ],

         
        });

              $('#listaTra tfoot tr').appendTo('#listaTra thead');
            });


</script>      

<script type="text/javascript">

        $('#proyecto').on('change', function(e) {
        var e = document.getElementById("proyecto");
        var filtroProyecto = e.options[e.selectedIndex].value;
        var url = 'https://aragonltda.cl/trabajador/getfilPro/'+ filtroProyecto;

         $('#listaTra').dataTable( {

         "bDestroy": true   
});
   $('#listaTra').dataTable().fnDestroy();
   $('#listaTra').empty();

         $('#listaTra').DataTable({
            processing: false,
            serverSide: true,
            ajax: url,
            order: [4, "asc"], 
            lengthMenu: [[10, 25, 50, -1], [10, 25, 50, 'TODO']],
            "sDom": 'Rfrtlip',
            language: {
              url: 'https://cdn.datatables.net/plug-ins/1.10.12/i18n/Spanish.json'
          },
            columns: [
                {data: 'id', name: 'trabajador.id', visible: false},
                {data: 'nombre', name: 'trabajador.nombre', title: 'Nombre'},
                {data: 'ap_paterno', name: 'trabajador.ap_paterno', title: 'Apellido'},
                {data: 'fecha_termino', render: function(data, type, row){
                  if (data === '01-01-1970'){
                    return 'Contrato Indefinido';
                  } else {
                    return data;
                  }}, name: 'fecha_termino', title: 'Fecha Término Contrato'},
                {data: 'action', name: 'action', orderable: false, searchable: false, title: 'Acciones'}
    
            ],

         
        });

              $('#listaTra tfoot tr').appendTo('#listaTra thead');
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


 });

$("#button").click(function() {
  var from = $('#datepicker1').val();
   var to = $("#datepicker2").val();
   var url = 'https://aragonltda.cl/trabajador/getfilFecha/'+ from +'/' + to;

  
    $('#listaTra').dataTable( {

         "bDestroy": true   
});
   $('#listaTra').dataTable().fnDestroy();
   $('#listaTra').empty();
         $('#listaTra').DataTable({
            processing: false,
            serverSide: true,
            ajax: url,
            order: [4, "asc"], 
            lengthMenu: [[10, 25, 50, -1], [10, 25, 50, 'TODO']],
            "sDom": 'Rfrtlip',
            language: {
              url: 'https://cdn.datatables.net/plug-ins/1.10.12/i18n/Spanish.json'
          },
            columns: [
                {data: 'id', name: 'id', visible: false},
                {data: 'nombre', name: 'nombre'},
                {data: 'ap_paterno', name: 'ap_paterno'},
                {data: 'fecha_termino', render: function(data, type, row){
                  if (data === '01-01-1970'){
                    return 'Contrato Indefinido';
                  } else {
                    return data;
                  }}, name: 'fecha_termino', title: 'Fecha Término Contrato'},
                {data: 'action', name: 'action', orderable: false, searchable: false}
    
            ],

         
        });
            
              $('#listaTra tfoot tr').appendTo('#listaTra thead');
        });



</script>  

@stop



 

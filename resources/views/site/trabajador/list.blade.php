 
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
              url: 'http://cdn.datatables.net/plug-ins/1.10.12/i18n/Spanish.json'
          },
            columns: [
                {data: 'id', name: 'id', visible: false},
                {data: 'nombre', name: 'nombre'},
                {data: 'ap_paterno', name: 'ap_paterno'},
                {data: 'fecha_termino', name: 'fecha_termino'},
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
        var url = 'http://aragonltda.cl/trabajador/getfil/'+ filtroTrabajador;

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
              url: 'http://cdn.datatables.net/plug-ins/1.10.12/i18n/Spanish.json'
          },
            columns: [
                {data: 'id', name: 'id', visible: false},
                {data: 'nombre', name: 'nombre'},
                {data: 'ap_paterno', name: 'ap_paterno'},
                {data: 'fecha_termino', name: 'fecha_termino'},
                {data: 'action', name: 'action', orderable: false, searchable: false}
    
            ],

         
        });
              $('#listaTra tfoot tr').appendTo('#listaTra thead');
            });


</script>        

@stop

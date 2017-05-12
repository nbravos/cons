 
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
  <table id="listaTra" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
              <thead>
                <tr>
                <th>Número</th>
                <th>Nombre</th>
                 <th>Teléfono</th>
                 <th>Acciones</th>
                 </tr>
              </thead>
                  <tfoot>
                    <tr>
                      <td class="non_searchable"></td>
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
	order: [[0, "desc"]], 
            lengthMenu: [[10, 25, 50, -1], [10, 25, 50, 'TODO']],
            "sDom": 'Rfrtlip',
            language: {
              url: 'http://cdn.datatables.net/plug-ins/1.10.12/i18n/Spanish.json'
          },
            columns: [
                {data: 'id', name: 'id'},
                {data: 'nombre', name: 'nombre'},
                {data: 'telefono', name: 'telefono'},
                {data: 'action', name: 'action', orderable: false, searchable: false}
    
            ],

         
        });
              $('#listaTra tfoot tr').appendTo('#listaTra thead');
       });

          </script>

@stop

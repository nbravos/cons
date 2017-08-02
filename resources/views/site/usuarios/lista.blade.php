
@extends ('layout3')

@section ('title') Lista de Usuarios @stop

@section ('breadcrumbs')

		<ul class="breadcrumb a">
                  <li class="active">
                    <p>Inicio</p>
                  </li>
                  <li><a href="" class="active">Usuarios</a>
                  </li>
                </ul>
 @stop

@section ('content')

<p>
  <a href="{!! route('usuarios.create') !!}" class="btn btn-primary">Agregar nuevo  </a>
  </p>

<!--         <div class="container-fluid container-fixed-lg bg-white"> -->
            <!-- START PANEL -->
            <div class="panel panel-transparent">
              <div class="panel-heading" style>
                <div class="panel-title">Usuarios
                </div>
                <div class="export-options-container pull-right"></div>
                <div class="clearfix"></div>
              </div>
              <div class="panel-body">
  <table id="users-table" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
              <thead>
                      <tr>
                  <th>Número</th>
                  <th>Nombre</th>
                  <th>Correo</th>
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

            <!-- END PANEL -->

         <script type="text/javascript">
              $(document).ready(function() {
               $('#users-table').DataTable({
            processing: false,
            serverSide: true,
            ajax: '{!! route("usuarios.index") !!}',
		order: [[0, "desc"]], 
            lengthMenu: [[10, 25, 50, -1], [10, 25, 50, 'TODO']],
             "dom": 'Bfrtip'
              buttons: [
                'copy', 'excel', 'pdf', 'csv'
              ],
            language: {
              url: 'https://cdn.datatables.net/plug-ins/1.10.12/i18n/Spanish.json'
          },
            columns: [
                {data: 'id', name: 'id', visible: false},
                {data: 'name', name: 'name'},
                {data: 'email', name: 'email'},
                {data: 'action', name: 'action', orderable: false, searchable: false}
		
            ],
           
        });
              $('#users-table tfoot tr').appendTo('#users-table thead');

       });

          </script>


@stop 

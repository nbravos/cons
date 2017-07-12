 
@extends ('layout3')

@section ('title') Lista de Usuarios @stop

@section ('content')
 

         <div class="container-fluid container-fixed-lg bg-white">
            <!-- START PANEL -->
            <div class="panel panel-transparent">
              <div class="panel-heading">
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
                      <td class="non_searchable"></td>
                    </tr>
                  </tfoot>
              </table>
              </div>
            </div>
          </div>

            <!-- END PANEL -->
         <script type="text/javascript">
              $(document).ready(function() {
              $('#users-table').DataTable({
            processing: true,
            serverSide: true,
            ajax: '{!! route("usuarios.index") !!}',
            lengthMenu: [[10, 25, 50, -1], [10, 25, 50, 'TODO']],
            dom: 'lBfrtip',
            language: {
              url: 'http://cdn.datatables.net/plug-ins/1.10.12/i18n/Spanish.json'
          },
            columns: [
                {data: 'id', name: 'id'},
                {data: 'name', name: 'name'},
                {data: 'email', name: 'email'},
                {data: 'action', name: 'action', orderable: false, searchable: false}
		
            ],
            initComplete: function () {
                this.api().columns().every(function () {
                    var column = this;
                    var columnClass = column.footer().className;
                    if(columnClass != 'non_searchable'){
                      var input = document.createElement("input");
                      $(input).appendTo($(column.footer()).empty())
                      .on('keydown change', function () {
                          column.search($(this).val(), false, false, true).draw();
                      });
                  } 
                });
            }
        });
               
              });
          </script>
@stop 

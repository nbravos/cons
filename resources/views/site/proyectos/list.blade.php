 
@extends ('layout3')

@section ('title') Lista de Proyectos @stop

@section ('breadcrumbs')

                <ul class="breadcrumb a">
                  <li class="active">
                    <p>Inicio</p>
                  </li>
                  <li><a href="" class="active">Proyectos</a>
                  </li>
                </ul>
 @stop

@section ('content')


  <a href="{{ route('proyectos.create') }}" class="btn btn-primary" >Agregar nuevo</a>
  
  
<!--  <div class="container-fluid container-fixed-lg bg-white"> -->
            <!-- START PANEL -->
            <div  class="panel panel-transparent">
              <div class="panel-heading">
                <div class="panel-title">Listado de Proyectos
                </div>
                <div class="export-options-container pull-right"></div>
                <div class="clearfix"></div>
              </div>
              <div  class="panel-body">
  <table id="listaPro" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
              <thead>
                <tr>
                <th>Número</th>
                <th>Nombre</th>
                 <th>Comuna de Proyecto</th>
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
            lengthMenu: [[10, 25, 50, -1], [10, 25, 50, 'TODO']],
            "sDom": 'Rfrtlip',
            language: {
              url: 'http://cdn.datatables.net/plug-ins/1.10.12/i18n/Spanish.json'
          },
            columns: [
                {data: 'id', name: 'proyecto.id'},
                {data: 'proNombre', name: 'proNombre'},
                {data: 'comu', name: 'comu'},
                {data: 'fecha_licitacion', name: 'proyecto.fecha_licitacion'},
                {data: 'action', name: 'action', orderable: false, searchable: false}
    
            ],
            
        });
              $('#listaPro tfoot tr').appendTo('#listaPro thead');
       });

          </script>


         <!-- <script type="text/javascript">
              $(document).ready(function() {
              $('#listaPro').DataTable({
                "oLanguage": { 
                  "sUrl": "//cdn.datatables.net/plug-ins/1.10.7/i18n/Spanish.json" }
                });
              });
          </script> -->
@stop

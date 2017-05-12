 
@extends ('layout3')

@section ('title') Listado de Documentos @stop
@section ('breadcrumbs')

                <ul class="breadcrumb a">
                  <li class="active">
                    <p>Inicio</p>
                  </li>
                  <li><a href="" class="active">Documentos</a>
                  </li>
                </ul>
 @stop
@section ('content')
 
<p>
  <a href="{!! route('documentos.create') !!}" class="btn btn-primary">Agregar nuevo </a>
  </p>
<!--<div class="container-fluid container-fixed-lg bg-white">-->
            <!-- START PANEL -->
            <div class="panel panel-transparent">
              <div class="panel-heading">
                <div class="panel-title">Listado de Documentos
                </div>
                <div class="export-options-container pull-right"></div>
                <div class="clearfix"></div>
              </div>
              <div class="panel-body">
  <table id="listaDoc" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
              <thead>
                <tr>
                <th> Número</th>
                <th>Tipo</th>
                 <th>Monto</th>
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
               $('#listaDoc').DataTable({
            processing: false,
            serverSide: true,
            ajax: '{!! route("documentos.index") !!}',
	    order: [[3, "desc"]], 
            lengthMenu: [[10, 25, 50, -1], [10, 25, 50, 'TODO']],
            "sDom": 'Rfrtlip',
            language: {
              url: 'http://cdn.datatables.net/plug-ins/1.10.12/i18n/Spanish.json'
          },
            columns: [
                {data: 'id', name: 'id'},
                {data: 'tipo', name: 'tipo'},
                {data: 'monto', name: 'monto'},
                {data: 'fecha', name: 'fecha'},
                {data: 'action', name: 'action', orderable: false, searchable: false}
    
            ],

        });
              $('#listaDoc tfoot tr').appendTo('#listaDoc thead');
       });

          </script>
          <!--<script type="text/javascript">
              $(document).ready(function() {
              $('#listaDoc').DataTable({
                "oLanguage": { 
                  "sUrl": "//cdn.datatables.net/plug-ins/1.10.7/i18n/Spanish.json" }
                });
              });
          </script>-->
   
@stop

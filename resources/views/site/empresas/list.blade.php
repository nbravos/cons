 
@extends ('layout3')

@section ('title') Lista de Empresas @stop
@section ('breadcrumbs')

                <ul class="breadcrumb a">
                  <li class="active">
                    <p>Inicio</p>
                  </li>
                  <li><a href="" class="active">Empresas</a>
                  </li>
                </ul>
 @stop
@section ('content')
 
<p>
  <a href="{!! route('empresas.create') !!}" class="btn btn-primary">Agregar nueva </a>
  </p>

<!-- <div class="container-fluid container-fixed-lg bg-white">-->
            <!-- START PANEL -->
            <div class="panel panel-transparent">
              <div class="panel-heading">
                <div class="panel-title">Listado de Empresas
                </div>
                <div class="export-options-container pull-right"></div>
                <div class="clearfix"></div>
              </div>
              <div class="panel-body">
  <table id="listaEmp" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
              <thead>
                <tr>
                <th>Número</th>
                <th>Nombre</th>
                 <th>Nombre Contacto</th>
                 <th>Teléfono</th>
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
<!--           </div> -->

<script type="text/javascript">
              $(document).ready(function() {
               $('#listaEmp').DataTable({
            processing: false,
            serverSide: true,
            ajax: '{!! route("empresas.index") !!}',
	order: [[0, "desc"]], 
            lengthMenu: [[10, 25, 50, -1], [10, 25, 50, 'TODO']],
            "sDom": 'Rfrtlip',
            language: {
              url: 'http://cdn.datatables.net/plug-ins/1.10.12/i18n/Spanish.json'
          },
            columns: [
                {data: 'id', name: 'id'},
                {data: 'nombre', name: 'nombre'},
                {data: 'nombre_contacto', name: 'nombre_contacto'},
                {data: 'telefono', name: 'telefono'},
                {data: 'action', name: 'action', orderable: false, searchable: false}
    
            ],

          
        });
              $('#listaEmp tfoot tr').appendTo('#listaEmp thead');
		
       });

          </script>
       <!--   <script type="text/javascript">
              $(document).ready(function() {
              $('#listaEmp').DataTable({
                "oLanguage": { 
                  "sUrl": "//cdn.datatables.net/plug-ins/1.10.7/i18n/Spanish.json" }
                });
              });
          </script>

  
<table class="table table-striped">
    <tr>
        <th>Nombre</th>
        <th>Nombre de Contacto</th>
        <th>Teléfono</th>
	<th>Acciones</th>
    </tr>
    @foreach ($empresas as $empresa)
    <tr>
        <td>{!! $empresa->nombre !!}</td>
        <td>{!! $empresa->nombre_contacto !!}</td>
        <td>{!! $empresa->telefono !!}</td>

      
	<td>
          <a href="{!! route('empresas.show', $empresa->id) !!}" class="btn btn-info">
              Ver
          </a>
          <a href="{!! route('empresas.edit', $empresa->id) !!}" class="btn btn-primary">
            Editar
          </a>
	</td>

    </tr> 
    @endforeach
  </table>
-->
@stop

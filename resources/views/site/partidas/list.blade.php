 
@extends ('layout3')

@section ('title') Listado Partidas  @stop
@section ('breadcrumbs')

                <ul class="breadcrumb a">
                  <li class="active">
                    <p>Inicio</p>
                  </li>
                  <li><a href="" class="active">Partidas</a>
                  </li>
                </ul>
 @stop
@section ('content')

<p>
  <a href="{!! route('partidas.create') !!}" class="btn btn-primary">Agregar Nueva</a>
  </p>

  <!-- <div class="container-fluid container-fixed-lg bg-white">-->
            <!-- START PANEL -->
            <div class="panel panel-transparent">
              <div class="panel-heading">
                <div class="panel-title">Listado de Partidas
                </div>
                <div class="export-options-container pull-right"></div>
                <div class="clearfix"></div>
              </div>
              <div class="panel-body">
  <table id="listaPart" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
              <thead>
                <tr>
                <th>Numero </th>
               <th>Nombre</th>
               <th>Detalle </th>
               <th>Total</th>
               <th>Inicio Real</th>
               <th>Acciones</th>
                 </tr>
              </thead>
              <tbody>
     <tfoot>
                    <tr>
                      <td  class="non_searchable"></td>
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
          <!-- </div> -->
          <script type="text/javascript">
              $(document).ready(function() {
               $('#listaPart').DataTable({
            processing: false,
            serverSide: true,
            ajax: '{!! route("partidas.index") !!}',
            lengthMenu: [[10, 25, 50, -1], [10, 25, 50, 'TODO']],
            "sDom": 'Rfrtlip',
            language: {
              url: 'http://cdn.datatables.net/plug-ins/1.10.12/i18n/Spanish.json'
          },
            columns: [
                {data: 'id', name: 'id'},
                {data: 'nombre', name: 'nombre'},
                {data: 'detalle', name: 'detalle'},
                {data: 'total', name: 'ftotal'},
                {data: 'inicio_real', name: 'inicio_real'},
                {data: 'action', name: 'action', orderable: false, searchable: false}
    
            ],
        });
              $('#listaPart tfoot tr').appendTo('#listaPart thead');
       });

          </script>


 <!--         <script type="text/javascript">
              $(document).ready(function() {
              $('#listaPart').DataTable({
                "oLanguage": { 
                  "sUrl": "//cdn.datatables.net/plug-ins/1.10.7/i18n/Spanish.json" }
                });
              });
          </script>
  
<table class="table table-striped">
    <tr>
        <th>Nombre</th>
        <th>Detalle </th>
        <th>Total</th>
        <th>Inicio</th>
	<th>Acciones</th>
    </tr>
    @foreach ($partidas as $partida)
    <tr>
        <td>{!! $partida->nombre !!}</td>
        <td>{!! $partida->detalle !!}</td>
        <td>{!! $partida->total!!}</td>
        <td>{!! date('d-m-Y', strtotime($partida->fecha_inicio)) !!}</td>

      
	<td>
          <a href="{!! route('partidas.show', $partida->id) !!}" class="btn btn-info">
              Ver
          </a>
          <a href="{!! route('partidas.edit', $partida->id) !!}" class="btn btn-primary">
            Editar
          </a>
	</td>
    </tr> 
    @endforeach
  </table>
-->
@stop

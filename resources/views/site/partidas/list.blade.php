 
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
              <div class="form-group">
           {!! Form::label('proyecto', 'Proyecto Base') !!}
           {!! Form::select('proyecto', App\Models\Proyecto::pluck('nombre', 'nombre'), null, array('class' => 'form-control', 'id' => 'proyecto', 'placeholder' => 'Todos')) !!}
    </div>
  <table id="listaPart" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
              <thead>
                <tr>
                <th>Numero </th>
               <th>Nombre</th>
		            <th>Proyecto</th>
               <th>Detalle </th>
               <th>Item</th>
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
                      <td></td>
                      <td  class="non_searchable"></td>
                    </tr>
                  </tfoot>
              </table>
              </div>
            </div>
          <!-- </div> -->
          <script type="text/javascript">
             $(document).ready(function (){
             var table = $('#listaPart').DataTable({
            processing: false,
            serverSide: true,
            ajax: '{!! route("partidas.index") !!}',
            order: [[5, "desc"]], 
            lengthMenu: [[10, 25, 50, -1], [10, 25, 50, 'TODO']],
            "sDom": 'Rfrtlip',
            language: {
              url: 'http://cdn.datatables.net/plug-ins/1.10.12/i18n/Spanish.json'
          },
            columns: [
                {data: 'id', name: 'partida.id', visible: false},
                {data: 'partNombre', name: 'partida.nombre'},
                {data: 'proNombre', name: 'proyecto.nombre'},
                {data: 'detalle', name: 'detalle'},
                {data: 'item', name: 'item'},
                {data: 'inicio_real', name: 'inicio_real'},
                {data: 'action', name: 'action', orderable: false, searchable: false}
    
            ],
        });
            
    
            $('#proyecto').on('change', function(){
            table.search(this.value).draw();   
            });
          }); 
          </script>

@stop

 

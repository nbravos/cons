
@extends ('layout3')

@section ('title') Listado de OC @stop
@section ('breadcrumbs')

                <ul class="breadcrumb a">
                  <li class="active">
                    <p>Inicio</p>
                  </li>
                  <li><a href="" class="active">Orden de Compra</a>
                  </li>
                </ul>
 @stop
@section ('content')
 <h1>Lista de OC </h1>
<p>
  <a href="{!! route('oc.create') !!}" class="btn btn-primary">Agregar nueva </a>
  </p>
<!--   <div class="container-fluid container-fixed-lg bg-white"> -->
            <!-- START PANEL -->
            <div class="panel panel-transparent">
              <div class="panel-heading">
                <div class="panel-title">Listado de OC
                </div>
                <div class="export-options-container pull-right"></div>
                <div class="clearfix"></div>
              </div>
              <div class="panel-body">

               @php
  $role = App\Models\Proyecto::pluck('nombre', 'id');
  $role['0'] = 'Todos'; 
  @endphp 
	<div class="form-group">
           {!! Form::label('proyecto', 'Filtrar por: Proyecto') !!}
           {!! Form::select('proyecto', $role, ['0' => 'Todos'], array('class' => 'form-control', 'id' => 'proyecto')) !!}
    </div>
  <table id="listaOc" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
              <thead>
                <tr>
		            <th>OC</th>
                <th>Partida (Item)</th>
                 <th>Número</th>
                 <th>Fecha Emisión</th>
                 <th>Acciones</th>
                 </tr>
              </thead>
              <tfoot>
                    <tr>
		      <td  class="non_searchable"></td>	
                      <td></td>
                      <td></td>
                      <td></td>
                      <td  class="non_searchable"></td>
                    </tr>
                  </tfoot>
              </table>
              </div>
            </div>
<!--           </div>-->

          <script type="text/javascript">
              $(document).ready(function() {
            var table =  $('#listaOc').DataTable({
            processing: false,
            serverSide: true,
            ajax: '{!! route("oc.index") !!}',
	          order: [[3, "desc"]], 
            lengthMenu: [[10, 25, 50, -1], [10, 25, 50, 'TODO']],
            "sDom": 'Rfrtlip',
            language: {
              url: 'https://cdn.datatables.net/plug-ins/1.10.12/i18n/Spanish.json'
          },
            columns: [
		
                {data: 'item', name: 'orden_compra.id', visible: false},
                {data: 'item', name: 'partida.item'},
                {data: 'numero', name: 'orden_compra.numero'},
                {data: 'fecha_emision', name: 'orden_compra.fecha_emision'},
                {data: 'action', name: 'action', orderable: false, searchable: false}
    
            ],
        });
              $('#listaOc tfoot tr').appendTo('#listaOc thead');

       });

          </script>

          <script type="text/javascript">

            
    $('#proyecto').on('change', function(e) {
        var e = document.getElementById("proyecto");
        var valorProy = e.options[e.selectedIndex].value;
        var url = 'https://aragonltda.cl/oc/getProy/'+ valorProy;

	
      $('#listaOc').dataTable( {

         "bDestroy": true   
      });
      $('#listaOc').dataTable().fnDestroy();
      $('#listaOc').empty();

            var table =  $('#listaOc').DataTable({
            processing: false,
            serverSide: true,
            ajax: url,
            order: [[3, "desc"]], 
            lengthMenu: [[10, 25, 50, -1], [10, 25, 50, 'TODO']],
            "sDom": 'Rfrtlip',
            language: {
              url: 'https://cdn.datatables.net/plug-ins/1.10.12/i18n/Spanish.json'
          },
            columns: [
    
                {data: 'id', name: 'orden_compra.id',visible: false},
                {data: 'item', name: 'partida.item', title: 'Partida (Item)'},
                {data: 'numero', name: 'orden_compra.numero', title: 'Número'},
                {data: 'fecha_emision', name: 'orden_compra.fecha_emision', title: 'Fecha Emisión'},
                {data: 'action', name: 'action', orderable: false, title:'Acciones', searchable: false}
    
            ],
          });
              $('#listaOc tfoot tr').appendTo('#listaOc thead');
              });

          </script>
@stop

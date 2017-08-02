
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
	<div class="form-group">
           {!! Form::label('partida', 'Obra Asociada') !!}
           {!! Form::select('partida', App\Models\Partida::pluck('nombre', 'item'), null, array('class' => 'form-control', 'id' => 'partida')) !!}
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
		$('#partida').on('change', function(){
            table.search(this.value).draw();   
            });


       });

          </script>
@stop

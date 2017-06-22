 
@extends ('layout3')

@section ('title') Mantenciones @stop
@section ('breadcrumbs')

                <ul class="breadcrumb a">
                  <li class="active">
                    <p>Inicio</p>
                  </li>
                  <li><a href="" class="active">Mantenciones</a>
                  </li>
                </ul>
 @stop

@section ('content')


<!-- <div class="container-fluid container-fixed-lg bg-white"> -->
            <!-- START PANEL -->
            <div class="panel panel-transparent">
              <div class="panel-heading">
                <div class="panel-title">Listado Mantenciones 
                </div>
                <div class="export-options-container pull-right"></div>
                <div class="clearfix"></div>
              </div>
              <div class="panel-body">
  <table id="listaEq" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
              <thead>
                <tr>
                <th>Número</th>
                <th>Nombre</th>
                <th>Repuesto</th>
                 <th>Valor Repuesto</th>
                 <th>Fecha Inicio</th>
		 <th>Gasto Total</th>
                 </tr>
              </thead>
               <tfoot>
                    <tr>
                      <td class="non_searchable"></td>
                      <td></td>
                      <td></td>
                      <td></td>
                      <td></td>
		    <td></td>
                    </tr>
                  </tfoot>
              </table>
              </div>
            </div>
<!--           </div> -->

<script type="text/javascript">
              $(document).ready(function() {
               $('#listaEq').DataTable({
            processing: false,
            serverSide: true,
            ajax:'{!! route('verMant', ['id' =>  $eqId]) !!}',
	    order: [[0, "desc"]], 
            lengthMenu: [[10, 25, 50, -1], [10, 25, 50, 'TODO']],
            "sDom": 'Rfrtlip',
            language: {
              url: 'http://cdn.datatables.net/plug-ins/1.10.12/i18n/Spanish.json'
          },
            columns: [
                {data: 'id', name: 'id', visible: false},
                {data: 'nombre', name: 'nombre'},
                {data: 'repuesto', name: 'repuesto'},
                {data: 'valorRep', name: 'valorRep'},
                {data: 'fecha_inicio', name: 'fecha_inicio'},
		{data: 'total', name: 'total'}
    
            ],

        });
              $('#listaEq tfoot tr').appendTo('#listaEq thead');
       });

          </script>


@stop

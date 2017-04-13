@extends ('layout3')

@section ('title') Listado de Item @stop
@section ('breadcrumbs')

                <ul class="breadcrumb a">
                  <li class="active">
                    <p>Inicio</p>
                  </li>
                  <li><a href="" class="active">Item</a>
                  </li>
                </ul>
 @stop
@section ('content')

<!--<p>
  <a href="{!! route('items.create') !!}" class="btn btn-primary">Agregar nuevo </a>
  </p> -->
<!--<div class="container-fluid container-fixed-lg bg-white">-->
            <!-- START PANEL -->
            <div class="panel panel-transparent">
              <div class="panel-heading">
                <div class="panel-title">Listado de Item
                </div>
                <div class="export-options-container pull-right"></div>
                <div class="clearfix"></div>
              </div>
              <div class="panel-body">
  <table id="listaItem" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
              <thead>
                <tr>
                <th> Número</th>
                <th>Detalle</th>
                 <th>Valor Unitario</th>
		<th>O.C Asociada</th>
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
               $('#listaItem').DataTable({
            processing: false,
            serverSide: true,
            ajax: '{!! route("items.index") !!}',
            lengthMenu: [[10, 25, 50, -1], [10, 25, 50, 'TODO']],
            "sDom": 'Rfrtlip',
            language: {
              url: 'http://cdn.datatables.net/plug-ins/1.10.12/i18n/Spanish.json'
          },
            columns: [
                {data: 'id', name: 'item.id'},
		{data: 'detalle', name: 'item.detalle'},
                {data: 'unitario', name: 'item.unitario'},
		{data: 'numero', name: 'orden_compra.numero'},
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
              $('#listaItem tfoot tr').appendTo('#listaItem thead');
       });

          </script>

   <!--  {data: 'numero', name: 'orden_compra.numero'}, -->
@stop
 

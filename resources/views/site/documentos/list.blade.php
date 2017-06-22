 
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
              <div class="form-group">
           {!! Form::label('proyecto', 'Proyecto Base') !!}
           {!! Form::select('proyecto', App\Models\Proyecto::pluck('nombre', 'id'), null, array('class' => 'form-control', 'id' => 'proyecto')) !!}
    </div>
              <div class="form-group">
           {!! Form::label('orden', 'Orden Asociada') !!}
           {!! Form::select('orden', App\Models\Ordencompra::pluck('numero', 'numero'), null, array('class' => 'form-control', 'id' => 'orden')) !!}
    </div>
  <table id="listaDoc" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
              <thead>
                <tr>
                <th> Número</th>
                <th>Tipo</th>
                 <th>Monto</th>
                 <th>Fecha</th>
                 <th>Orden Compra</th>
                 <th>Acciones</th>
                 </tr>
              </thead>
             <tfoot>
                    <tr>
                      <td class="non_searchable"></td>
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
<!--          </div> -->

<script type="text/javascript">
              $(document).ready(function() {
              var table = $('#listaDoc').DataTable({
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
                {data: 'id', name: 'id', visible: false},
                {data: 'tipo', name: 'tipo'},
                {data: 'monto', name: 'monto'},
                {data: 'fecha', name: 'fecha'},
                {data: 'ocNum', name: 'orden_compra.numero'},
                {data: 'action', name: 'action', orderable: false, searchable: false}
    
            ],

        });
              $('#listaDoc tfoot tr').appendTo('#listaDoc thead');
               $('#orden').on('change', function(){
            table.search(this.value).draw();   
            });
       });

          </script>

   
@stop

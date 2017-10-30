@extends ('layout3')

@section ('title') {!! $partida->id !!}  @stop
@section ('breadcrumbs')

                <ul class="breadcrumb a">
                  <li class="active">
                    <p>Inicio</p>
                  </li>
                  <li><a href="" class="active">Obra</a>
                  </li>
                <li><a href="">{{ $partida->item }}</a>
                  </li>

                </ul>
 @stop

@section ('content')


        <h1> <strong> {!! $partida->nombre!!} </strong> </h1> 
        <a href="{{ route('addCuad', ['id' =>  $partida->id]) }}" class="btn btn-primary">Agregar Cuadrilla</a>
        

<!-- </div>-->
<table class="table table-user-information">
                    <tbody>
                       <tr>
                        <td><strong>Proyecto</strong></td>
                        <td>{!!$partida->proyecto->nombre!!}</td>   
                      </tr>
		      <tr>
                        <td><strong>Item Partida</strong></td>
                        <td>{!!$partida->item !!}</td>
                      </tr>

                      <tr>
                        <td><strong>Detalle</strong> </td>
                        <td>{!!$partida->detalle!!}</td>
                      </tr>
                      <tr>
                        <td><strong> Unidad</strong></td>
                        <td>{!!$partida->unidad!!}</td>
                      </tr>
                        <tr>
                        <td><strong>Cantidad</strong></td>
                        <td>{!!$partida->cantidad!!}</td>
                      </tr>
                        <tr>
                        <td><strong>Precio Unitario</strong></td>
                        <td>${!!$partida->unitario!!}</td>
                      </tr>
                      <tr>
                        <td><strong>Precio Total</strong></td>
                        <td>${!!$partida->total!!}</td>
                      </tr>
		


                      <tr>
                        <td><strong>Fecha Inicio</strong></td>
                        <td>{{ Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $partida->inicio_teorico)->format('d-m-Y') }} </td>			
                      </tr>
                      <tr>
                        <td><strong>Fecha Término Teórica</strong></td>
                        <td>{{ Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $partida->fin_teorico)->format('d-m-Y') }} </td>     
                      </tr>
                      <tr>
                        <td><strong>Fecha Inicio Real</strong></td>
                        <td>@if (isset($partida->inicio_real))
        {{ Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $partida->inicio_real)->format('d-m-Y') }}     
        @endif </td>     
                      </tr>
                      <tr>
                        <td><strong> Fecha Término Real </strong></td>
                        <td>@if (isset($oc->fecha_entrega)) {{ Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $oc->fecha_entrega)->format('d-m-Y') }}  
        @endif</td>     
                      </tr>
                     
                    </tbody>
                  </table>
                  <p>
<a href="{!!route('partidas.index')!!}" class="btn btn-primary">Volver</a>
<a href="{!!route('partidas.edit', $partida->id)!!}" class="btn btn-primary">Editar</a>
{!! Form::model($partida, array('route' => array('partidas.destroy', $partida->id), 'method' => 'DELETE', 'onsubmit' => 'return ConfirmDelete()'), array('role' => 'form')) !!}
  {!! Form::submit('Eliminar Obra', array('class' => 'btn btn-danger')) !!}
  {!! Form::close() !!}
</p>

<div class="panel panel-transparent">
              <div class="panel-heading">
                <div class="panel-title">
                </div>
                <div class="export-options-container pull-right"></div>
                <div class="clearfix"></div>
              </div>
              <div class="panel-body">
  <table id="listaTrabProy" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
              <thead>
                <tr>
                <th>Número</th>
                <th>Nombre</th>
               <th>Apellido</th>
                <th>Presente</th>
                 <th>Fecha</th>
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


<script type="text/javascript">
        var url = 'https://aragonltda.cl/reportes/getTablaTrab/'+ valorTrab;
        $('#listaTrabProy').DataTable({
            processing: false,
            serverSide: true,
            ajax: url,
            order: [[2, "desc"]], 
            lengthMenu: [[10, 25, 50, -1], [10, 25, 50, 'TODO']],
            "sDom": 'TRfrtlip',
            "oTableTools": {
          "sSwfPath": "//cdn.datatables.net/tabletools/2.2.2/swf/copy_csv_xls_pdf.swf",
          "aButtons": [
            {
              "sExtends": "xls",
              "sButtonText": 'Exportar ',
              "sFileName": "Asistencia_Trabajadores - *.csv",
               "mColumns": [1, 2, 3, 4],
              "aButtons": [ "xls" ]
            }
            ]
        },
           
              language: {
              url: 'https://cdn.datatables.net/plug-ins/1.10.12/i18n/Spanish.json'
          },
            columns: [
                {data: 'id', name: 'id', visible: false},
                {data: 'nombre', render : function ( data, type, full ) { 
        return full['nombre'] +' '+ full['apellido'];}
      },
                {data: 'apellido', name: 'trabajador.ap_paterno', visible: false},
                {data: 'presente', render:  function(data, type, row) {
                                if (data === '1') {
                                return 'Si';
                                  } else {
                                return 'No';
                              }}, name: 'asistencia.presente'},
                {data: 'ausente', render:  function(data, type, row) {
                                if (data === '1') {
                                return 'Si';
                                  } else {
                                return 'No';
                              }}, name: 'asistencia.ausente'},
                {data: 'fecha', name: 'asistencia.fecha'},
    
            ],

        });
</script>
<script>

  function ConfirmDelete()
  {
  var x = confirm("Desea eliminar la obra?");
  if (x)
    return true;
  else
    return false;
  }

</script>

@stop


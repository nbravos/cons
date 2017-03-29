 
@extends ('layout3')

@section ('title') Listado de Documentos @stop

@section ('content')
 
<p>
  <a href="{!! route('documentos.create') !!}" class="btn btn-primary">Agregar nuevo </a>
  </p>

<div class="container-fluid container-fixed-lg bg-white">
            <!-- START PANEL -->
            <div class="panel panel-transparent">
              <div class="panel-heading">
                <div class="panel-title">Listado de Documentos
                </div>
                <div class="export-options-container pull-right"></div>
                <div class="clearfix"></div>
              </div>
              <div class="panel-body">
                <table class="table table-striped" id="listadoDocumentos">
              <thead>
                <tr>
                <th>Tipo</th>
                 <th>Monto</th>
                 <th>Fecha</th>
                 <th>Acciones</th>
                 </tr>
              </thead>
              <tbody>
    @foreach ($documentos as $documento)
<!--    <tr> -->
        <tr class="odd gradeX">
        <td>{!! $documento->tipo !!}</td>
        <td>{!! $documento->monto!!}</td>
        <td>{!!date('d-m-Y', strtotime($documento->fecha))!!}</td>
   <!-- </tr> -->


	<td>
          <a href="{!!route('documentos.show', $documento->id) !!}" class="btn btn-info">
              Ver
          </a>
          <a href="{!!route('documentos.edit', $documento->id) !!}" class="btn btn-primary">
            Editar
          </a>
	</td>

    </tr> 
    </tbody>
                </table>
              </div>
            </div>
          </div>
    @endforeach
  </table>

@stop

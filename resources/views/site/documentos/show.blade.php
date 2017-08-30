@extends ('layout3')

@section ('title') {!! $documento->fecha !!}  @stop
@section ('breadcrumbs')

           <ul class="breadcrumb a">
                  <li class="active">
                    <p>Inicio</p>
                  </li>
                  <li><a href="" class="active">Documento</a>
                  </li>
                <li><a href="">{{ $documento->tipo}}</a>
                  </li>

                </ul>
 @stop
@section ('content')


        <h1> <strong> {!! $documento->tipo!!} # {!!$documento->numero!!}  </strong></h1> 
<table class="table table-user-information">
                    <tbody>
                      <tr>
                        <td> <strong>Tipo de Documento </strong></td>
                        <td>{!!$documento->nombre!!}</td>
                      </tr>
                      <tr>
                        <td><strong>Monto (IVA incluido)</strong> </td>
                        <td>{!!$documento->monto!!}</td>
                      </tr>
                      <tr>
                        <td><strong>Orden de Compra Asociada Documento</strong></td>
                        <td>{!!$documento->ordencompra->numero!!}</td>
                      </tr>
                        <tr>
                        <td><strong>Fecha</strong></td>
                        <td>  {{ Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $documento->fecha)->format('d-m-Y') }}  </td>
                      </tr>
                      <tr>
                        <td><strong>Contabilidad</strong></td>
                              @if ($documento->no_contabilidad  == 1)
                                <td>Contable</td>
                              @else
                                <td>No Contable</td>
                              @endif
                      </tr>
                      <tr>
                        <td>Archivo</td>                                     
                       <td> <a href="{!!route('descargardoc', $documento->rutadoc)!!}" class="btn btn-primary">Descargar</a> </td>
                      </tr>
                    </tbody>
                  </table>

                 
                  <p>
<a href="{!!route('documentos.index')!!}" class="btn btn-primary">Volver</a>
<a href="{!!route('documentos.edit', $documento->id)!!}" class="btn btn-primary">Editar</a>
{!! Form::model($documento, array('route' => array('documentos.destroy', $documento->id), 'method' => 'DELETE', 'onsubmit' => 'return ConfirmDelete()'), array('role' => 'form')) !!}
<!--  {!! Form::submit('Eliminar Documento', array('class' => 'btn btn-danger')) !!}-->
{!! Form::close() !!}
</p>

<script>

  function ConfirmDelete()
  {
  var x = confirm("Desea eliminar el documento?");
  if (x)
    return true;
  else
    return false;
  }

</script>
@stop


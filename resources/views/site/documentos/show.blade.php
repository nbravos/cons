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


        <h1> <strong> {!! $documento->tipo!!}  </strong></h1> 

                    
                       <div class="form-group">
                      {{ Form::label('tipo', 'Tipo de Documento' )}}
			                 <br>
                         <a  class="active"> {{ $documento->tipo }} </a> 
                      </div>
                      <div class="form-group">
                        {{ Form::label( 'monto', 'Monto') }}
                        <br>
                       <a class="active">  {!!$documento->monto!!} </a>
                      </div>
                        <div class="form-group">
                        {{ Form::label( 'oc', 'Orden de Compra Asociada') }}
                        <br>
                        <a class="active">  {!!$documento->ordencompra->numero!!} </a>
                      </div>
                        <div class="form-group"> 
                         {{ Form::label( 'no_contable', 'Contabilidad') }}
                         <br>
			@if ($documento->no_contabilidad  == 1)
                       <a class="active">   Contable </a>
			@else
			                 <a class="active">  Documento no Contable </a>
			@endif
                        </div>
                        <div class="form-group"> 
			                  {{ Form::label( 'archivo', 'Archivo') }}  
                        <br>                                                
			                 <a href="{!!route('descargardoc', $documento->rutadoc)!!}" class="btn btn-primary">Descargar</a> 
                        </div>
                        <div class="form-group"> 
                        {{ Form::label( 'fecha', 'Fecha') }}
                        <br>
                        <a class="active"> {{ Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $documento->fecha)->format('d-m-Y') }}   </a>
                      </div>
                 
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


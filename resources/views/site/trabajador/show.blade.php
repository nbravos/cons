@extends ('layout3')

@section ('title') {!! $trabajador->nombre !!}  @stop
@section ('breadcrumbs')

                <ul class="breadcrumb a">
                  <li class="active">
                    <p>Inicio</p>
                  </li>
                  <li><a href="" class="active">Trabajador</a>
                  </li>
                <li><a href="">{{ $trabajador->nombre }} {{$trabajador->ap_paterno}}</a>
                  </li>

                </ul>
 @stop
@section ('content')


        <h1> <strong> {!! $trabajador->nombre!!} </strong> </h1> 
<!-- </div>-->
<table class="table table-user-information">
                    <tbody>
                      <tr>
                        <td> <strong>Nombre </strong></td>
                        <td>{{$trabajador->nombre}} {{$trabajador->ap_paterno}} {{$trabajador->ap_materno}}</td>
                      </tr>
                      <tr>
                        <td><strong>Dirección</strong> </td>
                        <td>{!!$trabajador->direccion!!}</td>
                      </tr>
                      <tr>
                        <td><strong>Rut</strong></td>
                        <td>{!!$trabajador->rut!!}</td>
                      </tr>
                        <tr>
                        <td><strong>Teléfono</strong></td>
                        <td>{!!$trabajador->telefono!!}</td>
                      </tr>
                        <tr>
                        <td><strong>Correo</strong></td>
                        <td>{!!$trabajador->email!!}</td>
                      </tr>
                      <tr>
                        <td><strong>Fecha de Nacimiento</strong></td>
                        <td>{!!date('d-m-Y', strtotime($trabajador->fecha_nac))!!}</td>
                      </tr>
                      <tr>
                        <td><strong> Fecha Ingreso </strong></td>
                        <td>{!!date('d-m-Y', strtotime($trabajador->fecha))!!}</td>   
                      </tr>
                      <tr>
                        <td><strong> Fecha Fin de Contrato </strong></td>
                        <td>{!!date('d-m-Y', strtotime($trabajador->fecha_termino))!!}</td>   
                      </tr>
                      <tr>
                        <td><strong>Estado de Contrato </strong></td>
                        
                        @if($trabajador->estado_contrato == 1)
                        <td>Contrato Vigente</td>
                        
                        @else
                        <td>Finiquitado</td>
                        
                        @endif
                      </tr>
                       <tr>
                        <td><strong> Foto </strong></td>
                        <td><img height="400" width="400 "src="<?php echo asset("workerImage/$trabajador->foto")?>"></img> </td>
                       </tr>                   
                    </tbody>
                  </table>
                  <p>
<a href="{!!route('trabajador.index')!!}" class="btn btn-primary">Volver</a>
<a href="{!!route('trabajador.edit', $trabajador->id)!!}" class="btn btn-primary">Editar</a>
{!! Form::model($trabajador, array('route' => array('trabajador.destroy', $trabajador->id), 'method' => 'DELETE', 'onsubmit' => 'return ConfirmDelete()'), array('role' => 'form')) !!}
  {!! Form::submit('Eliminar Trabajador', array('class' => 'btn btn-danger')) !!}

{!! Form::close() !!}
</p>

<script>

  function ConfirmDelete()
  {
  var x = confirm("Desea eliminar al trabajador?");
  if (x)
    return true;
  else
    return false;
  }

</script>

@stop


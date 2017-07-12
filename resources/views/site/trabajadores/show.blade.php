@extends ('layout3')

@section ('title') {!! $trabajador->nombre !!}  @stop

@section ('content')


        <h1> <strong> {!! $trabajador->nombre!!} </strong> </h1> 
<!-- </div>-->
<table class="table table-user-information">
                    <tbody>
                      <tr>
                        <td> <strong>Nombre </strong></td>
                        <td>{!!$trabajador->nombre!!}</td>
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
                        <td><strong> Foto </strong></td>
                        <td><img src="<?php echo asset("workerImage/$trabajador->foto")?>"></img> </td>
                       </tr>                   
                    </tbody>
                  </table>
                  <p>
<a href="{!!route('trabajador.index')!!}" class="btn btn-primary">Volver</a>
<a href="{!!route('trabajador.edit', $trabajador->id)!!}" class="btn btn-primary">Editar</a>
{!! Form::model($trabajador, array('route' => array('trabajador.destroy', $trabajador->id), 'method' => 'DELETE'), array('role' => 'form')) !!}
  {!! Form::submit('Eliminar Trabajador', array('class' => 'btn btn-danger')) !!}

{!! Form::close() !!}
</p>
@stop


@extends ('layout3')

@section ('title') {!! $equipo->nombre !!}  @stop

@section ('breadcrumbs')

                <ul class="breadcrumb a">
                  <li class="active">
                    <p>Inicio</p>
                  </li>
                  <li><a href="" class="active">Equipo</a>
                  </li>
                <li><a href="">{{ $equipo->nombre }}</a>
                  </li>

                </ul>
 @stop
@section ('content')


        <h1> <strong> {!! $equipo->nombre!!} </strong> </h1> 
<!-- </div>-->
<table class="table table-user-information">
                    <tbody>
                      <tr>
                        <td> <strong>Nombre </strong></td>
                        <td>{!!$equipo->nombre!!}</td>
                      </tr>
                      <tr>
                        <td><strong>Código</strong> </td>
                        <td>{!!$equipo->codigo!!}</td>
                      </tr>
                      <tr>
                        <td><strong>Costo Equipo</strong></td>
                        <td>{!!$equipo->costo!!}</td>
                      </tr>
                        <tr>
                        <td><strong>Descripción</strong></td>
                        <td>{!!$equipo->descripcion!!}</td>
                      </tr>
                    </tbody>
                  </table>
                  <p>
<a href="{!!route('equipos.index')!!}" class="btn btn-primary">Volver</a>
<a href="{!!route('equipos.edit', $equipo->id)!!}" class="btn btn-primary">Editar</a>
{!! Form::model($equipo, array('route' => array('equipos.destroy', $equipo->id), 'method' => 'DELETE', 'onsubmit' => 'return ConfirmDelete()'), array('role' => 'form')) !!}
  {!! Form::submit('Eliminar Equipo', array('class' => 'btn btn-danger')) !!}
{!! Form::close() !!}
</p>

<script>

  function ConfirmDelete()
  {
  var x = confirm("Desea eliminar el equipo?");
  if (x)
    return true;
  else
    return false;
  }

</script>

@stop


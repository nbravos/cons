@extends ('layout3')

@section ('title') Usuario {!! $user->name !!}  @stop

@section ('breadcrumbs')

                <ul class="breadcrumb a">
                  <li class="active">
                    <p>Inicio</p>
                  </li>
                  <li><a href="" class="active">Usuarios</a>
                  </li>
		<li><a href="">{{ $user->name }}</a>
                  </li>

                </ul>
 @stop


@section ('content')

<h2> {!! $user->name !!}  </h2>

<table class="table table-striped">
    <tr>
        <th>Nombre</th>
        <th>Dirección de Correo</th>
    </tr>
    <tr>
        <td>{{ $user->name }}</td>
        <td>{{ $user->email }}</td>
    </tr>
</table>
<p>
<a href="{!!route('usuarios.index')!!}" class="btn btn-primary">Volver</a>
<a href="{!!route('usuarios.edit', $user->id)!!}" class="btn btn-primary">Editar</a>
{!! Form::model($user, array('route' => array('usuarios.destroy', $user->id), 'method' => 'DELETE', 'onsubmit' => 'return ConfirmDelete()'), array('role' => 'form')) !!}
 {!! Form::submit('Eliminar Usuario', array('class' => 'btn btn-danger')) !!}
{!! Form::close() !!}
</p>

<script>

  function ConfirmDelete()
  {
  var x = confirm("Desea eliminar al Usuario?");
  if (x)
    return true;
  else
    return false;
  }

</script>

@stop

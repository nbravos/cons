@extends ('layout3')

@section ('content')


  @if ($errors->any())
    <div class="alert alert-danger">
      <button type="button" class="close" data-dismiss="alert">&times;</button>
      <strong>Por favor corrige los siguentes errores:</strong>
      <ul>
      @foreach ($errors->all() as $error)
        <li>{!! $error !!}</li>
      @endforeach
      </ul>
    </div>
  @endif
@if(isset($user))
    {!! Form::model($user, ['route' => ['usuarios.update', $user->id], 'method' => 'patch']) !!}
	@section ('breadcrumbs')

                <ul class="breadcrumb a">
                  <li class="active">
                    <p>Inicio</p>
                  </li>
                  <li><a href="" class="active">Usuarios</a>
                  </li>
                <li><a href="Editar:">{{ $user->name }}</a>
                  </li>

                </ul>
 @stop

	 <h1>Editar Usuario</h1>
@else
    {!! Form::open(array('route' => 'usuarios.store', 'method' => 'POST'), array('role' => 'form')) !!}
	@section ('breadcrumbs')

                <ul class="breadcrumb a">
                  <li class="active">
                    <p>Inicio</p>
                  </li>
                  <li><a href="" class="active">Usuarios</a>
                  </li>
		<li><a href="" class="active">Agregar</a>
                  </li>

                </ul>
 @stop

	 <h1>Agregar Usuario</h1>
@endif
  <div class="row">
    <div class="form-group >
      {!! Form::label('name', 'Nombre completo') !!}
      {!! Form::text('name', null, array('placeholder' => 'Introduce tu nombre y apellido', 'class' => 'form-control')) !!}
    </div>
    <div class="form-group >
      {!! Form::label('email', 'Dirección de E-mail') !!}
      {!! Form::text('email', null, array('placeholder' => 'Introduce tu E-mail', 'class' => 'form-control')) !!}
    </div>
    <div class="form-group >
      {!! Form::label('password', 'Contraseña') !!}
      {!! Form::password('password', array('class' => 'form-control')) !!}
    </div>
    <div class="form-group >
      {!! Form::label('password_confirmation', 'Confirmar contraseña') !!}
      {!! Form::password('password_confirmation', array('class' => 'form-control')) !!}
    </div>

   <div class="form-group">
      {!!Form::label('roles', 'Rol Usuario')!!}
      {!!Form::select('roles', array(
          '1' => 'Administrador',
          '2' => 'Medio',
          '3' => 'Básico'), null, ['id' =>'roles', 'class' => 'form-control']) !!}
  </div>



<!--    <div class="form-group >
      {!! Form::label('roles', 'Rol Usuario') !!}
      {!! Form::text('roles', null, array('placeholder' => 'Rol de usuario', 'class' => 'form-control')) !!}
    </div> -->
 </div>
  {!! Form::button('Guardar', array('type' => 'submit', 'class' => 'btn btn-primary btn-lg')) !!}    
  
{!! Form::close() !!}

@stop

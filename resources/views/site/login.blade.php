@extends ('loginlayout')
@section ('title') Login @stop


@section('content')
  @if ($errors->any())
    <div class="alert alert-danger">
       <button type="button" class="close" data-dismiss="alert">&times;</button>
      <strong>Por favor corrige los siguentes errores:</strong>
      <ul>
      @foreach ($errors->all() as $error)
        <li>{{ $error }}</li>
      @endforeach
      </ul>
    </div>
 @endif
  <form  action="login" method="post" class="p-t-15"> 
	    <input type="hidden" name="_token" value="{{  csrf_token() }}">
            <!-- START Form Control-->
            <div class="form-group form-group-default">
              <label>Login</label>
              <div class="controls">
                <input type="text" name="email" placeholder="Correo" class="form-control" required>
              </div>
            </div>
            <!-- END Form Control-->
            <!-- START Form Control-->
            <div class="form-group form-group-default">
              <label>Password</label>
              <div class="controls">
                <input type="password" class="form-control" name="password" placeholder="Contraseña" required>
              </div>
            </div>
            <!-- START Form Control-->
            <div class="row">
              <div class="col-md-6 no-padding">
                <div class="checkbox ">
                  <input type="checkbox" value="1" id="rememberme">
                  <label for="rememberme">Recordarme</label>
                </div>
              </div>
              <div class="col-md-6 text-right">
<!--Acá agregar link a la vista recuperar contraseña -->
                <a href="remind" class="text-info small">Recuperar Contraseña </a>
              </div>
            </div>
            <!-- END Form Control-->
            <button class="btn btn-primary btn-cons m-t-10" type="submit">Sign in</button>
         {{ Form::close() }}
@stop

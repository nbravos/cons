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
@if(isset($equipo))
    {!! Form::model($equipo, ['route' => ['equipos.update', $equipo->id], 'method' => 'patch']) !!}
 @section ('breadcrumbs')

                <ul class="breadcrumb a">
                  <li class="active">
                    <p>Inicio</p>
                  </li>
                  <li><a href="" class="active">Equipo</a>
                  </li>
                <li><a href="Editar:">{{ $equipo->nombre }}</a>
                  </li>

                </ul>
 @stop
	<h1>Editar Equipo</h1>
@else
    {!! Form::open(array('route' => 'equipos.store', 'method' => 'POST'), array('role' => 'form')) !!}
         @section ('breadcrumbs')

                <ul class="breadcrumb a">
                  <li class="active">
                    <p>Inicio</p>
                  </li>
                  <li><a href="" class="active">Equipo</a>
                  </li>
                <li><a href="" class="active">Agregar</a>
                  </li>

                </ul>
 @stop
	 <h1>Agregar Equipo</h1>
@endif
  <div class="row">
    <div class="form-group">
      {!! Form::label('nombre', 'Nombre Equipo') !!}
      {!! Form::text('nombre', null, array('placeholder' => 'Ingresa el nombre del Equipo', 'class' => 'form-control')) !!}
    </div>
    <div class="form-group">
      {!! Form::label('codigo', 'Código') !!}
      {!! Form::text('codigo', null, array('placeholder' => 'Ingresa el código ', 'class' => 'form-control')) !!}
    </div>
    <div class="form-group">
           {!! Form::label('id_proyecto', 'Obra Asociada') !!}
           {!! Form::select('id_proyecto', $proyectos, null, ['class' => 'form-control']) !!}
    </div>
  </div>
   <div class="row">
    <div class="form-group">
      {!! Form::label('costo', 'Costo Equipo') !!}
      {!! Form::text('costo', null, array('placeholder' => 'Costo del Equipo', 'class' => 'form-control')) !!}
    </div>
    <div class="form-group">
      {!! Form::label('descipcion', 'Descripción') !!}
      {!! Form::text('descripcion', null, array('placeholder' => 'Descripción del Equipo', 'class' => 'form-control')) !!}
    </div>
   </div> 
   
  {!! Form::button('Guardar Datos', array('type' => 'submit', 'class' => 'btn btn-primary')) !!}    
  
{!! Form::close() !!}
<script type="text/javascript">
    $("#id_proyecto").prepend("<option value='' selected='selected'>Seleccionar</option>");
</script>
@stop

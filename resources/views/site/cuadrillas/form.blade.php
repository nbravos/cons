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
    {!! Form::open(array('route' => 'cuadrillas.store', 'method' => 'POST'), array('role' => 'form')) !!}
         @section ('breadcrumbs')

                <ul class="breadcrumb a">
                  <li class="active">
                    <p>Inicio</p>
                  </li>
                  <li><a href="" class="active">cuadrilla</a>
                  </li>
                <li><a href="" class="active">Agregar</a>
                  </li>

                </ul>
 @stop
	 <h1>Agregar Cuadrilla</h1>
  <div class="row">
    <div class="form-group">
      {!! Form::label('nombre', 'Nombre cuadrilla') !!}
      {!! Form::text('nombre', null, array('placeholder' => 'Ingresa el nombre del cuadrilla', 'class' => 'form-control')) !!}
    </div>
<div class="form-group">
           {!! Form::label('id_part', 'Partida Base') !!}
           {!! Form::text('id_part', $partida["0"]->nombre,  array('readonly' => 'true', 'class' => 'form-control'), array('disabled')) !!}
 </div>


           {!! Form::hidden('id_partida', $partida["0"]->id, array('readonly' => 'true', 'class' => 'form-control')) !!}
  </div>

  <div class="form-group">
        {{Form::label('trabajadores', 'Trabajadores Asociados')}}
	<br>
        {{Form::select('trabajadores[]', $trabajadores, null, array('multiple'=>true,'class'=>'custom-scroll')) }}
      </div>

   <div class="row">
    <div class="form-group">
      {!! Form::label('descipcion', 'Descripción') !!}
      {!! Form::text('descripcion', null, array('placeholder' => 'Descripción del cuadrilla', 'class' => 'form-control')) !!}
    </div>
   </div> 
   
  {!! Form::button('Guardar Datos', array('type' => 'submit', 'class' => 'btn btn-primary')) !!}    
  
{!! Form::close() !!}

@stop

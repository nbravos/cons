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

    {!! Form::model($pc, ['route' => ['ofertas.update', $pc->id], 'method' => 'patch']) !!}
 @section ('breadcrumbs')

                <ul class="breadcrumb a">
                  <li class="active">
                    <p>Inicio</p>
                  </li>
                  <li><a href="" class="active">Contratista</a>
                  </li>
                <li><a href="Editar:" ></a>
                  </li>

                </ul>
 @stop
	<h1>Editar Contratista</h1>

  <div class="row">
<div class="form-group">
           {!! Form::label('id_proy', 'Proyecto Base') !!}
           {!! Form::text('id_proy', $pc->proyecto->nombre,  array('readonly' => 'true', 'class' => 'form-control'), array('disabled')) !!}
 </div>

           {!! Form::hidden('id_proyecto', $pc->id_proyecto, array('readonly' => 'true', 'class' => 'form-control')) !!}
  
 <div class="form-group">
           {!! Form::label('id_emp', 'Contratista Asociado') !!}
          {!! Form::text('id_emp', $pc->empresa->nombre,  array('readonly' => 'true', 'class' => 'form-control'), array('disabled')) !!}
    </div>  
    {!! Form::hidden('id_empresa', $pc->id_proyecto, array('readonly' => 'true', 'class' => 'form-control')) !!}  

    <div class="form-group">
      {!! Form::label('monto_ofertado', 'Monto Ofertado') !!}
      {!! Form::text('monto_ofertado', null, array('placeholder' => 'Igresa el monto ofertado', 'class' => 'form-control')) !!}
    </div>
    <div class="form-group">
      {!! Form::label('dias', 'Plazo de la Licitación' ) !!}
      {!! Form::text('dias', null, array('placeholder' => 'Ingresa el plazo en días', 'class' => 'form-control')) !!}
    </div>
    <div class="form-group"> 
  {{ Form::radio('estado_oferta', '1') }}
  Ganadora
  <br>
  {{ Form::radio('estado_oferta', '0', true) }}
  No Ganada
</div>

  
</div> 
   
  {!! Form::button('Guardar', array('type' => 'submit', 'class' => 'btn btn-primary')) !!}    
  
{!! Form::close() !!}

@stop


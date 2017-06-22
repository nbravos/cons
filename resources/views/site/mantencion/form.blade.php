@extends ('layout3')

@section ('content')
<script src="http://192.241.187.240/assets/plugins/bootstrap-datepicker/js/bootstrap-datepicker.js"></script>
   <script src="http://192.241.187.240/assets/plugins/bootstrap-datepicker/js/bootstrap-datepicker.es.min.js"></script>
    <script type="text/javascript">
$(document).ready(function () {
       
  $( "#datepicker1" ).datepicker({
        format: 'dd/mm/yyyy',
        language: 'es',
        autoclose: true

  });

  $( "#datepicker2" ).datepicker({
        format: 'dd/mm/yyyy',
        language: 'es',
        autoclose: true

  });
 

});
</script>

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
@if(isset($pc))
    {!! Form::model($em, ['route' => ['mantencion.update', $em->id], 'method' => 'patch']) !!}
 @section ('breadcrumbs')

                <ul class="breadcrumb a">
                  <li class="active">
                    <p>Inicio</p>
                  </li>
                  <li><a href="" class="active">Mantención</a>
                  </li>
                <li><a href="Editar:" ></a>
                  </li>

                </ul>
 @stop
  <h1>Editar Mantención</h1>
@else
    {!! Form::open(array('route' => 'mantencion.store', 'method' => 'POST', 'files'=> true), array('role' => 'form')) !!}
         @section ('breadcrumbs')

                <ul class="breadcrumb a">
                  <li class="active">
                    <p>Inicio</p>
                  </li>
                  <li><a href="" class="active">Mantención</a>
                  </li>
                <li><a href="" class="active">Agregar</a>
                  </li>

                </ul>
 @stop

   <h1>Agregar Mantención</h1>
@endif

  <div class="row">
<div class="form-group">
           {!! Form::label('equipo', 'Equipo Asociado') !!}
           {!! Form::text('equipo', $equipo["0"]->nombre,  array('readonly' => 'true', 'class' => 'form-control'), array('disabled')) !!}
 </div>
           {!! Form::hidden('id_equipo', $equipo["0"]->id, array('readonly' => 'true', 'class' => 'form-control')) !!}
    <div class="form-group">
      {!! Form::label('tipo', 'Tipo de Mantención') !!}
      {!! Form::text('tipo', null, array('placeholder' => 'Igresa el tipo de la mantención', 'class' => 'form-control')) !!}
    </div>
    <div class="form-group">
      {!! Form::label('repuesto', 'Tipo de Repuesto') !!}
      {!! Form::text('repuesto', null, array('placeholder' => 'Ingresa el repuesto requerido', 'class' => 'form-control')) !!}
    </div>
    <div class="form-group">
      {!! Form::label('valor_repuesto', 'Valor Repuesto') !!}
      {!! Form::text('valor_repuesto', null, array('placeholder' => 'Ingresa el valor del repuesto requerido', 'class' => 'form-control')) !!}
    </div>
    <div class="form-group">
      {!! Form::label('lugar_repuesto', 'Lugar de Repuesto') !!}
      {!! Form::text('lugar_repuesto', null, array('placeholder' => 'Ingresa el lugar del repuesto', 'class' => 'form-control')) !!}
    </div>
    <div class="form-group">
      {!! Form::label('nombre_taller', 'Nombre del Taller Mecánico') !!}
      {!! Form::text('nombre_taller', null, array('placeholder' => 'Ingresa el nombre del taller', 'class' => 'form-control')) !!}
    </div>
    <div class="form-group">
      {!! Form::label('valor_taller', 'Costo de Arreglo') !!}
      {!! Form::text('valor_taller', null, array('placeholder' => 'Ingresa el costo del taller', 'class' => 'form-control')) !!}
    </div>

    <div class="form-group">
    <label class="control-label" for="fecha_inicio">Fecha Inicio</label>
    <input class="form-control" id="datepicker1" name="fecha_inicio" placeholder="DD/MM/AA" type="text">
  </div>  
    <div class="form-group">
    <label class="control-label" for="fecha_termino">Fecha Término</label>
    <input class="form-control" id="datepicker2" name="fecha_termino" placeholder="DD/MM/AA" type="text">
  </div>  
  
    <div class="form-group">
      {!! Form::label('descripcion', 'Descripción del Arreglo') !!}
      {!! Form::text('descripcion', null, array('placeholder' => 'Breve descripción de las mejoras', 'class' => 'form-control')) !!}
    </div>



    <div class="form-group">
    {{Form::label('image', 'Adjuntar imágenes')}}
    {{ Form::file('images[]', array('multiple'=>'true','id'=>'image','class'=>'file')) }}  
    </div>


  
</div> 
   
  {!! Form::button('Guardar', array('type' => 'submit', 'class' => 'btn btn-primary')) !!}    
  
{!! Form::close() !!}

@stop


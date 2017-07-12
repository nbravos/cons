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
@if(isset($trabajador))
    {!! Form::model($trabajador, ['route' => ['trabajador.update', $trabajador->id], 'method' => 'patch']) !!}
	<h1>Editar Trabajador</h1>
@else
    {!! Form::open(array('route' => 'trabajador.store', 'method' => 'POST', 'files'=> true), array('role' => 'form')) !!}
	 <h1>Agregar Trabajador</h1>
@endif
  <div class="row">
    <div class="form-group">
      {!! Form::label('nombre', 'Nombre del Trabajador') !!}
      {!! Form::text('nombre', null, array('placeholder' => 'Ingresa el nombre del trabajador', 'class' => 'form-control')) !!}
    </div>
    <div class="form-group">
      {!! Form::label('email', 'Correo de Contacto') !!}
      {!! Form::text('email', null, array('placeholder' => 'Ingresa el correo del trabajador ', 'class' => 'form-control')) !!}
    </div>
    <div class="form-group">
      {!! Form::label('direccion', 'Dirección') !!}
      {!! Form::text('direccion', null, array('placeholder' => 'Ingresa la dirección ', 'class' => 'form-control')) !!}
    </div>
    <div class="form-group">
      {!! Form::label('rut', 'Rut') !!}
      {!! Form::text('rut', null, array('placeholder' => 'Ingresa Rut', 'class' => 'form-control')) !!}
    </div>
    <div class="form-group">
      {!! Form::label('telefono', 'Número de teléfono') !!}
      {!! Form::text('telefono', null, array('placeholder' => 'Ingresa el teléfono', 'class' => 'form-control')) !!}
    </div>
    <div class="form-group">
    <label class="control-label" for="fecha_nac">Fecha Nacimiento</label>
    <input class="form-control" id="datepicker1" name="fecha_nac" placeholder="DD/MM/AA" type="text">
  </div>  
    <div class="form-group">
    <label class="control-label" for="fecha">Fecha Ingreso</label>
    <input class="form-control" id="datepicker2" name="fecha" placeholder="DD/MM/AA" type="text">
  </div>
        <div class="form-group">
           {!! Form::label('id_afp', 'Afp') !!}
           {!! Form::select('id_afp', $afp, null, ['class' => 'form-control']) !!}
        </div>    
        <div class="form-group">
           {!! Form::label('id_salud', 'Salud') !!}
           {!! Form::select('id_salud', $salud, null, ['class' => 'form-control']) !!}
        </div>   
  <div class="form-group">
    {!! Form::label('foto','Adjuntar Imagen') !!}
    {!! Form::file('foto', null) !!}
</div>

  </div> 

  {!! Form::button('Guardar', array('type' => 'submit', 'class' => 'btn btn-primary')) !!}    
  
{!! Form::close() !!}

@stop

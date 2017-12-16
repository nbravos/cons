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
        {!! Form::open(['route' => ['storeTrabajadorObra', $proyecto->id], 'method' => 'POST']) !!}
         @section ('breadcrumbs')

                <ul class="breadcrumb a">
                  <li class="active">
                    <p>Inicio</p>
                  </li>
                  <li><a href="" class="active">Agregar Trabajador</a>
                  </li>
                </ul>
 @stop
	 <h1>Agregar Trabajador</h1>
  <div class="row">

<div class="form-group">
           {!! Form::label('id_proyecto', 'Obra Asociada') !!}
           {!! Form::text('id_proyecto', $proyecto->nombre,  array('readonly' => 'true', 'class' => 'form-control'), array('disabled')) !!}
 </div>


           {!! Form::hidden('id_proyecto', $proyecto->id, array('readonly' => 'true', 'class' => 'form-control')) !!}
  </div>


  <div class="row">

    <div class="form-group">
      {!! Form::label('fecha', 'Fecha') !!}
      {!! Form::text('fecha', null, array('placeholder' => 'Fecha de Ingreso', 'class' => 'form-control')) !!}
    </div>

     <div class="form-group ">
     {!! Form::label('trabajadores[]', 'Seleccionar') !!}
    <select id="trabajadores[]" name="trabajadores[]" class="form-control" data-init-plugin="select2" multiple="multiple">
          @foreach($trabajadores as $trabajador)
           <option value="{{$trabajador->id}}">{{$trabajador->nombre}} {{$trabajador->ap_paterno}}</option>
         @endforeach
         </select>
     </div>   
   </div> 

  
   
  {!! Form::button('Guardar Datos', array('type' => 'submit', 'class' => 'btn btn-primary')) !!}    
  
{!! Form::close() !!}

<script src="https://aragonltda.cl/assets/plugins/bootstrap-datepicker/js/bootstrap-datepicker.js"></script>
   <script src="https://aragonltda.cl/assets/plugins/bootstrap-datepicker/js/bootstrap-datepicker.es.min.js"></script>
    <script type="text/javascript">
$(document).ready(function () {
       
  $( "#fecha" ).datepicker({
        format: 'dd/mm/yyyy',
        language: 'es',
        autoclose: true

  });
});
  </script>

@stop

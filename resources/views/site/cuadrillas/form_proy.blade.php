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
           {!! Form::label('id_partida', 'Partida Asociada') !!}
           {!! Form::select('id_partida', $partidas, null, ['class' => 'form-control']) !!}
    </div>

          
  </div>


  <div class="row">
    <div class="form-group">
      {!! Form::label('descripcion', 'Descripción') !!}
      {!! Form::text('descripcion', null, array('placeholder' => 'Descripción de los integrantes', 'class' => 'form-control')) !!}
    </div>
    <div class="form-group">
      {!! Form::label('fecha', 'Fecha') !!}
      {!! Form::text('fecha', null, array('placeholder' => 'Fecha de Ingreso', 'class' => 'form-control')) !!}
    </div>

     <div class="form-group">
           {!! Form::label('equipo', 'Equipo') !!}
           {!! Form::select('equipo', $equipos, null, ['class' => 'form-control']) !!}
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

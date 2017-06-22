@extends ('layout3')

@section ('content')
<script src="http://192.241.187.240/assets/plugins/bootstrap-datepicker/js/bootstrap-datepicker.js"></script>
   <script src="http://192.241.187.240/assets/plugins/bootstrap-datepicker/js/bootstrap-datepicker.es.min.js"></script>
    <script type="text/javascript">
$(document).ready(function () {
       
  $( "#inicio_teorico" ).datepicker({
        format: 'dd-mm-yyyy',
        language: 'es',
        autoclose: true

  });

  $( "#inicio_real" ).datepicker({
        format: 'dd-mm-yyyy',
        language: 'es',
        autoclose: true

  });

  $( "#fin_teorico" ).datepicker({
        format: 'dd-mm-yyyy',
        language: 'es',
        autoclose: true

  });

    $( "#fin_real" ).datepicker({
        format: 'dd-mm-yyyy',
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
@if(isset($partida))
    {!! Form::model($partida, ['route' => ['partidas.update', $partida->id], 'method' => 'patch']) !!}

     @section ('breadcrumbs')

                <ul class="breadcrumb a">
                  <li class="active">
                    <p>Inicio</p>
                  </li>
                  <li><a href="" class="active">Partida</a>
                  </li>
                <li><a href="Editar:">{{ $partida->item }}</a>
                  </li>

                </ul>
 @stop
	<h1>Editar Partida</h1>
@else
    {!! Form::open(array('route' => 'partidas.store', 'method' => 'POST'), array('role' => 'form')) !!}
	
     @section ('breadcrumbs')

                <ul class="breadcrumb a">
                  <li class="active">
                    <p>Inicio</p>
                  </li>
                  <li><a href="" class="active">Partida</a>
                  </li>
                <li><a href="" class="active">Agregar</a>
                  </li>

                </ul>
 @stop
	 <h1>Agregar Partida</h1>
@endif
  <div class="row">


@if(isset($partida))
    <div class="form-group">
           {!! Form::label('id_proyecto', 'Proyecto Base') !!}
           {!! Form::select('id_proyecto', $proyectos, null,  ['class' => 'form-control', 'readonly' => 'true']) !!}
    </div>
@else

    <div class="form-group">
           {!! Form::label('id_proyecto', 'Proyecto Base') !!}
           {!! Form::select('id_proyecto', $proyectos, null, ['class' => 'form-control']) !!}
    </div>
@endif


<!-- -->
  <div class="form-group">
      {!! Form::label('nombre', 'Nombre Partida') !!}
      {!! Form::text('nombre', null, array('placeholder' => 'Ingresar nombre de la Partida ', 'class' => 'form-control')) !!}
    </div>
   <div class="form-group">
           {!! Form::label('item', 'Item') !!}
           {!! Form::text('item', null, array('placeholder' => 'Ingresar item de la Partida ', 'class' => 'form-control')) !!}
    </div> 

    <div class="form-group">
      {!! Form::label('detalle', 'Detalle Partida') !!}
      {!! Form::text('detalle', null, array('placeholder' => 'Ingresar detalle de la Partida ', 'class' => 'form-control')) !!}
    </div>
    <div class="form-group">
      {!! Form::label('unidad', 'Unidad') !!}
      {!! Form::text('unidad', null, array('placeholder' => 'Unidad Partida', 'class' => 'form-control')) !!}
    </div>
    <div class="form-group">
      {!! Form::label('cantidad', 'Cantidad') !!}
      {!! Form::text('cantidad', null, array('placeholder' => 'Indica la Cantidad ', 'class' => 'form-control')) !!}
    </div>
    <div class="form-group">
      {!! Form::label('unitario', 'Valor Unitario' ) !!}
      {!! Form::text('unitario', null, array('placeholder' => 'Indica el valor unitario ', 'class' => 'form-control')) !!}
    </div>
  </div>
   <div class="row">
    <div class="form-group">
      {!! Form::hidden('total', 'Total') !!}
      {!! Form::hidden('total', 1, array('id' => 'total')) !!}
    </div>

   <div class="form-group">
      {!! Form::hidden('porcentaje', 'Porcentaje del Proyecto') !!}
      {!! Form::hidden('porcentaje', 1, array('id' => 'porcentaje')) !!}
    </div>

    <div class="form-group">
    <label class="control-label" for="inicio_teorico">Fecha de Inicio Teórico</label>
    <input class="form-control" id="inicio_teorico" name="inicio_teorico" placeholder="DD-MM-AA" value="@if (isset($partida->inicio_teorico))
          {{ Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $partida->inicio_teorico)->format('d-m-Y') }}     
        @endif"type="text">
  </div>
<div class="form-group">
    <label class="control-label" for="fin_teorico">Fecha Término Teórica</label>
    <input class="form-control" id="fin_teorico" name="fin_teorico" placeholder="DD-MM-AA" value="@if (isset($partida->fin_teorico))
          {{ Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $partida->fin_teorico)->format('d-m-Y') }}     
        @endif"type="text">
  </div>
  <div class="form-group">
    <label class="control-label" for="inicio_real">Fecha Inicio Real</label>
    <input class="form-control" id="inicio_real" name="inicio_real" placeholder="DD-MM-AA" value="@if (isset($partida->inicio_real))
        {{ Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $partida->inicio_real)->format('d-m-Y') }}     
        @endif" type="text">
  </div>
  <div class="form-group">
    <label class="control-label" for="fin_real">Fecha Término Real</label>
    <input class="form-control" id="fin_real" name="fin_real" placeholder="DD-MM-AA" value="@if (isset($partida->inicio_teorico))
        {{ Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $partida->fin_real)->format('d-m-Y') }}     
        @endif" type="text">
  </div>    
    
</div> 
   

  {!! Form::button('Guardar', array('type' => 'submit', 'class' => 'btn btn-primary')) !!}    
  
{!! Form::close() !!}

@stop

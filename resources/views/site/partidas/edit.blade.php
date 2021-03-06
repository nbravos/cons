@extends ('layout3')

@section ('content')
<script src="https://192.241.187.240/assets/plugins/bootstrap-datepicker/js/bootstrap-datepicker.js"></script>
   <script src="https://192.241.187.240/assets/plugins/bootstrap-datepicker/js/bootstrap-datepicker.es.min.js"></script>
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
      {!! Form::label('detalle', 'Comentarios de la Partida') !!}
      {!! Form::text('detalle', null, array('placeholder' => 'Ingresar comentarios de la Partida ', 'class' => 'form-control')) !!}
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
      {!! Form::label('total', 'Total') !!}
      {!! Form::text('total', null, array('placeholder' => 'Ingresa el total ', 'class' => 'form-control')) !!}
    </div>
    <div class="form-group">
      {!! Form::label('porcentaje', 'Porcentaje del Proyecto') !!}
      {!! Form::text('porcentaje', null, array('placeholder' => 'Ingresa el porcentaje correspondiente al proyecto ', 'class' => 'form-control')) !!}
    </div>
    <div class="form-group"> 
  {{ Form::radio('activa', '1') }}
  Partida Activa
  <br>
  {{ Form::radio('activa', '0', true) }}
  Partida No Activa
</div>
    <div class="form-group">
    <label class="control-label" for="inicio_teorico">Fecha de Inicio Teórico</label>
    <input class="form-control" id="inicio_teorico" name="inicio_teorico" placeholder="DD/MM/AA" value="{{ Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $partida->inicio_teorico)->format('d-m-Y') }}" type="text">
  </div>
<div class="form-group">
    <label class="control-label" for="fin_teorico">Fecha Término Teórica</label>
    <input class="form-control" id="fin_teorico" name="fin_teorico" placeholder="DD/MM/AA" value="{{ Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $partida->fin_teorico)->format('d-m-Y') }}" type="text">
  </div>
  
  @if ($partida->inicio_real == NULL)
<div class="form-group">
    <label class="control-label" for="inicio_real">Fecha Inicio Real</label>
    <input class="form-control" id="inicio_real" name="inicio_real" placeholder="DD-MM-AA" value=""  type="text">
  </div>
  @else
  <div class="form-group">
    <label class="control-label" for="inicio_real">Fecha Inicio Real</label>
    <input class="form-control" id="inicio_real" name="inicio_real" placeholder="DD-MM-AA" value="{{ Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $partida->inicio_real)->format('d-m-Y') }}" type="text">
  </div>
@endif

  @if ($partida->fin_real == NULL)

  <div class="form-group">
    <label class="control-label" for="fin_real">Fecha Término Real</label>
    <input class="form-control" id="fin_real" name="fin_real" placeholder="DD-MM-AA" value="" type="text">
  </div>   
@else
   <div class="form-group">
    <label class="control-label" for="fin_real">Fecha Término Real</label>
    <input class="form-control" id="fin_real" name="fin_real" placeholder="DD/MM/AA" value="{{ Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $partida->fin_real)->format('d-m-Y') }}" type="text">
  </div>   
    @endif
</div> 
   

  {!! Form::button('Guardar', array('type' => 'submit', 'class' => 'btn btn-primary')) !!}    
  
{!! Form::close() !!}

@stop

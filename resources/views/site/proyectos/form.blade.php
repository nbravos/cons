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
@if(isset($proyecto))
    {!! Form::model($proyecto, ['route' => ['proyectos.update', $proyecto->id], 'method' => 'patch']) !!}
 @section ('breadcrumbs')

                <ul class="breadcrumb a">
                  <li class="active">
                    <p>Inicio</p>
                  </li>
                  <li><a href="" class="active">Licitaciones</a>
                  </li>
                <li><a href="Editar:">{{ $proyecto->nombre }}</a>
                  </li>

                </ul>
 @stop

	<h1>Editar</h1>
@else
    {!! Form::open(array('route' => 'proyectos.store', 'method' => 'POST'), array('role' => 'form')) !!}
        @section ('breadcrumbs')

                <ul class="breadcrumb a">
                  <li class="active">
                    <p>Inicio</p>
                  </li>
                  <li><a href="" class="active">Proyectos</a>
                  </li>
                <li><a href="" class="active">Agregar</a>
                  </li>

                </ul>
 @stop

	 <h1>Agregar </h1>
@endif
{!! csrf_field() !!}
  <div class="row">
    <div class="form-group">
      {!! Form::label('nombre', 'Nombre Licitación') !!}
      {!! Form::text('nombre', null, array('placeholder' => 'Ingresa el nombre de la licitación', 'class' => 'form-control')) !!}
    </div>
    <div class="form-group">
      {!! Form::label('ide', 'ID de Licitación') !!}
      {!! Form::text('ide', null, array('placeholder' => 'Ingresa el ID de licitación', 'class' => 'form-control')) !!}
    </div>

    <div class="form-group">
           {!! Form::label('id_empresa', 'Mandante') !!}
           {!! Form::select('id_empresa', $empresa, null, ['class' => 'form-control']) !!}
    </div>
    <div class="form-group">
           {!! Form::label('id_comuna', 'Comuna') !!}
           {!! Form::select('id_comuna', $comuna, null, ['class' => 'form-control']) !!}
    </div>
     <div class="form-group">
      {!!Form::label('estado', 'Estado de Proyecto')!!}
      {!!Form::select('estado', array(
          'licitacion' => 'Licitación', 
          'obra' => 'Obra', 
          'oficial' => 'Oficial'), null, ['id' =>'estado', 'class' => 'form-control']) !!}
	</div>

      <div class="form-group">
      {!!Form::label('tipo_proyecto', 'Tipo de Proyecto')!!}
      {!!Form::select('tipo_proyecto', array(
          'Pavimento Participativo' => 'Pavimento Participativo', 
          'Mejoramiento Vía' => 'Mejoramiento Vial', 
          'Reconstrucción' => 'Reconstrucción',
          'Espacios Públicos' => 'Espacios Públicos',
          'Saneamiento'  => 'Saneamiento',
          'Pavimentación Calzada' => 'Pavimentación Calzada',
          'Hormigón' => 'Hormigón',
          'Pavimentación Asfalto' => 'Asfalto',
          'Aceras' => 'Aceras'), null, ['id' =>'tipo_proyecto', 'class' => 'form-control']) !!}
  </div>

  <div class="form-group">
      {!!Form::label('tipo_licitacion', 'Tipo de Licitación')!!}
      {!!Form::select('tipo_licitacion', array(
          'publica' => 'Pública', 
          'privada' => 'Privada'), null, ['id' =>'tipo_licitacion', 'class' => 'form-control']) !!}
  </div>

    <div class="form-group">
      {!!Form::label('financiamiento', 'Financiamiento')!!}
      {!!Form::select('financiamiento', array(
          'Propio' => 'Propio', 
          'GORE' => 'GORE',
          'FFNDR' => 'FFNDR'), null, ['id' =>'financiamiento', 'class' => 'form-control']) !!}
  </div>
  </div>
   <div class="row">
<!--    <div class="form-group">
      {!! Form::label('monto_disponible', 'Monto Disponible') !!}
      {!! Form::text('monto_disponible', null, array('placeholder' => 'Indica el Monto Disponible Proyecto', 'class' => 'form-control')) !!}
    </div>
    <div class="form-group">
      {!! Form::label('monto_minimo_oferta', 'Monto Mínimo Ofertado') !!}
      {!! Form::text('monto_minimo_oferta', null, array('placeholder' => 'Indica el Valor Mínimo Ofertado ', 'class' => 'form-control')) !!}
    </div>
    <div class="form-group">
      {!! Form::label('monto_ofertado', 'Monto  Ofertado') !!}
      {!! Form::text('monto_ofertado', null, array('placeholder' => 'Indica el Valor Ofertado ', 'class' => 'form-control')) !!}
    </div>
    <div class="form-group">
      {!! Form::label('presupuesto_oficial', 'Presupuesto Oficial') !!}
      {!! Form::text('presupuesto_oficial', null, array('placeholder' => 'Indica el presupuesto Oficial del Proyecto', 'class' => 'form-control')) !!}
    </div>
       <div class="form-group">
      {!! Form::label('costos_directos', 'Costos Directos') !!}
      {!! Form::text('costos_directos', null, array('placeholder' => 'Costos Directos del Proyecto', 'class' => 'form-control')) !!}
    </div>
      <div class="form-group">
      {!! Form::label('costos_generales', 'Costos Generales') !!}
      {!! Form::text('costos_generales', null, array('placeholder' => 'Costos Generales del Proyecto', 'class' => 'form-control')) !!}
    </div>-->
       <div class="form-group">
    <label class="control-label" for="fecha_licitacion">Fecha Licitación</label>
    <input class="form-control" id="datepicker1" name="fecha_licitacion" placeholder="DD/MM/AA" value="@if (isset($proyecto->fecha_licitacion))
          {{ Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $proyecto->fecha_licitacion)->format('d-m-Y') }}     
        @endif" type="text">
  </div>
</div> 
<!-- Datetime Script-->
   <script src="https://192.241.187.240/assets/plugins/bootstrap-datepicker/js/bootstrap-datepicker.js"></script>
   <script src="https://192.241.187.240/assets/plugins/bootstrap-datepicker/js/bootstrap-datepicker.es.min.js"></script>
    <script type="text/javascript">
$(document).ready(function () {
       
  $( "#datepicker1" ).datepicker({
        format: 'dd/mm/yyyy',
        language: 'es',
        autoclose: true

  });
});
  </script>
  <!-- Datetime Script-->
  <!-- SelectBox Script-->
<script type="text/javascript">
    $(document).ready(function() {
      $('#estado').change(function(){
        var opt = $(this).find("option:selected").attr('value');
        if(opt != 'Licitación'){
          $('#tipo_licitacion').hide();
        }
        else{
          $('#tipo_licitacion').show();
        }
      });
    });
    </script>
    <!-- SelectBox Script-->
  {!! Form::button('Guardar', array('type' => 'submit', 'class' => 'btn btn-primary')) !!}    
  
{!! Form::close() !!}

@stop

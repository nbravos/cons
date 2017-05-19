@extends ('layout3')

@section ('content')
 <script src="http://192.241.187.240/assets/plugins/bootstrap-datepicker/js/bootstrap-datepicker.js"></script>
   <script src="http://192.241.187.240/assets/plugins/bootstrap-datepicker/js/locales/bootstrap-datepicker.es.js"> charset="UTF-8"</script>
  
   <script type="text/javascript">
$(document).ready(function () {
       
  $( "#datepicker" ).datepicker({
	format: 'dd-mm-yyyy',
	language: 'es'     
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
@if(isset($documento))
    {!! Form::model($documento, ['route' => ['documentos.update', $documento->id], 'method' => 'patch']) !!}
 @section ('breadcrumbs')

                <ul class="breadcrumb a">
                  <li class="active">
                    <p>Inicio</p>
                  </li>
                  <li><a href="" class="active">Documentos</a>
                  </li>
                <li><a href="Editar:">{{ $documento->tipo }}</a>
                  </li>
                </ul>
 @stop
	<h1>Editar Documento</h1>
@else
    {!! Form::open(array('route' => 'documentos.store', 'method' => 'POST', 'files'=> true), array('role' => 'form')) !!}
         @section ('breadcrumbs')

                <ul class="breadcrumb a">
                  <li class="active">
                    <p>Inicio</p>
                  </li>
                  <li><a href="" class="active">Documento</a>
                  </li>
                <li><a href="" class="active">Agregar</a>
                  </li>
                </ul>
 @stop
	 <h1>Agregar Documento</h1>
@endif
  <div class="row">
  <div class="form-group">
      {!!Form::label('tipo', 'Tipo de Documento')!!}
      {!!Form::select('tipo', array(
          'Boleta' => 'Boleta', 
          'Factura' => 'Factura', 
          'Nota de Crédito' => 'Nota de Crédito',
          'Guía de Despacho' => 'Guía de Despacho'), null, ['id' =>'tipo', 'class' => 'form-control']) !!}
  </div>
   
	<div class="form-group ">
		{{ Form::hidden('no_contabilidad', '1', array('id' => 'no_contabilidad')) }}
  </div>

    <div class="form-group">
      {!! Form::label('monto', 'Monto Documento') !!}
      {!!Form::text('monto', null, array('placeholder' => 'Monto del Documento', 'class' => 'form-control')) !!}
    </div>
	 
    <div class="form-group">
     <label class="control-label" for="fecha_">Fecha </label>
    <input class="form-control" id="datepicker" name="fecha" placeholder="DD-MM-AA" value="@if (isset($documento->fecha))
            {{ Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $documento->fecha)->format('d-m-Y') }}
        @endif"  type="text">
  </div>

  <div class="form-group">
           {!! Form::label('proyecto', 'Proyecto Base') !!}
           {!! Form::select('proyecto', App\Models\Proyecto::pluck('nombre', 'id'), null, array('class' => 'form-control', 'id' => 'proyecto')) !!}
    </div>

 <div class="form-group">
           {!! Form::label('id_orden', 'Orden de Compra Asociada') !!}
           {!! Form::select('id_orden', $ocs, null, ['class' => 'form-control']) !!}
    </div>
   <div class="form-group">
    {!! Form::label('rutadoc','Adjuntar Documento') !!}
    {!! Form::file('rutadoc', null) !!}
</div>
   
   </div>
   

  {!! Form::button('Guardar Datos', array('type' => 'submit', 'class' => 'btn btn-primary')) !!}    
  
{!! Form::close() !!}

<script type="text/javascript">
  $(document).ready(function () {

    if(('#tipo:selected').val() == "Guía de Despacho"){
      $('#no_contabilidad').val("0")
    }
    else{
      ('#no_contabilidad').val("0")

    }
    
  })


</script>

@stop

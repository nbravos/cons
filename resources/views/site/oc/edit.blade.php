@extends ('layout3')

@section ('content')
<script src="http://192.241.187.240/assets/plugins/bootstrap-datepicker/js/bootstrap-datepicker.js"></script>
   <script src="http://192.241.187.240/assets/plugins/bootstrap-datepicker/js/bootstrap-datepicker.es.min.js"></script>
    <script type="text/javascript">
$(document).ready(function () {
       
  $( "#fecha_emision" ).datepicker({
        format: 'dd-mm-yyyy',
        language: 'es',
        autoclose: true

  });

  $( "#fecha_entrega" ).datepicker({
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
    {!! Form::model($oc, ['route' => ['oc.update', $oc->id], 'method' => 'patch']) !!}
     @section ('breadcrumbs')

                <ul class="breadcrumb a">
                  <li class="active">
                    <p>Inicio</p>
                  </li>
                  <li><a href="" class="active">Orden de Compra</a>
                  </li>
                <li><a href="Editar:">{{ $oc->numero }}</a>
                  </li>
                </ul>
 @stop

	<h1>Editar Orden de Compra</h1>

  <div class="row">
 <div class="form-group">
           {!! Form::label('id_partida', 'Partida Asociada') !!}
           {!! Form::select('id_partida', $partida, null, ['class' => 'form-control']) !!}
    </div>
    <div class="form-group">
           {!! Form::label('id_empresa', 'Empresa Asociada') !!}
           {!! Form::select('id_empresa', $empresa, null, ['class' => 'form-control']) !!}
    </div>
    <div class="form-group">
      {!! Form::label('id_empresa_cargo', 'Cargo') !!}
      {!! Form::text('id_empresa_cargo', null, array('placeholder' => 'Indica Cargo de la OC ', 'class' => 'form-control')) !!}
    </div>
    <div class="form-group">
      {!! Form::label('numero', 'Número') !!}
      {!! Form::text('numero', null, array('placeholder' => 'Ingresa número de la OC', 'class' => 'form-control')) !!}
    </div>
    <div class="form-group">
      {!! Form::label('uf', 'Valor en UF') !!}
      {!! Form::text('uf', null, array('placeholder' => 'Indica el valor en UF', 'class' => 'form-control')) !!}
    </div>
    <div class="form-group">
    <label class="control-label" for="fecha_emision">Fecha Emisión</label>
    <input class="form-control" id="fecha_emision" name="fecha_emision" placeholder="DD/MM/AA" value="{{ Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $oc->fecha_emision)->format('d-m-Y') }}" type="text">
  </div>  
    <div class="form-group">
    <label class="control-label" for="fecha_entrega">Fecha Entrega</label>
    <input class="form-control" id="fecha_entrega" name="fecha_entrega" placeholder="DD/MM/AA" value="{{ Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $oc->fecha_entrega)->format('d-m-Y') }}" type="text">
  </div>
      <div class="form-group">
      {!!Form::label('condicion_pago', 'Condición de Pago')!!}
      {!!Form::select('condicion_pago', array(
          'Plazo' => 'Plazo', 
          'Cheque' => 'Cheque', 
          'Contado' => 'Contado'), null, ['id' =>'condicion_pago', 'class' => 'form-control']) !!}
  </div>

  <div class="form-group">
      {!!Form::label('tipo_plazo', 'Tipo de Plazo')!!}
      {!!Form::select('tipo_plazo', array(
          '15' => '15', 
          '30' => '30', 
          '45' => '45'), null, ['id' =>'tipo_plazo', 'class' => 'form-control']) !!}
  </div>
  </div> 

  <script type="text/javascript">
    $(document).ready(function() {
      $('#condicion_pago').change(function(){
        var opt = $(this).find("option:selected").attr('value');
        if(opt != 'Plazo'){
          document.getElementById("tipo_plazo").value = "";
          $('#tipo_plazo').hide();
	  
        }
        else{
          $('#tipo_plazo').show();
        }
      });
    });
    </script>
	
  {!! Form::button('Guardar', array('type' => 'submit', 'class' => 'btn btn-primary')) !!}   
{!! Form::close() !!}

@stop

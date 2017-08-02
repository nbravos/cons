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
@if(isset($empresa))
    {!! Form::model($empresa, ['route' => ['empresas.update', $empresa->id], 'method' => 'patch']) !!}
 @section ('breadcrumbs')

                <ul class="breadcrumb a">
                  <li class="active">
                    <p>Inicio</p>
                  </li>
                  <li><a href="" class="active">Empresas</a>
                  </li>
                <li><a href="Editar:">{{ $empresa->nombre }}</a>
                  </li>

                </ul>
 @stop
	<h1>Editar Empresa</h1>
@else
    {!! Form::open(array('route' => 'empresas.store', 'method' => 'POST'), array('role' => 'form')) !!}
         @section ('breadcrumbs')

                <ul class="breadcrumb a">
                  <li class="active">
                    <p>Inicio</p>
                  </li>
                  <li><a href="" class="active">Empresa</a>
                  </li>
                <li><a href="" class="active">Agregar</a>
                  </li>

                </ul>
 @stop
 @if (!empty(session('errorMessageDuration')))
         <div class="alert alert-danger">
             <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
             {{ session('errorMessageDuration') }}
         </div>
@endif
	 <h1>Agregar Empresa</h1>
@endif
  <div class="row">
    <div class="form-group">
      {!! Form::label('nombre', 'Nombre de la Empresa') !!}
      {!! Form::text('nombre', null, array('placeholder' => 'Ingresa el nombre de la empresa', 'class' => 'form-control')) !!}
    </div>
    <div class="form-group">
      {!! Form::label('email', 'Correo de Contacto') !!}
      {!! Form::text('email', null, array('placeholder' => 'Ingresa el correo de la empresa ', 'class' => 'form-control')) !!}
    </div>
    <div class="form-group">
      {!! Form::label('nombre_contacto', 'Nombre de Contacto Empresa') !!}
      {!! Form::text('nombre_contacto', null, array('placeholder' => 'Ingresa nombre y apellido de contacto', 'class' => 'form-control')) !!}
    </div>
    <div class="form-group">
      {!! Form::label('telefono', 'Número de teléfono') !!}
      {!! Form::text('telefono', null, array('placeholder' => 'Ingresa el teléfono de la Empresa ', 'class' => 'form-control')) !!}
    </div>
    <div class="form-group">
      {!! Form::label('razon_social', 'Razón Social' ) !!}
      {!! Form::text('razon_social', null, array('placeholder' => 'Ingresa la Razón Social de la Empresa ', 'class' => 'form-control')) !!}
    </div>
  </div>
   <div class="row">
    <div class="form-group">
      {!! Form::label('giro', 'Giro Empresa') !!}
      {!! Form::text('giro', null, array('placeholder' => 'Ingresa el Giro de la Empresa', 'class' => 'form-control')) !!}
    </div>
    <div class="form-group">
      {!! Form::label('direccion', 'Dirección') !!}
      {!! Form::text('direccion', null, array('placeholder' => 'Ingresa la dirección de la Empresa ', 'class' => 'form-control')) !!}
    </div>
     <div class="form-group">
      {!! Form::label('rut', 'Rut') !!}
      {!! Form::text('rut', null, array('placeholder' => 'Ingresa RUT Empresa', 'class' => 'form-control')) !!}
    </div>
    <!-- , 'method' => 'POST', 'onsubmit' => 'return validaRut' -->
    <div class="form-group">
      {!! Form::label('web', 'Página Web') !!}
      {!! Form::text('web', null, array('placeholder' => 'Ingresa Dirección web de la Empresa', 'class' => 'form-control', 'onclick'=> 'return validaRut')) !!}
    </div>

     <div class="form-group">
      {!!Form::label('tipo_empresa', 'Tipo de Empresa')!!}
      {!!Form::select('tipo_empresa', array(
          'Proveedor' => 'Proovedor', 
          'Mandante' => 'Mandante', 
          'Contratista' => 'Contratista'), null, ['id' =>'tipo_empresa', 'class' => 'form-control']) !!}
  </div>
       <div class="form-group">
      {!!Form::label('tipo_proovedor', 'Tipo de Proveedor')!!}
      {!!Form::select('tipo_proovedor', array(
          'RR.HH' => 'RR.HH', 
          'Materiales' => 'Materiales', 
          'Equipo' => 'Equipo',
          'Combustible' => 'Combustible',
          'Otros' => 'Otros'), null, ['id' =>'tipo_proovedor', 'class' => 'form-control']) !!}
  </div>

    <!--<div class="form-group" id="ProvOp">
          {!! Form::label('tipo_proveedor', 'Tipo De Proveedor') !!}
	<br>
           <select class="form-control"  id="ProvOp">
              <option value="1">RR.HH</option>
              <option value="2">Materiales</option>
              <option value="3">Equipo</option>
	      <option value="4">Combustible</option>
	      <option value="5">Otros</option>
          </select>
    </div> -->
</div> 
   
<script type="text/javascript">
    $(document).ready(function() {
      $('#tipo_empresa').change(function(){
        var opt = $(this).find("option:selected").attr('value');
        if(opt != 'Proveedor'){
          $('#tipo_proovedor').hide();
        }
        else{
          $('#tipo_proovedor').show();
        }
      });
    });
    </script>
<script type="text/javascript">
  

var Fn = {
    // Valida el rut con su cadena completa "XXXXXXXX-X"
    validaRut : function (rutCompleto) {
        rutCompleto = rutCompleto.replace("‐","-");
        if (!/^[0-9]+[-|‐]{1}[0-9kK]{1}$/.test( rutCompleto ))
            return false;
        var tmp     = rutCompleto.split('-');
        var digv    = tmp[1]; 
        var rut     = tmp[0];
        if ( digv == 'K' ) digv = 'k' ;
        
        return (Fn.dv(rut) == digv );
    },
    dv : function(T){
        var M=0,S=1;
        for(;T;T=Math.floor(T/10))
            S=(S+T%10*(9-M++%6))%11;
        return S?S-1:'k';
    }
}


$("#rut").change(function(){
    if (!Fn.validaRut( $("#rut").val() )){
        alert("Rut no válido");  
    } 
          
});


</script>


  {!! Form::button('Guardar', array('type' => 'submit', 'class' => 'btn btn-primary')) !!}    
  
{!! Form::close() !!}

@stop

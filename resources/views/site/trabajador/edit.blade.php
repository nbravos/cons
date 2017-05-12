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
    {!! Form::model($trabajador, ['route' => ['trabajador.update', $trabajador->id], 'method' => 'patch']) !!}
 @section ('breadcrumbs')

                <ul class="breadcrumb a">
                  <li class="active">
                    <p>Inicio</p>
                  </li>
                  <li><a href="" class="active">Trabajador</a>
                  </li>
                <li><a href="Editar:">{{ $trabajador->nombre }}</a>
                  </li>

                </ul>
 @stop
	<h1>Editar Trabajador</h1>
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
      {!! Form::text('rut', null, array('placeholder' => 'XXXXXXXX-X', 'class' => 'form-control', 'method' => 'POST', 'onsubmit' => 'return validaRut')) !!}
      
    </div>
    <div class="form-group">
      {!! Form::label('telefono', 'Número de teléfono') !!}
      {!! Form::text('telefono', null, array('placeholder' => 'Ingresa el teléfono', 'class' => 'form-control')) !!}
    </div>
    <div class="form-group">
    <label class="control-label" for="fecha_nac">Fecha Nacimiento</label>
    <input class="form-control" id="datepicker1" name="fecha_nac" placeholder="DD/MM/AA" value=
            {{ Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $trabajador->fecha_nac)->format('d-m-Y') }}  type="text">
  </div>  
    <div class="form-group">
    <label class="control-label" for="fecha">Fecha Ingreso</label>
    <input class="form-control" id="datepicker2" name="fecha" placeholder="DD/MM/AA" value= {{ Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $trabajador->fecha)->format('d-m-Y') }}
             type="text">
  </div>
        <div class="form-group">
           {!! Form::label('id_afp', 'Afp') !!}
           {!! Form::select('id_afp', $afp, null, ['class' => 'form-control']) !!}
        </div>    
        <div class="form-group">
           {!! Form::label('id_salud', 'Salud') !!}
           {!! Form::select('id_salud', $salud, null, ['class' => 'form-control']) !!}
        </div>   
  

  </div> 

  {!! Form::button('Guardar', array('type' => 'submit', 'class' => 'btn btn-primary', 'id'=> 'guarda')) !!}    
  
{!! Form::close() !!}


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

@stop

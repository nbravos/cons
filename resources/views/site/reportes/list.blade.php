@extends ('layout3')

@section ('title') Reportes @stop
@section ('breadcrumbs')

                <ul class="breadcrumb a">
                  <li class="active">
                    <p>Inicio</p>
                  </li>
                  <li><a href="" class="active">Reportes</a>
                  </li>
                </ul>
 @stop
@section ('content')
 <h1>Reportes </h1>

<div class="form-group">
           {{ Form::label('coleccion', 'Seleccionar Reporte') }}
           {{Form::select('coleccion', array(
           'nada' =>'',
          'contratista' => 'Contratistas', 
          'partida' => 'Partidas', 
          'trabajador' => 'Trabajador'), null, ['id' =>'coleccion', 'class' => 'form-control']) }}
    </div>
    <div class="form-group" name="grupo1">
     {{ Form::label('contrac_datos', 'Seleccionar Gráfico') }}
           {{Form::select('contrac_datos', array(
          '1' => 'Contratistas por Proyecto', 
          '2' => 'Contratistas -  Ofertas', 
          '3' => 'Otro gráfico'), null, ['id' =>'contrac_datos', 'class' => 'form-control']) }}
     </div>

   <div class="form-group" name="grupo2">
     {{ Form::label('partida_datos', 'Seleccionar Gráfico') }}
           {{Form::select('partida_datos', array(
          '1' => 'Avance por Partida', 
          '2' => 'Partidas por Mes ', 
          '3' => 'Otro gráfico'), null, ['id' =>'partida_datos', 'class' => 'form-control']) }}
     </div>
       <div class="form-group" name="grupo3">
     {{ Form::label('trabajador_datos', 'Seleccionar Gráfico') }}
           {{Form::select('trabajador_datos', array(
          '1' => 'Asistencia trabajador', 
          '2' => 'Proyectos por trabajador', 
          '3' => 'Otro gráfico'), null, ['id' =>'trabajador_datos', 'class' => 'form-control']) }}
     </div>

<script type="text/javascript">
    $(document).ready(function() {
      $('#coleccion').change(function(){
        var opt = $(this).find("option:selected").attr('value');
        if(opt == 'contratista'){
        $("div[name='grupo1']").show();

        }
        else{
          $("div[name='grupo2']").hide();
          $("div[name='grupo3']").hide();
        }
      });
    });
    </script>


@stop

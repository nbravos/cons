@extends ('layout3')

@section ('title') Reportes @stop
@section ('breadcrumbs')

                <ul class="breadcrumb a">
                  <li class="active">
                    <p>Inicio</p>
                  </li>
                  <li><a href="" class="active">Gráfico de Prueba</a>
                  </li>
                </ul>
 @stop
@section ('content')
 <h1> Ejemplo </h1>

<div id="perf_div"></div>
<?= $lava->render('ColumnChart', 'Contratistas', 'perf_div') ?>

@stop

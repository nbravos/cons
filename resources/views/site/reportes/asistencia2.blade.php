@extends ('layout3')

@section ('title') Reportes @stop
@section ('breadcrumbs')

                <ul class="breadcrumb a">
                  <li class="active">
                    <p>Inicio</p>
                  </li>
                  <li><a href="" class="active">Asistencia Mensual </a>
                  </li>
                </ul>
 @stop
@section ('content')
 <h1> Asistencia Trabajadores </h1>


<div id="perf_div"></div>
<?= Lava::render('ColumnChart', 'Asistencia', 'perf_div') ?>

@stop




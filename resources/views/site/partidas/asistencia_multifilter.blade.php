
@extends ('layout3')
@section ('title')  @stop
@section ('breadcrumbs')

                <ul class="breadcrumb a">
                  <li class="active">
                    <p>Inicio</p>
                  </li>
                  <li><a href="" class="active">Asistencia</a>
                  </li>
                </ul>
 @stop
@section ('content')

<table class="table table-striped">
    <tr>
        <th>Nombre</th>
        <th>Acceder</th>
    </tr>
    @foreach ($trabajadores as $trabajador)
    <tr>
        <td>{{ $trabajador->nombre }} {{ $trabajador->ap_paterno}}</td>
        <td> <a href="{{ route('asistencia_obra', ['id_trabajador'=>$trabajador->id]) }}" class="btn btn-info">Asistencia Actual</a> </td>
    </tr>
    @endforeach
</table>

@stop


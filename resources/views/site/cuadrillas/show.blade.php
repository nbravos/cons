@extends ('layout3')

@section ('title') {!! $cuadrilla->nombre !!}  @stop

@section ('breadcrumbs')

                <ul class="breadcrumb a">
                  <li class="active">
                    <p>Inicio</p>
                  </li>
                  <li><a href="" class="active">Cuadrilla</a>
                  </li>
                <li><a href="">{{ $cuadrilla->nombre }}</a>
                  </li>

                </ul>
 @stop
@section ('content')


        <h1> <strong> {!! $cuadrilla->nombre!!} </strong> </h1> 
 
<br>
<br>
<!-- </div>-->
<table class="table table-user-information">
                    <tbody>
                      <tr>
                        <td> <strong>Nombre Cuadrilla </strong></td>
                        <td>{!!$cuadrilla->nombre!!}</td>
                      </tr>
                        <tr>
                        <td><strong>Descripción</strong></td>
                        <td>{!!$cuadrilla->descripcion!!}</td>
                      </tr>
                      <tr>
                        <td> <strong>Equipo </strong></td>
                        <td>{!!$cuadrilla->equipo!!}</td>
                      </tr>
		@foreach ($cuadrilla->trabajadores as $trabajador)
                          <tr>
			<td> </td>
                          <td>{{ $trabajador->nombre }} {{ $trabajador->ap_paterno }}</td>
                      </tr>
			
                      @endforeach
                    </tbody>
                  </table>
                  <p>
<a href="{!!route('cuadrillas.index')!!}" class="btn btn-primary">Volver</a>
<a href="{!!route('cuadrillas.edit', $cuadrilla->id)!!}" class="btn btn-primary">Editar</a>
{!! Form::model($cuadrilla, array('route' => array('cuadrillas.destroy', $cuadrilla->id), 'method' => 'DELETE', 'onsubmit' => 'return ConfirmDelete()'), array('role' => 'form')) !!}
  {!! Form::submit('Eliminar cuadrilla', array('class' => 'btn btn-danger')) !!}
{!! Form::close() !!}
</p>

<script>

  function ConfirmDelete()
  {
  var x = confirm("Desea eliminar esta cuadrilla?");
  if (x)
    return true;
  else
    return false;
  }

</script>

@stop


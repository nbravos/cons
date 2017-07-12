 
@extends ('layout3')

@section ('title') Listado de Trabajadores @stop

@section ('content')
 <h1>Lista de Trabajadores </h1>
<p>
  <a href="{!! route('trabajador.create') !!}" class="btn btn-primary">Agregar nuevo </a>
  </p>
<table class="table table-striped">
    <tr>
        <th>Nombre</th>
        <th>Teléfono</th>
	<th>Acciones</th>
    </tr>
    @foreach ($trabajadores as $trabajador)
    <tr>
        <td>{!! $trabajador->nombre !!}</td>
        <td>{!! $trabajador->telefono !!}</td>

      
	<td>
          <a href="{!! route('trabajador.show', $trabajador->id) !!}" class="btn btn-info">
              Ver
          </a>
          <a href="{!! route('trabajador.edit', $trabajador->id) !!}" class="btn btn-primary">
            Editar
          </a>
	</td>

    </tr> 
    @endforeach
  </table>

@stop

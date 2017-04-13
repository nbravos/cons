@extends ('layout3')

@section ('title') {!! $proyecto->nombre !!}  @stop
@section ('breadcrumbs')

                <ul class="breadcrumb a">
                  <li class="active">
                    <p>Inicio</p>
                  </li>
                  <li><a href="" class="active">Proyecto</a>
                  </li>
                <li><a href="">{{ $proyecto->nombre }}</a>
                  </li>

                </ul>
 @stop
@section ('content')


        <h1> <strong> {!! $proyecto->nombre!!} </strong> </h1> 

<a href="{{ route('addof', ['id' =>  $proyecto->id]) }}" class="btn btn-primary">Agregar Oferta</a>
<!-- <a href="/ofertas/create/'.$proyecto->id.'" class="btn btn-primary"> Oferta</a>-->
<table class="table table-user-information">
                    <tbody>
                      <tr>
                        <td> <strong>Nombre </strong></td>
                        <td>{!!$proyecto->nombre!!}</td>
                      </tr>
                      <tr>
                        <td><strong>Empresa</strong> </td>
                        <td>{!!$proyecto->id_empresa!!}</td>
                      </tr>
                      <tr>
                        <td><strong> Comuna</strong></td>
                        <td>{!!$proyecto->comuna->nombre!!}</td>
                      </tr>
                        <tr>
                        <td><strong>Estado Proyecto</strong></td>
                        <td>{!!$proyecto->tipo_licitacion!!}</td>
                      </tr>
                        <tr>
                        <td><strong>Financiamiento</strong></td>
                        <td>{!!$proyecto->financiamiento!!}</td>
                      </tr>
                      <tr>
                        <td><strong>Monto Disponible</strong></td>
                        <td>{!!$proyecto->monto_disponible!!}</td>
                      </tr>
                      <tr>
                        <td><strong>Monto Mínimo Ofertado</strong></td>
                        <td>{!!$proyecto->monto_minimo_oferta!!}</td>   
                      </tr>
                          <tr>
                        <td><strong>Monto Ofertado</strong></td>
                        <td>{!!$proyecto->monto_ofertado!!}</td>   
                      </tr>
                      <tr>
                        <td><strong>Presupuesto Oficial</strong></td>
                        <td>{!!$proyecto->presupuesto_oficial!!}</td>   
                      </tr>
                      <tr>
                        <td><strong> Costos Directos </strong></td>
                        <td>{!!$proyecto->giro!!}</td>   
                      </tr>
                      <tr>
                        <td><strong> Costos Generales </strong></td>
                        <td>{!!$proyecto->generales!!}</td>   
                      </tr>
                         <tr>
                        <td><strong> Fecha de Licitación </strong></td>
                        <td>{{ Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $proyecto->fecha_licitacion)->format('d-m-Y') }}</td>   
                      </tr>
                     
                    </tbody>
                  </table>
                  <p>
<a href="{!!route('proyectos.index')!!}" class="btn btn-primary">Volver</a>
<a href="{!!route('proyectos.edit', $proyecto->id)!!}" class="btn btn-primary">Editar</a>
{!! Form::model($proyecto, array('route' => array('proyectos.destroy', $proyecto->id), 'method' => 'DELETE', 'onsubmit' => 'return ConfirmDelete()'), array('role' => 'form')) !!}
  {{ Form::submit('Eliminar Proyecto', array('class' => 'btn btn-danger')) }}
{!! Form::close() !!}
</p>

<script>

  function ConfirmDelete()
  {
  var x = confirm("Desea eliminar el proyecto?");
  if (x)
    return true;
  else
    return false;
  }

</script>

@stop



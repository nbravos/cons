@extends ('layout3')

@section ('title') {!! $partida->id !!}  @stop
@section ('breadcrumbs')

                <ul class="breadcrumb a">
                  <li class="active">
                    <p>Inicio</p>
                  </li>
                  <li><a href="" class="active">Partida</a>
                  </li>
                <li><a href="">{{ $partida->item }}</a>
                  </li>

                </ul>
 @stop

@section ('content')


        <h1> <strong> {!! $partida->nombre!!} </strong> </h1> 
<!-- </div>-->
<table class="table table-user-information">
                    <tbody>
                       <tr>
                        <td><strong>Proyecto</strong></td>
                        <td>{!!$partida->proyecto->nombre!!}</td>   
                      </tr>
		      <tr>
                        <td><strong>Item Partida</strong></td>
                        <td>{!!$partida->item !!}</td>
                      </tr>

                      <tr>
                        <td><strong>Detalle</strong> </td>
                        <td>{!!$partida->detalle!!}</td>
                      </tr>
                      <tr>
                        <td><strong> Unidad</strong></td>
                        <td>{!!$partida->unidad!!}</td>
                      </tr>
                        <tr>
                        <td><strong>Cantidad</strong></td>
                        <td>{!!$partida->cantidad!!}</td>
                      </tr>
                        <tr>
                        <td><strong>Precio Unitario</strong></td>
                        <td>${!!$partida->unitario!!}</td>
                      </tr>
                      <tr>
                        <td><strong>Precio Total</strong></td>
                        <td>${!!$partida->total!!}</td>
                      </tr>
			<tr>
                        <td><strong>Porcentaje Proyecto </strong></td>
                        <td>{!!$partida->porcentaje!!}</td>
                      </tr>

		       <tr>
                        <td><strong>Porcentaje de Avance al: {{ Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $partida->avance[0]->fecha_termino)->format('d-m-Y') }} </strong></td>
                        <td>{!!$partida->avance[0]->porcentaje!!}</td>
                      </tr>


                      <tr>
                        <td><strong>Fecha Inicio</strong></td>
                        <td>{{ Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $partida->inicio_teorico)->format('d-m-Y') }} </td>			
                      </tr>
                      <tr>
                        <td><strong>Fecha Término Teórica</strong></td>
                        <td>{{ Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $partida->fin_teorico)->format('d-m-Y') }} </td>     
                      </tr>
                      <tr>
                        <td><strong>Fecha Inicio Real</strong></td>
                        <td>@if (isset($partida->inicio_real))
        {{ Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $partida->inicio_real)->format('d-m-Y') }}     
        @endif </td>     
                      </tr>
                      <tr>
                        <td><strong> Fecha Término Real </strong></td>
                        <td>@if (isset($oc->fecha_entrega)) {{ Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $oc->fecha_entrega)->format('d-m-Y') }}  
        @endif</td>     
                      </tr>
                     
                    </tbody>
                  </table>
                  <p>
<a href="{!!route('partidas.index')!!}" class="btn btn-primary">Volver</a>
<a href="{!!route('partidas.edit', $partida->id)!!}" class="btn btn-primary">Editar</a>
{!! Form::model($partida, array('route' => array('partidas.destroy', $partida->id), 'method' => 'DELETE', 'onsubmit' => 'return ConfirmDelete()'), array('role' => 'form')) !!}
  {!! Form::submit('Eliminar Partida', array('class' => 'btn btn-danger')) !!}
  {!! Form::close() !!}
</p>

<script>

  function ConfirmDelete()
  {
  var x = confirm("Desea eliminar la partida?");
  if (x)
    return true;
  else
    return false;
  }

</script>

@stop


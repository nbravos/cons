@extends ('layout3')

@section ('title') {!! $pc->id !!}  @stop

@section ('breadcrumbs')

                <ul class="breadcrumb a">
                  <li class="active">
                    <p>Inicio</p>
                  </li>
                  <li><a href="" class="active">Contratista</a>
                  </li>
                <li><a href="">Ver</a>
                  </li>

                </ul>
 @stop
@section ('content')

        <h1> <strong> {!! $pc->proyecto->nombre!!} </strong> </h1> 
        

<!-- </div>-->
<table class="table table-striped table-bordered dt-responsive nowrap">
                    <tbody>
                       <tr>
                        <td><strong>Proyecto Asociado</strong></td>
                        <td>{!!$pc->proyecto->nombre!!}</td>   
                      </tr>
          
                      <tr>
                        <td><strong> Empresa</strong></td>
                        <td>{!!$pc->empresa->nombre!!}</td>
                      </tr>
                        <tr>
                        <td><strong>Monto Ofertado</strong></td>
                        <td>{!!$pc->monto_ofertado!!}</td>
                      </tr>
                      <tr>
                        <td><strong>Estado Oferta</strong></td>
                        @if ($pc->estado_oferta == 0)
                        <td>No Ganada</td>
                        @else
                        <td>Ganada</td>
                        @endif
                      </tr>
                        <tr>
                        <td><strong>Plazo (días)</strong></td>
                        <td>{!!$pc->dias!!}</td>
                      </tr> 
                       <tr>
                        <td><strong>Fecha de la Oferta</strong></td>
                        <td>{!!date('d-m-Y', strtotime($pc->fecha_oferta))!!}</td>
                      </tr>                 
                    </tbody>
                  </table>
                  <p>
<a href="{!!route('proyectos.index')!!}" class="btn btn-primary">Volver a Proyectos</a>
<a href="{!!route('ofertas.edit', $pc->id)!!}" class="btn btn-primary">Editar</a>
<br>
<br>
  {!! Form::model($pc, array('route' => array('ofertas.destroy', $pc->id), 'method' => 'DELETE', 'onsubmit' => 'return ConfirmDelete()'), array('role' => 'form')) !!}
  {!! Form::submit('Eliminar', array('class' => 'btn btn-danger')) !!}
  {!! Form::close() !!}
</p>

<script>

  function ConfirmDelete()
  {
  var x = confirm("Desea eliminar esta Oferta?");
  if (x)
    return true;
  else
    return false;
  }

</script>

@stop



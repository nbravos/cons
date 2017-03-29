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
<table class="table table-user-information">
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
                        <td><strong>Bases</strong></td>
                        <td>{!!$pc->bases!!}</td>
                      </tr>                  
                    </tbody>
                  </table>
                  <p>
<a href="{!!route('proyectos.index')!!}" class="btn btn-primary">Volver a Proyectos</a>
<a href="{!!route('proyectocontratista.edit', $pc->id)!!}" class="btn btn-primary">Editar</a>
{!! Form::model($pc, array('route' => array('proyectocontratista.destroy', $pc->id), 'method' => 'DELETE', 'onsubmit' => 'ConfirmDelete()'), array('role' => 'form')) !!}
  {!! Form::submit('Eliminar Partida', array('class' => 'btn btn-danger')) !!}
  {!! Form::close() !!}
</p>

<script>

  function ConfirmDelete()
  {
  var x = confirm("Desea eliminar el Contratista?");
  if (x)
    return true;
  else
    return false;
  }

</script>

@stop



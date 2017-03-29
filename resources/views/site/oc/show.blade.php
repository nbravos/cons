@extends ('layout3')

@section ('title') {!! $oc->numero !!}  @stop
@section ('breadcrumbs')

                <ul class="breadcrumb a">
                  <li class="active">
                    <p>Inicio</p>
                  </li>
                  <li><a href="" class="active">Orden de Compra</a>
                  </li>
                <li><a href="">{{ $oc->numero }}</a>
                  </li>

                </ul>
 @stop

@section ('content')


        <h1> <strong> {!! $oc->numero!!} </strong> </h1> 
<!-- </div>-->
<table class="table table-user-information">
                    <tbody>
                      <tr>
                        <td> <strong>Número de OC </strong></td>
                        <td>{!!$oc->numero!!}</td>
                      </tr>
                        <tr>
                        <td> <strong>Partida Asociada </strong></td>
                        <td>{!!$oc->partida->item!!}</td>
                      </tr>
                      <tr>
                        <td><strong>Empresa Asociada</strong> </td>
                        <td>{!!$oc->empresa->nombre!!}</td>
                      </tr>
                      <tr>
                        <td><strong>Cargo</strong></td>
                        <td>{!!$oc->id_empresa_cargo!!}</td>
                      </tr>
                        <tr>
                        <td><strong>Cantidad</strong></td>
                        <td>{!!$oc->numero!!}</td>
                      </tr>
                        <tr>
                        <td><strong>Monto en UF</strong></td>
                        <td>{!!$oc->uf!!}</td>
                      </tr>
                      <tr>
                        <td><strong>Condición de Pago</strong></td>
                        <td>{!!$oc->condicion_pago!!}</td>
                      </tr>
                      <tr>
                        <tr id="tipo_plazo">
                        <td><strong>Condición de Plazo</strong></td>
                        <td>  {!!$oc->tipo_plazo!!}</td>   
                      </tr>
                        <td><strong>Fecha Emisión</strong></td>
                        <td>{{ Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $oc->fecha_emision)->format('d-m-Y') }}</td>   
                      </tr>
                       <tr>
                        <td><strong>Fecha Entrega</strong></td>
                        <td>{{ Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $oc->fecha_entrega)->format('d-m-Y') }}</td>   
                      </tr>
                       
                    </tbody>
                  </table>
                  <p>
<a href="{!!route('oc.index')!!}" class="btn btn-primary">Volver</a>
<a href="{!!route('oc.edit', $oc->id)!!}" class="btn btn-primary">Editar</a>
{!! Form::model($oc, array('route' => array('oc.destroy', $oc->id), 'method' => 'DELETE', 'onsubmit' => 'return ConfirmDelete()'), array('role' => 'form')) !!}
<!--  {!! Form::submit('Eliminar Orden de Compra', array('class' => 'btn btn-danger')) !!} -->

{!! Form::close() !!}
<!--<script type="text/javascript">
    $(document).ready(function() {
      function  RemoveFromTable(tableID){
        $("#"+tableID)

      }
        if($oc->condicion_pago != 'Plazo'){
          $('#tipo_plazo').hide();
        }
        else{
          $('#tipo_plazo').show();
        }
      });
    });
    </script>-->
</p>

<script>

  function ConfirmDelete()
  {
  var x = confirm("Desea eliminar la orden de compra?");
  if (x)
    return true;
  else
    return false;
  }

</script>

@stop


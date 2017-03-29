@extends ('layout3')

@section ('title') {!! $empresa->nombre !!}  @stop
@section ('breadcrumbs')

                <ul class="breadcrumb a">
                  <li class="active">
                    <p>Inicio</p>
                  </li>
                  <li><a href="" class="active">Empresa</a>
                  </li>
                <li><a href="">{{ $empresa->nombre }}</a>
                  </li>

                </ul>
 @stop
@section ('content')


        <h1> <strong> {!! $empresa->nombre!!} </strong> </h1> 
<!-- </div>-->
<table class="table table-user-information">
                    <tbody>
                      <tr>
                        <td> <strong>Nombre </strong></td>
                        <td>{!!$empresa->nombre!!}</td>
                      </tr>
                      <tr>
                        <td><strong>Dirección</strong> </td>
                        <td>{!!$empresa->direccion!!}</td>
                      </tr>
                      <tr>
                        <td><strong> Nombre Contacto</strong></td>
                        <td>{!!$empresa->nombre_contacto!!}</td>
                      </tr>
                        <tr>
                        <td><strong>Rut</strong></td>
                        <td>{!!$empresa->rut!!}</td>
                      </tr>
                        <tr>
                        <td><strong>Correo</strong></td>
                        <td>{!!$empresa->email!!}</td>
                      </tr>
                      <tr>
                        <td><strong>Razón Social</strong></td>
                        <td>{!!$empresa->razon_social!!}</td>
                      </tr>
                      <tr>
                        <td><strong>Web</strong></td>
                        <td>{!!$empresa->web!!}</td>   
                      </tr>
                      <tr>
                        <td><strong>Tipo</strong></td>
                        <td>{!!$empresa->tipo_empresa!!}</td>   
                      </tr>
                      <tr>
                        <td><strong> Giro </strong></td>
                        <td>{!!$empresa->giro!!}</td>   
                      </tr>
                     
                    </tbody>
                  </table>
                  <p>
<a href="{!!route('empresas.index')!!}" class="btn btn-primary">Volver</a>
<a href="{!!route('empresas.edit', $empresa->id)!!}" class="btn btn-primary">Editar</a>
{!! Form::model($empresa, array('route' => array('empresas.destroy', $empresa->id), 'method' => 'DELETE', 'onsubmit' => 'return ConfirmDelete()'), array('role' => 'form')) !!}
  {!! Form::submit('Eliminar Empresa', array('class' => 'btn btn-danger')) !!}
{!! Form::close() !!}
</p>

<script>

  function ConfirmDelete()
  {
  var x = confirm("Desea eliminar la empresa?");
  if (x)
    return true;
  else
    return false;
  }

</script>

@stop


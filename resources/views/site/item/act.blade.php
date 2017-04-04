@extends ('layout3')

@section ('title')  Modificar Item  @stop
@section ('breadcrumbs')

                <ul class="breadcrumb a">
                  <li class="active">
                    <p>Inicio</p>
                  </li>
                  <li><a href="" class="active">Items</a>
                  </li>
                <li><a href="">Modificar</a>
                  </li>

                </ul>
 @stop

@section ('content')

<table class="table table-striped">
    <tr>
        <th>Items </th>
        <th>Cantidad</th>
    </tr>
    @foreach ($items as $item)
    <tr>
    	<td> {{ $item->detalle }} </td>
        <td>  {{ Form::number('cantidad', $item->cantidad) }} {{ $item->unidad  }} </td>
    </tr>
    @endforeach	
  </table>

@stop

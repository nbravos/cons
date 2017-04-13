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
<div class=class="panel-body">
<table class="table table-striped">
    <thead>
    <tr>
        <th>Items </th>
        <th>Cantidad</th>
    </tr>
    </thead>
    @foreach ($items as $item)
    <tbody>
    <tr>
      <td> {{ $item->detalle }} </td>
        <td>  {{ Form::number('cantidad', $item->cantidad), null, ['class' => 'form-control'] }} {{ $item->unidad }} </td>
    </tr>
    </tbody>
    @endforeach 
  </table>
</div>
 {!! Form::button('Guardar Datos', array('type' => 'submit', 'class' => 'btn btn-primary')) !!}    
  
{!! Form::close() !!}
<script type="text/javascript">
  $(document).ready(function(){
    $(".valor").attr({
      "min" : 0

    });
  });
</script>

@stop


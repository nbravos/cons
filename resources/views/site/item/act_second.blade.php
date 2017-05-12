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



  @for($i = 0; $i < count($items); $i++)
        <tr>
            <td>{{ $item[$i]->detalle}} </td>
            <td>
            	{!! Form::open(['action' => ['ItemController@storefromdoc', $item->id], 'class' => 'form-inline']) !!}
                <div class="input-group">
                    <div class="input-group">
                        {!! Form::text('Cantidad', $item->cantidad, ['class' => 'form-control']) !!}
                        <span class="input-group-btn">
                            {!! Form::submit('Guardar', ['class' => 'btn btn-success']) !!}
                        </span>
                    </div>
                </div>
                {!! Form::close() !!}
            </td>
        </tr>
    @endfor

    <script type="text/javascript">
  $(document).ready(function(){
    $(".valor").attr({
      "min" : 0

    });
  });
</script>

@stop

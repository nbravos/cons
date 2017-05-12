@extends ('layout3')

@section ('title')  Modificar Item  @stop
@section ('breadcrumbs')

{!! Form::open(['action' => ['ItemController@storefromdoc'], 'class' => 'form-inline']) !!}

   
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

   


  @foreach($items as $item)
                    <div class="input-group">
			{{$item->detalle}}
                        {!! Form::number('cantidad[]', $item->cantidad, ['class' => 'form-control']) !!} {{$item->unidad}}
                        {{ Form::hidden('detalle[]', $item->detalle) }}
                        {{ Form::hidden('unidad[]', $item->unidad) }}
                        {{ Form::hidden('unitario[]', $item->unitario) }}
                        {{ Form::hidden('id_item_dos[]', $item->id) }}
                        <span class="input-group-btn">
                        </span>
                    </div>
<br>
    @endforeach

<br>

{!! Form::submit('Guardar', ['class' => 'btn btn-primary']) !!}

{!! Form::close() !!}
@stop

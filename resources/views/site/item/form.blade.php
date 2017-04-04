@extends ('layout3')

@section ('content')

  @if ($errors->any())
    <div class="alert alert-danger">
      <button type="button" class="close" data-dismiss="alert">&times;</button>
      <strong>Por favor corrige los siguentes errores:</strong>
      <ul>
      @foreach ($errors->all() as $error)
        <li>{!! $error !!}</li>
      @endforeach
      </ul>
    </div>
  @endif
@if(isset($item))
    {!! Form::model($item, ['route' => ['items.update', $item->id], 'method' => 'patch']) !!}
     @section ('breadcrumbs')

                <ul class="breadcrumb a">
                  <li class="active">
                    <p>Inicio</p>
                  </li>
                  <li><a href="" class="active">Item</a>
                  </li>
                <li><a href="Editar:"></a>
                  </li>
                </ul>
 @stop

	<h1>Editar Item</h1>
@else
    {!! Form::open(array('route' => 'items.store', 'method' => 'POST', 'files'=> true), array('role' => 'form')) !!}
             @section ('breadcrumbs')

                <ul class="breadcrumb a">
                  <li class="active">
                    <p>Inicio</p>
                  </li>
                  <li><a href="" class="active">Item</a>
                  </li>
                <li><a href="" class="active">Agregar</a>
                  </li>
                </ul>
 @stop
	 <h1>Agregar Item</h1>
@endif

<div class="row">
<div class="form-group">
      {!! Form::label('cantidad', 'Cantidad') !!}
      {!! Form::text('cantidad', null, array('placeholder' => 'Ingresa cantidad del item', 'class' => 'form-control')) !!}
    </div>
    <div class="form-group">
      {!! Form::label('detalle', 'Detalle') !!}
      {!! Form::text('detalle', null, array('placeholder' => 'Ingresa detalle del artículo', 'class' => 'form-control')) !!}
    </div>
    <div class="form-group">
      {!! Form::label('unidad', 'Unidad') !!}
      {!! Form::text('unidad', null, array('placeholder' => 'Ingresa la unidad de medida (cm, m, kg; etc)', 'class' => 'form-control')) !!}
    </div>
    <div class="form-group">
      {!! Form::label('unitario', 'Unitario') !!}
      {!! Form::text('unitario', null, array('placeholder' => 'Indica el valor unitario del item', 'class' => 'form-control')) !!}
    </div>
</div>

{{ $order = Input::get('oc')  }}

 {!! Form::button('Guardar Datos', array('type' => 'submit', 'class' => 'btn btn-primary')) !!}    
  
{!! Form::close() !!}
<br>
<p>
  <a href="{!! route('items.create') !!}" class="btn btn-primary">Agregar nuevo </a>
  </p>

@stop

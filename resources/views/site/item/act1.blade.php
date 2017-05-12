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

<div class="panel panel-transparent">
              <div class="panel-heading">
                <div class="export-options-container pull-right"></div>
                <div class="clearfix"></div>
              </div>
              <div class="panel-body">
  <table  class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
              <thead>
                <tr>
                <th>Items</th>
                <th>Cantidad</th>
                 </tr>
              </thead>
                  <tbody>
            @foreach ($items as $item)
            {!! Form::open(array('route' => 'additemdoc', 'method' => 'POST', 'files'=> true), array('role' => 'form')) !!}
              <tr>
                <td> {{ $item->detalle }} </td>
                <td>  {{ Form::number('cantidad', $item->cantidad), null, ['class' => 'form-control'] }} {{ $item->unidad }} </td>
              </tr>
               {{ Form::button('Guardar Datos', array('type' => 'submit', 'class' => 'btn btn-primary')) }} 
               {{ Form::close() }}
            @endforeach 
              </tbody>
              </table>
              </div>
  </div>



<script type="text/javascript">
  $(document).ready(function(){
    $(".valor").attr({
      "min" : 0

    });
  });
</script>

@stop


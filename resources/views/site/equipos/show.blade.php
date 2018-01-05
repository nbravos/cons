@extends ('layout3')

@section ('title') {!! $equipo->nombre !!}  @stop

@section ('breadcrumbs')

                <ul class="breadcrumb a">
                  <li class="active">
                    <p>Inicio</p>
                  </li>
                  <li><a href="" class="active">Equipo</a>
                  </li>
                <li><a href="">{{ $equipo->nombre }}</a>
                  </li>

                </ul>
 @stop
@section ('content')
<script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyD0oVFzgMpoDrPfOG_rBVRzA-_vgSdcf38" type="text/javascript"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/gmaps.js/0.4.24/gmaps.js"></script>

        <h1> <strong> {!! $equipo->nombre!!} </strong> </h1> 
 <a href="{{ route('verMant', ['id' =>  $equipo->id]) }}" class="btn btn-primary">Ver Mantenciones</a>
 <a href="{{ route('addMant', ['id' =>  $equipo->id]) }}" class="btn btn-primary">Agregar Mantención</a>
<br>
<br>
<!-- </div>-->
<table class="table table-striped table-bordered dt-responsive nowrap">
                    <tbody>
                      <tr>
                        <td> <strong>Nombre </strong></td>
                        <td>{!!$equipo->nombre!!}</td>
                      </tr>
                      <tr>
                        <td><strong>Código</strong> </td>
                        <td>{!!$equipo->codigo!!}</td>
                      </tr>
                      <tr>
                        <td><strong>Costo Equipo</strong></td>
                        <td>{!!$equipo->costo!!}</td>
                      </tr>
                        <tr>
                        <td><strong>Descripción</strong></td>
                        <td>{!!$equipo->descripcion!!}</td>
                      </tr>
                    </tbody>
                  </table>
                <div class="row">
                  <div class="col-sm-2"></div>
                  <div class="col-sm-8">
                    <div id="mymap"></div>
                  </div>
                  <div class="col-sm-2"></div>
              </div> 
                  <p>
              <br>
              <br>    
<a href="{!!route('equipos.index')!!}" class="btn btn-primary">Volver</a>
<a href="{!!route('equipos.edit', $equipo->id)!!}" class="btn btn-primary">Editar</a>
{!! Form::model($equipo, array('route' => array('equipos.destroy', $equipo->id), 'method' => 'DELETE', 'onsubmit' => 'return ConfirmDelete()'), array('role' => 'form')) !!}
  {!! Form::submit('Eliminar Equipo', array('class' => 'btn btn-danger')) !!}
{!! Form::close() !!}
</p>

<script>

  function ConfirmDelete()
  {
  var x = confirm("Desea eliminar el equipo?");
  if (x)
    return true;
  else
    return false;
  }

</script>

<script type="text/javascript">

$(document).ready(function(){
   var locations = <?php print_r(json_encode($ubicacion)) ?>;
  
    var mymap = new GMaps({
      div: '#mymap',
      lat: -33.047238,
      lng: -71.61268849999999,
      width: '600px',
      height: '300px',
      zoom:14
    });

    $.each( locations, function( index, value ){
      var fecha =  new Date(value.fecha);
      mymap.addMarker({
        lat: value.lat,
        lng: value.lon,
        infoWindow: {
          content: '<p>Nombre Equipo:  </p> '+ value.nombre +' <br> <br> <p>Fecha: </p>' + (fecha.getDate() + 1) + '/' + fecha.getMonth() + '/' +  fecha.getFullYear()
        }
        
      });
   });

});

   

  </script>

@stop


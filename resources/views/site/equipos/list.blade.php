
@extends ('layout3')

@section ('title') Lista de Equipos @stop
@section ('breadcrumbs')

                <ul class="breadcrumb a">
                  <li class="active">
                    <p>Inicio</p>
                  </li>
                  <li><a href="" class="active">Equipos</a>
                  </li>
                </ul>
 @stop

@section ('content')
<script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyD0oVFzgMpoDrPfOG_rBVRzA-_vgSdcf38" type="text/javascript"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/gmaps.js/0.4.24/gmaps.js"></script>
<p>
  <a href="{!! route('equipos.create') !!}" class="btn btn-primary">Agregar nuevo </a>
  </p>

<!-- <div class="container-fluid container-fixed-lg bg-white"> -->
            <!-- START PANEL -->
            <div class="panel panel-transparent">
              <div class="panel-heading">
                <div class="panel-title">Listado de Equipos
                </div>
                <div class="export-options-container pull-right"></div>
                <div class="clearfix"></div>
              </div>
              <div class="panel-body">
  <table id="listaEq" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
              <thead>
                <tr>
                <th>Número</th>
                <th>Nombre</th>
                 <th>Descripción</th>
                 <th>Acciones</th>
                 </tr>
              </thead>
               <tfoot>
                    <tr>
                      <td class="non_searchable"></td>
                      <td></td>
                      <td></td>
                      <td  class="non_searchable"></td>
                    </tr>
                  </tfoot>
              </table>
              </div>
              <div id="mymap"></div>
            </div>
<!--           </div> -->



<script type="text/javascript">

$(document).ready(function(){
   var locations = <?php print_r(json_encode($ubicaciones)) ?>;
  
    var mymap = new GMaps({
      div: '#mymap',
      lat: -33.047238,
      lng: -71.61268849999999,
      width: '800px',
      height: '800px',
      zoom:12
    });

    $.each( locations, function( index, value ){
      var fecha =  new Date(value.fecha);
      mymap.addMarker({
        lat: value.lat,
        lng: value.lon,
        infoWindow: {
          content: '<p>Código Equipo:  </p> '+ value.nombre +' <br> <br> <p>Fecha: </p>' + (fecha.getDate() + 1) + '/' + fecha.getMonth() + '/' +  fecha.getFullYear()
        }
        
      });
   });

});

   

  </script>

<script type="text/javascript">
              $(document).ready(function() {
               $('#listaEq').DataTable({
            processing: false,
            serverSide: true,
            ajax: '{!! route("equipos.index") !!}',
	    order: [[0, "desc"]], 
            lengthMenu: [[10, 25, 50, -1], [10, 25, 50, 'TODO']],
            "sDom": 'Rfrtlip',
            language: {
              url: 'https://cdn.datatables.net/plug-ins/1.10.12/i18n/Spanish.json'
          },
            columns: [
                {data: 'id', name: 'id', visible: false},
                {data: 'nombre', name: 'nombre'},
                {data: 'descripcion', name: 'descripcion'},
                {data: 'action', name: 'action', orderable: false, searchable: false}
    
            ],

        });
              $('#listaEq tfoot tr').appendTo('#listaEq thead');
       });

          </script>


<!--          <script type="text/javascript">
              $(document).ready(function() {
              $('#listaEq').DataTable({
                "oLanguage": { 
                  "sUrl": "//cdn.datatables.net/plug-ins/1.10.7/i18n/Spanish.json" }
                });
              });
          </script>

 
<table class="table table-striped">
    <tr>
        <th>Nombre</th>
        <th>Descripción</th>
	<th>Acciones</th>
    </tr>
    @foreach ($equipos as $equipo)
    <tr>
        <td>{!! $equipo->nombre !!}</td>
        <td>{!! $equipo->descripcion !!}</td>
       

      
	<td>
          <a href="{!! route('equipos.show', $equipo->id) !!}" class="btn btn-info">
              Ver
          </a>
          <a href="{!! route('equipos.edit', $equipo->id) !!}" class="btn btn-primary">
            Editar
          </a>
	</td>

    </tr> 
    @endforeach
  </table>
-->
@stop

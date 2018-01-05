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
<table class="table table-striped table-bordered dt-responsive nowrap">
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
                      @if ($empresa->tipo_empresa == 1)
                        <td>Proveedor</td>   
                      @elseif ($empresa->tipo_empresa == 2)
                        <td>Mandante</td>
                      @elseif ($empresa->tipo_empresa == 3)
                        <td>Contratista</td>
                      @endif
                      </tr>
                      <tr>
                        <td><strong> Giro </strong></td>
                        <td>{!!$empresa->giro!!}</td>   
                      </tr>
                     
                    </tbody>
                  </table>

<!-- Agregar acá tabla con datos -->
<div  class="panel panel-transparent">
              <div class="panel-heading">
                <div class="panel-title">Listado de Ofertas
                </div>
                <div class="export-options-container pull-right"></div>
                <div class="clearfix"></div>
              </div>
              <div  class="panel-body">

          {!! Form::label('filtro', 'Filtrar por: ') !!}
          {!!Form::select('filtroTrab', array(
          '0' => 'Todos',
          '1' => 'Oferta Ganadora', 
          '2' => 'Ofertas No Ganadoras'), null, ['id' =>'filtroTrab', 'class' => 'form-control']) !!}

          <div class="row">
          <div class= "col-xs-6 col-md-4">
          <div class="form-group">
           <label class="control-label" for="inicio">Desde</label>
          <input class="form-control" id="datepicker1" name="inicio" placeholder="DD/MM/AA" type="text">
      </div>
      </div>
      <div class ="col-xs-6 col-md-4">
      <div class="form-group">
           <label class="control-label" for="fin">Hasta</label>
          <input class="form-control" id="datepicker2" name="fin" placeholder="DD/MM/AA" type="text">
      </div>
      </div>
      <div class="col-xs-6 col-md-4"> <br> <p  id="button" class="btn btn-default btn-sm m-t-10" >Filtrar </p></div>
      </div>
<br>
  <table id="listaOf" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
              <thead>
                <tr>
	             	<th>Id </th>	
		            <th>Empresa</th>                
                <th>Proyecto</th>
                <th>Monto Ofertado</th> 
                <th>Plazo</th>
                </tr>
              </thead>
              <tfoot>
                    <tr>
		      <td class="non_searchable"></td>	
                       <td></td>
                      <td></td>
                  <td></td>
                      <td></td> 
                    </tr>
                  </tfoot>
              </table>
              </div>
            </div>
            <p>
<a href="{!!route('empresas.index')!!}" class="btn btn-primary">Volver</a>
<a href="{!!route('empresas.edit', $empresa->id)!!}" class="btn btn-primary">Editar</a>
<br>
<br>
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

<script type="text/javascript">
              $(document).ready(function() {
               $('#listaOf').DataTable({
            processing: false,
            serverSide: true,
            ajax: '{!! route('verofEmp', ['id' =>  $empresa->id]) !!}',
           
            lengthMenu: [[10, 25, 50, -1], [10, 25, 50, 'TODO']],
            "sDom": 'Rfrtlip',
            language: {
              url: 'https://cdn.datatables.net/plug-ins/1.10.12/i18n/Spanish.json'
          },
            columns: [
		{data: 'id', name: 'proyecto_contratista.id', visible:false},                
                {data: 'mand', name:'empresa.nombre'},
		{data: 'proNom', name:'proyecto.nombre'},
                {data: 'montOf', name: 'proyecto_contratista.monto_ofertado as montOf'},
                {data: 'diasOf', name: 'proyecto_contratista.dias'}    
            ],
            
        });
              $('#listaOf tfoot tr').appendTo('#listaOf thead');
       });

          </script>

      <script type="text/javascript">
       
       $('#filtroTrab').on('change', function(e) {
        var e = document.getElementById("filtroTrab");
        var valorCom = e.options[e.selectedIndex].value;
        var url = 'https://aragonltda.cl/ofertas/getEmpGan/'+ valorCom;
      $('#listaOf').dataTable( {

         "bDestroy": true   
});
   $('#listaOf').dataTable().fnDestroy();
   $('#listaOf').empty();

        $('#listaOf').DataTable({
            processing: false,
            serverSide: true,
            ajax: url,
            lengthMenu: [[10, 25, 50, -1], [10, 25, 50, 'TODO']],
            "sDom": 'Rfrtlip',
            language: {
              url: 'https://cdn.datatables.net/plug-ins/1.10.12/i18n/Spanish.json'
          },
            columns: [
                {data: 'id', name: 'proyecto_contratista.id', visible:false},                
                {data: 'mand', name:'empresa.nombre'},
                {data: 'proNom', name:'proyecto.nombre'},
                {data: 'montOf', name: 'proyecto_contratista.monto_ofertado as montOf'},
                {data: 'diasOf', name: 'proyecto_contratista.dias'}    
            ],
            
        });

          $('#listaOf tfoot tr').appendTo('#listaOf thead');
         
            
        }); 


      </script>


 <script src="https://aragonltda.cl/assets/plugins/bootstrap-datepicker/js/bootstrap-datepicker.js"></script>
   <script src="https://aragonltda.cl/assets/plugins/bootstrap-datepicker/js/bootstrap-datepicker.es.min.js"></script>
    <script type="text/javascript">
$(document).ready(function () {
       
  $( "#datepicker1" ).datepicker({
        format: 'yy-mm-dd',
        language: 'es',
        autoclose: true

  });

  $( "#datepicker2" ).datepicker({
        format: 'yy-mm-dd',
        language: 'es',
        autoclose: true

  });

$("#button").click(function() {
   var from = $("#datepicker1").val();
   var to = $("#datepicker2").val();
   var idempresa =   "<?php echo $empresa->id; ?>";
   var url = 'https://aragonltda.cl/ofertas/getfilFecha/'+ from +'/' + to + '/' + idempresa;
  


  
    $('#listaOf').dataTable( {

         "bDestroy": true   
});
   $('#listaOf').dataTable().fnDestroy();
   $('#listaOf').empty();
         $('#listaOf').DataTable({
            processing: false,
            serverSide: true,
            ajax: url,
            order: [4, "asc"], 
            lengthMenu: [[10, 25, 50, -1], [10, 25, 50, 'TODO']],
            "sDom": 'Rfrtlip',
            language: {
              url: 'https://cdn.datatables.net/plug-ins/1.10.12/i18n/Spanish.json'
          },
            columns: [
                {data: 'id', name: 'proyecto_contratista.id', visible:false},                
                {data: 'mand', name:'empresa.nombre'},
                {data: 'proNom', name:'proyecto.nombre'},
                {data: 'montOf', name: 'proyecto_contratista.monto_ofertado as montOf'},
                {data: 'diasOf', name: 'proyecto_contratista.dias'}    
            ],

         
        });
              $('#listaOf tfoot tr').appendTo('#listaOf thead');
        });

});

</script>  


@stop


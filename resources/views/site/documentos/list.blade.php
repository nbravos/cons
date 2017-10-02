 
@extends ('layout3')

@section ('title') Listado de Documentos @stop
@section ('breadcrumbs')

                <ul class="breadcrumb a">
                  <li class="active">
                    <p>Inicio</p>
                  </li>
                  <li><a href="" class="active">Documentos</a>
                  </li>
                </ul>
 @stop
@section ('content')
 
<p>
  <a href="{!! route('documentos.create') !!}" class="btn btn-primary">Agregar nuevo </a>
  </p>
<!--<div class="container-fluid container-fixed-lg bg-white">-->
            <!-- START PANEL -->
            <div class="panel panel-transparent">
              <div class="panel-heading">
                <div class="panel-title">Listado de Documentos
                </div>
                <div class="export-options-container pull-right"></div>
                <div class="clearfix"></div>
              </div>
              <div class="panel-body">
              <div class="form-group">
           {!! Form::label('proyecto', 'Proyecto Base') !!}
           {!! Form::select('proyecto', App\Models\Proyecto::pluck('nombre', 'id'), null, array('class' => 'form-control', 'id' => 'proyecto')) !!}
    </div>
              <div class="form-group">
           {!! Form::label('orden', 'Orden Asociada') !!}
           {!! Form::select('orden', App\Models\Ordencompra::pluck('numero', 'numero'), null, array('class' => 'form-control', 'id' => 'orden')) !!}
    </div>
     <div class="form-group">
            {!! Form::label('tipo', 'Tipo de Documento') !!}
            {!!Form::select('tipo', array(
          'Boleta' => 'Boleta', 
          'Factura' => 'Factura', 
          'Nota de Crédito' => 'Nota de Crédito',
          'Guía de Despacho' => 'Guía de Despacho'), null, ['id' =>'tipo', 'class' => 'form-control']) !!}
     </div>    

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
  <table id="listaDoc" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
              <thead>
                <tr>
                <th>ID</th>
                <th>Tipo</th>
                <th>Número</th>
                 <th>Monto</th>
                 <th>Fecha</th>
                 <th>Orden Compra</th>
                 <th>Acciones</th>
                 </tr>
              </thead>
             <tfoot>
                    <tr>
                      <td class="non_searchable"></td>
                      <td></td>
                      <td></td>
                      <td></td>
                      <td></td>
                      <td></td>
                      <td  class="non_searchable"></td>
                    </tr>
                  </tfoot>
              </table>
              </div>
            </div>
<!--          </div> -->



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
   
   var url = 'https://aragonltda.cl/documentos/getfilFecha/'+ from +'/' + to;

  
    $('#listaDoc').dataTable( {

         "bDestroy": true   
});
   $('#listaDoc').dataTable().fnDestroy();
   $('#listaDoc').empty();
         $('#listaDoc').DataTable({
            processing: false,
            serverSide: true,
            ajax: url,
            order: [4, "desc"], 
            lengthMenu: [[10, 25, 50, -1], [10, 25, 50, 'TODO']],
            "sDom": 'Rfrtlip',
            language: {
              url: 'https://cdn.datatables.net/plug-ins/1.10.12/i18n/Spanish.json'
          },
            columns: [
                {data: 'id', name: 'id', visible: false},
                {data: 'tipo', name: 'tipo'},
                {data: 'numero', name: 'documento.numero'},
                {data: 'monto', name: 'monto'},
                {data: 'fecha', name: 'fecha'},
                {data: 'ocNum', name: 'orden_compra.numero'},
                {data: 'action', name: 'action', orderable: false, searchable: false}
    
            ],

         
        });
              $('#listaDoc tfoot tr').appendTo('#listaDoc thead');
        });

});

</script>  
   
@stop

 
@extends ('layout3')

@section ('title') Listado Partidas  @stop
@section ('breadcrumbs')

                <ul class="breadcrumb a">
                  <li class="active">
                    <p>Inicio</p>
                  </li>
                  <li><a href="" class="active">Partidas</a>
                  </li>
                </ul>
 @stop
@section ('content')

<p>
  <a href="{!! route('partidas.create') !!}" class="btn btn-primary">Agregar Nueva</a>
  </p>

  <!-- <div class="container-fluid container-fixed-lg bg-white">-->
            <!-- START PANEL -->
            <div class="panel panel-transparent">
              <div class="panel-heading">
                <div class="panel-title">Presupuesto de Obra 
                </div>
                <div class="export-options-container pull-right"></div>
                <div class="clearfix"></div>
              </div>
              <div class="panel-body">
              <div class="form-group">
          <div class="form-group">
      {!!Form::label('select1', 'Filtro')!!}
      {!!Form::select('select1', array(
          '0' => 'Todos',
          '1' => 'Activos',
          '2' => 'No Activos'), null, ['id' =>'select1', 'class' => 'form-control']) !!}
  </div>

           <div class="form-group">
    <label> Seleccionar Proyecto
        <select id="select2" class="form-control" name="select2">
            <option value=""></option>
       </select>
    </label>
</div>
    </div>
  <table id="listaPart" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
              <thead>
                <tr>
                <th>Numero </th>
               <th>Nombre</th>
               <th>Item</th>
               <th>Total Partida</th>
               <th>Activa</th>
               <th>Acciones</th>
                 </tr>
              </thead>
              <tbody>
     <tfoot>
                    <tr>
                      <td  class="non_searchable"></td>
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
          <!-- </div> -->

<script type="text/javascript">

  $('#select1').on('change', function(e){
    console.log(e);
    var valor = e.target.value;
    $.get('partidas/getDrop/' + valor, function(data) {  
    console.log(data);
    $('#select2').empty();
    $.each(data, function(index, CatObj){
    $('#select2').append($('<option>', { 
    value: CatObj.id,
    text : CatObj.nombre,
      }));
    });
  });
 });

  $('#select2').on('change', function(e){
     var e = document.getElementById("select2");
     var proyecto_id = e.options[e.selectedIndex].value;
     var url = 'https://aragonltda.cl/partidas/getIndex/'+ proyecto_id;
    $('#listaPart').dataTable( {

         "bDestroy": true   
});
   $('#listaPart').dataTable().fnDestroy();
   $('#listaPart').empty();

        $('#listaPart').DataTable({
            processing: false,
            select:  true, 
            serverSide: true,
            retrieve: true,
            ajax: url,
            order: [1, "desc"], 
            lengthMenu: [[10, 25, 50, -1], [10, 25, 50, 'TODO']],
            iDisplayLength: -1,
            "sDom": 'TRfrtlip',
            "oTableTools": {
          "sSwfPath": "//cdn.datatables.net/tabletools/2.2.2/swf/copy_csv_xls_pdf.swf",
          "aButtons": [
            {
              "sExtends": "xls",
              "sButtonText": 'Exportar ',
              "sFileName": "Partidas - *.csv",
               "mColumns": [1, 2, 3, 4],
              "aButtons": [ "xls" ]
            }
            ]
        },
            language: {
              url: 'https://cdn.datatables.net/plug-ins/1.10.12/i18n/Spanish.json'
          },
             columns: [
                {data: 'id', name: 'partida.id', visible: false},
                {data: 'partNombre', name: 'partida.nombre', title: 'Nombre'},
                {data: 'item', name: 'item', title: 'Item'},
                {data: 'total', render: function ( data, type, row ) {
                  return $.fn.dataTable.render.number( '.', '.', 0, '$' ).display(data) ;
                }, name: 'partida.total', title: 'Total'},
                {data: 'activa', render:  function(data, type, row) {
                                if (data === '1') {
                                return 'Si';
                                  } else {
                                return 'No';
                              }}, name: 'partida.activa', title: 'Activa'},
                {data: 'action', name: 'action', orderable: false, searchable: false, title: 'Acciones'}
    
            ],

          
        });
              $('#listaPart tfoot tr').appendTo('#listaPart thead');
 });


</script>

@stop

 

@extends ('layout3')

@section ('title') {!! $proyecto->nombre !!}  @stop
@section ('breadcrumbs')

                <ul class="breadcrumb a">
                  <li class="active">
                    <p>Inicio</p>
                  </li>
                  <li><a href="" class="active">Obras</a>
                  </li>
                <li><a href="">{{ $proyecto->nombre }}</a>
                  </li>

                </ul>
 @stop
@section ('content')
        <h1> <strong> {!! $proyecto->nombre!!} </strong> </h1> 



<table class="table table-striped table-bordered dt-responsive nowrap">
                    <tbody>
                      <tr>
                        <td> <strong>Nombre </strong></td>
                        <td>{!!$proyecto->nombre!!}</td>
                      </tr>
                      <tr>
                        <td><strong>Mandante</strong> </td>
                        <td>{!!$proyecto->empresa->nombre!!}</td>
                      </tr>
                      <tr>
                        <td><strong> Comuna</strong></td>
                        <td>{!!$proyecto->comuna->nombre!!}</td>
                      </tr>
		                  <tr>
                        <td><strong>Presupuesto</strong></td>
                        <td>${!!$proyecto->presupuesto_oficial!!}</td>
                      </tr>
                        <tr>
                        <td><strong>Financiamiento</strong></td>
                        <td>{!!$proyecto->financiamiento!!}</td>
                      </tr>
                         <tr>
                        <td><strong> Inicio Obra </strong></td>
			 <td>{!!date('d-m-Y', strtotime($fecha->inicio_real))!!}</td>                       
                      </tr>

                      <tr style="display: none;">
                        <td> <strong>ID </strong></td>
                        <td id="fila">{!!$proyecto->id!!}</td>
                      </tr>

                    </tbody>
                  </table>
                  <p>
  <a href="{!! route('partidas.create') !!}" class="btn btn-primary">Agregar Partida</a> 
  <a href="{{ route('agregaTrabajadorObra', $proyecto->id)  }}" class="btn btn-primary">Agregar Trabajador</a>
  <a href="{{ route('asistenciaDiaria', $proyecto->id)  }}" class="btn btn-primary">Asistencia</a>
  </p>


  	<table id="listaPart" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
              <thead>
                <tr>
               <th>Número</th>
               <th>Item</th>
               <th>Nombre</th>
               <th>Unidad</th>
               <th>Cantidad</th>
               <th>Precio Unitario</th>
               <th>Valor</th>
               <th>Seguimiento</th>
               <th>Acciones</th>
                 </tr>
              </thead>
              <tfoot>
        </tfoot>
              <tbody>
              <td class="non_searchable"></td>
                      <td></td>
                      <td></td>
                      <td></td>
                      <td></td>
                      <td></td>
                      <td></td>
                      <td></td>
              <td class="non_searchable"></td>
              </table>
              </div>
<!--<a href="#" class="btn btn-primary">Editar</a>
  <p>
  <a href="#" class="btn btn-primary">Asistencia Diaria</a>
  </p>-->


<script type="text/javascript">
	
	var proyecto_id = $("#fila").text();
	var url = 'https://aragonltda.cl/partidas/getIndex3/'+ proyecto_id;
	$('#listaPart').dataTable().fnDestroy();
   $('#listaPart').empty();

        $("#listaPart").append('<tfoot><th></th><th></th><th></th><th></th><th></th><th></th><th></th><th></th><th></th></tfoot>');
        $('#listaPart').DataTable({
            fixedHeader:{
              header: true,
              footer: true,
            },
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
              "sFileName": "Obras - *.csv",
               "mColumns": [1, 2, 3, 4],
              "aButtons": [ "xls" ]
            }
            ]
        },
            language: {
              url: 'https://cdn.datatables.net/plug-ins/1.10.12/i18n/Spanish.json'
          },
             columns: [
                {data: 'id', name:'partida.id', searchable: false, visible: false},
                {data: 'item', name: 'item', title: 'Item'},
                {data: 'partNombre', name: 'partida.nombre', title: 'Nombre'},
                {data: 'unidad', name: 'partida.unidad', title: 'Unidad'},
                {data: 'cantidad', name: 'partida.cantidad', title: 'Cantidad'},
                {data: 'unitario', name: 'partida.unitario', title: 'Valor Unitario'},
                {data: 'total',  render: function ( data, type, row ) {
                  return $.fn.dataTable.render.number( '.', '.', 0, '$' ).display(data) ;
                }, name: 'partida.total', title: 'Valor'},
                {data: 'activa', render:  function(data, type, row) {
                                if (data === '1') {
                                return 'Si';
                                  } else {
                                return 'No';
                              }}, name: 'partida.activa', title: 'Seguimiento'},
                {data: 'action', name: 'action', orderable: false, searchable: false, title: 'Acciones'}
              

    
            ],
            
            "footerCallback": function ( row, data, start, end, display ) {
            var api = this.api(), data;
 
            // Remove the formatting to get integer data for summation
            var intVal = function ( i ) {
                return typeof i === 'string' ?
                    i.replace(/[\$.]/g, '')*1 :
                    typeof i === 'number' ?
                        i : 0;
            };
 
            // Total over all pages
            total = api
                .column( 5 )
                .data()
                .reduce( function (a, b) {
                    return intVal(a) + intVal(b);
                }, 0 );
  
            // Update footer
            var numFormat = $.fn.dataTable.render.number( '.', '.', 0, '$' ).display;
         $( api.column( 5 ).footer() ).html(
                ' Total: '+ numFormat(total) +''
            );
        }
        });
</script>
@stop

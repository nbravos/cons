
@extends ('layout3')
@section ('title')  @stop
@section ('breadcrumbs')

                <ul class="breadcrumb a">
                  <li class="active">
                    <p>Inicio</p>
                  </li>
                  <li><a href="" class="active">Asistencia</a>
                  </li>
                </ul>
 @stop

@section ('content')

<!-- <div class="container-fluid container-fixed-lg bg-white"> -->
            <!-- START PANEL -->
            <div class="panel panel-transparent">
              <div class="panel-heading">
                <div class="panel-title">Asistencia Obra
                </div>
                <div class="export-options-container pull-right"></div>
                <div class="clearfix"></div>
              </div>
              <div class="panel-body">
  <table id="listaTrabProy" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
              <thead>
                <tr>
                <th>Nombre</th>
                <th>Presente</th>
                <th>Fecha</th>
                 <th>Usuario</th>
                 </tr>
              </thead>
               <tfoot>
                    <tr>
                      <td></td>
                      <td></td>
                      <td></td>
                      <td></td>
                    </tr>
                  </tfoot>
              </table>

    <br>

    <br>
              <div class="form-group">
    <label>Trabajadores
        <select name="id_trabajador" id="id_trabajador" class="form-control input-sm">
            @foreach($trabajadores as $trabajador)
          <option value="{{$trabajador->id}}">{{$trabajador->nombre}} {{$trabajador->ap_paterno}}</option>            @endforeach
           </select>
    </label>
</div>



<canvas id="projects-graph" width="600" height="400"></canvas>

  <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.1.3/Chart.bundle.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.17.1/moment-with-locales.min.js"></script>
<script type="text/javascript">
    $(document).ready(function() {
    moment.locale('es');
    var id = "<?php echo $obra->id; ?>";
    var url = 'https://aragonltda.cl/partidas/asistenciaDiaria/'+ id;
    $('#listaTrabProy').DataTable({
      processing: false,
            serverSide: true,
            ajax: url,
            order: [[2, "desc"]], 
            lengthMenu: [[10, 25, 50, -1], [10, 25, 50, 'TODO']],
            "sDom": 'TRfrtlip',
            "oTableTools": {
          "sSwfPath": "//cdn.datatables.net/tabletools/2.2.2/swf/copy_csv_xls_pdf.swf",
          "aButtons": [
            {
              "sExtends": "xls",
              "sButtonText": 'Exportar ',
              "sFileName": "Asistencia_Trabajadores - *.csv",
               "mColumns": [0, 1, 2, 3],
              "aButtons": [ "xls" ]
            }
            ]
        },
           
              language: {
              url: 'https://cdn.datatables.net/plug-ins/1.10.12/i18n/Spanish.json'
          },
            columns: [
                
                {data: 'nombre', render: function(data, type, full, meta){
                  return full.nombre + ' ' + full.ap_paterno;

                } , name: 'trabajador.nombre'},
                {data: 'presente', render:  function(data, type, row) {
                                if (data === '1') {
                                return 'Si';
                                  } else {
                                return 'No';
                              }}, name: 'asistencia.presente'},
                {data: 'fecha', render:function (value) {
                        if (value === null) return "";
                        return moment(value).format('L');
                 }, name: 'asistencia.fecha'},
                {data: 'name', name: 'usuario.name'},
    
            ],
        initComplete: function () {
            this.api().columns().every( function () {
                var column = this;
                var select = $('<select><option value=""></option></select>')
                    .appendTo( $(column.footer()).empty() )
                    .on( 'change', function () {
                        var val = $.fn.dataTable.util.escapeRegex(
                            $(this).val()
                        );
 
                        column
                            .search( val ? '^'+val+'$' : '', true, false )
                            .draw();
                    } );
 
                column.data().unique().sort().each( function ( d, j ) {
                    select.append( '<option value="'+d+'">'+d+'</option>' )
                } );
            } );
        }
    });
$('#id_trabajador').on('change', function(e) {
        var e = document.getElementById("id_trabajador");
        var id_obra = "<?php echo $obra->id; ?>";
        var valorid = e.options[e.selectedIndex].value;
        var url = 'https://aragonltda.cl/partidas/graficoAsistenciaDiaria/'+ valorid+'/'+id_obra;

        
  $.getJSON(url, function (result) {

    var  data2=[], data3=[], data4=[], data1=[];
    for (var i = 0; i < result.length; i++) {

        data1.push(result[i].nombre);
        data2.push(result[i].apellido);
	data3.push(moment((result[i].fecha)).format('L'));
        data4.push(result[i].presente);
    }
	
    var buyerData = {
      labels : data3,
      datasets : [

        {
          label: "Asistencia Semanal "+data1[0]+" "+data2[0],
          backgroundColor: ["#3e95cd", "#8e5ea2","#3cba9f","#e8c3b9","#c45850", "#99ff33", "#660033"],
          borderColor : 'rgba(75, 192, 192, 1)',
          data : data4
        }
      ]
    };
    var buyers = document.getElementById('projects-graph').getContext('2d');
    
    var chartInstance = new Chart(buyers, {
    type: 'bar',
    data: buyerData, 
    options: {
       scales: {

          xAxes: [{
            gridLines:{
              display: false
            }
            
      }],
    }
  },
    
    });

  });

});
 });

          </script>

         
            
   
          

@stop

@extends ('layout3')
@section ('title') Monto Ofertado  @stop

@section ('breadcrumbs')

                <ul class="breadcrumb a">
                  <li class="active">
                    <p>Inicio</p>
                  </li>
                  <li><a href="" class="active">Gráficos Licitaciones</a>
                  </li>
                <li><a href="">Montos Ofertados</a>
                  </li>

                </ul>
 @stop
@section ('content')
<script src='https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.1/Chart.bundle.min.js'></script>
<!-- Agregar acá tabla con datos -->
<div  class="panel panel-transparent">
              <div class="panel-heading">
                <div class="panel-title"> Montos Ofertados 
                </div>
                <div class="export-options-container pull-right"></div>
                <div class="clearfix"></div>
              </div>
              <div  class="panel-body">

<br>
          {!! Form::label('proyecto', 'Seleccionar Obra') !!}
           {!! Form::select('proyecto', $proyectos, ['0' => 'Todos'], array('class' => 'form-control', 'id' => 'proyecto')) !!}
<br>           
<canvas id="projects-graph" width="1400" height="600"></canvas>
<br>

  <table id="listaOfertados" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
              <thead>
                <tr>
                <th>Proyecto</th>
                <th>Contratista</th>
                <th>Mandante</th> 
                <th>Fecha</th>
                <th>Monto</th>
                </tr>
              </thead>
              <tfoot>
                    <tr>
                      <td></td>
                      <td></td>
                      <td></td>
                      <td></td>
		                  <td></td>
                    </tr>
                  </tfoot>
              </table>
              </div>
            </div>
            <br>

           <br>

</script>

<script type="text/javascript" src="{{ URL::asset('assets/plugins/moment/moment-with-locales.min.js') }}"></script>
<script type="text/javascript" src="{{ URL::asset('assets/plugins/accounting/accounting.min.js') }}"></script>

<script type="text/javascript">
              $(document).ready(function() {
    var url = 'https://aragonltda.cl/reportes/montoOferta';
    $('#listaOfertados').DataTable({
      processing: false,
            serverSide: true,
            ajax: url,
            order: [[2, "desc"]], 
	    "iDisplayLength": -1,
            lengthMenu: [[10, 25, 50, -1], [10, 25, 50, 'TODO']],
            "sDom": 'TRfrtlip',
            "oTableTools": {
          "sSwfPath": "//cdn.datatables.net/tabletools/2.2.2/swf/copy_csv_xls_pdf.swf",
          "aButtons": [
            {
              "sExtends": "xls",
              "sButtonText": 'Exportar ',
              "sFileName": "Ofertas_Obras - *.csv",
               "mColumns": [0, 1, 2, 3, 4],
              "aButtons": [ "xls" ]
            }
            ]
        },
           
              language: {
              url: 'https://cdn.datatables.net/plug-ins/1.10.12/i18n/Spanish.json'
          },
            columns: [
                
                {data: 'obra',  name: 'proyecto.nombre'},
                {data: 'contratista', name: 'contratista.nombre'},
                {data: 'mandante', name: 'mandante.nombre'},
                {data: 'fecha', render:function (value) {
                        if (value === null) return "";
                        return moment(value).format('L');
                 }, name: 'proyecto_contratista.fecha_oferta'},
                {data: 'monto', render: function(value) {
                      return accounting.formatMoney(value, "$", 0, ",", ".");
                 }, name: 'proyecto_contratista.monto_ofertado'},

    
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
    } );
       
       });

$('#proyecto').on('change', function(e) {
        var e = document.getElementById("proyecto");
        var id_obra = e.options[e.selectedIndex].value;
        var url = 'https://aragonltda.cl/reportes/montoOfertado/'+ id_obra;

  $.getJSON(url, function (result) {

    var labels = [],data1=[], data2=[], data3=[], data4=[];
    for (var i = 0; i < result.length; i++) {

        labels.push(result[i].contratista);
        data1.push(result[i].monto);
        data2.push(moment((result[i].fecha)).format('L'));
        data3.push(result[i].mandante);
        data4.push(result[i].obra);
    }


    var buyerData = {
      labels : labels,
      datasets : [
        {
          label: "Monto",
          backgroundColor : 'rgba(255, 99, 132, 0.2)',
          borderColor : 'rgba(255,99,132,1)',
          data : data1
        }
      ]
    };

    
    var buyers = document.getElementById('projects-graph').getContext('2d');
    
    var chartInstance = new Chart(buyers, {
    type: 'line',
    data: buyerData, 
    options: {
    scales: {
        yAxes: [
            {
                ticks: {
                    callback: function(data1) {
                        return     accounting.formatMoney(data1, "$", 0, ",", ".");
                    }
                },
            }
        ]
    },
     tooltips: {
        callbacks: {
            label: function(tooltipItem, data1) {
                return "$" + Number(tooltipItem.yLabel).toFixed(0).replace(/./g, function(c, i, a) {
                    return i > 0 && c !== "," && (a.length - i) % 3 === 0 ? "." + c : c;
                });
            }
        }
    }
}


    });


  });

});
          </script>

@stop



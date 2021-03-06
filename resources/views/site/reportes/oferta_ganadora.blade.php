@extends ('layout3')
@section ('title') Monto Ofertado  @stop

@section ('breadcrumbs')

                <ul class="breadcrumb a">
                  <li class="active">
                    <p>Inicio</p>
                  </li>
                  <li><a href="" class="active">Gráficos Licitaciones</a>
                  </li>
                <li><a href="">Total v/s Oferta Ganadora</a>
                  </li>

                </ul>
 @stop

@section ('content')
<script src='https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.1/Chart.bundle.min.js'></script>

<div  class="panel panel-transparent">
    <div class="panel-heading">
      <div class="panel-title"> Total v/s Oferta Ganadora </div>
        <div class="export-options-container pull-right"></div>
        <div class="clearfix"></div>
    </div>
     <div  class="panel-body">


  @php
  $role = App\Models\Comuna::where('id', '>', '5000')->pluck('nombre', 'id');
  $role['0'] = 'Todos'; 
  $emp =  App\Models\Empresa::pluck('nombre', 'id');
  $emp['0'] = 'Todos'; 
  @endphp 

       {!! Form::label('mand', 'Filtrar por: Mandante') !!}
           {!! Form::select('mand', $emp, ['0' => 'Todos'], array('class' => 'form-control', 'id' => 'mand')) !!}

           <br>
           {!! Form::label('com', 'Filtrar por: Comuna') !!}
           {!! Form::select('com', $role, ['0' => 'Todos'], array('class' => 'form-control', 'id' => 'com')) !!}
           <br>
        
          {!!Form::label('tipo_proyecto', 'Tipo de Licitación')!!}
          {!!Form::select('tipo_proyecto', array(
          'Pavimento Participativo' => 'Pavimento Participativo', 
            'Mejoramiento Vía' => 'Mejoramiento Vía', 
            'Reconstrucción' => 'Reconstrucción',
            'Espacios Públicos' => 'Espacios Públicos',
            'Saneamiento'  => 'Saneamiento',
            'Pavimentación Calzada' => 'Pavimentación Calzada',
            'Hormigón' => 'Hormigón',
            'Pavimentación Asfalto' => 'Asfalto',
            'Aceras' => 'Aceras'), null, ['id' =>'tipo_proyecto', 'class' => 'form-control']) !!}
      
            <br>
           <div class="col-xs-6 col-md-4"> <br> <p  id="button" class="btn btn-default btn-sm m-t-10"> Buscar </p></div>

    <br>           
      <canvas id="projects-graph" width="1400" height="600"></canvas>
    <br>

    </div>
</div>
<script type="text/javascript" src="{{ URL::asset('assets/plugins/accounting/accounting.min.js') }}"></script>

<script type="text/javascript">
$(document).ready(function() {

  $('#button').click(function() {

   $('#projects-graph').replaceWith('<canvas id="projects-graph"></canvas>');

    var a = document.getElementById('mand');
    var mandante = a.options[a.selectedIndex].value;

        var b = document.getElementById('com');
        var comuna = b.options[b.selectedIndex].value;

        var c = document.getElementById('tipo_proyecto');
        var tipo = c.options[c.selectedIndex].value;

        var url = 'https://aragonltda.cl/reportes/montoOfertado2/'+ mandante +'/'+ comuna +'/'+ tipo;

        $.getJSON(url, function (result) {
          console.log(result);
          var labels=[], data1=[], data2=[];

          for (var i = 0; i < result.length; i++) {
            labels.push(result[i].obra);
            data1.push(result[i].monto);
            data2.push(result[i].total);
          
        }

          var buyerData = {
            labels : labels,
            datasets : [
            {
              label: "Obras",
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
    },

            legend: {
                        display: true,
                        labels: {
                            fontColor: "#000080",
                        }
                    }
          },
            
            });



        });


  });
});
</script>
@stop

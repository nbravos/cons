@extends ('layout3')

@section ('breadcrumbs')

                <ul class="breadcrumb a">
                  <li class="active">
                    <p>Inicio</p>
                  </li>
                  <li><a href="" class="active">Obra</a>
                  </li>
                <li><a href="">Obras de Licitación </a>
                  </li>

                </ul>
 @stop

@section ('content')

<!-- Agregar acá tabla con datos -->
<div  class="panel panel-transparent">
              <div class="panel-heading">
                <div class="panel-title">Obras de Licitación 
                </div>
                <div class="export-options-container pull-right"></div>
                <div class="clearfix"></div>
              </div>
              <div  class="panel-body">
  <table id="listaPartPro" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
              <thead>
                <tr>
                <th>Número</th>
                <th>Obras</th>
                <th>Detalle</th> 
                <th>Fecha Inicio</th>
                </tr>
              </thead>
              <tfoot>
                    <tr>
                      <td class="non_searchable"></td>
                      <td></td>
                      <td></td>
                      <td></td> 
                    </tr>
                  </tfoot>
              </table>
              </div>
            </div>


                  <p>
<a href="{!!route('proyectos.index')!!}" class="btn btn-primary">Volver</a>
<br>
<br>

</p>

<script type="text/javascript">
              $(document).ready(function() {
               $('#listaPartPro').DataTable({
            processing: false,
            serverSide: true,
            ajax: '{!! route('verPart', ['id' =>  $proy->id]) !!}',
            order: [[3, "desc"]], 
            lengthMenu: [[10, 25, 50, -1], [10, 25, 50, 'TODO']],
            "sDom": 'Rfrtlip',
            language: {
              url: 'https://cdn.datatables.net/plug-ins/1.10.12/i18n/Spanish.json'
          },
            columns: [

              {data: 'id', name: 'partida.id', visible: false},
                {data: 'partNombre', name: 'partida.nombre'},
                {data: 'detalle', name:'partida.detalle'},
                {data: 'inicio_real', name: 'partida.inicio_real'}    
            ],
            
        });
              $('#listaPartPro tfoot tr').appendTo('#listaPartPro thead');
       });

          </script>
              

@stop


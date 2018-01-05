@extends ('layout3')

@section ('title') {!! $proyecto->nombre !!}  @stop
@section ('breadcrumbs')

                <ul class="breadcrumb a">
                  <li class="active">
                    <p>Inicio</p>
                  </li>
                  <li><a href="" class="active">Licitaciones</a>
                  </li>
                <li><a href="">{{ $proyecto->nombre }}</a>
                  </li>

                </ul>
 @stop
@section ('content')


        <h1> <strong> {!! $proyecto->nombre!!} </strong> </h1> 

<a href="{{ route('addof', ['id' =>  $proyecto->id]) }}" class="btn btn-primary">Agregar Oferta</a>
<!--<a href="{{ route('verPart', ['id' =>  $proyecto->id]) }}" class="btn btn-primary">Ver Obras </a>-->
<!--<a href="{{ route('addTrab', ['id' =>  $proyecto->id]) }}" class="btn btn-primary">Agregar Cuadrilla </a>-->


<!-- <a href="/ofertas/create/'.$proyecto->id.'" class="btn btn-primary"> Oferta</a>-->
<table class="table table-striped table-bordered dt-responsive nowrap">
                    <tbody>
                      <tr>
                        <td> <strong>Nombre </strong></td>
                        <td>{!!$proyecto->nombre!!}</td>
                      </tr>
                       <tr>
                        <td><strong>ID</strong></td>
                        <td>{!!$proyecto->ide!!}</td>
                      </tr>
                      <tr>
                        <td><strong>Empresa</strong> </td>
                        <td>{!!$proyecto->id_empresa!!}</td>
                      </tr>
                      <tr>
                        <td><strong> Comuna</strong></td>
                        <td>{!!$proyecto->comuna->nombre!!}</td>
                      </tr>
                       <tr>
                        <td><strong>Tipo Proyecto</strong></td>
                        <td>{!!$proyecto->tipo_proyecto!!}</td>
                      </tr>
                    <tr>
                        <td><strong>Vigencia</strong></td>
                        @if ($proyecto->activo == 1)
                        <td> Proyecto Activo </td>
                        @else
                        <td> Proyecto No Vigente</td>
                        @endif
                      </tr>
                        <tr>
                        <td><strong>Tipo de Licitación</strong></td>
                        <td>{!!$proyecto->tipo_licitacion!!}</td>
                      </tr>
                      <tr>
                        <td><strong>Estado de Proyecto</strong></td>
                        <td>{!!$proyecto->estado!!}</td>
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
                        <td><strong> Fecha de Licitación </strong></td>
			 <td>{!!date('d-m-Y', strtotime($proyecto->fecha_licitacion))!!}</td>                       
                      </tr>
                     
                    </tbody>
                  </table>
                  <p>

<!-- Agregar acá tabla con datos -->
<div  class="panel panel-transparent">
              <div class="panel-heading">
                <div class="panel-title">Listado de Ofertas
                </div>
                <div class="export-options-container pull-right"></div>
                <div class="clearfix"></div>
              </div>
              <div  class="panel-body">
  <table id="listaOf" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
              <thead>
                <tr>
                <th>Número</th>
                <th>Empresa</th>
                <th>Monto Ofertado</th> 
                <th>Plazo (días)</th>
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

                    </tr>
                  </tfoot>
              </table>
              </div>
            </div>

<a href="{!!route('proyectos.index')!!}" class="btn btn-primary">Volver</a>
<a href="{!!route('proyectos.edit', $proyecto->id)!!}" class="btn btn-primary">Editar</a>
<br>
<br>
{!! Form::model($proyecto, array('route' => array('proyectos.destroy', $proyecto->id), 'method' => 'DELETE', 'onsubmit' => 'return ConfirmDelete()'), array('role' => 'form')) !!}
  {{ Form::submit('Eliminar Proyecto', array('class' => 'btn btn-danger')) }}
{!! Form::close() !!}
</p>

<script>

  function ConfirmDelete()
  {
  var x = confirm("Desea eliminar el proyecto?");
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
            ajax: '{!! route('verof', ['id' =>  $proyecto->id]) !!}',
            lengthMenu: [[10, 25, 50, -1], [10, 25, 50, 'TODO']],
            "sDom": 'TRfrtlip',
            "oTableTools": {
          "sSwfPath": "//cdn.datatables.net/tabletools/2.2.2/swf/copy_csv_xls_pdf.swf",
          "aButtons": [
            {
              "sExtends": "xls",
              "sButtonText": 'Exportar ',
              "sFileName": "Ofertas Proyecto - *.csv",
               "mColumns": [1, 2, 3],
              "aButtons": [ "xls" ]
            }
            ]
        },

            language: {
              url: 'https://cdn.datatables.net/plug-ins/1.10.12/i18n/Spanish.json'
          },
            columns: [
                {data: 'id', name: 'proyecto_contratista.id', visible: false},
                {data: 'mand', name:'empresa.nombre'},
                {data: 'montOf',  render: function ( data, type, row ) {
                  return $.fn.dataTable.render.number( '.', '.', 0, '$' ).display(data) ;
                }, name: 'proyecto_contratista.monto_ofertado as montOf', title: 'Monto Ofertado'},
                {data: 'diasOf', name: 'proyecto_contratista.dias'},
		{data: 'action', name: 'action', orderable: false, searchable: false}    
            ],
            
        });
              $('#listaOf tfoot tr').appendTo('#listaOf thead');
       });

          </script>

@stop



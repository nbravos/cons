 
@extends ('layout3')

@section ('title') Lista de Usuarios @stop

@section ('content')
 

         <div class="container-fluid container-fixed-lg bg-white">
            <!-- START PANEL -->
            <div class="panel panel-transparent">
              <div class="panel-heading">
                <div class="panel-title">Usuarios
                </div>
                <div class="export-options-container pull-right"></div>
                <div class="clearfix"></div>
              </div>
              <div class="panel-body">
  <table id="listaUs" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
              <thead>
                <tr>
                <th>Nombre</th>
                 <th>Correo Electrónico</th>
                 <th>Acciones</th>
                 </tr>
              </thead>
              <tbody>
    @foreach ($users as $user)
<!--    <tr> -->
        <tr class="odd gradeX">
        <td>{!! $user->name !!}</td>
        <td>{!! $user->email !!}</td>
          <td><a href="{!! route('usuarios.show', $user->id) !!}" class="btn btn-info">
              Ver
          </a>
          <a href="{!! route('usuarios.edit', $user->id) !!}" class="btn btn-primary">
            Editar
          </a>
          </td>
           @endforeach
    </tr> 
      </tbody>
              </table>
              </div>
            </div>
          </div>
            {!! $users->links() !!}

            <!-- END PANEL -->
         <script type="text/javascript">
              $(document).ready(function() {
              $('#listaUs').DataTable({
                "oLanguage": { 
                  "sUrl": "//cdn.datatables.net/plug-ins/1.10.7/i18n/Spanish.json" }
                });
              });
          </script>
@stop 

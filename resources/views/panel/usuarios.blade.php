@extends('layouts.panel')
@section('Panelcontent')
<div class="panel panel-default">
  <div class="panel-heading">USUARIOS</div>
  <div class="panel-body">
    <a href="/crear-usuario" class="btn btn-success">Crear Usuario</a>
    <hr>
    @if (session('status'))
        <div class="alert alert-success">
            {{ session('status') }}
        </div>
    @endif
    <table class="table" id="usuarios">
      <thead>
        <tr>
          <th>#</th>
          <th>Nombre</th>
          <th>Rut</th>
          <th>Tipo Usuario</th>
          <th>Estado</th>
          <th>Acción</th>
        </tr>
      </thead>
      <tbody>
        @foreach($usuarios as $usuario)
        <tr>
          <td>{{ $loop->iteration }}</td>
          <td>{{ $usuario->name }}</td>
          <td>{{ $usuario->email }}</td>
          <td >
            @if(TipoDeAdmin($usuario->email) == 'ADMINISTRADOR')
              <p class="btn btn-xs" style="background-color:#BF00FF; color:white; width:100%; !important;">{{ TipoDeAdmin($usuario->email) }}</p>
            @else
              <p class="btn btn-xs" style="background-color:#DF01A5; color:white; width:100%; !important;">{{ TipoDeAdmin($usuario->email) }}</p>
            @endif
          </td>
          <td>
              @if($usuario->estado == 1)
              <span class="label label-success" style="font-size:12px;">Habilitado</span>
              @else
              <span class="label label-danger" style="font-size:12px;">Deshabilitado</span>
              @endif
          </td>
          <td><a href="/ver-usuario/{{ $usuario->id }}" class="btn btn-info btn-xs">Ver Más</a> |<a href="/editar-usuario/{{ $usuario->id }}" class="btn btn-warning btn-xs">Editar</a> | <a href="/habilitar-usuario/{{ $usuario->id }}" class="btn btn-success btn-xs"> Habilitar</a> | <a href="/desabilitar-usuario/{{ $usuario->id }}" class="btn btn-danger btn-xs"> Deshabilitar</a></td>
        </tr>
        @endforeach
      </tbody>
    </table>
  </div>
</div>
<script type="text/javascript">
$(document).ready(function() {
    $('#usuarios').DataTable( {
        "language": {
        "sProcessing":     "Procesando...",
        "sLengthMenu":     "Mostrar _MENU_ registros",
        "sZeroRecords":    "No se encontraron resultados",
        "sEmptyTable":     "Ningún dato disponible en esta tabla",
        "sInfo":           "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
        "sInfoEmpty":      "Mostrando registros del 0 al 0 de un total de 0 registros",
        "sInfoFiltered":   "(filtrado de un total de _MAX_ registros)",
        "sInfoPostFix":    "",
        "sSearch":         "Buscar:",
        "sUrl":            "",
        "sInfoThousands":  ",",
        "sLoadingRecords": "Cargando...",
        "oPaginate": {
            "sFirst":    "Primero",
            "sLast":     "Último",
            "sNext":     "Siguiente",
            "sPrevious": "Anterior"
        },
        "oAria": {
            "sSortAscending":  ": Activar para ordenar la columna de manera ascendente",
            "sSortDescending": ": Activar para ordenar la columna de manera descendente"
        }
      }
   });
});
</script>
@stop

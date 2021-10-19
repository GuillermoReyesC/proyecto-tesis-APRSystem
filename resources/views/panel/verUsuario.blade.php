@extends('layouts.panel')
@section('Panelcontent')
{!! Charts::assets() !!}
<div class="panel panel-default">
  <div class="panel-heading">Usuario</div>
  <div class="panel-body">
    <a href="javascript:history.back()" class="btn btn-warning">Volver</a>
    <hr>
    <div class="panel panel-default">
      <div class="panel-body">
      <h4>Mis datos</h4>
      @foreach($users as $user)
      <table class="table">
        <tr>
          <td><b>Nombre:</b></td>
          <td>{{ $user->name }}</td>
        </tr>
        <tr>
          <td><b>Rut:</b></td>
          <td>{{ $user->email }}</td>
        </tr>
        <tr>

        </tr>
        <tr>
          <td><b>Fecha de Entrada:</b></td>
          <td>{{ $user->created_at }}</td>
        </tr>
        <tr>
          <td><b>Fecha de Facturación:</b></td>
          <td> {{ $user->fecha_facturacion }} / de cada mes </td>
        </tr>
      </table>
      @endforeach
      <hr>
      {!! $chart->render() !!}
      </div>
    </div>
  </div>
</div>
@stop

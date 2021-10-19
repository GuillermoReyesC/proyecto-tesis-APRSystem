@extends('layouts.panel')
@section('Panelcontent')
<div class="panel panel-default">
  <div class="panel-heading">Panel de Administrador</div>
  <div class="panel-body">
  <div class="panel panel-default">
    <div class="panel-body">
    <h4>Mis datos</h4>
    <table class="table">
      <tr>
        <td><b>Nombre:</b></td>
        <td>{{ Auth::User()->name }}</td>
      </tr>
      <tr>
        <td><b>Rut:</b></td>
        <td>{{ Auth::User()->email }}</td>
      </tr>
      <tr>
      
      </tr>
      <tr>
        <td><b>Fecha de Entrada:</b></td>
        <td>{{ Auth::User()->created_at }}</td>
      </tr>
    </table>
    </div>
  </div>
  </div>
</div>
@stop

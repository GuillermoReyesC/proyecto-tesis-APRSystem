@extends('layouts.panel')
@section('Panelcontent')
<div class="panel panel-default">
  <div class="panel-heading">Historia de Facturación</div>
  <div class="panel-body">
      <table class="table table-hover">
        <thead>
          <tr>
            <th>#</th>
            <th>Rut</th>
            <th>Fecha de Facturación</th>
            <th>Monto Cancelado</th>
          </tr>
        </thead>
        <tbody>
          @foreach($historales as $historial)
          <tr>
            <td>{{ $loop->iteration }}</td>
            <td>{{ $historial->user }}</td>
            <td>{{ $historial->date }}</td>
            <td>{{ $historial->monto }}</td>
          </tr>
          @endforeach
        </tbody>
      </table>
  </div>
</div>
@stop

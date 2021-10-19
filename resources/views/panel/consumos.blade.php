@extends('layouts.panel')
@section('Panelcontent')
<div class="panel panel-default">
  <div class="panel-heading">Consumos</div>
  <div class="panel-body">
    {!! Charts::assets() !!}
    {!! $charts->render() !!}
  </div>
</div>
@stop

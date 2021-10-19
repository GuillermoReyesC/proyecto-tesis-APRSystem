@extends('layouts.panel')
@section('Panelcontent')
<div class="panel panel-default">
  <div class="panel-heading">Panel de Control</div>
  <div class="panel-body">
    <!-- Widgets -->
    @if(Auth::User()->estado == 1)
    <div class="row clearfix">
        <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
            <div class="info-box bg-pink hover-expand-effect">
                <div class="icon">
                    <i class="material-icons">whatshot</i>
                </div>
                <div class="content">
                    <div class="text">TOTAL A PAGAR</div>
                    <div class="number">$ {{ number_format(Subsidio(Auth::User()->email)) }}</div>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
            <div class="info-box bg-cyan hover-expand-effect">
                <div class="icon">
                    <i class="material-icons">help</i>
                </div>
                <div class="content">
                    <div class="text">m3</div>
                    <div class="number">{{ number_format(TotalLitrosPorHora(Auth::User()->email) / 36000) }}</div>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
            <div class="info-box bg-light-green hover-expand-effect">
                <div class="icon">
                    <i class="material-icons">forum</i>
                </div>
                <div class="content">
                    <div class="text">Subsidio</div>
                    <div class="number">$ {{ number_format(Subsidio(Auth::User()->email)) }}</div>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
            <div class="info-box bg-orange hover-expand-effect">
                <div class="icon">
                    <i class="material-icons">attach_money</i>
                </div>
                <div class="content">
                    <div class="text">TOTAL MES</div>
                    <div class="number">{{ number_format(CalcularGastoEnPesos(Auth::User()->email)) }}</div>
                </div>
            </div>
        </div>
    </div>
    <!-- #END# Widgets -->
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
      <tr>
        <td><b>Fecha de Facturación:</b></td>
        <td> {{ Auth::User()->fecha_facturacion }} / de cada mes </td>
      </tr>
    </table>
    </div>
  </div>
  @else
  <div class="alert alert-warning">
      Su cuenta ha sido suspendida, por favor contacte con el administrador..
  </div>
  @endif
  </div>
</div>
@stop

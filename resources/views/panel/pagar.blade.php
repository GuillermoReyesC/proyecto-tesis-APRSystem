@extends('layouts.panel')
@section('Panelcontent')
<div class="panel panel-default">
  <div class="panel-heading">Metodo de Pago ->  </div>
  <div class="panel-body">
    <img src="{{URL::asset('img/webpay-456x200.png')}}" alt="">
    <hr>
    <h4 style="margin-left:50px;">Cancela: $ {{ number_format(CalcularGastoEnPesos(Auth::User()->email) - Subsidio(Auth::User()->email)) }} CLP</h4>
    <hr>
    <h4 style="margin-left:50px;">Cuotas: 48 Cuotas Precio contado.</h4>
    <hr>
    <a style="margin-left:50px;" href="javascript:history.back();" class="btn btn-warning btn-lg">VOLVER</a>
    <a  href="/pay" class="btn btn-success btn-lg">PAGAR</a>
  </div>
</div>
@stop

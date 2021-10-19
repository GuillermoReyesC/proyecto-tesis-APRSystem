@extends('layouts.panel')
@section('Panelcontent')
<div class="panel panel-default">
  <div class="panel-heading">Historial de Facturación</div>
  <div class="panel-body">
    <a href="/historial-de-facturacion" class="btn btn-success">Ver Historial</a>
    <hr>
    @if (session('status'))
        <div class="alert alert-success">
            {{ session('status') }}
        </div>
    @endif
    @if(empty($facturacion))
      <div class="alert alert-dismissible alert-warning">
        <button type="button" class="close" data-dismiss="alert">&times;</button>
        Sin deuda pendiente!
      </div>
     @else
     @if(empty(buscarFactura(Auth::User()->email)))
       <div class="card border-dark">
       <div class="card-body" style="padding:15px;">
         <table class="table" style="width:50%;">
           <thead>
             <tr>
               <td> <h4>Facturación</h4> </td>
             </tr>
           </thead>
           <tbody>
             <tr>
               <td>Fecha de Facturación:</td>
               <td>{{ date('d-m-Y h:i:s') }}</td>
             </tr>
             <tr>
               <td>Metros Cubicos Consumidos:</td>
               <td>{{ number_format(TotalLitrosPorHora(Auth::User()->email) / 3600 / 0.001) }}</td>
             </tr>
             <tr>
               <td>Total del Mes :</td>
               <td>{{ number_format(CalcularGastoEnPesos(Auth::User()->email)) }}</td>
             </tr>
             <tr>
               <td>Subsidio : </td>
               <td>{{ number_format(Subsidio(Auth::User()->email)) }}</td>
             </tr>
             <tr>
               <td><b>Total a Pagar :</b></td>
               <td><b>{{ number_format(CalcularGastoEnPesos(Auth::User()->email) - Subsidio(Auth::User()->email)) }}</b></td>
             </tr>
             <tr>
               <td></td>
               <td> <a href="javascript:history.back();" class="btn btn-warning btn-lg">VOLVER</a> <a href="/metodo-de-pago" class="btn btn-success btn-lg">CONTINUAR</a> </td>
             </tr>
           </tbody>
         </table>
       </div>
     </div>
     @else
     <div class="alert alert-dismissible alert-warning">
       <button type="button" class="close" data-dismiss="alert">&times;</button>
        Sin deuda pendiente!
     </div>
     @endif
    @endif
  </div>
</div>
@stop

<?php

use Carbon\Carbon;
use App\Facturacion;
use App\Medicion;

function ObtenerRut($id){
  $rut = DB::table('facturacion')->where('id', $id)->select('user')->first();
  return $rut->user;
}

function ContarSubsidios($id) {
  $total = DB::table('users')->where('subsidio', $id)->count();
  return $total;
}

function TotalUsuarios($id) {

  if($id == 1)
  $users = DB::table('users')->count();
  else
  $users = DB::table('users')->where('admin', 0)->count();
  return $users;
}

function Alerta($fecha_facturacion) {
  $day = Carbon::now()->day;
  $date = Facturacion::where('user', '=', Auth::User()->email)->count();
  if(!$date)
  {
    return true;
  }
}

function GetMonths() {
  $months = ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'];
  return $months;
}

function RetornarIngresoMensual($id) {

   $total = 0;

   $facturacion = Facturacion::all();

   foreach ($facturacion as $value) {
     $dt = Carbon::parse($value->date);
     if($dt->month == $id){
       $total = $total + $value->monto;
     }
   }

   return $total;

}

function RetornarIngresoMensualM3($id) {

   $total = 0;

   $facturacion = Facturacion::all();

   foreach ($facturacion as $value) {
     $dt = Carbon::parse($value->date);
     if($dt->month == $id){
       $total = $total + $value->monto;
     }
   }

   return $total / 160;

}

function IngresoMensualM3() {

   $total = 0;

   $facturacion = Facturacion::all();

   foreach ($facturacion as $value) {
       $total = $total + $value->monto;
   }

   return $total / 160;

}

function IngresoTotal() {

   $total = 0;

   $facturacion = Facturacion::all();

   foreach ($facturacion as $value) {
       $total = $total + $value->monto;
   }

   return $total;

}

function TotalPorMes($mes) {
  $total = 0;
  $now  = Carbon::now();
  $user = Auth::User()->email;
  $find = DB::table('facturacion')->where('user', $user)->get();
  foreach ($find as $value) {
    $dt = Carbon::parse($value->date);
      if($dt->month == $mes) {
         $total = $total + $value->monto;
      }
    }
    return $total;
}

function TmU($mes, $user) {
  $total = 0;
  $now  = Carbon::now();
  $find = DB::table('facturacion')->where('user', ObtenerRut($user))->get();
  foreach ($find as $value) {
    $dt = Carbon::parse($value->date);
      if($dt->month == $mes) {
         $total = $total + $value->monto;
      }
    }
    return $total;
}

function buscarFactura($user) {
  $now  = Carbon::now();
  $find = DB::table('facturacion')->where('user', $user)->where('date', '<=', $now)->count();
  return $find;
}

function TipoDeAdmin($user) {

  $tipo = DB::table('users')->where('email', $user)->select('admin')->first();

  switch ($tipo->admin) {
    case 0:
      $tipo_usuario = 'CLIENTE';
      break;

    case 1:
      $tipo_usuario = 'ADMINISTRADOR';
        break;

    case 1:
      $tipo_usuario = 'SECRETARIA';
        break;
  }

  return $tipo_usuario;

}

function totalGeneral() {

  $vueltas = 0;
  $totalLitrosPorHora = null;

  $totalLitros = DB::table('medicion')
  ->where('id_sensor', 1)
  ->get();

  foreach ($totalLitros as $value) {
    if($value->dato > 0)
      $totalLitrosPorHora = $totalLitrosPorHora + $value->dato;
      $vueltas = $vueltas + 1;
  }

  $TotalLitrosPorSegundo = $totalLitrosPorHora / 3600 ;
  $MetrosCubicosXseg = $TotalLitrosPorSegundo / 0.001;

  $MetrosCubicos = $MetrosCubicosXseg / 1000;

  $valorGastado = $MetrosCubicosXseg  * 0.0025;

  return $valorGastado;
}


function Subsidio($user) {
  $costoFijo = 3000;
  $metroCubicobaseSubsidio = 1580;
  $vueltas = 0;
  $totalLitrosPorHora = null;

  $totalLitros = DB::table('medicion')
  ->where('id_sensor', Auth::User()->id_sensor)
  ->get();

  foreach ($totalLitros as $value) {
    if($value->dato > 0)
      $totalLitrosPorHora = $totalLitrosPorHora + $value->dato;
      $vueltas = $vueltas + 1;
  }

  $horas = $vueltas;

  $TotalLitrosPorSegundo = $totalLitrosPorHora / 3600 ;
  $MetrosCubicosXseg = $TotalLitrosPorSegundo / 0.001;

  $MetrosCubicos = $MetrosCubicosXseg / 1000;

  $valorGastado = $MetrosCubicosXseg  * 0.017;

  if($MetrosCubicos < 15)
    $descuento = ($valorGastado + $costoFijo) / 2;

  else
    $descuento = 2700;

    return $valorGastado + $costoFijo - $descuento;
}

function CalcularGastoEnPesos($user){

  $costoFijo = 3000;
  $metroCubicobaseSubsidio = 1580;
  $vueltas = 0;
  $totalLitrosPorHora = null;

  $totalLitros = DB::table('medicion')
  ->where('id_sensor', Auth::User()->id_sensor)
  ->get();

  foreach ($totalLitros as $value) {
    if($value->dato > 0)
      $totalLitrosPorHora = $totalLitrosPorHora + $value->dato;
      $vueltas = $vueltas + 1;
  }

  $horas = $vueltas;

  $TotalLitrosPorSegundo = $totalLitrosPorHora / 3600 ;
  $MetrosCubicosXseg = $TotalLitrosPorSegundo / 0.001;

  $MetrosCubicos = $MetrosCubicosXseg / 1000;

  $valorGastado = $MetrosCubicosXseg  * 0.017;

  if($MetrosCubicos < 15)
    $descuento = ($valorGastado + $costoFijo) / 2;

  else
    $descuento = 2700;

  return $valorGastado + $costoFijo;

}

function TotalLitrosPorHora($user) {
  $totalLitrosPorHora = null;
  $totalLitros = DB::table('medicion')
    ->where('id_sensor', Auth::User()->id_sensor)
  ->get();

  foreach ($totalLitros as $value) {
    if($value->dato > 0)
      $totalLitrosPorHora = $totalLitrosPorHora + $value->dato;
  }

  return $totalLitrosPorHora;

}

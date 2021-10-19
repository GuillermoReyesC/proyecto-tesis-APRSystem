<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Medicion;
use App\Facturacion;
use App\User;
use Charts;
use DB;
use Auth;
use Carbon\Carbon;


class PanelController extends Controller
{

    public function reportes() {

      $chart = Charts::realtime(route('data'), 1000, 'line', 'highcharts')
			->setResponsive(true)
      ->setTitle('Lts/H x Seg')
			->setWidth(0);

      $chart2 = Charts::realtime(route('data'), 1000, 'gauge', 'google')
            ->setelementLabel('Lts/H')
            ->setvalues([0, 0,800])
            ->setLabels(['First', 'Second', 'Third'])
            ->setResponsive(true)
            ->setTitle("Lts/H x Seg");

      $chart3 = Charts::database(User::all(), 'bar', 'highcharts')
            ->setElementLabel("Total")
            ->setDimensions(1000, 500)
            ->setResponsive(true)
            ->setTitle('Total de Usuarios por Mes')
            ->groupByMonth(Carbon::now()->year, true);

      $chart4 = Charts::create('bar', 'highcharts')
			->setTitle('Total Ingreso Anual: '. number_format(IngresoTotal()) )
			->setLabels(GetMonths())
      ->setElementLabel("Total Ingresos por Mes")
			->setValues([RetornarIngresoMensual(1),RetornarIngresoMensual(2),RetornarIngresoMensual(3),RetornarIngresoMensual(4),RetornarIngresoMensual(5),RetornarIngresoMensual(6),RetornarIngresoMensual(7),RetornarIngresoMensual(8),RetornarIngresoMensual(9),RetornarIngresoMensual(10),RetornarIngresoMensual(11),RetornarIngresoMensual(12)])
			->setDimensions(1000,500)
			->setResponsive(true);

      $chart5 = Charts::create('area', 'highcharts')
			->setTitle('Total Ingreso Anual m3: '. IngresoMensualM3())
			->setLabels(GetMonths())
      ->setElementLabel("Total Ingresos por Mes m3")
			->setValues([RetornarIngresoMensualM3(1),RetornarIngresoMensualM3(2),RetornarIngresoMensualM3(3),RetornarIngresoMensualM3(4),RetornarIngresoMensualM3(5),RetornarIngresoMensualM3(6),RetornarIngresoMensualM3(7),RetornarIngresoMensualM3(8),RetornarIngresoMensualM3(9),RetornarIngresoMensualM3(10),RetornarIngresoMensualM3(11),RetornarIngresoMensualM3(12)])
			->setDimensions(1000,500)
			->setResponsive(true);

      $chart6 = Charts::create('pie', 'highcharts')
            ->setelementLabel('Lts/H')
            ->setvalues([ContarSubsidios(1), ContarSubsidios(0)])
            ->setLabels(['Con subsidios', 'Sin Subsidio'])
            ->setResponsive(true)
            ->setTitle("Cantidad de usuarios con y sin subsidios");

      return view('panel/reportes', ['chart' => $chart, 'chart2' => $chart2, 'chart3' => $chart3, 'chart4' => $chart4, 'chart5' => $chart5, 'chart6' => $chart6]);

    }

    public function insert($id_sensor, $dato) {

      $medicion = New Medicion;
      $medicion->id_sensor= $id_sensor;
      $medicion->dato = $dato;
      $medicion->save();

    }

    public function admin() {
      return view('panel/admin');
    }

    public function usuarios() {
      $users = User::all();
      return view('panel/usuarios', ['usuarios' => $users]);
    }

    public function crearUsuario() {
      $sensores = DB::table('sensor')->where('estado', 0)->get();
      return view('panel/crearUsuario', ['sensores' => $sensores]);
    }


    public function datos() {
      $sensor_produccion = DB::table('medicion')->where('id_sensor', '1')->orderBy('id', 'desc')->first()->dato;
      return ['value' => $sensor_produccion];
    }

    public function facturacion() {
      $user = User::all();
      $now = Carbon::now()->day;
      if($now == Auth::User()->fecha_facturacion)
        {
          return view('panel/facturacion', ['facturacion' => $user]);
        }
      else
      {
          return view('panel/facturacion');
      }
    }

    public function pagar() {
      return view('panel/pagar');
    }

    public function pay() {

      $user = Auth::User()->email;

      $facturacion = new Facturacion;
      $facturacion->user = $user;
      $facturacion->date = Carbon::now(+1);
      $facturacion->monto = CalcularGastoEnPesos(Auth::User()->email) - Subsidio(Auth::User()->email);
      $facturacion->save();

      return redirect('/facturacion')->with('status', 'La transacción se ha realizado exitosamente!');
    }

    public function historialFacturacion() {
      $user = Auth::User()->email;
      $select = DB::table('facturacion')->where('user', $user)->get();
      return view('panel/historial', ['historales' => $select]);
    }

    public function consumos() {
    // to display a specific year, pass the parameter. For example to display the months of 2016 and display a fancy output label:
    $chart = Charts::create('bar', 'highcharts')
        ->settitle('Total por Mes')
        ->setelementLabel('Gasto Mensual $')
        ->setlabels(['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio','Julio','Agosto','Septiembre','Octubre','Noviembre','Diciembre'])
        ->setvalues([TotalPorMes(1),
        TotalPorMes(2),TotalPorMes(3),TotalPorMes(4),TotalPorMes(5),TotalPorMes(6),TotalPorMes(7),TotalPorMes(8),TotalPorMes(9),TotalPorMes(10),TotalPorMes(11),TotalPorMes(12)])
        ->setdimensions(1000,500)
        ->setresponsive(true);

        return view('panel/consumos', ['charts' => $chart]);

    }

    public function Registro(Request $request) {

        $registro = New User;
        $registro->name = $request['name'];
        $registro->email = $request['email'];
        $registro->password = bcrypt($request['password']);
        $registro->subsidio = $request['subsidio'];
        $registro->admin = $request['tipo_usuario'];
        $registro->telefono = $request['telefono'];
        $registro->direccion = $request['direccion'];
        $registro->fecha_facturacion = $request['fecha_facturacion'];
        $registro->id_sensor = $request['sensor'];
        $registro->save();

        DB::table('sensor')->where('id', $request['sensor'])->update(['estado' => 1]);

        return redirect('/crear-usuario')->with('status', 'El usuario se ha creado exitosamente.');
    }

    public function editarUsuario($id) {
      $users = DB::table('users')->where('id', $id)->get();
      $sensores = DB::table('sensor')->get();
      return view('panel/editarUsuario', ['sensores' => $sensores, 'usuarios' => $users]);
    }

    public function ActualizarUsuario(Request $request) {

          $registro = User::find($request['id_usuario']);
          $registro->name = $request['name'];
          $registro->email = $request['email'];
          if($request['password'] == true){
            $registro->password = bcrypt($request['password']);
          }
          $registro->subsidio = $request['subsidio'];
          $registro->admin = $request['tipo_usuario'];
          $registro->telefono = $request['telefono'];
          $registro->direccion = $request['direccion'];
          $registro->fecha_facturacion = $request['fecha_facturacion'];
          $registro->id_sensor = $request['sensor'];
          $registro->save();

          return redirect('/usuarios')->with('status', 'El usuario se ha actualizado exitosamente.');;

    }

    public function DardeBaja($id){

        $users = User::find($id);
        $users->estado = 0;
        $users->save();

        return redirect()->back();

    }

    public function DarDeAlta($id) {

      $users = User::find($id);
      $users->estado = 1;
      $users->save();

      return redirect()->back();
    }

    public function verificar() {
      $sensor_produccion = DB::table('medicion')->where('id_sensor', '2')->orderBy('id', 'desc')->first()->dato;
      $sensor_cliente    = DB::table('medicion')->where('id_sensor', '1')->orderBy('id', 'desc')->first()->dato;
        if($sensor_cliente < $sensor_produccion){
          return '<audio autoplay id="miAudio" src="/sounds/Alarme.mp3"></audio><div class="alert alert-danger"><img style="padding:5px;" src="http://defensacivil.gob.bo/web/images/alarma-gif.gif" width="50" alt="">
          Revisar Sensor de Producción
          </div>';
        }
        else {
          return '<div class="alert alert-success">Sensor de Producción OK:</div>';
        }
    }

    public function Totalgeneral(){
      return '$ '.number_format(totalGeneral());
    }

    public function metrosCubicos() {
      return substr(TotalLitrosPorHora(Auth::User()->email) / 230000, 0, 6);
    }

    public function verUsuario($user_id){

      $users = User::where('id', $user_id)->get();

      $chart = Charts::create('bar', 'highcharts')
          ->settitle('Total por Mes')
          ->setelementLabel('Gasto Mensual $')
          ->setlabels(['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio','Julio','Agosto','Septiembre','Octubre','Noviembre','Diciembre'])
          ->setvalues([TmU(1, $user_id),TmU(2, $user_id),TmU(3, $user_id),TmU(4, $user_id),TmU(5, $user_id),TmU(6, $user_id),TmU(7, $user_id),TmU(7, $user_id),TmU(9, $user_id),
          TmU(10, $user_id),TmU(11, $user_id),TmU(12, $user_id)])
          ->setdimensions(1000,500)
          ->setresponsive(true);

      return view('/panel/verUsuario', ['users' => $users, 'chart' => $chart]);
    }
}

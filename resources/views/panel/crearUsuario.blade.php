@extends('layouts.panel')
@section('Panelcontent')
<div class="panel panel-default">
  <div class="panel-heading">Crear Usuario</div>
  <div class="panel-body">
    <div class="col-md-6 table">
      <div class="card border-dark">
      <div class="card-body" style="padding:50px;">
        @if (session('status'))
            <div class="alert alert-success">
                {{ session('status') }}
            </div>
        @endif
        <form id="sign_up"  method="POST" action="/crear-usuario">
            {{ csrf_field() }}
              <div class="input-group">
                  <span class="input-group-addon">
                      <i class="material-icons">person</i>
                  </span>
                  <div class="form-line">
                      <input type="text" class="form-control" name="name" value="{{ old('name') }}" placeholder="Nombre" autofocus>
                      @if ($errors->has('name'))
                          <span class="help-block">
                              <strong>{{ $errors->first('name') }}</strong>
                          </span>
                      @endif
                  </div>
              </div>
              <div class="input-group">
                  <span class="input-group-addon">
                      <i class="material-icons">person</i>
                  </span>
                  <div class="form-line">
                      <input type="text" class="form-control" name="email" value="{{ old('email') }}" placeholder="11.111.111-1" >
                  </div>
              </div>
              <div class="input-group">
                  <span class="input-group-addon">
                      <i class="material-icons">lock</i>
                  </span>
                  <div class="form-line">
                      <input type="password" class="form-control" name="password" minlength="6" placeholder="Password">
                      @if ($errors->has('password'))
                          <span class="help-block">
                              <strong>{{ $errors->first('password') }}</strong>
                          </span>
                      @endif
                  </div>
              </div>
              <div class="input-group">
                  <span class="input-group-addon">
                      <i class="material-icons">lock</i>
                  </span>
                  <div class="form-line">
                      <input type="password" class="form-control" name="password_confirmation" minlength="6" placeholder="Confirm Password">
                  </div>
              </div>

              <div class="input-group">
                  <span class="input-group-addon">
                      <i class="material-icons">home</i>
                  </span>
                  <div class="form-line">
                      <input type="text" class="form-control" name="direccion" placeholder="Dirección">
                  </div>
              </div>

              <div class="input-group">
                  <span class="input-group-addon">
                      <i class="material-icons">call</i>
                  </span>
                  <div class="form-line">
                      <input type="text" class="form-control" name="telefono" placeholder="Telefono">
                  </div>
              </div>

              <div class="input-group">
                  <span class="input-group-addon">
                      <i class="material-icons">face</i>
                  </span>
                  <div class="form-line">
                    <select class="form-control" name="tipo_usuario">
                        <option value="" selected>Seleccione Tipo de Usuario...</option>
                        <option value="0">Cliente</option>
                        <option value="1">Administrador</option>
                        <option value="2">Secretari@</option>
                    </select>
                   </div>
              </div>

              <div class="input-group">
                  <span class="input-group-addon">
                      <i class="material-icons">attach_money</i>
                  </span>
                  <div class="form-line">
                    <select class="form-control" name="subsidio">
                        <option value="" selected>Selccione Subsidio...</option>
                        <option value="0">Si</option>
                        <option value="1">No</option>
                    </select>
                   </div>
              </div>


              <div class="input-group">
                  <span class="input-group-addon">
                      <i class="material-icons">toys</i>
                  </span>
                  <div class="form-line">
                    <select class="form-control" name="sensor">
                        <option value="" selected>Seleccione Sensor...</option>
                        @foreach($sensores as $sensor)
                          <option value="{{ $sensor->id }}"> {{ $sensor->nombre_sensor }}</option>
                        @endforeach
                    </select>
                  </div>
              </div>

              <div class="input-group">
                  <span class="input-group-addon">
                      <i class="material-icons">event_available</i>
                  </span>
                  <div class="form-line">
                    <select class="form-control" name="fecha_facturacion">
                        <option value="" selected>Dia de Facturacion...</option>
                        @for($i=0; $i < 28; $i++)
                          <option value="{{ $i }}"> {{ $i }}</option>
                        @endfor
                    </select>
                  </div>
              </div>



              <button class="btn btn-block btn-lg bg-pink waves-effect" type="submit">REGISTRAR USUARIO</button>

          </form>
      </div>
    </div>
    </div>
  </div>
</div>
@stop

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
        @foreach($usuarios as $usuario)
        <form id="sign_up"  method="POST" action="/actualizar-usuario">
            {{ csrf_field() }}

              <div class="input-group">
                  <span class="input-group-addon">
                      <i class="material-icons">person</i>
                  </span>
                  <div class="form-line">
                      <input type="text" class="form-control" value="{{ $usuario->name }}" name="name" value="{{ old('name') }}" placeholder="Nombre" autofocus>
                      <input type="hidden" name="id_usuario" value="{{ $usuario->id }}">
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
                      <input type="text" class="form-control" value="{{ $usuario->email }}" name="email" value="{{ old('email') }}" placeholder="11.111.111-1" >
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
                      <i class="material-icons">lock</i>
                  </span>
                  <div class="form-line">
                      <input type="text" class="form-control" value="{{ $usuario->direccion }}" name="direccion" placeholder="Dirección">
                  </div>
              </div>

              <div class="input-group">
                  <span class="input-group-addon">
                      <i class="material-icons">lock</i>
                  </span>
                  <div class="form-line">
                      <input type="text" class="form-control" value="{{ $usuario->telefono }}" name="telefono" placeholder="Telefono">
                  </div>
              </div>

              <div class="input-group">
                  <span class="input-group-addon">
                      <i class="material-icons">lock</i>
                  </span>
                  <div class="form-line">
                    <select class="form-control" name="tipo_usuario">
                        @if($usuario->admin == 0)
                        <option value="0" selected>Cliente</option>
                        <option value="1">Administrador</option>
                        <option value="2">Secretario</option>
                        @elseif($usuario->admin == 1)
                        <option value="0">Cliente</option>
                        <option value="1" selected>Administrador</option>
                        <option value="2">Secretario</option>
                        @elseif($usuario->admin == 2)
                        <option value="0">Cliente</option>
                        <option value="1">Administrador</option>
                        <option value="2" selected>Secretari@</option>
                        @endif
                    </select>
                   </div>
              </div>

              <div class="input-group">
                  <span class="input-group-addon">
                      <i class="material-icons">lock</i>
                  </span>
                  <div class="form-line">
                    <select class="form-control" name="subsidio">
                        @if($usuario->subsidio == 1)
                        <option value="0" selected>Si</option>
                        <option value="1">No</option>
                        @else
                        <option value="0">Si</option>
                        <option value="1" selected>No</option>
                        @endif
                    </select>
                   </div>
              </div>
              <div class="input-group">
                  <span class="input-group-addon">
                      <i class="material-icons">lock</i>
                  </span>
                  <div class="form-line">
                    <select class="form-control" name="sensor">
                        @foreach($sensores as $sensor)
                          @if($sensor->id == $usuario->id_sensor)
                          <option value="{{ $sensor->id }}" selected> {{ $sensor->nombre_sensor }}</option>
                          @endif
                        @endforeach
                    </select>
                  </div>
              </div>
              <div class="input-group">
                  <span class="input-group-addon">
                      <i class="material-icons">lock</i>
                  </span>
                  <div class="form-line">
                    <select class="form-control" name="fecha_facturacion">
                        <option value="" selected>Dia de Facturacion...</option>
                        @for($i=0; $i < 29; $i++)
                          @if($i == $usuario->fecha_facturacion)
                          <option value="{{ $i }}" selected> {{ $i }}</option>
                          @else
                          <option value="{{ $i }}"> {{ $i }}</option>
                          @endif
                        @endfor
                    </select>
                  </div>
              </div>
              @endforeach
              <button class="btn btn-block btn-lg bg-pink waves-effect" type="submit">ACTUALIZAR USUARIO</button>
          </form>
      </div>
    </div>
    </div>
  </div>
</div>
@stop

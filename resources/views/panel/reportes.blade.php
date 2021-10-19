@extends('layouts.panel')
@section('Panelcontent')
<style>
audio {
   display:none;
}
</style>
<script type="text/javascript">
 $(document).ready(function(){
   var callAjax = function(){
     $.ajax({
       method:'get',
       url:'/verificar',
       success:function(data){
          $("#mensaje").html(data);
       }
     });
   }
   setInterval(callAjax, 1920);

   var callAjax2 = function(){
     $.ajax({
       method:'get',
       url:'/totalGeneral',
       success:function(data){
          $("#totalingresos").html(data);
       }
     });
   }
   setInterval(callAjax2, 1000);

   var callAjax3 = function(){
     $.ajax({
       method:'get',
       url:'/MetrosCubicos',
       success:function(data){
          $("#metrosCubicos").html(data);
       }
     });
   }
   setInterval(callAjax3, 1000);
 });
</script>

<div id="mensaje">
</div>
<div class="panel panel-default">
  <div class="panel-heading">Reportes</div>
  <div class="panel-body">
  {!! Charts::assets() !!}
  <!-- Widgets -->
  <div class="row clearfix">
      <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
          <div class="info-box bg-pink hover-expand-effect">
              <div class="icon">
                  <i class="material-icons">whatshot</i>
              </div>
              <div class="content">
                  <div class="text"> INGRESOS T.</div>
                  <div class="number"><span id="totalingresos"></span> </div>
              </div>
          </div>
      </div>
      <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
          <div class="info-box bg-cyan hover-expand-effect">
              <div class="icon">
                  <i class="material-icons">help</i>
              </div>
              <div class="content">
                  <div class="text" style="margin-top:-1px;"><span style="font-size:22px;">m³</span></div>
                  <div class="number"> <span id="metrosCubicos"></span> </div>
              </div>
          </div>
      </div>
      <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
          <div class="info-box bg-light-green hover-expand-effect">
              <div class="icon">
                  <i class="material-icons">people</i>
              </div>
              <div class="content">
                  <div class="text">T. USUARIOS</div>
                  <div class="number">{{ TotalUsuarios(1) }}</div>
              </div>
          </div>
      </div>
      <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
          <div class="info-box bg-orange hover-expand-effect">
              <div class="icon">
                  <i class="material-icons">people_outline</i>
              </div>
              <div class="content">
                  <div class="text">CLIENTES</div>
                  <div class="number">{{ TotalUsuarios(0) }}</div>
              </div>
          </div>
      </div>
  </div>
  <!-- #END# Widgets -->
  <div class="card border-dark">
  <div class="card-body" style="padding:20px;">
    <div class="row">
    <div class="col-md-9">
      {!! $chart->render() !!}
    </div>
    <div class="col-md-3">
    {!! $chart2->render() !!}
    </div>
  </div>
</div>
</div>
<div class="card border-dark">
<div class="card-body" style="padding:20px;">
  <div class="row">
  <div class="col-md-12">
  {!! $chart3->render() !!}
  </div>
</div>
</div>
</div>
<div class="card border-dark">
<div class="card-body" style="padding:20px;">
  <div class="row">
  <div class="col-md-12">
  {!! $chart4->render() !!}
  </div>
</div>
</div>
</div>

<div class="card border-dark">
<div class="card-body" style="padding:20px;">
  <div class="row">
  <div class="col-md-12">
  {!! $chart5->render() !!}
  </div>
</div>
</div>
</div>

<div class="card border-dark">
<div class="card-body" style="padding:20px;">
  <div class="row">
  <div class="col-md-12">
  {!! $chart6->render() !!}
  </div>
</div>
</div>
</div>
@stop

<?php

Route::get('/','WebController@welcome');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/cerrar-sesion', function () { Auth::logout(); Session::flush(); return redirect('/'); })->name('cerrar-session');

Route::get('/insert/{user}/{dato}', 'PanelController@insert');

Route::get('/admin', 'PanelController@admin')->middleware('admin');

Route::get('/usuarios', 'PanelController@usuarios');

Route::get('/crear-usuario', 'PanelController@crearUsuario');

Route::get('/reportes', 'PanelController@reportes');

Route::get('/data', 'PanelController@datos')->name('data');

Route::get('/facturacion', 'PanelController@facturacion');

Route::get('/metodo-de-pago', 'PanelController@pagar');

Route::get('/pay', 'PanelController@pay');

Route::get('/historial-de-facturacion', 'PanelController@historialFacturacion');

Route::get('/consumos', 'PanelController@consumos');

Route::get('/editar-usuario/{id}', 'PanelController@editarUsuario');

Route::post('/crear-usuario', 'PanelController@Registro');

Route::post('/actualizar-usuario', 'PanelController@ActualizarUsuario');

Route::get('/desabilitar-usuario/{id}', 'PanelController@DardeBaja');

Route::get('/habilitar-usuario/{id}', 'PanelController@DarDeAlta');

Route::get('/verificar', 'PanelController@verificar');

Route::get('/totalGeneral', 'PanelController@Totalgeneral');

Route::get('/MetrosCubicos', 'PanelController@metrosCubicos');

Route::get('/ver-usuario/{id}', 'PanelController@verUsuario');

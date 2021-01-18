<?php

use Illuminate\Routing\Router;

Admin::routes();

Route::group([
    'prefix'        => config('admin.route.prefix'),
    'namespace'     => config('admin.route.namespace'),
    'middleware'    => config('admin.route.middleware'),
    'as'            => config('admin.route.prefix') . '.',
], function (Router $router) {

    $router->get('/', 'HomeController@index')->name('home');
    /* Rutas de Configuración */
    $router->resource('/configuracion/reservas/estados', 'ReservaEstadoController', ['as' => 'configuracion.reservas']);
    $router->resource('/configuracion/eventos/estados', 'EventoEstadoController', ['as' => 'configuracion.eventos']);
    $router->resource('/configuracion/identificacion/tipos', 'IdentificacionTipoController', ['as' => 'configuracion.identificacion']);

    /* Rutas de Aplicación */
    $router->resource('/eventos', 'EventoController');
    $router->resource('/lugares', 'LugarController');


});

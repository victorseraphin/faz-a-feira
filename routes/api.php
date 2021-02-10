<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
 */
Route::group(['middleware' => 'api', 'prefix' => 'auth'], function ($router) {
    Route::post('login', 'Api\AuthController@login');
    Route::post('logout', 'Api\AuthController@logout');
    Route::post('refresh', 'Api\AuthController@refresh');
    Route::post('me', 'Api\AuthController@me');
    Route::post('register', 'Api\UserController@register')->name('register');
});
Route::group(['middleware' => 'apiJwt'], function ($router) {
    Route::get('users', 'Api\UserController@index')->name('usuarios');
    Route::get('users/{id}', 'Api\UserController@show')->name('usuarios.listar');
    Route::post('users/salvar', 'Api\UserController@store')->name('usuarios.salvar');
    Route::post('users/atualizar/{id}', 'Api\UserController@update')->name('usuarios.atualizar');
    Route::get('users/deletar/{id}', 'Api\UserController@destroy')->name('usuarios.deletar');

    Route::get('categorias', 'Api\CategoriasController@index')->name('categorias');
    Route::get('categorias/{id}', 'Api\CategoriasController@show')->name('categorias.listar');
    Route::post('categorias/salvar', 'Api\CategoriasController@store')->name('categorias.salvar');
    Route::post('categorias/atualizar/{id}', 'Api\CategoriasController@update')->name('categorias.atualizar');
    Route::get('categorias/deletar/{id}', 'Api\CategoriasController@destroy')->name('categorias.deletar');

    Route::get('produtos', 'Api\ProdutosController@index')->name('produtos');
    Route::get('produtos/{user_id}', 'Api\ProdutosController@show')->name('produtos.listar');
    Route::post('produtos/salvar/{user_id}', 'Api\ProdutosController@store')->name('produtos.salvar');
    Route::post('produtos/atualizar/{user_id}/{id}', 'Api\ProdutosController@update')->name('produtos.atualizar');
    Route::get('produtos/deletar/{user_id}/{id}', 'Api\ProdutosController@destroy')->name('produtos.deletar');
    Route::get('produtos_detalhes/{id}', 'Api\ProdutosController@show_detalhes')->name('produtos.produtos_detalhes');

    Route::get('desejos', 'Api\ListaDesejosController@index')->name('desejos');
    Route::get('desejos/{user_id}', 'Api\ListaDesejosController@show')->name('desejos.listar');
    Route::post('desejos/salvar', 'Api\ListaDesejosController@store')->name('desejos.salvar');
    Route::post('desejos/atualizar/{id}', 'Api\ListaDesejosController@update')->name('desejos.atualizar');
    Route::get('desejos/deletar/{user_id}/{id}', 'Api\ListaDesejosController@destroy')->name('desejos.deletar');
});



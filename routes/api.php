<?php

use Illuminate\Http\Request;
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

Route::get('users', 'Api\UserController@index')->name('usuarios');
Route::get('users/{id}', 'Api\UserController@show')->name('usuarios.listar');
Route::post('users/salvar', 'Api\UserController@store')->name('usuarios.salvar');
Route::post('users/atualizar/{id}', 'Api\UserController@update')->name('usuarios.atualizar');
Route::get('users/deletar/{id}', 'Api\UserController@destroy')->name('usuarios.deletar');

Route::get('categorias', 'Api\Categorias@index')->name('categorias');
Route::get('categorias/{id}', 'Api\Categorias@show')->name('categorias.listar');
Route::post('categorias/salvar', 'Api\Categorias@store')->name('categorias.salvar');
Route::post('categorias/atualizar/{id}', 'Api\Categorias@update')->name('categorias.atualizar');
Route::get('categorias/deletar/{id}', 'Api\Categorias@destroy')->name('categorias.deletar');

Route::get('produtos', 'Api\Produtos@index')->name('produtos');
Route::get('produtos/{id}', 'Api\Produtos@show')->name('produtos.listar');
Route::post('produtos/salvar', 'Api\Produtos@store')->name('produtos.salvar');
Route::post('produtos/atualizar/{id}', 'Api\Produtos@update')->name('produtos.atualizar');
Route::get('produtos/deletar/{id}', 'Api\Produtos@destroy')->name('produtos.deletar');

Route::get('desejos', 'Api\ListaDesejos@index')->name('desejos');
Route::get('desejos/{id}', 'Api\ListaDesejos@show')->name('desejos.listar');
Route::post('desejos/salvar', 'Api\ListaDesejos@store')->name('desejos.salvar');
Route::post('desejos/atualizar/{id}', 'Api\ListaDesejos@update')->name('desejos.atualizar');
Route::get('desejos/deletar/{id}', 'Api\ListaDesejos@destroy')->name('desejos.deletar');

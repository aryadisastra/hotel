<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('homepage.irna_index');
});

Route::get('/logout', 'IrnaLoginController@logout');
Route::get('/admin', 'IrnaLoginController@index');
Route::get('/admin/login', 'IrnaLoginController@login');
Route::get('/dashboard','IrnaLoginController@index');

Route::get('/pengguna','IrnaPenggunaController@index');
Route::post('/pengguna','IrnaPenggunaController@add');
Route::get('/pengguna/{id}','IrnaPenggunaController@detail');
Route::put('/pengguna','IrnaPenggunaController@update');

Route::get('/role','IrnaRoleController@index');
Route::post('/role','IrnaRoleController@add');
Route::get('/role/{id}','IrnaRoleController@detail');
Route::put('/role','IrnaRoleController@update');

Route::get('/fasilitas','IrnaFasilitasController@index');
Route::post('/fasilitas','IrnaFasilitasController@add');
Route::get('/fasilitas/{id}','IrnaFasilitasController@detail');
Route::put('/fasilitas','IrnaFasilitasController@update');

Route::get('/tipe','IrnaTipeController@index');
Route::post('/tipe','IrnaTipeController@add');
Route::get('/tipe/{id}','IrnaTipeController@detail');
Route::put('/tipe','IrnaTipeController@update');

Route::get('/kamar','IrnaKamarController@index');
Route::post('/kamar','IrnaKamarController@add');
Route::get('/kamar/{id}','IrnaKamarController@detail');
Route::put('/kamar','IrnaKamarController@update');
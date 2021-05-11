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
    // return view('welcome');
    return view('auth/login');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/logout', '\App\Http\Controllers\Auth\LoginController@logout');

//data
Route::get('/data', 'DataController@index');
Route::post('/simpan_data', 'DataController@simpan');
Route::get('/CetakCover/{id}', 'DataController@CetakCover');
Route::get('/update/{id}', 'DataController@update');

Route::get('/level-1', 'DataController@level_1');
Route::get('/level-2', 'DataController@level_2');
Route::get('/level-3', 'DataController@level_3');

Route::get('/pengguna', 'UserController@index');
Route::post('/pengguna/simpan_data', 'UserController@simpan');
Route::post('/pengguna/edit/{id}', 'UserController@update');
Route::get('/pengguna/hapus/{id}', 'UserController@hapus');
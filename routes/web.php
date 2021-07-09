<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;

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
/*
Route::get('/', function () {
    return view('welcome');
});*/

Route::get('app','App\Http\Controllers\PostController@index');
Route::get('auth','App\Http\Controllers\PostController@index');

Route::group(['prefix' => 'auth'], function () {
    Route::get('login','App\Http\Controllers\PostController@getLogin');
    Route::get('register','App\Http\Controllers\PostController@getRegister');
    Route::post('register','App\Http\Controllers\PostController@postRegister');
    Route::post('login','App\Http\Controllers\PostController@postLogin');
    Route::get('logout','App\Http\Controllers\PostController@getLogout');
    
  });
//   Route::get('login','App\Http\Controllers\PostController@getLogin');
//   Route::get('register','App\Http\Controllers\PostController@getRegister');
//   Route::post('register','App\Http\Controllers\PostController@postRegister');
//   Route::post('login','App\Http\Controllers\PostController@postLogin');
//   Route::get('logout','App\Http\Controllers\PostController@getLogout');
/*
Route::get('registers',function(){
    return view('auths.register');
});

Route::get('logins',function(){
    return view('auths.login');
});*/

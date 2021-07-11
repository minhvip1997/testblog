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
Route::get('/','App\Http\Controllers\PostController@index');

Route::group(['prefix' => 'auth'], function () {
    Route::get('login','App\Http\Controllers\PostController@getLogin');
    Route::get('register','App\Http\Controllers\PostController@getRegister');
    Route::post('register','App\Http\Controllers\PostController@postRegister');
    Route::post('login','App\Http\Controllers\PostController@postLogin');
    Route::get('logout','App\Http\Controllers\PostController@getLogout');

    Route::get('newpost','App\Http\Controllers\PostController@getCreate');
    Route::post('newpost','App\Http\Controllers\PostController@postCreate');
    Route::get('edit/{slug}','App\Http\Controllers\PostController@getEdit');
    Route::post('edit','App\Http\Controllers\PostController@postEdit');
    Route::get('delete/{id}', 'App\Http\Controllers\PostController@deletePost');

    Route::post('comment/add', 'App\Http\Controllers\CommentController@postAdd');
    Route::get('myallposts', 'App\Http\Controllers\UserController@userpostsall');
    // display user's drafts
    Route::get('mydrafts', 'App\Http\Controllers\UserController@userpostsdraft');
  });
  Route::get('showpost/{slug}','App\Http\Controllers\PostController@getShow');
  Route::get('user/{id}/posts', 'App\Http\Controllers\UserController@userposts');
  Route::get('user/{id}', 'App\Http\Controllers\UserController@profile');
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

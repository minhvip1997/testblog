<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\CommentController;

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


// Route::get('app','App\Http\Controllers\PostController@index');
// Route::get('/','App\Http\Controllers\PostController@index');

Route::get('app',[PostController::class,'index']);
Route::get('/',[PostController::class,'index']);

// Route::get('login','App\Http\Controllers\UserController@getLogin');
// Route::get('register','App\Http\Controllers\UserController@getRegister');
// Route::post('register','App\Http\Controllers\UserController@postRegister');
// Route::post('login','App\Http\Controllers\UserController@postLogin');

Route::get('login',[UserController::class,'getLogin']);
Route::get('register',[UserController::class,'getRegister']);
Route::post('register',[UserController::class,'postRegister']);
Route::post('login',[UserController::class,'postLogin']);

Route::group(['prefix' => 'auth','middleware'=>'adminLogin'], function () {
    Route::get('logout',[UserController::class,'getLogout']);

    Route::get('newpost',[PostController::class,'getCreate']);
    Route::post('newpost',[PostController::class,'postCreate']);
    Route::get('edit/{slug}',[PostController::class,'getEdit']);
    Route::post('edit',[PostController::class,'postEdit']);
    Route::get('delete/{id}', [PostController::class,'deletePost']);

    Route::post('comment/add', [CommentController::class,'postAdd']);
    Route::get('myallposts', [UserController::class,'userpostsall']);
    // display user's drafts
    Route::get('mydrafts', [UserController::class,'userpostsdraft']);
  });
  Route::get('showpost/{slug}',[PostController::class,'getShow']);
  Route::get('user/{id}/posts', [UserController::class,'userposts']);
  Route::get('user/{id}', [UserController::class,'profile']);

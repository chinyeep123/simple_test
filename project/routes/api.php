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

//Route::middleware('auth:api')->get('/user', function (Request $request) {
//    return $request->user();
//});
Route::get('get_posts','Controller@getAllPost')->name('get_posts');
Route::get('get_post/{post_id}','Controller@getPostByID')->name('get_post');
Route::get('get_comments','Controller@getAllComment')->name('get_comments');
Route::post('comment/search','Controller@getFilteringComment')->name('comment/search');

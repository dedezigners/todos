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

Route::group([

    'middleware' => 'api',
    'prefix' => 'auth'

], function ($router) {

    Route::post('register', 'AuthController@register');
    Route::post('login', 'AuthController@login');
    Route::post('logout', 'AuthController@logout');
    Route::post('refresh', 'AuthController@refresh');
    Route::post('me', 'AuthController@me');

});

Route::get('/questions', 'QuestionController@index')->name('question.index');
Route::apiResource('/question', 'QuestionController')->except('index');

Route::get('/categories', 'CategoryController@index')->name('category.index');
Route::apiResource('/category', 'CategoryController')->except('index');

Route::get('/question/{question}/replies', 'ReplyController@index')->name('reply.index');
Route::apiResource('/question/{question}/reply', 'ReplyController')->except('index');

Route::post('/like/{reply}', 'LikeController@like')->name('like');
Route::delete('/like/{reply}', 'LikeController@dislike')->name('dislike');

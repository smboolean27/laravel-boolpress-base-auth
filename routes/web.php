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
// Area Pubblica!!
Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

// Area Privata!!
Route::prefix('user')->name('user.')->namespace('User')->middleware('auth')->group(function () {
    Route::get('/', 'HomeController@index')->name('home');
    Route::resource('posts', 'PostController');
    // Route::resource('tags', 'TagController');
    Route::delete('comments/{comment}', 'CommentController@destroy')->name('comments.destroy');
});
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
Route::get('/', 'BlogController@index')->name('guest.index');
Route::get('posts/{slug}', 'BlogController@showPost')->name('guest.show-post');
Route::get('tags/{slug}', 'BlogController@showTag')->name('guest.show-tag');
Route::post('posts/{post}/add-comment', 'BlogController@addComment')->name('guest.add-comment');
Route::get('search/', 'BlogController@search')->name('guest.search');

Auth::routes();

// Area Privata!!
Route::prefix('user')->name('user.')->namespace('User')->middleware('auth')->group(function () {
    Route::get('/', 'HomeController@index')->name('home');
    Route::resource('posts', 'PostController');
    Route::resource('tags', 'TagController');
    Route::delete('comments/{comment}', 'CommentController@destroy')->name('comments.destroy');
});
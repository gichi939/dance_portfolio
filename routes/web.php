<?php

use App\Http\Controllers\TopController;
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
    return view('welcome');
});

// Route::get('/', 'DevelopController@show');

Route::group(['middleware' => 'auth'], function() {
Route::get('/', 'PostController@index');
Route::get('/', 'DevelopController@show')->name('post.show');
Route::get('/post/like/{id}', 'DevelopController@like')->name('post.like');
Route::get('/post/unlike/{id}', 'DevelopController@unlike')->name('post.unlike');
Route::get('/post/create', 'postController@post_show')->name('post.show');
Route::post('/post/create', 'postController@post_create')->name('post.create');
// Route::post('ajaxlike', 'PostController@ajaxlike')->name('.ajaxlikpostse');
Route::post('/like', 'PostController@like')->name('reviews.like');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

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
    return view('welcome');
});

Route::get('/dashboard', 'UsersController@dashboard')->name('user.dashboard');

Route::group(['prefix' => 'forum'], function () {
    Route::get('/home', 'ForumController@index');
    Route::get('/all/topics', 'ForumController@topics');
    Route::get('/topics/post/{slug}', 'ForumController@singlePost')->name('forum.post');
    Route::post('/submit/post', 'ForumController@store')->name('save.post');
});

Auth::routes();

Route::group(['prefix' => 'admin', 'middleware'=>'admin'], function () {
    Route::get('/forum/categories', "ForumCategoryController@allCategories")->name('categories');
    Route::post('/store/category', "ForumCategoryController@saveCategory")->name('save.category');
    Route::post('/store/forum', "ForumCategoryController@saveForum")->name('save.forum');
    Route::get('/home', 'HomeController@index')->name('home');
});
// Serve Files
Route::get('/files/images/', 'FileController@fetchFile')->name('file-fetch');

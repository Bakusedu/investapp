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

Route::get('/dashboard', 'UsersController@dashboard')->name('user.dashboard')->middleware('hasprogramme');
Route::get('/join/programme', 'ProgrammeController@joinPage')->name('programme.join');
Route::get('/programme/details', 'ProgrammeController@details')->name('programme.details');
Route::get('/request/to/join', 'ProgrammeController@sendRequest')->name('join.request');

Route::group(['prefix' => 'forum'], function () {
    Route::get('/home', 'ForumController@index')->name('forum.home');
    Route::get('/all/topics/{slug}', 'ForumController@topics')->name('topics')->middleware('auth');
    Route::get('/topics/post/{slug}', 'ForumController@singlePost')->name('forum.post')->middleware('auth');
    Route::post('/submit/post', 'ForumController@store')->name('save.post')->middleware('auth');
    Route::post('/comment/submit', 'ForumController@storeComment')->name('comment')->middleware('auth');
});

Auth::routes();

Route::group(['prefix' => 'admin', 'middleware'=>'admin'], function () {
    Route::get('/forum/categories', "ForumCategoryController@allCategories")->name('categories');
    Route::post('/store/category', "ForumCategoryController@saveCategory")->name('save.category');
    Route::post('/store/forum', "ForumCategoryController@saveForum")->name('save.forum');
    Route::get('/home', 'HomeController@index')->name('home');

    //Programmes

    Route::get('/programmes', "ProgrammeController@index")->name('programmes.index')->middleware('auth');
    Route::post('/programme/store', 'ProgrammeController@store')->name('store.programme');
    Route::post('/events/store', 'ProgrammeController@createEvent')->name('save.event');
});

// Serve Files
Route::get('/files/images/', 'FileController@fetchFile')->name('file-fetch');

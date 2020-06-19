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

Route::group(['middleware' => ['auth', 'verified']], function () {
    Route::get('/dashboard', 'UsersController@dashboard')->name('user.dashboard');
    Route::get('/programme/calendar/{id}', 'ProgrammeController@userCalendar')->name('user.calendar');
    Route::get('/request/to/join', 'ProgrammeController@sendRequest')->name('join.request');
});

Route::get('logout','UsersController@Logout');
Route::get('/join/programme', 'ProgrammeController@joinPage')->name('programme.join');
Route::get('/programme/details', 'ProgrammeController@details')->name('programme.details');
Route::get('/invite/{id}', 'SpeakerController@speakerInvite')->name('invitation.page');
Route::get('/speaker-accept/{id}', 'SpeakerController@speakerAccept')->name('accept.speaker')->middleware('auth');
Route::get('/speaker-decline/{id}', 'SpeakerController@speakerDecline')->name('decline.speaker')->middleware('auth');
Route::post('/delete/programme', 'ProgrammeController@deleteProgram');
Route::post('/delete/waiter', 'ProgrammeController@deleteWaiter');

Route::group(['prefix' => 'forum'], function () {
    Route::get('/home', 'ForumController@index')->name('forum.home');
    Route::get('/all/topics/{slug}', 'ForumController@topics')->name('topics')->middleware('auth');
    Route::get('/topics/post/{slug}', 'ForumController@singlePost')->name('forum.post')->middleware('auth');
    Route::post('/submit/post', 'ForumController@store')->name('save.post')->middleware('auth','verified');
    Route::post('/comment/submit', 'ForumController@storeComment')->name('comment')->middleware('auth','verified');
});

Auth::routes(['verify'=>true]);

Route::group(['prefix' => 'admin', 'middleware'=>'admin'], function () {
    Route::get('/forum/categories', "ForumCategoryController@allCategories")->name('categories');
    Route::post('/store/category', "ForumCategoryController@saveCategory")->name('save.category');
    Route::post('/store/forum', "ForumCategoryController@saveForum")->name('save.forum');
    Route::get('/home', 'HomeController@index')->name('home');

    Route::get('/approve/request', 'ProgrammeController@approve')->name('approve.request');

    //Programmes

    Route::get('/programmes', "ProgrammeController@index")->name('programmes.index')->middleware('auth');
    Route::post('/programme/store', 'ProgrammeController@store')->name('store.programme');
    Route::get('/programme/calendar', 'ProgrammeController@viewCalender')->name('programme.calendar');
    Route::post('/events/store', 'EventsController@createEvent')->name('save.event');
});

// Serve Files
Route::get('/files/images/', 'FileController@fetchFile')->name('file-fetch');

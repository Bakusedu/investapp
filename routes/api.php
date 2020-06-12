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

Route::get('/programmes/{type}', 'UsersController@programmes')->middleware('auth:sanctum');

Route::get('/program/details', 'ProgrammeController@programmeDetails');

Route::post('/saveprogram', 'ProgrammeController@save');
Route::post('/addevent', 'ProgrammeController@addEvent');
Route::post('/editevent', 'ProgrammeController@updateEvent');

Route::post('/updateprogram', 'ProgrammeController@update');
Route::post('/addspeaker', 'ProgrammeController@addSpeaker');
Route::post('/updatespeaker', 'ProgrammeController@updateSpeaker');

Route::get('/join', 'ProgrammeController@joinRequest');
Route::post('/approve', 'ProgrammeController@waitingApproval');

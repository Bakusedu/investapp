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

Route::post('/saveprogram', 'ProgrammeController@save')->middleware('auth:sanctum');
Route::post('/addevent', 'EventsController@addEvent')->middleware('auth:sanctum');
Route::post('/editevent', 'EventsController@updateEvent')->middleware('auth:sanctum');
Route::post('/delete/event', 'EventsController@deleteEvent');

Route::post('/updateprogram', 'ProgrammeController@update')->middleware('auth:sanctum');
Route::post('/addspeaker', 'SpeakerController@addSpeaker')->middleware('auth:sanctum');
Route::post('/updatespeaker', 'SpeakerController@updateSpeaker')->middleware('auth:sanctum');
Route::post('/delete/speaker', 'SpeakerController@deleteSpeaker')->middleware('auth:sanctum');

Route::get('/join', 'ProgrammeController@joinRequest')->middleware('auth:sanctum');
Route::post('/approve', 'ProgrammeController@waitingApproval')->middleware('auth:sanctum');

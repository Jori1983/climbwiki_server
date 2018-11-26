<?php

use Illuminate\Http\Request;

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

Route::get('/climbs',         ['uses' => 'ClimbController@getClimbs']);
Route::get('/climbs/{id}',    ['uses' => 'ClimbController@getClimb']);
Route::post('/climb',         ['uses' => 'ClimbController@postClimb']);
Route::put('/climb/{id}',     ['uses' => 'ClimbController@putClimb']);
Route::delete('/climb/{id}',  ['uses' => 'ClimbController@deleteClimb']);

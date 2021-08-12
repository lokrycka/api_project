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

Route::prefix('search')->group(function () {
    Route::get('code', 'App\Http\Controllers\ApiSearchController@code');
    Route::get('commits', 'App\Http\Controllers\ApiSearchController@commits');
    Route::get('issues', 'App\Http\Controllers\ApiSearchController@issues');
    Route::get('labels', 'App\Http\Controllers\ApiSearchController@labels');
    Route::get('repositories', 'App\Http\Controllers\ApiSearchController@repositories');
    Route::get('topics', 'App\Http\Controllers\ApiSearchController@topics');
});
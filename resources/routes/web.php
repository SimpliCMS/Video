<?php

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
Route::prefix('video')->group(function () {
    Route::get('/', 'VideoController@index')->name('video.index');
    Route::get('{video}', 'VideoController@show')->name('video.show');
});
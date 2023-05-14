<?php

/*
  |--------------------------------------------------------------------------
  | Admin Web Routes
  |--------------------------------------------------------------------------
  |
  | Here is where you can register Admin web routes for your application. These
  | routes are loaded by the RouteServiceProvider within a group which
  | contains the "web" "auth" and "role" middleware groups to lock them to the Admin.
  |
 */
Route::group(['prefix' => 'video'], function () {
    Route::get('/', 'VideoController@index')->name('video.admin.index');
    Route::post('/', 'VideoController@store')->name('video.admin.store');
    Route::get('create', 'VideoController@create')->name('video.admin.create');
    Route::get('{video}', 'VideoController@show')->name('video.admin.show');
    Route::put('{video}', 'VideoController@update')->name('video.admin.update');
    Route::delete('{video}', 'VideoController@destroy')->name('video.admin.destroy');
    Route::get('{video}/edit', 'VideoController@edit')->name('video.admin.edit');
});

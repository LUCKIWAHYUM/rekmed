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

Route::group(['middleware' => ['auth','check.nakes'], 'prefix' => 'perawat'], function () {
    Route::get('/', 'PerawatController@index')->name('perawat');
    Route::prefix('account')->group(function () {
        Route::get('/', 'PerawatController@profile')->name('account');
        Route::post('update', 'PerawatController@update')->name('update.account');
    });

    Route::prefix('pemeriksaan')->group(function () {
        Route::get('/', 'PemeriksaanController@index')->name('pemeriksaan');
        Route::get('detail/{id}', 'PemeriksaanController@detail')->name('pemeriksaan.detail');
        Route::post('process/{id}', 'PemeriksaanController@process')->name('pemeriksaan.process');
        Route::post('formPeriksa', 'PemeriksaanController@formPeriksa')->name('pemeriksaan.formPeriksa');
        Route::post('formLampiran', 'PemeriksaanController@formLampiran')->name('pemeriksaan.formLampiran');
        Route::post('process-lampiran/{id}', 'PemeriksaanController@process_lampiran')->name('pemeriksaan.process-lampiran');
    });
});

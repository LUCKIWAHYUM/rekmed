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

Route::group(['middleware' => ['auth','check.nakes'], 'prefix' => 'dokter'], function () {
    Route::get('/', 'DokterController@index')->name('perawat');
    Route::prefix('account')->group(function () {
        Route::get('/', 'DokterController@profile')->name('account');
        Route::post('update', 'DokterController@update')->name('update.account');
    });

    Route::prefix('pemeriksaan')->group(function () {
        Route::get('/', 'PemeriksaanController@index')->name('pemeriksaan');
        Route::get('detail/{id}', 'PemeriksaanController@detail')->name('pemeriksaan.detail');
        Route::post('process/{id}', 'PemeriksaanController@process')->name('pemeriksaan.process');
        Route::post('formPeriksa', 'PemeriksaanController@formPeriksa')->name('pemeriksaan.formPeriksa');
        Route::post('formLampiran', 'PemeriksaanController@formLampiran')->name('pemeriksaan.formLampiran');
        Route::post('process-lampiran/{id}', 'PemeriksaanController@process_lampiran')->name('pemeriksaan.process-lampiran');
    });

    Route::prefix('tindakan')->group(function () {
        // Tindakan
        Route::get('/', 'TindakanController@index')->name('tindakan');
        Route::get('create', 'TindakanController@create')->name('tindakan.create');
        Route::post('store', 'TindakanController@store')->name('tindakan.store');
        Route::get('edit/{id}', 'TindakanController@edit')->name('tindakan.edit');
        Route::post('update/{id}', 'TindakanController@update')->name('tindakan.update');
        Route::get('delete/{id}', 'TindakanController@destroy')->name('tindakan.delete');
    });

    Route::prefix('resep-obat')->group(function () {
        // Resep Obat
        Route::get('/', 'ResepController@index')->name('resep-obat');
        Route::post('create', 'ResepController@create')->name('resep-obat.create');
        Route::post('store', 'ResepController@store')->name('resep-obat.store');
        Route::post('edit', 'ResepController@edit')->name('resep-obat.edit');
        Route::get('detail/{id}', 'ResepController@detail')->name('resep-obat.detail');
        Route::get('print/{id}', 'ResepController@print')->name('resep-obat.print');
        Route::post('update/{id}', 'ResepController@update')->name('resep-obat.update');
        Route::get('delete/{id}', 'ResepController@destroy')->name('resep-obat.delete');
        Route::get('done/{id}', 'ResepController@done')->name('resep-obat.done');
    });

    Route::prefix('rekam-medis')->group(function () {
        // Resep Obat
        Route::get('/', 'RekamController@index')->name('rekam-medis');
        Route::get('detail/{id}', 'RekamController@detail')->name('rekam-medis.detail');
        Route::get('print/{id}', 'RekamController@print')->name('rekam-medis.print');
        Route::post('update/{id}', 'RekamController@update')->name('rekam-medis.update');
        Route::get('delete/{id}', 'RekamController@destroy')->name('rekam-medis.delete');
    });
});

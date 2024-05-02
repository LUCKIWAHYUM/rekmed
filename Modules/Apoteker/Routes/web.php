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

Route::group(['middleware' => ['auth','check.nakes'], 'prefix' => 'apoteker'], function () {
    Route::get('/', 'ApotekerController@index')->name('apoteker');
    Route::prefix('account')->group(function () {
        Route::get('/', 'ApotekerController@account')->name('apoteker.account');
        Route::post('update', 'ApotekerController@update')->name('apoteker.update.account');
    });

    Route::prefix('obat-pasien')->group(function () {
        // Resep Obat
        Route::get('/', 'ResepController@index')->name('apoteker.obat-pasien');
        Route::get('detail/{id}', 'ResepController@detail')->name('apoteker.obat-pasien.detail');
        Route::get('print/{id}', 'ResepController@print')->name('apoteker.obat-pasien.print');
        Route::get('done/{id}', 'ResepController@done')->name('apoteker.obat-pasien.done');
    });

    Route::prefix('obat')->group(function () {
        // Obat
        Route::get('/', 'ObatController@index')->name('apoteker.obat');
        Route::get('create', 'ObatController@create')->name('apoteker.obat.create');
        Route::post('store', 'ObatController@store')->name('apoteker.obat.store');
        Route::get('edit/{id}', 'ObatController@edit')->name('apoteker.obat.edit');
        Route::post('update/{id}', 'ObatController@update')->name('apoteker.obat.update');
        Route::get('delete/{id}', 'ObatController@destroy')->name('apoteker.obat.delete');
    });
});

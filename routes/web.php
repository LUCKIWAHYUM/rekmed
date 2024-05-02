<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\LoginController;

use Illuminate\Support\Facades\Storage;
use Aws\S3\S3Client;
use App\Models\Mail as Mailing;
use Aws\Exception\AwsException;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Mail;

Route::middleware(['guest'])->group(function () {
    Route::post('proses_login', 'App\Http\Controllers\LoginController@proses_login')->name('proses_login')->middleware('check.status');
    Route::get('forgot', 'App\Http\Controllers\LoginController@forgot')->name('forgot');
    Route::post('forgotPassword', 'App\Http\Controllers\LoginController@forgotPassword')->name('forgotPassword');
    Route::get('reset/{token}', 'App\Http\Controllers\LoginController@reset')->name('reset');
    Route::post('resetPassword', 'App\Http\Controllers\LoginController@resetPassword')->name('resetPassword');
    Route::get('verify/{token}', 'App\Http\Controllers\LoginController@verify')->name('verify');
});
// page utama
Route::get('/', 'App\Http\Controllers\LoginController@index')->name('login')->middleware('check.auth');
Route::get('logout', 'App\Http\Controllers\LoginController@logout')->name('logout');
Route::group(['middleware' => ['auth','check.admin']], function () {
    Route::get('change-language/{locale}', function ($locale) {
        App::setLocale($locale);
        Config::set('app.locale', $locale);
        return back()->with('swal', swal_alert('success', 'Language Changed'));
    });
    Route::group(['prefix' => 'app'], function () {
        Route::get('dashboard', [DashboardController::class, 'index'])->name('dashboard');
        Route::prefix('account')->group(function () {
            Route::get('/', 'App\Http\Controllers\DashboardController@profile')->name('account');
            Route::post('update', 'App\Http\Controllers\DashboardController@update')->name('update.account');
            Route::get('activity', 'App\Http\Controllers\AdminController@activity')->name('account.activity');
        });

        Route::prefix('dokter')->group(function () {
            // Dokter
            Route::get('/', 'App\Http\Controllers\DokterController@index')->name('dokter');
            Route::get('create', 'App\Http\Controllers\DokterController@create')->name('dokter.create');
            Route::post('store', 'App\Http\Controllers\DokterController@store')->name('dokter.store');
            Route::get('edit/{id}', 'App\Http\Controllers\DokterController@edit')->name('dokter.edit');
            Route::post('update/{id}', 'App\Http\Controllers\DokterController@update')->name('dokter.update');
            Route::get('delete/{id}', 'App\Http\Controllers\DokterController@destroy')->name('dokter.delete');
        });

        Route::prefix('apoteker')->group(function () {
            // Apoteker
            Route::get('/', 'App\Http\Controllers\ApotekerController@index')->name('apoteker');
            Route::get('create', 'App\Http\Controllers\ApotekerController@create')->name('apoteker.create');
            Route::post('store', 'App\Http\Controllers\ApotekerController@store')->name('apoteker.store');
            Route::get('edit/{id}', 'App\Http\Controllers\ApotekerController@edit')->name('apoteker.edit');
            Route::post('update/{id}', 'App\Http\Controllers\ApotekerController@update')->name('apoteker.update');
            Route::get('delete/{id}', 'App\Http\Controllers\ApotekerController@destroy')->name('apoteker.delete');
        });

        Route::prefix('perawat')->group(function () {
            // Apoteker
            Route::get('/', 'App\Http\Controllers\PerawatController@index')->name('perawat');
            Route::get('create', 'App\Http\Controllers\PerawatController@create')->name('perawat.create');
            Route::post('store', 'App\Http\Controllers\PerawatController@store')->name('perawat.store');
            Route::get('edit/{id}', 'App\Http\Controllers\PerawatController@edit')->name('perawat.edit');
            Route::post('update/{id}', 'App\Http\Controllers\PerawatController@update')->name('perawat.update');
            Route::get('delete/{id}', 'App\Http\Controllers\PerawatController@destroy')->name('perawat.delete');
        });

        Route::prefix('pasien')->group(function () {
            // Apoteker
            Route::get('/', 'App\Http\Controllers\PasienController@index')->name('pasien');
            Route::get('create', 'App\Http\Controllers\PasienController@create')->name('pasien.create');
            Route::post('find', 'App\Http\Controllers\PasienController@find')->name('pasien.find');
            Route::post('kunjungan', 'App\Http\Controllers\PasienController@kunjungan')->name('pasien.kunjungan');
            Route::post('store', 'App\Http\Controllers\PasienController@store')->name('pasien.store');
            Route::get('edit/{id}', 'App\Http\Controllers\PasienController@edit')->name('pasien.edit');
            Route::post('update/{id}', 'App\Http\Controllers\PasienController@update')->name('pasien.update');
            Route::get('delete/{id}', 'App\Http\Controllers\PasienController@destroy')->name('pasien.delete');
        });

        Route::prefix('kunjungan')->group(function () {
            // Kunjungan
            Route::get('/', 'App\Http\Controllers\KunjunganController@index')->name('kunjungan');
            Route::post('find', 'App\Http\Controllers\KunjunganController@find')->name('kunjungan.find');
            Route::post('process', 'App\Http\Controllers\KunjunganController@process')->name('kunjungan.process');
            Route::get('edit/{id}', 'App\Http\Controllers\KunjunganController@edit')->name('kunjungan.edit');
            Route::post('update/{id}', 'App\Http\Controllers\KunjunganController@update')->name('kunjungan.update');
            Route::get('print/{id}', 'App\Http\Controllers\KunjunganController@print')->name('kunjungan.print');
            Route::get('delete/{id}', 'App\Http\Controllers\KunjunganController@destroy')->name('kunjungan.delete');
        });

        Route::prefix('cetak')->group(function () {
            Route::get('/', 'App\Http\Controllers\KunjunganController@cetak')->name('cetak');
            Route::get('cetakExcel/{id}', 'App\Http\Controllers\KunjunganController@cetakExcel')->name('cetakExcel');
        });

        Route::prefix('pembayaran')->group(function() {
            Route::get('/', 'App\Http\Controllers\KunjunganController@pembayaran')->name('pembayaran');
            Route::get('detail/{id}', 'App\Http\Controllers\KunjunganController@detailPembayaran')->name('pembayaran.detail');
            Route::get('print/{id}', 'App\Http\Controllers\KunjunganController@printStruk')->name('pembayaran.print');
            Route::post('process/{id}', 'App\Http\Controllers\KunjunganController@processPembayaran')->name('pembayaran.process');
        });

        Route::prefix('users')->group(function () {
            Route::get('/', 'App\Http\Controllers\UsersController@index')->name('users');
            Route::get('create', 'App\Http\Controllers\UsersController@create')->name('users.create');
            Route::post('store', 'App\Http\Controllers\UsersController@store')->name('users.store');
            Route::get('edit/{id}', 'App\Http\Controllers\UsersController@edit')->name('users.edit');
            Route::post('update/{id}', 'App\Http\Controllers\UsersController@update')->name('users.update');
            Route::get('delete/{id}', 'App\Http\Controllers\UsersController@destroy')->name('users.delete');
            Route::get('detail/{id}', 'App\Http\Controllers\UsersController@show')->name('users.show');
        });
    });
});

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
Auth::routes();

Route::get('/', 'HomeController@root')->name('root');

Route::group(['middleware' => ['XSS','auth']], function() {
    Route::get('/home', 'HomeController@index')->name('home');
});

Route::group(['prefix'=>'pengguna','middleware' => ['XSS','auth','role:administrator|admin super']], function() {
    Route::resource('user', 'Pengguna\UserController')->parameters(['user' => 'id']);
});

Route::group(['prefix'=>'master','middleware' => ['XSS','auth','role:admin super']], function() {
    Route::resource('opd', 'Master\MasterOpdController')->parameters(['opd' => 'id']);
    Route::resource('posisi', 'Master\MasterPosisiController')->parameters(['posisi' => 'id']);
});

Route::group(['prefix'=>'tenaga-kerja','middleware' => ['XSS','auth','role:admin super|admin opd']], function() {
    Route::get('honorer/contoh-data', 'TenagaKerja\HonorerController@exampleData')->name('honorer.example');
    Route::get('honorer/excel', 'TenagaKerja\HonorerController@excel')->name('honorer.excel');
    Route::get('honorer/pdf', 'TenagaKerja\HonorerController@pdf')->name('honorer.pdf');
    Route::post('honorer/import', 'TenagaKerja\HonorerController@import')->name('honorer.import');
    Route::post('honorer/{id?}/approve', 'TenagaKerja\HonorerController@approve')->name('honorer.approve');
    
    // Route::get('tks/excel', 'TenagaKerja\TksController@excel')->name('tks.excel');
    // Route::get('tks/pdf', 'TenagaKerja\TksController@pdf')->name('tks.pdf');

    Route::resource('honorer', 'TenagaKerja\HonorerController')->parameters(['honorer' => 'id']);
    Route::resource('tks', 'TenagaKerja\TksController')->parameters(['tks' => 'id']);
});

Route::group(['middleware' => ['XSS','auth','role:admin super|admin opd']], function() {
    Route::resource('struktur-organisasi', 'StrukturOrganisasiController')->parameters(['struktur-organisasi' => 'id']);
});

Route::get('/debug','DebugController@index');
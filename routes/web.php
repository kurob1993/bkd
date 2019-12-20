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

Route::get('/', function () {
    if(!Auth::user()){
        //untuk virutal host
        return redirect()->route('login');

        //jika tidak menggukalan virtual host
        // return redirect()->guest('/public/login');
    }else{
        return redirect()->route('home');
    }
});

Route::group(['middleware' => ['auth']], function() {
    Route::get('/home', 'HomeController@index')->name('home');
});

Route::group(['prefix'=>'pengguna','middleware' => ['auth','role:administrator|admin super']], function() {
    Route::resource('user', 'Pengguna\UserController')->parameters(['user' => 'id']);
});

Route::group(['prefix'=>'master','middleware' => ['auth','role:admin super']], function() {
    Route::resource('opd', 'Master\MasterOpdController')->parameters(['opd' => 'id']);
});

Route::group(['prefix'=>'tenaga-kerja','middleware' => ['auth','role:admin super|admin opd']], function() {
    Route::get('honorer/excel', 'TenagaKerja\HonorerController@excel')->name('honorer.excel');
    Route::get('honorer/pdf', 'TenagaKerja\HonorerController@pdf')->name('honorer.pdf');
    Route::resource('honorer', 'TenagaKerja\HonorerController')->parameters(['honorer' => 'id']);
    Route::resource('struktur-organisasi', 'StrukturOrganisasiController')->parameters(['struktur-organisasi' => 'id']);
});

// Route::group(['middleware' => ['auth','role:administrator|admin']], function() {
//     Route::resource('materi', 'MateriRakoorController')->parameters(['materi' => 'id']);
    
//     Route::get('partisipan/user','PartisipanController@user')->name('partisipan.user');
//     Route::resource('partisipan', 'PartisipanController')->parameters(['partisipan' => 'id']);
    
//     Route::get('notulis/user','NotulisController@user')->name('notulis.user');
//     Route::resource('notulis', 'NotulisController')->parameters(['notulis' => 'id']);
// });

// Route::group(['middleware' => ['auth','role:notulis|administrator|admin']], function() {
//     Route::get('notulen/user/{q?}','NotulenController@user')->name('notulen.user');
//     Route::resource('notulen', 'NotulenController')->parameters(['notulen' => 'id']);
// });

// Route::group(['middleware' => ['auth','permission:read materis|read partisipans']], function() {
//     Route::resource('materi', 'MateriRakoorController')->parameters(['materi'=>'id'])->only(['index','show']);
//     Route::resource('partisipan', 'PartisipanController')->parameters(['partisipan'=>'id'])->only(['index','show']);
//     Route::get('notulen/view-notulen/{id?}','NotulenController@viewNotulen')->name('notulen.viewNotulen');
//     Route::get('notulen/view/{id?}','NotulenController@view')->name('notulen.view');

//     Route::get('progres-kerja/view/{id?}','ProgresKerjaController@view')->name('progres-kerja.view');
//     Route::get('progres-kerja/list-proker','ProgresKerjaController@listProker')->name('progres-kerja.listproker');
//     Route::resource('progres-kerja', 'ProgresKerjaController')
//     ->parameters(['progres-kerja'=>'id'])->only(['index','show']);;
// });

// Route::group(['middleware' => ['auth','role:pic|administrator']], function() {
//     Route::get('progres-kerja/user/{id?}','ProgresKerjaController@user')->name('progres-kerja.user');
//     Route::resource('progres-kerja', 'ProgresKerjaController')->parameters(['progres-kerja'=>'id']);
// });
Route::get('/debug','DebugController@index');
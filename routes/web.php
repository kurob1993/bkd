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
    Route::get('notulen/user/{q?}','NotulenController@user')->name('notulen.user');
    Route::resource('notulen', 'NotulenController');
});

Route::group(['middleware' => ['auth','role:administrator|admin']], function() {
    Route::resource('materi', 'MateriRakoorController')
    ->parameters([
        'materi' => 'id'
    ])
    ->except([
        'index','show'
    ]);
    
    Route::get('partisipan/judul/{q?}','PartisipanController@judul')->name('partisipan.judul');
    Route::get('partisipan/user/{q?}','PartisipanController@user')->name('partisipan.user');
    Route::resource('partisipan', 'PartisipanController');
    Route::resource('notulis', 'NotulisController')->except([
        'index','show'
    ]);
});
Route::group(['middleware' => ['auth','role_or_permission:administrator|admin|read materis']], function() {
    Route::resource('materi', 'MateriRakoorController')
    ->parameters([
        'materi' => 'id'
    ])
    ->only([
        'index','show'
    ]);
});
Route::get('/debug','DebugController@index');
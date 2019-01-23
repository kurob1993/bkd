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

Route::group(['middleware' => ['auth','role:administrator|admin']], function() {
    Route::resource('materi', 'MateriRakoorController')->parameters(['materi' => 'id']);
    
    Route::get('partisipan/user','PartisipanController@user')->name('partisipan.user');
    Route::resource('partisipan', 'PartisipanController')->parameters(['partisipan' => 'id']);
    
    Route::get('notulis/user','NotulisController@user')->name('notulis.user');
    Route::resource('notulis', 'NotulisController')->parameters(['notulis' => 'id']);
    Route::get('notulen/user/{q?}','NotulenController@user')->name('notulen.user');
});

Route::group(['middleware' => ['auth','role:notulis|administrator|admin']], function() {
    Route::resource('notulen', 'NotulenController')->parameters(['notulen' => 'id']);
});

Route::group(['middleware' => ['auth','permission:read materis|read partisipans']], function() {
    Route::resource('materi', 'MateriRakoorController')->parameters(['materi'=>'id'])->only(['index','show']);
    Route::resource('partisipan', 'PartisipanController')->parameters(['partisipan'=>'id'])->only(['index','show']);
});
Route::get('/debug','DebugController@index');
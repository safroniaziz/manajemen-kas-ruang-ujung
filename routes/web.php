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

Route::get('/', function () {
    return view('auth.login');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::group(['prefix'  =>  'admin'], function(){
    Route::get('/login','AuthAdmin\LoginAdminController@showLoginForm')->name('admin.login');
    Route::post('/login','AuthAdmin\LoginAdminController@login')->name('admin.login.submit');
    Route::get('/','Admin\DashboardController@dashboard')->name('admin.dashboard');
});

Route::group(['prefix'	=>	'admin/pengaturan_periode'],function(){
    Route::get('/','Admin\PengaturanPeriodeController@index')->name('admin.pengaturan_periode');
});

Route::group(['prefix'	=>	'admin/transaksi_pemasukan'],function(){
    Route::get('/','Admin\PemasukanController@index')->name('admin.pemasukan');
    Route::post('/','Admin\PemasukanController@post')->name('admin.pemasukan.post');
    Route::get('/{id}/edit','Admin\PemasukanController@edit')->name('admin.pemasukan.edit');
    Route::patch('/{id}','Admin\PemasukanController@update')->name('admin.pemasukan.update');
});

//Route Anggota
Route::get('/anggota','Anggota\DashboardController@dashboard')->name('anggota.dashboard');
// Route::get('/')
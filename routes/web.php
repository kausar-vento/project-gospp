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
    return view('welcome');
});
Route::get('register-siswa', function () {
    return view('siswa.register');
});



Auth::routes(['register' => false]);
// ADMIN
Route::get('/home', 'HomeController@index')->name('home');
// -------------------------------------------------ADMIN//
Route::get('/login/admin', 'Auth\LoginController@showAdminLoginForm');
Route::get('/register/admin', 'Auth\RegisterController@showAdminRegisterForm');
Route::post('/login/admin', 'Auth\LoginController@adminLogin');
Route::post('/register/admin', 'Auth\RegisterController@createAdmin');
Route::get('/admin', 'AdminController@home');
Route::get('/datasiswa', 'SiswaController@index')->name('datasiswa');
// -------------------------------------------------PETUGAS//
Route::get('/login/writer', 'Auth\LoginController@showWriterLoginForm');
Route::get('/register/writer', 'Auth\RegisterController@showWriterRegisterForm');
Route::post('/login/writer', 'Auth\LoginController@writerLogin');
Route::post('/register/writer', 'Auth\RegisterController@createWriter');
Route::view('/writer', 'petugas.home');

// -------------------------------------------------KELAS//
Route::get('/kelas', 'KelasController@index')->name('kelas');
Route::get('/tambah-kelas', 'KelasController@tambah')->name('tambah-kelas');
Route::post('/simpan', 'KelasController@simpan')->name('kelas.simpan');
Route::get('/edit-kelas{id}', 'KelasController@edit')->name('edit_saja');
Route::post('/kelas-update', 'KelasController@update')->name('kelas-update');
// ----------------------------------------------------SPP
Route::get('/spp', 'SppController@index')->name('spp');
Route::get('/tambah-spp', 'SppController@create')->name('tambah-spp');
Route::post('/save', 'SppController@store')->name('spp.save');
Route::get('/edit-spp{id}', 'SppController@edit')->name('edt');
Route::get('/hapus/{id}', 'SppController@delete')->name('hapus');
Route::post('/update', 'SppController@update')->name('spp.update');

Route::get('/list-bayar', 'PembayaranController@index')->name('list-bayar');
Route::get('/list-bayar-petugas', 'PembayaranController@view')->name('petugas.bayar');
Route::get('/pembayaran', 'PembayaranController@create')->name('pembayaran');
Route::get('/bayar-petugas', 'PembayaranController@tambah')->name('bayar-petugas');
Route::post('/proses', 'PembayaranController@store')->name('proses-pembayaran');
// ------------------------EDIT MURID------------------//
Route::get('/edit/user/', 'ProfileController@edit')->name('user.edit');
Route::post('/edit/user/', 'ProfileController@update')->name('user.update');
Route::get('/tambah-murid', 'ProfileController@create')->name('tambah-murid');
Route::post('/simpan-murid', 'ProfileController@store')->name('simpan.murid');
Route::get('/list-siswa', 'ProfileController@index')->name('list-siswa');

//-----------------------PETUGAS-------------------------//
Route::get('/petugas', 'OperatorController@index')->name('petugas');
Route::get('/delete/{id}', 'OperatorController@delete')->name('delete');
Route::get('/tambah-petugas', 'OperatorController@create')->name('tambah-petugas');
Route::post('/simpan-petugas', 'OperatorController@store')->name('petugas.save');
Route::get('/edit-petugas{id}', 'OperatorController@edit')->name('edit.petugas');
Route::post('/update-petugas', 'OperatorController@update')->name('save.petugas');

Route::get('/siswa/export_excel', 'ProfileController@export');

Route::get('chart', 'AdminController@home');

Route::get('/home', 'HomeController@index')->name('home');


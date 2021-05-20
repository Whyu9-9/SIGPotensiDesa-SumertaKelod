<?php

use Illuminate\Support\Facades\Route;

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

// Route::get('/', function () {
//     return view('user.home');
// });
Route::get('/', 'user\DashboardController@dashboard');
Route::get('/login','admin\AuthController@loginpage')->name('user-login');
Route::post('/login/submit','admin\AuthController@login')->name('user-login-submit');
Route::get('/loadDataDesa/{id}', 'user\DashboardController@loadDataDesa');
Route::get('/loadDataSekolah/{id}', 'user\DashboardController@loadDataDesa');
Route::get('/loadDataPasar/{id}', 'user\DashboardController@loadDataPasar');
Route::get('/loadDataTempatIbadah/{id}', 'user\DashboardController@loadDataTempatIbadah');
Route::get('/loadDataTempatWisata/{id}', 'user\DashboardController@loadDataTempatWisata');
Route::prefix('admin')->group(function () {
    Route::get('/loadDataDesa/{id}', 'admin\HomeController@loadDataDesa');
    Route::get('/', 'admin\HomeController@Home')->name('admin-home');
    Route::get('/dashboard', 'admin\HomeController@Home')->name('admin-home');
    Route::resource('kabupaten', 'admin\KabupatenController');
    Route::resource('kecamatan', 'admin\KecamatanController');
    Route::get('/kecamatan/{id}', 'admin\KecamatanController@getKecamatan');
    Route::resource('desa', 'admin\DesaController');
    Route::prefix('potensi')->group(function () {
        Route::resource('sekolah', 'admin\SekolahController');
        Route::resource('tempatibadah', 'admin\TempatIbadahController');
        Route::resource('tempatwisata', 'admin\TempatWisataController');
        Route::resource('pasar', 'admin\PasarController');
    });
    Route::get('/logout','admin\AuthController@logout')->name('admin-logout');
});
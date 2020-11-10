<?php

use Illuminate\Support\Facades\Auth;
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

Route::get('/', function () {
    return view('dashbord');
});

Auth::routes();

// Route::get('/home', 'HomeController@index')->name('home');
Route::get('/home', 'ChatController@index')->name('home');
Route::get('/halchat/{id}', 'ChatController@getMessage');
Route::post('/halchat', 'ChatController@sendMessage');


// Route::group(['middleware' => 'jwt-verify'], function() {
Route::resource('/ModeBank', 'ModBankController');
Route::resource('/Kota', 'KotaController');
Route::resource('/Hubungi', 'HubungiController');
Route::resource('/Kategori', 'KategoriController');
Route::resource('/Keranjang', 'KeranjangController');
Route::resource('/MainMenu', 'MainMenuController');
Route::resource('/Order', 'OrderController');
Route::resource('/Penjual', 'PenjualController');
Route::resource('/Produk', 'ProdukController');
    
// });

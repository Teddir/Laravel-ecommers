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
    return view('welcome');
});

Auth::routes();

// Route::get('/home', 'HomeController@index')->name('home');
        //route Chat
Route::get('/home', 'ChatController@index')->name('home'); 
Route::get('/message/{id}', 'ChatController@getMessage');
Route::post('/message', 'ChatController@sendMessage');


Route::group(['middleware' => 'jwt-verify'], function() {
    //route mod bank
Route::resource('/ModeBank', 'ModBankController');
    //route kota
Route::resource('/Kota', 'KotaController');
    //route hubungi
Route::resource('/Hubungi', 'HubungiController');
    //route kategori
Route::resource('/Kategori', 'KategoriController');
    //route keranjang
Route::resource('/Keranjang', 'KeranjangController');
    //route mainmenu
Route::resource('/MainMenu', 'MainMenuController');
    //route order
Route::resource('/Order', 'OrderController');
    //route penjual
Route::resource('/Penjual', 'PenjualController');
    //route produk
Route::resource('/Produk', 'ProdukController');
    
});

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

Route::get('/home', function () {
    return view('home');
});

Route::get('/create', function () {
    return view('Tampilan.Produk.create');
});


Auth::routes();

// Route::get('/home', 'HomeController@index')->name('home');


//route Chat
Route::get('/chat', 'ChatController@index'); 
Route::get('/message/{id}', 'ChatController@getMessage');
Route::post('/message', 'ChatController@sendMessage');

// Route::group(['middleware' => 'auth'], function() {
    
    //route mod bank
    Route::resource('/modeBank', 'ModBankController')->except('create','show');
    //route kota
    Route::resource('/kota', 'KotaController');
    //route hubungi
    Route::resource('/hubungi', 'HubungiController');
    //route kategori
    Route::resource('/kategori', 'KategoriController');
    //route keranjang
    Route::resource('/keranjang', 'KeranjangController');
    //route mainmenu
    Route::resource('/mainMenu', 'MainMenuController');
    //route order
    Route::resource('/order', 'OrderController');
    //route penjual
    Route::resource('/penjual', 'PenjualController');
    //route produk
    Route::resource('/produk', 'ProdukController');
    
    //route Admin
    
// });
Route::get('/dashbord', 'ProdukController@index'); 
// Route::get('/create', 'ProdukController@index1'); 
Route::get('/cari', 'ProdukController@render'); 

Route::get('/login/facebook', 'Auth\LoginController@redirectToProvider');
Route::get('/login/facebook/callback', 'Auth\LoginController@handleProviderCallback');
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

// Route::get('/home', function () {
//     return view('home');
// });

// Route::get('/store', function () {
//     return view('website.store');
// });


// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/penjualan', function () {
    return view('send_email');
});



// Route::get('/store', 'ProdukController@produkat');
// Route::get('/store', 'ProdukController@produkall');

Auth::routes();

// Route::get('/home', 'HomeController@index')->name('home');

Route::get('admin/login', 'Auth\AdminAuthController@getLogin')->name('admin.login');
Route::post('admin/login', 'Auth\AdminAuthController@postLogin');
Route::get('/website', 'Produk\Web\ProdukController@newproduk');


//route Chat
Route::group(['middleware' => 'auth'], function () {
    Route::get('/chat', 'ChatController@index');
    Route::get('/message/{id}', 'ChatController@getMessage');
    Route::post('/message', 'ChatController@sendMessage');
    // Route::get('/create', 'ProdukController@index1'); 
    
    
    Route::get('/cari', 'Produk\Web\ProdukController@render');
    Route::get('/login/facebook', 'Auth\LoginController@redirectToProvider');
    Route::get('/login/facebook/callback', 'Auth\LoginController@handleProviderCallback');
    
    
    Route::get('/edit3/{id}', 'Keranjang\Web\KeranjangController@edit1');
    
    //---------------------------------------------------------->website
    Route::post('/website/pesan/{id}', 'Keranjang\Web\KeranjangController@pesan1');
    Route::get('/website/chekout', 'Keranjang\Web\KeranjangController@chekout1');
    Route::get('/website/chekout/delete/{id}', 'Keranjang\Web\KeranjangController@destroy1');
    Route::get('/website/chekout/konfirmasi', 'Keranjang\Web\KeranjangController@konfirmasi1');
    Route::get('/cari', 'Keranjang\Web\KeranjangController@cari');
    
    
    
});

//email


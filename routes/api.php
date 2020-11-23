<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/



Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
// Route::get('/', function () {
//     return view('welcome');
// });
//route Auth
Route::post('register', 'UserController@register');
Route::post('login', 'UserController@login');

Route::post('logout', 'UserController@logout');
Route::get('/chat', 'ChatController@allchat');


//route produk
Route::get('/produk', 'ProdukController@index');
Route::get('/produk/{id}', 'ProdukController@show');

Route::group(['middleware' => 'jwt.verify'], function () {
    
    
    // -----------------------------------------------------> produk
    
    Route::get('/produkp', 'ProdukController@produkpenjual');      //------------->produkpenjualaja
    Route::put('/produk/{id}', 'ProdukController@update');
    Route::post('/produk', 'ProdukController@store');
    Route::delete('/produk/{id}', 'ProdukController@destroy');
    Route::post('/searc', 'ProdukController@searc'); //-----------> Searching  Produk

    // -----------------------------------------------------> end produk

    // -----------------------------------------------------> chet
    Route::get('/message/{id}', 'ChatController@getMessage');
    Route::post('/message', 'ChatController@sendMessage');

    //route hubungi
    Route::resource('/hubungi', 'HubungiController');

    //route kategori
    Route::resource('/kategori', 'KategoriController');

    //route keranjang
    Route::get('/keranjang', 'KeranjangController@index'); //----------------->nampilin all aja di keranjang 
    Route::get('/keranjangaja/', 'KeranjangController@detailkeranjang'); //-----------> detail barang si user di dalam Ke keranjang
    Route::post('/keranjang/{id}', 'KeranjangController@pesan'); //------------> tambah ke keranjang
    Route::delete('/keranjang/delete/{id}', 'KeranjangController@destroy'); //-----------> hapus barang ke keranjang
    Route::post('/keranjang/chekout/', 'KeranjangController@konfirmasi'); //-----------> chekout

    //route Penjual
    Route::resource('/penjual', 'PenjualController');

    Route::get('user', 'UserController@index');  //-------->nampilin semua user
    Route::get('useraja', 'UserController@getAuthenticatedUser');  //-------->nampilin 1 user
    Route::get('userp', 'UserController@userp');         //-------------delete
    Route::put('user/update', 'UserController@update');           //----------update
    Route::delete('user/{id}', 'UserController@destroy');         //-------------delete
    Route::get('user/{id}', 'UserController@show');         //-------------delete



    Route::get('/allchat', 'ChatController@allchat');  //---------->menampilkan semua chat
    Route::get('/chat/{id}', 'ChatController@index1');    //----------------------->menampilkan setiap ada chat
    Route::post('/searc/pesan', 'ChatController@searc'); //-----------> Searching  Message
    Route::get('/get/pesan', 'ChatController@getMessage'); //-----------> Nampilin  Message
    Route::post('/send/pesan', 'ChatController@sendMessage'); //-----------> Kirim  Message

});

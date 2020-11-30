<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Controller;

$route = 
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
Route::post('register', 'User\Api\UserController@register');
Route::post('login', 'User\Api\UserController@login');

Route::post('logout', 'User\Api\UserController@logout');
Route::get('/chat', 'ChatController@allchat');


//route produk
Route::get('/produk', 'Produk\Api\ProdukController@index');
Route::get('/produk/{id}', 'Produk\Api\ProdukController@show');

Route::group(['middleware' => 'jwt.verify'], function () {
    
    
    // -----------------------------------------------------> produk
    
    Route::get('/produkp', 'Produk\Api\ProdukController@produkpenjual');      //------------->produkpenjualaja
    Route::put('/produk/{id}', 'Produk\Api\ProdukController@update');    //-------------- Update Data
    Route::post('/produk', 'Produk\Api\ProdukController@store');          //------------------------Tambah Data
    Route::delete('/produk/delete/{id}', 'Produk\Api\ProdukController@destroy');  //----------> Delete data
    Route::post('/searc', 'Produk\Api\ProdukController@render'); //-----------> Searching  Produk

    // -----------------------------------------------------> end produk

    // -----------------------------------------------------> chet
    Route::get('/message/{id}', 'ChatController@getMessage');
    Route::post('/message', 'ChatController@sendMessage');

    //route hubungi
    Route::resource('/hubungi', 'HubungiController');

    //route keranjang
    Route::get('/keranjang', 'Keranjang\Api\KeranjangController@index'); //----------------->nampilin all aja di keranjang 
    Route::get('/keranjangaja', 'Keranjang\Api\KeranjangController@detailkeranjang'); //-----------> detail barang si user di dalam Ke keranjang
    Route::post('/keranjang/{id}', 'Keranjang\Api\KeranjangController@pesan'); //------------> tambah ke keranjang
    Route::delete('/keranjang/delete/{id}', 'Keranjang\Api\KeranjangController@destroy'); //-----------> hapus barang ke keranjang
    Route::post('/keranjangaja/chekout', 'Keranjang\Api\KeranjangController@konfirmasi'); //-----------> chekout

    //route Penjual
    Route::resource('/penjual', 'Penjual\Api\PenjualController');

    Route::get('/user', 'User\Api\UserController@index');  //-------->nampilin semua user
    Route::get('/useraja', 'User\Api\UserController@getAuthenticatedUser');  //-------->nampilin 1 user
    Route::get('/userp', 'User\Api\UserController@userp');         //-------------data si user aja
    Route::put('/user/update', 'User\Api\UserController@update');           //----------update
    Route::delete('/user/{id}', 'User\Api\UserController@destroy');         //-------------delete
    Route::get('/user/{id}', 'User\Api\UserController@show');         //-------------delete

    Route::get('/allchat', 'ChatController@allchat');  //---------->menampilkan semua chat
    Route::get('/chat/{id}', 'ChatController@index1');    //----------------------->menampilkan setiap ada chat
    Route::post('/searc/pesan', 'ChatController@searc'); //-----------> Searching  Message
    Route::get('/get/pesan', 'ChatController@getMessage1'); //-----------> Nampilin  Message
    Route::post('/send/pesan', 'ChatController@sendMessage'); //-----------> Kirim  Message

    Route::get('/finish', 'FinishController@finish');         //-------------finish
    Route::get('/finishp', 'FinishController@finishp');         //-------------finish penjual
    Route::get('/finishb', 'FinishController@finishb');         //-------------finish pembeli
});

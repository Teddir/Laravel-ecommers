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

// Route::get('user', 'UserController@getAuthenticatedUser');

Route::post('register', 'UserController@register');
Route::post('login', 'UserController@login');
Route::get('/chat', 'ChatController@index')->name('home');
Route::resource('/Produk', 'ProdukController');

Route::group(['middleware' => 'jwt.verify'], function (){
    Route::post('/user', 'UserController@update');
    Route::resource('/modeank', 'ModBankController');
    Route::resource('/kota', 'KotaController');
    Route::resource('/hubungi', 'HubungiController');
    Route::resource('/kategori', 'KategoriController');
    Route::resource('/keranjang', 'KeranjangController');
    Route::resource('/mainMenu', 'MainMenuController');
    Route::resource('/orderdetail', 'OrderDetailController');
    Route::resource('/order', 'OrderController');
    // Route::resource('/Pembeli', 'PembeliController');
    // Route::resource('/Penjual', 'PenjualController');

    // -----------------------------------------------------> chet
    
    Route::get('/message/{id}', 'ChatController@getMessage');
    Route::post('/message', 'ChatController@sendMessage');

});

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
Route::get('/', function () {
    return view('welcome');
});

    //route Auth
Route::post('register', 'UserController@register');
Route::post('login', 'UserController@login');
Route::get('/chat', 'ChatController@index')->name('home');


    //route produk
Route::resource('/produk', 'ProdukController');

Route::group(['middleware' => 'jwt.verify'], function() {
    
    // -----------------------------------------------------> chet
    Route::get('/message/{id}', 'ChatController@getMessage');
    Route::post('/message', 'ChatController@sendMessage');

    //route mod bank
    Route::resource('/modeank', 'ModBankController');

    //route kota
    Route::resource('/kota', 'KotaController');

    //route hubungi
    Route::resource('hubungi', 'HubungiController');

    //route kategori
    Route::resource('/kategori', 'KategoriController');

    //route keranjang
    Route::resource('/keranjang', 'KeranjangController');

    //route mainmenu
    Route::resource('/mainMenu', 'MainMenuController');

    //route order
    Route::resource('order', 'OrderController');

    //route orderdetail
    Route::resource('/orderdetail', 'OrderDetailController');

    //route penjual
    // Route::resource('/Pembeli', 'PembeliController');
    Route::resource('/penjual', 'PenjualController');
});
    

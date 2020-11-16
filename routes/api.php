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
    Route::get('/chat', 'ChatController@index')->name('home');
    
    
    //route produk
    // Route::resource('/produk', 'ProdukController');
    
    Route::group(['middleware' => 'jwt.verify'], function () {
        
        Route::resource('/produk', 'ProdukController');
        // -----------------------------------------------------> chet
        Route::get('/message/{id}', 'ChatController@getMessage');
        Route::post('/message', 'ChatController@sendMessage');
        
        //route mod bank
        Route::resource('/modebank', 'ModBankController');
        
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
                
        Route::resource('/penjual', 'PenjualController');
    
        Route::get('user', 'UserController@getAuthenticatedUser');  //-------->nampilin
        Route::put('user/{id}', 'UserController@update');           //----------update
        Route::delete('user/{id}', 'UserController@destroy');         //-------------delete
    });
    
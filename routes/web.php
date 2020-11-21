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

// Route::get('/', function () {
//     return view('welcome');
// });

// Route::get('/home', function () {
//     return view('home');
// });

// Route::get('/store', function () {
//     return view('website.store');
// });


// Route::get('/', function () {
//     return view('welcome');
// });

// Route::get('/Doc', function () {
//     return view('bersama');
// });



// Route::get('/store', 'ProdukController@produkat');
// Route::get('/store', 'ProdukController@produkall');

Auth::routes();

// Route::get('/home', 'HomeController@index')->name('home');


//route Chat
Route::group(['middleware' => 'auth'], function () {
    Route::get('/chat', 'ChatController@index');
    Route::get('/message/{id}', 'ChatController@getMessage');
    Route::post('/message', 'ChatController@sendMessage');
    // Route::get('/create', 'ProdukController@index1'); 
    
    
    Route::get('/cari', 'ProdukController@render');
    Route::get('/login/facebook', 'Auth\LoginController@redirectToProvider');
    Route::get('/login/facebook/callback', 'Auth\LoginController@handleProviderCallback');
    
    
    Route::get('/edit3/{id}', 'KeranjangController@edit1');
    
    //---------------------------------------------------------->website
    Route::get('/website', 'ProdukController@newproduk');
    Route::post('/website/pesan/{id}', 'KeranjangController@pesan1');
    Route::get('/website/chekout', 'KeranjangController@chekout1');
    Route::get('/website/chekout/delete/{id}', 'KeranjangController@destroy1');
    Route::get('/website/chekout/konfirmasi', 'KeranjangController@konfirmasi1');
    Route::get('/cari', 'KeranjangController@cari');

    
    
});


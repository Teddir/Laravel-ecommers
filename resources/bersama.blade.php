<?php


user [
  'name', 'email', 'password','alamat','phone_number','image','alamat','status',
  'produk_id','kategori_id','kota_id'
];

produk = [
        'name_produk', 'desc', 'harga','stok','image','diskon','status',
        'kategori_id','user_id'
    ];

order = [
    'invoice', 'subtotal', 'status','pengiriman','pesan',
    'user_id','produk_id'
];

penjual = [
        'name_toko','phone_number',
        'message_id','penjual_id', //---->user is penjual
    ];

message = ['from', 'to', 'message', 'is_read'];


kotas = [
        'name_kota', 'onkos_kirim',protected $fillable
    ];

keranjang = [
    'jumlah', 'qty', 'produk_name','produk_price','produk_image',
    'user_id','produk_id'
];

KATEGORI = [
    'name_kategori',
    'parent_id'
    // 'tgl_posting'---> diganti sama created_at
];

HUBUNGI = [
    'email', 'subjek', 'message',
    'hubungi_id',
];


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
Route::get('/produk', 'ProdukController@index');
Route::get('/produk/{id}', 'ProdukController@show');

Route::group(['middleware' => 'jwt.verify'], function () {
    
    Route::get('/produkT', 'ProdukController@store');
    Route::put('/produk/{id}', 'ProdukController@update');
    Route::delete('/produk/{id}', 'ProdukController@destroy');
    
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

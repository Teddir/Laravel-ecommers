<?php

Route::group(['middleware' => 'auth:admin'], function () {
  //--------------------------------------------------->tampilan E-Produk
  Route::get('/index1', 'Produk\Web\ProdukController@index1');
  Route::get('/tambah1', 'Produk\Web\ProdukController@show1');
  Route::get('/edit1/{id}', 'Produk\Web\ProdukController@edit1');
  //--------------------------------------------------->crud
  Route::post('/create1', 'Produk\Web\ProdukController@store1');
  Route::put('/update1/{id}', 'Produk\Web\ProdukController@update1');
  Route::delete('/destroy1/{id}', 'Produk\Web\ProdukController@destroy1');

  //--------------------------------------------------->tampilan E-Penjuals
  Route::get('/index2', 'Penjual\Web\PenjualController@index1');
  Route::get('/tambah2', 'Penjual\Web\PenjualController@show1');
  Route::get('/edit2/{id}', 'Penjual\Web\PenjualController@edit1');
  //--------------------------------------------------->crud  
  Route::post('/create2', 'Penjual\Web\PenjualController@store1');
  Route::put('/update2/{id}', 'Penjual\Web\PenjualController@update1');
  Route::get('/destroy2/{id}', 'Penjual\Web\PenjualController@destroy1');


  //--------------------------------------------------->tampilan E-Pembeli
  Route::get('/index3', 'User\Web\UserController@index1');
  Route::get('/tambah3', 'User\Web\UserController@show1');
  Route::get('/edit3/{id}', 'User\Web\UserController@edit1');
  //--------------------------------------------------->crud  
  Route::post('/create3', 'User\Web\UserController@store1');
  Route::put('/update3/{id}', 'User\Web\UserController@update1');
  Route::delete('/destroy3/{id}', 'User\Web\UserController@destroy1');

  //--------------------------------------------------->tampilan E-Kategori
  Route::get('/index4', 'Kategori\Web\KategoriController@index1');
  Route::post('/create4', 'Kategori\Web\KategoriController@store1');
});

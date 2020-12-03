<?php

Route::group(['middleware' => 'auth'], function () {
  //--------------------------------------------------->tampilan E-Produk
  Route::get('/index1', 'Produk\Web\ProdukController@index2');
  Route::get('/tambah1', 'Produk\Web\ProdukController@show2');
  Route::get('/edit1/{id}', 'Produk\Web\ProdukController@edit2');
  //--------------------------------------------------->crud
  Route::post('/create1', 'Produk\Web\ProdukController@store2');
  Route::put('/update1/{id}', 'Produk\Web\ProdukController@update2');
  Route::delete('/destroy1/{id}', 'Produk\Web\ProdukController@destroy2');

  //--------------------------------------------------->tampilan E-Penjuals
  Route::get('/index2', 'FinishController@penjualan');
  Route::get('/tambah2', 'Penjual\Web\PenjualController@show2');
  Route::get('/edit2/{id}', 'Penjual\Web\PenjualController@edit2');
  //--------------------------------------------------->crud  
  Route::post('/create2', 'Penjual\Web\PenjualController@store2');
  Route::put('/update2/{id}', 'Penjual\Web\PenjualController@update2');
  Route::delete('/destroy2/{id}', 'Penjual\Web\PenjualController@destroy2');

  //--------------------------------------------------->tampilan E-Pembeli
  Route::get('/index3', 'User\Web\UserController@index2');
  Route::get('/edit3/{id}', 'User\Web\UserController@edit2');
  Route::get('/invoice/{id}', 'User\Web\UserController@show2');
  //--------------------------------------------------->crud  
  Route::delete('/destroy3/{id}', 'User\Web\UserController@destroy2');
  
  Route::post('/sendEmail', 'Email@sendEmail');
});



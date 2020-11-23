<?php

Route::group(['middleware' => 'auth'], function () {
  //--------------------------------------------------->tampilan E-Produk
  Route::get('/index1', 'ProdukController@index1');
  Route::get('/tambah1', 'ProdukController@show1');
  Route::get('/edit1/{id}', 'ProdukController@edit1');
  //--------------------------------------------------->crud
  Route::post('/create1', 'ProdukController@store1');
  Route::put('/update1/{id}', 'ProdukController@update1');
  Route::delete('/destroy1/{id}', 'ProdukController@destroy1');

  //--------------------------------------------------->tampilan E-Penjuals
  Route::get('/index2', 'PenjualController@index1');
  Route::get('/tambah2', 'PenjualController@show1');
  Route::get('/edit2/{id}', 'PenjualController@edit1');
  //--------------------------------------------------->crud  
  Route::post('/create2', 'PenjualController@store1');
  Route::put('/update2/{id}', 'PenjualController@update1');
  Route::delete('/destroy2/{id}', 'PenjualController@destroy1');

  //--------------------------------------------------->tampilan E-Pembeli
  Route::get('/index3', 'UserController@index1');
  //--------------------------------------------------->crud  
  Route::delete('/destroy3/{id}', 'UserController@destroy1');

});

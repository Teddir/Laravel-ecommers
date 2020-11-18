<?php

// Route::group(['middleware' => 'auth'], function () {
  //--------------------------------------------------->tampilan
  Route::get('/index1', 'ProdukController@index1');
  Route::get('/tambah1', 'ProdukController@show1');
  Route::get('/edit1/{id}', 'ProdukController@edit1');
  //--------------------------------------------------->crud
  Route::post('/create1', 'ProdukController@store1');
  Route::put('/update1/{id}', 'ProdukController@update1');
  Route::delete('/destroy1/{id}', 'ProdukController@destroy1');
  Route::get('/index9', 'ProdukController@index3');

  //--------------------------------------------------->tampilan
  Route::get('/index2', 'PenjualController@index1');
  Route::get('/tambah2', 'PenjualController@show1');
  Route::get('/edit2/{id}', 'PenjualController@edit1');
  //--------------------------------------------------->crud
  Route::post('/create2', 'PenjualController@store1');
  Route::put('/update2/{id}', 'PenjualController@update1');
  Route::delete('/destroy2/{id}', 'PenjualController@destroy1');


  //--------------------------------------------------->tampilan
  Route::get('/index3', 'KeranjangController@index1');
  Route::get('/tambah3', 'KeranjangController@show1');
  Route::get('/edit3/{id}', 'KeranjangController@edit1');
  //--------------------------------------------------->crud
  Route::post('/create3', 'KeranjangController@store1');
  Route::put('/update3/{id}', 'KeranjangController@update1');
  Route::delete('/destroy3/{id}', 'KeranjangController@destroy1');



  Route::get('/index4', 'UserController@index1');
  Route::get('/tambah4', 'UserController@show1');
  Route::get('/edit4/{id}', 'UserController@edit1');
  //--------------------------------------------------->crud
  Route::post('/create4', 'UserController@store1');
  Route::put('/update4/{id}', 'UserController@update1');
  Route::delete('/destroy4/{id}', 'UserController@destroy1');



  Route::get('/index5 ', 'OrderController@index1');
  Route::get('/tambah5', 'OrderController@show1');
  Route::get('/edit5/{id}', 'OrderController@edit1');
  Route::get('/finish', 'OrderController@finish');
  Route::get('/finish1', 'OrderController@finish1');
  //--------------------------------------------------->crud
  Route::post('/create5', 'OrderController@store1');
  Route::put('/update5/{id}', 'OrderController@update1');
  Route::delete('/destroy5/{id}', 'OrderController@destroy1');

  Route::get('/index6 ', 'KategoriController@index1');
  Route::get('/tambah6', 'KategoriController@show1');
  Route::get('/edit6/{id}', 'KategoriController@edit1');
  Route::get('/destroy/{id}', 'KategoriController@destroy');
  //--------------------------------------------------->crud
  Route::post('/create6', 'KategoriController@store1');
  Route::put('/update6/{id}', 'KategoriController@update1');
  Route::delete('/destroy6/{id}', 'KategoriController@destroy1');
// });

<?php

Route::group(['middleware' => 'auth'], function () {
  //--------------------------------------------------->tampilan
  Route::get('/index1', 'ProdukController@index1');
  Route::get('/tambah1', 'ProdukController@show1');
  Route::get('/edit1/{id}', 'ProdukController@edit1');
  //--------------------------------------------------->crud
  Route::post('/create1', 'ProdukController@store1');
  Route::put('/update1/{id}', 'ProdukController@update1');
  Route::delete('/destroy1/{id}', 'ProdukController@destroy1');


});

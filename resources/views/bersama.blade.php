
        <li>
            <ul>

                user =  [
                    'name', 'email', 'password','alamat','phone_number','image','alamat','status',
                    ];
                </ul>
            </li>
            <li>
                <ul>
                    produk = [
                        'name_produk', 'desc', 'harga','stok','image','diskon','status',
                        'kategori_id','user_id', 'keranjang_id'
                        ];

                </ul>
            </li>
            
            <li>
                <ul>
                    
                    order = [
                        'invoice', 'subtotal', 'status','pengiriman','pesan',  
                        'user_id','produk_id'
                        
                        ];
                    
                </ul>
            </li>

            <li>
                <ul>
                    penjual = [
                        'name_toko','phone_number',
                        'message_id','penjual_id', //---->user is penjual
        ];
                    
                </ul>
            </li>

            <li>
                <ul>
                    
                    
                                        
                        message = ['from', 'to', 'message', 'is_read'];
                        
                        
                    
                </ul>
            </li>
            <li>
                <ul>
                    keranjang = [
                    'jumlah', 'qty', 'produk_name','produk_price','produk_image',
                    'user_id','produk_id'
                    ];
                    
                </ul>
            </li>
            <li>
                <ul>
                    KATEGORI = [
                        'name_kategori',
                        'parent_id'
                        // 'tgl_posting'---> diganti sama created_at
                        ];
                    
                </ul>
            </li>
            <li>
                <ul>
                    
                    HUBUNGI = [
                        'email', 'subjek', 'message',
                        'hubungi_id',
                        ];
                        
                    
                </ul>
            </li>
 <li>
    <ul>
        Route::post('register', 'UserController@register');
    </ul> 
    <ul>
    
        Route::post('login', 'UserController@login');
    </ul>     
    
    <ul>
        
        Route::post('logout', 'UserController@logout');
        
    </ul>     
    
    <ul>
        Route::get('/chat', 'ChatController@index')->name('home');
        
    </ul>    
    <ul>
        Route::get('user', 'UserController@index');  //-------->nampilin Semua User
    </ul>
    <ul>

        Route::put('user/{id}', 'UserController@update');           //----------update
    </ul>
    <ul>

        Route::delete('user/{id}', 'UserController@destroy');         //-------------delete
    </ul>
    <ul>
        Route::get('user/{id}', 'UserController@show');         //-------------show dari ID
    </ul>
    
        
</li> 

<li>

    <ul>
        
        //route produk

        Route::get('/produk', 'ProdukController@index');
    </ul>
    <ul>
        
        Route::get('/produk/{id}', 'ProdukController@show');
    </ul>
                    
<li>
    <ul>
        Route::get('/produkp', 'ProdukController@produkpenjual');      //------------->produkpenjualaja
        </ul>
        <ul>
            Route::put('/produk/{id}', 'ProdukController@update');
            </ul>
            <ul>
                Route::post('/produk', 'ProdukController@store');
                </ul>   
                <ul>
                    Route::delete('/produk/{id}', 'ProdukController@destroy');
                    </ul> 
</li>    
<li>
    <ul>
        
        Route::get('/message/{id}', 'ChatController@getMessage');
    </ul>
    <ul>

        Route::post('/message', 'ChatController@sendMessage');
    </ul>
</li>
<li>
    <ul>
        Route::resource('/hubungi', 'HubungiController');
    </ul>
</li>
<li>
    <ul>
        
        Route::resource('/kategori', 'KategoriController');
    </ul>
</li>
<li>
    <ul>
        Route::resource('/keranjang', 'KeranjangController');
        Route::post('/tambah/keranjang/{id}', 'KeranjangController@addcart');    //-----------> addcart/tambah ke keranjang
    </ul>
</li>
<li>
    <ul>
        
        Route::resource('/mainMenu', 'MainMenuController');
    </ul>
</li>
<li>
    <ul>
        Route::resource('/order', 'OrderController');
        
    </ul>
</li>
<li>
    <ul>
        
        Route::resource('/penjual', 'PenjualController');
    </ul>
</li>
<li>
    <ul>
        Route::resource('/chekout', 'ChekoutController');
        
    </ul>
</li>


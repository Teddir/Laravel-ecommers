<?php

namespace App\Http\Controllers;

use App\keranjangs;
use App\orders;
use App\produks;
use Illuminate\Http\Request;
use Produk;

class KeranjangController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $keranjang = keranjangs::where('user_id', auth()->user()->id)->with('users', 'produks')->get();
        // dd($keranjang);
        $keranjang = keranjangs::where('user_id', auth()->user()->id)->with('users', 'produks')->get();
        // $subtotal = collect($keranjang)->sum(function($keranjang) {
        //     return $keranjang['qty'] * $keranjang['produks']->harga;
        // });
        if (!$keranjang) {
            # code...
            return response()->json([
                'status' => 'Error',
                'Message' => 'Data Gagal Di Tampilkan',
                'data' => NULL, 402,
            ]);
        }
        return response()->json([
            'status' => 'Succes',
            'Message' => 'Data Berhasil Di Tampilkan',
            'data' => $keranjang, 200,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $keranjang = keranjangs::where('user_id', auth()->user()->id)->with('users', 'produks')->get();
        if (!$keranjang) {
            # code...
            return response()->json([
                'data' => NULL, 402
            ]);
        }
        return response()->json([
            'data' => $keranjang, 200
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'qty' => 'required',
        ]);

        $keranjang = new keranjangs;
        $keranjang->qty = $request->qty;
        $keranjang->user_id = auth()->user()->id;
        $keranjang->produk_id = $request->produk_id;
        try {
        $keranjang->save();
        } catch (\Throwable $th) {
            return response([
                'status' => 'error',
                'message' => $th->getMessage(),
                'data' => NULL, 404
            ]);
            
        }
        return response([
            'status' => 'succes',
            'message' => 'Berhasil Di update',
            'data' => $keranjang, 200
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\keranjangs  $keranjangs
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $keranjang = keranjangs::where('user_id', auth()->user()->id)->with('users', 'produks')->find($id);
        if (!$keranjang) {
            # code...
            return response()->json([
                'data' => NULL, 402
            ]);
        }
        return response()->json([
            'data' => $keranjang, 200
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\keranjangs  $keranjangs
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $mbank = keranjangs::find($id);

        if (!$mbank) {
            # code...
            return response()->json([
                'data' => NULL, 402
            ]);
        } 
        return response()->json([
            'data' => $mbank, 200
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\keranjangs  $keranjangs
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $keranjang = keranjangs::find($id);
        $dataRequest = $request->all();
        $dataResult = array_filter($dataRequest);
        
        try {
            $keranjang->update($dataRequest);
        } catch (\Throwable $th) {
            return response([
                'status' => 'error',
                'message' => $th->getMessage(),
                'data' => NULL, 404
            ]);
            
        }
        return response([
            'status' => 'succes',
            'message' => 'Berhasil Di update',
            'data' => $keranjang, 200
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\keranjangs  $keranjangs
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $keranjang = keranjangs::destroy($id);
        if (! $keranjang) {
            # code...
            return response()->json([
                'status' => 'Error',
                'Message' => 'Data Gagal Di Hapus',
                'data' => NULL, 402,
            ]);
        }
        return response()->json([
            'status' => 'Succes',
            'Message' => 'Data Berhasil Di Hapus',
            'data' => $keranjang, 200,
        ]);
    }

    //--------------------------------------------------->web

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index1(request $request)
    {   
        $keranjang = keranjangs::where('user_id', auth()->user()->id)->with('users', 'produks')->get();
        $subtotal = null;
        return view('Tampilan.Keranjang.keranjang', compact('keranjang', 'subtotal'));

        // $produk = produks::get();
        // $keranjang = keranjangs::with(['user', 'produk',])->orderBy('created_at', 'asc')->get();
        // return view('Tampilan.Keranjang.keranjang', compact('keranjang', 'produk'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create1()
    {
        $keranjang = keranjangs::where('user_id', auth()->user()->id)->with('users', 'produks')->get();

        $keranjang = keranjangs::get();
        return view('Tampilan.Keranjang.keranjang', compact('keranjang'));

    }

  

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store1(Request $request)
    {

        $request->validate([
            // 'qty' => 'required',
            // 'produk_id' => 'required'
        ]);
        $keranjang = keranjangs::get();
        $keranjang = produks::get();
       
            $keranjang = new keranjangs;
            $keranjang->qty = $request->qty;
            $keranjang->user_id = auth()->user()->id;
            $keranjang->produk_id = $request->produk_id;
            $keranjang->save();
            return redirect('/admin/index3')->with(['success' => 'Kategori Diperbaharui!']);


        
    }
      

    /**
     * Display the specified resource.
     *
     * @param  \App\keranjangs  $keranjangs
     * @return \Illuminate\Http\Response
     */
    public function show1()
    {
        $produk = produks::get();
        $keranjang = keranjangs::where('user_id', auth()->user()->id)->with('users', 'produks')->get();
        return view('Tampilan.Keranjang.create', compact('keranjang', 'produk'));

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\keranjangs  $keranjangs
     * @return \Illuminate\Http\Response
     */
    public function edit1($id)
    {
        //UBAH ARRAY MENJADI COLLECTION, KEMUDIAN GUNAKAN METHOD SUM UNTUK MENGHITUNG SUBTOTAL
        // $keranjang = keranjangs::find($id);
        $keranjang = keranjangs::where('user_id', auth()->user()->id)->with('users', 'produks')->get();
            $subtotal = collect($keranjang)->sum(function($keranjang) {
                return $keranjang['qty'] * $keranjang['produks']->harga;
            });
        $produk = produks::get();
        return view('website.cart', compact('keranjang','produk','subtotal'));

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\keranjangs  $keranjangs
     * @return \Illuminate\Http\Response
     */
    public function update1(Request $request, $id)
    {
        $request->validate([
            // 'jumlah' => 'required',
        ]);

        // $keranjang = keranjangs::with('users', 'produks')->get();
        $keranjang = keranjangs::find($id);
        $keranjang->update([
            $keranjang->qty = $request->qty
            ]);
            return redirect('/website/cart')->with(['success' => 'Kategori Diperbaharui!']);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\keranjangs  $keranjangs
     * @return \Illuminate\Http\Response
     */
    public function destroy1($id)
    {
        $keranjang = keranjangs::destroy($id);
        return redirect('/admin/index3')->with(['success' => 'Kategori Diperbaharui!']);
    }

    public function cart()
    {   
        $produk = produks::get();
        // $orders = orders::get();
        // dd($keranjang);
        $keranjang = keranjangs::with('produks')->get();

        if ($keranjang = keranjangs::get()) {
            // dd($produk);
            $subtotal = collect($keranjang)->sum(function($keranjang) {
                return $keranjang['produk_price'] * $keranjang['qty'];    
            });
            // dd($subtotal);
        }
        
    return view('website.cart', compact('keranjang', 'subtotal', 'produk'));
    }

    public function add($id)
    {
        $row = produks::find($id);
        // dd($row);
        if ($row->count() > 0) {
            // dd($row);
            $keranjang = new keranjangs;
            $keranjang->produk_id = $row->id; 
            $keranjang->produk_name = $row->name_produk;
            $keranjang->produk_price = $row->harga;
            $keranjang->produk_image = $row->image;
            $keranjang->produk_diskon = $row->diskon;
            $keranjang->user_id = auth()->user()->id;
            // dd($keranjang);
            $keranjang->save();
            // $keranjang = new keranjangs;
            return redirect('/website/cart');
        } else {
            return redirect('/website');
        }

    }
    
  
    
    public function updateproduk(Request $request)
    {
        
    }

    public function hapuskeranjang($id)
    {
        $keranjang = keranjangs::destroy($id);
        return redirect('/website')->with(['success' => 'Kategori Diperbaharui!']);
    }

    // public function keranjang()
    // {
    //     if (keranjangs::count() == 0) {
    //         return Redirect::to('/');       
    //     } else {
    //         return View::make('keranjangs.basket')
    //                    ->with('title', 'keranjangs &rarr; Basket');
    //     }
    // }


    // public function remove($rowid)
    // {
    //     Cart::remove($rowid);
    //     return Redirect::to('basket');
    // }

    // public function destroy()
    // {
    //     Cart::destroy();
    //     return Redirect::to('/');
    // }

   
}

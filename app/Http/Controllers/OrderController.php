<?php

namespace App\Http\Controllers;

use App\orders;
use App\produks;
use App\kategoris;
use App\keranjangs;
use App\User;

use Illuminate\Http\Request;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $orderaja = orders::get();
        if (!$orderaja) {
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
            'data' => $orderaja, 200,
        ]);

        // return view('home', compact('orderaja'));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $orderaja = orders::get();
        if (!$orderaja) {
            # code...
            return response()->json([
                'data' => NULL, 402
            ]);
        }
        return response()->json([
            'data' => $orderaja, 200
        ]);

        // return view('Home', compact('orderaja'));

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
            'invoice' => 'required',
            'subtotal' => 'required',
            'status' => 'required',
            'pesan' => 'required',
            'pengiriman' => 'required',
            ]);

        try {
            $orderaja = new orders;
            $orderaja->invoice = $request->invoice;
            $orderaja->subtotal = $request->subtotal;
            $orderaja->status = $request->status;
            $orderaja->pesan = $request->pesan;
            $orderaja->pengiriman = $request->pengiriman;
            $orderaja->produk_id = $request->produk_id;
            $orderaja->user_id = auth()->user()->id;
            $orderaja->save();

        } catch (\Throwable $th) {
            return response([
                'status' => 'error',
                'message' => $th->getMessage(),
                'data' => NULL, 404
            ]);
            
        }
        return response([
            'status' => 'succes',
            'message' => 'Berhasil Di Tambah',
            'data' => $orderaja, 200
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\orders  $orders
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $orderaja = orders::find($id);
        if (!$orderaja) {
            # code...
            return response()->json([
                'data' => NULL, 402
            ]);
        }
        return response()->json([
            'data' => $orderaja, 200
        ]);

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\orders  $orders
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $orderaja = orders::find($id);
        if (!$orderaja) {
            # code...
            return response()->json([
                'data' => NULL, 402
            ]);
        } 
        return response()->json([
            'data' => $orderaja, 200
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\orders  $orders
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'pesan' => 'required',
            'pengiriman' => 'required',
            ]);

        try {
            $orderaja = orders::find($id);
            $orderaja->pesan = $request->pesan;
            $orderaja->pengiriman = $request->pengiriman;
            $orderaja->user_id = auth()->user()->id;
            $orderaja->produk_id = $request->produk_id;
            $orderaja->save();
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
            'data' => $orderaja, 200
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\orders  $orders
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $orderaja = orders::destroy($id);
        if (! $orderaja) {
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
            'data' => $orderaja, 200,
        ]);
    }


    public function index1()
    {
        $users = User::get();
        $keranjang = keranjangs::get();
        if ($orders = orders::where('user_id', auth()->user()->id)->with('users', 'produks', 'keranjangs')->get()) {
            // dd($orderaja);
            # code...
                $subtotal = collect($orders)->sum(function($orders) {
                return $orders['keranjangs']->qty * $orders['produks']->jumlah / $orders['produks']->diskon ;
                });
                return view('Tampilan.Order.order', compact('orders', 'subtotal', 'keranjang'));
            };
        // dd($orderaja);

    }

    public function index2()
    {
        $users = User::get();
        $keranjang = keranjangs::get();
        if ($orders = orders::where('user_id', auth()->user()->id)->with('users', 'produks', 'keranjangs')->get()) {
            // dd($orderaja);
            # code...
                $subtotal = collect($orders)->sum(function($orders) {
                return $orders['keranjangs']->qty * $orders['produks']->jumlah / $orders['produks']->diskon ;
                });
                            dd($orders);

                return view('website.cart', compact('orders', 'subtotal', 'keranjang'));
            };
        // dd($orderaja);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create1()
    {
        $orderaja = orders::get();
       

        // return view('Home', compact('orderaja'));

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
            'invoice' => 'required',
            'subtotal' => 'required',
            'status' => 'required',
            'pesan' => 'required',
            'pengiriman' => 'required',
            ]);

            $orderaja = new orders;
            $orderaja->invoice = $request->invoice;
            $orderaja->subtotal = $request->subtotal;
            $orderaja->status = $request->status;
            $orderaja->pesan = $request->pesan;
            $orderaja->pengiriman = $request->pengiriman;
            $orderaja->produk_id = $request->produk_id;
            $orderaja->user_id = auth()->user()->id;
            $orderaja->save();

     
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\orders  $orders
     * @return \Illuminate\Http\Response
     */
    public function show1(orders $orders)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\orders  $orders
     * @return \Illuminate\Http\Response
     */
    public function edit1($id)
    {
        $orderaja = orders::find($id);
        
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\orders  $orders
     * @return \Illuminate\Http\Response
     */
    public function update1(Request $request, $id)
    {
        $request->validate([
            'pesan' => 'required',
            ]);

            $orderaja = orders::find($id);
            $orderaja->pesan = $request->pesan;
            $orderaja->pengiriman = $request->pengiriman;
            $orderaja->produk_id = $request->produk_id;
            $orderaja->user_id = auth()->user()->id;
            $orderaja->save();
       
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\orders  $orders
     * @return \Illuminate\Http\Response
     */
    public function destroy1($id)
    {
        $orderaja = orders::destroy($id);
    
    }

    public function finish()
    {   


        $keranjang = keranjangs::get();

        $produk = produks::where('user_id', auth()->user()->id)->with('users', 'keranjangs')->get();
        if ($orders = orders::where('user_id', auth()->user()->id)->with('users', 'produks', 'keranjangs')->get()) {
            $subtotal = collect($orders)->sum(function($orders) {
                    return $orders['keranjangs']->qty * $orders['produks']->harga / $orders['produks']->diskon ;
            });
            // dd($subtotal);
            return view('Tampilan.Order.finish', compact('keranjang', 'produk','subtotal', 'orders'));
        }
        
    }
    
    public function finish1()
    {
        
        $produk = produks::get();
        $keranjang = keranjangs::get();
        $orders = orders::where('user_id', auth()->user()->id)->with('users', 'produks', 'keranjangs')->get();
        $subtotal = collect($keranjang)->sum(function($keranjang) {
            return $keranjang['qty'] - $keranjang['stok'];
        });
        // $produk->save();
        
        return view('Tampilan.Order.order', compact('keranjang', 'produk','subtotal', 'orders'));

    }


    
}

<?php

namespace App\Http\Controllers;

use App\produks;
use Illuminate\Http\Request;
use App\kategoris;
use App\User;
use illuminate\support\Str;
use App\keranjangs;
use App\orders;
use App\penjuals;

class ProdukController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    //-------------------------------------------------------------->Produk    
    public function __construct()
    {
        $this->middleware('jwt.verify');
    }
    public function index()
    {
        $produk = produks::where('user_id', auth()->user()->id)->with('kategoris')->get();
        if (!$produk) {
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
            'data' => $produk, 200,
        ]);
    }

    public function produkpenjual()
    {
        $produk = produks::where('user_id', auth()->user()->id)->with('produks', 'users')->get();
        // dd($produk);
        if (!$produk) {
            # code...
            return response()->json([
                'status' => 'Error',
                'Message' => 'Data Gagal Di Tampilkan Sesuai Produk Penjual',
                'data' => NULL, 402,
            ]);
        }
        return response()->json([
            'status' => 'Succes',
            'Message' => 'Data Berhasil Di Tampilkan Sesuai Produk Penjual',
            'data' => $produk, 200,
        ]);
    }

    //-------------------------------------------------------------->END Produk    






    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $produk = produks::get();
        if (!$produk) {
            # code...
            return response()->json([
                'data' => NULL, 402
            ]);
        }
        return response()->json([
            'data' => $produk, 200
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
            'name_produk' => 'required',
            'desc' => 'required',
            'harga' => 'required',
            'stok' => 'required|integer',
            'status' => 'required|integer',
            'diskon' => 'required',
        ]);

        $produk = new produks;
        $produk->name_produk = $request->name_produk;
        $produk->user_id = auth()->user()->id;
        $produk->kategori_id = $request->kategori_id;
        $produk->desc = $request->desc;
        $produk->harga = $request->harga;
        $produk->stok = $request->stok;
        $produk->status = $request->status;
        $produk->diskon = $request->diskon;
        $file = base64_encode(file_get_contents($request->image));

        $client = new \GuzzleHttp\Client();
        $response = $client->request('POST', 'https://freeimage.host/api/1/upload', [
            'form_params' => [
                'key' => '6d207e02198a847aa98d0a2a901485a5',
                'action' => 'upload',
                'source' => $file,
                'format' => 'json'
            ]
        ]);

        $data = $response->getBody()->getContents();
        $data = json_decode($data);
        $image = $data->image->url;

        $produk->image = $image;
        try {
            $produk->save();
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
            'data' => $produk, 200
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\produks  $produks
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $produk = produks::where('user_id', auth()->user()->id)->with('kategoris')->get();
        if (!$produk) {
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
            'data' => $produk, 200,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\produks  $produks
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $produk = produks::with(['kategoris'])->orderBy('created_at', 'asc')->find($id);
        $produk = produks::find($id);
        if (!$produk) {
            return response()->json([
                'data' => NULL, 402
            ]);
        }
        return response()->json([
            'data' => $produk, 200
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\produks  $produks
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
    
        $produk = produks::find($id);
        $dataRequest = $request->all();
        $dataResult = array_filter($dataRequest);

        $file = base64_encode(file_get_contents($request->image));
        $client = new \GuzzleHttp\Client();
        $response = $client->request('POST', 'https://freeimage.host/api/1/upload', [
            'form_params' => [
                'key' => '6d207e02198a847aa98d0a2a901485a5',
                'action' => 'upload',
                'source' => $file,
                'format' => 'json'
                ]
                ]);
                
                $data = $response->getBody()->getContents();
                $data = json_decode($data);
                $image = $data->image->url;
                $produk->image = $image;
            try {
            $produk->update($dataRequest);
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
            'data' => $produk, 200
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\produks  $produks
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $produk = produks::destroy($id);
        if (!$produk) {
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
            'data' => $produk, 200,
        ]);
    }

    //-------------------------------------------------------------->WEB
    public function render(Request $request, $cari)
    {
        $produk =  produks::WHERE('name', 'like', '%' . $cari . '%');
        $produk->cari = $request->cari;
        return view('dashbord', compact('produk'));
        if (!$produk) {
            # code...
            return response()->json([
                'status' => 'Error',
                'Message' => 'Data Not Pound',
                'data' => NULL, 402,
            ]);
        }
        return response()->json([
            'data' => $produk, 200,
        ]);
    }


    //-------------------------------------------------------------->Admin

    public function __construct1()
    {
        $this->middleware('auth');
    }

    public function index1(Request $request)
    {
        $users = User::get();
        $keranjang = keranjangs::get();

        $produk = new produks;
        $produk->stok = $request->stok;
        if ($produk = produks::where('user_id', auth()->user()->id)->with('users', 'produks', 'keranjangs')->get()) {
            // dd($orderaja);
            # code...
            $subtotal = collect($request->stok)->sum(function ($orders) {
                return  $orders['produks']->jumlah - $orders['keranjangs']->qty;
            });
        };
        // $produk->save();
        return view('Tampilan.Produk.produk', compact('produk', 'subtotal', 'keranjang'));
    }


    public function show1(produks $produks)
    {
        $kategori = kategoris::get();
        $user = User::get();
        $produk = produks::with(['kategoris'])->orderBy('created_at', 'asc')->get();
        return view('Tampilan.Produk.create', compact('produk', 'kategori', 'user'));
    }


    public function store1(Request $request)
    {
        $request->validate([
            'name_produk' => 'required',
            'desc' => 'required',
            'harga' => 'required',
            'stok' => 'required',
            'status' => 'required',
            'diskon' => 'required',
        ]);
        $produk = new produks;
        $produk->name_produk = $request->name_produk;
        $produk->user_id = auth()->user()->id;
        $produk->desc = $request->desc;
        $produk->harga = $request->harga;
        $produk->stok = $request->stok;
        $file = base64_encode(file_get_contents($request->image));

        $client = new \GuzzleHttp\Client();
        $response = $client->request('POST', 'https://freeimage.host/api/1/upload', [
            'form_params' => [
                'key' => '6d207e02198a847aa98d0a2a901485a5',
                'action' => 'upload',
                'source' => $file,
                'format' => 'json'
            ]
        ]);

        $data = $response->getBody()->getContents();
        $data = json_decode($data);
        $image = $data->image->url;

        $produk->image = $image;
        $produk->status = $request->status;
        $produk->diskon = $request->diskon;
        $produk->save();

        return redirect('/admin/index1')->with(['success' => 'Kategori Diperbaharui!']);
    }

    public function edit1($id)
    {
        $produk = produks::find($id);
        $kategori = kategoris::with(['produk'])->orderBy('created_at', 'asc')->get();
        return view('Tampilan.Produk.edit', compact('produk', 'kategori'));
    }

    public function update1(Request $request, $id)
    {
        $request->validate([
            'name_produk' => 'required',
            'desc' => 'required',
            'harga' => 'required',
            'stok' => 'required|integer',
            'status' => 'required',
            'diskon' => 'required',
        ]);


        $produk = produks::find($id);
        $produk->name_produk = $request->name_produk;
        $produk->desc = $request->desc;
        $produk->harga = $request->harga;
        $produk->stok = $request->stok;
        $file = base64_encode(file_get_contents($request->image));

        $client = new \GuzzleHttp\Client();
        $response = $client->request('POST', 'https://freeimage.host/api/1/upload', [
            'form_params' => [
                'key' => '6d207e02198a847aa98d0a2a901485a5',
                'action' => 'upload',
                'source' => $file,
                'format' => 'json'
            ]
        ]);

        $data = $response->getBody()->getContents();
        $data = json_decode($data);
        $image = $data->image->url;

        $produk->image = $image;
        $produk->status = $request->status;
        $produk->diskon = $request->diskon;
        $produk->save();

        return redirect('/admin/index1')->with(['success' => 'Kategori Diperbaharui!']);
    }

    public function destroy1($id)
    {
        $produk = produks::destroy($id);
        return redirect('/admin/index1')->with(['success' => 'Kategori Diperbaharui!']);
    }


    //-------------------------------------------------------------->WEB

    public function produkall()
    {
        // $produk = produks::where('user_id', auth()->user()->id())->with('produks', 'keranjangs', 'users');
        $produk = produks::get();
        // $produkdetail = produks::find($id);
        return view('website.allproduk', compact('produk'));
    }

    public function bestseller()
    {
        return view('website.bestseller', compact('produk'));
    }

    public function newproduk()
    {
        $produk = produks::get();
        // $produk = produks::find($id);
        return view('website.newproduk', compact('produk'));
    }

    // public function cart()
    // {
    //     $produk = produks::get();
    //     $subtotal = null;
    //     return view('website.cart', compact('produk', 'subtotal'));

    // }


    public function produldetail($id)
    {
        // $produk = produks::where('user_id', auth()->user()->id())->with('produks', 'keranjangs', 'users');
        $produkdetail = produks::find($id);
        return view('website.cart', compact('produkdetail'));
    }

    public function chekout(Request $request, $id)
    {
        $row = produks::get();
        if ($produks = produks::where('user_id', auth()->user()->id)->with('keranjangs')->first()) {
            // dd($produks->keranjangs->qty);
            $stok = $produks->stok - $produks->keranjangs->qty;
            // dd($stok);
            // dd($stok);
            $produk = produks::find($id);
            // dd($produk);
            $produk->stok = $stok;
            $produk->update();
            return view('website.chekout')
                ->with('title', 'Cart &rarr; Checkout');
        };
    }
}

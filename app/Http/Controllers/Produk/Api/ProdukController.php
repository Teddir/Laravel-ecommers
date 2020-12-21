<?php

namespace App\Http\Controllers\Produk\Api;

use App\Http\Controllers\Controller;
use App\penjuals;
use Illuminate\Http\Request;
use App\produks;
use Illuminate\Support\Facades\Auth;

class ProdukController extends Controller
{
    // public function __construct()
    // {
    //     $this->middleware('jwt.verify');
    // }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    //-------------------------------------------------------------->Produk    
    public function index()
    {
        $produk = produks::where('stok', '>', 0)->with('penjuals')->get();
        // dd($produk);
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
        $penjual = penjuals::where('user_id', auth()->user()->id)->get();

        $produk = produks::where('penjual_id', $penjual[0]->id)->get();
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

    public function toko($id)  //---->userpenjual
    {
        $user = produks::where('penjual_id', $id)->with('penjuals')->get();
        // dd($user);
        if (!$user) {
            return response()->json([
                'status' => 'Error',
                'Message' => 'Data Gagal Di Hapus',
                'data' => NULL, 402,
            ]);
        }
        return response()->json([
            'status' => 'Succes',
            'Message' => 'Data Berhasil Di Tampilkan',
            'data' => $user, 200,
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
        $penjual  = penjuals::where('user_id', auth()->user()->id)->get();
        // dd($penjual);
        $request->validate([
            'name_produk' => 'required',
            'desc' => 'required',
            'harga' => 'required|integer',
            'stok' => 'required|integer',
        ]);

        $produk = new produks;
        $produk->name_produk = $request->name_produk;
        if (empty($penjual[0]->id)) {
            # code...
            return response([
                'message' => 'Maaf Anda Bukan Penjual',
            ]);
        }
        $produk->penjual_id = $penjual[0]->id;
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
        $produk = produks::where('user_id', auth()->user()->id)->find($id);
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
        $dataRequest = $request->except(['image']);
        $dataResult = array_filter($dataRequest);
        $image = $request->file('image');
        if ($image) {
            # code...
            $file = base64_encode(file_get_contents($image));
            
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
        }else
        $image = $produk->image;
        try {
            $produk->update($dataResult);
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
    public function render(Request $request)
    {
        $cari = $request->get('cari');
        if (empty($cari)) {
            # code..
            return response()->json([
                'Message' => 'Anda Belum Mengisi Apa Yang Harus Di cari',
            ]);
        }
        $result =  produks::WHERE('name_produk', 'like', '%' . $cari . '%')->with('penjuals')->paginate(10);
        if (empty($result)) {
            return response()->json([
                'status' => 'Error',
                'Message' => 'Name Barang Tidak Di Temukan',
                'data' => NULL, 402,
            ]);
        }
        return response()->json([
            'status' => 'Succes',
            'Message' => 'Barang Berhasil Di Temukan',
            'data' => $result, 200,
        ]);

    }
}

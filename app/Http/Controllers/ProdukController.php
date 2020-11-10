<?php

namespace App\Http\Controllers;

use App\produks;
use Illuminate\Http\Request;

class ProdukController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $produk = produks::get();
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

        // return view('Home', compact('produk'));

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
            'stok' => 'required',
            'tgl_masuk' => 'required',
            'image' => 'required',
            'terjual' => 'required',
            'diskon' => 'required',
        ]);

        $imgName = $request->image->getClientOriginalName() . '-' . time() . '.' . $request->image->extension();

        $request->image->move(public_path('image'), $imgName);
        
        try {
            $produk = new produks;
            $produk->name_produk = $request->name_produk;
            $produk->id_kategori = $request->id_kategori;
            $produk->desc = $request->desc;
            $produk->harga = $request->harga;
            $produk->stok = $request->stok;
            $produk->tgl_masuk = $request->tgl_masuk;
            $produk->image = $imgName;
            $produk->terjual = $request->terjual;
            $produk->diskon = $request->terjual;
            $produk->save();
            if (!$produk) {
                return response([
                    'status' => 'error',
                    'message' => 'Invalid Credentials',
                    'data' => NULL, 404
                ]);
            }
        } catch (\Throwable $th) {
            $th->getMessage();
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
    public function show(produks $produks)
    {
        //
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
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\produks  $produks
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'name_produk' => 'required',
            'desc' => 'required',
            'harga' => 'required',
            'stok' => 'required',
            'tgl_masuk' => 'required',
            'image' => 'required',
            'terjual' => 'required',
            'diskon' => 'required',
        ]);

        $imgName = $request->old_image;
        if ($request->image) {
            $imgName = $request->image->getClientOriginalName() . '-' . time() . '.' . $request->image->extension();

            $request->image->move(public_path('image'), $imgName);
        }

        try {
            $produk = produks::find($id);
            $produk->name_produk = $request->name_produk;
            $produk->id_kategori = $request->id_kategori;
            $produk->desc = $request->desc;
            $produk->harga = $request->harga;
            $produk->stok = $request->stok;
            $produk->tgl_masuk = $request->tgl_masuk;
            $produk->image = $imgName;
            $produk->terjual = $request->terjual;
            $produk->diskon = $request->terjual;
            $produk->save();
            if (!$produk) {
                return response([
                    'status' => 'error',
                    'message' => 'Invalid Credentials',
                    'data' => NULL, 404
                ]);
            }
        } catch (\Throwable $th) {
            $th->getMessage();
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
        if (! $produk) {
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

    public function render($cari)
    {
        $produk = produks::WHERE('name', 'like', '%' . $cari . '%') ;
        if (! $produk) {
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
}

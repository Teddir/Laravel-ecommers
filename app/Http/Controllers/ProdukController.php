<?php

namespace App\Http\Controllers;

use App\produks;
use Illuminate\Http\Request;
use App\kategoris;

class ProdukController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $produk = produks::get();
        // $produk = kategoris::with(['kategoris'])->orderBy('created_at', 'asc')->get();
        // $kategori = kategoris::get();
        // $produk = produks::with(['kategoris'])->orderBy('created_at', 'asc')->get();
        $produk = produks::get();

        //-------------------------------------------------------------->WEB

        // return view('Tampilan.Produk.produk', compact('produk'));
        //-------------------------------------------------------------->API    
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
        // $kategori = kategoris::get();
        // return response()->json(['data' => $kategori]);
        $produk = produks::with(['kategoris'])->orderBy('created_at', 'asc')->get();
        $kategori = kategoris::with(['produk'])->orderBy('created_at', 'asc')->get();
        return view('Tampilan.Produk.create', compact('kategori','produk'));
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
            'status' => 'required',
            'diskon' => 'required',
        ]);

        $imgName = $request->image->getClientOriginalName() . '-' . time() . '.' . $request->image->extension();

        $request->image->move(public_path('image'), $imgName);

        try {
            $produk = new produks;
            $produk->name_produk = $request->name_produk;
            $produk->desc = $request->desc;
            $produk->harga = $request->harga;
            $produk->stok = $request->stok;
            $produk->tgl_masuk = $request->tgl_masuk;
            $produk->image = $imgName;
            $produk->status = $request->status;
            $produk->diskon = $request->diskon;
            $produk->save();
            return redirect('/dashbord')->with(['success' => 'Kategori Diperbaharui!']);
            if (!$produk) {
                return response([
                    'status' => 'error',
                    'message' => 'Gagal Di Tambah',
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
        $produk = produks::with(['kategoris'])->orderBy('created_at', 'asc')->find($id);
        $kategori = kategoris::with(['produk'])->orderBy('created_at', 'asc')->get();
        return view('Tampilan.Produk.edit', compact('kategori','produk'));
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
            'stok' => 'required|integer',
            'status' => 'required',
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
        $produk->desc = $request->desc;
        $produk->harga = $request->harga;
        $produk->stok = $request->stok;
        $produk->image = $imgName;
        $produk->status = $request->status;
        $produk->diskon = $request->diskon;
        $produk->save();
        return redirect('/dashbord')->with(['success' => 'Kategori Diperbaharui!']);
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

    public function render(Request $request, $cari)
    {
        $produk =  produks::WHERE('name', 'like', '%' . $cari . '%');
        $produk->cari = $request->cari;
        return view('dashbord', compact('kategori','produk'));
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
}

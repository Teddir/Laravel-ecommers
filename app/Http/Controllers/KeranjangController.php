<?php

namespace App\Http\Controllers;

use App\keranjangs;
use Illuminate\Http\Request;

class KeranjangController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $keranjang = keranjangs::get();
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
        $keranjang = keranjangs::get();
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
            'jumlah' => 'required',
            'date' => 'required',
        ]);

        try {
            $keranjang = new keranjangs;
            $keranjang->jumlah = $request->jumlah;
            $keranjang->date = $request->date;
            $keranjang->id_kategori = $request->id_kategori;
            $keranjang->id_pembeli = $request->id_pembeli;

            $keranjang->save();
            if (!$keranjang) {
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
            'data' => $keranjang, 200
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\keranjangs  $keranjangs
     * @return \Illuminate\Http\Response
     */
    public function show(keranjangs $keranjangs)
    {
        //
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
        $request->validate([
            'jumlah' => 'required',
            'date' => 'required',
        ]);

        try {
            $keranjang = keranjangs::find($id);
            $keranjang->jumlah = $request->jumlah;
            $keranjang->date = $request->date;

            $keranjang->save();
            if (!$keranjang) {
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
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\chekout;
use App\keranjangs;

class ChekoutController extends Controller
{
    public function index()
    {
        $chekout = chekout::with('keranjangs', 'produks')->get();
        // dd($chekout);
        if (!$chekout) {
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
            'data' => $chekout, 200,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $chekout = chekout::where('user_id', auth()->user()->id)->with('users', 'produks')->get();
        if (!$chekout) {
            # code...
            return response()->json([
                'data' => NULL, 402
            ]);
        }
        return response()->json([
            'data' => $chekout, 200
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

        $chekout = new chekout;
        $chekout->qty = $request->qty;
        $chekout->produk_id = $request->produk_id;
        $chekout->keranjang_id = $request->keranjang_id;
        try {
        $chekout->save();
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
            'data' => $chekout, 200
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\chekout  $chekout
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $chekout = chekout::with('keranjangs', 'produks')->find($id);
        if (!$chekout) {
            # code...
            return response()->json([
                'data' => NULL, 402
            ]);
        }
        return response()->json([
            'data' => $chekout, 200
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\chekout  $chekout
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $mbank = chekout::find($id);

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
     * @param  \App\chekout  $chekout
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $chekout = chekout::find($id);
        $dataRequest = $request->all();
        $dataResult = array_filter($dataRequest);
        // dd($dataRequest);
        try {
            $chekout->update($dataRequest);
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
            'data' => $chekout, 200
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\chekout  $chekout
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $chekout = chekout::destroy($id);
        if (! $chekout) {
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
            'data' => $chekout, 200,
        ]);
    }

    public function chekout($id)
    {
        $row = keranjangs::find($id);
        // dd($row);
        if ($row->count() > 0) {
            // dd($row);
            $keranjang = new chekout;
            $keranjang->keranjang_id = $row->id; 
            $keranjang->produk_name = $row->name_produk;
            $keranjang->produk_price = $row->harga;
            $keranjang->produk_image = $row->image;
            dd($keranjang);
            $keranjang->save();
            // $keranjang = new keranjangs;
            return redirect('/website/cart');
        } else {
            return redirect('/website');
        }

    }

}

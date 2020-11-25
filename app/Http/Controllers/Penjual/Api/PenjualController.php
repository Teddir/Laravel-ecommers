<?php

namespace App\Http\Controllers\Penjual\Api;

use App\Http\Controllers\Controller;
use App\messages;
use App\penjuals;
use App\User;
use GuzzleHttp\Psr7\Message;
use Illuminate\Http\Request;
use Penjual;
use illuminate\Support\Str;

class PenjualController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $penjual = penjuals::get();
        if (!$penjual) {
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
            'data' => $penjual, 200,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $penjual = penjuals::get();
        if (!$penjual) {
            # code...
            return response()->json([
                'data' => NULL, 402
            ]);
        }
        return response()->json([
            'data' => $penjual, 200
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
            'name_toko' => 'required:unique:penjuals',
            'phone_number' => 'required|numeric:unique:penjuals',

        ]);

        try {
            $penjual = new penjuals;
            $penjual->user_id = auth()->user()->id;
            $penjual->name_toko = $request->name_toko;
            $penjual->phone_number = $request->phone_number;
            $penjual->save();
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
            'data' => $penjual, 200
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\penjuals  $penjuals
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $penjual = penjuals::find($id);
        if (!$penjual) {
            # code...
            return response()->json([
                'data' => NULL, 402
            ]);
        }
        return response()->json([
            'data' => $penjual, 200
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\penjuals  $penjuals
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $penjual = penjuals::find($id);
        if (!$penjual) {
            # code...
            return response()->json([
                'data' => NULL, 402
            ]);
        }
        return response()->json([
            'data' => $penjual, 200
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\penjuals  $penjuals
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $penjual = penjuals::find($id);
        $dataRequest = $request->all();
        $dataResult = array_filter($dataRequest);        
        try {
            $penjual->update($dataRequest);
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
            'data' => $penjual, 200
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\penjuals  $penjuals
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $penjual = penjuals::destroy($id);
        if (!$penjual) {
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
            'data' => $penjual, 200,
        ]);
    }
}

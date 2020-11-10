<?php

namespace App\Http\Controllers;

use App\orderdetails;
use Illuminate\Http\Request;

class OrderDetailController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $orderdetail = orderdetails::get();
        if (! $orderdetail) {
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
            'data' => $orderdetail, 200,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $orderdetail = orderdetails::get();
        if (!$orderdetail) {
            # code...
            return response()->json([
                'data' => NULL, 402
            ]);
        } 
        return response()->json([
            'data' => $orderdetail, 200
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
        ]);

        try {
            $orderdetail = new orderdetails;
            $orderdetail->jumlah = $request->jumlah;
            $orderdetail->save();
            if (!$orderdetail) {
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
            'data' => $orderdetail, 200
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\orderdetails  $orderdetails
     * @return \Illuminate\Http\Response
     */
    public function show(orderdetails $orderdetails)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\orderdetails  $orderdetails
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $orderdetail = orderdetails::find($id);
        if (!$orderdetail) {
            # code...
            return response()->json([
                'data' => NULL, 402
            ]);
        } 
        return response()->json([
            'data' => $orderdetail, 200
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\orderdetails  $orderdetails
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'jumlah' => 'required',
        ]);

        try {
            $orderdetail = orderdetails::find($id);
            $orderdetail->jumlah = $request->jumlah;
            $orderdetail->save();
            if (!$orderdetail) {
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
            'data' => $orderdetail, 200
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\orderdetails  $orderdetails
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $orderdetail = orderdetails::destroy($id);
        if (! $orderdetail) {
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
            'data' => $orderdetail, 200,
        ]);

    }
}

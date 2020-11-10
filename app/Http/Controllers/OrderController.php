<?php

namespace App\Http\Controllers;

use App\orders;
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
            'status_order' => 'required',
            'tgl_order' => 'required',
            'time' => 'required',
        ]);

        try {
            $orderaja = new orders;
            $orderaja->status_order = $request->status_order;
            $orderaja->tgl_order = $request->tgl_order;
            $orderaja->time = $request->time;
            $orderaja->save();
            if (!$orderaja) {
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
            'data' => $orderaja, 200
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\orders  $orders
     * @return \Illuminate\Http\Response
     */
    public function show(orders $orders)
    {
        //
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
            'status_order' => 'required',
            'tgl_order' => 'required',
            'time' => 'required',
        ]);

        try {
            $orderaja = orders::find($id);
            $orderaja->status_order = $request->status_order;
            $orderaja->tgl_order = $request->tgl_order;
            $orderaja->time = $request->time;
            $orderaja->save();
            if (!$orderaja) {
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
}

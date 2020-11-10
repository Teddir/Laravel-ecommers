<?php

namespace App\Http\Controllers;

use App\penjuals;
use Illuminate\Http\Request;

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
            'name_penjual' => 'required',
            'email' => 'required',
            'password' => 'required',
            'alamat' => 'required',
            'phone_number' => 'required',

        ]);

        $imgName = $request->avatar->getClientOriginalName() . '-' . time() . '.' . $request->avatar->extension();

        $request->avatar->move(public_path('image'), $imgName);
        

        try {
            $penjual = new penjuals;
            $penjual->name_penjual = $request->name_penjual;
            $penjual->avatar = $imgName;
            $penjual->email = $request->email;
            $penjual->password = $request->password;
            $penjual->alamat = $request->alamat;
            $penjual->phone_number = $request->phone_number;
            $penjual->save();
            if (!$penjual) {
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
            'data' => $penjual, 200
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\penjuals  $penjuals
     * @return \Illuminate\Http\Response
     */
    public function show(penjuals $penjuals)
    {
        //
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
        $request->validate([
            'name_penjual' => 'required',
            'email' => 'required',
            'password' => 'required',
            'alamat' => 'required',
            'phone_number' => 'required',
        ]);

        $imgName = $request->old_avatar;
        if ($request->avatar) {
            $imgName = $request->avatar->getClientOriginalName() . '-' . time() . '.' . $request->avatar->extension();

            $request->avatar->move(public_path('image'), $imgName);
        }


        try {
            $penjual = penjuals::find($id);
            $penjual->name_penjual = $request->name_penjual;
            $penjual->avatar = $imgName;
            $penjual->email = $request->email;
            $penjual->password = $request->password;
            $penjual->alamat = $request->alamat;
            $penjual->phone_number = $request->phone_number;
            $penjual->save();
            if (!$penjual) {
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

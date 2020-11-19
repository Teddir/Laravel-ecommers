<?php

namespace App\Http\Controllers;

use App\hubungis;
use Illuminate\Http\Request;

class HubungiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $hubungi = hubungis::get();
        if (!$hubungi) {
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
            'data' => $hubungi, 200,
        ]);

        // return view('home', compact('hubungi'));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $hubungi = hubungis::get();
        if (!$hubungi) {
            # code...
            return response()->json([
                'data' => NULL, 402
            ]);
        }
        return response()->json([
            'data' => $hubungi, 200
        ]);

        // return view('Home', compact('hub$hubungi'));
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
            'email' => 'required|email',
            'subjek' => 'required',
            'message' => 'required',
        ]);

        try {
            $hubungi = new hubungis;
            $hubungi->email = $request->email;
            $hubungi->subjek = $request->subjek;
            $hubungi->message = $request->message;
            $hubungi->save();
            if (!$hubungi) {
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
            'data' => $hubungi, 200
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\hubungis  $hubungis
     * @return \Illuminate\Http\Response
     */
    public function show(hubungis $hubungis)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\hubungis  $hubungis
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $hubungi = hubungis::find($id);
        if (!$hubungi) {
            # code...
            return response()->json([
                'data' => NULL, 402
            ]);
        }
        return response()->json([
            'data' => $hubungi, 200
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\hubungis  $hubungis
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {

        $hubungi = hubungis::find($id);
        $dataRequest = $request->all();
        $dataResult = array_filter($dataRequest);
        try {
            $hubungi->update($dataRequest);
            if (!$hubungi) {
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
            'data' => $hubungi, 200
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\hubungis  $hubungis
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $hubungi = hubungis::destroy($id);
        if (!$hubungi) {
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
            'data' => $hubungi, 200,
        ]);
    }
}

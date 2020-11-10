<?php

namespace App\Http\Controllers;

use App\mod_banks;
use Illuminate\Http\Request;

class ModBankController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $mbank = mod_banks::get();
        if (! $mbank) {
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
            'data' => $mbank, 200,
        ]);

        // return view('home', compact('mbank'));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $mbank = mod_banks::get();
        if (!$mbank) {
            # code...
            return response()->json([
                'data' => NULL, 402
            ]);
        } 
        return response()->json([
            'data' => $mbank, 200
        ]);

        // return view('Home', compact('mbank'));
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
            'name_bank' => 'required',
            'rekening_number' => 'required',
        ]);

        $imgName = $request->image->getClientOriginalName() . '-' . time() . '.' . $request->image->extension();

        $request->image->move(public_path('image'), $imgName);
        

        try {
            $mbank = new mod_banks;
            $mbank->name_bank = $request->name_bank;
            $mbank->rekening_number = $request->rekening_number;
            $mbank->save();
            if (!$mbank) {
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
            'data' => $mbank, 200
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Mod_Bank  $mod_Bank
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Mod_Bank  $mod_Bank
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $mbank = mod_banks::find($id);
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
     * @param  \App\mod_banks  $mod_banks
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'name_bank' => 'required', 
            'rekening_number' => 'required', 
        ]);

        $imgName = $request->old_image;
        if ($request->image) {
            $imgName = $request->image->getClientOriginalName() . '-' . time() . '.' . $request->image->extension();

            $request->image->move(public_path('image'), $imgName);
        }

        try {
            //code...
            $mbank = mod_banks::find($id);
            $mbank->name_bank = $request->name_bank;
            $mbank->rekening_number = $request->rekening_number;
            $mbank->save();
            if (!$mbank) {
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
            'message' => 'Berhasil Di Update',
            'data' => $mbank, 200
        ]);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\mod_banks  $mod_banks
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $mbank = mod_banks::destroy($id);
        if (! $mbank) {
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
            'data' => $mbank, 200,
        ]);

    }
}

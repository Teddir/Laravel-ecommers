<?php

namespace App\Http\Controllers;

use App\hubungis;
use App\kategoris;
use Illuminate\Http\Request;
use Kategori;

class KategoriController extends Controller
{
    
        //-------------------------------------------------------------->WEB

    
        //-------------------------------------------------------------->API
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $kategori = kategoris::get();
        $kategori = kategoris::with(['produk'])->orderBy('created_at', 'asc')->get();
        // return response()->json(['data' => $kategori]);
            return view('Tampilan.Kategori.create', compact('kategori'));
        if (! $kategori) {
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
            'data' => $kategori, 200,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $kategori = kategoris::get();
        // return view('Tampilan.Kategori.create', compact('kategori'));
        if (!$kategori) {
            # code...
            return response()->json([
                'data' => NULL, 402
            ]);
        } 
        return response()->json([
            'data' => $kategori, 200
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
            // 'name_kategori' => 'required',
            'tgl_posting' => 'required',
        ]);

            $kategori = new kategoris();
            $kategori->name_kategori = $request->name_kategori;
            $kategori->tgl_posting = $request->tgl_posting;
            $kategori->save();
            return redirect('/dashbord')->with(['success' => 'Kategori Diperbaharui!']);
            if (!$kategori) {
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
            'data' => $kategori, 200
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\kategoris  $kategoris
     * @return \Illuminate\Http\Response
     */
    public function show(kategoris $kategoris)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\kategoris  $kategoris
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $kategori = kategoris::find($id);
        if (!$kategori) {
            # code...
            return response()->json([
                'data' => NULL, 402
            ]);
        } 
        return response()->json([
            'data' => $kategori, 200
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\kategoris  $kategoris
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'name_kategori' => 'required',
            'tgl_posting' => 'required',
        ]);

        $imgName = $request->old_image;
        if ($request->image) {
            $imgName = $request->image->getClientOriginalName() . '-' . time() . '.' . $request->image->extension();

            $request->image->move(public_path('image'), $imgName);
        }

        try {
            //code...
            $kategori = kategoris::find($id);
            $kategori->name_kategori = $request->name_kategori;
            $kategori->tgl_posting = $request->tgl_posting;
            $kategori->save();
            if (!$kategori) {
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
            'data' => $kategori, 200
        ]);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\kategoris  $kategoris
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $kategori = kategoris::destroy($id);
        if (! $kategori) {
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
            'data' => $kategori, 200,
        ]);
    }
}

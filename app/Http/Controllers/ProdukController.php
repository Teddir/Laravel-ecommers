<?php

namespace App\Http\Controllers;

use App\produks;
use Illuminate\Http\Request;
use App\kategoris;
use App\User;

class ProdukController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //-------------------------------------------------------------->API    
        $produk = produks::get();
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
        $produk = produks::get();
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
            'status' => 'required',
            'diskon' => 'required',
        ]);

        $imgName = $request->image->getClientOriginalName() . '-' . time() . '.' . $request->image->extension();

        $request->image->move(public_path('image'), $imgName);
            // dd($imgName);
        try {
            $produk = new produks;
            $produk->name_produk = $request->name_produk;
            $produk->user_id = auth()->user()->id;
            $produk->kategori_id = $request->kategori_id;
            $produk->desc = $request->desc;
            $produk->harga = $request->harga;
            $produk->stok = $request->stok;
            $produk->image = $imgName;
            $produk->status = $request->status;
            $produk->diskon = $request->diskon;
            $produk->save();

        
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
            'data' => $produk, 200
        ]);
        
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\produks  $produks
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $produk = produks::find($id);
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
     * Show the form for editing the specified resource.
     *
     * @param  \App\produks  $produks
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $produk = produks::with(['kategoris'])->orderBy('created_at', 'asc')->find($id);
        $produk = produks::find($id);
        if (!$produk) {
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
        $produk->user_id = auth()->user()->id;
        $produk->kategori_id = $request->kategori_id;
        $produk->save();
            if (!$produk) {
                
            }
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

    //-------------------------------------------------------------->WEB
    public function render(Request $request, $cari)
    {
        $produk =  produks::WHERE('name', 'like', '%' . $cari . '%');
        $produk->cari = $request->cari;
        return view('dashbord', compact('produk'));
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
    
    public function index1(){

        $produk = produks::get();
        $users = User::get();
        // $produk = produks::get();
        $produk = produks::with('users', 'produks')->get();
        return view('Tampilan.Produk.produk', compact('produk', 'users', 'produk'));

    }

    public function show1(produks $produks)
    {
        $kategori = kategoris::get();
        $user = User::get();
        $produk = produks::with(['kategoris'])->orderBy('created_at', 'asc')->get();
        return view('Tampilan.Produk.create', compact('produk', 'kategori', 'user'));

    }


    public function store1(Request $request)
    {
        $request->validate([
            'name_produk' => 'required',
            'desc' => 'required',
            'harga' => 'required',
            'stok' => 'required',
            'status' => 'required',
            'diskon' => 'required',
        ]);

        $imgName = $request->image->getClientOriginalName() . '-' . time() . '.' . $request->image->extension();

        $request->image->move(public_path('image'), $imgName);

        $user = User::find($request->id);
            $produk = new produks;
            $produk->name_produk = $request->name_produk;
            $produk->user_id = $user;
            $produk->desc = $request->desc;
            $produk->harga = $request->harga;
            $produk->stok = $request->stok;
            $produk->image = $imgName;
            $produk->status = $request->status;
            $produk->diskon = $request->diskon;
            $produk->save();

            return redirect('/admin/index1')->with(['success' => 'Kategori Diperbaharui!']);
        
    }

    public function edit1($id)
    {
        $produk = produks::find($id);
        $kategori = kategoris::with(['produk'])->orderBy('created_at', 'asc')->get();
        return view('Tampilan.Produk.edit', compact('produk','kategori'));
    }

    public function update1(Request $request, $id)
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

        $produk = produks::find($id);
        $produk->name_produk = $request->name_produk;
        $produk->desc = $request->desc;
        $produk->harga = $request->harga;
        $produk->stok = $request->stok;
        $produk->image = $imgName;
        $produk->status = $request->status;
        $produk->diskon = $request->diskon;
        $produk->save();

        return redirect('/admin/index1')->with(['success' => 'Kategori Diperbaharui!']);
    }

    public function destroy1($id)
    {
        $produk = produks::destroy($id);
        return redirect('/admin/index1')->with(['success' => 'Kategori Diperbaharui!']);
    
    }

}



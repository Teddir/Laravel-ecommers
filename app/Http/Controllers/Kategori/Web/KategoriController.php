<?php

namespace App\Http\Controllers\Kategori\Web;

use App\Http\Controllers\Controller;
use App\hubungis;
use App\kategoris;
use App\produks;
use Illuminate\Http\Request;
use Kategori;

class KategoriController extends Controller
{   //-------------------------------------------------------------->WEB

          /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index1()
    {
        $produk = produks::get();
        $kategori = kategoris::with(['produks'])->orderBy('created_at', 'asc')->get();
        // return response()->json(['data' => $kategori]);
        return view('Tampilan.Kategori.create', compact('kategori', 'produk'));
    
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create1()
    {
        $produk = produks::get();
        $kategori = kategoris::with(['produk'])->orderBy('created_at', 'asc')->get();
        // return response()->json(['data' => $kategori]);
        return view('Tampilan.Kategori.create', compact('kategori', 'produk'));
    
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store1(Request $request)
    {
        $request->validate([
            'name_kategori' => 'required',
            // 'tgl_posting' => 'required',
        ]);
            $kategori = new kategoris();
            $kategori->name_kategori = $request->name_kategori;
            $kategori->save();
            return redirect('/admin/index1')->with(['success' => 'Kategori Diperbaharui!']);
       
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\kategoris  $kategoris
     * @return \Illuminate\Http\Response
     */
    public function show1($id)
    {
        $produk = produks::get();
        $kategori = kategoris::with(['produk'])->orderBy('created_at', 'asc')->find($id);
        // return response()->json(['data' => $kategori]);
        return view('Tampilan.Kategori.create', compact('kategori', 'produk'));
    
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\kategoris  $kategoris
     * @return \Illuminate\Http\Response
     */
    public function edit1($id)
    {
        $produk = produks::get();
        $kategori = kategoris::with(['produk'])->orderBy('created_at', 'asc')->find($id);
        // return response()->json(['data' => $kategori]);
        return view('Tampilan.Kategori.edit', compact('kategori', 'produk'));     
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\kategoris  $kategoris
     * @return \Illuminate\Http\Response
     */
    public function update1(Request $request, $id)
    {
        $request->validate([
            'name_kategori' => 'required',
        ]);

            //code...
            $kategori = kategoris::find($id);
            $kategori->name_kategori = $request->name_kategori;
            $kategori->save();

            return redirect('/admin/index1')->with(['success' => 'Kategori Diperbaharui!']);
      

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\kategoris  $kategoris
     * @return \Illuminate\Http\Response
     */
    public function destroy1($id)
    {
        $kategori = kategoris::destroy($id);
        return redirect('/admin/index1')->with(['success' => 'Kategori Diperbaharui!']);

      
    }
    
}

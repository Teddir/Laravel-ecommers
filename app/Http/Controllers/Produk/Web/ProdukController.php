<?php

namespace App\Http\Controllers\Produk\Web;

use App\Http\Controllers\Controller;
use App\produks;
use Illuminate\Http\Request;
use App\kategoris;
use App\User;
use illuminate\support\Str;
use App\keranjangs;
use App\orders;
use App\penjuals;

class ProdukController extends Controller
{


    public function __construct1()
    {
        $this->middleware('auth');
    }

    public function index1(Request $request)       //-------------------------------------------------------------->Admin

    {
        // $produk = produks::where('user_id', auth()->user()->id)->with('kategoris')->get();
        // dd($produk);
        $penjual = penjuals::get();
        $produk = produks::get();
        return view('Tampilan.admin.daftar_produk', compact('produk','penjual'));
    }

    public function index2(Request $request)            //-------------------------------------------------------------->User
    {
        $produk = produks::where('user_id', auth()->user()->id)->with('kategoris')->get();
        // dd($produk);
        return view('Tampilan.user.Produk.produk', compact('produk'));
    }


    public function show1(produks $produks)
    {
        $kategori = kategoris::get();
        $user = User::get();
        $produk = produks::with(['kategoris'])->orderBy('created_at', 'asc')->get();
        return view('Tampilan.admin.Produk.create', compact('produk', 'kategori', 'user'));
    }

    public function show2(produks $produks)
    {
        $kategori = kategoris::get();
        $user = User::get();
        $produk = produks::with(['kategoris'])->orderBy('created_at', 'asc')->get();
        return view('Tampilan.user.Produk.create', compact('produk', 'kategori', 'user'));
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
        $produk = new produks;
        $produk->name_produk = $request->name_produk;
        $produk->user_id = auth()->user()->id;
        $produk->desc = $request->desc;
        $produk->harga = $request->harga;
        $produk->stok = $request->stok;
        $file = base64_encode(file_get_contents($request->image));

        $client = new \GuzzleHttp\Client();
        $response = $client->request('POST', 'https://freeimage.host/api/1/upload', [
            'form_params' => [
                'key' => '6d207e02198a847aa98d0a2a901485a5',
                'action' => 'upload',
                'source' => $file,
                'format' => 'json'
            ]
        ]);

        $data = $response->getBody()->getContents();
        $data = json_decode($data);
        $image = $data->image->url;

        $produk->image = $image;
        $produk->status = $request->status;
        $produk->diskon = $request->diskon;
        $produk->save();

        return redirect('/admin/index1')->with(['success' => 'Kategori Diperbaharui!']);
    }


    public function store2(Request $request)
    {
        $request->validate([
            'name_produk' => 'required',
            'desc' => 'required',
            'harga' => 'required',
            'stok' => 'required',
            'status' => 'required',
            'diskon' => 'required',
        ]);
        $produk = new produks;
        $produk->name_produk = $request->name_produk;
        $produk->user_id = auth()->user()->id;
        $produk->desc = $request->desc;
        $produk->harga = $request->harga;
        $produk->stok = $request->stok;
        $file = base64_encode(file_get_contents($request->image));

        $client = new \GuzzleHttp\Client();
        $response = $client->request('POST', 'https://freeimage.host/api/1/upload', [
            'form_params' => [
                'key' => '6d207e02198a847aa98d0a2a901485a5',
                'action' => 'upload',
                'source' => $file,
                'format' => 'json'
            ]
        ]);

        $data = $response->getBody()->getContents();
        $data = json_decode($data);
        $image = $data->image->url;

        $produk->image = $image;
        $produk->status = $request->status;
        $produk->diskon = $request->diskon;
        $produk->save();

        return redirect('/user/index1')->with(['success' => 'Kategori Diperbaharui!']);
    }

    public function edit1($id)
    {
        $produk = produks::find($id);
        $kategori = kategoris::with('produks')->orderBy('created_at', 'asc')->get();
        return view('Tampilan.admin.Produk.edit', compact('produk', 'kategori'));
    }

    public function edit2($id)
    {
        $produk = produks::find($id);
        $kategori = kategoris::with('produks')->orderBy('created_at', 'asc')->get();
        return view('Tampilan.user.Produk.edit', compact('produk', 'kategori'));
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


        $produk = produks::find($id);
        $dataRequest = $request->all();
        $dataResult  = array_filter($dataRequest);
        $produk->name_produk = $request->name_produk;
        $produk->desc = $request->desc;
        $produk->harga = $request->harga;
        $produk->stok = $request->stok;
        $file = base64_encode(file_get_contents($request->image));

        $client = new \GuzzleHttp\Client();
        $response = $client->request('POST', 'https://freeimage.host/api/1/upload', [
            'form_params' => [
                'key' => '6d207e02198a847aa98d0a2a901485a5',
                'action' => 'upload',
                'source' => $file,
                'format' => 'json'
            ]
        ]);

        $data = $response->getBody()->getContents();
        $data = json_decode($data);
        $image = $data->image->url;

        $produk->image = $image;
        $produk->status = $request->status;
        $produk->diskon = $request->diskon;
        $produk->save();

        return redirect('/admin/index1')->with(['success' => 'Kategori Diperbaharui!']);
    }

    public function update2(Request $request, $id)
    {
        $request->validate([
            'name_produk' => 'required',
            'desc' => 'required',
            'harga' => 'required',
            'stok' => 'required|integer',
            'status' => 'required',
            'diskon' => 'required',
        ]);


        $produk = produks::find($id);
        $dataRequest = $request->all();
        $dataResult  = array_filter($dataRequest);
        $produk->name_produk = $request->name_produk;
        $produk->desc = $request->desc;
        $produk->harga = $request->harga;
        $produk->stok = $request->stok;
        $file = base64_encode(file_get_contents($request->image));

        $client = new \GuzzleHttp\Client();
        $response = $client->request('POST', 'https://freeimage.host/api/1/upload', [
            'form_params' => [
                'key' => '6d207e02198a847aa98d0a2a901485a5',
                'action' => 'upload',
                'source' => $file,
                'format' => 'json'
            ]
        ]);

        $data = $response->getBody()->getContents();
        $data = json_decode($data);
        $image = $data->image->url;

        $produk->image = $image;
        $produk->status = $request->status;
        $produk->diskon = $request->diskon;
        $produk->save();

        return redirect('/user/index1')->with(['success' => 'Kategori Diperbaharui!']);
    }

    public function destroy1($id)
    {
        $produk = produks::destroy($id);
        return redirect('/admin/index1')->with(['success' => 'Kategori Diperbaharui!']);
    }

    public function destroy2($id)
    {
        $produk = produks::destroy($id);
        return redirect('/user/index1')->with(['success' => 'Kategori Diperbaharui!']);
    }


    //-------------------------------------------------------------->WEBSITE

    public function produkall()
    {
        // $produk = produks::where('user_id', auth()->user()->id())->with('produks', 'keranjangs', 'users');
        $produk = produks::get();
        // $produkdetail = produks::find($id);
        return view('website.store', compact('produk'));
    }

    public function bestseller()
    {
        return view('website.store', compact('produk'));
    }

    public function newproduk()
    {
        $produk = produks::get();
        // $produk = produks::find($id);
        return view('website.store', compact('produk'));
    }

    
}

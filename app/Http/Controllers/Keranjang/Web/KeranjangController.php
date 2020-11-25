<?php

namespace App\Http\Controllers\Keranjang\Web;

use App\Http\Controllers\Controller;
use App\keranjangdetail;
use App\keranjangs;
use App\orders;
use App\produks;
use Illuminate\Http\Request;
use Produk;

class KeranjangController extends Controller
{    //-----------------------------------------> website faedah.store
    
    public function pesan1(Request $request, $id)
    {
        $produk = produks::where('id', $id)->first();
        // dd($produk);

        if ($request->qty > $produk->stok) {
            return redirect('/website')->with('status', 'Maaf Stok Tidak Cukup');
        }
        $cek_pesanan =  keranjangs::where('user_id', auth()->user()->id)->where('status', 0)->first();
        if (empty($cek_pesanan)) {
            # code...
            //simpan database
            $keranjang = new keranjangs;
            $keranjang->user_id = auth()->user()->id;
            $keranjang->status = 0;
            $keranjang->subtotal = 0;
            $keranjang->save();
        }

        //simpan ke databsw keranjangdetails
        $keranjang_new = keranjangs::where('user_id', auth()->user()->id)->where('status', 0)->first();

        //cek keranjang new
        $cek_keranjangdetail = keranjangdetail::where('produk_id', $produk->id)
        ->where('keranjang_id', $keranjang_new->id)->first();

        if (empty($cek_keranjangdetail)) {
            $keranjangdetail = new keranjangdetail;
            $keranjangdetail->produk_id = $produk->id;
            $keranjangdetail->keranjang_id = $keranjang_new->id;
            $keranjangdetail->jumlah_pesan = $request->qty;
            $keranjangdetail->subtotal = $produk->harga * $request->qty;
            $keranjangdetail->save();
    
        } else
        {
            $cek_keranjangdetail = keranjangdetail::where('produk_id', $produk->id)
            ->where('keranjang_id', $keranjang_new->id)->first();

            $cek_keranjangdetail->jumlah_pesan = $cek_keranjangdetail->jumlah_pesan+$request->qty;
            
            //harga sekarang
            $harga_keranjangdetail_new = $produk->harga*$request->qty;
            $cek_keranjangdetail->subtotal = $cek_keranjangdetail->subtotal+$harga_keranjangdetail_new;
            $cek_keranjangdetail->update();
        }

        //jumlah total
        $keranjang = keranjangs::where('user_id', auth()->user()->id)->where('status', 0)->first();
        $keranjang->subtotal = $keranjang->subtotal+$produk->harga*$request->qty;
        $keranjang->update();
        return redirect('/website')->with('status', 'Pesanan Berhasil Di Hapus');


    }


    public function chekout1()
    {
        // $produk = produks::where('user_id', auth()->user()->id)->where('chekout')->first();
        $keranjang = keranjangs::where('user_id', auth()->user()->id)->where('status', 0)->first();
        // dd($keranjang);

        if (empty($keranjang->id)) {
            return redirect('/website');
        }
        $keranjangdetail = keranjangdetail::where('keranjang_id', $keranjang->id)->get();
        // dd($keranjangdetail);
        return view('website.cart', compact('keranjang', 'keranjangdetail'));
        
    }

    public function konfirmasi1()
    {
        $keranjang = keranjangs::where('user_id', auth()->user()->id)->where('status', 0)->first();
        $keranjang_id = $keranjang->id;
        $keranjang->status = 1;
        $keranjang->update();

        $keranjangdetail = keranjangdetail::where('keranjang_id', $keranjang_id)->get();
        foreach ($keranjangdetail as $keranjangdetail) {
            $produk = produks::where('id', $keranjangdetail->produk_id)->first();
            $produk->stok = $produk->stok - $keranjangdetail->jumlah_pesan;

            $produk->update();

            return redirect('/website')->with('status', 'Pesanan Berhasil Di Hapus');

        
        }
        
    }

    public function destroy1($id)
    {
        $keranjangdetail = keranjangdetail::where('id', $id)->first();

        $keranjang = keranjangs::where('id', $keranjangdetail->keranjang_id)->first();
        // dd($keranjang);
        $keranjang->subtotal = $keranjang->subtotal-$keranjangdetail->subtotal;
        $keranjang->update();
            // dd($keranjang); 
        $keranjangdetail->delete();

        return redirect('/website')->with('status', 'Pesanan Berhasil Di Hapus');
     
    }

    public function cari(Request $request)
    {
        $cari = $request->get('cari');
        $result =  produks::WHERE('name_produk', 'like', '%' . $cari . '%')->paginate(10);

        return view('website.cari', compact('cari', 'result'));

    }


   
}

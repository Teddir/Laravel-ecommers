<?php

namespace App\Http\Controllers\Keranjang\Api;

use App\Http\Controllers\Controller;
use App\keranjangdetail;
use App\keranjangs;
use App\orders;
use App\produks;
use Illuminate\Http\Request;
use Produk;
use App\finish;

class KeranjangController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function __construct()
    {
        $this->middleware('jwt.verify');
    }

    public function index()
    {
        $keranjang = keranjangs::where('user_id', auth()->user()->id)->with('users')->orderBy('created_at', 'DESC')->get();
        if (!$keranjang) {
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
            'data' => $keranjang, 200,
        ]);
    }

    public function pesan(Request $request, $id)
    {
        $produk = produks::where('id', $id)->first();
        // dd($produk);

        $request->validate([
            'jumlah_pesan' => 'required',

        ]);


        if ($request->jumlah_pesan > $produk->stok) {
            return response()->json([
                'status' => 'Error',
                'Message' => 'Stok Mencapai Batas',
                'data' => NULL, 402,
            ]);
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
            $keranjangdetail->jumlah_pesan = $request->jumlah_pesan;
            $keranjangdetail->subtotal = $produk->harga * $request->jumlah_pesan;
            $keranjangdetail->save();
        } else {
            $cek_keranjangdetail = keranjangdetail::where('produk_id', $produk->id)
                ->where('keranjang_id', $keranjang_new->id)->first();

            $cek_keranjangdetail->jumlah_pesan = $cek_keranjangdetail->jumlah_pesan + $request->jumlah_pesan;

            //harga sekarang
            $harga_keranjangdetail_new = $produk->harga * $request->jumlah_pesan;
            $cek_keranjangdetail->subtotal = $cek_keranjangdetail->subtotal + $harga_keranjangdetail_new;
            $cek_keranjangdetail->update();
        }

        //jumlah total
        $keranjang = keranjangs::where('user_id', auth()->user()->id)->where('status', 0)->first();
        $keranjang->subtotal = $keranjang->subtotal + $produk->harga * $request->jumlah_pesan;
        try {
            //code...
            $keranjang->update();
        } catch (\Throwable $th) {
            //throw $th;
            return response()->json([
                'status' => 'Error',
                'Message' => 'Data Gagal Di Tampilkan',
                'data' => NULL, 402,
            ]);
        }
        return response()->json([
            'status' => 'Succes',
            'Message' => 'Data Berhasil Di Tampilkan',
            'data' => $keranjang, 200,
        ]);
    }



    public function detailkeranjang()
    {

        // $produk = produks::where('id', $id)->first();

        $keranjang = keranjangs::where('user_id', auth()->user()->id)->where('status', 0)->first();

        if (empty($keranjang->id)) {
            return response()->json([
                'status' => 'Error',
                'Message' => 'Maaf Anda Tidak Memiliki Daftar Barang Di Keranjang',
                'data' => NULL, 402,
            ]);
        }
        $keranjangdetail = keranjangdetail::where('keranjang_id', $keranjang->id, 'produk_id')->with('produks')->orderBy('created_at', 'DESC')->get();
        //  dd($keranjangdetail);
        return response()->json([
            'status' => 'Succes',
            'Message' => 'Berhasil Menampilkan Keranjang',
            'data' => $keranjangdetail, 200,
        ]);
    }

    public function konfirmasi(Request $request)
    {
        $keranjang = keranjangs::where('user_id', auth()->user()->id)->where('status', 0)->first();
        if (empty($keranjang->id)) {
            return redirect('/website')->with('status', 'Pesanan Tidak Terdaftar');
        }
        $keranjang_id = $keranjang->id;
        $keranjang->status = 1;
        $keranjang->update();


        $keranjangdetail = keranjangdetail::where('keranjang_id', $keranjang_id)->get();
        foreach ($keranjangdetail as $keranjangdetails) {
            $produk = produks::where('id', $keranjangdetails->produk_id)->first();
            $produk->stok = $produk->stok - $keranjangdetails->jumlah_pesan;
            $produk->update();
            // dd($produk);
            # code...
            $finish = new finish;
            $finish->qty = $keranjangdetails->jumlah_pesan;
            $finish->status = 0;
            $finish->pengiriman = 0;
            $finish->produk_id = $keranjangdetails->produk_id;
            $finish->user_id = auth()->user()->id;
            $finish->penjual_id = $produk->penjual_id;
            $finish->keranjangdetail_id = $keranjangdetails->keranjang_id;
            $finish->save();
        }
        return response()->json([
            'status' => 'Succes',
            'Message' => 'Data Berhasil Di Tampilkan',
            'data' => $finish, 200,
        ]);
    }

    public function destroy($id)
    {
        $keranjangdetail = keranjangdetail::where('id', $id)->first();

        $keranjang = keranjangs::where('id', $keranjangdetail->keranjang_id)->first();
        // dd($keranjang);
        $keranjang->subtotal = $keranjang->subtotal - $keranjangdetail->subtotal;
        $keranjang->update();
        // dd($keranjang);
        try {
            //code...
            $keranjangdetail->delete();
        } catch (\Throwable $th) {
            return response()->json([
                'status' => 'Error',
                'Message' => $th->getMessage(),
                'data' => NULL, 402,
            ]);
        }
        return response()->json([
            'status' => 'Succes',
            'Message' => 'Data Berhasil Di Hapus',
            'data' => $keranjangdetail, 200,
        ]);
    }
}

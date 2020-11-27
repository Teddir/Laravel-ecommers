<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\finish;
use App\keranjangdetail;

class FinishController extends Controller
{
  public function finish(Request $request)            //-------------------------------------------------------------->User
  {
    $finish = finish::where('penjual_id', auth()->user()->id)->with( 'produks', 'keranjangs')->get();
    // dd($finish);    
    if (!$finish) {
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
      'data' => $finish, 200,
  ]);
    //barang terjual

  }

  public function penjualan(Request $request)            //-------------------------------------------------------------->User
  {
    $finish = finish::where('penjual_id', auth()->user()->id)->with( 'produks', 'keranjangs')->get();
    // dd($finish);    
    return view('Tampilan.user.Produk.penjualan', compact('finish'));

    //barang terjual

  }
}

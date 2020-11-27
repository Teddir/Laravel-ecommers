<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\finish;
use App\keranjangdetail;

class FinishController extends Controller
{
  public function penjualan(Request $request)            //-------------------------------------------------------------->User
  {
    $finish = finish::where('penjual_id', auth()->user()->id)->with( 'produks', 'keranjangs')->get();
    // dd($finish);    
    return view('Tampilan.user.Produk.penjualan', compact('finish'));

    //barang terjual

  }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\finish;
use App\keranjangdetail;
use App\penjuals;
use App\User;

class FinishController extends Controller
{
  public function finish(Request $request)            //-------------------------------------------------------------->User
  {
    $finish = finish::get();
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
      'Message' => 'Invoice Berhasil Di Cetak',
      'data' => $finish, 200,
      // dd($finish),
    ]);
    //barang terjual

  }

  public function finishp(Request $request)            //-------------------------------------------------------------->User
  {
    $penjual = penjuals::where('user_id', auth()->user()->id)->get();
    $finish = finish::where('penjual_id', $penjual[0]->id)->with('produks', 'keranjangs')->get();
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
      'Message' => 'Invoice Berhasil Di Cetak',
      'data' => $finish, 200,
      // dd($finish),
    ]);
    //barang terjual

  }

  public function finishb(Request $request)            //-------------------------------------------------------------->User
  {
    $finish = finish::where('user_id', auth()->user()->id)->with('produks', 'keranjangs')->get();
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
      'Message' => 'Invoice Berhasil Di Cetak',
      'data' => $finish, 200,
      // dd($finish),
    ]);
    //barang terjual

  }

  public function penjualan(Request $request)            //-------------------------------------------------------------->User
  {
    $penjual = penjuals::where('user_id', auth()->user()->id)->get();

    $finish = finish::where('penjual_id', $penjual[0]->id)->with('produks', 'keranjangs')->get();
    // dd($finish);    
    return view('Tampilan.user.Produk.penjualan', compact('finish'));

    //barang terjual

  }


  public function invoice($id)
  {
      // $kategori = kategoris::get();
      // $user = User::with(['penjuals'])->orderBy('created_at', 'asc')->get(); //-------------> USER
      // $finish = finish::where('user_id', auth()->user()->id)->get();
      $user = User::with('users','finis','finish')->find($id);
      $finish = finish::find($id);
      // dd($user);
      return view('send_email', compact('user', 'finish'));

  }
}

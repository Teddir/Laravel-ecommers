<?php

namespace App\Http\Controllers;

use App\finish;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\keranjangdetail;
use App\penjuals;
use App\produks;
use App\User;

class Email extends Controller
{

    public function sendEmail(Request $request)
    {
        // $user = User::with('finish')->find($id);
        // // dd($user);
        // // return view('send_email', compact('user'));
        // return view('email', compact('user'));

        try {
            Mail::send(
                'email',
                [
                    'nama' => $request->nama,
                    'pesan' => $request->pesan
                ],
                function ($message) use ($request) {

                    $message->subject($request->judul);
                    $message->from('faedah@store.com', 'Faedah.Store');
                    $message->to($request->email);

                    
                    $finish_id = finish::where('penjual_id', auth()->user()->id)->where('status', 0)->first();
                    $finish = $finish_id; 
                    $finish->status = 1;
                    $finish->update();
                    // dd($finish_id);
                    // dd($finish);
                }
            );
            return back()->with('alert-success', 'Berhasil Kirim Email');
        } catch (Exception $e) {
            return response(['status' => false, 'errors' => $e->getMessage()]);
        }
    }
}

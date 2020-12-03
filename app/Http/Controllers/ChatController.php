<?php

namespace App\Http\Controllers;

use App\User;
use App\messages;
use App\penjuals;
use GuzzleHttp\Psr7\Message;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Pusher\Pusher;

class ChatController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    // public function __construct()
    // {
    //     $this->middleware('auth');
    // }

    public function searcToko(Request $request)
    {
        $cari = $request->get('cari');
        if (empty($cari)) {
            # code...
            return response()->json([
                'Message' => 'Anda Belum Mengisi Nama Akun(cari)',
            ]);
        }
        $result =  penjuals::WHERE('name_toko', 'like', '%' . $cari . '%')->paginate(10);

        if (empty($result)) {
            return response()->json([
                'status' => 'Error',
                'Message' => 'Name User Tidak Di Temukan',
                'data' => NULL, 402,
            ]);
        }
        return response()->json([
            'status' => 'Succes',
            'Message' => 'User Berhasil Di Temukan',
            'data' => $result, 200,
        ]);
    }

    public function searcpesan(Request $request)
    {
        $cari = $request->get('cari');
        if (empty($cari)) {
            # code...
            return response()->json([
                'Message' => 'Anda Belum Mengisi Nama Akun(cari)',
            ]);
        }
        $result =  messages::WHERE('message', 'like', '%' . $cari . '%')->paginate(10);
        if (empty($result)) {
            return response()->json([
                'status' => 'Error',
                'Message' => 'Name User Tidak Di Temukan',
                'data' => NULL, 402,
            ]);
        }
        return response()->json([
            'status' => 'Succes',
            'Message' => 'User Berhasil Di Temukan',
            'data' => $result, 200,
        ]);
    }


    public function allchat()
    {
        $user = User::first();
        // $id = auth()->user()->id;
        // $user = User::where('id', $id);
        // $messages = messages::where('from', $user->id)->first();
        $messages = messages::get();
        // dd($messages);
        if (empty($messages)) {
            return response()->json([
                'status' => 'Error',
                'Message' => 'Belum Ada Message Di Antara User',
                'data' => NULL, 402,
            ]);
        }
        return response()->json([
            'status' => 'Succes',
            'Message' => 'All Chat Berhasil Di Tampilkan',
            'data' => $messages, 200,
        ]);
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */

    public function index1()
    {
        $from = DB::table('users')
            ->join('messages', 'users.id', '=', 'messages.from')
            ->where('users.id', '!=', auth()->user()->id)
            ->where('messages.to', '=', auth()->user()->id)
            // ->where('messages.is_read', 0)
            ->select('users.id', 'users.name', 'users.avatar', 'users.email')
            ->distinct()->get()->toArray();  //---> guna distinct digunakan untuk memastikan tidak ada dua baris data atau lebih yang menampilkan nilai yang sama

        $to = DB::table('users')
            ->join('messages', 'users.id', '=', 'messages.to')
            ->where('users.id', '!=', auth()->user()->id)
            ->where('messages.from', '=', auth()->user()->id)
            ->select('users.id', 'users.name', 'users.avatar', 'users.email')
            ->distinct()->get()->toArray();

        $contact = array_unique(array_merge($from, $to,), SORT_REGULAR);
        if (empty($contact)) {
            return response()->json([
                'status' => 'Error',
                'Message' => 'Halaman Chat Tidak Di Temukan',
                'data' => NULL, 402,
            ]);
        }
        return response()->json([
            'status' => 'Succes',
            'Message' => 'Berhasil Menampilkan Hal Chat',
            'data' => $contact, 200,
        ]);
    }


    public function index()
    {
        // $users = User::where('id', '!=', Auth::id())->get();
        // return view('home', ['users' => $users ]);

        $users =  DB::select('SELECT users.id, users.name, users.avatar, users.email, 
        count(is_read) as unread FROM users LEFT JOIN messages ON users.id = messages.from AND is_read = 0  
        WHERE users.id <>  messages.to   GROUP BY users.id, users.name, users.avatar, users.email');
        return view('halchat', compact('users'));
    }

    public function getMessage1($user_id)
    {

        // return $user_id;
        $my_id = Auth::id();

        messages::where(['from' => $user_id, 'to' => $my_id])->update(['is_read' => 1]);

        $messages = messages::where(function ($query) use ($user_id, $my_id) {
            $query->where('from', $my_id)->where('to', $user_id);
        })->orwhere(function ($query) use ($user_id, $my_id) {
            $query->where('from', $user_id)->where('to', $my_id);
        })->orderBy('created_at', 'ASC')->get();
        if (empty($messages)) {
            return response()->json([
                'status' => 'Error',
                'Message' => 'Tidak Ada Chat',
                'data' => NULL, 402,
            ]);
        }
        return response()->json([
            'status' => 'Succes',
            'Message' => 'Berhasil Menampilkan Chat',
            'data' => $messages, 200,
        ]);
    }


    public function getMessage($user_id)
    {

        // return $user_id;
        $my_id = Auth::id();

        messages::where(['from' => $user_id, 'to' => $my_id])->update(['is_read' => 1]);

        $messages = messages::where(function ($query) use ($user_id, $my_id) {
            $query->where('from', $my_id)->where('to', $user_id);
        })->orwhere(function ($query) use ($user_id, $my_id) {
            $query->where('from', $user_id)->where('to', $my_id);
        })->get();

        return view('messages.index', ['messages' => $messages]);
    }

    public function sendMessage1(Request $request, $id)
    {
        $from = Auth::id();
        $to = $id;
        $message = $request->message;

        if (empty($message)) {
            return response()->json([
                'Message' => 'Anda Belum Mengisi Pesan(message)'
            ]);
        }


        $data = new messages();
        $data->from = $from;
        $data->to = $to;
        $data->message = $message;
        $data->is_read = 0;
        $data->save();

        //Pusher    
        $options = array(
            'cluster' => 'ap1',
            'useTLS' => true
        );
        $pusher = new Pusher(
            '65cc2e5ff5fbd2addc7a',
            'd09c21c29430d3efc39b',
            '1104140',
            $options
        );

        // $data = ['from' => $from, 'to' => $to];
        $pusher->trigger('my-channel', 'my-event', $data);

        return response()->json(['status' => 'succes', 'Message' => 'Chat Berhasil Terkirim', 'data' => $data]);
    }

    public function sendMessage(Request $request)
    {
        $from = Auth::id();
        $to = $request->receiver_id;
        $message = $request->message;

        $data = new messages();
        $data->from = $from;
        $data->to = $to;
        $data->message = $message;
        $data->is_read = 0;
        $data->save();

        //Pusher    
        $options  = array(
            'cluster' => 'ap1',
            'useTLS' => true
        );

        $pusher = new Pusher(
            env('PUSHER_APP_KEY'),
            env('PUSHER_APP_SECRET'),
            env('PUSHER_APP_ID'),
            $options
        );

        $data = ['from' => $from, 'to' => $to];
        $pusher->trigger('my-channel', 'my-event', $data);
    }
}

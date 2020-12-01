<?php

namespace App\Http\Controllers;

use App\User;
use App\messages;
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

    public function searc(Request $request)
    {
        $cari = $request->all();
        $result =  User::WHERE('name', 'like', '%' . $cari . '%')->paginate(10);
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

    public function index1($user_id)
    {
        // $users = User::where('id', '!=', Auth::id())->get();
        // return view('home', ['users' => $users ]);

        $users =  DB::select('SELECT users.id, users.name, users.avatar, users.email, 
        count(is_read) as unread FROM users LEFT JOIN messages ON users.id = messages.from AND is_read = 0  
        WHERE users.id <>  messages.to   GROUP BY users.id, users.name, users.avatar, users.email');

        if (empty($users)) {
            return response()->json([
                'status' => 'Error',
                'Message' => 'Halaman Chat Tidak Di Temukan',
                'data' => NULL, 402,
            ]);
        }
        return response()->json([
            'status' => 'Succes',
            'Message' => 'Berhasil Menampilkan Hal Chat',
            'data' => $users, 200,  
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
        })->get();
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
        // dd($to);
        if (empty($to)) {
            return response()->json([
                'Message' => 'Anda Belum Mengisi Penerima(receiver_id)'
            ]);
        }

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
        $options  = array(
            'cluster' => 'ap1',
            'useTLS' => true
        );

        $pusher = new Pusher(
            env('65cc2e5ff5fbd2addc7a'),
            env('d09c21c29430d3efc39b'),
            env('1104140'),
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
            env('65cc2e5ff5fbd2addc7a'),
            env('d09c21c29430d3efc39b'),
            env('1104140'),
            $options
        );

        $data = ['from' => $from, 'to' => $to];
        $pusher->trigger('my-channel', 'my-event', $data);
    }
}

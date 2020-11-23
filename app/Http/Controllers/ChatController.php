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
                'Message' => 'Name User Tidak Di Temukan',
                'data' => NULL, 402,
            ]);
        }
        return response()->json([
            'status' => 'Succes',
            'Message' => 'User Berhasil Di Temukan',
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
                'Message' => 'Tidak Ada Chat',
                'data' => NULL, 402,
            ]);
        }
        return response()->json([
            'status' => 'Succes',
            'Message' => 'Berhasil Menampilkan Chat',
            'data' => $users, 200,
        ]);
    }


    public function index($user_id)
    {
        // $users = User::where('id', '!=', Auth::id())->get();
        // return view('home', ['users' => $users ]);

        $users =  DB::select('SELECT users.id, users.name, users.avatar, users.email, 
        count(is_read) as unread FROM users LEFT JOIN messages ON users.id = messages.from AND is_read = 0  
        WHERE users.id <>  messages.to   GROUP BY users.id, users.name, users.avatar, users.email');
        return view('halchat', compact('users'));
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

    public function sendMessage(Request $request)
    {
        $from = Auth::id();
        $to = $request->to;
        $message = $request->message;

        $data = new messages();
        $data->from = $from;
        $data->to = $to;
        $data->message = $message;
        $data->is_read = 0;
        try {
            $data->save();
            //code...
        } catch (\Throwable $th) {
            return response()->json([
                'status' => 'Error',
                'Message' => $th->getMessage(),
                'data' => NULL, 402,
            ]);
        }
        return response()->json([
            'status' => 'Succes',
            'Message' => 'Berhasil Menampilkan Chat',
            'data' => $data, 200,
        ]);

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

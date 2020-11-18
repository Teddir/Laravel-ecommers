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
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
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

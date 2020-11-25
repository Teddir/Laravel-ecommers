<?php

namespace App\Http\Controllers\Penjual\Web;

use App\Http\Controllers\Controller;
use App\messages;
use App\penjuals;
use App\User;
use GuzzleHttp\Psr7\Message;
use Illuminate\Http\Request;
use Penjual;
use illuminate\Support\Str;

class PenjualController extends Controller
{
    //----------------------------------------------------Web

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index1()
    {
        $penjual = penjuals::get();
        return view('Tampilan.admin.Penjual.penjual', compact('penjual'));
    }

    public function index2()
    {
        // $penjual = penjuals::where('penjual_id', auth()->user()->id)->with('users', 'penjuals')->get(); --->user
        $penjual = penjuals::where('user_id', auth()->user()->id)->get();
        // dd($penjual);
        return view('Tampilan.user.penjual', compact('penjual'));
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store1(Request $request)
    {
        $request->validate([
            'name_toko' => 'required:unique:penjuals',
            'phone_number' => 'required|numeric',

        ]);
        $penjual = new penjuals;
        $penjual->user_id = $request->user_id;
        $penjual->name_toko = $request->name_toko;
        $penjual->phone_number = $request->phone_number;
        $penjual->save();

        return redirect('/admin/index2')->with(['success' => 'Kategori DiTambah!']);
    }

    public function store2(Request $request)
    {
        $request->validate([
            'name_toko' => 'required:unique:penjuals',
            'phone_number' => 'required|numeric',

        ]);
        $penjual = new penjuals;
        $penjual->user_id = $request->user_id;
        $penjual->name_toko = $request->name_toko;
        $penjual->phone_number = $request->phone_number;
        $penjual->save();

        return redirect('/user/index2')->with(['success' => 'Kategori DiTambah!']);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\penjuals  $penjuals
     * @return \Illuminate\Http\Response
     */
    public function show1(penjuals $penjuals)
    {
        $message = messages::get();
        $user = User::get();
        $penjual = penjuals::where('user_id', auth()->user()->id)->with('users')->get();
        return view('Tampilan.admin.Penjual.create', compact('penjual', 'message', 'user'));
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\penjuals  $penjuals
     * @return \Illuminate\Http\Response
     */
    public function edit1($id)
    {
        // $penjual = penjuals::where('penjual_id', auth()->user()->id)->with('users', 'penjuals')->find($id);  ---->user
        $user = User::get();
        $penjual = penjuals::find($id);
        return view('Tampilan.admin.Penjual.edit', compact('penjual', 'user'));
    }

    public function edit2($id)
    {
        // $penjual = penjuals::where('penjual_id', auth()->user()->id)->with('users', 'penjuals')->find($id);  ---->user
        $user = User::get();
        $penjual = penjuals::find($id);
        return view('Tampilan.user.Penjual.edit', compact('penjual', 'user'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\penjuals  $penjuals
     * @return \Illuminate\Http\Response
     */
    public function update1(Request $request, $id)
    {
        $request->validate([
            'name_toko' => 'required:unique:penjuals',
            'phone_number' => 'required:unique:penjuals',
        ]);

        $penjual = penjuals::find($id);
        $penjual->name_toko = $request->name_toko;
        $penjual->phone_number = $request->phone_number;
        $penjual->save();

        return redirect('/admin/index2')->with(['success' => 'Kategori Diperbaharui!']);
    }

    public function update2(Request $request, $id)
    {
        $request->validate([
            'name_toko' => 'required:unique:penjuals',
            'phone_number' => 'required:unique:penjuals',
        ]);

        $penjual = penjuals::find($id);
        $penjual->name_toko = $request->name_toko;
        $penjual->phone_number = $request->phone_number;
        $penjual->save();

        return redirect('/user/index2')->with(['success' => 'Kategori Diperbaharui!']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\penjuals  $penjuals
     * @return \Illuminate\Http\Response
     */
    public function destroy1($id)
    {
        $penjual = penjuals::destroy($id);
        return redirect('/admin/index2')->with(['success' => 'Kategori Diperbaharui!']);
    }

    public function destroy2($id)
    {
        $penjual = penjuals::destroy($id);
        return redirect('/user/index2')->with(['success' => 'Kategori Diperbaharui!']);
    }
}

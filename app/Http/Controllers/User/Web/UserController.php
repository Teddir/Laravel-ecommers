<?php

namespace App\Http\Controllers\User\Web;

use App\Http\Controllers\Controller;
use App\penjuals;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;
use illuminate\Support\Str;

class UserController extends Controller
{
    public function detail($id)
    {
        // $user = User::where('id', $id)->first();

        $penjual = penjuals::where('user_id', $id)->with('users')->first();
        // dd($penjual);
        return view('Tampilan.admin.Penjual.detail', compact('penjual'));
    }


    public function index1()
    {

        $user = User::get();
        return view('Tampilan.admin.Pembeli.pembeli', compact('user'));
    }

    public function index2()
    {

        $user = User::where('id', auth()->user()->id)->get();
        return view('Tampilan.user.Pembeli.pembeli', compact('user'));
    }

    public function show1(User $User)
    {
        // $kategori = kategoris::get();
        // $user = User::with(['penjuals'])->orderBy('created_at', 'asc')->get(); //-------------> USER
        $penjual = penjuals::get();
        $user = User::get();
        return view('Tampilan.admin.Pembeli.create', compact('penjual', 'user'));
    }


    public function store1(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed',
            'alamat' => 'required|string|max:255|unique:users',
        ]);

        $user = new User;
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->alamat = $request->alamat;
        $file = base64_encode(file_get_contents($request->avatar));
        $client = new \GuzzleHttp\Client();
        $response = $client->request('POST', 'https://freeimage.host/api/1/upload', [
            'form_params' => [
                'key' => '6d207e02198a847aa98d0a2a901485a5',
                'action' => 'upload',
                'source' => $file,
                'format' => 'json'
            ]
        ]);

        $data = $response->getBody()->getContents();
        $data = json_decode($data);
        $image = $data->image->url;
        $user->avatar = $image;
        $user->save();

        return redirect('/admin/index3')->with(['success' => 'Kategori Diperbaharui!']);
    }

    public function edit1($id)
    {
        // $user = User::with(['penjuals'])->orderBy('created_at', 'asc')->get();
        $user = user::find($id);
        return view('Tampilan.admin.Pembeli.edit', compact('user'));
    }

    public function edit2($id)
    {
        // $user = User::with(['penjuals'])->orderBy('created_at', 'asc')->get();
        $user = user::find($id);
        return view('Tampilan.user.Pembeli.edit', compact('user'));
    }

    public function update1(Request $request, $id)
    {
        $user = User::find($id);
        $dataRequest = $request->all();
        $dataResult = array_filter($dataRequest);
        $file = base64_encode(file_get_contents($request->avatar));
        $client = new \GuzzleHttp\Client();
        $response = $client->request('POST', 'https://freeimage.host/api/1/upload', [
            'form_params' => [
                'key' => '6d207e02198a847aa98d0a2a901485a5',
                'action' => 'upload',
                'source' => $file,
                'format' => 'json'
            ]
        ]);

        $data = $response->getBody()->getContents();
        $data = json_decode($data);
        $image = $data->image->url;
        $user->avatar = $image;
        $user->save();
        // $user->update($dataRequest);

        return redirect('/admin/index3')->with(['success' => 'Kategori Diperbaharui!']);
    }

    public function destroy1($id)
    {
        $produk = User::destroy($id);
        return redirect('/admin/index3')->with(['success' => 'Kategori Diperbaharui!']);
    }

    public function destroy2($id)
    {
        $produk = User::destroy($id);
        return redirect('/user/index3')->with(['success' => 'Kategori Diperbaharui!']);
    }
}

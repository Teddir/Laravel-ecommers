<?php

namespace App\Http\Controllers;

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
    public function login(Request $request)
    {
        $user = User::get();
        $credentials = $request->only('email', 'password');

        try {
            if (!$token = JWTAuth::attempt($credentials)) {
                return response()->json(['error' => 'invalid_credentials'], 400);
            }
        } catch (JWTException $e) {
            return response()->json(['error' => 'could_not_create_token'], 500);
        }

        return response()->json(compact('token'));
    }


    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed',
            'alamat' => 'required|string|max:255',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors()->toJson(), 400);
        }

        $user = User::create([
            'name' => $request->get('name'),
            'email' => $request->get('email'),
            'password' => Hash::make($request->get('password')),
            'avatar' => 'https://via.placeholder.com/150',
            'alamat' => $request->get('alamat'),
        ]);

        $token = JWTAuth::fromUser($user);

        return response()->json(compact('user', 'token'), 201);
    }

    public function getAuthenticatedUser()
    {
        try {

            if (!$user = JWTAuth::parseToken()->authenticate()) {
                return response()->json(['user_not_found'], 404);
            }
        } catch (Tymon\JWTAuth\Exceptions\TokenExpiredException $e) {

            return response()->json(['token_expired'], $e->getStatusCode());
        } catch (Tymon\JWTAuth\Exceptions\TokenInvalidException $e) {

            return response()->json(['token_invalid'], $e->getStatusCode());
        } catch (Tymon\JWTAuth\Exceptions\JWTException $e) {

            return response()->json(['token_absent'], $e->getStatusCode());
        }

        return response()->json(compact('user'));
    }

    public function userp()  //---->userpenjual
    {
        $user = User::where('id', auth()->user()->id)->with('penjuals')->get();
        // dd($user);
        if (!$user) {
            return response()->json([
                'status' => 'Error',
                'Message' => 'Data Gagal Di Hapus',
                'data' => NULL, 402,
            ]);
        }
        return response()->json([
            'status' => 'Succes',
            'Message' => 'Data Berhasil Di Tampilkan',
            'data' => $user, 200,
        ]);
    }

    public function index()
    {

        $user = User::get();
        if (!$user) {
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
            'data' => $user, 200,
        ]);
    }

    public function show($id)
    {
        $user = User::find($id);
        if (!$user) {
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
            'data' => $user, 200,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\User  $User
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = User::find($id);
        if (!$user) {
            return response()->json([
                'data' => NULL, 402
            ]);
        }
        return response()->json([
            'data' => $user, 200
        ]);
    }


    public function update(Request $request, $id)
    {

        $user = User::find($id);
        $dataRequest = $request->all();
        $dataResult = array_filter($dataRequest);
        // dd($dataRequest);
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
            try {
            $user->update($dataRequest);
        } catch (\Throwable $th) {
            return response([
                'status' => 'error',
                'message' => $th->getMessage(),
                'data' => NULL, 404
            ]);
        }
        return response([
            'status' => 'succes',
            'message' => 'Berhasil Di update',
            'data' => $user, 200
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\User  $User
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = User::destroy($id);

        if (!$user) {
            # code...
            return response()->json([
                'status' => 'Error',
                'Message' => 'Data Gagal Di Hapus',
                'data' => NULL, 402,
            ]);
        }
        return response()->json([
            'status' => 'Succes',
            'Message' => 'Data Berhasil Di Hapus',
            'data' => $user, 200,
        ]);
    }




    public function index1()
    {

        $user = User::get();
        return view('Tampilan.Pembeli.pembeli', compact('user'));
    }

    public function show1(User $User)
    {
        // $kategori = kategoris::get();
        // $user = User::with(['penjuals'])->orderBy('created_at', 'asc')->get(); //-------------> USER
        $penjual = penjuals::get();
        $user = User::get();
        return view('Tampilan.Pembeli.create', compact('penjual', 'user'));
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
        $user->password = $request->password;
        $user->alamat = $request->alamat;
        $file = base64_encode(file_get_contents($request->image));

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

        return redirect('/admin/index4')->with(['success' => 'Kategori Diperbaharui!']);
    }

    public function edit1($id)
    {
        // $user = User::with(['penjuals'])->orderBy('created_at', 'asc')->get();
        $user = user::find($id);
        return view('Tampilan.Pembeli.edit', compact('user'));
    }

    public function update1(Request $request, $id)
    {
        $user = User::find($id);
        $dataRequest = $request->all();
        $dataResult = array_filter($dataRequest);

        $file = base64_encode(file_get_contents($request->image));

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
        $user->save($dataRequest);

        return redirect('/admin/index4')->with(['success' => 'Kategori Diperbaharui!']);
    }

    public function destroy1($id)
    {
        $produk = User::destroy($id);
        return redirect('/admin/index4')->with(['success' => 'Kategori Diperbaharui!']);
    }

  
}

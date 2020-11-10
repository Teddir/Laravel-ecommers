<?php
 
namespace App\Http\Controllers;
 
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;
 
class UserController extends Controller
{
    public function login(Request $request)
    {
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
            'alamat' => 'required|string|max:255|unique:users',
            'phone_number' => 'required|min:8|max:13|unique:users',
        ]);
 
        if($validator->fails()){
            return response()->json($validator->errors()->toJson(), 400);
        }
 
        $user = User::create([
            'name' => $request->get('name'),
            'email' => $request->get('email'),
            'password' => Hash::make($request->get('password')),
            'avatar' => 'https://via.placeholder.com/150',
            'alamat' => $request->get('alamat'),
            'phone_number' => $request->get('phone_number'),    
        ]);
 
        $token = JWTAuth::fromUser($user);
 
        return response()->json(compact('user','token'),201);
    }
 
    public function getAuthenticatedUser()
    {
        try {
 
            if (! $user = JWTAuth::parseToken()->authenticate()) {
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

    public function edit($id)
    {
        $user = User::find($id);
        if (!$user) {
            # code...
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
       $request->validate([
           'name' => 'required',
           'email' => 'required',
           'avatar' => 'required',
           'password' => 'required',
           'alamat' => 'required',
           'phone_number' => 'required',   
       ]);

       $imgName = $request->old_avatar;
       if ($request->avatar) {
           $imgName = $request->avatar->getClientOriginalName() . '-' . time() . '.' . $request->avatar->extension();

           $request->avatar->move(public_path('image'), $imgName);
       }


       try {
           $user = User::find($id);
           $user->name = $request->name;
           $user->avatar = $imgName;
           $user->email = $request->email;
           $user->password = $request->password;
           $user->alamat = $request->alamat;
           $user->phone_number = $request->phone_number;
           $user->save();
           if (!$user) {
               return response([
                   'status' => 'error',
                   'message' => 'Invalid Credentials',
                   'data' => NULL, 404
               ]);
           }
       } catch (\Throwable $th) {
           $th->getMessage();
       }
       return response([
           'status' => 'succes',
           'message' => 'Berhasil Di update',
           'data' => $user, 200
       ]);
   }

}

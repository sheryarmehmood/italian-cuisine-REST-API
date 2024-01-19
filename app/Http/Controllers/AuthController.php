<?php

namespace App\Http\Controllers;
use Tymon\JWTAuth\Facades\JWTAuth;
// use JWTAuth;
use Validator;
use App\Models\User;
use Illuminate\Http\Request;
use Tymon\JWTAuth\Exceptions\JWTException;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str; 

class AuthController extends Controller
{
    public $token = true;
 
    public function register(Request $request)
    {

         $validator = Validator::make($request->all(), 
                      [ 
                      'name' => 'required|max:255',
                      'email' => 'required|email|max:255|unique:users',
                      'user_name' => 'required|max:255|unique:users',
                      'password' => 'required|max:255',  
                      'confirm_password' => 'required|same:password', 
                     ]);  

         if ($validator->fails()) {  

               return response()->json(['error'=>$validator->errors()], 401); 

            }   

        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = bcrypt($request->password);
        $user->user_name = $request->user_name;
         // Create 'nick_name' from 'name'
        $user->nick_name = Str::slug($request->name);
        $user->save();
 
        return response()->json([
            'success' => true,
            'data' => $user
        ], Response::HTTP_OK);
    }
 
    // User Login (POST, formdata)
    public function login(Request $request){
        
        // data validation
        $request->validate([
            "user_name" => "required",
            "password" => "required"
        ]);

        // JWTAuth
        $token = JWTAuth::attempt([
            "user_name" => $request->user_name,
            "password" => $request->password
        ]);

        if(!empty($token)){

            return response()->json([
                "status" => true,
                "message" => "User logged in succcessfully",
                "token" => $token
            ]);
        }

        return response()->json([
            "status" => false,
            "message" => "Invalid details"
        ]);
    }
 
// User Profile (GET)
public function profile(){

    $userdata = auth()->user();

    return response()->json([
        "status" => true,
        "message" => "Profile data",
        "data" => $userdata
    ]);
} 

// To generate refresh token value
public function refreshToken(){
        
    $newToken = auth()->refresh();

    return response()->json([
        "status" => true,
        "message" => "New access token",
        "token" => $newToken
    ]);
}


// User Logout (GET)
public function logout(){
        
    auth()->logout();

    return response()->json([
        "status" => true,
        "message" => "User logged out successfully"
    ]);
}


}
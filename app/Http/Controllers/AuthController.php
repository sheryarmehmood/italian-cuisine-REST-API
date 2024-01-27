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
use App\Jobs\SendLoginEmailJob;

class AuthController extends Controller
{
    public $token = true;
 
    public function register(Request $request)
    {

        $validator = Validator::make($request->all(), 
        [ 
        'name' => 'required|max:5',
        'email' => 'required|email|max:255|unique:users',
        'user_name' => 'required|max:255|unique:users',
        'password' => 'required|max:255',  
        'confirm_password' => 'required|same:password', 
        ]);  

        if ($validator->fails()) {  

        return response()->json(['error' => $validator->errors()->all()], 401);

        }   

        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = bcrypt($request->password);
        $user->user_name = $request->user_name;
         // Create 'nick_name' from 'name'
        $user->nick_name = Str::slug($request->name);
        
        if($user->save()){
            event(new \App\Events\UserRegistered($user));
            return response()->json([
                "status" => true,
                "message" => "User registered succcessfully",
            ]);
        }else{
            return response()->json([
                "status" => false,
                "message" => "User can't be registered, Please try again"
            ]);
        }

 
        // return response()->json([
        //     'success' => true,
        //     'data' => $user
        // ], Response::HTTP_OK);


    }
 
    
    // User Login
    public function login(Request $request){
        
        $validator = Validator::make($request->all(), 
            [ 
                "user_name" => "required",
                "password" => "required",
            ]);  

            if ($validator->fails()) {  
                return response()->json(['error' => $validator->errors()->first()], 401);
            }          

          // Check if the user exists
            $user = User::where("user_name", $request->user_name)->first();

            if (!$user) {
                return response()->json([
                    "status" => false,
                    "message" => "User not found. Please register first and then try login again."
                ]);
            }

            // Check the user's password
            if (!Hash::check($request->password, $user->password)) {
                return response()->json([
                    "status" => false,
                    "message" => "Invalid password"
                ]);
            }

        // JWTAuth
        $token = JWTAuth::attempt([
            "user_name" => $request->user_name,
            "password" => $request->password
        ]);

        if(!empty($token)){

            dispatch(new SendLoginEmailJob($user));

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
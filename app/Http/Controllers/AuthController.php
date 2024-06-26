<?php

namespace App\Http\Controllers;

use App\Events\UserRegister;
use App\Http\Requests\RegisterRequest;
use App\Http\Requests\LoginRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Traits\ResponseTrait;
use Illuminate\Auth\Events\Login;
use PHPOpenSourceSaver\JWTAuth\Exceptions\JWTException;
use PHPOpenSourceSaver\JWTAuth\Facades\JWTAuth;

class AuthController extends Controller
{ 
    use ResponseTrait;
 
    public function login(LoginRequest $request)
    {  
        $request->validated();
        $credentials = $request->only('email', 'password');

        $token = Auth::attempt($credentials);
        if (!$token) {
          return $this->ReturnError("Unauthorized", 401);
        }

        $user = Auth::user();
        $msg="successfully User login";
        return $this->Return_Register_Login_Refresh_Success($user, $token, $msg);
    }

    public function register(RegisterRequest $request){
         $request->validated();

        $user = User::create([
       'full_name' => $request->first_name.' '.$request->last_name,
        'email' => $request->email,
        'password' => Hash::make($request->password),
        ]);
        
        event(new UserRegister($user));

        $token = Auth::login($user);
        $msg= "successfully User created";
        return $this->Return_Register_Login_Refresh_Success($user, $token, $msg);

    }
  
    public function logout()
    {
        Auth::logout();
        $msg= "Successfully logged out";
        return $this->ReturnSuccess($msg);
    }

    public function refresh()
    {  try{
        $NewToken = JWTAuth::refresh(JWTAuth::getToken());
       }

      catch(JWTException $e){
        
        return $this->ReturnError("could_not_refresh_token",500);
      }

        $msg = "successfully  Token  refresh";
        return $this->Return_Register_Login_Refresh_Success(Auth::user(),$NewToken,$msg);
    }

}

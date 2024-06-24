<?php

namespace App\Traits;

Trait  ResponseTrait{

    public function ReturnError($msg, $code) {
    return response()->json([
    'status' => false,
    'code' => $code,
    'msg'  => $msg],
    $code
    );
    }
     
    public function ReturnSuccess($msg, $code="200") {
        return response()->json([
        'status' => true,
        'code' => $code,
        'msg'  => $msg,],
        200
        );
    }
    
        public function ReturnData($key, $value, $msg="", $code="200") {
            return response()->json([
            'status' => true,
            'code' => $code,
            'msg'  => $msg,
            $key => $value,],
            $code
            );
        }
      public function Return_Register_Login_Refresh_Success($user, $token, $msg){
        return response()->json([  
            'status' => true,
            'user' => $user,
            'code' => 200,
            'msg'=> $msg,
            'authorisation' => [
                'token' => $token,
                'type' => 'bearer',
            ]], 200);
      }
    
    }    

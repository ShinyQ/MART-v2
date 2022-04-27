<?php

namespace App\Http\Controllers;

use Api;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    private $code, $response;

    public function __construct(){
        $this->code = 200;
        $this->response = [];
    }

    public function login(Request $request)
    {
        try {
            if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
                $user = Auth::user();
                $success['user'] = $user;
                $success['token'] = $user->createToken('mart')->accessToken;
                $this->response = $success;
            } else {
                $this->code = 401;
            }
        } catch (Exception $e) {
            $this->code = 500;
            $this->response = $e->getMessage();
        }

        return Api::apiRespond($this->code, $this->response);
    }

    public function profile(){
        try {
            $this->response = auth()->guard('api')->user();
        } catch (Exception $e) {
            $this->code = 500;
            $this->response = $e->getMessage();
        }

        return Api::apiRespond($this->code, $this->response);
    }

    public function logout(){
        try {
            $user = auth()->guard('api')->user();

            if($user){
                foreach ($user->tokens as $token) {
                    $token->revoke();
                }
            }

            Auth::logout();
        } catch (Exception $e) {
            $this->code = 500;
            $this->response = $e->getMessage();
        }

        return Api::apiRespond($this->code, $this->response);
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Response;
use Illuminate\Http\Request;
use App\CustomTraits\PassportTokenTrait;
use Auth;

class LoginController extends Controller
{
    use PassportTokenTrait;

    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }


    public function login(Request $request)
    {
        if (Auth::attempt(['email' => $request->email, 'password' => $request->password]))
        {
            $token = $this->getFirstTokenAndRefreshToken(request('email'), request('password'));
            return response()->json($token, 200);
        }
        else {
            return response()->json(['message'=>'Unauthorised'], 401);
        }
    }

    public function refresh(Request $request)
    {
        $refresh_token = $request->header('refreshtoken');

        try {
            $token = $this->getTokenAndRefreshToken($refresh_token);
            return response()->json($token, 200);
        } catch (\GuzzleHttp\Exception\BadResponseException $e) {
            return response()->json("unauthorized", 401);
        }
    }

}

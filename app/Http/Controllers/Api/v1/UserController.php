<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */

    public function login( Request $request){
        if(Auth::attempt(['email' => $request->get('email'), 'password' => $request->get('password')])){
            $user = Auth::user();
            $token =  $user->createToken('Stats_Token')-> accessToken;
            return response()->json(['token' => $token],200);
        }
        else{
            return response()->json(['error'=>'Unauthorised'], 401);
        }
    }
}
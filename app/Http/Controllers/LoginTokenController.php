<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class LoginTokenController extends Controller
{
    public function login(Request $request, $email, $pass)
    {  
        if (Auth::attempt(['email' => $email, 'password' => $pass], true)) {
            $user = Auth::user();
            return response()->json(['message' => 'Authorized'], 200);
        }

        return response()->json(['message' => 'Unauthorized'], 401);
    }
}

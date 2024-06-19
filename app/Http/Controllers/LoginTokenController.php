<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\ApiToken;
use App\Models\User;

class LoginTokenController extends Controller
{
    public function login(Request $request, $token)
    {
        $user = ApiToken::where('token', '=', $token)->first();
        if ($user) {
            Auth::login($user->user()->first(), true);
            return response()->json(['message' => 'Authorized'], 200);
        } else {
            return response()->json(['message' => 'Unauthorized'], 401);
        }
    }
}

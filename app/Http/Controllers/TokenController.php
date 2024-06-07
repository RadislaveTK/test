<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ApiToken;
use App\Models\User;
use App\Models\Workspace;

class TokenController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('token');
    }

    public function viewToken(Workspace $ws, $api) {
        return response()->json([
            'message' => 'API endpoint accessed',
            'token' => ApiToken::where('token', $api)->first(),
        ]);
    }

}

<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Models\ApiToken;
use App\Models\User;
use App\Models\Workspace;
use Illuminate\Support\Facades\Gate;

class TokenController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('token');
    }
    

    public function viewToken(Request $r, Workspace $ws, $api)
    {
        $token = ApiToken::where('token', $api)->first();
        Gate::authorize('view', $token);

        $startTime = Carbon::now();

        $res = response()->json([
            'message' => 'API работает отлично!',
            'token' => $token,
        ]);

        $endTime = Carbon::now();

        $totalTime = floatval($startTime->diffInSeconds($endTime));
        // $totalTime = (int) $totalTime;
        
        $token->time += $totalTime;
        $token->save();

        return $res;
    }

}

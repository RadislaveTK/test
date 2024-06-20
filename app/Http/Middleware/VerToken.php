<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use App\Models\ApiToken;
use App\Models\Workspace;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class VerToken
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $token = ApiToken::where('token', $request->ap)->first();

        if (!$token) {
            return response()->json(['error' => 'Tокен не найден!'], 404);
        } else if(!Auth::user()) {
            return response()->json(['error' => 'Не авторизован!'], 401);
        }

        $ws = Workspace::find($token->workspace_id);
        if($token->revoked_at != null || $token->blocking == true) {
            return response()->json(['message' => 'Превышенна квота'], 403);
        } else if($ws->total >= $ws->limit) {
            $ws->total = $ws->limit;
            $token->blocking = true;
            $token->save();
            return $next($request);
        } else {
            return $next($request);
        }
    }
}

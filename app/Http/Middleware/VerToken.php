<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use App\Models\ApiToken;
use Carbon\Carbon;

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
        
        if($token->revoked_at != null) {
            return redirect()->route('home');
        } else if($token->time >= $token->limit) {
            $token->revoked_at = Carbon::now();
            $token->save();
            return $next($request);
        } else {
            $token->time += 0.1;
            $token->save();
            return $next($request);
        }
    }
}

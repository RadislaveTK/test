<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ApiToken;
use Illuminate\Support\Facades\Gate;
use Carbon\Carbon;

class MindReaderController extends Controller
{
    public function recognizeObjects(Request $request, $api)
    {
        if (!$request->input('image')) {
            return response('Not found attribute', 400);
        }

        $token = ApiToken::where('token', $api)->first();
        $ws = $token->workspace()->first();
        Gate::authorize('view', $token);

        $startTime = Carbon::now();

        $res = response()->json([
            "objects" => [
                "label" => "Test",
                "probability" => 0.9,
                "bounding_box" => [
                    "top" => 10,
                    "left" => 20,
                    "bottom" => 30,
                    "right" => 40
                ]
            ]
        ]);Djn

        $endTime = Carbon::now();
        $totalTime = floatval($startTime->diffInSeconds($endTime));
        $token->time += $totalTime;
        $token->save();
        $ws->total += ($totalTime * $token->price);
        $ws->save();

        return $res;
    }
}

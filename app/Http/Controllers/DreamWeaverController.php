<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ApiToken;
use Illuminate\Support\Facades\Gate;
use Carbon\Carbon;

class DreamWeaverController extends Controller
{
    public function generateImage(Request $request, $api)
    {
        if (!$request->input('text_prompt')) {
            return response('Not found attribute', 400);
        }

        $token = ApiToken::where('token', $api)->first();
        $ws = $token->workspace()->first();
        Gate::authorize('view', $token);

        $startTime = Carbon::now();

        $res = response()->json([
            "job_id" => rand(1, 100),
            "started_at" => Carbon::now()
        ])->setStatusCode(201);

        $endTime = Carbon::now();
        $totalTime = floatval($startTime->diffInSeconds($endTime));
        $token->time += $totalTime;
        $token->save();
        $ws->total += ($totalTime * $token->price);
        $ws->save();

        return $res;
    }

    public function getJobStatus(Request $request, $api, $job_id)
    {
        $token = ApiToken::where('token', $api)->first();
        $ws = $token->workspace()->first();
        Gate::authorize('view', $token);

        $startTime = Carbon::now();

        $res = response()->json([
            "status" => "pending",
            "progress" => rand(0, 100),
            "image_url" => "/store/images/" . $job_id . "_image.png"
        ]);
        $endTime = Carbon::now();
        $totalTime = floatval($startTime->diffInSeconds($endTime));
        $token->time += $totalTime;
        $token->save();
        $ws->total += ($totalTime * $token->price);
        $ws->save();

        return $res;
    }

    public function getResult(Request $request, $api, $job_id)
    {
        $token = ApiToken::where('token', $api)->first();
        $ws = $token->workspace()->first();
        Gate::authorize('view', $token);

        $startTime = Carbon::now();

        $res = response()->json([
            "resource_id" => rand(0, 100),
            "image_url" => "/store/images/" . $job_id . "_image.png",
            "finshed_at" => Carbon::now()
        ]);
        $endTime = Carbon::now();
        $totalTime = floatval($startTime->diffInSeconds($endTime));
        $token->time += $totalTime;
        $token->save();
        $ws->total += ($totalTime * $token->price);
        $ws->save();

        return $res;
    }

    public function upscaleImage(Request $request, $api)
    {
        if (!$request->input('resource_id')) {
            return response('Not found attribute', 400);
        }

        $token = ApiToken::where('token', $api)->first();
        $ws = $token->workspace()->first();
        Gate::authorize('view', $token);

        $startTime = Carbon::now();

        $res = response()->json([
            "job_id" => rand(1, 100),
            "started_at" => Carbon::now()
        ]);

        $endTime = Carbon::now();
        $totalTime = floatval($startTime->diffInSeconds($endTime));
        $token->time += $totalTime;
        $token->save();
        $ws->total += ($totalTime * $token->price);
        $ws->save();

        return $res;
    }

    public function zoomInImage(Request $request, $api)
    {
        if (!$request->input('')) {
            return response('Not found attribute', 400);
        }

        $token = ApiToken::where('token', $api)->first();
        $ws = $token->workspace()->first();
        Gate::authorize('view', $token);

        $startTime = Carbon::now();

        $res = response()->json([
            "job_id" => rand(1, 100),
            "started_at" => Carbon::now()
        ]);

        $endTime = Carbon::now();
        $totalTime = floatval($startTime->diffInSeconds($endTime));
        $token->time += $totalTime;
        $token->save();
        $ws->total += ($totalTime * $token->price);
        $ws->save();

        return $res;
    }

    public function zoomOutImage(Request $request, $api)
    {
        if (!$request->input('resource_id')) {
            return response('Not found attribute', 400);
        }

        $token = ApiToken::where('token', $api)->first();
        $ws = $token->workspace()->first();
        Gate::authorize('view', $token);

        $startTime = Carbon::now();

        $res = response()->json([
            "job_id" => rand(1, 100),
            "started_at" => Carbon::now()
        ]);

        $endTime = Carbon::now();
        $totalTime = floatval($startTime->diffInSeconds($endTime));
        $token->time += $totalTime;
        $token->save();
        $ws->total += ($totalTime * $token->price);
        $ws->save();

        return $res;
    }
}

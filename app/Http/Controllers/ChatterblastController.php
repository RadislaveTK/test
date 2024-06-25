<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ApiToken;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Carbon;

class ChatterblastController extends Controller
{
    /**
     * Создать новую беседу в Chatterblast.
     *
     * @param  Request  $request
     * @return Response
     */
    public function createConversation(Request $request, $api)
    {
        if (!$request->input('conversationId')) {
            return response('Not found conversationId', 400);
        }
        // Ваша логика для создания беседы в Chatterblast
        $token = ApiToken::where('token', $api)->first();
        $ws = $token->workspace()->first();
        Gate::authorize('view', $token);

        $startTime = Carbon::now();

        $res = response()->json([
            'conversation_id' => $request->input('conversationId'),
            'created_at' => Carbon::now()
        ])->setStatusCode(201);

        $endTime = Carbon::now();

        $totalTime = floatval($startTime->diffInSeconds($endTime));
        // $totalTime = (int) $totalTime;

        $token->time += $totalTime;
        $token->save();
        $ws->total += ($totalTime * $token->price);
        $ws->save();

        return $res;
    }

    /**
     * Отправить запрос в существующую беседу в Chatterblast.
     *
     * @param  Request  $request
     * @param  string  $conversation_id
     * @return Response
     */
    public function sendPrompt(Request $request, $api, $conversation_id)
    {
        if (!$request->input('conversationId') || !$request->input('message')) {
            return response('Not found attribute', 400);
        }

        $token = ApiToken::where('token', $api)->first();
        $ws = $token->workspace()->first();
        Gate::authorize('view', $token);

        $startTime = Carbon::now();

        $res = response()->json([
            'message' => 'OK',
        ]);

        $endTime = Carbon::now();
        $totalTime = floatval($startTime->diffInSeconds($endTime));
        $token->time += $totalTime;
        $token->save();
        $ws->total += ($totalTime * $token->price);
        $ws->save();

        return $res;
    }

    /**
     * Получить ответ от существующей беседы в Chatterblast.
     *
     * @param  string  $conversation_id
     * @return Response
     */
    public function getResponse(Request $request, $api, $conversation_id)
    {
        $token = ApiToken::where('token', $api)->first();
        $ws = $token->workspace()->first();
        Gate::authorize('view', $token);

        $startTime = Carbon::now();

        $res = response()->json([
            'message' => "Test message",
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

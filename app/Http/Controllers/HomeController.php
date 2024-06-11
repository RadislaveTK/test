<?php

namespace App\Http\Controllers;

use App\Models\ApiToken;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Workspace;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        // return view('home');
        return redirect()->route('workspace');
    }

    public function notpage()
    {
        return redirect()->route('home');
    }

    public function showWorkspace()
    {
        return view('workspaces', ['ws' => Auth::user()->workspaces()->latest()->get()]);
    }

    public function createWorkspace()
    {
        return view('workspace.create');
    }

    public function storeWorkspace(Request $r)
    {
        $messages = [
            'title.required' => 'Введите название для рабочего пространства!',
            'title.max' => 'Название должно быть не больше 50 символов',
        ];
        $validated = $r->validate([
            'title' => 'required|max:50',
            'desc' => '',
        ], $messages);
        if (Workspace::where('title', '=', $validated['title'])->where('user_id', '=', Auth::user()->id)->get()->count() > 0) {
            return redirect($r->server('HTTP_REFERER'))->withErrors(['name' => 'Пространство с таким названием уже существует!']);
        } else {
            Auth::user()->workspaces()->create([
                'title' => $validated['title'],
                'desc' => $validated['desc'] ?? ' ',
            ]);
            return redirect()->route('workspace');
        }
    }

    public function detailWorkspace(Workspace $ws)
    {
        $this->authorize('view', $ws);
        return view('workspace.detail', ['ws' => $ws]);
    }

    public function deleteWorkspace(Workspace $ws)
    {
        $this->authorize('view', $ws);
        $ws->delete();
        return redirect()->route('workspace');
    }

    public function createApi(Workspace $ws)
    {
        $this->authorize('view', $ws);
        return view('apis.create', ['ws' => $ws]);
    }

    public function storeApi(Request $r, Workspace $ws)
    {
        $this->authorize('view', $ws);
        $messages = [
            'name.required' => 'Введите название для токена!',
            'name.max' => 'Название должно быть не больше 50 символов',
        ];
        $validated = $r->validate([
            'name' => 'required|max:50',
            'token' => '',
        ], $messages);
        if ($ws->apiTokens()->where('name', '=', $validated['name'])->where('user_id', '=', Auth::user()->id)->get()->count() > 0) {
            return redirect($r->server('HTTP_REFERER'))->withErrors(['name' => 'Токен с таким названием уже существует!']);
        } else {
            $ws->apiTokens()->create([
                'name' => $validated['name'],
                'token' => $validated['token'],
                'price' => config('app.TOKEN_PRICE'),
                'limit' => config('app.TOKEN_LIMIT'),
                'user_id' => Auth::user()->id,
            ]);
            return redirect()->route('detail', ['ws' => $ws->id]);
        }
    }

    public function removeApi(Workspace $ws, ApiToken $ap)
    {
        $this->authorize('view', $ws);
        $ap->revoked_at = Carbon::now();
        $ap->save();
        return redirect()->route('detail', ['ws' => $ws->id]);
    }

    public function showBills()
    {
        return view('bills');
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Workspace;
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
        return view('home');
    }

    public function showWorkspace()
    {
        return view('workspaces', ['ws' => Auth::user()->workspaces()->latest()->get()]);
    }

    public function createWorkspace()
    {
        return view('createW');
    }

    public function storeWorkspace(Request $r)
    {
        Auth::user()->workspaces()->create([
            'title' => $r->title,
            'desc' => $r->desc,
        ]);
        return redirect()->route('workspace');
    }

    public function detailWorkspace(Workspace $ws)
    {
        return view('detailW', ['ws' => $ws]);
    }

    public function deleteWorkspace(Workspace $ws)
    {
        $ws->delete();
        return redirect()->route('workspace');
    }
}

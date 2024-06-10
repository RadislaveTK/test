<?php

namespace App\Http\Controllers;

use App\Models\Workspace;
use Illuminate\Http\Request;
use App\Models\User;

class admincontroller extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function viewPanel()
    {
        return view("admin.panel");
    }

    public function editConfig(Request $r)
    {
        $messages = [
            'limit.required' => 'Поле лимит должно быть заполнено!',
            'limit.max' => 'Кол-во символов должно быть не больше 50',
            'limit.numeric' => 'Поле лимит должно содержать только цифры',
            'price.required' => 'Поле цена должно быть заполнено!',
            'price.max' => 'Кол-во символов должно быть не больше 50',
            'price.numeric' => 'Поле цена должно содержать только цифры',
        ];
        $validated = $r->validate([
            'limit' => 'required|max:50|numeric',
            'price' => 'required|max:50|numeric',
        ], $messages);
        config('app.TOKEN_PRICE', $validated['price']);
        config('app.TOKEN_LIMIT', $validated['limit']);
        return redirect('adminpanel');
    }

    public function editUser(User $user)
    {
        return view('admin.editUser', ['user' => $user]);
    }

    public function storeUser(Request $r)
    {
        $messages = [
            'name.required' => 'Поле имя должно быть заполнено!',
            'name.max' => 'Кол-во символов должно быть не больше 50',
            'email.required' => 'Поле email должно быть заполнено!',
            'email.max' => 'Кол-во символов должно быть не больше 50',
            'role.required' => 'Поле роль должно быть заполнено!',
            'role.max' => 'Кол-во символов должно быть не больше 50',
        ];
        $validated = $r->validate([
            'id' => '',
            'name' => 'required|max:50',
            'email' => 'required|max:50',
            'role' => 'required|max:50',
        ], $messages);
        $user = User::find($r->id);
        $user->id = $validated['id'];
        $user->name = $validated['name'];
        $user->email = $validated['email'];
        $user->role = $validated['role'];
        $user->save();
        return redirect($r->server('HTTP_REFERER'));
    }

    public function editWs(Workspace $ws)
    {
        return view('admin.editWs', ['ws' => $ws]);
    }

    public function storeWs(Request $r)
    {
        $messages = [
            'id.required' => 'Поле ID должно быть заполнено!',
            'id.max' => 'Кол-во символов должно быть не больше 50',
            'id.numeric' => 'Поле ID должно содержать только цифры',
            'title.required' => 'Поле название должно быть заполнено!',
            'title.max' => 'Кол-во символов должно быть не больше 50',
        ];
        $validated = $r->validate([
            'id' => '',
            'title' => 'required|max:50',
            'desc' => '',
        ], $messages);
        $ws = Workspace::find($validated['id']);
        $ws->id = $validated['id'];
        $ws->title = $validated['title'];
        $ws->desc = $validated['desc'] ?? ' ';
        $ws->save();
        return redirect($r->server('HTTP_REFERER'));
    }
}

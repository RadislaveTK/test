<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class admincontroller extends Controller
{

    public function __construct() {
        $this->middleware('auth');
    }

    public function viewPanel() {
        return view("admin.panel");
    }
}

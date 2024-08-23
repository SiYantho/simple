<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class User2Controller extends Controller
{
    public function index()
    {
        return view('user2.home');
    }
}

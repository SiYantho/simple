<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Contracts\Validation\Rule;

class AdminController extends Controller
{
    public function index()
    {
        return view('admin.home');
    }
}

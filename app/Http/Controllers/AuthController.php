<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function login()
    {
        return view("auth.login");
    }
    public function register()
    {
        return view('auth.create');
    }
    public function profile()
    {
        return view("auth.profile");
    }
}

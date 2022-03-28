<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Session;

class HomeController extends Controller
{
    public function index()
    {
        if(empty(Session::get('access_token')) || empty(Session::get('user')))
            return view('auth.login');
        else
            return view('home',['user'=>Session::get('user')]);

    }
}

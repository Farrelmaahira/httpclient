<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;


class AuthController extends Controller
{
    public function index()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $sign = Http::post('http://127.0.0.1:8003/api/v1/auth/login', [
            'email' => $request->email,
            'password' => $request->password
        ])->collect();
       if(!$sign->has('token'))
       {
            return redirect('/');
       }
        return redirect()->route('home');

    }

    public function register()
    {
        return view('auth.register');
    }

    public function signup(Request $request)
    {
        $sign = Http::post('http://127.0.0.1:8003/api/v1/auth/register', [
            'email' => $request->email,
            'name' => $request->name,
            'password' => $request->password
        ])->collect();

      
    }
}

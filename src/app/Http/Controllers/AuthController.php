<?php


namespace App\Http\Controllers;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function postLogin(Request $request){
        $credentials = $request->only('id', 'password');
        if (!Auth::attempt($credentials)) {
            return view("login");
        }

        return redirect()->intended('/');
    }
}

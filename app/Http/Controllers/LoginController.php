<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Validator;
use Auth;
use Response;

class LoginController extends Controller
{
    public function login()
    {
        if (Auth::check()) {
            return redirect('/');
        }
        return view('/login');
    }

    public function auth(Request $request)
    {

        $this->validate($request,[
            "email" => "required|exists:users",
            "password" => "required"
        ]);


        if (Auth::attempt(['email' => $request->email, 'password' => $request->password],isset($request->remember)) ) {

            return redirect('/admin');
        }else{

            return redirect()->back()->with('status', "No se ha podido iniciar sesion. Revise sus datos.");
        }
    }


    public function logout()
    {
        return "logout";

        Auth::logout();
        return redirect('/');
    }
}

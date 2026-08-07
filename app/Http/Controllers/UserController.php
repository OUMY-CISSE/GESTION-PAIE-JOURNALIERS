<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\support\Facades\Validator;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

class UserController extends Controller
{
    public function register()
    {
        return view('securite/register');
    }

    public function registerSave(Request $request)
    {
        Validator::make($request->all(), [
            'name'=>'required',
            'email'=>'required|email',
            'password' =>'required|min:8|max:10',

        ])->validate();

        User::create([
            'name'=> $request->name,
            'email'=> $request->email,
            'password' => Hash::make($request->password),
            'level'=> 'Admin'
        ]);

        return redirect()->route('login');
    }

    public function login() 
    {
        return view('securite/login');
    }

    public function loginAction(Request $request)
    {
        Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required'
        ])->validate();

        if (!Auth::attempt($request->only('email', 'password'), $request->boolean('remember'))) 
        {
            throw ValidationException::withMessages(
                [
                    'email' => trans("auth.failed")
                ]
                ); 
            
        }

        $request->session()->regenerate();

        return redirect()->route('journaliers');
    }


    public function logout(Request $request) 
    {
        Auth::guard('web')->logout();
        $request->session()->invalidate();

        return redirect('/');
    }

    

}

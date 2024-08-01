<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class UserController extends Controller
{
    public function create(){
        return view('users.register');
    }

    public function store(Request $request){
        $formFileds = $request->validate([
                'name' => ['required','min:3'],
                'email'=> ['required', 'email', Rule::unique('users','email')],
                'password'=>['required','confirmed','min:6']
            
        ]);
        //hash password
        $formFileds['password'] = bcrypt( $formFileds['password']);
        $user = User::create($formFileds);
        //login
        auth()->login($user);
        return redirect('/');
    }
    public function logout(Request $request){
        auth()->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/');
    }
    public function login(){
        return view('users.login');
    }
    public function authenticate(Request $request){
        $formFileds = $request->validate([
                'email'=> ['email','required'],
                'password'=>'required'
        ]);

        if(auth()->attempt($formFileds)){
            $request->session()->regenerate();
            return redirect('/');
        }

        return back()->withErrors(['email' => 'Invalid credentials'])->onlyInput('email');
    
    }


}

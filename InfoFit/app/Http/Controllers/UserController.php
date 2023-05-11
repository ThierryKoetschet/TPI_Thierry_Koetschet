<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Foundation\Auth\User;

class UserController extends Controller
{
    public function register() {
        return view('register');
    }

    public function store(Request $request) {
        $formFields = $request->validate([
            'gender' => ['required'],
            'lastname' => ['required', 'min:2'],
            'firstname' => ['required', 'min:2'],
            'email' => ['required', 'email', Rule::unique('users', 'email')],
            'password' => ['required', 'confirmed', 'min:6'],
            'birthdate' => ['required'],
            'height' => ['required'],
            'weight' => ['required']
        ]);

        //Hash Password
        $formFields['password'] = bcrypt($formFields['password']);

        $user = new User();
        $user->gender = $formFields->gender;
        $user->lastname = $formFields->lastname;
        $user->firstname = $formFields->firstname;
        $user->email = $formFields->email;
        $user->password = $formFields->password;
        $user->birthdate = $formFields->birthdate;
        $user->height = $formFields->height;
        $user->weight = $formFields->weight;

        $res = $user->save();

        if($res) {
            return redirect('/')->with('success', 'Enregistrement réussi!');
        }
        else {
            return back()->with('fail', 'Enregistrement impossible!');
        }

        
    }

    public function logout(Request $request) {
        auth()->logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/')->with('message', 'Vous vous êtes déconnecté');
    }

    public function login() {
        return view('login');
    }

    public function authenticate(Request $request) {
        $formFields = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required']
        ]);

        if(auth()->attempt($formFields)) {
            $request->session()->regenerate();

            return redirect('/')->with('message', 'Vous êtes connecté');
        }

        return back()->withErrors(['email' => 'Les identifiants sont invalides']);
    }
}

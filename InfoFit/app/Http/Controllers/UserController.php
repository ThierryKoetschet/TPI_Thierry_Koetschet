<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Weight;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
    public function register() {
        return view('register');
    }

    public function store(Request $request) {
        $formFields = $request->validate([
            'gender' => 'required',
            'lastname' => 'required|min:2',
            'firstname' => 'required|min:2',
            'email' => ['required', 'email', Rule::unique('users', 'email')],
            'password' => 'required|confirmed|min:6',
            'birthdate' => 'required',
            'height' => 'required|integer|gt:0',
            'weight' => 'required|integer|gt:0'
        ]);


        //Hash Password
        $formFields['password'] = bcrypt($formFields['password']);

        $user = new User();
        $weight = new Weight();

        $user->gender = $formFields['gender'];
        $user->lastname = $formFields['lastname'];
        $user->firstname = $formFields['firstname'];
        $user->email = $formFields['email'];
        $user->password = $formFields['password'];
        $user->birthdate = $formFields['birthdate'];
        $user->height = $formFields['height'];

        $user->save();
        Auth::login($user);

        $weight->value = $formFields['weight'];
        $weight->date = date("Y-m-d");
        $weight->users_id = Auth::id();

        $weight->save();

        return redirect('/profile')->with('success', 'Enregistrement réussi!');
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
            'email' => 'required',
            'password' => 'required'
        ]);

        $user = User::where('email', '=', $request->email)->first();
        if($user) {
            if (Auth::attempt($formFields)) {
                $request->session()->regenerate();

                return redirect('/profile')->with('message', 'Vous êtes maintenant connecté !');
            }
        }
        return back()->withErrors(['email' => 'Les identifiants sont invalides'])->onlyInput('email');
    }

    public function updateUser(Request $request) {
        $request->validate([
            'gender' => 'required',
            'lastname' => 'required|min:2',
            'firstname' => 'required|min:2',
            'email' => ['required', 'email', Rule::unique('users', 'email')],
            'birthdate' => 'required',
            'height' => 'required|integer|gt:0',
            'weight' => 'required|integer|gt:0'
        ]);

        $weight = new Weight();

        $weight->value = $request['weight'];
        $weight->date = date("Y-m-d");
        $weight->users_id = Auth::id();

        $weight->save();

        return redirect('/imc')->with('success', 'Enregistrement réussi!');
    }

    public function getLastWeight() {
        $users_id = Auth::id();
        $lastWeight = Weight::where('users_id', '=', $users_id)->orderby('updated_at', 'desc')->first();
        return view('profile',['lastWeight'=>$lastWeight]);
    }

    public function deleteUser(Request $request) {
        $users_id = Auth::id();
        User::where('id', '=', $users_id)->delete();

        auth()->logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/')->with('message', 'Vous avez supprimé votre compte');
    }
}

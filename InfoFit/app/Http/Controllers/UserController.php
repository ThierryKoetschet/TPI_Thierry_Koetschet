<?php
/**
 * @file    UserController.php
 * @brief   This file contains all the functions that impact the users of the application
 * @author  Created by Thierry.KOETSCHET
 * @version 11.05.2023
 */

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Weight;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
    //to show the register page
    public function register()
    {
        return view('register');
    }

    //stores the new users informations in the database
    public function store(Request $request)
    {
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

    public function logout(Request $request)
    {
        auth()->logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/')->with('message', 'Vous vous êtes déconnecté');
    }

    public function login()
    {
        return view('login');
    }

    //authenticates the user with his credentials
    public function authenticate(Request $request)
    {
        $formFields = $request->validate([
            'email' => 'required',
            'password' => 'required'
        ]);

        $user = User::where('email', '=', $request->email)->first();
        if ($user) {
            if (Auth::attempt($formFields)) {
                $request->session()->regenerate();

                return redirect('/profile')->with('message', 'Vous êtes maintenant connecté !');
            }
        }
        return back()->withErrors(['email' => 'Les identifiants sont invalides'])->onlyInput('email');
    }

    //updates the different user informations in the database like the weight, the email, the name, etc.
    public function updateUser(Request $request)
    {
        $oldEmail = Auth::user()->email;

        if (User::where('email', '=', $oldEmail)->get()->count() == 0) {
            $formFields = $request->validate([
                'gender' => 'required',
                'lastname' => 'required|min:2',
                'firstname' => 'required|min:2',
                'email' => ['required', 'email', Rule::unique('users', 'email')],
                'birthdate' => 'required',
                'height' => 'required|integer|gt:0',
                'weight' => 'required|integer|gt:0'
            ]);
        }
        else {
            $formFields = $request->validate([
                'gender' => 'required',
                'lastname' => 'required|min:2',
                'firstname' => 'required|min:2',
                'email' => ['required', 'email'],
                'birthdate' => 'required',
                'height' => 'required|integer|gt:0',
                'weight' => 'required|integer|gt:0'
            ]);
        }


        $user = User::where('email', '=', $oldEmail)->get();

        $user->gender = $formFields['gender'];
        $user->lastname = $formFields['lastname'];
        $user->firstname = $formFields['firstname'];
        $user->email = $formFields['email'];
        $user->birthdate = $formFields['birthdate'];
        $user->height = $formFields['height'];

        User::where('email', '=', $oldEmail)->update(
            [
                'gender' => $user->gender,
                'lastname' => $user->lastname,
                'firstname' => $user->firstname,
                'email' => $user->email,
                'birthdate' => $user->birthdate,
                'height' => $user->height
            ]
        );

        $oldWeight = Weight::where('users_id', '=', Auth::id())->orderby('id', 'desc')->first();

        //to avoid inserting duplicate data in the database
        if ($formFields['weight'] == $oldWeight['value'] && $oldWeight['date'] == date("Y-m-d")) {
            return back();
        }
        $weight = new Weight();

        $weight->value = $formFields['weight'];
        $weight->date = date("Y-m-d");
        $weight->users_id = Auth::id();

        $weight->save();

        return back()->with('message', 'Modification réussie !');
    }

    public function getLastWeight()
    {
        $users_id = Auth::id();
        $lastWeight = Weight::where('users_id', '=', $users_id)->orderby('updated_at', 'desc')->first();
        return view('profile', ['lastWeight' => $lastWeight]);
    }

    public function deleteUser(Request $request)
    {
        $users_id = Auth::id();
        User::where('id', '=', $users_id)->delete();

        auth()->logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/')->with('message', 'Vous avez supprimé votre compte');
    }

    public function newPassword() {
        return view('/changePassword');
    }

    //changes the users password in the database via the link "mot de passe oublié ?"
    public function changePassword(Request $request) {
        $formFields = $request->validate([
            'email' => 'required|email',
            'password' => 'required|confirmed|min:6'
        ]);

        //select the user with the email input
        $user = User::where('email', '=', $formFields['email'])->get();

        if ($user) {
            //Hash Password
            $formFields['password'] = bcrypt($formFields['password']);

            $user->password = $formFields['password'];

            //update the password in the DB
            User::where('email', '=', $formFields['email'])->update(
                [
                    'password' => $formFields['password'],
                ]
            );

            Auth::login(User::where('email', '=', $formFields['email'])->first());

            return redirect('/profile')->with('message', 'Vous êtes maintenant connecté !');
        }
        else {
            return back()->with('message', 'Email invalide !');
        }
    }
}

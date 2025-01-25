<?php

namespace App\Http\Controllers;


use App\Models\User;
use Illuminate\View\View;
use App\Http\Requests\LoginRequest;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    // Créons la fonction login
    public function login () : View{
        // Autofill des champs
        //  User::create([
        //      'name' => 'John',
        //      'email' => 'john@doe.com',
        //      'password' => Hash::make('0000')
        //  ]);
        return view ('auth.login');
    }

    //LogOut function 
    public function logout () {
        Auth::logout();
        return to_route('login')->with(['success', 'Vous êtes maintenant déconnecté']);
    }

    //doLogin function to check if user is connected
    public function doLogin(LoginRequest $request){
        //Recupération des informations
        $credentials = $request -> validated();
       
        // On vérifie si l'utilisateur est connecté
        if(Auth::attempt($credentials)){
            // Si oui on régénère la session  
            $request->session()->regenerate();
            return redirect()->intended(route('admin.property.index'));
        }
        // Si les informations sont incorrects, on rédirige vers la page précédente
        
        return back()->withErrors([
        'email' => 'email or password invalid'
        ])->onlyInput('email', 'password');
    } 
}
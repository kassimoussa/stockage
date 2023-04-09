<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UsersController extends Controller
{
    
    public function accueil(Request $request)
    {
        if ($request->session()->has('level')) {
            return redirect('index');
        } else {
            return view('auth.connexion');
        }
    }

    public function check(Request $request)
    {
        //validate the input
        $request->validate([
            "email" => 'required',
            "password" => 'required', 
        ]);

        $field = filter_var($request->input('email'), FILTER_VALIDATE_EMAIL) ? 'email' : 'username';

        $user = User::where($field, $request->email)->first();
        if ($user) {
            if ($request->password == $user->password) {
                $request->session()->put('id', $user->id);
                $request->session()->put('level', $user->level);
                $request->session()->put('name', $user->name);
                $request->session()->put('username', $user->username);
                $request->session()->put('direction', $user->direction);
                $request->session()->put('service', $user->service);  
                return redirect('index');
            } else {
                return back()->with('fail', "Mot de passe incorrecte pour ce compte. Veuillez contactez l'adminirateur du site .");
            }
        } else {
            return back()->with('fail', "Il n'y a pas de compte qui correspond à cet email dans la base des données ! ");
        }
    }
    

    public function logout()
    {
        session()->flush();
        return redirect('/');
    }



    public function index()
    {
        $level = session('level');
        $dir = session('dir');
        $service = session('service');
        $sih = 'IT HelpDesk';

        if ($service == $sih) {
            return view('sih.'.$level.'.index');
        } else {
            return view($level . '.index');
        }
    }


    public function liste()
    {
        $level = session('level');
        return view($level . '.admin.listusers');   
    }


}

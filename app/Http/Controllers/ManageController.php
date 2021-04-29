<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

use App\User;

class ManageController extends Controller
{
    //
    public function index() {

        if (!Session::has('user')){
            return redirect('/login');
        }

        return view('manage.index');
    }

    public function register() {

        $formations = DB::table('formations')->where('id', '>', 0)->get();
        return view('manage.register.register', ['formations' => $formations]);
    }

    public function postRegister(Request $request) {
        $this->validate($request,
        [
            'username' => 'unique:users,login',
            'password' => 'min:8',
            'type' => 'required',
        ],
        [
            'username.unique' => 'User name already exists.',
            'type.required' => 'Must choose the user type.',
            'password.min' => 'Password must be longer than 8 characters',
        ]
        );

        $user = new User();

        $user->nom = $request->firstname;
        $user->prenom = $request->lastname;
        $user->login = $request->username;
        $user->mdp = Hash::make($request->password);

        if ($request->formation_id) {
            $user->formation_id = $request->formation_id;
        }
        $user->type = $request->type;

        $user->save();

        return redirect()->back();
    }
}

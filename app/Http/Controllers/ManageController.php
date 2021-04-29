<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

use App\User;

class ManageController extends Controller
{
    //
    public function index() {
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
        ],
        [
            'username.unique' => 'User name already exists.',
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

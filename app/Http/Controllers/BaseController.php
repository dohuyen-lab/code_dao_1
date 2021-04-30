<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class BaseController extends Controller
{
    //

    public function login() {
        if (Session::has('user')) {
            Session::forget('user');
        }
        return view('login.login');
    }

    public function postLogin(Request $request) {
        $this->validate($request,
        [
            'mdp' => 'min:8|required'
        ],
        [
            'mdp.min' => 'Password must be longer than 8 characters'
        ]
        );

        $user = DB::table('users')
                    ->where([
                        ['login', '=', $request->login],
                        ['type', '<>', null]
                        ])
                    ->get();

        if (empty($user[0])) {
            return redirect()->back()->with(['message'=>'Vous devez attendre la confirmation de l\'inscription.']);
        }

        if ( Hash::check($request->mdp, $user[0]->mdp) ) {
            Session::push('user', $user);
            switch ($user[0]->type) {
                case 'etudiant':
                    # code...
                    return redirect('/student');
                case 'enseignant':
                    return redirect('/teacher');
                default:
                    # code...
                    return redirect()->route('manager.index');
            }
        } else {
            // Kiểm tra không đúng sẽ hiển thị thông báo lỗi
			Session::flash('error', 'Username or password is incorrect!');
			return redirect('login');
        }
    }

    public function logout() {
        if (Session::has('user')) {
            Session::forget('user');
            return redirect('/login');
        } else {
            return redirect('/login');
        }
    }

    public function signup(Request $request){
        $this->validate($request,
        [
            'mdp' => 'min:8|required',
            'login' => 'unique:users,login'
        ],
        [
            'mdp.min' => 'Password must be longer than 8 characters',
            'login.unique' => 'User name already exists.',
        ]
        );
        $nom = $request['nom'];
        $prenom = $request['prenom'];
        $login = $request['login'];
        $mdp = $request['mdp'];
        $formation_id = $request['formation'];

        $mdp = Hash::make($mdp);

        DB::table('users')
            ->insert([
                'nom' => $nom,
                'prenom' => $prenom,
                'login' => $login,
                'mdp' => $mdp,
                'formation_id' => $formation_id
            ]);
        return redirect()->route('login');
    }

    public function getSignup(){
        $formation = DB::table('formations')
                        ->where('deleted_at',0)
                        ->get();
        return view('login.signup',[
            'formations' => $formation
        ]);
    }

}

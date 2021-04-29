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

        $user = DB::table('users')->where('login', '=', $request->login)->get();

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

}

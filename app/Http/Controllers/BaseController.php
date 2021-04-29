<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;

class BaseController extends Controller
{
    //

    public function login() {
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

        $check = DB::table('users')->where(['login' => $request->login], ['mdp'=>$request->mdp])->get();

        if ( $check ) {
            Session::push('user', $check);
            return redirect('/manager');
        } else {
            // Kiểm tra không đúng sẽ hiển thị thông báo lỗi
			Session::flash('error', 'Username or password is incorrect!');
			return redirect('login');
        }
    }

    public function logout() {
        if (Auth::check()) {
            Auth::logout();
        } else {
            return redirect('/login');
        }
    }

}

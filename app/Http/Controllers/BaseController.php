<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class BaseController extends Controller
{
    //

    public function login() {
        return view('login.login');
    }

    public function postLogin(Request $request) {
        $this->validate($request,
        [
            'password' => 'min:8|required'
        ],
        [
            'password.min' => 'Password must be longer than 8 characters'
        ]
        );

        $username = $request->username;
        $password = $request->password;

        if ( Auth::attempt(['login' => $username, 'mdp' => $password])) {
            return redirect('/');
        } else {
            // Kiểm tra không đúng sẽ hiển thị thông báo lỗi
			Session::flash('error', 'Email or password is incorrect!');
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

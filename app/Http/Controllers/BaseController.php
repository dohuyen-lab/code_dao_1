<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class BaseController extends Controller
{
    //

    public function login() {
        return view('login.login');
    }

    public function postLogin(Request $request) {
        // $this->validate();
    }
}

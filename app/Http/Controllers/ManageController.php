<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ManageController extends Controller
{
    //
    public function index() {
        return view('manage.index');
    }

    public function register() {
        return view('manage.register');
    }

    public function postRegister(Request $request) {
        $this->validate($request,
        [

        ],
        [

        ]
        );
    }
}

<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;

class InformationController extends Controller
{
    public function getInformation(){
        return view('student.account.information');
    }
    public function editInformation(Request $request){
        $id = $request->id;
        $user = User::where('id', $id);
        return response()->json(['error' => false, 'data' => $user], 200);
    }
}

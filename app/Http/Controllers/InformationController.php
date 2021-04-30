<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class InformationController extends Controller
{
    public function getInformation(){
        $user = Session::get('user');
        $user_id = $user[0][0]->id;
        $formation = DB::table('users')
            ->where('users.id',$user_id)
            ->join('formations', 'users.formation_id','=','formations.id')
            ->select('users.*','formations.intitule')
            ->first();
        $data =[];
        $data['formation'] = $formation;
        return view('student.account.information', $data);
    }
    public function editInformation(){
        $user = Session::get('user');
        $user_id = $user[0][0]->id;
        $user = User::find($user_id);
        return response()->json(['error' => false, 'data' => $user], 200);
    }
    public function postEditInformation(Request $request)
    {

        $request->validate([
            'nom' => 'required',
            'prenom' => 'required',
        ],[
            'nom.required' => 'Please enter first name',
            'prenom.required' => 'Please enter last name',
        ]);
        //upload
        $id = $request->idUser;
        $user = User::find($id);
        $user->nom = $request->nom;
        $user->prenom = $request->prenom;
        $user->update();
        return($request);
    }
}

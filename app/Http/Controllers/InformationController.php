<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
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

    public function postChangePass(Request $request)
    {
        $id = $request->idUser;
        $user = DB::table('users')->where('id', '=', $id)->first();

        if($request->password){
            $validatedData = $request->validate([
                'newpassword' => 'min:8',
                'password_confirmation'=>'required|same:newpassword',
            ],[
                'newpassword.required'=>'Mật khẩu không trùng khớp',
                'password.min'=>'Mật khẩu phải lớn hơn 8 kí tự',
            ]);
        }

        if ($request->newpassword != $request->password_confirmation) {
            return redirect()->back()->with(['message'=>'Le mot de passe ne correspond pas']);
        }
        
        if (Hash::check($request->password, $user->mdp)) {
            DB::table('users')
            ->where('id', '=', $id)
            ->update(['mdp' => Hash::make($request->newpassword)]);
        } else
        {
            $error = array('password' => 'Please enter correct current password');
            return response()->json(array('error' => $error), 400);
        }
        return redirect()->back();
    }
}

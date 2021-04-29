<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

use App\User;

class ManageController extends Controller
{
    //
    public function getListStudent() {
        $data =[];
        $student = DB::table('users')
            ->where('users.type', 'etudiant')
            ->join('formations','users.formation_id','=','formations.id')
            ->select('users.*','formations.intitule')
            ->get();
        $data['student'] = $student;
        return view('manage.account.listStudent', $data);
    }
    public function getListTeacher() {
        $data =[];
        $teacher = DB::table('users')
            ->where('users.type', 'enseignant')
            ->join('formations','users.formation_id','=','formations.id')
            ->select('users.*','formations.intitule')
            ->get();
        $data['teacher'] = $teacher;
        return view('manage.account.listTeacher', $data);
    }
    public function postdeleteAccount($id){
        $user_id = User::find($id);
        $user_id = $user_id->id;
        $cour_user = DB::table('cours_users')
            ->where('user_id','=',$user_id)
            ->delete();
        $cour = DB::table('cours')
            ->where('user_id',$user_id)
            ->delete();
        $user = DB::table('users')
            ->where('id',$user_id)
            ->delete();

        return redirect()->back()->with('success', 'Xóa thành công !');
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

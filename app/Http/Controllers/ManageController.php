<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

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
    public function deleteAccount(Request $request){
        $user_id = User::find(id);
        $user = DB::table('users')
            ->where('id',$user_id)
            ->delete();
        $cour = DB::table('cours_user')
            ->where('user_id',$user_id)
            ->delete();
        return redirect('/manage/')
    }
}

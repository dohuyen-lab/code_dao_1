<?php

namespace App\Http\Controllers;
use  Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class StudentController extends Controller
{
    public function getStudentCalendar(){
        $user_id = Auth::id();
        $data = [];
        $cours = DB::table('cours_users')
            ->where('cours_users',$user_id)
            ->join('plannings','cours_users.cours_id','=','plannings.cours_id')
            ->get();
        $data['cours'] = $cours;
        return view('student.calendar.calendar', $data);
    }
    public function getListCours(){
        return view('student.cours.listcours');
    }
}

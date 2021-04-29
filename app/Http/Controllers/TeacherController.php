<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TeacherController extends Controller
{
    //
    public function index() {
        return view('teacher.index');
    }

    public function getListCours() {
        $list = DB::table('cours')
                ->join('plannings','cours.id','=','plannings.cours_id')
                ->join('formations','cours.formation_id','=','formations.id')
                ->get();

        return view('teacher.cours.listcours',[
            'cours'=> $list
        ]);
    }

    public function getTeacherCalendar(){
        return view('teacher.calendar.calendar');
    }


}

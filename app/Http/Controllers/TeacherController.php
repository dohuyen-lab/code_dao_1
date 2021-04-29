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

    public function getListFormations() {
        $list = DB::table('cours')
                ->join('formations','cours.formation_id','=','formations.id')
                ->get();

        return view('teacher.cours.listcours',[
            'formations'=> $list
        ]);
    }

}

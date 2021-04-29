<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TeacherController extends Controller
{
    public function getTeacherCalendar(){
        return view('teacher.calendar.calendar');
    }
    public function getListCours(){
        return view('teacher.cours.listcours');
    }
}

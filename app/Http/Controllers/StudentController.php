<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class StudentController extends Controller
{
    public function getStudentCalendar(){
        return view('student.calendar.calendar');
    }
}

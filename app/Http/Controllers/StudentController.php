<?php

namespace App\Http\Controllers;
use App\Cours;
use  Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class StudentController extends Controller
{
    public function getStudentCalendar(){
        $user = Session::get('user');
        $user_id = $user[0][0]->id;
        $data = [];
        $cours = DB::table('cours_users')
            ->where('cours_users.user_id',$user_id)
            ->join('plannings','cours_users.cours_id','=','plannings.cours_id')
            ->join('cours','cours.id','=','cours_users.cours_id')
            ->select('cours.intitule','plannings.*')
            ->get();
        $data['cours'] = $cours;
        return view('student.calendar.calendar', $data);
    }
    public function getListCoursStudent(){
        $user = Session::get('user');
        $user_id = $user[0][0]->id;
        $data = [];
        $cours = DB::table('cours_users')
            ->where('cours_users.user_id',$user_id)
            ->join('cours','cours.id','=','cours_users.cours_id')
            ->select('cours.intitule')
            ->get();
        $data['cours'] = $cours;
        return view('student.cours.listcours', $data);
    }
    public function postdeleteCours($id){
        $cours = Cours::find($id);
        $cours_id = $cours->id;
        $cour_user = DB::table('plannings')
            ->where('cours_id','=',$cours_id)
            ->delete();
        $cour = DB::table('cours_users')
            ->where('cours_id',$cours_id)
            ->delete();
        $user = DB::table('cours')
            ->where('id',$cours_id)
            ->delete();

        return redirect()->back()->with('success', 'Xóa thành công !');
    }
}

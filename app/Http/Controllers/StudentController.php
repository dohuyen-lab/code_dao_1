<?php

namespace App\Http\Controllers;
use App\Cours;
use App\Cours_User;
use  Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Validation\Rule;

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
        $cour = DB::table('cours_users')
            ->where('cours_id',$cours_id)
            ->delete();

        return redirect()->back()->with('success', 'Xóa thành công !');
    }

    public function postRegisterCours(Request $request){
        $validatedData = $request->validate([
            'intitule' => 'required',
        ],[
            'intitule.required' => 'Please enter a course name',
        ]);
        $cours = DB::table('cours')
                ->where('intitule',$request->intitule)
                ->first();
        $check = DB::table('cours_users')
            ->where('cours_id',$cours->id)
            ->get();
        if(!empty($check)) {
            $user = Session::get('user');
            $user_id = $user[0][0]->id;
            $cours_user = new Cours_User;
            $cours_user->cours_id = $cours->id;
            $cours_user->user_id = $user_id;
            $cours_user->save();
            return redirect()->back()->with('success', 'Successful course registration !');
        }
        else{
            return redirect()->back()->with('error', 'You have signed up for the course!');
        }
    }
}

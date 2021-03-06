<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class CourController extends Controller
{
    //

    public function getStore(){
        $user = Session::get('user');
        $user_id = $user[0][0]->id;

        $user = DB::table('users')
                    ->where('id', $user_id)
                    ->get();

        $formation = DB::table('formations')
                        ->where('deleted_at', '=', 0)
                        ->get();

        if($user[0]->type == "admin"){
            $user = DB::table('users')
                        ->where('type', 'enseignant')
                        ->get();
            return view('manage.course.createcours',[
                'teachers' => $user,
                'formations' => $formation,
                'status' => 0
            ]);
        } else {
            $course = DB::table('cours')->where('user_id', '=', $user_id)->get();
            return view('teacher.cours.createcours',[
                'teachers' => $user,
                'course' => $course,
                'status' => 0
            ]);
        }
    }

    public function store(Request $request) {
        $date = $request['date'];
        $heure_debut = $request['heure_debut'];
        $heure_fin = $request['heure_fin'];
        $cours_id = $request['cours_id'];

        $date_debut = $date.' '.$heure_debut;
        $date_fin = $date.' '.$heure_fin;

        $planning = DB::table('plannings')
        ->where('cours_id', '=', $cours_id)
        ->select('date_debut', 'date_fin')
        ->first();

        $today = date('y-m-d');

        if (strtotime($date) < strtotime($today)) {
            return redirect()->back()->with(['err_date' => 'Start date must come after End date']);
        }

        if (strtotime($date_debut) > strtotime($date_fin)) {
            return redirect()->back()->with(['err_time' => 'Start time must come after End time']);
        }

        if (strtotime($planning[0]['date_debut']) > strtotime($date) || strtotime($date) > strtotime($planning[0]['date_fin']))
        {
            return redirect()->back()->with(['warning_date' => 'Start time must come after End time']);
        }

        DB::table('plannings')->insert([
            'cours_id' => $cours_id,
            'date_debut' => $date_debut,
            'date_fin' => $date_fin
        ]);

        return redirect()->back()->with(['message'=>'Create success']);
    }

    public function storeByManager (Request $request) {
        $user_id = $request['user_id'];

        $intitule = $request['intitule'];
        $formation_id = $request['formation_id'];
        $date_debut = $request['date_debut'];
        $date_fin = $request['date_fin'];

        if (strtotime($date_debut) > strtotime($date_fin)) {
            return redirect()->back()->with(['err_date' => 'Start date must come after End date']);
        }

        DB::table('cours')->insert([
            'intitule' => $intitule,
            'user_id' => $user_id,
            'formation_id' => $formation_id
        ]);

        $cour = DB::table('cours')
                    ->where([
                        ['intitule',$intitule],
                        ['user_id', $user_id],
                        ['formation_id', $formation_id]
                    ])
                    ->get();
        $cour_id = $cour[0]->id;

        DB::table('plannings')->insert([
            'cours_id' => $cour_id,
            'date_debut' => $date_debut,
            'date_fin' => $date_fin
        ]);

        return redirect()->route('manager.cours', ['message'=>'Create success']);
    }

    public function getAll() {

        $user = Session::get('user');
        $user_id = $user[0][0]->id;


        $user = DB::table('users')
                    ->where('id','=',$user_id)
                    ->get();

        if($user[0]->type == 'admin'){
            $list = DB::table('cours')
                        ->select('cours.id','cours.intitule','plannings.date_debut','plannings.date_fin', 'formations.intitule as Fintitule')
                        ->join('plannings','cours.id','=','plannings.cours_id')
                        ->join('formations','cours.formation_id','=','formations.id')
                        ->orderBy('cours.intitule', 'asc')
                        ->paginate(15);
        } else{
            $list = DB::table('cours')
                        ->select('cours.id','cours.intitule','plannings.date_debut','plannings.date_fin', 'formations.intitule as Fintitule')
                        ->join('plannings','cours.id','=','plannings.cours_id')
                        ->join('formations','cours.formation_id','=','formations.id')
                        ->where('cours.user_id', '=', $user_id)
                        ->orderBy('cours.intitule', 'asc')
                        ->paginate(15);
        }

        if ($user[0]->type == 'admin') {
            return view('manage.course.cours',[
                'cours'=> $list
            ]);
        }
        return view('teacher.cours.cours',[
            'cours'=> $list
        ]);
    }

    public function getCourse($id) {
        $cour_id = $id;

        $cour_edit = DB::table('cours')
                        ->select('cours.id','cours.intitule','plannings.date_debut','plannings.date_fin')
                        ->join('plannings','cours.id','=','plannings.cours_id')
                        ->where('cours.id', '=', $cour_id)
                        ->get();

        $formations = DB::table('cours')
                        ->select('formations.intitule','formations.id')
                        ->join('formations','cours.formation_id','=','formations.id')
                        ->get();

        $user = Session::get('user');

        if ($user[0][0]->type == 'admin') { //admin
            $teacher = DB::table('users')
                        ->where('users.type', '=', 'enseignant')
                        ->get();

            return view('manage.course.createcours',[
                'teachers' => $teacher,
                'formations' => $formations,
                'status' => 1,
                'cour' => $cour_edit[0]
            ]);
        }
        // teacher
        $teacher = DB::table('cours')
                        ->select('users.nom','users.prenom','users.id')
                        ->join('users','users.id','=','cours.user_id')
                        ->where('cours.id', '=', $cour_id)
                        ->get();
        $course = DB::table('cours')
                    ->where('user_id', '=', $user[0][0]->id)
                    ->where('id', '<>', $cour_id)
                    ->get();

        return view('teacher.cours.createcours',[
            'teachers' => $teacher,
            'formations' => $formations,
            'status' => 1,
            'cour' => $cour_edit[0],
            'course' => $course
        ]);
    }

    public function editCours(Request $request){
        $user = Session::get('user');
        $user_id = $request['user_id'];
        $id = $request['id'];

        if ($user[0][0]->type == 'admin') {
            $intitule = $request['intitule'];
            $formation_id = $request['formation_id'];
            $date_debut = $request['date_debut'];
            $date_fin = $request['date_fin'];

            DB::table('cours')
            ->where('id', '=', $id)
            ->update([
                'intitule' => $intitule,
                'user_id' => $user_id,
                'formation_id' => $formation_id
            ]);
        } else {
            $date_debut = $request['date'].' '.$request['heure_debut'].':00';
            $date_fin = $request['date'].' '.$request['heure_fin'].':00';
        }

        DB::table('plannings')
            ->where('cours_id', '=',$id)
            ->update([
                'date_debut' => $date_debut,
                'date_fin' => $date_fin
            ]);

        if ($user[0][0]->type == 'admin') {
            return redirect()->route('manager.cours')->with(['message'=>'Create success']);
        }
        return redirect()->route('getListCours')->with(['message'=>'Create success']);
    }

    public function delete(Request $request){
        $id = $request['id'];
        DB::table('cours_users')->where('cours_id','=',$id)->delete();
        DB::table('plannings')->where('cours_id','=',$id)->delete();
        DB::table('cours')->where('id','=',$id)->delete();

        return $this->getAll();
    }

    public function getAllWeek(Request $request){
        $user = Session::get('user');
        $user_id = $user[0][0]->id;

        $date = $request['date'];

        if($date == 0) {
            $date = Carbon::now();
        }else {
            $isnext = $request['isnext'];
            if($isnext) $date = $date->addDays(7);
            else $date = $date->subDays(7);
        }

        $user = DB::table('users')
                    ->where('id','=',$user_id)
                    ->get();

        if($user[0]->type == 'admin'){
            $list = DB::table('cours')
                        ->select('cours.id','cours.intitule','plannings.date_debut','plannings.date_fin', 'formations.intitule as Fintitule')
                        ->join('plannings','cours.id','=','plannings.cours_id')
                        ->join('formations','cours.formation_id','=','formations.id')
                        ->where([
                            ['plannings.date_debut','<',$date],
                            ['plannings.date_fin','>',$date]
                        ])
                        ->paginate(15);
            // dd($user);
        } else{
            $list = DB::table('cours')
                        ->select('cours.id','cours.intitule','plannings.date_debut','plannings.date_fin', 'formations.intitule as Fintitule')
                        ->join('plannings','cours.id','=','plannings.cours_id')
                        ->join('formations','cours.formation_id','=','formations.id')
                        ->where([
                            ['cours.user_id', '=', $user_id],
                            ['plannings.date_debut','<',$date],
                            ['plannings.date_fin','>',$date]
                            ])
                        ->paginate(15);
        }

        if ($user[0]->type == 'admin') {
            return view('manage.course.cours',[
                'cours'=> $list,
                'now' => $date
            ]);
        }
        return view('teacher.cours.cours',[
            'cours'=> $list,
            'now' => $date
        ]);
    }

    public function getCourseByFormationID() {
        $user = Session::get('user');
        $user_id = $user[0][0]->id;

        $id = $_GET['id'];
        if ($user[0][0]->type == 'admin') {
            $course = DB::table('cours')
            ->where('formation_id', '=', $id)
            ->get();
        } else {
            $course = DB::table('cours')
            ->where('user_id', '=', $user_id)
            ->where('formation_id', '=', $id)
            ->get();
        }
        return response()->json($course);
    }
}

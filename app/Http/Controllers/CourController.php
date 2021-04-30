<?php

namespace App\Http\Controllers;

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
                        ->get();
        
        if($user->type == "admin"){
            $user = DB::table('users')
                        ->where('type', 'enseignant')
                        ->get();
        }

        return view('teacher.cours.createcours',[
            'teachers' => $user,
            'formations' => $formation,
            'status' => 0
        ]);
    }

    public function store(Request $request) {

        $intitule = $request['intitule'];
        $user_id = $request['user_id'];
        $formation_id = $request['formation_id'];
        $date_debut = $request['date_debut'];
        $date_fin = $request['date_fin'];

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

        return $this->getAll();
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
                        ->get();
        }else{
            $list = DB::table('cours')
                        ->select('cours.id','cours.intitule','plannings.date_debut','plannings.date_fin', 'formations.intitule as Fintitule')
                        ->join('plannings','cours.id','=','plannings.cours_id')
                        ->join('formations','cours.formation_id','=','formations.id')
                        ->where('cours.id', '=', $user_id)
                        ->get();
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

    public function getCourse(Request $request) {
        $cour_id = $request['id'];

        $cour_edit = DB::table('cours')
                        ->select('cours.id','cours.intitule','plannings.date_debut','plannings.date_fin')
                        ->join('plannings','cours.id','=','plannings.cours_id')
                        ->where('cours.id', '=', $cour_id)
                        ->get();
        $teacher = DB::table('cours')
                        ->select('users.nom','users.prenom','users.id')
                        ->join('users','users.id','=','cours.users_id')
                        ->where('cours.id', '=', $cour_id)
                        ->get();
        $formation = DB::table('cours')
                        ->select('formations.intitule')
                        ->join('formations','cours.formation_id','=','formations.id')
                        ->where('cours.id', '=', $cour_id)
                        ->get();

        return view('teacher.cours.createcours',[
            'teachers' => $teacher,
            'formations' => $formation,
            'status' => 1,
            'cour' => $cour_edit
        ]);
    }

    public function update(Request $request, $id) {
        $intitule = $request['intitule'];
        $user_id = $request['user_id'];
        $formation_id = $request['formation_id'];
        $date_debut = $request['date_debut'];
        $date_fin = $request['date_fin'];

        DB::table('cours')
        ->where('id','=', $id)
        ->update([
            'intitule' => $intitule,
            'user_id' => $user_id,
            'formation_id' => $formation_id
        ]);

        DB::table('plannings')
        ->where('cours_id', '=', $id)
        ->insert([
            'date_debut' => $date_debut,
            'date_fin' => $date_fin
        ]);

        return $this->getAll();
    }

    public function delete(Request $request){
        $id = $request['id'];

        DB::table('cours_users')->where('cours_id','=',$id)->delete();
        DB::table('plannings')->where('cours_id','=',$id)->delete();
        DB::table('cours')->where('id','=',$id)->delete();

        return $this->getAll();
    }
}

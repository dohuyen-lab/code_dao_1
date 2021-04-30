<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class CourController extends Controller
{
    //
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
            $teacher = DB::table('users')
                            ->where('type','=','enseignant')
                            ->get();

            $formation = DB::table('formations')->where('deleted_at', '=', 0)->get();

            $list = DB::table('cours')
                        ->select('cours.id','cours.intitule','plannings.date_debut','plannings.date_fin', 'formations.intitule as Fintitule')
                        ->join('plannings','cours.id','=','plannings.cours_id')
                        ->join('formations','cours.formation_id','=','formations.id')
                        ->get();
        }else{

            $teacher = $user;

            $formation = DB::table('formations')
                            ->where('id','=',$teacher->formation_id)
                            ->where('deleted_at', '=', 0)
                            ->get();

            $list = DB::table('cours')
                        ->select('cours.id','cours.intitule','plannings.date_debut','plannings.date_fin', 'formations.intitule as Fintitule')
                        ->join('plannings','cours.id','=','plannings.cours_id')
                        ->join('formations','cours.formation_id','=','formations.id')
                        ->where('cours.id', '=', $teacher->id)
                        ->get();
        }

        if ($user[0]->type == 'admin') {
            return view('manage.course.cours',[
                'cours'=> $list,
                'teachers'=> $teacher,
                'formations'=> $formation
            ]);
        }
        return view('teacher.cours.cours',[
            'cours'=> $list,
            'teachers'=> $teacher,
            'formations'=> $formation
        ]);
    }

    public function getCourseByID($id) {
        $user = Session::get('user');

        $user_type = $user[0][0]->type;

        $cour_edit = DB::table('cours')
        ->select('cours.id','cours.intitule','plannings.date_debut','plannings.date_fin', 'formations.intitule as Fintitule')
        ->join('plannings','cours.id','=','plannings.cours_id')
        ->join('formations','cours.formation_id','=','formations.id')
        ->where('cours.id', '=', $id)
        ->get();

        if ($user_type == 'admin') {

        } else {

        }
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

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CourController extends Controller
{
    //
    public function store(Request $request) {
        $intitule = $request['intitule'];
        $user_id = $request['user_id'];
        $formation_id = $request['formation_id'];

        DB::table('cours')->insert([
            'intitule' => $intitule,
            'user_id' => $user_id,
            'formation_id' => $formation_id
        ]);

        return $this->getAll();
    }

    public function getAll() {
        $list = DB::table('cours')
                ->select('cours.id','cours.intitule','plannings.date_debut','plannings.date_fin', 'formations.intitule as Fintitule')
                ->join('plannings','cours.id','=','plannings.cours_id')
                ->join('formations','cours.formation_id','=','formations.id')
                ->get();
        return view('teacher.cours.listcours',[
            'cours'=> $list
        ]);
    }

    public function delete(Request $request){
        $id = $request['id'];

        DB::table('cours_users')->where('cours_id','=',$id)->delete();
        DB::table('plannings')->where('cours_id','=',$id)->delete();
        DB::table('cours')->where('id','=',$id)->delete();

        return $this->getAll();
    }
}

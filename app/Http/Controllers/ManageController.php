<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

use App\User;

class ManageController extends Controller
{
    //
    public function index() {

        if (!Session::has('user')){
            return redirect('/login');
        }

        return view('manage.index');
    }
    public function getListStudent() {
        $data =[];
        $student = DB::table('users')
            ->where('users.type', 'etudiant')
            ->join('formations','users.formation_id','=','formations.id')
            ->select('users.*','formations.intitule')
            ->get();
        $data['student'] = $student;
        return view('manage.account.listStudent', $data);
    }
    public function getListTeacher() {
        $data =[];
        $teacher = DB::table('users')
            ->where('users.type', 'enseignant')
            ->join('formations','users.formation_id','=','formations.id')
            ->select('users.*','formations.intitule')
            ->get();
        $data['teacher'] = $teacher;
        return view('manage.account.listTeacher', $data);
    }
    public function postdeleteAccount($id){
        $user_id = User::find($id);
        $user_id = $user_id->id;
        $cour_user = DB::table('cours_users')
            ->where('user_id','=',$user_id)
            ->delete();
        $cour = DB::table('cours')
            ->where('user_id',$user_id)
            ->delete();
        $user = DB::table('users')
            ->where('id',$user_id)
            ->delete();

        return redirect()->back()->with('success', 'Xóa thành công !');
    }

    public function register() {

        $formations = DB::table('formations')
        ->where('id', '>', 0)
        ->where('deleted_at', '=', 0)
        ->get();
        return view('manage.register.register', ['formations' => $formations]);
    }

    public function postRegister(Request $request) {
        $this->validate($request,
        [
            'username' => 'unique:users,login',
            'password' => 'min:8',
            'type' => 'required',
        ],
        [
            'username.unique' => 'User name already exists.',
            'type.required' => 'Must choose the user type.',
            'password.min' => 'Password must be longer than 8 characters',
        ]
        );

        $user = new User();

        $user->nom = $request->firstname;
        $user->prenom = $request->lastname;
        $user->login = $request->username;
        $user->mdp = Hash::make($request->password);

        if ($request->formation_id) {
            $user->formation_id = $request->formation_id;
        }
        $user->type = $request->type;

        $user->save();

        return redirect()->back();
    }

    public function getRequest(){
        $r = DB::table('users')
                ->where('type', '=', null)
                ->get();
        
        return view('',[
            'requests' => $r
        ]);
    }

    public function acceptRequest(Request $request){
        $user_id = $request['user_id'];
        $type = $request['type'];
        if($type == 0) $type = 'etudiant';
            else $type = 'enseignant';

        DB::table('users')
            ->where('id', $user_id)
            ->update(['type' => $type]);
        return $this->getRequest();
    }

    public function postCourse(Request $request) {

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

        return redirect()->back();
    }
}

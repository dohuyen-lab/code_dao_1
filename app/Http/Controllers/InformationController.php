<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class InformationController extends Controller
{
    public function getInformation(){
        $user = Session::get('user');
        $user_id = $user[0][0]->id;
        $formation = DB::table('users')
            ->where('users.id',$user_id)
            ->join('formations', 'users.formation_id','=','formations.id')
            ->select('users.*','formations.intitule')
            ->first();
        $data =[];
        $data['formation'] = $formation;
        if ($user[0][0]->type == 'etudiant') {
            return view('student.account.information', $data);
        } else if ($user[0][0]->type == 'enseignant') {
            return view('teacher.account.information', $data);
        }

    }
    public function editInformation(){
        $user = Session::get('user');
        $user_id = $user[0][0]->id;
        $user = User::find($user_id);
        return response()->json(['error' => false, 'data' => $user], 200);
    }
    public function postEditInformation(Request $request)
    {

        $request->validate([
            'nom' => 'required',
            'prenom' => 'required',
        ],[
            'nom.required' => 'Please enter first name',
            'prenom.required' => 'Please enter last name',
        ]);
        //upload
        $id = $request->idUser;
        $user = User::find($id);
        $user->nom = $request->nom;
        $user->prenom = $request->prenom;
        $user->update();
        $user = ['nom' => $request->nom, 'prenom' => $request->prenom];

        return response()->json(['error' => false, 'data' => $user], 200);
    }

    public function postChangePass(Request $request)
    {
        $id = $request->idUser;
        $user = DB::table('users')->where('id', '=', $id)->first();

        if($request->password){
            $validatedData = $request->validate([
                'newpassword' => 'min:8',
                'password_confirmation'=>'required|same:newpassword',
            ],[
                'newpassword.required'=>'Mật khẩu không trùng khớp',
                'password.min'=>'Mật khẩu phải lớn hơn 8 kí tự',
            ]);
        }

        if ($request->newpassword != $request->password_confirmation) {
            return redirect()->back()->with(['message'=>'Le mot de passe ne correspond pas']);
        }

        if (Hash::check($request->password, $user->mdp)) {
            DB::table('users')
            ->where('id', '=', $id)
            ->update(['mdp' => Hash::make($request->newpassword)]);
        } else
        {
            $error = array('password' => 'Please enter correct current password');
            return response()->json(array('error' => $error), 400);
        }
        return redirect()->back();
    }

    public function getInfoUserById() {
        if (isset($_GET['id'])) {
            $data = array();
            $id = $_GET['id'];

            $user = DB::table('users')
            ->select('nom', 'prenom', 'id')
            ->where('id', '=', $id)
            ->first();

            $formations = DB::table('formations')
                            ->where('id', '>', 1)
                            ->where('deleted_at', '<>', 1)
                            ->get();

            $data['user'] = $user;
            $data['formations'] = $formations;
            return response()->json(['error' => false, 'data' => $data], 200);
        }
    }

    public function postInfoUserById(Request $req) {

        $user_id = $req->idUser;
        $nom = $req->nom;
        $prenom = $req->prenom;
        $formation_id = $req->formation_id;

        DB::table('users')
        ->where('id', '=', $user_id)
        ->update([
            'nom' => $nom,
            'prenom' => $prenom,
            'formation_id' => $formation_id
        ]);

        return redirect()->back()->with(['message'=>'Mise à jour réussie!!']);
    }
}

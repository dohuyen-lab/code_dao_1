@extends('student.layout.master')
@section('category', 'Contact')
@section('title','Student Calenda')
@section('content')
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center py-4">
        <div class="d-block mb-4 mb-md-0">
            <h2 class="h4">Inscription</h2>
        </div>
    </div>
    <div class="table-settings mb-4">
        <div class="row align-items-center justify-content-between">
            <div class="col col-md-6 col-lg-3 col-xl-4">
                <form action="{{ route('postRegisterCours')}}" method="POST">
                    @csrf
                    <div class="row align-items-center" style="display: flex">
                        <div >
                            <div class="col mt-4" >
                                <input type="text" class="form-control" name="intitule" placeholder="Nom de cours" required>
                            </div>
                        </div>
                        <div>
                            <div class="col mt-4">
                                <button type="submit">S’inscrire</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        <div class="card card-body border-light shadow-sm table-wrapper table-responsive pt-0">
            <table class="table table-hover">
                <thead>
                <tr>
                    <th> N°</th>
                    <th>Enseignement</th>
                    <th>Date_début</th>
                    <th>Date_fin</th>
                    <th>Action</th>
                </tr>
                </thead>
                <tbody>
                @foreach($cours as $key => $c)
                    <form action="{{url('/student/delete/'.$c->cours_id)}}" method="POST" >
                        @csrf
                    <tr>
                        <th scope="row">{{$key + 1}}</th>
                        <td>{{$c->intitule}}</td>
                        <td>{{$c->date_debut}}</td>
                        <td>{{$c->date_fin}}</td>
                        <td>
                            <button type="submit">Supprimer</button>
                        </td>
                    </tr>
                    </form>
                @endforeach
                </tbody>
            </table>

@endsection

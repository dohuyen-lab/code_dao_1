@extends('manage.layout.master')
@section('category', 'Contact')
@section('title','Student Calenda')
@section('content')

    <section class="fdb-block">
        <div class="container"><div class="row">
            <div class="col text-center">
                @if($status == 0)
                    <h1>Création de cours</h1>
                @else
                    <h1>Modifier le cours</h1>
                @endif
            </div>
        </div>
            <form method="POST" action="{{$status == 0? route('manager.store.post') : route('updateCours')}}">
                @csrf
                <section class="fdb-block">
                    <div class="container">
                        <div class="row justify-content-center">
                            <div class="col-12 col-md-8 col-lg-8 col-xl-6">
                                <div class="row align-items-center">
                                    @if (Session::has('err_date'))
                                        <div class="alert alert-danger" role="alert">
                                            <strong class="mb-5" style="color: white; font-weight: bold">{{Session::get('err_date')}}</strong>
                                        </div>
                                    @endif
                                </div>
                                <div class="row align-items-center">
                                    <div class="col mt-4">
                                        @if($status == 0)
                                            <input type="text" class="form-control" placeholder="Nom" name="intitule" id="intitule">
                                        @else
                                            <input type="text" class="form-control" value="{{$cour->intitule}}" placeholder="Nom" name="intitule" id="intitule">
                                            <input name="id" value="{{$cour->id}}" hidden>
                                        @endif
                                    </div>
                                </div>
                                <div class="row align-items-center">
                                            <div class="col mt-4">

                                                    <select name="user_id" id="user_id" class="form-control" required="required" >
                                                        <option value= "" selected >Liste des enseignants</option>
                                                        @foreach($teachers as $key => $t)
                                                            <option value="{{ $t->id }}">{{ $t->nom.' '.$t->prenom }}</option>
                                                        @endforeach
                                                    </select>

                                            </div>
                                        </div>
                                            <div class="row align-items-center">
                                                <div class="col mt-4">

                                                    <select name="formation_id" id="formation_id" class="form-control" required="required" >
                                                        @foreach($formations as $key => $f)
                                                            <option value="{{ $f->id }}">{{ $f->intitule }}</option>
                                                        @endforeach
                                                    </select>

                                                </div>
                                            </div>

                                            <div class="form-group row">
                                                <label for="example-date-input" class="col mt-4 col-form-label">Date_début</label>
                                                <div class="col mt-4">
                                                <input class="form-control" type="date" value="{{$status == 1?substr($cour->date_debut,0, 10):''}}" id="date_debut" name="date_debut">
                                                </div>
                                            </div>

                                            <div class="form-group row">
                                                <label for="example-date-input" class="col mt-4 col-form-label">Date_fin</label>
                                                <div class="col mt-4">
                                                <input class="form-control" type="date" value="{{$status == 1?substr($cour->date_fin,0, 10):''}}" id="date_fin" name="date_fin">
                                                </div>
                                            </div>

                                            <div class="row mt-4">
                                                <div class="col">
                                                    <button class="btn btn-primary mt-4" type="submit">Soumission</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </section>
                        </div>
            </form>
        </div>
    </section>
@endsection


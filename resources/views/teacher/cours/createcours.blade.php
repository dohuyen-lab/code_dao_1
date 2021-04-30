@extends('teacher.layout.master')
@section('category', 'Contact')
@section('title','Student Calenda')
@section('content')

    <section class="fdb-block">
        <div class="container"><div class="row">
            <div class="col text-center">
                @if($status == 0)
                    <h1>Create Course</h1>
                @else
                    <h1>Edit Course</h1>
                @endif
            </div>
        </div>
            <form method="POST" action="{{$status? route('storeCours') : route('editCours')}}">
                <section class="fdb-block">
                    <div class="container">
                        <div class="row justify-content-center">

                            <div class="col-12 col-md-8 col-lg-8 col-xl-6">
                                <div class="row align-items-center">
                                    <div class="col mt-4">
                                        @if($status == 0)
                                            <input type="text" class="form-control" placeholder="Name class" name="intitule" id="intitule">
                                        @else 
                                            <label>{{$cour->intitule}}</label>
                                    </div>
                                </div>
                                <div class="row align-items-center">
                                            <div class="col mt-4">
                                                
                                                    <select name="user_id" id="user_id" class="form-control" required="required">
                                                         @foreach($teachers as $key => $t)
                                                            <option value="{{ $t->id }}">{{ $t->nom + $t->prenom }}</option>
                                                        @endfor 
                                                    </select>
                                                    
                                            </div>
                                        </div>
                                            <div class="row align-items-center">
                                                <div class="col mt-4">

                                                    <select name="formation_id" id="formation_id" class="form-control" required="required">
                                                         @foreach($fomations as $key => $f)
                                                            <option value="{{ $f->id }}">{{ $f->intitule }}</option>
                                                        @endfor 
                                                    </select>

                                                </div>
                                            </div>

                                            <div class="form-group row">
                                                <label for="example-date-input" class="col mt-4 col-form-label">Start time</label>
                                                <div class="col mt-4">
                                                <input class="form-control" type="date" value="{{$cour->date_debut}}" id="date_debut" name="date_debut">
                                                </div>
                                            </div>
                                            
                                            <div class="form-group row">
                                                <label for="example-date-input" class="col mt-4 col-form-label">End time</label>
                                                <div class="col mt-4">
                                                <input class="form-control" type="date" value="{{$cour->date_fin}}" id="date_fin" name="date_fin">
                                                </div>
                                            </div>

                                            <div class="row mt-4">
                                                <div class="col">
                                                    <button class="btn btn-primary mt-4" type="submit">Submit</button>
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


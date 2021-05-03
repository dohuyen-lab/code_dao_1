@extends('teacher.layout.master')
@section('category', 'Contact')
@section('title','Student Calenda')
@section('content')

    <section class="fdb-block">
        <div class="container"><div class="row">
            <div class="col text-center">
                @if($status == 0)
                    <h1>Création de séance</h1>
                @else
                    <h1>Modifier le séance</h1>
                @endif
            </div>
        </div>
            <form method="POST" action="{{$status == 0? route('storeCours') : route('updateCours')}}">
                @csrf
                <input type="hidden" value="{{$status == 1?$cour->id:''}}" name="id">
                <section class="fdb-block">
                    <div class="container">
                        <div class="row justify-content-center">
                            <div class="col-12 col-md-8 col-lg-8 col-xl-6">
                                <div class="row align-items-center">
                                    <div class="col mt-4">
                                        @if (Session::has('err_time'))
                                            <div class="alert alert-danger" role="alert">
                                                <strong class="mb-5" style="color: white; font-weight: bold">{{Session::get('err_time')}}</strong>
                                            </div>
                                        @endif
                                        @if (Session::has('err_date'))
                                            <div class="alert alert-danger" role="alert">
                                                <strong class="mb-5" style="color: white; font-weight: bold">{{Session::get('err_date')}}</strong>
                                            </div>
                                        @endif
                                        @if (Session::has('warning_date'))
                                            <div class="alert alert-warning" role="alert">
                                                <strong class="mb-5" style="color: white; font-weight: bold">{{Session::get('warning_date')}}</strong>
                                            </div>
                                        @endif
                                    </div>
                                </div>
                                <div class="row align-items-center">
                                    <div class="col mt-4">
                                        <select name="cours_id" id="cours_id" class="form-control" required="required">
                                            <option value="{{$status == 1? $cour->id : ""}}" selected >{{$status == 1? $cour->intitule : "Veuillez choisir un cours"}}</option>
                                                @if (isset($course))
                                                    @foreach ($course as $cours)
                                                        <option value="{{ $cours->id }}">{{ $cours->intitule }}</option>
                                                    @endforeach
                                                @endif
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="example-date-input" class="col mt-4 col-form-label">Date</label>
                                    <div class="col mt-4">
                                    <input class="form-control" type="date" value="{{$status == 1?substr($cour->date_debut,0, 10):''}}" id="date_debut" name="date">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="example-date-input" class="col mt-4 col-form-label">Heure_debut</label>
                                    <div class="col mt-4">
                                        <input class="form-control" type="time" id="appt" value="{{$status == 1?substr($cour->date_debut,11, 10):''}}" name="heure_debut" min="00:00" max="24:00" required>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="example-date-input" class="col mt-4 col-form-label">Heure_fin</label>
                                    <div class="col mt-4">
                                        <input class="form-control" type="time" id="appt" value="{{$status == 1?substr($cour->date_fin,11, 10):''}}" name="heure_fin" min="00:00" max="24:00" required>
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
    <script type="text/javascript">

    </script>
@endsection


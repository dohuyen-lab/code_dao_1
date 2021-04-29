@extends('manage.layout.master')
@section('category', 'Contact')
@section('title','Student Calenda')
@section('content')
    <section class="fdb-block">
        <div class="container">
            <form action="{{ route('manager.post_register')}}" method="POST">
                @csrf
                <div class="row justify-content-center">
                    <div class="col-12 col-md-8 col-lg-8 col-xl-6">
                        @if ($errors->any())
                            <div class="alert alert-danger alert-dismissible" role="alert">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li class="text-white">{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                        <div class="row">
                            <div class="col text-center">
                                <h1>Register</h1>
                            </div>
                        </div>
                        <div class="row align-items-center">
                            <div style="display: flex; margin-left: 170px; margin-top: 30px">
                                <input type="radio" id="teacher" name="type" value="enseignant">
                                <label for="teacher" style="margin-left: 10px">teacher</label><br>
                                <input type="radio" id="student" name="type" value="etudiant" style="margin-left: 30px">
                                <label for="student" style="margin-left: 10px" >student</label><br>
                            </div>
                            <div class="col mt-4">
                                <input type="text" class="form-control" name="firstname" placeholder="First Name" required>
                            </div>
                        </div>
                        <div class="row align-items-center">
                            <div class="col mt-4">
                                <input type="text" class="form-control" name="lastname" placeholder="Last Name" required>
                            </div>
                        </div>
                        <div class="row align-items-center">
                            <div class="col mt-4">
                                <input type="text" class="form-control" name="username" placeholder="User Name" required>
                            </div>
                        </div>
                        <div class="row align-items-center">
                            <div class="col mt-4">
                                <select class="form-control" name="formation_id">
                                    <option selected>Click this select menu</option>
                                    @if (!empty($formations))
                                        @foreach ($formations as $format)
                                            <option value="{{ $format->id}}">{{ $format->intitule }}</option>
                                        @endforeach
                                    @endif
                                </select>
                            </div>
                        </div>
                        <div class="row align-items-center mt-4">
                            <div class="col">
                                <input type="password" class="form-control" placeholder="Password" name="password" required>
                            </div>
                            <div class="col">
                                <input type="password" class="form-control" placeholder="Confirm Password" name="password_confirmation" required>
                            </div>
                        </div>
                        <div class="row mt-4">
                            <div class="col">
                                <button class="btn btn-primary mt-4" type="submit">Submit</button>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </section>
@endsection

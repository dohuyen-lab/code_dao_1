@extends('manage.layout.master')
@section('category', 'Contact')
@section('title','Student Calenda')
@section('content')
    <section class="fdb-block">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-12 col-md-8 col-lg-8 col-xl-6">
                    <div class="row">
                        <div class="col text-center">
                            <h1>Register</h1>
{{--                            <p class="lead">Far far away, behind the word mountains, far from the countries Vokalia and Consonantia. </p>--}}
                        </div>
                    </div>
                    <div class="row align-items-center">
                        <div class="col mt-4">
                            <input type="text" class="form-control" placeholder="First Name">
                        </div>
                    </div>
                    <div class="row align-items-center">
                        <div class="col mt-4">
                            <input type="text" class="form-control" placeholder="Last Name">
                        </div>
                    </div>
                    <div class="row align-items-center">
                        <div class="col mt-4">
                            <input type="text" class="form-control" placeholder="User Name">
                        </div>
                    </div>
                    <div class="row align-items-center">
                        <div class="col mt-4">
                            <input type="text" class="form-control" placeholder="Ten khoa hoc">
                        </div>
                    </div>
                    <div class="row align-items-center mt-4">
                        <div class="col">
                            <input type="password" class="form-control" placeholder="Password">
                        </div>
                        <div class="col">
                            <input type="password" class="form-control" placeholder="Confirm Password">
                        </div>
                    </div>
                    <div style="display: flex; margin-left: 170px; margin-top: 30px">
                        <input type="radio" id="teacher" name="type" value="teacher">
                        <label for="teacher" style="margin-left: 10px">teacher</label><br>
                        <input type="radio" id="student" name="type" value="student" style="margin-left: 30px">
                        <label for="student" style="margin-left: 10px" >student</label><br>
                    </div>
                    <div class="row justify-content-start mt-4">
                        <div class="col">
                            <div class="form-check">
                                <label class="form-check-label">
                                    <input type="checkbox" class="form-check-input">
                                    I Read and Accept <a href="https://www.froala.com">Terms and Conditions</a>
                                </label>
                            </div>

                            <button class="btn btn-primary mt-4">Submit</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

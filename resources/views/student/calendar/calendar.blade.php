@extends('student.layout.master')
@section('category', 'Contact')
@section('title','Student Calenda')
@section('content')
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center py-4">
        <div class="d-block mb-4 mb-md-0">
            <nav aria-label="breadcrumb" class="d-none d-md-inline-block">
                <ol class="breadcrumb breadcrumb-dark breadcrumb-transparent">
                    <li class="breadcrumb-item"><a href="#"><span class="fas fa-home"></span></a></li>
                    <li class="breadcrumb-item"><a href="#">Calendar</a></li>
                </ol>
            </nav>
            <h2 class="h4">Register the course</h2>
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
                                <input type="text" class="form-control" name="intitule" placeholder="Name Cours" required>
                            </div>
                        </div>
                        <div>
                            <div class="col mt-4">
                                <button type="submit"> Register </button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        <div class="card card-body border-light shadow-sm table-wrapper table-responsive pt-0">
            <table class="table table-hover">
                <thead>
                <tr>
                    <th>STT</th>
                    <th>Course Title</th>
                    <th>Date start</th>
                    <th>Date end</th>
                    <th>Status</th>
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
                            <button type="submit">Delete</button>
                        </td>
                    </tr>
                    </form>
                @endforeach
                </tbody>
            </table>

@endsection

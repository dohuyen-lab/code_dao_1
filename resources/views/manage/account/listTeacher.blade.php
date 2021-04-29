@extends('manage.layout.master')
@section('category', 'Contact')
@section('title','Teacher List')
@section('content')
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center py-4">
        <div class="d-block mb-4 mb-md-0">
            <h2 class="h4">Teacher List</h2>
        </div>

    </div>
    <div class="table-settings mb-4">

        {{--        <div class="table-settings mb-4">--}}
        {{--            --}}
        {{--    </div>--}}
        <div class="card card-body border-light shadow-sm table-wrapper table-responsive pt-0">
            <table class="table table-hover">
                <thead>
                <tr>
                    <th>#</th>
                    <th>First name</th>
                    <th>Last name</th>
                    <th>User name</th>
                    <th>Course</th>
                    <th>Action</th>
                </tr>
                </thead>
                <tbody>
                @foreach($teacher as $key => $t)
                    <tr>
                        <th scope="row">{{$key + 1}}</th>
                        <td>{{$t->nom}}</td>
                        <td>{{$t->prenom}}</td>
                        <td>{{$t->intitule}}</td>
                        <td>
                            <button>Delete</button>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>

        </div>


@endsection

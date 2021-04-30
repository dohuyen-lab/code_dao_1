@extends('manage.layout.master')
@section('category', 'Contact')
@section('title','Student Calenda')
@section('content')
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center py-4">
        <div class="d-block mb-4 mb-md-0">
            <h2 class="h4">Request List</h2>
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
                    <th>Serial</th>
                    <th>First name</th>
                    <th>Last name</th>
                    <th>User name</th>
                    <th>Type</th>
                    <th>Action</th>
                </tr>
                </thead>
                <tbody>
                @if(!empty($r))
                @foreach($r as $key => $s)
                    <form action="{{url('/manager/accept/')}}" method="POST" >
                        @csrf
                        <input name="user_id" id="user_id" value="{{$s->id}}" hidden>
                    <tr>
                        <th scope="row">{{$key + 1}}</th>
                        <td>{{$s->nom}}</td>
                        <td>{{$s->prenom}}</td>
                        <td>{{$s->login}}</td>
                        <td>
                        <select name="type" id="type" class="form-control" required="required">
                            <option value="0" selected>Student</option>
                            <option value="1">Teacher</option>
                        </select>
                        </td>
                        <td>
                            <button type="submit">Accept</button>
                        </td>
                    </tr>
                    </form>
                @endforeach
                @endif
                </tbody>
            </table>

        </div>

@endsection

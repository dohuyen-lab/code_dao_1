@extends('manage.layout.master')
@section('category', 'Contact')
@section('title','manage Calenda')
@section('content')
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center py-4">
        @if (!empty($message))
            <div class="alert alert-success" role="alert">
                <strong>{{$message}}</strong>
            </div>
        @endif
        <div class="d-block mb-4 mb-md-0">
            <h2 class="h4">Courses List</h2>
        </div>



    </div>
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center py-4">
        <div class="d-block mb-4 mb-md-0">
            <div class="d-block mb-4 mb-md-0">
                <a href="{{route('manager.store.cours')}}">
                    <button type="submit" class="btn btn-success" data-toggle="modal" data-target="#myModal">
                        Create course
                    </button>
                </a>
        </div>
        </div>

    </div>



    <div class="table-settings mb-4">
        <div class="row align-items-center justify-content-between">


        </div>
        {{--        <div class="table-settings mb-4">--}}
        {{--            --}}
        {{--    </div>--}}
        <div class="card card-body border-light shadow-sm table-wrapper table-responsive pt-0">
        <table class="table table-hover">
            <thead>
            <tr>
                <th>Serial</th>
                <th>Intitule</th>
                <th>Formation</th>
                <th>Date Debut</th>
                <th>Date Fin</th>
                <th>Action</th>
            </tr>
            </thead>
            <tbody>
            <tr>
                @if(!empty($cours))
                    @foreach($cours as $key => $c)
                        <tr>
                            <th scope="row">{{$key + 1}}</th>
                            <td>{{$c->intitule}}</td>
                            <td>{{$c->Fintitule}}</td>
                            <td>{{$c->date_debut}}</td>
                            <td>{{$c->date_fin}}</td>
                            <td>
                                <div class="d-flex">
                                    <a href="{{url('/manager/cours/edit/'.$c->id)}}">
                                        <div class="form-group">
                                            <input type="submit" class="btn btn-success" value="edit" >
                                        </div>
                                    </a>&nbsp;&nbsp;
                                    <form method="POST" action="{{route('manager.delete.course')}}">
                                        {{ csrf_field() }}
                                        <div class="form-group">
                                            <input type="text" value="{{$c->id}}" name="id" hidden>
                                            <input type="submit" class="btn btn-danger" value="deltete" >
                                        </div>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                @endif
            </tbody>
        </table>
@endsection

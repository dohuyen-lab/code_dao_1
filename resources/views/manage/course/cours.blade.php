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

            <h2 class="h4">Liste de cours</h2>
                <form action="{{route('manager.search.course')}}" method="get" class="navbar-search form-inline" id="navbar-search-main">
                    <div class="input-group input-group-merge search-bar">
                        <input type="text" class="form-control" id="topbarInputIconLeft" name="search" placeholder="Recherche" aria-label="Search" aria-describedby="topbar-addon">
                        <input type="submit" class="btn btn-success form-control" value="Search" style="width:70px;">
                    </div>
                </form>
        </div>



    </div>
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center py-4">
        <div class="d-block mb-4 mb-md-0">
            <div class="d-block mb-4 mb-md-0">
                <a href="{{route('manager.store.cours')}}">
                    <button type="submit" class="btn btn-success" data-toggle="modal" data-target="#myModal">
                        Création de cours
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
                <th>N°</th>
                <th>Intitulé</th>
                <th>Formation</th>
                <th>Date Début</th>
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
                                            <input type="submit" class="btn btn-success" value="Éditer" >
                                        </div>
                                    </a>&nbsp;&nbsp;
                                    <form method="POST" action="{{route('manager.delete.course')}}">
                                        {{ csrf_field() }}
                                        <div class="form-group">
                                            <input type="text" value="{{$c->id}}" name="id" hidden>
                                            <input type="submit" class="btn btn-danger" value="supprimer" >
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

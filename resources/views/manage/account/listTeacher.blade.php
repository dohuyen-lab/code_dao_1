@extends('manage.layout.master')
@section('category', 'Contact')
@section('title','Teacher List')
@section('content')
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center py-4" style="padding-bottom: 5px !important;">
        <div class="d-block mb-4 mb-md-0">

            <h2 class="h4">Liste des enseignants</h2>
                <form action="{{route('manager.search.teacher')}}" method="get" class="navbar-search form-inline" id="navbar-search-main">
                    <div class="input-group input-group-merge search-bar">
                        <input type="text" class="form-control" name="search" id="topbarInputIconLeft" placeholder="Recherche" aria-label="Search" aria-describedby="topbar-addon">
                        <input type="submit" class="btn btn-success form-control" value="Search" style="width:70px;">
                    </div>
                </form>
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
                        <th>N°</th>
                        <th>Prénom</th>
                        <th>Nom</th>
                        <th>Identifiant</th>
                        <th>cours</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                @foreach($teacher as $key => $t)
                    <form action="{{url('/manager/delete/'.$t->id)}}" method="POST" >
                        @csrf
                    <tr>
                        <th scope="row">{{$key + 1}}</th>
                        <td>{{$t->nom}}</td>
                        <td>{{$t->prenom}}</td>
                        <td>{{$t->login}}</td>
                        <td>{{$t->intitule}}</td>
                        <td>

                            <button class="btn btn-danger" type="submit">Supprimer</button>
                        </td>
                    </tr>
                    </form>
                @endforeach
                </tbody>
            </table>

        </div>


@endsection

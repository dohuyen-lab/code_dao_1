@extends('teacher.layout.master')
@section('category', 'Contact')
@section('title','manage Calenda')
@section('content')
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center py-2">
        <div class="d-block mb-1 mb-md-0">
            <h2 class="h4">Liste de cours</h2>
        </div>
    </div>
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center py-2">
        <div class="d-block mb-4 mb-md-0">
            <div class="d-block mb-4 mb-md-0">
                <a href="{{route('storeCours')}}">
                    <button type="submit" class="btn btn-success" data-toggle="modal" data-target="#myModal">
                        Création de séance
                    </button>
                </a>
        </div>
        </div>

    </div>

    <!-- Xep theo Tuan -->
    <div>
    @if(!empty($date))
            <form method="GET" class="mb-3" action="{{route('getListCoursWeek')}}">
                <input name="isnext" value="false" hidden>
                <button type="submit" name="date" value="{{$date}}">Prevew</button>
            </form>
        @endif

        <form method="GET" class="mb-3" action="{{route('getListCoursWeek')}}">
            <button type="submit" name="date" value="0">Tri par semaine</button>
        </form>

        @if(!empty($date))
            <form method="GET" class="mb-3" action="{{route('getListCoursWeek')}}">
                <input name="isnext" value="true" hidden>
                <button type="submit" name="date" value="{{$date}}">Suivant</button>
            </form>
        @endif

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
                                    <a href="{{url('/teacher/cours/edit/'.$c->id)}}">
                                        <div class="form-group">
                                            <input type="submit" class="btn btn-success" value="Éditer" >
                                        </div>
                                    </a>&nbsp;&nbsp;
                                    <form method="POST" action="{{route('deleteCours')}}">
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
        {{$cours->links()}}

@endsection

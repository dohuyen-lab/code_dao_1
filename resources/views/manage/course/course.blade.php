@extends('manage.layout.master')
@section('category', 'Contact')
@section('title','manage Calenda')
@section('content')
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center py-4" style="padding-bottom: 5px !important;">
        <div class="d-block mb-4 mb-md-0">

            <h2 class="h4">Liste des formations</h2>
                <form action="{{route('search.manager.formation')}}" method="get" class="navbar-search form-inline" id="navbar-search-main">
                    <div class="input-group input-group-merge search-bar">
                        <input type="text" class="form-control" name="search" id="topbarInputIconLeft" placeholder="Recherche" aria-label="Search" aria-describedby="topbar-addon">
                        <button type="submit" class="btn btn-success form-control" style="width:70px;">
                            <span class="fas fa-search"></span>
                        </button>
                    </div>
                </form>
        </div>
    </div>

    <section class="fdb-block">
        <div class="container-fluid">
            <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center" style="padding-top: 0 !important;">
                <div class="col-6 col-md-6 col-lg-7 col-xl-5 text-center">
                    <form action="{{route('formations.store')}}" method="POST">
                        @csrf
                        <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center py-4">
                            <div class="col mt-4 align-self-center">
                                <input type="text" class="form-control" name="intitule" placeholder="Matière" required>
                            </div>
                            <div class="col mt-4">
                                <button class="btn btn-outline-secondary" type="submit">Soumission</button>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="col-6 col-md-6 col-lg-7 col-xl-5 text-center">
                    <form id="form_edit" action="" method="POST">
                        @csrf
                        <input name="_method" type="hidden" value="PUT">
                        <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center py-4">
                            <div class="col mt-4 align-self-center">
                                <input type="text" class="form-control" id="edit_text" name="intitule" placeholder="Éditer ..." required>
                            </div>
                            <div class="col mt-4">
                                <button id="btn_edit" class="btn btn-outline-success" type="submit" disabled>Éditer</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>


    <div class="table-settings mb-4">
        <div class="row align-items-center justify-content-between">
        </div>
        <div class="card card-body border-light shadow-sm table-wrapper table-responsive pt-0">
            <table class="table table-hover">
                <thead>
                <tr>
                    <th>#</th>
                    <th>Name</th>
                    <th>Action</th>
                </tr>
                </thead>
                <tbody>
                    @if (!empty($coures))
                        @foreach($coures as $key => $coure)
                            <tr>
                                <th scope="row">{{$key + 1}}</th>
                                <td>{{$coure->intitule}}</td>
                                <td>
                                    <div class="d-flex">
                                        <button class="btn btn-success" type="button" onclick="setEdit(`{{$coure->intitule}}`, {{$coure->id}})">
                                            Éditer
                                        </button>&nbsp;&nbsp;
                                        <form action="{{url('manager/formations/'.$coure->id)}}" method="POST" class="signin-form" enctype="multipart/form-data">
                                            <input type="hidden" name="_method" value="delete" />
                                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                            <button class="btn btn-danger" type="submit">
                                                Supprimer
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    @endif
                </tbody>
            </table>
            {{$coures->links()}}
        </div>
        <script type="text/javascript">
            function setEdit(text, id) {
                $("input[id='edit_text']").val(text);
                route = `{{route('formations.store')}}/${id}`;
                $("#btn_edit").prop('disabled', false);
                $("#form_edit").attr('action', route);
            }
        </script>
@endsection

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
                <button type="submit" class="btn btn-success form-control" style="width:70px;">
                    <span class="fas fa-search"></span>
                </button>
            </div>
        </form>
    </div>
    <div class="d-block mb-4 mb-md-0">
        @if (Session::has('message'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <strong style="color: white;">{{Session::get('message')}}</strong>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
        @elseif (Session::has('err'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <strong style="color: white;">{{Session::get('err')}}</strong>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
        @endif
    </div>
</div>
<div class="table-settings mb-4">
    <div class="card card-body border-light shadow-sm table-wrapper table-responsive pt-0">
        <table class="table table-hover">
            <thead>
                <tr>
                    <th>N°</th>
                    <th>Prénom</th>
                    <th>Nom</th>
                    <th>Identifiant</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
            @foreach($teacher as $key => $t)
                <tr>
                    <th scope="row">{{$key + 1}}</th>
                    <td>{{$t->nom}}</td>
                    <td>{{$t->prenom}}</td>
                    <td>{{$t->login}}</td>
                    <td>
                        <div class="d-flex">
                            <form>
                                <button onclick="editInformation({{$t->id}})" class="btn btn-success" type="button">Éditer</button>
                            </form>&nbsp;&nbsp;
                            <form action="{{url('/manager/delete/'.$t->id)}}" method="POST" >
                                @csrf
                                <button class="btn btn-danger" type="submit">Supprimer</button>
                            </form>
                        </div>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
        <div class="modal fade" id="editInformationModal">
            <div class="modal-dialog">
                <div class="modal-content">

                    <!-- Modal Header -->
                    <div class="modal-header">
                        <h4 class="modal-title">Modifier le profil <p><small>(Veuillez sélectionner toutes les informations pour soumettre votre demande.)</small></p> </h4>
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>
                    <!-- Modal body -->
                    <div class="modal-body">
                        <form id="edit_information_form" action="{{route('manager.post.edit')}}" method="POST"  enctype="multipart/form-data">
                            @csrf
                            <input hidden name="idUser" id="idUser" type="text">
                            <div class="form-group">
                                <label>Prénom</label>
                                <input type="text" name="nom" class="form-control" value="">
                                <small class="error form-text text-danger"></small>
                            </div>
                            <div class="form-group">
                                <label>Nom</label>
                                <input type="text" name="prenom" class="form-control" value="">
                                <small class="error form-text text-danger"></small>
                            </div>
                            <div class="form-group d-flex mt-2">
                                <button type="submit" id="btn_submit" class="btn btn-primary"><i class="fas fa-sync pr-1"></i>Mettre à jour</button>&nbsp;
                                <button class="btn btn-danger" data-dismiss="modal">Fermer</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script type="text/javascript">
        function editInformation(id){
            event.preventDefault();
            $.ajax({
                type: 'GET',
                url: "{{route('manager.get.edit')}}",
                data: {id: id},
                success: function(data) {
                    console.log(data);
                    $('#idUser').val(data['data']['user'].id);
                    $("#editInformationModal input[name=nom]").val(data['data'].user.nom);
                    $("#editInformationModal input[name=prenom]").val(data['data'].user.prenom);
                    $("#editInformationModal").modal('show');
                },
                error: function(error) {
                    console.log(error);
                }
            });
        }
    </script>
</div>
@endsection

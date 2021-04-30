@extends('student.layout.master')
@section('category', 'Information')
@section('title','Thông tin tài khoản')
@section('content')
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center py-4">
        <div class="d-block mb-4 mb-md-0">
            <nav aria-label="breadcrumb" class="d-none d-md-inline-block">
                <ol class="breadcrumb breadcrumb-dark breadcrumb-transparent">
                    <li class="breadcrumb-item"><a href="#"><span class="fas fa-home"></span></a></li>
                    <li class="breadcrumb-item"><a href="#">Compte</a></li>
                    <li class="breadcrumb-item"><a href="#">Information du compte</a></li>
                </ol>
            </nav>
        </div>
    </div>
    <div class="container">
        <div class="main-body">
            <div class="row gutters-sm">
                <div class="col-md-4 mb-3">
                    <div class="card">
                        <div class="card-body">
                            <div class="d-flex flex-column align-items-center text-center">
                                <img src="https://bootdey.com/img/Content/avatar/avatar7.png" alt="Admin" class="rounded-circle" width="150">
                                <div class="md-3">
                                    <h4>{{$formation->nom}} {{$formation->prenom}}</h4>
                                    <p class="text-secondary mb-1">
                                    </p>
                                    <!-- <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModal">Chỉnh sửa thông tin</button> -->
                                    <button onclick="editInformation({{$formation->id}})" class="btn btn-primary btn-sm btn-block">Modifier le profil</button>
                                    <button onclick="ChangePass()" type="button" class="btn btn-primary btn-sm btn-block" data-toggle="modal " data-target="#myModal">Changer mot de passe</button>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
                <div class="col-md-8">
                    <div class="card mb-3">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-sm-3">
                                    <h6 class="mb-0">Prénom </h6>
                                </div>
                                <div class="col-sm-9 text-secondary">
                                    {{$formation->nom}}
                                </div>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="col-sm-3">
                                    <h6 class="mb-0">Nom </h6>
                                </div>
                                <div class="col-sm-9 text-secondary">
                                    {{$formation->prenom}}
                                </div>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="col-sm-3">
                                    <h6 class="mb-0">Formation</h6>
                                </div>
                                <div class="col-sm-9 text-secondary">
                                    {{$formation->intitule}}
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Modal chỉnh sửa thông tin người dùng  -->
    <div class="modal fade" id="editInformationModal">
        <div class="modal-dialog">
            <div class="modal-content">

                <!-- Modal Header -->
                <div class="modal-header">
                    <h4 class="modal-title">Modifier le profil</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <!-- Modal body -->
                <div class="modal-body">
                    <form id="edit_information_form" method="POST"  enctype="multipart/form-data">
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
                    </form>
                </div>

                <!-- Modal footer -->
                <div class="modal-footer">
                    <button onclick="submitEdit()" class="btn btn-primary"><i class="fas fa-sync pr-1"></i>Mettre à jour</button>
                    <button class="btn btn-danger" data-dismiss="modal">Fermer</button>
                </div>

            </div>
        </div>
    </div>

    <!-- Modal chỉnh sửa thông tin người dùng  -->
    <div class="modal fade" id="editPassword">
        <div class="modal-dialog">
            <div class="modal-content">

                <!-- Modal Header -->
                <div class="modal-header">


                    <h4 class="modal-title">Changer mot de passe</h4>

                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <!-- Modal body -->
                <div class="modal-body">
                    <form id="edit_information_form" action="{{route('postChangePass')}}" method="POST"  enctype="multipart/form-data">
                        @csrf
                        @if (Session::has('message'))
                            <div class="alert alert-danger alert-dismissible" role="alert">
                                {{Session::get('message')}}
                            </div>
                        @endif
                        <input hidden name="idUser" id="idUser" value="{{$formation->id}}" type="text">
                        <div class="form-group">
                            <label>Mot de passe actuel</label>
                            <input type="password" name="password" class="form-control" value="">
                            <small class="error form-text text-danger"></small>
                        </div>
                        <div class="form-group">
                            <label>Nouveau mot de passe</label>
                            <input type="password" name="newpassword" class="form-control" value="">
                            <small class="error form-text text-danger"></small>
                        </div>
                        <div class="form-group">
                            <label>Confirmez le mot de passe</label>
                            <input type="password" name="password_confirmation" class="form-control" value="">
                            <small class="error form-text text-danger"></small>
                        </div>
                        <div class="form-group mt-5">
                            <button type="submit" class="btn btn-primary"><i class="fas fa-sync pr-1"></i>Cập nhật</button>
                            <button class="btn btn-danger" data-dismiss="modal">Close</button>
                        </div>
                    </form>
                </div>

                <!-- Modal footer -->
            </div>
        </div>
    </div>
<script>
    function editInformation(id){
        event.preventDefault();
        $.ajax({
            type: 'GET',
            url: "{{route('editInformation')}}",
            data:{id:id},
            success: function(data) {
                console.log(data);
                $('#idUser').val(data.data.id);
                $("#editInformationModal input[name=nom]").val(data.data.nom);
                $("#editInformationModal input[name=prenom]").val(data.data.prenom);
                $("#editInformationModal").modal('show');
            },
            error: function(error) {
                console.log(error);
            }
        });
    }
    function ChangePass(){
        $("#editPassword").modal('show');
    }
    function submitEdit(){
        event.preventDefault();

        var data = new FormData($("#editInformationModal form")[0]);
        console.log(data);
        $.ajax({
            url: "{{route('postEditInformation')}}",
            method: 'post',
            data: data,
            contentType: false,
            processData: false,
            success: function(data) {
                console.log(data);
                $('#editInformationModal').modal('hide');
                toastr.success('Sửa thành công!')
                window.location.reload().delay(500);

            },
            error: function(error) {
                var errors = error.responseJSON;
                console.log(errors.errors);
                $.each(errors.errors, function(i, val) {
                    $("#editInformationModal input[name=" + i + "]").siblings('.error').text(val[0]);

                })

            }
        });
    }
    function submitChangePass(){
        event.preventDefault();

        var data = new FormData($("#editPassword form")[0]);

        $.ajax({
            url: "{{route('postChangePass')}}",
            method: 'post',
            data: data,
            contentType: false,
            processData: false,
            success: function(data) {
                console.log(data);
                $('#editPassword').modal('hide');
                toastr.success('Sửa thành công!')
                // window.location.reload().delay(500);

            },
            error: function(error) {
                var errors = error.responseJSON;
                console.log(errors.errors);
                $.each(errors.errors, function(i, val) {
                    $("#editPassword input[name=" + i + "]").siblings('.error').text(val[0]);

                })

            }
        });
    }
</script>
@endsection

@extends('student.layout.master')
@section('category', 'Information')
@section('title','Thông tin tài khoản')
@section('content')
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center py-4">
        <div class="d-block mb-4 mb-md-0">
            <nav aria-label="breadcrumb" class="d-none d-md-inline-block">
                <ol class="breadcrumb breadcrumb-dark breadcrumb-transparent">
                    <li class="breadcrumb-item"><a href="#"><span class="fas fa-home"></span></a></li>
                    <li class="breadcrumb-item"><a href="#">Tài khoản</a></li>
                    <li class="breadcrumb-item"><a href="#">Thông tin tài khoản</a></li>
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
                                    <h4> Tên</h4>
                                    <p class="text-secondary mb-1">
                                    </p>
                                    <p class="text-muted font-size-sm">Hà Nội </p>
                                    <!-- <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModal">Chỉnh sửa thông tin</button> -->
                                    <button onclick="editInformation()" class="btn btn-primary">Chỉnh sửa thông tin</button>
                                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModal">Cài đặt tài khỏan</button>
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
                                    <h6 class="mb-0">First Name</h6>
                                </div>
                                <div class="col-sm-9 text-secondary">

                                </div>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="col-sm-3">
                                    <h6 class="mb-0">Last Name </h6>
                                </div>
                                <div class="col-sm-9 text-secondary">

                                </div>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="col-sm-3">
                                    <h6 class="mb-0">Formation</h6>
                                </div>
                                <div class="col-sm-9 text-secondary">

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
                    <h4 class="modal-title">Chỉnh sửa thông tin người dùng</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <!-- Modal body -->
                <div class="modal-body">
                    <form id="edit_information_form" method="POST"  enctype="multipart/form-data">
                        @csrf
                        <input hidden name="idUser" id="idUser" type="text">
                        <div class="form-group">
                            <label>First Name</label>
                            <input type="text" name="firstname" class="form-control" value="">
                            <small class="error form-text text-danger"></small>
                        </div>
                        <div class="form-group">
                            <label>Last Name</label>
                            <input type="text" name="lastname" class="form-control" value="">
                            <small class="error form-text text-danger"></small>
                        </div>
                    </form>
                </div>

                <!-- Modal footer -->
                <div class="modal-footer">
                    <button onclick="" class="btn btn-primary"><i class="fas fa-sync pr-1"></i>Cập nhật</button>
                    <button class="btn btn-danger" data-dismiss="modal">Close</button>
                </div>

            </div>
        </div>
    </div>
<script>
    function editInformation(){
        event.preventDefault();
        $.ajax({
            type: 'GET',
            url: "{{route('editInformation')}}",
            data:{id:id},
            success: function(data) {
                console.log(data);
                $('#idUser').val(data.data.id);
                $("#editInformationModal input[name=firstname]").val(data.data.nom);
                $("#editInformationModal input[name=lastname]").val(data.data.prenom);
                $("#editInformationModal").modal('show');
            },
            error: function(error) {
                console.log(error);
            }
        });
    }
</script>
@endsection
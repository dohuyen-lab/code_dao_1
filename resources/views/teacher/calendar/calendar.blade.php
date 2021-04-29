@extends('teacher.layout.master')
@section('category', 'Contact')
@section('title','Student Calenda')
@section('content')
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center py-4">
        <div class="d-block mb-4 mb-md-0">
            <nav aria-label="breadcrumb" class="d-none d-md-inline-block">
                <ol class="breadcrumb breadcrumb-dark breadcrumb-transparent">
                    <li class="breadcrumb-item"><a href="#"><span class="fas fa-home"></span></a></li>
                    <li class="breadcrumb-item"><a href="#">Yêu cầu</a></li>
                </ol>
            </nav>
            <h2 class="h4">Danh sách yêu cầu liên hệ</h2>
            <p class="mb-0">Thông tin liên hệ được gửi từ trang thông tin</p>
        </div>
    </div>
    {{--    <div class="table-settings mb-4">--}}
    {{--        <div class="row align-items-center justify-content-between">--}}
    {{--            <div class="col col-md-6 col-lg-3 col-xl-4">--}}
    {{--                <button class="btn btn-primary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">--}}
    {{--                    <span class="fas fa-clipboard mr-2"></span>Loại liên hệ--}}
    {{--                    <span class="icon icon-small ml-1"><span class="fas fa-chevron-down"></span></span>--}}
    {{--                </button>--}}
    {{--                <div class="dropdown-menu dashboard-dropdown dropdown-menu-left mt-2">--}}
    {{--                    <a class="dropdown-item font-weight-bold" href=""><span class="fa fa-address-card"></span>Tất cả yêu liên hệ</a>--}}
    {{--                    <a class="dropdown-item font-weight-bold" href=""><span class="far fa-envelope "></span>Chưa xử lý</a>--}}
    {{--                    <a class="dropdown-item font-weight-bold" href=""><span class="far fa-envelope-open"></span>Đã xử lý</a>--}}
    {{--                </div>--}}
    {{--                <button class="btn btn-primary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">--}}
    {{--                    <span class="fas fa-clipboard mr-2"></span>Loại bài đăng--}}
    {{--                    <span class="icon icon-small ml-1"><span class="fas fa-chevron-down"></span></span>--}}
    {{--                </button>--}}
    {{--                <div class="dropdown-menu dashboard-dropdown dropdown-menu-left mt-2">--}}
    {{--                    <a class="dropdown-item font-weight-bold" href=""><span class="fa fa-address-card"></span>Tất cả bài đăng</a>--}}
    {{--                    <a class="dropdown-item font-weight-bold" href=""><span class="far fa-envelope "></span>Cho thuê, cho bán</a>--}}
    {{--                    <a class="dropdown-item font-weight-bold" href=""><span class="far fa-envelope-open"></span>Cần thuê, cần bán</a>--}}
    {{--                </div>--}}
    {{--            </div>--}}

    {{--        </div>--}}
    {{--        <div class="table-settings mb-4">--}}
    {{--            --}}
    {{--    </div>--}}
    <div class="card card-body border-light shadow-sm table-wrapper table-responsive pt-0">
        <table class="table table-hover">
            <thead>
            <tr>
                <th>STT</th>
                <th>Course Title</th>
                <th>Date start</th>
                <th>Date end</th>
                <th>Hủy đăng ký</th>
            </tr>
            </thead>
            <tbody>
{{--            @foreach($cours as $key => $c)--}}
{{--                <tr>--}}
{{--                    <th scope="row">{{$key + 1}}</th>--}}
{{--                    <td>{{$c->intitule}}</td>--}}
{{--                    <td>{{$c->date_debut}}</td>--}}
{{--                    <td>{{$c->date_fin}}</td>--}}
{{--                    <td>--}}
{{--                        <button>Delete</button>--}}
{{--                    </td>--}}
{{--                </tr>--}}
{{--            @endforeach--}}
            </tbody>
        </table>

@endsection

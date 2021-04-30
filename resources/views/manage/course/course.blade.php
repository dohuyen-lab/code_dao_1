@extends('manage.layout.master')
@section('category', 'Contact')
@section('title','manage Calenda')
@section('content')
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center py-4" style="padding-bottom: 5px !important;">
        <div class="d-block mb-4 mb-md-0">
            <h2 class="h4">Formations List</h2>
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
                                <input type="text" class="form-control" name="intitule" placeholder="Name Course" required>
                            </div>
                            <div class="col mt-4">
                                <button class="btn btn-outline-secondary" type="submit">Submit</button>
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
                    <th>Created time</th>
                    <th>Update time</th>
                    <th>Action</th>
                </tr>
                </thead>
                <tbody>
                    @if (!empty($coures))
                        @foreach($coures as $key => $coure)
                            <tr>
                                <th scope="row">{{$key + 1}}</th>
                                <td>{{$coure->intitule}}</td>
                                <td>{{$coure->created_at}}</td>
                                <td>{{$coure->updated_at}}</td>
                                <td>
                                    <form action="{{url('manager/formations/'.$coure->id)}}" method="POST" class="signin-form" enctype="multipart/form-data">
                                        <input type="hidden" name="_method" value="delete" />
                                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                        <button class="btn btn-danger" type="submit">
                                            Delete
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    @endif
                </tbody>
            </table>

        </div>


@endsection

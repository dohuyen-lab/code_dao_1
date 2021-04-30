@extends('manage.layout.master')
@section('category', 'Contact')
@section('title','manage Calenda')
@section('content')
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center py-4">
        <div class="d-block mb-4 mb-md-0">
            <h2 class="h4">Courses List</h2>
        </div>



    </div>
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center py-4">
        <div class="d-block mb-4 mb-md-0">
            <div class="d-block mb-4 mb-md-0">

                {{-- <button class="btn btn-success" type="submit" style="width: 150px; height: 10; border-radius: 0px; ">Create Course</button> --}}
                <button type="button" class="btn btn-success" data-toggle="modal" data-target="#myModal">
                    Create course
               </button>
               <form method="POST" action="{{route('manager.post.course')}}">
                @csrf
                <input type="hidden" name="course_id" value="">
                    <div class="modal" id="myModal">
                        <div class="modal-dialog">
                        <div class="modal-content">
                            <!-- Modal Header -->
                            <div class="modal-header">
                                <div class="col text-center">
                                    <h2>Create course</h2>
                                </div>
                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                            </div>
                            <!-- Modal body -->
                            <div class="modal-body">
                                <section class="fdb-block">
                                    <div class="container">
                                        <div class="row justify-content-center">
                                            <div class="col-12 col-md-8 col-lg-8 col-xl-6">
                                                <div class="row">

                                                </div>
                                                <div class="row align-items-center">
                                                    <div class="col mt-4">
                                                        <input type="text" class="form-control" placeholder="Name class" name="intitule" id="intitule" required>
                                                    </div>
                                                </div>
                                                <div class="row align-items-center">
                                                    <div class="col mt-4">

                                                        <select name="user_id" id="user_id" class="form-control" required="required">
                                                            @foreach($teachers as $key => $t)
                                                                <option value="{{ $t->id }}">{{ $t->nom.' '.$t->prenom }}</option>
                                                            @endforeach
                                                        </select>

                                                    </div>
                                                </div>
                                                <div class="row align-items-center">
                                                    <div class="col mt-4">

                                                        <select name="formation_id" id="formation_id" class="form-control" required="required">
                                                            @foreach($formations as $key => $f)
                                                                <option value="{{ $f->id }}">{{ $f->intitule }}</option>
                                                            @endforeach
                                                        </select>

                                                    </div>
                                                </div>

                                                <div class="form-group row">
                                                    <label for="example-date-input" class="col mt-4 col-form-label">Start time</label>
                                                    <div class="col mt-4">
                                                    <input class="form-control" type="date" value="2011-08-19" id="date_debut" name="date_debut" required>
                                                    </div>
                                                </div>

                                                <div class="form-group row">
                                                    <label for="example-date-input" class="col mt-4 col-form-label">End time</label>
                                                    <div class="col mt-4">
                                                    <input class="form-control" type="date" value="2011-08-19" id="date_fin" name="date_fin" required>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </section>
                            </div>
                            <!-- Modal footer -->
                            <div class="modal-footer">
                                <button type="submit" class="btn btn-success">Submit</button>
                            </div>
                        </div>

                        </div>
                    </div>
                 </form>
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
                                    <form method="GET" action="{{url('/manager/cours/'.$c->id)}}">
                                        <div class="form-group">
                                            <input type="text" value="{{$c->id}}" name="id" hidden>
                                            <input type="submit" class="btn btn-success" value="edit" >
                                        </div>
                                    </form>&nbsp;&nbsp;
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

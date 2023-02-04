@extends('admin.layouts.master')
@section('title','Admin List Page')
@section('content')
    <!-- MAIN CONTENT-->
            <div class="main-content">
                <div class="section__content section__content--p30">
                    <div class="container-fluid">
                        <div class="col-md-12">
                            <!-- DATA TABLE -->
                            <div class="table-data__tool">
                                <div class="table-data__tool-left">
                                    <div class="overview-wrap">
                                        <h2 class="title-1">Admin List</h2>

                                    </div>
                                </div>
                            </div>
                            @if (session('deleteSuccess'))
                                <div class="col-4 offset-8">
                                <div class="alert alert-warning alert-dismissible fade show" role="alert">
                                    <i class="fa-solid fa-circle-xmark"></i>  {{session('deleteSuccess')}}
                                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                </div>
                                </div>
                            @endif
                            @if (session('updateSuccess'))
                                <div class="col-4 offset-8">
                                <div class="alert alert-success alert-dismissible fade show" role="alert">
                                    <i class="fa-solid fa-circle-xmark"></i>  {{session('updateSuccess')}}
                                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                </div>
                                </div>
                            @endif
                            <div class="row">
                                <div class="col-3">
                                    <h4 class="text-secondary">Search key:<span class="text-danger">{{request('key')}}</span></h4>
                                </div>
                                <div class="col-3 offset-9">
                                <form action="" method="get">
                                    @csrf
                                    <div class="d-flex">
                                        <input type="text" name="key" value="{{request('key')}}" class="form-control" placeholder="Search..">
                                        <button class="btn btn-dark text-white" type="submit">
                                            <i class="fa-solid fa-magnifying-glass"></i>
                                        </button>
                                    </div>
                                </form>
                            </div>
                            </div>
                            <div class="row mt-3">
                                <div class="col-2 offset-10 bg-white shadow-sm p-3 text-center">
                                    <h4><i class="fa-solid fa-database"></i> - {{$admin->total()}}</h4>
                                </div>
                            </div>

                                <div class="table-responsive table-responsive-data2">
                                <table class="table table-data2 text-center">
                                    <thead>
                                        <tr>
                                            <th>Image</th>
                                            <th>Name</th>
                                            <th>Email</th>
                                            <th>Gender</th>
                                            <th>Phone</th>
                                            <th>Address</th>
                                            <th>Role</th>
                                            <th></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($admin as $a)
                                            <tr class="tr-shadow">
                                            <td>
                                                 @if ($a->image == null)
                                                    @if ($a->gender == 'male')
                                                        <img src="{{asset('image/default_user.jfif')}}" class="img-thumbnail shadow-sm ">
                                                    @else
                                                        <img src="{{asset('image/default_female.jfif')}}" class="img-thumbnail shadow-sm ">
                                                    @endif
                                                @else
                                                    <img src="{{asset('storage/'.$a->image)}}"/>
                                                @endif
                                            </td>
                                            <input type="hidden" value="{{$a->id}}" id="adminId">
                                            <td>{{$a->name}}</td>
                                            <td>{{$a->email}}</td>
                                            <td>{{$a->gender}}</td>
                                            <td>{{$a->phone}}</td>
                                            <td>{{$a->address}}</td>
                                            <td>
                                                    @if (Auth::user()->id != $a->id)
                                                      {{-- <a href="{{route('admin#changeRole',$a->id)}}" class="me-2">
                                                        <button class="item" data-toggle="tooltip" data-placement="top" title="Change">
                                                        <i class="fa-solid fa-person-circle-minus"></i>
                                                        </button>
                                                    </a> --}}
                                                    <select id="changeRole" class="form-control">
                                                        <option value="admin" @if ($a->role == 'admin') selected @endif>Admin</option>
                                                        <option value="user" @if ($a->role == 'user') selected @endif>User</option>
                                                    </select>
                                                    @endif
                                            </td>
                                            <td>
                                                <div class="table-data-feature">
                                                    @if (Auth::user()->id != $a->id)
                                                    <a href="{{route('admin#delete',$a->id)}}" class="me-2">
                                                            <button class="item" data-toggle="tooltip" data-placement="top" title="Delete">
                                                            <i class="zmdi zmdi-delete"></i>
                                                            </button>
                                                    </a>
                                                    @endif
                                                </div>
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                                <div class="mt-3">

                                    {{$admin->links()}}
                                </div>
                            </div>
                            <!-- END DATA TABLE -->
                        </div>
                    </div>
                </div>
            </div>
            <!-- END MAIN CONTENT-->
@endsection
@section('scriptSection')
        <script>
            $(document).ready(function(){
                $('#changeRole').change(function(){
                    $currentRole = $(this).val();
                    $parentNode = $(this).parents('tr');
                    $id = $parentNode.find('#adminId').val();

                    $.ajax({
                        type : 'get',
                        url : '/admin/ajax/change/role',
                        data : {
                            'adminId' : $id,
                            'role' : $currentRole,
                        },
                        dataType : 'json',

                    })
                    location.reload();
                })
            })
        </script>
@endsection

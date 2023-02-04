@extends('admin.layouts.master')
@section('title','User List Page')
@section('content')
    <!-- MAIN CONTENT-->
            <div class="main-content">
                <div class="section__content section__content--p30">
                    <div class="container-fluid">
                        <div class="col-md-12">
                            @if (session('deleteSuccess'))
                                <div class="col-4 offset-8">
                                <div class="alert alert-warning alert-dismissible fade show" role="alert">
                                    <i class="fa-solid fa-circle-xmark"></i>  {{session('deleteSuccess')}}
                                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                </div>
                                </div>
                            @endif
                                <div class="table-responsive table-responsive-data2">
                                    <h3><i class="fa-solid fa-database"></i> - {{$users->total()}}</h3>
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
                                        </tr>
                                    </thead>
                                    <tbody id="dataList">
                                        @foreach ($users as $user)
                                            <tr class="tr-shadow">
                                                 <td class="col-2">
                                                    @if ($user->image == null)
                                                        @if ($user->gender == 'male')
                                                            <img src="{{asset('image/default_user.jfif')}}" class="img-thumbnail shadow-sm ">
                                                        @else
                                                            <img src="{{asset('image/default_female.jfif')}}" class="img-thumbnail shadow-sm ">
                                                        @endif
                                                        @else
                                                            <img src="{{asset('storage/'.$user->image)}}"/>
                                                    @endif
                                                </td>
                                                <input type="hidden" value="{{$user->id}}" id="userId">
                                                <td>{{$user->name}}</td>
                                                <td>{{$user->email}}</td>
                                                <td>{{$user->gender}}</td>
                                                <td>{{$user->phone}}</td>
                                                <td>{{$user->address}}</td>
                                                <td>
                                                    <select class="form-control statusChange">
                                                        <option value="admin" @if ($user->role == 'admin') selected @endif>Admin</option>
                                                        <option value="user" @if ($user->role == 'user') selected @endif>User</option>
                                                    </select>
                                                </td>
                                                 <td class="col-2">
                                                    <div class="table-data-feature">
                                                        <a href="{{route('admin#userDelete',$user->id)}}">
                                                            <button class="item" data-toggle="tooltip" data-placement="top" title="Delete">
                                                            <i class="zmdi zmdi-delete"></i>
                                                            </button>
                                                        </a>

                                                    </div>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                                <div class="mt-3">
                                    {{$users->links()}}
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
                $('.statusChange').change(function(){
                    $currentStatus = $(this).val();
                    $parentNode = $(this).parents('tr');
                    $userId = $parentNode.find('#userId').val();
                    $data = {'userId' : $userId, 'role' : $currentStatus};

                    $.ajax({
                        type : 'get',
                        url : '/user/change/role',
                        data : $data,
                        dataType : 'json'
                    })
                    location.reload();
                })

            })
        </script>
@endsection

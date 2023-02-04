@extends('admin.layouts.master')
@section('title','Change Role Page')
@section('content')
    <!-- MAIN CONTENT-->
            <div class="main-content">
                <div class="section__content section__content--p30">
                    <div class="container-fluid">

                        <div class="col-lg-10 offset-1">
                            <div class="card">
                                <div class="card-body">
                                    <div class="card-title">
                                        <h3 class="text-center title-2">Change Role</h3>
                                    </div>
                                    <hr>
                                    <form action="{{route('admin#change',$data->id)}}" method="post" enctype="multipart/form-data">
                                        @csrf
                                        <div class="row">
                                            <div class="col-4 offset-1">
                                                @if ($data->image == null)
                                                    @if ($data->gender == 'male')
                                                        <img src="{{asset('image/default_user.jfif')}}" class="img-thumbnail shadow-sm ">
                                                    @else
                                                        <img src="{{asset('image/default_female.jfif')}}" class="img-thumbnail shadow-sm ">
                                                    @endif
                                                @else
                                                    <img src="{{ asset('storage/'.$data->image) }}"
                                                            class="img-thumbnail shadow-sm"/>
                                                @endif
                                                <div class="mt-3">
                                                    <button class="btn bg-dark text-white col-12" type="submit">
                                                        <i class="fa-solid fa-arrow-right me-1"></i>Change
                                                    </button>
                                                </div>
                                            </div>
                                            <div class="row col-6">
                                                <div class="form-group">
                                                    <label class="control-label mb-1">Name</label>
                                                    <input type="text" name="name" value="{{old('name',$data->name)}}" class="form-control" placeholder="Enter Admin Name..." disabled>
                                                </div>

                                                <div class="form-group">
                                                    <label class="control-label mb-1">Role</label>
                                                    <select name="role" class="form-control">
                                                        <option value="admin" @if ($data->role == 'admin') selected @endif>Admin</option> >
                                                        <option value="user" @if ($data->role == 'user') selected @endif>User</option>
                                                    </select>
                                                </div>

                                                <div class="form-group">
                                                    <label class="control-label mb-1">Email</label>
                                                    <input type="email" name="email" value="{{old('email',$data->email)}}" class="form-control" placeholder="Enter Admin Email..." disabled >
                                                </div>


                                                <div class="form-group">
                                                    <label class="control-label mb-1">Phone</label>
                                                    <input type="number" name="phone" value="{{old('phone',$data->phone)}}" class="form-control" placeholder="Enter Admin Phone..." disabled>
                                                </div>


                                                <div class="form-group">
                                                    <label class="control-label mb-1">Gender</label>
                                                    <select name="gender" class="form-control" disabled>
                                                        <option value="">Choose your gender....</option>
                                                        <option value="male" @if ($data->gender == 'male') selected @endif>Male</option>
                                                        <option value="female" @if ($data->gender == 'female') selected @endif>Female</option>
                                                    </select>
                                                </div>

                                                <div class="form-group">
                                                    <label class="control-label mb-1">Address</label>
                                                    <textarea class="form-control" name="address" placeholder="Enter Admin Address..." disabled>{{old('address',$data->address)}}</textarea>
                                                </div>



                                            </div>
                                        </div>

                                    </form>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- END MAIN CONTENT-->

@endsection

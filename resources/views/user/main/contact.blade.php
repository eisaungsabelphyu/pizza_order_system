@extends('user.layouts.master')
@section('content')
    <!-- Shop Start -->
    <div class="container">
        <div class="row">
            <div class="col-lg-8 offset-2">
                @if (session('receiveMessage'))
                    <div class="col-5 offset-7">
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            <i class="fa-solid fa-check"></i>  {{session('receiveMessage')}}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    </div>
                @endif
                <div class="card">
                    <div class="card-body">
                        <div class="card-title">
                            <h3 class="text-center title-2">Contact Us</h3>
                        </div>
                        <hr>
                        <form action="{{route('user#createContact')}}" method="post" >
                            @csrf
                            <div class="form-group">
                                    <label class="form-label">Name</label>
                                    <input class="form-control @error('name') is-invalid @enderror" value="{{old('name')}}" type="text" name="name" placeholder="Enter your name">
                                    @error('name')
                                        <small class="text-danger">{{$message}}</small>
                                    @enderror
                            </div>

                            <div class="mb-3">
                                <label  class="form-label">Email address</label>
                                <input class="form-control @error('email') is-invalid @enderror" value="{{old('email')}}" type="email" name="email" placeholder="Enter your email">
                                    @error('email')
                                        <small class="text-danger">{{$message}}</small>
                                    @enderror
                            </div>

                            <div class="form-group">
                                <label  class="form-label mb-1">Message</label>
                                <textarea name="message" class="form-control @error('message') is-invalid @enderror" cols="30" rows="10" placeholder="Message...">
                                    {{old('message')}}
                                </textarea>
                                 @error('message')
                                    <div class="invalid-feedback">
                                        {{$message}}
                                    </div>
                                @enderror
                            </div>

                            <div>
                                <button  type="submit" class="btn  btn-warning float-end">
                                    Send
                                </button>
                            </div>

                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Shop End -->
@endsection

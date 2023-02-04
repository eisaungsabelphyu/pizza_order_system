@extends('user.layouts.master')
@section('content')
    <div class="row">
        <div class="col-6 offset-3">
            <div class="main-content">
                <div class="section__content section__content--p30">
                    <div class="container-fluid">
                        {{-- <div class="row">
                            <div class="col-3 offset-8">
                                <a href="{{route('category#list')}}"><button class="btn bg-dark text-white my-3">List</button></a>
                            </div>
                        </div> --}}
                        <div class="">
                            <div class="card">
                                <div class="card-body">
                                    <div class="card-title">
                                        <h3 class="text-center title-2">Change Your Password</h3>
                                    </div>
                                    <hr>
                                    @if (session('changeSuccess'))
                                        <div class="col-12">
                                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                                <i class="fa-solid fa-circle-xmark"></i>  {{session('changeSuccess')}}
                                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                            </div>
                                        </div>
                                    @endif
                                    @if (session('notMatch'))
                                        <div class="col-12">
                                            <div class="alert alert-warning alert-dismissible fade show" role="alert">
                                                <i class="fa-solid fa-circle-xmark"></i>  {{session('notMatch')}}
                                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                            </div>
                                        </div>
                                    @endif
                                    <form action="{{route('user#changePassword')}}" method="post" novalidate="novalidate">
                                        @csrf
                                        <div class="form-group">
                                            <label  class="control-label mb-1">Old Password</label>
                                            <input  name="oldPassword" type="password"  class="form-control  @error('oldPassword') is-invalid @enderror" aria-required="true" aria-invalid="false" placeholder="Enter your password...">
                                            @error('oldPassword')
                                                <div class="invalid-feedback">
                                                    {{$message}}
                                                </div>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <label  class="control-label mb-1">New Password</label>
                                            <input  name="newPassword" type="password" class="form-control @error('newPassword') is-invalid @enderror" aria-required="true" aria-invalid="false" placeholder="Enter your password...">
                                            @error('newPassword')
                                                <div class="invalid-feedback">
                                                    {{$message}}
                                                </div>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <label  class="control-label mb-1">Confirm Password</label>
                                            <input  name="confirmPassword" type="password" class="form-control @error('confirmPassword') is-invalid @enderror" aria-required="true" aria-invalid="false" placeholder="Enter your password...">
                                            @error('confirmPassword')
                                                <div class="invalid-feedback">
                                                    {{$message}}
                                                </div>
                                            @enderror
                                        </div>

                                        <div>
                                            <button id="payment-button" type="submit" class="btn btn-lg btn-dark btn-block">
                                                <span id="payment-button-amount">Change Password</span>
                                                {{-- <span id="payment-button-sending" style="display:none;">Sending…</span> --}}
                                                <i class="fa-solid fa-circle-right"></i>
                                            </button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

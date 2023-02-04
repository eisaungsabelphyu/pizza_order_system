@extends('admin.layouts.master')
@section('title','Category Page')
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
                                        <h2 class="title-1">Contact List</h2>

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

                            </div>
                            <div class="row mt-3">
                                <div class="col-2 offset-10 bg-white shadow-sm p-3 text-center">
                                    <h4><i class="fa-solid fa-database"></i> - {{$contact->total()}}</h4>
                                </div>
                            </div>
                            @if (count($contact) != 0)
                                <div class="table-responsive table-responsive-data2">
                                    <table class="table table-data2 text-center">
                                        <thead>
                                            <tr>
                                                <th>Id</th>
                                                <th>Name</th>
                                                <th>Email</th>
                                                <th>Message</th>
                                                <th>Date</th>
                                                <th></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($contact as $c)
                                                <tr class="tr-shadow">
                                                    <td>{{$c->id}}</td>
                                                    <td>{{$c->name}}</td>
                                                    <td>{{$c->email}}</td>
                                                    <td>{{$c->message}}</td>
                                                    <td>{{$c->created_at->format('j-F-Y')}}</td>
                                                    <td>
                                                        <div class="table-data-feature">

                                                            <a href="{{route('admin#contactDelete',$c->id)}}">
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
                                    {{$contact->links()}}
                                </div>
                            </div>
                            @else
                                <h3 class="text-secondary">There is no message from users.</h3>
                            @endif



                            <!-- END DATA TABLE -->
                        </div>
                    </div>
                </div>
            </div>
            <!-- END MAIN CONTENT-->

@endsection

@extends('admin.layouts.master')
@section('title','Update Pizza')
@section('content')
    <!-- MAIN CONTENT-->
            <div class="main-content">
                <div class="section__content section__content--p30">
                    <div class="container-fluid">

                        <div class="col-lg-10 offset-1">
                            <div class="card">
                                <div class="card-body">
                                    <a href="{{route('product#list')}}" class="text-decoration-none text-dark">
                                        <i class="fa-solid fa-arrow-left"></i> back
                                    </a>
                                    <div class="card-title">
                                        <h3 class="text-center title-2">Product Update</h3>
                                    </div>
                                    <hr>
                                    <form action="{{route('product#update')}}" method="post" enctype="multipart/form-data">
                                        @csrf
                                        <div class="row">
                                            <div class="col-4 offset-1">
                                               <img src="{{ asset('storage/'.$pizza->image) }}"/>
                                                <div class="mt-3">
                                                    <input type="file" name="image" class="form-control @error('image') is-invalid @enderror">
                                                    @error('image')
                                                        <div class="invalid-feedback">
                                                            {{$message}}
                                                        </div>
                                                    @enderror
                                                </div>
                                                <input type="hidden" name="pizzaId" value="{{old('pizzaId',$pizza->id)}}">
                                                <div class="mt-3">
                                                    <button class="btn bg-dark text-white col-12" type="submit">
                                                        <i class="fa-solid fa-arrow-right me-1"></i>Update
                                                    </button>
                                                </div>
                                            </div>
                                            <div class="row col-6">
                                                <div class="form-group">
                                                    <label class="control-label mb-1">Pizza Name</label>
                                                    <input type="text" name="pizzaName" value="{{old('pizzaName',$pizza->name)}}" class="form-control @error('pizzaName') is-invalid @enderror" placeholder="Enter Pizza Name...">
                                                    @error('pizzaName')
                                                        <div class="invalid-feedback">
                                                            {{$message}}
                                                        </div>
                                                    @enderror
                                                </div>

                                                <div class="form-group">
                                                    <label class="control-label mb-1">Category</label>
                                                    <select name="pizzaCategory" class="form-control @error('pizzaCategory') is-invalid @enderror">
                                                        <option value="">Choose your category....</option>
                                                        @foreach ($categories as $c)
                                                            <option value="{{$c->id}}" @if ($c->id == $pizza->category_id) selected @endif>{{$c->name }}</option>
                                                        @endforeach
                                                    </select>
                                                    @error('pizzaCategory')
                                                        <div class="invalid-feedback">
                                                            {{$message}}
                                                        </div>
                                                    @enderror
                                                </div>

                                                <div class="form-group">
                                                    <label class="control-label mb-1">Description</label>
                                                    <textarea class="form-control @error('pizzaDescription') is-invalid @enderror" name="pizzaDescription" placeholder="Enter Admin Address...">{{old('pizzaDescription',$pizza->description)}}</textarea>
                                                    @error('pizzaDescription')
                                                        <div class="invalid-feedback">
                                                            {{$message}}
                                                        </div>
                                                    @enderror
                                                </div>

                                                <div class="form-group">
                                                    <label class="control-label mb-1">Price</label>
                                                    <input type="number" name="pizzaPrice" value="{{old('pizzaPrice',$pizza->price)}}" class="form-control @error('pizzaPrice') is-invalid @enderror" placeholder="Enter Pizza Price...">
                                                    @error('pizzaPrice')
                                                        <div class="invalid-feedback">
                                                            {{$message}}
                                                        </div>
                                                    @enderror
                                                </div>

                                                <div class="form-group">
                                                    <label class="control-label mb-1">Waiting Time</label>
                                                    <input type="number" name="pizzaWaitingTime" value="{{old('pizzaWaitingTime',$pizza->waiting_time)}}" class="form-control @error('pizzaWaitingTime') is-invalid @enderror">
                                                    @error('pizzaWaitingTime')
                                                        <div class="invalid-feedback">
                                                            {{$message}}
                                                        </div>
                                                    @enderror
                                                </div>

                                                <div class="form-group">
                                                    <label class="control-label mb-1">View Count</label>
                                                    <input type="number" name="pizzaViewCount" value="{{old('pizzaViewCount',$pizza->view_count)}}" class="form-control " disabled>
                                                </div>

                                                <div class="form-group">
                                                    <label class="control-label mb-1">Created Date</label>
                                                    <input type="text" name="pizzaDate" value="{{$pizza->created_at->format('j-F-Y')}}" class="form-control " disabled>
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

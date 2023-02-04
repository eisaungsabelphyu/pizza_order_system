@extends('admin.layouts.master')
@section('title','Pizza List Page')
@section('content')
    <!-- MAIN CONTENT-->
            <div class="main-content">
                <div class="section__content section__content--p30">
                    <div class="container-fluid">
                        <div class="col-md-12">

                                <a href="{{route('admin#orderList')}}" class="text-dark text-decoration-none"><i class="fa-solid fa-arrow-left"></i> Back</a>

                                <div class="row col-6">
                                    <div class="card mt-4">
                                        <div class="card-header">
                                            <h3><i class="fa-solid fa-clipboard me-2"></i>Order Info </h3>
                                            <small class="text-warning"><i class="fa-solid fa-triangle-exclamation"></i>Include Delivery Charges</small>

                                        </div>
                                        <div class="card-body">
                                            <div class="row mb-2">
                                                <div class="col"><i class="fa-solid fa-user me-2"></i>Name</div>
                                                <div class="col">{{strtoupper($orderList[0]->user_name)}}</div>
                                            </div>
                                            <div class="row mb-2">
                                                <div class="col"><i class="fa-solid fa-barcode me-2"></i>Order Code</div>
                                                <div class="col">{{$orderList[0]->order_code}}</div>
                                            </div>
                                            <div class="row mb-2">
                                                <div class="col"><i class="fa-solid fa-clock me-2"></i>Order Date</div>
                                                <div class="col">{{$orderList[0]->created_at->format('F-j-Y')}}</div>
                                            </div>
                                            <div class="row mb-2">
                                                <div class="col"><i class="fa-solid fa-money-bill-1-wave me-2"></i>Total</div>
                                                <div class="col">{{$order->total_price}}</div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="table-responsive table-responsive-data2">
                                <table class="table table-data2 text-center">
                                    <thead>
                                        <tr>

                                            <th>Order ID</th>
                                            <th>Product Image</th>
                                            <th>Product Name</th>
                                            <th>Order Date</th>
                                            <th>Qty</th>
                                            <th>Amount</th>
                                        </tr>
                                    </thead>
                                    <tbody id="dataList">
                                        @foreach ($orderList as $o)
                                            <tr class="tr-shadow">
                                                <td>{{$o->id}}</td>
                                                <td class="col-2"><img src="{{asset('storage/'.$o->product_image)}}" class="img-thumbnail shadow-sm"></td>
                                                <td>{{$o->product_name}}</td>
                                                <td>{{$o->created_at->format('F-j-Y')}}</td>
                                                <td>{{$o->qty}}</td>
                                                <td>{{$o->total}}</td>
                                            </tr>
                                        @endforeach

                                    </tbody>
                                </table>
                            </div>




                            <!-- END DATA TABLE -->
                        </div>
                    </div>
                </div>
            </div>
            <!-- END MAIN CONTENT-->

@endsection

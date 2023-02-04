@extends('admin.layouts.master')
@section('title','Pizza List Page')
@section('content')
    <!-- MAIN CONTENT-->
            <div class="main-content">
                <div class="section__content section__content--p30">
                    <div class="container-fluid">
                        <div class="col-md-12">
                            <!-- DATA TABLE -->
                            {{-- <div class="table-data__tool">
                                <div class="table-data__tool-left">
                                    <div class="overview-wrap">
                                        <h2 class="title-1">Product List</h2>

                                    </div>
                                </div>
                            </div> --}}
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
                                   <i class="fa-solid fa-check"></i> {{session('updateSuccess')}}
                                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                </div>
                                </div>
                            @endif
                            </div>
                            <form action="{{route('admin#changeStatus')}}" method="get" class="col-5">
                                @csrf

                                <div class="input-group mb-3">
                                    <div class="input-group-text">
                                        <h4><i class="fa-solid fa-database"></i> - {{count($order)}}</h4>
                                    </div>
                                    <select name="orderStatus" class="form-select">
                                        <option value="">All</option>
                                        <option value="0" @if (request('orderStatus') == '0') selected @endif>Pending</option>
                                        <option value="1" @if (request('orderStatus') == '1') selected @endif>Accept</option>
                                        <option value="2" @if (request('orderStatus') == 2) selected @endif>Reject</option>
                                    </select>
                                    <div class="input-group-text">
                                        <button type="submit" class="btn btn-sm bg-dark text-white">Search</button>
                                    </div>
                                </div>
                            </form>

                               @if (count($order) != 0)
                                     <div class="table-responsive table-responsive-data2">
                                <table class="table table-data2 text-center">
                                    <thead>
                                        <tr>
                                            <th>User ID</th>
                                            <th>User Name</th>
                                            <th>Order Date</th>
                                            <th>Order Code</th>
                                            <th>Amount</th>
                                            <th>Status</th>
                                        </tr>
                                    </thead>
                                    <tbody id="dataList">
                                        @foreach ($order as $o)
                                            <tr class="tr-shadow">
                                                <input type="hidden" id="orderId" value="{{$o->id}}">
                                                <td>{{$o->user_id}}</td>
                                                <td>{{$o->user_name}}</td>
                                                <td>{{$o->created_at->format('F-j-Y')}}</td>
                                                <td><a href="{{route('admin#listInfo',$o->order_code)}}" class="text-primary text-decoration-none">{{$o->order_code}}</a></td>
                                                <td>{{$o->total_price}}</td>
                                                <td>
                                                    <select name="status" class="form-control statusChange">
                                                        <option value="0" @if ($o->status == 0) selected @endif>Pending</option>
                                                        <option value="1" @if ($o->status == 1) selected @endif>Accept</option>
                                                        <option value="2" @if ($o->status == 2) selected @endif>Reject</option>
                                                    </select>
                                                </td>
                                        </tr>
                                        @endforeach

                                    </tbody>
                                </table>
                            </div>
                               @else
                                 <h3 class="text-secondary">There is no order.</h3>

                               @endif
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
        // $('#orderStatus').change(function(){
        //     $status = $('#orderStatus').val();

        //     $.ajax({
        //         type : 'get',
        //         url : 'http://127.0.0.1:8000/order/ajax/status',
        //         data : {'status' : $status},
        //         dataType : 'json',
        //         success : function(response){

        //             $list = '';

        //             for($i=0;$i<response.length;$i++){

        //                 $months = ['January','February','March','April','May','June','July','August','September','October','November','December'];
        //                 $date = new Date(response[$i].created_at);
        //                 $finalDate = $months[$date.getMonth()] +"-"+ $date.getDate() +"-"+ $date.getFullYear();

        //                 if(response[$i].status == 0){
        //                     $statusMessage = `
        //                         <select name="status" class="form-control statusChange">
        //                             <option value="0" selected>Pending</option>
        //                             <option value="1">Accept</option>
        //                             <option value="2">Reject</option>
        //                         </select>
        //                     `;
        //                 }else if(response[$i].status == 1){
        //                      $statusMessage = `
        //                         <select name="status" class="form-control statusChange">
        //                             <option value="0">Pending</option>
        //                             <option value="1" selected>Accept</option>
        //                             <option value="2">Reject</option>
        //                         </select>
        //                     `;
        //                 }else if(response[$i].status == 2){
        //                     $statusMessage = `
        //                         <select name="status" class="form-control statusChange">
        //                             <option value="0">Pending</option>
        //                             <option value="1">Accept</option>
        //                             <option value="2" selected>Reject</option>
        //                         </select>
        //                     `;
        //                 }

        //                 $list +=`
        //                     <tr class="tr-shadow">
        //                                         <input type="hidden" id="orderId" value="{{$o->id}}">
        //                                         <td>${response[$i].user_id}</td>
        //                                         <td>${response[$i].user_name}</td>
        //                                         <td>${$finalDate}</td>
        //                                         <td>${response[$i].order_code}</td>
        //                                         <td>${response[$i].total_price}</td>
        //                                         <td>${$statusMessage}</td></td>
        //                                 </tr>
        //                 `;
        //             }
        //             $('#dataList').html($list);
        //         }

        //     })
        // })

        //status change
        $('.statusChange').change(function(){
            $status = $(this).val();
            $parentNode = $(this).parents('tr');
            $orderId = $parentNode.find('#orderId').val();

            $data = {'orderId' : $orderId,'status' : $status};

            $.ajax({
                type : 'get',
                url : '/order/ajax/status/change',
                data : $data,
                dataType : 'json',
                success : function(){

                }
            });
        })
    })
</script>

@endsection

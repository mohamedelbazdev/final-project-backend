@extends('admin.admin_master')

@section('admin')
    <?php
    $pull = 'float-left';
    ?>
    <ol class="breadcrumb">
        <li class="breadcrumb-item {{ $pull }}"><a href="{{ URL::to('/dashboard') }}"> Home</a></li>
        <li class="breadcrumb-item {{ $pull }}"><a href="{{ URL::to('/orders') }}"> orders</a></li>
        <li class="breadcrumb-item active {{ $pull }}">order DataTable</li>
    </ol>
    <div class="card">
        <div class="card-body">
            <h4 class="card-title">Orders</h4>
            <!-- <p class="card-description"><code>Payments</code>
            </p> -->
            <div class="table-responsive">
                <table class="table table-hover">
                    <thead>
                    
                        <tr>
                            <th>User</th>
                            <th>Provider</th>
                            <th>Description</th>
                            <th>Order Status</th>
                            <th>Total Amount</th>
                            <th>hours</th>
                            <th>Stripe Code</th>
                            <th>excuted Time</th>


                        </tr>
                    </thead>
                   
                    <tbody>
                        @foreach ($orders as $key => $order)
                            <tr>
                                <td>{{$order->user->name}}</td>
                                <td>{{$order->provider->name}}</td>
                                <!-- <td class="text-danger"> 28.76% <i class="mdi mdi-arrow-down"></i></td> -->
                                <td>{{ $order->description }}</td>
                                
                                <!-- <td>
                                @if ($order->status==0)
                                <span class="badge badge-success">Pending</span>
                                elseif ($order->status==1)
                                <span class="badge badge-success">Accepted</span>
                                else
                                <span class="badge badge-danger">Refused</span>
                                @endif
                                </td> -->
                                <td style="width: 50%">
                                @if ($order->status==0)
                                <span class="badge badge-warning">Pendinng</span>
                                @elseif ($order->status==1)
                                <span class="badge badge-success">Accepted</span>
                                @else
                                <span class="badge badge-danger">Refused</span>
                                @endif
                            </td>
                                
                                <td>{{ $order->total_amount }}</td>
                                <td>{{ $order->hours }}</td>
                                <td>1561564545454</td>
                                <td>{{$order->executed_at}}</td>
                            </tr>
                        @endforeach

                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection

@extends('admin.admin_master')

@section('admin')
    <?php
    $pull = 'float-left';
    ?>
    <ol class="breadcrumb">
        <li class="breadcrumb-item {{ $pull }}"><a href="{{ URL::to('/dashboard') }}"> Home</a></li>
        <!-- <li class="breadcrumb-item {{ $pull }}"><a href="{{ URL::to('/payments') }}"> Payments</a></li> -->
        <li class="breadcrumb-item active {{ $pull }}">Payments DataTable</li>
    </ol>
    <div class="card">
        <div class="card-body">
            <h4 class="card-title">Payments Table</h4>
            <p class="card-description"><code>Payments</code>
            </p>
            <div class="table-responsive">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>User</th>
                            <th>Provider</th>
                            <th>Total Amount</th>
                            <th>currency</th>
                            <th>source</th>
                            <th>description</th>
                            <th>strip_id</th>


                        </tr>
                    </thead>
                    <tbody>
                    @foreach ($payments as $key => $payment)
                        <tr>
                            <td>{{$payment->order->user->name}}</td>
                            <td>{{$payment->order->provider->name}}</td>
                           <td>{{$payment->amount}}</td>
                            <td>{{$payment->currency}}</td>
                            <td>{{\Illuminate\Support\Str::limit($payment->source,10)}}</td>
                            <td>{{\Illuminate\Support\Str::limit($payment->description,10)}}</td>
                            <td>{{$payment->strip_id}}</td>
                        </tr>
                      
                       
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection

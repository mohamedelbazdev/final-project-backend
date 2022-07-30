@extends('admin.admin_master')

@section('admin')
    <?php
    $pull = 'float-left';
    ?>
    <ol class="breadcrumb">
        <li class="breadcrumb-item {{ $pull }}"><a href="{{ URL::to('/dashboard') }}"> Home</a></li>
        <li class="breadcrumb-item {{ $pull }}"><a href="{{ URL::to('/payments') }}"> Payments</a></li>
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
                            <th>Order</th>
                            <th>Order Status</th>
                            <th>Total Amount</th>
                            <th>PaymentDate</th>
                            <th>Stripe Code</th>


                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>Jacob</td>
                            <td>Photoshop</td>
                            <td class="text-danger"> 28.76% <i class="mdi mdi-arrow-down"></i></td>
                            <td><label class="badge badge-danger">Pending</label></td>
                            <td>1450</td>
                            <td>25-07-2022</td>
                            <td>1561564545454</td>
                        </tr>
                        <tr>
                            <td>Messsy</td>
                            <td>Flash</td>
                            <td class="text-danger"> 21.06% <i class="mdi mdi-arrow-down"></i></td>
                            <td><label class="badge badge-warning">In progress</label></td>
                            <td>1450</td>
                            <td>25-07-2022</td>
                            <td>1561564545454</td>
                        </tr>
                        <tr>
                            <td>John</td>
                            <td>Premier</td>
                            <td class="text-danger"> 35.00% <i class="mdi mdi-arrow-down"></i></td>
                            <td><label class="badge badge-info">Fixed</label></td>
                            <td>1450</td>
                            <td>25-07-2022</td>
                            <td>1561564545454</td>
                        </tr>
                        <tr>
                            <td>Peter</td>
                            <td>After effects</td>
                            <td class="text-success"> 82.00% <i class="mdi mdi-arrow-up"></i></td>
                            <td><label class="badge badge-success">Completed</label></td>
                            <td>1450</td>
                            <td>25-07-2022</td>
                            <td>1561564545454</td>
                        </tr>
                        <tr>
                            <td>Dave</td>
                            <td>53275535</td>
                            <td class="text-success"> 98.05% <i class="mdi mdi-arrow-up"></i></td>
                            <td><label class="badge badge-warning">In progress</label></td>
                            <td>1450</td>
                            <td>25-07-2022</td>
                            <td>1561564545454</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection

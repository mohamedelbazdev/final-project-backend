@extends('admin.admin_master')
@section('admin')
    <?php
    $pull = 'float-left';
    ?>
    <ol class="breadcrumb">
        <li class="breadcrumb-item {{ $pull }}"><a href="{{ URL::to('/dashboard') }}"> Home</a></li>
        <li class="breadcrumb-item {{ $pull }}"><a href="{{ URL::to('/contact-us') }}">ContactUs Table
            </a></li>
        <li class="breadcrumb-item active {{ $pull }}">ContactUs DataTable</li>
    </ol>
    <div class="card">
        <div class="card-body">
            <h4 class="card-title"> ContactUs Table</h4>
            <p class="card-description"><code>
                    <h4 class="card-title"> ContactUs</h4>
                </code>
            </p>
            <div class="table-responsive">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Phone</th>
                            <th>Subject</th>
                            <th>Message</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($data as $item)
                            <tr>
                                <td><strong>Name: </strong>{{ $item->name }} <br></td>
                                <td><strong>Email: </strong>{{ $item->email }} <br></td>
                                <td><strong>Phone: </strong>{{ $item->phone }} <br></td>
                                <td><strong>Subject: </strong>{{ $item->subject }} <br>
                                </td>
                                <td> <strong>Message: </strong>{{ $item->message }} <br><br>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection

@extends('admin.admin_master')
@section('admin')
    @foreach ($data as $item)
        <h2>Hey, It's me {{ $item->name }}</h2>
        <br>

        <strong>User details: </strong><br>
        <strong>Name: </strong>{{ $item->name }} <br>
        <strong>Email: </strong>{{ $item->email }} <br>
        <strong>Phone: </strong>{{ $item->phone }} <br>
        <strong>Subject: </strong>{{ $item->subject }} <br>
        <strong>Message: </strong>{{ $item->user_query }} <br><br>

        Thank you
    @endforeach
@endsection

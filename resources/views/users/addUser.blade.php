@extends('layouts.master')
@section('css')
    <!--  Owl-carousel css-->
    <link href="{{ URL::asset('assets/plugins/owl-carousel/owl.carousel.css') }}" rel="stylesheet" />
    <!-- Maps css -->
    <link href="{{ URL::asset('assets/plugins/jqvmap/jqvmap.min.css') }}" rel="stylesheet">
@endsection
@section('page-header')
@endsection
@section('content')
    <div class="card-body">
        <div class="main-content-label mg-b-5">
            Add New User
        </div>
        <p class="mg-b-20">create new user account</p>
        <div class="pd-30 pd-sm-40 bg-gray-200">
            <div class="row row-xs align-items-center mg-b-20">
                <div class="col-md-4">
                    <label class="form-label mg-b-0">Name</label>
                </div>
                <div class="col-md-8 mg-t-5 mg-md-t-0">
                    <input class="form-control" placeholder="Enter your firstname" type="text">
                </div>
            </div>
            <div class="row row-xs align-items-center mg-b-20">
                <div class="col-md-4">
                    <label class="form-label mg-b-0">address</label>
                </div>
                <div class="col-md-8 mg-t-5 mg-md-t-0">
                    <input class="form-control" placeholder="Enter your address" type="text">
                </div>
            </div>
            <div class="row row-xs align-items-center mg-b-20">
                <div class="col-md-4">
                    <label class="form-label mg-b-0">Email</label>
                </div>
                <div class="col-md-8 mg-t-5 mg-md-t-0">
                    <input class="form-control" placeholder="Enter your email" type="email">
                </div>
            </div>
            <button class="btn btn-main-primary pd-x-30 mg-r-5 mg-t-5">Add New User</button>
            <button class="btn btn-dark pd-x-30 mg-t-5">Cancel</button>
        </div>
    </div>
@endsection
@section('js')
    <!--Internal  Chart.bundle js -->
    <script src="{{ URL::asset('assets/plugins/chart.js/Chart.bundle.min.js') }}"></script>
    <!-- Moment js -->
    <script src="{{ URL::asset('assets/plugins/raphael/raphael.min.js') }}"></script>
    <!--Internal  Flot js-->
    <script src="{{ URL::asset('assets/plugins/jquery.flot/jquery.flot.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/jquery.flot/jquery.flot.pie.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/jquery.flot/jquery.flot.resize.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/jquery.flot/jquery.flot.categories.js') }}"></script>
    <script src="{{ URL::asset('assets/js/dashboard.sampledata.js') }}"></script>
    <script src="{{ URL::asset('assets/js/chart.flot.sampledata.js') }}"></script>
    <!--Internal Apexchart js-->
    <script src="{{ URL::asset('assets/js/apexcharts.js') }}"></script>
    <!-- Internal Map -->
    <script src="{{ URL::asset('assets/plugins/jqvmap/jquery.vmap.min.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/jqvmap/maps/jquery.vmap.usa.js') }}"></script>
    <script src="{{ URL::asset('assets/js/modal-popup.js') }}"></script>
    <!--Internal  index js -->
    <script src="{{ URL::asset('assets/js/index.js') }}"></script>
    <script src="{{ URL::asset('assets/js/jquery.vmap.sampledata.js') }}"></script>
@endsection

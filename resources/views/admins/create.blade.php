@extends('admin.admin_master')
@section('admin')

<?php
        $pull = "float-left";
        ?>
    <ol class="breadcrumb">
        <li class="breadcrumb-item {{$pull}}"><a href="{{URL::to('/dashboard')}}"> Home</a></li>
        <li class="breadcrumb-item {{$pull}}"><a href="{{URL::to('/admins')}}"> Admins</a></li>
        <li class="breadcrumb-item active {{$pull}}">Create Admin</li> 
    </ol>
    <div class="content-wrapper">
     
       <div class="col-md-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Add Admin</h4>

                    <form class="forms-sample" method="POST" action="{{ route('admins.store') }}"
                        enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <label class="form-label mg-b-0">Name</label>
                            <input class="form-control" name="name" type="text" placeholder="Enter your firstname"
                                type="text">
                                @error('name')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror

                        </div>

                        <div class="form-group">
                            <label class="form-label mg-b-0">Password</label>
                            <input class="form-control" name="password" type="password" placeholder="Enter your password">

                            @error('password')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                       
                        <div class="form-group">
                            <label class="form-label mg-b-0">Email</label>
                            <input class="form-control" name="email" type="text" placeholder="Enter your email"
                                type="text">
                                @error('email')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label class="form-label mg-b-0">Image</label>
                            <input class="form-control" type="file" name="image">
                            @error('image')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label class="form-label mg-b-0">Mobile Number</label>
                            <input class="form-control" name="mobile" type="text"
                                placeholder="Enter your Mobile Number">
                                @error('mobile')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                        </div>
                        <div id="map" style="width:100%;height:400px;"></div>
                        <input type="hidden" id="text-map" name="map" value="30.071265, 31.021114">

                        <button type="submit" class="btn btn-primary mr-2 m-2">Submit</button>

                    </form>
                </div>
            </div>
        </div>
        <script>
            function initMap() {
                var latlng = new google.maps.LatLng(30.071265, 31.021114);

                var map = new google.maps.Map(document.getElementById('map'), {
                    center: latlng,
                    zoom: 11,
                    mapTypeId: google.maps.MapTypeId.ROADMAP
                });
                var marker = new google.maps.Marker({
                    position: latlng,
                    map: map,
                    title: 'Set lat/lon values for this property',
                    draggable: true,
                });
                google.maps.event.addListener(marker, 'dragend', function(event) {
                    console.log(event);
                    console.log(event.latLng);
                    document.getElementById('text-map').value = event.latLng.lat() + ',' + event.latLng.lng();
                    // bingo!
                    // a.latLng contains the co-ordinates where the marker was dropped
                });
            }
            window.initMap = initMap;
        </script>

        <script type="text/javascript"
            src="https://maps.google.com/maps/api/js?key={{ env('GOOGLE_MAP_KEY') }}&callback=initMap"></script>
   
            @endsection

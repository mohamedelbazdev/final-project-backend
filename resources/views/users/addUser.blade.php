@extends('admin.admin_master')
@section('admin')
    <div class="content-wrapper">
        <!-- <div class="row">
                                                                                                                                                                                                                                                                                                                                                                <div class="col-12 grid-margin stretch-card">
                                                                                                                                                                                                                                                                                                                                                                    <div class="card corona-gradient-card">
                                                                                                                                                                                                                                                                                                                                                                        <div class="card-body py-0 px-0 px-sm-3">
                                                                                                                                                                                                                                                                                                                                                                            <div class="row align-items-center">
                                                                                                                                                                                                                                                                                                                                                                                <div class="col-4 col-sm-3 col-xl-2">
                                                                                                                                                                                                                                                                                                                                                                                    <img src="{{ asset('backend/assets/images/dashboard/Group126@2x.png') }}"
                                                                                                                                                                                                                                                                                                                                                                                        class="gradient-corona-img img-fluid" alt="">
                                                                                                                                                                                                                                                                                                                                                                                </div>
                                                                                                                                                                                                                                                                                                                                                                                <div class="col-5 col-sm-7 col-xl-8 p-0">
                                                                                                                                                                                                                                                                                                                                                                                    <h4 class="mb-1 mb-sm-0">create new user account </h4>

                                                                                                                                                                                                                                                                                                                                                                                </div>
                                                                                                                                                                                                                                                                                                                                                                                <div class="col-3 col-sm-2 col-xl-2 pl-0 text-center">
                                                                                                                                                                                                                                                                                                                                                                                    <span>
                                                                                                                                                                                                                                                                                                                                                                                        <a href=" {{ url('/') }} " target="_blank"
                                                                                                                                                                                                                                                                                                                                                                                            class="btn btn-outline-light btn-rounded get-started-btn">Visit Fontend ? </a>
                                                                                                                                                                                                                                                                                                                                                                                    </span>
                                                                                                                                                                                                                                                                                                                                                                                </div>
                                                                                                                                                                                                                                                                                                                                                                            </div>
                                                                                                                                                                                                                                                                                                                                                                        </div>
                                                                                                                                                                                                                                                                                                                                                                    </div>
                                                                                                                                                                                                                                                                                                                                                                </div>
                                                                                                                                                                                                                                                                                                                                                            </div> -->



        <div class="col-md-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Add User</h4>

                    <form class="forms-sample" method="POST" action="{{ route('user.store') }}"
                        enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <label class="form-label mg-b-0">Name</label>
                            <input class="form-control" name="name" type="text" placeholder="Enter your firstname"
                                type="text" value="{{ old('name') }}">
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
                            <label class="form-label mg-b-0">Mobile Number</label>
                            <input class="form-control" name="mobile" type="text" placeholder="Enter your Mobile Number"
                                value="{{ old('mobile') }}">
                        </div>
                        @error('mobile')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror


                        <div class="form-group">
                            <label class="form-label mg-b-0">Email</label>
                            <input class="form-control" name="email" type="text" placeholder="Enter your email"
                                type="text" value="{{ old('email') }}">
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
                        <div id="map" style="width:100%;height:400px;"></div>
                        <input type="hidden" id="text-map" name="map" value="30.071265,31.021114">

                        <button type="submit" class="btn btn-primary mr-2">Submit</button>

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

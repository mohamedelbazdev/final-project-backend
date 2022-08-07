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
                    <h4 class="card-title">Edit User</h4>

                    {!! Form::open([
                        'route' => ['user.update', $user->id],
                        'method' => 'PUT',
                        'enctype' => 'multipart/form-data',
                    ]) !!}
                    @csrf
                    <div class="form-group">
                        <label class="form-label mg-b-0">Name</label>
                        <input class="form-control" name="name" type="text" placeholder="Enter your firstname"
                            type="text" value="{{ $user->name }}">
                        @error('name')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror


                    </div>

                    <div class="form-group">
                        <label class="form-label mg-b-0">Password</label>
                        <input class="form-control" name="password" type="password" placeholder="Enter your password"
                            value="{{ old('password') }}">
                        @error('password')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror

                    </div>
                    <div class="form-group">
                        <label class="form-label mg-b-0">Mobile Number</label>
                        <input class="form-control" name="mobile" type="text" placeholder="Enter your Mobile Number"
                            value="{{ $user->mobile }}">
                    </div>
                    @error('mobile')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror


                    <div class="form-group">
                        <label class="form-label mg-b-0">Email</label>
                        <input class="form-control" name="email" type="text" placeholder="Enter your email"
                            type="text" value="{{ $user->email }}">
                        @error('email')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror

                    </div>
                    <div class="col-lg-6">
                        <div class="form-group"
                            style="position:relative;
                                    padding:0;
                                    margin-bottom: 10px;">
                            <label class="form-control-label">Image: <span class="tx-danger">*</span></label>
                            <label for="exampleInputName1">Old Image</label>
                            <img src="{{ URL::to($user->image) }}" style="width: 70px; height: 50px;">
                            <input type="hidden" name="oldimage" value="{{ $user->image }}">
                            <input class="form-control" type="file"class="custom-file-input" name="image"
                                onchange="readURL(this);"
                                style=" height:40px;
                                        margin-bottom:25px;
                                        padding-left:30px;">
                            <span class="custom-file-control"></span>
                            <img src="#" id="one">
                            @error('image')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror

                        </div>
                    </div>



                    <div id="map" style="width:100%;height:400px;margin-bottom:20px;"></div>
                    <input type="hidden" id="text-map" name="map" value="30.071265, 31.021114" />


                    <button type="submit" class="btn btn-primary mr-2">Submit</button>

                    </form>
                </div>
            </div>
        </div>

        {{-- <script>
            function myMap() {
                var mapProp = {
                    center: new google.maps.LatLng(51.508742, -0.120850),
                    zoom: 5,
                };
                var map = new google.maps.Map(document.getElementById("googleMap"), mapProp);
            }
        </script> --}}

        {{-- <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBeiDt8Y-GYYRyUvMauJE3fP-tzm8pWwEM&callback=myMap">
        </script> --}}

        {{-- <script type="text/javascript">
            function initMap() {
                const myLatLng = {
                    lat: 22.2734719,
                    lng: 70.7512559
                };
                const map = new google.maps.Map(document.getElementById("map"), {
                    zoom: 5,
                    center: myLatLng,
                });

                new google.maps.Marker({
                    position: myLatLng,
                    map,
                    title: "Hello Rajkot!",
                });
            }

            window.initMap = initMap;
        </script> --}}
        <script>
            function initMap() {
                let lat = {{ $user->lat }}
                let lng = {{ $user->lng }}
                var latlng = new google.maps.LatLng(lat, lng);

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
        <script type="text/javascript">
            function readURL(input) {
                if (input.files && input.files[0]) {
                    var reader = new FileReader();
                    reader.onload = function(e) {
                        $('#one')
                            .attr('src', e.target.result)
                            .width(80)
                            .height(80);
                    };
                    reader.readAsDataURL(input.files[0]);
                }
            }
        </script>

        <script type="text/javascript"
            src="https://maps.google.com/maps/api/js?key={{ env('GOOGLE_MAP_KEY') }}&callback=initMap"></script>
    @endsection

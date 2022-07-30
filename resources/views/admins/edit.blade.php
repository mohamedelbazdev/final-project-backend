@extends('admin.admin_master')
@section('admin')
    <div class="content-wrapper">
       
        <div class="col-md-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Edit Admin</h4>

                    {!! Form::open([
                        'route' => ['admins.update', $user->id],
                        'method' => 'PUT',
                        'enctype' => 'multipart/form-data',
                    ]) !!}
                    @csrf

                    <div class="form-group">
                        <label class="form-label mg-b-0">Name</label>
                        <input class="form-control" name="name" type="text" placeholder="Enter your firstname"
                            type="text" value="{{ $user->name }}">


                    </div>


                    <div class="form-group">
                        <label class="form-label mg-b-0">Email</label>
                        <input class="form-control" name="email" type="text" placeholder="Enter your email"
                            type="text" value="{{ $user->email }}">

                    </div>
                    <div class="form-group">
                        <label class="form-label mg-b-0">Image</label>
                        <div class="form-group col-md-6">
                            <label for="exampleInputName1">Old Image</label>
                            <img src="{{ URL::to($user->image) }}" style="width: 70px; height: 50px;">
                            <input type="hidden" name="oldimage" value="{{ $user->image }}">
                        </div>
                        <input class="form-control" type="file" name="image">

                    </div>
                    <div class="form-group">
                        <label class="form-label mg-b-0">Mobile Number</label>
                        <input class="form-control" name="mobile" type="text" placeholder="Enter your Mobile Number">
                    </div>

                    <div id="map" style="width:100%;height:400px;"></div>
                    <input type="hidden" id="text-map" name="map" value="">


                    <button type="submit" class="btn btn-primary mr-2">Submit</button>

                    </form>
                </div>
            </div>
        </div>
        <script>
            function initMap() {
                var latlng = new google.maps.LatLng(51.4975941, -0.0803232);

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

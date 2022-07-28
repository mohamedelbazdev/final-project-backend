@extends('admin.admin_master')
@section('admin')
        <?php
        $pull = "float-left";
        ?>
    <ol class="breadcrumb">
        <li class="breadcrumb-item {{$pull}}"><a href="{{URL::to('/dashboard')}}"> Home</a></li>
        <li class="breadcrumb-item {{$pull}}"><a href="{{URL::to('/provider')}}"> Providers</a></li>
        <li class="breadcrumb-item active {{$pull}}">Create Provider</li> 
    </ol>
        <div class="col-md-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Add new Provider</h4>

                    {!! Form::open(['route' => 'provider.store', 'method' => 'POST', 'enctype' => 'multipart/form-data']) !!}
                            @csrf
                            
                                    <div class="form-group">
                                <label class="form-label mg-b-0">Name</label>
                                <input class="form-control" name="name" type="text" placeholder="Enter your firstname"
                                    type="text" value="">


                            </div>

                            <div class="form-group">
                        <label class="form-label mg-b-0">Email</label>
                        <input class="form-control" name="email" type="text" placeholder="Enter your email"
                            type="text" value="">

                    </div>

                    <div class="form-group">
                        <label class="form-label mg-b-0">Image</label>
                        <input class="form-control" type="file" name="image">

                    </div>


                          

                        <div class="form-group">
                                <label for="categories"> Category</label>
                            {{ Form::select('category_id',$categories, null, ['class'=>'form-control select2','id'=>'category_id']) }}
                            @if($errors->has('category_id'))
                                 <span class="text-danger">{{$errors->first('category_id')}}</span>
                             @endif
                        </div>

                       

                        <div class="form-group">
                            <label for="exampleFormControlSelect2">Description</label>
                            <input name="description" class="form-control" placeholder="Enter Provider Description" type="textarea">
                            @if($errors->has('description'))
                                 <span class="text-danger">{{$errors->first('description')}}</span>
                             @endif
                        </div>

                        <div class="form-group">
                            <label for="exampleFormControlSelect2">Price</label>
                            <input name="price" class="form-control" placeholder="Enter Provider Price" type="textarea">
                            @if($errors->has('price'))
                                 <span class="text-danger">{{$errors->first('price')}}</span>
                             @endif
                        </div>
                        <div id="map" style="width:100%;height:400px;"></div>
                    <input type="hidden" id="text-map" name="map" value="">


                        <button class="btn btn-primary mr-2 pd-x-30 mg-r-5 mg-t-5">Add Provider</button>
                                   
                    {!! Form::close() !!}
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

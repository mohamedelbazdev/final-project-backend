@extends('admin.admin_master')
@section('admin')
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>


    <div class="content-wrapper">
        <div class="row">
            <div class="col-12 grid-margin stretch-card">
                <div class="card corona-gradient-card">
                    <div class="card-body py-0 px-0 px-sm-3">
                        <div class="row align-items-center">
                            <div class="col-4 col-sm-3 col-xl-2">
                                <img src="{{ asset('backend/assets/images/dashboard/Group126@2x.png') }}"
                                    class="gradient-corona-img img-fluid" alt="">
                            </div>
                            <div class="col-5 col-sm-7 col-xl-8 p-0">
                                <h4 class="mb-1 mb-sm-0">Welcome to Easy News </h4>

                            </div>
                            <div class="col-3 col-sm-2 col-xl-2 pl-0 text-center">
                                <span>
                                    <a href=" {{ url('/') }} " target="_blank"
                                        class="btn btn-outline-light btn-rounded get-started-btn">Vist Fontend ? </a>
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>



        <div class="col-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Profile Update </h4>

                    <form class="forms-sample" action="{{ route('profile.store') }}" method="post"
                        enctype="multipart/form-data">
                        @csrf


                        <div class="form-group">
                            <label for="exampleInputName1">User Name </label>
                            <input type="text" class="form-control" id="exampleInputName1" name="name"
                                value="{{ $editData->name }}">
                        </div>


                        <div class="form-group">
                            <label for="exampleInputName1">User Email </label>
                            <input type="email" class="form-control" id="exampleInputName1" name="email"
                                value="{{ $editData->email }}">
                        </div>

                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label class="form-label mg-b-0">Image</label>
                                    <div class="form-group col-md-6">
                                        <label for="exampleInputName1">Old Image</label>
                                        <img src="{{ URL::to($editData->image) }}" style="width: 70px; height: 50px;">
                                        <input type="hidden" name="oldimage" value="{{ $editData->image }}">
                                    </div>
                                    <input class="form-control" type="file" name="image">

                                </div>


                            </div>

                        </div>

                </div>



                <button type="submit" class="btn btn-primary mr-2">Submit</button>

                </form>
            </div>
        </div>
    </div>

    <script type="text/javascript">
        $(document).ready(function() {
            $('#image').change(function(e) {
                var reader = new FileReader();
                reader.onload = function(e) {
                    $('#showImage').attr('src', e.target.result);
                }
                reader.readAsDataURL(e.target.files['0']);
            });
        });
    </script>
@endsection

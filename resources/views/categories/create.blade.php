@extends('admin.admin_master')
@section('admin')
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


@section('content')
    <div class="card-body">
        <div class="main-content-label mg-b-5">
            Add New Category
        </div>
        <p class="mg-b-20">create new category</p>
        {!! Form::open(['route' => 'category.store', 'method' => 'POST', 'enctype' => 'multipart/form-data']) !!}
                
            <div class="pd-30 pd-sm-40 bg-gray-200">
                <div class="row row-xs align-items-center mg-b-20">
                    <div class="col-md-4">
                        <label class="form-label mg-b-0">Name</label>
                    </div>
                    <div class="col-md-8 mg-t-5 mg-md-t-0">
                        <input name="name" class="form-control" placeholder="Enter Category Name" type="text">
                        @if($errors->has('name'))
                                    <div class="alert alert-danger">{{$errors->first('name')}}</div>
                        @endif
                    </div>
                </div>
                
                <div class="form-group row row-xs align-items-center mg-b-20">
                    <div class="col-md-4">
                                    <label for="file" class="form-label mg-b-0">Image</label> 
                    </div>
                    <div class="col-md-8 mg-t-5 mg-md-t-0 custom-file">
                                        <input type="file" name="image" class="form-control">  

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
            
                <button class="btn btn-main-primary pd-x-30 mg-r-5 mg-t-5">Add Category</button>
                <button class="btn btn-dark pd-x-30 mg-t-5">Cancel</button>
            </div>

        {!! Form::close() !!}
    </div>
@endsection


        </div>



        <div class="col-md-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Add Category</h4>

                    <form class="forms-sample" method="POST" action="">
                        @csrf
                        <div class="form-group">
                            <label for="exampleInputUsername1">Category English</label>
                            <input type="text" class="form-control" name="category_en" placeholder="Category English">

                            @error('category_en')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="exampleInputEmail1">Category Arabic</label>
                            <input type="text" class="form-control" name="category_ar" placeholder="Category Arabic">
                            @error('category_ar')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <button type="submit" class="btn btn-primary mr-2">Submit</button>

                    </form>
                </div>
            </div>
        </div>
    @endsection


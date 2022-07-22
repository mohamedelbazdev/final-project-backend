@extends('layouts.master')

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
                    </div>
                </div>
                <div class="form-group row row-xs align-items-center mg-b-20">
                    <div class="col-md-4">
                                    <label for="file" class="form-label mg-b-0">Image</label> 
                    </div>
                    <div class="col-md-8 mg-t-5 mg-md-t-0 custom-file">
                                        <input type="file" name="image" class="form-control">  
                    </div>
                </div>
            
                <button class="btn btn-main-primary pd-x-30 mg-r-5 mg-t-5">Add Category</button>
                <button class="btn btn-dark pd-x-30 mg-t-5">Cancel</button>
            </div>
        {!! Form::close() !!}
    </div>
@endsection


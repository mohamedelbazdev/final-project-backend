@extends('layouts.master')

@section('content')
    <div class="card-body">
        <div class="main-content-label mg-b-5">
            Add New Provider
        </div>
        <p class="mg-b-20">create new Provider</p>
        <div class="pd-30 pd-sm-40 bg-gray-200">
            <div class="row row-xs align-items-center mg-b-20">
                <div class="col-md-4">
                    <label class="form-label mg-b-0">Name</label>
                </div>
                <div class="col-md-8 mg-t-5 mg-md-t-0">
                    <input class="form-control" placeholder="Enter Provider Name" type="text">
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
            <div class="form-group row row-xs align-items-center mg-b-20">
                <div class="col-md-4">
                <label for="file" class="form-label mg-b-0">Description</label> 
                </div>
                <div class="col-md-8 mg-t-5 mg-md-t-0">
                    <input class="form-control" placeholder="Enter Provider Description" type="textarea">
                </div>
            </div>

            <div class="row row-xs align-items-center mg-b-20">
                <div class="col-md-4">
                    <label class="form-label mg-b-0">Price</label>
                </div>
                <div class="col-md-8 mg-t-5 mg-md-t-0">
                    <input class="form-control" placeholder="Enter Provider Price" type="text">
                </div>
            </div>
           
            <button class="btn btn-main-primary pd-x-30 mg-r-5 mg-t-5">Add Provider</button>
            <button class="btn btn-dark pd-x-30 mg-t-5">Cancel</button>
        </div>
    </div>
@endsection


@extends('admin.admin_master')
@section('admin')
        <?php
         $pull = "float-left";
        ?>
    <ol class="breadcrumb">
        <li class="breadcrumb-item {{$pull}}"><a href="{{URL::to('/dashboard')}}"> Home</a></li>
        <li class="breadcrumb-item {{$pull}}"><a href="{{URL::to('/category')}}"> categories</a></li>
        <li class="breadcrumb-item active {{$pull}}">Create category</li> 
    </ol>
    <!-- <div class="content-wrapper"> -->
       <div class="col-md-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Add Category</h4>

                    {!! Form::open(['route' => 'category.store', 'method' => 'POST', 'enctype' => 'multipart/form-data']) !!}
          
                
                            <div class="form-group">
                                <label for="exampleInputUsername1">Category Name</label>
                                <input type="text" class="form-control" name="name" placeholder="Category Name">

                              @if($errors->has('name'))
                                 <span class="text-danger">{{$errors->first('name')}}</span>
                              @endif
                           </div>

                                    
                           <div class="form-group">
                            <label class="form-label mg-b-0">Image</label>
                            <input class="form-control" type="file" name="image">
                            @if($errors->has('image'))
                                 <span class="text-danger">{{$errors->first('image')}}</span>
                              @endif
                           </div>

                            <div class="form-group ">
                                    <button class="btn btn-primary mr-2 pd-x-30 mg-r-5 mg-t-5">Add Category</button>
                            </div>   
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    <!-- </div> -->
 @endsection


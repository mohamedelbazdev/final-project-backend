@extends('admin.admin_master')
@section('admin')
        <?php
         $pull = "float-left";
        ?>
    <ol class="breadcrumb">
        <li class="breadcrumb-item {{$pull}}"><a href="{{URL::to('/dashboard')}}"> Home</a></li>
        <li class="breadcrumb-item {{$pull}}"><a href="{{URL::to('/slider')}}"> Slider</a></li>
        <li class="breadcrumb-item active {{$pull}}">Create Slider</li> 
    </ol>
    <!-- <div class="content-wrapper"> -->
       <div class="col-md-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Add Slider</h4>

                    {!! Form::open(['route' => 'slider.store', 'method' => 'POST', 'enctype' => 'multipart/form-data']) !!}
          
                
                            <div class="form-group">
                                <label for="exampleInputUsername1">Slider Title</label>
                                <input type="text" class="form-control" name="title" placeholder="slider title">

                              @if($errors->has('title'))
                                 <span class="text-danger">{{$errors->first('title')}}</span>
                              @endif
                           </div>

                           <div class="form-group">
                            <label for="exampleFormControlSelect2">Description</label>
                            <input name="description" class="form-control" placeholder="Enter Slider Description" type="textarea">
                            @if($errors->has('description'))
                                 <span class="text-danger">{{$errors->first('description')}}</span>
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
                                    <button class="btn btn-primary mr-2 pd-x-30 mg-r-5 mg-t-5">Add slider</button>
                            </div>   
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    <!-- </div> -->
 @endsection


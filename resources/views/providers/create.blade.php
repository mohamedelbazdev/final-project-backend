@extends('admin.admin_master')
@section('admin')

        <div class="col-md-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Add new Provider</h4>

                    {!! Form::open(['route' => 'provider.store', 'method' => 'POST', 'enctype' => 'multipart/form-data']) !!}
                            @csrf
                        <div class="form-group">
                            <label for="exampleInputUsername1">Name</label>
                            <input class="form-control" placeholder="Enter Provider Name" type="text" name="name">

                            @if($errors->has('name'))
                                 <span class="text-danger">{{$errors->first('name')}}</span>
                              @endif
                        </div>

                        <div class="form-group">
                                <label for="categories"> Category</label>
                            {{ Form::select('category_id',$categories, null, ['class'=>'form-control select2','id'=>'category_id']) }}
                            @if($errors->has('category_id'))
                                 <span class="text-danger">{{$errors->first('category_id')}}</span>
                             @endif
                        </div>

                        <div class="form-group">
                            <label for="exampleFormControlSelect2">Image</label>
                            <input type="file" name="image" class="form-control">

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


                        <button class="btn btn-primary mr-2 pd-x-30 mg-r-5 mg-t-5">Add Provider</button>
                                    <button class="btn btn-dark pd-x-30 mg-t-5">Cancel</button>
                            

                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    @endsection

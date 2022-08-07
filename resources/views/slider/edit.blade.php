@extends('admin.admin_master')

@section('admin')

<h1>Edit : {{$slider['title']}}</h1>
    <div class="contaner" style="margin-left: 50px;margin-top:20px;">
        <div class="row">
            <div class="col-md-9">
                {!! Form::open([
                    'route' => ['slider.update', $slider->id],
                    'method' => 'PUT',
                    'enctype' => 'multipart/form-data',
                ]) !!}
                    <div class="form-group">
                        <label for="title">slider</label>
                        {{ Form::text('title', $slider['title'], ['class'=>'form-control','id'=>'title']) }}
                        @if($errors->has('title'))
                              <div class="alert alert-danger">{{$errors->first('title')}}
                         @endif 
                    </div>
                    <div class="form-group">
                        <label for="description">slider</label>
                        {{ Form::text('description', $slider['description'], ['class'=>'form-control','id'=>'description']) }}
                        @if($errors->has('description'))
                              <div class="alert alert-danger">{{$errors->first('description')}}
                         @endif 
                    </div>
                            
                    
                        <label for="image">image</label>
                        
                {{ Form::file('image',['class'=>'form-control']) }}
               
                <div class="form-group col-md-6">
                            <label for="exampleInputName1">Old Image</label>
                            <img src="{{ URL::to($slider->image) }}" style="width: 70px; height: 50px;">
                            <input type="hidden" name="oldimage" value="{{ $slider->image }}">
                            @if($errors->has('image'))
                              <div class="alert alert-danger">{{$errors->first('image')}}
                         @endif 
                        </div>
                       
                <br>
                {!! Form::submit('update slider', ['class' => 'btn btn-primary']) !!}
                {!! Form::close() !!}
            </div>
        </div>
    </div>

@endsection

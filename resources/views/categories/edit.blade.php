@extends('admin.admin_master')

@section('admin')

<h1>Edit : {{$category['name']}}</h1>
    <div class="contaner" style="margin-left: 50px;margin-top:20px;">
        <div class="row">
            <div class="col-md-9">
                {!! Form::open([
                    'route' => ['category.update', $category->id],
                    'method' => 'PUT',
                    'enctype' => 'multipart/form-data',
                ]) !!}
                <div class="form-group">
                    <label for="name">category</label>
                    {{ Form::text('name', $category['name'], ['class'=>'form-control','id'=>'name']) }}
                    @if($errors->has('name'))
                                    <div class="alert alert-danger">{{$errors->first('name')}}</div>
                        @endif
                   
                    <label for="image">image</label>
                    {{ Form::file('image',['class'=>'form-control']) }}
               
                </div>
                <br>

                {!! Form::submit('update category', ['class' => 'btn btn-primary']) !!}
                {!! Form::close() !!}
            </div>
        </div>
    </div>

@endsection

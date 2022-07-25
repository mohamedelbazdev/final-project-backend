@extends('admin.admin_master')

@section('admin')
    <h1>Edit : {{ $provider['name'] }}</h1>
    <div class="contaner" style="margin-left: 50px;margin-top:20px;">
        <div class="row">
            <div class="col-md-9">
                {!! Form::open([
                    'route' => ['provider.update', $provider->id],
                    'method' => 'PUT',
                    'enctype' => 'multipart/form-data',
                ]) !!}

                @csrf
              


                <div class="form-group">
                    <label for="category_id">Category</label>

                    {{ Form::select('category_id',$categories, $provider['category_id'], ['class'=>'form-control select2','id'=>'category_id']) }}
                    </div>
                            
                   
                    <div class="form-group">
                        <label for="description">provider</label>
                        {{ Form::text('description', $provider['description'], ['class'=>'form-control','id'=>'description']) }}
                        @if($errors->has('description'))
                              <div class="alert alert-danger">{{$errors->first('description')}}
                         @endif 
                    </div>
                    <div class="form-group">
                        <label for="price">provider</label>
                        {{ Form::text('price', $provider['price'], ['class'=>'form-control','id'=>'price']) }}
                        @if($errors->has('price'))
                              <div class="alert alert-danger">{{$errors->first('price')}}
                         @endif 
                    </div>

                    {{ Form::select('category_id', $categories, $provider['category_id'], ['class' => 'form-control select2', 'id' => 'category_id']) }}
                </div>

                <div class="form-group">
                    <label for="image">image</label>
                    {{ Form::file('image', ['class' => 'form-control']) }}
                </div>
                <div class="form-group">
                    <label for="description">provider</label>
                    {{ Form::text('description', $provider['description'], ['class' => 'form-control', 'id' => 'description']) }}
                    @if ($errors->has('description'))
                        <div class="alert alert-danger">{{ $errors->first('description') }}
                    @endif
                </div>
                <div class="form-group">
                    <label for="price">provider</label>
                    {{ Form::text('price', $provider['price'], ['class' => 'form-control', 'id' => 'price']) }}
                    @if ($errors->has('price'))
                        <div class="alert alert-danger">{{ $errors->first('price') }}
                    @endif
                </div>

                <br>
                {!! Form::submit('update provider', ['class' => 'btn btn-primary']) !!}
                {!! Form::close() !!}
            </div>
        </div>
    </div>
@endsection

@extends('admin.admin_master')
@section('admin')
                <div class="box-header">
                    <a href="{{URL::to('/category/create')}}" class="btn btn-info m-4">Add category</a>
                </div> 
    
      
        <div class="card-body">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>NO</th>
                        <th>Name</th>
                        <th>Image</th>
                        <th style="width: 40px">Action</th>
                    </tr>
                </thead>

                <tbody>
                @foreach ($categories as $key => $category)
                        <tr>
                            <td style="width: 25%">{{ $loop->iteration }}</td>
                            <td style="width: 50%">{{ $category->name }}</td>
                            <td style="width: 50%">image</td>
                            <td>
                                <a href="{{ route('category.edit', $category->id) }}" class="btn btn-info">Edit</a>
                                <a href='' data-toggle="modal" data-target="#modal_single_del{{ $key }}"
                                    class='btn btn-danger m-r-1em'>Delete </a>
                            </td>
                        </tr>
                 @endforeach

                 @if(isset($key))
                      <div class="modal" id="modal_single_del{{ $key }}" tabindex="-1" role="dialog">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title">delete confirmation</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>

                                <div class="modal-body">
                                    Remove {{ $category->name }} !!!!
                                </div>
                                <div class="modal-footer">
                                    <form action="{{ url('/category/' . $category->id) }}" method="post">
                                        @csrf
                                        @method('delete')

                                        <div class="not-empty-record">
                                            <button type="submit" class="btn btn-primary">Delete</button>
                                            <button type="button" class="btn btn-secondary"
                                                data-dismiss="modal">close</button>
                                        </div>
                                    </form>

                                </div>
                            </div>
                        </div>
                </tbody>
                    @endif
              </table>






    @endsection

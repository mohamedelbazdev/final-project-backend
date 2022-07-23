@extends('admin.admin_master')
@section('admin')
    <div class="card-body">
        <div class="box-header with-border">
            <div class="box-title">
                <h2>Providers</h2>
            </div>

        </div>
        <div class="card-body">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>NO</th>
                        <th>Name</th>
                        <th>Category</th>
                        <th>Image</th>
                        <th>Description</th>
                        <th>Price</th>
                        <th style="width: 40px">Action</th>
                    </tr>
                </thead>
                <tbody>



                @foreach ($providers as $key => $provider)
                        <tr>
                            <td style="width: 25%">{{ $loop->iteration }}</td>
                            <td style="width: 50%">{{ $provider->name }}</td>
                            <td style="width: 50%">
                              {{optional($provider->categories)->name}}
                            </td>
                            <td style="width: 50%">image</td>
                            <td style="width: 50%">{{ $provider->description }}</td>
                            <td style="width: 50%">{{ $provider->price }}</td>
                            <td>
                                <a href="{{ route('provider.edit', $provider->id) }}" class="btn btn-info">Edit</a>
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
                                    Remove {{ $provider->name }} !!!!
                                </div>
                                <div class="modal-footer">
                                    <form action="{{ url('/provider/' . $provider->id) }}" method="post">
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
        </div>
    </div>
@endsection

@extends('admin.admin_master')

@section('admin')
    <div class="box-header">
        <a href="{{ URL::to('/admins/create') }}" class="btn btn-info m-4">Add Admin</a>
    </div>
    <div class="card-body">
        <div class="box-header with-border">
            <div class="box-title">
                <h2>Admins</h2>
            </div>

        </div>
        <div class="table-responsive">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>NO</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Image</th>
                        <th>Mobile Number</th>
                        <th>Role</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>



                    @foreach ($users as $key => $user)
                        <tr>
                            <td style="width: 25%">{{ $loop->iteration }}</td>
                            <td style="width: 50%">{{ $user->name }}</td>
                            <td style="width: 50%">
                                {{ $user->email }}
                            </td>
                            
                            <td style="width: 50%"><img src="{{ $user->image }}" alt=""></td>
                            <td style="width: 50%">{{ $user->mobile }}</td>
    
                            <td style="width: 50%">
                                @if ($user->role_id == 1)
                                    <button type="button" class="btn btn-outline-success btn-fw">Admin</button>
                                @elseif($user->role_id == 2)
                                    <button type="button" class="btn btn-outline-danger btn-fw">Provider</button>
                                @else
                                    <button type="button" class="btn btn-outline-warning btn-fw">User</button>
                                @endif
                            </td>
                            <td style="width: 50%">
                                <a href="{{ route('admins.edit', $user->id) }}" class="btn btn-info">Edit</a>
                                <a href='' data-toggle="modal" data-target="#modal_single_del{{ $key }}"
                                    class='btn btn-danger m-r-1em'>Delete </a>

                            </td>
                        </tr>
                    

                    @if (isset($key))
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
                                        Remove {{ $user->name }} !!!!
                                    </div>
                                    <div class="modal-footer">
                                        <form action="{{ url('/admins/' . $user->id) }}" method="post">
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
                @endforeach
            </table>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk="
        crossorigin="anonymous"></script>
    <script>
        $(document).ready(function() {
            // $("#provider_table").dataTable()
        });
        $(function() {
            $(".toggle-class").change(function() {
                var status = $(this).prop('checked') == true ? 1 : 0;
                var provider_id = $(this).data('id');
                $.ajax({
                    type: "GET",
                    dataType: "json",
                    url: "/providerStatus",
                    data: {
                        'status': status,
                        'provider_id': provider_id
                    },
                    success: function(data) {
                        console.log(data.success);
                    }
                });
            });
        });
    </script>
@endsection

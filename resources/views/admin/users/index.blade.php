@extends('template')

@section('container')
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">Users</div>
            <div class="card-body">
                <a href="{{ url('dashbord/admin') }}" class="btn btn-warning btn-sm" title="Add New User">
                    <i class="fa fa-arrow-left" aria-hidden="true"></i> Kembali
                </a>
                <a href="{{ url('/admin/users/create') }}" class="btn btn-success btn-sm" title="Add New User">
                    <i class="fa fa-plus" aria-hidden="true"></i> Tambah Data
                </a>

                <form method="GET" action="{{ url('/admin/users') }}" accept-charset="UTF-8" class="form-inline my-2 my-lg-0 float-right" role="search">
                    <div class="input-group">
                        <input type="text" class="form-control" name="search" placeholder="Search..." value="{{ request('search') }}">
                        <span class="input-group-append">
                            <button class="btn btn-secondary" type="submit">
                                <i class="fa fa-search"></i>
                            </button>
                        </span>
                    </div>
                </form>

                <br/>
                <br/>
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>#</th><th>Name</th><th>NIK</th><th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                        @foreach($users as $item)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $item->nama }}</td><td>{{ $item->memberid }}</td>
                                <td>
                                    <a href="{{ url('/admin/users/users_view/' . $item->memberid) }}" title="View User"><button class="btn btn-info btn-sm"><i class="fa fa-eye" aria-hidden="true"></i> View</button></a>
                                    <a href="{{ url('/admin/users/users_edit/' . $item->memberid) }}" title="Edit User"><button class="btn btn-primary btn-sm"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit</button></a>
                                     <a href="{{ url('admin/user_menu/create/' . $item->memberid) }}" title="Edit User"><button class="btn btn-primary btn-sm"><i class="fa fa-plus" aria-hidden="true"></i> Tambah Menu</button></a>
                                    <!-- <form method="POST" action="{{ url('/admin/users/users_edit' . '/' . $item->memberid) }}" accept-charset="UTF-8" style="display:inline">
                                        {{ method_field('DELETE') }}
                                        {{ csrf_field() }}
                                        <button type="submit" class="btn btn-danger btn-sm" title="Delete User" onclick="return confirm(&quot;Confirm delete?&quot;)"><i class="fa fa-trash-o" aria-hidden="true"></i> Delete</button>
                                    </form> -->
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>

            </div>
        </div>
    </div>
@endsection

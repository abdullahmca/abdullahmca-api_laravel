@extends('template')

@section('container')
    <div class="container">
        <div class="row"> 
            <div class="col-md-9">
                <div class="card">
                    <div class="card-header">User_menu {{ $user_menu->id }}</div>
                    <div class="card-body">

                        <a href="{{ url('/admin/user_menu') }}" title="Back"><button class="btn btn-warning btn-sm"><i class="fa fa-arrow-left" aria-hidden="true"></i> Back</button></a>
                        <a href="{{ url('/admin/user_menu/' . $user_menu->id . '/edit') }}" title="Edit User_menu"><button class="btn btn-primary btn-sm"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit</button></a>

                        <form method="POST" action="{{ url('admin/user_menu' . '/' . $user_menu->id) }}" accept-charset="UTF-8" style="display:inline">
                            {{ method_field('DELETE') }}
                            {{ csrf_field() }}
                            <button type="submit" class="btn btn-danger btn-sm" title="Delete User_menu" onclick="return confirm(&quot;Confirm delete?&quot;)"><i class="fa fa-trash-o" aria-hidden="true"></i> Delete</button>
                        </form>
                        <br/>
                        <br/>

                        <div class="table-responsive">
                            <table class="table">
                                <tbody>
                                    <tr>
                                        <th>ID</th><td>{{ $user_menu->id }}</td>
                                    </tr>
                                    <tr><th> Id Menu </th><td> {{ $user_menu->id_menu }} </td></tr><tr><th> Id User </th><td> {{ $user_menu->id_user }} </td></tr>
                                </tbody>
                            </table>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@extends('template')

@section('container') 
<div class="col-md-12">
    <div class="card">
        <div class="card-header">User {{ $user->id }}</div>
        <div class="card-body">

            <a href="{{ url('/user_management/users') }}" title="Back"><button class="btn btn-warning btn-sm"><i class="fa fa-arrow-left" aria-hidden="true"></i> Back</button></a>
            <a href="{{ url('/user_management/users/' . $user->id . '/edit') }}" title="Edit User"><button class="btn btn-primary btn-sm"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit</button></a>

            <form method="POST" action="{{ url('user_management/users' . '/' . $user->id) }}" accept-charset="UTF-8" style="display:inline">
                {{ method_field('DELETE') }}
                {{ csrf_field() }}
                <button type="submit" class="btn btn-danger btn-sm" title="Delete User" onclick="return confirm(&quot;Confirm delete?&quot;)"><i class="fa fa-trash-o" aria-hidden="true"></i> Delete</button>
            </form>
            <br/>
            <br/>

            <div class="table-responsive">
                <table class="table">
                    <tbody>
                        <tr>
                            <th>ID</th><td>{{ $user->id }}</td>
                        </tr>
                        <tr><th> User Name </th><td> {{ $user->user_name }} </td></tr><tr><th> Password </th><td> {{ $user->password }} </td></tr><tr><th> Nama User </th><td> {{ $user->nama_user }} </td></tr>
                    </tbody>
                </table>
            </div>

        </div>
    </div>
</div>
@endsection

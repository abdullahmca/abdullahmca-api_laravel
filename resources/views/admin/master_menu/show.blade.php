@extends('template')

@section('container') 
<div class="col-md-12">
    <div class="card">
        <div class="card-header">Master_menu {{ $master_menu->id }}</div>
        <div class="card-body">

            <a href="{{ url('/admin/master_menu') }}" title="Back"><button class="btn btn-warning btn-sm"><i class="fa fa-arrow-left" aria-hidden="true"></i> Back</button></a>
            <a href="{{ url('/admin/master_menu/' . $master_menu->id . '/edit') }}" title="Edit Master_menu"><button class="btn btn-primary btn-sm"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit</button></a>

            <form method="POST" action="{{ url('admin/master_menu' . '/' . $master_menu->id) }}" accept-charset="UTF-8" style="display:inline">
                {{ method_field('DELETE') }}
                {{ csrf_field() }}
                <button type="submit" class="btn btn-danger btn-sm" title="Delete Master_menu" onclick="return confirm(&quot;Confirm delete?&quot;)"><i class="fa fa-trash-o" aria-hidden="true"></i> Delete</button>
            </form>
            <br/>
            <br/>

            <div class="table-responsive">
                <table class="table">
                    <tbody>
                        <tr>
                            <th>ID</th><td>{{ $master_menu->id }}</td>
                        </tr>
                        <tr><th> Menu </th><td> {{ $master_menu->menu }} </td></tr><tr><th> Link </th><td> {{ $master_menu->link }} </td></tr><tr><th> Icon </th><td> {{ $master_menu->icon }} </td></tr>
                    </tbody>
                </table>
            </div>

        </div>
    </div>
</div> 
@endsection

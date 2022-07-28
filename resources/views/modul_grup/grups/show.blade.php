@extends('template')

@section('container') 
<div class="col-md-12">
    <div class="card">
        <div class="card-header">Grup {{ $grup->groupid }}</div>
        <div class="card-body">

            <a href="{{ url('/modul_grup/grups') }}" title="Back"><button class="btn btn-warning btn-sm"><i class="fa fa-arrow-left" aria-hidden="true"></i> Back</button></a>
            <a href="{{ url('/modul_grup/grups/' . $grup->id . '/edit') }}" title="Edit Grup"><button class="btn btn-primary btn-sm"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit</button></a>

            <form method="POST" action="{{ url('modul_grup/grups' . '/' . $grup->groupid) }}" accept-charset="UTF-8" style="display:inline">
                {{ method_field('DELETE') }}
                {{ csrf_field() }}
                <button type="submit" class="btn btn-danger btn-sm" title="Delete Grup" onclick="return confirm(&quot;Confirm delete?&quot;)"><i class="fa fa-trash-o" aria-hidden="true"></i> Delete</button>
            </form>
            <br/>
            <br/>

            <div class="table-responsive">
                <table class="table">
                    <tbody>
                        <tr>
                            <th>ID</th><td>{{ $grup->groupid }}</td>
                        </tr>
                        <tr><th> Namagrup </th><td> {{ $grup->namagrup }} </td></tr><tr><th> Kota </th><td> {{ $grup->kota }} </td></tr>
                    </tbody>
                </table>
            </div>

        </div>
    </div>
</div> 
@endsection

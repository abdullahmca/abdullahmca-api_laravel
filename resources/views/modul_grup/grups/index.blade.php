@extends('template')

@section('container') 
<div class="col-md-12">
    <div class="card">
        <div class="card-header">Grups</div>
        <div class="card-body">
            <a href="{{ url('/modul_grup/grups/create') }}" class="btn btn-primary btn-sm" title="Add New Grup">
                <i class="fa fa-plus" aria-hidden="true"></i> Tambah Data
            </a>
            <a href="{{ url('/') }}" class="btn btn-danger btn-sm" title="kembali">
                <i class="fa fa-arrow-left" aria-hidden="true"></i> Kembali
            </a>

            <form method="GET" action="{{ url('/modul_grup/grups') }}" accept-charset="UTF-8" class="form-inline my-2 my-lg-0 float-right" role="search">
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
                            <th>#</th><th>Nama group</th><th>Kota</th><th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($grups as $item)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $item->namagroup }}</td><td>{{ $item->kota }}</td>
                            <td>
                                <a href="{{ url('/modul_grup/grups/' . $item->groupid) }}" title="View Grup"><button class="btn btn-info btn-sm"><i class="fa fa-eye" aria-hidden="true"></i> View</button></a>
                                <a href="{{ url('/modul_grup/grups/' . $item->groupid . '/edit') }}" title="Edit Grup"><button class="btn btn-primary btn-sm"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit</button></a>

                                <form method="POST" action="{{ url('/modul_grup/grups' . '/' . $item->groupid) }}" accept-charset="UTF-8" style="display:inline">
                                    {{ method_field('DELETE') }}
                                    {{ csrf_field() }}
                                    <button type="submit" class="btn btn-danger btn-sm" title="Delete Grup" onclick="return confirm(&quot;Confirm delete?&quot;)"><i class="fa fa-trash-o" aria-hidden="true"></i> Delete</button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                <div class="pagination-wrapper"> {!! $grups->appends(['search' => Request::get('search')])->render() !!} </div>
            </div>

        </div>
    </div>
</div> 
@endsection

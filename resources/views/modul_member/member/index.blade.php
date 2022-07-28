@extends('template')

@section('container') 
<div class="col-md-12">
    <div class="card">
        <div class="card-header">Member</div>
        <div class="card-body">
            <a href="{{ url('/modul_member/member/create') }}" class="btn btn-primary btn-sm" title="Add New Member">
                <i class="fa fa-plus" aria-hidden="true"></i> Tambah Data
            </a>
            <a href="{{ url('file-upload') }}" class="btn btn-warning btn-sm" title="Add New Member">
                <i class="fa fa-arrow-down" aria-hidden="true"></i> Import Data
            </a>
            <a href="{{ url('/') }}" class="btn btn-danger btn-sm" title="kembali">
                <i class="fa fa-arrow-left" aria-hidden="true"></i> Kembali
            </a>

            <form method="GET" action="{{ url('/modul_member/member') }}" accept-charset="UTF-8" class="form-inline my-2 my-lg-0 float-right" role="search">
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
                            <th>#</th><th>Hp</th><th>Alamat</th><th>Nama</th><th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($member as $item)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $item->hp }}</td><td>{{ $item->alamat }}</td><td>{{ $item->nama }}</td>
                            <td>
                                <a href="{{ url('/modul_member/member/' . $item->memberid) }}" title="View Member"><button class="btn btn-info btn-sm"><i class="fa fa-eye" aria-hidden="true"></i> View</button></a>
                                <a href="{{ url('/modul_member/member/' . $item->memberid . '/edit') }}" title="Edit Member"><button class="btn btn-primary btn-sm"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit</button></a>

                                <form method="POST" action="{{ url('/modul_member/member' . '/' . $item->memberid) }}" accept-charset="UTF-8" style="display:inline">
                                    {{ method_field('DELETE') }}
                                    {{ csrf_field() }}
                                    <button type="submit" class="btn btn-danger btn-sm" title="Delete Member" onclick="return confirm(&quot;Confirm delete?&quot;)"><i class="fa fa-trash-o" aria-hidden="true"></i> Delete</button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                <div class="pagination-wrapper"> {!! $member->appends(['search' => Request::get('search')])->render() !!} </div>
            </div>

        </div>
    </div>
</div> 
@endsection

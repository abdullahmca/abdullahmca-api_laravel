@extends('template')

@section('container') 
<div class="col-md-12">
    <div class="card">
        <div class="card-header">Master_menu</div>
        <div class="card-body">
            <a href="{{ url('/admin/master_menu/create') }}" class="btn btn-primary btn-sm" title="Add New Master_menu">
                <i class="fa fa-plus" aria-hidden="true"></i> Tambah Data
            </a>
            <a href="{{ url('/') }}" class="btn btn-danger btn-sm" title="Add New Master_menu">
                <i class="fa fa-arrow-left" aria-hidden="true"></i> Kembali
            </a><br><br>

            <form method="GET" action="{{ url('/admin/master_menu') }}" accept-charset="UTF-8" class="form-inline my-2 my-lg-0 float-right" role="search">
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
                            <th>#</th><th>Menu</th><th>Link</th><th>Icon</th><th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($master_menu as $item)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $item->menu }}</td><td>{{ $item->link }}</td><td>{{ $item->icon }}</td>
                            <td>
                                <a href="{{ url('/admin/master_menu/' . $item->id) }}" title="View Master_menu"><button class="btn_aksi btn btn-primary"><i class="fa fa-eye" aria-hidden="true"></i> </button></a>
                                <a href="{{ url('/admin/master_menu/' . $item->id . '/edit') }}" title="Edit Master_menu"><button class="btn_aksi btn btn-warning"><i class="fa fa-edit" aria-hidden="true"></i> </button></a>

                                <form method="POST" action="{{ url('/admin/master_menu' . '/' . $item->id) }}" accept-charset="UTF-8" style="display:inline">
                                    {{ method_field('DELETE') }}
                                    {{ csrf_field() }}
                                    <button type="submit" class="btn_aksi btn btn-danger" title="Delete Master_menu" onclick="return confirm(&quot;Confirm delete?&quot;)"><i class="fa fa-trash" aria-hidden="true"></i></button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                <div class="pagination-wrapper"> {!! $master_menu->appends(['search' => Request::get('search')])->render() !!} </div>
            </div>

        </div>
    </div>
</div> 
@endsection

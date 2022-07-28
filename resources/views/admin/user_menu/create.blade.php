@extends('template')

@section('container') 
<div class="row"> 
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <label>Menu User</label>
                <a style="float:right" href="{{ url('/admin/user_menu') }}" title="Back"><button class="btn btn-danger btn-sm"><i class="fa fa-arrow-left" aria-hidden="true"></i> Back</button></a>
            </div>
            <div class="card-body">
                <label class="col-md-2">Nama Pengguna</label>
                <label class="col-md-8">
                    <select class="select2 form-control">
                        <option value="">pilih data</option>
                    <?php
                        $nm_user=DB::table('tbl_user_faskes')->select('nik_admin','admin')
                        ->get();
                        foreach($nm_user as $user){?>
                            <option value="<?=$user->nik_admin?>"><?=$user->admin?></option>
                        <?php }?>
                    </select>
                </label>
                <button class="btn btn-primary" title="simpan data"><i class="far fa-floppy-o"></i>Simpan Data</button>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card">
            <div class="card-header">Grup Menu</div>
            <div class="card-body">
                <table style="width:100%" class="table table-bordered">
                    <tr>
                        <td>Menu</td>
                        <td>Aksi</td>
                    </tr>
                    <?php
                        $grupmenu=DB::table('grup_master_menu')->select('id_master','menu')
                        ->get();
                        foreach($grupmenu as $grupmn){?>
                            <tr>
                                <td><?=$grupmn->menu?></td>
                                <td><label><input type="checkbox" name="gr_mn" id="gr_mn" value='<?=$grupmn->id_master?>' data-id='<?=$grupmn->id_master?>'> pilih</label></td>
                            </tr>
                        <?php }
                    ?>
                </table>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card">
            <div class="card-header">Grup Menu</div>
            <div class="card-body">
                <table style="width:100%" class="table table-bordered">
                    <tr>
                        <td>Menu</td>
                        <td>Aksi</td>
                    </tr>
                    <?php
                        $grupmenu=DB::table('master_menu')->select('id','menu')
                        ->get();
                        foreach($grupmenu as $grupmn){?>
                            <tr>
                                <td><?=$grupmn->menu?></td>
                                <td><label><input type="checkbox" name="gr_mn" id="gr_mn" value='<?=$grupmn->id?>' data-id='<?=$grupmn->id?>'> pilih</label></td>
                            </tr>
                        <?php }
                    ?>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection

@extends('template')
@section('nav')

@endsection
@section('container') 
<meta name="csrf-token" content="{{ csrf_token() }}">
<div class="row"> 
    <div class="col-md-4">
        <div class="card">
            <div class="card-header">
                <label>Menu User</label>
                <a style="float:right" href="{{ url('/admin/users') }}" title="Back"><button class="btn btn-danger btn-sm"><i class="fa fa-arrow-left" aria-hidden="true"></i> Kembali</button></a>
            </div>
            <div class="card-body">
                <label class="col-md-12">Nama Pengguna</label>
                <label class="col-md-12">
                    <select name="nik_admin" id="nik_admin" class="select2 form-control"> 
                    <?php
                        $nm_user=DB::table('tbl_user_faskes')
                        ->select('nik_admin','admin')
                        ->where('id_user',$id)
                        ->get();
                        foreach($nm_user as $user){?>
                            <option value="<?=$user->nik_admin?>"><?=$user->admin?></option>
                        <?php }?>
                    </select>
                </label>
            </div>
        </div>
    </div>
    <div class="col-md-7">
        <div class="card">
            <div class="card-header">Grup Menu</div>
            <div class="card-body">
                <table style="width:100%" class="table table-bordered">
                    <tr>
                        <td>Menu</td>
                        <!-- <td>Aksi</td> -->
                    </tr>
                    <?php 
                        $grup_master_menu = DB::table('grup_master_menu')
                            // ->where('id_kategori', '=', $cat->id)
                        ->select('*')
                        ->orderBy('id_master', 'asc')
                        ->get();$a=0;$b=0;
                        foreach($grup_master_menu as $gmm){
                            $master_menu = DB::table('master_menu')
                            ->where('id_master','=',$gmm->id_master)
                            ->select('*')
                            ->get();
                            foreach($master_menu as $mm){?>
                                    <label class="col-md-12">
                                        <?=$mm->menu?>
                                    </label>
                                    <?php
                            $list_menu = DB::table('master_menu')
                            ->where('parent','=',$mm->id)
                            ->select('*')
                            ->get();
                            $chek='';
                            foreach($list_menu as $lm){
                                    $nm_users=DB::table('tbl_user_faskes')
                                    ->select('nik_admin','admin')
                                    ->where('id_user',$id)
                                    ->first();
                                    $query=DB::table('user_menu')
                                    ->where('id_user','=',$nm_users->nik_admin)
                                    ->where('id_menu','=',$lm->id)
                                    ->first();
                                    if($query){
                                        $chek='checked';
                                    }else{
                                        $chek='';
                                    }
?>
                                    <label class="col-md-12">
                                    <input type="checkbox" title="<?=$lm->menu?>" <?=$chek?> name="checkbox" class="checkboxx" data-id='<?=$lm->id?>' value="<?=$lm->id?>"> &nbsp;<?=$lm->menu?>
                                    </label>
                                <?php }
                        }
                        }
                    ?>
                </table>
            </div>
        </div>
    </div>
</div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script> 
<script type="text/javascript">
   // $(".checkboxx").on('click', function(){
   // });
        $(document).ready(function(){
            console.log('cek menu user');
   $.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
    });
    });
    $('.pilih_master').on('click',function(){
        var kondisi=$(this).is(':checked');
        var url;var sts;
        var id_menu=$(this).val();
        console.log(id_menu);
        if(kondisi==true) {
            url="{{route('cari_list_menu')}}";
            sts='true';
        } else {
            url="{{route('cari_list_menu')}}";
            sts='false';
        }
        // // cek list menu
        // $.ajax({     
        //     type: "POST",
        //     url: url,
        //     dataType: "JSON",
        //     data: {
        //         sts:sts,
        //         id_menu:id_menu,
        //         nik_admin:$('select[name=nik_admin] option').filter(':selected').val(),
        //     },
        //     success: function (data) {
        //         console.log(data);
        //     },
        //     error: function(){}
        // });
    });
    $('.checkboxx').on('click',function(){
        var kondisi=$(this).is(':checked');
        var url;var sts;
        var id_menu=$(this).val();
        console.log(id_menu+' save menu persatu');
        if(kondisi==true) {
            url="{{route('cari_list_menu')}}";
            sts='true';
        } else {
            url="{{route('cari_list_menu')}}";
            sts='false';
        }
        // cek list menu
        $.ajax({     
            type: "POST",
            url: url,
            dataType: "JSON",
            data: {
                sts:sts,
                id_menu:id_menu,
                nik_admin:$('select[name=nik_admin] option').filter(':selected').val(),
            },
            success: function (data) {
                console.log(data);
            },
            error: function(){}
        });
    });
</script>
@endsection

@extends('template')

@section('container') 
<style type="text/css">
    table tr td{
        border: 0px solid;
        border-collapse: 0;
    }
</style>
<div class="row">
    <div class="col-md-12">
        <div class="card"> 
            <div class="card-body"> 
                <a href="{{ url('/modul_member/member') }}" title="Back"><button class="btn btn-danger btn-sm"><i class="fa fa-arrow-left" aria-hidden="true"></i> Back</button></a> 
                <br/>
                <br/>
                <table width="100%">
                    <tr>
                        <td width="10%">Nama</td>
                        <td>: {{ $member->nama }} </td>
                    </tr>
                    <tr>
                        <td>Hp</td>
                        <td>: {{ $member->hp }} </td>
                    </tr>
                    <tr>
                        <td>Alamat</td>
                        <td>: {{ $member->alamat }} </td>
                    </tr>
                </table>
                <div class="table-responsive">
                </div> 
            </div>
        </div>
    </div> 
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">Menu member</div>
            <div class="card-body">  
                <div class="table-responsive"> 
                    <table width="100%">
                        <?php $chek='';
                        $master_menu=\DB::table('master_menu')->where('parent','=','true')->get();
                        foreach ($master_menu as $value) { 
                            $sub_menu=\DB::table('master_menu')->where('parent','=',$value->id)->get();
                            ?>
                            <tr>
                                <td>
                                    <label class="col-md-4">  <u><?=$value->menu?></u></label>
                                </td>
                            </tr>
                            <?php
                            foreach($sub_menu as $sm){
                                $cek_data_user_mn=\DB::table('users_menu')->select('*')->where('id_menu','=',$sm->id)->first();
                                $ceked="";
                                if($cek_data_user_mn){
                                    $ceked="checked";
                                }
                                ?>
                                <tr>
                                    <td>
                                        <label class="col-md-4"> 
                                    <input type="checkbox" <?=$ceked?> title="<?=$sm->menu?>" <?=$chek?> name="checkbox" class="checkboxx" data-id='<?=$sm->id?>' value="<?=$sm->id?>"> &nbsp;<?=$sm->menu?></label>
                                    </td>
                                </tr>
                                <?php 
                            }
                        }?> 
                    </table>
                </div> 
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
    $('.checkboxx').on('click',function(){
        var kondisi=$(this).is(':checked');
        var url;var sts;
        var id_menu=$(this).val();
        console.log("{{$member->memberid}} "+id_menu+' save menu persatu');
        url="{{route('member/simpan_menu')}}";
        if(kondisi==true) { 
            sts='true';
        } else {
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
                memberid:"<?=$member->memberid?>",
            },
            success: function (data) {
                console.log(data); 
                alert(data.sts);
            },
            error: function(){}
        });
    });
</script>
@endsection

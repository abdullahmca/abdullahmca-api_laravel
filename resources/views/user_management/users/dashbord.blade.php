@extends('template')

@section('sub_title')  
Halaman Dashbord
@endsection
@section('container') 
<div class="row"> 
  <div class="col-lg-3 col-6" style="margin-bottom: 2%">
    <div class="small-box"  style="background-color:blue; padding-top:2%;padding-left:3%;padding-right:3%;border-radius:3%;height:150px">
    <div class="inner">
    <h3><a href="<?=URL::to("admin/master_menu")?>" style="color:#000"> master menu </a> 
    <i style="float:right" class=""></i>
    </h3>
    <p style="background-color:transparent;"> &nbsp;</p>
    </div>
    <div class="icon">
    </div>
    <a href="<?=URL::to("admin/master_menu")?>" class="small-box-footer col-md-12" style="color:black">Lihat Fitur <i class="fa fa-arrow-circle-right"></i></a>
    </div>
  </div> 
  <div class="col-lg-3 col-6" style="margin-bottom: 2%">
    <div class="small-box"  style="background-color:blue; padding-top:2%;padding-left:3%;padding-right:3%;border-radius:3%;height:150px">
    <div class="inner">
    <h3><a href="<?=URL::to("modul_grup/grups")?>" style="color:#000"> Group </a> 
    <i style="float:right" class=""></i>
    </h3>
    <p style="background-color:transparent;"> &nbsp;</p>
    </div>
    <div class="icon">
    </div>
    <a href="<?=URL::to("modul_grup/grups")?>" class="small-box-footer col-md-12" style="color:black">Lihat Fitur <i class="fa fa-arrow-circle-right"></i></a>
    </div>
  </div>
  <div class="col-lg-3 col-6" style="margin-bottom: 2%">
    <div class="small-box"  style="background-color:blue; padding-top:2%;padding-left:3%;padding-right:3%;border-radius:3%;height:150px">
    <div class="inner">
    <h3><a href="<?=URL::to("modul_member/member")?>" style="color:#000"> member </a> 
    <i style="float:right" class=""></i>
    </h3>
    <p style="background-color:transparent;"> &nbsp;</p>
    </div>
    <div class="icon">
    </div>
    <a href="<?=URL::to("modul_member/member")?>" class="small-box-footer col-md-12" style="color:black">Lihat Fitur <i class="fa fa-arrow-circle-right"></i></a>
    </div>
  </div>
</div> 
@endsection
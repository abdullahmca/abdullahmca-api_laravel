@extends('template')

@section('container')
    <form action="{{ url('admin/users/simpan_tambah') }}" method="post">
        {{ csrf_field() }}
        <div class="form-group">
            <label for="menu" class="control-label col-md-2">{{ 'Nama Pegawai' }}</label>
            <label class="col-md-9">
            <input class="form-control" name="admin" type="text" id="admin" value="" >
            </label>
        </div>
        <div class="form-group">
            <label for="menu" class="control-label col-md-2">{{ 'NIK Pegawai' }}</label>
            <label class="col-md-9">
            <input class="form-control" name="nik_admin" maxlength="16" type="text" id="nik_admin" value="" >
            </label>
        </div>
        <div class="form-group">
            <label for="menu" class="control-label col-md-2">{{ 'Passwod' }}</label>
            <label class="col-md-9">
            <input class="form-control" name="nik_admin" type="password" id="password" value="" >
            </label>
            <label for="menu" class="control-label col-md-2">{{ 'Ulangi Passwod' }}</label>
            <label class="col-md-9">
            <input class="form-control" name="nik_admin" type="password" id="password_ulang" value="" >
            </label>
        </div>
        <div class="form-group">
            <label class="col-md-2" id=""></label>
            <label class="col-md-2" id="labelcek"></label>
        </div>
        <div class="form-group">
            <input class="btn btn-primary" type="submit" value="Tambah Data">
        </div>
    </form>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script type="text/javascript">
    $(document).ready(function() {
        // console.log('add data...');
    });
   $("#password").on('keyup', function(){
    if($(this).val()==$('#password').val()){
        document.getElementById('labelcek').innerHTML = "<font style='color:green'>)* sama";
    }else{        
        document.getElementById('labelcek').innerHTML = "<font style='color:red'>)* tida sama";
    }
   });
   $("#password_ulang").on('keyup', function(){
    if($(this).val()==$('#password').val()){
        document.getElementById('labelcek').innerHTML = "<font style='color:green'>)* sama";
    }else{        
        document.getElementById('labelcek').innerHTML = "<font style='color:red'>)* tida sama";
    }
   });
   $("#nik_admin").on('keyup', function(){
    // var kata = document.getElementsById("nik_admin")[0].getAttribute("lang");
    console.log($(this).val().length);
    if($(this).val().length==16){
        document.getElementById('labelcek').innerHTML = "<font style='color:green'>)* ok";
    }else if($(this).val().length>16){
        document.getElementById('labelcek').innerHTML = "<font style='color:green'>)* NIK Lebih ";
    }else{        
        document.getElementById('labelcek').innerHTML = "<font style='color:red'>)* NIK kurang...!";
    }
   });
        
    </script>
@endsection
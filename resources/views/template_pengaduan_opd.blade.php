
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Diskominfo</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel = "icon" href ="{{ URL::asset('assets/new_temp') }}/images/faces/logo_clp.png" type = "image/x-icon">
  <meta name="csrf-token" content="{{ csrf_token() }}"> 
  <!-- Font Awesome -->
  <link rel="stylesheet" href="{{ URL::asset('assets/') }}/plugins/fontawesome-free/css/all.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Tempusdominus Bbootstrap 4 -->
  <link rel="stylesheet" href="{{ URL::asset('assets/') }}/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css">
  <!-- iCheck -->
  <link rel="stylesheet" href="{{ URL::asset('assets/') }}/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <!-- JQVMap -->
  <link rel="stylesheet" href="{{ URL::asset('assets/') }}/plugins/jqvmap/jqvmap.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="{{ URL::asset('assets/') }}/dist/css/adminlte.min.css">
  <!-- overlayScrollbars -->
  <link rel="stylesheet" href="{{ URL::asset('assets/') }}/plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
  <!-- Daterange picker -->
  <link rel="stylesheet" href="{{ URL::asset('assets/') }}/plugins/daterangepicker/daterangepicker.css">
  <!-- summernote -->
  <link rel="stylesheet" href="{{ URL::asset('assets/') }}/plugins/summernote/summernote-bs4.css">
  <!-- Google Font: Source Sans Pro -->
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
</head>
<body class="hold-transition sidebar-mini layout-fixed">
  <?php 
    $res=DB::table('user_opd')->select('nik','password','nama_user','kode_opd')->where('nik',Session::get('nik_admin_opd'))
    ->first();
    if($res){
    $admin=$res->nama_user;
    }else{
      $admin='';
    }
  ?>
  <div class="wrapper">

    <!-- Navbar -->
    <nav class="main-header navbar navbar-expand navbar-white navbar-light">
      <!-- Left navbar links -->
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
        </li>
      </ul>
      <!-- Right navbar links -->
      <ul class="navbar-nav ml-auto">
        <!-- Notifications Dropdown Menu -->
        <li class="nav-item dropdown">
          <a class="nav-link" data-toggle="dropdown" href="#">
            <i class="far fa-user"></i>
            <span class="badge badge-warning navbar-badge">&nbsp;</span>
          </a>
          <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
            <center>
              <img src="#">
            </center>
            <span class="dropdown-item dropdown-header"><?=$admin?></span>
            <div class="dropdown-divider"></div>
            <a href="#" class="dropdown-item">
              <a href="{{route('pengaduan/ubah_password')}}" class="dropdown-item dropdown-footer btn btn-warning btn-sm">Ubah Password</a>
              <a href="{{route('pengaduan/login')}}" class="dropdown-item dropdown-footer btn btn-danger btn-sm">Keluar</a>
            </div>
          </li>
        </ul>
      </nav>
      <!-- /.navbar -->

      <!-- Main Sidebar Container -->
      <aside class="main-sidebar sidebar-light-primary elevation-4">
        <!-- Brand Logo -->
        <a href="<?=URL::to('pengaduan/dashbord')?>" class="brand-link">
          <img src="{{ URL::asset('assets/') }}/img/logo_clp.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3"
          style="opacity: .8">
          <span class="brand-text font-weight-light">DISKOMINFO</span>
        </a>

        <!-- Sidebar -->
        <div class="sidebar">
          <!-- Sidebar Menu -->
          <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
            <li class="nav-item">
              <a href="<?=URL::to('pengaduan/dashbord')?>" class="nav-link">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>
                Dashbord
              </p>
              </a>
            </li>
            <?php 
              $user=DB::table('user_opd')
              ->select('nik','nama_user')
              ->where('nik',Session::get('nik_admin_opd'))
              ->first();
              //,DB::raw('COUNT(master_menu_opd.issue_id) as followers')
              $menu_nav=DB::table('user_menu_opd')->select('*')->where('id_user','=',Session::get('nik_admin_opd'))->get();
              $label_menu = DB::table('master_menu_opd')
                          // ->join('user_menu', 'user_menu.id_menu', '=', 'master_menu_opd.id')
                          ->select('master_menu_opd.*')
                          ->where('parent','=','true')
                          ->get();
              $hitung = DB::table('master_menu_opd')
                          ->join('user_menu', 'user_menu.id_menu', '=', 'master_menu_opd.id')
                          ->select('master_menu_opd.parent')
                          ->distinct()
                          // ->where('parent','=','true')
                          ->where('id_user','=',Session::get('nik_admin'))
                          ->get();$a=0;
              foreach($hitung as $htg){
              $label_menu_ = DB::table('master_menu_opd')
                          // ->join('user_menu', 'user_menu.id_menu', '=', 'master_menu_opd.id')
                          ->select('master_menu_opd.*')
                          // ->where('parent','=','true')
                          ->where('id','=',$htg->parent)
                          ->get();
                          // print_r($label_menu_);


              if($label_menu_){
              foreach($label_menu_ as $lm){$a++;
                  $count = DB::table('user_menu_opd')->count();
              ?>

              <li class="nav-item has-treeview">
                <a href="#" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>
                      <?=$lm->menu?>
                    <i class="fas fa-angle-left right"></i>
                    <!-- <span class="badge badge-info right"><?=$a?></span> -->
                  </p>
                </a>
                <ul class="nav nav-treeview">
                <?php
                  foreach($menu_nav as $men){//->where('parent','=',$lm->id)
                  $menu_lis=DB::table('master_menu')->where('parent','=',$lm->id)->where('id','=',$men->id_menu)->select('*')->first();
                  if($menu_lis){?>
                  <li class="nav-item">
                      <a href="<?=URL::to($menu_lis->link)?>" class="nav-link">
                    <i class="nav-icon <?=$menu_lis->icon?>"></i>
                    <!-- <a href="<?=URL::to($menu_lis->link)?>" class="nav-link"> -->
                    <p>
                      <?=$menu_lis->menu?>
                    </p>
                    </a>
                  </li>
                  <?php }else{} 
                      }?>
                </ul>
              </li>
              <?php }
              }else{}$a=0;}?>
            @yield('nav')
            </ul>
          </nav>
          <!-- /.sidebar-menu -->
        </div>
        <!-- /.sidebar -->
      </aside>

      <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
          <div class="container-fluid">
            <div class="row mb-2">
              <div class="col-sm-6">
                <h1 class="m-0 text-dark">Dashboard</h1>
              </div><!-- /.col -->
            </div><!-- /.row -->
          </div><!-- /.container-fluid -->
        </div>
        <!-- /.content-header -->

        <!-- Main content -->
        <section class="content">
          <div class="container-fluid">
            <!-- Small boxes (Stat box) -->
            @yield('container')
            <!-- /.row -->
          </div><!-- /.container-fluid -->
        </section>
        <!-- /.content -->
      </div>
      <!-- /.content-wrapper -->
      <footer class="main-footer">
        <strong>Copyright &copy; 2022 <a href="#">Diskominfo Cilacap</a>.</strong>
        All rights reserved.
        <div class="float-right d-none d-sm-inline-block">
          <!-- <b>Version</b> 3.0.4 -->
        </div>
      </footer>

      <!-- Control Sidebar -->
      <aside class="control-sidebar control-sidebar-light"> <!--atau light-->
        <!-- Control sidebar content goes here -->
      </aside>
      <!-- /.control-sidebar -->
    </div>
    <!-- ./wrapper -->

    <!-- jQuery -->
    <!-- <script src="{{ URL::asset('assets/') }}/plugins/jquery/jquery.min.js"></script> -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script> 
    <!-- jQuery UI 1.11.4 -->
    <script src="{{ URL::asset('assets/') }}/plugins/jquery-ui/jquery-ui.min.js"></script>
    <!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
    <script>
      $.widget.bridge('uibutton', $.ui.button)
    </script>
    <!-- Bootstrap 4 -->
    <script src="{{ URL::asset('assets/') }}/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- ChartJS -->
    <script src="{{ URL::asset('assets/') }}/plugins/chart.js/Chart.min.js"></script>
    <!-- Sparkline -->
    <script src="{{ URL::asset('assets/') }}/plugins/sparklines/sparkline.js"></script>
    <!-- JQVMap -->
<!--     <script src="{{ URL::asset('assets/') }}/plugins/jqvmap/jquery.vmap.min.js"></script>
    <script src="{{ URL::asset('assets/') }}/plugins/jqvmap/maps/jquery.vmap.usa.js"></script> -->
    <!-- jQuery Knob Chart -->
    <script src="{{ URL::asset('assets/') }}/plugins/jquery-knob/jquery.knob.min.js"></script>
    <!-- daterangepicker -->
    <script src="{{ URL::asset('assets/') }}/plugins/moment/moment.min.js"></script>
    <script src="{{ URL::asset('assets/') }}/plugins/daterangepicker/daterangepicker.js"></script>
    <!-- Tempusdominus Bootstrap 4 -->
    <script src="{{ URL::asset('assets/') }}/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js"></script>
    <!-- Summernote -->
    <script src="{{ URL::asset('assets/') }}/plugins/summernote/summernote-bs4.min.js"></script>
    <!-- overlayScrollbars -->
    <script src="{{ URL::asset('assets/') }}/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
    <!-- AdminLTE App -->
    <script src="{{ URL::asset('assets/') }}/dist/js/adminlte.js"></script>
    <!-- AdminLTE dashboard demo (This is only for demo purposes) -->
    <script src="{{ URL::asset('assets/') }}/dist/js/pages/dashboard.js"></script>
    <!-- AdminLTE for demo purposes -->
    <script src="{{ URL::asset('assets/') }}/dist/js/demo.js"></script>
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script type="text/javascript">
    $(document).ready(function() {
        $(".select2").select2();
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        }); 
    }); 
</script>
<script>
    $.ajaxSetup({
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});

    function cari_kab(val) {
        $.ajax({
            type: "POST",
            url: " {{ url('puskesmas/data_kota') }}",
            data: {
                id_prov:val,
                jenis:$('#provinsi').attr("data-id")
            },
            success: function(response){

               $('#kab').html(response);
           }
       });
    }
    function cari_kec(val) {
        $.ajaxSetup({
          headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
        $.ajax({
            type: "POST",
            url: " {{ url('puskesmas/data_kota') }}",
            data: {
                id_prov:val,
                jenis:$('#kab').attr("data-id")
            },
            success: function(response){

               $('#kec').html(response);
           }
       });
    }  
    function cari_desa(val) {
        $.ajaxSetup({
          headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    // alert(val+'='+$('#kec').attr("data-id"))
    $.ajax({
        type: "POST",
        url: " {{ url('puskesmas/data_kota') }}",
        data: {
            id_prov:val,
            jenis:$('#kec').attr("data-id")
        },
        success: function(response){

           $('#desa').html(response);
       }
   });
}   
</script>
  </body>
  </html>

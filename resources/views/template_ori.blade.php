<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>KOMINFO</title>
  <!-- add icon link -->
        <link rel = "icon" href ="{{ URL::asset('assets/new_temp') }}/images/faces/logo_clp.png" type = "image/x-icon">
    <!-- plugins:css -->
    <link rel="stylesheet" href="{{ URL::asset('assets/new_temp') }}/vendors/mdi/css/materialdesignicons.min.css">
    <link rel="stylesheet" href="{{ URL::asset('assets/new_temp') }}/vendors/flag-icon-css/css/flag-icon.min.css">
    <link rel="stylesheet" href="{{ URL::asset('assets/new_temp') }}/vendors/css/vendor.bundle.base.css">
    <!-- endinject -->
    <!-- Plugin css for this page -->
    <link rel="stylesheet" href="{{ URL::asset('assets/new_temp') }}/vendors/jquery-bar-rating/css-stars.css" />
    <link rel="stylesheet" href="{{ URL::asset('assets/new_temp') }}/vendors/font-awesome/css/font-awesome.min.css" />
    <!-- End plugin css for this page -->
    <!-- inject:css -->
    <!-- endinject -->
    <!-- Layout styles -->
    <link rel="stylesheet" href="{{ URL::asset('assets/new_temp') }}/css/demo_1/style.css" />
    <style type="text/css">
        thead{
            background-color: #f0f0f0;
        }
    </style>
  </head>
<style type="text/css">
    .select2-selection__rendered{
        margin-top: -2.5%;
    }
</style>

  <body>
  <?php
    $res=DB::table('tbl_user_faskes')->select('nik_admin','pass','admin','id_faskes','dashbord')
    // ->where('nik_admin',Session::get('nik_admin'))
    ->first();
    if($res){
    $admin=$res->admin;
    }else{
      $admin='';
    }
  ?>
    <div class="container-scroller">
      <div class="row p-0 m-0 proBanner" id="proBanner">
        <div class="col-md-12 p-0 m-0" style="display: none;">
          <div class="card-body card-body-padding d-flex align-items-center justify-content-between">
            <div class="ps-lg-1">
              <div class="d-flex align-items-center justify-content-between">
                <p class="mb-0 font-weight-medium me-3 buy-now-text">Free 24/7 customer support, updates, and more with this template!</p>
                <a href="https://www.bootstrapdash.com/product/plus-admin-template/?utm_source=organic&utm_medium=banner&utm_campaign=buynow_demo" target="_blank" class="btn me-2 buy-now-btn border-0">Get Pro</a>
              </div>
            </div>
            <div class="d-flex align-items-center justify-content-between">
              <a href="https://www.bootstrapdash.com/product/plus-admin-template/"><i class="mdi mdi-home me-3 text-white"></i></a>
              <button id="bannerClose" class="btn border-0 p-0">
                <i class="mdi mdi-close text-white me-0"></i>
              </button>
            </div>
          </div>
        </div>
      </div>
      <!-- partial:partials/_sidebar.html -->
      <nav class="sidebar sidebar-offcanvas" id="sidebar">
        <ul class="nav">
          <li class="nav-item nav-profile border-bottom">
            <a href="#" class="nav-link flex-column">
              <div class="nav-profile-image">
                <img src="{{ URL::asset('assets/new_temp') }}/images/faces/logo_clp.png" alt="profile" />
                <!--change to offline or busy as needed-->
              </div>
              <div class="nav-profile-text d-flex ms-0 mb-3 flex-column">
                <span class="font-weight-semibold mb-1 mt-2 text-center">Admin</span>
                <!-- <span class="text-secondary icon-sm text-center">$3499.00</span> -->
              </div>
            </a>
          </li>
          <li class="nav-item pt-3">
            <a class="nav-link d-block" href="<?=URL::to($res->dashbord)?>">
              <div class="small font-weight-light pt-1">
              <h2>DISKOMINFO</h2>Pemkab Cilacap
            </div>
            </a>
              <!-- kotak cari -->
<!--             <form style="display:none;" class="d-flex align-items-center" action="#"> 
              <div class="input-group">
                <div class="input-group-prepend">
                  <i class="input-group-text border-0 mdi mdi-magnify"></i>
                </div>
                <input type="text" class="form-control border-0" placeholder="Search" />
              </div>
            </form> -->
          </li>
          <li class="pt-2 pb-1">
            <span class="nav-item-head">DAFTAR LAYANAN</span>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="<?=URL::to($res->dashbord)?>">
              <i class="mdi mdi-compass-outline menu-icon"></i>
              <span class="menu-title">Dashboard</span>
            </a>
          </li>
          @yield('nav')
          <li class="nav-item">
            <a class="nav-link" data-bs-toggle="collapse" href="#ui-user" aria-expanded="false" aria-controls="ui-basic">
              <i class="mdi mdi-account"></i>
              <span class="menu-title" style="margin-left:2%"><b><?=$admin?></b></span>
              <i class="menu-arrow"></i>
            </a>
            <div class="collapse" id="ui-user">
              <ul class="nav flex-column sub-menu">
                  <li class="nav-item">
                    <a style="color:#000" title="keluar akun" href="" class='nav_link btn btn-info col-md-12'><i style="color:black;" class="mdi mdi-arrow-right"></i>Keluar</a>
                  </li>
              </ul>
            </div>
          </li>
          <?php 
            $daf_menu = DB::table('master_menu')
            ->where('parent', '=', 'true')
            ->select('*')
            ->orderBy('id', 'desc')
            ->get();
            $a=0;
            foreach($daf_menu as $parentt){$a++;
          ?>
          <li class="nav-item" style="display:none">
            <a class="nav-link" data-bs-toggle="collapse" href="#ui-basic<?=$a?>" aria-expanded="false" aria-controls="ui-basic">
              <i class="<?=$parentt->icon?>"></i>
              <span class="menu-title"><?=$parentt->menu?></span>
              <i class="menu-arrow"></i>
            </a>
            <div class="collapse" id="ui-basic<?=$a?>">
              <ul class="nav flex-column sub-menu">
                <?php 
                    $jenis = DB::table('master_menu')
                    ->where('parent', '=', $parentt->id)
                    ->select('*')
                    ->orderBy('id', 'desc')
                    ->get();
                    foreach($jenis as $jns){?>
                <li class="nav-item">
                  <a class="nav-link" href="<?=URL::to($jns->link)?>">
                    <i style="color:black;" class="<?=$jns->icon?>"></i><?=$jns->menu?></a>
                </li>
                <?php }?>
              </ul>
            </div>
          </li>
          <?php }?>
        </ul>
      </nav>
      <!-- partial -->
      <div class="container-fluid page-body-wrapper">
        <!-- partial:partials/_settings-panel.html -->
       <!--  <div id="settings-trigger"><i class="mdi mdi-settings"></i></div> -->
        <div id="theme-settings" class="settings-panel">
          <i class="settings-close mdi mdi-close"></i>
          <p class="settings-heading">SIDEBAR SKINS</p>
          <div class="sidebar-bg-options selected" id="sidebar-default-theme">
            <div class="img-ss rounded-circle bg-light border me-3"></div>Default
          </div>
          <div class="sidebar-bg-options" id="sidebar-dark-theme">
            <div class="img-ss rounded-circle bg-dark border me-3"></div>Dark
          </div>
          <p class="settings-heading mt-2">HEADER SKINS</p>
          <div class="color-tiles mx-0 px-4">
            <div class="tiles default primary"></div>
            <div class="tiles success"></div>
            <div class="tiles warning"></div>
            <div class="tiles danger"></div>
            <div class="tiles info"></div>
            <div class="tiles dark"></div>
            <div class="tiles light"></div>
          </div>
        </div>
        <!-- partial -->
        <!-- partial:partials/_navbar.html -->
        <nav class="navbar default-layout-navbar col-lg-12 col-12 p-0 fixed-top d-flex flex-row">
          <div class="navbar-menu-wrapper d-flex align-items-stretch">
            <button class="navbar-toggler navbar-toggler align-self-center" type="button" data-toggle="minimize">
              <span class="mdi mdi-chevron-double-left"></span>
            </button>
            <div class="text-center navbar-brand-wrapper d-flex align-items-center justify-content-center">
              <a class="navbar-brand brand-logo-mini" href="<?=URL::to($res->dashbord)?>"><img style="width:80%;height: 50%" src="{{ URL::asset('assets/new_temp') }}/images/logo_kominfo.png" alt="logo" /></a>
            </div>
            <ul class="navbar-nav">
              <li class="nav-item dropdown" style="display:none">
                <a class="nav-link" id="messageDropdown" href="#" data-bs-toggle="dropdown" aria-expanded="false">
                  <i class="mdi mdi-email-outline"></i>
                </a>
                <div class="dropdown-menu dropdown-menu-left navbar-dropdown preview-list" aria-labelledby="messageDropdown">
                  <h6 class="p-3 mb-0 font-weight-semibold">Pesan</h6>
                  <div class="dropdown-divider"></div>
                  <a class="dropdown-item preview-item">
                    <div class="preview-thumbnail">
                      <!-- <img src="{{ URL::asset('assets/new_temp') }}/images/faces/face1.jpg" alt="image" class="profile-pic"> -->
                    </div>
                    <div class="preview-item-content d-flex align-items-start flex-column justify-content-center">
                      <h6 class="preview-subject ellipsis mb-1 font-weight-normal">Mark send you a message</h6>
                      <p class="text-gray mb-0"> 1 Minutes ago </p>
                    </div>
                  </a>
                  <div class="dropdown-divider"></div>
                  <h6 class="p-3 mb-0 text-center text-primary font-13">Ada Pesan Baru</h6>
                </div>
              </li>
              <li class="nav-item dropdown ms-3" style="display:none">
                <a class="nav-link" id="notificationDropdown" href="#" data-bs-toggle="dropdown">
                  <i class="mdi mdi-bell-outline"></i>
                </a>
                <div class="dropdown-menu dropdown-menu-left navbar-dropdown preview-list" aria-labelledby="notificationDropdown">
                  <h6 class="px-3 py-3 font-weight-semibold mb-0">Pemberitahuan</h6>
                  <div class="dropdown-divider"></div>
                  <h6 class="p-3 font-13 mb-0 text-primary text-center">View all notifications</h6>
                </div>
              </li>
            </ul>
            <ul class="navbar-nav navbar-nav-right">
              <li class="nav-item nav-logout d-none d-md-block me-3">
                <a class="nav-link" href="#">Status</a>
              </li>
              <li class="nav-item nav-profile dropdown d-none d-md-block">
                <!-- <a  class="nav-link dropdown-toggle" id="profileDropdown" href="#" data-bs-toggle="dropdown" aria-expanded="false">
                  <div class="nav-profile-text">English </div>
                </a> -->
                <div class="dropdown-menu center navbar-dropdown" aria-labelledby="profileDropdown">
                  <a class="dropdown-item" href="#">
                    <i class="flag-icon flag-icon-bl me-3"></i> French </a>
                  <div class="dropdown-divider"></div>
                  <a class="dropdown-item" href="#">
                    <i class="flag-icon flag-icon-cn me-3"></i> Chinese </a>
                  <div class="dropdown-divider"></div>
                  <a class="dropdown-item" href="#">
                    <i class="flag-icon flag-icon-de me-3"></i> German </a>
                  <div class="dropdown-divider"></div>
                  <a class="dropdown-item" href="#">
                    <i class="flag-icon flag-icon-ru me-3"></i>Russian </a>
                </div>
              </li>
              <li class="nav-item nav-logout d-none d-lg-block">
                <a class="nav-link" href="<?=URL::to($res->dashbord)?>">
                  <i class="mdi mdi-home-circle"></i>
                </a>
              </li>
            </ul>
            <button class="navbar-toggler navbar-toggler-right d-lg-none align-self-center" type="button" data-toggle="offcanvas">
              <span class="mdi mdi-menu"></span>
            </button>
          </div>
        </nav>
        <!-- partial -->
        <div class="main-panel">
          <div class="content-wrapper pb-0" style="display: none;">
            <div class="page-header flex-wrap">
              <div class="header-left">
                <button class="btn btn-primary mb-2 mb-md-0 me-2"> Create new document </button>
                <button class="btn btn-outline-primary bg-white mb-2 mb-md-0"> Import documents </button>
              </div>
              <div class="header-right d-flex flex-wrap mt-2 mt-sm-0">
                <div class="d-flex align-items-center">
                  <a href="#">
                    <p class="m-0 pe-3">Dashboard</p>
                  </a>
                  <a class="ps-3 me-4" href="#">
                    <p class="m-0">ADE-00234</p>
                  </a>
                </div>
                <button type="button" class="btn btn-primary mt-2 mt-sm-0 btn-icon-text">
                  <i class="mdi mdi-plus-circle"></i> Add Prodcut </button>
              </div>
            </div>
            <!-- first row starts here -->
            <div class="row">
              <div class="col-xl-9 stretch-card grid-margin">
                <div class="card">
                  <div class="card-body">
                    <div class="d-flex justify-content-between flex-wrap">
                      <div>
                        <div class="card-title mb-0">Sales Revenue</div>
                        <h3 class="font-weight-bold mb-0">$32,409</h3>
                      </div>
                      <div>
                        <div class="d-flex flex-wrap pt-2 justify-content-between sales-header-right">
                          <div class="d-flex me-5">
                            <button type="button" class="btn btn-social-icon btn-outline-sales">
                              <i class="mdi mdi-inbox-arrow-down"></i>
                            </button>
                            <div class="ps-2">
                              <h4 class="mb-0 font-weight-semibold head-count"> $8,217 </h4>
                              <span class="font-10 font-weight-semibold text-muted">TOTAL SALES</span>
                            </div>
                          </div>
                          <div class="d-flex me-3 mt-2 mt-sm-0">
                            <button type="button" class="btn btn-social-icon btn-outline-sales profit">
                              <i class="mdi mdi-cash text-info"></i>
                            </button>
                            <div class="ps-2">
                              <h4 class="mb-0 font-weight-semibold head-count"> 2,804 </h4>
                              <span class="font-10 font-weight-semibold text-muted">TOTAL PROFIT</span>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                    <p class="text-muted font-13 mt-2 mt-sm-0"> Your sales monitoring dashboard template. <a class="text-muted font-13" href="#"><u>Learn more</u></a>
                    </p>
                    <div class="flot-chart-wrapper">
                      <div id="flotChart" class="flot-chart">
                        <canvas class="flot-base"></canvas>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-xl-3 stretch-card grid-margin">
                <div class="card card-img">
                  <div class="card-body d-flex align-items-center">
                    <div class="text-white">
                      <h1 class="font-20 font-weight-semibold mb-0"> Get premium </h1>
                      <h1 class="font-20 font-weight-semibold">account!</h1>
                      <p>to optimize your selling prodcut</p>
                      <p class="font-10 font-weight-semibold"> Enjoy the advantage of premium. </p>
                      <button class="btn bg-white font-12">Get Premium</button>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <!-- chart row starts here -->
            <div class="row">
              <div class="col-sm-6 stretch-card grid-margin">
                <div class="card">
                  <div class="card-body">
                    <div class="d-flex justify-content-between">
                      <div class="card-title"> Customers <small class="d-block text-muted">August 01 - August 31</small>
                      </div>
                      <div class="d-flex text-muted font-20">
                        <i class="mdi mdi-printer mouse-pointer"></i>
                        <i class="mdi mdi-help-circle-outline ms-2 mouse-pointer"></i>
                      </div>
                    </div>
                    <h3 class="font-weight-bold mb-0"> 2,409 <span class="text-success h5">4,5%<i class="mdi mdi-arrow-up"></i></span>
                    </h3>
                    <span class="text-muted font-13">Avg customers/Day</span>
                    <div class="line-chart-wrapper">
                      <canvas id="linechart" height="80"></canvas>
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-sm-6 stretch-card grid-margin">
                <div class="card">
                  <div class="card-body">
                    <div class="d-flex justify-content-between">
                      <div class="card-title"> Conversions <small class="d-block text-muted">August 01 - August 31</small>
                      </div>
                      <div class="d-flex text-muted font-20">
                        <i class="mdi mdi-printer mouse-pointer"></i>
                        <i class="mdi mdi-help-circle-outline ms-2 mouse-pointer"></i>
                      </div>
                    </div>
                    <h3 class="font-weight-bold mb-0"> 0.40% <span class="text-success h5">0.20%<i class="mdi mdi-arrow-up"></i></span>
                    </h3>
                    <span class="text-muted font-13">Avg customers/Day</span>
                    <div class="bar-chart-wrapper">
                      <canvas id="barchart" height="80"></canvas>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <!-- image card row starts here -->
          </div>
          <!-- content-wrapper ends -->
          <div class="content-wrapper">
            @yield('container')
            <!-- <div class="page-header">
              <h3 class="page-title">Dashbord</h3> -->
              <!-- <nav aria-label="breadcrub">
                <ol class="breadcrumb">
                  <li class="breadcrumb-item"><a href="#">Dashbord</a></li>
                  <li class="breadcrumb-item active" aria-current="page"> Dashbord </li>
                </ol>
              </nav> -->
            <!-- </div> -->
            <!-- <div class="row">
              <div class="col-lg-3 grid-margin stretch-card">
                <div class="card">
                  <div class="card-body">
                    <div class="chartjs-size-monitor"><div class="chartjs-size-monitor-expand"><div class=""></div></div><div class="chartjs-size-monitor-shrink"><div class=""></div></div></div>
                    <h4>Menu 1</h4>
                    <canvas id="lineChart" style="height: 100px; display: block; width: 446px;" width="446" height="223" class="chartjs-render-monitor"></canvas>
                  </div>
                </div>
              </div>
            </div> -->
          </div>
          <!-- partial:partials/_footer.html -->
          <footer class="footer">
            <div class="d-sm-flex justify-content-center justify-content-sm-between">
              <span class="text-muted text-center text-sm-left d-block d-sm-inline-block">Copyright © 2022 <a href="#" target="_blank">Diskominfo</a>. All rights reserved.</span>
            </div>
          </footer>
          <!-- partial -->
        </div>
        <!-- main-panel ends -->
      </div>
      <!-- page-body-wrapper ends -->
    </div>
    <!-- container-scroller -->
    <!-- plugins:js -->
    <script src="{{ URL::asset('assets/new_temp') }}/vendors/js/vendor.bundle.base.js"></script>
    <!-- endinject -->
    <!-- Plugin js for this page -->
    <script src="{{ URL::asset('assets/new_temp') }}/vendors/jquery-bar-rating/jquery.barrating.min.js"></script>
    <script src="{{ URL::asset('assets/new_temp') }}/vendors/chart.js/Chart.min.js"></script>
    <script src="{{ URL::asset('assets/new_temp') }}/vendors/flot/jquery.flot.js"></script>
    <script src="{{ URL::asset('assets/new_temp') }}/vendors/flot/jquery.flot.resize.js"></script>
    <script src="{{ URL::asset('assets/new_temp') }}/vendors/flot/jquery.flot.categories.js"></script>
    <script src="{{ URL::asset('assets/new_temp') }}/vendors/flot/jquery.flot.fillbetween.js"></script>
    <script src="{{ URL::asset('assets/new_temp') }}/vendors/flot/jquery.flot.stack.js"></script>
    <script src="{{ URL::asset('assets/new_temp') }}/js/jquery.cookie.js" type="text/javascript"></script>
    <!-- End plugin js for this page -->
    <!-- inject:js -->
    <script src="{{ URL::asset('assets/new_temp') }}/js/off-canvas.js"></script>
    <script src="{{ URL::asset('assets/new_temp') }}/js/hoverable-collapse.js"></script>
    <script src="{{ URL::asset('assets/new_temp') }}/js/misc.js"></script>
    <script src="{{ URL::asset('assets/new_temp') }}/js/settings.js"></script>
    <script src="{{ URL::asset('assets/new_temp') }}/js/todolist.js"></script>
    <!-- endinject -->
    <!-- Custom js for this page -->
    <script src="{{ URL::asset('assets/new_temp') }}/js/dashboard.js"></script>
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
    <!-- End custom js for this page -->
  </body>
</html>
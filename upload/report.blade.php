<style type="text/css">
    .href{
        margin-bottom: 2%;
        /*font-color: #fff;*/
    }
    #myChart{
        width: 50%;
        height: 100px;
    }
</style>
<?php 
    $data=DB::table('puskesmas_transaksi_keu')->select('*')->limit(10)->orderby('tanggal','asc')->orderby('create_date','desc')->get();
    $data2=DB::table('puskesmas_transaksi_keu')
    ->join('tbl_user_faskes','tbl_user_faskes.nik_admin','=','puskesmas_transaksi_keu.nik_user')
    ->join('tbl_faskes','tbl_faskes.id','=','tbl_user_faskes.id_faskes')
    // ->select(DB::raw('SUM(nominal) as ttl'))
    ->select(DB::raw('DISTINCT id_faskes'))
    //->orderby('tanggal','asc')
    ->get();
    $daily= date('Y-m-d');
    $from = date('2022-07-12');
    $to = date('2018-05-02');

    $faskes_daily=DB::table('puskesmas_transaksi_keu')
    ->join('tbl_user_faskes','tbl_user_faskes.nik_admin','=','puskesmas_transaksi_keu.nik_user')
    ->join('tbl_faskes','tbl_faskes.id','=','tbl_user_faskes.id_faskes')
    // ->select(DB::raw('SUM(nominal) as ttl'))
    ->select(DB::raw('DISTINCT id_faskes'))
    ->where('tanggal','=',$from)
    //->orderby('tanggal','asc')
    ->get();
?>
<div style="display: none;position : fixed ;z-index: 100000;margin-top: 5%;margin-left: 80%;" class="col-md-2">
    <div class="card">
        <div class="card-body href">
            <a href="#per_faskes2" style="border-radius: 25px;" class="btn btn-default btn-sm col-md-12">
                Per Faskes
            </a>
            <a href="#daily_perfaskes2" style="border-radius: 25px;" class="btn btn-default btn-sm col-md-12">
                Harian Faskes
            </a>
            <a href="#myChart2" style="border-radius: 25px;" class="btn btn-default btn-sm col-md-12">
                Last Transaksi
            </a>
        </div>
    </div>
</div>
@extends('template')
@section('nav')
<a href="#per_faskes2" style="border-radius: 25px;" class="btn btn-info btn-sm col-md-12 href">
    Per Faskes
</a>
<a href="#daily_perfaskes2" style="border-radius: 25px;" class="btn btn-info btn-sm col-md-12 href">
    Harian Faskes
</a>
<a href="#myChart2" style="border-radius: 25px;" class="btn btn-info btn-sm col-md-12 href">
    Last Transaksi
</a>
@endsection
@section('container')
<div class="col-md-12" id="per_faskes2">
<!-- <?=print_r($faskes_daily)?> -->
    <div class="card">
        <div class="card-header">Grafik Laporan Pendapatan (PerFaskes)</div>
        <div class="card-body">
            <canvas id="per_faskes" style="position: relative; height:90vh; width:80vw"></canvas>
        </div>
    </div>
</div>
<div class="col-md-12" id="daily_perfaskes2">
    <div class="card">
        <div class="card-header">Grafik Laporan Pendapatan (Daily per Faskes)</div>
        <div class="card-body">
            <canvas id="daily_perfaskes" style="position: relative; height:90vh; width:80vw"></canvas>
        </div>
    </div>
</div>
<div class="col-md-12" id="myChart2">
    <div class="card">
        <div class="card-header">Grafik Laporan Pendapatan (10 Transaksi)</div>
        <div class="card-body">
            <canvas id="myChart" style="position: relative; height:90vh; width:80vw"></canvas>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
const ctx = document.getElementById('myChart').getContext('2d');
const perfaskes = document.getElementById('per_faskes').getContext('2d');
const daily_perfaskes = document.getElementById('daily_perfaskes').getContext('2d');
const daily_perfaskesc = new Chart(daily_perfaskes, {
    data: {
        datasets: [{
            type: 'bar',
            label: 'nominal',
            // data: [10, 20, 50, 40],

            data: [
            <?php 
            $data1=array('10','20','50','40');
            $a=0;
            foreach($faskes_daily as $dat){
                $nom=DB::table('puskesmas_transaksi_keu')
                ->select(DB::raw('SUM(nominal) as ttl'))
                ->join('tbl_user_faskes','tbl_user_faskes.nik_admin','=','puskesmas_transaksi_keu.nik_user')
                ->where('tbl_user_faskes.id_faskes','=',$dat->id_faskes)
                ->where('tanggal','=',$from)
                ->first();
                echo "'".$nom->ttl."' ,";//$a++;
            }
            ?>
            ],
            backgroundColor: [

                'rgba(54, 162, 235, 0.2)',
                'rgba(54, 162, 235, 0.2)',
                'rgba(54, 162, 235, 0.2)',
                'rgba(54, 162, 235, 0.2)',
                // 'rgba(255, 99, 132, 0.2)',
                // 'rgba(54, 162, 235, 0.2)',
                // 'rgba(255, 206, 86, 0.2)',
                // 'rgba(75, 192, 192, 0.2)',
                // 'rgba(153, 102, 255, 0.2)',
                // 'rgba(255, 159, 64, 0.2)'
            ],
            borderColor: [

                'rgba(54, 162, 235, 1)',
                'rgba(54, 162, 235, 1)',
                'rgba(54, 162, 235, 1)',
                'rgba(54, 162, 235, 1)',
                // 'rgba(255, 99, 132, 1)',
                // 'rgba(54, 162, 235, 1)',
                // 'rgba(255, 206, 86, 1)',
                // 'rgba(75, 192, 192, 1)',
                // 'rgba(153, 102, 255, 1)',
                // 'rgba(255, 159, 64, 1)'
            ],
        }, 
        // {
        //     type: 'line',
        //     label: 'Progress',
        //     // data: [10, 20, 50, 40],

        //     data: [
        //     <?php 
        //     $data1=array('10','20','50','40');
        //     // $data=DB::table('puskesmas_transaksi_keu')->select('*')->get();
        //     $a=0;
        //     foreach($faskes_daily as $dat){
        //         $nom=DB::table('puskesmas_transaksi_keu')
        //         ->select(DB::raw('SUM(nominal) as ttl'))
        //         ->join('tbl_user_faskes','tbl_user_faskes.nik_admin','=','puskesmas_transaksi_keu.nik_user')
        //         ->where('tbl_user_faskes.id_faskes','=',$dat->id_faskes)
        //         ->where('tanggal','=',$from)
        //         ->first();
        //         echo "'".$nom->ttl."' ,";//$a++;
        //     }
        //     ?>
        //     ],
        //     backgroundColor: [
        //         'rgba(255, 99, 132, 0.2)',
        //         // 'rgba(54, 162, 235, 0.2)',
        //         // 'rgba(255, 206, 86, 0.2)',
        //         // 'rgba(75, 192, 192, 0.2)',
        //         // 'rgba(153, 102, 255, 0.2)',
        //         // 'rgba(255, 159, 64, 0.2)'
        //     ],
        //     borderColor: [
        //         'rgba(255, 99, 132, 1)',
        //         // 'rgba(54, 162, 235, 1)',
        //         // 'rgba(255, 206, 86, 1)',
        //         // 'rgba(75, 192, 192, 1)',
        //         // 'rgba(153, 102, 255, 1)',
        //         // 'rgba(255, 159, 64, 1)'
        //     ],
        // }
        ],
        labels: [
        <?php 
            foreach($data2 as $dat){
                $fas=DB::table('tbl_faskes')->select('name_faskes')->where('id','=',$dat->id_faskes)->first();
                echo "'".$fas->name_faskes."', ";//$a++;
                // echo "'".date_format(new DateTime(substr($dat->id_faskes,0,10)),"d-m-Y")."' ,";//$a++;
            }
            ?>
        // 'January', 'February', 'March', 'April'
        ]
    },
    options: {
        //responsive:true,
        //maintainAspectRatio: false,
        scales: {
            y: {
                beginAtZero: true
            }
        }
    }
    // options: options
});
const mixedChart2= new Chart(perfaskes,{
    data: {
        datasets: [{
            type: 'bar',
            label: 'nominal',
            // data: [10, 20, 50, 40],

            data: [
            <?php 
            $data1=array('10','20','50','40');
            $a=0;
            foreach($data2 as $dat){
                $nom=DB::table('puskesmas_transaksi_keu')
                ->select(DB::raw('SUM(nominal) as ttl'))
                ->join('tbl_user_faskes','tbl_user_faskes.nik_admin','=','puskesmas_transaksi_keu.nik_user')
                ->where('tbl_user_faskes.id_faskes','=',$dat->id_faskes)
                ->first();
                echo "'".$nom->ttl."' ,";//$a++;
            }
            ?>
            ],
            backgroundColor: [

                'rgba(54, 162, 235, 0.2)',
                'rgba(54, 162, 235, 0.2)',
                'rgba(54, 162, 235, 0.2)',
                'rgba(54, 162, 235, 0.2)',
                // 'rgba(255, 99, 132, 0.2)',
                // 'rgba(54, 162, 235, 0.2)',
                // 'rgba(255, 206, 86, 0.2)',
                // 'rgba(75, 192, 192, 0.2)',
                // 'rgba(153, 102, 255, 0.2)',
                // 'rgba(255, 159, 64, 0.2)'
            ],
            borderColor: [

                'rgba(54, 162, 235, 1)',
                'rgba(54, 162, 235, 1)',
                'rgba(54, 162, 235, 1)',
                'rgba(54, 162, 235, 1)',
                // 'rgba(255, 99, 132, 1)',
                // 'rgba(54, 162, 235, 1)',
                // 'rgba(255, 206, 86, 1)',
                // 'rgba(75, 192, 192, 1)',
                // 'rgba(153, 102, 255, 1)',
                // 'rgba(255, 159, 64, 1)'
            ],
        }, /*{
            type: 'line',
            label: 'Progress',
            // data: [10, 20, 50, 40],

            data: [
            <?php 
            $data1=array('10','20','50','40');
            // $data=DB::table('puskesmas_transaksi_keu')->select('*')->get();
            $a=0;
            foreach($data2 as $dat){
                $nom=DB::table('puskesmas_transaksi_keu')
                ->select(DB::raw('SUM(nominal) as ttl'))
                ->join('tbl_user_faskes','tbl_user_faskes.nik_admin','=','puskesmas_transaksi_keu.nik_user')
                ->where('tbl_user_faskes.id_faskes','=',$dat->id_faskes)
                ->first();
                echo "'".$nom->ttl."' ,";//$a++;
            }
            ?>
            ],
            backgroundColor: [
                'rgba(255, 99, 132, 0.2)',
                // 'rgba(54, 162, 235, 0.2)',
                // 'rgba(255, 206, 86, 0.2)',
                // 'rgba(75, 192, 192, 0.2)',
                // 'rgba(153, 102, 255, 0.2)',
                // 'rgba(255, 159, 64, 0.2)'
            ],
            borderColor: [
                'rgba(255, 99, 132, 1)',
                // 'rgba(54, 162, 235, 1)',
                // 'rgba(255, 206, 86, 1)',
                // 'rgba(75, 192, 192, 1)',
                // 'rgba(153, 102, 255, 1)',
                // 'rgba(255, 159, 64, 1)'
            ],
        }*/],
        labels: [
        <?php 
            foreach($data2 as $dat){
                $fas=DB::table('tbl_faskes')->select('name_faskes')->where('id','=',$dat->id_faskes)->first();
                echo "'".$fas->name_faskes."', ";//$a++;
                // echo "'".date_format(new DateTime(substr($dat->id_faskes,0,10)),"d-m-Y")."' ,";//$a++;
            }
            ?>
        // 'January', 'February', 'March', 'April'
        ]
    },
    options: {
        //responsive:true,
        //maintainAspectRatio: false,
        scales: {
            y: {
                beginAtZero: true
            }
        }
    }
    // options: options
});
const mixedChart = new Chart(ctx, {
    data: {
        datasets: [{
            type: 'bar',
            label: 'nominal',
            // data: [10, 20, 50, 40],

            data: [
            <?php 
            $data1=array('10','20','50','40');
            $a=0;
            foreach($data as $dat){
                echo "'".$dat->nominal."' ,";//$a++;
            }
            ?>
            ],
            backgroundColor: [

                'rgba(54, 162, 235, 0.2)',
                'rgba(54, 162, 235, 0.2)',
                'rgba(54, 162, 235, 0.2)',
                'rgba(54, 162, 235, 0.2)',
                // 'rgba(255, 99, 132, 0.2)',
                // 'rgba(54, 162, 235, 0.2)',
                // 'rgba(255, 206, 86, 0.2)',
                // 'rgba(75, 192, 192, 0.2)',
                // 'rgba(153, 102, 255, 0.2)',
                // 'rgba(255, 159, 64, 0.2)'
            ],
            borderColor: [

                'rgba(54, 162, 235, 1)',
                'rgba(54, 162, 235, 1)',
                'rgba(54, 162, 235, 1)',
                'rgba(54, 162, 235, 1)',
                // 'rgba(255, 99, 132, 1)',
                // 'rgba(54, 162, 235, 1)',
                // 'rgba(255, 206, 86, 1)',
                // 'rgba(75, 192, 192, 1)',
                // 'rgba(153, 102, 255, 1)',
                // 'rgba(255, 159, 64, 1)'
            ],
        }, {
            type: 'line',
            label: 'Progress',
            // data: [10, 20, 50, 40],

            data: [
            <?php 
            $data1=array('10','20','50','40');
            // $data=DB::table('puskesmas_transaksi_keu')->select('*')->get();
            $a=0;
            foreach($data as $dat){
                echo "'".$dat->nominal."' ,";//$a++;
            }
            ?>
            ],
            backgroundColor: [
                'rgba(255, 99, 132, 0.2)',
                // 'rgba(54, 162, 235, 0.2)',
                // 'rgba(255, 206, 86, 0.2)',
                // 'rgba(75, 192, 192, 0.2)',
                // 'rgba(153, 102, 255, 0.2)',
                // 'rgba(255, 159, 64, 0.2)'
            ],
            borderColor: [
                'rgba(255, 99, 132, 1)',
                // 'rgba(54, 162, 235, 1)',
                // 'rgba(255, 206, 86, 1)',
                // 'rgba(75, 192, 192, 1)',
                // 'rgba(153, 102, 255, 1)',
                // 'rgba(255, 159, 64, 1)'
            ],
        }],
        labels: [
        <?php 
            foreach($data as $dat){
                echo "'".date_format(new DateTime(substr($dat->tanggal,0,10)),"d-m-Y")."' ,";//$a++;
            }
            ?>
        // 'January', 'February', 'March', 'April'
        ]
    },
    options: {
        //responsive:true,
        //maintainAspectRatio: false,
        scales: {
            y: {
                beginAtZero: true
            }
        }
    }
    // options: options
});
</script>
@endsection
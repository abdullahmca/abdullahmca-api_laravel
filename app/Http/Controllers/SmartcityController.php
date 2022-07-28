<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request; 
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use RealRashid\SweetAlert\Facades\Alert;
use DataTables;
use Illuminate\Support\Facades\Validator;
use Symfony\Component\Process\Process;
use Symfony\Component\Process\Exception\ProcessFailedException;

class SmartcityController extends Controller
{
    public function __construct()
    {
    }
  public function index(){
    return 'index';
  }
  public function dashbord_menu(){
  //  return "peta cilacap";   
    $res=DB::table('tbl_user_faskes')->select('nik_admin','pass','admin','id_faskes','dashbord')->where('nik_admin',Session::get('nik_admin'))
    ->first();
    $direct='';
    $dashbord='';
    if($res){
        $direct=$res->dashbord;
        $dashbord=$res->dashbord;
        if($dashbord=='/'){
            // return 'masuk ROOT';
            return view('peta.dashbord');
        }
        else{
            // return 'masuk USER';
            return redirect($direct);
        }
    }
    else{
        // return 'gagal';
            return redirect('/dashbord/login');
    }
  }
  public function dashbord_admin(){
  //  return "peta cilacap";    
  return view('peta.dashbord_master',["data"=>'ADMIN']);
  }
  public function dashbord_map(){
  //  return "peta cilacap";    
  return view('peta.dashbord_master',["data"=>'PETA']);
  }
  public function dashbord_surat(){
  //  return "peta cilacap";    
  return view('peta.dashbord_master',["data"=>'SURAT']);
  }
  public function dashbord_puskesmas(){
  //  return "peta cilacap";    
  return view('peta.dashbord_master',["data"=>'PUSKESMAS']);
  }
  public function template_test(){
    return view('template_py');
  }
  public function template(){
    //return "peta cilacap";    
    return view('peta.template');
  }
  public function dashbord2(){
    //return "peta cilacap";    
    return view('peta.dashmapp');
  }

  public function dashbord(){
    //return "peta cilacap";    
    return view('peta.dashmap');
  }    public function simpan_shp_action(Request $request)
    {
        if ($request->ajax()) {
            $data['koordinat']=$request->koordinat;
            $data['kec']=$request->kec;
            $data['kab']=$request->kab;
            $data['prov']=$request->prov;

            // return $data;
            return response()->json($data, 200, ['Content-Type' => 'application/json;charset=UTF-8', 'Charset' => 'utf-8'],
        JSON_UNESCAPED_UNICODE);
        }
        return view('peta.map');
    }
    public function loadpoligon(Request $request)
    {
        if ($request->ajax()) {
            $id=request()->post();
            // var_dump($id);
            $data = DB::table('jenis')
            ->where('id', '=', $id)
            ->select('*')
            ->orderBy('id', 'desc')
            // ->first();
            ->get();
            return response()->json($data, 200, ['Content-Type' => 'application/json;charset=UTF-8', 'Charset' => 'utf-8'],
        JSON_UNESCAPED_UNICODE);
        }
        return view('peta.map');
    }
    public function ubah_loaksi($id,Request $request){ 
        $data['lang']=$request['lang'];
        $data['lat']=$request['lat'];
        $data['id_kategori']=$request['kategori'];
        $data['id_jenis']=$request['jenis'];
        $data['icon']=$request['icon'];
        $data['nama_lokasi']=$request['nama_lokasi'];
        $res=DB::table('koordinatkota')
            ->where('id', $id) 
            ->update([
                'lang' =>$request->lang,
                'lat' =>$request->lat,
                'id_kategori' =>$request->kategori,
                'id_jenis' =>$request->jenis,
                'icon' =>$request->icon,
                'nama_lokasi' =>$request->nama_lokasi,
            ]);
            // ->update(['name_faskes' => $request->faskes]);
        return redirect('map/koordinat_lokasi')->with('flash_message', 'Admisi_pasien updated!');
    }
    public function edit_loaksi($id){
            $data = DB::table('koordinatkota')
            ->where('id', '=', $id)
            ->select('*')
            ->orderBy('id', 'desc')
            ->first();
        return view('peta.ubah_lokasi_koordinat',['data' => $data]);
    }
    public function tbl_lokasi(){
        return view('peta.lokasi_koordinat');
    }

    public function ubah_jenis($id,Request $request){ 
        $res=DB::table('jenis')
            ->where('id', $id) 
            ->update([
                'name' =>$request->name,
                'id_kategori' =>$request->id_kategori,
                'tipe' =>$request->tipe,
            ]);
            // ->update(['name_faskes' => $request->faskes]);
        return redirect('map/jenis')->with('flash_message', 'Admisi_pasien updated!');
    }
    public function edit_jenis($id){
            $data = DB::table('jenis')
            ->where('id', '=', $id)
            ->select('*')
            ->orderBy('id', 'desc')
            ->first();
            $kategori = DB::table('kategori')
            ->where('id', '=', $id)
            ->select('*')
            ->orderBy('id', 'desc')
            ->get();
        return view('peta.ubah_jenis',['data' => $data,'kategori' => $kategori]);
    }
    public function tbl_jenis(){
        return view('peta.tbl_jenis');
    }
  public function create(){
    return view('peta.tambah_lokasi_form');
}
    public function loadpoligonnn(Request $request)
    {
        if ($request->ajax()) {
            $id=request()->post();
            // var_dump($id);
            $data = DB::table('jenis')
            ->where('id', '=', $id)
            ->select('*')
            ->orderBy('id', 'desc')
            ->first();
            // ->get();
            return response()->json($data, 200, ['Content-Type' => 'application/json;charset=UTF-8', 'Charset' => 'utf-8'],
        JSON_UNESCAPED_UNICODE);
        }
        return view('peta.map');
    }
    public function getkoordinat(Request $request)
    {
        if ($request->ajax()) {
            $id=request()->post();
            // var_dump($id);
            $data = DB::table('koordinatkota')
            ->where('id_kategori', '=', 1)
            ->select('*')
            ->orderBy('id', 'desc')
            ->get();
            return response()->json($data, 200, ['Content-Type' => 'application/json;charset=UTF-8', 'Charset' => 'utf-8'],
        JSON_UNESCAPED_UNICODE);
        }
        return view('peta.map');
    }
    public function get_file_geojson(Request $request){
            // mengambil file geojson di folder shp
        $data=[];
            if($handle = opendir('./assets/shp')){
              while(false !==($entry = readdir($handle))){
                if($entry != "." && $entry != ".."){
                  $ex_entry=explode('.', $entry);
                  $jum=count($ex_entry);
                  for($a=0;$a<$jum;$a++){
                  }
                    if($ex_entry[$jum-1]=='geojson'){
                      $nama_file=implode('.',$ex_entry);
                    array_push($data,$nama_file);
                      // echo $nama_file.'<br>';
                    }
                }
              }
            }
            return response()->json($data, 200, ['Content-Type' => 'application/json;charset=UTF-8', 'Charset' => 'utf-8'],
        JSON_UNESCAPED_UNICODE);
        // }
        // return view('peta.map');
    }
    public function cari_lokasi(Request $request)
    {
        if ($request->ajax()) {
            $kata=$request->kata;
            $data['kata']=$kata;
            $data = DB::table('koordinatkota')
            ->where('nama_lokasi', 'like','%'.$kata.'%')
            ->select('*')
            ->orderBy('id', 'desc')
            ->get();
            return response()->json($data, 200, ['Content-Type' => 'application/json;charset=UTF-8', 'Charset' => 'utf-8'],
        JSON_UNESCAPED_UNICODE);
        }
        return view('peta.map');
    }
    public function getkoordinat_db(Request $request)
    {
        if ($request->ajax()) {
            $id=request()->post();
            // var_dump($id);
            $data = DB::table('koordinatkota')
            ->where('id_jenis', '=', $id)
            ->select('*')
            ->orderBy('id', 'desc')
            ->get();
            return response()->json($data, 200, ['Content-Type' => 'application/json;charset=UTF-8', 'Charset' => 'utf-8'],
        JSON_UNESCAPED_UNICODE);
        }
        return view('peta.map');
    }
  
  public function catagory_create(){
    return view('peta.tambah_katagori_form');
}
    public function catagory_create_action(Request $request){
        $data['name']=$request->name;
         $user = DB::table('kategori')->insert($data);//inserting data 
         if($user){
            //Alert::info('Berhasil', 'Data berhasil di input ...!'); 
        }else{
            //Alert::warning('GAGAL', 'Gagal input data... !'); 
        }
        return redirect('/map/tambah_kategori');
    }
  public function jenis_create(){
            $data = DB::table('kategori')
            // ->where('id_jenis', '=', $id)
            ->select('*')
            ->orderBy('id', 'desc')
            ->get();
    return view('peta.tambah_jenis_form',["data"=>$data]);
}
    public function jenis_create_action(Request $request){
        $data['name']=$request->name;
        $data['id_kategori']=$request->id_kategori;
        $data['tipe']=$request->tipe;
         $user = DB::table('jenis')->insert($data);//inserting data 
         if($user){
           // Alert::info('Berhasil', 'Data berhasil di input ...!'); 
        }else{
            //Alert::warning('GAGAL', 'Gagal input data... !'); 
        }
        return redirect('/map/tambah_jenis');
    }
    public function create_action(Request $request){
        $data['nama_lokasi']=$request->nama_lokasi;
        $data['id_kategori']=$request->kategori;
        $data['id_jenis']=$request->jenis;
        $data['lat']=$request->lat;
        $data['lang']=$request->lang;
        $data['icon']=$request->icon;
        // var_dump ($data);

        // Alert::su('Question Title', 'Question Message');

         $user = DB::table('koordinatkota')->insert($data);//inserting data 
         if($user){
            //Alert::info('Berhasil', 'Data berhasil di input ...!'); 
        }else{
            //Alert::warning('GAGAL', 'Gagal input data... !'); 
        }
        return redirect('/map/koordinat_lokasi');
    }
}
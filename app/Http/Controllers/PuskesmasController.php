<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request; 
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use RealRashid\SweetAlert\Facades\Alert;
use DataTables;
use Illuminate\Http\RedirectResponse;

class PuskesmasController extends Controller
{
    public function __construct()
    {
    }
    public function data_kota(Request $request){
        if($request->ajax()){
            if($request->id){
                $id=$request->id;
            }else{
                $id='';
            }
            $data['jenis']=$request->jenis;
            $data['id_prov']=$request->id_prov;
            if($request->jenis=='provinsi'){
                ?>
                 <option value =''>--pilih kabupaten--</option>
                 <?php 
            $res=DB::table('cities')->select('*')->where('prov_id',$request->id_prov)
                ->get();
                foreach($res as $kab){
                ?>
                 <option value ='<?=$kab->city_id?>' <?php if($id==$kab->city_id){?> selected <?php }?>><?=$kab->city_name?> </option>
                 <?php }
             }
            else if($request->jenis=='kabupaten'){
                ?>
                 <option value =''>--pilih Kecamatan--</option>
                 <?php 
            $res=DB::table('districts')->select('*')->where('city_id',$request->id_prov)
                ->get();
                foreach($res as $kec){
                ?>
                 <option value ='<?=$kec->dis_id?>' <?php if($id==$kec->dis_id){?> selected <?php }?>>
                   <?=$kec->dis_name?> </option>
                 <?php }
             }
            else if($request->jenis=='kecamatan'){
                ?>
                 <option value =''>--pilih desa--</option>
                 <?php 
            $res=DB::table('subdistricts')->select('*')->where('dis_id',$request->id_prov)
                ->get();
                foreach($res as $desa){
                ?>
                 <option value ='<?=$desa->subdis_id?>' <?php if($id==$desa->subdis_id){?> selected <?php }?>><?=$desa->subdis_name?> </option>
                 <?php }
             }
        }
    }
    public function dashbord_cek_login(Request $request){  

        $info='';
        if($request->all()){
        $username=$request->username;
        //\Hash::make
        $pass=password_hash($request->password,PASSWORD_DEFAULT);
        $res=DB::table('tbl_user_faskes')->select('nik_admin','pass','admin','dashbord')->where('nik_admin',$request->username)
        ->first();
            if($res){

            $data=array($pass,$username);
                if(password_verify($request->password,$res->pass)){
                // print_r($res);
                $info='sukses';
                Session::put(['login'=>true]);
                Session::put(['nik_admin'=>$res->nik_admin]);
                }else{
                $info='gagal';
        }}
        else{
        $info='gagal';
        }
    }
    $data['info']=$info;
    // print_r($data);
    if($info=='sukses'){
        return new RedirectResponse($res->dashbord); 
    }
    else{
        return new RedirectResponse('dashbord/login'); 
        // return redirect();
    }
    // return response()->json($data, 200, ['Content-Type' => 'application/json;charset=UTF-8', 'Charset' => 'utf-8'],
    // JSON_UNESCAPED_UNICODE);
    }
    public function cek_login(){  
        if(Session::get('login')){
            $data['info']='sukses';
        }else{
            $data['info']='gagal';
        }  return response()->json($data, 200, ['Content-Type' => 'application/json;charset=UTF-8', 'Charset' => 'utf-8'],
        JSON_UNESCAPED_UNICODE);
    }
    public function logout(){   
        if(Session::get('login')){
            $data['info']='sukses';
        }else{
            $data['info']='gagal';
        }  return response()->json($data, 200, ['Content-Type' => 'application/json;charset=UTF-8', 'Charset' => 'utf-8'],
        JSON_UNESCAPED_UNICODE);
    }
    public function dashbord_logout(){   
        if(Session::get('login')){
            $data['info']='sukses';
        }else{
            $data['info']='gagal';
        }  return response()->json($data, 200, ['Content-Type' => 'application/json;charset=UTF-8', 'Charset' => 'utf-8'],
        JSON_UNESCAPED_UNICODE);
    }
    public function index(){
        return view('puskesmas.kasir');
    }
    public function kasir(){
      if(Session::get('login')){
        // var_dump(session()->all());
        $res=DB::table('tbl_user_faskes')->select('nik_admin','pass','admin','id_faskes')->where('nik_admin',Session::get('nik_admin'))
            ->first();
            // var_dump($res);
        $data['admin']=$res->admin;
        $data['nik_admin']=$res->nik_admin;
        $data['id_faskes']=$res->id_faskes;
        return view('puskesmas.kasir',$data);
      }else{
        return redirect()->route('puskesmas/login');
      }
    }
    public function dashbord_input_login(){
        Session::get('login');
        // die;
        Session::flush();
        session()->forget('login'); 
        session()->forget('nik_admin'); 
        // return view('puskesmas.login');
        return view('puskesmas.dashbord_login');
    }
    public function login(){
        // Session::get('login');
        // die;
        Session::flush();
        session()->forget('nik_admin'); 
        session()->forget('login'); 
        return view('puskesmas.login');
    }
  
    public function dashbord_input_loginn(Request $request){
        $info='';
        if($request->ajax()){
        $username=$request->username;
        //\Hash::make
        $pass=password_hash($request->password,PASSWORD_DEFAULT);
        $res=DB::table('tbl_user_faskes')->select('nik_admin','pass','admin')->where('nik_admin',$request->username)
        ->first();
            if($res){

            $data=array($pass,$username);
                if(password_verify($request->password,$res->pass)){
                // print_r($res);
                $info='sukses';
                Session::put(['login'=>true]);
                Session::put(['nik_admin'=>$res->nik_admin]);
                }else{
                $info='gagal';
        }}
        else{
        $info='gagal';
        }
    }
    $data['info']=$info;
    return response()->json($data, 200, ['Content-Type' => 'application/json;charset=UTF-8', 'Charset' => 'utf-8'],
    JSON_UNESCAPED_UNICODE);
    }
    public function input_login(Request $request){
        if($request->ajax()){
            $username=$request->username;
            //\Hash::make
            $pass=password_hash($request->password,PASSWORD_DEFAULT);
             $res=DB::table('tbl_user_faskes')->select('nik_admin','pass','admin')->where('nik_admin',$request->username)
                ->first();
                if($res){

            $data=array($pass,$username);
            if(password_verify($request->password,$res->pass)){
                // print_r($res);
                $info='sukses';
                Session::put(['login'=>true]);
                Session::put(['nik_admin'=>$res->nik_admin]);
}else{
    $info='gagal';
}}
else{
    $info='gagal';
}
        }
$data['info']=$info;
        return response()->json($data, 200, ['Content-Type' => 'application/json;charset=UTF-8', 'Charset' => 'utf-8'],
        JSON_UNESCAPED_UNICODE);
    }
    public function input_data_kasir(Request $request){
        if ($request->ajax()) {
        $data['response']='success...';
        $data['admin']=$request->admin;
        $data['nik_admin']=$request->nik_admin;
        $data['id_faskes']=$request->faskes;
        $data['no_admisi']=$request->no_admisi;
        $data['nomor_rm']=$request->nomor_rm;
        $nominal=str_replace('.','',str_replace('Rp. ', '', $request->nominal));
        $data['nominal']=$nominal;$hasil='sukses';
            $res=DB::table('transaksi')->insert([
                'nominal'   =>$nominal,
                'admin'     =>$request->admin,
                'nik_admin' =>$request->nik_admin,
                'id_faskes' =>$request->faskes,
                'no_admisi' =>$request->no_admisi,
                'nomor_rm'  =>$request->nomor_rm,
            ]);
            if($res){
                $hasil='sukses';
            }else{
                $hasil='gagal';
            }
            $data['hasil']=$hasil;
        return redirect()->route('puskesmas/kasir');
        return response()->json($data, 200, ['Content-Type' => 'application/json;charset=UTF-8', 'Charset' => 'utf-8'],
        JSON_UNESCAPED_UNICODE);
        }
        return view('puskesmas.kasir');
    }
    public function register(){
        return view('puskesmas.register');
    }
    public function register_action(Request $request){
        if ($request->ajax()) {
        $data['response']='success...';
        $data['admin']=$request->admin;
        $data['nik_admin']=$request->nik_admin;
        $data['id_faskes']=$request->faskes;
        $hasil='sukses';
        $password = \Hash::make($request->pass);
            $res=DB::table('tbl_user_faskes')->insert([
                'admin'     =>$request->admin,
                'nik_admin' =>$request->nik_admin,
                'id_faskes' =>$request->faskes,
                'pass' =>$password,
            ]);
            if($res){
                $hasil='sukses';
            }else{
                $hasil='gagal';
            }
            $data['hasil']=$hasil;
        // return redirect()->route('puskesmas/register');
        return response()->json($data, 200, ['Content-Type' => 'application/json;charset=UTF-8', 'Charset' => 'utf-8'],
        JSON_UNESCAPED_UNICODE);
        }
        return view('puskesmas.register');
    }
    public function tarif_master(){
        return view('puskesmas.tarif_master');
    }
    public function faskes(){
        return view('puskesmas.tbl_faskes');
    }
    public function get_faskes(Request $request){
        if ($request->ajax()) {
            $data['data']= DB::table('tbl_faskes')
            // ->where('id_jenis', '=', $id)
            ->select('id','name_faskes')
            ->orderBy('id', 'desc')
            ->get();
        return response()->json($data, 200, ['Content-Type' => 'application/json;charset=UTF-8', 'Charset' => 'utf-8'],
        JSON_UNESCAPED_UNICODE);
        }
        return view('puskesmas.tbl_faskes');

    }
    public function hapus_tarif_master(Request $request){
        if ($request->ajax()) {
            // print_r($request);
            // $data=$request->faskes;
            $res = DB::table('tarif_master')->where('id', '=', $request->id)->delete();
            // $res=DB::table('tbl_faskes')->insert([
            //     'name_faskes' => $request->faskes,
            // ]);
            if($res){$data['info']='suksesss';}
            else{$data['info']='gagal input';}
        return response()->json($data, 200, ['Content-Type' => 'application/json;charset=UTF-8', 'Charset' => 'utf-8'],
        JSON_UNESCAPED_UNICODE);
        }
        // return view('puskesmas.tbl_faskes');

    }
    public function hapus_faskes(Request $request){
        if ($request->ajax()) {
            // print_r($request);
            // $data=$request->faskes;
            $res = DB::table('tbl_faskes')->where('id', '=', $request->id)->delete();
            // $res=DB::table('tbl_faskes')->insert([
            //     'name_faskes' => $request->faskes,
            // ]);
            if($res){$data['info']='suksesss';}
            else{$data['info']='gagal input';}
        return response()->json($data, 200, ['Content-Type' => 'application/json;charset=UTF-8', 'Charset' => 'utf-8'],
        JSON_UNESCAPED_UNICODE);
        }
        // return view('puskesmas.tbl_faskes');

    }
    public function input_faskes(Request $request){
        if ($request->ajax()) {
            if($request->id != null){
                $res=DB::table('tbl_faskes')
                  ->where('id', $request->id)
                  ->update(['name_faskes' => $request->faskes]);

                if($res){
                    $data['info']='suksesss update';
                }else{
                    $data['info']='gagal update';
                }
            }
                else{
            $res=DB::table('tbl_faskes')->insert([
                'name_faskes' => $request->faskes,
            ]);
            if($res){
                $data['info']='suksesss';
            }else{
                $data['info']='gagal input';
            }
        }
        return response()->json($data, 200, ['Content-Type' => 'application/json;charset=UTF-8', 'Charset' => 'utf-8'],
        JSON_UNESCAPED_UNICODE);
        }
        // return view('puskesmas.tbl_faskes');

    }
    public function input_tarif_master(Request $request){
        if ($request->ajax()) {
            if($request->id != null){
                $res=DB::table('tarif_master')
                  ->where('id', $request->id)
                  ->update(['jenis_layanan' => $request->jenis_layanan])
                  ->update(['tarif' => $request->tarif])
                  ->update(['is_parent' => $request->is_parent])
                  ->update(['id_parent' => $request->id_parent])
                  ->update(['kode_tarif' => $request->kode_tarif]);

                if($res){
                    $data['info']='suksesss update';
                }else{
                    $data['info']='gagal update';
                }
            }
                else{
            $res=DB::table('tbl_faskes')->insert([
                'name_faskes' => $request->jenis_layanan,
            ]);
            if($res){
                $data['info']='suksesss';
            }else{
                $data['info']='gagal input';
            }
        }
        return response()->json($data, 200, ['Content-Type' => 'application/json;charset=UTF-8', 'Charset' => 'utf-8'],
        JSON_UNESCAPED_UNICODE);
        }
        // return view('puskesmas.tbl_faskes');

    }
    public function get_modal(Request $request){
        $nama_faskes='';$id='';
        if ($request->ajax()) {
            $id=$request->id;
            $data_faskes= DB::table('tbl_faskes')
            ->where('id', '=', $request->id)
            ->select('id','name_faskes')
            ->orderBy('id', 'desc')
            ->get();
            // ->delete();
            foreach($data_faskes as $dat){
                // $nama_faskes=$dat->name_faskes;
                // print_r($dat);
                $nama_faskes=$dat->name_faskes;
            }
        }
            // Alert::info('Berhasil', 'Hapus data ...!');
        ?>
        <form id="formId">
            <div class="form-group row">
                <label for="exampleInputEmail1" class="col-md-12">Nama FASKES</label>
                <div class="col-md-12">
                    <input type="hidden" name="id" id='id' value="<?=$id?>">
                    <input type="text" class="form-control" value="<?=$nama_faskes?>" id="faskes" name="faskes" aria-describedby="emailHelp" placeholder="">
                    <!-- <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small> -->
                </div>
            </div>
                <!-- <button type="submit" id="simpan_data" class="btn btn-primary">Simpan Data</button> -->
        </form>
        <?php
    }
    public function get_modal_add_tarif(Request $request){
        $jenis_pelayanan='';$id='';$id_parent='';$tarif='';$is_parent='';$kode_tarif='';
        if ($request->ajax()) {
            $id=$request->id;
            $dat= DB::table('tarif_master')
            ->where('id', '=', $request->id)
            ->select('id','jenis_layanan','tarif','is_parent','kode_tarif','id_parent')
            ->orderBy('id', 'desc')
            ->first();
            $id=$dat->id;
            $jenis_pelayanan=$dat->jenis_layanan;
            $id_parent=$dat->id_parent;
            $kode_tarif=$dat->kode_tarif;
            $tarif=$dat->tarif;
            $is_parent=$dat->is_parent;
            // ->delete();
        }
            // Alert::info('Berhasil', 'Hapus data ...!');
        ?>
        <form id="formId">
            <div class="form-group row">
                <label for="exampleInputEmail1" class="col-md-12">Parent Tarif</label>
                <div class="col-md-12">
                    <input type="text" class="form-control" value="<?=$id_parent?>" id="id_parent" name="id_parent" placeholder="">
                </div>
            </div>
            <div class="form-group row">
                <label for="exampleInputEmail1" class="col-md-12">Kode Tarif</label>
                <div class="col-md-12">
                    <input type="text" class="form-control" value="<?=$kode_tarif?>" id="kode_tarif" name="kode_tarif" placeholder="">
                </div>
            </div>
            <div class="form-group row">
                <label for="exampleInputEmail1" class="col-md-12">Tarif</label>
                <div class="col-md-12">
                    <input type="text" class="form-control" value="<?=$tarif?>" id="tarif" name="tarif" placeholder="">
                </div>
            </div>
            <div class="form-group row">
                <label for="exampleInputEmail1" class="col-md-12">Nama Tarif</label>
                <div class="col-md-12">
                    <input type="hidden" name="id" id='id' value="<?=$id?>">
                    <input type="text" class="form-control" value="<?=$jenis_pelayanan?>" id="jenis_layanan" name="jenis_layanan" placeholder="">
                </div>
            </div>
            <div class="form-group row">
                <label for="exampleInputEmail1" class="col-md-12">setting sebagai parent</label>
                <div class="col-md-12">
                    <label class="col-md-3">
                        <input type="radio" name="is_parent" id="is_parent_t" <?php if($is_parent=='true'){?> checked <?php }?> value="true"> Ya
                    </label>
                    <label class="col-md-3">
                        <input type="radio" name="is_parent" id="is_parent_n" <?php if($is_parent!='true'){?> checked <?php }?> value="false"> Tidak
                    </label>
                </div>
            </div>
        </form>
        <?php
    }
    public function del_faskes(Request $request){
        $nama_faskes='';
        if ($request->ajax()) {
            $data_faskes= DB::table('tbl_faskes')
            ->where('id', '=', $request->id)
            ->select('id','name_faskes')
            ->orderBy('id', 'desc')
            // ->get();
            ->delete();
            Alert::info('Berhasil', 'Hapus data ...!'); 
        }
    }
}

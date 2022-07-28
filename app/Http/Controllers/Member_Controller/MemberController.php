<?php

namespace App\Http\Controllers\Member_Controller;

use App\Http\Controllers\Controller;
use App\Http\Requests; 
use App\Models\Member;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use RealRashid\SweetAlert\Facades\Alert;
use DataTables;
use Illuminate\Http\RedirectResponse;
use Symfony\Component\HttpFoundation\Response as HttpFoundationResponse;

class MemberController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\View\View
     */
// public function add_member(Request $request){
//     // $res="";
//     // if($request){
//             $response["sts"]="no request";
//             $response["email"]=$request->email;
//             $response["pasword"]=$request->password;
//             $password = \Hash::make($request->pass)
//             // $res=DB::table('users')->insert([
//             //     'user_name'=>$request->email,
//             //     'password'=>$password,
//             //     'nama_user'=>$request->email,
//             // ]);
//             // if($res){
//             // $response["simpan"]="oke"; 
//             // }else{
//             // $response["simpan"]="gagal"; 
//             // }
//         // }
//             return response()->json($response, HttpFoundationResponse::HTTP_OK);
// }
    public function form_cari(){
        return view('modul_member.member.form_cari');        
    }
    public function file_upload(){
        return view('modul_member.member.file_upload');        
    }

    public function excel_upload(Request $request)
    {
        $file = $request->file('file');
        $fileName = $_FILES['file']['name'];
        $fileType = $_FILES['file']['type'];
        $data['fileName']= $file->getClientOriginalName();
        $data['fileType']=$fileType;
        return print_r($data);
        return "proses upload";
        $request->validate([
            'file' => 'required',
        ]);
   
        $fileName = time().'.'.request()->file->getClientOriginalExtension();
   
        request()->file->move(public_path('files'), $fileName);
   
        return response()->json(['success'=>'You have successfully upload file.']);
    }

    public function excel_upload_ajax(Request $request)
    { 
        if($request){
            $data['sts']="da req";
        // $fileName = $_FILES['file']['name'];
        // $fileType = $_FILES['file']['type'];
        // $data['fileName']=$fileName;
        // $data['fileType']=$fileType;
        }
        else{$data['sts']="tidak ada req";}
        return response()->json($data);
        $request->validate([
            'file' => 'required',
        ]);
   
        $fileName = time().'.'.request()->file->getClientOriginalExtension();
   
        $upload=request()->file->move(public_path('files'), $fileName);
        if($upload){$sts="sukses";}else{$sts="gagal";}
   
        return response()->json(['success'=>$sts]);
    }
      public function api_login(Request $request)
    {
        if($request){
            $id=$request->email; 
            $pass=password_hash($request->password,PASSWORD_DEFAULT); 
            $admin = Member::query("select * from member where email='".$id."'")->first();
            if (Hash::check($pass, $admin->pass)) {
            // if(password_verify($pass,$admin->pass)){ 
                $response["login"]="sama";
            }else{
                $response["login"]="beda";
            }
            $cari=DB::table('member')->select('*')->first();
            $response["sts"]="ada request";
            $response["cari"]=$cari;
            $response["pasword"]=$admin;
        }else{
            $response["login"]="beda";
            $response["sts"]="no request";
            $response["cari"]="tidak ada adata";
            $response["pasword"]="-";
        }
        return response()->json($response, HttpFoundationResponse::HTTP_OK);
    }
  public function get_by_id($id)
    {
        $posts2=\DB::table("member")->select('*')->where('memberid','=',$id)->first();
        if($posts2){
          $stts="true";
          $message="list semua";
          $data=$posts2;  
          $res="200";
        }else{
          $stts="true";
          $message="list semua";
          $data="";  
          $res="500";
        }
        return response([
            'success' => $stts,
            'message' => $message,
            'data' => $data
        ], $res);
    }
    public function simpan_menu(Request $request){
        if($request){
                $data['sts_ck']=$request->sts;
                $data['id_menu']=$request->id_menu;
                $data['memberid']=$request->memberid; 
                $data2['id_menu']=$request->id_menu;
                $data2['id_user']=$request->memberid;
                //input
                if($request->sts=="true"){ 
                    $simpan_menu=\DB::table('users_menu')->insert($data2);
                    if( $simpan_menu){ 
                        $data['sts']="masuk data";
                    }else{
                        $data['sts']="gagal masuk data";                        
                    } 
                }else{
                    $simpan_menu=\DB::table('users_menu')->where('id_menu','=',$request->id_menu)->where('id_user','=',$request->memberid)->delete();
                    if( $simpan_menu){ 
                        $data['sts']="hapus data";
                    }else{
                        $data['sts']="gagal hapus data";  
                    }  
                }
        }else{
        $data['sts']="tidak ada rq";
        }
    return response()->json($data, 200, ['Content-Type' => 'application/json;charset=UTF-8', 'Charset' => 'utf-8'],
    JSON_UNESCAPED_UNICODE);
    }
    public function index(Request $request)
    {
        $keyword = $request->get('search');
        $perPage = 25;

        if (!empty($keyword)) {
            $member = Member::where('hp', 'LIKE', "%$keyword%")
                ->orWhere('alamat', 'LIKE', "%$keyword%")
                ->orWhere('nama', 'LIKE', "%$keyword%")
                ->orWhere('groupid', 'LIKE', "%$keyword%")
                ->orWhere('email', 'LIKE', "%$keyword%")
                ->orWhere('profil_pic', 'LIKE', "%$keyword%")
                ->latest()->paginate($perPage);
        } else {
            $member = Member::latest()->paginate($perPage);
        }

        return view('modul_member.member.index', compact('member'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('modul_member.member.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function store(Request $request)
    {
        
        $requestData = $request->all();
        
        Member::create($requestData);

        return redirect('modul_member/member')->with('flash_message', 'Member added!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     *
     * @return \Illuminate\View\View
     */
    public function show($id)
    {
        $member = Member::findOrFail($id);

        return view('modul_member.member.show', compact('member'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     *
     * @return \Illuminate\View\View
     */
    public function edit($id)
    {
        $member = Member::findOrFail($id);

        return view('modul_member.member.edit', compact('member'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param  int  $id
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function update(Request $request, $id)
    {
        
        $requestData = $request->all();
        
        $member = Member::findOrFail($id);
        $member->update($requestData);

        return redirect('modul_member/member')->with('flash_message', 'Member updated!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function destroy($id)
    {
        Member::destroy($id);

        return redirect('modul_member/member')->with('flash_message', 'Member deleted!');
    }
}

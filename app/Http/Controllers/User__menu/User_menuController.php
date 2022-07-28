<?php

namespace App\Http\Controllers\User__menu;

use App\Http\Controllers\Controller;
use App\Http\Requests;

use App\Models\User_menu;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class User_menuController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\View\View
     */
    public function index(Request $request)
    {
        $keyword = $request->get('search');
        $perPage = 25;

        if (!empty($keyword)) {
            $user_menu = User_menu::where('id_menu', 'LIKE', "%$keyword%")
                ->orWhere('id_user', 'LIKE', "%$keyword%")
                ->latest()->paginate($perPage);
        } else {
            $user_menu = User_menu::latest()->paginate($perPage);
        }

        return view('admin.user_menu.index', compact('user_menu'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function cari_list_menu(Request $request){
        if($request->sts=='true'){
            $list['id_gm']=$request->id_menu;
            $data['nik_admin']=$request->nik_admin;
            $list['list_mn'] = DB::table('master_menu')
            // ->where('id_master', '=', $request->id_menu)
            ->get();

            $query=DB::table('user_menu')
            ->where('id_user','=',$request->nik_admin)
            ->where('id_menu','=',$request->id_menu)
            ->first();
            if($query){
                $data['sts']="sudah ada";
                return response()->json($data, 200, ['Content-Type' => 'application/json;charset=UTF-8', 'Charset' => 'utf-8'],
                    JSON_UNESCAPED_UNICODE);
            }else{
                $insert=DB::table('user_menu')
                ->insert([
                    'id_menu'   => $request->id_menu,
                    'id_user'   => $request->nik_admin,
                ]);
                if($insert){
                    $data['sts']='berhasil_insert';
                    return response()->json($data, 200, ['Content-Type' => 'application/json;charset=UTF-8', 'Charset' => 'utf-8'],
                        JSON_UNESCAPED_UNICODE);
                }else{
                    $data['sts']='gagal_insert';
                    return response()->json($data, 200, ['Content-Type' => 'application/json;charset=UTF-8', 'Charset' => 'utf-8'],
                        JSON_UNESCAPED_UNICODE);
                }
            }
        }else{
            $whereArray = array('id_menu' => $request->id_menu,'id_user' => $request->nik_admin);

            $query = DB::table('user_menu');
            foreach($whereArray as $field => $value) {
                $query->where($field, $value);
            }
            $delete=$query->delete();
            if($delete){
                $data['sts']='berhasil_hapus';
                return response()->json($data, 200, ['Content-Type' => 'application/json;charset=UTF-8', 'Charset' => 'utf-8'],
                    JSON_UNESCAPED_UNICODE);
            }else{
                $data['sts']='gagal_hapus';
                return response()->json($data, 200, ['Content-Type' => 'application/json;charset=UTF-8', 'Charset' => 'utf-8'],
                    JSON_UNESCAPED_UNICODE);
            }
        }
        return $list;
    }
    public function tambah_menu($id)
    {
        return view('admin.user_menu.form_tambah_menu', compact('id'));
    }
    public function create()
    {
        return view('admin.user_menu.create');
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
        
        User_menu::create($requestData);

        return redirect('admin/user_menu')->with('flash_message', 'User_menu added!');
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
        $user_menu = User_menu::findOrFail($id);

        return view('admin.user_menu.show', compact('user_menu'));
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
        $user_menu = User_menu::findOrFail($id);

        return view('admin.user_menu.edit', compact('user_menu'));
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
        
        $user_menu = User_menu::findOrFail($id);
        $user_menu->update($requestData);

        return redirect('admin/user_menu')->with('flash_message', 'User_menu updated!');
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
        User_menu::destroy($id);

        return redirect('admin/user_menu')->with('flash_message', 'User_menu deleted!');
    }
}

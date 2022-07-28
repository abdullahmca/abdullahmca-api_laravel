<?php

namespace App\Http\Controllers\Users;

use App\Http\Controllers\Controller;
use App\Http\Requests;

use App\Models\User; 
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class UsersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\View\View
     */
    public function dashbord(){
        
    }
    public function simpan_add(Request $request){
        if($request){
            $id=$request->id_user;
            $data['password']    = $request->password;
            $data['admin']      = $request->admin;
            $data['nik_admin']  = $request->nik_admin;
            $password = \Hash::make($request->password);
            $save=DB::table('tbl_user_faskes')
                    ->insert([
                        'pass'       => $password,
                        'admin'      => $request->admin,
                        'nik_admin'  => $request->nik_admin,
                    ]);
            if($save){
                return redirect('admin/users')->with('flash_message', 'User updated!');
            }
            else{
                return redirect('admin/users/')->with('flash_message', 'User updated failed!');
            }
        }
        else{
            return redirect('admin/users')->with('flash_message', '....?');
        }
    }
    public function simpan_edit(Request $request){
        if($request){
            $id=$request->id_user;
            $data['id_user']    = $request->id_user;
            $data['admin']      = $request->admin;
            $data['nik_admin']  = $request->nik_admin;
            $update=DB::table('tbl_user_faskes')
                    ->where('id_user', '=', $request->id_user)
                    ->update([
                        'id_user'    => $request->id_user,
                        'admin'      => $request->admin,
                        'nik_admin'  => $request->nik_admin,
                    ]);
            if($update){
                return redirect('admin/users')->with('flash_message', 'User updated!');
            }
            else{
                return redirect('admin/users/')->with('flash_message', 'User updated failed!');
            }
        }
        else{
            return redirect('admin/users')->with('flash_message', '....?');
        }
    }

   public function users_resetpwd($id){
    $password = \Hash::make(12345);
    $reset=DB::table('tbl_user_faskes')
        ->where('id_user', '=', $id)
        ->update([
            'pass'  => $password,
        ]);
        if($reset){
            return redirect('admin/users')->with('flash_message', 'User updated!');
        }
        else{
            return redirect('admin/users/')->with('flash_message', 'User updated failed!');
        }
   }

   public function users_edit($id){
     $tbl_user_faskes=DB::table('tbl_user_faskes')
        ->where('id_user', '=', $id)
        ->select('*')
        ->first();
        return view('admin.tbl_user_faskes.form_edit', compact('tbl_user_faskes'));
   }
   public function users_view($id){
     $tbl_user_faskes=DB::table('tbl_user_faskes')
        ->where('id_user', '=', $id)
        ->select('*')
        ->first();
        return view('admin.tbl_user_faskes.show', compact('tbl_user_faskes'));
   }

    public function index(Request $request)
    {
        $keyword = $request->get('search');
        $perPage = 25;

        if (!empty($keyword)) {
            $tbl_user_faskes = DB::table('member')
                ->where('memberid', 'LIKE', "%$keyword%")
                ->orWhere('groupid', 'LIKE', "%$keyword%")
                ->orWhere('nama', 'LIKE', "%$keyword%")
                ->orWhere('alamat', 'LIKE', "%$keyword%")
                ->orWhere('hp', 'LIKE', "%$keyword%")
                ->orWhere('email', 'LIKE', "%$keyword%")
                ->orWhere('profil_pic', 'LIKE', "%$keyword%")
                ->latest()->paginate($perPage);
        } else {
             $tbl_user_faskes=DB::table('member')
             ->select('memberid','groupid','nama','alamat','hp','email','profil_pic')
            ->get(); 
        } 
        $users=$tbl_user_faskes;
        return view('admin.users.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('admin.users.create');
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
        
        User::create($requestData);

        return redirect('admin/users')->with('flash_message', 'User added!');
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
        $user = User::findOrFail($id);

        return view('users.users.show', compact('user'));
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
        $user = User::findOrFail($id);

        return view('users.users.edit', compact('user'));
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
        
        $user = User::findOrFail($id);
        $user->update($requestData);

        return redirect('admin/users')->with('flash_message', 'User updated!');
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
        User::destroy($id);

        return redirect('admin/users')->with('flash_message', 'User deleted!');
    }
}

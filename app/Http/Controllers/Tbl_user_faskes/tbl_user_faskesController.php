<?php

namespace App\Http\Controllers\Tbl_user_faskes;

use App\Http\Controllers\Controller;
use App\Http\Requests;

use App\Models\tbl_user_faske;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class tbl_user_faskesController extends Controller
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
            $tbl_user_faskes = tbl_user_faske::where('menu', 'LIKE', "%$keyword%")
                ->orWhere('link', 'LIKE', "%$keyword%")
                ->orWhere('icon', 'LIKE', "%$keyword%")
                ->orWhere('parent', 'LIKE', "%$keyword%")
                ->orWhere('created_at', 'LIKE', "%$keyword%")
                ->orWhere('updated_at', 'LIKE', "%$keyword%")
                ->orWhere('id_master', 'LIKE', "%$keyword%")
                ->latest()->paginate($perPage);
        } else {
             $tbl_user_faskes=DB::table('tbl_user_faskes')
             ->select('id_user','nik_admin','pass','admin','id_faskes','dashbord')
            ->get();
            // $tbl_user_faskes = tbl_user_faske::latest()->paginate($perPage);
        }

        return view('admin.tbl_user_faskes.index', compact('tbl_user_faskes'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('admin.tbl_user_faskes.create');
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
        
        tbl_user_faske::create($requestData);

        return redirect('admin/tbl_user_faskes')->with('flash_message', 'tbl_user_faske added!');
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
        $tbl_user_faske = tbl_user_faske::findOrFail($id);

        return view('admin.tbl_user_faskes.show', compact('tbl_user_faske'));
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
        $tbl_user_faske = tbl_user_faske::findOrFail($id);

        return view('admin.tbl_user_faskes.edit', compact('tbl_user_faske'));
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
        
        $tbl_user_faske = tbl_user_faske::findOrFail($id);
        $tbl_user_faske->update($requestData);

        return redirect('admin/tbl_user_faskes')->with('flash_message', 'tbl_user_faske updated!');
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
        tbl_user_faske::destroy($id);

        return redirect('admin/tbl_user_faskes')->with('flash_message', 'tbl_user_faske deleted!');
    }
}

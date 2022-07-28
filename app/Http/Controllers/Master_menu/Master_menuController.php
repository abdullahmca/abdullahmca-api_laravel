<?php

namespace App\Http\Controllers\Master_menu;

use App\Http\Controllers\Controller;
use App\Http\Requests;

use App\Models\Master_menu;
use Illuminate\Http\Request;

class Master_menuController extends Controller
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
            $master_menu = Master_menu::where('menu', 'LIKE', "%$keyword%")
                ->orWhere('link', 'LIKE', "%$keyword%")
                ->orWhere('icon', 'LIKE', "%$keyword%")
                ->orWhere('parent', 'LIKE', "%$keyword%")
                ->latest()->paginate($perPage);
        } else {
            $master_menu = Master_menu::latest()->paginate($perPage);
        }

        return view('admin.master_menu.index', compact('master_menu'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('admin.master_menu.create');
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
        
        Master_menu::create($requestData);

        return redirect('admin/master_menu')->with('flash_message', 'Master_menu added!');
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
        $master_menu = Master_menu::findOrFail($id);

        return view('admin.master_menu.show', compact('master_menu'));
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
        $master_menu = Master_menu::findOrFail($id);

        return view('admin.master_menu.edit', compact('master_menu'));
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
        
        $master_menu = Master_menu::findOrFail($id);
        $master_menu->update($requestData);

        return redirect('admin/master_menu')->with('flash_message', 'Master_menu updated!');
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
        Master_menu::destroy($id);

        return redirect('admin/master_menu')->with('flash_message', 'Master_menu deleted!');
    }
}

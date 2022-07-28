<?php

namespace App\Http\Controllers\Grupss_Controller;

use App\Http\Controllers\Controller;
use App\Http\Requests;

use App\Models\Grup;
use Illuminate\Http\Request;

class GrupsController extends Controller
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
            $grups = Grup::where('namagroup', 'LIKE', "%$keyword%")
                ->orWhere('kota', 'LIKE', "%$keyword%")
                ->latest()->paginate($perPage);
        } else {
            $grups = Grup::latest()->paginate($perPage);
        }
        return view('modul_grup.grups.index', compact('grups'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('modul_grup.grups.create');
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
        
        Grup::create($requestData);

        return redirect('modul_grup/grups')->with('flash_message', 'Grup added!');
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
        $grup = Grup::findOrFail($id);

        return view('modul_grup.grups.show', compact('grup'));
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
        $grup = Grup::findOrFail($id);

        return view('modul_grup.grups.edit', compact('grup'));
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
        
        $grup = Grup::findOrFail($id);
        $grup->update($requestData);

        return redirect('modul_grup/grups')->with('flash_message', 'Grup updated!');
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
        Grup::destroy($id);

        return redirect('modul_grup/grups')->with('flash_message', 'Grup deleted!');
    }
}

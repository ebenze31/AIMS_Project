<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests;

use App\Models\Aims_area;
use Illuminate\Http\Request;

class Aims_areasController extends Controller
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
            $aims_areas = Aims_area::where('name_area', 'LIKE', "%$keyword%")
                ->orWhere('polygon', 'LIKE', "%$keyword%")
                ->orWhere('status', 'LIKE', "%$keyword%")
                ->orWhere('check_time_command', 'LIKE', "%$keyword%")
                ->orWhere('time_start_command', 'LIKE', "%$keyword%")
                ->orWhere('time_end_command', 'LIKE', "%$keyword%")
                ->orWhere('aims_partner_id', 'LIKE', "%$keyword%")
                ->latest()->paginate($perPage);
        } else {
            $aims_areas = Aims_area::latest()->paginate($perPage);
        }

        return view('aims_areas.index', compact('aims_areas'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('aims_areas.create');
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
        
        Aims_area::create($requestData);

        return redirect('aims_areas')->with('flash_message', 'Aims_area added!');
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
        $aims_area = Aims_area::findOrFail($id);

        return view('aims_areas.show', compact('aims_area'));
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
        $aims_area = Aims_area::findOrFail($id);

        return view('aims_areas.edit', compact('aims_area'));
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
        
        $aims_area = Aims_area::findOrFail($id);
        $aims_area->update($requestData);

        return redirect('aims_areas')->with('flash_message', 'Aims_area updated!');
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
        Aims_area::destroy($id);

        return redirect('aims_areas')->with('flash_message', 'Aims_area deleted!');
    }
}

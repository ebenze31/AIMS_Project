<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests;

use App\Models\Aims_type_unit;
use Illuminate\Http\Request;

class Aims_type_unitsController extends Controller
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
            $aims_type_units = Aims_type_unit::where('name_type_unit', 'LIKE', "%$keyword%")
                ->orWhere('aims_partner_id', 'LIKE', "%$keyword%")
                ->orWhere('aims_area_id', 'LIKE', "%$keyword%")
                ->latest()->paginate($perPage);
        } else {
            $aims_type_units = Aims_type_unit::latest()->paginate($perPage);
        }

        return view('aims_type_units.index', compact('aims_type_units'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('aims_type_units.create');
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
        
        Aims_type_unit::create($requestData);

        return redirect('aims_type_units')->with('flash_message', 'Aims_type_unit added!');
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
        $aims_type_unit = Aims_type_unit::findOrFail($id);

        return view('aims_type_units.show', compact('aims_type_unit'));
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
        $aims_type_unit = Aims_type_unit::findOrFail($id);

        return view('aims_type_units.edit', compact('aims_type_unit'));
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
        
        $aims_type_unit = Aims_type_unit::findOrFail($id);
        $aims_type_unit->update($requestData);

        return redirect('aims_type_units')->with('flash_message', 'Aims_type_unit updated!');
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
        Aims_type_unit::destroy($id);

        return redirect('aims_type_units')->with('flash_message', 'Aims_type_unit deleted!');
    }
}

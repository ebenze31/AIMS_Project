<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests;

use App\Models\Aims_operating_unit;
use App\Models\Aims_command;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class Aims_operating_unitsController extends Controller
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
            $aims_operating_units = Aims_operating_unit::where('name_unit', 'LIKE', "%$keyword%")
                ->orWhere('type_unit', 'LIKE', "%$keyword%")
                ->orWhere('status', 'LIKE', "%$keyword%")
                ->orWhere('creator', 'LIKE', "%$keyword%")
                ->orWhere('aims_partner_id', 'LIKE', "%$keyword%")
                ->orWhere('aims_area_id', 'LIKE', "%$keyword%")
                ->latest()->paginate($perPage);
        } else {
            $aims_operating_units = Aims_operating_unit::latest()->paginate($perPage);
        }

        return view('aims_operating_units.index', compact('aims_operating_units'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('aims_operating_units.create');
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
        
        Aims_operating_unit::create($requestData);

        return redirect('aims_operating_units')->with('flash_message', 'Aims_operating_unit added!');
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
        $aims_operating_unit = Aims_operating_unit::findOrFail($id);

        return view('aims_operating_units.show', compact('aims_operating_unit'));
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
        $aims_operating_unit = Aims_operating_unit::findOrFail($id);

        return view('aims_operating_units.edit', compact('aims_operating_unit'));
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
        
        $aims_operating_unit = Aims_operating_unit::findOrFail($id);
        $aims_operating_unit->update($requestData);

        return redirect('aims_operating_units')->with('flash_message', 'Aims_operating_unit updated!');
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
        Aims_operating_unit::destroy($id);

        return redirect('aims_operating_units')->with('flash_message', 'Aims_operating_unit deleted!');
    }

    function operating_unit(){
        $data_user = Auth::user();
        $partner_of_user = Aims_command::where('user_id' , $data_user->id)->first();

        $operating_unit = DB::table('aims_operating_units')
            ->where('aims_operating_units.aims_partner_id', '=' ,$partner_of_user->aims_partner_id)
            ->leftjoin('aims_type_units', 'aims_operating_units.aims_type_unit_id', '=', 'aims_type_units.id')
            ->leftjoin('aims_areas', 'aims_operating_units.aims_area_id', '=', 'aims_areas.id')
            ->select(
                'aims_operating_units.name_unit as name_unit',
                'aims_operating_units.status as status',
                'aims_operating_units.creator as creator_units',
                'aims_type_units.name_type_unit as name_type_unit',
                'aims_areas.name_area as name_area',
            )
            ->get();
        
        return view('aims_operating_units.operating_unit', compact('operating_unit'));
    }
}

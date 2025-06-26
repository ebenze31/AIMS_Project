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
        $role = $partner_of_user->officer_role ;
        $partner_id = $partner_of_user->aims_partner_id ;
        $area_id = $partner_of_user->aims_area_id ;
        $command_id = $partner_of_user->id ;

        $aims_areas_query = DB::table('aims_areas')
            ->where('aims_partner_id', $partner_id);

        $aims_type_units_query = DB::table('aims_type_units')
            ->where('aims_partner_id', $partner_id);

        if ($role === 'admin-area') {
            $aims_areas_query->where('id', $area_id);
            $aims_type_units_query->where('aims_area_id', $area_id);
        }

        $aims_areas = $aims_areas_query
            ->select('id', 'name_area', 'status')
            ->get();

        $aims_type_units = $aims_type_units_query
            ->select('id', 'name_type_unit')
            ->get();

        $operating_unit = DB::table('aims_operating_units')
            ->where('aims_operating_units.aims_partner_id', '=' ,$partner_id)
            ->leftjoin('aims_type_units', 'aims_operating_units.aims_type_unit_id', '=', 'aims_type_units.id')
            ->leftjoin('aims_areas', 'aims_operating_units.aims_area_id', '=', 'aims_areas.id')
            ->select(
                'aims_operating_units.id as id',
                'aims_operating_units.name_unit as name_unit',
                'aims_operating_units.status as status',
                'aims_operating_units.creator as creator_units',
                'aims_type_units.name_type_unit as name_type_unit',
                'aims_areas.name_area as name_area',
            )
            ->get();
        
        return view('aims_operating_units.operating_unit', compact('operating_unit', 'aims_areas', 'aims_type_units', 'role', 'partner_id', 'command_id'));
    }

    function cf_add_operating_unit(Request $request)
    {
        $requestData = $request->json()->all();
        $newUnit = Aims_operating_unit::create($requestData);

        return response()->json([
            'status' => 'success',
            'id' => $newUnit->id
        ]);
    }

}

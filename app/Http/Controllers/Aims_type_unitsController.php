<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests;

use App\Models\Aims_type_unit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\Aims_command;

class Aims_type_unitsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\View\View
     */
    public function index(Request $request)
    {
        $data_user = Auth::user();

        $aims_commands = Aims_command::where('user_id' , $data_user->id)->first();
        $officer_role = $aims_commands->officer_role ;
        $aims_partner_id = $aims_commands->aims_partner_id ;
        $aims_area_id = $aims_commands->aims_area_id ;

        if($officer_role == "admin-partner"){
            $aims_type_units = DB::table('aims_type_units')
                ->where('aims_type_units.aims_partner_id', '=' ,$aims_partner_id)
                ->leftjoin('aims_areas', 'aims_type_units.aims_area_id', '=', 'aims_areas.id')
                ->select(
                    'aims_areas.name_area as name_area',
                    'aims_type_units.*',
                )
                ->get();
        }
        else if($officer_role == "admin-area"){
            $aims_type_units = DB::table('aims_type_units')
                ->where('aims_type_units.aims_partner_id', '=' ,$aims_partner_id)
                ->where('aims_type_units.aims_area_id', '=' ,$aims_area_id)
                ->leftjoin('aims_areas', 'aims_type_units.aims_area_id', '=', 'aims_areas.id')
                ->select(
                    'aims_areas.name_area as name_area',
                    'aims_type_units.*',
                )
                ->get();
        }

        $data_for_add = DB::table('aims_areas')
                ->where('aims_areas.id', '=' ,$aims_area_id)
                ->leftjoin('aims_partners', 'aims_areas.aims_partner_id', '=', 'aims_partners.id')
                ->select(
                    'aims_areas.name_area as name_area',
                    'aims_partners.name as name_partner',
                )
                ->first();

        $emergency_types = DB::table('aims_emergency_types')
                ->where('aims_partner_id', '=' ,$aims_partner_id)
                ->where('aims_area_id', '=' ,$aims_area_id)
                ->get();

        return view('aims_type_units.index', compact('aims_type_units','officer_role','aims_partner_id','aims_area_id','data_for_add','emergency_types'));
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
        $data_user = Auth::user();

        $aims_commands = Aims_command::where('user_id' , $data_user->id)->first();
        $officer_role = $aims_commands->officer_role ;
        $aims_partner_id = $aims_commands->aims_partner_id ;
        $aims_area_id = $aims_commands->aims_area_id ;

        $aims_type_unit = Aims_type_unit::findOrFail($id);

        $emergency_types = DB::table('aims_emergency_types')
                ->where('aims_partner_id', '=' ,$aims_partner_id)
                ->where('aims_area_id', '=' ,$aims_area_id)
                ->get();

        return view('aims_type_units.edit', compact('aims_type_unit','emergency_types'));
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

    function cf_add_type_units(Request $request)
    {
        $requestData = $request->all();
        $requestData['emergency_type'] = json_encode($requestData['emergency_type']);
        Aims_type_unit::create($requestData);

        return "success" ;
    }

    function cf_edit_type_units(Request $request, $type_unit_id)
    {
        $requestData = $request->all();
        
        $aims_type_unit = Aims_type_unit::findOrFail($type_unit_id);
        $aims_type_unit->update($requestData);

        return "success" ;
    }
}

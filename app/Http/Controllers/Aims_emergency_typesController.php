<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests;

use App\Models\Aims_emergency_type;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\Aims_command;

class Aims_emergency_typesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\View\View
     */
    public function index(Request $request)
    {
        // $aims_emergency_types = Aims_emergency_type::where('name_emergency_type' , '!=' , null)->get();
        $data_user = Auth::user();

        $aims_commands = Aims_command::where('user_id' , $data_user->id)->first();
        $officer_role = $aims_commands->officer_role ;
        $aims_partner_id = $aims_commands->aims_partner_id ;
        $aims_area_id = $aims_commands->aims_area_id ;

        if($officer_role == "admin-partner"){
            $aims_emergency_types = DB::table('aims_emergency_types')
                ->where('aims_emergency_types.aims_partner_id', '=' ,$aims_partner_id)
                ->leftjoin('aims_areas', 'aims_emergency_types.aims_area_id', '=', 'aims_areas.id')
                ->select(
                    'aims_areas.name_area as name_area',
                    'aims_emergency_types.*',
                )
                ->get();
        }
        else if($officer_role == "admin-area"){
            $aims_emergency_types = DB::table('aims_emergency_types')
                ->where('aims_emergency_types.aims_partner_id', '=' ,$aims_partner_id)
                ->where('aims_emergency_types.aims_area_id', '=' ,$aims_area_id)
                ->leftjoin('aims_areas', 'aims_emergency_types.aims_area_id', '=', 'aims_areas.id')
                ->select(
                    'aims_areas.name_area as name_area',
                    'aims_emergency_types.*',
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

        return view('aims_emergency_types.index', compact('aims_emergency_types','officer_role','aims_partner_id','aims_area_id','data_for_add'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('aims_emergency_types.create');
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
        
        Aims_emergency_type::create($requestData);

        return redirect('aims_emergency_types')->with('flash_message', 'Aims_emergency_type added!');
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
        $aims_emergency_type = Aims_emergency_type::findOrFail($id);

        return view('aims_emergency_types.show', compact('aims_emergency_type'));
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
        $aims_emergency_type = Aims_emergency_type::findOrFail($id);

        return view('aims_emergency_types.edit', compact('aims_emergency_type'));
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
        
        $aims_emergency_type = Aims_emergency_type::findOrFail($id);
        $aims_emergency_type->update($requestData);

        return redirect('aims_emergency_types')->with('flash_message', 'Aims_emergency_type updated!');
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
        Aims_emergency_type::destroy($id);

        return redirect('aims_emergency_types')->with('flash_message', 'Aims_emergency_type deleted!');
    }

    function get_emergency_types($area_id , $partner_id)
    {
        $data = Aims_emergency_type::where('aims_partner_id' , $partner_id)
            ->where('aims_area_id' , $area_id)
            ->where('status' , 'Active')
            ->get();

        return $data ;
    }

    function cf_add_emergency_type(Request $request)
    {
        $requestData = $request->all();
        Aims_emergency_type::create($requestData);

        return "success" ;

    }

    function change_status_emergency_type($id , $new_status){

        DB::table('aims_emergency_types')
            ->where('id',$id)
            ->update([
                'status' => $new_status ,
        ]);

        return "success" ;

    }
}

<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests;

use App\Models\Aims_emergency;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class Aims_emergencysController extends Controller
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
            $aims_emergencys = Aims_emergency::where('aims_partner_id', 'LIKE', "%$keyword%")
                ->orWhere('aims_area_id', 'LIKE', "%$keyword%")
                ->orWhere('report_platform', 'LIKE', "%$keyword%")
                ->orWhere('name_reporter', 'LIKE', "%$keyword%")
                ->orWhere('type_reporter', 'LIKE', "%$keyword%")
                ->orWhere('phone_reporter', 'LIKE', "%$keyword%")
                ->orWhere('emergency_type', 'LIKE', "%$keyword%")
                ->orWhere('emergency_detail', 'LIKE', "%$keyword%")
                ->orWhere('emergency_lat', 'LIKE', "%$keyword%")
                ->orWhere('emergency_lng', 'LIKE', "%$keyword%")
                ->orWhere('emergency_location', 'LIKE', "%$keyword%")
                ->orWhere('emergency_photo', 'LIKE', "%$keyword%")
                ->orWhere('score_impression', 'LIKE', "%$keyword%")
                ->orWhere('score_period', 'LIKE', "%$keyword%")
                ->orWhere('score_total', 'LIKE', "%$keyword%")
                ->orWhere('comment_help', 'LIKE', "%$keyword%")
                ->orWhere('patient_name', 'LIKE', "%$keyword%")
                ->orWhere('patient_birth', 'LIKE', "%$keyword%")
                ->orWhere('patient_identification', 'LIKE', "%$keyword%")
                ->orWhere('patient_gender', 'LIKE', "%$keyword%")
                ->orWhere('patient_blood_type', 'LIKE', "%$keyword%")
                ->orWhere('patient_phone', 'LIKE', "%$keyword%")
                ->orWhere('patient_address', 'LIKE', "%$keyword%")
                ->orWhere('patient_congenital_disease', 'LIKE', "%$keyword%")
                ->orWhere('patient_allergic_drugs', 'LIKE', "%$keyword%")
                ->orWhere('patient_regularly_medications', 'LIKE', "%$keyword%")
                ->orWhere('symptom', 'LIKE', "%$keyword%")
                ->orWhere('symptom_other', 'LIKE', "%$keyword%")
                ->orWhere('idc', 'LIKE', "%$keyword%")
                ->orWhere('rc', 'LIKE', "%$keyword%")
                ->orWhere('rc_black_text', 'LIKE', "%$keyword%")
                ->latest()->paginate($perPage);
        } else {
            $aims_emergencys = Aims_emergency::latest()->paginate($perPage);
        }

        return view('aims_emergencys.index', compact('aims_emergencys'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('aims_emergencys.create');
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
        
        Aims_emergency::create($requestData);

        return redirect('aims_emergencys')->with('flash_message', 'Aims_emergency added!');
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
        $aims_emergency = Aims_emergency::findOrFail($id);

        return view('aims_emergencys.show', compact('aims_emergency'));
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
        $aims_emergency = Aims_emergency::findOrFail($id);

        return view('aims_emergencys.edit', compact('aims_emergency'));
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
        
        $aims_emergency = Aims_emergency::findOrFail($id);
        $aims_emergency->update($requestData);

        return redirect('aims_emergencys')->with('flash_message', 'Aims_emergency updated!');
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
        Aims_emergency::destroy($id);

        return redirect('aims_emergencys')->with('flash_message', 'Aims_emergency deleted!');
    }

    function get_polygon_all(){

        $polygon = DB::table('aims_areas')
            ->join('aims_partners', 'aims_areas.aims_partner_id', '=', 'aims_partners.id')
            ->select(
                'aims_areas.*',
                'aims_partners.name as name_partner',
                'aims_partners.full_name as full_name_partner',
                'aims_partners.logo as logo',
                'aims_partners.color as color',
                'aims_partners.province as province',
                'aims_partners.district as district',
                'aims_partners.sub_district as sub_district',
            )
            ->where('aims_areas.status', "show")
            ->get();

        return $polygon ;

    }

    function send_emergency(Request $request)
    {
        $requestData = $request->all();

        echo "<pre>";
        print_r($requestData);
        echo "<pre>";
        exit();

        // return "success" ;
    }
}

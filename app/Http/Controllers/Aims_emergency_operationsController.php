<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests;

use App\Models\Aims_emergency_operation;
use Illuminate\Http\Request;

class Aims_emergency_operationsController extends Controller
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
            $aims_emergency_operations = Aims_emergency_operation::where('aims_emergency_id', 'LIKE', "%$keyword%")
                ->orWhere('notify', 'LIKE', "%$keyword%")
                ->orWhere('command_by', 'LIKE', "%$keyword%")
                ->orWhere('operating_code', 'LIKE', "%$keyword%")
                ->orWhere('waiting_reply', 'LIKE', "%$keyword%")
                ->orWhere('officer_refuse', 'LIKE', "%$keyword%")
                ->orWhere('status', 'LIKE', "%$keyword%")
                ->orWhere('remark_status', 'LIKE', "%$keyword%")
                ->orWhere('treatment', 'LIKE', "%$keyword%")
                ->orWhere('sub_treatment', 'LIKE', "%$keyword%")
                ->orWhere('aims_operating_unit_id', 'LIKE', "%$keyword%")
                ->orWhere('aims_operating_officers', 'LIKE', "%$keyword%")
                ->orWhere('time_create_sos', 'LIKE', "%$keyword%")
                ->orWhere('time_command', 'LIKE', "%$keyword%")
                ->orWhere('time_go_to_help', 'LIKE', "%$keyword%")
                ->orWhere('time_to_the_scene', 'LIKE', "%$keyword%")
                ->orWhere('time_leave_the_scene', 'LIKE', "%$keyword%")
                ->orWhere('time_hospital', 'LIKE', "%$keyword%")
                ->orWhere('time_to_the_operating_base', 'LIKE', "%$keyword%")
                ->orWhere('time_sos_success', 'LIKE', "%$keyword%")
                ->orWhere('time_sum_sos', 'LIKE', "%$keyword%")
                ->orWhere('time_sum_to_base', 'LIKE', "%$keyword%")
                ->orWhere('km_before', 'LIKE', "%$keyword%")
                ->orWhere('km_to_the_scene', 'LIKE', "%$keyword%")
                ->orWhere('km_hospital', 'LIKE', "%$keyword%")
                ->orWhere('km_operating_base', 'LIKE', "%$keyword%")
                ->orWhere('km_sum', 'LIKE', "%$keyword%")
                ->orWhere('photo_by_officer', 'LIKE', "%$keyword%")
                ->orWhere('remark_photo_by_officer', 'LIKE', "%$keyword%")
                ->orWhere('photo_succeed', 'LIKE', "%$keyword%")
                ->orWhere('remark_by_helper', 'LIKE', "%$keyword%")
                ->latest()->paginate($perPage);
        } else {
            $aims_emergency_operations = Aims_emergency_operation::latest()->paginate($perPage);
        }

        return view('aims_emergency_operations.index', compact('aims_emergency_operations'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('aims_emergency_operations.create');
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
        
        Aims_emergency_operation::create($requestData);

        return redirect('aims_emergency_operations')->with('flash_message', 'Aims_emergency_operation added!');
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
        $aims_emergency_operation = Aims_emergency_operation::findOrFail($id);

        return view('aims_emergency_operations.show', compact('aims_emergency_operation'));
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
        $aims_emergency_operation = Aims_emergency_operation::findOrFail($id);

        return view('aims_emergency_operations.edit', compact('aims_emergency_operation'));
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
        
        $aims_emergency_operation = Aims_emergency_operation::findOrFail($id);
        $aims_emergency_operation->update($requestData);

        return redirect('aims_emergency_operations')->with('flash_message', 'Aims_emergency_operation updated!');
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
        Aims_emergency_operation::destroy($id);

        return redirect('aims_emergency_operations')->with('flash_message', 'Aims_emergency_operation deleted!');
    }
}

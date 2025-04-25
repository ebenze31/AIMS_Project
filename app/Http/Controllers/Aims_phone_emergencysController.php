<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests;

use App\Models\Aims_phone_emergency;
use Illuminate\Http\Request;

class Aims_phone_emergencysController extends Controller
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
            $aims_phone_emergencys = Aims_phone_emergency::where('name', 'LIKE', "%$keyword%")
                ->orWhere('phone', 'LIKE', "%$keyword%")
                ->orWhere('country_code', 'LIKE', "%$keyword%")
                ->orWhere('priority', 'LIKE', "%$keyword%")
                ->orWhere('status', 'LIKE', "%$keyword%")
                ->latest()->paginate($perPage);
        } else {
            $aims_phone_emergencys = Aims_phone_emergency::latest()->paginate($perPage);
        }

        return view('aims_phone_emergencys.index', compact('aims_phone_emergencys'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('aims_phone_emergencys.create');
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
        
        Aims_phone_emergency::create($requestData);

        return redirect('aims_phone_emergencys')->with('flash_message', 'Aims_phone_emergency added!');
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
        $aims_phone_emergency = Aims_phone_emergency::findOrFail($id);

        return view('aims_phone_emergencys.show', compact('aims_phone_emergency'));
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
        $aims_phone_emergency = Aims_phone_emergency::findOrFail($id);

        return view('aims_phone_emergencys.edit', compact('aims_phone_emergency'));
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
        
        $aims_phone_emergency = Aims_phone_emergency::findOrFail($id);
        $aims_phone_emergency->update($requestData);

        return redirect('aims_phone_emergencys')->with('flash_message', 'Aims_phone_emergency updated!');
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
        Aims_phone_emergency::destroy($id);

        return redirect('aims_phone_emergencys')->with('flash_message', 'Aims_phone_emergency deleted!');
    }

    function get_data_phone_emergency($countryCode){
        $data = Aims_phone_emergency::where('country_code' , $countryCode)
            ->where('status' , 'Show')
            ->orderBy('priority' , 'ASC')
            ->get();

        return $data ;
    }
}

<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests;

use App\Models\Aims_command;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class Aims_commandsController extends Controller
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
            $aims_commands = Aims_command::where('name_officer_command', 'LIKE', "%$keyword%")
                ->orWhere('officer_role', 'LIKE', "%$keyword%")
                ->orWhere('number', 'LIKE', "%$keyword%")
                ->orWhere('status', 'LIKE', "%$keyword%")
                ->orWhere('creator', 'LIKE', "%$keyword%")
                ->orWhere('user_id', 'LIKE', "%$keyword%")
                ->orWhere('aims_partner_id', 'LIKE', "%$keyword%")
                ->orWhere('aims_area_id', 'LIKE', "%$keyword%")
                ->latest()->paginate($perPage);
        } else {
            $aims_commands = Aims_command::latest()->paginate($perPage);
        }

        return view('aims_commands.index', compact('aims_commands'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('aims_commands.create');
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
        
        Aims_command::create($requestData);

        return redirect('aims_commands')->with('flash_message', 'Aims_command added!');
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
        $aims_command = Aims_command::findOrFail($id);

        return view('aims_commands.show', compact('aims_command'));
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
        $aims_command = Aims_command::findOrFail($id);

        return view('aims_commands.edit', compact('aims_command'));
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
        
        $aims_command = Aims_command::findOrFail($id);
        $aims_command->update($requestData);

        return redirect('aims_commands')->with('flash_message', 'Aims_command updated!');
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
        Aims_command::destroy($id);

        return redirect('aims_commands')->with('flash_message', 'Aims_command deleted!');
    }

    public function all_name_user_partner(Request $request)
    {
        $data_user = Auth::user();

        $partner_of_user = Aims_command::where('user_id' , $data_user->id)->first();
        $member_commands = DB::table('aims_commands')
            ->where('aims_commands.aims_partner_id', '=' ,$partner_of_user->aims_partner_id)
            ->leftjoin('users', 'aims_commands.user_id', '=', 'users.id')
            ->select(
                'aims_commands.name_officer_command as name_officer_command',
                'aims_commands.number as number',
                'aims_commands.status as status',
                'aims_commands.creator as creator',
                'users.phone as user_phone',
                'users.photo as user_photo',
            )
            ->get();
        
        return view('aims_commands.member_command', compact('member_commands'));
    }
}

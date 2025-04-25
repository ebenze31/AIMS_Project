@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            @include('admin.sidebar')

            <div class="col-md-9">
                <div class="card">
                    <div class="card-header">Aims_emergency {{ $aims_emergency->id }}</div>
                    <div class="card-body">

                        <a href="{{ url('/aims_emergencys') }}" title="Back"><button class="btn btn-warning btn-sm"><i class="fa fa-arrow-left" aria-hidden="true"></i> Back</button></a>
                        <a href="{{ url('/aims_emergencys/' . $aims_emergency->id . '/edit') }}" title="Edit Aims_emergency"><button class="btn btn-primary btn-sm"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit</button></a>

                        <form method="POST" action="{{ url('aims_emergencys' . '/' . $aims_emergency->id) }}" accept-charset="UTF-8" style="display:inline">
                            {{ method_field('DELETE') }}
                            {{ csrf_field() }}
                            <button type="submit" class="btn btn-danger btn-sm" title="Delete Aims_emergency" onclick="return confirm(&quot;Confirm delete?&quot;)"><i class="fa fa-trash-o" aria-hidden="true"></i> Delete</button>
                        </form>
                        <br/>
                        <br/>

                        <div class="table-responsive">
                            <table class="table">
                                <tbody>
                                    <tr>
                                        <th>ID</th><td>{{ $aims_emergency->id }}</td>
                                    </tr>
                                    <tr><th> Aims Partner Id </th><td> {{ $aims_emergency->aims_partner_id }} </td></tr><tr><th> Aims Area Id </th><td> {{ $aims_emergency->aims_area_id }} </td></tr><tr><th> Report Platform </th><td> {{ $aims_emergency->report_platform }} </td></tr>
                                </tbody>
                            </table>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            @include('admin.sidebar')

            <div class="col-md-9">
                <div class="card">
                    <div class="card-header">Aims_type_unit {{ $aims_type_unit->id }}</div>
                    <div class="card-body">

                        <a href="{{ url('/aims_type_units') }}" title="Back"><button class="btn btn-warning btn-sm"><i class="fa fa-arrow-left" aria-hidden="true"></i> Back</button></a>
                        <a href="{{ url('/aims_type_units/' . $aims_type_unit->id . '/edit') }}" title="Edit Aims_type_unit"><button class="btn btn-primary btn-sm"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit</button></a>

                        <form method="POST" action="{{ url('aims_type_units' . '/' . $aims_type_unit->id) }}" accept-charset="UTF-8" style="display:inline">
                            {{ method_field('DELETE') }}
                            {{ csrf_field() }}
                            <button type="submit" class="btn btn-danger btn-sm" title="Delete Aims_type_unit" onclick="return confirm(&quot;Confirm delete?&quot;)"><i class="fa fa-trash-o" aria-hidden="true"></i> Delete</button>
                        </form>
                        <br/>
                        <br/>

                        <div class="table-responsive">
                            <table class="table">
                                <tbody>
                                    <tr>
                                        <th>ID</th><td>{{ $aims_type_unit->id }}</td>
                                    </tr>
                                    <tr><th> Name Type Unit </th><td> {{ $aims_type_unit->name_type_unit }} </td></tr><tr><th> Aims Partner Id </th><td> {{ $aims_type_unit->aims_partner_id }} </td></tr><tr><th> Aims Area Id </th><td> {{ $aims_type_unit->aims_area_id }} </td></tr>
                                </tbody>
                            </table>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            @include('admin.sidebar')

            <div class="col-md-9">
                <div class="card">
                    <div class="card-header">Aims_operating_unit {{ $aims_operating_unit->id }}</div>
                    <div class="card-body">

                        <a href="{{ url('/aims_operating_units') }}" title="Back"><button class="btn btn-warning btn-sm"><i class="fa fa-arrow-left" aria-hidden="true"></i> Back</button></a>
                        <a href="{{ url('/aims_operating_units/' . $aims_operating_unit->id . '/edit') }}" title="Edit Aims_operating_unit"><button class="btn btn-primary btn-sm"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit</button></a>

                        <form method="POST" action="{{ url('aims_operating_units' . '/' . $aims_operating_unit->id) }}" accept-charset="UTF-8" style="display:inline">
                            {{ method_field('DELETE') }}
                            {{ csrf_field() }}
                            <button type="submit" class="btn btn-danger btn-sm" title="Delete Aims_operating_unit" onclick="return confirm(&quot;Confirm delete?&quot;)"><i class="fa fa-trash-o" aria-hidden="true"></i> Delete</button>
                        </form>
                        <br/>
                        <br/>

                        <div class="table-responsive">
                            <table class="table">
                                <tbody>
                                    <tr>
                                        <th>ID</th><td>{{ $aims_operating_unit->id }}</td>
                                    </tr>
                                    <tr><th> Name Unit </th><td> {{ $aims_operating_unit->name_unit }} </td></tr><tr><th> Type Unit </th><td> {{ $aims_operating_unit->type_unit }} </td></tr><tr><th> Status </th><td> {{ $aims_operating_unit->status }} </td></tr>
                                </tbody>
                            </table>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

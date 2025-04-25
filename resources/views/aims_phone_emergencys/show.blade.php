@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            @include('admin.sidebar')

            <div class="col-md-9">
                <div class="card">
                    <div class="card-header">Aims_phone_emergency {{ $aims_phone_emergency->id }}</div>
                    <div class="card-body">

                        <a href="{{ url('/aims_phone_emergencys') }}" title="Back"><button class="btn btn-warning btn-sm"><i class="fa fa-arrow-left" aria-hidden="true"></i> Back</button></a>
                        <a href="{{ url('/aims_phone_emergencys/' . $aims_phone_emergency->id . '/edit') }}" title="Edit Aims_phone_emergency"><button class="btn btn-primary btn-sm"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit</button></a>

                        <form method="POST" action="{{ url('aims_phone_emergencys' . '/' . $aims_phone_emergency->id) }}" accept-charset="UTF-8" style="display:inline">
                            {{ method_field('DELETE') }}
                            {{ csrf_field() }}
                            <button type="submit" class="btn btn-danger btn-sm" title="Delete Aims_phone_emergency" onclick="return confirm(&quot;Confirm delete?&quot;)"><i class="fa fa-trash-o" aria-hidden="true"></i> Delete</button>
                        </form>
                        <br/>
                        <br/>

                        <div class="table-responsive">
                            <table class="table">
                                <tbody>
                                    <tr>
                                        <th>ID</th><td>{{ $aims_phone_emergency->id }}</td>
                                    </tr>
                                    <tr><th> Name </th><td> {{ $aims_phone_emergency->name }} </td></tr><tr><th> Phone </th><td> {{ $aims_phone_emergency->phone }} </td></tr><tr><th> Country Code </th><td> {{ $aims_phone_emergency->country_code }} </td></tr>
                                </tbody>
                            </table>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

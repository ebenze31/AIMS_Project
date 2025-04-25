@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            @include('admin.sidebar')

            <div class="col-md-9">
                <div class="card">
                    <div class="card-header">Aims_emergency_operation {{ $aims_emergency_operation->id }}</div>
                    <div class="card-body">

                        <a href="{{ url('/aims_emergency_operations') }}" title="Back"><button class="btn btn-warning btn-sm"><i class="fa fa-arrow-left" aria-hidden="true"></i> Back</button></a>
                        <a href="{{ url('/aims_emergency_operations/' . $aims_emergency_operation->id . '/edit') }}" title="Edit Aims_emergency_operation"><button class="btn btn-primary btn-sm"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit</button></a>

                        <form method="POST" action="{{ url('aims_emergency_operations' . '/' . $aims_emergency_operation->id) }}" accept-charset="UTF-8" style="display:inline">
                            {{ method_field('DELETE') }}
                            {{ csrf_field() }}
                            <button type="submit" class="btn btn-danger btn-sm" title="Delete Aims_emergency_operation" onclick="return confirm(&quot;Confirm delete?&quot;)"><i class="fa fa-trash-o" aria-hidden="true"></i> Delete</button>
                        </form>
                        <br/>
                        <br/>

                        <div class="table-responsive">
                            <table class="table">
                                <tbody>
                                    <tr>
                                        <th>ID</th><td>{{ $aims_emergency_operation->id }}</td>
                                    </tr>
                                    <tr><th> Aims Emergency Id </th><td> {{ $aims_emergency_operation->aims_emergency_id }} </td></tr><tr><th> Notify </th><td> {{ $aims_emergency_operation->notify }} </td></tr><tr><th> Command By </th><td> {{ $aims_emergency_operation->command_by }} </td></tr>
                                </tbody>
                            </table>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

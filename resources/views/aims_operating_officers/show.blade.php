@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            @include('admin.sidebar')

            <div class="col-md-9">
                <div class="card">
                    <div class="card-header">Aims_operating_officer {{ $aims_operating_officer->id }}</div>
                    <div class="card-body">

                        <a href="{{ url('/aims_operating_officers') }}" title="Back"><button class="btn btn-warning btn-sm"><i class="fa fa-arrow-left" aria-hidden="true"></i> Back</button></a>
                        <a href="{{ url('/aims_operating_officers/' . $aims_operating_officer->id . '/edit') }}" title="Edit Aims_operating_officer"><button class="btn btn-primary btn-sm"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit</button></a>

                        <form method="POST" action="{{ url('aims_operating_officers' . '/' . $aims_operating_officer->id) }}" accept-charset="UTF-8" style="display:inline">
                            {{ method_field('DELETE') }}
                            {{ csrf_field() }}
                            <button type="submit" class="btn btn-danger btn-sm" title="Delete Aims_operating_officer" onclick="return confirm(&quot;Confirm delete?&quot;)"><i class="fa fa-trash-o" aria-hidden="true"></i> Delete</button>
                        </form>
                        <br/>
                        <br/>

                        <div class="table-responsive">
                            <table class="table">
                                <tbody>
                                    <tr>
                                        <th>ID</th><td>{{ $aims_operating_officer->id }}</td>
                                    </tr>
                                    <tr><th> Name Officer </th><td> {{ $aims_operating_officer->name_officer }} </td></tr><tr><th> Type </th><td> {{ $aims_operating_officer->type }} </td></tr><tr><th> Level </th><td> {{ $aims_operating_officer->level }} </td></tr>
                                </tbody>
                            </table>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

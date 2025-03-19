@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            @include('admin.sidebar')

            <div class="col-md-9">
                <div class="card">
                    <div class="card-header">Sos_partner_officer {{ $sos_partner_officer->id }}</div>
                    <div class="card-body">

                        <a href="{{ url('/sos_partner_officers') }}" title="Back"><button class="btn btn-warning btn-sm"><i class="fa fa-arrow-left" aria-hidden="true"></i> Back</button></a>
                        <a href="{{ url('/sos_partner_officers/' . $sos_partner_officer->id . '/edit') }}" title="Edit Sos_partner_officer"><button class="btn btn-primary btn-sm"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit</button></a>

                        <form method="POST" action="{{ url('sos_partner_officers' . '/' . $sos_partner_officer->id) }}" accept-charset="UTF-8" style="display:inline">
                            {{ method_field('DELETE') }}
                            {{ csrf_field() }}
                            <button type="submit" class="btn btn-danger btn-sm" title="Delete Sos_partner_officer" onclick="return confirm(&quot;Confirm delete?&quot;)"><i class="fa fa-trash-o" aria-hidden="true"></i> Delete</button>
                        </form>
                        <br/>
                        <br/>

                        <div class="table-responsive">
                            <table class="table">
                                <tbody>
                                    <tr>
                                        <th>ID</th><td>{{ $sos_partner_officer->id }}</td>
                                    </tr>
                                    <tr><th> Full Name </th><td> {{ $sos_partner_officer->full_name }} </td></tr><tr><th> Phone </th><td> {{ $sos_partner_officer->phone }} </td></tr><tr><th> Department </th><td> {{ $sos_partner_officer->department }} </td></tr>
                                </tbody>
                            </table>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@extends('layouts.admin')

@section('content')
<br>
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">Nationalitie_group_line {{ $nationalitie_group_line->id }}</div>
                    <div class="card-body">

                        <a href="{{ url('/nationalitie_group_lines') }}" title="Back"><button class="btn btn-warning btn-sm"><i class="fa fa-arrow-left" aria-hidden="true"></i> Back</button></a>
                        <a href="{{ url('/nationalitie_group_lines/' . $nationalitie_group_line->id . '/edit') }}" title="Edit Nationalitie_group_line"><button class="btn btn-primary btn-sm"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit</button></a>

                        <form method="POST" action="{{ url('nationalitie_group_lines' . '/' . $nationalitie_group_line->id) }}" accept-charset="UTF-8" style="display:inline">
                            {{ method_field('DELETE') }}
                            {{ csrf_field() }}
                            <button type="submit" class="btn btn-danger btn-sm" title="Delete Nationalitie_group_line" onclick="return confirm(&quot;Confirm delete?&quot;)"><i class="fa fa-trash-o" aria-hidden="true"></i> Delete</button>
                        </form>
                        <br/>
                        <br/>

                        <div class="table-responsive">
                            <table class="table">
                                <tbody>
                                    <tr>
                                        <th>ID</th><td>{{ $nationalitie_group_line->id }}</td>
                                    </tr>
                                    <tr><th> GroupId </th><td> {{ $nationalitie_group_line->groupId }} </td></tr><tr><th> GroupName </th><td> {{ $nationalitie_group_line->groupName }} </td></tr><tr><th> PictureUrl </th><td> {{ $nationalitie_group_line->pictureUrl }} </td></tr>
                                </tbody>
                            </table>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

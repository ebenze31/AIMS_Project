@extends('layouts.partners.theme_partner_new')

@section('content')

<div class="card radius-10 border-top border-0 border-4 border-primary">
    <div class="card-body p-3">
        <div class="card-title d-flex align-items-center">
            <div>
                <i class='fa-solid fa-pen me-1 font-22'></i>
            </div>
            <h5 class="mb-0">
                แก้ไข <b>{{ $aims_type_unit->name_type_unit }}</b>
            </h5>
            <button style="margin-left: 10px;margin-right: 10px;" type="button" class="btn btn-white radius-10 float-end ms-auto" onclick="window.history.back();">
                <i class="fa fa-arrow-left"></i> ย้อนกลับ
            </button>
        </div>
        <hr>
        @if ($errors->any())
            <ul class="alert alert-danger">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        @endif

        @include ('aims_type_units.form')
        
    </div>
</div>
@endsection

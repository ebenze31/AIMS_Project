@extends('layouts.partners.theme_partner_new')

@section('content')

<div class="modal fade" id="Modal_add_operating_unit" tabindex="-1" aria-labelledby="Modal_add_operating_unit" aria-hidden="true">
    <div class="modal-dialog modal-xl modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content">
            <div class="card border-top border-0 border-4 border-info">
                <div class="card-body">
                    <div class="border p-4 rounded">
                        <div class="card-title d-flex align-items-center">
                            <div>
                                <i class="fa-solid fa-truck-medical me-1 font-22 text-info"></i>
                            </div>
                            <h5 class="mb-0 text-info">เพิ่มหน่วยปฏิบัติการ</h5>
                        </div>
                        <hr>
                        <div class="row mb-3">
                            <label for="name_unit" class="col-sm-3 col-form-label">ชื่อหน่วย</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control add_data" id="name_unit" name="name_unit" placeholder="เพิ่มชื่อหน่วย" oninput="check_title();">
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="aims_type_unit_id" class="col-sm-3 col-form-label">ประเภท</label>
                            <div class="col-sm-9">
                                <select class="form-select add_data" id="aims_type_unit_id" name="aims_type_unit_id" onchange="check_title();">
                                    <option value="" selected>เลือกประเภท</option>
                                    @foreach($aims_type_units as $type_units)
                                    <option value="{{ $type_units->id }}">{{ $type_units->name_type_unit }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="row mb-3">
                        @if( $role == "admin-partner" )
                            <label for="aims_area_id" class="col-sm-3 col-form-label">พื้นที่</label>
                            <div class="col-sm-9">
                                <select class="form-select add_data" id="aims_area_id" name="aims_area_id" onchange="check_title();">
                                    <option value="" selected>เลือกพื้นที่</option>
                                    @foreach($aims_areas as $areas)
                                    <option value="{{ $areas->id }}">{{ $areas->name_area }}</option>
                                    @endforeach
                                </select>
                            </div>
                        @elseif( $role == "admin-area" )
                            <label for="aims_area_id" class="col-sm-3 col-form-label">พื้นที่</label>
                            <div class="col-sm-9">
                                <select class="form-select add_data" id="aims_area_id" name="aims_area_id" disabled>
                                    @foreach($aims_areas as $areas)
                                        <option value="{{ $areas->id }}" selected>{{ $areas->name_area }}</option>
                                    @endforeach
                                </select>
                            </div>
                        @endif
                        </div>

                        <div class="row mb-3 d-none">
                            <input type="text" class="form-control add_data" id="status" name="status" value="Active" readonly>
                            <input type="text" class="form-control add_data" id="aims_partner_id" name="aims_partner_id" value="{{ $partner_id }}" readonly>
                            <input type="text" class="form-control add_data" id="creator" name="creator" value="{{ $command_id }}" readonly>
                        </div>

                        <div class="text-center mt-4">
                            <div class="d-inline-flex gap-3">
                                <button type="button" class="btn btn-secondary w-100" style="min-width: 120px;" data-dismiss="modal">ปิด</button>
                                <button id="btn_submit" disabled type="button" class="btn btn-success w-100" style="min-width: 120px;" onclick="submit_add_data();">ยืนยัน</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="card radius-10 border-top border-0 border-4 border-primary">
    <div class="card-body p-3">
        <div class="card-title d-flex align-items-center">
            <div>
                <i class='fa-solid fa-truck-medical me-1 font-22'></i>
            </div>
            <h5 class="mb-0">
                หน่วยปฏิบัติการ
            </h5>
            <button style="margin-left: 10px;margin-right: 10px;" class="btn btn-success radius-10 float-end ms-auto" data-toggle="modal" data-target="#Modal_add_operating_unit">
                <i class="fa fa-plus"></i> เพิ่มหน่วยปฏิบัติการ
            </button>
        </div>
        <hr>
        <div class="table-responsive">
            <table id="example2555" class="table table-striped table-bordered">
                <thead>
                    <tr>
                        <th>ชื่อ</th>
                        <th>ประเภท</th>
                        <th>พื้นที่</th>
                        <th>สถานะ</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($operating_unit as $item)
                        <tr>
                            <td><h6>{{ $item->name_unit }}</h6></td>
                            <td>{{ $item->name_type_unit }}</td>
                            <td>{{ $item->name_area }}</td>
                            <td>{{ $item->status }}</td>
                            <td style="width: 1%; white-space: nowrap;">
                                <div class="float-end">
                                    <a href="{{ url('/operating_unit') }}/{{ $item->id }}">
                                        <button class="btn btn-info btn-sm">
                                            <i class="fa fa-eye" aria-hidden="true"></i> รายละเอียด
                                        </button>
                                    </a>
                                    <a href="">
                                        <button class="btn btn-warning btn-sm">
                                            <i class="fa-solid fa-user-pen"></i> แก้ไข
                                        </button>
                                    </a>
                                </div>
                            </td>
                        </tr>
                    @endforeach

                </tbody>
            </table>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', (event) => {
    var table = $('#example2555').DataTable( {
        
		lengthChange: false,
		buttons: [ 'copy', 'excel', 'pdf', 'print']
	} );
 
	table.buttons().container()
		.appendTo( '#example2_wrapper .col-md-6:eq(0)' );
});

function check_title() {

    let role = "{{ $role }}";
    let btn_submit = document.querySelector('#btn_submit');
    let name_unit = document.querySelector('#name_unit');
    let aims_type_unit_id = document.querySelector('#aims_type_unit_id');
    let aims_area_id = document.querySelector('#aims_area_id');

    // เงื่อนไขแยกตาม role
    if (role === "admin-partner") {
        if (
            name_unit.value.trim() !== "" &&
            aims_type_unit_id.value.trim() !== "" &&
            aims_area_id.value.trim() !== ""
        ) {
            btn_submit.disabled = false;
        } else {
            btn_submit.disabled = true;
        }
    } else if (role === "admin-area") {
        if (
            name_unit.value.trim() !== "" &&
            aims_type_unit_id.value.trim() !== ""
        ) {
            btn_submit.disabled = false;
        } else {
            btn_submit.disabled = true;
        }
    }
}

function submit_add_data() {

    const elements = document.querySelectorAll('.add_data');
    const data = {};

    elements.forEach((element, index) => {
        const key = element.name || element.id || `field_${index}`;
        data[key] = element.value;
    });

    // console.log(data);

    fetch("{{ url('/') }}/api/cf_add_operating_unit", {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': '{{ csrf_token() }}'
        },
        body: JSON.stringify(data),
    })
    .then(response => response.json())
    .then(result => {
        if (result.status === "success") {
            // console.log(result);
            window.location.href = "{{ url('/operating_unit') }}" + "/" + result.id;
        } else {
            console.error('Server response:', result);
        }
    })
    .catch(error => console.error('Error:', error));
}
</script>
@endsection
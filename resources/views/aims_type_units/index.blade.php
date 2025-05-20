@extends('layouts.partners.theme_partner_new')

@section('content')

<!-- Modal -->
<div class="modal fade" id="add_emergency_types" tabindex="-1" aria-labelledby="add_emergency_types" aria-hidden="true">
    <div class="modal-dialog modal-xl modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content">
            <div class="card border-top border-0 border-4 border-info">
                <div class="card-body">
                    <div class="border p-4 rounded">
                        <div class="card-title d-flex align-items-center">
                            <div>
                                <i class="fa-solid fa-house-medical-circle-exclamation me-1 font-22 text-info"></i>
                            </div>
                            <h5 class="mb-0 text-info">เพิ่มประเภทหน่วยปฏิบัติการ</h5>
                        </div>
                        <hr>
                        <div class="row mb-3">
                            <label for="status" class="col-sm-3 col-form-label">พื้นที่</label>
                            <div class="col-sm-9">
                                <h6 class="mt-2">
                                    {{ $data_for_add->name_partner }} : {{ $data_for_add->name_area }}
                                </h6>
                            </div>
                            <input type="text" class="d-none form-control add_data" id="aims_area_id" name="aims_area_id" readonly value="{{ $aims_area_id }}">
                            <input type="text" class="d-none form-control add_data" id="aims_partner_id" name="aims_partner_id" readonly value="{{ $aims_partner_id }}">
                        </div>
                        <div class="row mb-3">
                            <label for="name_type_unit" class="col-sm-3 col-form-label">ชื่อประเภท</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control add_data" id="name_type_unit" name="name_type_unit" placeholder="เพิ่มประเภท" oninput="check_title();">
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="status" class="col-sm-3 col-form-label">
                                ประเภทการช่วยเหลือ <br>
                                <span class="text-danger" style="font-size: 14px;">(สำหรับแท็กการส่งเคสอัตโนมัติ)</span>
                            </label>
                            <div class="col-sm-9">

                                <div class="row">
                                    <div class="col-12">
                                        <input class="form-check-input" type="checkbox" id="checkbox_id_0" 
                                               onclick="select_priority_for_type('0', 'ผู้ใช้ไม่ได้กรอก');">

                                        <label class="form-check-label mx-2">
                                            <b style="font-size:15px;">ผู้ใช้ไม่ได้กรอก</b>
                                        </label>

                                        <input type="number" class="form-control mt-2" id="priority_for_id_0" 
                                               placeholder="ลำดับความสำคัญ" readonly 
                                               oninput="update_priority('0')">
                                    </div>
                                </div>
                                <hr>

                                @foreach($emergency_types as $e_type)
                                    <div class="row">
                                        <div class="col-12">
                                            <input class="form-check-input" type="checkbox" id="checkbox_id_{{ $e_type->id }}" 
                                                   onclick="select_priority_for_type('{{ $e_type->id }}', '{{ $e_type->name_emergency_type }}');">

                                            <label class="form-check-label mx-2">
                                                <b style="font-size:15px;">{{ $e_type->name_emergency_type }}</b>
                                                @if($e_type->status == "Active")
                                                    <span class="text-success">({{ $e_type->status }})</span>
                                                @else
                                                    <span class="text-danger">({{ $e_type->status }})</span>
                                                @endif
                                            </label>

                                            <input type="number" class="form-control mt-2" id="priority_for_id_{{ $e_type->id }}" 
                                                   placeholder="ลำดับความสำคัญ" readonly 
                                                   oninput="update_priority('{{ $e_type->id }}')">
                                        </div>
                                    </div>
                                    <hr>
                                @endforeach
                            </div>
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
                <i class='fa-solid fa-house-medical-circle-exclamation me-1 font-22'></i>
            </div>
            <h5 class="mb-0">
                ประเภทหน่วยปฏิบัติการ
            </h5>
            @if( $officer_role == "admin-area")
                <button style="margin-left: 10px;margin-right: 10px;" type="button" class="btn btn-success radius-10 float-end ms-auto" data-toggle="modal" data-target="#add_emergency_types">
                    <i class="fa fa-plus"></i> เพิ่มประเภทใหม่
                </button>
            @endif
        </div>
        <hr>
        <div>
            @foreach($aims_type_units as $item)
                <div class="d-flex align-items-center mt-3">
                    <div class="flex-grow-1 ms-3">
                        <h4 class="font-weight-bold mb-0">
                            ประเภท : {{ $item->name_type_unit }}
                        </h4>
                        <p class="font-weight-bold mb-0">
                            พื้นที่ : {{ $item->name_area }}
                        </p>
                        @php
                            $type_list = json_decode($item->emergency_type, true);
                        @endphp
                        <p class="mb-0 mt-2">
                            @if(is_array($type_list))
                                @foreach ($type_list as $type)
                                    <span class="badge badge-pill bg-light-danger text-danger">
                                        <span style="font-size:15px;">#{{ $type['name_emergency_type'] }}</span> (priority : {{ $type['priority'] ? $type['priority'] : 'สุดท้าย' }})
                                    </span>
                                @endforeach
                            @endif
                        </p>
                    </div>
                    <a href="{{ url('/aims_type_units/' . $item->id . '/edit') }}" title="Edit Aims_type_unit">
                        <button class="btn btn-sm btn-outline-primary radius-10 mx-1">
                            <i class="fa-solid fa-pen"></i> Edit
                        </button>
                    </a>
                    <form method="POST" action="{{ url('/aims_type_units' . '/' . $item->id) }}" accept-charset="UTF-8" style="display:inline">
                        {{ method_field('DELETE') }}
                        {{ csrf_field() }}
                        <button type="submit" class="btn btn-sm btn-danger radius-10 mx-1" title="Delete Aims_type_unit" onclick="return confirm(&quot;Confirm delete?&quot;)">
                            <i class="fa-solid fa-delete-right"></i> Delete
                        </button>
                    </form>
                </div>
                <hr>
            @endforeach
        </div>
    </div>
</div>

<script>
    function check_title(){
        let title = document.querySelector('#name_type_unit');
        let btn_submit = document.querySelector('#btn_submit');

        if (title.value.trim() !== "") {
            btn_submit.disabled = false;
        } else {
            btn_submit.disabled = true;
        }
    }

    let data_list = [];

    function select_priority_for_type(type_id, name_emergency_type) {
        const checkbox = document.querySelector('#checkbox_id_' + type_id);
        const input = document.querySelector('#priority_for_id_' + type_id);

        if (checkbox.checked) {
            input.readOnly = false;

            // เพิ่มข้อมูลใหม่
            const existing = data_list.find(item => item.id === type_id);
            if (!existing) {
                data_list.push({
                    id: type_id,
                    name_emergency_type: name_emergency_type,
                    priority: input.value || null
                });
            }
        } else {
            input.readOnly = true;
            input.value = null;

            // ลบข้อมูลออกจาก list
            data_list = data_list.filter(item => item.id !== type_id);
        }
    }

    function update_priority(type_id) {
        const input = document.querySelector('#priority_for_id_' + type_id);
        const item = data_list.find(item => item.id === type_id);
        if (item) {
            item.priority = input.value;
        }
    }

    function submit_add_data() {

        const elements = document.querySelectorAll('.add_data');
        const data = {};

        elements.forEach((element, index) => {
            const key = element.name || element.id || `field_${index}`;
            data[key] = element.value;
        });

        data.emergency_type = data_list;

        fetch("{{ url('/') }}/api/cf_add_type_units", {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            },
            body: JSON.stringify(data),
        })
        .then(response => response.text())
        .then(result => {
            if (result === "success") {
                window.location.href = "{{ url('/aims_type_units') }}";
            } else {
                console.error('Server response:', result);
            }
        })
        .catch(error => console.error('Error:', error));
    }

</script>

@endsection

<div class="col-md-6 d-none">
    <label for="aims_partner_id" class="control-label">{{ 'Aims Partner Id' }}</label>
    <input class="form-control add_data" name="aims_partner_id" type="text" id="aims_partner_id" value="{{ isset($aims_type_unit->aims_partner_id) ? $aims_type_unit->aims_partner_id : ''}}" readonly>
    {!! $errors->first('aims_partner_id', '<p class="help-block">:message</p>') !!}
</div>
<div class="col-md-6 d-none">
    <label for="aims_area_id" class="control-label">{{ 'Aims Area Id' }}</label>
    <input class="form-control add_data" name="aims_area_id" type="text" id="aims_area_id" value="{{ isset($aims_type_unit->aims_area_id) ? $aims_type_unit->aims_area_id : ''}}" readonly>
    {!! $errors->first('aims_area_id', '<p class="help-block">:message</p>') !!}
</div>

<div class="row mb-3 mt-3">
    <label for="name_type_unit" class="col-sm-3 col-form-label">ชื่อประเภท</label>
    <div class="col-sm-9">
        <input class="form-control mt-2 add_data" name="name_type_unit" type="text" id="name_type_unit" value="{{ isset($aims_type_unit->name_type_unit) ? $aims_type_unit->name_type_unit : ''}}" oninput="check_title();">
        {!! $errors->first('name_type_unit', '<p class="help-block">:message</p>') !!}
    </div>
</div>
<div class="row mb-3">
    <label for="status" class="col-sm-3 col-form-label">
        ประเภทการช่วยเหลือ <br>
        <span class="text-danger" style="font-size: 14px;">(สำหรับแท็กการส่งเคสอัตโนมัติ)</span>
    </label>
    <div class="col-sm-9">
        @php
            $selected_types = json_decode($aims_type_unit->emergency_type, true) ?? [];
            $selected_ids = collect($selected_types)->pluck('id')->toArray();

            // ตรวจสอบว่ามี "ผู้ใช้ไม่ได้กรอก" ใน JSON หรือไม่
            $unknownItem = collect($selected_types)->firstWhere('id', '0');
            $hasUnknown = !is_null($unknownItem);
            $unknownPriority = $unknownItem['priority'] ?? '';
        @endphp

        <!-- แสดง “ผู้ใช้ไม่ได้กรอก” เสมอ -->
        <div class="row">
            <div class="col-12">
                <input class="form-check-input" type="checkbox"
                       id="checkbox_id_0"
                       onclick="select_priority_for_type('0', 'ผู้ใช้ไม่ได้กรอก');"
                       {{ $hasUnknown ? 'checked' : '' }}>

                <label class="form-check-label mx-2">
                    <b style="font-size:15px;">ผู้ใช้ไม่ได้กรอก</b>
                </label>

                <input type="number" class="form-control mt-2"
                       id="priority_for_id_0"
                       placeholder="ลำดับความสำคัญ"
                       value="{{ $hasUnknown ? $unknownPriority : '' }}"
                       {{ $hasUnknown ? '' : 'readonly' }}
                       oninput="update_priority('0');">
            </div>
        </div>
        <hr>

        <!-- แสดงรายการอื่นๆ -->
        @foreach($emergency_types as $e_type)
            @php
                $isChecked = in_array($e_type->id, $selected_ids);
                $priority = '';
                if ($isChecked) {
                    $found = collect($selected_types)->firstWhere('id', $e_type->id);
                    $priority = $found['priority'] ?? '';
                }
            @endphp

            <div class="row">
                <div class="col-12">
                    <input class="form-check-input" type="checkbox"
                           id="checkbox_id_{{ $e_type->id }}"
                           onclick="select_priority_for_type('{{ $e_type->id }}', '{{ $e_type->name_emergency_type }}');"
                           {{ $isChecked ? 'checked' : '' }}>

                    <label class="form-check-label mx-2">
                        <b style="font-size:15px;">{{ $e_type->name_emergency_type }}</b>
                        @if($e_type->status == "Active")
                            <span class="text-success">({{ $e_type->status }})</span>
                        @else
                            <span class="text-danger">({{ $e_type->status }})</span>
                        @endif
                    </label>

                    <input type="number" class="form-control mt-2"
                           id="priority_for_id_{{ $e_type->id }}"
                           placeholder="ลำดับความสำคัญ"
                           value="{{ $priority }}"
                           {{ $isChecked ? '' : 'readonly' }}
                           oninput="update_priority('{{ $e_type->id }}');">
                </div>
            </div>
            <hr>
        @endforeach
    </div>
</div>

<div class="col-12 form-group">
    <button id="btn_submit" class="btn btn-primary" type="submit" onclick="submit_add_data();">แก้ไข</button>
</div>

<script>

    let data_list = [];

    // กรณีโหลดค่าจาก server มาแล้วมีข้อมูล
    document.addEventListener("DOMContentLoaded", () => {
        @if ($selected_types)
            @foreach ($selected_types as $stype)
                data_list.push({
                    id: "{{ $stype['id'] ?? '0' }}",
                    name_emergency_type: "{{ $stype['name_emergency_type'] ?? '' }}",
                    priority: "{{ $stype['priority'] ?? '' }}"
                });
            @endforeach
        @endif
    });

    function check_title(){
        let title = document.querySelector('#name_type_unit');
        let btn_submit = document.querySelector('#btn_submit');

        if (title.value.trim() !== "") {
            btn_submit.disabled = false;
        } else {
            btn_submit.disabled = true;
        }
    }


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
        // console.log(data)

        fetch("{{ url('/') }}/api/cf_edit_type_units" + "/" + "{{ $aims_type_unit->id }}", {
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

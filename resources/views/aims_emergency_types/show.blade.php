@extends('layouts.partners.theme_partner_new')

@section('content')

<div class="card radius-10 border-top border-0 border-4 border-primary">
    <div class="card-body p-3">
        <div class="card-title d-flex align-items-center">
            <div>
                <i class='fa-solid fa-messages-question me-1 font-22'></i>
            </div>
            <h5 class="mb-0">
                {{ $name_title }}
            </h5>
        </div>
        <hr>
        <div>
            <div id="priority-units">
                <div class="text-muted">กำลังโหลด...</div>
            </div>
        </div>
    </div>
</div>

<script>
// document.addEventListener('DOMContentLoaded', function () {
//     const id = "{{ $id }}";

//     fetch(`{{ url('/') }}/api/get_priority_units/${id}`)
//         .then(response => response.json())
//         .then(data => {
//             const container = document.getElementById('priority-units');
//             if (Array.isArray(data)) {
//                 container.innerHTML = '';
//                 data.forEach(unit => {
//                     const div = document.createElement('div');
//                     div.className = 'card mb-2';
//                     div.innerHTML = `
//                         <div class="card-body">
//                             <h5>${unit.name_type_unit}</h5>
//                             <p>Priority: ${unit.priority ?? 'สุดท้าย'}</p>
//                         </div>
//                     `;
//                     container.appendChild(div);
//                 });
//             } else {
//                 container.innerHTML = '<div class="alert alert-danger">ไม่พบข้อมูล</div>';
//             }
//         });
// });

document.addEventListener('DOMContentLoaded', function () {
    const id = "{{ $id }}";

    fetch(`{{ url('/') }}/api/get_priority_units/${id}`)
        .then(response => response.json())
        .then(data => {
            const container = document.getElementById('priority-units');
            container.innerHTML = '';

            if (Array.isArray(data)) {
                data.forEach((unit, index) => {
                    const unitId = `unit-${index}`;
                    const realId = unit.id;

                    const div = document.createElement('div');
                    div.className = 'card mb-3 shadow-sm';

                    div.innerHTML = `
                        <div class="card-body">
                            <div class="d-flex justify-content-between align-items-center">
                                <div>
                                    <h5 class="mb-1">${unit.name_type_unit}</h5>
                                    <p class="mb-0">Priority: <span id="${unitId}-display">${unit.priority ?? 'สุดท้าย'}</span></p>
                                </div>
                                <button class="btn btn-sm btn-primary" onclick="editPriority('${unitId}', '${unit.priority ?? ''}', '${realId}')">แก้ไข</button>
                            </div>
                            <div id="${unitId}-edit" class="mt-3 d-none">
                                <div class="row mb-2">
                                    <div class="col-md-4">
                                        <label>ลำดับ (Priority):</label>
                                        <input type="number" class="form-control" id="${unitId}-input" value="${unit.priority ?? ''}">
                                    </div>
                                    <div class="col-md-8 mt-2 mt-md-0">
                                        <label>ตัวเลือก:</label><br>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="${unitId}-option" id="${unitId}-none" value="none" onchange="toggleInput('${unitId}', true)">
                                            <label class="form-check-label" for="${unitId}-none">ไม่รับ Auto</label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="${unitId}-option" id="${unitId}-last" value="last" onchange="toggleInput('${unitId}', true)">
                                            <label class="form-check-label" for="${unitId}-last">สุดท้าย</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="text-end">
                                    <button class="btn btn-sm btn-success" onclick="savePriority('${unitId}', '${realId}')">ยืนยัน</button>
                                    <button class="btn btn-sm btn-secondary" onclick="cancelEdit('${unitId}')">ยกเลิก</button>
                                </div>
                            </div>
                        </div>
                    `;
                    container.appendChild(div);
                });
            } else {
                container.innerHTML = '<div class="alert alert-danger">ไม่พบข้อมูล</div>';
            }
        });
});

function editPriority(unitId, currentValue, realId) {
    document.getElementById(`${unitId}-edit`).classList.remove('d-none');
    document.getElementById(`${unitId}-input`).value = currentValue;
    toggleInput(unitId, false);
}

function toggleInput(unitId, readonly) {
    const input = document.getElementById(`${unitId}-input`);
    input.readOnly = readonly;
}

function cancelEdit(unitId) {
    document.getElementById(`${unitId}-edit`).classList.add('d-none');
}

function savePriority(unitId, realId) {
    const input = document.getElementById(`${unitId}-input`);
    const radios = document.getElementsByName(`${unitId}-option`);
    let selectedOption = null;

    radios.forEach(radio => {
        if (radio.checked) {
            selectedOption = radio.value;
        }
    });

    let finalPriority = null;

    if (selectedOption === 'none') {
        finalPriority = 'ไม่รับ Auto';
    }
    else if (selectedOption === 'last') {
        finalPriority = 'สุดท้าย';
    }
    else {
        finalPriority = input.value;
    }

    // console.log('กำลังอัปเดต Aims_type_unit ID:', realId, ' → Priority:', finalPriority);

    send_savePriority(realId, finalPriority);

    // อัปเดตในหน้า
    document.getElementById(`${unitId}-display`).innerText = finalPriority || 'สุดท้าย';
    cancelEdit(unitId);
}

function send_savePriority(realId, finalPriority) {
    fetch('{{ url("/") }}/api/update_priority_unit', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': '{{ csrf_token() }}'
        },
        body: JSON.stringify({
            realId: realId,
            finalPriority: finalPriority,
            name_title: '{{ $name_title }}'
        })
    })
    .then(response => response.json())
    .then(data => {
        // console.log('อัปเดตสำเร็จ:', data);
        if(data.message == "อัปเดตเรียบร้อย"){
            window.location.reload();
        }
    })
    .catch(error => {
        console.error('เกิดข้อผิดพลาด:', error);
    });
}

</script>

@endsection

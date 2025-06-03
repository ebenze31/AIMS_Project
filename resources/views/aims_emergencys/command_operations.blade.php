@extends('layouts.partners.theme_partner_new')

@section('content')

<style>
    #map_operations {
        height: calc(70vh);
    }

    #map_monitor {
        height: calc(70vh);
    }

    .list_officer {
        position: absolute;
        top: 10px;
        right: 10px;
        width: 30%;
        background-color: white; /* เพื่อให้เนื้อหาชัดเจน */
        z-index: 10; /* ให้อยู่เหนือ map */
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.2); /* เพิ่มเงาให้นูนขึ้น */
        border: 3.5px solid #6B1181;
    }

    .photo-img {
        width: 100%;
        height: auto;
        border-radius: 10px;
        object-fit: cover;
        background-color: #000;
        margin-right: 15px;
    }
</style>

<div class="row">
    <div class="col-3">
        <div class="card radius-10 border-top border-0 border-4 border-secondary">
            <div class="card-body p-3">
                <h5><b>ข้อมูลผู้ขอความช่วยเหลือ</b></h5>
                <hr>
                <h6>
                    ชื่อผู้แจ้ง : {{ $emergency->name_reporter ?? 'ไม่ได้ระบุ' }}
                    <br>
                    ประเภทผู้แจ้ง : {{ $emergency->type_reporter ?? 'ไม่ได้ระบุ' }}
                    <br>
                    เบอร์ติดต่อ : {{ $emergency->phone_reporter ?? 'ไม่ได้ระบุ' }}
                </h6>
            </div>
            <div class="accordion accordion-flush" id="accordionFlushExample">
                <div class="accordion-item">
                    <h2 class="accordion-header" id="flush-headingOne">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseOne" aria-expanded="false" aria-controls="flush-collapseOne">
                            # ดูรูปภาพ
                        </button>
                    </h2>
                    <div id="flush-collapseOne" class="accordion-collapse collapse" aria-labelledby="flush-headingOne" data-bs-parent="#accordionFlushExample" style="">
                        <div class="accordion-body">
                            <img class="photo-img" src="{{ url('/storage') }}/{{ $emergency->emergency_photo }}">
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div id="status_case" class="card radius-10 border-top border-0 border-4 border-secondary">
            <div class="row my-2 p-2">
                <div class="col-12 my-1">
                    <div id="show_status">
                        สถานะ : {{ $emergency->op_status }}
                    </div>
                </div>
                <div class="col-12 my-1">
                    <div id="show_time_distance" class="d-none">
                        <!-- 3 นาที (2 กม) • 15:00 น. -->
                    </div>
                </div>
                <div class="col-12 my-1">
                    <div class="p-2 radius-10 overflow-hidden bg-gradient-Ohhappiness">
                        <div class="d-flex align-items-center">
                            <div>
                                <p class="mb-0 text-white">การให้รหัสความรุนแรง (IDC)</p>
                                <h5 id="show_text_idc" class="mb-0 text-white">
                                    {{ $emergency->idc ?? '-' }}
                                </h5>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-12 my-1">
                    <div class="p-2 radius-10 overflow-hidden bg-gradient-burning">
                        <div class="d-flex align-items-center">
                            <div>
                                <p class="mb-0 text-white">รหัสความรุนแรง ณ จุดเกิดเหตุ (RC)</p>
                                <h5 id="show_text_rc" class="mb-0 text-white">
                                    {{ $emergency->rc ?? '-' }}
                                </h5>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div id="info_officer" class="card radius-10 border-top border-0 border-4 border-secondary d-none">
            <div class="card-body p-3">
                <h5><b>ข้อมูลหน่วยแพทย์</b></h5>
                <hr>
                <div id="div_data_info_officer" class="d-flex flex-column align-items-center text-center">
                    <!-- data officer -->
                </div>
            </div>
        </div>


    </div>
    <div class="col-9">
        <div class="card radius-10 border-top border-0 border-4 border-secondary">
            <div class="card-body p-3">
                <div class="col-12 row">
                    <div class="col-3">
                        <h5><b>รหัสปฏิบัติการ</b></h5>
                        <h6>{{ $emergency->op_operating_code ?? '-' }}</h6>
                    </div>
                    <div class="col-9">
                        <button id="btn_order" style="width:20%;" class="btn btn-outline-danger mx-2 radius-10 float-end ms-auto">
                            <i class="fa-solid fa-truck-fast"></i> สั่งการ
                        </button>
                        <button id="btn_info" style="width:20%;" class="btn btn-info mx-2 radius-10 float-end ms-auto">
                            <i class="fa-solid fa-memo-circle-info"></i> ข้อมูลเคส
                        </button>
                    </div>
                </div>
            </div>
        </div>
        <div class="card radius-10 border-top border-0 border-4 border-secondary">

            <!-- ---- MAP สั่งการ ---- -->
            <div id="card_map" class="card-body p-3 d-none">
                <div id="map_operations" style="position: relative;">
                    <!-- พื้นที่แผนที่ -->
                </div>
                
                <div class="list_officer card radius-10">

                    <div class="btn-group-round w-100 mb-2 mt-2 p-2" style="overflow: auto;">
                        <div class="btn-group w-100" role="group">
                            <button type="button" class="btn btn-info w-100" onclick="select_for_search(this)">
                                ทั้งหมด
                            </button>
                            <button type="button" class="btn btn-white w-100" onclick="select_for_search(this)">
                                ประเภท
                            </button>
                            <button type="button" class="btn btn-white w-100" onclick="select_for_search(this)">
                                ชื่อ
                            </button>
                            <button type="button" class="btn btn-white w-100" onclick="select_for_search(this)">
                                หน่วย
                            </button>
                        </div>
                    </div>

                    <!-- ค้นหาจาก ประเภท -->
                    <div id="search_by_type" class="px-2 d-none">
                        <select class="form-select" name="input_search_by_type" id="input_search_by_type" onchange="filter_officers();">
                            <option>เลือกประเภท</option>
                        </select>
                    </div>

                    <!-- ค้นหาจาก ชื่อ -->
                    <div id="search_by_name" class="px-2 d-none">
                        <input type="text" class="form-control" name="input_search_by_name" id="input_search_by_name" placeholder="กรอกชื่อเจ้าหน้าที่" oninput="filter_officers(true)">
                    </div>

                    <!-- ค้นหาจาก หน่วย -->
                    <div id="search_by_unit" class="px-2 d-none">
                        <select class="form-select" name="input_search_by_unit" id="input_search_by_unit" onchange="filter_officers();">
                            <option>เลือกหน่วย</option>
                        </select>
                    </div>

                    <!-- -------------- แสดงผลรายชื่อเจ้าหน้าที่ -------------- -->
                    <div id="div_list_officer" class="card-body p-3">
                        <!-- content By Javascript -->
                    </div>
                </div>
            </div>

            <!-- ---- ข้อมูลเคส ---- -->
            <div id="data_case" class="card-body p-3">
                <div>
                    
                </div>
            </div>

            <!-- ---- ควบคุมการดำเนินการ ---- -->
            <div id="card_map_operation" class="card-body p-3 d-none">
                <div id="map_monitor" style="position: relative;">
                    <!-- พื้นที่แผนที่ -->
                </div>
            </div>

        </div>
    </div>
</div>

<!-- Modal เลือกเจ้าหน้าที่ -->
<div class="modal fade" id="modal_view_select_officer" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="modal_view_select_officerLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modal_view_select_officerLabel">Modal title</h5>
            </div>
            <div class="modal-body">
                <!-- เนื้อหา modal -->
            </div>
            <div class="modal-footer justify-content-center">
                <button type="button" class="btn btn-secondary me-2" style="width: 20%;" data-bs-dismiss="modal">
                    ยกเลิก
                </button>
                <button type="button" class="btn btn-success" style="width: 20%;" id="btn_confirm_select">
                    ยืนยัน
                </button>
            </div>
        </div>
    </div>
</div>

<!-- Modal รอเจ้าหน้าที่ -->
<div class="modal fade" id="wait_officer" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="wait_officerLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="wait_officerLabel">Modal title</h5>
            </div>
            <div class="modal-body">
                <!-- เนื้อหา modal -->
            </div>
            <div class="modal-footer justify-content-center">
                <button id="btn_select_officer_again" type="button" class="btn btn-secondary me-2" style="width: 20%;" data-bs-dismiss="modal">
                    เลือกใหม่
                </button>
            </div>
        </div>
    </div>
</div>

<!-- Modal เจ้าหน้าที่ ปฏิเสธ -->
<div class="modal fade" id="officer_refuse" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="officer_refuseLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="officer_refuseLabel">Modal title</h5>
            </div>
            <div class="modal-body">
                <!-- เนื้อหา modal -->
            </div>
            <div class="modal-footer justify-content-center">
                <button id="officer_refuse_select_again" type="button" class="btn btn-secondary me-2" style="width: 20%;" data-bs-dismiss="modal">
                    เลือกใหม่
                </button>
            </div>
        </div>
    </div>
</div>

<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBgrxXDgk1tgXngalZF3eWtcTWI-LPdeus&language=th"></script>

<script>

    var check_show_map ;

    document.addEventListener("DOMContentLoaded", function() {

        var aims_operating_officers_id = "{{ $emergency->op_aims_operating_officers_id }}" ;
        if(aims_operating_officers_id){
            check_show_map = "card_map_operation";
            open_map_monitor();
        }else{
            check_show_map = "card_map";
            open_map_operating_unit();
        }

        document.querySelector('#btn_order').click();
    });

    var map ;
    var map_monitor ;
    var aims_marker = "{{ url('/img/icon/operating_unit/aims/aims_marker.png') }}";
    var officer_marker = "{{ url('/img/icon/operating_unit/aims/officer.png') }}";
    var emergency_Lat = parseFloat("{{ $emergency->emergency_lat }}");
    var emergency_Lng = parseFloat("{{ $emergency->emergency_lng }}");
    var old_status = "{{ $emergency->op_status }}";

    // console.log(emergency_Lat);
    // console.log(emergency_Lng);

    function open_map_operating_unit() {
        const emergency_LatLng = {
            lat: emergency_Lat,
            lng: emergency_Lng
        };
        
        map = new google.maps.Map(document.getElementById("map_operations"), {
            center: emergency_LatLng,
            zoom: 15
        });

        new google.maps.Marker({
            position: emergency_LatLng,
            map: map,
            icon: {
                url: aims_marker,
                scaledSize: new google.maps.Size(45, 45),
            },
        });

        get_data_officer();

    }

    function open_map_monitor(){
        const emergency_LatLng = {
            lat: emergency_Lat,
            lng: emergency_Lng
        };
        
        map_monitor = new google.maps.Map(document.getElementById("map_monitor"), {
            center: emergency_LatLng,
            zoom: 15
        });

        show_data_helper();

    }

    function get_data_officer(){

        const officerRefuse = "{{ $emergency->op_officer_refuse }}".split(',').map(id => parseInt(id.trim())).filter(id => !isNaN(id));
        const officerNoRespond = "{{ $emergency->op_officer_no_respond }}".split(',').map(id => parseInt(id.trim())).filter(id => !isNaN(id));

        let let_emergency = parseFloat("{{ $emergency->emergency_lat }}");
        let lng_emergency = parseFloat("{{ $emergency->emergency_lng }}");

        fetch("{{ url('/') }}/api/get_data_officer/" + "{{ $emergency->aims_area_id }}")
            .then(response => response.json())
            .then(result => {
                // console.log(result);

                if (result) {

                    let div_list_officer = document.querySelector('#div_list_officer');
                        div_list_officer.innerHTML = '';

                    // เก็บประเภทและหน่วยไม่ให้ซ้ำ
                    let typeSet = new Set();
                    let unitSet = new Set();

                    for (let i = 0; i < result.length; i++) {

                        let officerLat = parseFloat(result[i].lat);
                        let officerLng = parseFloat(result[i].lng);

                        // เช็คว่ามีค่าพิกัดหรือไม่
                        if (!isNaN(officerLat) && !isNaN(officerLng)) {
                            let distance = calculateDistance(let_emergency, lng_emergency, officerLat, officerLng);
                            let distanceText = distance.toFixed(2);

                            // เพิ่มค่าประเภทและหน่วยลง Set
                            typeSet.add(result[i].unit_name_type_unit);
                            unitSet.add(result[i].unit_name_unit);

                            // ปักหมุดเจ้าหน้าที่
                            new google.maps.Marker({
                                position: { lat: officerLat, lng: officerLng },
                                map: map,
                                title: result[i].name_officer,
                                icon: {
                                    url: officer_marker,
                                    scaledSize: new google.maps.Size(40, 40),
                                }
                            });

                            let buttonHTML = '';

                            if (officerRefuse.includes(result[i].id)) {
                                buttonHTML = `
                                    <span class="ms-auto text-danger fw-bold">ปฏิเสธ</span>
                                `;
                            } else if (officerNoRespond.includes(result[i].id)) {
                                buttonHTML = `
                                    <span class="ms-auto" style="color:#DD8616;">ไม่ตอบสนอง</span>
                                `;
                            } else {
                                buttonHTML = `
                                    <button id="btn_of_id_${result[i].id}" class="btn btn-sm btn-success radius-30 ms-auto mb-0" onclick="view_select_officer('${result[i].id}');">
                                        <span class="mx-2">เลือก</span>
                                    </button>
                                `;
                            }


                            let html = `
                                <div id="div_officer_id_${result[i].id}" class="d-flex align-items-center officer-card" type="${result[i].unit_name_type_unit}" name_officer="${result[i].name_officer}" unit="${result[i].unit_name_unit}" data-distance="${distanceText}">
                                    <div class="ps-3">
                                        <h6 class="mb-0 font-weight-bold">
                                            <b>${result[i].name_officer}</b>
                                        </h6>
                                        <span class="mt-2 text-secondary">
                                            <b>${result[i].unit_name_unit}</b>
                                            <br>
                                            ${result[i].unit_name_type_unit}
                                            <br>
                                            ระยะห่าง(รัศมี) ≈ ${distanceText} กม. 
                                        </span>
                                    </div>
                                    ${buttonHTML}
                                </div>
                                <hr>
                            `;

                            div_list_officer.insertAdjacentHTML('beforeend',html); // แทรกล่างสุด
                        }
                    }

                    // สร้าง option สำหรับประเภท (เรียงตามตัวอักษร)
                    let typeSelect = document.getElementById('input_search_by_type');
                    typeSelect.innerHTML = `<option>เลือกประเภท</option>`;
                    [...typeSet].sort().forEach(type => {
                        typeSelect.insertAdjacentHTML('beforeend', `<option value="${type}">${type}</option>`);
                    });

                    // สร้าง option สำหรับหน่วย (เรียงตามตัวอักษร)
                    let unitSelect = document.getElementById('input_search_by_unit');
                    unitSelect.innerHTML = `<option>เลือกหน่วย</option>`;
                    [...unitSet].sort().forEach(unit => {
                        unitSelect.insertAdjacentHTML('beforeend', `<option value="${unit}">${unit}</option>`);
                    });

                }
            });

    }

    function calculateDistance(lat1, lon1, lat2, lon2) {
        const R = 6371; // รัศมีโลก (กม.)
        const toRad = x => x * Math.PI / 180;

        const dLat = toRad(lat2 - lat1);
        const dLon = toRad(lon2 - lon1);

        const a = Math.sin(dLat/2) * Math.sin(dLat/2) +
                  Math.cos(toRad(lat1)) * Math.cos(toRad(lat2)) *
                  Math.sin(dLon/2) * Math.sin(dLon/2);
        const c = 2 * Math.atan2(Math.sqrt(a), Math.sqrt(1-a));

        return R * c; // ระยะทางเป็นกิโลเมตร
    }


    function view_select_officer(officer_id) {
        const officerDiv = document.getElementById(`div_officer_id_${officer_id}`);
        if (!officerDiv) return;

        const name_officer = officerDiv.getAttribute('name_officer') || '';
        const unit_type = officerDiv.getAttribute('type') || '';
        const unit_name = officerDiv.getAttribute('unit') || '';
        const distanceText = officerDiv.getAttribute('data-distance') || '';

        // อ้างอิงส่วนต่างๆ ใน modal ใหม่
        const modalTitle = document.getElementById('modal_view_select_officerLabel');
        const modalBody = document.querySelector('#modal_view_select_officer .modal-body');
        const confirmButton = document.getElementById('btn_confirm_select');

        // เคลียร์และใส่เนื้อหาใหม่
        modalTitle.textContent = "ยืนยันการเลือกเจ้าหน้าที่";
        modalBody.innerHTML = `
            <p><strong>ชื่อ:</strong> ${name_officer}</p>
            <p><strong>หน่วย:</strong> ${unit_name}</p>
            <p><strong>ประเภท:</strong> ${unit_type}</p>
            <p><strong>ระยะห่าง:</strong> ${distanceText} กม.</p>
            <p class="text-danger">คุณต้องการเลือกเจ้าหน้าที่คนนี้ใช่หรือไม่?</p>
        `;

        // ตั้งค่า onclick ปุ่มยืนยัน
        confirmButton.setAttribute('onclick', `select_officer('${officer_id}', '${name_officer}', '${unit_name}', '${unit_type}')`);

        // เปิด modal
        $('#modal_view_select_officer').modal('show');
    }


    let waitOfficerInterval = null;
    let selectedEmergencyId = null;
    let selectedOfficerId = null;

    // ฟังก์ชันจัดการ beforeunload
    function handleBeforeUnload(e) {
        if (!selectedEmergencyId || !selectedOfficerId) return;

        const url = `{{ url('/') }}/api/officer_no_response`;

        const payload = JSON.stringify({
            emergency_id: selectedEmergencyId,
            officer_id: selectedOfficerId
        });

        const blob = new Blob([payload], { type: 'application/json' });

        navigator.sendBeacon(url, blob);
    }

    // ติดตั้ง event listener
    window.addEventListener('beforeunload', handleBeforeUnload);

    function select_officer(officer_id, name, unit, type) {
        let data = {
            emergency_id: "{{ $emergency->id }}",
            aims_operating_officers_id: officer_id
        };

        // เก็บข้อมูลระดับ global
        selectedEmergencyId = data.emergency_id;
        selectedOfficerId = officer_id;

        fetch("{{ url('/') }}/api/send_sos_to_officer", {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            },
            body: JSON.stringify(data),
        })
        .then(response => response.text())
        .then(result => {
            // console.log(result);

            if (result === "send success") {
                $('#modal_view_select_officer').modal('hide');

                if (waitOfficerInterval) {
                    clearInterval(waitOfficerInterval);
                    waitOfficerInterval = null;
                }

                document.querySelector('#wait_officer .modal-body').innerHTML = '';
                document.querySelector('#wait_officerLabel').innerText = 'กำลังรอเจ้าหน้าที่ตอบรับ';

                const infoHTML = `
                    <p><strong>ชื่อ:</strong> ${name}</p>
                    <p><strong>หน่วย:</strong> ${unit}</p>
                    <p><strong>ประเภท:</strong> ${type}</p>
                    <p><strong>ระยะเวลา:</strong> <span id="timer_text">00:00</span></p>
                    <p style="color: red; font-weight: bold;">
                      หากปิดแท็บหรือรีเฟรช เจ้าหน้าที่ ${name} จะเปลี่ยนสถานะเป็นไม่ตอบสนองเคสนี้
                    </p>
                `;

                document.querySelector('#wait_officer .modal-body').innerHTML = infoHTML;

                let secondsPassed = 0;
                waitOfficerInterval = setInterval(() => {
                    secondsPassed++;
                    const minutes = String(Math.floor(secondsPassed / 60)).padStart(2, '0');
                    const seconds = String(secondsPassed % 60).padStart(2, '0');
                    document.getElementById('timer_text').innerText = `${minutes}:${seconds}`;
                }, 1000);

                const againButton = document.querySelector('#btn_select_officer_again');
                againButton.setAttribute('onclick', `select_officer_again(${data.emergency_id}, ${officer_id}, 'ไม่ตอบสนอง')`);

                $('#wait_officer').modal('show');

                let intervalId = setInterval(() => {
                    fetch("{{ url('/') }}/api/get_data_wait_officer/" + data.emergency_id + "/" + officer_id)
                        .then(response => response.text())
                        .then(result => {
                            // console.log(result);

                            if (result.trim() === "ปฏิเสธ") {
                                clearInterval(intervalId);

                                // ยกเลิกส่งข้อมูลเมื่อปิดแท็บ
                                window.removeEventListener('beforeunload', handleBeforeUnload);

                                // ล้างค่าตัวแปร global
                                selectedEmergencyId = null;
                                selectedOfficerId = null;

                                $('#wait_officer').modal('hide');

                                const modalBody = document.querySelector('#officer_refuse .modal-body');
                                modalBody.innerHTML = `
                                    <p><strong>ชื่อ:</strong> ${name}</p>
                                    <p><strong>หน่วย:</strong> ${unit}</p>
                                    <p><strong>ประเภท:</strong> ${type}</p>
                                    <p class="text-danger"><strong>เจ้าหน้าที่ปฏิเสธการรับเคสนี้</strong></p>
                                `;

                                const againButton = document.querySelector('#officer_refuse_select_again');
                                againButton.setAttribute('onclick', `select_officer_again(${data.emergency_id}, ${officer_id}, 'ปฏิเสธ')`);

                                $('#officer_refuse').modal('show');
                            }
                            else if(result.trim() === "รับเคส"){
                                clearInterval(intervalId);
                                // ยกเลิกส่งข้อมูลเมื่อปิดแท็บ
                                window.removeEventListener('beforeunload', handleBeforeUnload);
                                $('#wait_officer').modal('hide');

                                check_show_map = "card_map_operation";
                                document.getElementById('card_map').classList.add('d-none');
                                document.getElementById('card_map_operation').classList.remove('d-none');
                                open_map_monitor();

                            }

                        })
                        .catch(error => {
                            console.error("เกิดข้อผิดพลาดในการดึงข้อมูล:", error);
                        });
                }, 5000);
            } else {
                console.warn("ส่งข้อมูลไม่สำเร็จ:", result);
            }
        })
        .catch(error => {
            console.error('เกิดข้อผิดพลาด:', error);
        });
    }


    function select_officer_again(emergency_id, officer_id, type) {
        // console.log("เลือกใหม่:", emergency_id, officer_id);

        // ปิด modal ปัจจุบัน
        $('#wait_officer').modal('hide');

        // เคลียร์ตัวจับเวลา
        if (waitOfficerInterval) {
            clearInterval(waitOfficerInterval);
            waitOfficerInterval = null;
        }

        if( type == "ปฏิเสธ" ){
            document.querySelector('#btn_of_id_'+officer_id).remove();
            let div_officer = document.querySelector('#div_officer_id_'+officer_id);
            let new_show = `<span class="ms-auto text-danger fw-bold">ปฏิเสธ</span>`;
                div_officer.insertAdjacentHTML('beforeend',new_show); // แทรกล่างสุด

            $('#officer_refuse').modal('hide');
        }
        else if( type == "ไม่ตอบสนอง" ){
            let data = {
                emergency_id: emergency_id,
                officer_id: officer_id
            };

            fetch("{{ url('/') }}/api/officer_no_response", {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                body: JSON.stringify(data),
            })
            .then(response => response.json())
            .then(result => {
                if (result.status === 'ok') {
                    // console.log('สำเร็จ');
                    document.querySelector('#btn_of_id_'+officer_id).remove();
                    let div_officer = document.querySelector('#div_officer_id_'+officer_id);
                    let new_show = `<span class="ms-auto" style="color:#DD8616;">ไม่ตอบสนอง</span>`;
                        div_officer.insertAdjacentHTML('beforeend',new_show); // แทรกล่างสุด
                }
            })
            .catch(error => {
                console.error('เกิดข้อผิดพลาด:', error);
            });
        }

    }

    function show_data_helper(){

        let emergency_id = "{{ $emergency->id }}" ;

        let info_officer = document.querySelector('#info_officer');

        let div_data_info_officer = document.querySelector('#div_data_info_officer');
            div_data_info_officer.innerHTML = '' ;

        fetch("{{ url('/') }}/api/get_for_show_helper/" + emergency_id)
            .then(response => response.json())
            .then(result => {
                // console.log(result);

                if(result){

                    // ข้อมูลเส้นทาง
                    let emergency_id = result['emergency'].id ;
                    let emergency_lat = result['emergency'].emergency_lat ;
                    let emergency_lng = result['emergency'].emergency_lng ;
                    let officer_lat = result['officer'].lat ;
                    let officer_lng = result['officer'].lng ;
                    let officer_id = result['officer'].id ;

                    if( result['emergency'].op_status == "สั่งการ" || result['emergency'].op_status == "ออกจากฐาน"){
                        init_distance_tracking(emergency_lat , emergency_lng , officer_lat , officer_lng , officer_id, emergency_id);
                    }
                    else{
                        let emergencyLatLng = { lat: parseFloat(emergency_lat), lng: parseFloat(emergency_lng) };

                        if (!emergencyMarker) {
                            emergencyMarker = new google.maps.Marker({
                                position: emergencyLatLng,
                                map: map_monitor,
                                icon: {
                                    url: aims_marker,
                                    scaledSize: new google.maps.Size(45, 45)
                                },
                            });
                        }

                        startRealtimeCaseLoop(emergency_id);
                    }

                    // ข้อมูลเจ้าหน้าที่
                    let user_photo = ``;
                    if(result['officer'].user_photo){
                        user_photo = `<img src="{{ url('/storage') }}/${result['officer'].user_photo}" class="rounded-circle p-1" style="width:110px;height: 110px;object-fit: cover;">`
                    }

                    let level = `-`;
                    if(result['officer'].level){
                        level = result['officer'].level
                    }

                    let html = `
                        ${user_photo}
                        <div class="mt-3">
                            <h4 id="info_name_officer">
                                ${result['officer'].name_officer}
                            </h4>
                            <p id="info_name_unit" class="text-secondary mb-1">
                                ${result['officer'].unit_name_unit}
                            </p>
                            <p id="info_type_unit" class="text-muted font-size-sm">
                                ${result['officer'].unit_name_type_unit}
                            </p>
                            <button id="info_vehicle_type" class="btn btn-sm btn-outline-dark" style="width:47%;">
                                ${result['officer'].vehicle_type}
                            </button>
                            <button id="info_level" class="btn btn-sm btn-outline-dark" style="width:47%;">
                                Lv. ${level}
                            </button>
                        </div>
                    `;

                    div_data_info_officer.innerHTML = html ;

                    info_officer.classList.remove('d-none');

                }
        });
        
    }

    let loopInterval_case_realtime ;

    function startRealtimeCaseLoop(emergency_id) {
        get_data_case_realtime(emergency_id); // เรียกทันที 1 ครั้งก่อนเริ่ม interval
        loopInterval_case_realtime = setInterval(function () {
            get_data_case_realtime(emergency_id);
        }, 12000);
    }

    function get_data_case_realtime(emergency_id){
        // รับ status, IDC, RC
        // console.log("รับ status, IDC, RC");
        fetch("{{ url('/') }}/api/get_data_case_realtime/" + emergency_id)
            .then(response => response.json())
            .then(result => {
                if(result){
                    
                    document.querySelector('#show_text_idc').innerHTML = result[0].idc;
                    document.querySelector('#show_text_rc').innerHTML = result[0].rc;

                    if( old_status != result[0].status ){
                        old_status = result[0].status
                        alert_change_status_case(result[0].status);
                    }

                    if (result[0].status === 'เสร็จสิ้น') {
                        clearInterval(loopInterval_case_realtime); // หยุดการ loop
                        // console.log("เสร็จสิ้น");
                    }
                }
        });

    }

    function alert_change_status_case(new_status){
        document.querySelector('#show_status').innerHTML = `สถานะ : ${new_status}` ;
        alert(new_status)
    }

    let emergencyMarker = null;
    let officerMarker = null;
    let directionsRenderer = null;
    let distanceInterval = null;

    function init_distance_tracking(emergencyLat, emergencyLng, officerLat, officerLng, officer_id, emergency_id) {
        const emergencyLatLng = { lat: parseFloat(emergencyLat), lng: parseFloat(emergencyLng) };
        const officerLatLng = { lat: parseFloat(officerLat), lng: parseFloat(officerLng) };

        // Emergency Marker
        if (!emergencyMarker) {
            emergencyMarker = new google.maps.Marker({
                position: emergencyLatLng,
                map: map_monitor,
                icon: {
                    url: aims_marker,
                    scaledSize: new google.maps.Size(45, 45)
                },
            });
        }

        // Officer Marker
        if (!officerMarker) {
            officerMarker = new google.maps.Marker({
                position: officerLatLng,
                map: map_monitor,
                icon: {
                    url: officer_marker,
                    scaledSize: new google.maps.Size(45, 45)
                },
            });
        }

        // Directions Renderer (ไม่มี A, B)
        if (!directionsRenderer) {
            directionsRenderer = new google.maps.DirectionsRenderer({
                map: map_monitor,
                suppressMarkers: true
            });
        }

        // คำนวณครั้งแรก
        update_distance(emergencyLat, emergencyLng, officerLat, officerLng);

        // เริ่ม loop
        distanceInterval = setInterval(() => {
            fetch("{{ url('/') }}/api/get_location_realtime/" + officer_id + "/" + emergency_id)
                .then(response => response.json())
                .then(result => {
                    let status = result?.emergency?.status;
                    let officer = result?.officer;

                    if( old_status != status ){
                        old_status = status
                        alert_change_status_case(status);
                    }

                    if (status === "ถึงที่เกิดเหตุ") {
                        // หยุด loop และเคลียร์แผนที่
                        clearInterval(distanceInterval);
                        distanceInterval = null;

                        if (directionsRenderer) {
                            directionsRenderer.setMap(null);
                            directionsRenderer = null;
                        }

                        if (officerMarker) {
                            officerMarker.setMap(null);
                            officerMarker = null;
                        }

                        map_monitor.setCenter(emergencyMarker.getPosition());

                        let show_time_distance = document.querySelector('#show_time_distance');
                            show_time_distance.innerHTML = "ถึงที่เกิดเหตุแล้ว" ;
                            show_time_distance.classList.remove('d-none')

                        startRealtimeCaseLoop(emergency_id);
                        return;
                    }

                    // ถ้ามีข้อมูลตำแหน่งเจ้าหน้าที่ใหม่
                    if (officer?.lat && officer?.lng) {
                        const newLatLng = {
                            lat: parseFloat(officer.lat),
                            lng: parseFloat(officer.lng)
                        };

                        officerMarker.setPosition(newLatLng);
                        update_distance(emergencyLat, emergencyLng, officer.lat, officer.lng);
                    }
                });
        }, 12000);
    }

    function update_distance(emergencyLat, emergencyLng, officerLat, officerLng) {
        const directionsService = new google.maps.DirectionsService();

        const request = {
            origin: { lat: parseFloat(officerLat), lng: parseFloat(officerLng) },
            destination: { lat: parseFloat(emergencyLat), lng: parseFloat(emergencyLng) },
            travelMode: google.maps.TravelMode.DRIVING
        };

        directionsService.route(request, function (result, status) {
            if (status === google.maps.DirectionsStatus.OK) {
                directionsRenderer.setDirections(result);

                // ระยะทาง
                let text_distance = result.routes[0].legs[0].distance.text;
                // เวลา
                let text_duration = result.routes[0].legs[0].duration.text ;
                // เวลาถึงโดยประมาณ
                let text_arrivalTime = aims_func_arrivalTime(result.routes[0].legs[0].duration.value) ;

                // ใส่ข้อความลงใน HTML
                let show_time_distance = document.querySelector('#show_time_distance');
                show_time_distance.classList.remove('d-none');
                show_time_distance.innerHTML = `${text_duration} (${text_distance}) • ${text_arrivalTime}`;

            } else {
                console.error("Directions request failed: " + status);
            }
        });
    }

    function aims_func_arrivalTime(duration){
        // assuming you have already obtained the duration from Google Maps API and stored it in a variable called `duration`
        let date_now = new Date(); // get the current time
        let travelTimeInSeconds = duration; // get the travel time in seconds
        let arrivalTime = new Date(date_now.getTime() + (travelTimeInSeconds * 1000)); // add the travel time to the current time and create a new date object
        // let formattedTime = arrivalTime.toLocaleTimeString(); // format the arrival time as a string in a readable format
        let options = { hourCycle: 'h24' };
        let formattedTime = arrivalTime.toLocaleTimeString('th-TH', options);
            let timeWithoutSeconds = formattedTime.slice(0, -3); // ตัดวินาทีออก
            let timeWithSuffix = `${timeWithoutSeconds} น.`; // เติม "น." เข้าไป

        return timeWithSuffix ;
    }




    document.getElementById('btn_order').addEventListener('click', function () {
        // ปรับปุ่ม
        this.classList.remove('btn-outline-danger');
        this.classList.add('btn-danger');

        document.getElementById('btn_info').classList.remove('btn-info');
        document.getElementById('btn_info').classList.add('btn-outline-info');

        // สลับแสดงผล
        document.getElementById('data_case').classList.add('d-none');
        document.getElementById('card_map').classList.add('d-none');
        document.getElementById('card_map_operation').classList.add('d-none');

        // แสดงเฉพาะอันที่ต้องการ
        if (check_show_map === "card_map") {
            document.getElementById('card_map').classList.remove('d-none');
        } else if (check_show_map === "card_map_operation") {
            document.getElementById('card_map_operation').classList.remove('d-none');
        }
    });

    document.getElementById('btn_info').addEventListener('click', function () {
        // ปรับปุ่ม
        this.classList.remove('btn-outline-info');
        this.classList.add('btn-info');

        document.getElementById('btn_order').classList.remove('btn-danger');
        document.getElementById('btn_order').classList.add('btn-outline-danger');

        // สลับแสดงผล
        document.getElementById('data_case').classList.remove('d-none');
        document.getElementById('card_map').classList.add('d-none');
        document.getElementById('card_map_operation').classList.add('d-none');
    });

    function select_for_search(btn) {
        // เปลี่ยนคลาสของปุ่มให้เฉพาะปุ่มที่ถูกเลือกเป็น active (btn-info)
        document.querySelectorAll('.btn-group .btn').forEach(b => {
            b.classList.remove('btn-info');
            b.classList.add('btn-white');
        });
        btn.classList.remove('btn-white');
        btn.classList.add('btn-info');

        // ซ่อน input ทั้งหมดก่อน แล้วค่อยโชว์อันที่ต้องการ
        document.getElementById('search_by_type').classList.add('d-none');
        document.getElementById('search_by_name').classList.add('d-none');
        document.getElementById('search_by_unit').classList.add('d-none');

        // รีเซ็ตค่าของ input ทุกตัว
        document.getElementById('input_search_by_type').selectedIndex = 0;
        document.getElementById('input_search_by_unit').selectedIndex = 0;
        document.getElementById('input_search_by_name').value = '';

        // ตรวจสอบว่าผู้ใช้กดค้นหาจากอะไร
        const selectedText = btn.textContent.trim();

        if (selectedText === 'ประเภท') {
            document.getElementById('search_by_type').classList.remove('d-none');
        } else if (selectedText === 'ชื่อ') {
            const input = document.getElementById('search_by_name');
            input.classList.remove('d-none');
            document.getElementById('input_search_by_name').focus(); // ใส่ focus ให้เลย
        } else if (selectedText === 'หน่วย') {
            document.getElementById('search_by_unit').classList.remove('d-none');
        }

        // เรียก filter_officers เพื่อแสดงผลใหม่หลังจากรีเซ็ต
        filter_officers();
    }


    let nameSearchTimeout = null;

    function filter_officers(delaySearch = false) {
        const selectedFilter = document.querySelector('.btn-group .btn-info').textContent.trim();

        const allOfficerCards = document.querySelectorAll('.officer-card');

        const selectedType = document.getElementById('input_search_by_type').value.trim();
        const inputName = document.getElementById('input_search_by_name').value.trim().toLowerCase();
        const selectedUnit = document.getElementById('input_search_by_unit').value.trim();

        // Delay การค้นหาชื่อ
        if (delaySearch && selectedFilter === 'ชื่อ') {
            clearTimeout(nameSearchTimeout);
            nameSearchTimeout = setTimeout(() => {
                filter_officers(false); // เรียกใหม่แบบไม่มี delay
            }, 500);
            return;
        }

        // ถ้าเลือก "ทั้งหมด" ให้แสดงทุกอัน
        if (selectedFilter === 'ทั้งหมด') {
            allOfficerCards.forEach(card => {
                card.classList.remove('d-none');
                const hr = card.nextElementSibling;
                if (hr && hr.tagName === 'HR') {
                    hr.classList.remove('d-none');
                }
            });
            return;
        }

        // เงื่อนไขกรณีอื่น ๆ
        allOfficerCards.forEach(card => {
            const cardType = card.getAttribute('type') || '';
            const cardName = card.getAttribute('name_officer') || '';
            const cardUnit = card.getAttribute('unit') || '';

            let isVisible = true;

            if (selectedFilter === 'ประเภท') {
                isVisible = (selectedType === 'เลือกประเภท' || selectedType === '') ? true : (cardType === selectedType);
            } else if (selectedFilter === 'ชื่อ') {
                isVisible = cardName.toLowerCase().includes(inputName);
            } else if (selectedFilter === 'หน่วย') {
                isVisible = (selectedUnit === 'เลือกหน่วย' || selectedUnit === '') ? true : (cardUnit === selectedUnit);
            }

            if (isVisible) {
                card.classList.remove('d-none');
                const hr = card.nextElementSibling;
                if (hr && hr.tagName === 'HR') {
                    hr.classList.remove('d-none');
                }
            } else {
                card.classList.add('d-none');
                const hr = card.nextElementSibling;
                if (hr && hr.tagName === 'HR') {
                    hr.classList.add('d-none');
                }
            }
        });
    }

</script>
        
@endsection

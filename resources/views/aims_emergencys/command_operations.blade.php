@extends('layouts.partners.theme_partner_new')

@section('content')

<style>
    #map_operations {
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
</style>

<div class="row">
    <div class="col-3">
        <div class="card radius-10 border-top border-0 border-4 border-secondary">
            <div class="card-body p-3">
                <h5><b>ข้อมูลผู้ขอความช่วยเหลือ</b></h5>
                <hr>

                <h6>
                    ชื่อผู้แจ้ง : {{ $emergency->name_reporter ?? 'ไม่ได้ระบุ' }}<br>
                    ประเภทผู้แจ้ง : {{ $emergency->type_reporter ?? 'ไม่ได้ระบุ' }}<br>
                    เบอร์ติดต่อ : {{ $emergency->phone_reporter ?? 'ไม่ได้ระบุ' }}<br>
                </h6>
            </div>
        </div>
        <div class="card radius-10 border-top border-0 border-4 border-secondary">
            <div class="card-body p-3">
                <h5><b>ข้อมูลหน่วยแพทย์</b></h5>
                <hr>
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
                        <select class="form-select" name="input_search_by_type" id="input_search_by_type">
                            <option>เลือกประเภท</option>
                        </select>
                    </div>

                    <!-- ค้นหาจาก ชื่อ -->
                    <div id="search_by_name" class="px-2 d-none">
                        <input type="text" class="form-control" name="input_search_by_name" id="input_search_by_name" placeholder="กรอกชื่อเจ้าหน้าที่">
                    </div>

                    <!-- ค้นหาจาก หน่วย -->
                    <div id="search_by_unit" class="px-2 d-none">
                        <select class="form-select" name="input_search_by_unit" id="input_search_by_unit">
                            <option>เลือกหน่วย</option>
                        </select>
                    </div>

                    <!-- -------------- แสดงผลรายชื่อเจ้าหน้าที่ -------------- -->
                    <div id="div_list_officer" class="card-body p-3">

                        <div class="d-flex align-items-center">
                            <div class="ps-3">
                                <h6 class="mb-0 font-weight-bold">
                                    <b>Thanakorn Tungkasopa</b>
                                </h6>
                                <span class="mt-2 text-secondary">
                                    <b>ViiCHECK</b>
                                    <br>
                                    อาสาสมัคร
                                    <br>
                                    ระยะห่าง(รัศมี) ≈ 1.28 กม. 
                                </span>
                            </div>
                            <button class="btn btn-sm btn-success radius-30 ms-auto mb-0" onclick="select_officer();">
                                <span class="mx-2">เลือก</span>
                            </button>
                        </div>
                        <hr>

                    </div>
                </div>
            </div>

            <!-- ---- ข้อมูลเคส ---- -->
            <div id="data_case" class="card-body p-3">
                <div>
                    
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBgrxXDgk1tgXngalZF3eWtcTWI-LPdeus&language=th"></script>

<script>

    document.addEventListener("DOMContentLoaded", function() {
        // document.querySelector('#btn_order').click();
        open_map_operating_unit();
    });

    var aims_marker = "{{ url('/img/icon/operating_unit/aims/aims_marker.png') }}";
    var emergency_Lat = parseFloat("{{ $emergency->emergency_lat }}");
    var emergency_Lng = parseFloat("{{ $emergency->emergency_lng }}");

    console.log(emergency_Lat);
    console.log(emergency_Lng);

    function open_map_operating_unit() {
        const emergency_LatLng = {
            lat: emergency_Lat,
            lng: emergency_Lng
        };
        const map = new google.maps.Map(document.getElementById("map_operations"), {
            center: emergency_LatLng,
            zoom: 15
        });

        new google.maps.Marker({
            position: emergency_LatLng,
            map: map,
            icon: {
                url: aims_marker,
                scaledSize: new google.maps.Size(40, 40),
            },
        });
    }

    function select_officer(){

        let data = {};
            data['emergency_id'] = "{{ $emergency->id }}";
            data['aims_operating_officers_id'] = 1;

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
            console.log(result);
        })
        .catch(error => console.error('Error:', error));

    }

    document.getElementById('btn_order').addEventListener('click', function () {
        // ปรับปุ่ม
        this.classList.remove('btn-outline-danger');
        this.classList.add('btn-danger');

        document.getElementById('btn_info').classList.remove('btn-info');
        document.getElementById('btn_info').classList.add('btn-outline-info');

        // สลับแสดงผล
        document.getElementById('card_map').classList.remove('d-none');
        document.getElementById('data_case').classList.add('d-none');
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
    });

    function select_for_search(button) {
        const selectedText = button.textContent.trim();
        // console.log("ผู้ใช้เลือก:", selectedText);

        // จัดการปุ่ม: ลบ class btn-info และใส่ btn-white กับทุกปุ่มในกลุ่ม
        const buttons = button.parentElement.querySelectorAll('button');
        buttons.forEach(btn => {
            btn.classList.remove('btn-info');
            btn.classList.add('btn-white');
        });

        // ใส่ class btn-info ให้ปุ่มที่ถูกคลิก
        button.classList.remove('btn-white');
        button.classList.add('btn-info');

        // จัดการแสดงผลช่องค้นหา
        const typeDiv = document.getElementById('search_by_type');
        const nameDiv = document.getElementById('search_by_name');
        const unitDiv = document.getElementById('search_by_unit');

        // ซ่อนทั้งหมดก่อน
        typeDiv.classList.add('d-none');
        nameDiv.classList.add('d-none');
        unitDiv.classList.add('d-none');

        // เงื่อนไขการแสดงตามปุ่ม
        if (selectedText === 'ประเภท') {
            typeDiv.classList.remove('d-none');
        } else if (selectedText === 'ชื่อ') {
            nameDiv.classList.remove('d-none');
        } else if (selectedText === 'หน่วย') {
            unitDiv.classList.remove('d-none');
        }
    }

</script>
        
@endsection

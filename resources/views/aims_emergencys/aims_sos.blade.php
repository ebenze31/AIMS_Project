@extends('layouts.theme_aims')

@section('content')

<style>
    .gmnoprint *,
    .gm-style-mtc-bbw * {
        display: none !important;
    }

    body {
        width: 100%;
        height: 100dvh;
    }

    .nav-top {
        background: var(--background_primary);
        width: 100%;
        height: 79px;
        display: flex;
        align-items: center;
        padding: 0 20px;
        font-size: 22px;
        font-weight: bold;
        color: #fff;
    }

    .map-container {
        padding: 20px;
    }

    .number-item {
        display: flex;
        justify-content: space-between;
        padding: 10px;
        border-bottom: 1px solid #848484;
    }

    .contect .name {
        font-size: 16px;
        font-weight: bolder;
    }

    .contect .number {
        font-size: 14px;
        font-weight: lighter;
        color: #3f3939;
    }



    .btn-call {
        display: flex;
        align-items: center;
        justify-content: center;
        width: 45px;
        border-radius: 10px;
        border: 2px solid transparent;
        background: linear-gradient(to right, #fff, #fff),
            linear-gradient(260deg, rgba(40, 86, 250, 1) 0%, rgba(6, 162, 253, 1) 100%);
        background-clip: padding-box, border-box;
        -webkit-background-clip: padding-box, border-box;
        transition: all .15s ease-in-out;
    }

    .btn-call i {
        background: rgb(40, 86, 250);
        background: -moz-linear-gradient(260deg, rgba(40, 86, 250, 1) 0%, rgba(6, 162, 253, 1) 100%);
        background: -webkit-linear-gradient(260deg, rgba(40, 86, 250, 1) 0%, rgba(6, 162, 253, 1) 100%);
        background: linear-gradient(260deg, rgba(40, 86, 250, 1) 0%, rgba(6, 162, 253, 1) 100%);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        transition: all .15s ease-in-out;
    }

    .btn-call:hover,
    .btn-call:focus {
        color: #fff !important;
        background: var(--background_primary);
        border: none !important;
    }

    .btn-call:hover i,
    .btn-call:focus i {
        background: #fff;
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
    }

    .map {
        display: flex;
        justify-content: center;
        align-items: center;
        color: #fff;
    }

    @media (max-width: 900px) {
        .content {
            display: block;
        }

        .map {
            width: 100% !important;
            background-color: #2d2d2d;
            height: 250px;
            border-radius: 15px;
        }

        .header-phone-number {
            background: var(--background_primary);
            height: 56px;
            margin-left: 20px;
            display: flex;
            align-items: center;
            padding-left: 20px;
            font-weight: bold;
            border-radius: 10px 0 0 10px;
            color: #fff;
        }

        .phone-number {
            height: calc(100% - 426px);
            /* background-color: rgb(189, 189, 189); */
            padding: 20px 30px;
            overflow: auto;

        }

        .btn-sos-aims {
            position: fixed;
            bottom: 0px;
            padding: 20px;
            /* background-color: #000; */
            width: 100%;
            /* background: rgba(0,0,0,1);
            backdrop-filter: blur(50px); */
        }

        .btn-sos-aims button {
            background: var(--background_primary);
            width: 100%;
            height: 74px;
            border-radius: 10px;
            z-index: 3;
            position: relative;
            display: flex;
            align-items: center;
            padding: 20px;
        }

        .backdrop {
            position: absolute;
            bottom: 0;
            left: 0;
            width: 100%;
            height: calc(100% + 20px);
            background: linear-gradient(to bottom,
                    rgba(0, 0, 0, 0) 0%,
                    rgba(0, 0, 0, .8) 100%);
            pointer-events: none;
            /* เพื่อให้คลิกผ่านได้ */
            z-index: 2;
            /* กำหนดให้อยู่ด้านบนของเนื้อหา */
        }

        .phone-number .number-item:last-child {
            margin-bottom: 5em;
        }

    }

    @media (min-width: 900px) {
        .content {
            display: flex;
        }

        .map {
            width: 60dvw !important;
            background-color: #2d2d2d;
            height: calc(100dvh - 119px);
            border-radius: 15px;
        }

        .container-phone-number {
            width: 100%;
            padding: 0 10px;
            display: block;
            align-content: space-between;
        }

        .container-phone-number {
            width: 100%;
            padding: 20px;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            /* จัดให้อยู่บนสุดและล่างสุด */
            min-height: 100%;
            /* ให้ container เต็มหน้าจอ */
            max-height: 100%;
            /* ให้ container เต็มหน้าจอ */
        }

        .btn-sos-aims button {
            background: var(--background_primary);
            width: 100%;
            height: 74px;
            border-radius: 10px;
            z-index: 3;
            position: relative;
            display: flex;
            align-items: center;
            padding: 20px;
        }

        .phone-number {
            height: calc(100dvh - 240px);
            /* background-color: rgb(189, 189, 189); */
            padding: 20px 30px;
            overflow: auto;

        }

        .gmnoprint,
        .gm-style-mtc-bbw,
        .gm-style-mtc {
            display: none !important;
        }
    }
</style>

<style>
    .container {
        --uib-size: 40px;
        --uib-color: white;
        --uib-speed: 2s;
        --uib-bg-opacity: 0;
        height: var(--uib-size);
        width: var(--uib-size);
        transform-origin: center;
        animation: rotate var(--uib-speed) linear infinite;
        will-change: transform;
        overflow: visible;
    }

    .car {
        fill: none;
        stroke: var(--uib-color);
        stroke-dasharray: 1, 200;
        stroke-dashoffset: 0;
        stroke-linecap: round;
        animation: stretch calc(var(--uib-speed) * 0.75) ease-in-out infinite;
        will-change: stroke-dasharray, stroke-dashoffset;
        transition: stroke 0.5s ease;
    }

    .track {
        fill: none;
        stroke: var(--uib-color);
        opacity: var(--uib-bg-opacity);
        transition: stroke 0.5s ease;
    }

    @keyframes rotate {
        100% {
            transform: rotate(360deg);
        }
    }

    @keyframes stretch {
        0% {
            stroke-dasharray: 0, 150;
            stroke-dashoffset: 0;
        }

        50% {
            stroke-dasharray: 75, 150;
            stroke-dashoffset: -25;
        }

        100% {
            stroke-dashoffset: -100;
        }
    }
</style>
<nav class="nav-top">   
    <div style="width: 55px;height: 55px;padding: 5px;background-color: #fff;border-radius: 50px;" class="mr-3" >

        <img src="{{ asset('/partner_new/images/logo/aims full logo.png') }}" height="60" width="60"  alt="" >
    </div>

    <div class="">
        แจ้งเหตุฉุกเฉิน
    </div>
</nav>

<div class=" m-auto">
    <div class="content">
        <div class="map-container">
            <div class="map" id="map">

                <div class="block justify-center">
                    <div class="flex justify-center mb-3" id="spin_alert_map">
                        <svg
                            class="container"
                            viewBox="0 0 40 40"
                            height="40"
                            width="40">
                            <circle
                                class="track"
                                cx="20"
                                cy="20"
                                r="17.5"
                                pathlength="100"
                                stroke-width="5px"
                                fill="none" />
                            <circle
                                class="car"
                                cx="20"
                                cy="20"
                                r="17.5"
                                pathlength="100"
                                stroke-width="5px"
                                fill="none" />
                        </svg>
                    </div>

                    <p id="text_alert_map" class="text-center">กำลังค้นหาตำแหน่ง...</p>
                </div>


            </div>
        </div>
        <div class="container-phone-number ">
            <div>
                <div class="header-phone-number">
                    เบอร์โทรฉุกเฉิน
                </div>
                <div id="phone_content" class="phone-number">
                    <!-- phone -->
                </div>
            </div>

            <div id="btn_help" class="btn-sos-aims hidden">
                <div class="backdrop"></div>
                <button onclick="openModal();">
                    <div>
                        <img id="btn_help_img" src="{{ asset('/partner_new/images/logo/aims logo.png') }}" alt="" width="60" height="60">
                    </div>
                    <div class="w-full block text-[#fff]">
                        <p class="text-[16px] font-extrabold">ขอความช่วยเหลือ</p>
                        <p id="btn_help_name" class="text-[12px] font-light">ตำรวจท่องเที่ยว</p>
                    </div>
                </button>
            </div>

        </div>
    </div>
</div>



<style>
    .bg-backdrop {
        background-color: rgba(0, 0, 0, .8);
    }

    input.data_for_ask ,textarea.data_for_ask ,select.data_for_ask{
        padding: 10px;
        width: 100%;
        border: #dde1eb 1px solid;
        border-radius: 10px;
        color: #3f3939;
        margin-top: 10px;
        margin-bottom: 20px;
    }

    #myModal label {
        color: #3f3939;
    }

    .container-data-api {
        max-height: calc(80dvh - 20px) !important;
        overflow: auto !important;
    }
    .btn-sos{
        
    }
    .btn-sos {
        background: var(--background_primary);
        width: 100%;
        height: 50px;
        border-radius: 10px;
        z-index: 3;
        position: relative;
        display: flex;
        align-items: center;
        padding: 20px;
        color: #fff;
        margin-top: 10px;
    }
</style>
<!-- Modal -->
<div id="myModal" class="fixed inset-0 p-3 bg-backdrop flex items-center justify-center z-50 hidden">
    <div class="bg-white rounded-lg shadow-lg w-full max-w-lg p-6 relative">
        <h2 class="text-xl font-bold ">การขอความช่วยเหลือ</h2>
        <div class="row ">
            <div class="container-data-api">

            
            <!-- Date API -->
            <div class="col-12">
                <p class="hidden">ข้อมูลจาก API (เดี๋ยวซ่อนไว้)</p>
                <label class="hidden">platform (เดี๋ยวซ่อนไว้)</label>
                <input type="text" class="data_for_ask hidden" name="report_platform" id="report_platform" value="{{ htmlspecialchars($formData['report_platform'] ?? '') }}" placeholder="Enter report_platform">

                <br>
                <label>ชื่อผู้ขอความช่วยเหลือ <span class="text-[#db2d2e]">*</span></label>
                <input type="text" class="data_for_ask" name="name_reporter" id="name_reporter" value="{{ htmlspecialchars($formData['name_reporter'] ?? '') }}" placeholder="กรอกชื่อผู้ขอความช่วยเหลือ" required>
                <br>
                <label>เบอร์ผู้ขอความช่วยเหลือ <span class="text-[#db2d2e]">*</span></label>
                <input type="text" class="data_for_ask" name="phone_reporter" id="phone_reporter" value="{{ htmlspecialchars($formData['phone_reporter'] ?? '') }}" placeholder="กรอกเบอร์ผู้ขอความช่วยเหลือ" required>
                <br>
                <!-- <label>ประเภทผู้ขอความช่วยเหลือ <span></span></label> -->
                <input type="text" class="data_for_ask hidden" name="type_reporter" id="type_reporter" value="{{ htmlspecialchars($formData['type_reporter'] ?? '') }}" placeholder="Enter type_reporter">

                <hr>
            </div>
            <!-- END Date API -->
            <div class="col-12">
                <!-- <label>partner id</label> -->
                <input type="text" class="data_for_ask form-control hidden" name="aims_partner_id" id="aims_partner_id" value="" placeholder="aims_partner_id">
                <!-- <br> -->
                <!-- <label>area id</label> -->
                <input type="text" class="data_for_ask form-control hidden" name="aims_area_id" id="aims_area_id" value="" placeholder="aims_area_id">
                <!-- <br> -->
                <!-- <label>lat</label> -->
                <input type="text" class="data_for_ask hidden" name="emergency_lat" id="emergency_lat" value="" placeholder="emergency_lat">
                <!-- <br> -->
                <!-- <label>lng</label> -->
                <input type="text" class="data_for_ask hidden" name="emergency_lng" id="emergency_lng" value="" placeholder="emergency_lng">
                <br>
                <label>รายละเอียดสถานที่</label>
                <br>
                <textarea type="text" class="data_for_ask form-control" name="emergency_location" id="emergency_location" placeholder="กรอกรายละเอียดสถานที่"></textarea>
                <br>
                <label>ประเภทการขอความช่วยเหลือ</label>
                <br>
                <select class="data_for_ask form-control" name="emergency_type" id="emergency_type">
                    <option selected value="">กรุณเลือก</option>
                </select>
                <br>
                <label>รายละเอียดเหตุ</label>
                <br>
                <textarea type="text" class="data_for_ask form-control" name="emergency_detail" id="emergency_detail" placeholder="กรอกรายละเอียดของเหตุ"></textarea>
                <br>
                <label>รูปภาพ</label>
                <input type="file" class="data_for_ask" name="emergency_photo" id="emergency_photo" value="" placeholder="emergency_photo">
            </div>
            </div>
            <hr>

            <div class="col-12">
                <button class="btn-sos" onclick="send_emergency();">
                   <p class="text-center">ขอความช่วยเหลือ</p>
                </button>
            </div>
        </div>

        <button onclick="closeModal()" class="absolute top-2 right-3 text-gray-500 hover:text-red-500 text-xl font-bold">&times;</button>
    </div>
</div>

<script>
    function openModal() {
        document.getElementById('myModal').classList.remove('hidden');
    }

    function closeModal() {
        document.getElementById('myModal').classList.add('hidden');
    }
</script>


<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBgrxXDgk1tgXngalZF3eWtcTWI-LPdeus&language=th"></script>

<script>
    var aims_marker = "{{ url('/img/icon/operating_unit/aims/aims_marker.png') }}";

    document.addEventListener("DOMContentLoaded", function() {
        // ขออนุญาตตำแหน่งผู้ใช้
        if (navigator.geolocation) {
            navigator.geolocation.getCurrentPosition(location_success, error);
        } else {
            console.log("Geolocation ไม่รองรับในเบราว์เซอร์นี้");
        }
    });

    function location_success(position) {
        const lat = position.coords.latitude;
        const lng = position.coords.longitude;

        // สร้าง MAP
        const userLatLng = {
            lat: lat,
            lng: lng
        };
        const map = new google.maps.Map(document.getElementById("map"), {
            center: userLatLng,
            zoom: 15
        });

        // Marker ตำแหน่งผู้ใช้
        new google.maps.Marker({
            position: userLatLng,
            map: map,
            icon: {
                url: aims_marker,
                scaledSize: new google.maps.Size(40, 40),
            },
        });

        // เช็คพื้นที่
        check_area(lat, lng);

        // เบอร์ฉุกเฉินตามประเทศ
        const apiUrl = `https://api.bigdatacloud.net/data/reverse-geocode-client?latitude=${lat}&longitude=${lng}&localityLanguage=en`;
        fetch(apiUrl)
            .then(response => response.json())
            .then(data => {
                // console.log("Country Code:", data.countryCode);
                if (data.countryCode) {
                    get_data_phone_emergency(data.countryCode);
                }
            })
            .catch(err => {
                console.error("เกิดข้อผิดพลาด:", err);
            });
    }

    // หารายละเอียดสถานที่
    const geocoder = new google.maps.Geocoder();
    const infowindow = new google.maps.InfoWindow();

    async function geocodeLatLng(geocoder, map, infowindow, lat, lng) {
        const latlng = {
            lat: parseFloat(lat),
            lng: parseFloat(lng),
        };

        try {
            const response = await geocoder.geocode({
                location: latlng
            });
            if (response.results[0]) {
                return response.results[0].formatted_address;
            } else {
                // window.alert("No results found");
                return null; // หรือจัดการตามที่ต้องการ
            }
        } catch (e) {
            // window.alert("Geocoder failed due to: " + e);
            return null; // หรือจัดการตามที่ต้องการ
        }
    }

    var formatted_address;
    async function getFormattedAddress(lat, lng) {
        formatted_address = await geocodeLatLng(geocoder, map, infowindow, lat, lng);
        if (formatted_address) {
            // console.log("ที่อยู่: ", formatted_address);
            document.querySelector('#emergency_location').value = formatted_address;
        } else {
            // console.log("ไม่มีข้อมูลที่อยู่");
        }
    }

    function error(err) {
        console.warn("ไม่สามารถดึงตำแหน่งได้:", err.message);
        document.getElementById("spin_alert_map").classList.add('hidden');
        document.getElementById("text_alert_map").innerHTML = `ไม่สามารถดึงตำแหน่งได้ <br> กรุณาเปิดตำแหน่งที่ตั้งและลองใหม่อีกครั้ง`;

        get_data_phone_emergency('TH');
    }

    // ฟังก์ชัน Ray Casting เพื่อตรวจสอบว่าจุดอยู่ในโพลีกอนหรือไม่
    function isPointInPolygon(point, polygon) {
        const x = point.lng;
        const y = point.lat;
        let inside = false;

        for (let i = 0, j = polygon.length - 1; i < polygon.length; j = i++) {
            const xi = polygon[i].lng;
            const yi = polygon[i].lat;
            const xj = polygon[j].lng;
            const yj = polygon[j].lat;

            const intersect =
                yi > y !== yj > y && x < ((xj - xi) * (y - yi)) / (yj - yi) + xi;
            if (intersect) inside = !inside;
        }

        return inside;
    }

    function check_area(lat, lng) {
        // สร้าง object สำหรับจุด
        let point = {
            lat: lat,
            lng: lng
        };

        // ดึงข้อมูลโพลีกอนจาก API
        fetch("{{ url('/') }}/api/get_polygon_all")
            .then(response => response.json())
            .then(result => {
                // console.log(result);

                if (result && Array.isArray(result)) {
                    let found = false;

                    // วนลูปตรวจสอบแต่ละ polygon
                    result.forEach(area => {

                        let polygon;
                        if (area.polygon) {
                            polygon = JSON.parse(area.polygon);
                        } else {
                            polygon = null;
                        }

                        // ตรวจสอบว่าจุดอยู่ในโพลีกอนนี้หรือไม่
                        if (polygon && isPointInPolygon(point, polygon)) {
                            // console.log(`อยู่ในพื้นที่: ${area.name_area}`);
                            found = true;

                            // หารายละเอียดสถานที่
                            getFormattedAddress(lat, lng);
                            document.querySelector('#aims_partner_id').value = area.aims_partner_id;
                            document.querySelector('#aims_area_id').value = area.id;
                            document.querySelector('#emergency_lat').value = lat;
                            document.querySelector('#emergency_lng').value = lng;
                            document.querySelector('#btn_help_img').setAttribute('src', `{{ url('/storage') }}/${area.logo}`)
                            document.querySelector('#btn_help_name').innerHTML = `${area.name_partner}`;
                            document.querySelector('#btn_help').classList.remove('hidden');

                            fetch("{{ url('/') }}/api/get_emergency_types/" + area.id + "/" + area.aims_partner_id)
                                .then(response => response.json())
                                .then(result => {
                                    // console.log("get_emergency_types");

                                    if(result.length > 0){
                                        // console.log(result);
                                        let emergency_type = document.querySelector('#emergency_type');

                                        for (let i = 0; i < result.length; i++) {
                                            let option = document.createElement("option");
                                                option.text = result[i].name_emergency_type;
                                                option.value = result[i].name_emergency_type;
                                                emergency_type.add(option);
                                        }
                                    }
                            });

                        }
                    });

                    // ถ้าไม่พบโพลีกอนใดเลย
                    if (!found) {
                        console.log(`ไม่อยู่ในพื้นที่ใดเลย`);
                    }
                } else {
                    console.error("ไม่มีข้อมูลโพลีกอนหรือข้อมูลไม่ถูกต้อง");
                }
            })
            .catch(error => {
                console.error("เกิดข้อผิดพลาดในการดึงข้อมูล:", error);
            });
    }

    function get_data_phone_emergency(countryCode) {
        // console.log("Country Code:", countryCode);

        fetch("{{ url('/') }}/api/get_data_phone_emergency/" + countryCode)
            .then(response => response.json())
            .then(result => {
                // console.log(result);
                if (result) {
                    let phone_content = document.querySelector('#phone_content');

                    for (let i = 0; i < result.length; i++) {
                        let html = `
                            <div class="number-item">
                                <div class="contect">
                                    <p class="name">` + result[i]['name'] + `</p>
                                    <p class="m-0 number">` + result[i]['phone'] + `</p>
                                </div>
                                <a href="tel:` + result[i]['phone'] + `" class="btn-call">
                                    <i class="fa-solid fa-phone"></i>
                                </a>
                            </div>
                        `;

                        phone_content.insertAdjacentHTML('beforeend', html); // แทรกบนสุด
                    }
                }
            });
    }

    function send_emergency() {
        const elements = document.querySelectorAll('.data_for_ask');
        const data = {};

        elements.forEach((element, index) => {
            // ใช้ name หรือ id เป็น key หรือใช้ index ถ้าไม่มี name/id
            const key = element.name || element.id || `field_${index}`;
            data[key] = element.value;
        });

        // console.log(data);

        fetch("{{ url('/') }}/api/send_emergency", {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                },
                body: JSON.stringify(data),
            })
            .then(response => response.text())
            .then(result => {
                // console.log(result);

                if (result == "success") {
                    window.location.href = "{{ url('/demo/user_wait_officer') }}";
                }
            })
            .catch(error => console.error('Error:', error));
    }
</script>


@endsection
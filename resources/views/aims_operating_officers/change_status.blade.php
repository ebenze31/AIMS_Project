@extends('layouts.theme_aims')

@section('content')
<style>
    .modal-tw .backdrop-modal {
        position: fixed;
        z-index: 999 !important;
        top: 0;
        left: 0;
        width: 100dvw !important;
        height: 100dvh !important;
        background-color: #000;
    }

    .modal-tw.hidden .backdrop-modal {
        opacity: 0;
    }

    .modal-tw.flex .backdrop-modal {
        opacity: .3;
    }

    .form-label {
        margin-bottom: 0.5rem;
    }

    .form-control {
        font-size: .875rem;
        font-weight: 400;
        line-height: 1.5;

        display: block;

        width: 100%;
        height: calc(1.5em + 1.25rem + 2px);
        padding: .625rem .75rem;

        transition: all .15s cubic-bezier(.68, -.55, .265, 1.55);

        color: #8898aa;
        background-color: #fff;
        background-clip: padding-box;
        box-shadow: 0 3px 2px rgba(233, 236, 239, .05);

        border: #DDE1EB 1px solid;
        border-radius: 10px;
    }

    @media (prefers-reduced-motion: reduce) {
        .form-control {
            transition: none;
        }
    }

    .form-control::-ms-expand {
        border: 0;
        background-color: transparent;
    }

    .form-control:-moz-focusring {
        color: transparent;
        text-shadow: 0 0 0 #8898aa;
    }

    .form-control:focus {
        color: #8898aa;
        border-color: #5e72e4;
        outline: 0;
        background-color: #fff;
        box-shadow: 0 3px 9px rgba(50, 50, 9, 0), 3px 4px 8px rgba(94, 114, 228, .1);
    }

    .form-control::-ms-input-placeholder {
        opacity: 1;
        color: #adb5bd;
    }

    .form-control::placeholder {
        opacity: 1;
        color: #adb5bd;
    }

    .form-control:disabled,
    .form-control[readonly] {
        opacity: 1;
        background-color: #e9ecef;
    }

    select.form-control:focus::-ms-value {
        color: #8898aa;
        background-color: #fff;
    }

    .form-control-file,
    .form-control-range {
        display: block;

        width: 100%;
    }
    .gm-fullscreen-control{
        display: none !important;
    }
    #trackButton{
    position: absolute;
  top:10px;
  right: 10px;
        z-index: 999;
        background-color: #fff;
        color: #000;
        padding: 8px;
        box-shadow: rgba(0, 0, 0, 0.3) 0px 1px 4px -1px;
    }

    .gm-bundled-control {
        display: none !important;
    }
</style>
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
<style>
    body {
        width: 100%;
        height: 100dvh;
        background-color: #f0f0f0;
    }

    .menu {
        position: fixed;
        width: 100%;
        max-width: 800px;
        height: fit-content;
        bottom: 10px;
        left: 50%;
        transform: translate(-50%, 0);
        padding: 10px;
        z-index: 3;
    }

    .menu-container {
        background-color: #fff;
        z-index: 3;
        position: relative;
        padding: 10px;
        display: flex;
        justify-content: space-around;

    }

    #map {
        height: 100vh; /* หรือความสูงที่ต้องการ */
        position: relative;
        overflow: visible; /* ตรวจสอบว่าไม่ถูกตัด */
    }

    .menu-container {
        border-radius: 10px;

    }


    .btn-menu {
        border-radius: 10px;
        border: 2px solid transparent;
        background: linear-gradient(to right, #fff, #fff),
            linear-gradient(260deg, rgba(40, 86, 250, 1) 0%, rgba(6, 162, 253, 1) 100%);
        background-clip: padding-box, border-box;
        -webkit-background-clip: padding-box, border-box;
        transition: all .15s ease-in-out;
        color: #fff;
        width: 100%;
        margin: 0 5px;
        padding: 10px 0;
        cursor: pointer;
    }

    .btn-menu i {
        background: rgb(40, 86, 250);
        background: -moz-linear-gradient(260deg, rgba(40, 86, 250, 1) 0%, rgba(6, 162, 253, 1) 100%);
        background: -webkit-linear-gradient(260deg, rgba(40, 86, 250, 1) 0%, rgba(6, 162, 253, 1) 100%);
        background: linear-gradient(260deg, rgba(40, 86, 250, 1) 0%, rgba(6, 162, 253, 1) 100%);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        transition: all .15s ease-in-out;
    }

    /*.btn-menu:hover i,*/
    /*.btn-menu:focus i,*/
    .btn-menu.active i {
        background: #fff;
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
    }

    /*.btn-menu:hover,*/
    /*.btn-menu:focus,*/
    .btn-menu.active {
        background: #06A2FD;
        background: -webkit-linear-gradient(90deg, rgba(6, 162, 253, 1) 0%, rgba(40, 86, 250, 1) 100%);
        background: -moz-linear-gradient(90deg, rgba(6, 162, 253, 1) 0%, rgba(40, 86, 250, 1) 100%);
        background: linear-gradient(90deg, rgba(6, 162, 253, 1) 0%, rgba(40, 86, 250, 1) 100%);
        filter: progid:DXImageTransform.Microsoft.gradient(startColorstr="#06A2FD", endColorstr="#2856FA", GradientType=1);
        border: none !important;
    }


    .btn-menu {
        -webkit-animation: scale-up-hor-center 0.4s cubic-bezier(0.390, 0.575, 0.565, 1.000) both;
        animation: scale-up-hor-center 0.4s cubic-bezier(0.390, 0.575, 0.565, 1.000) both;
        animation-delay: calc(var(--index) * 0.1s);

    }


    @-webkit-keyframes scale-up-hor-center {
        0% {
            -webkit-transform: scaleX(0);
            transform: scaleX(0);
        }

        100% {
            -webkit-transform: scaleX(1);
            transform: scaleX(1);
        }
    }

    .container-content {
        position: fixed;
        width: 100%;
        max-width: 800px;
        height: fit-content;
        bottom: 90px;
        left: 50%;
        transform: translate(-50%, 0);
        padding: 10px;
        z-index: 3;

    }

    .content {
        background-color: #fff;
        z-index: 3;
        position: relative;
        display: flex;
        justify-content: space-around;
        border-radius: 10px;
    }

    .content .header {
        padding: 15px;
        box-shadow: 0px 2px 3px 0px rgba(0, 0, 0, 0.15);
        -webkit-box-shadow: 0px 2px 3px 0px rgba(0, 0, 0, 0.15);
        -moz-box-shadow: 0px 2px 3px 0px rgba(0, 0, 0, 0.15);
        display: flex;
        align-items: center;
    }

    .content .body {
        padding: 15px;
        max-height: calc(100dvh - 200px);
        overflow: auto;
    }

    .backdrop {
        position: absolute;
        bottom: 0;
        left: 0;
        width: 100%;
        height: 200px;
        background: linear-gradient(to bottom,
                rgba(0, 0, 0, 0) 0%,
                rgba(0, 0, 0, .8) 100%);
        pointer-events: none;
        /* เพื่อให้คลิกผ่านได้ */
        z-index: 2;
        /* กำหนดให้อยู่ด้านบนของเนื้อหา */
    }

    .btn-edit,
    .btn-call-more, .btn-call-success, .btn-call-success-outline, .btn-call-more-outline {
        width: 100%;
        border-radius: 5px;
        padding: 8px;
        font-size: 16px;
        -webkit-animation: slide-top 0.5s cubic-bezier(0.250, 0.460, 0.450, 0.940) both;
        animation: slide-top 0.5s cubic-bezier(0.250, 0.460, 0.450, 0.940) both;
        animation-delay: calc(var(--index) * 0.1s);
    }

    .btn-edit {
        align-items: center;
        background-color: #FDB022;
        color: #000;
        margin-bottom: 10px;
    }

    .btn-call-more {
        align-items: center;
        background-color: #2856FA;
        color: #fff;
    }

    .btn-call-success {
        align-items: center;
        background-color: #28a745;
        color: #fff;
    }

    .btn-call-success-outline {
        align-items: center;
        background-color: transparent;     /* พื้นหลังโปร่งใส */
        color: #28a745;                    /* สีตัวอักษรเขียว */
        border: 1px solid #28a745;         /* ขอบสีเขียว */
        padding: 0.375rem 0.75rem;         /* ระยะ padding เหมือนปุ่ม */
        border-radius: 0.25rem;            /* ขอบโค้ง */
        transition: all 0.15s ease-in-out; /* ให้มี animation */
    }

    .btn-call-more-outline {
        align-items: center;
        background-color: transparent;     /* พื้นหลังโปร่งใส */
        color: #2856FA;                    /* สีตัวอักษรเขียว */
        border: 1px solid #2856FA;         /* ขอบสีเขียว */
        padding: 0.375rem 0.75rem;         /* ระยะ padding เหมือนปุ่ม */
        border-radius: 0.25rem;            /* ขอบโค้ง */
        transition: all 0.15s ease-in-out; /* ให้มี animation */
    }

    @-webkit-keyframes slide-top {
        0% {
            -webkit-transform: translateY(100%);
            transform: translateY(100%);
            opacity: 0;
        }

        100% {
            -webkit-transform: translateY(0);
            transform: translateY(0);
            opacity: 1;

        }
    }

    .status {
        display: flex;
        align-items: center;
        width: 100%;
        padding: 10px;
    }

    .btn-prev {
        cursor: pointer;
        margin-right: 10px;
    }

    .header {
        font-weight: bolder;
    }

    .d-none{
        display: none;
    }
</style>

<div class="notranslate">
    <div class="map notranslate" id="map"></div>
    <div class="backdrop"></div>

    @php
	    $status = $data_officer->status;
	    $statusText = 'ไม่พร้อม';
	    $statusColor = 'text-gray-500';
	    $statusDotColor = 'bg-gray-400';
    	$hasPing = false;

	    if ($status === 'Standby') {
	        $statusText = 'พร้อมช่วยเหลือ';
	        $statusColor = 'text-green-600';
	        $statusDotColor = 'bg-green-500';
        	$hasPing = true;
	    } elseif ($status === 'Helping') {
	        $statusText = 'กำลังช่วยเหลือ';
	        $statusColor = 'text-yellow-500';
	        $statusDotColor = 'bg-yellow-500';
	    }
	@endphp
    
    <div id="div_card_content" class="menu d-none">
        <div class="flex items-center bg-white rounded-xl shadow-md p-4 space-x-4 w-full max-w-md">
            <!-- รูปโปรไฟล์ -->
            <div class="relative">
            	@if( !empty($data_user->photo) )
                <!-- จุดเขียวบนรูป -->
                <div class="relative">
				    <img src="{{ url('/storage') }}/{{ $data_user->photo }}" alt="Profile" class="w-14 h-14 rounded-full object-cover" />

				    <!-- จุดสถานะ -->
					<span id="statusDot" class="absolute top-0 right-0 w-4 h-4 {{ $statusDotColor }} border-2 border-white rounded-full z-10"></span>

					@if($hasPing)
					    <!-- คลื่น ping -->
					    <span id="statusPing" class="absolute top-0 right-0 w-4 h-4 rounded-full animate-ping bg-green-400 opacity-75 z-0"></span>
					@endif
				</div>
                @endif
            </div>

            <!-- ข้อความ -->
			<div class="flex-1">
			    <p id="statusText" class="text-sm font-semibold {{ $statusColor }}">{{ $statusText }}</p>
			    <p class="text-gray-800 font-semibold">{{ $data_officer->name_officer }}</p>
			</div>

            <!-- Toggle -->
			<label class="inline-flex items-center cursor-pointer relative">
			    <input
			        type="checkbox"
			        class="sr-only peer"
			        id="statusToggle"
			        {{ $data_officer->status == 'Standby' ? 'checked' : '' }}>
			    
			    <div class="w-11 h-6 bg-gray-300 peer-checked:bg-green-500 rounded-full peer-focus:ring-2 peer-focus:ring-green-500 transition-all duration-300"></div>
			    <div class="w-5 h-5 bg-white absolute rounded-full -translate-x-1 peer-checked:translate-x-6 transition-transform duration-300 shadow-md pointer-events-none"></div>
			</label>
        </div>
	</div>

	<div id="div_card_warn" class="menu d-none">
        <div class="flex items-center bg-white rounded-xl shadow-md p-4 space-x-4 w-full max-w-md">
        	กรุณาเปิดตำแหน่งที่ตั้ง
        </div>
    </div>
</div>

<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBgrxXDgk1tgXngalZF3eWtcTWI-LPdeus&language=th"></script>

<script>
document.addEventListener("DOMContentLoaded", function () {
    open_map();
});

var aims_icon = "{{ url('/img/icon/operating_unit/aims/aims_marker.png') }}";
var officer_icon = "{{ url('/img/icon/operating_unit/aims/officer.png') }}";
const toggle = document.getElementById('statusToggle');
const div_card_content = document.getElementById('div_card_content');
const div_card_warn = document.getElementById('div_card_warn');
const officer_id = "{{ $data_officer->id }}";
let map;
let defaultZoom = 15;
let LatLng = { lat: 13.736717, lng: 100.523186 };
let cachedLocation = null; // ใช้เก็บตำแหน่งจากตอนโหลดหน้า

function open_map() {
    if (navigator.geolocation) {
        navigator.geolocation.getCurrentPosition(
            function (position) {
                const userLatLng = {
                    lat: position.coords.latitude,
                    lng: position.coords.longitude
                };

                cachedLocation = {
				    lat: position.coords.latitude,
				    lng: position.coords.longitude
				};

                // สร้างแผนที่
                map = new google.maps.Map(document.getElementById("map"), {
                    center: userLatLng,
                    zoom: defaultZoom,
                    mapId: "90f87356969d889c",
                    gestureHandling: "greedy"
                });

                // ปักหมุด
                new google.maps.Marker({
                    position: userLatLng,
                    map: map,
                    icon: officer_icon,
                });

                // ✅ 1.1 โชว์ div_card_content ซ่อน div_card_warn
                div_card_content.classList.remove("d-none");
                div_card_warn.classList.add("d-none");

                // ✅ 2.1 ถ้าสถานะปัจจุบันคือ 'Standby' ให้ส่งตำแหน่งทันที
                const currentStatus = "{{ $data_officer->status }}";
                if (currentStatus === 'Standby') {
                    UpdateStatusOfficer(userLatLng, "Standby");
                }

                // ✅ 2.2 เพิ่ม event toggle
                toggle.addEventListener('change', function () {
				    if (this.checked) {
				        // เปิด → ใช้ cached location
				        if (cachedLocation) {
				            UpdateStatusOfficer(cachedLocation, "Standby");
				            updateStatusUI("Standby");
				        } else {
				            alert("ตำแหน่งไม่พร้อมใช้งาน");
				            this.checked = false;
				        }
				    } else {
				        // ปิด → ส่ง null
				        UpdateStatusOfficer(null, null);
				        updateStatusUI(null);
				    }
				});
            },
            function (error) {
                console.error("ไม่สามารถเข้าถึงตำแหน่งผู้ใช้:", error);

                // ✅ 1.2 ซ่อน div_card_content โชว์ div_card_warn
                div_card_content.classList.add("d-none");
                div_card_warn.classList.remove("d-none");

                // fallback map
                loadMapWithDefault();

                // ✅ เริ่ม polling เพื่อตรวจสอบว่าผู้ใช้เปิดตำแหน่งแล้วหรือยัง
			    const retryInterval = setInterval(function () {
			        navigator.geolocation.getCurrentPosition(
			            function (position) {
			                // ✅ ได้ตำแหน่งแล้ว → หยุด interval
			                clearInterval(retryInterval);

			                const userLatLng = {
			                    lat: position.coords.latitude,
			                    lng: position.coords.longitude
			                };

			                cachedLocation = userLatLng;

			                map.setCenter(userLatLng);

			                // ปักหมุด
			                new google.maps.Marker({
			                    position: userLatLng,
			                    map: map,
			                    icon: officer_icon,
			                });

			                // แสดงการ์ด
			                div_card_content.classList.remove("d-none");
			                div_card_warn.classList.add("d-none");

			                // ถ้าเปิด toggle อยู่แล้ว → ส่งตำแหน่ง
			                if (toggle.checked) {
			                    UpdateStatusOfficer(userLatLng, "Standby");
			                    updateStatusUI("Standby");
			                }

			                // เพิ่ม event toggle
			                toggle.addEventListener('change', function () {
			                    if (this.checked) {
			                        if (cachedLocation) {
			                            UpdateStatusOfficer(cachedLocation, "Standby");
			                            updateStatusUI("Standby");
			                        } else {
			                            alert("ตำแหน่งไม่พร้อมใช้งาน");
			                            this.checked = false;
			                        }
			                    } else {
			                        UpdateStatusOfficer(null, null);
			                        updateStatusUI(null);
			                    }
			                });
			            },
			            function () {
			                // ยังไม่ได้ → ลองใหม่ในรอบถัดไป
			                // console.log("ยังไม่สามารถรับตำแหน่งได้ ลองใหม่...");
			            }
			        );
			    }, 5000); // ลองใหม่ทุก 5 วินาที
            }
        );
    } else {
        alert("เบราว์เซอร์ไม่รองรับการระบุตำแหน่ง");
        div_card_content.classList.add("d-none");
        div_card_warn.classList.remove("d-none");
        loadMapWithDefault();
    }
}

function loadMapWithDefault() {
    map = new google.maps.Map(document.getElementById("map"), {
        center: LatLng,
        zoom: defaultZoom,
        mapId: "90f87356969d889c",
        gestureHandling: "greedy"
    });
}

function UpdateStatusOfficer(location, status) {
    fetch("{{ url('/') }}/api/UpdateStatusOfficer/" + officer_id + "/" + status, {
        method: 'POST',
        body: JSON.stringify(location),
        headers: {
            'Content-Type': 'application/json'
        }
    })
    .then(response => response.text())
    .then(data => {
        // console.log("ส่งสำเร็จ:", data);
    })
    .catch(error => {
        console.error("ส่งไม่สำเร็จ:", error);
    });
}

const statusTextEl = document.getElementById('statusText');
const statusDotEl = document.getElementById('statusDot');

function updateStatusUI(status) {
    // ลบ ping เก่าถ้าเคยมี
    const oldPing = document.getElementById('statusPing');
    if (oldPing) oldPing.remove();

    if (status === "Standby") {
        statusTextEl.textContent = "พร้อมช่วยเหลือ";
        statusTextEl.className = "text-sm font-semibold text-green-600";
        statusDotEl.className = "absolute top-0 right-0 w-4 h-4 bg-green-500 border-2 border-white rounded-full z-10";

        // เพิ่มคลื่น ping
        const ping = document.createElement('span');
        ping.id = "statusPing";
        ping.className = "absolute top-0 right-0 w-4 h-4 rounded-full animate-ping bg-green-400 opacity-75 z-0";
        statusDotEl.parentElement.appendChild(ping);
    }
    else if (status === "Helping") {
        statusTextEl.textContent = "กำลังช่วยเหลือ";
        statusTextEl.className = "text-sm font-semibold text-yellow-500";
        statusDotEl.className = "absolute top-0 right-0 w-4 h-4 bg-yellow-500 border-2 border-white rounded-full z-10";
    }
    else {
        statusTextEl.textContent = "ไม่พร้อม";
        statusTextEl.className = "text-sm font-semibold text-gray-500";
        statusDotEl.className = "absolute top-0 right-0 w-4 h-4 bg-gray-400 border-2 border-white rounded-full z-10";
    }
}


</script>


@endsection
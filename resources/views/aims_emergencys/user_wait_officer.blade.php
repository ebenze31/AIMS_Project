@extends('layouts.theme_aims')

@section('content')
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
<style>
    .d-none{
        display: none;
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

    .gm-fullscreen-control{
        display: none !important;
    }
    
    body {
        width: 100%;
        height: 100dvh;
    }

    .disable-dbl-tap-zoom {
        touch-action: manipulation;
    }

    .map {
        width: 100%;
        height: 100%;
        background-color: #000;

    }

    .menu {
        position: fixed;
        width: 100%;
        max-width: 800px;
        height: fit-content;
        bottom: 0;
        left: 50%;
        transform: translate(-50%, 0);

    }

    .content-container {
        background-color: #fff;
        z-index: 3;
        position: relative;
        padding: 20px;

    }

    .content {
        flex-direction: column;
        overflow: auto;
        max-height: 230px;
    }

    .backdrop {
        position: absolute;
        bottom: calc(100% - 1px);
        left: 0;
        width: 100%;
        height: calc(30px);
        background: linear-gradient(to bottom,
                rgba(255, 255, 255, 0) 0%,
                rgba(255, 255, 255, .5) 50%,
                rgba(255, 255, 255, .9) 80%,

                rgba(255, 255, 255, 1) 100%);
        pointer-events: none;
        /* เพื่อให้คลิกผ่านได้ */
        z-index: 2;
        border-radius: 10px 10px 0 0;
        /* กำหนดให้อยู่ด้านบนของเนื้อหา */
    }

    .btn-call-officer {
        width: 100%;
        text-align: center;
        padding: 5px;
        border: #1371fd 1px solid;
        border-radius: 10px;
        color: #1371fd;
        transition: all .15s ease-in-out;
        display: inline-block;
        cursor: pointer;
    }

    .btn-call-officer:hover {
        color: #fff;
        background-color: #1371fd;
    }

    .container-loader {
        --uib-size: 40px;
        --uib-color: #1371fd;
        --uib-speed: 2s;
        --uib-bg-opacity: 0;
        height: var(--uib-size);
        width: var(--uib-size);
        transform-origin: center;
        animation: rotate var(--uib-speed) linear infinite;
        will-change: transform;
        overflow: visible;
    }

    .container-loader-location {
        --uib-size: 40px;
        --uib-color: #ffffff;
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
        opacity: .2;
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

    @media (min-width: 800px) {
        .menu {
            position: fixed;
            width: 100%;
            max-width: 800px;
            height: fit-content;
            bottom: 10px;
            left: 50%;
            transform: translate(-50%, 0);
            
        }
        .content-container {
           border-radius: 20px;

        }

        .backdrop {
            display: none;
        }
    }
</style>

<style>
.loader {
  position: relative;
  width: 160px;
  height: 160px;
  border-radius: 50%;
  background: radial-gradient(
    circle,
    rgba(34, 197, 94, 0.1) 30%,
    transparent 70%
  );
  overflow: hidden;
}

.loader::before {
  content: "";
  position: absolute;
  inset: 0;
  border-radius: 50%;
  border: 4px solid transparent;
  border-top-color: rgba(34, 197, 94, 0.6);
  animation: loader-spin 2s linear infinite;
}

.loader::after {
  content: "";
  position: absolute;
  inset: 10%;
  border-radius: 50%;
  background: conic-gradient(from 90deg, rgba(34, 197, 94, 0.2), transparent);
  filter: blur(2px);
  animation: loader-spin-reverse 1.5s linear infinite;
}

.loader__inner {
  position: absolute;
  top: 50%;
  left: 50%;
  width: 25px;
  height: 25px;
  background: rgba(34, 197, 94, 0.9);
  border-radius: 50%;
  transform: translate(-50%, -50%);
  box-shadow: 0 0 15px rgba(34, 197, 94, 0.6);
  animation: loader-pulse 1s ease-in-out infinite;
}

.loader__orbit {
  position: absolute;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
  animation: orbit-rotate 3s linear infinite;
}

.loader__dot {
  position: absolute;
  left: 50%;
  top: 50%;
  width: 8px;
  height: 8px;
  background: rgba(34, 197, 94, 0.8);
  border-radius: 50%;
}

.loader__dot:nth-child(1) {
  transform: rotate(0deg) translate(60px);
}
.loader__dot:nth-child(2) {
  transform: rotate(90deg) translate(60px);
}
.loader__dot:nth-child(3) {
  transform: rotate(180deg) translate(60px);
}
.loader__dot:nth-child(4) {
  transform: rotate(270deg) translate(60px);
}

@keyframes loader-spin {
  0% {
    transform: rotate(0deg);
  }
  100% {
    transform: rotate(360deg);
  }
}

@keyframes loader-spin-reverse {
  0% {
    transform: rotate(0deg);
  }
  100% {
    transform: rotate(-360deg);
  }
}

@keyframes loader-pulse {
  0%, 100% {
    transform: translate(-50%, -50%) scale(1);
  }
  50% {
    transform: translate(-50%, -50%) scale(1.2);
  }
}

@keyframes orbit-rotate {
  0% {
    transform: rotate(0deg);
  }
  100% {
    transform: rotate(360deg);
  }
}
</style>

<style>
.button-Rate {
  display: inline-flex;
  align-items: center;
  justify-content: center;
  padding: 14px 32px;
  min-width: 280px;
  background-color: #22c55e;
  border: 6px solid #bbf7d0;
  color: white;
  gap: 12px;
  border-radius: 20px;
  cursor: pointer;
  text-decoration: none;
  transition: all 0.3s;
  font-size: 1.1rem;
}

.text-Rate {
  font-weight: 700;
  white-space: nowrap;
}

.svg-Rate svg {
  width: 32px;
  height: 20px;
  animation: jello-vertical 0.9s infinite;
  transform-origin: left;
}

@keyframes jello-vertical {
  0% { transform: scale3d(1, 1, 1); }
  30% { transform: scale3d(0.75, 1.25, 1); }
  40% { transform: scale3d(1.25, 0.75, 1); }
  50% { transform: scale3d(0.85, 1.15, 1); }
  65% { transform: scale3d(1.05, 0.95, 1); }
  75% { transform: scale3d(0.95, 1.05, 1); }
  100% { transform: scale3d(1, 1, 1); }
}
</style>

<button id="trackButton" class="btn d-none" onclick="toggleTracking();">
    ติดตามตำแหน่ง
</button>
<div>
    <div class="map" id="map">
        <!-- กำลังค้นหาตำแหน่ง.. GPS -->
        <div class="block justify-center p-5">
            <div class="flex justify-center mb-3" id="spin_alert_map">
                <svg
                    class="container-loader-location mb-3 mx-auto mt-5"
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
            <p id="text_alert_map" class="text-center mt-5" style="color: #ffffff;">กำลังค้นหาตำแหน่ง...</p>
        </div>

    </div>

    <div class="menu">
        <div class="backdrop "></div>
        <div class="content-container">

            <!-- กำลังค้นหาเจ้าหน้าที่ -->
            <div id="content_searching" class="content flex flex-col items-center justify-center text-center d-none">
                <div style="transform: scale(0.6); transform-origin: center;">
                    <div class="loader">
                        <div class="loader__inner"></div>
                        <div class="loader__orbit">
                            <div class="loader__dot"></div>
                            <div class="loader__dot"></div>
                            <div class="loader__dot"></div>
                            <div class="loader__dot"></div>
                        </div>
                    </div>
                </div>
                <h5 class="text-xl font-extrabold text-green-600 mt-0">กำลังค้นหาเจ้าหน้าที่ใกล้คุณ</h5>
                <h5 class="text-base text-gray-700 mb-3">โปรดรอสักครู่...</h5>
            </div>


            <!-- กำลังมาช่วยเหลือ -->
            <div id="content_coming" class="content mb-3 d-none">
                <div class="mb-[8px]">
                    <p class="text-[13px] text-[#7c7c7c] leading-[18px] mb-[5px]">ระยะเวลา (เริ่มจาก <span id="date_now"></span>)</p>
                    <p class="text-[17px] text-[#2856fa] leading-[18px] mb-[10px]" id="travel-duration">0 นาที</p>
                    <p class="text-[13px] text-[#7c7c7c] leading-[18px] mb-[5px]">ระยะทาง</p>
                    <p class="text-[17px] text-[#2856fa] leading-[18px] mb-[10px]" id="travel-distance">00 กม.</p>
                </div>
                <hr>
                <div class="mt-[15px]">
                    <div id="content_aims_officer" class="flex items-center bg-white rounded-lg shadow-md">
                        <!--  -->
                    </div>
                </div>
            </div>

            <!-- ถึงที่เกิดเหตุ -->
            <div id="content_arrive_scene" class="content mb-3 d-none">
                <h5 class="text-xl font-extrabold text-green-600 mt-4">เจ้าหน้าที่เดินทางมาถึงแล้ว</h5>
                <h5 class="text-base text-gray-700">กำลังช่วยเหลือ...</h5>
            </div>

            <!-- เสร็จสิ้น -->
            <div id="content_success" class="content flex flex-col items-center justify-center text-center d-none">
                <h5 class="text-xl font-extrabold text-gray-600 mt-2 mb-2">การช่วยเหลือเสร็จสิ้นแล้ว</h5>
                <a id="btn_to_questionnaire" href="{{ url('/assistance_questionnaire') }}/{{ $emergency->id }}" class="button-Rate"  style="transform: scale(0.8); transform-origin: center;">
                    <span class="text-Rate">ให้คะแนนการช่วยเหลือ</span>
                    <span class="svg-Rate">
                        <svg xmlns="http://www.w3.org/2000/svg" width="50" height="20" viewBox="0 0 38 15" fill="none">
                            <path fill="white"
                            d="M10 7.519l-.939-.344h0l.939.344zm14.386-1.205l-.981-.192.981.192zm1.276 5.509l.537.843.148-.094.107-.139-.792-.611zm4.819-4.304l-.385-.923h0l.385.923zm7.227.707a1 1 0 0 0 0-1.414L31.343.448a1 1 0 0 0-1.414 0 1 1 0 0 0 0 1.414l5.657 5.657-5.657 5.657a1 1 0 0 0 1.414 1.414l6.364-6.364zM1 7.519l.554.833.029-.019.094-.061.361-.23 1.277-.77c1.054-.609 2.397-1.32 3.629-1.787.617-.234 1.17-.392 1.623-.455.477-.066.707-.008.788.034.025.013.031.021.039.034a.56.56 0 0 1 .058.235c.029.327-.047.906-.39 1.842l1.878.689c.383-1.044.571-1.949.505-2.705-.072-.815-.45-1.493-1.16-1.865-.627-.329-1.358-.332-1.993-.244-.659.092-1.367.305-2.056.566-1.381.523-2.833 1.297-3.921 1.925l-1.341.808-.385.245-.104.068-.028.018c-.011.007-.011.007.543.84zm8.061-.344c-.198.54-.328 1.038-.36 1.484-.032.441.024.94.325 1.364.319.45.786.64 1.21.697.403.054.824-.001 1.21-.09.775-.179 1.694-.566 2.633-1.014l3.023-1.554c2.115-1.122 4.107-2.168 5.476-2.524.329-.086.573-.117.742-.115s.195.038.161.014c-.15-.105.085-.139-.076.685l1.963.384c.192-.98.152-2.083-.74-2.707-.405-.283-.868-.37-1.28-.376s-.849.069-1.274.179c-1.65.43-3.888 1.621-5.909 2.693l-2.948 1.517c-.92.439-1.673.743-2.221.87-.276.064-.429.065-.492.057-.043-.006.066.003.155.127.07.099.024.131.038-.063.014-.187.078-.49.243-.94l-1.878-.689zm14.343-1.053c-.361 1.844-.474 3.185-.413 4.161.059.95.294 1.72.811 2.215.567.544 1.242.546 1.664.459a2.34 2.34 0 0 0 .502-.167l.15-.076.049-.028.018-.011c.013-.008.013-.008-.524-.852l-.536-.844.019-.012c-.038.018-.064.027-.084.032-.037.008.053-.013.125.056.021.02-.151-.135-.198-.895-.046-.734.034-1.887.38-3.652l-1.963-.384zm2.257 5.701l.791.611.024-.031.08-.101.311-.377 1.093-1.213c.922-.954 2.005-1.894 2.904-2.27l-.771-1.846c-1.31.547-2.637 1.758-3.572 2.725l-1.184 1.314-.341.414-.093.117-.025.032c-.01.013-.01.013.781.624zm5.204-3.381c.989-.413 1.791-.42 2.697-.307.871.108 2.083.385 3.437.385v-2c-1.197 0-2.041-.226-3.19-.369-1.114-.139-2.297-.146-3.715.447l.771 1.846z">
                            </path>
                        </svg>
                    </span>
                </a>
            </div>

        </div>
    </div>
</div>


<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBgrxXDgk1tgXngalZF3eWtcTWI-LPdeus&language=th"></script>

<script>

var aims_icon = "{{ url('/img/icon/operating_unit/aims/aims_marker.png') }}";
var officer_icon = "{{ url('/img/icon/operating_unit/aims/officer.png') }}";
var emergency_Lat = parseFloat("{{ $emergency->emergency_lat }}");
var emergency_Lng = parseFloat("{{ $emergency->emergency_lng }}");
var officers_id = parseFloat("{{ $emergency->op_aims_operating_officers_id }}");
var current_status = "{{ $emergency->op_status }}";

var interval_check_status;
let check_contentIndex;
var map;
var officerMarker;
var emergencyMarker;
var directionsRenderer;
var watchId;
var directionsService;
var isTracking = false;
var defaultZoom = 15;
var isProgrammaticChange = false; // ตัวแปรควบคุมการเปลี่ยนแปลงจากโค้ด

document.addEventListener("DOMContentLoaded", function () {
    open_map();
    updateContentByStatus(current_status);
    start_check_status();
});

function start_check_status() {
    interval_check_status = setInterval(loop_check_status, 5000);
}

var first_check_status = true;

function loop_check_status(){
    fetch("{{ url('/') }}/api/loop_check_status" + "/" + '{{ $emergency->id }}')
    .then(response => response.text())
    .then(result => {
        // console.log(result);
        if(result){
            current_status = result ;
            updateContentByStatus(current_status);

            if (current_status === "ออกจากฐาน") {
                if(first_check_status){

                    first_check_status = false;

                    // Initialize Directions Service and Renderer
                    directionsService = new google.maps.DirectionsService();
                    directionsRenderer = new google.maps.DirectionsRenderer({
                        map: map,
                        suppressMarkers: true
                    });

                    // เพิ่ม event listener สำหรับหยุดการติดตามเมื่อมีการโต้ตอบกับแผนที่
                    map.addListener('dragend', stopTrackingCenter);
                    map.addListener('zoom_changed', stopTrackingCenter);
                    map.addListener('tilt_changed', stopTrackingCenter);
                    map.addListener('heading_changed', stopTrackingCenter);

                    // เริ่มรับตำแหน่งผู้ใช้
                    startTrackingUser();
                }
            }
        }
    });
}

function updateContentByStatus(current_status) {
    // ซ่อนทั้งหมดก่อน
    document.querySelector('#content_searching')?.classList.add('d-none');
    document.querySelector('#content_coming')?.classList.add('d-none');
    document.querySelector('#content_arrive_scene')?.classList.add('d-none');
    document.querySelector('#content_success')?.classList.add('d-none');

    // แสดงเฉพาะตามสถานะ
    if (current_status === "รับแจ้งเหตุ" || current_status === "สั่งการ") {
        document.querySelector('#content_searching')?.classList.remove('d-none');
    } else if (current_status === "ออกจากฐาน") {
        document.querySelector('#content_coming')?.classList.remove('d-none');
    } else if (current_status === "ถึงที่เกิดเหตุ") {
        document.querySelector('#content_arrive_scene')?.classList.remove('d-none');
    } else if (current_status === "เสร็จสิ้น") {
        document.querySelector('#content_success')?.classList.remove('d-none');
    }else{
        document.querySelector('#content_arrive_scene')?.classList.remove('d-none');
    }
}


const emergency_LatLng = { lat: emergency_Lat, lng: emergency_Lng };

function open_map() {
    map = new google.maps.Map(document.getElementById("map"), {
        center: emergency_LatLng,
        zoom: defaultZoom,
        mapId: "90f87356969d889c",
        gestureHandling: "greedy"
    });

    // Marker สำหรับจุดฉุกเฉิน
    emergencyMarker = new google.maps.Marker({
        position: emergency_LatLng,
        map: map,
        icon: { url: aims_icon, scaledSize: new google.maps.Size(45, 45) }
    });

    if(current_status == "ออกจากฐาน"){

        first_check_status = false;

        // Initialize Directions Service and Renderer
        directionsService = new google.maps.DirectionsService();
        directionsRenderer = new google.maps.DirectionsRenderer({
            map: map,
            suppressMarkers: true
        });

        // เพิ่ม event listener สำหรับหยุดการติดตามเมื่อมีการโต้ตอบกับแผนที่
        map.addListener('dragend', stopTrackingCenter);
        map.addListener('zoom_changed', stopTrackingCenter);
        map.addListener('tilt_changed', stopTrackingCenter);
        map.addListener('heading_changed', stopTrackingCenter);

        // เริ่มรับตำแหน่งผู้ใช้
        startTrackingUser();
    }
}

function startTrackingUser() {

    get_data_individual_officer();

    let url_api = "{{ url('/') }}/api/get_location_realtime/" + officers_id + "/" + "{{ $emergency->id }}";

    fetch(url_api)
        .then(response => {
            if (!response.ok) {
                throw new Error("Network response was not ok");
            }
            return response.json();
        })
        .then(data => {
            const userLatLng = {
                lat: parseFloat(data.officer.lat),
                lng: parseFloat(data.officer.lng)
            };

            // console.log("ครั้งแรก");
            // console.log(userLatLng);

            if (!officerMarker) {
                officerMarker = new google.maps.Marker({
                    position: userLatLng,
                    map: map,
                    icon: { url: officer_icon, scaledSize: new google.maps.Size(45, 45) }
                });
            } else {
                officerMarker.setPosition(userLatLng);
            }

            calculateAndDisplayRoute(userLatLng, emergency_LatLng);
            document.querySelector('#trackButton').classList.remove('d-none');

            // ติดตามตำแหน่งทุก 5 วินาที
            watchId = setInterval(() => {
                fetch(url_api)
                    .then(response => {
                        if (!response.ok) {
                            throw new Error("Network response was not ok");
                        }
                        return response.json();
                    })
                    .then(update => {
                        // console.log("Loop");
                        // console.log(update);

                        // ✅ หยุดติดตามและรีเซ็ตแผนที่หากสถานะไม่ใช่ "ออกจากฐาน"
                        if (update.emergency.status !== "ออกจากฐาน") {
                            clearInterval(watchId);
                            watchId = null;

                            // ลบหมุดผู้ปฏิบัติการ
                            if (officerMarker) {
                                officerMarker.setMap(null);
                                officerMarker = null;
                            }

                            // ลบเส้นทาง
                            if (directionsRenderer) {
                                directionsRenderer.setMap(null);
                                directionsRenderer = null;
                            }

                            // ลบหมุดฉุกเฉินเก่า (ถ้ามี)
                            if (emergencyMarker) {
                                emergencyMarker.setMap(null);
                            }

                            // ปักหมุดฉุกเฉินใหม่
                            emergencyMarker = new google.maps.Marker({
                                position: emergency_LatLng,
                                map: map,
                                icon: { url: aims_icon, scaledSize: new google.maps.Size(45, 45) }
                            });

                            // เซ็ตตำแหน่งไปยังหมุดฉุกเฉิน
                            isProgrammaticChange = true;
                            map.setCenter(emergency_LatLng);
                            map.setZoom(defaultZoom);
                            isProgrammaticChange = false;

                            // ซ่อนปุ่มติดตาม
                            document.querySelector('#trackButton').classList.add('d-none');

                            return; // ⛔️ ออกจาก loop
                        }

                        const updatedLatLng = {
                            lat: parseFloat(update.officer.lat),
                            lng: parseFloat(update.officer.lng)
                        };

                        if (isTracking) {
                            isProgrammaticChange = true;
                            map.panTo(updatedLatLng);
                            isProgrammaticChange = false;
                        }

                        officerMarker.setPosition(updatedLatLng);
                    })
                    .catch(error => {
                        console.error("Error fetching updated position:", error);
                    });
            }, 5000);
        })
        .catch(error => {
            console.error("Error getting initial position:", error);
        });
}

function calculateAndDisplayRoute(origin, destination) {
    directionsService.route(
        {
            origin: origin,
            destination: destination,
            travelMode: google.maps.TravelMode.DRIVING
        },
        (response, status) => {

            if (status === google.maps.DirectionsStatus.OK) {
                directionsRenderer.setDirections(response);

                const leg = response.routes[0].legs[0];
                const distanceText = leg.distance.text;
                const durationText = leg.duration.text;
                const durationValue = leg.duration.value;

                const arrivalTime = aims_func_arrivalTime(durationValue);
                // console.log("เวลาถึงที่หมาย:", arrivalTime);

                document.querySelector("#travel-distance").textContent = distanceText;
                document.querySelector("#travel-duration").textContent = durationText + " ("+arrivalTime+")";
                const now = new Date();
                const formatted = now.toLocaleString('th-TH', {
                    year: 'numeric',
                    month: 'short',
                    day: 'numeric',
                    hour: '2-digit',
                    minute: '2-digit',
                    hourCycle: 'h24'
                });

                document.querySelector("#date_now").textContent = formatted + " น.";

                setTimeout(() => {
                    const windowHeight = window.innerHeight;
                    const topPadding = windowHeight * 0.20;
                    const bottomPadding = windowHeight * 0.40;
                    const leftPadding = windowHeight * 0.10;
                    const rightPadding = windowHeight * 0.10;

                    isProgrammaticChange = true;
                    map.fitBounds(response.routes[0].bounds, {
                        top: topPadding,
                        bottom: bottomPadding,
                        left: leftPadding,
                        right: rightPadding
                    });
                    isProgrammaticChange = false;
                }, 200);
            } else {
                console.error("Directions request failed due to " + status);
            }

        }
    );
}

function toggleTracking() {
    if (!officerMarker) return;

    isTracking = !isTracking;
    const trackButton = document.getElementById('trackButton');

    if (isTracking) {
        // console.log('ติดตาม');
        isProgrammaticChange = true; // ระบุว่าเป็นการเปลี่ยนจากโค้ด
        map.panTo(officerMarker.getPosition());
        map.setZoom(defaultZoom + 2);
        isProgrammaticChange = false;
        trackButton.textContent = 'หยุดติดตาม';
        trackButton.classList.add('tracking');
    } else {
        // console.log('หยุดติดตาม');
        isProgrammaticChange = true; // ระบุว่าเป็นการเปลี่ยนจากโค้ด
        map.setZoom(defaultZoom);
        isProgrammaticChange = false;
        trackButton.textContent = 'ติดตามตำแหน่ง';
        trackButton.classList.remove('tracking');
    }
}

function stopTrackingCenter() {
    // console.log('stopTrackingCenter');
    if (isTracking && !isProgrammaticChange) {
        isTracking = false;
        const trackButton = document.getElementById('trackButton');
        trackButton.textContent = 'ติดตามตำแหน่ง';
        trackButton.classList.remove('tracking');
        isProgrammaticChange = true; // ระบุว่าเป็นการเปลี่ยนจากโค้ด
        map.setZoom(defaultZoom);
        isProgrammaticChange = false;
    }
}

function stopTracking() {
    if (watchId) {
        navigator.geolocation.clearWatch(watchId);
        watchId = null;
    }
    if (officerMarker) {
        officerMarker.setMap(null);
        officerMarker = null;
    }
    if (directionsRenderer) {
        directionsRenderer.setMap(null);
    }
    isProgrammaticChange = true; // ระบุว่าเป็นการเปลี่ยนจากโค้ด
    map.setCenter(emergency_LatLng);
    map.setZoom(defaultZoom);
    isProgrammaticChange = false;
    document.querySelector('#trackButton').classList.add('d-none');
}

function aims_func_arrivalTime(duration){
    let date_now = new Date();
    let travelTimeInSeconds = duration; 
    let arrivalTime = new Date(date_now.getTime() + (travelTimeInSeconds * 1000));
    let options = { hourCycle: 'h24' };
    let formattedTime = arrivalTime.toLocaleTimeString('th-TH', options);
    let timeWithoutSeconds = formattedTime.slice(0, -3); // ตัดวินาทีออก
    let timeWithSuffix = `${timeWithoutSeconds} น.`;

    return timeWithSuffix ;
}

function get_data_individual_officer(){
    fetch("{{ url('/') }}/api/get_data_individual_officer" + "/" + officers_id)
    .then(response => response.json())
    .then(result => {

        if(result){
            // console.log(result);
            let content_aims_officer = document.querySelector('#content_aims_officer');
                content_aims_officer.innerHTML = "" ;

            let html_photo = ``;
            if(result[0].photo){
                html_photo = `<img src="{{ url('storage')}}/${result[0].photo}" class="w-14 h-14 rounded-full object-cover mr-4">`;
            }

            let html = `
                ${html_photo}
                <div>
                    <h2 class="text-lg font-semibold text-gray-800">${result[0].name_officer}</h2>
                    <p class="text-sm text-gray-500">${result[0].name_unit}</p>
                    <p class="text-sm text-gray-500">${result[0].name_type_unit}</p>
                </div>
            `;

            content_aims_officer.insertAdjacentHTML('beforeend',html); // แทรกล่างสุด
        }

    });
}


</script>

@endsection
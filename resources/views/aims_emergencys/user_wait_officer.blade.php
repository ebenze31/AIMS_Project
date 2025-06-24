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
        overflow: auto;
        max-height: 200px;
        align-content: center;
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

<button id="trackButton" class="btn d-none" onclick="toggleTracking();">
    ติดตามตำแหน่ง
</button>
<div>
    <div class="map" id="map">
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
        <div>
            <div class="backdrop "></div>
            <div class="content-container">
                <div class="content mb-3">
                    <svg
                        class="container-loader mb-3 mx-auto"
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
                    <h5 class="text-center font-extrabold mt-4">กำลังค้นหาเจ้าหน้าที่ใกล้คุณ</h5>
                    <h5 class="text-center mb-3">โปรดรอซักครู่...</h5>
                    <p class="text-[13px] text-[#7c7c7c] leading-[18px]">ระยะทาง (จากฐานถึงที่เกิดเหตุ)</p>
                    <p class="text-[18px] text-[#2856fa] leading-[18px]" id="travel-distance">00 กม.</p>
                    <p class="text-[13px] text-[#7c7c7c] leading-[18px]">ระยะเวลา (เริ่มจาก <span id="date_now"></span>)</p>
                    <p class="text-[18px] text-[#2856fa] leading-[18px]" id="travel-duration">0 นาที</p>
                </div>
                <!-- <a href="#" class="btn-call-officer btn">ติดต่อเจ้าหน้าที่</a> -->
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

var interval_get_idc_rc;
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
});

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

            console.log("ครั้งแรก");
            console.log(userLatLng);

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
                        console.log("Loop");
                        console.log(update);

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


</script>

@endsection
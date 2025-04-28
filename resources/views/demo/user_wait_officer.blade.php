@extends('layouts.theme_aims')

@section('content')
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
<style>
    .gmnoprint *,
    .gm-style-mtc-bbw * {
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
                </div>
                <a href="#" class="btn-call-officer btn">ติดต่อเจ้าหน้าที่</a>
            </div>
        </div>
    </div>
</div>


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

    }

    function error(err) {
        console.warn("ไม่สามารถดึงตำแหน่งได้:", err.message);
        document.getElementById("spin_alert_map").classList.add('hidden');
        document.getElementById("text_alert_map").innerHTML = `ไม่สามารถดึงตำแหน่งได้ <br> กรุณาเปิดตำแหน่งที่ตั้งและลองใหม่อีกครั้ง`;
    }
</script>

@endsection
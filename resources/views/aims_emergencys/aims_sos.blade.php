@extends('layouts.theme_aims')

@section('content')

<style>
    .gmnoprint * , .gm-style-mtc-bbw *{
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

        .gmnoprint, .gm-style-mtc-bbw, .gm-style-mtc{
            display: none!important;
        }
    }
</style>

<nav class="nav-top">
    <div class="">
        แจ้งเหตุฉุกเฉิน
    </div>
</nav>

<!-- Date API -->
<div class="hidden">
    <input type="text" name="report_platform" id="report_platform" value="{{ htmlspecialchars($formData['report_platform'] ?? '') }}" placeholder="Enter report_platform">
    <input type="text" name="name_reporter" id="name_reporter" value="{{ htmlspecialchars($formData['name_reporter'] ?? '') }}" placeholder="Enter name_reporter">
    <input type="text" name="type_reporter" id="type_reporter" value="{{ htmlspecialchars($formData['type_reporter'] ?? '') }}" placeholder="Enter type_reporter">
    <input type="text" name="phone_reporter" id="phone_reporter" value="{{ htmlspecialchars($formData['phone_reporter'] ?? '') }}" placeholder="Enter phone_reporter">
</div>
<!-- END Date API -->


<div class=" m-auto">
    <div class="content">
        <div class="map-container">
            <div class="map" id="map"></div>
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

            <div class="btn-sos-aims">
                <div class="backdrop"></div>
                <button>
                    <div>
                        <img src="{{ asset('/partner_new/images/logo/aims logo.png') }}" alt="" width="60" height="60">
                    </div>
                    <div class="w-full block text-[#fff]">
                        <p class="text-[16px] font-extrabold">ขอความช่วยเหลือ</p>
                        <p class="text-[12px] font-light">ตำรวจท่องเที่ยว</p>
                    </div>
                </button>
            </div>

        </div>
    </div>
</div>


<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBgrxXDgk1tgXngalZF3eWtcTWI-LPdeus&language=th" ></script>

<script>

    var aims_marker = "{{ url('/img/icon/operating_unit/aims/aims_marker.png') }}";

    document.addEventListener("DOMContentLoaded", function () {
        // ขออนุญาตตำแหน่งผู้ใช้
        if (navigator.geolocation) {
            navigator.geolocation.getCurrentPosition(success, error);
        } else {
            console.log("Geolocation ไม่รองรับในเบราว์เซอร์นี้");
        }
    });

    function success(position) {
        const lat = position.coords.latitude;
        const lng = position.coords.longitude;

        // สร้าง MAP
        const userLatLng = { lat: lat, lng: lng };
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

        // เบอร์ฉุกเฉินตามประเทศ
        const apiUrl = `https://api.bigdatacloud.net/data/reverse-geocode-client?latitude=${lat}&longitude=${lng}&localityLanguage=en`;
        fetch(apiUrl)
            .then(response => response.json())
            .then(data => {
                // console.log("Country Code:", data.countryCode);
                if(data.countryCode){
                    get_data_phone_emergency(data.countryCode);
                }
            })
            .catch(err => {
                console.error("เกิดข้อผิดพลาด:", err);
            });
    }

    function error(err) {
        console.warn("ไม่สามารถดึงตำแหน่งได้:", err.message);
    }

    function get_data_phone_emergency(countryCode){
        // console.log("Country Code:", countryCode);

        fetch("{{ url('/') }}/api/get_data_phone_emergency/" + countryCode)
            .then(response => response.json())
            .then(result => {
                // console.log(result);
                if(result){
                    let phone_content = document.querySelector('#phone_content');

                    for (let i = 0; i < result.length; i++) {
                        let html = `
                            <div class="number-item">
                                <div class="contect">
                                    <p class="name">`+result[i]['name']+`</p>
                                    <p class="m-0 number">`+result[i]['phone']+`</p>
                                </div>
                                <a href="tel:`+result[i]['phone']+`" class="btn-call">
                                    <i class="fa-solid fa-phone"></i>
                                </a>
                            </div>
                        `;

                        phone_content.insertAdjacentHTML('beforeend', html); // แทรกบนสุด
                    }
                }
            });
    }
</script>


@endsection
@extends('layouts.partners.theme_partner_new')

@section('content')

<style>

    #map {
        width: 100%;
        height: 300px;
        border-radius: 10px;
    }

    .gm-svpc, .gm-control-active{
        display: none !important;
    }

    /* ปรับขนาดปุ่มนอก */
    .gm-ui-hover-effect {
        width: 24px !important;
        height: 24px !important;
        top: 2px !important;
        right: -10px !important;
        background: #fff !important;
        border-radius: 50% !important;
        border: 0.5px solid #ccc !important;
        box-shadow: 0 0 2px rgba(0,0,0,0.1) !important;
        display: flex !important;
        align-items: center;
        justify-content: center;
        z-index: 1000;
    }

    .gm-ui-hover-effect > span {
        all: unset !important;
        display: block !important;
        font-size: 16px !important;
        font-weight: bold !important;
        color: #333 !important;
        position: relative !important;
        top: 1px !important;
        line-height: 1 !important;
    }

    .custom-info-window {
        font-size: 14px;
        font-family: 'Sarabun', sans-serif;
        text-align: center;
    }

    .custom-info-window .title {
        font-weight: bold;
        color: #333;
    }

    .status-standby {
        color: green;
    }

    .status-helping {
        color: orange;
    }

    .status-ไม่พร้อม {
        color: gray;
    }

    #div_right {
        height: 75vh; 
        overflow-y: auto;
        overflow-x: hidden;
        padding-right: 10px; /* ป้องกัน scrollbar ทับเนื้อหา */
        border-left: 1px solid #dee2e6;
    }

    .officer-card {
        box-shadow: 0 4px 8px rgba(0,0,0,0.05);
        transition: box-shadow 0.3s;
        width: 100%;
        white-space: normal; /* ป้องกันข้อความลากยาว */
    }

    .officer-card:hover {
        box-shadow: 0 6px 16px rgba(0,0,0,0.1);
    }

    .officer-img {
        width: 70px;
        height: 70px;
        border-radius: 50%;
        object-fit: cover;
        border: 2px solid #dee2e6;
    }

    .text-muted {
        font-size: 0.9rem;
    }

    .btn-status {
        font-weight: 500;
        font-size: 0.85rem;
        border-radius: 20px;
        padding: 6px 16px;
    }
</style>
    
<div class="card radius-10 border-top border-0 border-4 border-secondary">
    <div class="card-body p-3">
        <div class="card-title d-flex align-items-center">
            <h5 class="mb-0">
                หน่วย : {{ $aims_operating_unit->name_unit }}
                <div class="text-muted mt-1" style="font-size: 16px;">
                    ประเภท : {{ $aims_operating_unit->name_type_unit }}
                </div>
            </h5>
        </div>
        <hr>
        <div class="row">
            <div id="div_left" class="col-12 col-md-3">
                <div class="row">
                    <div class="col-12">
                        <div id="map"></div>
                    </div>
                    <div class="col-12">
                        <div class="card mt-4">
                            <div class="card-body d-flex flex-column align-items-center text-center">
                                <!-- Container สำหรับ QR -->
                                <div id="qrcode"></div>

                                <div class="mt-3">
                                    <p class="text-secondary mb-1">QR-Code สำหรับลงทะเบียนเจ้าหน้าที่</p>
                                    <button class="btn btn-sm btn-primary" style="width: 100%;" onclick="downloadQR()">
                                        ดาวน์โหลด
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div id="div_right" class="col-12 col-md-9">
                <div id="list_officer" class="row">
                    <!--  -->
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/qrcodejs@1.0.0/qrcode.min.js"></script>
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBgrxXDgk1tgXngalZF3eWtcTWI-LPdeus&language=th"></script>


<script>
    document.addEventListener("DOMContentLoaded", function () {
        open_map();
    });

    let map;
    let markers = [];
    let infoWindows = [];
    let LatLng = { lat: 14.3, lng: 100.6 };
    let defaultZoom = 13;
    let mapBounds = new google.maps.LatLngBounds();

    function open_map() {
        map = new google.maps.Map(document.getElementById("map"), {
            center: LatLng,
            zoom: defaultZoom,
            mapId: "90f87356969d889c",
            gestureHandling: "greedy"
        });

        get_data_by_unit();
    }

    function get_data_by_unit() {
        let unit_id = "{{ $aims_operating_unit->id }}";

        fetch("{{ url('/') }}/api/get_data_by_unit" + "/" + unit_id)
            .then(response => response.json())
            .then(result => {
                if (result) {
                    const listOfficer = document.getElementById('list_officer');
                    listOfficer.innerHTML = '';
                    clearMarkers();

                    mapBounds = new google.maps.LatLngBounds();

                    result.forEach((officer, index) => {
                        const status = officer.status;
                        const isValidStatus = status === 'Standby' || status === 'Helping';

                        const markerColor = (status === 'Standby') ? 'green'
                                          : (status === 'Helping') ? '#DAA520' : 'gray';

                        const photoHTML = officer.photo
                            ? `<img src="{{ url('/storage') }}/${officer.photo}" class="officer-img me-3" style="width:80px; height:80px; border-radius:50%; object-fit:cover;align-self:center;">`
                            : '';

                        let statusClass = 'btn-secondary';
                        let statusText = 'ไม่พร้อม';
                        if (status === 'Standby') {
                            statusClass = 'btn-success';
                            statusText = 'Standby';
                        } else if (status === 'Helping') {
                            statusClass = 'btn-warning text-dark';
                            statusText = 'Helping';
                        }

                        const levelText = officer.level ? `ระดับ : ${officer.level}` : 'ระดับ : -';
                        const vehicleText = officer.vehicle_type ? `ยานพาหนะ : ${officer.vehicle_type}` : '';
                        const amountHelpText = officer.amount_help ? `ช่วยเหลือ : ${officer.amount_help}` : 'ช่วยเหลือ : 0';

                        const html = `
                            <div class="col-12 col-md-6 mb-3">
                                <div class="d-flex align-items-center justify-content-between bg-white border rounded p-3 officer-card h-100" data-index="${index}">
                                    <div class="d-flex align-items-start">
                                        ${photoHTML}
                                        <div>
                                            <div class="fw-bold fs-6">${officer.name_officer}</div>
                                            <div class="text-muted">${levelText}</div>
                                            <div class="text-muted">${vehicleText}</div>
                                            <div class="text-muted">${amountHelpText} ครั้ง</div>
                                        </div>
                                    </div>
                                    <span class="btn btn-sm ${statusClass} btn-status mt-2 mt-md-0">${statusText}</span>
                                </div>
                            </div>
                        `;
                        listOfficer.insertAdjacentHTML('beforeend', html);

                        if (isValidStatus && officer.lat && officer.lng) {
                            const latLng = new google.maps.LatLng(parseFloat(officer.lat), parseFloat(officer.lng));

                            // สร้าง Marker
                            const marker = new google.maps.Marker({
                                position: latLng,
                                map: map,
                                icon: {
                                    path: google.maps.SymbolPath.CIRCLE,
                                    scale: 10,
                                    fillColor: markerColor,
                                    fillOpacity: 1,
                                    strokeColor: 'white',
                                    strokeWeight: 2
                                },
                                title: officer.name_officer
                            });

                            // สร้าง InfoWindow
                            const info = new google.maps.InfoWindow({
                            content:`
                                    <div class="custom-info-window pt-2 px-1">
                                        <div class="title">${officer.name_officer}</div>
                                        <div class="status status-${statusText.toLowerCase()}">${statusText}</div>
                                    </div>
                                    `
                            });

                            marker.addListener('click', () => {
                                // ปิดทุกอันก่อน
                                infoWindows.forEach(iw => iw.close());
                                info.open(map, marker);
                                setTimeout(() => {
                                    document.querySelectorAll('.gm-ui-hover-effect > span').forEach(span => {
                                        span.textContent = '×';
                                    });
                                }, 100);
                            });

                            markers.push(marker);
                            infoWindows.push(info);
                            mapBounds.extend(latLng);
                        }
                    });

                    if (!mapBounds.isEmpty()) {
                        map.fitBounds(mapBounds);
                    }

                    const cards = document.querySelectorAll('.officer-card');

                    cards.forEach((card, i) => {
                        card.addEventListener('mouseenter', () => {
                            if (markers[i]) {
                                // แพนไปที่หมุด
                                map.panTo(markers[i].getPosition());
                                map.setZoom(15);

                                // ปิด Info ทั้งหมดก่อน
                                infoWindows.forEach(iw => iw.close());

                                // เปิด Info ของเจ้าหน้าที่ที่ hover
                                infoWindows[i].open(map, markers[i]);

                                let btn_close = document.querySelector('.gm-style-iw-chr');
                                    btn_close.classList.add("d-none");
                            }
                        });

                        card.addEventListener('mouseleave', () => {
                            // ปิด InfoWindow เฉพาะของเจ้าหน้าที่คนนั้น
                            infoWindows[i].close();

                            // รอเล็กน้อยแล้วเช็คว่าไม่มี .officer-card ที่ hover อยู่
                            setTimeout(() => {
                                const isAnyHovered = Array.from(document.querySelectorAll('.officer-card:hover')).length > 0;
                                if (!isAnyHovered && !mapBounds.isEmpty()) {
                                    map.fitBounds(mapBounds);
                                }
                            }, 100);
                        });
                    });
                }
            });
    }

    function clearMarkers() {
        markers.forEach(marker => marker.setMap(null));
        markers = [];
        infoWindows.forEach(info => info.close());
        infoWindows = [];
    }


    const qrUrl = "{{ url('/officer_register_unit') }}/{{ $aims_operating_unit->id }}";

    // สร้าง QR Code
    const qrcode = new QRCode(document.getElementById("qrcode"), {
        text: qrUrl,
        width: 200,
        height: 200
    });

    // ฟังก์ชันดาวน์โหลด
    function downloadQR() {
        const qrCanvas = document.querySelector('#qrcode canvas');
        if (!qrCanvas) return;

        const imgData = qrCanvas.toDataURL("image/png");

        const link = document.createElement('a');
        link.href = imgData;
        link.download = 'qr_register_'+"{{ $aims_operating_unit->id }}"+'.png';
        link.click();
    }
</script>

@endsection

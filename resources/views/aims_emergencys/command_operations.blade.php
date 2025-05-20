@extends('layouts.partners.theme_partner_new')

@section('content')

<style>
    #map_operations {
        height: calc(80vh);
    }
</style>

<div class="row">
    <div class="col-3">
        <div class="card radius-10 border-top border-0 border-4 border-secondary">
            <div class="card-body p-3">
                <h5><b>ข้อมูลผู้ขอความช่วยเหลือ</b></h5>
            </div>
        </div>
    </div>
    <div class="col-9">
        <div class="card radius-10 border-top border-0 border-4 border-secondary">
            <div class="card-body p-3">
                <h5><b>รหัสปฏิบัติการ</b></h5>
                <h6>2505-0001-00003-0001</h6>
            </div>
        </div>
        <div class="card radius-10 border-top border-0 border-4 border-secondary">
            <div class="card-body p-3">
                <div id="map_operations">
                    
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBgrxXDgk1tgXngalZF3eWtcTWI-LPdeus&language=th"></script>

<script>

    document.addEventListener("DOMContentLoaded", function() {
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

</script>
        
@endsection

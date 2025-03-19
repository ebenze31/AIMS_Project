@extends('layouts.viicheck')
@section('content')

<a id="Ct_f5" class="d-none" href="JavaScript: location.reload(true);">Refresh page</a>
<input type="hidden" id="lat" name="lat" readonly>
<input type="hidden" id="lng" name="lng" readonly> 
<input type="hidden" id="latlng" name="latlng" readonly> 

<div class="container d-block d-md-none" style="margin-top:100px; ">
        <div class="row">
            <div class="col-12 main-shadow main-radius" style="margin-top:15px; margin-bottom:10px" id="map">
                <!-- <iframe src="https://www.google.com/maps/embed?pb=!1m14!1m12!1m3!1d4989368.068715823!2d100.32470292487557!3d14.23861745451566!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!5e0!3m2!1sth!2sth!4v1625474458473!5m2!1sth!2sth" width="100%" height="300" style="border:0;" allowfullscreen="" loading="lazy"></iframe> -->
            </div>
            <div class="col-12 card shadow p-3 mb-5 bg-body rounded" >
                <div class="row">
                    <div class="col-2">
                        <button class="btn-sos btn d-flex justify-content-center align-items-center" style="background-color: #E8F0FE;">
                            <i class="fas fa-map-marker-alt text-danger"></i>
                        </button>
                    </div>
                    <div class="col-10" >
                        <p style=" color:#B3B6B7" id="location_user"><span class="text-danger">กรุณาเปิดตำแหน่งที่ตั้ง</span></p>
                    </div>
                    <div class="col-2"></div>
                    <div class="col-10">
                        <a id="a_help" class="btn btn-warning btn-block shadow-box text-white d-none" data-toggle="modal" data-target="#staticBackdrop">
                            <i class="fas fa-bullhorn"></i> ขอความช่วยเหลือพื้นที่ <span id="area_help"></span>
                        </a>
                    </div> 
                </div>
            </div>
        
        <div class="col-12 card shadow p-3 mb-5 bg-body rounded d-none" style="margin-top:-35px">
            <div class="row" >
                <div class="col-3" >
                    <center>
                        <button class="btn-sos btn d-flex justify-content-center align-items-center" style="background-color: #188038;">
                        <i class="fas fa-gas-pump" style="color:white"></i>
                        </button>
                        <p style="font-size:11px; text-align: center; margin-top:10px;color:#B3B6B7; ">ปั๊มน้ำมัน</p>
                    </center>
                </div>
                <div class="col-3" >
                    <center>    
                        <button class="btn-sos btn d-flex justify-content-center align-items-center" style="background-color: #129EAF;">
                        <i class="fad fa-garage-open" style="color:white"></i>
                        </button>
                        <p style="font-size:11px; text-align: center; margin-top:10px;color:#B3B6B7; ">ศูนย์บริการรถยนต์</p>
                    </center>
                </div>
                <div class="col-3" >
                    <center>
                        <button class="btn-sos btn d-flex justify-content-center align-items-center" style="background-color: #C5221F;">
                        <i class="far fa-hospital" style="color:white"></i>
                        </button>
                        <p style="font-size:11px; text-align: center; margin-top:10px;color:#B3B6B7; ">โรงพยาบาล</p>
                    </center>
                </div>
                <div class="col-3" >
                    <center>
                        <button class="btn-sos btn d-flex justify-content-center align-items-center" style="background-color: #E37400;">
                        <i class="fad fa-siren-on" style="color:white"></i>
                        </button>
                        <p style="font-size:11px; text-align: center; margin-top:10px;color:#B3B6B7; ">สถานีตำรวจ</p>
                    </center>
                </div>
            </div>
        </div>

        <div class="col-12 card shadow" style="margin-top:-35px;">
            <div class="row">
                <div class="col-6">
                    <p style="font-size:15px; text-align: center; margin-top:10px; ">เหตุด่วนเหตุร้าย</p>
                    <a class="btn btn-danger btn-block shadow-box" href="tel:191" style="margin-top:-10px; background-color: #DB2D2E;"><i class="fas fa-phone-alt"></i> 191</a>
                </div>
                <div class="col-6">
                    <p style="font-size:15px; text-align: center; margin-top:10px; ">จ.ส.100</p>
                    <a class="btn btn-danger btn-block shadow-box" href="tel:1137" style="margin-top:-10px; background-color: #DB2D2E;"><i class="fas fa-phone-alt"></i> 1137</a>
                </div>
                <div class="col-6">
                    <p style="font-size:15px; text-align: center; margin-top:10px; ">หน่วยแพทย์กู้ชีวิต</p>
                    <a class="btn btn-danger btn-block shadow-box" href="tel:1669" style="margin-top:-10px; background-color: #DB2D2E;"><i class="fas fa-phone-alt"></i> 1669</a>
                </div>
                <div class="col-6 ">
                    <p style="font-size:15px; text-align: center; margin-top:10px; ">ป่อเต็กตึ๊ง</p>
                    <a class="btn btn-danger btn-block shadow-box" href="tel:1418" style="margin-top:-10px; background-color: #DB2D2E;"><i class="fas fa-phone-alt"></i> 1418</a>
                </div>
                <div class="col-6">
                    <p style="font-size:15px; text-align: center; margin-top:10px; ">สายด่วนทางหลวง</p>
                    <a class="btn btn-danger btn-block shadow-box" href="tel:1193" style="margin-top:-10px; background-color: #DB2D2E;"><i class="fas fa-phone-alt"></i> 1193</a>
                </div>
                <div class="col-6">
                    <p style="font-size:15px; text-align: center; margin-top:10px; ">ทนายอาสา</p>
                    <a class="btn btn-danger btn-block shadow-box" href="tel:1167" style="margin-top:-10px; background-color: #DB2D2E;"><i class="fas fa-phone-alt"></i> 1167</a>
                </div>

               
            </div> <br>
        </div>
        <!-- Button trigger modal -->
        <!-- <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#staticBackdrop">
          Launch static backdrop modal
        </button> -->

        <!-- Modal -->
        <div class="modal fade" id="staticBackdrop" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
          <div class="modal-dialog modal-dialog-centered ">
            <div class="modal-content">
            @if(!empty($user))
              <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">สวัสดีคุณ <b style="color:blue;">{{ $user->name }}</b></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body text-center">
                <img width="50%" src="{{ asset('/img/stickerline/PNG/7.png') }}">
                <br><br>
                โปรดยืนยันหมายเลขโทรศัพท์ของคุณ
                <br>
                <input style="margin-top:15px;" class="form-control text-center" type="phone" id="text_phone" value="@if(!empty($user->phone)){{ $user->phone }}@endif" readonly>
                @if(!empty($user->phone))
                    <!-- <span style="font-size:22px;" id="not_empty_phone">{{ $user->phone }}</span> -->
                    <input style="margin-top:15px;" class="form-control d-none text-center"  type="phone" id="input_phone" value="{{ $user->phone }}" placeholder="กรุณากรอกหมายเลขโทรศัพท์" pattern="[0-9]{9-10}" onchange="edit_phone();">
                @endif

                @if(empty($user->phone))
                    <input style="margin-top:15px;" class="form-control text-center"  type="phone" id="input_not_phone" value="" required placeholder="กรุณากรอกหมายเลขโทรศัพท์" pattern="[0-9]{9-10}" onchange="add_phone();">
                @endif
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-secondary" onclick="
                    document.querySelector('#input_phone').classList.remove('d-none'),
                    document.querySelector('#text_phone').classList.add('d-none');">
                    แก้ไข
                </button>

                <button type="button" class="btn btn-primary" onclick="confirm_phone();">ยืนยัน</button>
              </div>
            @endif
            </div>
          </div>
        </div>
    </div>
</div>
<br><br>
<script src="https://polyfill.io/v3/polyfill.min.js?features=default"></script>
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBgrxXDgk1tgXngalZF3eWtcTWI-LPdeus&language=th" ></script>
<style type="text/css">
    #map {
      height: calc(45vh);
    }
    
</style>
<!-- <script>
    document.addEventListener('DOMContentLoaded', (event) => {
        // console.log("START");
        getLocation();

        
    });

    function getLocation() {
      if (navigator.geolocation) {
        navigator.geolocation.getCurrentPosition(showPosition);
        navigator.geolocation.getCurrentPosition(initMap);
        // navigator.geolocation.getCurrentPosition(geocodeLatLng);
      } else { 
        x.innerHTML = "Geolocation is not supported by this browser.";
      }
    }

    function showPosition(position) {
        let lat_text = document.querySelector("#lat");
        let lng_text = document.querySelector("#lng");
        let latlng = document.querySelector("#latlng");

        lat_text.value = position.coords.latitude ;
        lng_text.value = position.coords.longitude ;
        latlng.value = position.coords.latitude+","+position.coords.longitude ;

        let lat = parseFloat(lat_text.value) ;
        let lng = parseFloat(lng_text.value) ;

            // console.log(lat);
            // console.log(lng);
        

        fetch("{{ url('/') }}/api/location/" + lat_text.value +"/"+lng_text.value+"/province")
                .then(response => response.json())
                .then(result => {
                    // console.log(result[0]);

                    let location_user = document.querySelector("#location_user");
                        location_user.innerHTML = 
                            "&nbsp;&nbsp;&nbsp;" + 
                            result[0]['tambon_th'] +
                            " "+ 
                            result[0]['amphoe_th'] +
                            " "+ 
                            result[0]['changwat_th'];
                               
                    
                });
    }

    // function initMap(position) {
    //     let lat_text = document.querySelector("#lat");
    //     let lng_text = document.querySelector("#lng");

    //     lat_text.value = position.coords.latitude ;
    //     lng_text.value = position.coords.longitude ;

    //     let lat = parseFloat(lat_text.value) ;
    //     let lng = parseFloat(lng_text.value) ;

    //     const map = new google.maps.Map(document.getElementById("map"), {
    //         zoom: 15,
    //         center: { lat: lat, lng: lng },
    //     });
    //     const geocoder = new google.maps.Geocoder();
    //     const infowindow = new google.maps.InfoWindow();
    //     document.getElementById("submit").addEventListener("click", () => {
    //         geocodeLatLng(geocoder, map, infowindow);
    //     });
    // }
    function initMap(position) {
        let lat_text = document.querySelector("#lat");
        let lng_text = document.querySelector("#lng");
        lat_text.value = position.coords.latitude ;
        lng_text.value = position.coords.longitude ;
        let lat = parseFloat(lat_text.value) ;
        let lng = parseFloat(lng_text.value) ;

      const cairo = { lat: lat, lng: lng };
      const map = new google.maps.Map(document.getElementById("map"), {
        center: cairo,
        zoom: 16,
        streetViewControl: false,
      });


      // ตำแหน่ง USER
      const user = { lat: lat, lng: lng };
      const infowindow_user = new google.maps.InfoWindow();
        infowindow_user.setContent("ตำแหน่งของคุณ");

      const marker_user = new google.maps.Marker({ map, position: user });
      marker_user.addListener("click", () => {
            infowindow_user.open(map, marker_user);
          });

      // END ตำแหน่ง USER

      // พื้นที่ VRU 
      const vru_a = { lat: 14.1357294, lng: 100.6054468 };
      const vru_b = { lat: 14.1357294, lng: 100.6179993 };

      const vru_c = { lat: 14.1319187, lng: 100.6054468 };
      const vru_d = { lat: 14.1319187, lng: 100.6179993 };

      const marker_vru_a = new google.maps.Marker({ map, position: vru_a });
      const marker_vru_b = new google.maps.Marker({ map, position: vru_b });
      const marker_vru_c = new google.maps.Marker({ map, position: vru_c });
      const marker_vru_d = new google.maps.Marker({ map, position: vru_d });
      // END พื้นที่ VRU 

      const geocoder = new google.maps.Geocoder();
      const infowindow = new google.maps.InfoWindow();
      document.getElementById("submit").addEventListener("click", () => {
        geocodeLatLng(geocoder, map, infowindow);
      });
    }

</script> -->
<script>
    document.addEventListener('DOMContentLoaded', (event) => {
        // console.log("START");
        getLocation();
    });

    function getLocation() {
      if (navigator.geolocation) {
        navigator.geolocation.getCurrentPosition(showPosition);
        navigator.geolocation.getCurrentPosition(initMap);
        // navigator.geolocation.getCurrentPosition(geocodeLatLng);
      } else { 
        x.innerHTML = "Geolocation is not supported by this browser.";
      }
    }

    function showPosition(position) {
        let lat_text = document.querySelector("#lat");
        let lng_text = document.querySelector("#lng");
        let latlng = document.querySelector("#latlng");

        lat_text.value = position.coords.latitude ;
        lng_text.value = position.coords.longitude ;
        latlng.value = position.coords.latitude+","+position.coords.longitude ;

        let lat = parseFloat(lat_text.value) ;
        let lng = parseFloat(lng_text.value) ;

        // console.log(lat);
        // console.log(lng);

        let location_user = document.querySelector("#location_user");
            location_user.innerHTML = '<a class="btn-block shadow-box text-white btn btn-primary" id="submit"><i class="fas fa-search-location"></i> ตำแหน่งของฉัน</a>';

        // // พื้นที่ ทดสอบ
        //     const test_a = { lat: 14.1150621, lng: 100.6013697 };
        //     const test_b = { lat: 14.1150621, lng: 100.6074465 };

        //     const test_c = { lat: 14.1127626, lng: 100.6013697 };
        //     const test_d = { lat: 14.1127626, lng: 100.6074465 };
        // // END พื้นที่ ทดสอบ

        // // พื้นที่ VRU 
        //     const vru_a = { lat: 14.1357294, lng: 100.6054468 };
        //     const vru_b = { lat: 14.1357294, lng: 100.6179993 };

        //     const vru_c = { lat: 14.1319187, lng: 100.6054468 };
        //     const vru_d = { lat: 14.1319187, lng: 100.6179993 };
        // // END พื้นที่ VRU

        // ตรวจสอบว่าอยู่ในพื้นที่บริการไหน

        if (lat < 14.1150621 && lat > 14.1127626 && lng > 100.6013697 && lng < 100.6074465) {
            // พื้นที่ทดสอบ
            document.querySelector('#a_help').classList.remove('d-none');
            let area_help = document.querySelector("#area_help");
                area_help.innerHTML = "ทดสอบ"
        } else if (lat < 14.1357294 && lat > 14.1319187 && lng > 100.6054468 && lng < 100.6179993) {
            // VRU
            document.querySelector('#a_help').classList.remove('d-none');
            let area_help = document.querySelector("#area_help");
                area_help.innerHTML = "VRU"
        }
        
        // END ตรวจสอบว่าอยู่ในพื้นที่บริการไหน
    }

    function initMap(position) {
        let lat_text = document.querySelector("#lat");
        let lng_text = document.querySelector("#lng");
        let latlng = document.querySelector("#latlng");

        lat_text.value = position.coords.latitude ;
        lng_text.value = position.coords.longitude ;
        latlng.value = position.coords.latitude+","+position.coords.longitude ;
        let lat = parseFloat(lat_text.value) ;
        let lng = parseFloat(lng_text.value) ;

        const map = new google.maps.Map(document.getElementById("map"), {
            zoom: 15,
            center: { lat: lat, lng: lng },
        });

        // ตำแหน่ง USER
            const user = { lat: lat, lng: lng };
            const marker_user = new google.maps.Marker({ map, position: user });

        // // พื้นที่ ทดสอบ 
        //     const test_a = { lat: 14.1150621, lng: 100.6013697 };
        //     const test_b = { lat: 14.1150621, lng: 100.6074465 };

        //     const test_c = { lat: 14.1127626, lng: 100.6013697 };
        //     const test_d = { lat: 14.1127626, lng: 100.6074465 };

        //     const marker_test_a = new google.maps.Marker({ map, position: test_a });
        //     const marker_test_b = new google.maps.Marker({ map, position: test_b });
        //     const marker_test_c = new google.maps.Marker({ map, position: test_c });
        //     const marker_test_d = new google.maps.Marker({ map, position: test_d });

        // // END พื้นที่ ทดสอบ

        // // พื้นที่ VRU 
        //     const vru_a = { lat: 14.1357294, lng: 100.6054468 };
        //     const vru_b = { lat: 14.1357294, lng: 100.6179993 };

        //     const vru_c = { lat: 14.1319187, lng: 100.6054468 };
        //     const vru_d = { lat: 14.1319187, lng: 100.6179993 };

        //     const marker_vru_a = new google.maps.Marker({ map, position: vru_a });
        //     const marker_vru_b = new google.maps.Marker({ map, position: vru_b });
        //     const marker_vru_c = new google.maps.Marker({ map, position: vru_c });
        //     const marker_vru_d = new google.maps.Marker({ map, position: vru_d });
        // // END พื้นที่ VRU 

        const geocoder = new google.maps.Geocoder();
        const infowindow = new google.maps.InfoWindow();

        document.getElementById("submit").addEventListener("click", () => {
            geocodeLatLng(geocoder, map, infowindow);
        });

        marker_user.addListener("click", () => {
            geocodeLatLng(geocoder, map, infowindow);
        });
    }

    function geocodeLatLng(geocoder, map, infowindow) {
        const input = document.getElementById("latlng").value;
        const latlngStr = input.split(",", 2);
        const latlng = {
            lat: parseFloat(latlngStr[0]),
            lng: parseFloat(latlngStr[1]),
        };
        geocoder
            .geocode({ location: latlng })
            .then((response) => {
                if (response.results[0]) {
                    map.setZoom(15);
                    const marker = new google.maps.Marker({
                      position: latlng,
                      map: map,
                    });
                    infowindow.setContent(response.results[0].formatted_address);
                    infowindow.open(map, marker);

                    let location_user = document.querySelector("#location_user");
                        location_user.innerHTML = response.results[0].formatted_address;
                } else {
                    window.alert("No results found");
                }
            })
            .catch((e) => window.alert("Geocoder failed due to: " + e));
        }

    // function confirm_phone() {
    //     let text_phone = document.querySelector("#text_phone");
    //     let lat_text = document.querySelector("#lat");
    //     let lng_text = document.querySelector("#lng");
    //     let area_help = document.querySelector("#area_help");

    //         console.log(area_help.innerHTML);
    //         console.log(lat_text.value);
    //         console.log(lng_text.value);
    //         console.log(text_phone.value);

    //     // fetch("{{ url('/') }}/api/send_sos/" + lat_text.value + "/" + lng_text.value + "/" + text_phone + "/" area_help)
    //     //     .then(response => response.json())
    //     //     .then(result => {
    //     //         console.log(result);
    //     //     });

    // }

    function edit_phone() {
        let text_phone = document.querySelector("#text_phone");
        let input_phone = document.querySelector("#input_phone");
            text_phone.value = input_phone.value ;
            // console.log(text_phone.innerHTML);
    }

    function add_phone() {
        let text_phone = document.querySelector("#text_phone");
        let input_not_phone = document.querySelector("#input_not_phone");
            text_phone.value = input_not_phone.value ;
            // console.log(text_phone.innerHTML);
    }

</script>

@endsection
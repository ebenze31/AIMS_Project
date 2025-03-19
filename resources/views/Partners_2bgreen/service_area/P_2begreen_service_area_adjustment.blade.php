@extends('layouts.partners.theme_partner')

@section('content')
<style type="text/css">
    #map {
      height: calc(80vh);
    }
    
</style>
<br>
<div class="container-fluid">
    <div class="row">
        <div class="col-8">
            <div class="row">
                <div class="col-12">
                    <a id="btn_service_current" href="{{ url('/service_current') }}" type="button" class="btn btn-primary text-white">พื้นที่ปัจจุบัน</a>
                    <a id="btn_service_pending" href="{{ url('/service_pending') }}" type="button" class="btn btn-warning text-white">รอการตรวจสอบ</a>
                    <a id="btn_service_area" href="{{ url('/service_area') }}" type="button" class="btn btn-secondary text-white">ปรับพื้นที่บริการ</a>
                    <div class="float-right" style="margin-left: 20px;">
                        <select id="select_district" class="form-control" onchange="zoom_district();">
                            <option>- ตำบล -</option>
                        </select>
                    </div>
                    <div class="float-right" style="margin-left: 20px;">
                        <select id="select_amphoe" class="form-control" onchange="show_district();">
                            <option>- อำเภอ -</option>
                        </select>
                    </div>
                    <div class="float-right" style="margin-left: 20px;">
                        <select id="select_province" class="form-control" onchange="show_amphoe();">
                            <option value="" selected > - กรุณาเลือกจังหวัด - </option> 
                            @foreach($location_array as $lo)
                            <option 
                            value="{{ $lo->changwat_th }}" 
                            {{ request('changwat_th') == $lo->changwat_th ? 'selected' : ''   }} >
                            @php
                                $text_changwat_th = str_replace("จ.","","$lo->changwat_th");
                            @endphp
                            {{ $text_changwat_th }} 
                            </option>
                            @endforeach    
                        </select>
                    </div>
                    <br><br>
                    <input class="d-none" type="text" id="va_zoom" name="" value="6">
                    <input class="d-none" type="text" id="center_lat" name="" value="13.7248936">
                    <input class="d-none" type="text" id="center_lng" name="" value="100.4930264">
                    <div class="card">
                        <div id="map"></div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-4">
            <div class="row">
                <div class="col-md-12">
                    <br><br><br>
                    <div class="card">
                        <h3 class="card-header">
                            ปรับพื้นที่บริการ
                            <a id="btn_re" href="{{ url('/service_area') }}" class="btn btn-sm btn-info float-right d-none">
                                เริ่มใหม่
                            </a>
                        </h3>
                        <div class="container">
                            <div class="row">
                                <div class="col-12" id="div_lat_lng">
                                    <div id="div_form_{{ $count_position }}" class="form-group">
                                        <label class="control-label">จุดที่ {{ $count_position }}</label>
                                        <input class="form-control" name="position_{{ $count_position }}" type="text" id="position_{{ $count_position }}" value="" placeholder="คลิกที่แผนที่เพื่อรับโลเคชั่น">
                                    </div>
                                </div>

                                <div class="col-6">
                                    <input class="form-control" name="count_position" type="hidden" id="count_position" value="{{ $count_position }}">
                                    <br>
                                    <input class="form-control" type="hidden" name="name_partner" id="name_partner" value="{{ Auth::user()->organization }}">
                                </div>
                                <div class="col-6">
                                    <textarea class="form-control d-none" name="area_arr"  id="area_arr" value="" rows="10"></textarea>
                                </div>
                                <div class="col-6">
                                    <button id="btn_delete_form" class="btn btn-sm btn-warning d-none" onclick="delete_input();">
                                        แก้ไขจุดก่อนหน้า
                                    </button>
                                </div>
                                <div class="col-6">
                                    <button id="btn_send_sos_area" class="btn btn-sm btn-primary float-right d-none" onclick="send_sos_area();">
                                        ส่งข้อมูล
                                    </button>
                                </div>
                            </div>
                            <br>
                            <!-- Button trigger modal -->
                            <button id="btn_modal_send_area" type="button" class="btn btn-primary d-none" data-toggle="modal" data-target="#modal_send_area"></button>

                            <!-- Modal -->
                            <div class="modal fade" id="modal_send_area" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                              <div class="modal-dialog">
                                <div class="modal-content">
                                  <div class="modal-header">
                                    <!-- <h5 class="modal-title" id="exampleModalLabel">Modal title</h5> -->
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close" onclick="document.querySelector('#btn_service_pending').click();">
                                      <span aria-hidden="true">&times;</span>
                                    </button>
                                  </div>
                                  <div class="modal-body">
                                    ViiCheck ได้รับข้อมูลการเปลี่ยนแปลงพื้นที่ของคุณแล้ว กรุณารอ Admin ตรวจสอบ
                                  </div>
                                  <div class="modal-footer d-none">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                    <button type="button" class="btn btn-primary">Save changes</button>
                                  </div>
                                </div>
                              </div>
                            </div>
                        </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://polyfill.io/v3/polyfill.min.js?features=default"></script>
<!-- <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBgrxXDgk1tgXngalZF3eWtcTWI-LPdeus"></script> -->
<script
      src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBgrxXDgk1tgXngalZF3eWtcTWI-LPdeus&callback=initMap&v=weekly"
      async
    ></script>

<script>

    var draw_area ;
    var markers = [] ;
    var map ;
    var area = [] ;
    var marker ; 

    function initMap() {
        
        let text_zoom = document.getElementById("va_zoom").value;
        let num_zoom = parseFloat(text_zoom);

        let text_center_lat = document.getElementById("center_lat").value;
        let num_center_lat = parseFloat(text_center_lat);

        let text_center_lng = document.getElementById("center_lng").value;
        let num_center_lng = parseFloat(text_center_lng);

        let count_position = document.querySelector('#count_position');

        // 13.7248936,100.4930264 lat lng ประเทศไทย

        const myLatlng = { lat: num_center_lat, lng: num_center_lng };

        map = new google.maps.Map(document.getElementById("map"), {
            zoom: num_zoom,
            center: myLatlng,
        });
        // Create the initial InfoWindow.
        let infoWindow = new google.maps.InfoWindow({
            // content: "คลิกที่แผนที่เพื่อรับโลเคชั่น",
            // position: myLatlng,
        });

        infoWindow.open(map);
        // Configure the click listener.
        map.addListener("click", (mapsMouseEvent) => {
            // Close the current InfoWindow.
            infoWindow.close();
            // Create a new InfoWindow.
            infoWindow = new google.maps.InfoWindow({
                // position: mapsMouseEvent.latLng,
            });

            infoWindow.setContent(
                JSON.stringify(mapsMouseEvent.latLng.toJSON(), null, 2)
            );

            let text_content = infoWindow.content ;
            

            // console.log(text_content)

            const contentArr = text_content.split(",");

            const lat_Arr = contentArr[0].split(":");

                let marker_lat = lat_Arr[1];

            const lng_Arr = contentArr[1].split(":");

                let marker_lng = lng_Arr[1].replace("\n}", "");

            // console.log(marker_lat)
            // console.log(marker_lng)
            
            addMarker(count_position , marker_lat , marker_lng);

            infoWindow.open(map);

            add_location(text_content, count_position.value, map , marker_lat , marker_lng)
        });
        
    }

    function addMarker(count_position , marker_lat , marker_lng) {
        const image = "https://www.viicheck.com/img/icon/flag_2.png";

        map_maeker = {
            position: {lat: parseFloat(marker_lat) , lng: parseFloat(marker_lng) },
            label: {text: count_position.value, color: "white"},
            map: map,
            icon: image,
        };

        marker = new google.maps.Marker(map_maeker);

        markers.push(map_maeker);
    }

    function add_location(text_content , count_position , map , marker_lat , marker_lng) {

        let co_position = document.querySelector('#count_position');

        let add_count = parseFloat(co_position.value) + 1 ;

        let div_lat_lng = document.querySelector('#div_lat_lng');

        let position = document.querySelector('#position_' + count_position);
            position.value = '{"lat": ' + parseFloat(marker_lat) + ', "lng": ' + parseFloat(marker_lng)+ ' }';

        area = [];
        for (let i = 1; i <= parseFloat(count_position); i++) {

            let all_position = document.querySelector('#position_' + i).value ;
            area.push( JSON.parse(all_position) ) ;
        }

        // เคลีย Polygon map
        if (draw_area) {
            draw_area.setMap(null);
        }

        // Construct the polygon.
        draw_area = new google.maps.Polygon({
            paths: area,
            strokeColor: "#008450",
            strokeOpacity: 0.8,
            strokeWeight: 1,
            fillColor: "#008450",
            fillOpacity: 0.25,
        });
        draw_area.setMap(map);

        let area_arr = document.querySelector('#area_arr');
            area_arr.value = JSON.stringify(area) ;

        // add input position

        if (parseFloat(add_count) > 6) {

            document.querySelector('#div_form_'+co_position.value).classList.add('d-none');

            let count_para = parseFloat(co_position.value) - 1;

            if (count_para >= 6) {
                document.querySelector('#para_'+count_para).classList.add('d-none');
            }

            let para = document.createElement("p");
                para.innerHTML = " ... " ;

            let para_id = document.createAttribute("id");
                para_id.value = "para_" +co_position.value;

            let para_class = document.createAttribute("class");
                para_class.value = "";
             
            para.setAttributeNode(para_id); 
            para.setAttributeNode(para_class); 

            div_lat_lng.appendChild(para);

        }

        // div_form
        let div_form = document.createElement("div");

        let div_class_form = document.createAttribute("class");
            div_class_form.value = "form-group";

        let div_id_form = document.createAttribute("id");
            div_id_form.value = "div_form_" + add_count;
            
            div_form.setAttributeNode(div_class_form); 
            div_form.setAttributeNode(div_id_form); 

        // label
        let label = document.createElement("label");
            let label_class = document.createAttribute("class");
            label_class.value = "control-label";
            label.innerHTML = "จุดที่ " + add_count;
            label.setAttributeNode(label_class);

        // input
        let input = document.createElement("input");
            let input_class = document.createAttribute("class");
            input_class.value = "form-control";

            let input_name = document.createAttribute("name");
            input_name.value = "position_" + add_count;

            let input_type = document.createAttribute("type");
            input_type.value = "text";

            let input_id = document.createAttribute("id");
            input_id.value = "position_" + add_count;

            let input_value = document.createAttribute("value");
            input_value.value = "";

            let input_placeholder = document.createAttribute("placeholder");
            input_placeholder.value = "คลิกที่แผนที่เพื่อรับโลเคชั่น";

            input.setAttributeNode(input_class); 
            input.setAttributeNode(input_name); 
            input.setAttributeNode(input_type); 
            input.setAttributeNode(input_id); 
            input.setAttributeNode(input_value); 
            input.setAttributeNode(input_placeholder); 

        div_form.appendChild(label);
        div_form.appendChild(input);

        div_lat_lng.appendChild(div_form);

        document.querySelector('#btn_delete_form').classList.remove('d-none');
        document.querySelector('#btn_send_sos_area').classList.remove('d-none');
        document.querySelector('#btn_re').classList.remove('d-none');

        co_position.value = add_count ;

    }

    function delete_input() {

        let count_position = document.querySelector('#count_position');
            // console.log(count_position.value);


        document.querySelector('#div_form_' + count_position.value).remove();

        let count_delete = parseFloat(count_position.value) - 1 ;

        if (count_delete >= 6) {

            document.querySelector('#para_'+count_delete).remove();
        }

        document.querySelector('#position_' + count_delete).value = "";
        document.querySelector('#count_position').value = count_delete;

            // console.log(area);
            // console.log(markers);

        let last_arr_area = area.length - 1 ;
        let last_arr_markers = markers.length - 1 ;

        area.splice(last_arr_area);

        marker.setMap(null);

        // console.log(marker);
        // console.log(markers[0]);

        // for (let ii = 0; ii < markers.length; ii++) {

        //     let new_lat = markers[ii]['position']['lat'];
        //     let new_lng = markers[ii]['position']['lng'];

        //     console.log(new_lat);
        //     console.log(new_lng);


        //     // marker = new google.maps.Marker(markers);
        // }
        // console.log("-----------------");
        // markers.splice(last_arr_markers);
        // console.log(markers);

        

        let area_arr = document.querySelector('#area_arr');
            area_arr.value = JSON.stringify(area) ;

        // เคลีย Polygon map
        if (draw_area) {
            draw_area.setMap(null);
        }

        // Construct the polygon.
        draw_area = new google.maps.Polygon({
            paths: area,
            strokeColor: "#008450",
            strokeOpacity: 0.8,
            strokeWeight: 1,
            fillColor: "#008450",
            fillOpacity: 0.25,
        });
        draw_area.setMap(map);

        // console.log(area);

        // document.querySelector('#btn_delete_form').classList.add('d-none');

        if (count_delete === 1) {
            document.querySelector('#btn_delete_form').classList.add('d-none');
        }

    }

    function send_sos_area() {

        let area_arr = document.querySelector('#area_arr').value;

        let name_partner = document.querySelector('#name_partner').value;


        fetch("{{ url('/') }}/api/send_sos_area/"+area_arr+"/"+name_partner);

        document.querySelector('#btn_modal_send_area').click();

        var delayInMilliseconds = 3500; //3.5 second

        setTimeout(function() {
                document.querySelector('#btn_service_pending').click();
        }, delayInMilliseconds);

    }

    function show_amphoe(){
        let select_district = document.querySelector("#select_district");
            select_district.innerHTML = "";

        let option_district = document.createElement("option");
            option_district.text = "- ตำบล -";
            option_district.value = "- ตำบล -";
            select_district.add(option_district);

        let select_province = document.querySelector('#select_province');
        //PARAMETERS
        fetch("{{ url('/') }}/api/show_amphoe/"+select_province.value)
            .then(response => response.json())
            .then(result => {
                // console.log(result);
                //UPDATE SELECT OPTION
                let select_amphoe = document.querySelector("#select_amphoe");
                    select_amphoe.innerHTML = "";

                    for (let co_am = 0; co_am < result.length; co_am++) {

                        let name_province = select_province.value.replace("จ.", "");

                        if (result[co_am]['amphoe_th'] == "อ.เมือง"+name_province || result[co_am]['amphoe_th'] == "เขตราชเทวี" || result[co_am]['amphoe_th'] == "อ."+name_province) {

                            document.getElementById("va_zoom").value = "11";

                            document.getElementById("center_lat").value = result[co_am]['lat'];

                            document.getElementById("center_lng").value = result[co_am]['lng'];
                        }
                    }

                let option_1 = document.createElement("option");
                    option_1.text = "- อำเภอ -";
                    option_1.value = "- อำเภอ -";
                    select_amphoe.add(option_1);

                for(let item of result){
                    let option = document.createElement("option");
                    option.text = item.amphoe_th.replace("อ.", "");
                    option.value = item.amphoe_th;
                    select_amphoe.add(option);
                }

                initMap();
            });
    }

    function show_district(){
        let select_amphoe = document.querySelector('#select_amphoe');
        //PARAMETERS
        fetch("{{ url('/') }}/api/show_district/"+select_amphoe.value)
            .then(response => response.json())
            .then(result => {
                // console.log(result);
                //UPDATE SELECT OPTION
                let select_district = document.querySelector("#select_district");
                    select_district.innerHTML = "";
                    let total_lat_di = 0 ;
                    let total_lng_di = 0 ;
                    for (let co_di = 0; co_di < result.length; co_di++) {

                        total_lat_di = total_lat_di + parseFloat(result[co_di]['lat'])
                        total_lng_di = total_lng_di + parseFloat(result[co_di]['lng'])
        
                    }

                    let center_am_lat = total_lat_di / result.length ;
                    let center_am_lng = total_lng_di / result.length ;

                    document.getElementById("va_zoom").value = "12";

                    document.getElementById("center_lat").value = center_am_lat;

                    document.getElementById("center_lng").value = center_am_lng;


                let option_1 = document.createElement("option");
                    option_1.text = "- ตำบล -";
                    option_1.value = "- ตำบล -";
                    select_district.add(option_1);

                for(let item of result){
                    let option = document.createElement("option");
                    option.text = item.tambon_th.replace("ต.", "");
                    option.value = item.tambon_th;
                    select_district.add(option);
                }

                initMap();

            });
    }

    function zoom_district() {
        let select_district = document.querySelector('#select_district');
            // console.log(select_district.value);

        fetch("{{ url('/') }}/api/zoom_district/"+select_district.value)
            .then(response => response.json())
            .then(result => {
                // console.log(result);
                //UPDATE SELECT OPTION

                document.getElementById("va_zoom").value = "13";

                document.getElementById("center_lat").value = result[0]['lat'];

                document.getElementById("center_lng").value = result[0]['lng'];

                initMap();

            });

    }
</script>

@endsection

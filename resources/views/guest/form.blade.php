<div class="container">
    <div class="row">
        <!-- ข้อมูลรถที่ต้องการติดต่อ -->
        <div class="col-12">
            <div class="row">
                <div class="col-12 col-md-2">
                    <label for="massengbox" class="control-label">{{ 'ข้อความ' }}</label></label><span style="color: #FF0033;"> *</span>
                </div>
                <div class="col-12 col-md-4">
                    <div class="form-group {{ $errors->has('massengbox') ? 'has-error' : ''}}">
                        <select name="massengbox" class="form-control"  id="massengbox" required onchange="if(this.value=='6'){ 
                                document.querySelector('#masseng_label').classList.remove('d-none'),
                                document.querySelector('#masseng_input').classList.remove('d-none'),
                                document.querySelector('#masseng').focus();
                            }else{ 
                                document.querySelector('#masseng_label').classList.add('d-none'),
                                document.querySelector('#masseng_input').classList.add('d-none')
                            }
                            if (this.value=='4') {
                                document.querySelector('#photo_label').classList.remove('d-none'),
                                document.querySelector('#photo_input').classList.remove('d-none'),
                                add_required_photo(),
                                document.querySelector('#photo').focus();
                            }else{ 
                                document.querySelector('#photo_label').classList.add('d-none'),
                                document.querySelector('#photo_input').classList.add('d-none'),
                                remove_required_photo();
                            }
                            if (this.value=='5') {
                                document.querySelector('#report_drivingd_detail_label').classList.remove('d-none'),
                                document.querySelector('#report_drivingd_detail_input').classList.remove('d-none'),
                                remove_required_photo(),
                                document.querySelector('#report_drivingd_detail').focus();
                            }else{ 
                                document.querySelector('#report_drivingd_detail_label').classList.add('d-none'),
                                document.querySelector('#report_drivingd_detail_input').classList.add('d-none')
                            }">
                             <option value="" selected >
                                 - เลือกข้อความ - 
                             </option>  
                        @foreach (json_decode('{
                        "1":"กรุณาเลื่อนรถด้วยค่ะ",
                        "2":"รถคุณเปิดไฟค้างไว้ค่ะ",
                        "3":"มีเด็กอยู่ในรถค่ะ",
                        "4":"รถคุณเกิดอุบัติเหตุค่ะ",
                        "5":"แจ้งปัญหาการขับขี่"}',
                         true) as $optionKey => $optionValue)
                            <option value="{{ $optionKey }}"  {{ (isset($guest->massengbox) && $guest->massengbox == $optionKey) ? 'selected' : ''}}>{{ $optionValue }}</option>
                        @endforeach
                    </select>
                        {!! $errors->first('massengbox', '<p class="help-block">:message</p>') !!}
                    </div>
                </div>
                
                <div class="col-12 col-md-2">
                    <!-- ข้อความอื่นๆ -->
                    <label id="masseng_label" for="masseng" class="d-none control-label">{{ 'ข้อความอื่นๆ' }}</label>
                    <!-- รูปภาพ -->
                    <label id="photo_label" for="photo" class="d-none control-label">{{ 'รูปภาพ' }}</label>
                    <!-- รายละเอียดปัญหาการขับขี่ -->
                    <label id="report_drivingd_detail_label" for="photo" class="d-none control-label">{{ 'ปัญหาการขับขี่' }}</label>
                </div>
                <div class="col-12 col-md-4">
                    <!-- ข้อความอื่นๆ -->
                    <div id="masseng_input" class="d-none form-group {{ $errors->has('masseng') ? 'has-error' : ''}}">
                        <input class="form-control" name="masseng" type="text" id="masseng" value="{{ isset($guest->masseng) ? $guest->masseng : ''}}">
                        {!! $errors->first('masseng', '<p class="help-block">:message</p>') !!}
                    </div>
                    <!-- รูปภาพ -->
                    <div id="photo_input" class="d-none form-group {{ $errors->has('photo') ? 'has-error' : ''}}">
                        <input class="form-control" name="photo" type="file" id="photo" value="{{ isset($guest->photo) ? $guest->photo : ''}}" accept="image/*" multiple="multiple">
                        {!! $errors->first('photo', '<p class="help-block">:message</p>') !!}
                    </div>
                    <!-- รายละเอียดปัญหาการขับขี่ -->
                    <div id="report_drivingd_detail_input" class="d-none form-group {{ $errors->has('report_drivingd_detail') ? 'has-error' : ''}}">
                        <select name="report_drivingd_detail" class="form-control"  id="report_drivingd_detail">
                            <option value="">- เลือกเหตุผล -</option>
                            @foreach (json_decode('{
                            "ขับรถอันตราย":"ขับรถอันตราย",
                            "ไม่เปิดไฟเลี้ยว":"ไม่เปิดไฟเลี้ยว",
                            "หยุดรถกะทันหัน":"หยุดรถกะทันหัน",
                            "เล่นโทรศัพท์ขณะขับขี่":"เล่นโทรศัพท์ขณะขับขี่",
                            "จอดตรงที่ห้ามจอด":"จอดตรงที่ห้ามจอด"}',
                             true) as $optionKey => $optionValue)
                            <option value="{{ $optionKey }}"  {{ (isset($guest->report_drivingd_detail) && $guest->report_drivingd_detail == $optionKey) ? 'selected' : ''}}>{{ $optionValue }}</option>
                        @endforeach
                    </select>
                        {!! $errors->first('report_drivingd_detail', '<p class="help-block">:message</p>') !!}
                    </div>
                </div>

                <!-- ถ่ายภาพป้ายทะเบียน -->
                <div id="div_photo_registration" class="d-none">
                    <div class="d-block d-md-none">
                        <div class="col-12">
                            <div id="div_btn_click_frame" class="row">
                                <div class="col-12">
                                    <div style="float: right;">
                                        <p id="btn_click_frame_car" class="btn btn-primary btn-sm" onclick="frame_car();">
                                            <i class="fas fa-car-side"></i>
                                        </p>
                                        <p id="btn_click_frame_motor" class="btn btn-outline-success btn-sm" onclick="frame_motor();">
                                            <i class="fas fa-motorcycle"></i>
                                        </p>
                                    </div>
                                    <br><br>
                                </div>
                            </div>
                            <div id="container">
                                <div class="row">
                                    <div class="col-12">
                                        <div class="d-flex justify-content-end bg-light"> 
                                            <a style="position: absolute; z-index:10; margin-right:10px" class="text-white" onclick="stop();"> <i class="fas fa-times"></i></a>
                                        </div>
                                    </div>
                                    <div class="col-12" id="div_cam">
                                        <div class="d-flex justify-content-center bg-light"> 
                                            <p style="position: absolute"class="text-white">สแกนป้ายทะเบียน</p>
                                            <p style="position: absolute; margin-top:6%"class="text-white">กรุณาวางป้ายทะเบียนให้ตรงกรอบ</p>
                                           
                                            <video width="100%" height="100%" autoplay="true" id="videoElement"></video>

                                            <img id="img_frame_car" class="align-self-center" style="position: absolute;margin-top: -100px;" width="80%" height="30%" src="{{ asset('/img/icon/15.png') }}">

                                            <img id="img_frame_motor" class="align-self-center d-none" style="position: absolute;margin-top: -100px;" width="60%" height="50%" src="{{ asset('/img/icon/15.1.png') }}">

                                            <input type="hidden" name="type_reg" id="type_reg" value="car">

                                            <ul class="ul-dot align-self-center" style=" position: absolute;margin-top: 130px;padding-right: 20px;padding-left: 25px;">
                                               <span style="color:#ffff;">ข้อแนะนำ  </span> 
                                                <li class="li-dot">หลีกเลี่ยงแสงสะท้อน ไม่มืดหรือสว่างเกินไป</li>
                                                <li class="li-dot">รูปไม่เบลอ เห็นตัวอักษรชัดเจน</li>
                                            </ul>
                                            <a class="align-self-end text-white btn-primary btn-circle" style="position: absolute; margin-bottom:10px" onclick="capture();"><i class="fas fa-camera"></i></a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <div class="col-12">
                            <input type="hidden" name="" id="text_img">
                            <!-- CAR -->
                            <div id="show_img_car" class="d-none">
                                <canvas class="d-none"  id="canvas" width="250" height="100"></canvas>
                                <img class="d-none" src="" width="250" height="100" id="photo2">
                            </div>
                            
                            <!-- MOTOR -->
                            <div id="show_img_motor" class="d-none">
                                <canvas class="d-none"  id="canvas_motor" width="225" height="225"></canvas>
                                <center>
                                    <img class="d-none" src="" width="225" height="225" id="photo_motor">
                                </center>
                            </div>
                            <br>
                            <div id="div_spinner" class="d-none">
                                <div class="spinner-border text-success"></div> 
                                <span class="text-success">&nbsp;&nbsp;กำลังตรวจสอบ..</span>
                                <br>
                                <span style="font-size:12px;color:#f26363;">หากรอนานกรุณาลองใหม่อีกครั้ง</span>
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- สิ้นสุดถ่ายภาพป้ายทะเบียน -->

                <div class="col-12 col-md-2">
                    <label for="registration" class="control-label">{{ 'ทะเบียนรถ' }}</label><span style="color: #FF0033;"> *</span>
                </div>
                <br>
                <div class="col-12 col-md-4">
                  <label class="sr-only translate" for="inlineFormInputGroupUsername">Ex. กก9999</label>
                  <div class="input-group">
                    <input class="form-control notranslate" name="registration" type="text" id="registration" value="{{ isset($guest->registration) ? $guest->registration : ''}}" placeholder="Ex. ABC 1234" required onchange="check_registration()">
                        
                        {!! $errors->first('registration', '<p class="help-block">:message</p>') !!}
                    
                    <div id="orc_camera" class="input-group-prepend" onclick="capture_registration();">
                      <div class="input-group-text d-block d-md-none"><a href="#div_rgc"><i class="fas fa-camera"></i></a></div>
                    </div>
                  </div>
                </div>
                <br><br>
                <div class="col-12 col-md-2">
                    <label for="county" class="control-label">{{ 'จังหวัดของทะเบียนรถ' }}</label><span style="color: #FF0033;"> *</span>
                </div>
                <div class="col-12 col-md-4">
                    <div class="form-group {{ $errors->has('county') ? 'has-error' : ''}}">
                        <select name="county" id="county" class="form-control notranslate" required onchange="add_reg_id();">
                                <option class="translate" value="" selected > - กรุณาเลือกจังหวัด - </option> 
                                <!-- @foreach($location_array as $lo)
                                <option 
                                value="{{ $lo->province }}" 
                                {{ request('location') == $lo->province ? 'selected' : ''   }} >
                                {{ $lo->province }} 
                                </option>
                                @endforeach    -->                                  
                        </select>
                        {!! $errors->first('county', '<p class="help-block">:message</p>') !!}
                    </div>
                </div>
            </div>

            <div class="d-none form-group {{ $errors->has('brand') ? 'has-error' : ''}}">
                <label for="brand" class="control-label">{{ 'brand' }}</label>
                <input class="form-control" name="brand" type="text" id="brand" value="{{ isset($guest->brand) ? $guest->brand : ''}}" >
                {!! $errors->first('brand', '<p class="help-block">:message</p>') !!}
            </div>
        </div>
        <!-- ข้อมูลผู้ติดต่อ -->
        <div class="col-12">
            <span style="font-size: 22px;" class="control-label">{{ 'ท่านต้องการที่จะแสดงเบอร์ของท่านหรือไม่'}}</span>
            <!-- <span style="color: #FF0033;"> *</span><span style="color: #FF0033;font-size: 13px;"> (ระบบจะไม่แสดงข้อมูล / The system will not display the information.)</span> -->
            <br>
            <!-- <input type="radio" name="show_phone" onclick="document.querySelector('#name').classList.remove('d-none'),
            document.querySelector('#name_input').classList.remove('d-none'),
            document.querySelector('#phone').classList.remove('d-none'),
            document.querySelector('#phone_input').classList.remove('d-none')">
            &nbsp;&nbsp;&nbsp;แสดง / Show&nbsp;&nbsp;&nbsp; -->
            <!-- <br> -->
            <div class="row">
                <div class="col-12 col-md-2" style="margin-top:10px">
                    <label for="phone" id="phone" class="control-label">{{ 'เบอร์โทร' }}</label>
                </div>
                <div class="col-12 col-md-4" style="margin-top:10px">
                    <div class="form-group {{ $errors->has('phone') ? 'has-error' : ''}}">
                        <input class="form-control" name="phone" type="tel" id="phone_input" value="{{ isset($guest->phone) ? $guest->phone : Auth::user()->phone}}" placeholder="เช่น 0999999999 / Ex. 0999999999" pattern="[0-9]{10}" required>
                        {!! $errors->first('phone', '<p class="help-block">:message</p>') !!}
                    </div>
                </div>
                <div class="d-none col-12 col-md-2">
                    <label for="name" id="name" class="d-none control-label">{{ 'ชื่อ' }}</label>
                </div>
                <div class="col-12 col-md-4">
                    <div class="form-group {{ $errors->has('name') ? 'has-error' : ''}}">
                        <input class="d-none form-control" name="name" type="hidden" id="name_input" value="{{ isset($guest->name) ? $guest->name : Auth::user()->name}}" >
                        {!! $errors->first('name', '<p class="help-block">:message</p>') !!}
                    </div>
                </div>
            </div>

            <input type="radio" name="phonephone" checked class="d-none" id="show_phone_check">
            <span class="d-none" id="p_phone">&nbsp;&nbsp;&nbsp;แสดง</span>
            <input type="radio" name="phonephone" class="d-none" id="not_show_phone_check">
            <span class="d-none" id="pnot_phone">&nbsp;&nbsp;&nbsp;ไม่แสดง</span>

            <input type="checkbox" name="checkbox" onchange="if(this.checked){
                not_show_phone();
                document.getElementById('not_show_phone_check').click(); 
            }else{
                show_phone();
                document.getElementById('show_phone_check').click(); 
            }">&nbsp;&nbsp;&nbsp;ไม่แสดง

            <br>
            <div class="d-none">
                <div class="form-group {{ $errors->has('user_id') ? 'has-error' : ''}}">
                    <label for="user_id" class="control-label">{{ 'User Id' }}</label>
                    <input class="form-control" name="user_id" type="number" id="user_id" value="{{ isset($sos_map->user_id) ? $sos_map->user_id : Auth::user()->id}}" >
                    {!! $errors->first('user_id', '<p class="help-block">:message</p>') !!}
                </div>
                <input class="d-none" type="text" id="CountryCode" name="CountryCode" value="">
            </div>
            <div class="form-group {{ $errors->has('provider_id') ? 'has-error' : ''}}">
                <input class="form-control" name="provider_id" type="hidden" id="provider_id" value="{{ isset($guest->provider_id) ? $guest->provider_id : Auth::user()->provider_id}}" readonly>
                {!! $errors->first('provider_id', '<p class="help-block">:message</p>') !!}
            </div>
            <div class="form-group {{ $errors->has('user_id') ? 'has-error' : ''}}">
                <input class="form-control" name="user_id" type="hidden" id="user_id" value="{{ isset($register_car->user_id) ? $register_car->user_id : Auth::user()->id}}" required readonly>
                {!! $errors->first('user_id', '<p class="help-block">:message</p>') !!}
            </div>

            <div class="form-group {{ $errors->has('register_car_id') ? 'has-error' : ''}}">
                <input class="form-control" name="register_car_id" type="hidden" id="register_car_id" value="{{ isset($register_car->register_car_id) ? $register_car->register_car_id : ''}}" required readonly>
                {!! $errors->first('register_car_id', '<p class="help-block">:message</p>') !!}
            </div>

            <div class="form-group {{ $errors->has('organization') ? 'has-error' : ''}}">
                <input class="form-control" name="organization" type="hidden" id="organization" value="{{ isset($register_car->organization) ? $register_car->organization : ''}}" required readonly>
                {!! $errors->first('organization', '<p class="help-block">:message</p>') !!}
            </div>

            <div class="div_modal">
                @include ('guest.form_modal')
            </div>
            <div class="form-group">
                <button id="submit_form" type="button" class="btn btn-primary" data-toggle="modal" data-target="#btn-loading" onclick="submitform()">
                 ส่งข้อมูล
                </button>
                <input class="d-none btn btn-primary" id="btn_submit_form" type="submit" value="{{ $formMode === 'edit' ? 'Update' : 'ส่งข้อมูล' }}">
            </div>
        </div>
    </div>
</div>
@include ('layouts.modal_loading')




<script>

    document.addEventListener('DOMContentLoaded', (event) => {
        // console.log("START");
        let user_id = document.querySelector('#user_id').value;

        fetch("{{ url('/') }}/api/check_sos_country/" + user_id)
            .then(response => response.json())
            .then(result => {
                // console.log(result);

                let countryCode = document.querySelector('#CountryCode');
                    countryCode.value = result['countryCode'];

                if (result['countryCode']) {

                    if (result['countryCode'] !== 'TH') {
                    document.querySelector('#orc_camera').classList.add('d-none');
                    }

                    if (result['countryCode'] === 'TH') {
                        document.querySelector("#registration").placeholder = "กก9999";
                    }
                    if (result['countryCode'] === 'VN') {
                        document.querySelector("#registration").placeholder = "12A-345.67";
                    }
                    if (result['countryCode'] === 'MM') {
                        document.querySelector("#registration").placeholder = "9E-9999";
                    }
                    if (result['countryCode'] === 'MY') {
                        document.querySelector("#registration").placeholder = "AAA 9999";
                    }
                    if (result['countryCode'] === 'PH') {
                        document.querySelector("#registration").placeholder = "ABC 1234";
                    }
                    if (result['countryCode'] === 'KH') {
                        document.querySelector("#registration").placeholder = "2A-9999";
                    }
                    if (result['countryCode'] === 'LA') {
                        document.querySelector("#registration").placeholder = "ກກ9999";
                    }
                    if (result['countryCode'] === 'SG') {
                        document.querySelector("#registration").placeholder = "SBA 1234A";
                    }
                    if (result['countryCode'] === 'BN') {
                        document.querySelector("#registration").placeholder = "BZZ 9999";
                    }
                }
                
            });

    });
    
    document.addEventListener('DOMContentLoaded', (event) => {
        // console.log("START");
        // capture_registration();
    });

    function capture_registration(){
        document.querySelector('#div_photo_registration').classList.remove('d-none');

        var video = document.querySelector("#videoElement");
        var photo2 = document.querySelector("#photo2");
        var photo_motor = document.querySelector("#photo_motor");
        var canvas = document.querySelector("#canvas");
        var text_img = document.querySelector("#text_img");
        var context = canvas.getContext('2d');
        var div_cam = document.querySelector("#div_cam");
            div_cam.classList.remove('d-none');
            
            photo2.classList.add('d-none');
            photo_motor.classList.add('d-none');

            document.querySelector('#div_spinner').classList.add('d-none');

        var div_btn_click_frame = document.querySelector("#div_btn_click_frame");
            div_btn_click_frame.classList.remove('d-none');

        if (navigator.mediaDevices.getUserMedia) {
          navigator.mediaDevices.getUserMedia({ video: { facingMode: "environment" } })
          // { video: true}
          // { video: { facingMode: { exact: "environment" } } }
            .then(function (stream) {
              if (typeof video.srcObject == "object") {
                  video.srcObject = stream;
                } else {
                  video.src = URL.createObjectURL(stream);
                }
            })
            .catch(function (err0r) {
              console.log("Something went wrong!");
            });
        }

    }

    function stop(e) {
        document.querySelector('#div_photo_registration').classList.add('d-none');
        var video = document.querySelector("#videoElement");
        var photo2 = document.querySelector("#photo2");
        var canvas = document.querySelector("#canvas");
        var text_img = document.querySelector("#text_img");
        var context = canvas.getContext('2d');
          
          var stream = video.srcObject;
          var tracks = stream.getTracks();

          for (var i = 0; i < tracks.length; i++) {
            var track = tracks[i];
            track.stop();
          }

          video.srcObject = null;
    }

    function capture() {
        var show_img_car = document.querySelector("#show_img_car");
        var show_img_motor = document.querySelector("#show_img_motor");

        var video = document.querySelector("#videoElement");
        var text_img = document.querySelector("#text_img");

        // CAR
        var photo2 = document.querySelector("#photo2");
        var canvas = document.querySelector("#canvas");
        // MOTOR
        var photo_motor = document.querySelector("#photo_motor");
        var canvas_motor = document.querySelector("#canvas_motor");

        var div_cam = document.querySelector("#div_cam");
            div_cam.classList.add('d-none');

        var div_spinner = document.querySelector("#div_spinner");
            div_spinner.classList.remove('d-none');
        var div_btn_click_frame = document.querySelector("#div_btn_click_frame");
            div_btn_click_frame.classList.add('d-none');

        let type_reg = document.querySelector("#type_reg").value;
            
            //เช็คว่าเป็นรถยนต์หรือมอไซค์
            if (type_reg === 'car') {
                photo2.classList.remove('d-none');
                show_img_car.classList.remove('d-none');

                photo_motor.classList.add('d-none');
                show_img_motor.classList.add('d-none');

                let context = canvas.getContext('2d');
                    context.drawImage(video, 45, 140, 380, 170, 0, 0, 250, 100);

                photo2.setAttribute('src',canvas.toDataURL('image/png'));
                text_img.value = canvas.toDataURL('image/png');

            } else {
                photo2.classList.add('d-none');
                show_img_car.classList.add('d-none');

                photo_motor.classList.remove('d-none');
                show_img_motor.classList.remove('d-none');

                let context = canvas_motor.getContext('2d');
                    context.drawImage(video, 60, 90, 400, 270, 0, 0, 250, 250);

                photo_motor.setAttribute('src',canvas_motor.toDataURL('image/png'));
                text_img.value = canvas_motor.toDataURL('image/png');
            }

        

        const data = {
            requests: [
                {
                    image: {
                        content: text_img.value.replace(/^data:.+;base64,/, "")
                    },
                        features: [{ type: "TEXT_DETECTION" }]
                }
            ]
        };

        let url = "https://vision.googleapis.com/v1/images:annotate?key=AIzaSyBgrxXDgk1tgXngalZF3eWtcTWI-LPdeus";
        fetch( url, {
            method: 'post',
            body: JSON.stringify(data),
            headers: {
                "Content-Type": "application/json"
            }
        })
        .then(response => response.json())
            .then(result => {

                // เช็คก่อนว่าเป็นรถยนต์หรือมอไซค์
                if (type_reg === 'car') {

                    let length = result['responses']['0']['textAnnotations']['length'];
                    let locale = result['responses']['0']['textAnnotations']['0']['locale'];

                    if (length === 4 && locale === "th") {
                        let text_result_1 = result['responses']['0']['textAnnotations']['1']['description'];
                        let text_result_2 = result['responses']['0']['textAnnotations']['2']['description'];
                        let text_result_3 = result['responses']['0']['textAnnotations']['3']['description'];

                        let registration = document.querySelector("#registration");
                        let county = document.querySelector("#county");
                            
                            registration.value = text_result_1+text_result_2;
                            county.innerHTML = "";

                            let option = document.createElement("option");
                                option.text = text_result_3;
                                option.value = text_result_3;
                                county.add(option);  

                            check_time();
                            add_reg_id();  
                            div_spinner.classList.add('d-none');       

                    } else if (length !== 4 || locale !== "th") {
                        let text_result_0 = result['responses']['0']['textAnnotations']['0']['description'];

                        let text_result_arr = {
                                "text_result_0": text_result_0
                            };

                            fetch( "{{ url('/') }}/api/search_reg_ocr" , {
                                method: 'post',
                                body: JSON.stringify(text_result_arr),
                                headers: {
                                    "Content-Type": "application/json"
                                }
                            })
                            .then(response => response.json())
                            .then(result => {
                                // console.log(result.length);
                                if (result.length === 0) {
                                    // หาไม่เจอข้อมูล
                                    let div_content = document.querySelector("#div_content");
                                        div_content.textContent = "";
                                        
                                    let para = document.createElement("P");
                                    let style_para = document.createAttribute("style");
                                        style_para.value = "position: relative;margin-top: 20px; z-index: 5; font-size:18px;";
                                        para.setAttributeNode(style_para); 
                                        para.innerHTML = "Registration information"+"<br>"+"not found."+"<br>";

                                    let style_div_content = document.createAttribute("style");
                                            style_div_content.value = "position: relative;";

                                        div_content.appendChild(para);                
                                        div_content.setAttributeNode(style_div_content);

                                    document.querySelector('#btn_select_registration').click();
                                    div_spinner.classList.add('d-none'); 

                                }else {
                                    // มีข้อมูล
                                    let div_content = document.querySelector("#div_content");
                                        div_content.textContent = "";
                                    for(let item of result){

                                        // <div>
                                        let div = document.createElement("div");
                                        let id = document.createAttribute("id");
                                            id.value = "reg_"+item.id;
                                        let onClick = document.createAttribute("onClick");
                                            onClick.value = "show_reg('"+item.registration_number+"','"+item.province+"');";

                                            div.setAttributeNode(id); 
                                            div.setAttributeNode(onClick);

                                        // <p>
                                        let para = document.createElement("P");
                                        let style_para = document.createAttribute("style");
                                            style_para.value = "position: relative;margin-top: 20px; z-index: 5; font-size:18px;";
                                            para.setAttributeNode(style_para); 
                                            para.innerHTML = item.registration_number+"<br>"+item.province+"<br>";

                                        // <img>
                                        let img = document.createElement("img");
                                        let style_img = document.createAttribute("style");
                                            style_img.value = "right: 40px;z-index: 2;margin-top:-110px;";
                                        let src_img = document.createAttribute("src");
                                            src_img.value = "{{ asset('/img/icon/ป้ายทะเบียน.png') }}";
                                        let width_img = document.createAttribute("width");
                                            width_img.value = "250";
                                            
                                            img.setAttributeNode(style_img); 
                                            img.setAttributeNode(src_img); 
                                            img.setAttributeNode(width_img); 

                                        // <hr>
                                        let br = document.createElement("br");

                                        div.appendChild(para);
                                        div.appendChild(img);
                                        div.appendChild(br);

                                        let style_div_content = document.createAttribute("style");
                                            style_div_content.value = "position: relative;";

                                        div_content.appendChild(div);               
                                        div_content.setAttributeNode(style_div_content);               
                                    }
                                    document.querySelector('#btn_select_registration').click();
                                    div_spinner.classList.add('d-none');       

                                } 
                                
                            });

                    }
                } else {
                    // รถจักยานยนต์
                    // console.log(result);

                    let length = result['responses']['0']['textAnnotations']['length'];
                    let locale = result['responses']['0']['textAnnotations']['0']['locale'];

                    if (length === 4 && locale === "th") {

                        let text_result_1 = result['responses']['0']['textAnnotations']['1']['description'];
                        let text_result_2 = result['responses']['0']['textAnnotations']['2']['description'];
                        let text_result_3 = result['responses']['0']['textAnnotations']['3']['description'];

                        let registration = document.querySelector("#registration");
                        let county = document.querySelector("#county");
                            
                            registration.value = text_result_1+text_result_3;
                            county.innerHTML = "";

                            let option = document.createElement("option");
                                option.text = text_result_2;
                                option.value = text_result_2;
                                county.add(option);  

                            check_time();
                            add_reg_id();  
                            div_spinner.classList.add('d-none');    

                    }else if (length !== 4 || locale !== "th"){

                        let length_number = length - 1 ;
                        let text_number = result['responses']['0']['textAnnotations'][length_number]['description'];

                        let text_result_arr = {
                                "text_number": text_number
                            };

                            fetch( "{{ url('/') }}/api/search_reg_ocr_motor" , {
                                method: 'post',
                                body: JSON.stringify(text_result_arr),
                                headers: {
                                    "Content-Type": "application/json"
                                }
                            })
                            .then(response => response.json())
                            .then(result => {
                                // console.log(result.length);
                                if (result.length === 0) {
                                    // หาไม่เจอข้อมูล
                                    let div_content = document.querySelector("#div_content");
                                        div_content.textContent = "";
                                        
                                    let para = document.createElement("P");
                                    let style_para = document.createAttribute("style");
                                        style_para.value = "position: relative;margin-top: 20px; z-index: 5; font-size:18px;";
                                        para.setAttributeNode(style_para); 
                                        para.innerHTML = "Registration information"+"<br>"+"not found."+"<br>";

                                    let style_div_content = document.createAttribute("style");
                                            style_div_content.value = "position: relative;";

                                        div_content.appendChild(para);                
                                        div_content.setAttributeNode(style_div_content);

                                    document.querySelector('#btn_select_registration').click();
                                    div_spinner.classList.add('d-none'); 

                                } else {
                                    // มีข้อมูล
                                    let div_content = document.querySelector("#div_content");
                                        div_content.textContent = "";
                                    for(let item of result){
                                        
                                        let replace_not_digit = item.registration_number.replace(/\D/g, '/');

                                        let split = replace_not_digit.split('/') ;
                                        let i = split.length - 1 ;

                                        let second_text_reg = split[i];

                                        let split_2 = item.registration_number.split(second_text_reg);

                                        let first_text_reg = split_2[0];

                                        // console.log(first_text_reg);
                                        // console.log(second_text_reg);

                                        // <div>
                                        let div = document.createElement("div");
                                        let id = document.createAttribute("id");
                                            id.value = "reg_"+item.id;
                                        let onClick = document.createAttribute("onClick");
                                            onClick.value = "show_reg('"+item.registration_number+"','"+item.province+"');";

                                            div.setAttributeNode(id); 
                                            div.setAttributeNode(onClick);

                                        // <p>
                                        let para = document.createElement("P");
                                        let style_para = document.createAttribute("style");
                                            style_para.value = "position: relative;margin-top: 20px; z-index: 5; font-size:18px;";
                                            para.setAttributeNode(style_para); 
                                            para.innerHTML = first_text_reg+"<br>"+item.province+"<br>"+second_text_reg;

                                        // <img>
                                        let img = document.createElement("img");
                                        let style_img = document.createAttribute("style");
                                            style_img.value = "right: 65px;z-index: 2;margin-top:-135px";
                                        let src_img = document.createAttribute("src");
                                            src_img.value = "{{ asset('/img/icon/ป้ายทะเบียน.png') }}";
                                        let width_img = document.createAttribute("width");
                                            width_img.value = "200";
                                        let height_img = document.createAttribute("height");
                                            height_img.value = "120";
                                            
                                            img.setAttributeNode(style_img); 
                                            img.setAttributeNode(src_img); 
                                            img.setAttributeNode(width_img); 
                                            img.setAttributeNode(height_img); 

                                        // <hr>
                                        let br = document.createElement("br");

                                        div.appendChild(para);
                                        div.appendChild(img);
                                        div.appendChild(br);

                                        let style_div_content = document.createAttribute("style");
                                            style_div_content.value = "position: relative;";

                                        div_content.appendChild(div);               
                                        div_content.setAttributeNode(style_div_content);               
                                    }
                                    document.querySelector('#btn_select_registration').click();
                                    div_spinner.classList.add('d-none');       

                                } 
                                
                            });
                    }

                }

            });

    }

    function show_reg(reg_number , reg_province){
        // console.log(reg_number);
        // console.log(reg_province);

        let registration = document.querySelector("#registration");
        let county = document.querySelector("#county");
            
            registration.value = reg_number;
            county.innerHTML = "";

            let option = document.createElement("option");
                option.text = reg_province;
                option.value = reg_province;
                county.add(option);  

            check_time();
            add_reg_id();   
            document.querySelector('#btn_close_select_registration').click();      
    }

    function check_registration(){
        let registration = document.querySelector("#registration");
        //PARAMETERS
        fetch("{{ url('/') }}/api/check_registration/"+registration.value)
            .then(response => response.json())
            .then(result => {
                // console.log(result);
                //UPDATE SELECT OPTION
            for(let item of result){
                var registration_car = item.registration_number;
                // console.log(registration_car);
            }

            if (registration_car == null ) {
                // console.log("null");
                document.querySelector('#submit_form').classList.add('d-none');
                // alert("รถหมายเลขทะเบียนนี้ไม่มีในระบบ");
                document.getElementById("btn_not_system").click();
                let registration_reset = document.querySelector("#registration");
                    registration_reset.value = "";
                document.querySelector('#registration').focus();
            }else{ 
                // console.log("Yess");
                document.querySelector('#submit_form').classList.remove('d-none');
                document.querySelector('#county').focus();
            }

                check_province();
            });
            return registration.value;
    }

    function check_province(){
        let registration = document.querySelector("#registration");
        //PARAMETERS
        fetch("{{ url('/') }}/api/check_registration/"+registration.value+"/province")
            .then(response => response.json())
            .then(result => {
                // console.log(result.length);
                //UPDATE SELECT OPTION
                if (result.length == 1 ) {
                    let county = document.querySelector("#county");
                    county.innerHTML = "";

                    for(let item of result){
                        let option = document.createElement("option");
                        option.text = item.province;
                        option.value = item.province;
                        county.add(option);                
                    }
                }else{ 
                    let option = document.createElement("option");
                    option.text = "- กรุณาเลือกจังหวัด / Select province -";
                    option.value = "- กรุณาเลือกจังหวัด / Select province -";
                    
                    for(let item of result){
                        let option = document.createElement("option");
                        option.text = item.province;
                        option.value = item.province;
                        county.add(option);                
                    }
                }
                
                check_time();
                add_reg_id();
            });
    }

    function check_time(){
        let registration = document.querySelector("#registration");
        let county = document.querySelector("#county");
        let user_id = document.querySelector("#user_id");
        // console.log(registration.value);
        // console.log(county.value);
        // console.log(user_id.value);
        //PARAMETERS
        fetch("{{ url('/') }}/api/check_time/" + registration.value + "/" + county.value + "/" + user_id.value)
            .then(response => response.text())
            .then(result => {
                // console.log(result);

                if (result == "No" ) {
                    document.querySelector('#submit_form').classList.remove('d-none');
                }else if (result == "Yes" ){ 
                    // alert("ซ้ำ");
                    document.getElementById("btn_repeatedly").click();
                    document.querySelector('#submit_form').classList.add('d-none');
                    let registration_reset = document.querySelector("#registration");
                        registration_reset.value = "";
                    let county_reset = document.querySelector("#county");
                        county_reset.value = "";
                }

            
            });
    }

    function show_phone(){
        // console.log("show_phone"); 

        var name = document.querySelector('#name');
            name.classList.remove('d-none');

        var name_input = document.querySelector('#name_input');
            name_input.classList.remove('d-none');

        var phone = document.querySelector('#phone');
            phone.classList.remove('d-none');

        var phone_input = document.querySelector('#phone_input');
        var att = document.createAttribute('required'); 
            phone_input.setAttributeNode(att);
            phone_input.classList.remove('d-none');
            phone_input.value = '{{ isset($guest->phone) ? $guest->phone : Auth::user()->phone}}';

    }

    function not_show_phone(){
        // console.log("not_show_phone"); 

        var name = document.querySelector('#name');
            name.classList.add('d-none');

        var name_input = document.querySelector('#name_input');
            name_input.classList.add('d-none');

        var phone = document.querySelector('#phone');
            phone.classList.add('d-none');

        var phone_input = document.querySelector('#phone_input');
            phone_input.removeAttribute('value');
            phone_input.removeAttribute('required');
            phone_input.classList.add('d-none');
            

    }
    function add_required_photo(){ 

        var photo = document.querySelector('#photo');
        photo.setAttributeNode(document.createAttribute('required'));


    }
    function remove_required_photo(){ 

        var photo = document.querySelector('#photo');

        photo.removeAttribute('required');

    }

    function add_reg_id(){
        let registration = document.querySelector("#registration");
        let county = document.querySelector("#county");
        // console.log(registration.value);
        // console.log(county.value);
        let register_car_id = document.querySelector("#register_car_id");
        let organization = document.querySelector("#organization");
        //PARAMETERS
        fetch("{{ url('/') }}/api/add_reg_id/"+registration.value+"/"+county.value)
            .then(response => response.json())
            .then(result => {
                // console.log(result);
                //UPDATE SELECT OPTION
                for(let item of result){
                    register_car_id.value = item.id;
                    organization.value = item.juristicNameTH;
                    // console.log(registration_car);
                }

                if (result['length'] === 0) {
                    document.querySelector('#submit_form').classList.add('d-none');
                    // alert("รถหมายเลขทะเบียนนี้ไม่มีในระบบ");
                    document.getElementById("btn_not_system").click();
                } else{
                    document.querySelector('#submit_form').classList.remove('d-none');
                }

                if (result[0].active === "No") {
                    document.querySelector('#btn_car_cancel').click();
                    registration.value = "" ;
                    county.value = "" ;
                }
                
            });
    }

    function frame_car() {
        var btn_click_frame_car = document.querySelector("#btn_click_frame_car");
        var btn_click_frame_motor = document.querySelector("#btn_click_frame_motor");
        var img_frame_car = document.querySelector("#img_frame_car");
        var img_frame_motor = document.querySelector("#img_frame_motor");
        var type_reg = document.querySelector("#type_reg");

        type_reg.value = "car" ;

        img_frame_car.classList.remove('d-none');
        img_frame_motor.classList.add('d-none');

        btn_click_frame_car.classList.remove('btn-outline-primary');
        btn_click_frame_car.classList.add('btn-primary');

        btn_click_frame_motor.classList.remove('btn-success');
        btn_click_frame_motor.classList.add('btn-outline-success');
    }

    function frame_motor() {
        var btn_click_frame_car = document.querySelector("#btn_click_frame_car");
        var btn_click_frame_motor = document.querySelector("#btn_click_frame_motor");
        var img_frame_car = document.querySelector("#img_frame_car");
        var img_frame_motor = document.querySelector("#img_frame_motor");

        var type_reg = document.querySelector("#type_reg");

        type_reg.value = "motorcycle" ;

        img_frame_car.classList.add('d-none');
        img_frame_motor.classList.remove('d-none');

        btn_click_frame_car.classList.add('btn-outline-primary');
        btn_click_frame_car.classList.remove('btn-primary');

        btn_click_frame_motor.classList.add('btn-success');
        btn_click_frame_motor.classList.remove('btn-outline-success');
    }

</script>
<script>
    function submitform() {
        var delayInMilliseconds = 3000; //3 second

        setTimeout(function() {
            document.querySelector('#btn_submit_form').click();
        }, delayInMilliseconds);
    }
</script>
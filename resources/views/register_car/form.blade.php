@if(!empty($car_type_old))
<input type="hidden" name="car_type_old" id="car_type_old" value="{{ $car_type_old }}">
@endif
<div>
    <div class="container">
        <div class="row">
            <div class="col-12">
                

                <!-- หน้าลงทะเบียนสำหรับองค์กร -->
                <div id="blade_organization" class="d-none">
                    @include ('register_car.form_partner')
                </div>

                <!-- หน้าลงทะเบียนสำหรับบุคคลทั่วไป -->
                <div>
                    @if(empty(Auth::user()->phone) or empty(Auth::user()->location_P) or empty(Auth::user()->location_A))
                        <span style="font-size: 22px;" class="control-label">{{ 'ข้อมูลผู้ลงทะเบียน' }}</span><span style="color: #FF0033;"> *<br><br></span>
                        <div id="input_information">
                            <div class="row">
                                <div class="col-12 col-md-3">
                                    <label  class="control-label">{{ 'จังหวัดที่อยู่ปัจจุบัน' }}</label><span style="color: #FF0033;"> *</span>
                                    <div class="form-group {{ $errors->has('location_P') ? 'has-error' : ''}}">
                                        <select name="location_P" id="location_P" class="form-control" required onchange="show_location_A();change_location();">
                                                <option value="" selected > - กรุณาเลือกจังหวัด - </option> 
                                        </select>
                                        {!! $errors->first('location_P', '<p class="help-block">:message</p>') !!}
                                    </div>
                                </div>
                                <div class="col-12 col-md-3">
                                    <label  class="control-label">{{ 'อำเภอที่อยู่ปัจจุบัน' }}</label><span style="color: #FF0033;"> *</span>
                                    <div class="form-group {{ $errors->has('location_A') ? 'has-error' : ''}}">
                                        <select name="location_A" id="location_A" class="form-control" required>
                                                <option value="" selected > - กรุณาเลือกอำเภอ  - </option> 
                                                                                   
                                        </select>
                                        {!! $errors->first('location_A', '<p class="help-block">:message</p>') !!}
                                    </div>
                                </div>
                                <div class="col-12 col-md-3">
                                    <label  class="control-label">{{ 'เบอร์โทรศัพท์' }}</label><span style="color: #FF0033;"> *</span>
                                    <div class="form-group {{ $errors->has('phone') ? 'has-error' : ''}}">
                                        <input class="form-control" name="phone" type="phone" id="phone" value="{{ isset($register_car->phone) ? $register_car->phone :  Auth::user()->phone }}" required placeholder="กรุณาใส่เบอร์ของคุณ" pattern="[0-9]{9-10}">
                                        {!! $errors->first('phone', '<p class="help-block">:message</p>') !!}
                                    </div>
                                </div>
                                <div class="col-12 col-md-3">
                                    <label  class="control-label">{{ 'วันเกิด' }}</label>
                                    <div class="form-group {{ $errors->has('brith') ? 'has-error' : ''}}">
                                        <input class="form-control" name="brith" type="date" id="brith" value="{{ isset($register_car->brith) ? $register_car->brith :  Auth::user()->brith }}">
                                        {!! $errors->first('brith', '<p class="help-block">:message</p>') !!}
                                    </div>
                                </div>
                            </div>
                            <hr>
                        </div>
                    @else
                        <input class="form-control" name="location_P" type="hidden" id="location_P" value="{{ isset($register_car->location_P) ? $register_car->location_P :  Auth::user()->location_P }}" readonly>

                        <input class="form-control" name="location_A" type="hidden" id="location_A" value="{{ isset($register_car->location_A) ? $register_car->location_A :  Auth::user()->location_A }}" readonly>

                        <input class="form-control" name="phone" type="hidden" id="phone" value="{{ isset($register_car->phone) ? $register_car->phone :  Auth::user()->phone }}" readonly>
                    @endif
                </div>

                <input class="form-control" name="location" type="hidden" id="location" value="{{ isset($register_car->location) ? $register_car->location :  Auth::user()->location_P }}" readonly>
                <!-------------------------------------------------------------------- เลือกประเทศรถ -------------------------------------------------------------------->
                <div class="form-group {{ $errors->has('user_id') ? 'has-error' : ''}} d-none">
                        <label for="user_id" class="control-label">{{ 'User Id' }}</label>
                        <input class="form-control" name="user_id" type="number" id="user_id" value="{{ isset($sos_map->user_id) ? $sos_map->user_id : Auth::user()->id}}" >
                        {!! $errors->first('user_id', '<p class="help-block">:message</p>') !!}
                    </div>
                </div>

                <span style="font-size: 22px;" class="control-label">ขณะนี้ท่านลงทะเบียนรถประเทศ

                <input class="d-none" type="text" name="CountryCode" id="CountryCode">
                {!! $errors->first('CountryCode', '<p class="help-block">:message</p>') !!}

                    <!-- Button trigger modal -->
                    <!-- <button type="button"  class="btn" data-toggle="modal" data-target="#exampleModalCenter" style="padding:0px">
                        <span style="font-size: 18px;" class="control-label">
                            <i class="fad fa-globe-asia"></i> เลือกประเทศ <i class="fas fa-angle-double-down"></i>
                        </span> 
                    </button> -->
                    <span>
                        <a id="car_TH" href="#" class="d-none" data-toggle="modal" data-target="#exampleModalCenter" style="padding:0px">
                            <img width="40px" src="{{ asset('/img/national-flag/th1.png') }}" style= "border-radius: 5px;"> <i class="fal fa-angle-down"></i>
                        </a>
                    </span>
                    <span>
                        <a id="car_ID" href="#" class="d-none" data-toggle="modal" data-target="#exampleModalCenter" style="padding:0px">
                            <img width="40px" src="{{ asset('/img/national-flag/ID.png') }}" style= "border-radius: 5px; border: 1px solid; color:#8C8C8C;"> <i class="fal fa-angle-down"></i>
                        </a>
                    </span>
                    <span>
                        <a id="car_LA" href="#" class="d-none" data-toggle="modal" data-target="#exampleModalCenter" style="padding:0px">
                            <img width="40px" src="{{ asset('/img/national-flag/la1.png') }}" style= "border-radius: 5px;"> <i class="fal fa-angle-down"></i>
                        </a>
                    </span>
                    <span>
                        <a id="car_PH" href="#" class="d-none" data-toggle="modal" data-target="#exampleModalCenter" style="padding:0px">
                            <img width="40px" src="{{ asset('/img/national-flag/ph1.png') }}" style= "border-radius: 5px;"> <i class="fal fa-angle-down"></i>
                        </a>
                    </span>
                    <span>
                        <a id="car_MM" href="#" class="d-none" data-toggle="modal" data-target="#exampleModalCenter" style="padding:0px">
                            <img width="40px" src="{{ asset('/img/national-flag/my1.png') }}" style= "border-radius: 5px;"> <i class="fal fa-angle-down"></i>
                        </a>
                    </span>
                    <span>
                        <a id="car_SG" href="#" class="d-none" data-toggle="modal" data-target="#exampleModalCenter" style="padding:0px">
                            <img width="40px" src="{{ asset('/img/national-flag/sg1.png') }}" style= "border-radius: 5px;border: 1px solid; color:#8C8C8C;"> <i class="fal fa-angle-down"></i>
                        </a>
                    </span>
                    <span>
                        <a id="car_KR" href="#" class="d-none" data-toggle="modal" data-target="#exampleModalCenter" style="padding:0px">
                            <img width="40px" src="{{ asset('/img/national-flag/kr1.png') }}" style= "border-radius: 5px;"> <i class="fal fa-angle-down"></i>
                        </a>
                    </span>
                    <span>
                        <a id="car_BN" href="#" class="d-none" data-toggle="modal" data-target="#exampleModalCenter" style="padding:0px">
                            <img width="40px" src="{{ asset('/img/national-flag/bn1.png') }}" style= "border-radius: 5px;"> <i class="fal fa-angle-down"></i>
                        </a>
                    </span>
                    <span>
                        <a id="car_VN" href="#" class="d-none" data-toggle="modal" data-target="#exampleModalCenter" style="padding:0px">
                            <img width="40px" src="{{ asset('/img/national-flag/vn1.png') }}" style= "border-radius: 5px;"> <i class="fal fa-angle-down"></i>
                        </a>
                    </span>
                    <span>
                        <a id="car_MY" href="#" class="d-none" data-toggle="modal" data-target="#exampleModalCenter" style="padding:0px">
                            <img width="40px" src="{{ asset('/img/national-flag/ml1.jpg') }}" style= "border-radius: 5px;"> <i class="fal fa-angle-down"></i>
                        </a>
                    </span>
                    <span>
                        <a id="car_JP" href="#" class="d-none" data-toggle="modal" data-target="#exampleModalCenter" style="padding:0px">
                            <img width="40px" src="{{ asset('/img/national-flag/jp.png') }}" style= "border-radius: 5px; border: 1px solid; color:#8C8C8C;"> <i class="fal fa-angle-down"></i>
                        </a>
                    </span>
                    <span>
                        <a id="car_KO" href="#" class="d-none" data-toggle="modal" data-target="#exampleModalCenter" style="padding:0px">
                            <img width="40px" src="{{ asset('/img/national-flag/ko1.png') }}" style= "border-radius: 5px;border: 1px solid; color:#8C8C8C;"> <i class="fal fa-angle-down"></i>
                        </a>
                    </span>
                    <span>
                        <a id="car_CN" href="#" class="d-none" data-toggle="modal" data-target="#exampleModalCenter" style="padding:0px">
                            <img width="40px" src="{{ asset('/img/national-flag/cn.png') }}" style= "border-radius: 5px;"> <i class="fal fa-angle-down"></i>
                        </a>
                    </span>
                    <!-- Modal -->
                    <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered" role="document">
                        <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalCenterTitle">เลือกประเทศ</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                           <div class="row text-center">
                                <div class="col-lg-3 col-4">
                                    <!-- ไทย<br>  -->
                                     <a href="#"  class="select-btn" data-value="TH" data-dismiss="modal" onclick="
                                    document.querySelector('#car_TH').classList.remove('d-none'),
                                    document.querySelector('#car_ID').classList.add('d-none');
                                    document.querySelector('#car_LA').classList.add('d-none');
                                    document.querySelector('#car_PH').classList.add('d-none');
                                    document.querySelector('#car_MM').classList.add('d-none');
                                    document.querySelector('#car_SG').classList.add('d-none');
                                    document.querySelector('#car_KR').classList.add('d-none');
                                    document.querySelector('#car_BN').classList.add('d-none');
                                    document.querySelector('#car_VN').classList.add('d-none');
                                    document.querySelector('#car_MY').classList.add('d-none');
                                    document.querySelector('#car_JP').classList.add('d-none');
                                    document.querySelector('#car_KO').classList.add('d-none');
                                    document.querySelector('#car_CN').classList.add('d-none');">
                                         <img width="50%" src="{{ asset('/img/national-flag/th1.png') }}" style= "border-radius: 5px;">
                                     </a>
                                </div>
                                <div class="col-lg-3 col-4">
                                    <!-- อิโดนีเซีย<br>  -->
                                    <a href="#"  class="select-btn" data-value="ID" data-dismiss="modal" onclick="
                                    document.querySelector('#car_TH').classList.add('d-none'),
                                    document.querySelector('#car_ID').classList.remove('d-none');
                                    document.querySelector('#car_LA').classList.add('d-none');
                                    document.querySelector('#car_PH').classList.add('d-none');
                                    document.querySelector('#car_MM').classList.add('d-none');
                                    document.querySelector('#car_SG').classList.add('d-none');
                                    document.querySelector('#car_KR').classList.add('d-none');
                                    document.querySelector('#car_BN').classList.add('d-none');
                                    document.querySelector('#car_VN').classList.add('d-none');
                                    document.querySelector('#car_MY').classList.add('d-none');
                                    document.querySelector('#car_JP').classList.add('d-none');
                                    document.querySelector('#car_KO').classList.add('d-none');
                                    document.querySelector('#car_CN').classList.add('d-none');">
                                        <img width="50%" src="{{ asset('/img/national-flag/ID.png') }}" style= "border-radius: 5px;border: 1px solid; color:#8C8C8C;">
                                    </a>
                                </div>
                                <div class="col-lg-3 col-4 ">
                                    <!-- ลาว<br>  -->
                                    <a href="#"  class="select-btn" data-value="LA" data-dismiss="modal"onclick="
                                    document.querySelector('#car_TH').classList.add('d-none'),
                                    document.querySelector('#car_ID').classList.add('d-none');
                                    document.querySelector('#car_LA').classList.remove('d-none');
                                    document.querySelector('#car_PH').classList.add('d-none');
                                    document.querySelector('#car_MM').classList.add('d-none');
                                    document.querySelector('#car_SG').classList.add('d-none');
                                    document.querySelector('#car_KR').classList.add('d-none');
                                    document.querySelector('#car_BN').classList.add('d-none');
                                    document.querySelector('#car_VN').classList.add('d-none');
                                    document.querySelector('#car_MY').classList.add('d-none');
                                    document.querySelector('#car_JP').classList.add('d-none');
                                    document.querySelector('#car_KO').classList.add('d-none');
                                    document.querySelector('#car_CN').classList.add('d-none');">
                                        <img width="50%" src="{{ asset('/img/national-flag/la1.png') }}" style= "border-radius: 5px;">
                                    </a>
                                </div>
                                <div class="col-12 d-block d-md-none">&nbsp;</div>
                                <div class="col-lg-3 col-4">
                                    <a href="#"  class="select-btn" data-value="PH" data-dismiss="modal" onclick="
                                    document.querySelector('#car_TH').classList.add('d-none'),
                                    document.querySelector('#car_ID').classList.add('d-none');
                                    document.querySelector('#car_LA').classList.add('d-none');
                                    document.querySelector('#car_PH').classList.remove('d-none');
                                    document.querySelector('#car_MM').classList.add('d-none');
                                    document.querySelector('#car_SG').classList.add('d-none');
                                    document.querySelector('#car_KR').classList.add('d-none');
                                    document.querySelector('#car_BN').classList.add('d-none');
                                    document.querySelector('#car_VN').classList.add('d-none');
                                    document.querySelector('#car_MY').classList.add('d-none');
                                    document.querySelector('#car_JP').classList.add('d-none');
                                    document.querySelector('#car_KO').classList.add('d-none');
                                    document.querySelector('#car_CN').classList.add('d-none');">
                                    <!-- ฟิลิปปินส์<br>  -->
                                        <img width="50%" src="{{ asset('/img/national-flag/ph1.png') }}" style= "border-radius: 5px;">
                                    </a>
                                </div>
                                <div class="col-12 d-none d-lg-block">&nbsp;</div>
                                <div class="col-lg-3 col-4">
                                    <!-- พม่า<br>  -->
                                    <a href="#"  class="select-btn" data-value="MM" data-dismiss="modal" onclick="
                                    document.querySelector('#car_TH').classList.add('d-none'),
                                    document.querySelector('#car_ID').classList.add('d-none');
                                    document.querySelector('#car_LA').classList.add('d-none');
                                    document.querySelector('#car_PH').classList.add('d-none');
                                    document.querySelector('#car_MM').classList.remove('d-none');
                                    document.querySelector('#car_SG').classList.add('d-none');
                                    document.querySelector('#car_KR').classList.add('d-none');
                                    document.querySelector('#car_BN').classList.add('d-none');
                                    document.querySelector('#car_VN').classList.add('d-none');
                                    document.querySelector('#car_MY').classList.add('d-none');
                                    document.querySelector('#car_JP').classList.add('d-none');
                                    document.querySelector('#car_KO').classList.add('d-none');
                                    document.querySelector('#car_CN').classList.add('d-none');">
                                        <img width="50%" src="{{ asset('/img/national-flag/my1.png') }}" style= "border-radius: 5px;">
                                    </a>
                                </div> 
                                <div class="col-lg-3 col-4">
                                    <!-- สิงคโปร์<br>  -->
                                    <a href="#"  class="select-btn" data-value="SG" data-dismiss="modal" onclick="
                                    document.querySelector('#car_TH').classList.add('d-none'),
                                    document.querySelector('#car_ID').classList.add('d-none');
                                    document.querySelector('#car_LA').classList.add('d-none');
                                    document.querySelector('#car_PH').classList.add('d-none');
                                    document.querySelector('#car_MM').classList.add('d-none');
                                    document.querySelector('#car_SG').classList.remove('d-none');
                                    document.querySelector('#car_KR').classList.add('d-none');
                                    document.querySelector('#car_BN').classList.add('d-none');
                                    document.querySelector('#car_VN').classList.add('d-none');
                                    document.querySelector('#car_MY').classList.add('d-none');
                                    document.querySelector('#car_JP').classList.add('d-none');
                                    document.querySelector('#car_KO').classList.add('d-none');
                                    document.querySelector('#car_CN').classList.add('d-none');">
                                        <img width="50%" src="{{ asset('/img/national-flag/sg1.png') }}" style= "border-radius: 5px;border: 1px solid; color:#8C8C8C;">
                                    </a>
                                </div>
                                <div class="col-12 d-block d-md-none">&nbsp;</div>
                                <div class="col-lg-3 col-4">
                                    <!-- กัมพูชา<br>  -->
                                    <a href="#"  class="select-btn" data-value="KR" data-dismiss="modal"onclick="
                                    document.querySelector('#car_TH').classList.add('d-none'),
                                    document.querySelector('#car_ID').classList.add('d-none');
                                    document.querySelector('#car_LA').classList.add('d-none');
                                    document.querySelector('#car_PH').classList.add('d-none');
                                    document.querySelector('#car_MM').classList.add('d-none');
                                    document.querySelector('#car_SG').classList.add('d-none');
                                    document.querySelector('#car_KR').classList.remove('d-none');
                                    document.querySelector('#car_BN').classList.add('d-none');
                                    document.querySelector('#car_VN').classList.add('d-none');
                                    document.querySelector('#car_MY').classList.add('d-none');
                                    document.querySelector('#car_JP').classList.add('d-none');
                                    document.querySelector('#car_KO').classList.add('d-none');
                                    document.querySelector('#car_CN').classList.add('d-none');">
                                        <img width="50%" src="{{ asset('/img/national-flag/kr1.png') }}" style= "border-radius: 5px;">
                                    </a>
                                </div>
                                <div class="col-lg-3 col-4">
                                    <!-- บรูไน<br>  -->
                                    <a href="#"  class="select-btn" data-value="BN" data-dismiss="modal" onclick="
                                    document.querySelector('#car_TH').classList.add('d-none'),
                                    document.querySelector('#car_ID').classList.add('d-none');
                                    document.querySelector('#car_LA').classList.add('d-none');
                                    document.querySelector('#car_PH').classList.add('d-none');
                                    document.querySelector('#car_MM').classList.add('d-none');
                                    document.querySelector('#car_SG').classList.add('d-none');
                                    document.querySelector('#car_KR').classList.add('d-none');
                                    document.querySelector('#car_BN').classList.remove('d-none');
                                    document.querySelector('#car_VN').classList.add('d-none');
                                    document.querySelector('#car_MY').classList.add('d-none');
                                    document.querySelector('#car_JP').classList.add('d-none');
                                    document.querySelector('#car_KO').classList.add('d-none');
                                    document.querySelector('#car_CN').classList.add('d-none');">
                                        <img width="50%" src="{{ asset('/img/national-flag/bn1.png') }}" style= "border-radius: 5px;">
                                    </a>
                                </div>
                                <div class="col-12 d-none d-lg-block">&nbsp;</div>
                                <div class="col-lg-3 col-4">
                                    <!-- เวียดนาม<br>  -->
                                    <a href="#"  class="select-btn" data-value="VN" data-dismiss="modal" onclick="
                                    document.querySelector('#car_TH').classList.add('d-none'),
                                    document.querySelector('#car_ID').classList.add('d-none');
                                    document.querySelector('#car_LA').classList.add('d-none');
                                    document.querySelector('#car_PH').classList.add('d-none');
                                    document.querySelector('#car_MM').classList.add('d-none');
                                    document.querySelector('#car_SG').classList.add('d-none');
                                    document.querySelector('#car_KR').classList.add('d-none');
                                    document.querySelector('#car_BN').classList.add('d-none');
                                    document.querySelector('#car_VN').classList.remove('d-none');
                                   document.querySelector('#car_MY').classList.add('d-none');
                                    document.querySelector('#car_JP').classList.add('d-none');
                                    document.querySelector('#car_KO').classList.add('d-none');
                                    document.querySelector('#car_CN').classList.add('d-none');">
                                        <img width="50%" src="{{ asset('/img/national-flag/vn1.png') }}" style= "border-radius: 5px;">
                                    </a>
                                </div>
                                <div class="col-12 d-block d-md-none">&nbsp;</div>
                                <div class="col-lg-3 col-4">
                                    <!-- <br>  -->
                                    <a href="#"  class="select-btn" data-value="MY" data-dismiss="modal" onclick="
                                    document.querySelector('#car_TH').classList.add('d-none'),
                                    document.querySelector('#car_ID').classList.add('d-none');
                                    document.querySelector('#car_LA').classList.add('d-none');
                                    document.querySelector('#car_PH').classList.add('d-none');
                                    document.querySelector('#car_MM').classList.add('d-none');
                                    document.querySelector('#car_SG').classList.add('d-none');
                                    document.querySelector('#car_KR').classList.add('d-none');
                                    document.querySelector('#car_BN').classList.add('d-none');
                                    document.querySelector('#car_VN').classList.add('d-none');
                                    document.querySelector('#car_MY').classList.remove('d-none');
                                    document.querySelector('#car_JP').classList.add('d-none');
                                    document.querySelector('#car_KO').classList.add('d-none');
                                    document.querySelector('#car_CN').classList.add('d-none');">
                                        <img width="50%" src="{{ asset('/img/national-flag/ml1.jpg') }}" style= "border-radius: 5px;">
                                    </a>
                                </div>
                                <div class="col-lg-3 col-4">
                                    <!-- <br>  -->
                                    <a href="#"  class="select-btn" data-value="MY" data-dismiss="modal" onclick="
                                    document.querySelector('#car_TH').classList.add('d-none'),
                                    document.querySelector('#car_ID').classList.add('d-none');
                                    document.querySelector('#car_LA').classList.add('d-none');
                                    document.querySelector('#car_PH').classList.add('d-none');
                                    document.querySelector('#car_MM').classList.add('d-none');
                                    document.querySelector('#car_SG').classList.add('d-none');
                                    document.querySelector('#car_KR').classList.add('d-none');
                                    document.querySelector('#car_BN').classList.add('d-none');
                                    document.querySelector('#car_VN').classList.add('d-none');
                                    document.querySelector('#car_MY').classList.add('d-none');
                                    document.querySelector('#car_JP').classList.add('d-none');
                                    document.querySelector('#car_KO').classList.add('d-none');
                                    document.querySelector('#car_CN').classList.remove('d-none');">
                                        <img width="50%" src="{{ asset('/img/national-flag/cn.png') }}" style= "border-radius: 5px;">
                                    </a>
                                </div>
                                <div class="col-lg-3 col-4">
                                    <!-- <br>  -->
                                    <a href="#"  class="select-btn" data-value="MY" data-dismiss="modal" onclick="
                                    document.querySelector('#car_TH').classList.add('d-none'),
                                    document.querySelector('#car_ID').classList.add('d-none');
                                    document.querySelector('#car_LA').classList.add('d-none');
                                    document.querySelector('#car_PH').classList.add('d-none');
                                    document.querySelector('#car_MM').classList.add('d-none');
                                    document.querySelector('#car_SG').classList.add('d-none');
                                    document.querySelector('#car_KR').classList.add('d-none');
                                    document.querySelector('#car_BN').classList.add('d-none');
                                    document.querySelector('#car_VN').classList.add('d-none');
                                    document.querySelector('#car_MY').classList.add('d-none');
                                    document.querySelector('#car_JP').classList.add('d-none');
                                    document.querySelector('#car_KO').classList.remove('d-none');
                                    document.querySelector('#car_CN').classList.add('d-none');">
                                        <img width="50%" src="{{ asset('/img/national-flag/ko1.png') }}" style= "border-radius: 5px;border: 1px solid; color:#8C8C8C;">
                                    </a>
                                </div>
                                <div class="col-12 d-block d-md-none">&nbsp;</div>
                                <div class="col-12 d-none d-lg-block">&nbsp;</div>
                                <div class="col-lg-3 col-4">
                                    <!-- <br>  -->
                                    <a href="#"  class="select-btn" data-value="MY" data-dismiss="modal" onclick="
                                    document.querySelector('#car_TH').classList.add('d-none'),
                                    document.querySelector('#car_ID').classList.add('d-none');
                                    document.querySelector('#car_LA').classList.add('d-none');
                                    document.querySelector('#car_PH').classList.add('d-none');
                                    document.querySelector('#car_MM').classList.add('d-none');
                                    document.querySelector('#car_SG').classList.add('d-none');
                                    document.querySelector('#car_KR').classList.add('d-none');
                                    document.querySelector('#car_BN').classList.add('d-none');
                                    document.querySelector('#car_VN').classList.add('d-none');
                                    document.querySelector('#car_MY').classList.add('d-none');
                                    document.querySelector('#car_JP').classList.remove('d-none');
                                    document.querySelector('#car_KO').classList.add('d-none');
                                    document.querySelector('#car_CN').classList.add('d-none');">
                                        <img width="50%" src="{{ asset('/img/national-flag/jp.png') }}" style= "border-radius: 5px;border: 1px solid; color:#8C8C8C;">
                                    </a>
                                </div>
                                <div class="col-12 d-block d-md-none">&nbsp;</div>
                                <div class="col-12 d-none d-lg-block">&nbsp;</div>
                           </div>
                        </div>
                        <!-- <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        </div> -->
                        </div>
                    </div>
                    </div>
                <br>
                <!-------------------------------------------------------------------- จบเลือกประเทศรถ -------------------------------------------------------------------->
                <hr>
                <span style="font-size: 22px;" class="control-label">{{ 'ข้อมูลรถ' }}</span><span style="color: #FF0033;"> *</span>
                <br><br>
                <input class="d-none" type="text" id="input_check_type_car" value="car">
                <h4>
                    <input id="btn_type_car" type="radio" name="car_type" checked value="{{ isset($register_car->car_type) ? $register_car->car_type : 'car'}}" required onclick="
                        document.querySelector('#input_check_type_car').value = 'car',

                        document.querySelector('#div_motor_brand').classList.add('d-none'),
                        document.querySelector('#brand_input').classList.add('d-none'),
                        document.querySelector('#generation_input').classList.add('d-none'),
                        document.querySelector('#input_motor_brand').classList.add('d-none'),
                        document.querySelector('#input_motor_model').classList.add('d-none'),
                        document.querySelector('#span_text_other').classList.add('d-none'),

                        document.querySelector('#div_input_model').classList.remove('d-none'),
                        document.querySelector('#div_car_brand').classList.remove('d-none'),
                        document.querySelector('#input_car_model').classList.remove('d-none'),
                        document.querySelector('#input_car_brand').classList.remove('d-none');">
                    &nbsp;<i class="fas fa-car-side text-danger"></i>&nbsp; รถยนต์ &nbsp;&nbsp;&nbsp;
                  
                    <!-- แสดงเฉพาะมือถือ -->
                    <div class="d-block d-lg-none">
                        <input id="btn_type_motor_mobile" type="radio" name="car_type" value="{{ isset($register_car->car_type) ? $register_car->car_type : 'motorcycle'}}" required onclick="
                            document.querySelector('#input_check_type_car').value = 'motorcycle',

                            document.querySelector('#brand_input').classList.add('d-none'),
                            document.querySelector('#generation_input').classList.add('d-none'),
                            document.querySelector('#input_car_model').classList.add('d-none'),
                            document.querySelector('#input_car_brand').classList.add('d-none'),
                            document.querySelector('#div_car_brand').classList.add('d-none'),
                            document.querySelector('#span_text_other').classList.add('d-none'),

                            document.querySelector('#div_input_model').classList.remove('d-none'),
                            document.querySelector('#div_motor_brand').classList.remove('d-none'),
                            document.querySelector('#input_motor_brand').classList.remove('d-none'),
                            document.querySelector('#input_motor_model').classList.remove('d-none');">
                        &nbsp;<i class="fas fa-motorcycle text-success " ></i >&nbsp;&nbsp;มอเตอร์ไซต์
                    </div>
                    <!-- แสดงเฉพาะคอม -->
                    <div class="d-none d-lg-block">
                        <input id="btn_type_motor_pc" type="radio" name="car_type" value="{{ isset($register_car->car_type) ? $register_car->car_type : 'motorcycle'}}" required onclick="
                            document.querySelector('#input_check_type_car').value = 'motorcycle',

                            document.querySelector('#brand_input').classList.add('d-none'),
                            document.querySelector('#generation_input').classList.add('d-none'),
                            document.querySelector('#input_car_model').classList.add('d-none'),
                            document.querySelector('#input_car_brand').classList.add('d-none'),
                            document.querySelector('#div_car_brand').classList.add('d-none'),
                            document.querySelector('#span_text_other').classList.add('d-none'),

                            document.querySelector('#div_input_model').classList.remove('d-none'),
                            document.querySelector('#div_motor_brand').classList.remove('d-none'),
                            document.querySelector('#input_motor_brand').classList.remove('d-none'),
                            document.querySelector('#input_motor_model').classList.remove('d-none');">
                        &nbsp;<i class="fas fa-motorcycle text-success " ></i >&nbsp;&nbsp;มอเตอร์ไซต์
                    </div>

                    <input id="btn_type_car_other" type="radio" name="car_type" value="{{ isset($register_car->car_type) ? $register_car->car_type : 'other'}}" required onclick="
                        document.querySelector('#input_check_type_car').value = 'other',

                        document.querySelector('#div_motor_brand').classList.add('d-none'),
                        document.querySelector('#input_motor_brand').classList.add('d-none'),
                        document.querySelector('#input_motor_model').classList.add('d-none'),

                        document.querySelector('#input_car_model').classList.add('d-none'),
                        document.querySelector('#input_car_brand').classList.add('d-none'),
                        document.querySelector('#div_car_brand').classList.add('d-none'),
                        document.querySelector('#div_input_model').classList.add('d-none'),

                        document.querySelector('#span_text_other').classList.remove('d-none'),
                        document.querySelector('#brand_input').classList.remove('d-none'),
                        document.querySelector('#generation_input').classList.remove('d-none'),
                        document.querySelector('#brand_input').focus();

                        ">
                    &nbsp;<i class="fas fa-dolly text-info"></i>&nbsp; อื่นๆ &nbsp;&nbsp;&nbsp;
                </h4>
                <br>
                <!-- ข้อมูลรถ -->
                <div class=" row" id="div_data">
                    <div class="row">
                        <div class="col-12 col-md-2">
                            <label for="brand" id="brand_label" class="control-label">{{ 'ยี่ห้อรถ' }}</label><span style="color: #FF0033;"> *</span>
                        </div>
                        <div class="col-12 col-md-4">
                            <div id="div_car_brand" class=" form-group {{ $errors->has('brand') ? 'has-error' : ''}}">
                                <!-- car -->
                                <select name="brand" class="notranslate form-control" id="input_car_brand"  onchange="showCar_model();
                                    if(this.value=='อื่นๆ'){ 
                                        document.querySelector('#brand_input').classList.remove('d-none'),
                                        document.querySelector('#generation_input').classList.remove('d-none'),
                                        document.querySelector('#brand_input').focus();
                                    }else{ 
                                        document.querySelector('#brand_input').classList.add('d-none'),
                                        document.querySelector('#generation_input').classList.add('d-none');}">
                                    @if(!empty($brand_old))
                                        <option class="notranslate" value="{{ $brand_old }}" selected>{{ $brand_old }}</option>
                                    @else
                                        <option class="translate" value="" selected> - เลือกยี่ห้อ - </option> 
                                    @endif
                                    <br>
                                    {!! $errors->first('brand', '<p class="help-block">:message</p>') !!}
                                </select>
                            </div>
                            <div id="div_motor_brand" class="d-none form-group {{ $errors->has('motor_brand') ? 'has-error' : ''}}">
                                <!-- motorcycles -->
                                <select name="motor_brand" class="notranslate d-none form-control" id="input_motor_brand"  onchange="showMotor_model();
                                        if(this.value=='อื่นๆ'){ 
                                        document.querySelector('#brand_input').classList.remove('d-none'),
                                        document.querySelector('#generation_input').classList.remove('d-none'),
                                        document.querySelector('#brand_input').focus();
                                    }else{ 
                                        document.querySelector('#brand_input').classList.add('d-none'),
                                        document.querySelector('#generation_input').classList.add('d-none');}">
                                    @if(!empty($brand_old))
                                        <option class="notranslate" value="{{ $brand_old }}" selected>{{ $brand_old }}</option>
                                    @else
                                        <option class="translate" value="" selected> - เลือกยี่ห้อ - </option> 
                                    @endif
                                    <br>
                                    {!! $errors->first('motor_brand', '<p class="help-block">:message</p>') !!}
                                </select>
                            </div>
                            <div class="form-group {{ $errors->has('brand_other') ? 'has-error' : ''}}">
                                <input class="d-none form-control" name="brand_other" type="text" id="brand_input" value="{{ isset($register_car->brand_other) ? $register_car->brand_other : ''}}" placeholder="ยี่ห้อรถของคุณ / Your brand">
                                {!! $errors->first('brand_other', '<p class="help-block">:message</p>') !!}
                            </div>
                        </div>
                        <div class="col-12 col-md-2">
                            <label for="generation" class="control-label">{{ 'รุ่นรถ' }}</label><span style="color: #FF0033;"> *</span>
                        </div>
                        <div class="col-12 col-md-4">
                            <div id="div_input_model" class="form-group {{ $errors->has('generation') ? 'has-error' : ''}}">
                                <!-- car -->
                                <select name="generation" id="input_car_model" class=" form-control"  onchange="if(this.value=='อื่นๆ'){ 
                                        document.querySelector('#generation_input').classList.remove('d-none'),
                                        document.querySelector('#generation_input').focus();
                                    }else{ 
                                        document.querySelector('#generation_input').classList.add('d-none');}">
                                        @if(!empty($generation_old))
                                            <option value="{{ $generation_old }}" selected>{{ $generation_old }}</option>
                                        @else
                                            <option value="" selected> - เลือกรุ่น - </option> 
                                        @endif
                                        <br> 
                                        {!! $errors->first('generation', '<p class="help-block">:message</p>') !!}             
                                </select>
                                <!-- motorcycles -->
                                <select name="motor_generation" id="input_motor_model" class="d-none form-control"  onchange="if(this.value=='อื่นๆ'){ 
                                        document.querySelector('#generation_input').classList.remove('d-none'),
                                        document.querySelector('#generation_input').focus();
                                    }else{ 
                                        document.querySelector('#generation_input').classList.add('d-none');}">
                                        @if(!empty($generation_old))
                                            <option value="{{ $generation_old }}" selected>{{ $generation_old }}</option>
                                        @else
                                            <option value="" selected> - เลือกรุ่น - </option> 
                                        @endif     
                                        <br>  
                                        {!! $errors->first('motor_generation', '<p class="help-block">:message</p>') !!}            
                                </select>
                            </div>
                            <div class="form-group {{ $errors->has('generation_other') ? 'has-error' : ''}}">
                                <input class="d-none form-control" name="generation_other" type="text" id="generation_input" value="{{ isset($register_car->generation_other) ? $register_car->generation_other : ''}}" placeholder="รุ่นรถของคุณ / Your model" >
                                {!! $errors->first('generation_other', '<p class="help-block">:message</p>') !!}
                            </div>
                        </div>
                        <div id="span_text_other" style="font-size:15px;" class="col-12 text-secondary d-none">
                            <span>
                                ในกรณีลงทะเบียนประเภทอื่นๆ กรุณากรอกหมวดหมู่ตัวอักษรอย่างน้อย 4 ตัว
                                <br><br>
                            </span>
                        </div>
                        <div class="col-12 col-md-2">
                            <label for="registration_number" class="control-label">{{ 'ทะเบียนรถ' }}<span style="color: #FF0033;"> *</span></label>
                        </div>
                        <div class="col-12 col-md-4">
                            <div class="notranslate form-group {{ $errors->has('registration_number') ? 'has-error' : ''}}">
                                <input class="form-control" name="registration_number" type="text" id="registration_number" value="{{ isset($register_car->registration_number) ? $register_car->registration_number : ''}}" placeholder="Ex. กก9999 " required onchange="check_register_car();">
                                {!! $errors->first('registration_number', '<p class="help-block">:message</p>') !!}
                            </div>
                        </div>
                        <div class="col-12 col-md-2">
                            <label for="province" class="control-label">{{ 'จังหวัดของทะเบียนรถ' }}<span style="color: #FF0033;"> *</span></label>
                        </div>
                        <div class="col-12 col-md-4">
                            <div class="form-group {{ $errors->has('province') ? 'has-error' : ''}}">
                                <select name="province" id="province" class="form-control" required onchange="check_register_car();">
                                        @if(!empty($province_old))
                                            <option value="{{ $province_old }}" selected>{{ $province_old }}</option>
                                            @foreach($location_array as $lo)
                                            <option
                                            value="{{ $lo->province }}" 
                                            {{ request('province') == $lo->province ? 'selected' : ''   }} >
                                            {{ $lo->province }} 
                                            </option>
                                            @endforeach    
                                        @else
                                            <option value="" selected > - กรุณาเลือกจังหวัด - </option> 
                                            @foreach($location_array as $lo)
                                            <option
                                            value="{{ $lo->province }}" 
                                            {{ request('province') == $lo->province ? 'selected' : ''   }} >
                                            {{ $lo->province }} 
                                            </option>
                                            @endforeach    
                                        @endif
                                </select>
                                {!! $errors->first('province', '<p class="help-block">:message</p>') !!}
                            </div>
                        </div>
                        <br><br><br>
                        <hr>
                        <br>
                    </div>

                    <div class="row">
                        <div class="col-12 col-md-2">
                            <label for="province" class="control-label">{{ 'Insurance company (Optional)' }}</span></label>
                        </div>
                        <div class="col-12 col-md-4">
                            <div class="form-group {{ $errors->has('name_insurance') ? 'has-error' : ''}}">
                                <select name="name_insurance" id="name_insurance" class="form-control" onchange="search_phone_insurance();">

                                    @if(!empty($name_insurance_old))
                                        <option value="{{ $name_insurance_old }}" selected>{{ $name_insurance_old }}</option>
                                        @foreach($name_insurance as $item)
                                            <option value="{{ $item->company }}" 
                                            {{ request('company') == $item->company ? 'selected' : ''   }} >
                                            {{ $item->company }} 
                                            </option>
                                        @endforeach  
                                        <option value="insurance_another" >อื่นๆ</option>
                                    @else
                                        <option value="" selected>- เลือกบริษัทประกันภัย -</option>
                                        @foreach($name_insurance as $item)
                                            <option value="{{ $item->company }}" 
                                            {{ request('company') == $item->company ? 'selected' : ''   }} >
                                            {{ $item->company }} 
                                            </option>
                                        @endforeach 
                                        <option value="insurance_another" >อื่นๆ</option>
                                    @endif
                                </select>
                            </div>
                        </div>

                        <div id="insurance_another" class="d-none col-12 col-md-6">
                            <div class="form-group {{ $errors->has('name_insurance_another') ? 'has-error' : ''}}">
                                <input class="form-control" name="name_insurance_another" type="text" id="name_insurance_another" value="" >
                                {!! $errors->first('name_insurance', '<p class="help-block">:message</p>') !!}
                            </div>
                        </div>

                        <div class="col-12 col-md-2">
                            <label for="province" class="control-label">{{ 'เบอร์โทรบริษัทประกัน' }}</span></label>
                        </div>
                        <div class="col-12 col-md-4">
                            <div class="form-group {{ $errors->has('phone_insurance') ? 'has-error' : ''}}">
                                <input class="form-control" name="phone_insurance" type="text" id="phone_insurance" value="{{ isset($register_car->phone_insurance) ? $register_car->phone_insurance : '' }}" readonly>
                                {!! $errors->first('phone_insurance', '<p class="help-block">:message</p>') !!}
                            </div>
                        </div>

                        <div class="col-12 col-md-2">
                            <label for="province" class="control-label">{{ 'วันหมดอายุ ประกัน' }}</span></label>
                        </div>
                        <div class="col-12 col-md-4">
                            <div class="form-group {{ $errors->has('insurance') ? 'has-error' : ''}}">
                                <input class="form-control" name="insurance" type="date" id="insurance" value="{{ isset($register_car->insurance) ? $register_car->insurance : '' }}" >
                                {!! $errors->first('insurance', '<p class="help-block">:message</p>') !!}
                            </div>
                        </div>

                        <div class="col-12 col-md-2">
                            <label for="province" class="control-label">{{ 'วันหมดอายุ พรบ.' }}</span></label>
                        </div>
                        <div class="col-12 col-md-4">
                            <div class="form-group {{ $errors->has('act') ? 'has-error' : ''}}">
                                <input class="form-control" name="act" type="date" id="act" value="{{ isset($register_car->act) ? $register_car->act : '' }}" >
                                {!! $errors->first('act', '<p class="help-block">:message</p>') !!}
                            </div>
                        </div>

                    </div>
                </div>
                
                <div>
                    <button id="btn_edit_form" type="button" class="btn btn-primary" onclick="document.getElementById('btn_confirm').click();re_check();">บันทึก</button>
                </div>
                <!-- <button type="button" class="btn btn-primary" onclick="alert('hello')">Primary</button> -->

                <!-- Modal รถซ้ำ -->
                <!-- Button trigger modal -->
                <button id="btn_repeatedly" type="button" class="btn btn-primary d-none" data-toggle="modal" data-target="#not_system">
                  Launch static backdrop modal
                </button>

                <!-- Modal -->
                <div class="modal fade" id="not_system" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                  <div class="modal-dialog">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h5 class="modal-title" id="staticBackdropLabel">Warning <i class="fas fa-exclamation-triangle text-danger"></i></h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                        </button>
                      </div>
                      <div class="modal-body">
                        <center>
                            <img width="50%" src="{{ asset('/img/stickerline/PNG/17.png') }}">
                            <br><br>
                            <h5 class="text-danger">รถหมายเลขทะเบียนนี้ท่านลงทะเบียนแล้วค่ะ</h5>
                            <p style="line-height: 2;">กรุณาตรวจสอบใหม่อีกครั้งค่ะ</p>
                            <br>
                        </center>
                      </div>
                      <div class="modal-footer d-none">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">ปิด</button>
                        <button type="button" class="btn btn-primary">Understood</button>
                      </div>
                    </div>
                  </div>
                </div>

                <!-- ยืนยันการลงทะเบียน -->
                <!-- Button trigger modal -->
                <button id="btn_confirm" type="button" class="btn btn-primary d-none" data-toggle="modal" data-target="#confirm">
                  Launch static backdrop modal
                </button>

                <!-- Modal -->
                <div class="modal fade" id="confirm" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                  <div class="modal-dialog">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h5 class="modal-title" id="staticBackdropLabel">Warning <i class="fas fa-exclamation-triangle text-danger"></i></h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                        </button>
                      </div>
                      <!-- แสดงเฉพาะคอม -->
                      <div class="modal-body d-none d-lg-block">
                        <center>
                    
                            <h5 class="text-danger">คุณยืนยันที่จะลงทะเบียนหมายเลขทะเบียนนี้ใช่มั้ยค่ะ</h5>
                            <br>
                            <div style="position: relative; z-index: 5">
                                <div style="padding-top: 8px;">
                                    <h4 style="margin-top: 70px;"><b id="reg_num"></b></h4>
                                    <p class="notranslate" id="reg_province" style="font-size: 17px;" class="text-dark"></p>
                                </div>
                            </div>
                            <img style="position: absolute;margin: -180px -50px;z-index: 1;transform:rotate(360deg);" width="100" src="{{ asset('/img/stickerline/PNG/18.png') }}">
                            <img style="position: absolute;margin: -100px -140px;z-index: 2;" width="280" src="{{ asset('/img/icon/ป้ายทะเบียน.png') }}">

                        </center>

                      </div>
                      <!-- แสดงเฉพาะมือถือ -->
                      <div class="modal-body d-block d-md-none">
                        <center>
                            <h5 class="text-danger">คุณยืนยันที่จะลงทะเบียนหมายเลขทะเบียนนี้ใช่มั้ยค่ะ</h5>
                            <br>
                            <div style="position: relative; z-index: 5">
                                <div style="padding-top: 8px;">
                                    <h4 style="margin-top: 65px;"><b id="reg_num_mo"></b></h4>
                                    <p class="notranslate" id="reg_province_mo" style="font-size: 17px;" class="text-dark"></p>
                                </div>
                            </div>
                            <img style="position: absolute;margin: -180px -50px;z-index: 1;transform:rotate(360deg);" width="100" src="{{ asset('/img/stickerline/PNG/18.png') }}">
                            <img style="position: absolute;margin: -100px -140px;z-index: 2;" width="280" src="{{ asset('/img/icon/ป้ายทะเบียน.png') }}">

                        </center>
                      </div>
                      <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">แก้ไข</button>
                        <div style="margin-top:15px;" class="form-group">
                        <button id="submit_form"  type="button" class="btn btn-primary" data-toggle="modal" data-target="#btn-loading" onclick="submitform()">
                            บันทึก
                        </button>
                            <input id="btn_confirm_form"  class="d-none btn btn-primary" type="submit" value="{{ $formMode === 'edit' ? 'บันทึก' : 'บันทึก' }}" >
                        </div>
                      </div>
                    </div>
                  </div>
                </div>

                <hr>
                <div id="div_information" class="col-12 d-none">
                    <div class="row">
                        <div class="col-9 col-md-4 col-lg-2">
                            <p style="font-size: 22px;" class="control-label"><b>ข้อมูลของท่าน</b></p>
                        </div>
                        <div class="col-3" style="margin-top:-20px">
                            <br>
                            <button title="Click to show/hide content" type="button"  class="btn btn-sm"
                                onclick="if(document.getElementById('information') .style.display=='none') 
                                {document.getElementById('information') .style.display=''}else{document.getElementById('information')
                                .style.display='none'}"> 
                                <h6 style="color:#7D7D7D">
                                    <i class="fas fa-angle-double-down"></i>
                                </h6>
                            </button>
                        </div>
                    </div>
                </div>

                <br><br>
                <div id="information" class="row" style="display:none;">
                    <!-- ซ้าย -->
                    <div class="col-12 col-md-12 col-lg-5">
                        <div class="row">
                            <div class="col-12 col-md-3">
                                <center>
                                    <!-- <label for="name" class="control-label">{{ 'ชื่อ / Name' }}</label> -->
                                    <img width="80%" src="{{ Auth::user()->avatar }}" class="rounded-circle">
                                    <br><br>
                                </center>
                            </div>
                            <div class="col-12 col-md-9">
                                <div class="form-group {{ $errors->has('name') ? 'has-error' : ''}}">
                                    <h3 class="text-info notranslate"><b>{{ Auth::user()->name }}</b></h3><p></p>
                                    <h5 class="notranslate"><i class="fas fa-mail-bulk" style="color: #B22222"></i></i>&nbsp; {{ Auth::user()->email }}</h5>
                                    <p></p>
                                    <h5><i class="fas fa-phone text-success"></i>&nbsp; {{ Auth::user()->phone }}</h5>
                                    <p></p>
                                    <h5><i class="fas fa-venus-mars" style="color: #6600FF"></i></i>&nbsp; {{ Auth::user()->sex }}</h5>
                                    <h5><i class="fas fa-map-marked-alt" style="color: #FF0033"></i></i>&nbsp; {{ Auth::user()->location_A }}&nbsp; {{ Auth::user()->location_P }}</h5>
                                    <input class="d-none form-control" name="name" type="text" id="name" value="{{ isset($register_car->name) ? $register_car->name : Auth::user()->name}}" required readonly>
                                    {!! $errors->first('name', '<p class="help-block">:message</p>') !!}
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- ขวา -->
                    <div class="col-12 col-md-12 col-lg-7">
                        <div class="row">
                            <h5 style="padding-top: 7px;" class="text-info">รถที่คุณลงทะเบียนแล้ว</h5>
                            <br><br>
                            <div class="col-12 col-md-6 col-lg-6">
                                <h1><i class="fas fa-car-side text-danger"></i><span style="font-size: 25px;">&nbsp;&nbsp;รถยนต์</span></h1>
                               
                                @foreach($car as $item)
                                <!-- แสดงเฉพาะคอม -->
                                <div class="row d-none d-lg-block notranslate">
                                    <div class="col-10 col-md-10 border border-primary" style= "border-radius: 15px;padding: 8px;">
                                        <div class="row" style="margin-top: 8px; margin-bottom: 8px;">
                                            <div class="col-md-12 " style="margin: 5px 20px 15px 5px;"> 
                                                <div class="row">
                                                    <div class="col-md-4">
                                                        <img style="margin-top: -10px;" width="60"src="{{ asset('/img/logo_brand/logo-') }}{{ strtolower($item->brand) }}.png">
                                                    </div>
                                                    <div class="col-md-8">
                                                        <b style="font-size: 18px;">{{ $item->brand }}</b>
                                                        <br>
                                                        <span>{{ $item->generation }}</span>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <center>
                                                            <div style="position: relative; z-index: 5">
                                                                <hr style="margin-top: 8px; margin-bottom: 8px;">
                                                                <br>
                                                                <div style="padding-top: 8px;">
                                                                    <span style="font-size: 16px;" class="text-dark"><b>{{ $item->registration_number }}</b> </span>
                                                                    <p style="font-size: 12px;" class="text-secondary">{{ $item->province }}</p>
                                                                </div>
                                                            </div>

                                                            <div style="z-index: 2">
                                                                <img style="position: absolute;right: 8%;top: 28%;" width="240" height="80" src="{{ asset('/img/icon/ป้ายทะเบียน.png') }}">
                                                            </div>
                                                        </center>
                                                    </div>
                                                </div>
                                            </div>
                                         </div>
                                    </div>
                                </div>
                                <!-- แสดงเฉพาะมือถือ -->
                                <div class="row d-block d-md-none notranslate">
                                    <div class="col-11 border border-primary" style= "border-radius: 15px;padding: 8px;">
                                        <div class="row">
                                            <div class="col-12">
                                                <div class="row">
                                                    <br>
                                                    <div class="col-5">
                                                        <img class="float-right" width="60"src="{{ asset('/img/logo_brand/logo-') }}{{ strtolower($item->brand) }}.png">
                                                    </div>
                                                    <div class="col-7" style="padding-top: 5px;">
                                                        <h5><b>{{ $item->brand }}</b></h5>
                                                        <span style="font-size: 14px;">{{ $item->generation }}</span>
                                                    </div>
                                                </div>
                                                <hr style="margin-top: 8px; margin-bottom: 15px;">
                                                <div class="row">
                                                    <div class="col-12">
                                                        <center>
                                                            <div style="position: relative; z-index: 5">
                                                                <div style="padding-top: 8px;">
                                                                    <span style="font-size: 16px;" class="text-dark"><b>{{ $item->registration_number }}</b> </span>
                                                                    <p style="font-size: 12px;" class="text-secondary">{{ $item->province }}</p>
                                                                </div>
                                                            </div>
                                                            <div style="z-index: 2">
                                                                <img style="position: absolute;right: 15%;bottom: 10%;" width="200" src="{{ asset('/img/icon/ป้ายทะเบียน.png') }}">
                                                            </div>
                                                        </center>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                     </div>
                                </div>
                                <!-- แสดงเฉพาะแท็บเล็ต -->
                                <div class="d-none d-sm-block">
                                    <div class="row d-none d-lg-none notranslate d-flex justify-content-center">
                                        <div class="col-md-11 border border-primary" style= "border-radius: 15px;padding: 8px;">
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <div class="row">
                                                        <br>
                                                        <div class="col-md-5">
                                                            <img class="float-right" width="60"src="{{ asset('/img/logo_brand/logo-') }}{{ strtolower($item->brand) }}.png">
                                                        </div>
                                                        <div class="col-md-7" style="padding-top: 5px;">
                                                            <h5><b>{{ $item->brand }}</b></h5>
                                                            <span style="font-size: 14px;">{{ $item->generation }}</span>
                                                        </div>
                                                    </div>
                                                    <hr style="margin-top: 8px; margin-bottom: 15px;">
                                                    <div class="row">
                                                        <div class="col-md-12">
                                                            <center>
                                                                <div style="position: relative; z-index: 5">
                                                                    <div style="padding-top: 8px;">
                                                                        <span style="font-size: 16px;" class="text-dark"><b>{{ $item->registration_number }}</b> </span>
                                                                        <p style="font-size: 12px;" class="text-secondary">{{ $item->province }}</p>
                                                                    </div>
                                                                </div>
                                                                <div style="z-index: 2">
                                                                    <img style="position: absolute;right: 20%;bottom: 10%;" width="200" src="{{ asset('/img/icon/ป้ายทะเบียน.png') }}">
                                                                </div>
                                                            </center>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <br>
                                @endforeach
                            </div>
                            <div class="col-12 col-md-6 col-lg-6">
                                <h1><i class="fas fa-motorcycle text-success"></i><span style="font-size: 25px;">&nbsp;&nbsp;รถจักรยานยนต์</span></h1>
                                @foreach($motorcycle as $item)
                                <!-- แสดงเฉพาะคอม -->
                                <div class="row d-none d-lg-block notranslate">
                                    <div class="col-10 col-md-10 border border-primary" style= "border-radius: 15px;padding: 8px;">
                                        <div class="row" style="margin-top: 8px; margin-bottom: 8px;">
                                            <div class=" col-md-12 " style="margin: 5px 20px 15px 5px;"> 
                                                <div class="row">
                                                    <div class="col-md-4">
                                                        <img style="margin-top: -10px;" width="60"src="{{ asset('/img/logo_brand/logo-') }}{{ strtolower($item->brand) }}.png">
                                                    </div>
                                                    <div class="col-md-8">
                                                        <b style="font-size: 18px;">{{ $item->brand }}</b>
                                                        <br>
                                                        <span>{{ $item->generation }}</span>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <center>
                                                            <div style="position: relative; z-index: 5">
                                                                <hr style="margin-top: 8px; margin-bottom: 8px;">
                                                                <br>
                                                                <div style="padding-top: 8px;">
                                                                    <span style="font-size: 16px;" class="text-dark"><b>{{ $item->registration_number }}</b> </span>
                                                                    <p style="font-size: 12px;" class="text-secondary">{{ $item->province }}</p>
                                                                </div>
                                                            </div>

                                                            <div style="z-index: 2">
                                                                <img style="position: absolute;right: 8%;top: 28%;" width="240" height="80" src="{{ asset('/img/icon/ป้ายทะเบียน.png') }}">
                                                            </div>
                                                        </center>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                     </div>
                                </div>
                                <!-- แสดงเฉพาะมือถือ -->
                                <div class="row d-block d-md-none notranslate">
                                    <div class="col-11 border border-primary" style= "border-radius: 15px;padding: 8px;">
                                        <div class="row">
                                            <div class="col-12">
                                                <div class="row">
                                                    <br>
                                                    <div class="col-5">
                                                        <img class="float-right" width="60"src="{{ asset('/img/logo_brand/logo-') }}{{ strtolower($item->brand) }}.png">
                                                    </div>
                                                    <div class="col-7" style="padding-top: 5px;">
                                                        <h5><b>{{ $item->brand }}</b></h5>
                                                        <span style="font-size: 14px;">{{ $item->generation }}</span>
                                                    </div>
                                                </div>
                                                <hr style="margin-top: 8px; margin-bottom: 15px;">
                                                <div class="row">
                                                    <div class="col-12">
                                                        <center>
                                                            <div style="position: relative; z-index: 5">
                                                                <div style="padding-top: 8px;">
                                                                    <span style="font-size: 16px;" class="text-dark"><b>{{ $item->registration_number }}</b> </span>
                                                                    <p style="font-size: 12px;" class="text-secondary">{{ $item->province }}</p>
                                                                </div>
                                                            </div>
                                                            <div style="z-index: 2">
                                                                <img style="position: absolute;right: 15%;bottom: 10%;" width="200" src="{{ asset('/img/icon/ป้ายทะเบียน.png') }}">
                                                            </div>
                                                        </center>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                     </div>
                                </div>
                                <!-- แสดงเฉพาะแท็บเล็ต -->
                                <div class="d-none d-sm-block">
                                    <div class="row d-block d-lg-none notranslate d-flex justify-content-center">
                                        <div class="col-md-11 border border-primary" style= "border-radius: 15px;padding: 8px;">
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <div class="row">
                                                        <br>
                                                        <div class="col-md-5">
                                                            <img class="float-right" width="60"src="{{ asset('/img/logo_brand/logo-') }}{{ strtolower($item->brand) }}.png">
                                                        </div>
                                                        <div class="col-md-7" style="padding-top: 5px;">
                                                            <h5><b>{{ $item->brand }}</b></h5>
                                                            <span style="font-size: 14px;">{{ $item->generation }}</span>
                                                        </div>
                                                    </div>
                                                    <hr style="margin-top: 8px; margin-bottom: 15px;">
                                                    <div class="row">
                                                        <div class="col-md-12">
                                                            <center>
                                                                <div style="position: relative; z-index: 5">
                                                                    <div style="padding-top: 8px;">
                                                                        <span style="font-size: 16px;" class="text-dark"><b>{{ $item->registration_number }}</b> </span>
                                                                        <p style="font-size: 12px;" class="text-secondary">{{ $item->province }}</p>
                                                                    </div>
                                                                </div>
                                                                <div style="z-index: 2">
                                                                    <img style="position: absolute;right: 20%;bottom: 10%;" width="200" src="{{ asset('/img/icon/ป้ายทะเบียน.png') }}">
                                                                </div>
                                                            </center>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <br>
                                @endforeach
                            </div>
                        </div>
                    </div>
                    <div class="col-12">
                        <br><br>
                        <div class="row">
                            <div class="col-12 offset-7 offset-md-10">
                                <button type="button" class="btn btn-warning " onclick="document.getElementById('edit_information').click(); ">
                                    แก้ไขข้อมูล
                                </button>
                                <br>
                                <a id="edit_information" class="d-none" href="{{ url('/profile/' . $user->id . '/edit') }}" title="Edit Wishlist">แก้ไขข้อมูล </a>
                            </div>
                        </div>
                    </div>
                </div>
                
                
                <div class="form-group {{ $errors->has('user_id') ? 'has-error' : ''}}">
                    <input class="form-control" name="user_id" type="hidden" id="user_id" value="{{ isset($register_car->user_id) ? $register_car->user_id : Auth::user()->id}}"  readonly>
                    {!! $errors->first('user_id', '<p class="help-block">:message</p>') !!}
                </div>
                <div class="form-group {{ $errors->has('provider_id') ? 'has-error' : ''}}">
                    <input class="form-control" name="provider_id" type="hidden" id="provider_id" value="{{ isset($register_car->provider_id) ? $register_car->provider_id : Auth::user()->provider_id}}"  readonly>
                    {!! $errors->first('provider_id', '<p class="help-block">:message</p>') !!}
                </div>
                <div class="form-group {{ $errors->has('active') ? 'has-error' : ''}}">
                    <input class="form-control" name="active" type="hidden" id="active" value="{{ isset($register_car->active) ? $register_car->active : 'Yes'}}"  readonly>
                    {!! $errors->first('active', '<p class="help-block">:message</p>') !!}
                </div>

            </div> 
        </div>
    </div>
</div>
@include ('layouts.modal_loading')
    
<input type="text" class="d-none" name="language_user" id="language_user" value="{{ Auth::user()->language }}">
<a id="btn_change_language" class="d-none" href=""></a>

<script src="//code.jquery.com/jquery-3.2.1.min.js"></script>
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
                    document.querySelector('#car_'+result['countryCode']).classList.remove('d-none');
                }

            });
            
    $(function () {
            $('body').on('click', '.select-btn', function () {
                $('#CountryCode').val($(this).data('value'));

            })
        })
    });
</script>
<script>

    var language_user = document.querySelector('#language_user').value ;

    document.addEventListener('DOMContentLoaded', (event) => {
        // console.log("START");
        show_location_P();
        // show_location_P_2();
        showCar_brand();
        showMotor_brand();
    });

    function showCar_brand(){
        //PARAMETERS
        fetch("{{ url('/') }}/api/brand_middle_price")
            .then(response => response.json())
            .then(result => {
                // console.log(result);
                //UPDATE SELECT OPTION
                // let input_car_brand = document.querySelector("#input_car_brand");
                //     input_car_brand.innerHTML = "";

                for(let item of result){
                    let option = document.createElement("option");
                    option.text = item.brand;
                    option.value = item.brand;
                    input_car_brand.add(option);
                }
                let option = document.createElement("option");
                    option.text = "อื่นๆ";
                    option.value = "อื่นๆ";
                    input_car_brand.add(option); 

                    let option_class = document.createAttribute("class");
                        option_class.value = "translate";
                     
                    option.setAttributeNode(option_class); 

                //QUERY model
                showCar_model();
            });
            return input_car_brand.value;
    }
    function showCar_model(){
        // console.log(input_car_model.options.length);
        while (input_car_model.options.length > 1) {
                input_car_model.remove(1);
            } 
        let input_car_brand = document.querySelector("#input_car_brand");
        // console.log(input_car_brand.value);
        fetch("{{ url('/') }}/api/brand_middle_price/"+input_car_brand.value+"/model")
            .then(response => response.json())
            .then(result => {
                // console.log(result);
                // //UPDATE SELECT OPTION
                // let input_car_model = document.querySelector("#input_car_model");
                //     input_car_model.innerHTML = "";

                for(let item of result){
                    let option = document.createElement("option");
                    option.text = item.model;
                    option.value = item.model;
                    input_car_model.add(option);             
                } 
                let option = document.createElement("option");
                    option.text = "other";
                    option.value = "other";
                    input_car_model.add(option);  
            });
    }

    // motorcycle
    function showMotor_brand(){
        //PARAMETERS
        fetch("{{ url('/') }}/api/motor_middle_price")
            .then(response => response.json())
            .then(result => {
                // console.log(result);
                //UPDATE SELECT OPTION
                // let input_motor_brand = document.querySelector("#input_motor_brand");
                //     input_motor_brand.innerHTML = "";

                for(let item of result){
                    let option = document.createElement("option");
                    option.text = item.brand;
                    option.value = item.brand;
                    input_motor_brand.add(option);
                }
                let option = document.createElement("option");
                    option.text = "อื่นๆ";
                    option.value = "อื่นๆ";
                    input_motor_brand.add(option); 

                    let option_class = document.createAttribute("class");
                        option_class.value = "translate";
                     
                    option.setAttributeNode(option_class);

                //QUERY model
                showMotor_model();
            });
            return input_motor_brand.value;
    }
    function showMotor_model(){
        // console.log(input_motor_model.options.length);
        while (input_motor_model.options.length > 1) {
                input_motor_model.remove(1);
            } 
        let input_motor_brand = document.querySelector("#input_motor_brand");
        fetch("{{ url('/') }}/api/motor_middle_price/"+input_motor_brand.value+"/model")
            .then(response => response.json())
            .then(result => {
                // console.log(result);
                // //UPDATE SELECT OPTION
                // let input_motor_model = document.querySelector("#input_motor_model");
                //     input_motor_model.innerHTML = "";
                for(let item of result){
                    let option = document.createElement("option");
                    option.text = item.model;
                    option.value = item.model;
                    input_motor_model.add(option);                
                } 
                let option = document.createElement("option");
                    option.text = "other";
                    option.value = "other";
                    input_motor_model.add(option); 
            });
    }
    function check_register_car(){

        let registration_number = document.querySelector("#registration_number");
        let province = document.querySelector("#province");

        let span_text_other = document.querySelector("#span_text_other");
        let input_check_type_car = document.querySelector('#input_check_type_car').value;
        let text_registration = registration_number.value.replace(/[0-9]/g, '');

        if (input_check_type_car == 'other') {

            if (text_registration.length < 4) {
                span_text_other.classList.add('text-danger');
                document.querySelector('#btn_edit_form').disabled = true ;
            }else{
                span_text_other.classList.remove('text-danger');
                span_text_other.classList.add('text-secondary');
                document.querySelector('#btn_edit_form').disabled = false ;
            }

        }else{
            document.querySelector('#btn_edit_form').disabled = false ;
        }


        fetch("{{ url('/') }}/api/check_register_car/"+registration_number.value+"/"+province.value+"/check_register_car")
            .then(response => response.json())
            .then(result => {

            if (result.length != 0 ) {
                document.querySelector('#submit_form').classList.add('d-none');

                document.getElementById("btn_repeatedly").click();

                let registration_reset = document.querySelector("#registration_number");
                let province_reset = document.querySelector("#province");
                    registration_reset.value = "";
                    province_reset.value = "";
                document.querySelector('#registration_number').focus();
            }else{ 
                document.querySelector('#submit_form').classList.remove('d-none');
            }

            });
            return registration_number.value;
    }

    function re_check(){
        let registration_number = document.querySelector("#registration_number");
        let province = document.querySelector("#province");

        // console.log(registration_number);
        // console.log(province);

        let reg_num = document.querySelector("#reg_num");
            reg_num.innerHTML = registration_number.value;
        let reg_province = document.querySelector("#reg_province");
            reg_province.innerHTML = province.value;

        let reg_num_mo = document.querySelector("#reg_num_mo");
            reg_num_mo.innerHTML = registration_number.value;
        let reg_province_mo = document.querySelector("#reg_province_mo");
            reg_province_mo.innerHTML = province.value;
    }

    function show_location_P(){
        fetch("{{ url('/') }}/api/location/show_location_P")
            .then(response => response.json())
            .then(result => {
                // console.log(result);
                //UPDATE SELECT OPTION
                let location_P = document.querySelector("#location_P");
                    // location_P.innerHTML = "";

                for(let item of result){
                    let option = document.createElement("option");
                    option.text = item.province;
                    option.value = item.province;
                    location_P.add(option);
                }
                
            });
            
            return location_P.value;
    }

    function show_location_A(){
        let location_P = document.querySelector("#location_P");
        fetch("{{ url('/') }}/api/location/"+location_P.value+"/show_location_A")
            .then(response => response.json())
            .then(result => {
                // console.log(result);
                //UPDATE SELECT OPTION
                let location_A = document.querySelector("#location_A");
                    location_A.innerHTML = "";

                for(let item of result){
                    let option = document.createElement("option");
                    option.text = item.amphoe;
                    option.value = item.amphoe;
                    location_A.add(option);
                }
            });

            change_language_user();

            return location_A.value;
    }

    function change_location(){
        let location = document.querySelector("#location");
        let location_P = document.querySelector("#location_P");

        location.value = location_P.value;
        
    }

    function search_phone_insurance(){

        let name_insurance = document.querySelector("#name_insurance").value;

        if (name_insurance === "insurance_another") {

            document.querySelector('#insurance_another').classList.remove('d-none'),
            document.querySelector('#phone_insurance').setAttributeNode(document.createAttribute('required')),
            document.querySelector('#phone_insurance').value = "",
            document.querySelector('#phone_insurance').removeAttribute('readonly'),
            document.querySelector('#name_insurance_another').focus();

        } else { 

            document.querySelector('#insurance_another').classList.add('d-none'),
            document.querySelector('#phone_insurance').setAttributeNode(document.createAttribute('readonly')),
            document.querySelector('#phone_insurance').removeAttribute('required');
        

            fetch("{{ url('/') }}/api/phone_insurance/"+name_insurance+"/name_insurance")
                .then(response => response.json())
                .then(result => {
                    // console.log(result);
                    let phone_insurance = document.querySelector("#phone_insurance");
                        phone_insurance.value = result[0]['phone'] ;
                });
        }
    }

    function change_language_user()
    {
        let btn_change_language = document.querySelector('#btn_change_language');
            btn_change_language.href = "javascript:trocarIdioma('" + language_user +"')" ;
        
        var delayInMilliseconds = 1000; //1.5 second

        setTimeout(function() {
            document.querySelector('#btn_change_language').click();
        }, delayInMilliseconds);
    }
</script>
<script>
    function submitform() {
        var delayInMilliseconds = 3000; //3 second

        setTimeout(function() {
            document.querySelector('#btn_confirm_form').click();
        }, delayInMilliseconds);
    }
</script>

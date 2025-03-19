<input class="d-none" type="text" id="CountryCode" name="CountryCode" value="">

<div class="d-none" id="btn_tel"></div>

<!-- SOS ไทย -->
<div id="sos_TH" class="row notranslate d-none" style="margin-top:10px">
    @if( !empty($user->nationalitie) && !empty($nationalitie_tel) && $user->nationalitie != "Thai")
    <div class="col-12 mb-2">
        <a class="btn btn-danger btn-block shadow-box text-white" onclick="save_sos_content('embassy','{{ $nationalitie_tel }}');" style="background-color: #DB2D2E;"><i class="fas fa-phone-alt"></i>&nbsp;Embassy of {{$user->nationalitie}}
        </a>
    </div>
    <div class="col-12" style="margin-top:-20px;margin-bottom:-10px;">
        <hr>
    </div>
    @endif
    
    <div class="col-7">
        <p style="font-size:15px; text-align: center; margin-top:10px; ">เหตุด่วนเหตุร้าย</p>
    </div>
    <div class="col-5">
        <a class="btn btn-danger btn-block shadow-box text-white" onclick="save_sos_content('police','191');" style="background-color: #DB2D2E;"><i class="fas fa-phone-alt"></i>&nbsp; 191</a>
    </div>
    <div class="col-12" style="margin-top:-20px;margin-bottom:-10px;">
        <hr>
    </div>
    <div class="col-7">
        <p style="font-size:15px; text-align: center; margin-top:10px; ">จ.ส.100</p>
    </div>
    <div class="col-5">
        <a class="btn btn-danger btn-block shadow-box text-white" onclick="save_sos_content('js100','1137');" style=" background-color: #DB2D2E;"><i class="fas fa-phone-alt"></i>&nbsp; 1137</a>
    </div>
    <div class="col-12" style="margin-top:-20px;margin-bottom:-10px;">
        <hr>
    </div>
    <!-- <div class="col-7">
        <p style="font-size:15px; text-align: center; margin-top:10px; ">หน่วยแพทย์กู้ชีวิต</p>
    </div>
    <div class="col-5">
        <a class="btn btn-danger btn-block shadow-box text-white" onclick="save_sos_content('life_saving','1669');" style=" background-color: #DB2D2E;"><i class="fas fa-phone-alt"></i>&nbsp; 1669</a>
    </div> -->
    <!-- <div class="col-12" style="margin-top:-20px;margin-bottom:-10px;">
        <hr>
    </div> -->
    <div class="col-7">
        <p style="font-size:15px; text-align: center; margin-top:10px; ">ตำรวจท่องเที่ยว</p>
    </div>
    <div class="col-5">
        <a class="btn btn-danger btn-block shadow-box text-white" onclick="save_sos_content('tourist_police','1155');" style=" background-color: #DB2D2E;"><i class="fas fa-phone-alt"></i>&nbsp; 1155</a>
    </div>
    <div class="col-12" style="margin-top:-20px;margin-bottom:-10px;">
        <hr>
    </div>
    <div class="col-7">
        <p style="font-size:15px; text-align: center; margin-top:10px; ">สายด่วนทางหลวง</p>
    </div>
    <div class="col-5">
        <a class="btn btn-danger btn-block shadow-box text-white" onclick="save_sos_content('highway','1193');" style=" background-color: #DB2D2E;"><i class="fas fa-phone-alt"></i>&nbsp; 1193</a>
    </div>
    <div class="col-12" style="margin-top:-20px;margin-bottom:-10px;">
        <hr>
    </div>
    <div class="col-7">
        <p style="font-size:15px; text-align: center; margin-top:10px; ">ป่อเต็กตึ๊ง</p>
    </div>
    <div class="col-5">
        <a class="btn btn-danger btn-block shadow-box text-white" onclick="save_sos_content('pok_tek_tung','1418');" style=" background-color: #DB2D2E;"><i class="fas fa-phone-alt"></i>&nbsp; 1418</a>
    </div>

    <!-- <div class="col-6">
        <p style="font-size:15px; text-align: center; margin-top:10px; ">เหตุด่วนเหตุร้าย</p>
        <a class="btn btn-danger btn-block shadow-box text-white" onclick="save_sos_content('police','191');" style=" background-color: #DB2D2E;"><i class="fas fa-phone-alt"></i>&nbsp; 191</a>
    </div> -->
    <!-- <div class="col-6">
        <p style="font-size:15px; text-align: center; margin-top:10px; ">จ.ส.100</p>
        <a class="btn btn-danger btn-block shadow-box text-white" onclick="save_sos_content('js100','1137');" style=" background-color: #DB2D2E;"><i class="fas fa-phone-alt"></i>&nbsp; 1137</a>
    </div> -->
    <!-- <div class="col-6">
        <p style="font-size:15px; text-align: center; margin-top:10px; ">หน่วยแพทย์กู้ชีวิต</p>
        <a class="btn btn-danger btn-block shadow-box text-white" onclick="save_sos_content('life_saving','1669');" style=" background-color: #DB2D2E;"><i class="fas fa-phone-alt"></i>&nbsp; 1669</a>
    </div> -->
    <!-- <div class="col-6">
        <p style="font-size:15px; text-align: center; margin-top:10px; ">ตำรวจท่องเที่ยว</p>
        <a class="btn btn-danger btn-block shadow-box text-white" onclick="save_sos_content('tourist_police','1155');" style=" background-color: #DB2D2E;"><i class="fas fa-phone-alt"></i>&nbsp; 1155</a>
    </div>
    
    <div class="col-6">
        <p style="font-size:15px; text-align: center; margin-top:10px; ">สายด่วนทางหลวง</p>
        <a class="btn btn-danger btn-block shadow-box text-white" onclick="save_sos_content('highway','1193');" style=" background-color: #DB2D2E;"><i class="fas fa-phone-alt"></i>&nbsp; 1193</a>
    </div>
    <div class="col-6 ">
        <p style="font-size:15px; text-align: center; margin-top:10px; ">ป่อเต็กตึ๊ง</p>
        <a class="btn btn-danger btn-block shadow-box text-white" onclick="save_sos_content('pok_tek_tung','1418');" style=" background-color: #DB2D2E;"><i class="fas fa-phone-alt"></i>&nbsp; 1418</a>
    </div> -->

</div>
<!-- จบ SOS ไทย -->

<!-- SOS ลาว -->
<div id="sos_LA" class="row notranslate align-items-center d-none" style="margin-top:10px">
    <div class="col-12 mb-2">
        <span class="text-danger">
            * เป็นการติดต่อเจ้าหน้าที่ภายในประเทศลาว
        </span>
    </div>
    <div class="col-12 mb-2">
        <a class="btn btn-danger btn-block shadow-box text-white" onclick="save_sos_content('embassy','856-20-5551-2228');" style="background-color: #DB2D2E;"><i class="fas fa-phone-alt"></i>&nbsp; สถานทูตไทย ณ เวียงจันทน์
        </a>
    </div>
    <div class="col-12" style="margin-top:-20px;margin-bottom:-10px;">
        <hr>
    </div>
    <div class="col-7 text-center">
        <p style="font-size:15px; vertical-align: middle;margin:0px ">police</p>
    </div>
    <div class="col-5">
        <a class="btn btn-danger btn-block shadow-box text-white" onclick="save_sos_content('police','191');" style=" background-color: #DB2D2E;"><i class="fas fa-phone-alt"></i>&nbsp; 191</a>
    </div>
    <div class="col-12" style="margin-top:-8px;margin-bottom:-8px;">
        <hr class="align-items-center">
    </div>
    <div class="col-7 text-center">
        <p style="font-size:15px; vertical-align: middle;margin:0px ">ambulance</p>
    </div>
    <div class="col-5">
        <a class="btn btn-danger btn-block shadow-box text-white" onclick="save_sos_content('ambulance','195');" style=" background-color: #DB2D2E;"><i class="fas fa-phone-alt"></i>&nbsp; 195</a>
    </div>
    <div class="col-12" style="margin-top:-8px;margin-bottom:-8px;">
        <hr class="align-items-center">
    </div>
    <div class="col-7 text-center">
        <p style="font-size:15px; vertical-align: middle;margin:0px">fire</p>
    </div>
    <div class="col-5">
        <a class="btn btn-danger btn-block shadow-box text-white" onclick="save_sos_content('fire','190');" style=" background-color: #DB2D2E;"><i class="fas fa-phone-alt"></i>&nbsp; 190</a>
    </div>
    <div class="col-12" style="margin-top:-8px;margin-bottom:-8px;">
        <hr class="align-items-center">
    </div>
    <div class="col-7 text-center">
        <p style="font-size:15px; vertical-align: middle;margin:0px ">Touris police</p>
    </div>
    <div class="col-5">
        <a class="btn btn-danger btn-block shadow-box text-white" onclick="save_sos_content('tourist_police','192');" style=" background-color: #DB2D2E;"><i class="fas fa-phone-alt"></i>&nbsp; 192</a>
    </div>
    <div class="col-12" style="margin-top:-8px;margin-bottom:-8px;">
        <hr class="align-items-center">
    </div>
    <div class="col-7 text-center">
        <p style="font-size:15px; vertical-align: middle;margin:0px ">Electricity</p>
    </div>
    <div class="col-5">
        <a class="btn btn-danger btn-block shadow-box text-white" onclick="save_sos_content('electricity','1199');" style=" background-color: #DB2D2E;"><i class="fas fa-phone-alt"></i>&nbsp; 1199</a>
    </div>
    <div class="col-12" style="margin-top:-8px;margin-bottom:-8px;">
        <hr class="align-items-center">
    </div>
    <div class="col-7 text-center ">
        <p style="font-size:15px; vertical-align: middle;margin:0px ">Water</p>
    </div>
    <div class="col-5 d-flex">
        <a class="btn btn-danger btn-block shadow-box text-white" onclick="save_sos_content('water','1169');" style=" background-color: #DB2D2E;"><i class="fas fa-phone-alt"></i>&nbsp; 1169</a>
    </div>


    <!--     
    <div class="col-6">
        <p style="font-size:15px; text-align: center; margin-top:10px; ">police</p>
        <a class="btn btn-danger btn-block shadow-box text-white" onclick="save_sos_content('police','191');" style=" background-color: #DB2D2E;"><i class="fas fa-phone-alt"></i>&nbsp; 191</a>
    </div>
    <div class="col-6">
        <p style="font-size:15px; text-align: center; margin-top:10px; ">ambulance</p>
        <a class="btn btn-danger btn-block shadow-box text-white" onclick="save_sos_content('ambulance','195');" style=" background-color: #DB2D2E;"><i class="fas fa-phone-alt"></i>&nbsp; 195</a>
    </div>
    <div class="col-6">
        <p style="font-size:15px; text-align: center; margin-top:10px; ">fire</p>
        <a class="btn btn-danger btn-block shadow-box text-white" onclick="save_sos_content('fire','190');" style=" background-color: #DB2D2E;"><i class="fas fa-phone-alt"></i>&nbsp; 190</a>
    </div>
    <div class="col-6">
        <p style="font-size:15px; text-align: center; margin-top:10px; ">Touris police</p>
        <a class="btn btn-danger btn-block shadow-box text-white" onclick="save_sos_content('tourist_police','192');" style=" background-color: #DB2D2E;"><i class="fas fa-phone-alt"></i>&nbsp; 192</a>
    </div>
    <div class="col-6">
        <p style="font-size:15px; text-align: center; margin-top:10px; ">Electricity</p>
        <a class="btn btn-danger btn-block shadow-box text-white" onclick="save_sos_content('electricity','1199');" style=" background-color: #DB2D2E;"><i class="fas fa-phone-alt"></i>&nbsp; 1199</a>
    </div>
    <div class="col-6">
        <p style="font-size:15px; text-align: center; margin-top:10px; ">Water</p>
        <a class="btn btn-danger btn-block shadow-box text-white" onclick="save_sos_content('water','1169');" style=" background-color: #DB2D2E;"><i class="fas fa-phone-alt"></i>&nbsp; 1169</a>
    </div> -->
</div>
<!-- จบ SOS ลาว -->

<!-- SOS พม่า -->
<div id="sos_MM" class="row notranslate  align-items-center d-none" style="margin-top:10px;">
    <div class="col-12 mb-2">
        <span class="text-danger">
            * เป็นการติดต่อเจ้าหน้าที่ภายในประเทศเมียนม่า
        </span>
    </div>
    <div class="col-12 mb-2">
        <a class="btn btn-danger btn-block shadow-box text-white" onclick="save_sos_content('embassy','95-979-700-2801');" style="background-color: #DB2D2E;"><i class="fas fa-phone-alt"></i>&nbsp; สถานทูตไทย ณ กรุงย่างกุ้ง
        </a>
    </div>
    <div class="col-12" style="margin-top:-20px;margin-bottom:-10px;">
        <hr>
    </div>
    <div class="col-7 text-center">
        <p style="font-size:15px; vertical-align: middle;margin:0px ">police</p>
    </div>
    <div class="col-5">
        <a class="btn btn-danger btn-block shadow-box text-white" onclick="save_sos_content('police','199');" style=" background-color: #DB2D2E;"><i class="fas fa-phone-alt"></i>&nbsp; 199</a>
    </div>
    <div class="col-12" style="margin-top:-8px;margin-bottom:-8px;">
        <hr class="align-items-center">
    </div>
    <div class="col-7 text-center">
        <p style="font-size:15px; vertical-align: middle;margin:0px ">ambulance</p>
    </div>
    <div class="col-5">
        <a class="btn btn-danger btn-block shadow-box text-white" onclick="save_sos_content('ambulance','192');" style=" background-color: #DB2D2E;"><i class="fas fa-phone-alt"></i>&nbsp; 192</a>
    </div>
    <div class="col-12" style="margin-top:-8px;margin-bottom:-8px;">
        <hr class="align-items-center">
    </div>
    <div class="col-7 text-center">
        <p style="font-size:15px; vertical-align: middle;margin:0px">fire</p>
    </div>
    <div class="col-5">
        <a class="btn btn-danger btn-block shadow-box text-white" onclick="save_sos_content('fire','191');" style=" background-color: #DB2D2E;"><i class="fas fa-phone-alt"></i>&nbsp; 191</a>
    </div>
    <div class="col-12" style="margin-top:-8px;margin-bottom:-8px;">
        <hr class="align-items-center">
    </div>
    <div class="col-7 text-center">
        <p style="font-size:15px; vertical-align: middle;margin:0px">Highway police</p>
    </div>
    <div class="col-5">
        <a class="btn btn-danger btn-block shadow-box text-white" onclick="save_sos_content('highway_police','1880');" style=" background-color: #DB2D2E;"><i class="fas fa-phone-alt"></i>&nbsp; 1880</a>
    </div>
    <div class="col-12" style="margin-top:-8px;margin-bottom:-8px;">
        <hr class="align-items-center">
    </div>
    <div class="col-7 text-center">
        <p style="font-size:15px;  vertical-align: middle;margin:0px ">Emergency hotline</p>
    </div>
    <div class="col-5">
        <a class="btn btn-danger btn-block shadow-box text-white" onclick="save_sos_content('emergency_hotline','999');" style=" background-color: #DB2D2E;"><i class="fas fa-phone-alt"></i>&nbsp; 999</a>
    </div>
    <div class="col-12" style="margin-top:-8px;margin-bottom:-8px;">
        <hr class="align-items-center">
    </div>
    <div class="col-7 text-center ">
        <p style="font-size:15px;  vertical-align: middle;margin:0px">International hotline</p>
    </div>
    <div class="col-5 d-flex">
        <a class="btn btn-danger btn-block shadow-box text-white " onclick="save_sos_content('international_hotline','122');" style=" background-color: #DB2D2E;"><i class="fas fa-phone-alt"></i>&nbsp; 122</a>
    </div>



    <!-- <div class="col-6">
        <p style="font-size:15px; text-align: center; margin-top:10px; ">Police</p>
        <a class="btn btn-danger btn-block shadow-box text-white" onclick="save_sos_content('police','199');" style=" background-color: #DB2D2E;"><i class="fas fa-phone-alt"></i>&nbsp; 199</a>
    </div>
    <div class="col-6">
        <p style="font-size:15px; text-align: center; margin-top:10px; ">Ambulance</p>
        <a class="btn btn-danger btn-block shadow-box text-white" onclick="save_sos_content('ambulance','192');" style=" background-color: #DB2D2E;"><i class="fas fa-phone-alt"></i>&nbsp; 192</a>
    </div>
    <div class="col-6">
        <p style="font-size:15px; text-align: center; margin-top:10px; ">Fire</p>
        <a class="btn btn-danger btn-block shadow-box text-white" onclick="save_sos_content('fire','191');" style=" background-color: #DB2D2E;"><i class="fas fa-phone-alt"></i>&nbsp; 191</a>
    </div>
    <div class="col-6">
        <p style="font-size:15px; text-align: center; margin-top:10px; ">Highway police</p>
        <a class="btn btn-danger btn-block shadow-box text-white" onclick="save_sos_content('highway_police','1880');" style=" background-color: #DB2D2E;"><i class="fas fa-phone-alt"></i>&nbsp; 1880</a>
    </div> -->
    <!-- <div class="col-6">
        <p style="font-size:15px; text-align: center; margin-top:10px; ">Covid-19 call center</p>
        <a class="btn btn-danger btn-block shadow-box text-white" onclick="save_sos_content('covid-19_call_center','2019');" style=" background-color: #DB2D2E;"><i class="fas fa-phone-alt"></i>&nbsp; 2019</a>
    </div> -->

    <!-- <div class="col-6">
        <p style="font-size:15px; text-align: center; margin-top:10px; ">Emergency hotline</p>
        <a class="btn btn-danger btn-block shadow-box text-white" onclick="save_sos_content('emergency_hotline','999');" style=" background-color: #DB2D2E;"><i class="fas fa-phone-alt"></i>&nbsp; 999</a>
    </div>
    <div class="col-6">
        <p style="font-size:15px; text-align: center; margin-top:10px; ">International hotline</p>
        <a class="btn btn-danger btn-block shadow-box text-white" onclick="save_sos_content('international_hotline','122');" style=" background-color: #DB2D2E;"><i class="fas fa-phone-alt"></i>&nbsp; 122</a>
    </div> -->
</div>
<!-- จบ SOS พม่า -->

<!-- SOS บรูไน -->
<div id="sos_BN" class="row notranslate align-items-center d-none" style="margin-top:10px;">
    <div class="col-12 mb-2">
        <span class="text-danger">
            * เป็นการติดต่อเจ้าหน้าที่ภายในประเทศบรูไน
        </span>
    </div>
    <div class="col-12 mb-2">
        <a class="btn btn-danger btn-block shadow-box text-white" onclick="save_sos_content('embassy','673-876-2849');" style="background-color: #DB2D2E;"><i class="fas fa-phone-alt"></i>&nbsp; สถานทูตไทย ณ บันดาร์เสรีเบกาวัน
        </a>
    </div>
    <div class="col-12" style="margin-top:-20px;margin-bottom:-10px;">
        <hr>
    </div>
    <div class="col-7 text-center">
        <p style="font-size:15px; vertical-align: middle;margin:0px ">Police</p>
    </div>
    <div class="col-5">
        <a class="btn btn-danger btn-block shadow-box text-white" onclick="save_sos_content('police','993');" style=" background-color: #DB2D2E;"><i class="fas fa-phone-alt"></i>&nbsp; 993</a>
    </div>
    <div class="col-12" style="margin-top:-8px;margin-bottom:-8px;">
        <hr class="align-items-center">
    </div>
    <div class="col-7 text-center">
        <p style="font-size:15px; vertical-align: middle;margin:0px ">Ambulance</p>
    </div>
    <div class="col-5">
        <a class="btn btn-danger btn-block shadow-box text-white" onclick="save_sos_content('ambulance','991');" style=" background-color: #DB2D2E;"><i class="fas fa-phone-alt"></i>&nbsp; 991</a>
    </div>
    <div class="col-12" style="margin-top:-8px;margin-bottom:-8px;">
        <hr class="align-items-center">
    </div>
    <div class="col-7 text-center">
        <p style="font-size:15px; vertical-align: middle;margin:0px">FIRE Services</p>
    </div>
    <div class="col-5">
        <a class="btn btn-danger btn-block shadow-box text-white" onclick="save_sos_content('fire_services','995');" style=" background-color: #DB2D2E;"><i class="fas fa-phone-alt"></i>&nbsp; 995</a>
    </div>
    <div class="col-12" style="margin-top:-8px;margin-bottom:-8px;">
        <hr class="align-items-center">
    </div>
    <div class="col-7 text-center">
        <p style="font-size:15px; vertical-align: middle;margin:0px ">SEARCH & RESCUE</p>
    </div>
    <div class="col-5">
        <a class="btn btn-danger btn-block shadow-box text-white" onclick="save_sos_content('search_&_rescue','998');" style=" background-color: #DB2D2E;"><i class="fas fa-phone-alt"></i>&nbsp; 998</a>
    </div>
    <div class="col-12" style="margin-top:-8px;margin-bottom:-8px;">
        <hr class="align-items-center">
    </div>
    <div class="col-7 text-center">
        <p style="font-size:15px; vertical-align: middle;margin:0px ">Water</p>
    </div>
    <div class="col-5">
        <a class="btn btn-danger btn-block shadow-box text-white" onclick="save_sos_content('Water','140');" style=" background-color: #DB2D2E;"><i class="fas fa-phone-alt"></i>&nbsp;140</a>
    </div>
    <div class="col-12" style="margin-top:-8px;margin-bottom:-8px;">
        <hr class="align-items-center">
    </div>
    <div class="col-7 text-center ">
        <p style="font-size:15px; vertical-align: middle;margin:0px ">Covid-19 call center</p>
    </div>
    <div class="col-5 d-flex">
        <a class="btn btn-danger btn-block shadow-box text-white" onclick="save_sos_content('covid-19_call_center','123');" style=" background-color: #DB2D2E;"><i class="fas fa-phone-alt"></i>&nbsp; 123</a>
    </div>


    <!-- 
    <div class="col-6">
        <p style="font-size:15px; text-align: center; margin-top:10px; ">Police</p>
        <a class="btn btn-danger btn-block shadow-box text-white" onclick="save_sos_content('police','993');" style=" background-color: #DB2D2E;"><i class="fas fa-phone-alt"></i>&nbsp; 993</a>
    </div>
    <div class="col-6">
        <p style="font-size:15px; text-align: center; margin-top:10px; ">Ambulance</p>
        <a class="btn btn-danger btn-block shadow-box text-white" onclick="save_sos_content('ambulance','991');" style=" background-color: #DB2D2E;"><i class="fas fa-phone-alt"></i>&nbsp; 991</a>
    </div>
    <div class="col-6">
        <p style="font-size:15px; text-align: center; margin-top:10px; ">FIRE Services</p>
        <a class="btn btn-danger btn-block shadow-box text-white" onclick="save_sos_content('fire_services','995');" style=" background-color: #DB2D2E;"><i class="fas fa-phone-alt"></i>&nbsp; 995</a>
    </div>
    <div class="col-6">
        <p style="font-size:15px; text-align: center; margin-top:10px; ">SEARCH & RESCUE</p>
        <a class="btn btn-danger btn-block shadow-box text-white" onclick="save_sos_content('search_&_rescue','998');" style=" background-color: #DB2D2E;"><i class="fas fa-phone-alt"></i>&nbsp; 998</a>
    </div>
    <div class="col-6">
        <p style="font-size:15px; text-align: center; margin-top:10px; ">Water</p>
        <a class="btn btn-danger btn-block shadow-box text-white" onclick="save_sos_content('Water','140');" style=" background-color: #DB2D2E;"><i class="fas fa-phone-alt"></i>&nbsp;140</a>
    </div>
    <div class="col-6">
        <p style="font-size:15px; text-align: center; margin-top:10px; ">Covid-19 call center</p>
        <a class="btn btn-danger btn-block shadow-box text-white" onclick="save_sos_content('covid-19_call_center','123');" style=" background-color: #DB2D2E;"><i class="fas fa-phone-alt"></i>&nbsp; 123</a>
    </div> -->
</div>
<!-- จบ SOS บรูไน -->

<!-- SOS กัมพูชา -->
<div id="sos_KH" class="row notranslate align-items-center d-none" style="margin-top:10px;">
    <div class="col-12 mb-2">
        <span class="text-danger">
            * เป็นการติดต่อเจ้าหน้าที่ภายในประเทศกัมพูชา
        </span>
    </div>
    <div class="col-12 mb-2">
        <a class="btn btn-danger btn-block shadow-box text-white" onclick="save_sos_content('embassy','855-77-888-114');" style="background-color: #DB2D2E;"><i class="fas fa-phone-alt"></i>&nbsp; สถานทูตไทย ณ กรุงพนมเปญ
        </a>
    </div>
    <div class="col-12" style="margin-top:-20px;margin-bottom:-10px;">
        <hr>
    </div>
    <div class="col-7 text-center">
        <p style="font-size:15px; vertical-align: middle;margin:0px ">Police</p>
    </div>
    <div class="col-5">
        <a class="btn btn-danger btn-block shadow-box text-white" onclick="save_sos_content('police','117');" style=" background-color: #DB2D2E;"><i class="fas fa-phone-alt"></i>&nbsp; 117</a>
    </div>
    <div class="col-12" style="margin-top:-8px;margin-bottom:-8px;">
        <hr class="align-items-center">
    </div>
    <div class="col-7 text-center">
        <p style="font-size:15px; vertical-align: middle;margin:0px ">Ambulance</p>
    </div>
    <div class="col-5">
        <a class="btn btn-danger btn-block shadow-box text-white" onclick="save_sos_content('ambulance','119');" style=" background-color: #DB2D2E;"><i class="fas fa-phone-alt"></i>&nbsp; 119</a>
    </div>
    <div class="col-12" style="margin-top:-8px;margin-bottom:-8px;">
        <hr class="align-items-center">
    </div>
    <div class="col-7 text-center">
        <p style="font-size:15px; vertical-align: middle;margin:0px">FIRE Services</p>
    </div>
    <div class="col-5">
        <a class="btn btn-danger btn-block shadow-box text-white" onclick="save_sos_content('fire_services','666');" style=" background-color: #DB2D2E;"><i class="fas fa-phone-alt"></i>&nbsp; 666</a>
    </div>
    <div class="col-12" style="margin-top:-8px;margin-bottom:-8px;">
        <hr class="align-items-center">
    </div>
    <div class="col-7 text-center">
        <p style="font-size:15px; vertical-align: middle;margin:0px ">Electricity</p>
    </div>
    <div class="col-5">
        <a class="btn btn-danger btn-block shadow-box text-white" onclick="save_sos_content('electricity','023-723-871');" style=" background-color: #DB2D2E; font-size:10px;"><i class="fas fa-phone-alt"></i>&nbsp; <br> 023-723-871</a>
    </div>
    <div class="col-12" style="margin-top:-8px;margin-bottom:-8px;">
        <hr class="align-items-center">
    </div>
    <div class="col-7 text-center">
        <p style="font-size:15px; vertical-align: middle;margin:0px ">Traffic Police</p>
    </div>
    <div class="col-5">
        <a class="btn btn-danger btn-block shadow-box text-white" onclick="save_sos_content('traffic_police','012-896-628');" style=" background-color: #DB2D2E; font-size:10px;"><i class="fas fa-phone-alt"></i>&nbsp; <br> 012-896-628</a>
    </div>
    <div class="col-12" style="margin-top:-8px;margin-bottom:-8px;">
        <hr class="align-items-center">
    </div>
    <div class="col-7 text-center ">
        <p style="font-size:15px; vertical-align: middle;margin:0px ">Covid-19 call center</p>
    </div>
    <div class="col-5 d-flex">
        <a class="btn btn-danger btn-block shadow-box text-white" onclick="save_sos_content('covid-19_call_center','115');" style=" background-color: #DB2D2E;"><i class="fas fa-phone-alt"></i>&nbsp; 115</a>
    </div>
    <!-- 

    <div class="col-6">
        <p style="font-size:15px; text-align: center; margin-top:10px; ">Police</p>
        <a class="btn btn-danger btn-block shadow-box text-white" onclick="save_sos_content('police','117');" style=" background-color: #DB2D2E;"><i class="fas fa-phone-alt"></i>&nbsp; 117</a>
    </div>
    <div class="col-6">
        <p style="font-size:15px; text-align: center; margin-top:10px; ">Ambulance</p>
        <a class="btn btn-danger btn-block shadow-box text-white" onclick="save_sos_content('ambulance','119');" style=" background-color: #DB2D2E;"><i class="fas fa-phone-alt"></i>&nbsp; 119</a>
    </div>
    <div class="col-6">
        <p style="font-size:15px; text-align: center; margin-top:10px; ">FIRE Services</p>
        <a class="btn btn-danger btn-block shadow-box text-white" onclick="save_sos_content('fire_services','666');" style=" background-color: #DB2D2E;"><i class="fas fa-phone-alt"></i>&nbsp; 666</a>
    </div>
    <div class="col-6">
        <p style="font-size:15px; text-align: center; margin-top:10px; ">Covid-19 call center</p>
        <a class="btn btn-danger btn-block shadow-box text-white" onclick="save_sos_content('covid-19_call_center','115');" style=" background-color: #DB2D2E;"><i class="fas fa-phone-alt"></i>&nbsp; 115</a>
    </div>
    <div class="col-6">
        <p style="font-size:15px; text-align: center; margin-top:10px; ">Traffic Police</p>
        <a class="btn btn-danger btn-block shadow-box text-white" onclick="save_sos_content('traffic_police','012-896-628');" style=" background-color: #DB2D2E;"><i class="fas fa-phone-alt"></i>&nbsp; 012-896-628</a>
    </div>
    <div class="col-6">
        <p style="font-size:15px; text-align: center; margin-top:10px; ">Electricity</p>
        <a class="btn btn-danger btn-block shadow-box text-white" onclick="save_sos_content('electricity','023-723-871');" style=" background-color: #DB2D2E;"><i class="fas fa-phone-alt"></i>&nbsp; 023-723-871</a>
    </div> -->
</div>
<!-- จบ SOS กัมพูชา -->


<!-- SOS อินโดนีเซีย -->
<div id="sos_ID" class="row notranslate align-items-center d-none" style="margin-top:10px;">
    <div class="col-12 mb-2">
        <span class="text-danger">
            * เป็นการติดต่อเจ้าหน้าที่ภายในประเทศอินโดนีเซีย
        </span>
    </div>
    <div class="col-12 mb-2">
        <a class="btn btn-danger btn-block shadow-box text-white" onclick="save_sos_content('embassy','62-811-186-253');" style="background-color: #DB2D2E;"><i class="fas fa-phone-alt"></i>&nbsp; สถานทูตไทย ณ กรุงจาการ์ตา
        </a>
    </div>
    <div class="col-12" style="margin-top:-20px;margin-bottom:-10px;">
        <hr>
    </div>
    <div class="col-7 text-center">
        <p style="font-size:15px; vertical-align: middle;margin:0px ">Police</p>
    </div>
    <div class="col-5">
        <a class="btn btn-danger btn-block shadow-box text-white" onclick="save_sos_content('police','110');" style=" background-color: #DB2D2E;"><i class="fas fa-phone-alt"></i>&nbsp; 110</a>
    </div>
    <div class="col-12" style="margin-top:-8px;margin-bottom:-8px;">
        <hr class="align-items-center">
    </div>
    <div class="col-7 text-center">
        <p style="font-size:15px; vertical-align: middle;margin:0px ">Ambulance</p>
    </div>
    <div class="col-5">
        <a class="btn btn-danger btn-block shadow-box text-white" onclick="save_sos_content('ambulance','118');" style=" background-color: #DB2D2E;"><i class="fas fa-phone-alt"></i>&nbsp; 118</a>
    </div>
    <div class="col-12" style="margin-top:-8px;margin-bottom:-8px;">
        <hr class="align-items-center">
    </div>
    <div class="col-7 text-center">
        <p style="font-size:15px; vertical-align: middle;margin:0px">FIRE Services</p>
    </div>
    <div class="col-5">
        <a class="btn btn-danger btn-block shadow-box text-white" onclick="save_sos_content('fire_services','113');" style=" background-color: #DB2D2E;"><i class="fas fa-phone-alt"></i>&nbsp; 113</a>
    </div>
    <div class="col-12" style="margin-top:-8px;margin-bottom:-8px;">
        <hr class="align-items-center">
    </div>
    <div class="col-7 text-center">
        <p style="font-size:15px; vertical-align: middle;margin:0px ">SEARCH & RESCUE</p>
    </div>
    <div class="col-5">
        <a class="btn btn-danger btn-block shadow-box text-white" onclick="save_sos_content('search_&_rescue','115');" style=" background-color: #DB2D2E;"><i class="fas fa-phone-alt"></i>&nbsp; 115</a>
    </div>
    <div class="col-12" style="margin-top:-8px;margin-bottom:-8px;">
        <hr class="align-items-center">
    </div>
    <div class="col-7 text-center">
        <p style="font-size:15px; vertical-align: middle;margin:0px ">Electricity emergency</p>
    </div>
    <div class="col-5">
        <a class="btn btn-danger btn-block shadow-box text-white" onclick="save_sos_content('electricity_emergency ','123');" style=" background-color: #DB2D2E;"><i class="fas fa-phone-alt"></i>&nbsp; 123</a>
    </div>
    <div class="col-12" style="margin-top:-8px;margin-bottom:-8px;">
        <hr class="align-items-center">
    </div>
    <div class="col-7 text-center ">
        <p style="font-size:15px; vertical-align: middle;margin:0px ">Natural disasters</p>
    </div>
    <div class="col-5 d-flex">
        <a class="btn btn-danger btn-block shadow-box text-white" onclick="save_sos_content('natural_disasters ','129');" style=" background-color: #DB2D2E;"><i class="fas fa-phone-alt"></i>&nbsp; 129</a>
    </div>

    <!-- 
    <div class="col-6">
        <p style="font-size:15px; text-align: center; margin-top:10px; ">Police</p>
        <a class="btn btn-danger btn-block shadow-box text-white" onclick="save_sos_content('police','110');" style=" background-color: #DB2D2E;"><i class="fas fa-phone-alt"></i>&nbsp; 110</a>
    </div>
    <div class="col-6">
        <p style="font-size:15px; text-align: center; margin-top:10px; ">Ambulance</p>
        <a class="btn btn-danger btn-block shadow-box text-white" onclick="save_sos_content('ambulance','118');" style=" background-color: #DB2D2E;"><i class="fas fa-phone-alt"></i>&nbsp; 118</a>
    </div>
    <div class="col-6">
        <p style="font-size:15px; text-align: center; margin-top:10px; ">FIRE Services</p>
        <a class="btn btn-danger btn-block shadow-box text-white" onclick="save_sos_content('fire_services','113');" style=" background-color: #DB2D2E;"><i class="fas fa-phone-alt"></i>&nbsp; 113</a>
    </div>
    <div class="col-6">
        <p style="font-size:15px; text-align: center; margin-top:10px; ">SEARCH & RESCUE</p>
        <a class="btn btn-danger btn-block shadow-box text-white" onclick="save_sos_content('search_&_rescue','115');" style=" background-color: #DB2D2E;"><i class="fas fa-phone-alt"></i>&nbsp; 115</a>
    </div>
    <div class="col-6">
        <p style="font-size:15px; text-align: center; margin-top:10px; ">Electricity emergency </p>
        <a class="btn btn-danger btn-block shadow-box text-white" onclick="save_sos_content('electricity_emergency ','123');" style=" background-color: #DB2D2E;"><i class="fas fa-phone-alt"></i>&nbsp; 123</a>
    </div>
    <div class="col-6">
        <p style="font-size:15px; text-align: center; margin-top:10px; ">Natural disasters </p>
        <a class="btn btn-danger btn-block shadow-box text-white" onclick="save_sos_content('natural_disasters ','129');" style=" background-color: #DB2D2E;"><i class="fas fa-phone-alt"></i>&nbsp; 129</a>
    </div> -->
</div>
<!-- จบ SOS อินโดนีเซีย -->

<!-- SOS มาเลเซีย -->
<div id="sos_MY" class="row d-none align-items-center notranslate" style="margin-top:10px;">
    <div class="col-12 mb-2">
        <span class="text-danger">
            * เป็นการติดต่อเจ้าหน้าที่ภายในประเทศมาเลเซีย
        </span>
    </div>
    <div class="col-12 mb-2">
        <a class="btn btn-danger btn-block shadow-box text-white" onclick="save_sos_content('embassy','60-17700-4822');" style="background-color: #DB2D2E;"><i class="fas fa-phone-alt"></i>&nbsp; สถานทูตไทย ณ กรุงกัวลาลัมเปอร์
        </a>
    </div>
    <div class="col-12" style="margin-top:-20px;margin-bottom:-10px;">
        <hr>
    </div>
    <div class="col-7 text-center">
        <p style="font-size:15px; vertical-align: middle;margin:0px ">Police/Ambulance</p>
    </div>
    <div class="col-5">
        <a class="btn btn-danger btn-block shadow-box text-white" onclick="save_sos_content('police_ambulance','999');" style=" background-color: #DB2D2E;"><i class="fas fa-phone-alt"></i>&nbsp; 999</a>
    </div>
    <div class="col-12" style="margin-top:-8px;margin-bottom:-8px;">
        <hr class="align-items-center">
    </div>
    <div class="col-7 text-center">
        <p style="font-size:15px; vertical-align: middle;margin:0px ">Fire/Rescue</p>
    </div>
    <div class="col-5">
        <a class="btn btn-danger btn-block shadow-box text-white" onclick="save_sos_content('Fire_Rescue','994');" style=" background-color: #DB2D2E;"><i class="fas fa-phone-alt"></i>&nbsp; 994</a>
    </div>
    <div class="col-12" style="margin-top:-8px;margin-bottom:-8px;">
        <hr class="align-items-center">
    </div>
    <div class="col-7 text-center">
        <p style="font-size:15px; vertical-align: middle;margin:0px">Civil Defence</p>
    </div>
    <div class="col-5">
        <a class="btn btn-danger btn-block shadow-box text-white" onclick="save_sos_content('civil_defence','991');" style=" background-color: #DB2D2E;"><i class="fas fa-phone-alt"></i>&nbsp; 991</a>
    </div>
    <div class="col-12" style="margin-top:-8px;margin-bottom:-8px;">
        <hr class="align-items-center">
    </div>
    <div class="col-7 text-center">
        <p style="font-size:15px; vertical-align: middle;margin:0px ">Gas emergency</p>
    </div>
    <div class="col-5">
        <a class="btn btn-danger btn-block shadow-box text-white" onclick="save_sos_content('gas_emergency  ','995');" style=" background-color: #DB2D2E;"><i class="fas fa-phone-alt"></i>&nbsp; 995</a>
    </div>
    <div class="col-12" style="margin-top:-8px;margin-bottom:-8px;">
        <hr class="align-items-center">
    </div>
    <div class="col-7 text-center">
        <p style="font-size:15px; vertical-align: middle;margin:0px ">Power failure</p>
    </div>
    <div class="col-5">
        <a class="btn btn-danger btn-block shadow-box text-white" onclick="save_sos_content('power_failure','15454');" style=" background-color: #DB2D2E;font-size:15px"><i class="fas fa-phone-alt"></i>&nbsp; 15454</a>
    </div>
    <div class="col-12" style="margin-top:-8px;margin-bottom:-8px;">
        <hr class="align-items-center">
    </div>
    <div class="col-7 text-center ">
        <p style="font-size:15px; vertical-align: middle;margin:0px ">Tourist Police Hotline</p>
    </div>
    <div class="col-5 d-flex">
        <a class="btn btn-danger btn-block shadow-box text-white" onclick="save_sos_content('tourist_police_hotline','03-2149-6590');" style=" background-color: #DB2D2E;font-size:12px"><i class="fas fa-phone-alt"></i>&nbsp; 03-2149-6590</a>
    </div>

    <!-- 
    <div class="col-6">
        <p style="font-size:15px; text-align: center; margin-top:10px; ">Police/Ambulance</p>
        <a class="btn btn-danger btn-block shadow-box text-white" onclick="save_sos_content('police_ambulance','999');" style=" background-color: #DB2D2E;"><i class="fas fa-phone-alt"></i>&nbsp; 999</a>
    </div>
    <div class="col-6">
        <p style="font-size:15px; text-align: center; margin-top:10px; ">Fire/Rescue</p>
        <a class="btn btn-danger btn-block shadow-box text-white" onclick="save_sos_content('Fire_Rescue','994');" style=" background-color: #DB2D2E;"><i class="fas fa-phone-alt"></i>&nbsp; 994</a>
    </div>
    <div class="col-6">
        <p style="font-size:15px; text-align: center; margin-top:10px; ">Civil Defence</p>
        <a class="btn btn-danger btn-block shadow-box text-white" onclick="save_sos_content('civil_defence','991');" style=" background-color: #DB2D2E;"><i class="fas fa-phone-alt"></i>&nbsp; 991</a>
    </div>
    <div class="col-6">
        <p style="font-size:15px; text-align: center; margin-top:10px; ">Gas emergency</p>
        <a class="btn btn-danger btn-block shadow-box text-white" onclick="save_sos_content('gas_emergency  ','995');" style=" background-color: #DB2D2E;"><i class="fas fa-phone-alt"></i>&nbsp; 995</a>
    </div>
    <div class="col-6">
        <p style="font-size:15px; text-align: center; margin-top:10px; ">Power failure</p>
        <a class="btn btn-danger btn-block shadow-box text-white" onclick="save_sos_content('power_failure','15454');" style=" background-color: #DB2D2E;"><i class="fas fa-phone-alt"></i>&nbsp; 15454</a>
    </div>
    <div class="col-6">
        <p style="font-size:15px; text-align: center; margin-top:10px; ">Tourist Police Hotline</p>
        <a class="btn btn-danger btn-block shadow-box text-white" onclick="save_sos_content('tourist_police_hotline','03-2149-6590');" style=" background-color: #DB2D2E;"><i class="fas fa-phone-alt"></i>&nbsp; 03-2149-6590</a>
    </div> -->
</div>
<!-- จบ SOS มาเลเซีย -->


<!-- SOS ฟิลิปปินส์ -->
<div id="sos_PH" class="row d-none align-items-center notranslate" style="margin-top:10px;">
    <div class="col-12 mb-2">
        <span class="text-danger">
            * เป็นการติดต่อเจ้าหน้าที่ภายในประเทศฟิลิปปินส์
        </span>
    </div>
    <div class="col-12 mb-2">
        <a class="btn btn-danger btn-block shadow-box text-white" onclick="save_sos_content('embassy','63-917-806-3977');" style="background-color: #DB2D2E;"><i class="fas fa-phone-alt"></i>&nbsp; สถานทูตไทย ณ กรุงมะนิลา
        </a>
    </div>
    <div class="col-12" style="margin-top:-20px;margin-bottom:-10px;">
        <hr>
    </div>
    <div class="col-7 text-center">
        <p style="font-size:15px; vertical-align: middle;margin:0px ">Police</p>
    </div>
    <div class="col-5">
        <a class="btn btn-danger btn-block shadow-box text-white" onclick="save_sos_content('police','113');" style=" background-color: #DB2D2E;"><i class="fas fa-phone-alt"></i>&nbsp; 113</a>
    </div>
    <div class="col-12" style="margin-top:-8px;margin-bottom:-8px;">
        <hr class="align-items-center">
    </div>
    <div class="col-7 text-center">
        <p style="font-size:15px; vertical-align: middle;margin:0px ">Ambulance</p>
    </div>
    <div class="col-5">
        <a class="btn btn-danger btn-block shadow-box text-white" onclick="save_sos_content('ambulance','115');" style=" background-color: #DB2D2E;"><i class="fas fa-phone-alt"></i>&nbsp; 115</a>
    </div>
    <div class="col-12" style="margin-top:-8px;margin-bottom:-8px;">
        <hr class="align-items-center">
    </div>
    <div class="col-7 text-center">
        <p style="font-size:15px; vertical-align: middle;margin:0px">FIRE Services</p>
    </div>
    <div class="col-5">
        <a class="btn btn-danger btn-block shadow-box text-white" onclick="save_sos_content('fire','114');" style=" background-color: #DB2D2E;"><i class="fas fa-phone-alt"></i>&nbsp; 114</a>
    </div>
    <div class="col-12" style="margin-top:-8px;margin-bottom:-8px;">
        <hr class="align-items-center">
    </div>
    <div class="col-7 text-center">
        <p style="font-size:15px; vertical-align: middle;margin:0px ">SEARCH & RESCUE</p>
    </div>
    <div class="col-5">
        <a class="btn btn-danger btn-block shadow-box text-white" onclick="save_sos_content('search_&_rescue','112');" style=" background-color: #DB2D2E;"><i class="fas fa-phone-alt"></i>&nbsp; 112</a>
    </div>
    <div class="col-12" style="margin-top:-8px;margin-bottom:-8px;">
        <hr class="align-items-center">
    </div>
    <div class="col-7 text-center">
        <p style="font-size:15px; vertical-align: middle;margin:0px ">Directory Assistance</p>
    </div>
    <div class="col-5">
        <a class="btn btn-danger btn-block shadow-box text-white" onclick="save_sos_content('directory_assistance ','116');" style=" background-color: #DB2D2E;"><i class="fas fa-phone-alt"></i>&nbsp; 116</a>
    </div>
    <div class="col-12" style="margin-top:-8px;margin-bottom:-8px;">
        <hr class="align-items-center">
    </div>
    <div class="col-7 text-center ">
        <p style="font-size:15px; vertical-align: middle;margin:0px ">International Operator</p>
    </div>
    <div class="col-5 d-flex">
        <a class="btn btn-danger btn-block shadow-box text-white" onclick="save_sos_content('international_operator','110');" style=" background-color: #DB2D2E;"><i class="fas fa-phone-alt"></i>&nbsp; 110</a>
    </div>



    <!-- <div class="col-6">
        <p style="font-size:15px; text-align: center; margin-top:10px; ">Police</p>
        <a class="btn btn-danger btn-block shadow-box text-white" onclick="save_sos_content('police','113');" style=" background-color: #DB2D2E;"><i class="fas fa-phone-alt"></i>&nbsp; 113</a>
    </div>
    <div class="col-6">
        <p style="font-size:15px; text-align: center; margin-top:10px; ">Ambulance</p>
        <a class="btn btn-danger btn-block shadow-box text-white" onclick="save_sos_content('ambulance','115');" style=" background-color: #DB2D2E;"><i class="fas fa-phone-alt"></i>&nbsp; 115</a>
    </div>
    <div class="col-6">
        <p style="font-size:15px; text-align: center; margin-top:10px; ">FIRE Services</p>
        <a class="btn btn-danger btn-block shadow-box text-white" onclick="save_sos_content('fire','114');" style=" background-color: #DB2D2E;"><i class="fas fa-phone-alt"></i>&nbsp; 114</a>
    </div>
    <div class="col-6">
        <p style="font-size:15px; text-align: center; margin-top:10px; ">SEARCH & RESCUE</p>
        <a class="btn btn-danger btn-block shadow-box text-white" onclick="save_sos_content('search_&_rescue','112');" style=" background-color: #DB2D2E;"><i class="fas fa-phone-alt"></i>&nbsp; 112</a>
    </div>
    <div class="col-6">
        <p style="font-size:15px; text-align: center; margin-top:10px; ">Directory Assistance</p>
        <a class="btn btn-danger btn-block shadow-box text-white" onclick="save_sos_content('directory_assistance ','116');" style=" background-color: #DB2D2E;"><i class="fas fa-phone-alt"></i>&nbsp; 116</a>
    </div>
    <div class="col-6">
        <p style="font-size:15px; text-align: center; margin-top:10px; ">International Operator</p>
        <a class="btn btn-danger btn-block shadow-box text-white" onclick="save_sos_content('international_operator','110');" style=" background-color: #DB2D2E;"><i class="fas fa-phone-alt"></i>&nbsp; 110</a>
    </div> -->
</div>
<!-- จบ SOS ฟิลิปปินส์ -->
<!-- SOS สิงคโปร์ -->
<div id="sos_SG" class="row d-none align-items-center notranslate" style="margin-top:10px;">
    <div class="col-12 mb-2">
        <span class="text-danger">
            * เป็นการติดต่อเจ้าหน้าที่ภายในประเทศสิงคโปร์
        </span>
    </div>
    <div class="col-12 mb-2">
        <a class="btn btn-danger btn-block shadow-box text-white" onclick="save_sos_content('embassy','65-84210105');" style="background-color: #DB2D2E;"><i class="fas fa-phone-alt"></i>&nbsp; สถานทูตไทย ณ สิงคโปร์
        </a>
    </div>
    <div class="col-12" style="margin-top:-20px;margin-bottom:-10px;">
        <hr>
    </div>
    <div class="col-7 text-center">
        <p style="font-size:15px; vertical-align: middle;margin:0px ">Police</p>
    </div>
    <div class="col-5">
        <a class="btn btn-danger btn-block shadow-box text-white" onclick="save_sos_content('police','999');" style=" background-color: #DB2D2E;"><i class="fas fa-phone-alt"></i>&nbsp; 999</a>
    </div>
    <div class="col-12" style="margin-top:-8px;margin-bottom:-8px;">
        <hr class="align-items-center">
    </div>
    <div class="col-7 text-center">
        <p style="font-size:15px; vertical-align: middle;margin:0px ">emergencies</p>
    </div>
    <div class="col-5">
        <a class="btn btn-danger btn-block shadow-box text-white" onclick="save_sos_content('emergencies','995');" style=" background-color: #DB2D2E;"><i class="fas fa-phone-alt"></i>&nbsp; 995</a>
    </div>
    <div class="col-12" style="margin-top:-8px;margin-bottom:-8px;">
        <hr class="align-items-center">
    </div>
    <div class="col-7 text-center">
        <p style="font-size:15px; vertical-align: middle;margin:0px">Non-emergency Ambulance</p>
    </div>
    <div class="col-5">
        <a class="btn btn-danger btn-block shadow-box text-white" onclick="save_sos_content('Non_emergency','110');" style=" background-color: #DB2D2E;"><i class="fas fa-phone-alt"></i>&nbsp; 110</a>
    </div>
    <div class="col-12" style="margin-top:-8px;margin-bottom:-8px;">
        <hr class="align-items-center">
    </div>
    <div class="col-7 text-center">
        <p style="font-size:15px; vertical-align: middle;margin:0px ">Pet Ambulance And Transport</p>
    </div>
    <div class="col-5">
        <a class="btn btn-danger btn-block shadow-box text-white" onclick="save_sos_content('pet_ambulance','116');" style=" background-color: #DB2D2E;"><i class="fas fa-phone-alt"></i>&nbsp; 116</a>
    </div>
    <div class="col-12" style="margin-top:-8px;margin-bottom:-8px;">
        <hr class="align-items-center">
    </div>
    <div class="col-7 text-center">
        <p style="font-size:15px; vertical-align: middle;margin:0px ">Traffic Police</p>
    </div>
    <div class="col-5">
        <a class="btn btn-danger btn-block shadow-box text-white" onclick="save_sos_content('traffic_police','6547-0000');" style=" background-color: #DB2D2E;font-size:12px;"><i class="fas fa-phone-alt" style="font-size:15px;"></i> <br> 6547-0000</a>
    </div>
    <div class="col-12" style="margin-top:-8px;margin-bottom:-8px;">
        <hr class="align-items-center">
    </div>
    <div class="col-7 text-center ">
        <p style="font-size:15px; vertical-align: middle;margin:0px ">Emergency Road Service</p>
    </div>
    <div class="col-5 d-flex">
        <a class="btn btn-danger btn-block shadow-box text-white" onclick="save_sos_content('road_service','6748-9911');" style=" background-color: #DB2D2E;font-size:12px;"><i class="fas fa-phone-alt" style="font-size:15px;"></i> <br> 6748-9911</a>
    </div>

    <!-- 
    <div class="col-6">
        <p style="font-size:15px; text-align: center; margin-top:10px; ">Police</p>
        <a class="btn btn-danger btn-block shadow-box text-white" onclick="save_sos_content('police','999');" style=" background-color: #DB2D2E;"><i class="fas fa-phone-alt"></i>&nbsp; 999</a>
    </div>
    <div class="col-6">
        <p style="font-size:15px; text-align: center; margin-top:10px; ">emergencies</p>
        <a class="btn btn-danger btn-block shadow-box text-white" onclick="save_sos_content('emergencies','995');" style=" background-color: #DB2D2E;"><i class="fas fa-phone-alt"></i>&nbsp; 995</a>
    </div>
    <div class="col-6">
        <p style="font-size:15px; text-align: center; margin-top:10px; ">Non-emergency Ambulance</p>
        <a class="btn btn-danger btn-block shadow-box text-white" onclick="save_sos_content('Non_emergency','110');" style=" background-color: #DB2D2E;"><i class="fas fa-phone-alt"></i>&nbsp; 110</a>
    </div>
    <div class="col-6">
        <p style="font-size:15px; text-align: center; margin-top:10px; ">Pet Ambulance And Transport</p>
        <a class="btn btn-danger btn-block shadow-box text-white" onclick="save_sos_content('pet_ambulance','116');" style=" background-color: #DB2D2E;"><i class="fas fa-phone-alt"></i>&nbsp; 116</a>
    </div>
    <div class="col-6">
        <p style="font-size:15px; text-align: center; margin-top:10px; ">Traffic Police</p>
        <a class="btn btn-danger btn-block shadow-box text-white" onclick="save_sos_content('traffic_police','6547-0000');" style=" background-color: #DB2D2E;"><i class="fas fa-phone-alt"></i>&nbsp; 6547-0000</a>
    </div>
    <div class="col-6">
        <p style="font-size:15px; text-align: center; margin-top:10px; ">Emergency Road Service</p>
        <a class="btn btn-danger btn-block shadow-box text-white" onclick="save_sos_content('road_service','6748-9911');" style=" background-color: #DB2D2E;"><i class="fas fa-phone-alt"></i>&nbsp; 6748-9911</a>
    </div> -->
</div>
<!-- จบ SOS สิงคโปร์ -->
<!-- SOS เวียดนาม -->
<div id="sos_VN" class="row d-none align-items-center notranslate" style="margin-top:10px;">
    <div class="col-12 mb-2">
        <span class="text-danger">
            * เป็นการติดต่อเจ้าหน้าที่ภายในประเทศเวียดนาม
        </span>
    </div>
    <div class="col-12 mb-2">
        <a class="btn btn-danger btn-block shadow-box text-white" onclick="save_sos_content('embassy','84-904-544800');" style="background-color: #DB2D2E;"><i class="fas fa-phone-alt"></i>&nbsp; สถานทูตไทย ณ กรุงฮานอย
        </a>
    </div>
    <div class="col-12" style="margin-top:-20px;margin-bottom:-10px;">
        <hr>
    </div>
    <div class="col-7 text-center">
        <p style="font-size:15px; vertical-align: middle;margin:0px ">Police</p>
    </div>
    <div class="col-5">
        <a class="btn btn-danger btn-block shadow-box text-white" onclick="save_sos_content('directory_assistance','116');" style=" background-color: #DB2D2E;"><i class="fas fa-phone-alt"></i>&nbsp; 116</a>
    </div>
    <div class="col-12" style="margin-top:-8px;margin-bottom:-8px;">
        <hr class="align-items-center">
    </div>
    <div class="col-7 text-center">
        <p style="font-size:15px; vertical-align: middle;margin:0px ">Ambulance</p>
    </div>
    <div class="col-5">
        <a class="btn btn-danger btn-block shadow-box text-white" onclick="save_sos_content('search_and_rescue ','112');" style=" background-color: #DB2D2E;"><i class="fas fa-phone-alt"></i>&nbsp; 112</a>
    </div>
    <div class="col-12" style="margin-top:-8px;margin-bottom:-8px;">
        <hr class="align-items-center">
    </div>
    <div class="col-7 text-center">
        <p style="font-size:15px; vertical-align: middle;margin:0px">Fire</p>
    </div>
    <div class="col-5">
        <a class="btn btn-danger btn-block shadow-box text-white" onclick="save_sos_content('general','1080');" style=" background-color: #DB2D2E;"><i class="fas fa-phone-alt"></i>&nbsp; 1080</a>
    </div>
    <div class="col-12" style="margin-top:-8px;margin-bottom:-8px;">
        <hr class="align-items-center">
    </div>
    <div class="col-7 text-center">
        <p style="font-size:15px; vertical-align: middle;margin:0px ">General Information Service</p>
    </div>
    <div class="col-5">
        <a class="btn btn-danger btn-block shadow-box text-white" onclick="save_sos_content('fire','114');" style=" background-color: #DB2D2E;"><i class="fas fa-phone-alt"></i>&nbsp; 114</a>
    </div>
    <div class="col-12" style="margin-top:-8px;margin-bottom:-8px;">
        <hr class="align-items-center">
    </div>
    <div class="col-7 text-center">
        <p style="font-size:15px; vertical-align: middle;margin:0px ">Search and Rescue</p>
    </div>
    <div class="col-5">
        <a class="btn btn-danger btn-block shadow-box text-white" onclick="save_sos_content('ambulance','115');" style=" background-color: #DB2D2E;"><i class="fas fa-phone-alt"></i>&nbsp; 115</a>
    </div>
    <div class="col-12" style="margin-top:-8px;margin-bottom:-8px;">
        <hr class="align-items-center">
    </div>
    <div class="col-7 text-center ">
        <p style="font-size:15px; vertical-align: middle;margin:0px ">Directory Assistance</p>
    </div>
    <div class="col-5 d-flex">
        <a class="btn btn-danger btn-block shadow-box text-white" onclick="save_sos_content('police','113');" style=" background-color: #DB2D2E;"><i class="fas fa-phone-alt"></i>&nbsp; 113</a>
    </div>

    <!-- <div class="col-6">
        <p style="font-size:15px; text-align: center; margin-top:10px; ">Police</p>
        <a class="btn btn-danger btn-block shadow-box text-white" onclick="save_sos_content('police','113');" style=" background-color: #DB2D2E;"><i class="fas fa-phone-alt"></i>&nbsp; 113</a>
    </div>
    <div class="col-6">
        <p style="font-size:15px; text-align: center; margin-top:10px; ">Ambulance</p>
        <a class="btn btn-danger btn-block shadow-box text-white" onclick="save_sos_content('ambulance','115');" style=" background-color: #DB2D2E;"><i class="fas fa-phone-alt"></i>&nbsp; 115</a>
    </div>
    <div class="col-6">
        <p style="font-size:15px; text-align: center; margin-top:10px; ">Fire</p>
        <a class="btn btn-danger btn-block shadow-box text-white" onclick="save_sos_content('fire','114');" style=" background-color: #DB2D2E;"><i class="fas fa-phone-alt"></i>&nbsp; 114</a>
    </div>
    <div class="col-6">
        <p style="font-size:15px; text-align: center; margin-top:10px; ">General Information Service</p>
        <a class="btn btn-danger btn-block shadow-box text-white" onclick="save_sos_content('general','1080');" style=" background-color: #DB2D2E;"><i class="fas fa-phone-alt"></i>&nbsp; 1080</a>
    </div>
    <div class="col-6">
        <p style="font-size:15px; text-align: center; margin-top:10px; ">Search and Rescue</p>
        <a class="btn btn-danger btn-block shadow-box text-white" onclick="save_sos_content('search_and_rescue ','112');" style=" background-color: #DB2D2E;"><i class="fas fa-phone-alt"></i>&nbsp; 112</a>
    </div>
    <div class="col-6">
        <p style="font-size:15px; text-align: center; margin-top:10px; ">Directory Assistance</p>
        <a class="btn btn-danger btn-block shadow-box text-white" onclick="save_sos_content('directory_assistance','116');" style=" background-color: #DB2D2E;"><i class="fas fa-phone-alt"></i>&nbsp; 116</a>
    </div> -->
</div>
<!-- จบ SOS เวียดนาม -->
<!-- SOS ไต้หวัน -->
<div id="sos_TW" class="row notranslate align-items-center d-none" style="margin-top:10px;">
    <div class="col-12 mb-2">
        <span class="text-danger">
            * เป็นการติดต่อเจ้าหน้าที่ภายในประเทศไต้หวัน
        </span>
    </div>
    <div class="col-12 mb-2">
        <a class="btn btn-danger btn-block shadow-box text-white" onclick="save_sos_content('embassy','8862 2775-2211');" style="background-color: #DB2D2E;font-size:12px;"><i class="fas fa-phone-alt"></i>&nbsp; สำนักงานการค้าและเศรษฐกิจไทย (ไทเป)
        </a>
    </div>
    <div class="col-12" style="margin-top:-20px;margin-bottom:-10px;">
        <hr>
    </div>
    <div class="col-7 text-center">
        <p style="font-size:15px; vertical-align: middle;margin:0px ">Police</p>
    </div>
    <div class="col-5">
        <a class="btn btn-danger btn-block shadow-box text-white" onclick="save_sos_content('police','110');" style=" background-color: #DB2D2E;"><i class="fas fa-phone-alt"></i>&nbsp; 110</a>
    </div>
    <div class="col-12" style="margin-top:-8px;margin-bottom:-8px;">
        <hr class="align-items-center">
    </div>
    <div class="col-7 text-center">
        <p style="font-size:15px; vertical-align: middle;margin:0px ">Scam Watch</p>
    </div>
    <div class="col-5">
        <a class="btn btn-danger btn-block shadow-box text-white" onclick="save_sos_content('Scam_Watch','165');" style=" background-color: #DB2D2E;"><i class="fas fa-phone-alt"></i>&nbsp; 165</a>
    </div>
    <div class="col-12" style="margin-top:-8px;margin-bottom:-8px;">
        <hr class="align-items-center">
    </div>
    <div class="col-7 text-center">
        <p style="font-size:15px; vertical-align: middle;margin:0px">Emergency</p>
    </div>
    <div class="col-5">
        <a class="btn btn-danger btn-block shadow-box text-white" onclick="save_sos_content('Emergency','112');" style=" background-color: #DB2D2E;"><i class="fas fa-phone-alt"></i>&nbsp; 112</a>
    </div>
    <div class="col-12" style="margin-top:-8px;margin-bottom:-8px;">
        <hr class="align-items-center">
    </div>
    <div class="col-7 text-center">
        <p style="font-size:15px; vertical-align: middle;margin:0px ">Ambulance And Fire</p>
    </div>
    <div class="col-5">
        <a class="btn btn-danger btn-block shadow-box text-white" onclick="save_sos_content('Ambulance_And_Fire','119');" style=" background-color: #DB2D2E;"><i class="fas fa-phone-alt"></i>&nbsp; 119</a>
    </div>
    <div class="col-12" style="margin-top:-8px;margin-bottom:-8px;">
        <hr class="align-items-center">
    </div>
    <div class="col-7 text-center">
        <p style="font-size:15px; vertical-align: middle;margin:0px ">Overseas Operator</p>
    </div>
    <div class="col-5">
        <a class="btn btn-danger btn-block shadow-box text-white" onclick="save_sos_content('Overseas_Operator','100');" style=" background-color: #DB2D2E;"><i class="fas fa-phone-alt"></i>&nbsp; 100</a>
    </div>
    <div class="col-12" style="margin-top:-8px;margin-bottom:-8px;">
        <hr class="align-items-center">
    </div>
    <div class="col-7 text-center ">
        <p style="font-size:15px; vertical-align: middle;margin:0px ">Taiwan Information Center</p>
    </div>
    <div class="col-5 d-flex">
        <a class="btn btn-danger btn-block shadow-box text-white" onclick="save_sos_content('Taiwan_Information_Center','0800-024-111');" style=" background-color: #DB2D2E;font-size:15px;"><i class="fas fa-phone-alt"></i>&nbsp; 0800-024-111</a>
    </div>
    <!-- <div class="col-6">
        <p style="font-size:15px; text-align: center; margin-top:10px; ">Police</p>
        <a class="btn btn-danger btn-block shadow-box text-white" onclick="save_sos_content('police','110');" style=" background-color: #DB2D2E;"><i class="fas fa-phone-alt"></i>&nbsp; 110</a>
    </div>
    <div class="col-6">
        <p style="font-size:15px; text-align: center; margin-top:10px; ">Scam Watch</p>
        <a class="btn btn-danger btn-block shadow-box text-white" onclick="save_sos_content('Scam_Watch','165');" style=" background-color: #DB2D2E;"><i class="fas fa-phone-alt"></i>&nbsp; 165</a>
    </div>
    <div class="col-6">
        <p style="font-size:15px; text-align: center; margin-top:10px; ">Emergency</p>
        <a class="btn btn-danger btn-block shadow-box text-white" onclick="save_sos_content('Emergency','112');" style=" background-color: #DB2D2E;"><i class="fas fa-phone-alt"></i>&nbsp; 112</a>
    </div>
    <div class="col-6">
        <p style="font-size:15px; text-align: center; margin-top:10px; ">Ambulance And Fire</p>
        <a class="btn btn-danger btn-block shadow-box text-white" onclick="save_sos_content('Ambulance_And_Fire','119');" style=" background-color: #DB2D2E;"><i class="fas fa-phone-alt"></i>&nbsp; 119</a>
    </div>
    <div class="col-6">
        <p style="font-size:15px; text-align: center; margin-top:10px; ">Overseas Operator</p>
        <a class="btn btn-danger btn-block shadow-box text-white" onclick="save_sos_content('Overseas_Operator','100');" style=" background-color: #DB2D2E;"><i class="fas fa-phone-alt"></i>&nbsp; 100</a>
    </div>
    <div class="col-6">
        <p style="font-size:15px; text-align: center; margin-top:10px; ">Taiwan Information Center</p>
        <a class="btn btn-danger btn-block shadow-box text-white" onclick="save_sos_content('Taiwan_Information_Center','0800-024-111');" style=" background-color: #DB2D2E;"><i class="fas fa-phone-alt"></i>&nbsp;0800-024-111</a>
    </div> -->


</div>
<!----- จบ SOS ไต้หวัน -->
<script>
    document.addEventListener('DOMContentLoaded', (event) => {
        // console.log("START");
        let user_id = document.querySelector('#user_id').value;

        fetch("{{ url('/') }}/api/check_sos_country/" + user_id)
            .then(response => response.json())
            .then(result => {
                // console.log(result);
                // console.log(result['countryCode']);

                let countryCode = document.querySelector('#CountryCode');
                countryCode.value = result['countryCode'];

                if (result['countryCode']) {

                    if (result['countryCode'] !== 'TH') {
                        document.querySelector('#btn_quick_help').classList.add('d-none');
                    }

                    document.querySelector('#sos_' + result['countryCode']).classList.remove('d-none');
                }

            });

    });

    function save_sos_content(type_content, phone_sos) {
        let text_phone = document.querySelector("#text_phone");
        let lat_text = document.querySelector("#lat");
        let lng_text = document.querySelector("#lng");

        let content = document.querySelector("#content");
        content.value = type_content;


        let btn_tel = document.querySelector('#btn_tel');

        let tag_a = document.createElement("a");
        let tag_a_href = document.createAttribute("href");
        tag_a_href.value = 'tel:' + phone_sos;
        tag_a.setAttributeNode(tag_a_href);

        let tag_a_id = document.createAttribute("id");
        tag_a_id.value = 'btn_' + phone_sos;
        tag_a.setAttributeNode(tag_a_id);

        btn_tel.appendChild(tag_a);

        if(type_content == 'สพฉ'){
            // console.log('สพฉ 1669');
            send_data_sos_api(phone_sos);
        }
        else{
            document.querySelector("#btn_" + phone_sos).click();
            document.querySelector("#btn_submit").click();
        }
    }

    function send_data_sos_api(phone_sos){

        let informer = document.querySelectorAll('[name="informer"]');
        let informer_value = "" ;
            informer.forEach(informer => {
                if(informer.checked){
                    informer_value = informer.value;
                }
            })
        let symptom = document.querySelector('[name="symptom"]');
        let cid = document.querySelector('[name="cid"]');
        let firstname = document.querySelector('[name="firstname"]');
        let lastname = document.querySelector('[name="lastname"]');
        let gender = document.querySelectorAll('[name="gender"]');
        let gender_value = "" ;
            gender.forEach(gender => {
                if(gender.checked){
                    gender_value = gender.value;
                }
            })
        let age = document.querySelector('[name="age"]');
        let phone = document.querySelector('[name="phone"]');
        let symptom_detail = document.querySelector('[name="symptom_detail"]');
        let victim_number = document.querySelector('[name="victim_number"]');
        let risk_of_recurrence = document.querySelectorAll('[name="risk_of_recurrence"]');
        let risk_of_recurrence_value = "" ;
            risk_of_recurrence.forEach(risk_of_recurrence => {
                if(risk_of_recurrence.checked){
                    if(risk_of_recurrence.value == 'yes'){
                        risk_of_recurrence_value = true;
                    }
                    else{
                        risk_of_recurrence_value = false;
                    }
                }
            })
        let location =  document.querySelector('[name="location"]');
        let longitude = document.querySelector('[name="longitude"]');
        let latitude = document.querySelector('[name="latitude"]');
        let platform = document.querySelector('[name="platform"]');
        let remark = document.querySelector('[name="remark"]');

        let data_arr = {
            "informer" : informer_value,
            "symptom" : symptom.value,
            "cid" : cid.value,
            "firstname" : firstname.value,
            "lastname" : lastname.value,
            "gender" : gender_value,
            "age" : age.value,
            "phone" : phone.value,
            "symptom_detail" : symptom_detail.value,
            "victim_number" : victim_number.value,
            "risk_of_recurrence" : risk_of_recurrence_value,
            "location" : location.value,
            "longitude" : longitude.value,
            "latitude" : latitude.value,
            "platform" : platform.value,
            "remark" : remark.value,
        }; 

        let full_name = firstname.value + " " + lastname.value ;

        let test_url = "{{ url('/') }}/api/send_data_sos_api" ;
        let url_api = "https://uat-emergencymed.one.th/management/api/v1/case";

        fetch(url_api, {
            method: 'post',
            body: JSON.stringify(data_arr),
            headers: {
                'Content-Type': 'application/json'
            }
        }).then(function (response){
            return response.json();
        }).then(function(data){
            // console.log(data);
            if(data.status_code == 201){
                // console.log(data.status_code);
                send_data_sos_api_to_line(data.data.case_id, phone_sos , full_name);
            }
            else if(data.status_code == 400){
                alert(data.message);
            }
        }).catch(function(error){
            // console.error(error);
            send_data_sos_api_viicheck(phone_sos);
        });

    }

    function send_data_sos_api_viicheck(phone_sos){

        let informer = document.querySelectorAll('[name="informer"]');
        let informer_value = "" ;
            informer.forEach(informer => {
                if(informer.checked){
                    informer_value = informer.value;
                }
            })
        let symptom = document.querySelector('[name="symptom"]');
        let cid = document.querySelector('[name="cid"]');
        let firstname = document.querySelector('[name="firstname"]');
        let lastname = document.querySelector('[name="lastname"]');
        let gender = document.querySelectorAll('[name="gender"]');
        let gender_value = "" ;
            gender.forEach(gender => {
                if(gender.checked){
                    gender_value = gender.value;
                }
            })
        let age = document.querySelector('[name="age"]');
        let phone = document.querySelector('[name="phone"]');
        let symptom_detail = document.querySelector('[name="symptom_detail"]');
        let victim_number = document.querySelector('[name="victim_number"]');
        let risk_of_recurrence = document.querySelectorAll('[name="risk_of_recurrence"]');
        let risk_of_recurrence_value = "" ;
            risk_of_recurrence.forEach(risk_of_recurrence => {
                if(risk_of_recurrence.checked){
                    if(risk_of_recurrence.value == 'yes'){
                        risk_of_recurrence_value = true;
                    }
                    else{
                        risk_of_recurrence_value = false;
                    }
                }
            })
        let location =  document.querySelector('[name="location"]');
        let longitude = document.querySelector('[name="longitude"]');
        let latitude = document.querySelector('[name="latitude"]');
        let platform = document.querySelector('[name="platform"]');
        let remark = document.querySelector('[name="remark"]');

        let data_arr = {
            "informer" : informer_value,
            "symptom" : symptom.value,
            "cid" : cid.value,
            "firstname" : firstname.value,
            "lastname" : lastname.value,
            "gender" : gender_value,
            "age" : age.value,
            "phone" : phone.value,
            "symptom_detail" : symptom_detail.value,
            "victim_number" : victim_number.value,
            "risk_of_recurrence" : risk_of_recurrence_value,
            "location" : location.value,
            "longitude" : longitude.value,
            "latitude" : latitude.value,
            "platform" : platform.value,
            "remark" : remark.value,
        }; 

        let full_name = firstname.value + " " + lastname.value ;

        fetch("{{ url('/') }}/api/send_data_sos_api", {
            method: 'post',
            body: JSON.stringify(data_arr),
            headers: {
                'Content-Type': 'application/json'
            }
        }).then(function (response){
            return response.json();
        }).then(function(data){
            // console.log(data);
            if(data.status_code == 201){
                // console.log(data.status_code);
                send_data_sos_api_to_line(data.data.case_id, phone_sos, full_name);
            }
        }).catch(function(error){
            // console.error(error);
        });

    }

    function send_data_sos_api_to_line(case_id, phone_sos, full_name){
        console.log(case_id);

        fetch("{{ url('/') }}/api/send_data_sos_api_to_line/" + "{{ Auth::user()->id }}" + "/"+full_name+"/"+case_id)
            .then(response => response.text())
            .then(result => {
                // console.log(result);
                // alert(result);
                if (result) {
                    document.querySelector("#btn_" + phone_sos).click();
                    document.querySelector("#btn_submit").click();
                }
            });
    }
</script>
@extends('layouts.partners.theme_partner_new')

@section('content')

<style>
    #map_operations {
        height: 100%;
    }

    #map_monitor {
        height: 100%;
    }

    .list_officer {
        position: absolute;
        top: 10px;
        right: 10px;
        width: 30%;
        background-color: white;
        /* เพื่อให้เนื้อหาชัดเจน */
        z-index: 10;
        /* ให้อยู่เหนือ map */
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);
        /* เพิ่มเงาให้นูนขึ้น */
        border: 3.5px solid #6B1181;
    }

    .photo-img {
        width: 100%;
        height: auto;
        border-radius: 10px;
        object-fit: cover;
        background-color: #000;
        margin-right: 15px;
    }
</style>
<style>
    .page-wrapper {}

    .page-content {
        padding: 0 20px !important;
        margin: auto;
    }

    .header {
        font-size: 18px;
        font-weight: bolder;
        margin: 10px 0;
    }

    .btn-show-img {
        background-color: #D9D9D9;
        padding: 3px;
        color: #000;
        margin: 10px 0;
        font-size: 16px;
    }

    .status-rc {
        width: 100%;
        padding: 5px;
        border-radius: 10px;
        margin-top: 5px;
        font-weight: bolder;
        background-color: rgb(238, 238, 238);
        ;
    }

    .status-other {
        background-color: rgb(0, 0, 0, .13) !important;
        color: #000 !important;
    }

    .status-normal {
        background-color: rgb(19, 113, 253, .13) !important;
        color: #1371fd !important;
    }

    .status-success {
        background-color: rgb(28, 208, 83, .15) !important;
        color: rgb(28, 208, 83) !important;
    }

    .status-warning {
        background-color: rgb(255, 197, 23, .13) !important;
        color: rgb(255, 197, 23) !important;
    }

    .status-danger {
        background-color: rgb(255, 0, 0, .15) !important;
        color: rgb(255, 0, 0) !important;
    }

    .officer-info span {
        border-radius: 6px;
        padding: 0px 20px;
        margin-right: 5px;
        background-color: #D9D9D9;
        font-size: 11px;
    }

    @media (max-width: 767px) {
        .map-oparating {
            margin-top: 10px;
            margin-bottom: 20px;
            border-radius: 10px;
            height: 100dvw;
            overflow: auto;
        }

        .container-oparating {
            height: fit-content;
        }

        .content-oparating {
            display: block;
        }

    }

    @media only screen and (max-width: 1350px) and (min-width: 768px) {
        .data-oparating {
            max-width: 300px;
            min-width: 300px;
        }


    }

    @media (min-width: 1350px) {
        .data-oparating {
            max-width: 300px;
            min-width: 300px;
        }
    }

    @media (min-width: 767px) {
        .container-oparating {
            height: calc(100dvh - 130px) !important;

        }

        .map-oparating {
            border-radius: 0 10px 10px 0;
            overflow: auto;
        }

        .content-oparating {
            display: flex;
        }
    }

    .menu-select-officer {
        position: fixed;
        top: 90px;
        right: 30px;
        height: calc(100dvh - 150px);
        width: 350px;
        background-color: #fff;
        z-index: 999 !important;
        border-radius: 13px;
        box-shadow: 0px 4px 4px 0px rgba(0, 0, 0, 0.3);
        -webkit-box-shadow: 0px 4px 4px 0px rgba(0, 0, 0, 0.3);
        -moz-box-shadow: 0px 4px 4px 0px rgba(0, 0, 0, 0.3);
        transition: transform 0.3s ease-in-out;
        transform: translateX(0);
        max-width: 100dvw;
    }

    .btn-close-menu {
        display: flex;
        justify-content: center;
        align-items: center;
        position: absolute;
        top: 30px;
        right: 0px;
        transform: translate(-50%, -50%);
        width: 30px;
        height: 30px;
        border-radius: 50px;
        background-color: #D9D9D9;
        color: #000;
        padding: 0;
        font-size: 16px;
        border: unset;
        transition: all .15s ease-in-out;
    }

    .menu-header {
        font-size: 18px;
        font-weight: bolder;
        padding: 15px;
        margin-top: 10px;
        color: #000;
    }

    .content {
        align-items: center;
        overflow: auto;
        height: calc(100dvh - 350px);


    }

    /*
 *  STYLE 4
 */

    .content::-webkit-scrollbar-track {
        -webkit-box-shadow: inset 0 0 6px rgba(0, 0, 0, 0.3);
        background-color: #F5F5F5;
    }

    .content::-webkit-scrollbar {
        width: 5px;
        background-color: #F5F5F5;
    }

    .content::-webkit-scrollbar-thumb {
        background-color: rgb(163, 163, 163);
        border-radius: 20px;
    }

    .btn-select-officer {
        border-radius: 14px !important;
        padding: 8px 0px !important;
        width: 80px !important;
        box-shadow: 0px 4px 4px 0px rgba(0, 0, 0, 0.3);
        -webkit-box-shadow: 0px 4px 4px 0px rgba(0, 0, 0, 0.3);
        -moz-box-shadow: 0px 4px 4px 0px rgba(0, 0, 0, 0.3);
        transition: all .15s ease-in-out;
    }

    .content-items {
        display: flex;
        align-items: center;
        justify-content: space-between;
        border-bottom: 1px solid #DADADA;
        padding: 15px 20px;

    }

    .officer-response {
        text-align: center;
        padding: 10px 0px;
        width: 82px;
        border-radius: 10px;
    }

    .officer-response i {
        font-size: 28px;
        margin-bottom: 5px;
    }

    .officer-response p {
        font-size: 12px !important;
    }

    .officer-response.officer-refuse {
        background-color: #FFDADA;
        color: #FD060E;
    }

    .officer-response.officer-no-response {
        background-color: rgb(255, 197, 13, .13);
        color: rgb(231, 173, 0);
    }

    .officer-card-modal {
        display: flex;
        align-items: center;
        gap: 20px;
    }

    .officer-image-modal img {
        width: 80px;
        height: 80px;
        border-radius: 50%;
        object-fit: cover;
        border: 3px solid #dee2e6;
    }

    .officer-name-modal {
        font-size: 22px;
        font-weight: 700;
        margin: 0 0 8px 0;
    }

    .officer-info-modal p {
        font-size: 16px;
        margin: 4px 0;
        color: #6c757d;
    }

    .officer-info-modal p strong {
        color: #212529;
        font-weight: 500;
        margin-right: 8px;
    }

    .btn-secondary-normal {
        background-color: #fff;
        border-color: #dee2e6;
        color: #212529;
    }

    .btn-secondary-normal:hover {
        background-color: #e9ecef;
    }

    .modal.fade.show {
        background-color: rgb(0, 0, 0, .50);
    }

    .modal-content {
        border-radius: 15px;
        border: none;
        box-shadow: 0 4px 20px rgba(0, 0, 0, 0.15);

    }
</style>
<div class="col  radius-10 align-items-center test">
    <div class="card radius-10 w-100   mt-4 container-oparating" style="">
        <div class="h-100 content-oparating m-0 ">
            <div class="data-oparating h-100 m-0 p-0" style="border-right: 1px solid #DADADA;">
                <div class="px-4 py-3" style="border-bottom:  1px solid #DADADA;;">
                    <div class="header mb-0">รหัสปฏิบัติการ</div>
                    <p class="mb-3">{{ $emergency->op_operating_code ?? '-' }}</p>
                    <!-- <button class="btn w-100 btn-show-img">ดูรูปภาพ</button> -->
                    <div class="d-flex">
                        <button class="btn w-100 btn-outline-danger mx-1 py-1 " id="btn_order">
                            <!--  -->
                        </button>
                        <button class="btn w-100 mx-1 btn-primary  py-1" id="btn_info">
                            ข้อมูลเคส
                        </button>
                    </div>
                </div>
                <div class="px-4 py-3" style="border-bottom:  1px solid #DADADA;;">
                    <div class="header">ข้อมูลผู้ข้อความช่วยเหลือ</div>
                    <p class="mb-0">ชื่อผู้แจ้ง : {{ $emergency->name_reporter ?? 'ไม่ได้ระบุ' }}</p>
                    <p class="mb-0">เบอร์ : : {{ $emergency->type_reporter ?? 'ไม่ได้ระบุ' }}</p>
                    <p class="mb-0">เบอร์ : {{ $emergency->phone_reporter ?? 'ไม่ได้ระบุ' }}</p>
                    <!-- <button class="btn w-100 btn-show-img">ดูรูปภาพ</button> -->

                    @if(!empty($emergency->emergency_photo))
                    <button class="btn w-100 btn-show-img collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseOne" aria-expanded="false" aria-controls="flush-collapseOne">
                        ดูรูปภาพ
                    </button>
                    <div id="flush-collapseOne" class="accordion-collapse collapse" aria-labelledby="flush-headingOne" data-bs-parent="#accordionFlushExample" style="">
                        <div class="accordion-body">
                            <img class="photo-img" src="{{ url('/storage') }}/{{ $emergency->emergency_photo }}">
                        </div>
                    </div>
                    @endif
                </div>
                @php

                $class_status_rc = '' ;
                $class_status_idc = '' ;

                if(!empty($emergency->idc)){
                switch($emergency->idc){
                case 'ทั่วไป':
                $class_status_idc = 'status-normal' ;
                break;
                case 'ไม่รุนแรง':
                $class_status_idc = 'status-success' ;
                break;
                case 'เร่งด่วน':
                $class_status_idc = 'status-warning' ;
                break;
                case 'ฉุกเฉิน':
                $class_status_idc = 'status-danger' ;
                break;
                case 'อื่นๆ':
                $class_status_idc = 'status-other' ;
                break;
                }
                }

                if(!empty($emergency->rc)){
                switch($emergency->rc){
                case 'ทั่วไป':
                $class_status_rc = 'status-normal' ;
                break;
                case 'ไม่รุนแรง':
                $class_status_rc = 'status-success' ;
                break;
                case 'เร่งด่วน':
                $class_status_rc = 'status-warning' ;
                break;
                case 'ฉุกเฉิน':
                $class_status_rc = 'status-danger' ;
                break;
                case 'อื่นๆ':
                $class_status_rc = 'status-other' ;
                break;
                }
                }
                @endphp
                <div class="px-4 py-3" style="border-bottom:  1px solid #DADADA;;" id="status_case">
                    <div class="header mb-0" id="show_status">สถานะ : {{ $emergency->op_status }}</div>
                    <div id="show_time_distance" class="d-none">
                        <!-- 3 นาที (2 กม) • 15:00 น. -->
                    </div>
                    <div class="mb-4 mt-3">
                        <p class="mb-0">การประเมินจากศูนย์</p>
                        <div class="status-rc {{$class_status_idc}}" id="status_idc">
                            <i class="fa-solid fa-circle-small mx-2"></i>
                            <span id="show_text_idc"> {{ $emergency->idc ?? '-' }}</span>
                        </div>
                    </div>
                    <div>
                        <p class="mb-0">การประเมินจากหน่วย</p>
                        <div class="status-rc {{$class_status_rc}}" id="status_rc">
                            <i class="fa-solid fa-circle-small mx-2"></i>
                            <span id="show_text_rc">{{ $emergency->rc ?? '-' }}</span>
                        </div>
                    </div>
                </div>




                <div class="px-4 py-3 d-none" style="border-bottom:  1px solid #DADADA;" id="info_officer">
                    <div class="header">ข้อมูลหน่วยแพทย์</div>
                    <div class="d-flex align-items-center" id="div_data_info_officer">
                        <!-- <div>
                            <img src="" height="70" width="70" alt="" style="border-radius: 50px; background-color: #D9D9D9;">
                        </div>
                        <div class="ms-3">
                            <div class="d-flex flex-wrap officer-info">
                                <span>CAR</span>
                                <span>BLS</span>
                            </div>
                            <p class="mb-0">officer</p>
                            <p class="mb-0">viicheck , อาสาสมัคร</p>
                        </div> -->
                    </div>
                </div>
            </div>
            <div class="w-100 p-0 overflow-auto px-4 py-3" style="" id="data_case">
                <div class="header">ข้อมูลผู้ข้อความช่วยเหลือ</div>

                <div class="row g-3">
                    <div class="col-lg-6">
                        <label for="name_reporter" class="form-label">ผู้แจ้งเหตุ</label>
                        <input id="name_reporter" name="name_reporter" type="text" class="form-control" placeholder="ผู้แจ้งเหตุ" value="{{ $emergency->name_reporter }}">
                    </div>
                    <div class="col-lg-3 col-md-6">
                        <label for="phone_reporter" class="form-label">เบอร์ผู้แจ้งเหตุ</label>
                        <input id="phone_reporter" name="phone_reporter" type="text" class="form-control" placeholder="เบอร์ผู้แจ้งเหตุ" value="{{ $emergency->phone_reporter }}">
                    </div>
                    <div class="col-lg-3 col-md-6">
                        <label for="type_reporter" class="form-label">ประเภทผู้แจ้ง</label>
                        <input id="type_reporter" name="type_reporter" type="text" class="form-control" placeholder="ประเภทผู้แจ้ง" value="{{ $emergency->type_reporter }}">
                    </div>
                    <div class="col-lg-3 col-md-6">
                        <label for="report_platform" class="form-label">แพลตฟอร์มการแจ้ง</label>
                        <input id="report_platform" name="report_platform" type="text" class="form-control" readonly value="{{ $emergency->report_platform }}">
                    </div>
                    <div class="col-lg-3 col-md-6">
                        <label for="emergency_lat" class="form-label">latitude ที่เกิดเหตุ</label>
                        <input id="emergency_lat" name="emergency_lat" type="text" class="form-control" readonly value="{{ $emergency->emergency_lat }}">
                    </div>
                    <div class="col-lg-3 col-md-6">
                        <label for="emergency_lng" class="form-label">longitude ที่เกิดเหตุ</label>
                        <input id="emergency_lng" name="emergency_lng" type="text" class="form-control" readonly value="{{ $emergency->emergency_lng }}">
                    </div>
                    <div class="col-lg-3 col-md-6">
                        <label for="emergency_type" class="form-label">ประเภทเหตุ</label>
                        <input id="emergency_type" name="emergency_type" type="text" class="form-control" placeholder="ประเภทเหตุ" value="{{ $emergency->emergency_type }}">
                    </div>

                    <div class="col-12">
                        <label for="emergency_location" class="form-label">รายละเอียดสถานที่เกิดเหตุ</label>
                        <textarea id="emergency_location" name="emergency_location" class="form-control" placeholder="รายละเอียดสถานที่เกิดเหตุ">{{ $emergency->emergency_location }}</textarea>
                    </div>

                    <div class="col-12">
                        <label for="emergency_detail" class="form-label">รายละเอียดเหตุการณ์</label>
                        <textarea id="emergency_detail" name="emergency_detail" class="form-control" placeholder="รายละเอียดเหตุการณ์">{{ $emergency->emergency_detail }}</textarea>
                    </div>
                </div>

                <style>
                    .checkbox-symptom label {
                        padding: 10px 20px;
                        border-radius: 10px;
                        border: solid 1px #ced4da;
                        margin: 0 10px 10px 0;
                        transition: all .15s ease-in-out;
                    }

                    .checkbox-symptom:hover label,
                    .checkbox-symptom:focus label,
                    .checkbox-symptom input:checked~label {
                        background-color: #000;
                        color: #fff;
                    }

                    .checkbox-symptom input {
                        display: none;
                    }
                </style>
                <div class="header  mt-5">การประเมินอาการ</div>
                <div class="row g-3">
                    <div class="col-12 ">
                        <label for="inputCity" class="form-label">อาการเบื้องต้น</label>
                        <div class="d-flex flex-wrap">
                            <div class="checkbox-symptom">
                                <input value="ปวดท้อง หลัง เชิงกราน และขาหนีบ" type="checkbox" name="symptom" id="symptom_1">
                                <label for="symptom_1">
                                    ๑.ปวดท้อง หลัง เชิงกราน และขาหนีบ
                                </label>
                            </div>

                            <div class="checkbox-symptom">
                                <input value="แอนนาฟิแลกซิส ปฏิกิริยาภูมิแพ้/แมลงกัด" type="checkbox" name="symptom" id="symptom_2">
                                <label for="symptom_2">
                                    ๒.แอนนาฟิแลกซิส ปฏิกิริยาภูมิแพ้/แมลงกัด
                                </label>
                            </div>

                            <div class="checkbox-symptom">
                                <input value="สัตว์กัด" type="checkbox" name="symptom" id="symptom_3">
                                <label for="symptom_3">
                                    ๓.สัตว์กัด
                                </label>
                            </div>

                            <div class="checkbox-symptom">
                                <input value="เลือดออกไม่ใช่จากการบาดเจ็บ" type="checkbox" name="symptom" id="symptom_4">
                                <label for="symptom_4">
                                    ๔.เลือดออกไม่ใช่จากการบาดเจ็บ
                                </label>
                            </div>

                            <div class="checkbox-symptom">
                                <input value="หายใจลำบาก" type="checkbox" name="symptom" id="symptom_5">
                                <label for="symptom_5">
                                    ๕.หายใจลำบาก
                                </label>
                            </div>

                            <div class="checkbox-symptom">
                                <input value="หัวใจหยุดเต้น" type="checkbox" name="symptom" id="symptom_6">
                                <label for="symptom_6">
                                    ๖.หัวใจหยุดเต้น
                                </label>
                            </div>

                            <div class="checkbox-symptom">
                                <input value="เจ็บแน่นทรางออก หัวใจ" type="checkbox" name="symptom" id="symptom_7">
                                <label for="symptom_7">
                                    ๗.เจ็บแน่นทรางออก หัวใจ
                                </label>
                            </div>

                            <div class="checkbox-symptom">
                                <input value="สำลักอุดทางเดินหายใจ" type="checkbox" name="symptom" id="symptom_8">
                                <label for="symptom_8">
                                    ๘.สำลักอุดทางเดินหายใจ
                                </label>
                            </div>
                            <div class="checkbox-symptom">
                                <input value="เบาหวาน" type="checkbox" name="symptom" id="symptom_9">
                                <label for="symptom_9">
                                    ๙.เบาหวาน
                                </label>
                            </div>

                            <div class="checkbox-symptom">
                                <input value="อันตรายจากสภาพแวดล้อม" type="checkbox" name="symptom" id="symptom_10">
                                <label for="symptom_10">
                                    ๑๐.อันตรายจากสภาพแวดล้อม
                                </label>
                            </div>

                            <div class="checkbox-symptom">
                                <input value="ปวดศรีษะ ลำคอ" type="checkbox" name="symptom" id="symptom_11">
                                <label for="symptom_11">
                                    ๑๑.ปวดศรีษะ ลำคอ
                                </label>
                            </div>

                            <div class="checkbox-symptom">
                                <input value="คลุ้มคลั่ง จิตประสาท อารมณ์" type="checkbox" name="symptom" id="symptom_12">
                                <label for="symptom_12">
                                    ๑๒.คลุ้มคลั่ง จิตประสาท อารมณ์
                                </label>
                            </div>

                            <div class="checkbox-symptom">
                                <input value="ยาเกิดขนาด ได้รับพิษ" type="checkbox" name="symptom" id="symptom_13">
                                <label for="symptom_13">
                                    ๑๓.ยาเกิดขนาด ได้รับพิษ
                                </label>
                            </div>

                            <div class="checkbox-symptom">
                                <input value="มีครรภ คลอด นรี" type="checkbox" name="symptom" id="symptom_14">
                                <label for="symptom_14">
                                    ๑๔.มีครรภ คลอด นรี
                                </label>
                            </div>

                            <div class="checkbox-symptom">
                                <input value="ชัก" type="checkbox" name="symptom" id="symptom_15">
                                <label for="symptom_15">
                                    ๑๕.ชัก
                                </label>
                            </div>

                            <div class="checkbox-symptom">
                                <input type="checkbox" value="ป่วย อ่อนเพลีย" name="symptom" id="symptom_16">
                                <label for="symptom_16">
                                    ๑๖.ป่วย อ่อนเพลีย
                                </label>
                            </div>
                            <div class="checkbox-symptom">
                                <input value="อัมพาต (หลอดเลือดสมองตีบ แตก)" type="checkbox" name="symptom" id="symptom_17">
                                <label for="symptom_17">
                                    ๑๗.อัมพาต (หลอดเลือดสมองตีบ แตก)
                                </label>
                            </div>

                            <div class="checkbox-symptom">
                                <input value="หมดสติ ไม่ตอบสนอง หมดสติชั่ววูบ" type="checkbox" name="symptom" id="symptom_18">
                                <label for="symptom_18">
                                    ๑๘.หมดสติ ไม่ตอบสนอง หมดสติชั่ววูบ
                                </label>
                            </div>

                            <div class="checkbox-symptom">
                                <input value="เด็ก ทารก (กุมารเวชกรรม)" type="checkbox" name="symptom" id="symptom_19">
                                <label for="symptom_19">
                                    ๑๙.เด็ก ทารก (กุมารเวชกรรม)
                                </label>
                            </div>

                            <div class="checkbox-symptom">
                                <input value="ถูกทำร้าย บาดเจ็บ" type="checkbox" name="symptom" id="symptom_20">
                                <label for="symptom_20">
                                    ๒๐.ถูกทำร้าย บาดเจ็บ
                                </label>
                            </div>

                            <div class="checkbox-symptom">
                                <input value="ไฟไหม้ ลวก ความร้อน กระแสไฟฟ้า สารเคมี" type="checkbox" name="symptom" id="symptom_21">
                                <label for="symptom_21">
                                    ๒๑.ไฟไหม้ ลวก ความร้อน กระแสไฟฟ้า สารเคมี
                                </label>
                            </div>

                            <div class="checkbox-symptom">
                                <input value="จมน้ำ หน้าคว่ำจมน้ำ บาดเจ็บเหตุดำน้ำ บาดเจ็บทางน้ำ" type="checkbox" name="symptom" id="symptom_22">
                                <label for="symptom_22">
                                    ๒๒.จมน้ำ หน้าคว่ำจมน้ำ บาดเจ็บเหตุดำน้ำ บาดเจ็บทางน้ำ
                                </label>
                            </div>

                            <div class="checkbox-symptom">
                                <input value="พลัดตกหลุม อุบัติเหตุ" type="checkbox" name="symptom" id="symptom_23">
                                <label for="symptom_23">
                                    ๒๓.พลัดตกหลุม อุบัติเหตุ
                                </label>
                            </div>

                            <div class="checkbox-symptom">
                                <input value="อุบัติเหตุยานยนต์" type="checkbox" name="symptom" id="symptom_24">
                                <label for="symptom_24">
                                    ๒๔.อุบัติเหตุยานยนต์
                                </label>
                            </div>
                        </div>
                    </div>
                    <div class="col-12">
                        <label for="inputAddress2" class="form-label">อาการอื่นๆ</label>
                        <textarea id="symptom_other" name="symptom_other" class="form-control" rows="3" placeholder="กรอกข้อมูลอาการนำสำคัญ">{{ $emergency->symptom_other }}</textarea>
                    </div>


                </div>

                <div class="header  mt-5">ข้อมูลผู้ป่วย</div>
                <div class="row g-3">
                    <div class="col-md-12 col-lg-6">
                        <label for="patient_name" class="form-label">ชื่อ-นามสกุล</label>
                        <input id="patient_name" name="patient_name" type="text" class="form-control" placeholder="ชื่อ-นามสกุล ผู้ป่วย" value="{{ $emergency->patient_name }}">
                    </div>
                    <div class="col-md-6 col-lg-3">
                        <label for="patient_birth" class="form-label">วัน/เดือน/ปี เกิด</label>
                        <input id="patient_birth" name="patient_birth" type="date" class="form-control" placeholder="วันเดือนปีเกิดผู้ป่วย" value="{{ $emergency->patient_birth }}">
                    </div>
                    <div class="col-md-6 col-lg-3">
                        <label for="patient_identification" class="form-label">เลขประจำตัวประชาชนผู้ป่วย</label>
                        <input id="patient_identification" name="patient_identification" type="text" class="form-control" placeholder="เลขประจำตัวประชาชนผู้ป่วย" value="{{ $emergency->patient_identification }}">
                    </div>
                    <div class="col-md-12 col-lg-4">
                        <label for="patient_phone" class="form-label">เบอร์โทรศัพท์ผู้ป่วย</label>
                        <input id="patient_phone" name="patient_phone" type="text" class="form-control" placeholder="เบอร์โทรศัพท์ผู้ป่วย" value="{{ $emergency->patient_phone }}">
                    </div>
                    <div class="col-md-6 col-lg-4">
                        <label for="patient_gender" class="form-label">เพศผู้ป่วย</label>
                        <input id="patient_gender" name="patient_gender" type="text" class="form-control" placeholder="เพศผู้ป่วย" value="{{ $emergency->patient_gender }}">
                    </div>
                    <div class="col-md-6 col-lg-4">
                        <label for="patient_blood_type" class="form-label">กรุ๊ปเลือดผู้ป่วย</label>
                        <select name="patient_blood_type" id="patient_blood_type" class="form-control">
                            <option value="">-- เลือกกรุ๊ปเลือด --</option>
                            <option value="A+">A+</option>
                            <option value="A-">A-</option>
                            <option value="B+">B+</option>
                            <option value="B-">B-</option>
                            <option value="AB+">AB+</option>
                            <option value="AB-">AB-</option>
                            <option value="O+">O+</option>
                            <option value="O-">O-</option>
                        </select>
                    </div>

                    <div class="col-md-4">
                        <label for="patient_congenital_disease" class="form-label">โรคประจำตัวผู้ป่วย</label>
                        <input id="patient_congenital_disease" name="patient_congenital_disease" type="text" class="form-control" placeholder="โรคประจำตัวผู้ป่วย" value="{{ $emergency->patient_congenital_disease }}">
                    </div>
                    <div class="col-md-4">
                        <label for="patient_allergic_drugs" class="form-label">ยาที่แพ้</label>
                        <input id="patient_allergic_drugs" name="patient_allergic_drugs" type="text" class="form-control" placeholder="ยาที่แพ้" value="{{ $emergency->patient_allergic_drugs }}">
                    </div>
                    <div class="col-md-4">
                        <label for="patient_regularly_medications" class="form-label">ยาที่ใช้ประจำ</label>
                        <input id="patient_regularly_medications" name="patient_regularly_medications" type="text" class="form-control" placeholder="ยาที่ใช้ประจำ" value="{{ $emergency->patient_regularly_medications }}">
                    </div>
                    <div class="col-12">
                        <label for="patient_address" class="form-label">ที่อยู่ผู้ป่วย</label>
                        <textarea id="patient_address" name="patient_address" class="form-control" placeholder="ที่อยู่ผู้ป่วย" rows="3">{{ $emergency->patient_address }}</textarea>

                    </div>

                </div>

                <hr class="my-5">


                <style>
                    :root {
                        --primary-color: #0D6EFD;
                        /* A slightly softer blue */
                        --background-color: #F8F9FA;
                        --card-background-color: #FFFFFF;
                        --text-color: #212529;
                        --label-color: #6C757D;
                        --border-color: #E9ECEF;
                        --pill-time-bg: #F0F5FD;
                        --pill-time-text: #0D6EFD;
                        --pill-distance-bg: #FFF4E5;
                        --pill-distance-text: #E75800;
                    }



                    .main-container {
                        width: 100%;
                        max-width: 750px;
                        margin: 0 auto;
                    }

                    .timeline {
                        position: relative;
                        padding: 0;
                        list-style: none;
                    }

                    .timeline::before {
                        content: '';
                        position: absolute;
                        top: 0;
                        left: 20px;
                        /* Center of the icon (40px width) */
                        bottom: 0;
                        width: 3px;
                        background: var(--border-color);
                        border-radius: 1.5px;
                    }

                    .timeline-item {
                        position: relative;
                        margin-bottom: 1.5rem;
                        padding-left: 65px;
                        /* Icon width + gap */
                    }

                    .timeline-item:last-of-type {
                        margin-bottom: 0;
                    }

                    .timeline-icon {
                        position: absolute;
                        left: 0;
                        top: 13px;
                        width: 40px;
                        height: 40px;
                        border-radius: 50%;
                        background-color: var(--primary-color);
                        color: white;
                        display: flex;
                        align-items: center;
                        justify-content: center;
                        z-index: 1;
                    }

                    .timeline-icon svg {
                        width: 22px;
                        height: 22px;
                    }

                    .timeline-content {
                        background-color: var(--card-background-color);
                        padding: 1rem 1.5rem;
                        border-radius: 12px;
                        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.05);
                        border: 1px solid var(--border-color);
                    }



                    .timeline-header {
                        display: flex;
                        justify-content: space-between;
                        align-items: center;
                        flex-wrap: wrap;
                    }

                    .timeline-item:not(:first-child) .timeline-content .timeline-header {
                        margin-bottom: 0.75rem;
                        border-bottom: 1px #DEE2E6 dashed;
                        padding-bottom: 0.75rem;


                    }

                    .timeline-title {
                        font-size: 1.1rem;
                        font-weight: 600;
                        margin: 0;
                    }

                    .timeline-time {
                        font-size: 1rem;
                        font-weight: 500;
                        color: var(--label-color);
                        flex-shrink: 0;
                        padding: 4px 12px;
                        background-color: #F8F9FA;
                        border-radius: 5px;
                    }

                    .timeline-details {
                        display: flex;
                        flex-direction: column;
                        gap: 0.75rem;
                    }

                    .detail-item {
                        display: flex;
                        justify-content: space-between;
                        align-items: center;
                    }

                    .detail-label {
                        display: flex;
                        align-items: center;
                        gap: 0.5rem;
                        color: var(--label-color);
                        font-size: 0.95rem;
                    }

                    .detail-label svg {
                        width: 16px;
                        height: 16px;
                    }

                    .data-pill {
                        font-size: 0.9rem;
                        font-weight: 500;
                        padding: 0.25rem 0.75rem;
                        border-radius: 5px;
                        white-space: nowrap;
                    }

                    .pill-time {
                        background-color: var(--pill-time-bg);
                        color: var(--pill-time-text);
                    }

                    .pill-distance {
                        background-color: var(--pill-distance-bg);
                        color: var(--pill-distance-text);
                    }

                    /* Summary Card */
                    .summary-card {
                        background-color: var(--pill-time-bg);
                        padding: 1.5rem;
                        border-radius: 16px;
                        margin-top: 2.5rem;
                        border: 1px solid #4A90E2;
                    }

                    .summary-title {
                        font-size: 1.1rem;
                        font-weight: 600;
                        margin-top: 0;
                        margin-bottom: 1.5rem;
                        color: #5892E5;
                    }

                    .summary-grid {
                        display: grid;
                        grid-template-columns: repeat(3, 1fr);
                        gap: 1rem;
                    }

                    .summary-item {
                        background-color: #fff;
                        padding: 20px 10px;
                        border-radius: 5px;
                    }

                    .summary-item .value {
                        font-size: 1.5rem;
                        font-weight: 600;
                        color: var(--text-color);
                        line-height: 1.2;
                    }

                    .summary-item .label {
                        font-size: 1rem;
                        color: var(--text-color);
                        margin-top: 0.1rem;
                    }

                    .summary-item .sub-label {
                        font-size: 0.85rem;
                        color: var(--label-color);
                    }

                    /* Responsive */
                    @media (max-width: 768px) {
                        .main-container {
                            padding: 0;
                        }

                        .timeline-content {
                            padding: 1rem;
                        }

                        .summary-grid {
                            grid-template-columns: 1fr;
                            gap: 1.5rem;
                        }

                        .timeline-item {
                            padding-left: 55px;
                        }

                        .timeline::before {
                            left: 17px;
                        }

                        .timeline-icon {
                            width: 34px;
                            height: 34px;
                        }

                        .timeline-icon svg {
                            width: 18px;
                            height: 18px;
                        }
                    }

                    @media (max-width: 1393px) {
                        .summary-grid {
                            grid-template-columns: 1fr;
                            gap: 1.5rem;
                        }

                        .timeline-item {
                            padding-left: 55px;
                        }

                        .timeline::before {
                            left: 17px;
                        }

                        .timeline-icon {
                            width: 34px;
                            height: 34px;
                        }

                        .timeline-icon svg {
                            width: 18px;
                            height: 18px;
                        }
                    }
                </style>
                <div class="header  mt-5">ไทม์ไลน์การช่วยเหลือ</div>
                <ul class="timeline">
                    <li class="timeline-item">
                        <div class="timeline-icon">
                            <i class="fa-regular fa-phone"></i>
                        </div>
                        <div class="timeline-content">
                            <div class="timeline-header">
                                <h2 class="timeline-title">1. รับแจ้งเหตุ</h2>
                                <span class="timeline-time">14:00 น.</span>
                            </div>
                        </div>
                    </li>

                    <li class="timeline-item">
                        <div class="timeline-icon">
                            <i class="fa-regular fa-paper-plane-top fa-rotate-by" style="--fa-rotate-angle: 312deg;"></i>
                        </div>
                        <div class="timeline-content">
                            <div class="timeline-header">
                                <h2 class="timeline-title">2. สั่งการ</h2>
                                <span class="timeline-time">14:02 น.</span>
                            </div>
                            <div class="timeline-details">
                                <div class="detail-item">
                                    <span class="detail-label"><i class="fa-regular fa-clock"></i>ใช้เวลา (รับแจ้งเหตุ - สั่งการ)</span>
                                    <span class="data-pill pill-time">2 นาที</span>
                                </div>
                            </div>
                        </div>
                    </li>

                    <li class="timeline-item">
                        <div class="timeline-icon">
                            <i class="fa-regular fa-truck-medical"></i>

                        </div>
                        <div class="timeline-content">
                            <div class="timeline-header">
                                <h2 class="timeline-title">3. ออกจากฐาน</h2>
                                <span class="timeline-time">14:05 น.</span>
                            </div>
                            <div class="timeline-details">
                                <div class="detail-item">
                                    <span class="detail-label"><i class="fa-regular fa-clock"></i> ใช้เวลา (สั่งการ - ออกจากฐาน)</span>
                                    <span class="data-pill pill-time">3 นาที</span>
                                </div>
                                <div class="detail-item">
                                    <span class="detail-label"><i class="fa-regular fa-location-dot"></i>เลขกิโลเมตร (ออกจากฐาน)</span>
                                    <div>
                                        <span class="data-pill pill-time">10,500 กม.</span>
                                        <span class="data-pill pill-distance">15 กม.</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </li>

                    <li class="timeline-item">
                        <div class="timeline-icon">
                            <i class="fa-regular fa-location-dot"></i>

                        </div>
                        <div class="timeline-content">
                            <div class="timeline-header">
                                <h2 class="timeline-title">4. ถึงที่เกิดเหตุ</h2>
                                <span class="timeline-time">14:20 น.</span>
                            </div>
                            <div class="timeline-details">
                                <div class="detail-item">
                                    <span class="detail-label"><i class="fa-regular fa-clock"></i> ใช้เวลา (ออกจากฐาน - ที่เกิดเหตุ)</span>
                                    <span class="data-pill pill-time">15 นาที</span>
                                </div>
                                <div class="detail-item">
                                    <span class="detail-label"><i class="fa-regular fa-location-dot"></i>เลขกิโลเมตร (ถึงที่เกิดเหตุ)</span>
                                    <span class="data-pill pill-distance">10,510 กม.</span>
                                </div>
                                <div class="detail-item">
                                    <span class="detail-label"><i class="fa-regular fa-scribble"></i> ระยะทาง</span>
                                    <span class="data-pill pill-distance">10 กม.</span>
                                </div>
                            </div>
                        </div>
                    </li>

                    <li class="timeline-item">
                        <div class="timeline-icon">
                            <i class="fa-regular fa-arrow-turn-left"></i>

                        </div>
                        <div class="timeline-content">
                            <div class="timeline-header">
                                <h2 class="timeline-title">5. ออกจากที่เกิดเหตุ</h2>
                                <span class="timeline-time">14:45 น.</span>
                            </div>
                            <div class="timeline-details">
                                <div class="detail-item">
                                    <span class="detail-label"><i class="fa-regular fa-clock"></i> ใช้เวลา (รับแจ้งเหตุ - สั่งการ)</span>
                                    <span class="data-pill pill-time">25 นาที</span>
                                </div>
                            </div>
                        </div>
                    </li>

                    <li class="timeline-item">
                        <div class="timeline-icon">
                            <i class="fa-regular fa-hospital"></i>
                        </div>
                        <div class="timeline-content">
                            <div class="timeline-header">
                                <h2 class="timeline-title">6. ถึงโรงพยาบาล</h2>
                                <span class="timeline-time">14:05 น.</span>
                            </div>
                            <div class="timeline-details">
                                <div class="detail-item">
                                    <span class="detail-label"><i class="fa-regular fa-clock"></i> ใช้เวลา (ออกจากที่เกิดเหตุ - ถึงโรงพยาบาล)</span>
                                    <span class="data-pill pill-time">3 นาที</span>
                                </div>
                                <div class="detail-item">
                                    <span class="detail-label"><i class="fa-regular fa-location-dot"></i>เลขกิโลเมตร (ถึงโรงพยาบาล)</span>
                                    <div>
                                        <span class="data-pill pill-distance">15 กม.</span>
                                        <span class="data-pill pill-time">10,500 กม.</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </li>

                    <li class="timeline-item">
                        <div class="timeline-icon">
                            <svg width="15" height="15" viewBox="0 0 15 15" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M5.0625 9.125L1 5.0625M1 5.0625L5.0625 1M1 5.0625H9.53125C10.1181 5.0625 10.6992 5.17809 11.2414 5.40266C11.7835 5.62724 12.2762 5.9564 12.6911 6.37137C13.1061 6.78633 13.4353 7.27896 13.6598 7.82113C13.8844 8.36331 14 8.94441 14 9.53125C14 10.1181 13.8844 10.6992 13.6598 11.2414C13.4353 11.7835 13.1061 12.2762 12.6911 12.6911C12.2762 13.1061 11.7835 13.4353 11.2414 13.6598C10.6992 13.8844 10.1181 14 9.53125 14H6.6875" stroke="white" stroke-linecap="round" stroke-linejoin="round" />
                            </svg>
                        </div>
                        <div class="timeline-content">
                            <div class="timeline-header">
                                <h2 class="timeline-title">7. ถึงฐาน</h2>
                                <span class="timeline-time">14:05 น.</span>
                            </div>
                            <div class="timeline-details">
                                <div class="detail-item">
                                    <span class="detail-label"><i class="fa-regular fa-clock"></i> ใช้เวลา (รพ. - ถึงฐาน)</span>
                                    <span class="data-pill pill-time">3 นาที</span>
                                </div>
                                <div class="detail-item">
                                    <span class="detail-label"><i class="fa-regular fa-location-dot"></i>เลขกิโลเมตร (ถึงฐาน)</span>
                                    <div>
                                        <span class="data-pill pill-distance">15 กม.</span>
                                        <span class="data-pill pill-time">10,500 กม.</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </li>
                </ul>

                <div class="summary-card">
                    <h2 class="summary-title">สรุปภารกิจ</h2>
                    <div class="summary-grid">
                        <div class="summary-item">
                            <div class="label mb-2">รวมเวลาช่วยเหลือทั้งหมด</div>
                            <div class="value">1 ชั่วโมง 13 นาที</div>
                            <div class="sub-label">(ตั้งแต่รับแจ้งเหตุ - กลับถึงฐาน)</div>
                        </div>
                        <div class="summary-item">
                            <div class="label mb-2">เวลาปฏิบัติงานนอกฐาน</div>
                            <div class="value ">1 ชั่วโมง 8 นาที</div>
                            <div class="sub-label">(ตั้งแต่ออกจากฐาน - กลับถึงฐาน)</div>
                        </div>
                        <div class="summary-item">
                            <div class="label mb-2">ระยะทางทั้งหมด</div>
                            <div class="value">33 กิโลเมตร</div>
                            <div class="sub-label">(ออกจากฐาน - กลับถึงฐาน)</div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- ---- ควบคุมการดำเนินการ ---- -->
            <div id="card_map_operation" class="card-body p-0 d-none">
                <div id="map_monitor" style="position: relative;">
                    <!-- พื้นที่แผนที่ -->
                </div>
            </div>

            <!-- ---- MAP สั่งการ ---- -->
            <div id="card_map" class="w-100 p-0 bg-primary map-oparating d-none">
                <div id="map_operations" style="position: relative;">
                    <!-- พื้นที่แผนที่ -->
                </div>



                <style>
                    /* Animation */
                    @keyframes slideIn {
                        from {
                            transform: translateX(100%);
                        }

                        to {
                            transform: translateX(0%);
                        }
                    }

                    @keyframes slideOut {
                        from {
                            transform: translateX(0%);
                        }

                        to {
                            transform: translateX(100%);
                        }
                    }


                    .slide-in {
                        animation: slideIn 0.3s forwards;
                    }

                    .menu-select-officer.slide-out {
                        animation: slideOut 0.3s forwards;
                    }

                    .menu-toggle-btn {
                        position: fixed;
                        top: 150px;
                        right: 30px;
                        z-index: 999;
                        display: none;
                        background-color: #fff;
                        color: #000;
                        width: 30px;
                        height: 50px;
                        padding: 0 0 0 5px !important;
                        text-align: center !important;
                        vertical-align: middle !important;
                        border-radius: 50px;
                        box-shadow: rgba(0, 0, 0, 0.3) 0px 1px 4px -1px;
                    }

                    @media (max-width: 400px) {
                        .menu-select-officer {
                            position: fixed;
                            top: 90px;
                            right: 5px;
                            height: calc(100dvh - 150px);
                            width: calc(100dvw - 10px);
                            background-color: #fff;
                            z-index: 999 !important;
                            border-radius: 13px;
                            box-shadow: 0px 4px 4px 0px rgba(0, 0, 0, 0.3);
                            -webkit-box-shadow: 0px 4px 4px 0px rgba(0, 0, 0, 0.3);
                            -moz-box-shadow: 0px 4px 4px 0px rgba(0, 0, 0, 0.3);
                            transition: transform 0.3s ease-in-out;
                            transform: translateX(0);
                            max-width: 100dvw;
                        }

                        .btn-group {
                            overflow: auto;
                        }
                    }
                </style>

                <!-- ปุ่มเปิดเมนู -->
                <button class="menu-toggle-btn btn slide-in">
                    <i class="fa-solid fa-chevron-left"></i>
                </button>

                <!-- เมนู -->
                <div class="menu-select-officer">
                    <button class="btn-close-menu">
                        <div class="d-flex justify-content-center align-items-center w-100 h-100">
                            <i class="fa-solid fa-xmark"></i>
                        </div>
                    </button>

                    <div class="menu-header">กรองข้อมูล</div>
                    <div class="col mx-3">
                        <div class="btn-group w-100 d-flex" role="group" aria-label="Basic example">
                            <button type="button" class="btn btn-dark w-100" onclick="select_for_search(this)">ทั้งหมด</button>
                            <button type="button" class="btn btn-outline-dark w-100" onclick="select_for_search(this)">ประเภท</button>
                            <button type="button" class="btn btn-outline-dark w-100" onclick="select_for_search(this)">ชื่อ</button>
                            <button type="button" class="btn btn-outline-dark w-100" onclick="select_for_search(this)">หน่วย</button>
                        </div>
                    </div>
                    <!-- ค้นหาจาก ประเภท -->
                    <div id="search_by_type" class="px-3 my-3 d-none">
                        <select class="form-select" name="input_search_by_type" id="input_search_by_type" onchange="filter_officers();">
                            <option>เลือกประเภท</option>
                        </select>
                    </div>

                    <!-- ค้นหาจาก ชื่อ -->
                    <div id="search_by_name" class="px-3 my-3 d-none">
                        <input type="text" class="form-control" name="input_search_by_name" id="input_search_by_name" placeholder="กรอกชื่อเจ้าหน้าที่" oninput="filter_officers(true)">
                    </div>

                    <!-- ค้นหาจาก หน่วย -->
                    <div id="search_by_unit" class="px-3 my-3 d-none">
                        <select class="form-select" name="input_search_by_unit" id="input_search_by_unit" onchange="filter_officers();">
                            <option>เลือกหน่วย</option>
                        </select>
                    </div>

                    <!-- -------------- แสดงผลรายชื่อเจ้าหน้าที่ -------------- -->
                    <!-- <div id="div_list_officer" class="card-body p-3"> -->
                    <!-- content By Javascript -->
                    <!-- </div> -->
                    <div class="menu-container mt-4">
                        <div class="menu-header">เจ้าหน้าที่</div>
                        <div class="menu-content">
                            <div class="content" id="div_list_officer">
                                <div class="content-items">
                                    <div>
                                        <p class="mb-0 font-18 fw-bolder text-dark">officer lux</p>
                                        <p class="mb-0 font-16 fw-light text-dark">viicheck</p>
                                        <p class="mb-0 font-16 fw-light text-dark">อาสาสมัคร</p>
                                    </div>
                                    <div>
                                        <button class="btn btn-success btn-select-officer">เลือก</button>
                                    </div>
                                </div>
                                <!-- ซ้ำอีกอัน -->
                                <div class="content-items">
                                    <div>
                                        <p class="mb-0 font-18 fw-bolder text-dark">officer lux</p>
                                        <p class="mb-0 font-16 fw-light text-dark">viicheck</p>
                                        <p class="mb-0 font-16 fw-light text-dark">อาสาสมัคร</p>
                                    </div>
                                    <div>
                                        <div class="officer-response officer-refuse">
                                            <i class="fa-regular fa-circle-xmark"></i>
                                            <p class="mb-0">ปฏิเสธ</p>
                                        </div>
                                    </div>
                                </div>

                                <div class="content-items">
                                    <div>
                                        <p class="mb-0 font-18 fw-bolder text-dark">officer lux</p>
                                        <p class="mb-0 font-16 fw-light text-dark">viicheck</p>
                                        <p class="mb-0 font-16 fw-light text-dark">อาสาสมัคร</p>
                                    </div>
                                    <div>
                                        <div class="officer-response officer-no-response">
                                            <i class="fa-regular fa-circle-exclamation"></i>
                                            <p class="mb-0">ไม่ตอบสนอง</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <script>
                    const menu = document.querySelector('.menu-select-officer');
                    const btnClose = document.querySelector('.btn-close-menu');
                    const btnOpen = document.querySelector('.menu-toggle-btn');

                    // เปิดเมนู
                    btnOpen.addEventListener('click', () => {
                        menu.style.display = 'block';
                        menu.classList.remove('slide-out');
                        menu.classList.add('slide-in');
                        btnOpen.style.display = 'none';
                    });

                    // ปิดเมนู
                    btnClose.addEventListener('click', () => {
                        menu.classList.remove('slide-in');
                        menu.classList.add('slide-out');

                        menu.addEventListener(
                            'animationend',
                            () => {
                                menu.style.display = 'none';
                                btnOpen.style.display = 'block';
                            }, {
                                once: true
                            }
                        );
                    });
                </script>



            </div>
        </div>
    </div>
</div>

<!-- Modal เลือกเจ้าหน้าที่ -->
<div class="modal fade" id="modal_view_select_officer" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="modal_view_select_officerLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modal_view_select_officerLabel">Modal title</h5>
            </div>
            <div class="modal-body">
                <!-- เนื้อหา modal -->
            </div>
            <div class="modal-footer justify-content-end">
                <button type="button" class="btn btn-secondary-normal me-2" style="width: 20%;" data-bs-dismiss="modal">
                    ยกเลิก
                </button>
                <button type="button" class="btn btn-success" id="btn_confirm_select">
                    เลือกเจ้าหน้าที่
                </button>
            </div>
        </div>
    </div>
</div>


<style>
    .modal-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 16px 20px;
        border-bottom: 1px solid #dee2e6;
    }

    .modal-title {
        font-size: 20px;
        font-weight: 700;
        margin: 0;
        color: #212529;
    }

    .loader {
        border: 5px solid #f3f3f3;
        border-top: 5px solid #0d6efd;
        border-radius: 50%;
        width: 50px;
        height: 50px;
        animation: spin 1s linear infinite;
        margin: 0 auto 20px auto;
    }

    @keyframes spin {
        0% {
            transform: rotate(0deg);
        }

        100% {
            transform: rotate(360deg);
        }
    }

    .waiting-name {
        margin-top: 0;
    }

    .officer-unit {
        color: #6c757d;
        margin: -5px 0 5px 0;
        font-size: 16px;
    }

    .timer-container {
        margin: 20px 0;
    }

    .timer-container p {
        margin: 0;
        font-size: 14px;
        color: #6c757d;
    }

    #timer_text {
        font-size: 42px;
        font-weight: 700;
        color: #212529;
        letter-spacing: 2px;
    }

    .warning-box {
        background-color: #fff3cd;
        border: 1px solid #ffc107;
        color: #664d03;
        padding: 12px;
        border-radius: 6px;
        font-size: 14px;
        margin-top: 20px;
        text-align: left;
    }

    .warning-box p {
        margin: 0;
    }

    .modal-wait-officer {
        max-width: 420px;
        margin: auto;
    }

    .status-icon-wrapper {
        margin: 0 auto 20px auto;
    }

    .status-icon {
        width: 80px;
        height: 80px;
        border-radius: 50%;
        margin: 0 auto;
        position: relative;
        box-sizing: border-box;
        animation: scale-in 0.3s ease-in-out;
    }

    @keyframes scale-in {
        from {
            transform: scale(0.5);
            opacity: 0;
        }

        to {
            transform: scale(1);
            opacity: 1;
        }
    }

    .rejection-icon {
        background-color: #f8d7da;
        border: 4px solid #dc3545;
    }

    .rejection-icon .icon-line {
        position: absolute;
        top: 50%;
        left: 50%;
        width: 40px;
        height: 5px;
        background-color: #dc3545;
        border-radius: 2px;
    }

    .rejection-icon .line-1 {
        transform: translate(-50%, -50%) rotate(45deg);
    }

    .rejection-icon .line-2 {
        transform: translate(-50%, -50%) rotate(-45deg);
    }

    .status-title {
        font-size: 24px;
        font-weight: 700;
        color: #212529;
        margin: 0 0 8px 0;
    }

    .status-description {
        font-size: 16px;
        color: #6c757d;
        line-height: 1.6;
        margin: 0;
    }
</style>
<!-- Modal รอเจ้าหน้าที่ -->
<div class="modal fade" id="wait_officer" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="wait_officerLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-wait-officer">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="wait_officerLabel">Modal title</h5>
            </div>
            <div class="modal-body text-center">

                <!-- เนื้อหา modal -->
            </div>
            <div class="modal-footer justify-content-end">
                <button id="btn_select_officer_again" type="button" class="btn btn-secondary-normal me-2" data-bs-dismiss="modal">
                    เลือกใหม่
                </button>
            </div>
        </div>
    </div>
</div>

<style>
    .btn-primary-blue {
        font-size: 16px;
        font-weight: 500;
        padding: 10px 20px;
        border: 1px solid transparent;
        border-radius: 6px;
        cursor: pointer;
        transition: all .15s ease-in-out;
        background-color: #0d6efd;
        border-color: #0d6efd;
        color: #fff;
    }

    .btn-primary-blue:hover {
        background-color: #0b5ed7;
        border-color: #0b5ed7;
        color: #fff;
    }
</style>
<!-- Modal เจ้าหน้าที่ ปฏิเสธ -->
<div class="modal fade" id="officer_refuse" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="officer_refuseLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-wait-officer">
        <div class="modal-content">
            <div class="modal-body text-center">
                <!-- เนื้อหา modal -->
            </div>

            <div class="modal-footer justify-content-end">
                <!-- <button type="button" class="btn btn-secondary-normal me-2 px-4  py-2"  data-bs-dismiss="modal">
                    ปิด
                </button> -->
                <button id="officer_refuse_select_again" type="button" class="btn btn-primary-blue me-2 py-2" data-bs-dismiss="modal">
                    เลือกใหม่
                </button>
            </div>
        </div>
    </div>
</div>

<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBgrxXDgk1tgXngalZF3eWtcTWI-LPdeus&language=th"></script>

<script>
    var check_show_map;

    document.addEventListener("DOMContentLoaded", function() {

        var aims_operating_officers_id = "{{ $emergency->op_aims_operating_officers_id }}";

        if (aims_operating_officers_id) {
            check_show_map = "card_map_operation";
            open_map_monitor();
        } else {
            check_show_map = "card_map";
            open_map_operating_unit();
        }

        // document.querySelector('#btn_order').click();
    });

    var map;
    var map_monitor;
    var aims_marker = "{{ url('/img/icon/operating_unit/aims/aims_marker.png') }}";
    var officer_marker = "{{ url('/img/icon/operating_unit/aims/officer.png') }}";
    var emergency_Lat = parseFloat("{{ $emergency->emergency_lat }}");
    var emergency_Lng = parseFloat("{{ $emergency->emergency_lng }}");
    var old_status = "{{ $emergency->op_status }}";

    // console.log(emergency_Lat);
    // console.log(emergency_Lng);

    function open_map_operating_unit() {

        let btn_order = document.querySelector('#btn_order');
        btn_order.innerHTML = "สั่งการ" ;
        
        const emergency_LatLng = {
            lat: emergency_Lat,
            lng: emergency_Lng
        };

        map = new google.maps.Map(document.getElementById("map_operations"), {
            center: emergency_LatLng,
            zoom: 15
        });

        new google.maps.Marker({
            position: emergency_LatLng,
            map: map,
            icon: {
                url: aims_marker,
                scaledSize: new google.maps.Size(45, 45),
            },
        });

        get_data_officer();

    }

    function open_map_monitor() {
        let btn_order = document.querySelector('#btn_order');
        btn_order.innerHTML = "ติดตาม" ;

        const emergency_LatLng = {
            lat: emergency_Lat,
            lng: emergency_Lng
        };

        map_monitor = new google.maps.Map(document.getElementById("map_monitor"), {
            center: emergency_LatLng,
            zoom: 15
        });
        show_data_helper();

    }

    function get_data_officer() {

        const officerRefuse = "{{ $emergency->op_officer_refuse }}".split(',').map(id => parseInt(id.trim())).filter(id => !isNaN(id));
        const officerNoRespond = "{{ $emergency->op_officer_no_respond }}".split(',').map(id => parseInt(id.trim())).filter(id => !isNaN(id));

        let let_emergency = parseFloat("{{ $emergency->emergency_lat }}");
        let lng_emergency = parseFloat("{{ $emergency->emergency_lng }}");

        fetch("{{ url('/') }}/api/get_data_officer/" + "{{ $emergency->aims_area_id }}")
            .then(response => response.json())
            .then(result => {
                // console.log(result);

                if (result) {

                    let div_list_officer = document.querySelector('#div_list_officer');
                    div_list_officer.innerHTML = '';

                    // เก็บประเภทและหน่วยไม่ให้ซ้ำ
                    let typeSet = new Set();
                    let unitSet = new Set();

                    for (let i = 0; i < result.length; i++) {

                        let officerLat = parseFloat(result[i].lat);
                        let officerLng = parseFloat(result[i].lng);

                        // เช็คว่ามีค่าพิกัดหรือไม่
                        if (!isNaN(officerLat) && !isNaN(officerLng)) {
                            let distance = calculateDistance(let_emergency, lng_emergency, officerLat, officerLng);
                            let distanceText = distance.toFixed(2);

                            // เพิ่มค่าประเภทและหน่วยลง Set
                            typeSet.add(result[i].unit_name_type_unit);
                            unitSet.add(result[i].unit_name_unit);

                            // ปักหมุดเจ้าหน้าที่
                            new google.maps.Marker({
                                position: {
                                    lat: officerLat,
                                    lng: officerLng
                                },
                                map: map,
                                title: result[i].name_officer,
                                icon: {
                                    url: officer_marker,
                                    scaledSize: new google.maps.Size(40, 40),
                                }
                            });

                            let buttonHTML = '';

                            let check_UserPhoto = 'ไม่มี';
                            if (result[i].user_photo) {
                                check_UserPhoto = result[i].user_photo;
                            }

                            if (officerRefuse.includes(result[i].id)) {
                                buttonHTML = `
                                    <div>
                                        <div class="officer-response officer-refuse">
                                            <i class="fa-regular fa-circle-xmark"></i>
                                            <p class="mb-0">ปฏิเสธ</p>
                                        </div>
                                    </div>
                                `;
                            } else if (officerNoRespond.includes(result[i].id)) {
                                buttonHTML = `
                                     <div>
                                        <div class="officer-response officer-no-response">
                                            <i class="fa-regular fa-circle-exclamation"></i>
                                            <p class="mb-0">ไม่ตอบสนอง</p>
                                        </div>
                                    </div>
                                `;
                            } else {
                                buttonHTML = `
                                        <button class="btn btn-success btn-select-officer" id="btn_of_id_${result[i].id}" onclick="view_select_officer('${result[i].id}' , '${check_UserPhoto}');">เลือก</button>

                                `;
                            }


                            let html = `
                                 <div class="content-items officer-card" id="div_officer_id_${result[i].id}"  type="${result[i].unit_name_type_unit}" name_officer="${result[i].name_officer}" unit="${result[i].unit_name_unit}" data-distance="${distanceText}">
                                    <div>
                                        <p class="mb-0 font-18 fw-bolder text-dark">${result[i].name_officer}</p>
                                        <p class="mb-0 font-16 fw-light text-dark">${result[i].unit_name_unit}</p>
                                        <p class="mb-0 font-16 fw-light text-dark">  ${result[i].unit_name_type_unit} (${distanceText} กม.) </p>
                                    </div>
                                    <div>
                                        ${buttonHTML}
                                    </div>
                                </div>
                            `;

                            div_list_officer.insertAdjacentHTML('beforeend', html); // แทรกล่างสุด
                        }
                    }

                    // สร้าง option สำหรับประเภท (เรียงตามตัวอักษร)
                    let typeSelect = document.getElementById('input_search_by_type');
                    typeSelect.innerHTML = `<option>เลือกประเภท</option>`;
                    [...typeSet].sort().forEach(type => {
                        typeSelect.insertAdjacentHTML('beforeend', `<option value="${type}">${type}</option>`);
                    });

                    // สร้าง option สำหรับหน่วย (เรียงตามตัวอักษร)
                    let unitSelect = document.getElementById('input_search_by_unit');
                    unitSelect.innerHTML = `<option>เลือกหน่วย</option>`;
                    [...unitSet].sort().forEach(unit => {
                        unitSelect.insertAdjacentHTML('beforeend', `<option value="${unit}">${unit}</option>`);
                    });

                }
            });

    }

    function calculateDistance(lat1, lon1, lat2, lon2) {
        const R = 6371; // รัศมีโลก (กม.)
        const toRad = x => x * Math.PI / 180;

        const dLat = toRad(lat2 - lat1);
        const dLon = toRad(lon2 - lon1);

        const a = Math.sin(dLat / 2) * Math.sin(dLat / 2) +
            Math.cos(toRad(lat1)) * Math.cos(toRad(lat2)) *
            Math.sin(dLon / 2) * Math.sin(dLon / 2);
        const c = 2 * Math.atan2(Math.sqrt(a), Math.sqrt(1 - a));

        return R * c; // ระยะทางเป็นกิโลเมตร
    }


    function view_select_officer(officer_id, userPhoto) {
        const officerDiv = document.getElementById(`div_officer_id_${officer_id}`);
        if (!officerDiv) return;

        const name_officer = officerDiv.getAttribute('name_officer') || '';
        const unit_type = officerDiv.getAttribute('type') || '';
        const unit_name = officerDiv.getAttribute('unit') || '';
        const distanceText = officerDiv.getAttribute('data-distance') || '';

        // อ้างอิงส่วนต่างๆ ใน modal ใหม่
        const modalTitle = document.getElementById('modal_view_select_officerLabel');
        const modalBody = document.querySelector('#modal_view_select_officer .modal-body');
        const confirmButton = document.getElementById('btn_confirm_select');

        let htmlPhoto = '';
        if (userPhoto != 'ไม่มี') {
            htmlPhoto = `<div class="officer-image-modal">
                            <img src="{{url('/storage')}}/${userPhoto}" alt="รูปเจ้าหน้าที่">
                        </div>`;
        }

        // เคลียร์และใส่เนื้อหาใหม่
        modalTitle.textContent = "ยืนยันการเลือกเจ้าหน้าที่";
        modalBody.innerHTML = `
            <div class="officer-card-modal">
                ${htmlPhoto}
                <div class="officer-details-modal">
                    <h4 class="officer-name-modal">${name_officer}</h4>
                    <div class="officer-info-modal">
                        <p><strong>หน่วย:</strong><span>${unit_name}</span></p>
                        <p><strong>ประเภท:</strong><span>${unit_type} 1</span></p>
                        <p><strong>ระยะห่าง:</strong><span> ${distanceText} กม.</span></p>
                    </div>
                </div>
            </div>
        `;

        // ตั้งค่า onclick ปุ่มยืนยัน
        confirmButton.setAttribute('onclick', `select_officer('${officer_id}', '${name_officer}', '${unit_name}', '${unit_type}')`);

        // เปิด modal
        $('#modal_view_select_officer').modal('show');
    }


    let waitOfficerInterval = null;
    let selectedEmergencyId = null;
    let selectedOfficerId = null;

    // ฟังก์ชันจัดการ beforeunload
    function handleBeforeUnload(e) {
        if (!selectedEmergencyId || !selectedOfficerId) return;

        const url = `{{ url('/') }}/api/officer_no_response`;

        const payload = JSON.stringify({
            emergency_id: selectedEmergencyId,
            officer_id: selectedOfficerId
        });

        const blob = new Blob([payload], {
            type: 'application/json'
        });

        navigator.sendBeacon(url, blob);
    }

    // ติดตั้ง event listener
    window.addEventListener('beforeunload', handleBeforeUnload);

    function select_officer(officer_id, name, unit, type) {
        let data = {
            emergency_id: "{{ $emergency->id }}",
            aims_operating_officers_id: officer_id,
            user_id_command: "{{ Auth::user()->id }}",
        };

        // เก็บข้อมูลระดับ global
        selectedEmergencyId = data.emergency_id;
        selectedOfficerId = officer_id;

        fetch("{{ url('/') }}/api/send_sos_to_officer", {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                body: JSON.stringify(data),
            })
            .then(response => response.text())
            .then(result => {
                // console.log(result);

                if (result === "send success") {
                    $('#modal_view_select_officer').modal('hide');

                    if (waitOfficerInterval) {
                        clearInterval(waitOfficerInterval);
                        waitOfficerInterval = null;
                    }

                    document.querySelector('#wait_officer .modal-body').innerHTML = '';
                    document.querySelector('#wait_officerLabel').innerText = 'กำลังรอการตอบรับ';

                    const infoHTML = `
                    
                    <div class="loader"></div>

                    <h4 class="officer-name waiting-name"> ${name}</h4>
                    <p class="officer-unit">หน่วย: ${unit}</p>
                    <p class="officer-unit">ประเภท: ${type}</p>
                    <div class="timer-container">
                        <p>ระยะเวลา</p>
                        <span id="timer_text">00:00</span>
                    </div>
                    <div class="warning-box">
                        <p>หากปิดแท็บหรือรีเฟรช เจ้าหน้าที่ ${name} จะเปลี่ยนสถานะเป็นไม่ตอบสนองเคสนี้</p>
                    </div>
                `;

                    document.querySelector('#wait_officer .modal-body').innerHTML = infoHTML;

                    let secondsPassed = 0;
                    waitOfficerInterval = setInterval(() => {
                        secondsPassed++;
                        const minutes = String(Math.floor(secondsPassed / 60)).padStart(2, '0');
                        const seconds = String(secondsPassed % 60).padStart(2, '0');
                        document.getElementById('timer_text').innerText = `${minutes}:${seconds}`;
                    }, 1000);

                    const againButton = document.querySelector('#btn_select_officer_again');
                    againButton.setAttribute('onclick', `select_officer_again(${data.emergency_id}, ${officer_id}, 'ไม่ตอบสนอง')`);

                    $('#wait_officer').modal('show');

                    let intervalId = setInterval(() => {
                        fetch("{{ url('/') }}/api/get_data_wait_officer/" + data.emergency_id + "/" + officer_id)
                            .then(response => response.text())
                            .then(result => {
                                // console.log(result);

                                if (result.trim() === "ปฏิเสธ") {
                                    clearInterval(intervalId);

                                    // ยกเลิกส่งข้อมูลเมื่อปิดแท็บ
                                    window.removeEventListener('beforeunload', handleBeforeUnload);

                                    // ล้างค่าตัวแปร global
                                    selectedEmergencyId = null;
                                    selectedOfficerId = null;

                                    $('#wait_officer').modal('hide');

                                    const modalBody = document.querySelector('#officer_refuse .modal-body');
                                    modalBody.innerHTML = `
                                    <div class="status-icon-wrapper mt-3">
                                        <div class="status-icon rejection-icon">
                                            <span class="icon-line line-1"></span>
                                            <span class="icon-line line-2"></span>
                                        </div>
                                    </div>
                                     <h3 class="status-title">เจ้าหน้าที่ปฏิเสธ</h3>
                                    <p class="status-description">
                                        "${name}" ได้ปฏิเสธการช่วยเหลือ<br>กรุณาเลือกเจ้าหน้าที่คนอื่น
                                    </p>
                                `;

                                    select_officer_again(data.emergency_id, officer_id, 'ปฏิเสธ')

                                    // const againButton = document.querySelector('#officer_refuse_select_again');
                                    // againButton.setAttribute('onclick', `select_officer_again(${data.emergency_id}, ${officer_id}, 'ปฏิเสธ')`);

                                    $('#officer_refuse').modal('show');
                                } else if (result.trim() === "รับเคส") {
                                    clearInterval(intervalId);
                                    // ยกเลิกส่งข้อมูลเมื่อปิดแท็บ
                                    window.removeEventListener('beforeunload', handleBeforeUnload);
                                    $('#wait_officer').modal('hide');

                                    // Modal เจ้าหน้าที่รับเคสแล้ว Officer go to help

                                    // ชุดนี้ย้ายไปหลังจากกดปุ่มใน Modal เจ้าหน้าที่รับเคสแล้ว
                                    check_show_map = "card_map_operation";
                                    document.getElementById('card_map').classList.add('d-none');
                                    document.getElementById('card_map_operation').classList.remove('d-none');
                                    open_map_monitor();
                                    // -----------------------------------

                                }

                            })
                            .catch(error => {
                                console.error("เกิดข้อผิดพลาดในการดึงข้อมูล:", error);
                            });
                    }, 5000);
                } else {
                    console.warn("ส่งข้อมูลไม่สำเร็จ:", result);
                }
            })
            .catch(error => {
                console.error('เกิดข้อผิดพลาด:', error);
            });
    }


    function select_officer_again(emergency_id, officer_id, type) {
        // console.log("เลือกใหม่:", emergency_id, officer_id);

        // ปิด modal ปัจจุบัน
        $('#wait_officer').modal('hide');

        // เคลียร์ตัวจับเวลา
        if (waitOfficerInterval) {
            clearInterval(waitOfficerInterval);
            waitOfficerInterval = null;
        }

        if (type == "ปฏิเสธ") {
            document.querySelector('#btn_of_id_' + officer_id).remove();
            let div_officer = document.querySelector('#div_officer_id_' + officer_id);
            let new_show = `<div>
                                <div class="officer-response officer-refuse">
                                    <i class="fa-regular fa-circle-xmark"></i>
                                    <p class="mb-0">ปฏิเสธ</p>
                                </div>
                            </div>`;
            div_officer.insertAdjacentHTML('beforeend', new_show); // แทรกล่างสุด

            $('#officer_refuse').modal('hide');
        } else if (type == "ไม่ตอบสนอง") {
            let data = {
                emergency_id: emergency_id,
                officer_id: officer_id
            };

            fetch("{{ url('/') }}/api/officer_no_response", {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    body: JSON.stringify(data),
                })
                .then(response => response.json())
                .then(result => {
                    if (result.status === 'ok') {
                        // console.log('สำเร็จ');
                        document.querySelector('#btn_of_id_' + officer_id).remove();
                        let div_officer = document.querySelector('#div_officer_id_' + officer_id);
                        let new_show = `<div>
                                            <div class="officer-response officer-no-response">
                                                <i class="fa-regular fa-circle-exclamation"></i>
                                                <p class="mb-0">ไม่ตอบสนอง</p>
                                            </div>
                                        </div>`;
                        div_officer.insertAdjacentHTML('beforeend', new_show); // แทรกล่างสุด
                    }
                })
                .catch(error => {
                    console.error('เกิดข้อผิดพลาด:', error);
                });
        }

    }

    function show_data_helper() {

        let emergency_id = "{{ $emergency->id }}";

        let info_officer = document.querySelector('#info_officer');

        let div_data_info_officer = document.querySelector('#div_data_info_officer');
        div_data_info_officer.innerHTML = '';

        fetch("{{ url('/') }}/api/get_for_show_helper/" + emergency_id)
            .then(response => response.json())
            .then(result => {
                // console.log(result);

                if (result) {

                    // ข้อมูลเส้นทาง
                    let emergency_id = result['emergency'].id;
                    let emergency_lat = result['emergency'].emergency_lat;
                    let emergency_lng = result['emergency'].emergency_lng;
                    let officer_lat = result['officer'].lat;
                    let officer_lng = result['officer'].lng;
                    let officer_id = result['officer'].id;

                    if (result['emergency'].op_status == "สั่งการ" || result['emergency'].op_status == "ออกจากฐาน") {
                        init_distance_tracking(emergency_lat, emergency_lng, officer_lat, officer_lng, officer_id, emergency_id);
                    } else {
                        let emergencyLatLng = {
                            lat: parseFloat(emergency_lat),
                            lng: parseFloat(emergency_lng)
                        };

                        if (!emergencyMarker) {
                            emergencyMarker = new google.maps.Marker({
                                position: emergencyLatLng,
                                map: map_monitor,
                                icon: {
                                    url: aims_marker,
                                    scaledSize: new google.maps.Size(45, 45)
                                },
                            });
                        }

                        startRealtimeCaseLoop(emergency_id);
                    }

                    // ข้อมูลเจ้าหน้าที่
                    let user_photo = ``;
                    if (result['officer'].user_photo) {
                        user_photo = `<img src="{{ url('/storage') }}/${result['officer'].user_photo}" height="70" width="70" alt="" style="border-radius: 50px; background-color: #D9D9D9;">`
                    }

                    let level = ``;
                    if (result['officer'].level) {
                        level = `<span>${result['officer'].level}</span>`;
                    }

                    let vehicle_type = ``;
                    if (result['officer'].vehicle_type) {
                        vehicle_type = `<span>${result['officer'].vehicle_type}</span>`;
                    }

                    let html = `

                        <div>
                            ${user_photo}
                        </div>
                        <div class="ms-3">
                            <div class="d-flex flex-wrap officer-info">
                                ${vehicle_type}
                                ${level}
                            </div>
                            <p class="mb-0">${result['officer'].name_officer}</p>
                            <p class="mb-0"> ${result['officer'].unit_name_unit} ,${result['officer'].unit_name_type_unit}</p>
                        </div>
                        
                    `;

                    div_data_info_officer.innerHTML = html;

                    info_officer.classList.remove('d-none');

                }
            });

    }

    let loopInterval_case_realtime;

    function startRealtimeCaseLoop(emergency_id) {
        get_data_case_realtime(emergency_id); // เรียกทันที 1 ครั้งก่อนเริ่ม interval
        loopInterval_case_realtime = setInterval(function() {
            get_data_case_realtime(emergency_id);
        }, 12000);
    }

    function get_data_case_realtime(emergency_id) {
        // รับ status, IDC, RC
        // console.log("รับ status, IDC, RC");
        fetch("{{ url('/') }}/api/get_data_case_realtime/" + emergency_id)
            .then(response => response.json())
            .then(result => {
                if (result) {
                    const idc = result[0].idc;
                    const rc = result[0].rc;

                    // เปลี่ยนข้อความ
                    document.querySelector('#show_text_idc').innerHTML = idc;
                    document.querySelector('#show_text_rc').innerHTML = rc;

                    // อัปเดต class สำหรับ idc
                    const idcDiv = document.querySelector('#status_idc');
                    idcDiv.className = 'status-rc ' + getStatusClass(idc);

                    // อัปเดต class สำหรับ rc
                    const rcDiv = document.querySelector('#status_rc');
                    rcDiv.className = 'status-rc ' + getStatusClass(rc);

                    // ตรวจสอบการเปลี่ยนสถานะ
                    if (old_status !== result[0].status) {
                        old_status = result[0].status;
                        alert_change_status_case(result[0].status);
                    }

                    // หยุด loop ถ้าเสร็จสิ้น
                    if (result[0].status === 'เสร็จสิ้น') {
                        clearInterval(loopInterval_case_realtime);
                    }
                }
            });

    }

    function getStatusClass(status) {
        switch (status) {
            case 'ทั่วไป':
                return 'status-normal';
            case 'ไม่รุนแรง':
                return 'status-success';
            case 'เร่งด่วน':
                return 'status-warning';
            case 'ฉุกเฉิน':
                return 'status-danger';
            case 'อื่นๆ':
                return 'status-other';
            default:
                return '';
        }
    }

    function alert_change_status_case(new_status) {
        document.querySelector('#show_status').innerHTML = `สถานะ : ${new_status}`;
        alert(new_status)
    }

    let emergencyMarker = null;
    let officerMarker = null;
    let directionsRenderer = null;
    let distanceInterval = null;

    function init_distance_tracking(emergencyLat, emergencyLng, officerLat, officerLng, officer_id, emergency_id) {
        const emergencyLatLng = {
            lat: parseFloat(emergencyLat),
            lng: parseFloat(emergencyLng)
        };
        const officerLatLng = {
            lat: parseFloat(officerLat),
            lng: parseFloat(officerLng)
        };

        // Emergency Marker
        if (!emergencyMarker) {
            emergencyMarker = new google.maps.Marker({
                position: emergencyLatLng,
                map: map_monitor,
                icon: {
                    url: aims_marker,
                    scaledSize: new google.maps.Size(45, 45)
                },
            });
        }

        // Officer Marker
        if (!officerMarker) {
            officerMarker = new google.maps.Marker({
                position: officerLatLng,
                map: map_monitor,
                icon: {
                    url: officer_marker,
                    scaledSize: new google.maps.Size(45, 45)
                },
            });
        }

        // Directions Renderer (ไม่มี A, B)
        if (!directionsRenderer) {
            directionsRenderer = new google.maps.DirectionsRenderer({
                map: map_monitor,
                suppressMarkers: true
            });
        }

        // คำนวณครั้งแรก
        update_distance(emergencyLat, emergencyLng, officerLat, officerLng);

        // เริ่ม loop
        distanceInterval = setInterval(() => {
            fetch("{{ url('/') }}/api/get_location_realtime/" + officer_id + "/" + emergency_id)
                .then(response => response.json())
                .then(result => {
                    let status = result?.emergency?.status;
                    let officer = result?.officer;

                    if (old_status != status) {
                        old_status = status
                        alert_change_status_case(status);
                    }

                    if (status === "ถึงที่เกิดเหตุ") {
                        // หยุด loop และเคลียร์แผนที่
                        clearInterval(distanceInterval);
                        distanceInterval = null;

                        if (directionsRenderer) {
                            directionsRenderer.setMap(null);
                            directionsRenderer = null;
                        }

                        if (officerMarker) {
                            officerMarker.setMap(null);
                            officerMarker = null;
                        }

                        map_monitor.setCenter(emergencyMarker.getPosition());

                        let show_time_distance = document.querySelector('#show_time_distance');
                        show_time_distance.innerHTML = "ถึงที่เกิดเหตุแล้ว";
                        show_time_distance.classList.remove('d-none')

                        startRealtimeCaseLoop(emergency_id);
                        return;
                    }

                    // ถ้ามีข้อมูลตำแหน่งเจ้าหน้าที่ใหม่
                    if (officer?.lat && officer?.lng) {
                        const newLatLng = {
                            lat: parseFloat(officer.lat),
                            lng: parseFloat(officer.lng)
                        };

                        officerMarker.setPosition(newLatLng);
                        update_distance(emergencyLat, emergencyLng, officer.lat, officer.lng);
                    }
                });
        }, 12000);
    }

    function update_distance(emergencyLat, emergencyLng, officerLat, officerLng) {
        const directionsService = new google.maps.DirectionsService();

        const request = {
            origin: {
                lat: parseFloat(officerLat),
                lng: parseFloat(officerLng)
            },
            destination: {
                lat: parseFloat(emergencyLat),
                lng: parseFloat(emergencyLng)
            },
            travelMode: google.maps.TravelMode.DRIVING
        };

        directionsService.route(request, function(result, status) {
            if (status === google.maps.DirectionsStatus.OK) {
                directionsRenderer.setDirections(result);

                // ระยะทาง
                let text_distance = result.routes[0].legs[0].distance.text;
                // เวลา
                let text_duration = result.routes[0].legs[0].duration.text;
                // เวลาถึงโดยประมาณ
                let text_arrivalTime = aims_func_arrivalTime(result.routes[0].legs[0].duration.value);

                // ใส่ข้อความลงใน HTML
                let show_time_distance = document.querySelector('#show_time_distance');
                show_time_distance.classList.remove('d-none');
                show_time_distance.innerHTML = `${text_duration} (${text_distance}) • ${text_arrivalTime}`;

            } else {
                console.error("Directions request failed: " + status);
            }
        });
    }

    function aims_func_arrivalTime(duration) {
        // assuming you have already obtained the duration from Google Maps API and stored it in a variable called `duration`
        let date_now = new Date(); // get the current time
        let travelTimeInSeconds = duration; // get the travel time in seconds
        let arrivalTime = new Date(date_now.getTime() + (travelTimeInSeconds * 1000)); // add the travel time to the current time and create a new date object
        // let formattedTime = arrivalTime.toLocaleTimeString(); // format the arrival time as a string in a readable format
        let options = {
            hourCycle: 'h24'
        };
        let formattedTime = arrivalTime.toLocaleTimeString('th-TH', options);
        let timeWithoutSeconds = formattedTime.slice(0, -3); // ตัดวินาทีออก
        let timeWithSuffix = `${timeWithoutSeconds} น.`; // เติม "น." เข้าไป

        return timeWithSuffix;
    }




    document.getElementById('btn_order').addEventListener('click', function() {
        // ปรับปุ่ม
        this.classList.remove('btn-outline-danger');
        this.classList.add('btn-danger');

        document.getElementById('btn_info').classList.remove('btn-primary');
        document.getElementById('btn_info').classList.add('btn-outline-primary');

        // สลับแสดงผล
        document.getElementById('data_case').classList.add('d-none');
        document.getElementById('card_map').classList.add('d-none');
        document.getElementById('card_map_operation').classList.add('d-none');

        // แสดงเฉพาะอันที่ต้องการ
        if (check_show_map === "card_map") {
            document.getElementById('card_map').classList.remove('d-none');
        } else if (check_show_map === "card_map_operation") {
            document.getElementById('card_map_operation').classList.remove('d-none');
        }
    });

    document.getElementById('btn_info').addEventListener('click', function() {
        // ปรับปุ่ม
        this.classList.remove('btn-outline-primary');
        this.classList.add('btn-primary');

        document.getElementById('btn_order').classList.remove('btn-danger');
        document.getElementById('btn_order').classList.add('btn-outline-danger');

        // สลับแสดงผล
        document.getElementById('data_case').classList.remove('d-none');
        document.getElementById('card_map').classList.add('d-none');
        document.getElementById('card_map_operation').classList.add('d-none');
    });

    function select_for_search(btn) {
        // เปลี่ยนคลาสของปุ่มให้เฉพาะปุ่มที่ถูกเลือกเป็น active (btn-info)
        document.querySelectorAll('.btn-group .btn').forEach(b => {
            b.classList.remove('btn-dark', 'text-white');
            b.classList.add('btn-outline-dark');
        });
        btn.classList.remove('btn-white', 'text-dark');
        btn.classList.add('btn-dark', 'text-white');

        // ซ่อน input ทั้งหมดก่อน แล้วค่อยโชว์อันที่ต้องการ
        document.getElementById('search_by_type').classList.add('d-none');
        document.getElementById('search_by_name').classList.add('d-none');
        document.getElementById('search_by_unit').classList.add('d-none');

        // รีเซ็ตค่าของ input ทุกตัว
        document.getElementById('input_search_by_type').selectedIndex = 0;
        document.getElementById('input_search_by_unit').selectedIndex = 0;
        document.getElementById('input_search_by_name').value = '';

        // ตรวจสอบว่าผู้ใช้กดค้นหาจากอะไร
        const selectedText = btn.textContent.trim();

        if (selectedText === 'ประเภท') {
            document.getElementById('search_by_type').classList.remove('d-none');
        } else if (selectedText === 'ชื่อ') {
            const input = document.getElementById('search_by_name');
            input.classList.remove('d-none');
            document.getElementById('input_search_by_name').focus(); // ใส่ focus ให้เลย
        } else if (selectedText === 'หน่วย') {
            document.getElementById('search_by_unit').classList.remove('d-none');
        }

        // เรียก filter_officers เพื่อแสดงผลใหม่หลังจากรีเซ็ต
        filter_officers();
    }


    let nameSearchTimeout = null;

    function filter_officers(delaySearch = false) {
        const selectedFilter = document.querySelector('.btn-group .btn-dark').textContent.trim();

        const allOfficerCards = document.querySelectorAll('.officer-card');

        const selectedType = document.getElementById('input_search_by_type').value.trim();
        const inputName = document.getElementById('input_search_by_name').value.trim().toLowerCase();
        const selectedUnit = document.getElementById('input_search_by_unit').value.trim();

        // Delay การค้นหาชื่อ
        if (delaySearch && selectedFilter === 'ชื่อ') {
            clearTimeout(nameSearchTimeout);
            nameSearchTimeout = setTimeout(() => {
                filter_officers(false); // เรียกใหม่แบบไม่มี delay
            }, 500);
            return;
        }

        // ถ้าเลือก "ทั้งหมด" ให้แสดงทุกอัน
        if (selectedFilter === 'ทั้งหมด') {
            allOfficerCards.forEach(card => {
                card.classList.remove('d-none');
                const hr = card.nextElementSibling;
                if (hr && hr.tagName === 'HR') {
                    hr.classList.remove('d-none');
                }
            });
            return;
        }

        // เงื่อนไขกรณีอื่น ๆ
        allOfficerCards.forEach(card => {
            const cardType = card.getAttribute('type') || '';
            const cardName = card.getAttribute('name_officer') || '';
            const cardUnit = card.getAttribute('unit') || '';

            let isVisible = true;

            if (selectedFilter === 'ประเภท') {
                isVisible = (selectedType === 'เลือกประเภท' || selectedType === '') ? true : (cardType === selectedType);
            } else if (selectedFilter === 'ชื่อ') {
                isVisible = cardName.toLowerCase().includes(inputName);
            } else if (selectedFilter === 'หน่วย') {
                isVisible = (selectedUnit === 'เลือกหน่วย' || selectedUnit === '') ? true : (cardUnit === selectedUnit);
            }

            if (isVisible) {
                card.classList.remove('d-none');
                const hr = card.nextElementSibling;
                if (hr && hr.tagName === 'HR') {
                    hr.classList.remove('d-none');
                }
            } else {
                card.classList.add('d-none');
                const hr = card.nextElementSibling;
                if (hr && hr.tagName === 'HR') {
                    hr.classList.add('d-none');
                }
            }
        });
    }
</script>

@endsection
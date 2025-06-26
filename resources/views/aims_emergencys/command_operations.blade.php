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
            width: 500px;
        }


    }

    @media (min-width: 1350px) {
        .data-oparating {
            width: 600px;
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
    
</style>
<div class="col  radius-10 align-items-center">
    <div class="card radius-10 w-100   mt-4 container-oparating" style="">
        <div class="h-100 content-oparating m-0 ">
            <div class="data-oparating h-100 m-0 p-0" style="border-right: 1px solid #DADADA;">
                <div class="px-4 py-3" style="border-bottom:  1px solid #DADADA;;">
                    <div class="header">รหัสปฏิบัติการ</div>
                    <p class="mb-0">{{ $emergency->op_operating_code ?? '-' }}</p>
                    <!-- <button class="btn w-100 btn-show-img">ดูรูปภาพ</button> -->
                    <div class="d-flex">
                        <button class="btn w-100 btn-outline-danger mx-1 " id="btn_order">
                            สั่งการ
                        </button>
                        <button class="btn w-100 mx-1 btn-primary " id="btn_info">
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
                    <button class="btn w-100 btn-show-img collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseOne" aria-expanded="false" aria-controls="flush-collapseOne">
                        ดูรูปภาพ
                    </button>
                    <div id="flush-collapseOne" class="accordion-collapse collapse" aria-labelledby="flush-headingOne" data-bs-parent="#accordionFlushExample" style="">
                        <div class="accordion-body">
                            <img class="photo-img" src="{{ url('/storage') }}/{{ $emergency->emergency_photo }}">
                        </div>
                    </div>
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
                <div class="px-4 py-3" style="border-bottom:  1px solid #DADADA;;">
                    <div class="header">สถานะ : {{ $emergency->op_status }}</div>
                    <div class="mb-4">
                        <p class="mb-0">การประเมินจากศูนย์</p>
                        <div class="status-rc {{$class_status_idc}}">
                            <i class="fa-solid fa-circle-small mx-2"></i>
                            <span> {{ $emergency->idc ?? '-' }}</span>
                        </div>
                    </div>
                    <div>
                        <p class="mb-0">การประเมินจากหน่วย</p>
                        <div class="status-rc {{$class_status_rc}}">
                            <i class="fa-solid fa-circle-small mx-2"></i>
                            <span>{{ $emergency->rc ?? '-' }}</span>
                        </div>
                    </div>
                </div>
                <div class="px-4 py-3" style="border-bottom:  1px solid #DADADA;;">
                    <div class="header">ข้อมูลหน่วยแพทย์</div>
                    <div class="d-flex align-items-center">
                        <div>
                            <img src="" height="70" width="70" alt="" style="border-radius: 50px; background-color: #D9D9D9;">
                        </div>
                        <div class="ms-3">
                            <div class="d-flex flex-wrap officer-info">
                                <span>CAR</span>
                                <span>BLS</span>
                            </div>
                            <p class="mb-0">officer</p>
                            <p class="mb-0">viicheck , อาสาสมัคร</p>
                        </div>
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
            </div>

            <!-- ---- ควบคุมการดำเนินการ ---- -->
            <div id="card_map_operation" class="card-body p-3 d-none">
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
                        top: 90px;
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
                            <button type="button" class="btn btn-outline-dark w-100" onclick="select_for_search(this)">ทั้งหมด</button>
                            <button type="button" class="btn btn-outline-dark w-100" onclick="select_for_search(this)">ประเภท</button>
                            <button type="button" class="btn btn-outline-dark w-100" onclick="select_for_search(this)">ชื่อ</button>
                            <button type="button" class="btn btn-outline-dark w-100" onclick="select_for_search(this)">หน่วย</button>
                        </div>
                    </div>
                    <!-- ค้นหาจาก ประเภท -->
                    <div id="search_by_type" class="px-2 d-none">
                        <select class="form-select" name="input_search_by_type" id="input_search_by_type" onchange="filter_officers();">
                            <option>เลือกประเภท</option>
                        </select>
                    </div>

                    <!-- ค้นหาจาก ชื่อ -->
                    <div id="search_by_name" class="px-2 d-none">
                        <input type="text" class="form-control" name="input_search_by_name" id="input_search_by_name" placeholder="กรอกชื่อเจ้าหน้าที่" oninput="filter_officers(true)">
                    </div>

                    <!-- ค้นหาจาก หน่วย -->
                    <div id="search_by_unit" class="px-2 d-none">
                        <select class="form-select" name="input_search_by_unit" id="input_search_by_unit" onchange="filter_officers();">
                            <option>เลือกหน่วย</option>
                        </select>
                    </div>

                    <!-- -------------- แสดงผลรายชื่อเจ้าหน้าที่ -------------- -->
                    <div id="div_list_officer" class="card-body p-3">
                        <!-- content By Javascript -->
                    </div>
                    <div class="menu-container mt-4">
                        <div class="menu-header">เจ้าหน้าที่</div>
                        <div class="menu-content">
                            <div class="content"  id="div_list_officer" >
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
            <div class="modal-footer justify-content-center">
                <button type="button" class="btn btn-secondary me-2" style="width: 20%;" data-bs-dismiss="modal">
                    ยกเลิก
                </button>
                <button type="button" class="btn btn-success" style="width: 20%;" id="btn_confirm_select">
                    ยืนยัน
                </button>
            </div>
        </div>
    </div>
</div>

<!-- Modal รอเจ้าหน้าที่ -->
<div class="modal fade" id="wait_officer" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="wait_officerLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="wait_officerLabel">Modal title</h5>
            </div>
            <div class="modal-body">
                <!-- เนื้อหา modal -->
            </div>
            <div class="modal-footer justify-content-center">
                <button id="btn_select_officer_again" type="button" class="btn btn-secondary me-2" style="width: 20%;" data-bs-dismiss="modal">
                    เลือกใหม่
                </button>
            </div>
        </div>
    </div>
</div>

<!-- Modal เจ้าหน้าที่ ปฏิเสธ -->
<div class="modal fade" id="officer_refuse" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="officer_refuseLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="officer_refuseLabel">Modal title</h5>
            </div>
            <div class="modal-body">
                <!-- เนื้อหา modal -->
            </div>
            <div class="modal-footer justify-content-center">
                <button id="officer_refuse_select_again" type="button" class="btn btn-secondary me-2" style="width: 20%;" data-bs-dismiss="modal">
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

                            if (officerRefuse.includes(result[i].id)) {
                                buttonHTML = `
                                    <span class="ms-auto text-danger fw-bold">ปฏิเสธ</span>
                                `;
                            } else if (officerNoRespond.includes(result[i].id)) {
                                buttonHTML = `
                                    <span class="ms-auto" style="color:#DD8616;">ไม่ตอบสนอง</span>
                                `;
                            } else {
                                buttonHTML = `
                                    <button id="btn_of_id_${result[i].id}" class="btn btn-sm btn-success radius-30 ms-auto mb-0" onclick="view_select_officer('${result[i].id}');">
                                        <span class="mx-2">เลือก</span>
                                    </button>
                                `;
                            }


                            let html = `
                                <div id="div_officer_id_${result[i].id}" class="d-flex align-items-center officer-card" type="${result[i].unit_name_type_unit}" name_officer="${result[i].name_officer}" unit="${result[i].unit_name_unit}" data-distance="${distanceText}">
                                    <div class="ps-3">
                                        <h6 class="mb-0 font-weight-bold">
                                            <b>${result[i].name_officer}</b>
                                        </h6>
                                        <span class="mt-2 text-secondary">
                                            <b>${result[i].unit_name_unit}</b>
                                            <br>
                                            ${result[i].unit_name_type_unit}
                                            <br>
                                            ระยะห่าง(รัศมี) ≈ ${distanceText} กม. 
                                        </span>
                                    </div>
                                    ${buttonHTML}
                                </div>
                                <hr>
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


    function view_select_officer(officer_id) {
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

        // เคลียร์และใส่เนื้อหาใหม่
        modalTitle.textContent = "ยืนยันการเลือกเจ้าหน้าที่";
        modalBody.innerHTML = `
            <p><strong>ชื่อ:</strong> ${name_officer}</p>
            <p><strong>หน่วย:</strong> ${unit_name}</p>
            <p><strong>ประเภท:</strong> ${unit_type}</p>
            <p><strong>ระยะห่าง:</strong> ${distanceText} กม.</p>
            <p class="text-danger">คุณต้องการเลือกเจ้าหน้าที่คนนี้ใช่หรือไม่?</p>
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
                    document.querySelector('#wait_officerLabel').innerText = 'กำลังรอเจ้าหน้าที่ตอบรับ';

                    const infoHTML = `
                    <p><strong>ชื่อ:</strong> ${name}</p>
                    <p><strong>หน่วย:</strong> ${unit}</p>
                    <p><strong>ประเภท:</strong> ${type}</p>
                    <p><strong>ระยะเวลา:</strong> <span id="timer_text">00:00</span></p>
                    <p style="color: red; font-weight: bold;">
                      หากปิดแท็บหรือรีเฟรช เจ้าหน้าที่ ${name} จะเปลี่ยนสถานะเป็นไม่ตอบสนองเคสนี้
                    </p>
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
                                    <p><strong>ชื่อ:</strong> ${name}</p>
                                    <p><strong>หน่วย:</strong> ${unit}</p>
                                    <p><strong>ประเภท:</strong> ${type}</p>
                                    <p class="text-danger"><strong>เจ้าหน้าที่ปฏิเสธการรับเคสนี้</strong></p>
                                `;

                                    const againButton = document.querySelector('#officer_refuse_select_again');
                                    againButton.setAttribute('onclick', `select_officer_again(${data.emergency_id}, ${officer_id}, 'ปฏิเสธ')`);

                                    $('#officer_refuse').modal('show');
                                } else if (result.trim() === "รับเคส") {
                                    clearInterval(intervalId);
                                    // ยกเลิกส่งข้อมูลเมื่อปิดแท็บ
                                    window.removeEventListener('beforeunload', handleBeforeUnload);
                                    $('#wait_officer').modal('hide');

                                    check_show_map = "card_map_operation";
                                    document.getElementById('card_map').classList.add('d-none');
                                    document.getElementById('card_map_operation').classList.remove('d-none');
                                    open_map_monitor();

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
            let new_show = `<span class="ms-auto text-danger fw-bold">ปฏิเสธ</span>`;
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
                        let new_show = `<span class="ms-auto" style="color:#DD8616;">ไม่ตอบสนอง</span>`;
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
                        user_photo = `<img src="{{ url('/storage') }}/${result['officer'].user_photo}" class="rounded-circle p-1" style="width:110px;height: 110px;object-fit: cover;">`
                    }

                    let level = `-`;
                    if (result['officer'].level) {
                        level = result['officer'].level
                    }

                    let html = `
                        ${user_photo}
                        <div class="mt-3">
                            <h4 id="info_name_officer">
                                ${result['officer'].name_officer}
                            </h4>
                            <p id="info_name_unit" class="text-secondary mb-1">
                                ${result['officer'].unit_name_unit}
                            </p>
                            <p id="info_type_unit" class="text-muted font-size-sm">
                                ${result['officer'].unit_name_type_unit}
                            </p>
                            <button id="info_vehicle_type" class="btn btn-sm btn-outline-dark" style="width:47%;">
                                ${result['officer'].vehicle_type}
                            </button>
                            <button id="info_level" class="btn btn-sm btn-outline-dark" style="width:47%;">
                                Lv. ${level}
                            </button>
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

                    document.querySelector('#show_text_idc').innerHTML = result[0].idc;
                    document.querySelector('#show_text_rc').innerHTML = result[0].rc;

                    if (old_status != result[0].status) {
                        old_status = result[0].status
                        alert_change_status_case(result[0].status);
                    }

                    if (result[0].status === 'เสร็จสิ้น') {
                        clearInterval(loopInterval_case_realtime); // หยุดการ loop
                        // console.log("เสร็จสิ้น");
                    }
                }
            });

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
            b.classList.remove('btn-dark' ,'text-white');
            b.classList.add('btn-outline-dark');
        });
        btn.classList.remove('btn-white' ,'text-dark');
        btn.classList.add('btn-dark' ,'text-white');

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
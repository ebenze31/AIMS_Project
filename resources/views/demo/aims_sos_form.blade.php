@extends('layouts.partners.theme_partner_new')
@section('content')
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
    }

    .status-other {
        background-color: rgb(0, 0, 0, .13);
        color: #000;
    }

    .status-normal {
        background-color: rgb(19, 113, 253, .13);
        color: #1371fd;
    }

    .status-success {
        background-color: rgb(28, 208, 83, .15);
        color: rgb(28, 208, 83);
    }

    .status-warning {
        background-color: rgb(255, 197, 23, .13);
        color: rgb(255, 197, 23);
    }

    .status-danger {
        background-color: rgb(255, 0, 0, .15);
        color: rgb(255, 0, 0);
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
                    <div class="header">ข้อมูลผู้ข้อความช่วยเหลือ</div>
                    <p class="mb-0">ชื่อผู้แจ้ง : Teerasak</p>
                    <p class="mb-0">เบอร์ : ไม่ได้ระบุ</p>
                    <p class="mb-0">เบอร์ : ไม่ได้ระบุ</p>
                    <button class="btn w-100 btn-show-img">ดูรูปภาพ</button>
                </div>
                <div class="px-4 py-3" style="border-bottom:  1px solid #DADADA;;">
                    <div class="header">สถานะ : ถึงที่เกิดเหตุ</div>
                    <div class="mb-4">
                        <p class="mb-0">การประเมินจากศูนย์</p>
                        <div class="status-rc status-normal">
                            <i class="fa-solid fa-circle-small mx-2"></i>
                            <span>ทั่วไป</span>
                        </div>
                    </div>
                    <div>
                        <p class="mb-0">การประเมินจากหน่วย</p>
                        <div class="status-rc status-danger">
                            <i class="fa-solid fa-circle-small mx-2"></i>
                            <span>ฉุกเฉิน</span>
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
            <div class="w-100 p-0 map-oparating px-4 py-3" style="">
                <div class="header">ข้อมูลผู้ข้อความช่วยเหลือ</div>

                <div class="row g-3">
                    <div class="col-lg-6">
                        <label for="inputFirstName" class="form-label">ผู้แจ้งเหตุ</label>
                        <input type="text" class="form-control" id="inputFirstName">
                    </div>
                    <div class="col-lg-3 col-md-6">
                        <label for="inputLastName" class="form-label">เบอร์ผู้แจ้งเหตุ</label>
                        <input type="text" class="form-control" id="inputLastName">
                    </div>
                    <div class="col-lg-3 col-md-6">
                        <label for="inputLastName" class="form-label">ประเภทผู้แจ้ง</label>
                        <input type="text" class="form-control" id="inputLastName">
                    </div>
                    <div class="col-lg-3 col-md-6">
                        <label for="inputLastName" class="form-label">แพลตฟอร์มการแจ้ง</label>
                        <input type="text" class="form-control" id="inputLastName">
                    </div>
                    <div class="col-lg-3 col-md-6">
                        <label for="inputLastName" class="form-label">latitude ที่เกิดเหตุ</label>
                        <input type="text" class="form-control" id="inputLastName">
                    </div>
                    <div class="col-lg-3 col-md-6">
                        <label for="inputLastName" class="form-label">longitude ที่เกิดเหตุ</label>
                        <input type="text" class="form-control" id="inputLastName">
                    </div>
                    <div class="col-lg-3 col-md-6">
                        <label for="inputLastName" class="form-label">ประเภทเหตุ</label>
                        <input type="text" class="form-control" id="inputLastName">
                    </div>
                    <label for="inputAddress" class="form-label">รายละเอียดสถานที่เกิดเหตุ</label>

                    <div class="col-12">
                        <textarea class="form-control" id="inputAddress" rows="3"></textarea>
                    </div>

                    <div class="col-12">
                        <label for="inputAddress2" class="form-label">รายละเอียดเหตุการณ์</label>
                        <textarea class="form-control" id="inputAddress2" rows="3"></textarea>
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
                                <input type="checkbox" name="symptom" id="symptom_1">
                                <label for="symptom_1">
                                    ๑.ปวดท้อง หลัง เชิงกราน และขาหนีบ
                                </label>
                            </div>

                            <div class="checkbox-symptom">
                                <input type="checkbox" name="symptom" id="symptom_2">
                                <label for="symptom_2">
                                    ๒.แอนนาฟิแลกซิส ปฏิกิริยาภูมิแพ้/แมลงกัด
                                </label>
                            </div>

                            <div class="checkbox-symptom">
                                <input type="checkbox" name="symptom" id="symptom_3">
                                <label for="symptom_3">
                                    ๓.สัตว์กัด
                                </label>
                            </div>

                            <div class="checkbox-symptom">
                                <input type="checkbox" name="symptom" id="symptom_4">
                                <label for="symptom_4">
                                    ๔.เลือดออกไม่ใช่จากการบาดเจ็บ
                                </label>
                            </div>

                            <div class="checkbox-symptom">
                                <input type="checkbox" name="symptom" id="symptom_5">
                                <label for="symptom_5">
                                    ๕.หายใจลำบาก
                                </label>
                            </div>

                            <div class="checkbox-symptom">
                                <input type="checkbox" name="symptom" id="symptom_6">
                                <label for="symptom_6">
                                    ๖.หัวใจหยุดเต้น
                                </label>
                            </div>

                            <div class="checkbox-symptom">
                                <input type="checkbox" name="symptom" id="symptom_7">
                                <label for="symptom_7">
                                    ๗.เจ็บแน่นทรางออก หัวใจ
                                </label>
                            </div>

                            <div class="checkbox-symptom">
                                <input type="checkbox" name="symptom" id="symptom_8">
                                <label for="symptom_8">
                                    ๘.สำลักอุดทางเดินหายใจ
                                </label>
                            </div>
                            <div class="checkbox-symptom">
                                <input type="checkbox" name="symptom" id="symptom_9">
                                <label for="symptom_9">
                                    ๙.เบาหวาน
                                </label>
                            </div>

                            <div class="checkbox-symptom">
                                <input type="checkbox" name="symptom" id="symptom_10">
                                <label for="symptom_10">
                                    ๑๐.อันตรายจากสภาพแวดล้อม
                                </label>
                            </div>

                            <div class="checkbox-symptom">
                                <input type="checkbox" name="symptom" id="symptom_11">
                                <label for="symptom_11">
                                    ๑๑.<s>อื่นๆ(เว้นว่าง)</s><sup>(๔)</sup>
                                </label>
                            </div>

                            <div class="checkbox-symptom">
                                <input type="checkbox" name="symptom" id="symptom_12">
                                <label for="symptom_12">
                                    ๑๒.ปวดศรีษะ ลำคอ
                                </label>
                            </div>

                            <div class="checkbox-symptom">
                                <input type="checkbox" name="symptom" id="symptom_13">
                                <label for="symptom_13">
                                    ๑๓.คลุ้มคลั่ง จิตประสาท อารมณ์
                                </label>
                            </div>

                            <div class="checkbox-symptom">
                                <input type="checkbox" name="symptom" id="symptom_14">
                                <label for="symptom_14">
                                    ๑๔.ยาเกิดขนาด ได้รับพิษ
                                </label>
                            </div>

                            <div class="checkbox-symptom">
                                <input type="checkbox" name="symptom" id="symptom_15">
                                <label for="symptom_15">
                                    ๑๕.มีครรภ คลอด นรี
                                </label>
                            </div>

                            <div class="checkbox-symptom">
                                <input type="checkbox" name="symptom" id="symptom_16">
                                <label for="symptom_16">
                                    ๑๖.ชัก
                                </label>
                            </div>
                            <div class="checkbox-symptom">
                                <input type="checkbox" name="symptom" id="symptom_17">
                                <label for="symptom_17">
                                    ๑๗.ป่วย อ่อนเพลีย
                                </label>
                            </div>

                            <div class="checkbox-symptom">
                                <input type="checkbox" name="symptom" id="symptom_18">
                                <label for="symptom_18">
                                    ๑๘.อัมพาต (หลอดเลือดสมองตีบ แตก)
                                </label>
                            </div>

                            <div class="checkbox-symptom">
                                <input type="checkbox" name="symptom" id="symptom_19">
                                <label for="symptom_19">
                                    ๑๙.หมดสติ ไม่ตอบสนอง หมดสติชั่ววูบ
                                </label>
                            </div>

                            <div class="checkbox-symptom">
                                <input type="checkbox" name="symptom" id="symptom_20">
                                <label for="symptom_20">
                                    ๒๐.เด็ก ทารก (กุมารเวชกรรม)
                                </label>
                            </div>

                            <div class="checkbox-symptom">
                                <input type="checkbox" name="symptom" id="symptom_21">
                                <label for="symptom_21">
                                    ๒๑.ถูกทำร้าย บาดเจ็บ
                                </label>
                            </div>

                            <div class="checkbox-symptom">
                                <input type="checkbox" name="symptom" id="symptom_22">
                                <label for="symptom_22">
                                    ๒๒.ไฟไหม้ ลวก ความร้อน กระแสไฟฟ้า สารเคมี
                                </label>
                            </div>

                            <div class="checkbox-symptom">
                                <input type="checkbox" name="symptom" id="symptom_23">
                                <label for="symptom_23">
                                    ๒๓.จมน้ำ หน้าคว่ำจมน้ำ บาดเจ็บเหตุดำน้ำ บาดเจ็บทางน้ำ
                                </label>
                            </div>

                            <div class="checkbox-symptom">
                                <input type="checkbox" name="symptom" id="symptom_24">
                                <label for="symptom_24">
                                    ๒๔.พลัดตกหลุม อุบัติเหตุ
                                </label>
                            </div>
                            <div class="checkbox-symptom">
                                <input type="checkbox" name="symptom" id="symptom_25">
                                <label for="symptom_25">
                                    ๒๕.อุบัติเหตุยานยนต์
                                </label>
                            </div>
                        </div>
                    </div>
                    <div class="col-12">
                        <label for="inputAddress2" class="form-label">อาการอื่นๆ</label>
                        <textarea class="form-control" id="inputAddress2" rows="3"></textarea>
                    </div>

                
                </div>

                  <div class="header  mt-5">ข้อมูลผู้ป่วย</div>
                <div class="row g-3">
                      <div class="col-md-6">
                        <label for="inputFirstName" class="form-label">ชื่อ-นามสกุล</label>
                        <input type="text" class="form-control" id="inputFirstName">
                    </div>
                    <div class="col-md-3">
                        <label for="inputLastName" class="form-label">วัน/เดือน/ปี เกิด</label>
                        <input type="text" class="form-control" id="inputLastName">
                    </div>
                    <div class="col-md-4">
                        <label for="inputLastName" class="form-label">เพศผู้ป่วย</label>
                        <input type="text" class="form-control" id="inputLastName">
                    </div>
                    <div class="col-md-4">
                        <label for="inputLastName" class="form-label">กรุ๊ปเลือดผู้ป่วย</label>
                        <input type="text" class="form-control" id="inputLastName">
                    </div>
                    <div class="col-md-4">
                        <label for="inputLastName" class="form-label">เบอร์โทรศัพท์ผู้ป่วย</label>
                        <input type="text" class="form-control" id="inputLastName">
                    </div>
                    <div class="col-md-4">
                        <label for="inputLastName" class="form-label">โรคประจำตัวผู้ป่วย</label>
                        <input type="text" class="form-control" id="inputLastName">
                    </div>
                    <div class="col-md-4">
                        <label for="inputLastName" class="form-label">ยาที่แพ้</label>
                        <input type="text" class="form-control" id="inputLastName">
                    </div> 
                    <div class="col-md-4">
                        <label for="inputLastName" class="form-label">ยาที่ใช้ประจำ</label>
                        <input type="text" class="form-control" id="inputLastName">
                    </div>
                    <div class="col-12">
                        <label for="inputAddress2" class="form-label">ที่อยู่ผู้ป่วย</label>
                        <textarea class="form-control" id="inputAddress2" rows="3"></textarea>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>



@endsection
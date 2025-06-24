@extends('layouts.theme_aims')

@section('content')
<style>
    .modal-tw .backdrop-modal {
        position: fixed;
        z-index: 999 !important;
        top: 0;
        left: 0;
        width: 100dvw !important;
        height: 100dvh !important;
        background-color: #000;
    }

    .modal-tw.hidden .backdrop-modal {
        opacity: 0;
    }

    .modal-tw.flex .backdrop-modal {
        opacity: .3;
    }

    .form-label {
        margin-bottom: 0.5rem;
    }

    .form-control {
        font-size: .875rem;
        font-weight: 400;
        line-height: 1.5;

        display: block;

        width: 100%;
        height: calc(1.5em + 1.25rem + 2px);
        padding: .625rem .75rem;

        transition: all .15s cubic-bezier(.68, -.55, .265, 1.55);

        color: #8898aa;
        background-color: #fff;
        background-clip: padding-box;
        box-shadow: 0 3px 2px rgba(233, 236, 239, .05);

        border: #DDE1EB 1px solid;
        border-radius: 10px;
    }

    @media (prefers-reduced-motion: reduce) {
        .form-control {
            transition: none;
        }
    }

    .form-control::-ms-expand {
        border: 0;
        background-color: transparent;
    }

    .form-control:-moz-focusring {
        color: transparent;
        text-shadow: 0 0 0 #8898aa;
    }

    .form-control:focus {
        color: #8898aa;
        border-color: #5e72e4;
        outline: 0;
        background-color: #fff;
        box-shadow: 0 3px 9px rgba(50, 50, 9, 0), 3px 4px 8px rgba(94, 114, 228, .1);
    }

    .form-control::-ms-input-placeholder {
        opacity: 1;
        color: #adb5bd;
    }

    .form-control::placeholder {
        opacity: 1;
        color: #adb5bd;
    }

    .form-control:disabled,
    .form-control[readonly] {
        opacity: 1;
        background-color: #e9ecef;
    }

    select.form-control:focus::-ms-value {
        color: #8898aa;
        background-color: #fff;
    }

    .form-control-file,
    .form-control-range {
        display: block;

        width: 100%;
    }
    .gm-fullscreen-control{
        display: none !important;
    }
    #trackButton{
    position: absolute;
  top:10px;
  right: 10px;
        z-index: 999;
        background-color: #fff;
        color: #000;
        padding: 8px;
        box-shadow: rgba(0, 0, 0, 0.3) 0px 1px 4px -1px;
    }

    .gm-bundled-control {
        display: none !important;
    }
</style>
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
<button id="trackButton" class="btn d-none" onclick="toggleTracking();">
        ติดตามตำแหน่ง
</button>

<div id="Modal_Case_details" tabindex="-1" aria-hidden="true" class="modal-tw hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 justify-center items-center w-full md:inset-0 h-modal md:h-full  z-[9999]">
    <div class="backdrop-modal"></div>
    <div class="relative p-4 w-full max-w-2xl h-full md:h-auto z-[9999]">
        <div class="relative p-4 bg-white rounded-lg shadow  sm:p-5">
            <div class="flex justify-between items-center pb-4 mb-4 rounded-t border-b sm:mb-5 dark:border-gray-600">
                <button id="btnDetails" class="btn-call-more mx-2" style="--index: 1">รายละเอียดเคส</button>
                <button id="btnPhotos" class="btn-call-success-outline mx-2" style="--index: 1">รูปภาพ</button>
            </div>
            <div id="content_case_details_1" class="mb-4 w-full" >
                <div style="max-height: calc(100dvh - 250px);overflow: auto;">
                    <h5><b>สถานที่เกิดเหตุ</b></h5>
                    <span class="text-[14px] text-[#3D3D3D]">
                        {{ $emergency->emergency_location }}
                    </span>
                    <h5 class="mt-2"><b>ประเภทเหตุ</b></h5>
                    <span class="text-[14px] text-[#3D3D3D]">
                        {{ $emergency->emergency_type }}
                    </span>
                    <h5 class="mt-2"><b>รายละเอียด</b></h5>
                    <span class="text-[14px] text-[#3D3D3D]">
                        {{ $emergency->emergency_detail }}
                    </span>
                    <h5 class="mt-2"><b>อาการนำสำคัญ</b></h5>
                    <span class="text-[14px] text-[#3D3D3D]">
                        {{ $emergency->symptom }}
                    </span>
                    <h5 class="mt-2"><b>รายละเอียดอาการ</b></h5>
                    <span class="text-[14px] text-[#3D3D3D]">
                        {{ $emergency->symptom }}
                    </span>
                </div>
            </div>
            <div id="content_case_details_2" class="mb-4 w-full hidden">
                <div style="max-height: calc(100dvh - 250px);overflow: auto;">
                    @if( !empty($emergency->emergency_photo) )
                        <img src="{{ url('storage')}}/{{ $emergency->emergency_photo }}" class="w-[100%]">
                    @elseif( !empty($emergency->emergency_photo_url) )
                        <img src="{{ $emergency->emergency_photo_url }}" class="w-[100%]">
                    @else
                        <span class="text-[14px] text-[#3D3D3D]">
                            ไม่มีรูปภาพ
                        </span>
                    @endif
                </div>
            </div>
            <div class="flex justify-center items-center p-6 space-x-2 border-t border-gray-200 rounded-b dark:border-gray-600">
                <button data-modal-toggle="Modal_Case_details" type="button" class="w-[50%] text-gray-500 bg-white hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-gray-200 rounded-lg border border-gray-200 text-sm font-medium px-5 py-2.5 hover:text-gray-900 focus:z-10 dark:bg-gray-700 dark:text-gray-300 dark:border-gray-500 dark:hover:text-white dark:hover:bg-gray-600 dark:focus:ring-gray-600">ปิด</button>
            </div>
        </div>
    </div>
</div>

<script>
    document.addEventListener("DOMContentLoaded", function () {
        const btnDetails = document.querySelector("#btnDetails");
        const btnPhotos = document.querySelector("#btnPhotos");

        const contentDetails = document.getElementById("content_case_details_1");
        const contentPhotos = document.getElementById("content_case_details_2");

        btnDetails.addEventListener("click", function () {
            // ปรับคลาสปุ่ม
            btnDetails.classList.add("btn-call-more");
            btnDetails.classList.remove("btn-call-more-outline");

            btnPhotos.classList.add("btn-call-success-outline");
            btnPhotos.classList.remove("btn-call-success");

            // แสดง/ซ่อนเนื้อหา
            contentDetails.classList.remove("hidden");
            contentPhotos.classList.add("hidden");
        });

        btnPhotos.addEventListener("click", function () {
            // ปรับคลาสปุ่ม
            btnPhotos.classList.add("btn-call-success");
            btnPhotos.classList.remove("btn-call-success-outline");

            btnDetails.classList.add("btn-call-more-outline");
            btnDetails.classList.remove("btn-call-more");

            // แสดง/ซ่อนเนื้อหา
            contentDetails.classList.add("hidden");
            contentPhotos.classList.remove("hidden");
        });
    });
</script>

<div id="Modal_photo_officer" tabindex="-1" aria-hidden="true" class="modal-tw hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 justify-center items-center w-full md:inset-0 h-modal md:h-full  z-[9999]">
    <div class="backdrop-modal"></div>
    <div class="relative p-4 w-full max-w-2xl h-full md:h-auto z-[9999]">
        <div class="relative p-4 bg-white rounded-lg shadow  sm:p-5">
            <div class="flex justify-between items-center pb-4 mb-4 rounded-t border-b sm:mb-5 dark:border-gray-600">
                <button id="btnScene" class="btn-call-more mx-2" style="--index: 1">จุดเกิดเหตุ</button>
                <button id="btnSuccess" class="btn-call-success-outline mx-2" style="--index: 1">เสร็จสิ้น</button>
            </div>
            <div id="content_photo_officer_1" class="mb-4 w-full">
                <div style="max-height: calc(100dvh - 250px);overflow: auto;">
                    <!-- ปุ่มแทน input file -->
                    <div class="mb-4">
                        <button id="btn_select_photo_1" type="button"
                            class="px-2 py-1 text-sm bg-blue-600 text-white rounded hover:bg-blue-700">
                            <i class="fa-solid fa-camera"></i> เพิ่มภาพถ่าย
                        </button>

                        <!-- input file ซ่อน -->
                        <input id="photo_by_officer" type="file" accept="image/*" capture="environment" class="hidden">

                        <!-- พรีวิวรูป -->
                        <div id="photo_preview_1_wrapper" class="mt-4 {{ $emergency->op_photo_by_officer ? '' : 'hidden' }}">
                            <img
                                id="photo_preview_1"
                                class="max-w-xs rounded border border-gray-300"
                                src="{{ $emergency->op_photo_by_officer ? url('storage/' . $emergency->op_photo_by_officer) : '' }}"
                            />
                        </div>
                    </div>
                    <!-- ช่องกรอกหมายเหตุ -->
                    <div class="mb-4">
                        <label for="remark_photo_by_officer" class="block mb-2 text-sm">หมายเหตุ</label>
                        <textarea
                            id="remark_photo_by_officer"
                            class="form-control w-full border border-gray-300 rounded p-2"
                            rows="3"
                            placeholder="เหตุเกี่ยวกับภาพถ่าย..."
                            style="height: 97px;"
                        >{{ $emergency->op_remark_photo_by_officer }}</textarea>
                    </div>
                </div>
            </div>
            <div id="content_photo_officer_2" class="mb-4 w-full hidden">
                <div style="max-height: calc(100dvh - 250px);overflow: auto;">
                    <!-- ปุ่มแทน input file -->
                    <div class="mb-4">
                        <button id="btn_select_photo_2" type="button"
                            class="px-2 py-1 text-sm bg-blue-600 text-white rounded hover:bg-blue-700">
                            <i class="fa-solid fa-camera"></i> เพิ่มภาพถ่าย
                        </button>

                        <!-- input file ซ่อน -->
                        <input id="photo_succeed" type="file" accept="image/*" capture="environment" class="hidden">

                        <!-- พรีวิวรูป -->
                        <div id="photo_preview_2_wrapper" class="mt-4 {{ $emergency->op_photo_succeed ? '' : 'hidden' }}">
                            <img
                                id="photo_preview_2"
                                class="max-w-xs rounded border border-gray-300"
                                src="{{ $emergency->op_photo_succeed ? url('storage/' . $emergency->op_photo_succeed) : '' }}"
                            />
                        </div>
                    </div>
                    <!-- ช่องกรอกหมายเหตุ -->
                    <div class="mb-4">
                        <label for="remark_by_helper" class="block mb-2 text-sm">หมายเหตุ</label>
                        <textarea
                            id="remark_by_helper"
                            class="form-control w-full border border-gray-300 rounded p-2"
                            rows="3"
                            placeholder="เหตุเกี่ยวกับภาพถ่าย..."
                            style="height: 97px;"
                        >{{ $emergency->op_remark_by_helper }}</textarea>
                    </div>
                </div>
            </div>
            <div class="flex justify-center items-center p-6 space-x-2 border-t border-gray-200 rounded-b dark:border-gray-600">
                <button id="btn_send_data_photo_officer" data-modal-toggle="Modal_photo_officer" type="button" class="w-full text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">ยืนยัน</button>
                <button data-modal-toggle="Modal_photo_officer" type="button" class="w-[50%] text-gray-500 bg-white hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-gray-200 rounded-lg border border-gray-200 text-sm font-medium px-5 py-2.5 hover:text-gray-900 focus:z-10 dark:bg-gray-700 dark:text-gray-300 dark:border-gray-500 dark:hover:text-white dark:hover:bg-gray-600 dark:focus:ring-gray-600">ปิด</button>
            </div>
        </div>
    </div>
</div>

<script>

const originalphoto_officer = {
    photo_by_officer: "{{ $emergency->op_photo_by_officer ?? '' }}",
    remark_photo_by_officer: `{!! trim($emergency->op_remark_photo_by_officer ?? '') !!}`,
    photo_succeed: "{{ $emergency->op_photo_succeed ?? '' }}",
    remark_by_helper: `{!! trim($emergency->op_remark_by_helper ?? '') !!}`,
};

document.addEventListener("DOMContentLoaded", function () {
    const btn = document.getElementById("btn_send_data_photo_officer");

    btn.addEventListener("click", async function () {
        const formData = new FormData();

        // ตรวจสอบภาพถ่าย
        const photoByOfficerFile = document.getElementById("photo_by_officer").files[0];
        const photoSucceedFile = document.getElementById("photo_succeed").files[0];

        if (photoByOfficerFile) {
            formData.append("photo_by_officer", photoByOfficerFile);
        }

        if (photoSucceedFile) {
            formData.append("photo_succeed", photoSucceedFile);
        }

        // ตรวจสอบหมายเหตุ
        const remarkPhoto = document.getElementById("remark_photo_by_officer").value.trim();
        const remarkSuccess = document.getElementById("remark_by_helper").value.trim();

        if (remarkPhoto !== originalphoto_officer.remark_photo_by_officer) {
            formData.append("remark_photo_by_officer", remarkPhoto);
        }

        if (remarkSuccess !== originalphoto_officer.remark_by_helper) {
            formData.append("remark_by_helper", remarkSuccess);
        }

        // ถ้าไม่มีข้อมูลเปลี่ยนแปลง ไม่ต้องส่ง
        if ([...formData.keys()].length === 0) {
            alert("ไม่มีข้อมูลเปลี่ยนแปลง");
            return;
        }

        try {
            const response = await fetch("{{ route('photo_officer.update', $emergency->id) }}", {
                method: "POST",
                headers: {
                    "X-CSRF-TOKEN": "{{ csrf_token() }}"
                },
                body: formData
            });

            if (response.ok) {
                alert("บันทึกสำเร็จ");
                // location.reload(); // หรือปิด modal ก็ได้
            } else {
                alert("เกิดข้อผิดพลาดในการบันทึก");
            }
        } catch (error) {
            console.error("Error:", error);
            alert("การเชื่อมต่อล้มเหลว");
        }
    });
});
</script>
<script>
    document.addEventListener("DOMContentLoaded", function () {

        const fileInput = document.getElementById("photo_by_officer");
        const previewImg = document.getElementById("photo_preview_1");
        const previewWrapper = document.getElementById("photo_preview_1_wrapper");
        const btnSelectPhoto = document.getElementById("btn_select_photo_1");

        btnSelectPhoto.addEventListener("click", () => {
            fileInput.click(); // trigger input file
        });

        fileInput.addEventListener("change", (event) => {
            const file = event.target.files[0];
            if (file && file.type.startsWith("image/")) {
                const reader = new FileReader();
                reader.onload = function (e) {
                    previewImg.src = e.target.result;
                    previewWrapper.classList.remove("hidden");
                    document.querySelector('#btn_select_photo_1').innerHTML = `<i class="fa-solid fa-camera"></i> ถ่ายใหม่`;
                };
                reader.readAsDataURL(file);
            }
        });

        const photo_succeed = document.getElementById("photo_succeed");
        const previewImg_2 = document.getElementById("photo_preview_2");
        const previewWrapper_2 = document.getElementById("photo_preview_2_wrapper");
        const btnSelectPhoto_2 = document.getElementById("btn_select_photo_2");

        btnSelectPhoto_2.addEventListener("click", () => {
            photo_succeed.click(); // trigger input file
        });

        photo_succeed.addEventListener("change", (event_2) => {
            const file_2 = event_2.target.files[0];
            if (file_2 && file_2.type.startsWith("image/")) {
                const reader_2 = new FileReader();
                reader_2.onload = function (e) {
                    previewImg_2.src = e.target.result;
                    previewWrapper_2.classList.remove("hidden");
                    document.querySelector('#btn_select_photo_1').innerHTML = `<i class="fa-solid fa-camera"></i> ถ่ายใหม่`;
                };
                reader_2.readAsDataURL(file_2);
            }
        });

        // ------------- สลับปุ่ม -------------
        const btnScene = document.getElementById("btnScene");
        const btnSuccess = document.getElementById("btnSuccess");

        const content1 = document.getElementById("content_photo_officer_1");
        const content2 = document.getElementById("content_photo_officer_2");

        btnScene.addEventListener("click", function () {
            // ปรับคลาสปุ่ม
            btnScene.classList.add("btn-call-more");
            btnScene.classList.remove("btn-call-more-outline");

            btnSuccess.classList.add("btn-call-success-outline");
            btnSuccess.classList.remove("btn-call-success");

            // แสดง/ซ่อนเนื้อหา
            content1.classList.remove("hidden");
            content2.classList.add("hidden");
        });

        btnSuccess.addEventListener("click", function () {
            // ปรับคลาสปุ่ม
            btnSuccess.classList.add("btn-call-success");
            btnSuccess.classList.remove("btn-call-success-outline");

            btnScene.classList.add("btn-call-more-outline");
            btnScene.classList.remove("btn-call-more");

            // แสดง/ซ่อนเนื้อหา
            content1.classList.add("hidden");
            content2.classList.remove("hidden");
        });
    });
</script>




<div id="Modal_patient" tabindex="-1" aria-hidden="true" class="modal-tw hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 justify-center items-center w-full md:inset-0 h-modal md:h-full  z-[9999]">
    <div class="backdrop-modal"></div>
    <div class="relative p-4 w-full max-w-2xl h-full md:h-auto z-[9999]">
        <div class="relative p-4 bg-white rounded-lg shadow  sm:p-5">
            <div class="flex justify-between items-center pb-4 mb-4 rounded-t border-b sm:mb-5 dark:border-gray-600">
                <h3 class="text-lg font-semibold text-gray-900 dark:text-black">
                    ข้อมูลผู้ป่วย
                </h3>
                <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-toggle="Modal_patient">
                    <svg aria-hidden="true" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path>
                    </svg>
                    <span class="sr-only">Close modal</span>
                </button>
            </div>
            <div class="mb-4 w-full" >
                <div style="max-height: calc(100dvh - 250px);overflow: auto;">

                <div class="flex w-full flex-wrap -mx-2">

                    <div class="px-2 w-full lg:w-3/5 mb-4 lg:mb-0">
                        <label for="patient_name" class="form-label">ชื่อ-นามสกุล</label>
                        <input type="text" class="form-control" id="patient_name" value="{{ isset($emergency->patient_name) ? $emergency->patient_name : ''}}">
                    </div>

                    <div class="px-2 w-1/2 lg:w-1/5 mb-4 md:mb-0">
                        <label for="patient_birth" class="form-label">วันเกิด</label>
                        <input type="date" class="form-control" id="patient_birth" value="{{ isset($emergency->patient_birth) ? $emergency->patient_birth : ''}}">
                    </div>

                    <div class="px-2 w-1/2 lg:w-1/5">
                        <label for="patient_gender" class="form-label">เพศ</label>
                        <select name="patient_gender" id="patient_gender" class="form-control">
                            <option value="">-- เลือกเพศ --</option>
                            <option value="ชาย" {{ isset($emergency->patient_gender) && $emergency->patient_gender == 'ชาย' ? 'selected' : '' }}>ชาย</option>
                            <option value="หญิง" {{ isset($emergency->patient_gender) && $emergency->patient_gender == 'หญิง' ? 'selected' : '' }}>หญิง</option>
                        </select>

                    </div>

                </div>

                <div class="flex w-full flex-wrap -mx-2 mt-2">

                    <div class="px-2 w-1/1 lg:w-1/3 mb-4 md:mb-0">
                        <label for="patient_blood_type" class="form-label">กรุ๊ปเลือด</label>
                        <select name="patient_blood_type" id="patient_blood_type" class="form-control">
                            <option value="">-- เลือกกรุ๊ปเลือด --</option>
                            @foreach(['A+', 'A-', 'B+', 'B-', 'AB+', 'AB-', 'O+', 'O-'] as $blood)
                                <option value="{{ $blood }}" {{ isset($emergency->patient_blood_type) && $emergency->patient_blood_type == $blood ? 'selected' : '' }}>
                                    {{ $blood }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="px-2 w-1/1 lg:w-1/3 mb-4 md:mb-0">
                        <label for="patient_identification" class="form-label">เลขประจำตัวประชาชน</label>
                        <input type="text" class="form-control" id="patient_identification" value="{{ isset($emergency->patient_identification) ? $emergency->patient_identification : ''}}">
                    </div>

                    <div class="px-2 w-1/1 lg:w-1/3">
                        <label for="patient_phone" class="form-label">เบอร์โทรศัพท์</label>
                        <input type="text" class="form-control" id="patient_phone" value="{{ isset($emergency->patient_phone) ? $emergency->patient_phone : ''}}">
                    </div>

                </div>
                <div class="flex w-full flex-wrap -mx-2 mt-3">
                    <div class="px-2 w-1/1 lg:w-1/3 mb-4 md:mb-0">
                        <label for="patient_congenital_disease" class="form-label">โรคประจำตัว</label>
                        <input type="text" class="form-control" id="patient_congenital_disease" value="{{ isset($emergency->patient_congenital_disease) ? $emergency->patient_congenital_disease : ''}}">
                    </div>

                    <div class="px-2 w-1/1 lg:w-1/3 mb-4 md:mb-0">
                        <label for="patient_allergic_drugs" class="form-label">ยาที่แพ้</label>
                        <input type="text" class="form-control" id="patient_allergic_drugs" value="{{ isset($emergency->patient_allergic_drugs) ? $emergency->patient_allergic_drugs : ''}}">
                    </div>

                    <div class="px-2 w-1/1 lg:w-1/3">
                        <label for="patient_regularly_medications" class="form-label">ยาที่ใช้ประจำ</label>
                        <input type="text" class="form-control" id="patient_regularly_medications" value="{{ isset($emergency->patient_regularly_medications) ? $emergency->patient_regularly_medications : ''}}">
                    </div>

                </div>

                <div class="flex w-full flex-wrap -mx-2 mt-3">
                    <div class="px-2 w-full mb-4 md:mb-0">
                        <label for="patient_address" class="form-label">ที่อยู่</label>
                        <textarea class="form-control" id="patient_address" placeholder="กรอกที่อยู่" rows="4" style="height: 97px;">{{ isset($emergency->patient_address) ? $emergency->patient_address : ''}}</textarea>
                    </div>
                </div>
                </div>
            </div>
            <div class="flex justify-center items-center p-6 space-x-2 border-t border-gray-200 rounded-b dark:border-gray-600">
                <button id="btn_send_data_patient" data-modal-toggle="Modal_patient" type="button" class="w-full text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">ตกลง</button>
                <button data-modal-toggle="Modal_patient" type="button" class="w-full text-gray-500 bg-white hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-gray-200 rounded-lg border border-gray-200 text-sm font-medium px-5 py-2.5 hover:text-gray-900 focus:z-10 dark:bg-gray-700 dark:text-gray-300 dark:border-gray-500 dark:hover:text-white dark:hover:bg-gray-600 dark:focus:ring-gray-600">ยกเลิก</button>
            </div>
        </div>
    </div>
</div>

<div id="Modal_rc" tabindex="-1" aria-hidden="true" class="modal-tw hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 justify-center items-center w-full md:inset-0 h-modal md:h-full z-[9999]">
    <div class="backdrop-modal"></div>
    <div class="relative p-4 w-full max-w-2xl h-full md:h-auto z-[9999]">
        <div class="relative p-4 bg-white rounded-lg shadow  sm:p-5">
            <div class="flex justify-between items-center pb-4 mb-4 rounded-t border-b sm:mb-5 dark:border-gray-600">
                <h3 class="text-lg font-semibold text-gray-900 dark:text-black">
                    เลือกความรุนแรง
                </h3>
                <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-toggle="Modal_rc">
                    <svg aria-hidden="true" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path>
                    </svg>
                    <span class="sr-only">Close modal</span>
                </button>
            </div>

            <style>
                .btn-rc {
                    text-align: center;
                    padding: 10px;
                    border-radius: 10px;
                    display: flex;
                    justify-content: center;
                    width: 100%;
                    border-style: solid;
                    border-width: 1px;
                    cursor: pointer;
                    transition: all .15s ease-in-out;
                }

                .radio-rc {
                    display: none;
                }


                .radio-rc:checked~.rc-other {
                    background-color: #000;
                    color: #fff;
                }

                .rc-other {
                    border-color: #000 !important;
                    color: #000;
                }

                .radio-rc:checked~.rc-normal {
                    background-color: #1447e6;
                    color: #fff;
                }

                .rc-normal {
                    border-color: #1447e6 !important;
                    color: #1447e6;

                }

                .radio-rc:checked~.rc-not-severe {
                    background-color: #12BA09;
                    color: #fff;
                }

                .rc-not-severe {
                    border-color: #12BA09 !important;
                    color: #12BA09;

                }

                .radio-rc:checked~.rc-urgent {
                    background-color: #FFC517;
                    color: #fff;
                }

                .rc-urgent {
                    border-color: #FFC517 !important;
                    color: #FFC517;

                }

                .radio-rc:checked~.rc-danger {
                    background-color: #DE2525;
                    color: #fff;
                }

                .rc-danger {
                    border-color: #DE2525 !important;
                    color: #DE2525;

                }
            </style>
            <div class="mb-2">
                <div class="flex w-full">
                    <div class="w-1/2 p-2">
                        <input type="radio" name="rc_officer" id="radio_other" class="radio-rc">
                        <label for="radio_other" class="btn-rc rc-other">อื่นๆ</label>
                    </div>
                    <div class="w-1/2 p-2">
                        <input type="radio" name="rc_officer" id="radio_normal" class="radio-rc">
                        <label class="btn-rc rc-normal" for="radio_normal">ทั่วไป</label>
                    </div>
                </div>
                <div class="flex w-full">
                    <div class="w-1/2 p-2">
                        <input type="radio" name="rc_officer" id="radio_not_severe" class="radio-rc">
                        <label class="btn-rc rc-not-severe" for="radio_not_severe"> ไม่รุนแรง</label>
                    </div>
                    <div class="w-1/2 p-2">
                        <input type="radio" name="rc_officer" id="radio_urgent" class="radio-rc">
                        <label class="btn-rc rc-urgent" for="radio_urgent">เร่งด่วน</label>
                    </div>
                </div>
                <div class="flex w-full">
                    <div class="p-2 w-full">
                        <input type="radio" name="rc_officer" id="radio_danger" class="radio-rc">
                        <label class="btn-rc rc-danger" for="radio_danger">ฉุกเฉิน</label>
                    </div>
                </div>
            </div>
            <div class="flex items-center justify-end pb-6 space-x-2 b rounded-b ">
                <button id="btn_cf_chang_rc" data-modal-toggle="Modal_rc" type="button" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">ตกลง</button>
            </div>
        </div>
    </div>
</div>
<style>
    body {
        width: 100%;
        height: 100dvh;
        background-color: #f0f0f0;
    }

    .menu {
        position: fixed;
        width: 100%;
        max-width: 800px;
        height: fit-content;
        bottom: 10px;
        left: 50%;
        transform: translate(-50%, 0);
        padding: 10px;
        z-index: 3;
    }

    .menu-container {
        background-color: #fff;
        z-index: 3;
        position: relative;
        padding: 10px;
        display: flex;
        justify-content: space-around;

    }

    #map {
        height: 100vh; /* หรือความสูงที่ต้องการ */
        position: relative;
        overflow: visible; /* ตรวจสอบว่าไม่ถูกตัด */
    }

    .menu-container {
        border-radius: 10px;

    }


    .btn-menu {
        border-radius: 10px;
        border: 2px solid transparent;
        background: linear-gradient(to right, #fff, #fff),
            linear-gradient(260deg, rgba(40, 86, 250, 1) 0%, rgba(6, 162, 253, 1) 100%);
        background-clip: padding-box, border-box;
        -webkit-background-clip: padding-box, border-box;
        transition: all .15s ease-in-out;
        color: #fff;
        width: 100%;
        margin: 0 5px;
        padding: 10px 0;
        cursor: pointer;
    }

    .btn-menu i {
        background: rgb(40, 86, 250);
        background: -moz-linear-gradient(260deg, rgba(40, 86, 250, 1) 0%, rgba(6, 162, 253, 1) 100%);
        background: -webkit-linear-gradient(260deg, rgba(40, 86, 250, 1) 0%, rgba(6, 162, 253, 1) 100%);
        background: linear-gradient(260deg, rgba(40, 86, 250, 1) 0%, rgba(6, 162, 253, 1) 100%);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        transition: all .15s ease-in-out;
    }

    /*.btn-menu:hover i,*/
    /*.btn-menu:focus i,*/
    .btn-menu.active i {
        background: #fff;
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
    }

    /*.btn-menu:hover,*/
    /*.btn-menu:focus,*/
    .btn-menu.active {
        background: #06A2FD;
        background: -webkit-linear-gradient(90deg, rgba(6, 162, 253, 1) 0%, rgba(40, 86, 250, 1) 100%);
        background: -moz-linear-gradient(90deg, rgba(6, 162, 253, 1) 0%, rgba(40, 86, 250, 1) 100%);
        background: linear-gradient(90deg, rgba(6, 162, 253, 1) 0%, rgba(40, 86, 250, 1) 100%);
        filter: progid:DXImageTransform.Microsoft.gradient(startColorstr="#06A2FD", endColorstr="#2856FA", GradientType=1);
        border: none !important;
    }


    .btn-menu {
        -webkit-animation: scale-up-hor-center 0.4s cubic-bezier(0.390, 0.575, 0.565, 1.000) both;
        animation: scale-up-hor-center 0.4s cubic-bezier(0.390, 0.575, 0.565, 1.000) both;
        animation-delay: calc(var(--index) * 0.1s);

    }


    @-webkit-keyframes scale-up-hor-center {
        0% {
            -webkit-transform: scaleX(0);
            transform: scaleX(0);
        }

        100% {
            -webkit-transform: scaleX(1);
            transform: scaleX(1);
        }
    }

    .container-content {
        position: fixed;
        width: 100%;
        max-width: 800px;
        height: fit-content;
        bottom: 90px;
        left: 50%;
        transform: translate(-50%, 0);
        padding: 10px;
        z-index: 3;

    }

    .content {
        background-color: #fff;
        z-index: 3;
        position: relative;
        display: flex;
        justify-content: space-around;
        border-radius: 10px;
    }

    .content .header {
        padding: 15px;
        box-shadow: 0px 2px 3px 0px rgba(0, 0, 0, 0.15);
        -webkit-box-shadow: 0px 2px 3px 0px rgba(0, 0, 0, 0.15);
        -moz-box-shadow: 0px 2px 3px 0px rgba(0, 0, 0, 0.15);
        display: flex;
        align-items: center;
    }

    .content .body {
        padding: 15px;
        max-height: calc(100dvh - 200px);
        overflow: auto;
    }

    .backdrop {
        position: absolute;
        bottom: 0;
        left: 0;
        width: 100%;
        height: 200px;
        background: linear-gradient(to bottom,
                rgba(0, 0, 0, 0) 0%,
                rgba(0, 0, 0, .8) 100%);
        pointer-events: none;
        /* เพื่อให้คลิกผ่านได้ */
        z-index: 2;
        /* กำหนดให้อยู่ด้านบนของเนื้อหา */
    }

    .btn-edit,
    .btn-call-more, .btn-call-success, .btn-call-success-outline, .btn-call-more-outline {
        width: 100%;
        border-radius: 5px;
        padding: 8px;
        font-size: 16px;
        -webkit-animation: slide-top 0.5s cubic-bezier(0.250, 0.460, 0.450, 0.940) both;
        animation: slide-top 0.5s cubic-bezier(0.250, 0.460, 0.450, 0.940) both;
        animation-delay: calc(var(--index) * 0.1s);
    }

    .btn-edit {
        align-items: center;
        background-color: #FDB022;
        color: #000;
        margin-bottom: 10px;
    }

    .btn-call-more {
        align-items: center;
        background-color: #2856FA;
        color: #fff;
    }

    .btn-call-success {
        align-items: center;
        background-color: #28a745;
        color: #fff;
    }

    .btn-call-success-outline {
        align-items: center;
        background-color: transparent;     /* พื้นหลังโปร่งใส */
        color: #28a745;                    /* สีตัวอักษรเขียว */
        border: 1px solid #28a745;         /* ขอบสีเขียว */
        padding: 0.375rem 0.75rem;         /* ระยะ padding เหมือนปุ่ม */
        border-radius: 0.25rem;            /* ขอบโค้ง */
        transition: all 0.15s ease-in-out; /* ให้มี animation */
    }

    .btn-call-more-outline {
        align-items: center;
        background-color: transparent;     /* พื้นหลังโปร่งใส */
        color: #2856FA;                    /* สีตัวอักษรเขียว */
        border: 1px solid #2856FA;         /* ขอบสีเขียว */
        padding: 0.375rem 0.75rem;         /* ระยะ padding เหมือนปุ่ม */
        border-radius: 0.25rem;            /* ขอบโค้ง */
        transition: all 0.15s ease-in-out; /* ให้มี animation */
    }

    @-webkit-keyframes slide-top {
        0% {
            -webkit-transform: translateY(100%);
            transform: translateY(100%);
            opacity: 0;
        }

        100% {
            -webkit-transform: translateY(0);
            transform: translateY(0);
            opacity: 1;

        }
    }

    .status {
        display: flex;
        align-items: center;
        width: 100%;
        padding: 10px;
    }

    .btn-prev {
        cursor: pointer;
        margin-right: 10px;
    }

    .header {
        font-weight: bolder;
    }

    .d-none{
        display: none;
    }
</style>

<div class="notranslate">
    <div class="map notranslate" id="map"></div>
    <div class="backdrop"></div>
    
    <div class="menu">
        <div class="menu-container">
            <button class="btn-menu" style="--index: 0">
                <p class="m-0">
                    <i class="fa-solid fa-file-pen"></i>
                </p>
            </button>
            <button class="btn-menu" style="--index: 1">
                <p class="m-0">
                    <i class="fa-solid fa-comments-question-check"></i>
                </p>
            </button>
            <button id="btn_start_page" class="btn-menu" style="--index: 2">
                <p class="m-0">
                    <i class="fa-solid fa-truck-medical"></i>
                </p>
            </button>
            <button class="btn-menu" style="--index: 3">
                <p class="m-0">
                    <i class="fa-solid fa-map-location-dot"></i>
                </p>
            </button>
           
            <!-- <div> <i class="fa-solid fa-phone"></i>
                <button class="btn-menu ">asd</button>
            </div>
            <div>
                <button class="btn-menu ">asd</button>
            </div>
            <div>
                <button class="btn-menu ">asd</button>
            </div>
            <div>
                <button class="btn-menu ">asd</button>
            </div> -->
        </div>
    </div>

    <style>
        .status {
            border-radius: 10px;
            margin-bottom: 10px;
            font-weight: bold;
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
    </style>
    <div class="container-content">
        <div class="section-1">
            <div class="content">
                <div class="body">
                    <button class="btn-edit cursor-pointer" style="--index: 0" data-modal-target="Modal_patient" data-modal-toggle="Modal_patient">แก้ไขข้อมูลผู้ป่วย</button>
                    <button class="btn-call-success" style="--index: 1" data-modal-target="Modal_photo_officer" data-modal-toggle="Modal_photo_officer">เพิ่มภาพถ่าย</button>
                    <button class="btn-call-more mt-[10px]" style="--index: 2" data-modal-target="Modal_Case_details" data-modal-toggle="Modal_Case_details">รายละเอียดเคส</button>
                    @if( $emergency->op_status == "เสร็จสิ้น" )
                        <button class="btn-call-more mt-[10px]" style="--index: 3" onclick='window.location.href = "{{ url('/sos_aims/sum_timeline') }}" + "/" + "{{ $emergency->id }}";'>Timeline</button>
                    @endif
                </div>
            </div>
        </div>
        <script>
            document.addEventListener('DOMContentLoaded', () => {
                const modalToggles = document.querySelectorAll('[data-modal-toggle]');
                const modalDismisses = document.querySelectorAll('[data-modal-hide], [data-modal-toggle]'); // Include toggle for closing

                modalToggles.forEach(toggle => {
                    toggle.addEventListener('click', () => {
                        const targetModalId = toggle.getAttribute('data-modal-target') || toggle.getAttribute('data-modal-toggle');
                        const targetModal = document.getElementById(targetModalId);
                        if (targetModal) {
                            targetModal.classList.toggle('hidden');
                            targetModal.classList.toggle('flex'); // Use flex to center content
                            targetModal.setAttribute('aria-hidden', targetModal.classList.contains('hidden'));
                        }
                    });
                });
            });
        </script>
        <div class="section-2">
            <div class="content">
                <div class="body">
                    <div class="label mb-2">ศูนย์ควบคุม</div>
                    <div id="show_text_idc">
                        <div class="status status-normal">
                            <i class="fa-solid fa-circle fa-2xs me-2"></i>
                            <span>ไม่มีข้อมูล</span>
                        </div>
                    </div>
                    <div class="mt-4">
                        <div class="label mb-2">เจ้าหน้าที่</div>
                        <button id="show_text_rc" class="status status-normal flex justify-between cursor-pointer status-rc" data-modal-target="Modal_rc" data-modal-toggle="Modal_rc">
                            <div>
                                <i class="fa-solid fa-circle fa-2xs me-2"></i>
                                <span id="text_rc">ไม่มีข้อมูล</span>
                            </div>
                            <div>
                                <i class="fa-solid fa-chevron-right"></i>
                            </div>
                        </button>
                    </div>
                </div>
            </div>
        </div>


        <script>

            var check_rc = "{{ $emergency->rc }}";
            document.addEventListener('DOMContentLoaded', function() {
                const radios = document.querySelectorAll('input[name="rc_officer"]');
                const textIdc = document.querySelector('.section-2 .status #text_rc'); // เปลี่ยนตามตำแหน่งจริง
                const buttonIdc = document.querySelector('.section-2 .status-rc'); // ปุ่มที่จะแสดงระดับใหม่

                const levelMap = {
                    'radio_other': {
                        text: 'อื่นๆ',
                        class: 'status-other'
                    },
                    'radio_normal': {
                        text: 'ทั่วไป',
                        class: 'status-normal'
                    },
                    'radio_not_severe': {
                        text: 'ไม่รุนแรง',
                        class: 'status-success'
                    },
                    'radio_urgent': {
                        text: 'เร่งด่วน',
                        class: 'status-warning'
                    },
                    'radio_danger': {
                        text: 'ฉุกเฉิน',
                        class: 'status-danger'
                    }
                };

                radios.forEach(radio => {
                    radio.addEventListener('change', function() {
                        if (this.checked) {
                            const level = levelMap[this.id];

                            // อัปเดตข้อความ
                            textIdc.textContent = level.text;

                            // ลบคลาสเดิมออกก่อน
                            buttonIdc.classList.remove('status-normal', 'status-success', 'status-warning', 'status-danger', 'status-other');

                            // เพิ่มคลาสใหม่ตามระดับ
                            buttonIdc.classList.add(level.class);

                            // console.log("text_rc >> " + level.text);
                            check_rc = level.text ;
                        }
                    });
                });

                document.getElementById('btn_cf_chang_rc').addEventListener('click', function () {
                    // สิ่งที่คุณต้องการให้เกิดขึ้นเมื่อคลิกปุ่ม
                    // console.log("check_rc >> " + check_rc);
                    
                    fetch("{{ url('/') }}/api/update_rc" + "/" + '{{ $emergency->id }}' + "/" + check_rc)
                        .then(response => response.text())
                        .then(result => {
                            // console.log(result);
                            // console.log("เริ่ม interval ใหม่");
                            start_interval_get_idc_rc();
                        });
                });

                document.getElementById('show_text_rc').addEventListener('click', function () {
                    // console.log("หยุด interval_get_idc_rc ชั่วคราว");
                    clearInterval(interval_get_idc_rc);
                });


            });
        </script>

        <style>
            .input-officer {
                padding: 5px 10px;
                border: #DDE1EB 1px solid;
                border-radius: 10px;
                width: 100%;
            }

            .btn-next,
            .btn-to-base {
                padding: 15px 20px;
                background: #06A2FD;
                background: -webkit-linear-gradient(90deg, rgba(6, 162, 253, 1) 0%, rgba(40, 86, 250, 1) 100%);
                background: -moz-linear-gradient(90deg, rgba(6, 162, 253, 1) 0%, rgba(40, 86, 250, 1) 100%);
                background: linear-gradient(90deg, rgba(6, 162, 253, 1) 0%, rgba(40, 86, 250, 1) 100%);
                filter: progid:DXImageTransform.Microsoft.gradient(startColorstr="#06A2FD", endColorstr="#2856FA", GradientType=1);
                border: none !important;
                border-radius: 10px;
                color: #fff;
                margin: 0 5px;
                cursor: pointer;

            }

            .btn-next:disabled,
            .btn-to-base:disabled {
                opacity: .8;
            }

            .rc-group,
            .treatment-group,
            .no-treatment-group {
                flex-wrap: wrap;
                display: flex;
            }

            .rc-group button,
            .treatment-group,
            .no-treatment-group {
                background: unset;
                margin: 10px 0;
                width: 100%;
                padding: 20px;
            }

            .btn-black {
                background-color: #000 !important;
                color: #fff !important;
            }

            .btn-primary {
                background-color: #1371FD !important;
                color: #fff !important;
            }

            .btn-green {
                background-color: #12BA09 !important;
                color: #fff !important;

            }

            .btn-yellow {
                background-color: #FFC517 !important;
                color: #fff !important;

            }

            .btn-red {
                background-color: #DE2525 !important;
                color: #fff !important;
            }
        </style>
        <div class="section-3">
            <div class="content">
                <div class="header">
                    <!-- <div class="back btn-prev">
                        <p><i class="fa-solid fa-chevron-left"></i></p>
                    </div> -->
                    <div>เลข กม. รถ <u>ออกจากฐาน</u></div>
                </div>

                <div class="body flex">
                    <input type="text" name="km_before" class="input-officer">
                    <button class="btn-next"><i class="fa-solid fa-chevron-right"></i></button>
                </div>
            </div>
            <div class="content">
                <div class="header flex items-center">
                    <div class="back btn-prev">
                        <p><i class="fa-solid fa-chevron-left"></i></p>
                    </div>
                    <div>เลข กม. รถ <u>ถึงที่เกิดเหตุ</u></div>
                </div>

                <div class="body flex">
                    <input type="text" name="km_to_the_scene" class="input-officer">
                    <button class="btn-next"><i class="fa-solid fa-chevron-right"></i></button>
                </div>
            </div>
            <div class="content">
                <div class="header flex items-center">
                    <div class="back btn-prev">
                        <p><i class="fa-solid fa-chevron-left"></i></p>
                    </div>
                    <div>ระดับความรุนแรง</div>
                </div>

                <div class="body flex rc-group">
                    <div class="px-2 w-[50%]">
                        <button class="btn-next btn-black">อื่นๆ</button>
                    </div>
                    <div class="px-2 w-[50%]">
                        <button class="btn-next btn-primary">ทั่วไป</button>
                    </div>
                    <div class="px-2 w-[50%]">
                        <button class="btn-next btn-green">ไม่รุนแรง</button>
                    </div>
                    <div class="px-2 w-[50%]">
                        <button class="btn-next btn-yellow">เร่งด่วน</button>
                    </div>
                    <div class="px-2 w-[100%]">
                        <button class="btn-next btn-red">ฉุกเฉิน</button>
                    </div>
                    <input type="hidden" id="rc" name="rc" value="">
                </div>
            </div>
            <div class="content">
                <div class="header flex items-center">
                    <div class="back btn-prev">
                        <p><i class="fa-solid fa-chevron-left"></i></p>
                    </div>
                    <div>ระดับความรุนแรง</div>
                </div>

                <style>
                    .btn-treatment,
                    .btn-no-treatment {
                        background: unset;
                        margin: 10px 0;
                        width: 100%;
                        height: 65px;
                        border-radius: 5px;
                        transition: all .15s ease-in-out;
                        display: flex;
                        justify-content: center;
                        font-weight: bolder;
                        text-align: center;
                        align-items: center;
                        cursor: pointer;

                    }

                    .btn-treatment {
                        border: 1px solid #DB2F2F !important;
                        color: #DB2F2F;
                        cursor: pointer;
                    }

                    .btn-no-treatment {
                        border: 1px solid #1371FD !important;
                        color: #1371FD;
                        cursor: pointer;
                    }

                    .btn-treatment:hover,
                    input:checked~label.btn-treatment {
                        background-color: #db2f2f;
                        color: #fff;
                    }

                    .btn-no-treatment:hover,
                    input:checked~label.btn-no-treatment {

                        background-color: #1371FD;
                        color: #fff;
                    }

                    .treatment-group,
                    .no-treatment-group {

                        flex-wrap: wrap;
                        display: flex;

                    }

                    .hidden {
                        display: none !important;
                    }

                    .p-0 {
                        padding: 0 !important;
                    }
                </style>
                <div class="body">

                    <div class="flex mb-0 w-[100%]">
                        <div class="px-2 w-[100%]">

                            <input type="radio" name="treatment" id="has_treatment" value="มีการรักษา" class="hidden">
                            <label label-treatment="มีการรักษา" for="has_treatment" class="btn btn-treatment test">มีการรักษา</label>



                            <!-- <input type="radio" name="treatment" id="has_treatment" class="hidden">
                            <label for="has_treatment" class="btn btn-treatment">มีการรักษา</label> -->
                        </div>
                        <div class="px-2 w-[100%]">

                            <input type="radio" name="treatment" id="no_treatment" value="ไม่มีการรักษา" class="hidden">
                            <label label-treatment="ไม่มีการรักษา" for="no_treatment" class="btn btn-no-treatment test">ไม่มีการรักษา</label>
                        </div>
                    </div>

                    <div class=" flex treatment-group hidden p-0">
                        <div class="px-2 w-[100%]">
                            <input type="radio" name="sub_treatment" id="treatment_1" class="hidden" value="ส่งโรงพยาบาล">
                            <label for="treatment_1" id="" class="btn-next btn-treatment">ส่งโรงพยาบาล</label>
                        </div>
                        <div class="px-2 w-[50%]">
                            <input type="radio" name="sub_treatment" id="treatment_2" class="hidden" value="ส่งต่อหน่วยอื่น">
                            <label for="treatment_2" id="" class="btn-next btn-treatment">ส่งต่อหน่วยอื่น</label>
                        </div>
                        <div class="px-2 w-[50%]">
                            <input type="radio" name="sub_treatment" id="treatment_3" class="hidden" value="ไม่นำส่ง">
                            <label for="treatment_3" id="" class="btn-next btn-treatment">ไม่นำส่ง</label>
                        </div>
                        <div class="px-2 w-[50%]">
                            <input type="radio" name="sub_treatment" id="treatment_4" class="hidden" value="เสียชีวิตขณะนำส่ง">
                            <label for="treatment_4" id="" class="btn-next btn-treatment">เสียชีวิตขณะนำส่ง</label>
                        </div>
                        <div class="px-2 w-[50%]">
                            <input type="radio" name="sub_treatment" id="treatment_5" class="hidden" value="เสียชีวิต ณ จุดเกิดเหตุ">
                            <label for="treatment_5" id="" class="btn-next btn-treatment">เสียชีวิต ณ จุดเกิดเหตุ</label>
                        </div>
                    </div>

                    <div class=" flex no-treatment-group hidden p-0">

                        <div class="px-2 w-[50%]">
                            <input type="radio" name="sub_treatment" id="no_treatment_1" class="hidden" value="ผู้ป่วยปฎิเสธการรักษา">
                            <label for="no_treatment_1" id="" class="btn-next btn-no-treatment">ผู้ป่วยปฎิเสธการรักษา</label>
                        </div>
                        <div class="px-2 w-[50%]">
                            <input type="radio" name="sub_treatment" id="no_treatment_2" class="hidden" value="เสียชีวิต ก่อนชุดปฎิบัติการไปถึง">
                            <label for="no_treatment_2" id="" class="btn-next btn-no-treatment">เสียชีวิต ก่อนชุดปฎิบัติการไปถึง</label>
                        </div>
                        <div class="px-2 w-[50%]">
                            <input type="radio" name="sub_treatment" id="no_treatment_3" class="hidden" value="ยกเลิก">
                            <label for="no_treatment_3" id="" class="btn-next btn-no-treatment">ยกเลิก</label>
                        </div>
                        <div class="px-2 w-[50%]">
                            <input type="radio" name="sub_treatment" id="no_treatment_4" class="hidden" value="ไม่พบเหตุ">
                            <label for="no_treatment_4" id="" class="btn-next btn-no-treatment">ไม่พบเหตุ</label>
                        </div>
                    </div>
                </div>
            </div>
            <div class="content">
                <div class="header flex items-center">
                    <div class="back btn-prev">
                        <p><i class="fa-solid fa-chevron-left"></i></p>
                    </div>
                    <div>เลข กม. รถ <u>ถึงรพ.</u></div>
                </div>

                <div class="body flex">
                    <input type="text" class="input-officer" name="km_hospital">
                    <button class="btn-next"><i class="fa-solid fa-chevron-right"></i></button>
                </div>
            </div>

            <div class="content">
                <div class="header flex items-center">
                    <div class="back btn-prev">
                        <p><i class="fa-solid fa-chevron-left"></i></p>
                    </div>
                    <div>เลข กม. รถ <u>ถึงฐาน</u></div>
                </div>

                <div class="body flex">
                    <input type="text" class="input-officer" name="km_operating_base">
                    <button class="btn-to-base btn-next"><i class="fa-solid fa-chevron-right"></i></button>
                </div>
            </div>
        </div>
        <style>
            .icon-map {
                background: rgb(40, 86, 250);
                background: -moz-linear-gradient(260deg, rgba(40, 86, 250, 1) 0%, rgba(6, 162, 253, 1) 100%);
                background: -webkit-linear-gradient(260deg, rgba(40, 86, 250, 1) 0%, rgba(6, 162, 253, 1) 100%);
                background: linear-gradient(260deg, rgba(40, 86, 250, 1) 0%, rgba(6, 162, 253, 1) 100%);
                -webkit-background-clip: text;
                -webkit-text-fill-color: transparent;
                transition: all .15s ease-in-out;
                font-size: 18px;
            }
        </style>
        <div class="section-4">
            <div class="content">
                <div class="body">
                    <h4 class="font-bold mb-4 mt-2">จุดเกิดเหตุ</h4>
                    <div class="flex items-center">
                        <div class="me-4">
                            <div style="width: 50px; height: 50px; border-radius: 50px;display: flex;justify-content: center;align-items: center; background-color: #f0f0f0;">
                                <i class="fa-solid fa-diamond-turn-right icon-map"></i>
                            </div>
                        </div>
                        <div>
                            <p class="text-[13px] text-[#7c7c7c] leading-[18px]">ระยะทาง (จากฐานถึงที่เกิดเหตุ)</p>
                            <p class="text-[18px] text-[#2856fa] leading-[18px]" id="travel-distance">00 กม.</p>
                        </div>
                    </div>
                    <hr class="text-[#cdcdcd] my-3">
                    <div class="flex items-center mb-1">
                        <div class="me-4">
                            <div style="width: 50px; height: 50px; border-radius: 50px;display: flex;justify-content: center;align-items: center; background-color: #f0f0f0;">
                                <i class="fa-solid fa-location-crosshairs icon-map"></i>
                            </div>
                        </div>
                        <div>
                            <p class="text-[13px] text-[#7c7c7c] leading-[18px]">ระยะเวลา (เริ่มจาก <span id="date_now"></span>)</p>
                            <p class="text-[18px] text-[#2856fa] leading-[18px]" id="travel-duration">0 นาที</p>
                        </div>
                    </div>
                </div>
                <!-- <div class="body flex justify-around">
                    <div class="text-center">
                        <p class="text-[13px]">ระยะทาง</p>
                        <p class="text-[18px]">84 กม.</p>
                    </div>
                    <div>
                        <p class="text-[13px]">เดินทาง</p>
                        <p class="text-[18px]">1 ชม. 20 นาที</p>
                    </div>
                    <div>asd</div>
                </div> -->
            </div>
        </div>
    </div>
</div>

<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBgrxXDgk1tgXngalZF3eWtcTWI-LPdeus&language=th"></script>

<script>

var current_status = "{{ $emergency->op_status }}";
var check_km_before = "{{ $emergency->op_km_before }}";

document.addEventListener("DOMContentLoaded", function () {

    open_map();
    start_interval_get_idc_rc();
    initMenuAndContentNavigation();

});

function start_interval_get_idc_rc() {
    interval_get_idc_rc = setInterval(get_idc_rc_of_case, 5000);
    get_idc_rc_of_case(); // เรียกทันทีรอบแรก
}

var interval_get_idc_rc;
let check_contentIndex;
var map;
var officerMarker;
var emergencyMarker;
var directionsRenderer;
var watchId;
var directionsService;
var isTracking = false;
var defaultZoom = 15;
var isProgrammaticChange = false; // ตัวแปรควบคุมการเปลี่ยนแปลงจากโค้ด

var aims_icon = "{{ url('/img/icon/operating_unit/aims/aims_marker.png') }}";
var officer_icon = "{{ url('/img/icon/operating_unit/aims/officer.png') }}";
var emergency_Lat = parseFloat("{{ $emergency->emergency_lat }}");
var emergency_Lng = parseFloat("{{ $emergency->emergency_lng }}");
var officers_id = parseFloat("{{ $emergency->op_aims_operating_officers_id }}");

const emergency_LatLng = { lat: emergency_Lat, lng: emergency_Lng };

function open_map() {
    map = new google.maps.Map(document.getElementById("map"), {
        center: emergency_LatLng,
        zoom: defaultZoom,
        mapId: "90f87356969d889c",
        gestureHandling: "greedy"
    });

    // Marker สำหรับจุดฉุกเฉิน
    emergencyMarker = new google.maps.Marker({
        position: emergency_LatLng,
        map: map,
        icon: { url: aims_icon, scaledSize: new google.maps.Size(45, 45) }
    });

    if(current_status == "ออกจากฐาน"){
        // Initialize Directions Service and Renderer
        directionsService = new google.maps.DirectionsService();
        directionsRenderer = new google.maps.DirectionsRenderer({
            map: map,
            suppressMarkers: true
        });

        // เพิ่ม event listener สำหรับหยุดการติดตามเมื่อมีการโต้ตอบกับแผนที่
        map.addListener('dragend', stopTrackingCenter);
        map.addListener('zoom_changed', stopTrackingCenter);
        map.addListener('tilt_changed', stopTrackingCenter);
        map.addListener('heading_changed', stopTrackingCenter);

        // เริ่มรับตำแหน่งผู้ใช้
        startTrackingUser();
    }

}

function startTrackingUser() {
    if (navigator.geolocation) {
        navigator.geolocation.getCurrentPosition(
            (position) => {
                const userLatLng = {
                    lat: position.coords.latitude,
                    lng: position.coords.longitude
                };

                // console.log("Start geolocation");
                sendOfficerLocation(userLatLng)

                if (!officerMarker) {
                    officerMarker = new google.maps.Marker({
                        position: userLatLng,
                        map: map,
                        icon: { url: officer_icon, scaledSize: new google.maps.Size(45, 45) }
                    });
                } else {
                    officerMarker.setPosition(userLatLng);
                }

                calculateAndDisplayRoute(userLatLng, emergency_LatLng);
                document.querySelector('#trackButton').classList.remove('d-none');

                watchId = navigator.geolocation.watchPosition(
                    (position) => {
                        const updatedLatLng = {
                            lat: position.coords.latitude,
                            lng: position.coords.longitude
                        };

                        // console.log("watchPosition");
                        sendOfficerLocation(updatedLatLng)

                        if (isTracking) {
                            // console.log('ติดตามอยู่');
                            isProgrammaticChange = true; // ระบุว่าเป็นการเปลี่ยนจากโค้ด
                            map.panTo(updatedLatLng);
                            isProgrammaticChange = false;
                        } else {
                            // console.log('ไม่ได้ติดตาม');
                        }
                        officerMarker.setPosition(updatedLatLng);
                    },
                    (error) => {
                        console.error("Error watching position:", error);
                    },
                    {
                        enableHighAccuracy: true,
                        timeout: 5000,
                        maximumAge: 0
                    }
                );
            },
            (error) => {
                console.error("Error getting initial position:", error);
            },
            {
                enableHighAccuracy: true,
                timeout: 6000,
                maximumAge: 0
            }
        );
    } else {
        console.error("Geolocation is not supported by this browser.");
    }
}

function calculateAndDisplayRoute(origin, destination) {
    directionsService.route(
        {
            origin: origin,
            destination: destination,
            travelMode: google.maps.TravelMode.DRIVING
        },
        (response, status) => {

            if (status === google.maps.DirectionsStatus.OK) {
                directionsRenderer.setDirections(response);

                const leg = response.routes[0].legs[0];
                const distanceText = leg.distance.text;
                const durationText = leg.duration.text;
                const durationValue = leg.duration.value;

                const arrivalTime = aims_func_arrivalTime(durationValue);
                // console.log("เวลาถึงที่หมาย:", arrivalTime);

                document.querySelector("#travel-distance").textContent = distanceText;
                document.querySelector("#travel-duration").textContent = durationText + " ("+arrivalTime+")";
                const now = new Date();
                const formatted = now.toLocaleString('th-TH', {
                    year: 'numeric',
                    month: 'short',
                    day: 'numeric',
                    hour: '2-digit',
                    minute: '2-digit',
                    hourCycle: 'h24'
                });

                document.querySelector("#date_now").textContent = formatted + " น.";

                setTimeout(() => {
                    const windowHeight = window.innerHeight;
                    const topPadding = windowHeight * 0.20;
                    const bottomPadding = windowHeight * 0.40;
                    const leftPadding = windowHeight * 0.10;
                    const rightPadding = windowHeight * 0.10;

                    isProgrammaticChange = true;
                    map.fitBounds(response.routes[0].bounds, {
                        top: topPadding,
                        bottom: bottomPadding,
                        left: leftPadding,
                        right: rightPadding
                    });
                    isProgrammaticChange = false;
                }, 200);
            } else {
                console.error("Directions request failed due to " + status);
            }

        }
    );
}

function toggleTracking() {
    if (!officerMarker) return;

    isTracking = !isTracking;
    const trackButton = document.getElementById('trackButton');

    if (isTracking) {
        // console.log('ติดตาม');
        isProgrammaticChange = true; // ระบุว่าเป็นการเปลี่ยนจากโค้ด
        map.panTo(officerMarker.getPosition());
        map.setZoom(defaultZoom + 2);
        isProgrammaticChange = false;
        trackButton.textContent = 'หยุดติดตาม';
        trackButton.classList.add('tracking');
    } else {
        // console.log('หยุดติดตาม');
        isProgrammaticChange = true; // ระบุว่าเป็นการเปลี่ยนจากโค้ด
        map.setZoom(defaultZoom);
        isProgrammaticChange = false;
        trackButton.textContent = 'ติดตามตำแหน่ง';
        trackButton.classList.remove('tracking');
    }
}

function stopTrackingCenter() {
    // console.log('stopTrackingCenter');
    if (isTracking && !isProgrammaticChange) {
        isTracking = false;
        const trackButton = document.getElementById('trackButton');
        trackButton.textContent = 'ติดตามตำแหน่ง';
        trackButton.classList.remove('tracking');
        isProgrammaticChange = true; // ระบุว่าเป็นการเปลี่ยนจากโค้ด
        map.setZoom(defaultZoom);
        isProgrammaticChange = false;
    }
}

function stopTracking() {
    if (watchId) {
        navigator.geolocation.clearWatch(watchId);
        watchId = null;
    }
    if (officerMarker) {
        officerMarker.setMap(null);
        officerMarker = null;
    }
    if (directionsRenderer) {
        directionsRenderer.setMap(null);
    }
    isProgrammaticChange = true; // ระบุว่าเป็นการเปลี่ยนจากโค้ด
    map.setCenter(emergency_LatLng);
    map.setZoom(defaultZoom);
    isProgrammaticChange = false;
    document.querySelector('#trackButton').classList.add('d-none');
}

function sendOfficerLocation(location) {

    fetch("{{ url('/') }}/api/UpdateOfficerLocation/" + officers_id, {
        method: 'post',
        body: JSON.stringify(location),
        headers: {
            'Content-Type': 'application/json'
        }
    }).then(function (response){
        return response.text();
    }).then(function(data){
        // console.log(data);
    }).catch(function(error){
        // console.error(error);
    });
}

function get_idc_rc_of_case(){
    fetch("{{ url('/') }}/api/get_idc_rc_of_case" + "/" + '{{ $emergency->id }}')
    .then(response => response.json())
    .then(result => {
        // console.log(result);

        if (result.length > 0 && result[0]['idc']) {
            let idc = result[0]['idc'];
            let class_idc = ``;
            let show_text_idc = document.querySelector('#show_text_idc');
                show_text_idc.innerHTML = '' ;

            switch (idc) {
                case 'ทั่วไป':
                    class_idc = `status-normal`;
                    break;
                case 'ไม่รุนแรง':
                    class_idc = `status-success`;
                    break;
                case 'เร่งด่วน':
                    class_idc = `status-warning`;
                    break;
                case 'ฉุกเฉิน':
                    class_idc = `status-danger`;
                    break;
                case 'อื่นๆ':
                    class_idc = `status-other`;
                    break;
                default:
                    idc = 'ไม่มีข้อมูล';
                    class_idc = `status-normal`;
            }

            let text_html_idc = `
                <div class="status ${class_idc}">
                    <i class="fa-solid fa-circle fa-2xs me-2"></i>
                    <span>${idc}</span>
                </div>
            `;

            show_text_idc.insertAdjacentHTML('beforeend', text_html_idc);
        }

        if (result.length > 0 && result[0]['rc']) {
            let rc = result[0]['rc'];
            let class_rc = ``;
            let show_text_rc = document.querySelector('#show_text_rc');
            let text_rc = document.querySelector('#text_rc');

            show_text_rc.classList.remove('status-normal');
            show_text_rc.classList.remove('status-success');
            show_text_rc.classList.remove('status-warning');
            show_text_rc.classList.remove('status-danger');

            switch (rc) {
                case 'ทั่วไป':
                    class_rc = `status-normal`;
                    break;
                case 'ไม่รุนแรง':
                    class_rc = `status-success`;
                    break;
                case 'เร่งด่วน':
                    class_rc = `status-warning`;
                    break;
                case 'ฉุกเฉิน':
                    class_rc = `status-danger`;
                    break;
                case 'อื่นๆ':
                    class_rc = `status-other`;
                    break;
                default:
                    rc = 'ไม่มีข้อมูล';
                    class_rc = `status-normal`;
            }

            show_text_rc.classList.add(class_rc);
            text_rc.innerHTML = rc ;
        }

    });
}

function aims_func_arrivalTime(duration){
    let date_now = new Date();
    let travelTimeInSeconds = duration; 
    let arrivalTime = new Date(date_now.getTime() + (travelTimeInSeconds * 1000));
    let options = { hourCycle: 'h24' };
    let formattedTime = arrivalTime.toLocaleTimeString('th-TH', options);
    let timeWithoutSeconds = formattedTime.slice(0, -3); // ตัดวินาทีออก
    let timeWithSuffix = `${timeWithoutSeconds} น.`;

    return timeWithSuffix ;
}

// ===================== จัดการเมนู + คอนเทนต์ ===================== //
function initMenuAndContentNavigation() {
    const buttons = document.querySelectorAll('.btn-menu');
    const sections = document.querySelectorAll('.container-content > div');
    const sectionStates = new Map();
    let activeSection = null;

    // จัดการปุ่ม Treatment
    document.querySelectorAll('input[name="treatment"]').forEach(input => {
        input.addEventListener('change', () => {
            const treatmentGroup = document.querySelector('.treatment-group');
            const noTreatmentGroup = document.querySelector('.no-treatment-group');

            if (input.id === 'has_treatment') {
                treatmentGroup.classList.remove('hidden');
                noTreatmentGroup.classList.add('hidden');
            } else {
                treatmentGroup.classList.add('hidden');
                noTreatmentGroup.classList.remove('hidden');
            }

            document.querySelectorAll('input[name="sub_treatment"]').forEach(st => st.checked = false);
        });
    });

    // ซ่อนทุก section และ content
    sections.forEach((section, index) => {
        sectionStates.set(index, 0);
        section.style.display = 'none';

        const contents = section.querySelectorAll('.content');
        contents.forEach((content, contentIndex) => {
            content.style.display = 'none';

            const prevBtn = content.querySelector('.btn-prev');
            const nextBtns = content.querySelectorAll('.btn-next');

            if (prevBtn && index != 0) {
                prevBtn.addEventListener('click', () => navigateContent(index, contentIndex - 1));
            }

            nextBtns.forEach(nextBtn => {
                nextBtn.addEventListener('click', () => {
                    if (contentIndex <= 4) {
                        navigateContent(index, contentIndex + 1);

                        if (contentIndex == 1) {
                            stopTracking();
                        }
                    }
                });
            });
        });
    });

    // คลิกปุ่มเมนู
    buttons.forEach(button => {
        button.addEventListener('click', () => {
            const sectionIndex = parseInt(button.style.getPropertyValue('--index'));
            if (activeSection === sectionIndex) {
                sections[sectionIndex].style.display = 'none';
                button.classList.remove('active');
                activeSection = null;
            } else {
                buttons.forEach(btn => btn.classList.remove('active'));
                button.classList.add('active');
                sections.forEach(section => section.style.display = 'none');

                const selectedSection = sections[sectionIndex];
                selectedSection.style.display = 'block';
                activeSection = sectionIndex;

                const currentContentIndex = sectionStates.get(sectionIndex);
                const contents = selectedSection.querySelectorAll('.content');
                contents.forEach(content => content.style.display = 'none');
                if (contents[currentContentIndex]) {
                    contents[currentContentIndex].style.display = 'block';
                }
            }
        });
    });

    // ตรวจ input text เพื่อเปิดปุ่มถัดไป
    document.querySelectorAll('.content').forEach(content => {
        const input = content.querySelector('input[type="text"]');
        const nextButton = content.querySelector('.btn-next');

        if (input && nextButton) {
            nextButton.disabled = true;
            nextButton.classList.add('opacity-50', 'cursor-not-allowed');

            input.addEventListener('input', () => {
                const filled = input.value.trim() !== "";
                nextButton.disabled = !filled;
                nextButton.classList.toggle('opacity-50', !filled);
                nextButton.classList.toggle('cursor-not-allowed', !filled);
            });
        }
    });

    // ฟังก์ชันแสดง/เปลี่ยน content
    function navigateContent(sectionIndex, contentIndex) {

        // console.log("sectionIndex >> " + sectionIndex);
        // console.log("contentIndex >> " + contentIndex);

        sectionStates.set(sectionIndex, contentIndex);
        sections.forEach(section => section.style.display = 'none');
        const selectedSection = sections[sectionIndex];
        selectedSection.style.display = 'block';
        activeSection = sectionIndex;

        const contents = selectedSection.querySelectorAll('.content');
        contents.forEach(content => content.style.display = 'none');
        if (contents[contentIndex]) {
            contents[contentIndex].style.display = 'block';
        }

        buttons.forEach((btn, idx) => btn.classList.toggle('active', idx === sectionIndex));
    }

    // ฟังก์ชันแสดง console log เมื่อมีการเลือกค่าหรือคลิกถัดไป
    function showAlertData(event) {
        let inputName = '', inputValue = '';
        const target = event.target;

        if (target.matches('input[name="treatment"], input[name="sub_treatment"]')) {
            inputName = target.name;
            inputValue = target.value;
        } else if (target.closest('.btn-next')) {
            const button = target.closest('.btn-next');
            if (button.closest('.rc-group')) {
                inputName = 'rc';
                inputValue = button.textContent.trim();
                document.getElementById('rc').value = inputValue;
            } else {
                const content = button.closest('.content');
                const input = content.querySelector('input[type="text"]');
                if (input && input.value.trim()) {
                    inputName = input.name;
                    inputValue = input.value;
                }
            }
        }

        if (inputName && inputValue) {
            // console.log(`${inputName}: ${inputValue}`);

            fetch("{{ url('/') }}/api/update_help_operations", {
                method: "POST",
                headers: {
                    "Content-Type": "application/json",
                    "X-CSRF-TOKEN": "{{ csrf_token() }}"
                },
                body: JSON.stringify({
                    emergency_id: '{{ $emergency->id }}',
                    name: inputName,
                    value: inputValue
                })
            })
            .then(response => response.text())
            .then(data => {
                // console.log(data);
                if(data == "เสร็จสิ้น"){
                    navigateContent(2, 5)   
                }
                else if(data == "ถึงฐาน"){
                    setTimeout(() => {
                        // alert("เสร็จสิ้น GO TO Timeline Page")
                        window.location.href = "{{ url('/sos_aims/sum_timeline') }}" + "/" + "{{ $emergency->id }}";
                    }, 300);
                }
            })
            .catch(error => {
                console.error("เกิดข้อผิดพลาด:", error);
            });
        }

    }

    document.querySelectorAll('input[name="treatment"], input[name="sub_treatment"]').forEach(input => {
        input.addEventListener('change', showAlertData);
    });

    document.querySelectorAll('.btn-next').forEach(button => {
        button.addEventListener('click', showAlertData);
    });

    setTimeout(() => {
        if(current_status == "ออกจากฐาน" && !check_km_before){
            document.querySelector('#btn_start_page').click();
            navigateContent(2, 0);
        }
        else if(current_status == "ออกจากฐาน" && check_km_before){
            document.querySelector('#btn_start_page').click();
            navigateContent(2, 1);
        }
        else if(current_status == "ถึงที่เกิดเหตุ"){
            document.querySelector('#btn_start_page').click();
            let check_now_rc = "{{ $emergency->rc }}";
            let check_treatment = "{{ $emergency->op_treatment }}";
                // console.log(check_now_rc);
            if(!check_now_rc){
                navigateContent(2, 2);
            }
            else if(check_now_rc){
                navigateContent(2, 3);
                if(check_treatment){
                    document.querySelector('[label-treatment="'+check_treatment+'"]').click();
                }
            }
        }
        else if(current_status == "ออกจากที่เกิดเหตุ"){
            document.querySelector('#btn_start_page').click();
            navigateContent(2, 4);
        }
        else if(current_status == "ถึง รพ." || current_status == "กำลังกลับฐาน"){
            document.querySelector('#btn_start_page').click();
            navigateContent(2, 5);
        }
        else if(current_status == "เสร็จสิ้น"){
            document.querySelector('#btn_start_page').disabled = true;
        }
    }, 300);
}
</script>

<!-- บันทึกข้อมูลผู้ป่วย -->
<script>
    var originalData = {
        patient_name: document.getElementById('patient_name').value,
        patient_birth: document.getElementById('patient_birth').value,
        patient_gender: document.getElementById('patient_gender').value,
        patient_blood_type: document.getElementById('patient_blood_type').value,
        patient_identification: document.getElementById('patient_identification').value,
        patient_phone: document.getElementById('patient_phone').value,
        patient_congenital_disease: document.getElementById('patient_congenital_disease').value,
        patient_allergic_drugs: document.getElementById('patient_allergic_drugs').value,
        patient_regularly_medications: document.getElementById('patient_regularly_medications').value,
        patient_address: document.getElementById('patient_address').value,
    };

    const fieldLabels = {
        patient_name: 'ชื่อ-นามสกุล',
        patient_birth: 'วันเกิด',
        patient_gender: 'เพศ',
        patient_blood_type: 'กรุ๊ปเลือด',
        patient_identification: 'เลขประจำตัวประชาชน',
        patient_phone: 'เบอร์โทรศัพท์',
        patient_congenital_disease: 'โรคประจำตัว',
        patient_allergic_drugs: 'ยาที่แพ้',
        patient_regularly_medications: 'ยาที่ใช้ประจำ',
        patient_address: 'ที่อยู่'
    };


    function getChangedData() {
        let changedData = {};
        for (let key in originalData) {
            let currentValue = document.getElementById(key).value;
            if (originalData[key] !== currentValue) {
                changedData[key] = currentValue;
            }
        }
        return changedData;
    }

    document.querySelector('#btn_send_data_patient').addEventListener('click', async () => {
        const changedData = getChangedData();

        if (Object.keys(changedData).length === 0) {
            alert('ไม่มีข้อมูลที่เปลี่ยนแปลง');
            return;
        }

        const patientId = '{{ $emergency->id }}';
        try {
            const res = await fetch("{{ url('/') }}/api/patient/"+patientId+"/check_and_update", {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                },
                body: JSON.stringify({
                    originalData: originalData,
                    newData: changedData
                })
            });

            const result = await res.json();

            if (result.status === 'success') {
                alert('บันทึกเรียบร้อย');
                Object.assign(originalData, changedData);
            }
            else if (result.status === 'partial') {
                const conflictLabels = result.conflicts.map(field => fieldLabels[field] || field);
                alert(`บันทึกข้อมูลแล้ว แต่ช่องต่อไปนี้มีการเปลี่ยนแปลงโดยศูนย์ควบคุม:\n${conflictLabels.join('\n')}`);

                // 1. อัปเดต originalData เฉพาะช่องที่บันทึกได้
                for (const key in changedData) {
                    if (!result.conflicts.includes(key)) {
                        originalData[key] = changedData[key];
                    }
                }

                // 2. อัปเดต input ด้วยค่าปัจจุบันจาก DB สำหรับช่องที่ conflict
                if (result.currentValues) {
                    for (const key in result.currentValues) {
                        const input = document.getElementById(key);
                        if (input) {
                            input.value = result.currentValues[key];
                            originalData[key] = result.currentValues[key]; // sync originalData ด้วย
                        }
                    }
                }
            }


        } catch (error) {
            console.error('Error saving data:', error);
            alert('เกิดข้อผิดพลาดในการบันทึกข้อมูล');
        }
    });

</script>

@endsection
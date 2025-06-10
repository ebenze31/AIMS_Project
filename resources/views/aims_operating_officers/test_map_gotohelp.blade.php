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
</style>
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
<div id="myModal" tabindex="-1" aria-hidden="true" class="modal-tw hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 justify-center items-center w-full md:inset-0 h-modal md:h-full  z-[9999]">
    <div class="backdrop-modal"></div>
    <div class="relative p-4 w-full max-w-2xl h-full md:h-auto z-[9999]">
        <div class="relative p-4 bg-white rounded-lg shadow  sm:p-5">
            <div class="flex justify-between items-center pb-4 mb-4 rounded-t border-b sm:mb-5 dark:border-gray-600">
                <h3 class="text-lg font-semibold text-gray-900 dark:text-black">
                    ข้อมูลผู้ป่วย
                </h3>
                <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-toggle="myModal">
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
                        <input type="text" class="form-control" id="patient_name">
                    </div>

                    <div class="px-2 w-1/2 lg:w-1/5 mb-4 md:mb-0">
                        <label for="patient_birth_date" class="form-label">วันเกิด</label>
                        <input type="date" class="form-control" id="patient_birth_date">
                    </div>

                    <div class="px-2 w-1/2 lg:w-1/5">
                        <label for="patient_gender" class="form-label">เพศ</label>
                        <select name="patient_gender_select" id="patient_gender_select" class="form-control">
                            <option value="">-- เลือกเพศ --</option>
                            <option value="ชาย">ชาย</option>
                            <option value="หญิง">หญิง</option>
                        </select>
                    </div>

                </div>

                <div class="flex w-full flex-wrap -mx-2 mt-2">

                    <div class="px-2 w-1/1 lg:w-1/3 mb-4 md:mb-0">
                        <label for="patient_gender" class="form-label">กรุ๊ปเลือด</label>
                        <select name="patient_gender_select" id="patient_gender_select" class="form-control">
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

                    <div class="px-2 w-1/1 lg:w-1/3 mb-4 md:mb-0">
                        <label for="patient_" class="form-label">เลขประจำตัวประชาชน</label>
                        <input type="text" class="form-control" id="patient_">
                    </div>

                    <div class="px-2 w-1/1 lg:w-1/3">
                        <label for="patient_gender" class="form-label">เบอร์โทรศัพท์</label>
                        <select name="patient_gender_select" id="patient_gender_select" class="form-control">
                            <option value="ชาย">ชาย</option>
                            <option value="หญิง">หญิง</option>
                        </select>
                    </div>

                </div>
                <div class="flex w-full flex-wrap -mx-2 mt-3">
                    <div class="px-2 w-1/1 lg:w-1/3 mb-4 md:mb-0">
                        <label for="patient_" class="form-label">โรคประจำตัว</label>
                        <input type="text" class="form-control" id="patient_">
                    </div>

                    <div class="px-2 w-1/1 lg:w-1/3 mb-4 md:mb-0">
                        <label for="patient_" class="form-label">ยาที่แพ้</label>
                        <input type="text" class="form-control" id="patient_">
                    </div>

                    <div class="px-2 w-1/1 lg:w-1/3">
                        <label for="patient_gender" class="form-label">ยาที่ใช้ประจำ</label>
                        <select name="patient_gender_select" id="patient_gender_select" class="form-control">
                            <option value="ชาย">ชาย</option>
                            <option value="หญิง">หญิง</option>
                        </select>
                    </div>

                </div>

                <div class="flex w-full flex-wrap -mx-2 mt-3">
                    <div class="px-2 w-full mb-4 md:mb-0">
                        <label for="patient_" class="form-label">ที่อยู่</label>
                        <textarea class="form-control" id="inputAddress3" placeholder="กรอกที่อยู่" rows="4" style="height: 97px;"></textarea>
                    </div>
                </div>
                </div>
            </div>
            <div class="flex items-center p-6 space-x-2 border-t border-gray-200 rounded-b dark:border-gray-600">
                <button data-modal-toggle="myModal" type="button" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">ตกลง</button>
                <button data-modal-toggle="myModal" type="button" class="text-gray-500 bg-white hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-gray-200 rounded-lg border border-gray-200 text-sm font-medium px-5 py-2.5 hover:text-gray-900 focus:z-10 dark:bg-gray-700 dark:text-gray-300 dark:border-gray-500 dark:hover:text-white dark:hover:bg-gray-600 dark:focus:ring-gray-600">ยกเลิก</button>
            </div>
        </div>
    </div>
</div>

<div id="myModal1" tabindex="-1" aria-hidden="true" class="modal-tw hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 justify-center items-center w-full md:inset-0 h-modal md:h-full z-[9999]">
    <div class="backdrop-modal"></div>
    <div class="relative p-4 w-full max-w-2xl h-full md:h-auto z-[9999]">
        <div class="relative p-4 bg-white rounded-lg shadow  sm:p-5">
            <div class="flex justify-between items-center pb-4 mb-4 rounded-t border-b sm:mb-5 dark:border-gray-600">
                <h3 class="text-lg font-semibold text-gray-900 dark:text-black">
                    เลือกความรุนแรง
                </h3>
                <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-toggle="myModal">
                    <svg aria-hidden="true" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path>
                    </svg>
                    <span class="sr-only">Close modal</span>
                </button>
            </div>

            <style>
                .btn-idc {
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

                .radio-idc {
                    display: none;
                }


                .radio-idc:checked~.idc-other {
                    background-color: #000;
                    color: #fff;
                }

                .idc-other {
                    border-color: #000 !important;
                    color: #000;
                }

                .radio-idc:checked~.idc-normal {
                    background-color: #1447e6;
                    color: #fff;
                }

                .idc-normal {
                    border-color: #1447e6 !important;
                    color: #1447e6;

                }

                .radio-idc:checked~.idc-not-severe {
                    background-color: #12BA09;
                    color: #fff;
                }

                .idc-not-severe {
                    border-color: #12BA09 !important;
                    color: #12BA09;

                }

                .radio-idc:checked~.idc-urgent {
                    background-color: #FFC517;
                    color: #fff;
                }

                .idc-urgent {
                    border-color: #FFC517 !important;
                    color: #FFC517;

                }

                .radio-idc:checked~.idc-danger {
                    background-color: #DE2525;
                    color: #fff;
                }

                .idc-danger {
                    border-color: #DE2525 !important;
                    color: #DE2525;

                }
            </style>
            <div class="mb-2">
                <div class="flex w-full">
                    <div class="w-1/2 p-2">
                        <input type="radio" name="idc_officer" id="radio_other" class="radio-idc">
                        <label for="radio_other" class="btn-idc idc-other">อื่นๆ</label>
                    </div>
                    <div class="w-1/2 p-2">
                        <input type="radio" name="idc_officer" id="radio_normal" class="radio-idc">
                        <label class="btn-idc idc-normal" for="radio_normal">ทั่วไป</label>
                    </div>
                </div>
                <div class="flex w-full">
                    <div class="w-1/2 p-2">
                        <input type="radio" name="idc_officer" id="radio_not_severe" class="radio-idc">
                        <label class="btn-idc idc-not-severe" for="radio_not_severe"> ไม่รุนแรง</label>
                    </div>
                    <div class="w-1/2 p-2">
                        <input type="radio" name="idc_officer" id="radio_urgent" class="radio-idc">
                        <label class="btn-idc idc-urgent" for="radio_urgent">เร่งด่วน</label>
                    </div>
                </div>
                <div class="flex w-full">
                    <div class="p-2 w-full">
                        <input type="radio" name="idc_officer" id="radio_danger" class="radio-idc">
                        <label class="btn-idc idc-danger" for="radio_danger">รุนแรง</label>
                    </div>
                </div>
            </div>
            <div class="flex items-center justify-end pb-6 space-x-2 b rounded-b ">
                <button data-modal-toggle="myModal1" type="button" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">ตกลง</button>
                <!-- <button data-modal-toggle="myModal1" type="button" class="text-gray-500 bg-white hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-gray-200 rounded-lg border border-gray-200 text-sm font-medium px-5 py-2.5 hover:text-gray-900 focus:z-10 dark:bg-gray-700 dark:text-gray-300 dark:border-gray-500 dark:hover:text-white dark:hover:bg-gray-600 dark:focus:ring-gray-600">ยกเลิก</button> -->
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

    .btn-menu:hover i,
    .btn-menu:focus i,
    .btn-menu.active i {
        background: #fff;
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
    }

    .btn-menu:hover,
    .btn-menu:focus,
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
    .btn-call-more {
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
</style>

<div>
    <div class="map" id="map"></div>
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

                    <!-- <button data-modal-target="myModal" data-modal-toggle="myModal" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
  เปิด Modal
</button>
 <button data-modal-target="myModal1" data-modal-toggle="myModal1" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
  เปิด Modal
</button>
 -->



                    <button class="btn-edit cursor-pointer" style="--index: 0" data-modal-target="myModal" data-modal-toggle="myModal">แก้ไขข้อมูลผู้ป่วย</button>
                    <!-- <button class="btn-call-more" style="--index: 1">ปฎิบัติการร่วม / หมู่</button> -->
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
                    <div>
                        <div class="label">ศูนย์สั่งการ</div>
                        <div class="status status-normal">
                            <i class="fa-solid fa-circle fa-2xs me-2"></i>
                            <span>ทั่วไป</span>
                        </div>

                        <div class="status status-success">
                            <i class="fa-solid fa-circle fa-2xs me-2"></i>
                            <span>ไม่รุนแรง</span>
                        </div>

                        <div class="status status-warning">
                            <i class="fa-solid fa-circle fa-2xs me-2"></i>
                            <span>เร่งด่วน</span>
                        </div>

                        <div class="status status-danger">
                            <i class="fa-solid fa-circle fa-2xs me-2"></i>
                            <span>ฉุกเฉิน</span>
                        </div>
                    </div>
                    <div class="mt-4">
                        <div class="label">เจ้าหน้าที่</div>
                        <button class="status status-success flex justify-between cursor-pointer status-idc" data-modal-target="myModal1" data-modal-toggle="myModal1">
                            <div>

                                <i class="fa-solid fa-circle fa-2xs me-2"></i>
                                <span id="text_idc">ไม่รุนแรง</span>
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
            document.addEventListener('DOMContentLoaded', function() {
                const radios = document.querySelectorAll('input[name="idc_officer"]');
                const textIdc = document.querySelector('.section-2 .status.status-success #text_idc'); // เปลี่ยนตามตำแหน่งจริง
                const buttonIdc = document.querySelector('.section-2 .status-idc'); // ปุ่มที่จะแสดงระดับใหม่

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
                        text: 'รุนแรง',
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
                        }
                    });
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

            .idc-group,
            .treatment-group,
            .no-treatment-group {
                flex-wrap: wrap;
                display: flex;
            }

            .idc-group button,
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

                <div class="body flex idc-group">
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
                    <input type="hidden" id="idc" name="idc" value="">
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
                            <label for="has_treatment" class="btn btn-treatment test">มีการรักษา</label>



                            <!-- <input type="radio" name="treatment" id="has_treatment" class="hidden">
                            <label for="has_treatment" class="btn btn-treatment">มีการรักษา</label> -->
                        </div>
                        <div class="px-2 w-[100%]">

                            <input type="radio" name="treatment" id="no_treatment" value="ไม่มีการรักษา" class="hidden">
                            <label for="no_treatment" class="btn btn-no-treatment test">ไม่มีการรักษา</label>
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
                            <p class="text-[13px] text-[#7c7c7c] leading-[18px]">ระยะทาง</p>
                            <p class="text-[18px] text-[#2856fa] leading-[18px]">84 กม.</p>
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
                            <p class="text-[13px] text-[#7c7c7c] leading-[18px]">เดินทาง</p>
                            <p class="text-[18px] text-[#2856fa] leading-[18px]">1 ชม. 20 นาที</p>
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
document.addEventListener("DOMContentLoaded", function () {
    open_map();

    // setTimeout(() => {
    //     document.querySelector('#btn_start_page').click();
    // }, 200);

    initMenuAndContentNavigation();
});

// ========================== แผนที่ ========================== //
let check_contentIndex;
var map;
var officerMarker;
var emergencyMarker;
var directionsRenderer;

var aims_marker = "{{ url('/img/icon/operating_unit/aims/aims_marker.png') }}";
var emergency_Lat = parseFloat("{{ $emergency->emergency_lat }}");
var emergency_Lng = parseFloat("{{ $emergency->emergency_lng }}");

const emergency_LatLng = { lat: emergency_Lat, lng: emergency_Lng };
let contentIndex = 0;

// ตัวแปรเก็บตำแหน่งก่อนหน้า
let previousLatLng = null;
let currentLatLng = null; // เก็บตำแหน่งล่าสุด
let isRouteCreated = false; // ตัวแปรควบคุมการสร้างเส้นทางครั้งแรก
let currentHeading = 320; // เริ่มต้นมุมหมุนจากค่าเดิม

function open_map() {
    map = new google.maps.Map(document.getElementById("map"), {
        center: emergency_LatLng,
        zoom: 15,
        heading: currentHeading,
        tilt: 47.5,
        mapId: "90f87356969d889c",
    });
    const buttons = [
        ["Rotate Left", "rotate", 20, google.maps.ControlPosition.LEFT_CENTER],
        ["Rotate Right", "rotate", -20, google.maps.ControlPosition.RIGHT_CENTER],
        ["Tilt Down", "tilt", 20, google.maps.ControlPosition.TOP_CENTER],
        ["Tilt Up", "tilt", -20, google.maps.ControlPosition.BOTTOM_CENTER],
    ];

    buttons.forEach(([text, mode, amount, position]) => {
        const controlDiv = document.createElement("div");
        const controlUI = document.createElement("button");

        controlUI.classList.add("ui-button");
        controlUI.innerText = `${text}`;
        controlUI.addEventListener("click", () => {
            adjustMap(mode, amount);
        });
        controlDiv.appendChild(controlUI);
        map.controls[position].push(controlDiv);
    });

    const adjustMap = function (mode, amount) {
        switch (mode) {
            case "tilt":
                map.setTilt(map.getTilt() + amount);
                break;
            case "rotate":
                currentHeading = (map.getHeading() + amount + 360) % 360;
                map.setHeading(currentHeading);
                break;
            default:
                break;
        }
    };

    // Marker สำหรับจุดฉุกเฉิน
    emergencyMarker = new google.maps.Marker({
        position: emergency_LatLng,
        map: map,
        icon: { url: aims_marker, scaledSize: new google.maps.Size(45, 45) }
    });

    // ร้องขอการเข้าถึง Device Orientation
    if (window.DeviceOrientationEvent) {
        window.addEventListener("deviceorientation", handleOrientation, true);
    } else {
        console.log("อุปกรณ์นี้ไม่รองรับ DeviceOrientationEvent");
    }

    updateUserLocation();
}

function handleOrientation(event) {
    if (event.alpha !== null) {
        const deviceHeading = Math.round(event.alpha); // มุมทิศทางจากเข็มทิศ (0-360 องศา)
        currentHeading = deviceHeading;
        map.setHeading(currentHeading);
        console.log("อัปเดตทิศทางจากอุปกรณ์ ณ เวลา:", new Date().toLocaleString(), "มุม:", currentHeading);
    }
}

function updateUserLocation() {
    if (navigator.geolocation) {
        navigator.geolocation.getCurrentPosition(
            (position) => {
                const userLatLng = {
                    lat: position.coords.latitude,
                    lng: position.coords.longitude
                };

                // อัปเดต Marker เสมอ
                if (officerMarker) officerMarker.setMap(null);

                officerMarker = new google.maps.Marker({
                    position: userLatLng,
                    map: map,
                    icon: {
                        path: google.maps.SymbolPath.FORWARD_CLOSED_ARROW,
                        scale: 6,
                        strokeColor: "blue",
                        strokeWeight: 2,
                        fillColor: "#256aff",
                        fillOpacity: 1,
                        rotation: 0 // หัวขึ้นเสมอ
                    },
                    title: "ตำแหน่งของผู้ใช้"
                });

                // โฟกัสที่ officerMarker
                map.setCenter(userLatLng);

                // อัปเดตตำแหน่งล่าสุด
                currentLatLng = { lat: userLatLng.lat, lng: userLatLng.lng };
                if (!previousLatLng) {
                    previousLatLng = { ...currentLatLng }; // ตั้งค่าเริ่มต้น
                }

                // สร้างเส้นทางครั้งแรกครั้งเดียว
                if (!isRouteCreated) {
                    const directionsService = new google.maps.DirectionsService();
                    directionsRenderer = new google.maps.DirectionsRenderer({
                        suppressMarkers: true
                    });
                    directionsRenderer.setMap(map);

                    console.log("กำลังคำนวณเส้นทางครั้งแรก ณ เวลา:", new Date().toLocaleString());

                    directionsService.route(
                        {
                            origin: userLatLng,
                            destination: emergency_LatLng,
                            travelMode: 'DRIVING'
                        },
                        (response, status) => {
                            if (status === 'OK') {
                                directionsRenderer.setDirections(response);
                                map.fitBounds(response.routes[0].bounds, { top: 50, bottom: 500, left: 0, right: 0 });
                                isRouteCreated = true;
                            }
                        }
                    );
                }

                // ตรวจสอบการเปลี่ยนแปลงตำแหน่งและเรียก fitBounds
                if (previousLatLng) {
                    const prevLatStr = previousLatLng.lat.toFixed(3);
                    const prevLngStr = previousLatLng.lng.toFixed(3);
                    const currLatStr = currentLatLng.lat.toFixed(3);
                    const currLngStr = currentLatLng.lng.toFixed(3);

                    if (prevLatStr !== currLatStr || prevLngStr !== currLngStr) {
                        if (directionsRenderer && directionsRenderer.getDirections()) {
                            map.fitBounds(directionsRenderer.getDirections().routes[0].bounds, { top: 50, bottom: 500, left: 0, right: 0 });
                            console.log("ตำแหน่งเปลี่ยนแปลง ทำ fitBounds ใหม่ ณ เวลา:", new Date().toLocaleString());
                            previousLatLng = { ...currentLatLng }; // อัปเดต previous หลังจากเปลี่ยน
                        }
                    }
                }
            },
            () => {
                alert("ไม่สามารถรับตำแหน่งได้");
            }
        );
    }
}

// Loop รับตำแหน่งใหม่ทุก 12 วินาที
let locationInterval = setInterval(() => {
    if (check_contentIndex === 1) {
        clearInterval(locationInterval);
        if (officerMarker) officerMarker.setMap(null);
        if (directionsRenderer) directionsRenderer.setMap(null);
        map.setCenter(emergency_LatLng);
        return;
    }
    updateUserLocation();
}, 12000);

function sendOfficerLocation(location) {
    fetch("/api/save_officer_location", {
        method: "POST",
        headers: {
            "Content-Type": "application/json",
            "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').getAttribute('content')
        },
        body: JSON.stringify({ lat: location.lat, lng: location.lng })
    })
    .then(response => response.json())
    .then(data => console.log("Saved officer location:", data))
    .catch(error => console.error("Error saving officer location:", error));
}

function aims_func_arrivalTime(duration){
    // assuming you have already obtained the duration from Google Maps API and stored it in a variable called `duration`
    let date_now = new Date(); // get the current time
    let travelTimeInSeconds = duration; // get the travel time in seconds
    let arrivalTime = new Date(date_now.getTime() + (travelTimeInSeconds * 1000)); // add the travel time to the current time and create a new date object
    // let formattedTime = arrivalTime.toLocaleTimeString(); // format the arrival time as a string in a readable format
    let options = { hourCycle: 'h24' };
    let formattedTime = arrivalTime.toLocaleTimeString('th-TH', options);
        let timeWithoutSeconds = formattedTime.slice(0, -3); // ตัดวินาทีออก
        let timeWithSuffix = `${timeWithoutSeconds} น.`; // เติม "น." เข้าไป

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
                        check_contentIndex = contentIndex ;
                        navigateContent(index, contentIndex + 1);
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
            if (button.closest('.idc-group')) {
                inputName = 'idc';
                inputValue = button.textContent.trim();
                document.getElementById('idc').value = inputValue;
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
            console.log(`${inputName}: ${inputValue}`);
        }
    }

    document.querySelectorAll('input[name="treatment"], input[name="sub_treatment"]').forEach(input => {
        input.addEventListener('change', showAlertData);
    });

    document.querySelectorAll('.btn-next').forEach(button => {
        button.addEventListener('click', showAlertData);
    });
}
</script>

@endsection
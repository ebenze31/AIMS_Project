@extends('layouts.theme_aims')

@section('content')
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
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

    .map {
        width: 100%;
        height: 100%;
        background-color: #db2d2e;
        z-index: 1;
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
                    <i class="fa-solid fa-phone"></i>
                </p>
            </button>
            <button class="btn-menu" style="--index: 1">
                <p class="m-0">
                    <i class="fa-solid fa-phone"></i>
                </p>
            </button>
            <button class="btn-menu" style="--index: 2">
                <p class="m-0">
                    <i class="fa-solid fa-phone"></i>
                </p>
            </button>
            <button class="btn-menu" style="--index: 3">
                <p class="m-0">
                    <i class="fa-solid fa-phone"></i>
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
                    <button class="btn-edit" style="--index: 0">แก้ไขข้อมูลผู้ป่วย</button>
                    <button class="btn-call-more" style="--index: 1">ปฎิบัติการร่วม / หมู่</button>
                </div>
            </div>
        </div>

        <div class="section-2">
            <div class="content">
                <div class="body">
                    <div>
                        <div class="label">ศูนย์สั่งการ</div>
                        <div class="status status-normal">
                            <i class="fa-solid fa-circle fa-2xs me-2"></i>
                            <span>ทั่วไป</span>
                        </div>
                    </div>
                    <div>
                        <div class="label">เจ้าหน้าที่</div>
                        <button class="status status-success flex justify-between">
                            <div>

                                <i class="fa-solid fa-circle fa-2xs me-2"></i>
                                <span>ไม่รุนแรง</span>
                            </div>

                            <div>
                                <i class="fa-solid fa-chevron-right"></i>
                            </div>
                        </button>
                    </div>
                </div>
            </div>
        </div>
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
                        background-color: #DB2F2F;
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
                    <button class="btn-to-base btn-next" ><i class="fa-solid fa-chevron-right"></i></button>
                </div>
            </div>
        </div>
        <div class="section-4">
            <div class="content">
                <div class="body"></div>
            </div>
        </div>
    </div>
</div>
<script>
    document.addEventListener('DOMContentLoaded', () => {
        const buttons = document.querySelectorAll('.btn-menu');
        const sections = document.querySelectorAll('.container-content > div');
        const sectionStates = new Map();
        let activeSection = null;

        // Treatment radio button handling with immediate alert
        document.querySelectorAll('input[name="treatment"]').forEach(input => {
            input.addEventListener('change', () => {
                const treatmentGroup = document.querySelector('.treatment-group');
                const noTreatmentGroup = document.querySelector('.no-treatment-group');
                if (input.id === 'has_treatment') {
                    treatmentGroup.classList.remove('hidden');
                    noTreatmentGroup.classList.add('hidden');
                } else {
                    noTreatmentGroup.classList.remove('hidden');
                    treatmentGroup.classList.add('hidden');
                }
                document.querySelectorAll('input[name="sub_treatment"]').forEach(st => st.checked = false);
            });
        });


        // Initialize section states and hide all sections and contents
        sections.forEach((section, index) => {
            sectionStates.set(index, 0); // Start at first content (index 0)
            section.style.display = 'none'; // Hide all sections initially
            const contents = section.querySelectorAll('.content');
            contents.forEach((content, contentIndex) => {
                content.style.display = 'none'; // Hide all contents initially
                const prevBtn = content.querySelector('.btn-prev');
                const nextBtns = content.querySelectorAll('.btn-next');

                if (prevBtn) {
                    prevBtn.addEventListener('click', () => navigateContent(index, contentIndex - 1));
                }
                nextBtns.forEach(nextBtn => {
                    nextBtn.addEventListener('click', () => {
                        // Collect data for alert
                        // const content = nextBtn.closest('.content');
                        // const textInput = content.querySelector('input[type="text"]');
                        // const severityInput = content.querySelector('input[name="idc"]');
                        // let message = '';
                        // if (textInput) {
                        //     message += `ข้อมูล: ${textInput.value.trim()}\n`;
                        // }
                        // if (severityInput && severityInput.value) {
                        //     message += `ระดับความรุนแรง: ${severityInput.value}`;
                        // }
                        // if (message) {
                        //     alert(message);
                        // }
                        navigateContent(index, contentIndex + 1);
                    });
                });
            });
        });

        // Add click event to menu buttons
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

        // Input validation for text inputs
        document.querySelectorAll('.content').forEach(content => {
            const input = content.querySelector('input[type="text"]');
            const nextButton = content.querySelector('.btn-next');
            if (input && nextButton) {
                nextButton.disabled = true;
                nextButton.classList.add('opacity-50', 'cursor-not-allowed');
                input.addEventListener('input', () => {
                    if (input.value.trim() !== "") {
                        nextButton.disabled = false;
                        nextButton.classList.remove('opacity-50', 'cursor-not-allowed');
                    } else {
                        nextButton.disabled = true;
                        nextButton.classList.add('opacity-50', 'cursor-not-allowed');
                    }
                });
            }
        });

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

        // จัดการ radio buttons
        document.querySelectorAll('input[name="treatment"], input[name="sub_treatment"]').forEach(input => {
            input.addEventListener('change', showAlertData);
        });

        // จัดการปุ่ม btn-next
        document.querySelectorAll('.btn-next').forEach(button => {
            button.addEventListener('click', showAlertData);
        });

        function showAlertData(event) {
            let inputName = '';
            let inputValue = '';

            const target = event.target;

            // กรณีเป็น radio button (treatment หรือ sub_treatment)
            if (target.matches('input[name="treatment"], input[name="sub_treatment"]')) {
                inputName = target.name;
                inputValue = target.value;
            }
            // กรณีเป็นปุ่ม btn-next
            else if (target.closest('.btn-next')) {
                const button = target.closest('.btn-next');
                // ตรวจสอบว่าเป็นปุ่มใน idc-group (ระดับความรุนแรง)
                if (button.closest('.idc-group')) {
                    inputName = 'idc';
                    inputValue = button.textContent.trim();
                    document.getElementById('idc').value = inputValue;
                } else {
                    // ตรวจสอบ text input ที่เกี่ยวข้องกับปุ่ม
                    const content = button.closest('.content');
                    const input = content.querySelector('input[type="text"]');
                    if (input && input.value.trim()) {
                        inputName = input.name;
                        inputValue = input.value;
                    }
                }
            }

            // alert เฉพาะเมื่อมีข้อมูล
            if (inputName && inputValue) {
                alert(`${inputName}: ${inputValue}`);
            }
        }
    });
</script>
@endsection
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
            <div class="w-100 p-0 bg-primary map-oparating" style="">ASD</div>
        </div>
    </div>
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
            <button type="button" class="btn btn-outline-dark w-100">ทั้งหมด</button>
            <button type="button" class="btn btn-outline-dark w-100">ประเภท</button>
            <button type="button" class="btn btn-outline-dark w-100">ชื่อ</button>
            <button type="button" class="btn btn-outline-dark w-100">หน่วย</button>
        </div>
    </div>

    <div class="menu-container mt-4">
        <div class="menu-header">เจ้าหน้าที่</div>
        <div class="menu-content">
            <div class="content">
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




@endsection
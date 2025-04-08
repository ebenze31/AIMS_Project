@extends('layouts.theme_aims')

@section('content')

<style>
    body {
        width: 100%;
        height: 100dvh;
    }

    .nav-top {
        background: var(--background_primary);
        width: 100%;
        height: 79px;
        display: flex;
        align-items: center;
        padding: 0 20px;
        font-size: 22px;
        font-weight: bold;
        color: #fff;
    }

    .map-container {
        padding: 20px;
    }

    .number-item {
        display: flex;
        justify-content: space-between;
        padding: 10px;
        border-bottom: 1px solid #848484;
    }

    .contect .name {
        font-size: 16px;
        font-weight: bolder;
    }

    .contect .number {
        font-size: 14px;
        font-weight: lighter;
        color: #3f3939;
    }



    .btn-call {
        display: flex;
        align-items: center;
        justify-content: center;
        width: 45px;
        border-radius: 10px;
        border: 2px solid transparent;
        background: linear-gradient(to right, #fff, #fff),
            linear-gradient(260deg, rgba(40, 86, 250, 1) 0%, rgba(6, 162, 253, 1) 100%);
        background-clip: padding-box, border-box;
        -webkit-background-clip: padding-box, border-box;
        transition: all .15s ease-in-out;
    }

    .btn-call i {
        background: rgb(40, 86, 250);
        background: -moz-linear-gradient(260deg, rgba(40, 86, 250, 1) 0%, rgba(6, 162, 253, 1) 100%);
        background: -webkit-linear-gradient(260deg, rgba(40, 86, 250, 1) 0%, rgba(6, 162, 253, 1) 100%);
        background: linear-gradient(260deg, rgba(40, 86, 250, 1) 0%, rgba(6, 162, 253, 1) 100%);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        transition: all .15s ease-in-out;
    }

    .btn-call:hover,
    .btn-call:focus {
        color: #fff !important;
        background: var(--background_primary);
        border: none !important;
    }

    .btn-call:hover i,
    .btn-call:focus i {
        background: #fff;
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
    }

    @media (max-width: 900px) {
        .content {
            display: block;
        }

        .map {
            width: 100% !important;
            background-color: #2d2d2d;
            height: 250px;
            border-radius: 15px;
        }

        .header-phone-number {
            background: var(--background_primary);
            height: 56px;
            margin-left: 20px;
            display: flex;
            align-items: center;
            padding-left: 20px;
            font-weight: bold;
            border-radius: 10px 0 0 10px;
            color: #fff;
        }

        .phone-number {
            height: calc(100% - 426px);
            /* background-color: rgb(189, 189, 189); */
            padding: 20px 30px;
            overflow: auto;

        }

        .btn-sos-aims {
            position: fixed;
            bottom: 0px;
            padding: 20px;
            /* background-color: #000; */
            width: 100%;
            /* background: rgba(0,0,0,1);
            backdrop-filter: blur(50px); */
        }

        .btn-sos-aims button {
            background: var(--background_primary);
            width: 100%;
            height: 74px;
            border-radius: 10px;
            z-index: 3;
            position: relative;
            display: flex;
            align-items: center;
            padding: 20px;
        }

        .backdrop {
            position: absolute;
            bottom: 0;
            left: 0;
            width: 100%;
            height: calc(100% + 20px);
            background: linear-gradient(to bottom,
                    rgba(0, 0, 0, 0) 0%,
                    rgba(0, 0, 0, .8) 100%);
            pointer-events: none;
            /* เพื่อให้คลิกผ่านได้ */
            z-index: 2;
            /* กำหนดให้อยู่ด้านบนของเนื้อหา */
        }

        .phone-number .number-item:last-child {
            margin-bottom: 5em;
        }

    }

    @media (min-width: 900px) {
        .content {
            display: flex;
        }

        .map {
            width: 60dvw !important;
            background-color: #2d2d2d;
            height: calc(100dvh - 119px);
            border-radius: 15px;
        }

        .container-phone-number {
            width: 100%;
            padding: 0 10px;
            display: block;
            align-content: space-between;
        }

        .container-phone-number {
            width: 100%;
            padding: 20px;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            /* จัดให้อยู่บนสุดและล่างสุด */
            min-height: 100%;
            /* ให้ container เต็มหน้าจอ */
            max-height: 100%;
            /* ให้ container เต็มหน้าจอ */
        }

        .btn-sos-aims button {
            background: var(--background_primary);
            width: 100%;
            height: 74px;
            border-radius: 10px;
            z-index: 3;
            position: relative;
            display: flex;
            align-items: center;
            padding: 20px;
        }

        .phone-number {
            height: calc(100dvh - 240px);
            /* background-color: rgb(189, 189, 189); */
            padding: 20px 30px;
            overflow: auto;

        }
    }
</style>

<nav class="nav-top">
    <div class="">
        แจ้งเหตุฉุกเฉิน
    </div>
</nav>

<form method="POST" action="/submit">
    @csrf
    <div class="form-group">
        <label for="name">ชื่อ:</label>
        <input type="text" name="name" id="name" value="{{ session('webhook_data.name') }}" class="form-control">
    </div>
    <div class="form-group">
        <label for="email">อีเมล:</label>
        <input type="email" name="email" id="email" value="{{ session('webhook_data.email') }}" class="form-control">
    </div>
    <button type="submit" class="btn btn-primary">ส่ง</button>
</form>



<div class=" m-auto">
    <div class="content">
        <div class="map-container">
            <div class="map"></div>
        </div>
        <div class="container-phone-number ">
            <div>
                <div class="header-phone-number">
                    เบอร์โทรฉุกเฉิน
                </div>
                <div class="phone-number">
                    <div class="number-item">
                        <div class="contect">
                            <p class="name">ตำรวจ</p>
                            <p class="m-0 number">191</p>
                        </div>
                        <a href="tel:191" class="btn-call">
                            <i class="fa-solid fa-phone"></i>
                        </a>
                    </div>

                    <div class="number-item">
                        <div class="contect">
                            <p class="name">ตำรวจ</p>
                            <p class="m-0 number">191</p>
                        </div>
                        <div class="btn-call">
                            <i class="fa-solid fa-phone"></i>
                        </div>
                    </div>

                    <div class="number-item">
                        <div class="contect">
                            <p class="name">ตำรวจ</p>
                            <p class="m-0 number">191</p>
                        </div>
                        <div class="btn-call">
                            <i class="fa-solid fa-phone"></i>
                        </div>
                    </div>

                    <div class="number-item">
                        <div class="contect">
                            <p class="name">ตำรวจ</p>
                            <p class="m-0 number">191</p>
                        </div>
                        <div class="btn-call">
                            <i class="fa-solid fa-phone"></i>
                        </div>
                    </div>

                    <div class="number-item">
                        <div class="contect">
                            <p class="name">ตำรวจ</p>
                            <p class="m-0 number">191</p>
                        </div>
                        <div class="btn-call">
                            <i class="fa-solid fa-phone"></i>
                        </div>
                    </div>
                    <div class="number-item">
                        <div class="contect">
                            <p class="name">ตำรวจ</p>
                            <p class="m-0 number">191</p>
                        </div>
                        <a href="tel:191" class="btn-call">
                            <i class="fa-solid fa-phone"></i>
                        </a>
                    </div>

                    <div class="number-item">
                        <div class="contect">
                            <p class="name">ตำรวจ</p>
                            <p class="m-0 number">191</p>
                        </div>
                        <div class="btn-call">
                            <i class="fa-solid fa-phone"></i>
                        </div>
                    </div>

                    <div class="number-item">
                        <div class="contect">
                            <p class="name">ตำรวจ</p>
                            <p class="m-0 number">191</p>
                        </div>
                        <div class="btn-call">
                            <i class="fa-solid fa-phone"></i>
                        </div>
                    </div>

                    <div class="number-item">
                        <div class="contect">
                            <p class="name">ตำรวจ</p>
                            <p class="m-0 number">191</p>
                        </div>
                        <div class="btn-call">
                            <i class="fa-solid fa-phone"></i>
                        </div>
                    </div>

                    <div class="number-item">
                        <div class="contect">
                            <p class="name">ตำรวจ</p>
                            <p class="m-0 number">191</p>
                        </div>
                        <div class="btn-call">
                            <i class="fa-solid fa-phone"></i>
                        </div>
                    </div>
                    <div class="number-item">
                        <div class="contect">
                            <p class="name">ตำรวจ</p>
                            <p class="m-0 number">191</p>
                        </div>
                        <a href="tel:191" class="btn-call">
                            <i class="fa-solid fa-phone"></i>
                        </a>
                    </div>

                    <div class="number-item">
                        <div class="contect">
                            <p class="name">ตำรวจ</p>
                            <p class="m-0 number">191</p>
                        </div>
                        <div class="btn-call">
                            <i class="fa-solid fa-phone"></i>
                        </div>
                    </div>

                    <div class="number-item">
                        <div class="contect">
                            <p class="name">ตำรวจ</p>
                            <p class="m-0 number">191</p>
                        </div>
                        <div class="btn-call">
                            <i class="fa-solid fa-phone"></i>
                        </div>
                    </div>

                    <div class="number-item">
                        <div class="contect">
                            <p class="name">ตำรวจ</p>
                            <p class="m-0 number">191</p>
                        </div>
                        <div class="btn-call">
                            <i class="fa-solid fa-phone"></i>
                        </div>
                    </div>

                    <div class="number-item">
                        <div class="contect">
                            <p class="name">ตำรวจ</p>
                            <p class="m-0 number">191</p>
                        </div>
                        <div class="btn-call">
                            <i class="fa-solid fa-phone"></i>
                        </div>
                    </div>
                    <div class="number-item">
                        <div class="contect">
                            <p class="name">ตำรวจ</p>
                            <p class="m-0 number">191</p>
                        </div>
                        <a href="tel:191" class="btn-call">
                            <i class="fa-solid fa-phone"></i>
                        </a>
                    </div>

                    <div class="number-item">
                        <div class="contect">
                            <p class="name">ตำรวจ</p>
                            <p class="m-0 number">191</p>
                        </div>
                        <div class="btn-call">
                            <i class="fa-solid fa-phone"></i>
                        </div>
                    </div>

                    <div class="number-item">
                        <div class="contect">
                            <p class="name">ตำรวจ</p>
                            <p class="m-0 number">191</p>
                        </div>
                        <div class="btn-call">
                            <i class="fa-solid fa-phone"></i>
                        </div>
                    </div>

                    <div class="number-item">
                        <div class="contect">
                            <p class="name">ตำรวจ</p>
                            <p class="m-0 number">191</p>
                        </div>
                        <div class="btn-call">
                            <i class="fa-solid fa-phone"></i>
                        </div>
                    </div>

                    <div class="number-item">
                        <div class="contect">
                            <p class="name">ตำรวจ</p>
                            <p class="m-0 number">191</p>
                        </div>
                        <div class="btn-call">
                            <i class="fa-solid fa-phone"></i>
                        </div>
                    </div>
                    <div class="number-item">
                        <div class="contect">
                            <p class="name">ตำรวจ</p>
                            <p class="m-0 number">191</p>
                        </div>
                        <a href="tel:191" class="btn-call">
                            <i class="fa-solid fa-phone"></i>
                        </a>
                    </div>

                    <div class="number-item">
                        <div class="contect">
                            <p class="name">ตำรวจ</p>
                            <p class="m-0 number">191</p>
                        </div>
                        <div class="btn-call">
                            <i class="fa-solid fa-phone"></i>
                        </div>
                    </div>

                    <div class="number-item">
                        <div class="contect">
                            <p class="name">ตำรวจ</p>
                            <p class="m-0 number">191</p>
                        </div>
                        <div class="btn-call">
                            <i class="fa-solid fa-phone"></i>
                        </div>
                    </div>

                    <div class="number-item">
                        <div class="contect">
                            <p class="name">ตำรวจ</p>
                            <p class="m-0 number">191</p>
                        </div>
                        <div class="btn-call">
                            <i class="fa-solid fa-phone"></i>
                        </div>
                    </div>

                    <div class="number-item">
                        <div class="contect">
                            <p class="name">ตำรวจ</p>
                            <p class="m-0 number">191</p>
                        </div>
                        <div class="btn-call">
                            <i class="fa-solid fa-phone"></i>
                        </div>
                    </div>
                    <div class="number-item">
                        <div class="contect">
                            <p class="name">ตำรวจ</p>
                            <p class="m-0 number">191</p>
                        </div>
                        <a href="tel:191" class="btn-call">
                            <i class="fa-solid fa-phone"></i>
                        </a>
                    </div>

                    <div class="number-item">
                        <div class="contect">
                            <p class="name">ตำรวจ</p>
                            <p class="m-0 number">191</p>
                        </div>
                        <div class="btn-call">
                            <i class="fa-solid fa-phone"></i>
                        </div>
                    </div>

                    <div class="number-item">
                        <div class="contect">
                            <p class="name">ตำรวจ</p>
                            <p class="m-0 number">191</p>
                        </div>
                        <div class="btn-call">
                            <i class="fa-solid fa-phone"></i>
                        </div>
                    </div>

                    <div class="number-item">
                        <div class="contect">
                            <p class="name">ตำรวจ</p>
                            <p class="m-0 number">191</p>
                        </div>
                        <div class="btn-call">
                            <i class="fa-solid fa-phone"></i>
                        </div>
                    </div>

                    <div class="number-item">
                        <div class="contect">
                            <p class="name">ตำรวจ</p>
                            <p class="m-0 number">191</p>
                        </div>
                        <div class="btn-call">
                            <i class="fa-solid fa-phone"></i>
                        </div>
                    </div>
                    <div class="number-item">
                        <div class="contect">
                            <p class="name">ตำรวจ</p>
                            <p class="m-0 number">191</p>
                        </div>
                        <a href="tel:191" class="btn-call">
                            <i class="fa-solid fa-phone"></i>
                        </a>
                    </div>

                    <div class="number-item">
                        <div class="contect">
                            <p class="name">ตำรวจ</p>
                            <p class="m-0 number">191</p>
                        </div>
                        <div class="btn-call">
                            <i class="fa-solid fa-phone"></i>
                        </div>
                    </div>

                    <div class="number-item">
                        <div class="contect">
                            <p class="name">ตำรวจ</p>
                            <p class="m-0 number">191</p>
                        </div>
                        <div class="btn-call">
                            <i class="fa-solid fa-phone"></i>
                        </div>
                    </div>

                    <div class="number-item">
                        <div class="contect">
                            <p class="name">ตำรวจ</p>
                            <p class="m-0 number">191</p>
                        </div>
                        <div class="btn-call">
                            <i class="fa-solid fa-phone"></i>
                        </div>
                    </div>

                    <div class="number-item">
                        <div class="contect">
                            <p class="name">ตำรวจ</p>
                            <p class="m-0 number">191</p>
                        </div>
                        <div class="btn-call">
                            <i class="fa-solid fa-phone"></i>
                        </div>
                    </div>
                    <div class="number-item">
                        <div class="contect">
                            <p class="name">ตำรวจ</p>
                            <p class="m-0 number">191</p>
                        </div>
                        <a href="tel:191" class="btn-call">
                            <i class="fa-solid fa-phone"></i>
                        </a>
                    </div>

                    <div class="number-item">
                        <div class="contect">
                            <p class="name">ตำรวจ</p>
                            <p class="m-0 number">191</p>
                        </div>
                        <div class="btn-call">
                            <i class="fa-solid fa-phone"></i>
                        </div>
                    </div>

                    <div class="number-item">
                        <div class="contect">
                            <p class="name">ตำรวจ</p>
                            <p class="m-0 number">191</p>
                        </div>
                        <div class="btn-call">
                            <i class="fa-solid fa-phone"></i>
                        </div>
                    </div>

                    <div class="number-item">
                        <div class="contect">
                            <p class="name">ตำรวจ</p>
                            <p class="m-0 number">191</p>
                        </div>
                        <div class="btn-call">
                            <i class="fa-solid fa-phone"></i>
                        </div>
                    </div>

                    <div class="number-item">
                        <div class="contect">
                            <p class="name">ตำรวจ</p>
                            <p class="m-0 number">191</p>
                        </div>
                        <div class="btn-call">
                            <i class="fa-solid fa-phone"></i>
                        </div>
                    </div>
                    <div class="number-item">
                        <div class="contect">
                            <p class="name">ตำรวจ</p>
                            <p class="m-0 number">191</p>
                        </div>
                        <a href="tel:191" class="btn-call">
                            <i class="fa-solid fa-phone"></i>
                        </a>
                    </div>

                    <div class="number-item">
                        <div class="contect">
                            <p class="name">ตำรวจ</p>
                            <p class="m-0 number">191</p>
                        </div>
                        <div class="btn-call">
                            <i class="fa-solid fa-phone"></i>
                        </div>
                    </div>

                    <div class="number-item">
                        <div class="contect">
                            <p class="name">ตำรวจ</p>
                            <p class="m-0 number">191</p>
                        </div>
                        <div class="btn-call">
                            <i class="fa-solid fa-phone"></i>
                        </div>
                    </div>

                    <div class="number-item">
                        <div class="contect">
                            <p class="name">ตำรวจ</p>
                            <p class="m-0 number">191</p>
                        </div>
                        <div class="btn-call">
                            <i class="fa-solid fa-phone"></i>
                        </div>
                    </div>

                    <div class="number-item">
                        <div class="contect">
                            <p class="name">ตำรวจ</p>
                            <p class="m-0 number">191</p>
                        </div>
                        <div class="btn-call">
                            <i class="fa-solid fa-phone"></i>
                        </div>
                    </div>
                </div>
            </div>

            <div class="btn-sos-aims">
                <div class="backdrop"></div>
                <button>
                    <div>
                        <img src="{{ asset('/partner_new/images/logo/aims logo.png') }}" alt="" width="60" height="60">
                    </div>
                    <div class="w-full block text-[#fff]">
                        <p class="text-[16px] font-extrabold">ขอความช่วยเหลือ</p>
                        <p class="text-[12px] font-light">ตำรวจท่องเที่ยว</p>
                    </div>
                </button>
            </div>

        </div>
    </div>
</div>


@endsection
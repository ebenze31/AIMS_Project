@extends('layouts.theme_aims')

@section('content')
<style>
    .term-and-privicypolicy {
        background: -webkit-linear-gradient(45deg, #A11C67, #C68561 80%);
        -webkit-background-clip: text;
        /* apply background clip */
        -webkit-text-fill-color: transparent;

    }

    .wave-group {
        position: relative;
        width: calc(100dvw - 100px);
        max-width: 500px;
    }

    .wave-group .input {
        font-size: 16px;
        padding: 10px 10px 5px 5px;
        display: block;
        width: 100%;
        border: none;
        /* border-bottom: 1px solid #C8C8C8; */
        background: transparent;
        margin-left: 50px;
    }

    .wave-group .input:focus {
        outline: none;
    }

    .wave-group .icon-input {
        color: #C8C8C8;
        font-size: 22px;
        font-weight: normal;
        position: absolute;
        top: 55%;
        left: 20px;
        transform: translate(-50%, -50%);
        pointer-events: none;

    }

    .wave-group .label {
        color: #C8C8C8;
        font-size: 16px;
        font-weight: normal;
        position: absolute;
        pointer-events: none;
        left: 50px;
        top: 10px;
        display: flex;
    }

    .wave-group .label-char {
        transition: 0.2s ease all;
        transition-delay: calc(var(--index) * .05s);
    }

    .wave-group .input:focus~label .label-char,
    .wave-group .input:valid~label .label-char,
    .wave-group .input:-webkit-autofill~label .label-char {
        transform: translateY(-20px);
        font-size: 14px;
        background: -webkit-linear-gradient(45deg, #A11C67, #C68561 80%);
        -webkit-background-clip: text;
        /* apply background clip */
        -webkit-text-fill-color: transparent;
    }

    .wave-group .input:focus~.icon-input,
    .wave-group .input:valid~.icon-input {
        background: -webkit-linear-gradient(45deg, #A11C67, #C68561 80%);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
    }

    .wave-group .input:-webkit-autofill,
    .wave-group .input:-webkit-autofill:hover,
    .wave-group .input:-webkit-autofill:focus,
    .wave-group .input:-webkit-autofill:active {
        background: -webkit-linear-gradient(45deg, #A11C67, #C68561 80%);
        -webkit-background-clip: text;
        -webkit-text-fill-color: #000;

    }

    .wave-group .input:-webkit-autofill~.icon-input{
        background: -webkit-linear-gradient(45deg, #A11C67, #C68561 80%);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
    }

    .wave-group .input:-webkit-autofill~.bar:before {
        width: 100%;
    }
    
    .wave-group .bar {
        position: relative;
        display: block;
        border-bottom: 1px solid #C8C8C8;
        width: 100%;
    }

    .wave-group .bar:before {
        content: '';
        height: 2px;
        width: 0;
        /* bottom: 1px; */
        position: absolute;
        background: linear-gradient(260deg, #A11C67 0%, #C68561 100%);

        transition: 0.2s ease all;
        -moz-transition: 0.2s ease all;
        -webkit-transition: 0.2s ease all;
    }

    .wave-group .bar:before {
        left: 0%;
    }


    .wave-group .input:focus~.bar:before {
        width: 100%;
    }

    .container-bs {
        width: 100% !important;
        margin-right: auto !important;
        margin-left: auto !important;
        padding-right: 15px !important;
        padding-left: 15px !important;
    }

    @media (min-width: 576px) {
        .container-bs {
            max-width: 540px !important;
        }
    }

    @media (min-width: 768px) {
        .container-bs {
            max-width: 720px !important;
        }
    }

    @media (min-width: 992px) {
        .container-bs {
            max-width: 960px !important;
        }
    }

    @media (min-width: 1200px) {
        .container-bs {
            max-width: 1140px !important;
        }
    }
    .btn-login{
        width: 100%;
        display: flex;
        align-items: center;
        padding: 15px;
        border-radius: 10px;
        color: #fff;
        background: linear-gradient(45deg, #A11C67 0%, #C68561 100%);
       justify-content: center;
       font-size: 14px;
       margin-top: 50px;
    }
    .btn-login:hover{
      cursor: pointer;
      opacity: .9;
    }
   
</style>
<div class="container-bs flex items-center h-[100dvh] justify-center notranslate">
    <!-- ... -->
    <div>
        <div class="flex justify-center">
            <img src="{{ asset('/partner_new/images/logo/aims full logo.png') }}" alt="" width="150" height="150">
        </div>

        <p class="mt-4 mb-0 text-center font-bold text-[24px] text-[#585757]">
            Login
        </p>

        <div class="mt-5 mb-5 text-center font-bold text-[14px] text-[#9E9E9E] ">
            การลงชื่อหมายความว่าคุณ <br>
            ยอมรับ
            <a href="#" class="term-and-privicypolicy">Term and privicy policy</a>
        </div>

        <form method="POST" id="from_login" action="{{ route('login') }}">
        @csrf
            <div class="flex justify-center mb-4">
                <div class="wave-group">
                    <input id="username" type="text" class="input @error('username') is-invalid @enderror" name="username" value="{{ old('username') }}" required autocomplete="username">
                    <span class="bar"></span>
                    <div class="icon-input"><i class="fa-solid fa-envelope"></i></div>
                    <label class="label">
                        <span class="label-char" style="--index: 0">U</span>
                        <span class="label-char" style="--index: 1">s</span>
                        <span class="label-char" style="--index: 2">e</span>
                        <span class="label-char" style="--index: 3">r</span>
                        <span class="label-char" style="--index: 4">n</span>
                        <span class="label-char" style="--index: 5">a</span>
                        <span class="label-char" style="--index: 6">m</span>
                        <span class="label-char" style="--index: 7">e</span>
                    </label>
                </div>
            </div>
            <div class="flex justify-center mb-4">
                <div class="wave-group " class="mx-auto">
                    <input id="password" type="password" class="input @error('password') is-invalid @enderror" name="password"  required autocomplete="current-password">
                    <span class="bar"></span>
                    <div class="icon-input"><i class="fa-solid fa-lock"></i></div>

                    <label class="label">
                        <span class="label-char" style="--index: 0">P</span>
                        <span class="label-char" style="--index: 1">a</span>
                        <span class="label-char" style="--index: 2">s</span>
                        <span class="label-char" style="--index: 3">s</span>
                        <span class="label-char" style="--index: 4">w</span>
                        <span class="label-char" style="--index: 5">o</span>
                        <span class="label-char" style="--index: 6">r</span>
                        <span class="label-char" style="--index: 7">d</span>
                    </label>
                </div>
            </div>

            <button class="btn btn-login" onclick="handleLoginClick(this)">
                เข้าสู่ระบบ
            </button>

            <button id="btn_login" class="btn btn-login" style="display: none;">
                d-none
            </button>
        </form>
        <div class="">
            <p  class="text-[#C8C8C8] text-center my-5">or connect with</p>
            <style>
                .btn-line-login{
                    width: 100%;
                    display: flex;
                    align-items: center;
                    border-radius: 10px;
                    color: #fff;
                    background: #06c755;
                    font-size: 14px;
                    padding: 1px;
                }
                .btn-line-login:hover{
                    background: #05b34c;
                }
                .btn-line-login:focus{
                    background: #048b3b;
                }
                .icon-line{
                    border-right: 1px solid rgba(0, 0, 0, .08);
                }
            </style>
            <a href="{{ route('login.line') }}?redirectTo={{ request('redirectTo') }}" class="btn btn-line-login">
                <div class="flex items-center w-full">
                    <img src="{{ asset('/img/icon/line_60.png') }}" alt="" width="50" class="icon-line">
                    <div class="w-full flex items-center justify-center" style="width: 100%;margin-left: -50px;">
                        เข้าสู่ระบบ
                    </div>
                </div>
            </a>
        </div>
    </div>
</div>


<script>
    
    document.addEventListener("DOMContentLoaded", function () {
        // console.log("START");
        // ฟังก์ชันลบคุกกี้
        function deleteCookie(name, domain) {
            document.cookie = name + "=; path=/; domain=" + domain + "; expires=Thu, 01 Jan 1970 00:00:00 UTC";
        }

        // console.log(document.cookie);

        // ตรวจสอบว่ามีคุกกี้ 'laravel_session' ที่มาจาก '.viicheck.com' หรือไม่
        if (document.cookie.includes("laravel_session")) {
            deleteCookie("laravel_session", ".viicheck.com");
            // console.log("Deleted laravel_session cookie");
        } else {
            // console.log("laravel_session cookie not found");
        }

    });

    function handleLoginClick(button) {
        // ปิดปุ่มเพื่อไม่ให้กดซ้ำ
        button.disabled = true;
        document.querySelector('#btn_login').click();

        // console.log("กำลังเข้าสู่ระบบ...");
    }

</script>
@endsection

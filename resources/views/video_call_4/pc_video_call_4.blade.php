
{{-- <link href="{{ asset('css/video_call_4/video_call_4.css') }}" rel="stylesheet"> --}}
<link href="{{ asset('css/video_call_4/layout_video_call_4.css') }}" rel="stylesheet">

<link rel="shortcut icon" href="{{ asset('/img/logo/logo_x-icon.png') }}" type="image/x-icon" />
<link href="https://kit-pro.fontawesome.com/releases/v6.4.2/css/pro.min.css" rel="stylesheet">

<!-- Bootstrap CSS -->
<link href="{{ asset('partner_new/css/bootstrap.min.css') }}" rel="stylesheet">

{{-- <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500&display=swap" rel="stylesheet">
<link href="{{ asset('partner_new/css/app.css') }}" rel="stylesheet">
<link href="{{ asset('partner_new/css/icons.css') }}" rel="stylesheet"> --}}


<style>
    /* @media screen and (min-width: 1024px)
    { */
        html,
        body,
        .full-height,
        .page-content,
        .wrapper {
            height: calc(100%);
            min-height: calc(100% ) !important;
            padding-bottom: 0;
            /* padding-top: 0; */
            /* margin-top: 0; */
            margin-bottom: 0;
            max-width: 100%;
            position: relative;
        }

        .data-sos {
            /* border-radius: 5px; */
            height: calc(99vh);
            max-height: 100% !important;
            background-color: #2b2d31;
            color: #fff !important;
            overflow: auto;
        }
        .data-sos *{
            color: #fff;
        }

        .data-sos::-webkit-scrollbar-track
        {
            -webkit-box-shadow: inset 0 0 6px rgba(43,46,50);
            background-color: #2b2d31 !important;

        }

        .data-sos::-webkit-scrollbar
        {
            width: 10px;
            background-color: #F5F5F5;
        }

        .data-sos::-webkit-scrollbar-thumb
        {
            background-color: #8b8b8a;
            border-radius: 25px;
        }

        .data-sos::-webkit-scrollbar-thumb:hover
        {
            background-color: #666665;
            border-radius: 25px;
        }

        #sos_assistant_map{
            height: 200px;
        }


        .head_sidebar_div {
            background-color: rgb(255, 255, 255);
            height: auto;
            padding: 10px;
            border-radius: 7px;
            margin-left: 2px; /* เพิ่มระยะห่างจากขอบซ้าย 2px */
            border-top: red 5px solid;
        }

        .neck_sidebar_div {
            background-color: rgb(255, 255, 255);
            height: auto;
            padding: 10px;
            border-radius: 7px;
            margin-left: 2px; /* เพิ่มระยะห่างจากขอบซ้าย 2px */
            border-top: rgb(81, 255, 0) 5px solid;
        }

        .body_sidebar_div {
            background-color: rgb(255, 255, 255);
            height: auto;
            padding: 10px;
            border-radius: 7px;
            margin-left: 2px; /* เพิ่มระยะห่างจากขอบซ้าย 2px */
            border-top: rgb(0, 99, 247) 5px solid;
        }

        .border-radius{
            border-radius: 10px;
        }

        .nowordwarp{
            word-wrap: break-word;
        }

        .item-video-call {
            aspect-ratio: 16/9;
            /* outline: #000 1px solid; */
            cursor: pointer;
            /* เพิ่มคอร์เซอร์แสดงถึงว่าองค์ประกอบนี้สามารถคลิกได้ */
            transition: all 0.3s ease-in-out;
        }

        .user-video-call-bar {
            overflow: auto;
        }

        .user-video-call-bar .custom-div {
            width: 200px;
            margin: 0 5px;
            aspect-ratio: 16/9;
            height: 100px !important;
            background: red;
            /* padding-top: calc(9 / 16 * 100%); */
            outline: #000 1px solid;
            position: relative;
        }

        .btn-show-hide-user-video-call {
            position: absolute;
            color: #fff;
            background-color: #2c2e31;
            border-color: #fff;
            border-radius: 50px;
            opacity: 0;
            top: -13%;
            left: 50%;
            transform: translate(-50%, -5%);
            padding: 5px 25px;
            transition: all .15s ease-in-out;
        }

        #icon_show_hide{
            transition: all .15s ease-in-out;
        }

        .btn-show-hide-user-video-call:hover {
            color: #fff;
        }

        .video-call:hover .btn-show-hide-user-video-call {
            opacity: 0.6;
        }

        .video-call:hover {
            /* box-shadow: inset 0px 0px 100px 0px rgba(0,0,0,0.1); */

            transition: all .15s ease-in-out;
            /* box-shadow: 0px 20px 42px -20px rgba(0, 0, 0, 0.45) inset,
                0px -20px 42px -20px rgba(0, 0, 0, 0.45) inset; */
        }

        .video-call {
            /* outline: #000 1px solid; */
            margin: 0;
            background-color: #ffffff;
        }

        .user-video-call-contrainer {
            /* display: flex;
            justify-content: center; */
            position: relative;

        }

        .user-video-call-bar div div { /* ของ bar ล่าง  */
            border-radius: 10px;
        }

        .user-video-call-bar div div .profile_image{ /* ของ bar ล่าง  */
            width: 50px;
            height: 50px;
            border-radius: 50%; /* คงรูปร่างวงกลม */
            object-fit: cover;
            pointer-events: none;
        }

        #container_user_video_call div div .profile_image{ /* ของ container ใหญ่ */
            width: 150px;
            height: 150px;
            border-radius: 50%; /* คงรูปร่างวงกลม */
            object-fit: cover;
            pointer-events: none;
        }

        #container_user_video_call {
            width: 100%;
            height: 100%;
            overflow: auto;
            padding: 1px 2rem;
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
        }

        #container_user_video_call .custom-div {
            aspect-ratio: 16/8.5;
            width: 100%;
            outline: #000 1px solid;
            border-radius: 5px;
            position: relative;
            background-color: #4d4d4d;
            margin: 5px;
        }

        #container_user_video_call  .custom-div:only-child{
            flex: 0 0 calc(100% - 40px);
        }
        #container_user_video_call  .custom-div:not(:only-child) {
            flex: 0 0 calc(50% - 40px);
        }

        .transparent-div {
            position: absolute;
            width: 100%;
            height: 100%;
            z-index: 3;
            background: rgba(255, 255, 255, 0);
            /* pointer-events: none; */
        }

        .custom-div .status-sound-output{
            position: absolute;
            top: 0;
            left: 0;
            display: flex;
        }

        .custom-div .status-input-output{
            position: absolute;
            top: 0;
            right: 0;
            display: flex;
            z-index: 4;
        }

        .custom-div .infomation-user{
            position: absolute;
            bottom: 0;
            right: 0;
            background-color: rgba(132, 136, 140 , 0.8);
            padding: .5rem 1rem;
            border-radius: 10px;
            margin: 1rem;
            color: #ffffff !important;
            font-size: 1em;
            font-weight: bold;
            /* word-wrap: break-word; */
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
            max-width: calc(100% - 10%);
        }

        .infomation-user .role-user-video-call ,.infomation-user .name-user-video-call{
            display: block;
        }
        .status-input-output .mic ,.status-input-output .camera,.status-sound-output .sound{
            margin: 5px;
            background-color: rgba(132, 136, 140 , 0.8);
            padding: .5rem 1rem;
            border-radius: 10px;
            color: #ffffff;
        }

        .status-input-output .settings{
            margin: 5px;
            background-color: rgba(132, 136, 140 , 0.8);
            padding: .5rem 1rem;
            border-radius: 10px;
            color: #ffffff;
            z-index: 4;
        }

        .user-video-call-bar .custom-div {
            border-radius: 10px;
        }

        .user-video-call-bar .custom-div .infomation-user{
            transform: scale(0.6);
            margin: 0;
            bottom: -12px;
            right: -30px;
            font-size: 1.3em;
            font-weight: bold;
            /* word-wrap: break-word; */
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
            max-width: calc(100%);
        }

        .user-video-call-bar .custom-div .status-input-output{
            transform: scale(0.7);
            margin: 0;
            top: -3px;
            right: -10px;
            z-index: 4;
        }

        .video-call-contrainer {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(50%, 1fr));
        }

        .grid-template {
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
        }

        .radio_style:checked {
            border-color: red; /* เปลี่ยนสีขอบของ radio input เป็นสีแดงเมื่อถูกเลือก */
            background-color: red; /* เปลี่ยนสีพื้นหลังของ radio input เป็นสีแดงเมื่อถูกเลือก */
        }

        .font-weight-bold{
            font-weight: bold !important;
        }

        /* --------------------------  ฟังก์ชัน เปลี่ยนไมค์และกล้อง -------------------------------------*/

        .dropcontent {
            visibility: hidden;
            width: 142px;
            & a {
                color: rgb(31, 193, 27);
            }
        }

        .open_dropcontent {
            visibility: visible;
        }

        .dropcontent2{
            visibility: hidden;
            width: 142px;
            & a {
                color: rgb(31, 193, 27);
            }
        }

        .open_dropcontent2 {
            visibility: visible;
        }

        .btnSpecial_mute{
            background-color: #f15a5a ; /* Discord's color */
        }
        .btnSpecial_mute:hover{
            background-color: #fa3838 !important; /* Discord's color */
        }

        .btnSpecial_unmute{
            background-color: #3f3e3e ; /* Discord's color */
        }

        .btn_leave{
            background-color: #ff0000 ; /* Discord's color */
        }

        .btn_leave:hover{
            background-color: #fa3838 !important; /* Discord's color */
        }

        .btnSpecial {
            border: none;
            border-radius: 50%;
            width: 60px;
            height: 60px;
            cursor: pointer;
            display: flex;
            justify-content: center;
            align-items: center;
            position: relative;
            margin: 5px;
            top: 0; /* ตำแหน่ง list ขึ้นด้านบนของปุ่ม */
            left: 0;
            border:#fff 1px solid;
        }

        .audio_button{
            background: rgba(255, 255, 255, 0);
            position: absolute;
            border-radius: 50%;
            width: 100%;
            height: 100%;
            border:#fff 1px;
        }

        .video_button{
            background: rgba(255, 255, 255, 0);
            position: absolute;
            border-radius: 50%;
            width: 100%;
            height: 100%;
            border:#fff 1px;
        }

        .btnSpecial:hover {
            background-color: #292828; /* Discord's color */
        }

        .time_of_room{
            position: absolute;
            padding: 5px;
            border-radius: 10px;
            top: 3%;
            right: 40%;
            /* bottom: 11%;
            left: 3%; */
            z-index: 9999;
            background-color: #292828; /* Discord's color */
            color: #ffffff;
        }


        .btnSpecial i{
            color: #ffffff;
            font-size: 1.3rem; /* 60% ของขนาดปัจจุบันของ i */
            transition: transform 0.3s ease; /* เพิ่มการเปลี่ยนแปลงอย่างนุ่มนวล */
        }

        .smallCircle {
            background-color: #3f3e3e; /* เปลี่ยนสีพื้นหลังตามที่คุณต้องการ */
            border: none;
            border-radius: 50%;
            width: 25px; /* ปรับขนาดตามที่คุณต้องการ */
            height: 25px; /* ปรับขนาดตามที่คุณต้องการ */
            position: absolute;
            bottom: 10;
            right: 10;
            transform: translate(50%, 50%);
            display: flex;
            justify-content: center;
            align-items: center;
            border:#fff 1px solid;
            z-index: 1;
        }

        .smallCircle:hover{
            background-color: #292828; /* Discord's color */
        }

        .smallCircle i{
            color: #ffffff;
            font-size: 10px;
        }

        .fa-arrow-up {
            color: #fff; /* เปลี่ยนสีไอคอนตามที่คุณต้องการ */
            font-size: 20px; /* ปรับขนาดตามที่คุณต้องการ */
        }

        .ui-list {
            list-style-type: none;
            padding: 0;
            margin: 0;
            position: absolute;
            bottom: 100; /* ตำแหน่ง list ขึ้นด้านบนของปุ่ม */
            left: 61%; /* ให้อยู่กึ่งกลางด้านซ้าย */
            transform: translateX(-49%); /* ให้ย้ายกลับไปที่ตำแหน่งที่ถูกต้อง */
            background-color: #3f3e3e;
            border-radius: 5px;
            z-index: 1000; /* เพื่อให้แสดงอยู่ข้างบนของปุ่ม */
            min-width: 250px; /* กำหนดความกว้างขั้นต่ำ */

        }

        .ui-list-item {
            color: #ffffff; /* สีข้อความ */
            padding-left: 15px;
            padding-right: 15px;
            /* padding-top: 5px; */
            padding-bottom: 5px;
            border-radius: 5px;
            display: flex;
            justify-content: space-between; /* จัดตัว radio2 ไปทางขวา */
            align-items: center; /* จัดให้เนื้อหาแนวตั้งกลาง */
        }

        .top-0 {
            top: 0;
        }

        .top-50 {
            top: 50px;
        }

        .top-100 {
            top: 100px;
        }

        /* เมื่อเมาส์ hover บนรายการ */
        .ui-list-item:hover {
            background-color: #555555; /* เปลี่ยนสีพื้นหลังเมื่อ hover */
            cursor: pointer;
        }

        .overflow_auto_video_call{
            overflow: auto;
        }

        /* -------------------------- จบ ฟังก์ชัน เปลี่ยนไมค์และกล้อง -------------------------------------*/

        /* ----------------- ตัว Popup แจ้งเตือน----------------- */
        .div_alert {
            position: fixed;
            left: 14%;
            bottom: 9%;
            width: 300px;
            height: 50px;
            text-align: center;
            font-family: 'Kanit', sans-serif;
            z-index: 9999;
            font-size: 18px;
            display: none; /* เริ่มต้นซ่อน .div_alert */
        }

        .div_alert span {
            background-color: #e64237;
            border-radius: 10px;
            color: white;
            padding: 20px;
            font-family: 'Kanit', sans-serif;
            z-index: 9999;
            font-size: 1em;
        }

        /* .up_down {
            animation-name: slideUpAndDown;
            animation-duration: 10s;
        }

        @keyframes slideUpAndDown {
            0% {
                transform: translateY(-180px);
            }
            10% {
                transform: translateY(0);
            }
            90% {
                transform: translateY(0);
            }
            100% {
                transform: translateY(-180px);
            }
        } */

        .up_down {
            animation-name: fadeInOut;
            animation-duration: 10s;
        }

        @keyframes fadeInOut {
            0% {
                opacity: 0;
            }
            10% {
                opacity: 1;
            }
            90% {
                opacity: 1;
            }
            100% {
                opacity: 0;
            }
        }


        /* ----------------- End ตัว Popup แจ้งเตือน----------------- */

        /* css ของ dropdown remote volume */
        .dropdown_volume {
            text-decoration: none;
            color: #000000;
        }

        .dropdown_volume:hover {
            color: #222222
        }

        /* Dropdown */

        .dropdown_volume_label {
            display: inline-block;
            position: relative;
            cursor: pointer;
        }

        .dd-button {
            display: inline-block;
            border: 1px solid gray;
            border-radius: 4px;
            /* padding: 10px 30px 10px 20px; */
            background-color: #ffffff;
            cursor: pointer;
            white-space: nowrap;
        }

        .dd-button:after {
            content: '';
            position: absolute;
            top: 50%;
            right: 15px;
            transform: translateY(-50%);
            width: 0;
            height: 0;
            border-left: 5px solid transparent;
            border-right: 5px solid transparent;
            border-top: 5px solid black;
        }

        .dd-button:hover {
            background-color: #eeeeee;
        }


        .dd-input {
            display: none;
        }

        .dd-menu {
            position: absolute;
            top: 100%;
            border: 1px solid #ccc;
            border-radius: 4px;
            padding: 0;
            margin: 2px 0 0 0;
            box-shadow: 0 0 6px 0 rgba(0,0,0,0.1);
            background-color: #ffffff;
            list-style-type: none;
            width: 150px;
            right: 0;
            z-index: 5;
        }

        .dd-input + .dd-menu {
            display: none;
        }

        .dd-input:checked + .dd-menu {
            display: block;
        }

        .dd-menu li {
            position: relative;
            padding: 10px 20px;
            cursor: default;
            white-space: nowrap;
        }

        .dd-menu li:hover {
            background-color: hsl(0, 0%, 96%);
        }

        .dd-menu li a {
            display: block;
            margin: -10px -20px;
            padding: 10px 20px;
        }

        .dd-menu li.divider{
            padding: 0;
            border-bottom: 1px solid #cccccc;
        }

        .bottom_bar_video_call{
            position: absolute;
            bottom: 5px;
            background-color: #2b2d31;
            height: calc(100% - 93%);
            width: 100%;
            /* margin-left:2%; */
            border-radius: 5px;
        }

        /* ============== Div data Right ================*/

        .card_data{
            background-color: white;
            max-width: 35%;
            width: 25%;
            height: calc(90%);
            padding: 20px;
            border-radius: 15px;
            box-shadow: 0 4px 4px 0 rgba(0, 0, 0, 0.15), 0 4px 10px 0 rgba(0, 0, 0, 0.15);
        }

        #div_data_right{
            position:absolute;
            z-index: 5;
            top: 1%;
            right: -1%;
        }

        .active_div_data_right{
            animation: show_div_data_right 0.5s ease 0s 1 normal forwards;
        }


        .Inactive_div_data_right{
            animation: hide_div_data_right 0.5s ease 0s 1 normal forwards;
        }

        @keyframes hide_div_data_right {
            0% {
                transform: translateX(0%);
            }

            100% {
                transform: translateX(100%);
            }
        }

        @keyframes show_div_data_right {
            0% {
                transform: translateX(100%);
            }

            100% {
                transform: translateX(0%);
            }
        }

        .profile-picture {
            border: none;
            border-radius: 50%;
            width: 30px;
            height: 30px;
            display: flex;
            justify-content: center;
            align-items: center;
            position: relative;
            margin: 5px;
            top: 0; /* ตำแหน่ง list ขึ้นด้านบนของปุ่ม */
            left: 0;
            border:#fff 1px solid;
        }

        .profile-info {
            /* width: 40%; */
            overflow: hidden;
            display: flex;
            align-items: center;
        }

        .profile-info p {
            margin: 0;
            text-overflow: ellipsis;
            overflow: hidden;
            white-space: nowrap;
        }

        .button-container {
            width: 35%;
            display: flex;
            justify-content: space-between;
            margin-top: 20px;
        }

        .button {
            padding: 10px;
            background-color: #555;
            color: #fff;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        /* End Div data Right */

    /* } */
</style>
<!-- ใช้ในการเปลี่ยนสีสถานะ ของหน้านี้ -->
@php
    if(!empty($sos_data)){
        switch ($sos_data->status) {
            case 'เสร็จสิ้น':
                $color_text_status = "text-success";
                break;
            case 'รับแจ้งเหตุ':
                $color_text_status = "text-danger";
                break;
            default:
                $color_text_status = "text-warning";
                break;
        }
    }

@endphp

<div id="alert_warning" class="div_alert" role="alert">
    <span id="alert_text">
        <!-- ใช้ javascript กำหนด innerHTML-->
    </span>
</div>

<!-- ========================================== layout video call ========================================== -->
<div class="d-flex justify-content-center align-items-center">
    <div id="lds-ring" class="lds-ring"><div></div><div></div><div></div><div></div></div>
</div>
<div class="row full-height" style="position: relative;overflow: hidden;width: 100%;">
    <!-- สำหรับ loading ก่อนเข้า videocall -> จะลบออกหลังจากโหลดเสร็จ -->

	{{-- <div class="Scenary"></div> --}}
	<div class="col-12 col-md-2" style="background-color: #2b2d31;">
        <button id="join" class="btn btn-success d-none" >เข้าร่วม</button>

		<div class="data-sos text-center p-3 d-flex  row">
            @if ($type == "sos_1669")
                <div class="" >
                    <div class="head_sidebar_div text-center mb-2">
                        @if (Auth::user()->role == "partner")
                            @if (!empty($sos_data->code_for_officer))
                                <p class="h4 text-dark mt-3 font-weight-bold">{{$sos_data->code_for_officer ? $sos_data->code_for_officer : "--"}}</p>
                            @else
                                <p class="h4 text-dark mt-3 font-weight-bold">{{$sos_data->operating_code ? $sos_data->operating_code : "--"}}</p>
                            @endif
                        @else
                            <p class="h4 text-dark mt-3 font-weight-bold">{{$sos_data->operating_code ? $sos_data->operating_code : "--"}}</p>
                        @endif

                        <p class="h5 text-dark ">สถานะ:
                            <a class="{{$color_text_status}} font-weight-bold">{{$sos_data->status ? $sos_data->status : "--"}}</a>
                        </p>

                        @php
                            if( !empty($sos_data->created_sos)){
                                $currentdate = date('H:i:s'); // เวลาปัจจุบันในรูปแบบ "H:i:s"
                                $sos_data_time_command = strtotime($sos_data->created_sos); // แปลง $sos_data->time_create_sos เป็น timestamp
                                $sos_data_timeDifference = abs( $sos_data_time_command - strtotime($currentdate) );

                                if ($sos_data_timeDifference >= 86400) { // ถ้าเกิน 1 วัน (86400 วินาที)
                                    $sos_data_days = floor($sos_data_timeDifference / 86400);
                                    $sos_data_hours = floor(($sos_data_timeDifference % 86400) / 3600);

                                    $sos_data_time_unit = $sos_data_days . ' วัน ' . $sos_data_hours . ' ชั่วโมง ';

                                }elseif ($sos_data_timeDifference >= 3600) {
                                    $sos_data_hours = floor($sos_data_timeDifference / 3600);
                                    $sos_data_remainingMinutes = floor(($sos_data_timeDifference % 3600) / 60);
                                    $sos_data_remainingSeconds = $sos_data_timeDifference % 60;

                                    $sos_data_time_unit = $sos_data_hours . ' ชั่วโมง ' . $sos_data_remainingMinutes . ' นาที ' . $sos_data_remainingSeconds . ' วินาที';
                                } elseif ($sos_data_timeDifference >= 60) {
                                    $sos_data_minutes = floor($sos_data_timeDifference / 60);
                                    $sos_data_seconds = $sos_data_timeDifference % 60;

                                    $sos_data_time_unit = $sos_data_minutes . ' นาที ' . $sos_data_seconds . ' วินาที';
                                } else {
                                    $sos_data_time_unit = $sos_data_timeDifference . ' วินาที';
                                }
                            }else{
                                $sos_data_time_unit  = "--";
                            }
                        @endphp

                        <p class="h6 text-dark ">การช่วยเหลือผ่านไปแล้ว</p>
                        @if (!empty($sos_data_time_unit))
                            <p class="h5 text-dark font-weight-bold">{{$sos_data_time_unit}}</p>
                        @else
                        <p class="h5 text-dark "> -- </p>
                        @endif

                    </div>

                    <div class="neck_sidebar_div text-center mt-0 mb-2">
                        <p class="h5 text-dark mt-3 font-weight-bold">ผู้ขอความช่วยเหลือ</p>
                        <p class="h5 text-dark ">{{$sos_data->name_user ? $sos_data->name_user : "--"}}</p>
                        <p class="h6 text-dark font-weight-bold">{{$sos_data->phone_user ? $sos_data->phone_user : "--"}}</p>
                    </div>

                    <div class="body_sidebar_div mb-2 ">
                        <div class="d-flex text-center justify-content-center">
                            @php
                                switch ($sos_data->idc) {
                                    case 'แดง(วิกฤติ)':
                                        $bg_idc = "#db2d2e";
                                        $text_idc = "แดง";
                                        break;
                                    case 'เหลือง(เร่งด่วน)':
                                        $bg_idc = "#ffc30e";
                                        $text_idc = "เหลือง";
                                        break;
                                    case 'เขียว(ไม่รุนแรง)':
                                        $bg_idc = "#29cc39";
                                        $text_idc = "เขียว";
                                        break;
                                    case 'ขาว(ทั่วไป)':
                                        $bg_idc = "#0d6efd";
                                        $text_idc = "ขาว";
                                        break;
                                    case 'ดำ(รับบริการสาธารณสุขอื่น)':
                                        $bg_idc = "#000000";
                                        $text_idc = "ดำ";
                                        break;
                                    default:
                                        $bg_idc = "#000000";
                                        $text_idc = "--";
                                        break;
                                }


                                switch ($sos_data->rc) {
                                    case 'แดง(วิกฤติ)':
                                        $bg_rc = "#db2d2e";
                                        $text_rc = "แดง";
                                        break;
                                    case 'เหลือง(เร่งด่วน)':
                                        $bg_rc = "#ffc30e";
                                        $text_rc = "เหลือง";
                                        break;
                                    case 'เขียว(ไม่รุนแรง)':
                                        $bg_rc = "#29cc39";
                                        $text_rc = "เขียว";
                                        break;
                                    case 'ขาว(ทั่วไป)':
                                        $bg_rc = "#0d6efd";
                                        $text_rc = "ขาว";
                                        break;
                                    case 'ดำ(รับบริการสาธารณสุขอื่น)':
                                        $bg_rc = "#000000";
                                        $text_rc = "ดำ";
                                        break;
                                    default:
                                        $bg_rc = "#000000";
                                        $text_rc = "--";
                                        break;
                                }
                            @endphp
                            <p style="background-color: {{$bg_idc}};" class=" p-2 m-1 col-5 border-radius font-weight-bold">IDC <br> {{$text_idc ? $text_idc : "--"}}</p>
                            <p style="background-color: {{$bg_rc}};" class=" p-2 m-1 col-5 border-radius font-weight-bold">RC <br> {{$text_rc ? $text_rc : "--"}}</p>
                        </div>
                        <div class="p-3 nowordwarp text-start">
                            <p class="h5 text-dark mt-1 font-weight-bold">รายละเอียดสถานที่</p>
                            <p class="h6 text-dark ">{{$sos_data->location_sos ? $sos_data->location_sos : "--"}}</p>
                            <hr>
                            <p class="h5 text-dark mt-1 font-weight-bold">อาการ</p>
                            <p class="h6 text-dark ">{{$sos_data->symptom ? $sos_data->symptom : "--"}}</p>
                            <hr>
                            <p class="h5 text-dark mt-1 font-weight-bold">รายละเอียดอาการ</p>
                            <p class="h6 text-dark ">{{$sos_data->symptom_other ? $sos_data->symptom_other : "--"}}</p>
                        </div>
                    </div>
                </div>
            @elseif ($type == "sos_map")
                <div class="" >
                    <div class="head_sidebar_div text-center mb-2">
                        <h5 class="mb-0 text-info font-weight-bold">
                            <i class="fa-solid fa-user-injured me-1 text-info"></i>ผู้ขอความช่วยเหลือ
                        </h5>
                        <p class="text-dark d-flex justify-content-center align-items-center font-weight-bold">{{$sos_data->name ? $sos_data->name : "--"}} | {{$sos_data->phone ? $sos_data->phone : "--"}}</p>
                    </div>

                    <div class="neck_sidebar_div text-center mt-0 mb-2">
                        <h5 class="mb-0 text-danger font-weight-bold">
                            <i class="fa-solid fa-subtitles me-1 text-danger"></i>ข้อมูล
                        </h5>

                        <div  class="d-flex align-items-center">
                            @if ($sos_data->title_sos)
                                <p style="white-space: pre-line;" class="text-dark mb-2 font-weight-bold text-start">หัวข้อ : <b class="text-dark">{{$sos_data->title_sos ? $sos_data->title_sos : "--"}}</b></p>
                            @else
                                <p style="white-space: pre-line;" class="text-dark mb-2 font-weight-bold text-start">หัวข้อ : <b class="text-dark">--</b> </p>
                            @endif
                        </div>
                        <div  class="d-flex align-items-center">
                            @if ($sos_data->title_sos_other)
                                <p style="white-space: pre-line;" class="text-dark mb-2 font-weight-bold text-start">รายละเอียด : {{$sos_data->title_sos_other ? $sos_data->title_sos_other : "--"}} </p>
                            @else
                                <p style="white-space: pre-line;" class="text-dark mb-2 font-weight-bold text-start">รายละเอียด : -- </p>
                            @endif
                        </div>
                        <div  class="d-flex align-items-center">
                            @if ($sos_data->status)
                                <p id="status_of_Room" style="white-space: pre-line;" class="text-dark mb-2 font-weight-bold text-start">สถานะ : <b class="{{$color_text_status}}">{{$sos_data->status ? $sos_data->status : "--"}}</b></p>
                            @else
                                <p id="status_of_Room" style="white-space: pre-line;" class="text-dark mb-2 font-weight-bold text-start">สถานะ : -- </p>
                            @endif
                        </div>
                        <div  class="d-flex align-items-center">
                            @if ($sos_data->lat)
                                <p style="white-space: pre-line;" class="text-dark mb-2 font-weight-bold text-start">Lat : {{$sos_data->lat ? $sos_data->lat : "--"}}</p>
                            @else
                                <p style="white-space: pre-line;" class="text-dark mb-2 font-weight-bold text-start">Lat : -- </p>
                            @endif
                        </div>
                        <div  class="d-flex align-items-center">
                            @if ($sos_data->lng)
                                <p style="white-space: pre-line;" class="text-dark mb-2 font-weight-bold text-start">Long : {{$sos_data->lng ? $sos_data->lng : "--"}}</p>
                            @else
                                <p style="white-space: pre-line;" class="text-dark mb-2 font-weight-bold text-start">Long : -- </p>
                            @endif
                        </div>

                        <center>
                            <hr class="text-dark">
                            <div class="accordion" id="accordion_Forward_sos">
                                <div class="accordion-item">
                                    <h2 class="accordion-header" id="headingOne">
                                        <button type="button" class="btn btn-info p-2 mt-2" style="width:90%;" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                            <i class="fa-sharp fa-solid fa-share mr-1"></i>เลือกการส่งต่อ
                                        </button>
                                    </h2>
                                    <div id="collapseOne" class="accordion-collapse collapse mt-2" aria-labelledby="headingOne" data-bs-parent="#accordion_Forward_sos">
                                        <div class="accordion-body">

                                            <span id="btn_ask_1669" class="main-shadow btn btn-md btn-block d-none"  style="font-family: 'Kanit', sans-serif;border-radius:10px;color:white;background-color:#780908;" data-toggle="modal" data-target="#modal_sos_1669">
                                                <div class="d-flex">
                                                    <div class="col-3 p-0 d-flex align-items-center">
                                                        <div class="justify-content-center col-12 p-0">
                                                            <img src="{{ asset('/img/logo-partner/niemslogo.png') }}" width="70%" style="border:white solid 3px;border-radius:50%">
                                                        </div>
                                                    </div>
                                                    <div class="d-flex align-items-center col-9 text-center">
                                                        <div id="content_1669" class="justify-content-center col-12">
                                                            @if(empty($sos_data->sos_1669_id))
                                                            <b>
                                                                <span class="d-block" style="color: #ffffff; font-size:0.8em;">แพทย์ฉุกเฉิน (1669)</span>
                                                                <span id="name_1669_area" class="d-block" style="color: #ffffff; font-size:0.7em;"></span>
                                                            </b>
                                                            @else
                                                            <b>
                                                                <span class="d-block" style="color: #ffffff;">ส่งต่อ 1669 แล้ว</span>
                                                            </b>
                                                            @endif
                                                        </div>

                                                    </div>
                                                </div>
                                            </span>
                                            <hr class="text-dark">
                                            <label class="text-dark">หมายเลขโทรศัพท์ <br>ศูนย์รับแจ้งเหตุและสั่งการจังหวัดต่างๆ</label>
                                            <div id="content_phone_niems" class="mt-2 text-dark"></div>

                                            <div class="d-none">
                                                <input type="text" name="name" id="name" value="{{ $sos_data->name }}">
                                                <input type="text" name="phone" id="phone" value="{{ $sos_data->phone }}">
                                                <input type="text" name="user_id" id="user_id" value="{{ $sos_data->user_id }}">
                                                <input type="text" name="lat" id="lat" value="{{ $sos_data->lat }}">
                                                <input type="text" name="lng" id="lng" value="{{ $sos_data->lng }}">
                                                <input type="text" name="photo_sos_1669" id="photo_sos_1669" value="{{ $sos_data->photo }}">
                                            </div>

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </center>

                    </div>

                    @if(!empty($sos_data->helper_id))
                        <!-- ข้อมูลเจ้าหน้าที่ -->
                        <div class="body_sidebar_div text-center">
                            <h5  class="mb-0 text-success font-weight-bold">
                                <i class="fa-solid fa-user me-1 text-success"></i>ข้อมูลเจ้าหน้าที่
                            </h5>
                            <p  class="font-weight-bold text-dark">{{$sos_data->user_helper->name ? $sos_data->user_helper->name : "--"}} | {{$sos_data->user_helper->phone ? $sos_data->user_helper->phone : "--"}}</p>
                        </div>
                    @endif

                </div>

            @elseif ($type == "sos_personal_assistant")
                <div class="" >

                    <div class="head_sidebar_div text-center mb-2">
                        <div id="sos_assistant_map"></div>
                    </div>

                    <!-- รายละเอียดสถานที่ -->
                    <div class="neck_sidebar_div text-center mb-2">
                        <h5 class="mb-0 text-info font-weight-bold">
                            <i class="fa-solid fa-user-injured me-1 text-info"></i>รายละเอียดสถานที่
                        </h5>
                        <p class="text-dark d-flex justify-content-center align-items-center font-weight-bold"> ------------------------------------------------------- </p>
                    </div>

                    <!-- อาการ -->
                    <div class="body_sidebar_div text-center mb-2">
                        <h5  class="mb-0 text-success font-weight-bold">
                            <i class="fa-solid fa-user me-1 text-success"></i>อาการ
                        </h5>
                        <p  class="font-weight-bold text-dark">-------------------------------------------------------</p>
                    </div>

                    <!-- รูปภาพ -->
                    <div class="body_sidebar_div text-center">
                        <img src="https://picsum.photos/70" height="200px">
                    </div>

                </div>
            @endif
		</div>

        <div class="d-flex overflow_auto_video_call row py-3" style="background-color: #2b2d31;">
				<div id="video_call_sidebar" class="align-self-end w-100">

                    <div class="dropcontent">
                        <ul id="audio-device-list" class="ui-list">
                            <!-- Created list-audio from Javascript Here -->
                        </ul>
                    </div>
                    <div class="dropcontent2">
                        <ul id="video-device-list" class="ui-list">
                            <!-- Created list-video from Javascript Here -->
                        </ul>
                    </div>

				</div>
			</div>
	</div>

	<div class="col-12 col-md-10 full-height d-flex">
		<div class="video-call row w-100">
            <div class="col-12 my-auto">

                <div class="d-flex align-self-center">
                    <div class="row" id="container_user_video_call">
                        <!--  วิดีโอคอล tag ถูกสร้างในนี้-->
                    </div>
                </div>


				<!-- <div class="bg-success test col">user4</div> -->
				<div class="w-100 user-video-call-contrainer d-none">
					<div class="d-flex justify-content-center align-self-end d-non user-video-call-bar">
						<!--  วิดีโอคอล tag ถูกสร้างในนี้-->
					</div>
                    <button class="btn-show-hide-user-video-call btn" style="z-index: 25 " onclick="toggleUserVideoCallBar();">
                        <i id="icon_show_hide" class="fa-duotone fa-chevrons-down"></i>
                        <span id="text_show_hide"> ซ่อน</span>
                    </button>

					{{-- <button class="btn-show-hide-user-video-call btn" style="z-index: 2" onclick="document.querySelector('.user-video-call-bar').classList.toggle('d-none');">ซ่อน</button> --}}
				</div>

                <!-- DIV ขวา -->
                <div id="div_data_right" class="card_data Inactive_div_data_right">

                    <div class="card-body">
                        <h4>ผู้เข้าร่วมประชุม</h4>
                        <hr>

                        <div id="users_in_sidebar">

                        </div>

                    </div>
                </div>

            </div>

            <div class="col-12 " style="position: relative;">
                    <div class="d-flex justify-content-between align-items-center bg-dark p-1 w-100" style="border-radius:5px; position: absolute; bottom:5px;">
                        <div class="p-1 " style="color: #ffffff;" id="time_of_room"></div>
                        <div class="d-flex justify-content-center">
                            <!-- เปลี่ยนไมค์ ให้กดได้แค่ในคอม -->
                            <div id="div_for_AudioButton" class="btn btnSpecial " >
                                {{-- <i id="icon_muteAudio" class="fa-solid fa-microphone-stand"></i> --}}
                                <button class="smallCircle" id="btn_switchMicrophone">
                                    <i class="fa-sharp fa-solid fa-angle-up"></i>
                                </button>
                            </div>

                            <!-- เปลี่ยนกล้อง ให้กดได้แค่ในคอม -->
                            <div id="div_for_VideoButton" class="btn btnSpecial " >
                                {{-- <i id="icon_muteVideo" class="fa-solid fa-camera-rotate"></i> --}}
                                <button class="smallCircle" id="btn_switchCamera">
                                    <i class="fa-sharp fa-solid fa-angle-up"></i>
                                </button>
                            </div>
                            @if (Auth::user()->id == 1 || Auth::user()->id == 2 || Auth::user()->id == 64 || Auth::user()->id == 11003429 || Auth::user()->id == 11003473)
                                <div class="btn btnSpecial btn_leave d-none" id="addButton">
                                    <i class="fa-solid fa-plus" style="color: #ffffff;"></i>
                                </div>
                            @endif
                            <div class="btn btnSpecial btn_leave" id="leave">
                                <i class="fa-solid fa-phone-xmark" style="color: #ffffff;"></i>
                            </div>

                            {{-- <button class="btn btnSpecial " onclick="alertText()">
                                <i class="fa-solid fa-plus" style="color: #ffffff;"></i>
                            </button>
                            <script>
                                function alertText(){
                                    document.querySelector('#alert_copy').classList.add('up_down');

                                    const animated = document.querySelector('.up_down');
                                    animated.onanimationend = () => {
                                        document.querySelector('#alert_copy').classList.remove('up_down');
                                    };
                                }
                            </script> --}}
                        </div>
                        <div class="p-1">
                            <i id="user_right_data" class="fa-regular fa-users" style="color: #ffffff; font-size: 30px;" onclick="hide_or_show_Div('show', 'right');"></i>
                        </div>
                    </div>

            </div>

		</div>
	</div>

</div>

<!-- ========================================== javascript ========================================== -->

<script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
<script src="{{ asset('Agora_Web_SDK_FULL/AgoraRTC_N-4.17.0.js') }}"></script>

<!-- Google Map -->
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBgrxXDgk1tgXngalZF3eWtcTWI-LPdeus&language=th"></script>

<!-- Bootstrap JS -->
<script src="{{ asset('partner_new/js/bootstrap.bundle.min.js') }}"></script>
<!--plugins-->
<script src="{{ asset('partner_new/js/jquery.min.js') }}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.3/umd/popper.min.js" integrity="sha384-vFJXuSJphROIrBnz7yo7oB41mKfc8JzQZiCq4NCceLEaO4IHwicKwpJf9c9IpFgh" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/js/bootstrap.min.js" integrity="sha384-alpBpkh1PFOepccYVYDB4do5UnbKysX5WZXm3XxPqe5iKTfUKjNkCk9SaVuEZflJ" crossorigin="anonymous"></script>

{{-- <script src="{{ asset('js/for_video_call_4/resize_div_video_call.js') }}"></script> --}}
<script src="{{ asset('js/for_video_call_4/video_call_4.js') }}"></script>

<script>
    var options;
    // ใช้สำหรับ เช็คสถานะของปุ่มเปิด-ปิด วิดีโอและเสียง
    var isVideo = true;
    var isAudio = true;

    // ใช้สำหรับ เช็คสถานะของปุ่มเปิด-ปิด วิดีโอและเสียง ตอนเริ่มเข้าวิดีโอคอล
    var videoTrack = '{{$videoTrack}}';
    var audioTrack = '{{$audioTrack}}';

    var useSpeaker = '{{$useSpeaker}}';
    var useMicrophone = '{{$useMicrophone}}';
    var useCamera = '{{$useCamera}}';

    //สำหรับกำหนดสี background localPlayerContainer
    var bg_local;
    var name_local;
    var type_local;
    var profile_local;

    // ใช้สำหรับ เช็ค icon
    var isRemoteIconSound = false;

    // ใช้สำหรับ เช็คไม่ให้ฟังก์ชันออกห้องทำงานซ้ำ
    var leaveChannel = "false";

    // เกี่ยวกับเวลาในห้อง
    var check_start_timer_video_call = false;
    var check_user_in_video_call = false;
    // var hours = 0;
    // var minutes = 0;
    // var seconds = 0;
    var meet_2_people = 'No' ;

    // เรียกสองอันเพราะไม่อยากไปยุ่งกับโค้ดเก่า
    var user_id = '{{ Auth::user()->id }}';
    var user_data = @json(Auth::user());

    var agora_id = '{{ $data_agora->id}}';
    var sos_id = '{{ $sos_id }}';
    var type_video_call = '{{ $type }}';

    // var appId = '{{ env("AGORA_APP_ID") }}';
    // var appCertificate = '{{ env("AGORA_APP_CERTIFICATE") }}';

    var remoteVolume = localStorage.getItem('remote_rangeValue') ?? 70; // ค่าสำหรับเลือกระดับเสียงที่ได้ยินจากทุกคน
    var array_remoteVolumeAudio = [];

    var agoraEngine;

    var checkHtml = false; // ใช้เช็คเงื่อนไขตัวปรับเสียงของ remote

    var type_user_sos;

    document.addEventListener('DOMContentLoaded', (event) => {

        if (type_video_call == "sos_personal_assistant") {
            initMap();
        }

        var appId = sessionStorage.getItem('a');
        var appCertificate = sessionStorage.getItem('b');

        // สลับตำแหน่ง appId และ appCertificate
        function swapValues(value1, value2) {
            return {
                agoraAppId: value1.split('').reverse().join(''),
                agoraAppCertificate: value2.split('').reverse().join('')
            };
        }

        // สลับตำแหน่ง appId และ appCertificate
        const swappedValues = swapValues(appId, appCertificate);

        // กำหนดค่าที่ถูกสลับกลับไปที่ตัวแปรเดิม
        appId = swappedValues.agoraAppId;
        appCertificate = swappedValues.agoraAppCertificate;

        if (!appId || !appCertificate) {
            appId = '{{ env("AGORA_APP_ID") }}';
            appCertificate = '{{ env("AGORA_APP_CERTIFICATE") }}';
        }

        options =
        {
            // Pass your App ID here.
            appId: appId,
            // Set the channel name.
            channel: type_video_call+sos_id,
            // Pass your temp token here.
            token: '',
            // Set the user ID.
            uid: user_id,

            role: '',
        };

        function LoadingVideoCall() {
            const loadingAnime = document.getElementById('lds-ring');

            setTimeout(() => {
                //หลังจากสร้าง localPlayerContainer เสร็จให้เอา animation loading ออก
                if(loadingAnime){
                    loadingAnime.classList.remove('d-none');
                }
                fetch("{{ url('/') }}/api/video_call_4" + "?user_id=" + user_id + '&appCertificate=' + appCertificate  + '&appId=' + appId + '&type=' + type_video_call + '&sos_id=' + sos_id)
                    .then(response => response.json())
                    .then(result => {
                        console.log("GET Token success");

                        options['token'] = result['token'];

                        // ตั้งค่าเวลาที่ต้องการให้แจ้งเตือน
                        const expirationTimestamp = result['privilegeExpiredTs']; // เปลี่ยนเป็นเวลาที่คุณต้องการ
                        // เริ่มตรวจสอบเวลาและแจ้งเตือนในระยะเวลาที่กำหนด
                                        // ห้องหมดเวลา
                        function checkAndNotifyExpiration(expirationTimestamp) {
                            const currentTimestamp = Math.floor(Date.now() / 1000); // แปลงเป็น timestamp ในรูปแบบวินาที

                            if (currentTimestamp >= expirationTimestamp) {
                                // เวลาหมดแล้ว ให้แสดงข้อความแจ้งเตือนหรือทำการแจ้งเตือนผ่านทาง UI ตามที่คุณต้องการ
                                document.getElementById('leave').click();
                            }
                        }

                        setInterval(() => {
                            checkAndNotifyExpiration(expirationTimestamp);
                        }, 1000);

                        setTimeout(() => {
                            document.getElementById("join").click();
                        }, 1000); // รอเวลา 1 วินาทีก่อนเรียกใช้งาน

                })
                .catch(error => {

                    if(loadingAnime){
                        loadingAnime.classList.remove('d-none');
                    }

                    // เรียกใช้งานฟังก์ชัน retryFunction() อีกครั้งหลังจากเวลาหน่วงให้ผ่านไป
                    setTimeout(() => {
                        LoadingVideoCall();
                    }, 2000);
                });

            }, 1000);

        }

        //แสดง animation โหลด
        LoadingVideoCall();
        //เริ่มทำการสร้าง channel Video_call
        startBasicCall();
        //หาตำแหน่งของผู้ใช้ --> แสดงข้อมูล sos_map ตามจังหวัด
        if(type_video_call === "sos_map"){
            find_location();
        }

    });

    let channelParameters =
    {
        // A variable to hold a local audio track.
        localAudioTrack: null,
        // A variable to hold a local video track.
        localVideoTrack: null,
        // A variable to hold a remote audio track.
        remoteAudioTrack: null,
        // A variable to hold a remote video track.
        remoteVideoTrack: null,
        // A variable to hold the remote user id.s
        remoteUid: null,
    };

    async function startBasicCall()
    {
        // Create an instance of the Agora Engine

        agoraEngine = AgoraRTC.createClient({ mode: "rtc", codec: "vp9" });
        // console.log("agoraEngine");
        // console.log(agoraEngine);
        let rtcStats = agoraEngine.getRTCStats();
        // console.log("rtcStats");
        // console.log(rtcStats);

        agoraEngine.enableAudioVolumeIndicator(); // เปิดตัวตรวจับระดับเสียงไมค์

        /////////////////////// ปุ่มสลับ กล้อง /////////////////////
        const btn_switchCamera = document.querySelector('#btn_switchCamera');
        /////////////////////// ปุ่มสลับ ไมค์ /////////////////////
        const btn_switchMicrophone = document.querySelector('#btn_switchMicrophone');

        let remotePlayerContainer = [];

        let localPlayerContainer = document.createElement('div');
        // Specify the ID of the DIV container. You can use the uid of the local user.
        localPlayerContainer.id = options.uid;

        // Set the local video container size.
        localPlayerContainer.style.backgroundColor = "gray";
        localPlayerContainer.style.width = "100%";
        localPlayerContainer.style.height = "100%";
        localPlayerContainer.style.position = "absolute";
        localPlayerContainer.style.left = "0";
        localPlayerContainer.style.top = "0";
        localPlayerContainer.classList.add('agora_create_local');

        if(user_data.photo){
            profile_local = "{{ url('/storage') }}" + "/" + user_data.photo;
        }else if(!user_data.photo && user_data.avatar){
            profile_local = user_data.avatar;
        }else{
            profile_local = "https://www.viicheck.com/Medilab/img/icon.png";
        }
        //===== สุ่มสีพื้นหลังของ localPlayerContainer=====
        fetch("{{ url('/') }}/api/get_local_data_4" + "?user_id=" + options.uid + "&type=" + type_video_call + "&sos_id=" + sos_id)
            .then(response => response.json())
            .then(result => {
                // console.log("result get_local_data_4");
                // console.log(result);
                bg_local = result.hexcolor;
                name_local = result.name_user;
                type_local = result.user_type;

                type_user_sos = type_local; //เก็บ ประเภทผู้ใช้ไว้ใน array

                changeBgColor(bg_local);
        })
        .catch(error => {
            console.log("โหลดข้อมูล LocalUser ล้มเหลว ใน get_local_data_4");
        });
        //===== จบส่วน สุ่มสีพื้นหลังของ localPlayerContainer =====


        // Listen for the "user-published" event to retrieve a AgoraRTCRemoteUser object.
        agoraEngine.on("user-published", async (user, mediaType) =>
        {
            await agoraEngine.subscribe(user, mediaType);
            console.log("subscribe success");
            // console.log("user");
            // console.log(user);

            // setTimeout(() => {
            //     StatsVideoUpdate();
            // }, 2500);

            // Set the remote video container size.
            remotePlayerContainer[user.uid] = document.createElement("div");
            remotePlayerContainer[user.uid].style.backgroundColor = "black";
            remotePlayerContainer[user.uid].style.width = "100%";
            remotePlayerContainer[user.uid].style.height = "100%";
            remotePlayerContainer[user.uid].style.position = "absolute";
            remotePlayerContainer[user.uid].style.left = "0";
            remotePlayerContainer[user.uid].style.top = "0";

            // ตรวจสอบว่า user.uid เป็นไอดีของ remote user ที่คุณเลือก
            // if (mediaType == "video" && user.videoTrack)
            if (mediaType == "video")
            {
                channelParameters.remoteVideoTrack = user.videoTrack;
                channelParameters.remoteAudioTrack = user.audioTrack;

                console.log("============== channelParameters.remoteVideoTrack ใน published  ==================");
                console.log(channelParameters.remoteVideoTrack);

                channelParameters.remoteUid = user.uid.toString();
                remotePlayerContainer[user.uid].id = user.uid.toString();

                //======= สำหรับสร้าง div ที่ใส่ video tag พร้อม id_tag สำหรับลบแท็ก ========//
                let name_remote;
                let type_remote;

                fetch("{{ url('/') }}/api/get_remote_data_4" + "?user_id=" + user.uid + "&type=" + type_video_call + "&sos_id=" + sos_id)
                    .then(response => response.json())
                    .then(result => {
                        // console.log("result published");
                        // console.log(result);

                        bg_remote = result.hexcolor;
                        name_remote = result.name_user;
                        type_remote = result.user_type;

                        // bg_remote = "#2b2d31";
                        // name_remote = "guest";
                        // type_remote = "guest";

                        console.log("โหลดข้อมูล RemoteUser สำเร็จ published");

                        // สำหรับ สร้าง divVideo ตอนผู้ใช้เปิดกล้อง
                        create_element_remotevideo_call(remotePlayerContainer[user.uid], name_remote, type_remote , bg_remote ,user);

                        channelParameters.remoteVideoTrack.play(remotePlayerContainer[user.uid]);
                        // Set a stream fallback option to automatically switch remote video quality when network conditions degrade.
                        agoraEngine.setStreamFallbackOption(channelParameters.remoteUid, 1);
                })
                .catch(error => {
                    console.log("โหลดข้อมูล RemoteUser ล้มเหลว published");
                });

                if(user.hasVideo == false){
                    // เปลี่ยน ไอคอนวิดีโอเป็น ปิด
                    document.querySelector('#camera_remote_' + user.uid).innerHTML = '<i class="fa-duotone fa-video-slash" style="--fa-primary-color: #ff0000; --fa-secondary-color: #ffffff; --fa-secondary-opacity: 1;"></i>';
                }else{
                    // เปลี่ยน ไอคอนวิดีโอเป็น เปิด
                    document.querySelector('#camera_remote_' + user.uid).innerHTML = '<i class="fa-solid fa-video"></i>';
                }

                if(user.hasAudio == false){
                    // เปลี่ยน ไอคอนไมโครโฟนเป็น ปิด
                    document.querySelector('#mic_remote_' + user.uid).innerHTML = '<i class="fa-duotone fa-microphone-slash" style="--fa-primary-color: #ff0000; --fa-secondary-color: #ffffff; --fa-secondary-opacity: 1;"></i>';
                }else{
                    // เปลี่ยน ไอคอนไมโครโฟนเป็น เปิด
                    document.querySelector('#mic_remote_' + user.uid).innerHTML = '<i class="fa-solid fa-microphone"></i>';
                }

                // channelParameters.remoteVideoTrack.play(remotePlayerContainer);

                // Set a stream fallback option to automatically switch remote video quality when network conditions degrade.
                agoraEngine.setStreamFallbackOption(channelParameters.remoteUid, 1);

            }

            if (mediaType == "audio")
            {
                channelParameters.remoteAudioTrack = user.audioTrack;
                channelParameters.remoteAudioTrack.play();

                channelParameters.remoteAudioTrack.setVolume(parseInt(array_remoteVolumeAudio[user.uid]));

                if(user.hasAudio == false){
                    // เปลี่ยน ไอคอนไมโครโฟนเป็น ปิด
                    if (document.querySelector('#mic_remote_' + user.uid)) {
                        document.querySelector('#mic_remote_' + user.uid).innerHTML = '<i class="fa-duotone fa-microphone-slash" style="--fa-primary-color: #ff0000; --fa-secondary-color: #ffffff; --fa-secondary-opacity: 1;"></i>';
                    }else{
                        console.log("========================= ");
                        console.log("ไมค์ตาย");
                        console.log("=========================");
                    }
                }else{
                    // เปลี่ยน ไอคอนไมโครโฟนเป็น เปิด
                    if (document.querySelector('#mic_remote_' + user.uid)) {
                        document.querySelector('#mic_remote_' + user.uid).innerHTML = '<i class="fa-solid fa-microphone"></i>';
                    }else{
                        console.log("========================= ");
                        console.log("ไมค์ตาย");
                        console.log("=========================");
                    }
                }

                let type_of_microphone = "open";
                waitForElement_in_sidebar(type_of_microphone,user.uid); // รอจนกว่าจะมี icon ของไอดีนี้ใน sidebar และ เปลี่ยนไอคอน

                //ตรวจจับเสียงพูดแล้ว สร้าง animation บนขอบ div
                // agoraEngine.on("volume-indicator", volumes => {
                //     volumes.forEach((volume, index) => {
                //         console.log("volume in published");
                //         if (user.uid == volume.uid && volume.level > 50) {
                //             console.log(`${index} UID ${volume.uid} Level ${volume.level}`);
                //             document.querySelector('#statusMicrophoneOutput_remote_'+ user.uid).classList.remove('d-none');
                //         } else if (user.uid == volume.uid && volume.level <= 50) {
                //             console.log(`${index} UID ${volume.uid} Level ${volume.level}`);
                //             document.querySelector('#statusMicrophoneOutput_remote_'+ user.uid).classList.add('d-none');
                //         }
                //     });
                // })
                status_remote_volume[user.uid] = "yes";
                if (check_start_volume_indicator[user.uid] == "no") {
                    volume_indicator_remote(user.uid);
                }

                // สร้าง function callback ที่จะใช้ในการประกาศตัวแปรเพื่อทำการ unsubscribe
                // function onVolumeIndicatorCallback(volume) {
                //     volume.forEach((volume, index) => {
                //         console.log("volume in published");
                //         if (channelParameters.remoteUid == volume.uid && volume.level > 50) {
                //             console.log(`${index} UID ${volume.uid} Level ${volume.level}`);
                //             document.querySelector('#statusMicrophoneOutput_remote_'+ channelParameters.remoteUid).classList.remove('d-none');
                //         } else if (channelParameters.remoteUid == volume.uid && volume.level <= 50) {
                //             console.log(`${index} UID ${volume.uid} Level ${volume.level}`);
                //             document.querySelector('#statusMicrophoneOutput_remote_'+ channelParameters.remoteUid).classList.add('d-none');
                //         }
                //     });
                // }

                // // Subscribe การเรียก callback function เมื่อเกิดเหตุการณ์ "volume-indicator"
                // agoraEngine.off("volume-indicator", onVolumeIndicatorCallback);
                // agoraEngine.on("volume-indicator", onVolumeIndicatorCallback);
            }

        });

        // Listen for the "user-unpublished" event.
        agoraEngine.on("user-unpublished", async (user, mediaType) =>
        {
            console.log("เข้าสู่ user-unpublished");
            console.log("agoraEngine");
            console.log(agoraEngine);

            if(mediaType == "video"){
                if (user.hasVideo == false) {

                    console.log("สร้าง Div_Dummy ของ" + user.uid);
                    console.log(user);

                    let name_remote_user_unpublished;
                    let type_remote_user_unpublished;
                    let profile_remote_user_unpublished;
                    let hexcolor;
                    fetch("{{ url('/') }}/api/get_remote_data_4" + "?user_id=" + user.uid + "&type=" + type_video_call + "&sos_id=" + sos_id)
                        .then(response => response.json())
                        .then(result => {
                            // console.log("result");
                            // console.log(result);
                            hexcolor = result.hexcolor;
                            // hexcolor = "#2b2d26";
                            name_remote_user_unpublished = result.name_user;
                            type_remote_user_unpublished = result.user_type;
                            // name_remote_user_unpublished = "guest";
                            // type_remote_user_unpublished = "guest";
                            if(result.photo){
                                profile_remote_user_unpublished = "{{ url('/storage') }}" + "/" + result.photo;
                            }else if(!result.photo && result.avatar){
                                profile_remote_user_unpublished = result.avatar;
                            }else{
                                profile_remote_user_unpublished = "https://www.viicheck.com/Medilab/img/icon.png";
                            }
                            // สำหรับ สร้าง div_dummy ตอนผู้ใช้ไม่ได้เปิดกล้อง
                            create_dummy_videoTrack(user ,name_remote_user_unpublished ,type_remote_user_unpublished ,profile_remote_user_unpublished, hexcolor);

                            // เปลี่ยน ไอคอนวิดีโอเป็น ปิด
                            if(user.hasVideo == false){
                                // เปลี่ยน ไอคอนวิดีโอเป็น ปิด
                                document.querySelector('#camera_remote_' + user.uid).innerHTML = '<i class="fa-duotone fa-video-slash" style="--fa-primary-color: #ff0000; --fa-secondary-color: #ffffff; --fa-secondary-opacity: 1;"></i>';
                            }else{
                                // เปลี่ยน ไอคอนวิดีโอเป็น เปิด
                                document.querySelector('#camera_remote_' + user.uid).innerHTML = '<i class="fa-solid fa-video"></i>';
                            }

                            if(user.hasAudio == false){
                                // เปลี่ยน ไอคอนไมโครโฟนเป็น ปิด
                                document.querySelector('#mic_remote_' + user.uid).innerHTML = '<i class="fa-duotone fa-microphone-slash" style="--fa-primary-color: #ff0000; --fa-secondary-color: #ffffff; --fa-secondary-opacity: 1;"></i>';
                            }else{
                                // เปลี่ยน ไอคอนไมโครโฟนเป็น เปิด
                                document.querySelector('#mic_remote_' + user.uid).innerHTML = '<i class="fa-solid fa-microphone"></i>';
                            }

                    })
                    .catch(error => {
                        console.log("โหลดข้อมูล RemoteUser ล้มเหลว");
                    });

                }
            }

            if(mediaType == "audio"){
                // ตรวจจับเสียงพูดแล้ว สร้าง animation บนขอบ div
                console.log('unpublished AudioTrack:');
                console.log(channelParameters.localAudioTrack);

                status_remote_volume[user.uid] = "no";

                let type_of_microphone = "close";
                waitForElement_in_sidebar(type_of_microphone,user.uid); // รอจนกว่าจะมี icon ของไอดีนี้ใน sidebar และ เปลี่ยนไอคอน

                if(user.hasAudio == false){
                    console.log("if unpublished");
                    // เปลี่ยน ไอคอนไมโครโฟนเป็น ปิด
                    document.querySelector('#mic_remote_' + user.uid).innerHTML = '<i class="fa-duotone fa-microphone-slash" style="--fa-primary-color: #ff0000; --fa-secondary-color: #ffffff; --fa-secondary-opacity: 1;"></i>';
                }else{
                    console.log("else unpublished");
                    // เปลี่ยน ไอคอนไมโครโฟนเป็น เปิด
                    document.querySelector('#mic_remote_' + user.uid).innerHTML = '<i class="fa-solid fa-microphone"></i>';
                }

                // agoraEngine.on("volume-indicator", volumes => {
                //     volumes.forEach((volume, index) => {
                //         console.log("volume in unpublished");
                //         if (user.uid == volume.uid && volume.level > 50) {
                //             console.log(`${index} UID ${volume.uid} Level ${volume.level}`);
                //             document.querySelector('#statusMicrophoneOutput_remote_'+ user.uid).classList.remove('d-none');
                //         } else if (user.uid == volume.uid && volume.level <= 50) {
                //             console.log(`${index} UID ${volume.uid} Level ${volume.level}`);
                //             document.querySelector('#statusMicrophoneOutput_remote_'+ user.uid).classList.add('d-none');
                //         }
                //     });
                // })

            }


        });

        // เมื่อมีคนเข้าห้อง
        agoraEngine.on("user-joined", function (evt)
        {
            check_start_volume_indicator[evt.uid] = "no";

            console.log("agoraEngine มีคนเข้าห้องมา");
            console.log(agoraEngine);

            // เสียงแจ้งเตือน เวลาคนเข้า
            let audio_ringtone_join = new Audio("{{ asset('sound/join_room_1.mp3') }}");
                audio_ringtone_join.play();

            // หยุดการเล่นเสียงหลังจาก 1 วินาที
            setTimeout(function() {
                audio_ringtone_join.pause();
                audio_ringtone_join.currentTime = 0; // เริ่มเสียงใหม่เมื่อต้องการเล่นอีกครั้ง
            }, 1000);

            if(agoraEngine['remoteUsers'][0]){
                if( agoraEngine['remoteUsers']['length'] != 0 ){
                    for(let c_uid = 0; c_uid < agoraEngine['remoteUsers']['length']; c_uid++){

                        const dummy_remote = agoraEngine['remoteUsers'][c_uid];
                        console.log(dummy_remote);

                        if(dummy_remote['hasVideo'] == false){ //ถ้า remote คนนี้ ไม่ได้เปิดกล้องไว้ --> ไปสร้าง div_dummy
                            let name_remote_user_joined;
                            let type_remote_user_joined;
                            let profile_remote_user_joined;
                            let hexcolor;
                            fetch("{{ url('/') }}/api/get_remote_data_4" + "?user_id=" + dummy_remote.uid + "&type=" + type_video_call + "&sos_id=" + sos_id)
                                .then(response => response.json())
                                .then(result => {
                                    // console.log("result");
                                    // console.log(result);
                                    name_remote_user_joined = result.name_user;
                                    type_remote_user_joined = result.user_type
                                    hexcolor = result.hexcolor;
                                    // hexcolor = "#2b2d26";
                                    // name_remote_user_unpublished = "guest";
                                    // type_remote_user_unpublished = "guest";
                                    if(result.photo){
                                        profile_remote_user_joined = "{{ url('/storage') }}" + "/" + result.photo;
                                    }else if(!result.photo && result.avatar){
                                        profile_remote_user_joined = result.avatar;
                                    }else{
                                        profile_remote_user_joined = "https://www.viicheck.com/Medilab/img/icon.png";
                                    }

                                    create_dummy_videoTrack(dummy_remote ,name_remote_user_joined ,type_remote_user_joined ,profile_remote_user_joined ,hexcolor);
                                    console.log("Dummy Created !!!");

                                    // สร้าง โปรไฟล์ใน sidebar =========== อยู่จนกว่าจะออกจากห้อง ======================

                                    let create_profile_remote = document.createElement("div");
                                        create_profile_remote.id = "profile_"+dummy_remote.uid;
                                        create_profile_remote.classList.add('row');

                                    let html_profile_user = create_profile_in_sidebar(dummy_remote ,name_remote_user_joined ,type_remote_user_joined ,profile_remote_user_joined,array_remoteVolumeAudio[dummy_remote.uid]);


                                    create_profile_remote.innerHTML = html_profile_user;

                                    // ตรวจสอบว่าเจอ div เดิมหรือไม่
                                    let oldDiv = document.getElementById("profile_"+ dummy_remote.uid);
                                    if (oldDiv) {
                                        // ใช้ parentNode.replaceChild() เพื่อแทนที่ div เดิมด้วย div ใหม่
                                        oldDiv.parentNode.replaceChild(create_profile_remote, oldDiv);
                                    } else {
                                        document.querySelector('#users_in_sidebar').appendChild(create_profile_remote);
                                    }

                                    // จบส่วน สร้าง โปรไฟล์ใน sidebar ===============================================

                                    // เปลี่ยน ไอคอนวิดีโอเป็น ปิด
                                    document.querySelector('#camera_remote_' + dummy_remote.uid).innerHTML = '<i class="fa-duotone fa-video-slash" style="--fa-primary-color: #ff0000; --fa-secondary-color: #ffffff; --fa-secondary-opacity: 1;"></i>';

                                    //เช็คว่าไมค์ของเขาเปิดหรือไม่
                                    if(dummy_remote['hasAudio'] == false){ //ถ้า remote คนนี้ ไม่ได้เปิดไมไว้ --> ไปสร้าง div_dummy
                                        status_remote_volume[dummy_remote.uid] = "no";
                                        // เปลี่ยน ไอคอนไมโครโฟนเป็น ปิด
                                        document.querySelector('#mic_remote_' + dummy_remote.uid).innerHTML = '<i class="fa-duotone fa-microphone-slash" style="--fa-primary-color: #ff0000; --fa-secondary-color: #ffffff; --fa-secondary-opacity: 1;"></i>';
                                    }else{
                                        // เปลี่ยน ไอคอนไมโครโฟนเป็น เปิด
                                        document.querySelector('#mic_remote_' + dummy_remote.uid).innerHTML = '<i class="fa-solid fa-microphone"></i>';

                                        status_remote_volume[dummy_remote.uid] = "yes";
                                        if (check_start_volume_indicator[dummy_remote.uid] == "no") {
                                            volume_indicator_remote(dummy_remote.uid);
                                        }

                                    }

                                    let type_of_microphone;
                                    if (dummy_remote['hasAudio'] == false) {
                                        type_of_microphone = "close";
                                    } else {
                                        type_of_microphone = "open";
                                    }
                                    waitForElement_in_sidebar(type_of_microphone,dummy_remote.uid); // รอจนกว่าจะมี icon ของไอดีนี้ใน sidebar

                            })
                            .catch(error => {
                                console.log("โหลด เมื่อมีคนเข้าห้อง ล้มเหลว");
                            });

                        }

                    }
                }
            }

            fetch("{{ url('/') }}/api/check_status_room" + "?sos_id="+ sos_id + "&type=" + type_video_call)
                .then(response => response.json())
                .then(result => {
                // console.log("check_status_room user_join");
                // console.log(result);

                let member_in_room = JSON.parse(result['member_in_room']);

                if(member_in_room.length >= 2){
                    if(check_start_timer_video_call == false){
                        start_timer_video_call();
                    }else{
                        clearInterval(loop_timer_video_call);
                        document.getElementById("time_of_room").innerHTML = "";
                        start_timer_video_call();
                    }

                    // if (check_user_in_video_call == false) {
                    //     start_user_in_video_call(); // ทำฟังก์ชันเช็คคนที่ออกจากห้องไปแล้ว
                    // }
                }
            });

        });

        // ออกจากห้อง
        agoraEngine.on("user-left", function (evt)
        {

            console.log("ไอดี : " + evt.uid + " ออกจากห้อง");

            // ลบ videoDiv_ ที่อยู่ใน ห้องสนทนาออก
            if(document.getElementById('videoDiv_' + evt.uid)) {
                document.getElementById('videoDiv_' + evt.uid).remove();
            }

            // ลบ โปรไฟล์ที่อยู่ใน sidebar เมื่อ ออก
            if(document.getElementById('profile_' + evt.uid)) {
                document.getElementById('profile_' + evt.uid).remove();
            }

            // เช็คว่ามี div .custom-div อยู่ใน div container_user_video_call
            let container = document.getElementById("container_user_video_call");
            let customDivs = container.querySelectorAll(".custom-div");
            //ถ้าไม่มีให้ ย้าย div ใน bar ข้างล่าง ขึ้นมาทั้งหมด
            if (customDivs.length == 0) {
                moveAllDivsToContainer();
            }

            // เสียงแจ้งเตือน เวลาคนเข้า
            let audio_ringtone_left = new Audio("{{ asset('sound/left_room_1.mp3') }}");
            audio_ringtone_left.play();

            // หยุดการเล่นเสียงหลังจาก 1 วินาที
            setTimeout(function() {
                audio_ringtone_left.pause();
                audio_ringtone_left.currentTime = 0; // เริ่มเสียงใหม่เมื่อต้องการเล่นอีกครั้ง
            }, 1000);

            //=======================  Check Delete Member =========================

            fetch("{{ url('/') }}/api/left_room_4" + "?user_id=" + evt.uid + "&type=" + type_video_call + "&sos_id=" + sos_id +"&meet_2_people=beforeunload"+"&leave=beforeunload")
                .then(response => response.text())
                .then(result => {
                    console.log("result left_room_4 :" + result);
                    // OK
            });

            //=======================  Check Member And Stop Count Time =========================
            setTimeout(() => {
                fetch("{{ url('/') }}/api/check_status_room" + "?sos_id="+ sos_id + "&type=" + type_video_call)
                    .then(response => response.json())
                    .then(result => {
                        console.log("result check_status_room");
                        console.log(typeof result['member_in_room']);
                        console.log(result['member_in_room']);

                    let member_in_room = JSON.parse(result['member_in_room']);
                    console.log(typeof member_in_room);

                    // ถ้าผู้ใช้ เหลือ น้อยกว่า 2 คน ให้หยุดนับเวลา
                    if(member_in_room.length < 2){
                        console.log("member_in_room น้อยกว่า 2 --> user-left");
                        if(check_start_timer_video_call == true){
                            myStop_timer_video_call();
                        }

                        // if (check_user_in_video_call == true) {
                        //     Stop_check_user_in_video_call();
                        // }
                    }
                    // ถ้าผู้ใช้ เหลือ 0 คน ให้ทำลายห้องทิ้ง
                    if(member_in_room.length < 1){
                        setTimeout(() => {
                            agoraEngine.destroy();
                        }, 7000);
                    }
                });
            }, 3000);


            console.log("agoraEngine ของ user-left");
            console.log(agoraEngine);

        });


        // local_join
        window.onload = function ()
        {
            document.getElementById("join").onclick = async function (user_id)
            {
                try {
                    let response = await fetch("{{ url('/') }}/api/check_user_in_room_4" + "?sos_id=" + sos_id + "&type=" + type_video_call);
                    let result = await response.json();

                    if (result['status'] == "ok") {

                        // Enable dual-stream mode.
                        // agoraEngine.enableDualStream();
                        // Join a channel.
                        await agoraEngine.join(options.appId, options.channel, options.token, options.uid);
                        // Create a local audio track from the audio sampled by a microphone.

                        // ปิดกล้องเดิม (หากมีการสร้างไว้ก่อนหน้านี้)
                        if (channelParameters.localVideoTrack) {
                            channelParameters.localVideoTrack.close();
                            channelParameters.localVideoTrack = null;
                        }

                        // ปิดไมโครโฟนเดิม (หากมีการสร้างไว้ก่อนหน้านี้)
                        if (channelParameters.localAudioTrack) {
                            channelParameters.localAudioTrack.close();
                            channelParameters.localAudioTrack = null;
                        }

                        //หาไมโครโฟน
                        try {
                            if(useMicrophone){
                                channelParameters.localAudioTrack = await AgoraRTC.createMicrophoneAudioTrack(
                                    {
                                        AEC: true, // การยกเลิกเสียงสะท้อน
                                        ANS: true, // การลดเสียงรบกวนอัตโนมัติ
                                        encoderConfig: "high_quality", // ระดับคุณภาพเสียง
                                        microphoneId: useMicrophone
                                    }
                                );
                            }else{
                                // ดึงรายการไมโครโฟนทั้งหมด
                                let microphoneDevices = await navigator.mediaDevices.enumerateDevices();
                                    // เลือกไมโครโฟนที่ active (เช็ค kind เป็น 'audioinput')
                                let activeMicrophones = microphoneDevices.filter(device => device.kind === 'audioinput' && device.deviceId !== 'default');

                                if (activeMicrophones.length > 0) {
                                    // เลือกไมโครโฟนแรกที่ active
                                    let selectedMicrophone = activeMicrophones[0].deviceId;
                                    // ใช้ไมโครโฟนที่ถูกเลือก
                                    channelParameters.localAudioTrack = await AgoraRTC.createMicrophoneAudioTrack(
                                        {
                                            AEC: true, // การยกเลิกเสียงสะท้อน
                                            ANS: true, // การลดเสียงรบกวนอัตโนมัติ
                                            encoderConfig: "high_quality", // ระดับคุณภาพเสียง
                                            microphoneId: selectedMicrophone
                                        }
                                    );
                                } else {
                                    // ไม่พบไมโครโฟนที่ active
                                    console.error("ไม่พบไมโครโฟนที่ active");
                                    return;
                                }
                            }

                            console.log('หาไมโครโฟน สำเร็จ');
                        } catch (error) {
                            // ในกรณีที่เกิดข้อผิดพลาดในการสร้างไมโครโฟน
                            console.error('ไม่สามารถสร้างไมโครโฟนหรือไม่พบไมโครโฟน', error);

                            try { // เข้าใหม่ในสถานะปิดไมโครโฟนแทน
                                // ดึงรายการไมโครโฟนทั้งหมด
                                let microphoneDevices = await navigator.mediaDevices.enumerateDevices();
                                // เลือกไมโครโฟนที่ active (เช็ค kind เป็น 'audioinput')
                                let activeMicrophones = microphoneDevices.filter(device => device.kind === 'audioinput' && device.deviceId !== 'default');

                                if (activeMicrophones.length > 0) {
                                    // เลือกไมโครโฟนแรกที่ active
                                    let selectedMicrophone = activeMicrophones[0].deviceId;
                                    // ใช้ไมโครโฟนที่ถูกเลือก
                                    channelParameters.localAudioTrack = await AgoraRTC.createMicrophoneAudioTrack(
                                        {
                                            AEC: true, // การยกเลิกเสียงสะท้อน
                                            ANS: true, // การลดเสียงรบกวนอัตโนมัติ
                                            encoderConfig: "high_quality", // ระดับคุณภาพเสียง
                                            microphoneId: selectedMicrophone
                                        }
                                    );
                                } else {
                                    // ไม่พบไมโครโฟนที่ active
                                    // alert("ไมโครโฟน ไม่พร้อมใช้งาน try");
                                    console.error("ไม่พบไมโครโฟนที่ active");
                                }

                                // // ปิดไมโครโฟนใหม่ทันที
                                // await channelParameters.localAudioTrack.setEnabled(false);
                                // //เปลี่ยนสถานะไมโครโฟน เป็น false
                                // isAudio = false;

                            } catch (newError) {
                                // alert("ไมโครโฟน ไม่พร้อมใช้งาน catch");
                                console.error('ไม่สามารถสร้างไมโครโฟนใหม่หรือปิดไมโครโฟนใหม่', newError);
                                // ทำการปิดแบบถาวรหรือจัดการข้อผิดพลาดอื่นๆ ตามที่คุณต้องการ
                            }
                        }

                        // หากล้อง
                        try {
                            if(useCamera){
                                console.log("if หากล้อง");
                                channelParameters.localVideoTrack = await AgoraRTC.createCameraVideoTrack(
                                    {
                                        cameraId: useCamera,
                                        // optimizationMode: "detail",
                                        // encoderConfig:
                                        // {
                                        //     width: 640,
                                        //     // Specify a value range and an ideal value
                                        //     height: { ideal: 480, min: 400, max: 500 },
                                        //     frameRate: 15,
                                        //     bitrateMin: 500, bitrateMax: 1000,
                                        // },
                                    }
                                );
                            }else{
                                console.log("else หากล้อง");

                                channelParameters.localVideoTrack = await AgoraRTC.createCameraVideoTrack(
                                    {

                                        // optimizationMode: "detail",
                                        // encoderConfig:
                                        // {
                                        //     width: 640,
                                        //     // Specify a value range and an ideal value
                                        //     height: { ideal: 480, min: 400, max: 500 },
                                        //     frameRate: 15,
                                        //     bitrateMin: 500, bitrateMax: 1000,
                                        // },
                                    }
                                );
                            }

                        } catch (error) {
                            // ในกรณีที่เกิดข้อผิดพลาดในการสร้างกล้อง

                            console.error('ไม่สามารถสร้างกล้องหรือไม่พบกล้อง', error);

                            let cameraDevices = await navigator.mediaDevices.enumerateDevices();
                            let activeCameras = cameraDevices.filter(device => device.kind === 'videoinput');

                            if (activeCameras.length > 0) {
                                let selectedCamera = activeCameras[0].deviceId;
                                channelParameters.localVideoTrack = await AgoraRTC.createCameraVideoTrack({ cameraId: selectedCamera });

                            } else {
                                console.error("ไม่พบกล้องที่ active");
                            }

                            // channelParameters.localVideoTrack = await AgoraRTC.createCustomVideoTrack({
                            //     // mediaStreamTrack: screenTrack,
                            //     // optimizationMode: 'detail',
                            //     // encoderConfig: {
                            //     //     width: 640,
                            //     //     // Specify a value range and an ideal value
                            //     //     height: { ideal: 480, min: 400, max: 500 },
                            //     //     frameRate: 15,
                            //     //     bitrateMin: 500, bitrateMax: 1000,
                            //     // },
                            // });

                            // alert('ไม่สามารถโหลดข้อมูลกล้องได้ catch');

                            // setTimeout(() => {
                            //     window.location.reload(); // รีเฟรชหน้าเว็บ
                            // }, 2000);

                            // channelParameters.localVideoTrack = await AgoraRTC.createCameraVideoTrack({});


                        }

                        await agoraEngine.publish([channelParameters.localVideoTrack ,channelParameters.localAudioTrack]);
                        console.log("AgoraEngine");
                        console.log(agoraEngine);
                        //=================     สำหรับ Senior Benze  =========================
                        function join_and_update(){
                            console.log("join_and_update");
                                fetch("{{ url('/') }}/api/join_room_4" + "?user_id=" + '{{ Auth::user()->id }}' + "&type=" + type_video_call + "&sos_id=" + sos_id)
                                    .then(response => response.json())
                                    .then(result => {
                                        console.log("result join_room_4");
                                        console.log(result);
                                        // let member_in_room = JSON.parse(result);
                                        setTimeout(() => {
                                            if(result.length >= 2){
                                                if(check_start_timer_video_call == false){
                                                    start_timer_video_call();
                                                }

                                                // if (check_user_in_video_call == false) {
                                                //     start_user_in_video_call(); // ทำฟังก์ชันเช็คคนที่ออกจากห้องไปแล้ว
                                                // }

                                            }else{
                                                if(check_start_timer_video_call == true){
                                                    console.log("member_in_room น้อยกว่า 2 --> join_and_update");
                                                    myStop_timer_video_call();
                                                }

                                                // if (check_user_in_video_call == true) {
                                                //     Stop_check_user_in_video_call(); // หยุดทำฟังก์ชันเช็คคนที่ออกจากห้องไปแล้ว
                                                // }
                                            }
                                        }, 800);

                                        start_user_in_video_call(); // ทำฟังก์ชันเช็คคนที่ออกจากห้องไปแล้ว


                                })
                                .catch(error => {
                                    console.log("บันทึกข้อมูล join_and_update ล้มเหลว :" + error);
                                    // window.location.reload(); // รีเฟรชหน้าเว็บ
                                });
                        }
                        join_and_update();
                        //=================    จบ สำหรับ Senior Benze  =========================

                        // console.log("create_element_localvideo_call When Joined");
                        // console.log(name_local);
                        // console.log(type_local);
                        //======= สำหรับสร้าง div ที่ใส่ video tag พร้อม id_tag สำหรับลบแท็ก ========//
                        create_element_localvideo_call(localPlayerContainer,name_local,type_local,profile_local,bg_local);
                        // Play the local video track.
                        channelParameters.localVideoTrack.play(localPlayerContainer);

                        // เอาหน้าโหลดออก
                        document.querySelector('#lds-ring').remove();

                        //======= สำหรับ สร้างปุ่มที่ใช้ เปิด-ปิด กล้องและไมโครโฟน ==========//
                        btn_toggle_mic_camera(videoTrack,audioTrack,bg_local);

                        // สร้าง โปรไฟล์ใน sidebar =========== อยู่จนกว่าจะออกจากห้อง ======================

                        let create_profile_local = document.createElement("div");
                            create_profile_local.id = "profile_"+localPlayerContainer.id;
                            create_profile_local.classList.add('row');

                        let html_profile_user = create_profile_in_sidebar_local_only(localPlayerContainer ,name_local ,type_local ,profile_local);

                        create_profile_local.innerHTML = html_profile_user;

                        // ตรวจสอบว่าเจอ div เดิมหรือไม่
                        let oldDiv = document.getElementById("profile_"+ localPlayerContainer.id);
                        if (oldDiv) {
                            // ใช้ parentNode.replaceChild() เพื่อแทนที่ div เดิมด้วย div ใหม่
                            oldDiv.parentNode.replaceChild(create_profile_local, oldDiv);
                        } else {
                            document.querySelector('#users_in_sidebar').appendChild(create_profile_local);
                        }

                        // จบส่วน สร้าง โปรไฟล์ใน sidebar ===============================================

                        //ถ้ากดปุ่ม muteVideo แล้วกล้องอยู่ในสถานะปิด ให้เปลี่ยนสี bg ของ local
                        document.querySelector('#muteVideo').addEventListener("click", function(e) {
                            if (isVideo == false) {
                                console.log(bg_local);
                                changeBgColor(bg_local);
                            }
                        });

                        //ถ้ากดปุ่ม muteVideo แล้วกล้องอยู่ในสถานะปิด ให้เปลี่ยนสี bg ของ local
                        document.querySelector('#muteAudio').addEventListener("click", function(e) {
                            if (isAudio == true) {
                                SoundTest();
                            }
                        });

                        if(isAudio == true){
                            agoraEngine.publish([channelParameters.localAudioTrack]);
                        }

                        try { // เช็คสถานะจากห้องทางเข้า แล้วเลือกกดเปิด-ปิด ตามสถานะ
                            if(videoTrack == "open"){
                                // เข้าห้องด้วย->สถานะเปิดกล้อง
                                isVideo = false;
                                document.querySelector('#muteVideo').click();
                                console.log("Click open video ===================");
                            }else{
                                // เข้าห้องด้วย->สถานะปิดกล้อง
                                isVideo = true;
                                document.querySelector('#muteVideo').click();
                                console.log("Click close video ===================");
                            }

                            if(audioTrack == "open"){
                                // เข้าห้องด้วย->สถานะเปิดไมค์
                                isAudio = false;
                                document.querySelector('#muteAudio').click();
                                console.log("Click open audio ===================");
                            }else{
                                // เข้าห้องด้วย->สถานะปิดไมค์
                                isAudio = true;
                                document.querySelector('#muteAudio').click();
                                console.log("Click close audio ===================");
                            }
                        }
                        catch (error) {
                            console.log('ส่งตัวแปร videoTrack audioTrack ไม่สำเร็จ');
                        }

                        // console.log('AudioTrack:');
                        // console.log(channelParameters.localAudioTrack);

                    }else{
                        alert("จำนวนผู้ใช้ในห้องสนทนาสูงสุดแล้ว");
                        window.history.back();
                    }

                } catch (error) {
                    console.log("โหลดหน้าล้มเหลว :" + error);
                    // alert("ไม่สามารถเข้าร่วมได้ ");
                    window.location.reload(); // รีเฟรชหน้าเว็บ
                }
            }
            // Listen to the Leave button click event.
            document.getElementById('leave').onclick = async function ()
            {

                // Destroy the local audio and video tracks.
                if(channelParameters.localAudioTrack){
                    channelParameters.localAudioTrack.close();
                }
                if(channelParameters.localVideoTrack){
                    channelParameters.localVideoTrack.close();
                }

                // Remove the containers you created for the local video and remote video.
                removeVideoDiv(remotePlayerContainer.id);
                removeVideoDiv(localPlayerContainer.id);
                // Leave the channel
                await agoraEngine.leave();
                console.log("You left the channel");

                if (leaveChannel == "false") {
                    // leaveChannel();
                    fetch("{{ url('/') }}/api/left_room_4" + "?user_id=" + '{{ Auth::user()->id }}' + "&type=" + type_video_call + "&sos_id=" + sos_id +"&meet_2_people=beforeunload"+"&leave=beforeunload")
                        .then(response => response.text())
                        .then(result => {
                            // console.log(result);
                            console.log("left_and_update สำเร็จ");
                            leaveChannel = "true";

                            window.history.back();
                            let type_url;
                            switch (type_video_call) {
                                case 'sos_1669':
                                        // "ศูนย์อำนวยการ" , "หน่วยแพทย์ฉุกเฉิน" , "--"
                                        type_url = "{{ url('/sos_help_center')}}"+ '/' + "{{ $sos_id }}" + '/show_case';
                                        console.log("type_url");
                                        console.log(type_url);
                                        if (type_user_sos == "ศูนย์อำนวยการ") {
                                            window.history.back();
                                        } else if(type_user_sos == "หน่วยแพทย์ฉุกเฉิน"){
                                            window.location.href = type_url;
                                        }else if(type_user_sos == "เจ้าหน้าที่ห้อง ER"){
                                            window.history.back();
                                        }else{
                                            window.history.back();
                                        }
                                    break;

                                case 'user_sos_1669':
                                        // "ศูนย์อำนวยการ" , "ผู้ขอความช่วยเหลือ" , "--"
                                        type_url = "{{ url('/sos_help_center')}}"+ '/' + "{{ $sos_id }}" + '/show_user';
                                        if (type_user_sos == "ศูนย์อำนวยการ") {
                                            window.history.back();
                                        } else if(type_user_sos == "ผู้ขอความช่วยเหลือ"){
                                            window.location.href = type_url;
                                        }else{
                                            window.history.back();
                                        }
                                    break;

                                case 'sos_map':
                                        // "ศูนย์ควบคุม" , "เจ้าหน้าที่" , "ผู้ขอความช่วยเหลือ"
                                        if (type_user_sos == "ศูนย์ควบคุม") {
                                            window.history.back();
                                        }else if (type_user_sos == "เจ้าหน้าที่"){
                                            window.history.back();
                                        } else if(type_user_sos == "ผู้ขอความช่วยเหลือ"){
                                            window.location.href = "{{ url('/sos_help_center/' . $sos_id . '/show_user') }}";
                                        }else{
                                            window.history.back();
                                        }
                                    break;

                                case 'sos_personal_assistant':
                                        window.history.back();
                                    break;

                                default:
                                    window.history.back();
                                    break;
                            }
                    })
                    .catch(error => {
                        console.log("บันทึกข้อมูล left_and_update ล้มเหลว :" + error);
                    });
                }

            }
        }

        //=============================================================================//
        //                               สลับอุปกรณ์                                     //
        //=============================================================================//

        var activeVideoDeviceId;
        var activeAudioDeviceId;
        // var activeAudioOutputDeviceId
        window.addEventListener('DOMContentLoaded', async () => {
            try {
                // เรียกดูอุปกรณ์ทั้งหมด
                const devices = await navigator.mediaDevices.enumerateDevices();

                // เรียกดูอุปกรณ์ที่ใช้อยู่
                const stream = await navigator.mediaDevices.getUserMedia({
                    audio: true,
                    video: true
                });

                if(useMicrophone){
                    activeAudioDeviceId = useMicrophone;
                }else{
                    activeAudioDeviceId = stream.getAudioTracks()[0].getSettings().deviceId;
                }

                if(useCamera){
                    activeVideoDeviceId = useCamera;
                }else{
                    activeVideoDeviceId = stream.getVideoTracks()[0].getSettings().deviceId;
                }

                // if(useSpeaker){
                //     activeAudioOutputDeviceId = useSpeaker;
                // }else{
                //     activeAudioOutputDeviceId = devices.find(device => device.kind === 'audiooutput' && device.deviceId === 'default').deviceId;
                // }

            } catch (error) {
                console.error('เกิดข้อผิดพลาดในการเรียกดูอุปกรณ์:', error);
            }

        });
        // ไมโครโฟน -- Microphone
        var old_activeAudioDeviceId ;

        // เรียกใช้งานเมื่อต้องการเปลี่ยนอุปกรณ์เสียง
        function onChangeAudioDevice() {

            old_activeAudioDeviceId = activeAudioDeviceId;
            // old_activeAudioOutputDeviceId = activeAudioOutputDeviceId;

            const selectedAudioDeviceId = getCurrentAudioDeviceId();
            // const selectedAudioOutputDeviceId = getCurrentAudiooutputDeviceId();
            // console.log('อุปกรณ์เสียงเดิม:', activeAudioDeviceId);
            // console.log('เปลี่ยนอุปกรณ์เสียงเป็น:', selectedAudioDeviceId);

            activeAudioDeviceId = selectedAudioDeviceId ;

            // สร้าง local audio track ใหม่โดยใช้อุปกรณ์ที่คุณต้องการ
            AgoraRTC.createMicrophoneAudioTrack({
                AEC: true, // การยกเลิกเสียงสะท้อน
                ANS: true, // การลดเสียงรบกวนอัตโนมัติ
                encoderConfig: "high_quality", // ระดับคุณภาพเสียง
                microphoneId: selectedAudioDeviceId
            })
            .then(newAudioTrack => {
                console.log('newAudioTrack');
                console.log(newAudioTrack);
                // หยุดการส่งเสียงจากอุปกรณ์ปัจจุบัน
                channelParameters.localAudioTrack.setEnabled(false);

                agoraEngine.unpublish([channelParameters.localAudioTrack]);

                // ปิดการเล่นเสียงเดิม
                // channelParameters.localAudioTrack.stop();
                // channelParameters.localAudioTrack.close();

                // เปลี่ยน local audio track เป็นอุปกรณ์ใหม่
                channelParameters.localAudioTrack = newAudioTrack;

                channelParameters.localAudioTrack.play();

                if(isAudio == true){
                    // เริ่มส่งเสียงจากอุปกรณ์ใหม่
                    channelParameters.localAudioTrack.setEnabled(true);
                    channelParameters.localAudioTrack.play();

                    agoraEngine.publish([channelParameters.localAudioTrack]);

                    // isAudio = true;
                    console.log('เปลี่ยนอุปกรณ์เสียงสำเร็จ');
                    console.log('เข้า if => isAudio == true');
                    console.log(channelParameters.localAudioTrack);
                    console.log(agoraEngine);

                }
                else {
                    channelParameters.localAudioTrack.setEnabled(true);
                    channelParameters.localAudioTrack.play();
                    agoraEngine.publish([channelParameters.localAudioTrack]);

                    channelParameters.localAudioTrack.setEnabled(false);
                    agoraEngine.unpublish([channelParameters.localAudioTrack]);
                    // channelParameters.localAudioTrack.play();
                    // isAudio = false;

                    console.log('เปลี่ยนอุปกรณ์เสียงสำเร็จ');
                    console.log('เข้า else => isAudio == false');
                    console.log(channelParameters.localAudioTrack);
                    console.log(agoraEngine);
                }

            })
            .catch(error => {
                console.error('เกิดข้อผิดพลาดในการสร้าง local audio track:', error);

                selectedAudioDeviceId = old_activeAudioDeviceId;
                selectedAudioOutputDeviceId = old_activeAudioOutputDeviceId;
            });
        }

        // ลำโพง -- Speaker -- ยังหาฟังก์ชันเปลี่ยนไม่ได้
        // var old_activeAudioOutputDeviceId ;
        // function onChangeAudioOutputDevice() {
        //     old_activeAudioOutputDeviceId = activeAudioOutputDeviceId;

        //     const selectedAudioOutputDeviceId = getCurrentAudiooutputDeviceId();
        //     // console.log('อุปกรณ์เสียงเดิม:', activeAudioDeviceId);
        //     // console.log('เปลี่ยนอุปกรณ์เสียงเป็น:', selectedAudioDeviceId);

        //     activeAudioOutputDeviceId = selectedAudioOutputDeviceId;
        //     // สร้าง local audio track ใหม่โดยใช้อุปกรณ์ที่คุณต้องการ
        //     AgoraRTC.createSpeakerAudioTrack({
        //         deviceId: selectedAudioOutputDeviceId,
        //     })
        //     .then(newAudioTrack => {
        //         console.log('newAudioTrack');
        //         console.log(newAudioTrack);
        //         // หยุดการส่งเสียงจากอุปกรณ์ปัจจุบัน
        //         // channelParameters.localAudioTrack.setEnabled(false);

        //         // agoraEngine.unpublish([channelParameters.localAudioTrack]);

        //         // // ปิดการเล่นเสียงเดิม
        //         // // channelParameters.localAudioTrack.stop();
        //         // // channelParameters.localAudioTrack.close();

        //         // // เปลี่ยน local audio track เป็นอุปกรณ์ใหม่
        //         // channelParameters.localAudioTrack = newAudioTrack;

        //         // channelParameters.localAudioTrack.play();

        //         // if(isAudio == true){
        //         //     // เริ่มส่งเสียงจากอุปกรณ์ใหม่
        //         //     channelParameters.localAudioTrack.setEnabled(true);
        //         //     channelParameters.localAudioTrack.play();

        //         //     agoraEngine.publish([channelParameters.localAudioTrack]);

        //         //     // isAudio = true;
        //         //     console.log('เปลี่ยนอุปกรณ์เสียงสำเร็จ');
        //         //     console.log('เข้า if => isAudio == true');
        //         //     console.log(channelParameters.localAudioTrack);
        //         // }
        //         // else {
        //         //     channelParameters.localAudioTrack.setEnabled(false);
        //         //     // channelParameters.localAudioTrack.play();
        //         //     // isAudio = false;
        //         //     console.log('เปลี่ยนอุปกรณ์เสียงสำเร็จ');
        //         //     console.log('เข้า else => isAudio == false');
        //         //     console.log(channelParameters.localAudioTrack);
        //         // }

        //     })
        //     .catch(error => {
        //         console.error('เกิดข้อผิดพลาดในการสร้าง local audio track:', error);

        //         selectedAudioDeviceId = old_activeAudioDeviceId;
        //         selectedAudioOutputDeviceId = old_activeAudioOutputDeviceId;
        //     });
        // }

        var old_activeVideoDeviceId ;

        function onChangeVideoDevice() {

            old_activeVideoDeviceId = activeVideoDeviceId ;

            const selectedVideoDeviceId = getCurrentVideoDeviceId();
            console.log('เปลี่ยนอุปกรณ์กล้องเป็น:', selectedVideoDeviceId);

            activeVideoDeviceId = selectedVideoDeviceId ;

            // สร้าง local video track ใหม่โดยใช้กล้องที่คุณต้องการ
            AgoraRTC.createCameraVideoTrack({ cameraId: selectedVideoDeviceId })
            .then(newVideoTrack => {

                // console.log('------------ newVideoTrack ------------');
                // console.log(newVideoTrack);
                // console.log('------------ channelParameters.localVideoTrack ------------');
                // console.log(channelParameters.localVideoTrack);
                // console.log('------------ localPlayerContainer ------------');
                // console.log(localPlayerContainer);

                // // หยุดการส่งภาพจากอุปกรณ์ปัจจุบัน
                // channelParameters.localVideoTrack.setEnabled(false);

                agoraEngine.unpublish([channelParameters.localVideoTrack]);
                // console.log('------------unpublish localVideoTrack ------------');

                // ปิดการเล่นภาพวิดีโอกล้องเดิม
                channelParameters.localVideoTrack.stop();
                channelParameters.localVideoTrack.close();

                // เปลี่ยน local video track เป็นอุปกรณ์ใหม่
                channelParameters.localVideoTrack = newVideoTrack;

                if (isVideo == true) {
                    // เริ่มส่งภาพจากอุปกรณ์ใหม่
                    channelParameters.localVideoTrack.setEnabled(true);
                    // แสดงภาพวิดีโอใน <div>
                    channelParameters.localVideoTrack.play(localPlayerContainer);
                    // channelParameters.remoteVideoTrack.play(remotePlayerContainer);
                    agoraEngine.publish([channelParameters.localVideoTrack]);
                    // console.log('เปลี่ยนอุปกรณ์กล้องสำเร็จ');
                }
                else {
                    // alert('ปิด');
                    channelParameters.localVideoTrack.setEnabled(false);

                    channelParameters.localVideoTrack.play(localPlayerContainer);
                    agoraEngine.publish([channelParameters.localVideoTrack]);
                }

                if (isVideo == false) {
                    setTimeout(() => {
                        console.log("bg_local onChange");
                        changeBgColor(bg_local);
                    }, 50);
                }

            })
            .catch(error => {
                // alert('ไม่สามารถเปลี่ยนกล้องได้');
                // alertNoti('<i class="fa-solid fa-triangle-exclamation fa-shake"></i>', 'ไม่สามารถเปลี่ยนกล้องได้');
                console.log('ไม่สามารถเปลี่ยนกล้องได้');

                activeVideoDeviceId = old_activeVideoDeviceId ;

                // setTimeout(function() {
                //     document.querySelector('#btn_switchCamera').click();
                // }, 2000);

                console.error('เกิดข้อผิดพลาดในการสร้าง local video track:', error);

                if (isVideo == false) {
                    setTimeout(() => {
                        console.log("bg_local ddddddddddddddddddddddd");
                        changeBgColor(bg_local);
                    }, 50);
                }
            });

            // document.querySelector('#ปุ่มนี้สำหรับปิด_modal').click();
        }

        function getCurrentAudioDeviceId() {
            const audioDevices = document.getElementsByName('audio-device');
            for (let i = 0; i < audioDevices.length; i++) {
                if (audioDevices[i].checked) {
                    return audioDevices[i].value;
                }
            }
            return null;
        }

        // function getCurrentAudiooutputDeviceId() {
        //     const audiooutputDevices = document.getElementsByName('audio-device-output');
        //     for (let i = 0; i < audiooutputDevices.length; i++) {
        //         if (audiooutputDevices[i].checked) {
        //             return audiooutputDevices[i].value;
        //         }
        //     }
        //     return null;
        // }

        function getCurrentVideoDeviceId() {
            const videoDevices = document.getElementsByName('video-device');
            for (let i = 0; i < videoDevices.length; i++) {
                if (videoDevices[i].checked) {
                    return videoDevices[i].value;
                }
            }
            return null;
        }

        var now_Mobile_Devices = 1;
        var cachedVideoDevices = null; // สร้างตัวแปร global เพื่อเก็บข้อมูล camera

        btn_switchCamera.onclick = async function()
        {
            // console.log('btn_switchCamera');
            // console.log('activeVideoDeviceId');
            // console.log(activeVideoDeviceId);

            // เรียกใช้ฟังก์ชันและแสดงผลลัพธ์
            let deviceType = checkDeviceType();
            // console.log("Device Type:", deviceType);

           // ถ้ายังไม่มีข้อมูลอุปกรณ์ที่เก็บไว้
            if (!cachedVideoDevices) {
                // เรียกดูอุปกรณ์ทั้งหมด
                let getDevices = await navigator.mediaDevices.enumerateDevices();

                // แยกอุปกรณ์ตามประเภท
                let getVideoDevices = getDevices.filter(device => device.kind === 'videoinput');

                // กำหนดค่าให้กับตัวแปร global เพื่อเก็บไว้
                cachedVideoDevices = getVideoDevices;
            }

            let videoDevices = cachedVideoDevices; // สามารถใช้ cachedVideoDevices ได้ทุกครั้งที่ต้องการ

            console.log('------- videoDevices -------');
            console.log(videoDevices);
            console.log('length ==>> ' + videoDevices.length);
            console.log('------- ------- -------');

            // สร้างรายการอุปกรณ์ส่งข้อมูลและเพิ่มลงในรายการ
            let videoDeviceList = document.getElementById('video-device-list');
                videoDeviceList.innerHTML = '';
            let deviceText = document.createElement('li');
                deviceText.classList.add('text-center','p-1','text-white');
                deviceText.appendChild(document.createTextNode("กล้อง"));

                videoDeviceList.appendChild(deviceText);

            let count_i = 1 ;

            videoDevices.forEach(device => {
                let radio = document.createElement('input');
                    radio.type = 'radio';
                    radio.classList.add('radio_style');
                    radio.id = 'video-device-' + count_i;
                    radio.name = 'video-device';
                    radio.value = device.deviceId;

                if (deviceType == 'PC'){
                    radio.checked = device.deviceId === activeVideoDeviceId;
                }

                let label = document.createElement('li');
                    label.classList.add('ui-list-item');
                    label.appendChild(document.createTextNode(device.label || `อุปกรณ์ส่งข้อมูล ${videoDeviceList.children.length + 1}`));
                    label.appendChild(document.createTextNode("\u00A0")); // เพิ่ม non-breaking space
                    label.appendChild(radio);

                if (deviceType == 'PC'){
                    // สร้างเหตุการณ์คลิกที่ label เพื่อตรวจสอบ radio2
                    label.addEventListener('click', () => {
                        radio.checked = true;
                        onChangeVideoDevice();
                    });
                }

                videoDeviceList.appendChild(label);

                radio.addEventListener('change', onChangeVideoDevice);

                count_i = count_i + 1 ;
            });

            // ---------------------------

            if (deviceType !== 'PC'){
                let check_videoDevices = document.getElementsByName('video-device');

                if (now_Mobile_Devices == 1){
                    // console.log("now_Mobile_Devices == 1 // ให้คลิก ");
                    // console.log(check_videoDevices[1].id);
                    document.querySelector('#'+check_videoDevices[1].id).click();
                    now_Mobile_Devices = 2 ;
                }else{
                    // console.log("now_Mobile_Devices == 2 // ให้คลิก ");
                    // console.log(check_videoDevices[0].id);
                    document.querySelector('#'+check_videoDevices[0].id).click();
                    now_Mobile_Devices = 1 ;
                }
            }

        }

        var cachedAudioDevices = null; // สร้างตัวแปร global เพื่อเก็บข้อมูล microphone
        btn_switchMicrophone.onclick = async function()
        {
            console.log('btn_switchMicrophone');

            console.log('activeAudioDeviceId');
            console.log(activeAudioDeviceId);

            // เรียกใช้ฟังก์ชันและแสดงผลลัพธ์
            let deviceType = checkDeviceType();
            console.log("Device Type:", deviceType);

            // ถ้ายังไม่มีข้อมูลอุปกรณ์ที่เก็บไว้
            if (!cachedAudioDevices) {
                // เรียกดูอุปกรณ์ทั้งหมด
                let getDevices = await navigator.mediaDevices.enumerateDevices();
                // แยกอุปกรณ์ตามประเภท
                let getAudioDevices = getDevices.filter(device => device.kind === 'audioinput');

                // กำหนดค่าให้กับตัวแปร global เพื่อเก็บไว้
                cachedAudioDevices = getAudioDevices;
            }

            let audioDevices = cachedAudioDevices; // สามารถใช้ cachedAudioDevices ได้ทุกครั้งที่ต้องการ
            // แยกอุปกรณ์ตามประเภท --> ลำโพง
            // let audioOutputDevices = devices.filter(device => device.kind === 'audiooutput');

            console.log('------- audioDevices -------');
            console.log(audioDevices);
            console.log('length ==>> ' + audioDevices.length);
            console.log('------- ------- -------');

            // สร้างรายการอุปกรณ์ส่งข้อมูลและเพิ่มลงในรายการ
            let audioDeviceList = document.getElementById('audio-device-list');
                audioDeviceList.innerHTML = '';
            let deviceText = document.createElement('li');
                deviceText.classList.add('text-center','p-1','text-white');
                deviceText.appendChild(document.createTextNode("อุปกรณ์รับข้อมูล"));

            //============================================ ส่วนของ การปรับระดับเสียง(optional)=====================================================================================

            let localVolume = localStorage.getItem('local_sos_1669_rangeValue') ?? 100;

            let localAudioVolumeLabel = `<label class="ui-list-item d-block" for="localAudioVolume" >
                                            <li class="text-center p-1 text-white d-block" style="font-size: 1.1em;">ระดับเสียงไมค์(ตัวเอง)</li>
                                            <input type="range" id="localAudioVolume" min="0" max="1000" value="`+localVolume+`" class="w-100">
                                        </label>`

            audioDeviceList.insertAdjacentHTML('afterbegin', localAudioVolumeLabel); // แทรกบนสุด

            let remoteAudioVolumeLabel = `<label class="ui-list-item d-none" for="remoteAudioVolume" >
                                            <li class="text-center p-1 text-white d-block" style="font-size: 1.1em;">เสียงที่เราได้ยิน</li>
                                            <input type="range" id="remoteAudioVolume" min="0" max="100" value="`+remoteVolume+`" class="w-100">
                                        </label>`

            audioDeviceList.insertAdjacentHTML('afterbegin', remoteAudioVolumeLabel); // แทรกบนสุด

            // เข้าถึงตัวปรับ input =============== localVolume ==========================
            let local_rangeInput = document.getElementById('localAudioVolume');
            local_rangeInput.addEventListener('input', function() {
            // บันทึกค่าลงใน localStorage เมื่อมีการเปลี่ยนแปลง
                localStorage.setItem('local_sos_1669_rangeValue', local_rangeInput.value);
                localVolume = local_rangeInput.value; // เปลี่ยนค่าระดับเสียงของทางเราให้เท่ากับตัวปรับ

                if (local_rangeInput.value == 0) { // ถ้า value ตัวปรับเสียง ของ remote คนนี้ เป็น 0
                    document.querySelector('#icon_microphone_in_sidebar').innerHTML = `<i title="คุณปิดไมโครโฟนผู้ใช้ท่านนี้ไว้" class="fa-duotone fa-volume-xmark"
                    style="--fa-primary-color: #000000; --fa-secondary-color: #ff0000; --fa-secondary-opacity: 1; display: inline-block; z-index: 6; "></i>`;
                    // document.querySelector('#icon_microphone_in_sidebar').innerHTML = `<i title="คุณปิดไมโครโฟนผู้ใช้ท่านนี้ไว้" class="fa-duotone fa-microphone-slash" style="--fa-primary-color: #1319b9; --fa-secondary-color: #000000; --fa-secondary-opacity: 1; display: inline-block; z-index: 6;"></i>`;
                } else {
                    if (isAudio == true) {
                        document.querySelector('#icon_microphone_in_sidebar').innerHTML = `<i class="fa-solid fa-microphone" style="display: inline-block; z-index: 6;" ></i>`;
                    } else {
                        document.querySelector('#icon_microphone_in_sidebar').innerHTML = `<i class="fa-duotone fa-microphone-slash" style="--fa-primary-color: #e60000; --fa-secondary-color: #000000; --fa-secondary-opacity: 1; display: inline-block; z-index: 6;"></i>`;
                    }
                }
            });

            // เข้าถึงตัวปรับ input =============== remoteVolume ==========================
            let remote_rangeInput = document.getElementById('remoteAudioVolume');
            remote_rangeInput.addEventListener('input', function() {
            // บันทึกค่าลงใน remoteStorage เมื่อมีการเปลี่ยนแปลง
                localStorage.setItem('remote_rangeValue', remote_rangeInput.value);
                remoteVolume = remote_rangeInput.value; // เปลี่ยนค่าระดับเสียงของทางฝั่งตรงข้ามให้เท่ากับตัวปรับ
            });

            let localVolumeFromStorage = localStorage.getItem('local_sos_1669_rangeValue');
            // let remoteVolumeFromStorage = localStorage.getItem('remote_rangeValue');

            // ตั้งค่าเสียงในตอนที่เริ่มต้น
            if (localVolumeFromStorage !== null) {
                // ตั้งค่าเสียง local audio
                console.log("Volume of local audio at start :" + localVolumeFromStorage);
                channelParameters.localAudioTrack.setVolume(parseInt(localVolumeFromStorage));
            }else{
                channelParameters.localAudioTrack.setVolume(parseInt(100));
            }

            // เพิ่ม event listener สำหรับ local audio volume slider
            document.getElementById("localAudioVolume").addEventListener("change", function (evt) {
                console.log("Volume of local audio :" + evt.target.value);
                // Set the local audio volume.
                channelParameters.localAudioTrack.setVolume(parseInt(evt.target.value));
                // บันทึกค่าลงใน localStorage เพื่อให้ค่าเสียงเป็นค่าเริ่มต้นต่อครั้งถัดไป
            });

            // let remoteAudioTracksArray = [];

            // document.getElementById("remoteAudioVolume").addEventListener("change", function (evt) {
            //     // Set the remote audio volume.
            //     // ในตัวอย่างนี้, เราให้ remoteAudioTracksArray เป็น array ที่เก็บ remoteAudioTrack ของทุกคน
            //     remoteAudioTracksArray.forEach(remoteAudioTrack => {
            //         remoteAudioTrack.setVolume(parseInt(evt.target.value));
            //         console.log("Volume of remote audio for All User");
            //     });

            //     // บันทึกค่าลงใน localStorage เพื่อให้ค่าเสียงเป็นค่าเริ่มต้นต่อครั้งถัดไป
            // });

            //=================================================================================================================================

            audioDeviceList.appendChild(deviceText);
            // let audiooutputDeviceList = document.getElementById('audio-device-output-list');
            //     audiooutputDeviceList.innerHTML = '';

            let count_i = 1 ;
            let count_i_output = 1 ;
            // ----------- Input ----------------
            audioDevices.forEach(device => {
                const radio2 = document.createElement('input');
                    radio2.type = 'radio';
                    radio2.classList.add('radio_style');
                    radio2.id = 'audio-device-' + count_i;
                    radio2.name = 'audio-device';
                    radio2.value = device.deviceId;

                if (deviceType == 'PC'){
                    radio2.checked = device.deviceId === activeAudioDeviceId;
                }


                let label = document.createElement('li');
                    label.classList.add('ui-list-item');
                    label.appendChild(document.createTextNode(device.label || `อุปกรณ์รับข้อมูล ${audioDeviceList.children.length + 1}`));
                    label.appendChild(document.createTextNode("\u00A0")); // เพิ่ม non-breaking space
                    label.appendChild(radio2);

                    // สร้างเหตุการณ์คลิกที่ label เพื่อตรวจสอบ radio2
                    label.addEventListener('click', () => {
                        radio2.checked = true;
                        onChangeAudioDevice();
                    });


                audioDeviceList.appendChild(label);
                radio2.addEventListener('change', onChangeAudioDevice);

                count_i = count_i + 1 ;
            });

            // let hr = document.createElement('hr');
            // audioDeviceList.appendChild(hr);

            // ----------- Output ----------------
            // audioOutputDevices.forEach(device => {
            // const radio3 = document.createElement('input');
            //     radio3.type = 'radio';
            //     radio3.id = 'audio-device-output-' + count_i_output;
            //     radio3.name = 'audio-device-output';
            //     radio3.value = device.deviceId;

            // if (deviceType == 'PC'){
            //     radio3.checked = device.deviceId === activeAudioOutputDeviceId;
            // }

            // let label_output = document.createElement('label');
            //     label_output.classList.add('dropdown-item');
            //     label_output.appendChild(radio3);
            //     label_output.appendChild(document.createTextNode(device.label || `อุปกรณ์ส่งข้อมูล ${audioDeviceList.children.length + 1}`));

            // audiooutputDeviceList.appendChild(label_output);
            // radio3.addEventListener('change', onChangeAudioOutputDevice);

            // count_i_output = count_i_output + 1 ;
            // });

            // ---------------------------7

            // เพิ่มเหตุการณ์คลิกที่หน้าจอที่ไม่ใช่ตัว audio-device-list ให้ปิด audio-device-list
            // document.addEventListener('click', (event) => {
            //     const target = event.target;

            //     if (!target.closest('#audio-device-list')) {
            //        document.querySelector('.dropcontent').classList.toggle('open');
            //     }
            // });

        }

        // ตรวจสอบอุปกรณ์ที่ใช้งาน
        function checkDeviceType() {
            const userAgent = navigator.userAgent || navigator.vendor || window.opera;

            // ตรวจสอบชนิดของอุปกรณ์
            if (/android/i.test(userAgent)) {
                return "Mobile (Android)";
            }

            if (/iPad|iPhone|iPod/.test(userAgent) && !window.MSStream) {
                return "Mobile (iOS)";
            }

            return "PC";
        }

        //=============================================================================//
        //                              จบ -- สลับอุปกรณ์                                //
        //=============================================================================//



    }

    function onChangeVolumeRemote(div_id , slider){
        checkHtml = true; // ป้องกันการคลิ๊ก div video โดยยังไม่ได้ทำฟังก์ชันนี้

        let value_slider;
        if (slider == "handle") {
            value_slider = document.querySelector("#remoteAudioVolume_"+div_id).value;
        } else {
            value_slider = slider;
        }

        array_remoteVolumeAudio[div_id] = value_slider;
        // console.log("agoraEngine onChangeVolumeRemote");
        // console.log(agoraEngine);

        let id_in_agoraEngine = agoraEngine['remoteUsers'][div_id];

        if (!id_in_agoraEngine) {
            console.log("ไม่พบ id_in_agoraEngine ใน onChangeVolumeRemote");
        }

        let length_remote = agoraEngine['remoteUsers']['length'];

        for (let index = 0; index < length_remote; index++) {
            let uid_remote = agoraEngine['remoteUsers'][index]['uid'];
            // console.log("uid : "+uid_remote);

            if (div_id == uid_remote && agoraEngine['remoteUsers'][index]['audioTrack']) {
                // console.log("ไอดีตรงกัน");
                agoraEngine['remoteUsers'][index]['audioTrack'].setVolume(parseInt(value_slider));
            }

            //เช็คว่าสถานะ remote เปิดหรือปิดไมค์ แล้วส่งไปยังฟังก์ชันเปลี่ยน ไอคอนตามสถานะ
            if (!agoraEngine['remoteUsers'][index]['audioTrack']) {
                let type = "close";
                check_and_switch_icon_remote(div_id,type,value_slider);
            } else {
                let type = "open";
                check_and_switch_icon_remote(div_id,type,value_slider);
            }

        }

    }

    //============ โยกย้าย Div   =================//

    // ตรวจสอบว่า div อยู่ใน .user-video-call-bar หรือไม่
    function isInUserVideoCallBar(div) {
        return div.parentElement === document.querySelector(".user-video-call-bar");
    }

    // ย้าย div ไปยัง .user-video-call-bar หากไม่อยู่ในนั้นและสลับ div
    function moveDivsToUserVideoCallBar(clickedDiv) {
        let container = document.getElementById("container_user_video_call");
        let customDivs = container.querySelectorAll(".custom-div");
        let userVideoCallBar = document.querySelector(".user-video-call-bar");

        if(customDivs.length > 1){
            document.querySelector(".user-video-call-contrainer").classList.remove("d-none");

            customDivs.forEach(function(div) {
                if (div !== clickedDiv) { //ถ้า div ไม่ใช่ div ที่ถูกคลิก
                    if (!isInUserVideoCallBar(div)) { //ถ้า div ไม่ได้อยู่ใน div .user-video-call-bar
                        userVideoCallBar.appendChild(div);
                    }
                }
            });

            // ย้าย div ที่ถูกคลิกไปยังตำแหน่งที่ถูกคลิก
            if (!isInUserVideoCallBar(clickedDiv)) {
                container.appendChild(clickedDiv);
            }
        }

    }

    // ย้ายทุก div ใน .user-video-call-bar ไปยัง #container_user_video_call
    function moveAllDivsToContainer() {
        let container = document.getElementById("container_user_video_call");
        let userVideoCallBar = document.querySelector(".user-video-call-bar");
        let customDivsInUserVideoCallBar = userVideoCallBar.querySelectorAll(".custom-div");
        document.querySelector(".user-video-call-contrainer").classList.add("d-none");

        customDivsInUserVideoCallBar.forEach(function(div) {
            container.appendChild(div);
        });

    }

    function handleClick(clickedDiv) {
        let userVideoCallBar = document.querySelector(".user-video-call-bar");
        let customDivsInUserVideoCallBar = userVideoCallBar.querySelectorAll(".custom-div");
        console.log("handleClick OG : "+ checkHtml);

        if (checkHtml == false) {
            if (customDivsInUserVideoCallBar.length > 0) {
                moveAllDivsToContainer();
            } else {
                moveDivsToUserVideoCallBar(clickedDiv);
            }
        }else{
            checkHtml = false;
        }

    }

    // เพิ่ม event listener บน .user-video-call-bar สำหรับสลับ div
    document.querySelector(".user-video-call-bar").addEventListener("click", function(e) {
        if (e.target.classList.contains("custom-div")) {
            handleClick(e.target);
        }
    });

    // สร้างฟังก์ชันสำหรับการสลับข้อความของปุ่ม
    function toggleUserVideoCallBar() {
        var button = document.querySelector('.btn-show-hide-user-video-call');
        var videoCallBar = document.querySelector('.user-video-call-bar');

        if (videoCallBar.classList.contains('d-none')) {
            videoCallBar.classList.remove('d-none');
            document.getElementById("icon_show_hide").style.transform = "rotate(0deg)";
            document.querySelector('#text_show_hide').innerHTML = 'ซ่อน';

            document.querySelector("#container_user_video_call").removeAttribute('style');
        } else {
            videoCallBar.classList.add('d-none');
            document.getElementById("icon_show_hide").style.transform = "rotate(180deg)";
            document.querySelector('#text_show_hide').innerHTML = 'แสดง';

            // ใช้ค่า padding เริ่มต้นที่บันทึกไว้
            document.querySelector("#container_user_video_call").setAttribute('style','padding: 0;');

        }
    }

    //============ จบโยกย้าย Div   =================//

    function removeVideoDiv(elementId)
    {
        console.log("Removing "+ elementId+"Div");
        let Div = document.getElementById(elementId);
        if (Div)
        {
            Div.remove();
        }
    };

    function changeBgColor(bg_local){
        // เซ็ท bg-local เป็นสีที่ดูด
        console.log("ทำงาน "+bg_local)

        let agoraCreateLocalDiv = document.querySelector("#videoDiv_"+user_id);

        let divsInsideAgoraCreateLocal = agoraCreateLocalDiv.querySelector(".agora_create_local");
            let sub_div = divsInsideAgoraCreateLocal.querySelector("div");
                sub_div.style.backgroundColor = bg_local;

            if(isVideo == false){
                let video_tag = divsInsideAgoraCreateLocal.querySelector("video");
                    video_tag.remove();
            }
    }


    // เปิด-ปิด list ของไมค์
    $(document).ready(function() {
        $("#btn_switchMicrophone").click(function(event) {
            event.stopPropagation(); // หยุดการกระจายเหตุการณ์คลิกไปยัง document

            var targetId = $(this).attr("id"); // รับ id ของปุ่มที่ถูกคลิก

            if(document.querySelector('.open_dropcontent2')){
                $(".dropcontent2").removeClass("open_dropcontent2");
            }

            $(".dropcontent").toggleClass("open_dropcontent");

            // เพิ่มเหตุการณ์คลิกที่ document เพื่อปิด .dropcontent ถ้าคลิกที่นอกเหตุการณ์
            $(document).click(function(event) {
                if (!$(event.target).closest(".dropcontent").length) {
                    $(".dropcontent").removeClass("open_dropcontent");
                }
            });
        });
    });

    // เปิด-ปิด list ของกล้อง
    $(document).ready(function() {
        $("#btn_switchCamera").click(function(event) {
            event.stopPropagation(); // หยุดการกระจายเหตุการณ์คลิกไปยัง document

            var targetId = $(this).attr("id"); // รับ id ของปุ่มที่ถูกคลิก

            if(document.querySelector('.open_dropcontent')){
                $(".dropcontent").removeClass("open_dropcontent");
            }

            $(".dropcontent2").toggleClass("open_dropcontent2");

            // เพิ่มเหตุการณ์คลิกที่ document เพื่อปิด .dropcontent2 ถ้าคลิกที่นอกเหตุการณ์
            $(document).click(function(event) {
                if (!$(event.target).closest(".dropcontent2").length) {
                    $(".dropcontent2").removeClass("open_dropcontent2");
                }
            });
        });
    });

    // เพิ่ม event listener บนปุ่ม "เพิ่ม div"
    document.getElementById("addButton").addEventListener("click", createAndAttachCustomDiv);

    // ฟังก์ชันสุ่มสี
	function getRandomColor() {
		let letters = "0123456789ABCDEF";
		let color = "#";
		for (let i = 0; i < 6; i++) {
			color += letters[Math.floor(Math.random() * 16)];
		}
		return color;
	}

    function createAndAttachCustomDiv() {
		let randomColor = getRandomColor();
		let newDiv = document.createElement("div");
		newDiv.className = "custom-div";
		newDiv.style.backgroundColor = randomColor;

		// เพิ่ม div ด้านใน
		let statusInputOutputDiv = document.createElement("div");
		statusInputOutputDiv.className = "status-input-output";

		let micDiv = document.createElement("div");
		micDiv.className = "mic";
		micDiv.innerHTML = '<i class="fa-duotone fa-microphone"></i>';

		let cameraDiv = document.createElement("div");
		cameraDiv.className = "camera";
		cameraDiv.innerHTML = '<i class="fa-solid fa-video"></i>';

		statusInputOutputDiv.appendChild(micDiv);
		statusInputOutputDiv.appendChild(cameraDiv);

		let infomationUserDiv = document.createElement("div");

		// เพิ่ม div ด้านในลงใน div หลัก
		newDiv.appendChild(statusInputOutputDiv);
		newDiv.appendChild(infomationUserDiv);

		// เพิ่ม event listener สำหรับการคลิก
		newDiv.addEventListener("click", function() {
			handleClick(newDiv);
		});

		let userVideoCallBar = document.querySelector(".user-video-call-bar");
		let customDivsInUserVideoCallBar = userVideoCallBar.querySelectorAll(".custom-div");

		if (customDivsInUserVideoCallBar.length > 0) {
			userVideoCallBar.appendChild(newDiv);
		} else {
			document.getElementById("container_user_video_call").appendChild(newDiv);
		}
	}

</script>

<script>
    function find_location() {
		const geocoder = new google.maps.Geocoder();
        const infowindow = new google.maps.InfoWindow();

        // หาชื่อจังหวัด
		geocodeLatLng(geocoder, infowindow);

		// ---------------

		// onload_check_status_sos_map();

	}

    var all_address ;
    var check_status_done = 'yes'; // ไว้เช็คว่าทำตัวอัพเดตสถานะไปหรือยัง
    if ('{{$sos_data->status}}' === "เสร็จสิ้น") {
        check_status_done = 'yes';
    } else {
        check_status_done = 'no';
    }

	function geocodeLatLng(geocoder, map, infowindow) {
		// console.log("geocodeLatLng");
        const input = "{{ $sos_data->lat }}"+","+"{{ $sos_data->lng }}";
        const latlngStr = input.split(",", 2);
        const latlng = {
            lat: parseFloat(latlngStr[0]),
            lng: parseFloat(latlngStr[1]),
        };
        geocoder
            .geocode({ location: latlng })
            .then((response) => {
                if (response.results[0]) {

                	all_address = response.results[0].formatted_address ;

	                // console.log(response.results[0]);

                    // เข้าถึงชื่อจังหวัดจากผลลัพธ์
	                const addressComponents = response.results[0].address_components;

	                let cityName = ""; // ชื่อจังหวัด
	                let districtName = ""; // ชื่ออำเภอ (เขต)
	                let subdistrictName = ""; // ชื่อตำบล (แขวง)

	                for (const component of addressComponents) {
	                    for (const type of component.types) {
	                        if (type === "locality" || type === "administrative_area_level_1") {
	                            cityName = component.long_name;
	                        }
	                        if (type === "administrative_area_level_2") {
	                            districtName = component.long_name;
	                        }
	                        if (type === "administrative_area_level_3" || type === "locality") {
	                            subdistrictName = component.long_name;
	                        }
	                    }
	                }

	                if (cityName) {
	                    cityName = cityName.replaceAll("จังหวัด","");
	                	cityName = cityName.replaceAll("จ.","");
	                	cityName = cityName.replaceAll(" ","");
	                    // console.log("ชื่อจังหวัด: " + cityName);
	                }
	                if (districtName) {
	                    districtName = districtName.replaceAll("อำเภอ","");
	                	districtName = districtName.replaceAll("อ.","");
	                	districtName = districtName.replaceAll(" ","");
	                    // console.log("ชื่ออำเภอ (เขต): " + districtName);
	                }
	                if (subdistrictName) {
	                    subdistrictName = subdistrictName.replaceAll("ตำบล","");
	                	subdistrictName = subdistrictName.replaceAll("ต.","");
	                	subdistrictName = subdistrictName.replaceAll(" ","");
	                    // console.log("ชื่อตำบล (แขวง): " + subdistrictName);
	                }

	                if (cityName) {
	                	search_phone_niems(cityName ,districtName ,subdistrictName);
	                } else {
	                    console.log("ไม่พบชื่อจังหวัด");
	                }

                } else {
                    console.log("No results found");
                }
            })
            .catch((e) => window.alert("Geocoder failed due to: " + e));
    }

    function search_phone_niems(cityName ,districtName ,subdistrictName){

        fetch("{{ url('/') }}/api/sos_map/search_phone_niems/"+cityName)
            .then(response => response.json())
            .then(result => {
                // console.log("result phoneniems");
                // console.log(result);


                    if(result['1669'] != "no"){
                        @if(empty($sos_data->sos_1669_id))
                            document.querySelector('#name_1669_area').innerHTML = result['1669'] ;
                            document.querySelector('#btn_ask_1669').setAttribute('onclick' ,
                            "ask_to_1669('"+cityName+"','"+districtName+"','"+subdistrictName+"')");
                        @endif

                        document.querySelector('#btn_ask_1669').classList.remove('d-none');
                    }

                if(result['phone_niems'] != "no"){
                    let html_main ;
                    let html_sub ;
                    let content_phone_niems = document.querySelector('#content_phone_niems');

                    for (let i = 0; i < result['phone_niems'].length; i++) {

                        let phone_sp = result['phone_niems'][i]['phone'].split(",");

                        // console.log(phone_sp);

                        let sum_html = '' ;

                        for (let x = 0; x < phone_sp.length; x++) {
                            html_sub = `
                                <span class="mt-1 font-weight-bold text-primary p-2" style="width:80%; border-radius:5px;">
                                    `+phone_sp[x]+`
                                </span>
                                <br>
                            `;
                            sum_html = sum_html + html_sub ;
                        }

                        html = `
                            <p class="font-weight-bold text-dark" style="width:90%;">จ.`+result['phone_niems'][i]['province']+`</p>
                            `+sum_html+`
                            <hr>
                        `;

                        content_phone_niems.insertAdjacentHTML('beforeend', html); // แทรกล่างสุด

                    }
                }
        });
    }

    function ask_to_1669(cityName ,districtName ,subdistrictName){

        // console.log("ask_to_1669 >> " + cityName);

        let name = '{{ $sos_data->name }}';
        let phone = '{{ $sos_data->phone }}';
        let user_id = '{{ $sos_data->user_id }}';
        let lat = '{{ $sos_data->lat }}';
        let lng = '{{ $sos_data->lng }}';
        // let photo_sos_1669 = document.querySelector("#photo_sos_1669");
        let district_P = cityName;
        let district_A = districtName;
        let district_T = subdistrictName;

        // API UPLOAD IMG //
        let formData = new FormData();
        let imageFile = document.getElementById('photo_sos_1669').value;
            formData.append('photo_sos', imageFile);

        let data_sos_1669 = {
            "name_user" : name.value,
            "phone_user" : phone.value,
            "user_id" : user_id.value,
            "lat" : lat.value,
            "lng" : lng.value,
            "changwat" : district_P,
            "amphoe" : district_A,
            "tambon" : district_T,
            "all_address" : all_address,
        }
        // console.log(data_sos_1669);

        formData.append('name_user', data_sos_1669.name_user);
        formData.append('phone_user', data_sos_1669.phone_user);
        formData.append('user_id', data_sos_1669.user_id);
        formData.append('lat', data_sos_1669.lat);
        formData.append('lng', data_sos_1669.lng);
        formData.append('changwat', data_sos_1669.changwat);
        formData.append('amphoe', data_sos_1669.amphoe);
        formData.append('tambon', data_sos_1669.tambon);
        formData.append('all_address', data_sos_1669.all_address);
        formData.append('sos_map_id', "{{ $sos_data->id }}");

        fetch("{{ url('/') }}/api/create_new_sos_by_user", {
            method: 'POST',
            body: formData
        }).then(function (response){
            return response.text();
        }).then(function(data){
            // console.log(data);
            let name_admin = "{{ Auth::user()->name }}" ;

            if(data){
                fetch("{{ url('/') }}/api/sos_map/update_sos_1669_id/"+data+"/"+"{{ $sos_data->id }}" +"/"+ district_P +"/"+ name_admin)
                    .then(response => response.text())
                    .then(result => {
                        // console.log(result);
                        if(result == "ok"){
                            let html = `
                                <b>
                                    <span class="d-block" style="color: #ffffff;">ส่งต่อ 1669 แล้ว</span>
                                </b>
                            `;
                            document.querySelector('#content_1669').innerHTML = html ;
                            document.querySelector('#btn_ask_1669').setAttribute('onclick' ,"");

                            help_complete();

                            document.querySelector('#status_of_Room').innerHTML = 'สถานะ : <b class="text-success">เสร็จสิ้น</b>';
                            document.querySelector('#alert_text').innerHTML = "ส่งต่อ 1669 เรียบร้อยแล้ว";
                            document.querySelector('#alert_copy').classList.add('up_down');

                            const animated = document.querySelector('.up_down');
                            animated.onanimationend = () => {
                                document.querySelector('#alert_copy').classList.remove('up_down');
                            };

                            check_status_done = 'yes';

                            // เสียงแจ้งเตือน เวลาคนเข้า
                            let audio_ringtone_success = new Audio("{{ asset('sound/ยืนยัน.mp3') }}");
                            audio_ringtone_success.play();

                        }
                });
            }

        }).catch(function(error){
            // console.error(error);
        });
    }

    function help_complete(){

        let data_arr = [] ;

        let officer_id ;

        @if(!empty($sos_data->helper_id))
            officer_id = "{{ $sos_data->helper_id }}" ;
        @else
            fetch("{{ url('/') }}/api/sos_map/update_helper_id" + "/" + "{{ Auth::user()->id }}" + "/" + "{{ $sos_data->id }}")
                .then(response => response.text())
                .then(result => {
                    // console.log(result);
                    officer_id = result ;
                });
        @endif

        setTimeout(function() {

            data_arr = {
                "sos_map_id" : "{{ $sos_data->id }}",
                "officer_id" : officer_id,
                "groupId" : "{{ $groupId }}",
                "command_id" : "{{ Auth::user()->id }}",
            };

            fetch("{{ url('/') }}/api/sos_map/help_complete", {
                method: 'post',
                body: JSON.stringify(data_arr),
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

        }, 1500);

    }

    function check_status_sos(){
        fetch("{{ url('/') }}/api/check_status_sos_video_call" + "?sos_id="+'{{ $sos_data->id }}')
                .then(response => response.text())
                .then(result => {
                    // console.log(result);
                    if(result === "yes"){
                        let html = `
                                <b>
                                    <span class="d-block" style="color: #ffffff;">ส่งต่อ 1669 แล้ว</span>
                                </b>
                            `;
                            document.querySelector('#content_1669').innerHTML = html ;
                            document.querySelector('#btn_ask_1669').setAttribute('onclick' ,"");

                            document.querySelector('#status_of_Room').innerHTML = 'สถานะ : <b class="text-success">เสร็จสิ้น</b>';
                            document.querySelector('#alert_text').innerHTML = "ส่งต่อ 1669 เรียบร้อยแล้ว";
                            document.querySelector('#alert_copy').classList.add('up_down');

                            const animated = document.querySelector('.up_down');
                            animated.onanimationend = () => {
                                document.querySelector('#alert_copy').classList.remove('up_down');
                            };

                            check_status_done = 'yes';

                            // เสียงแจ้งเตือน เวลาคนเข้า
                            let audio_ringtone_success = new Audio("{{ asset('sound/ยืนยัน.mp3') }}");
                            audio_ringtone_success.play();
                    }
                });
    }

    if(type_video_call == "sos_map"){
        window.addEventListener('load', () => {
            // เรียกฟังก์ชัน check_status_sos() ทุก 10 วินาที
            setInterval(() => {
                if (check_status_done === 'no') {
                    check_status_sos();
                }
            }, 10000);
        });
    }


    function myStop_timer_video_call() {
        console.log("เข้ามาหยุด myStop_timer_video_call");
        setTimeout(() => {
            clearInterval(loop_timer_video_call);
            check_start_timer_video_call = false;

            document.getElementById("time_of_room").innerHTML = "";
            // document.getElementById("time_of_room").classList.add('d-none');
        }, 3000);

    }
    var audio_in_room = new Audio("{{ asset('sound/แจ้งเตือนก่อนหมดเวลาวิดีโอคอล.mp3') }}");

    function start_timer_video_call(){

        console.log('start_timer_video_call');
        // console.log(time_start);

        check_start_timer_video_call = true ;

        setTimeout(() => {

            // let time_of_room = document.getElementById("time_of_room");
            //     time_of_room.classList.remove('d-none');

            fetch("{{ url('/') }}/api/check_status_room" + "?sos_id="+ sos_id + "&type=" + type_video_call)
                .then(response => response.json())
                .then(result => {

                    // วันที่และเวลาที่กำหนด
                    let targetDate = '';
                    if (result['than_2_people_time_start']) {
                        targetDate = new Date(result['than_2_people_time_start']);
                    } else {
                        // targetDate = new Date(result['than_2_people_time_start']);
                        targetDate = new Date();
                    }

                    let targetTime = targetDate.getTime();

                    loop_timer_video_call = setInterval(function() {

                        // วันที่และเวลาปัจจุบัน
                        let currentDate = new Date();
                        let currentTime = currentDate.getTime();

                        // คำนวณเวลาที่ผ่านไปในมิลลิวินาที
                        let elapsedTime = currentTime - targetTime;
                        let elapsedMinutes = Math.floor(elapsedTime / (1000 * 60));

                        // แปลงเวลาที่ผ่านไปให้เป็นรูปแบบชั่วโมง:นาที:วินาที
                        let hours = Math.floor(elapsedMinutes / 60);
                        let minutes = elapsedMinutes % 60;
                        let seconds = Math.floor((elapsedTime / 1000) % 60);

                        let minsec = minutes + '.' + seconds;
                        let showTimeCountVideo;
                        // แสดงผลลัพธ์
                        let max_minute_time = 8;

                        // let remain_time = max_minute_time - 1;
                        // let time_warning = "";
                        // if (max_minute_time > 1) {
                        //     time_warning = (max_minute_time - remain_time);
                        // }else{
                        //     time_warning = "น้อยกว่า 1";
                        // }

                        if (hours > 0) {
                            if (minutes < 10) {  // ใส่ 0 ข้างหน้า นาที กรณีเลขยังไม่ถึง 10
                                showTimeCountVideo = hours + ':' + '0' + minutes + ':' + seconds + `&nbsp;/ `+max_minute_time+` นาที`;
                            }else{
                                showTimeCountVideo = hours + ':' + minutes + ':' + seconds + `&nbsp;/ `+max_minute_time+` นาที`;
                            }
                        } else {
                            if(seconds < 10){  // ใส่ 0 ข้างหน้า วินาที กรณีเลขยังไม่ถึง 10
                                showTimeCountVideo =  minutes + ':' + '0' + seconds + `&nbsp;/ `+max_minute_time+` นาที`;
                            }else{
                                showTimeCountVideo = minutes + ':' + seconds + `&nbsp;/ `+max_minute_time+` นาที`;
                            }
                        }

                        // // อัปเดตข้อความใน div ที่มี id เป็น timeCountVideo
                        time_of_room.innerHTML = '<i class="fa-regular fa-clock fa-fade" style="color: #11b06b; font-size: 16px;"></i>&nbsp;' + ": " + showTimeCountVideo;

                        if (minsec == 5.00) {
                            audio_in_room.play();
                            let alert_warning = document.querySelector('#alert_warning')
                            alert_warning.style.display = 'block'; // แสดง .div_alert

                            // document.querySelector('#alert_text').innerHTML = `เหลือเวลา `+ time_warning +` นาที`;
                            document.querySelector('#alert_text').innerHTML = `เหลือเวลา 3 นาที`;
                            alert_warning.classList.add('up_down');

                            const animated = document.querySelector('.up_down');
                            animated.onanimationend = () => {
                                document.querySelector('#alert_warning').classList.remove('up_down');
                                let alert_warning = document.querySelector('#alert_warning')
                                alert_warning.style.display = 'none'; // แสดง .div_alert
                            };
                        }

                        if (minsec == 7.00) {
                            audio_in_room.play();
                            let alert_warning = document.querySelector('#alert_warning')
                            alert_warning.style.display = 'block'; // แสดง .div_alert

                            // document.querySelector('#alert_text').innerHTML = `เหลือเวลา `+ time_warning +` นาที`;
                            document.querySelector('#alert_text').innerHTML = `เหลือเวลา 1 นาที`;
                            alert_warning.classList.add('up_down');

                            const animated = document.querySelector('.up_down');
                            animated.onanimationend = () => {
                                document.querySelector('#alert_warning').classList.remove('up_down');
                                let alert_warning = document.querySelector('#alert_warning')
                                alert_warning.style.display = 'none'; // แสดง .div_alert
                            };
                        }

                        if (elapsedMinutes == max_minute_time) {
                            document.querySelector('#leave').click();
                        }

                    }, 1000);


                });
        }, 2000);

    }


    let isIconVisible;
    let volumeIndicatorHandler = volumes => {
        volumes.forEach((volume) => {

            let localAudioTrackCheck = channelParameters.localAudioTrack;
            if (volume.level >= 50) {
                //แสดงชื่ออุปกรณ์ที่ใช้และระดับเสียง

                if (user_id == volume.uid && volume.level > 50) {
                    console.log('Enabled Device: ' + localAudioTrackCheck['_deviceName']);
                    console.log(`UID ${volume.uid} Level ${volume.level}`);

                    // แสดงปุ่มเสียงพูด"
                    if (!isIconVisible) {
                        document.querySelector('#statusMicrophoneOutput_local').classList.remove('d-none');
                        isIconVisible = true;
                    }
                }

            } else {

                if (user_id == volume.uid && volume.level <= 50) {
                    console.log('Enabled Device: ' + localAudioTrackCheck['_deviceName']);
                    console.log(`UID ${volume.uid} Level ${volume.level}`);

                    // ซ่อนปุ่มเสียงพูด"
                    if (isIconVisible) {
                        document.querySelector('#statusMicrophoneOutput_local').classList.add('d-none');
                        isIconVisible = false;
                    }

                }

            }
        });
    };


    function SoundTest() {
        // ตรวจจับเสียงพูดแล้ว สร้าง animation บนขอบ div
        agoraEngine.off("volume-indicator", volumeIndicatorHandler);
        agoraEngine.on("volume-indicator", volumeIndicatorHandler);
    }

    var check_start_volume_indicator = [];
    var status_remote_volume = [];
    function volume_indicator_remote(remote_id){
        console.log("ทำแล้วน้าาา volume_indicator_remote");
        check_start_volume_indicator[remote_id] = "yes";

        agoraEngine.on("volume-indicator", volumes => {
                volumes.forEach((volume, index) => {
                    console.log("เข้า foreach");
                    console.log(volume.uid);
                    if (remote_id == volume.uid && status_remote_volume[remote_id] == "yes") {
                        if (volume.level > 50) {
                            console.log(`Dummy_UID ${volume.uid} Level ${volume.level}`);
                            document.querySelector('#statusMicrophoneOutput_remote_'+remote_id).classList.remove('d-none');
                        } else if (volume.level <= 50) {
                            console.log(`Dummy_UID ${volume.uid} Level ${volume.level}`);
                            document.querySelector('#statusMicrophoneOutput_remote_'+remote_id).classList.add('d-none');
                        }
                    }else if(remote_id == volume.uid && status_remote_volume[remote_id] == "no") {
                        console.log("else ล่างสุด");
                        document.querySelector('#statusMicrophoneOutput_remote_'+remote_id).classList.add('d-none');
                    }

                    // if (remote_id == volume.uid && volume.level > 50) {
                    //     console.log(`Dummy_UID ${volume.uid} Level ${volume.level}`);
                    //     document.querySelector('#statusMicrophoneOutput_remote_'+remote_id).classList.remove('d-none');
                    // } else if (remote_id == volume.uid && volume.level <= 50) {
                    //     console.log(`Dummy_UID ${volume.uid} Level ${volume.level}`);
                    //     document.querySelector('#statusMicrophoneOutput_remote_'+remote_id).classList.add('d-none');
                    // }

                });
            })
    }

    function start_user_in_video_call(){

        // check_user_in_video_call = true;

        loop_check_div_user = setInterval(() => {
            console.log("start_user_in_video_call");
            let customDivAll = document.querySelectorAll(".custom-div");
            console.log("div count :"+customDivAll.length);

            if (customDivAll.length >= 2) {

                fetch("{{ url('/') }}/api/check_user_in_room_4" + "?sos_id=" + sos_id + "&type=" + type_video_call)
                .then(response => response.json())
                .then(result => {

                    let status_delete = "delete";

                    customDivAll.forEach(element => {

                        let id = element.id;

                        if (id.startsWith("videoDiv_")) {
                            // แยก UID จาก id โดยตัด "videoDiv_" ออก
                            let uid = id.replace("videoDiv_", "");


                            const promises = result['data'].map(data_user => {
                                return new Promise((resolve, reject) => {
                                    // ตรวจสอบว่า UID นี้อยู่ใน remoteUsers หรือไม่
                                    if (uid == data_user.id.toString()) {
                                        // ถ้าไม่มีให้ลบ element ออก
                                        status_delete = "not_delete";
                                    }
                                    // เมื่อเสร็จสิ้นให้เรียก resolve
                                    resolve();
                                });
                            });

                            Promise.all(promises)
                                .then(() => {
                                    if (status_delete == "delete") {
                                        element.remove();

                                        console.log("ลบ div ที่ค้าง")
                                    }
                                })
                                .catch(error => {
                                    // จัดการกับข้อผิดพลาด (ถ้ามี)
                                    console.error("catch error in promise :"+error);
                                });

                        }
                        else{
                            element.remove();
                        }



                    });

                })
                .catch(error => {
                    console.log("check_user_in_video_call error : "+error);
                });

            } // endif


        }, 15000);

    }

</script>

<script>
    let status_show_div_right = "show" ;

    function hide_or_show_Div(type , left_or_right) {
	    // let divDataLeft = document.getElementById('div_data_left');
	    let divDataRight = document.getElementById('div_data_right');

	    // let btn_left = document.querySelector('#btn_hide_or_show_Div_left');
	    // let icon_left = document.querySelector('#icon_hide_or_show_Div_left');

	    // let btn_right = document.querySelector('#btn_hide_or_show_Div_right');
	    // let icon_right = document.querySelector('#icon_hide_or_show_Div_right');

        let user_right_data = document.querySelector('#user_right_data');

	    if(left_or_right == "right"){

	    	status_show_div_right = type ;

	    	if(type == "show"){
                user_right_data.setAttribute('style','color: #1a6ce7; font-size: 30px')
		    	user_right_data.setAttribute('onclick' , "hide_or_show_Div('hide' , 'right');");
		    	// divDataRight.style.right = '5px';
		    	divDataRight.classList.add('active_div_data_right');
		    	divDataRight.classList.remove('Inactive_div_data_right');

		    	// func_check_dragstart_map();
		    }else{
                user_right_data.setAttribute('style','color: #ffffff; font-size: 30px')
		    	user_right_data.setAttribute('onclick' , "hide_or_show_Div('show' , 'right');");
		    	// divDataRight.style.right = '-310px';
		    	divDataRight.classList.remove('active_div_data_right');
		    	divDataRight.classList.add('Inactive_div_data_right');

                closeCheckboxAll(); // ปิดตัวปรับเสียงใน sidebar ทั้งหทด
		    }
	    }

	}

</script>

<!-- MAP พื้นที่การขอความช่วยเหลือในจังหวัด -->
<script>
    function initMap() {
        let map_sos_organization;
        let lat = Number("{{ $sos_data->lat }}");;
        let lng = Number("{{ $sos_data->lng }}");;

        let marker;
        map_sos_organization = new google.maps.Map(document.getElementById("sos_assistant_map"), {
            zoom: 14,
            center: {lat:lat, lng:lng },
        });

        let image = "https://www.viicheck.com/img/icon/flag_2.png";
        @if(!empty($sos_data->lat))
            marker = new google.maps.Marker({
                position: {lat: lat , lng: lng },
                map: map_sos_organization,
                icon: image,
                zIndex:5,
            });
        @endif

    }
</script>

<script>
    window.addEventListener('beforeunload', function(event) {
        if (leaveChannel == "false") {
            // leaveChannel();
            fetch("{{ url('/') }}/api/left_room_4" + "?user_id=" + '{{ Auth::user()->id }}' + "&type=" + type_video_call + "&sos_id=" + sos_id +"&meet_2_people=beforeunload"+"&leave=beforeunload")
                .then(response => response.text())
                .then(result => {
                    // console.log(result);
                    console.log("left_and_update สำเร็จ");
                    leaveChannel = "true";
            })
            .catch(error => {
                console.log("บันทึกข้อมูล left_and_update ล้มเหลว :" + error);
            });
        }
    });

    // window.addEventListener('beforeunload', function(event) {
    //     if (leaveChannel == "false") {
    //         const data = {
    //             user_id: '{{ Auth::user()->id }}',
    //             type: type_video_call,
    //             sos_id: sos_id,
    //         };

    //         const blob = new Blob([JSON.stringify(data)], { type: 'application/json' });
    //         console.log("Data to be sent:", data);
    //         navigator.sendBeacon("{{ url('/') }}/api/check_delete_member", blob);
    //         .then(response => {
    //             console.log("Response from server:", response);
    //         })
    //         .catch(error => {
    //             console.error("Error sending data:", error);
    //         });
    //     }
    // });

</script>


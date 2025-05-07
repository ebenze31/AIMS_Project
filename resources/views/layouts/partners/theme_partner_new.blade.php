
<!doctype html>
<html lang="en" class="color-sidebar sidebarcolor4 color-header headercolor4">


<head>

	<link href="{{ asset('partner_new/plugins/smart-wizard/css/smart_wizard_all.min.css') }}" rel="stylesheet" type="text/css" />
	<!-- loader-->
	<link href="{{ asset('partner_new/css/pace.min.css') }}" rel="stylesheet" />
	<script src="{{ asset('partner_new/js/pace.min.js') }}"></script>



	<!-- Required meta tags -->
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
	<!--favicon-->
	<link rel="shortcut icon" href="{{ asset('/partner_new/images/logo/aims full logo.png') }}" type="image/x-icon" />
	<!--plugins-->
	<link href="{{ asset('partner_new/plugins/simplebar/css/simplebar.css') }}" rel="stylesheet" />
	<link href="{{ asset('partner_new/plugins/perfect-scrollbar/css/perfect-scrollbar.css') }}" rel="stylesheet" />
	<link href="{{ asset('partner_new/plugins/metismenu/css/metisMenu.min.css') }}" rel="stylesheet" />
	<link href="{{ asset('partner_new/plugins/highcharts/css/highcharts.css') }}" rel="stylesheet" />
	<link href="{{ asset('partner_new/plugins/vectormap/jquery-jvectormap-2.0.2.css') }}" rel="stylesheet" />
	<link href="{{ asset('partner_new/plugins/smart-wizard/css/smart_wizard_all.min.css') }}" rel="stylesheet" type="text/css" />
	<link rel="stylesheet" href="{{ asset('partner_new/plugins/notifications/css/lobibox.min.css') }}" />
	<link href="{{ asset('/partner_new/plugins/datatable/css/dataTables.bootstrap5.min.css') }}" rel="stylesheet" />
	<!-- izitoast -->
	<link rel='stylesheet' href='https://unpkg.com/izitoast/dist/css/iziToast.min.css'>


	<link rel='stylesheet' href='https://unpkg.com/izitoast/dist/css/iziToast.min.css'>
	<!-- Bootstrap CSS -->
	<link href="{{ asset('partner_new/css/bootstrap.min.css') }}" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500&display=swap" rel="stylesheet">
	<link href="{{ asset('partner_new/css/app.css') }}" rel="stylesheet">
	<link href="{{ asset('partner_new/css/icons.css') }}" rel="stylesheet">
	<!-- Theme Style CSS -->
	<link rel="stylesheet" href="{{ asset('partner_new/css/dark-theme.css') }}" />
	<link rel="stylesheet" href="{{ asset('partner_new/css/semi-dark.css') }}" />
	<link rel="stylesheet" href="{{ asset('partner_new/css/header-colors.css') }}" />
	<!-- fontawesome icon -->
    <link rel="stylesheet" href="{{ asset('/partner/fonts/fontawesome/css/fontawesome-all.min.css') }}">
 	<link href="https://kit-pro.fontawesome.com/releases/v6.7.2/css/pro.min.css" rel="stylesheet">

	<!-- carousel -->
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.theme.default.min.css">


    <!-- font -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Baloo+Bhaijaan+2:wght@600;700;800&family=Prompt:wght@500&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Kanit:wght@300&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Sarabun:wght@100;400&family=Taviraj&display=swap" rel="stylesheet">
    <!-- datatables -->
    {{-- <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.24/css/jquery.dataTables.min.css" /> --}}

	<title id="title_theme">AIMS</title>

	<style>
		.main-shadow{
            box-shadow: 0 4px 4px 0 rgba(0, 0, 0, 0.15), 0 4px 10px 0 rgba(0, 0, 0, 0.15);
        }
        .main-radius{
            border-radius: 5px;
        }

        .profile-circle {
            width: 75px; /* ปรับขนาดตามที่คุณต้องการ */
            height: 75px; /* ปรับขนาดตามที่คุณต้องการ */
            object-fit: cover; /* ปรับขนาดภาพให้เต็มพื้นที่องค์ประกอบ */
            border-radius: 50%; /* ทำให้รูปเป็นวงกลม */
            border-style: solid;
            border-width: 3px;
            border-color: lightblue;
        }

		.notify_alert{
          animation-name: notify_alert;
          color: red;
          animation-duration: 4s;
          animation-iteration-count: 99;
        }

        .notify_alert_gotohelp{
          animation-name: notify_alert_gotohelp;
          color: #ffffff;
          background-color: red;
          animation-duration: 4s;
          animation-iteration-count: 99;
        }

        a.disabled {
		  pointer-events: none;
		  cursor: default;
		  opacity: 0.2;
		}

		.main-disabled {
		  pointer-events: none;
		  cursor: default;
		  opacity: 0.4;
		}

        @keyframes notify_alert {
          0%   {color: red;}
          20%  {color: yellow;}
          40%  {color: red;}
          60% {color: yellow;}
          80%   {color: red;}
          100%  {color: yellow;}

        }

        @keyframes notify_alert_gotohelp {
          0%   {background-color: red;
          		color: #ffffff;}
          20%  {background-color: yellow;
          		color: #000000;}
          40%  {background-color: red;
          		color: #ffffff;}
          60% {background-color: yellow;
          		color: #000000;}
          80%   {background-color: red;
          		color: #ffffff;}
          100%  {background-color: yellow;
          		color: #000000;}

        }

		.bg-color-progressbar {
		  animation-name: change-color;
		  animation-duration: 10s;
		  animation-timing-function: linear;
		  animation-iteration-count: infinite;
		  background-color: green;
		  animation-play-state: running;
		}

		@keyframes change-color {
		  0% {background-color: green;}
		  30% {background-color: yellow;}
		  50% {background-color: orange;}
		  100% {background-color: red;}
		}

		.border-color-change-color {
		  animation-name: change-color-border;
		  animation-duration: 10s;
		  animation-timing-function: linear;
		  animation-iteration-count: infinite;
		  border-width: 2px;
		  border-style: solid;
		  border-radius: 20px;
		  border-color: green;
		  animation-play-state: running;
		}

		@keyframes change-color-border {
		  0% {border-color: green;}
		  30% {border-color: yellow;}
		  50% {border-color: orange;}
		  100% {border-color: red;}
		}

		.iziToast_forward {
		  	border: 10px solid yellow;
		  	animation: change-bordercolors;
		  	animation-play-state: running;
		  	animation-duration: 10s;
		  	animation-timing-function: linear;
		  	animation-iteration-count: infinite;
		  	background-image: url("https://www.viicheck.com/img/icon/sos_warning.gif") !important;
		}

		@keyframes change-bordercolors {
		  0% { border-color: yellow; }
		  10% { border-color: red; }
		  20% { border-color: yellow; }
		  30% { border-color: red; }
		  40% { border-color: yellow; }
		  50% { border-color: red; }
		  60% { border-color: yellow; }
		  70% { border-color: red; }
		  80% { border-color: yellow; }
		  90% { border-color: red; }
		  100% { border-color: yellow; }
		}
		.userSosWait {
			-webkit-transition: all 0.2s;
			-o-transition: all 0.2s;
			transition: all 0.2s;
			padding: .5rem;

		}

		.userSosWait:hover {
			background-color: #f8f9fa;
			border-radius: 10px;
			margin-top: -.25rem;
			margin-bottom: .25rem;
			-webkit-box-shadow: 0 0.5rem 1rem 0 rgba(0, 0, 0, 0.2);
			box-shadow: 0 0.25rem 0.5rem 0 rgba(0, 0, 0, 0.2);
		}.btnSosWait{
			outline: 1px solid #dee2e6;
			border-radius: .375rem;
			background-color: #fff;
			padding:  .5rem 1rem;
			color: #2b2a2a;
			font-family: 'Mitr', sans-serif;
			transition: all .15s ease-in-out;


		}
		.btnSosWait:hover{
			border: 1px solid #dee2e6;
			background-color: #2b2a2a;
			color: #fff;
			outline-offset: .1rem;

		}
	</style>
	<!-- for sos -->
	<style>
        .owl-nav {
            display: flex;
            justify-content: space-between;
        }

        .owl-stage {
            display: -webkit-box;
            display: -moz-box;
            display: -ms-box;
            display: box;
            padding-top: 1rem;
        }

        .owl-carousel .owl-nav {
            display: flex;
            justify-content: space-between;
            align-items: center;

        }
        .owlOfficer .owl-nav .owl-prev {
            background-color: #000000;
            border-radius: 50%;
            margin-left: -10px;
            margin-top: -5.5rem;
        }

        .owlOfficer .owl-nav .owl-next {
            background-color: #000000;
            border-radius: 50%;
            margin-right: -30px!important;
            margin-top: -5.5rem;

        }

        .owlItemOfficer {
            -webkit-transition: all 0.2s;
            -o-transition: all 0.2s;
            transition: all 0.2s;
            padding: .5rem;

        }

        .owlItemOfficer:hover {
            background-color: #f8f9fa;
            border-radius: 10px;
            margin-top: -.25rem;
            margin-bottom: .25rem;
            -webkit-box-shadow: 0 0.5rem 1rem 0 rgba(0, 0, 0, 0.2);
            box-shadow: 0 0.25rem 0.5rem 0 rgba(0, 0, 0, 0.2);
        }

        .owlItemOfficer {
            display: flex;
            align-items: center;
            padding: .5rem 1rem;
        }

        .owlNameOfficer {
            color: #000000;
            font-family: 'Mitr', sans-serif;
        }

        .owl-next span,
        .owl-prev span {
            font-size: 2rem;
        }

        .badgeImg {
            position: relative;
            display: inline-block;
        }

        .badgeOnImg {
            position: absolute;
            color: #fff;
            background-color: #f5424e;
            font-size: 10px;
            padding: 1px 5px;
            border-radius: 8px;
            top: -5px;
            right: -5px;
        }

        .headerOwl {
            display: block;
            height: 18px;
            border-bottom: solid 1px #000;
            text-align: left;
        }

        .headerOwl span {
            display: inline-block;
            background-color: #fff;
            padding: 0 10px;
            font-family: 'Mitr', sans-serif;
        }

        .headerCardOfficer {
            font-family: 'Mitr', sans-serif;
        }

        .cardAlertOfficer {
            padding: 1rem;
        }

        .iziToast-buttons{
        	width: 100% !important;
        }

        .width-40{
        	width: 40% !important;
        }

        /*.iziToast-texts{
        	width: 100% !important;
        }*/


        /*แจ้งเตือน SOS ยังไม่ได้ดำเนินการ*/


.nav-wait-officer .nav-link.active {
		border-color: red red #fff !important;
        font-family: 'Mitr', sans-serif;
		color: red !important;
	}.nav-wait-data .nav-link.active {
		border-color: blue blue #fff !important;
        font-family: 'Mitr', sans-serif;
		color: blue !important;
	}
	.btnCloseModal{
		position: absolute;
		top: 5px;
		right: 5px;
	}

/*ปุ่ม ค้นหา level เจ้าหน้าที่ใน map */
.level {
    width: 38px !important;
    height: 38px !important;
    padding: 10px;
    border-radius: 50%;
    font-size: 13px;
    font-weight: bold;
    display: flex;
    align-items: center;
    justify-content: center;
}

.FR {
    background-color: #24b333;
    color: white;
}

.BLS {
    background-color: #fac831;
    color: drak;
}

.ILS {
    background-color: #faa507;
    color: drak;
}

.ALS {
    background-color: #ce1124;
    color: white;

}



.menu-select-one-lv-all ,.menu-select-lv-all{
    background-color: #fff!important;
    color: #8833ff !important;
    border: #8833ff 1px solid !important;
    border-radius: 5px 0 0 5px !important;
}
.all-active {
    background-color: #8833ff !important;;
    color: #ffffff !important;
}

.menu-select-one-lv-fr ,.menu-select-lv-fr{
    background-color: #fff!important;
    color: #24b333 !important;
    border: #24b333 1px solid !important;
    border-radius: 0px !important;
}
.fr-active {
    background-color: #24b333 !important;
    color: #ffffff !important;
}

.menu-select-one-lv-bls ,.menu-select-lv-bls{
   background-color: #fff!important;
    color: #fac831 !important;
    border: #fac831 1px solid !important;
    border-radius: 0px !important;
}
.bls-active {
    background-color: #fac831!important;
    color: #ffffff !important;
}

.menu-select-one-lv-ils ,.menu-select-lv-ils{
    background-color: #fff!important;
    color: #faa507 !important;
    border: #faa507 1px solid !important;
    border-radius: 0px !important;
}
.ils-active {
    background-color: #faa507!important;
    color: #ffffff !important;
}

.menu-select-one-lv-als ,.menu-select-lv-als{
    background-color: #fff!important;
    color: #ce1124 !important;
    border: #ce1124 1px solid !important;
    border-radius:  0 5px 5px  0!important;
}
.als-active {
    background-color: #ce1124!important;
    color: #ffffff !important;
}

.gm-style-iw{
    max-width: 250px !important;
    padding: 500px;
}.btn-select-officer{
    width:50px!important;
    color:white!important;
    background-color:#24b333!important;
    border-radius:25px !important;
}
.btn-select-officer:hover{
    color:#24b333!important;
    background-color:white!important;
    border:1px solid #24b333;
}

.menu-select-vehicle-officer-all{
    background-color: #fff!important;
    color: #00438c !important;
    border: #00438c 1px solid !important;
    border-radius: 25px !important;

}


.menu-select-vehicle-officer-car{
    background-color: #fff!important;
    color: #00438c !important;
    border: #00438c 1px solid !important;
    border-radius: 25px !important;
}

.menu-select-vehicle-officer-motorbike{
    background-color: #fff!important;
    color: #00438c !important;
    border: #00438c 1px solid !important;
    border-radius: 25px !important;
}


.menu-select-vehicle-officer-aircraft{
    background-color: #fff!important;
    color: #00438c !important;
    border: #00438c 1px solid !important;
    border-radius:25px!important;
}



.menu-select-vehicle-officer-boat-1{
    background-color: #fff!important;
    color: #00438c !important;
    border: #00438c 1px solid !important;
    border-radius: 25px !important;
}

.menu-select-vehicle-officer-boat-2{
    background-color: #fff!important;
    color: #00438c !important;
    border: #00438c 1px solid !important;
    border-radius: 25px !important;
}

.menu-select-vehicle-officer-boat-3{
    background-color: #fff!important;
    color: #00438c !important;
    border: #00438c 1px solid !important;
    border-radius:25px !important;
}

.menu-select-vehicle-officer-boat-other{
    background-color: #fff!important;
    color: #00438c !important;
    border: #00438c 1px solid !important;
    border-radius: 25px !important;
}




.menu-select-vehicle-all{
    background-color: #fff!important;
    color: #00438c !important;
    border: #00438c 1px solid !important;
    border-radius: 25px !important;

}

.menu-select-vehicle-motorbike{
    background-color: #fff!important;
    color: #00438c !important;
    border: #00438c 1px solid !important;
    border-radius: 25px !important;
}


.menu-select-vehicle-car{
    background-color: #fff!important;
    color: #00438c !important;
    border: #00438c 1px solid !important;
    border-radius: 25px !important;
}


.menu-select-vehicle-aircraft{
    background-color: #fff!important;
    color: #00438c !important;
    border: #00438c 1px solid !important;
    border-radius:25px!important;
}



.menu-select-vehicle-boat-1{
    background-color: #fff!important;
    color: #00438c !important;
    border: #00438c 1px solid !important;
    border-radius: 25px !important;
}

.menu-select-vehicle-boat-2{
    background-color: #fff!important;
    color: #00438c !important;
    border: #00438c 1px solid !important;
    border-radius: 25px !important;
}

.menu-select-vehicle-boat-3{
    background-color: #fff!important;
    color: #00438c !important;
    border: #00438c 1px solid !important;
    border-radius:25px !important;
}

.menu-select-vehicle-boat-other{
    background-color: #fff!important;
    color: #00438c !important;
    border: #00438c 1px solid !important;
    border-radius: 25px !important;
}


.vehicle-one-officer-active {
    background-color: #00438c !important;
    color: #ffffff !important;
}




/*
.countWaiting{
	position: absolute;
	top: -12px;
  left: -12px;
  background-color: blue;
  color: white;
  width: 24px;
  height: 24px;
  font-size: 16px;
  border-radius: 50%;
  display: flex;
  align-items: center;
  justify-content: center;
} */

@keyframes border-flash-danger {
  0% {
    box-shadow: 0 0 0 2px white;
  }
  50% {
    box-shadow: 0 0 0 2px red;
  }
  100% {
    box-shadow: 0 0 0 2px white;
  }
}

@keyframes border-flash-blue {
  0% {
    box-shadow: 0 0 0 2px white;
  }
  50% {
    box-shadow: 0 0 0 2px blue;
  }
  100% {
    box-shadow: 0 0 0 2px white;
  }
}
    .notification_group{
		position: fixed;
		bottom: 20px;
			left: 60px;
		float: right;
		z-index: 99999;

	}
	.notification-icon {
		position: relative;
		margin-right: 10px;
		width: 50px;
		height: 50px;
		border-radius: 50%;
		display: flex;
		align-items: center;
		justify-content: center;
		cursor: pointer;
		z-index: 99999;
		/* animation: border-flash 1s infinite; */
	}
	.notification-count {
		position: absolute;
		top: -12px;
		right: -12px;
		/* background-color: red; */
		color: white;
		width: 24px;
		height: 24px;
		font-size: 16px;
		border-radius: 50%;
		display: flex;
		align-items: center;
		justify-content: center;
	}
	.count-danger{
		background-color: red;
	}

	.count-blue{
		background-color: blue;
	}

	.notification-danger{
		background-color: #fc6d6d;
		animation: border-flash-danger 1s infinite;
	}
	.notification-primary{
		background-color: #4e73ff;
		animation: border-flash-blue 1s infinite;
	}.badge-pill{
		font-size: .8rem;
	}

    .theme-notification-menu {
        position: absolute;
        top: 10px;
        left: 78% !important;
        color: #f5950f;
        width: 30px;
        height: 30px;
        font-size: 18px;
        border-radius: 50%;
        z-index: 999999!important;
    }
    .theme-notification-call {
        position: absolute;
        left: 85% !important;
        color: #ADFF2F;
        width: 20px;
        height: 20px;
        font-size: 18px;
        z-index: 9999;
    }
    .theme-notification-refuse {
        position: absolute;
        left: 75% !important;
        color: red;
        width: 20px;
        height: 20px;
        font-size: 18px;
        z-index: 9999;
    }

</style>

</head>

<body>
	<!-- ///// แจ้งเตือน SOS ยังไม่ได้ดำเนินการ ///// -->
	<div class="notification_group">

		<!-- <button data-toggle="modal" data-target="#modal_show_sos_wait" onclick="click_show_data_sos_hepl_wait('wait');">asdas</button> -->

		<!-- div_noti_wait -->
		<div id="div_noti_wait" class="notification-icon d-none float-end notification-danger" data-toggle="modal" data-target="#modal_show_sos_wait" onclick="click_show_data_sos_hepl_wait('wait');">
		  	<span class="notification-count count-danger">
		  		<span class="text-white" id="show_count_sos_wait">0</span>
		  	</span>
		  	<i class="fa-solid fa-light-emergency-on fa-shake text-white" style="font-size: 18px;"></i>
		</div>
		<!-- div_noti_helping -->
		<div id="div_noti_helping" class="notification-icon d-none float-end notification-primary" data-toggle="modal" data-target="#modal_show_sos_wait" onclick="click_show_data_sos_hepl_wait('helping');">
		  	<span class="notification-count count-blue">
		  		<span class="text-white" id="show_count_sos_helping">0</span>
		  	</span>
		  	<!-- <i class="fa-solid fa-light-emergency-on fa-shake text-white" style="font-size: 18px;"></i> -->
		  	<i class="fa-duotone fa-spinner fa-spin-pulse text-white" style="font-size: 18px;"></i>
		</div>
	</div>

<!-- Modal -->
<div class="modal fade" id="modal_show_sos_wait" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-lg modal-dialog-centered" role="document">
		<div class="modal-content">
			<div class="modal-body">
				<div class="card-body">
					<ul class="nav nav-tabs mb-0" role="tablist">
						<li class="nav-item nav-wait-data col-6" role="presentation">
							<a id="li_show_helping" class="nav-link" data-bs-toggle="tab" href="#wait_data" role="tab" aria-selected="false">
								<div class="d-flex align-items-center">
									<div class="tab-icon">
										<i class="bx bx-bookmark-alt font-18 me-1"></i>
									</div>
									<div class="tab-title">เคสที่ดำเนินการอยู่</div>
								</div>
							</a>
						</li>
						<li class="nav-item nav-wait-officer col-6" role="presentation">
							<a id="li_show_wait" class="nav-link active " data-bs-toggle="tab" href="#modal_show_sos_wait_body" role="tab" aria-selected="true">
								<div class="d-flex align-items-center">
									<div class="tab-icon">
										<i class="bx bx-comment-detail font-18 me-1"></i>
									</div>
									<div class="tab-title"> เคสรอสั่งการ </div>
								</div>
							</a>
						</li>
					</ul>
					<button type="button" class="btnCloseModal btn" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
					<div class="tab-content pt-3">
						<div class="tab-pane fade active" id="modal_show_sos_wait_body" role="tabpanel">
							<!-- รอสั่งการ -->

							<!-- Mock up รอสั่งการ -->
							<div class="userSosWait d-flex align-items-center border-top border-bottom p-2 cursor-pointer">
								<div class="mr-5">
									<img src="http://localhost/Collect-all-cars/public/img/stickerline/PNG/21.png" class="imgSos" width="70" height="70" alt="" />
								</div>
								<div class="ms-2">
									<h6 class="mb-1 font-14">lucky</h6>
									<p class="mb-0 font-13 text-secondary">081-234-5678</p>
									<span class="badge badge-pill bg-light-danger text-danger " > <span>ผ่านมาแล้ว</span> <span>15 นาที</span></span>
								</div>
								<div class="list-inline d-flex  ms-auto">
									<a onclick="sos_1669_command_by('{{ Auth::user()->id }}' , `+ result[i_wait]['id'] +`);" class="btnSosWait">สั่งการ</a>
								</div>
							</div>
							<!-- END Mock up รอสั่งการ -->

						</div>
						<style>
							.mr{
								margin-right: .5rem	!important;
							}.pl{
								padding-left: .5rem !important;
							}.imgSos{
								border-radius: 5px;
								object-fit: cover;
								margin-right: .7rem;
							}
						</style>

						<div class="tab-pane fade" id="wait_data" role="tabpanel">
							<!-- เคสที่ดำเนินการอยู่ -->


							<!-- Mock up เคสที่ดำเนินการอยู่ -->
							<div class="userSosWait d-flex align-items-center border-top border-bottom p-2 cursor-pointer">
								<div class="mr-5">
									<img src="http://localhost/Collect-all-cars/public/img/stickerline/PNG/21.png" class="imgSos" width="70" height="70" alt="" />
								</div>

								<div class="w-100 pl">
									<div class="d-flex align-items-center">
										<h6	h6 class="d-flex align-items-center mr"> 2050-1553-1551</h6>
										<span class="badge badge-pill bg-light-danger text-danger mr" > IDC <br> เขียว </span>
										<span class="badge badge-pill bg-light-danger text-danger mr" > RC <br> แดง </span>
										<span class="badge badge-pill bg-light-danger text-danger ms-auto" > ออกจากฐาน </span>
									</div>

									<div class="d-flex align-items-center row mt-2">
										<div class="col-6 border-right">
											<h6 class="mb-1 font-14">ข้อมูลผู้ขอความช่วยเหลือ</h6>
											<p class="mb-0 font-13 text-secondary">lucky</p>
											<p class="mb-0 font-13 text-secondary">081-234-5678</p>

										</div>
										<div class="col-6">
											<div class="w-100">
												<span class="mb-1 font-14 h5">ข้อมูลหน่วยปฏิบัติการ</span>
												<div class="float-end">
													<span class="badge badge-pill bg-light-danger text-danger mr" > aa </span>
													<span class="badge badge-pill bg-light-danger text-danger" > aa </span>
												</div>
											</div>
											<p class="mb-0 font-13 text-secondary">ชื่อเจ้าหน้าที่ : Thanakorn</p>
											<p class="mb-0 font-13 text-secondary">หน่วยปฏิบัติการ : วีเช็ค</p>
										</div>
									</div>
								</div>

							</div>
							<!-- END Mock up เคสที่ดำเนินการอยู่ -->

						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

	<!--wrapper-->
	<div class="wrapper">
		<!--sidebar wrapper -->
		<div id="switcher-wrapper_menu" class="sidebar-wrapper menu-background" data-simplebar="true">
			<div id="header-wrapper_menu" class="sidebar-header menu-background">
                <div>
                    <img src="{{ url('/partner_new/images/logo/aims logo.png') }}" class="logo-icon">
                </div>
                <div>
                    <a href="{{ url('/partner_index') }}" >
                        <h4 id="h4_name_partner" class="logo-text mt-2 mx-1" style="font-family: 'Baloo Bhaijaan 2', cursive;
                        font-family: 'Prompt', sans-serif;">AIMS</h4>
                    </a>
                    <span class="d-none" id="span_sub_partner" style="margin-left: 5px;"></span>
                </div>
                <div class="toggle-icon ms-auto">
                    <i class='bx bx-first-page'></i>
                </div>
			</div>
			<!--navigation-->
			<ul class="metismenu" id="menu" style="font-family: 'Baloo Bhaijaan 2', cursive;font-family: 'Prompt', sans-serif;">

				<!-- Admin -->
				@if(Auth::check())
                    @if(Auth::user()->role == "admin-partner" || Auth::user()->role == "admin-area")
						<li>
							<a href="#" class="has-arrow">
								<div class="parent-icon">
                                    <i class="fas fa-user-shield"></i>
								</div>
								<div class="menu-title">การจัดการ</div>
							</a>
							<ul>
								<li>
									<a href="{{ url('/all_name_user_partner') }}">
                                        <i class='fas fa-users-cog'></i> สมาชิกศูนย์ควบคุม
                                    </a>
								</li>
                                <li>
                                    <a href="{{ url('/aims_emergency_types') }}">
                                        <i class="fa-solid fa-messages-question"></i> ประเภทการช่วยเหลือ
                                    </a>
                                </li>
                                <li>
                                    <a href="{{ url('/aims_type_units') }}">
                                        <i class="fa-solid fa-house-medical-circle-exclamation"></i> ประเภทหน่วยปฏิบัติการ
                                    </a>
                                </li>
								<li>
									<a href="{{ url('/operating_unit') }}">
                                        <i class="fa-solid fa-truck-medical"></i> หน่วยปฏิบัติการ
                                    </a>
								</li>
                            </ul>
                        </li>
                        
                        <li>
                            <a href="#" class="has-arrow">
                                <div class="parent-icon">
                                    <i class="fa-solid fa-gear"></i>
                                </div>
                                <div class="menu-title">ตั้งค่า</div>
                            </a>
                            <ul>
                                @if(Auth::user()->role == "admin-partner")
                                <li>
                                    <a href="{{ url('/') }}">
                                        <i class="fa-solid fa-building-magnifying-glass"></i> ข้อมูลองค์กร
                                    </a>
                                </li>
                                @endif
                                <li>
                                    <a href="{{ url('/') }}">
                                        <i class='far fa-map'></i><span> พื้นที่</span>
                                    </a>
                                </li>
                                <li>
                                    <a href="{{ url('/') }}">
                                        <i class="fa-regular fa-calendar-clock"></i>
                                        <span> เวลาทำการ</span>
                                    </a>
                                </li>
                            </ul>
                        </li>
					@endif
				@endif
				<!-- Admin -->

                <li>
                    <a href="{{ url('/') }}">
                        <div class="parent-icon">
                            <i class="fa-solid fa-chart-line"></i>
                        </div>
                        <div class="menu-title">Dashboard</div>
                    </a>
                </li>

                <li>
                    <a href="{{ url('/') }}">
                        <div class="parent-icon">
                            <i class="fa-solid fa-user-headset"></i>
                        </div>
                        <div class="menu-title">ควบคุมและสั่งการ</div>
                    </a>
                </li>

				<br>

			</ul>
			<!--end navigation-->
		</div>
		<!--end sidebar wrapper -->

		<!--start header -->
		<header style="font-family: 'Baloo Bhaijaan 2', cursive;font-family: 'Prompt', sans-serif;">
			<div id="div_color_navbar" class="topbar d-flex align-items-center header_nav-background" style="background-color: #250c37;">
				<nav class="navbar navbar-expand d-flex">
					<div class="mobile-toggle-menu">
						<i class='bx bx-menu'></i>
					</div>
					<div class="top-menu-left d-none d-lg-block">
						<ul id="partner_full_name" class="nav text-white">
                            <!--  -->
					  	</ul>
				 	</div>

					<style>

					.tabsStatusOfficer {
						display: flex;
						position: relative;
						background-color: #fff;
						box-shadow: 0 0 1px 0 rgba(24, 94, 224, 0.15), 0 6px 12px 0 rgba(24, 94, 224, 0.15);
						padding: 0.75rem;
						border-radius: .5rem;
						width: 20rem;
					}

					.tabsStatusOfficer * {
						z-index: 2;
						font-family: 'Mitr', sans-serif;
					}

					.containerStatusofficer input[type="radio"] {
						display: none;
					}
					.containerStatusofficer{
						margin-right: 0px;
					}

					/* .containerStatusofficer * {
						outline: #000 1px solid;
					} */
					.tabOfficer {
						position: relative;
						display: flex;
						align-items: center;
						justify-content: center;
						height: 30px;
						width: 30%;
						font-size: .8rem;
						color: black;
						font-weight: 500;
						border-radius: .5rem;
						cursor: pointer;
						transition: color 0.15s ease-in;
					}

					.notiStatusOfficer {
						display: flex;
						align-items: center;
						justify-content: center;
						width:  30%;
						height: .8rem;
						position: absolute;
						top: -5px;
						right: 0;
						font-size: 10px;
						margin-left: 0.75rem;
						border-radius: .5rem;
						margin: 0px;
						background-color: #e6eef9;
						transition: 0.15s ease-in;
					}

					.containerStatusofficer input[type="radio"]:checked+.radio-1 {
						color: blue;
					}

					.containerStatusofficer input[type="radio"]:checked+.radio-2 {
						color: #11c77c;
					}
					.containerStatusofficer input[type="radio"]:checked+.radio-3{
						color: #817e81;
					}


					.containerStatusofficer input[type="radio"]:checked+label>.notiStatusOfficer {
						background-color: #0000ff;
						color: #fff;
						margin: 0px;
					}

					.containerStatusofficer input[id="officerHelping"]:checked~.glider {
						transform: translateX(0);
						background-color: rgb(0, 0, 255 , 0.2);
					}

					.containerStatusofficer input[id="officerStandby"]:checked~.glider {
						transform: translateX(100%);
						background-color: rgb(17, 199, 124 , 0.2);
					}

					.containerStatusofficer input[id="officerNAN"]:checked~.glider {
						transform: translateX(200%);
						background-color: rgb(129, 126, 129 , 0.2);
					}

					.glider {
						position: absolute;
						display: flex;
						height: 30px;
						width:27.5%;
						z-index: 1;
						border-radius: .5rem;
						transition: 0.25s ease-out;
					}

					@media (max-width: 700px) {

						.tabsStatusOfficer {
							transform: scale(0.6);
						}
					}

					/* @media (max-width: 10px) {

					.tabsStatusOfficer {
						display: none;
					}
					} */
					.lds-ring {
						display: inline-block;
						position: relative;
						width: 10px;
						height: 10px;
					}
					.lds-ring div {
					box-sizing: border-box;
					display: block;
					position: absolute;
					width: 8px;
					height: 8px;
					/* margin: 8px; */
					border: .3px solid #fff;
					border-radius: 50%;
					animation: lds-ring 1.2s cubic-bezier(0.5, 0, 0.5, 1) infinite;
					border-color: #000 transparent transparent transparent;
					}
					.lds-ring div:nth-child(1) {
					animation-delay: -0.45s;
					}
					.lds-ring div:nth-child(2) {
					animation-delay: -0.3s;
					}
					.lds-ring div:nth-child(3) {
					animation-delay: -0.15s;
					}
					@keyframes lds-ring {
					0% {
						transform: rotate(0deg);
					}
					100% {
						transform: rotate(360deg);
					}
					}
					</style>

					<div class="containerStatusofficer ms-auto">
						<div id="switcher_status_command" class="tabsStatusOfficer d-none">
							<!-- ปุ่ม modal -->
							<input type="radio" id="officerHelping" name="tabsStatusOfficer"  onclick="click_switch_officer_1669();">
							<label class="tabOfficer radio-1" for="officerHelping">
								ช่วยเหลือ
								<span id="notiStatusOfficer" class="notiStatusOfficer">
									<div class="lds-ring"><div></div><div></div><div></div><div></div></div>
								</span>
							</label>

							<input type="radio" id="officerStandby" name="tabsStatusOfficer" onclick="click_switch_officer_1669();">
							<label class="tabOfficer radio-2" for="officerStandby">พร้อม</label>

							<input type="radio" id="officerNAN" name="tabsStatusOfficer" onclick="click_switch_officer_1669();">
							<label class="tabOfficer radio-3" for="officerNAN">ไม่พร้อม</label>
							<span class="glider"></span>
						</div>
					</div>
                    
			 		<!-- switch officer 1669 -->
					<style>
						.toggle-switch {
						  position: relative;
						  display: inline-block;
						  width: 80px;
						  height: 40px;
						  cursor: pointer;
						}

						.toggle-switch input[type="checkbox"] {
						  display: none;
						}

						.toggle-switch-background {
						  position: absolute;
						  top: 0;
						  left: 0;
						  width: 100%;
						  height: 100%;
						  background-color: #ddd;
						  border-radius: 20px;
						  box-shadow: inset 0 0 0 2px #ccc;
						  transition: background-color 0.3s ease-in-out;
						}

						.toggle-switch-handle {
						  position: absolute;
						  top: 5px;
						  left: 5px;
						  width: 30px;
						  height: 30px;
						  background-color: #fff;
						  border-radius: 50%;
						  box-shadow: 0 2px 5px rgba(0, 0, 0, 0.2);
						  transition: transform 0.3s ease-in-out;
						}

						.toggle-switch::before {
						  content: "";
						  position: absolute;
						  top: -25px;
						  right: -35px;
						  font-size: 12px;
						  font-weight: bold;
						  color: #aaa;
						  text-shadow: 1px 1px #fff;
						  transition: color 0.3s ease-in-out;
						}

						.toggle-switch input[type="checkbox"]:checked + .toggle-switch-handle {
						  transform: translateX(45px);
						  box-shadow: 0 2px 5px rgba(0, 0, 0, 0.2), 0 0 0 3px #05c46b;
						}

						.toggle-switch input[type="checkbox"]:checked + .toggle-switch-background {
						  background-color: #05c46b;
						  box-shadow: inset 0 0 0 2px #04b360;
						}

						.toggle-switch input[type="checkbox"]:checked + .toggle-switch:before {
						  content: "On";
						  color: #05c46b;
						  right: -15px;
						}

						.toggle-switch input[type="checkbox"]:checked + .toggle-switch-background .toggle-switch-handle {
						  transform: translateX(40px);
						}

					</style>

				    <!-- END switch officer 1669 -->

					<div class="search-bar flex-grow-1 header-notifications-list header-message-list">
						<div class="position-relative search-bar-box">
							<input type="text" class="form-control search-control" placeholder="Type to search..."> <span class="position-absolute top-50 search-show translate-middle-y"><i class='bx bx-search'></i></span>
							<span class="position-absolute top-50 search-close translate-middle-y"><i class='bx bx-x'></i></span>
						</div>
					</div>
					<!-- <div class="top-menu ms-auto">
					</div> -->



					 <div class="user-box dropdown">
						<a class="d-flex align-items-center nav-link dropdown-toggle dropdown-toggle-nocaret" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
							<div class="user-info ps-3">
								<p id="command_name" class="user-name mb-0" style="max-width:200px;white-space: nowrap;overflow: hidden;text-overflow: ellipsis;">
                                    <!-- command name -->
                                </p>
								<p id="command_role" class="designattion mb-0">
                                    <!-- command role -->
								</p>
							</div>
						</a>
						<ul class="dropdown-menu dropdown-menu-end">
                            <li>
                                <a class="dropdown-item" href="{{ url('/aims_edit_profile') }}">
                                    <i class="fa-solid fa-user-pen"></i><span>แก้ไขโปรไฟล์</span>
                                </a>
                            </li>
							<li>
                                <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();document.getElementById('logout-form').submit();">
                                    <i class='bx bx-log-out-circle'></i><span>ออกจากระบบ</span>
                                </a>
                                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                    @csrf
                                </form>
							</li>
						</ul>
					</div>
				</nav>
			</div>
		</header>
		<!--end header -->
		<!--start page wrapper -->
		<div class="page-wrapper">
			<div class="page-content" style="margin-top:-25px;">
				<br>
			  	@yield('content')
			</div>
		</div>
		<!--end page wrapper -->
		<!--start overlay-->
		<div class="overlay toggle-icon"></div>
		<!--end overlay-->
		<!--Start Back To Top Button--> <a href="javaScript:;" class="back-to-top"><i class='bx bxs-up-arrow-alt'></i></a>
		<!--End Back To Top Button-->
		<footer class="page-footer">
			<p class="mb-0">Power By 2B-Green</p>
		</footer>
	</div>
	<!--end wrapper-->


    <!-- Button trigger modal -->
	<button id="btn_modal_notify" type="button" class="btn btn-primary d-none" data-toggle="modal" data-target="#modal_notify">
	</button>

	<div class="modal fade" id="asd" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" >
	  	<div class="modal-dialog modal-dialog-centered modal-sm " role="document"style="right: -411px;z-index: 10040;">
	    	<div class="modal-content">
	      		<div class="modal-body text-center" style="padding:0px;">
	      			<a id="tag_a_modal_notify_img" href="" target="bank">
		        		<img src="{{ asset('/img/icon/zoom-in.png') }}" style="position:absolute;right: 10px;bottom: 10px;width: 20px;">
		    		</a>
	        		<img src="" alt="" id="modal_notify_img">
	      		</div>
    		</div>
	  	</div>
	</div>

	<!-- Modal -->
	<div class="modal fade " id="modal_notify" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	  	<div class="modal-dialog modal-dialog-centered modal-md" role="document">
	    	<div class="modal-content">
		      	<div class="modal-header " style="background-color:#D85261;">
		        	<h4 class="modal-title text-white text-center"  id="exampleModalLabel">
                        <b>แจ้งเตือน<br>การขอความช่วยเหลือ</b>
                    </h4>
					<img id="img_sos_map" width="180px" height="180px" style="border-radius: 10%; object-fit:cover;" src="{{ asset('/img/stickerline/PNG/21.png') }}">
		      	</div>
      			<div class="modal-body text-center" style="padding:0px;">
			  		<br>
			  		<div class="row">
				  		<div class="col-12">
		                    <h2 class="text-info"><b id="modal_notify_name">คุณ : </b></h2>
						</div>
						<div class="card-body">
							<ul class="list-group list-group-flush">
								<li class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
									<h4 class="mb-0">เวลา</h4>
									<span class="text-secondary" style="font-size:25px;" id="modal_notify_time"></span>
								</li>
								<li class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
									<h4 class="mb-0">เบอร์</h4>
									<span class="text-secondary" style="font-size:25px;" id="modal_notify_phone"></span>
								</li>
								<li class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
									<h4 class="mb-0">สถานที่</h4>
									<span class="text-secondary" style="font-size:25px;" id="modal_notify_name_area"></span>
								</li>
							</ul>
						</div>
	      			</div>
			     	<div class="modal-footer">
				     	<!-- <button id="btn_go_to_help" type="button" style="border-radius: 25px;" class="btn notify_alert_gotohelp" >
				     		<i class="fa-solid fa-truck-medical"></i> กำลังไปช่วยเหลือ
				     	</button> -->

				        <a id="btn_view_data" type="button" style="border-radius: 25px; background-color:#408AF4" class="btn text-white">
				        	<i class="fal fa-eye"></i> ดำเนินการ
				        </a>
				        <a id="tag_a_link_ggmap" target="bank" class="btn text-white" style="border-radius: 25px; background-color:#26A664">
				        	<i class="far fa-map-marker-alt"></i>ดูแผนที่
				        </a>
			      	</div>
	    		</div>
	  		</div>
		</div>
	</div>

	<!-- //////////////////// -->
	<!-- ///MODAL ASK MORE/// -->
	<!-- //////////////////// -->
	<style>
		.map_select_officer_ask_more {
	      	height: calc(60vh);
	    }
	</style>
	<button id="btn_modal_select_officer_ask_more" type="button" class="btn btn-primary d-none" data-toggle="modal" data-target="#modal_select_officer_ask_more"></button>

	<!-- Modal -->
	<div class="modal fade" id="modal_select_officer_ask_more" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="Label_modal_select_officer_ask_more" aria-hidden="true" style="z-index:999999;">
	  	<div class="modal-dialog modal-xl" role="document">
		    <div class="modal-content">
		      	<div class="modal-header">
		        	<h3 class="modal-title" id="Label_modal_select_officer_ask_more">
		        		การขอหน่วยปฏิบัติการเพิ่ม รหัสปฏิบัติการ : 000
		        	 </h3>
		        	<button id="btn_close_modal_ask_modal" type="button" class="close d-none" data-dismiss="modal" aria-label="Close">
		          		<span aria-hidden="true">&times;</span>
		        	</button>
		      	</div>
		      	<div class="modal-body">
		        	<div class="row">
	                    <div class="col-8">
	                    	<div class="card">
								<ul class="list-group mt-1 list-group-flush" id="text_header_ask_more">
									<!-- <h4>
										ต้องการ <b style="font-size:30px;" id="type_vahicle_ask_more">รถ</b>
										รหัสเหตุการณ์ <b style="font-size:30px;" id="rc_ask_more" class="text-warning">เหลือง(เร่งด่วน)</b>
										จำนวน <b  style="font-size:30px;" id="quantity_vahicle_ask_more">1</b>
									</h4> -->
								</ul>
							</div>
	                        <div class="map_select_officer_ask_more" id="map_select_officer_ask_more" class="d-none"></div>
	                    </div>
	                    <div class="col-4" style="display: flex;flex-direction: column;">
	                        <div class="card radius-10 w-100">
	                            <div class="card-body">
	                                <div class="d-flex align-items-center">
	                                    <div>
	                                        <h5 class="mb-0">ข้อมูลเจ้าหน้าที่</h5>
	                                    </div>
	                                </div>
	                            </div>

                                <div class="row text-center mb-3">
                                    <div class="col-12">
                                        <button id="btn_search_officer_by_type_ask_more" onclick="search_by_officer_ask_more('type');" type="button" class="btn btn-sm btn-info">
                                            ค้นหาจากประเภท
                                        </button>
                                        <button id="btn_search_officer_by_name_ask_more" onclick="search_by_officer_ask_more('name');" type="button" class="btn btn-sm btn-outline-info">
                                            ค้นหาจากชื่อ
                                        </button>
                                        <button id="btn_search_officer_by_unit_ask_more" onclick="search_by_officer_ask_more('unit');" type="button" class="btn btn-sm btn-outline-info">
                                            ค้นหาจากหน่วย
                                        </button>
                                    </div>
                                </div>

                                <center>
                                    <input style="width: 90%;" id="div_search_name_officer_ask_more" type="text" class="form-control mb-3 d-none" name="" placeholder="ค้นหา.." oninput="search_nameofficer_delay_ask_more();">
                                </center>

                                <center>
                                    <select style="width: 90%;" id="div_search_unit_officer_ask_more" class="form-control mb-3 d-none" onchange="change_select_unit_offiecr_ask_more();">
                                        <option>เลือกหน่วย</option>
                                    </select>
                                </center>

	                            <!-- BTN Select Level -->
	                            <div id="div_carousel_vehicle_ask_more" class="chat-tab-menu ">
	                                <ul class="nav nav-pills nav-justified">
	                                    <li class="nav-item">
	                                        <a id="btn_select_level_all_ask_more" class="nav-link  menu-select-lv-all ask_more-select-lv-all" href="javascript:;" onclick="document.querySelector('#select_officer_ask_more_level').value = 'all';select_officer_ask_more_btn_menu_select();">
	                                            <div class="font-24">ALL
	                                            </div>
	                                            <div><small>ทั้งหมด</small>
	                                            </div>
	                                        </a>
	                                    </li>
	                                    <li class="nav-item">
	                                        <a class="nav-link  menu-select-lv-fr ask_more-select-lv-fr" href="javascript:;" onclick="document.querySelector('#select_officer_ask_more_level').value = 'fr';select_officer_ask_more_btn_menu_select();">
	                                            <div class="font-24">FR
	                                            </div>
	                                            <div>
	                                                <small>เบื้องต้น</small>
	                                            </div>
	                                        </a>
	                                    </li>
	                                    <li class="nav-item">
	                                        <a class="nav-link menu-select-lv-bls ask_more-select-lv-bls" href="javascript:;" onclick="document.querySelector('#select_officer_ask_more_level').value = 'bls';select_officer_ask_more_btn_menu_select();">
	                                            <div class="font-24">BLS
	                                            </div>
	                                            <div><small>ทั่วไป</small>
	                                            </div>
	                                        </a>
	                                    </li>
	                                    <li class="nav-item">
	                                        <a class="nav-link menu-select-lv-ils ask_more-select-lv-ils" href="javascript:;" onclick="document.querySelector('#select_officer_ask_more_level').value = 'ils';select_officer_ask_more_btn_menu_select();">
	                                            <div class="font-24">ILS
	                                            </div>
	                                            <div><small>กลาง</small>
	                                            </div>
	                                        </a>
	                                    </li>
	                                    <li class="nav-item">
	                                        <a class="nav-link menu-select-lv-als ask_more-select-lv-als" href="javascript:;" onclick="document.querySelector('#select_officer_ask_more_level').value = 'als';select_officer_ask_more_btn_menu_select();">
	                                            <div class="font-24">ALS
	                                            </div>
	                                            <div><small>สูง</small>
	                                            </div>
	                                        </a>
	                                    </li>
	                                </ul>
	                                <input class="d-none" type="text" name="select_officer_ask_more_level" id="select_officer_ask_more_level" value="all">
	                            </div>

	                            <!-- BTN Select vehicle  -->
	                            <div id="div_carousel_level_ask_more" class="owl-carousel owl-theme owlmenu-vehicle-ask_more p-3">
	                                <div class="item" style="width:100%">
	                                    <a id="btn_select_vehicle_all_ask_more" class="btn menu-select-vehicle-all ask_more-select-vehicle-all" href="javascript:;" onclick="document.querySelector('#select_officer_ask_more_vehicle_type').value = 'all';select_officer_ask_more_btn_menu_select();">
	                                        ทั้งหมด
	                                    </a>
	                                </div>
                                    <div class="item" style="width:100%">
                                        <a class="btn menu-select-vehicle-motorbike ask_more-select-vehicle-motorbike" href="javascript:;" onclick="document.querySelector('#select_officer_ask_more_vehicle_type').value = 'หน่วยเคลื่อนที่เร็ว';select_officer_ask_more_btn_menu_select();">
                                            หน่วยเคลื่อนที่เร็ว
                                        </a>
                                    </div>
	                                <div class="item" style="width:100%">
	                                    <a class="btn menu-select-vehicle-car ask_more-select-vehicle-car" href="javascript:;" onclick="document.querySelector('#select_officer_ask_more_vehicle_type').value = 'รถ';select_officer_ask_more_btn_menu_select();">
	                                        รถ
	                                    </a>
	                                </div>
	                                <div class="item" style="width:100%">
	                                    <a class="btn menu-select-vehicle-aircraft ask_more-select-vehicle-aircraft" href="javascript:;" onclick="document.querySelector('#select_officer_ask_more_vehicle_type').value = 'อากาศยาน';select_officer_ask_more_btn_menu_select();">
	                                        อากาศยาน
	                                    </a>
	                                </div>
	                                <div class="item" style="width:100%">
	                                    <a class="btn menu-select-vehicle-boat-1 ask_more-select-vehicle-boat-1" href="javascript:;" onclick="document.querySelector('#select_officer_ask_more_vehicle_type').value = 'เรือ ป.1';select_officer_ask_more_btn_menu_select();">
	                                        เรือ ป.1
	                                    </a>
	                                </div>
	                                <div class="item" style="width:100%">
	                                    <a class="btn menu-select-vehicle-boat-2 ask_more-select-vehicle-boat-2" href="javascript:;" onclick="document.querySelector('#select_officer_ask_more_vehicle_type').value = 'เรือ ป.2';select_officer_ask_more_btn_menu_select();">
	                                        เรือ ป.2
	                                    </a>
	                                </div>
	                                <div class="item" style="width:100%">
	                                    <a class="btn menu-select-vehicle-boat-3 ask_more-select-vehicle-boat-3" href="javascript:;" onclick="document.querySelector('#select_officer_ask_more_vehicle_type').value = 'เรือ ป.3';select_officer_ask_more_btn_menu_select();">
	                                        เรือ ป.3
	                                    </a>
	                                </div>
	                                <div class="item" style="width:100%">
	                                    <a class="btn  menu-select-vehicle-boat-other ask_more-select-vehicle-boat-other" href="javascript:;" onclick="document.querySelector('#select_officer_ask_more_vehicle_type').value = 'เรือประเภทอื่นๆ';select_officer_ask_more_btn_menu_select();">
	                                        เรืออื่นๆ
	                                    </a>
	                                </div>
	                            </div>

	                            <input class="d-none" type="text" name="select_officer_ask_more_vehicle_type" id="select_officer_ask_more_vehicle_type" value="all">

	                            <input class="d-none" type="text" id="ask_more_id">
	                            <input class="d-none" type="text" id="list_select_officer_ask_more">

	                            <div class="data-officer p-3 mb-3" style="overflow: auto;max-height: 450px;" id="select_officer_ask_more_card_data_operating">
	                                <!-- ข้อมูลหน่วยปฏิบัติการในพื้นที่ -->
	                            </div>

                                <!-- div tag a เพื่อไปสู่เคสหลัก -->
                                <div id="div_tag_a_to_case_main" class="d-"></div>
                                
	                            <div class="div_bottom" style="margin-top: auto;">
	                                <center>
	                                    <p id="show_error_noselect_officer_ask_more" class="text-danger d-none">กรุณาเลือกหน่วยปฏิบัติการ</p>
	                                    <span id="btn_send_data_joint_sos_ask_more" class="mt-3 btn btn-primary main-shadow main-radius" style="width: 60%;" >
	                                        เลือก <b><span id="show_count_select_operating_officer_ask_more">0</span></b> หน่วย
	                                    </span>
	                                </center>
	                                <br>
	                            </div>
	                        </div>
	                    </div>
	                </div>
		      	</div>
		    </div>
	  	</div>
	</div>


<script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.0/jquery.min.js'></script>
<script src='https://unpkg.com/izitoast/dist/js/iziToast.min.js'></script>
<!-- Bootstrap JS -->
<script src="{{ asset('partner_new/js/bootstrap.bundle.min.js') }}"></script>
<!--plugins-->
<script src="{{ asset('partner_new/js/jquery.min.js') }}"></script>
<script src="{{ asset('partner_new/plugins/simplebar/js/simplebar.min.js') }}"></script>
<script src="{{ asset('partner_new/plugins/metismenu/js/metisMenu.min.js') }}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js"></script>
<script src="{{ asset('partner_new/plugins/perfect-scrollbar/js/perfect-scrollbar.js') }}"></script>
<script src="{{ asset('partner_new/plugins/vectormap/jquery-jvectormap-2.0.2.min.js') }}"></script>
<script src="{{ asset('partner_new/plugins/vectormap/jquery-jvectormap-world-mill-en.js') }}"></script>
<script src="{{ asset('partner_new/plugins/highcharts/js/highcharts.js') }}"></script>
<script src="{{ asset('partner_new/plugins/smart-wizard/js/jquery.smartWizard.min.js') }}"></script>
<script src="{{ asset('partner_new/plugins/highcharts/js/exporting.js') }}"></script>
<script src="{{ asset('partner_new/plugins/highcharts/js/variable-pie.js') }}"></script>
<script src="{{ asset('partner_new/plugins/highcharts/js/export-data.js') }}"></script>
<script src="{{ asset('partner_new/plugins/highcharts/js/accessibility.js') }}"></script>
<script src="https://cdn.jsdelivr.net/npm/apexcharts"></script><!-- apexcharts -->
<script src="{{ asset('partner_new/plugins/datatable/js/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('partner_new/plugins/datatable/js/dataTables.bootstrap5.min.js') }}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.3/umd/popper.min.js" integrity="sha384-vFJXuSJphROIrBnz7yo7oB41mKfc8JzQZiCq4NCceLEaO4IHwicKwpJf9c9IpFgh" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/js/bootstrap.min.js" integrity="sha384-alpBpkh1PFOepccYVYDB4do5UnbKysX5WZXm3XxPqe5iKTfUKjNkCk9SaVuEZflJ" crossorigin="anonymous"></script>

<script>
	new PerfectScrollbar('.dashboard-top-countries');
</script>
<script src="{{ asset('partner_new/js/index.js') }}"></script>
<!--app JS-->
<script src="{{ asset('partner_new/js/app.js') }}"></script>
<!-- dataTables -->
<!-- <script src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script> -->

<!--notification js -->
<script src="{{ asset('partner_new/plugins/notifications/js/lobibox.min.js') }}"></script>
<script src="{{ asset('partner_new/plugins/notifications/js/notifications.min.js') }}"></script>
<script src="{{ asset('partner_new/plugins/notifications/js/notification-custom-script.js') }}"></script>

<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBgrxXDgk1tgXngalZF3eWtcTWI-LPdeus&language=th" ></script>


@php
    $user_id = Auth::user()->id ;
    $partner_of_user = App\Models\Aims_command::where('user_id' , $user_id)->first();
    $officer_role = $partner_of_user->officer_role ;
@endphp
<script>

    document.addEventListener('DOMContentLoaded', (event) => {
        // console.log("START");
        check_data_partner();
        check_sos_alarm();

        // ตั้งให้ทำซ้ำทุก 5 วินาที
        setInterval(check_sos_alarm, 5000);

        if("{{ $officer_role }}" == "admin-partner"){
            document.querySelector('#switcher_status_command').classList.add('d-none');
        }
        else{
            document.querySelector('#switcher_status_command').classList.remove('d-none');
        }
    });

    function check_data_partner(){

        let user_id = "{{ Auth::user()->id }}";
            // console.log(user_id);

        fetch("{{ url('/') }}/api/theme/check_data_partner/" + user_id)
            .then(response => response.json())
            .then(result => {
                // console.log(result);

                if(result){
                    let command_name = document.querySelector('#command_name');
                    let command_role = document.querySelector('#command_role');
                    let partner_full_name = document.querySelector('#partner_full_name');
                    // let h4_name_partner = document.querySelector('#h4_name_partner');

                    command_name.innerHTML = result[0].command_name ;
                    partner_full_name.innerHTML = result[0].partner_name + " - " + result[0].partner_full_name ;
                    // h4_name_partner.innerHTML = result[0].partner_name ;

                    if (result[0].command_role == "operator-area") {
                        command_role.innerHTML = "เจ้าหน้าที่สั่งการ" ;
                    }
                    else if(result[0].command_role == "admin-area"){
                        command_role.innerHTML = "แอดมินพื้นที่" ;
                    }
                    else if(result[0].command_role == "admin-partner"){
                        command_role.innerHTML = "แอดมินองค์กร" ;
                    }

                    change_switch_officer_to(result[0].status_command);
                }

            });

    }

    function click_switch_officer_1669(){
        let switch_officer = document.querySelector('#officerStandby');
        let officer_helping = document.querySelector('#officerHelping');


        if (switch_officer.checked) {
            change_switch_officer_to('Standby');

        } else if (officer_helping.checked){
            change_switch_officer_to('Helping');
        }else{
            change_switch_officer_to('');
        }
    }

    function change_switch_officer_to(change_to){

        // console.log("change_switch_officer_to >> " + change_to);

        if (change_to == 'Standby'){
            document.querySelector('#officerStandby').checked = true ;
        }else if(change_to == 'Helping'){
            document.querySelector('#officerHelping').checked = true ;
        }else{
            document.querySelector('#officerNAN').setAttribute("checked", "") ;
            change_to = 'null' ;
        }

        let user_id = "{{ Auth::user()->id }}";

        fetch("{{ url('/') }}/api/change_status_command" + '/' + change_to + '/' + user_id)
            .then(response => response.text())
            .then(result => {
                // console.log(result)
        });

    }

    function check_sos_alarm(){

        console.log("check_sos_alarm");
        var audio = new Audio("{{ asset('sound/Alarm Clock.mp3') }}");

        fetch("{{ url('/') }}/api/check_sos_alarm/" + "{{ Auth::user()->id }}")
            .then(response => response.json())
            .then(result => {

                if(result['status'] == "alarm"){
                    console.log(result);
                    audio.play();
                    alert("รับแจ้งเหตุ SOS ID : " + result['data'].aims_emergency_id);
                }
        });
    }

</script>

</body>

</html>

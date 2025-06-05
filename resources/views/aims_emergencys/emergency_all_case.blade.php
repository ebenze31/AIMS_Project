@extends('layouts.partners.theme_partner_new')

@section('content')

<div class="card radius-10 border-top border-0 border-4 border-primary">
    <div class="card-body p-3">
        <div class="card-title d-flex align-items-center justify-content-between">
        	<div class="d-flex align-items-center">
	            <div>
	                <i class="fa-solid fa-user-headset me-1 font-22"></i>
	            </div>
	            <h5 class="mb-0">
	                เคสทั้งหมด
	            </h5>
        	</div>
            <div class="input-group" style="width: 40%;">
				<button class="btn btn-outline-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
					ค้นหาจาก
				</button>
				<ul class="dropdown-menu" style="margin: 0px;">
					<li>
						<a class="dropdown-item" href="#">รหัสเคส</a>
					</li>
					<li>
						<a class="dropdown-item" href="#">Action</a>
					</li>
					<li>
						<a class="dropdown-item" href="#">Action</a>
					</li>
					<li>
						<a class="dropdown-item" href="#">Action</a>
					</li>
				</ul>
				<input type="text" class="form-control" placeholder="ค้นหาจาก รหัสเคส">
				<button class="btn btn-outline-secondary" type="button"><i class="fa-solid fa-magnifying-glass fa-flip-horizontal"></i></button>
			</div>
        </div>
        <hr>
        <div id="div_content_all_case">
        	<!-- div_content_all_case -->
        </div>
        <div id="div_navigation" class="float-end">
			<!-- div_navigation -->
        </div>
    </div>
</div>

<script>
	document.addEventListener("DOMContentLoaded", function() {
		get_data_case_all();
    });

    function get_data_case_all(page = 1) {
		let user_id = "{{ Auth::user()->id }}";

		fetch("{{ url('/') }}/api/get_data_case_all/" + user_id + "?page=" + page)
			.then(response => response.json())
			.then(result => {

				let data = result.data;
				let total = result.total;
				let perPage = result.per_page;
				let currentPage = result.current_page;

				let div_content_all_case = document.querySelector('#div_content_all_case');
				div_content_all_case.innerHTML = "";

				for (let i = 0; i < data.length; i++) {
					let d = data[i];

					let time_sum_sos = ``;
					if(d.time_sum_sos){
						time_sum_sos = `<b>เวลาช่วยเหลือ :</b> ${d.time_sum_sos}`;
					}

					let name_officer_command = ``;
					if(d.name_officer_command){
						name_officer_command = `<h5 class="mb-1">สั่งการโดย : ${d.name_officer_command}</h5>`;
					}

					let html_officer = ``;
					if(d.name_officer){
						html_officer = `
							<span style="font-size: 16px;">
								เจ้าหน้าที่ช่วยเหลือ : ${d.name_officer || '-'}<br>
								หน่วย : ${d.name_unit || '-'}<br>
								ประเภท : ${d.name_type_unit || '-'}
							</span>
						`;
					}

					let html = `
						<div class="card mt-2 radius-10 border">
							<div class="card-body row">
								<div class="col-8">
									<h4>รหัสเคส : ${d.operating_code || '-'}</h4>
								</div>
								<div class="col-4">
									<div class="float-end">
										<span class="btn btn-sm radius-30" style="${getStatusStyle(d.status)}">
											<b class="mx-4">${d.status || '-'}</b>
										</span>
									</div>
								</div>
								<div class="col-2">
									<div class="p-1 mt-1 radius-10 overflow-hidden" style="${getLvStyle(d.idc)}">
										<div class="text-center">
											<p class="mb-0 text-white">IDC</p>
											<p class="mb-0 text-white">${d.idc || '-'}</p>
										</div>
									</div>
									<div class="p-1 mt-1 radius-10 overflow-hidden" style="${getLvStyle(d.rc)}">
										<div class="text-center">
											<p class="mb-0 text-white">RC</p>
											<p class="mb-0 text-white">${d.rc || '-'}</p>
										</div>
									</div>
								</div>
								<div class="col-4">
									<h5 class="mb-1">ผู้แจ้งเหตุ : ${d.name_reporter || '-'}</h5>
									<span style="font-size: 16px;">
										เบอร์โทรผู้แจ้ง : ${d.phone_reporter || '-'}<br>
										ประเภทผู้แจ้ง : ${d.type_reporter || 'ไม่ได้ระบุ'}<br>
										ประเภทเหตุ : ${d.emergency_type || 'ไม่ได้ระบุ'}
									</span>
								</div>
								<div class="col-6">
									${name_officer_command}
									${html_officer}
								</div>
								<div class="col-12"><hr></div>
								<div class="col-6">
									<span style="font-size: 14px;">
										<b>เวลาแจ้งเหตุ :</b> ${d.created_at ? formatThaiDate(d.created_at) : '-'}<br>
										${time_sum_sos}
									</span>
								</div>
								<div class="col-6">
									<div class="float-end">
										<a href="{{ url('/command_operations/${d.id}') }}" type="button" class="btn btn-info">
											<b class="mx-4">ดูข้อมูล</b>
										</a>
									</div>
								</div>
							</div>
						</div>
					`;

					div_content_all_case.insertAdjacentHTML('beforeend', html);
				}

				// สร้าง Navigation
				let div_navigation = document.querySelector('#div_navigation');
				div_navigation.innerHTML = "";

				let totalPages = Math.ceil(total / perPage);
				if (totalPages < 1) totalPages = 1;

				let html_navigation = `
					<nav aria-label="...">
						<ul class="pagination">
							<li class="page-item ${currentPage == 1 ? 'disabled' : ''}">
								<a class="page-link" href="javascript:;" tabindex="-1" aria-disabled="${currentPage == 1}" onclick="get_data_case_all(${currentPage - 1})">«</a>
							</li>
				`;

				for (let i = 1; i <= totalPages; i++) {
					if (i === currentPage) {
						html_navigation += `
							<li id="navigation_${i}" class="page-item" aria-current="page">
								<a class="page-link" href="javascript:;">${i} <span class="visually-hidden">(current)</span></a>
							</li>
						`;
					} else {
						html_navigation += `
							<li id="navigation_${i}" class="page-item">
								<a class="page-link" href="javascript:;" onclick="get_data_case_all(${i})">${i}</a>
							</li>
						`;
					}
				}

				html_navigation += `
							<li class="page-item ${currentPage == totalPages ? 'disabled' : ''}">
								<a class="page-link" href="javascript:;" aria-disabled="${currentPage == totalPages}" onclick="get_data_case_all(${currentPage + 1})">»</a>
							</li>
						</ul>
					</nav>
				`;

				div_navigation.innerHTML = html_navigation;

				setTimeout(() => {
				  	let activeItem = document.querySelector('#navigation_'+currentPage);
				  		activeItem.classList.add('active');
				}, 1000);

				window.scrollTo({ top: 0, behavior: 'smooth' });
			});
	}

	function formatThaiDate(dateStr) {
		const days = ['อาทิตย์', 'จันทร์', 'อังคาร', 'พุธ', 'พฤหัสบดี', 'ศุกร์', 'เสาร์'];
		const months = [
			'มกราคม', 'กุมภาพันธ์', 'มีนาคม', 'เมษายน', 'พฤษภาคม', 'มิถุนายน',
			'กรกฎาคม', 'สิงหาคม', 'กันยายน', 'ตุลาคม', 'พฤศจิกายน', 'ธันวาคม'
		];

		const date = new Date(dateStr);

		const day = days[date.getDay()];
		const dateNum = date.getDate();
		const month = months[date.getMonth()];
		const year = date.getFullYear() + 543; // แปลง ค.ศ. เป็น พ.ศ.
		const hour = date.getHours().toString().padStart(2, '0');
		const minute = date.getMinutes().toString().padStart(2, '0');

		return `วัน${day}ที่ ${dateNum} ${month} ${year} เวลา ${hour}:${minute} น.`;
	}

	function getStatusStyle(status) {
		switch (status) {
			case 'สั่งการ':
				return 'background-color: #ffc107; color: black;';
			case 'ออกจากฐาน':
				return 'background-color: #EA8B1A; color: black;';
			case 'ถึงที่เกิดเหตุ':
				return 'background-color: #EA8B1A; color: black;';
			case 'ออกจากที่เกิดเหตุ':
				return 'background-color: #EA8B1A; color: black;';
			case 'ถึง รพ.':
				return 'background-color: #EA8B1A; color: black;';
			case 'เสร็จสิ้น':
				return 'background-color: #28a745; color: white;';
			case 'ยกเลิก':
				return 'background-color: #dc3545; color: white;';
			default:
				return 'background-color: #f8f9fa; color: black;';
		}
	}

	function getLvStyle(status) {
		switch (status) {
			case 'เขียว(ไม่รุนแรง)':
				// ฟ้าอมเขียว - เย็นใจ
				return 'background: linear-gradient(to right, #56ab2f, #a8e063); color: #ffffff;';
			case 'เหลือง(เร่งด่วน)':
				// ส้มเหลือง - เตือนภัยเร่งด่วน
				return 'background: linear-gradient(to right, #f7971e, #ffd200); color: #000000;';
			case 'แดง(วิกฤติ)':
				// แดงเลือด - วิกฤตหนัก
				return 'background: linear-gradient(to right, #e53935, #e35d5b); color: #ffffff;';
			case 'ขาว(ทั่วไป)':
				// เทาอ่อน - เคสทั่วไป
				return 'background: linear-gradient(to right, #c9d6ff, #29B4C5); color: #000000;';
			case 'ดำ':
				// เทาเข้ม-ดำ - ผู้เสียชีวิต
				return 'background: linear-gradient(to right, #434343, #000000); color: #ffffff;';
			default:
				// สีพื้นฐาน
				return 'background: linear-gradient(to right, #c9d6ff, #29B4C5); color: #000000;';
		}
	}

</script>

@endsection
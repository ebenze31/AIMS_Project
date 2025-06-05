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

    function get_data_case_all(){
    	let user_id = "{{ Auth::user()->id }}";

    	fetch("{{ url('/') }}/api/get_data_case_all/" + user_id)
            .then(response => response.json())
            .then(result => {
                console.log(result);
                if(result){

                	let div_content_all_case = document.querySelector('#div_content_all_case');
                		div_content_all_case.innerHTML = "";

                	for (let i = 0; i < result.length; i++) {
                	
	                	let html = `
	                		<div class="card mt-2 radius-10 border">
								<div class="card-body row">
									<div class="col-8">
										<h4>รหัสเคส : ${result[i].operating_code}</h4>
									</div>
									<div class="col-4">
										<div class="float-end">
											<span class="btn btn-sm btn-success radius-30">
												<b class="mx-4">${result[i].status}</b>
											</span>
										</div>
									</div>
									<div class="col-2">
										<div class="p-1 mt-1 radius-10 overflow-hidden bg-gradient-Ohhappiness">
				                            <div class="text-center">
				                                <p class="mb-0 text-white">IDC</p>
				                                <p class="mb-0 text-white">${result[i].idc}</p>
				                            </div>
					                    </div>
					                    <div class="p-1 mt-1 radius-10 overflow-hidden bg-gradient-burning">
				                            <div class="text-center">
				                                <p class="mb-0 text-white">IDC</p>
				                                <p class="mb-0 text-white">${result[i].rc}</p>
				                            </div>
					                    </div>
									</div>
									<div class="col-4">
										<h5 class="mb-1">ผู้แจ้งเหตุ : ${result[i].name_reporter}</h5>
										<span style="font-size: 16px;">
											เบอร์โทรผู้แจ้ง : ${result[i].phone_reporter}
											<br>
											ประเภทผู้แจ้ง : ${result[i].type_reporter}
											<br>
											ประเภทเหตุ : ${result[i].emergency_type}
										</span>
									</div>
									<div class="col-6">
										<h5 class="mb-1">สั่งการโดย : ${result[i].name_officer_command}</h5>
										<span style="font-size: 16px;">
											เจ้าหน้าที่ช่วยเหลือ : ${result[i].name_officer}
											<br>
											หน่วย : ${result[i].name_unit}
											<br>
											ประเภท : ${result[i].name_type_unit}
										</span>
									</div>
									<div class="col-12">
										<hr>
									</div>
									<div class="col-6">
										<span style="font-size: 14px;">
											<b>เวลาแจ้งเหตุ : </b>วันอังคารที่ 20 พ.ค. 2568 เวลา 11:14 ${result[i].created_at}
											<br>
											<b>เวลาช่วยเหลือ : </b>${result[i].time_sum_sos}
										</span>
									</div>
									<div class="col-6">
										<div class="float-end">
											<a href="{{ url('/command_operations/${result[i].id}') }}" type="button" class="btn btn-info">
												<b class="mx-4">ดูข้อมูล</b>
											</a>
										</div>
									</div>
								</div>
							</div>
	                	`;

	                	div_content_all_case.insertAdjacentHTML('beforeend',html); // แทรกล่างสุด
	                }

	                let div_navigation = document.querySelector('#div_navigation');

	                let html_navigation = `
	                	<nav aria-label="Page navigation example">
							<ul class="pagination">
								<li class="page-item">
									<a class="page-link" href="javascript:;" aria-label="Previous">	<span aria-hidden="true">«</span>
									</a>
								</li>
								<li class="page-item"><a class="page-link" href="javascript:;">1</a>
								</li>
								<li class="page-item"><a class="page-link" href="javascript:;">2</a>
								</li>
								<li class="page-item"><a class="page-link" href="javascript:;">3</a>
								</li>
								<li class="page-item">
									<a class="page-link" href="javascript:;" aria-label="Next">	<span aria-hidden="true">»</span>
									</a>
								</li>
							</ul>
						</nav>
	                `;

	                div_navigation.insertAdjacentHTML('beforeend',html_navigation); // แทรกล่างสุด

                }
            });
    }
</script>

@endsection
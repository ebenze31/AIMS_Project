
@extends('layouts.partners.theme_partner_sos')

@section('content')

<div class="card border-top border-0 border-4 border-success">
	<div class="card-body">
		<div class="border p-4 rounded">
			<div class="card-title">
				<h4 class="mb-0 text-success">
					<i class="fa-brands fa-line me-1 font-22 text-success"></i> การจัดการกลุ่มไลน์
				</h4>
				<p class="mt-2" style="color: #7F7F7F;">(ชื่อและรูปจะอัพเดททุกๆ 1 ชั่วโมง)</p>
			</div>
			<hr>

			<div class="row">
				<div class="col">

                   	<div class="table-responsive mt-3">
					   	<table class="table align-middle mb-0">
						   	<thead class="table-light">
							   	<tr>
								   	<th>รูป</th>
								   	<th>ชื่อ</th>
								   	<th>พื้นที่</th>
								   	<th>ประเภท</th>
								   	<th>หมวดหมู่ (สำหรับระบบแจ้งซ่อม)</th>
								   	<th>สถานะ</th>
							   	</tr>
						   	</thead>
						   	<tbody id="tbody">
							   	<tr>
								   	<td>
								   		<img src="{{ url('/img/stickerline/PNG/1.png') }}" style="width:20%;">
								   	</td>
								   	<td>name</td>
								   	<td>area</td>
								   	<td class="">
								   		<span class="badge bg-light-danger text-danger">Vii SOS</span>
								   		<span class="badge bg-light-warning text-warning">Vii FIX</span>
								   	</td>
								   	<td>อุปกรณ์สำนักงาน</td>
								   	<td><span class="badge bg-light-success text-success">Active</span></td>
							   	</tr>
						   	</tbody>
					   	</table>
				   	</div>
							
				</div>
			</div>

		</div>
	</div>
</div>

<script>
	
document.addEventListener('DOMContentLoaded', (event) => {
    // console.log("START");
    get_data_group_line_ower();
});

function get_data_group_line_ower() {
	let organization_id = "{{ Auth::user()->organization_id }}";

	fetch("{{ url('/') }}/api/get_data_group_line_ower/" + organization_id)
        .then(response => response.json())
        .then(result => {
	       	console.log(result);

	       	if(result){

	       		let tbody = document.querySelector('#tbody');
	       			tbody.innerHTML = '';
	       			
	       		for (let i = 0; i < result.length; i++) {

	       			let html_status = `<span class="badge bg-light-danger text-danger">Inactive</span>`;
	       			if(result[i].status == "Active"){
	       				html_status = `<span class="badge bg-light-success text-success">Active</span>`;
	       			}

		       		let html = `
		       			<tr>
						   	<td>
						   		<img src="`+result[i].pictureUrl+`" style="width:20%;">
						   	</td>
						   	<td>`+result[i].groupName+`</td>
						   	<td>area</td>
						   	<td class="">
						   		<span class="badge bg-light-danger text-danger">Vii SOS</span>
						   		<span class="badge bg-light-warning text-warning">Vii FIX</span>
						   	</td>
						   	<td>อุปกรณ์สำนักงาน</td>
						   	<td>
						   		`+html_status+`
						   	</td>
					   	</tr>
		       		`;

		       		tbody.insertAdjacentHTML('beforeend', html); // แทรกล่างสุด
		       	}
	       	}
        	
        })
}

</script>

@endsection

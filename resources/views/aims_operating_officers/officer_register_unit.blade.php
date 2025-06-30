@extends('layouts.theme_aims_officer')

@section('content')
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">

<style>
@keyframes bounce-in {
0% {
  opacity: 0;
  transform: scale(0.3);
}
50% {
  opacity: 1;
  transform: scale(1.1);
}
100% {
  transform: scale(1);
}
}

.animate-bounce-in {
animation: bounce-in 0.6s ease;
}

@keyframes fade-in {
from {
  opacity: 0;
}

to {
  opacity: 1;
}
}

.animate-fade-in {
animation: fade-in 0.3s ease-in-out;
}

.d-none {
	display: none;
}
</style>

<!-- Modal -->
<div id="successModal" class="fixed inset-0 bg-black/80 flex items-center justify-center z-50 hidden">
  	<div class="bg-white rounded-lg shadow-lg p-8 text-center max-w-sm w-full mx-6 animate-fade-in">
	    <!-- Checkmark animation -->
	    <div class="flex justify-center mb-4">
	      	<svg class="w-16 h-16 text-green-500 animate-bounce-in" fill="none" stroke="currentColor" stroke-width="3"
	        viewBox="0 0 24 24">
	        	<path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7" />
	      	</svg>
	    </div>
	    <h3 class="text-xl font-bold text-gray-800 mb-2">ลงทะเบียนสำเร็จ</h3>
	    <p class="text-gray-600 text-sm">ระบบกำลังนำคุณไปยังหน้าเปิดสถานะ...</p>
  	</div>
</div>

<!-- Modal: แจ้งว่ามีการลงทะเบียนไว้ที่หน่วยอื่น -->
<div id="modalOtherUnit" class="fixed inset-0 bg-black/80 flex items-center justify-center z-50 hidden">
	<div class="bg-white p-6 rounded-lg shadow-lg max-w-md w-full text-center mx-6">
	  	<h2 class="text-xl font-bold text-red-600 mb-2">คุณมีการลงทะเบียนไว้ที่หน่วยอื่น</h2>
	  	<p class="text-gray-700">หากคุณดำเนินการลงทะเบียนใหม่<br>จะเป็นการยกเลิกหน่วยเดิม</p>
	  	
	  	<div class="flex justify-center gap-4 mt-4">
		  	<!-- ปุ่ม ดำเนินการต่อ -->
		  	<button onclick="closeModal('modalOtherUnit')"
			    class="mt-4 px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700">
			    ดำเนินการต่อ
			</button>

			<!-- ปุ่ม ยกเลิก -->
			<button onclick="window.close();"
			    class="mt-4 px-4 py-2 bg-gray-600 text-white rounded hover:bg-gray-700">
			    ยกเลิก
			</button>
		</div>
	</div>
</div>

<!-- Modal: หน่วยเดิม แสดงแอนิเมชันติกถูก -->
<div id="modalSameUnit" class="fixed inset-0 bg-black/80 flex items-center justify-center z-50 hidden">
	<div class="bg-white p-6 rounded-lg shadow-lg max-w-sm w-full mx-6 text-center animate-fade-in">
	  	<div class="flex justify-center mb-4">
	    	<svg class="w-16 h-16 text-green-500 animate-bounce-in" fill="none" stroke="currentColor" stroke-width="3"
	         viewBox="0 0 24 24">
	      		<path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7" />
	    	</svg>
	  	</div>
	  	<h3 class="text-lg font-bold text-gray-800 mb-2">คุณลงทะเบียนหน่วยนี้แล้ว</h3>
	  	<p class="text-gray-600 text-sm">ระบบกำลังนำคุณไปยังหน้าเปิดสถานะ...</p>
	</div>
</div>

<div class="bg-white p-8 rounded-lg shadow-lg w-full max-w-xl">
    <h2 class="text-2xl font-bold text-gray-800 text-center">ลงทะเบียนเจ้าหน้าที่</h2>
    <ul class="list-disc pl-6 text-gray-800 space-y-1">
	  	<li>หน่วย  : {{ $data->name_unit }}</li>
	  	<li>ประเภท : {{ $data->name_type_unit }}</li>
	</ul>

    <div class="mt-[15px]">
        <label for="name_officer" class="block mb-1 font-semibold text-gray-700">ชื่อเจ้าหน้าที่</label>
        <input type="text" id="name_officer" name="name_officer" placeholder="กรอกชื่อเจ้าหน้าที่"
          class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-400" />
  	</div>

  	<div class="mt-[15px]">
        <label for="level" class="block mb-1 font-semibold text-gray-700">Level (ถ้ามี)</label>
        <input type="text" id="level" name="level" placeholder="กรอกระดับ"
          class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-400" />
  	</div>

  	<div class="mt-[15px]">
        <div id="vehicle_select_group">
		  	<label for="vehicle_type" class="block mb-1 font-semibold text-gray-700">ประเภทยานพาหนะ</label>
		  	<select id="vehicle_type" name="vehicle_type"
		    class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-400"
		    onchange="checkVehicleType()">
			    <option value="">กรุณาเลือกยานพาหนะ</option>
			    <option value="รถยนต์">รถยนต์</option>
			    <option value="รถจักรยานยนต์">รถจักรยานยนต์</option>
			    <option value="รถพยาบาล">รถพยาบาล</option>
			    <option value="เรือ">เรือ</option>
			    <option value="เฮลิคอปเตอร์">เฮลิคอปเตอร์</option>
			    <option value="other">อื่นๆ</option>
		  	</select>
		</div>

		<div id="vehicle_other_group" class="mt-4 hidden">
		  	<label for="vehicle_other" class="block mb-1 font-semibold text-gray-700">ระบุประเภทยานพาหนะอื่นๆ</label>
		  	<input type="text" id="vehicle_other" name="vehicle_type" placeholder="ระบุประเภทยานพาหน"
		    class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-400" />
		</div>

		<script>
		  function checkVehicleType() {
		    const select = document.getElementById("vehicle_type");
		    const otherGroup = document.getElementById("vehicle_other_group");
		    const selectGroup = document.getElementById("vehicle_select_group");

		    if (select.value === "other") {
		      selectGroup.classList.add("hidden");
		      otherGroup.classList.remove("hidden");
		    }
		  }
		</script>
     </div>

    <div class="d-none">
        <label for="user_id" class="block mb-1 font-semibold text-gray-700">user_id</label>
        <input type="text" id="user_id" name="user_id"
          class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-400" readonly value="{{ Auth::user()->id }}">
    </div>

    <div class="d-none">
        <label for="aims_operating_unit_id" class="block mb-1 font-semibold text-gray-700">aims_operating_unit_id</label>
        <input type="text" id="aims_operating_unit_id" name="aims_operating_unit_id"
          class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-400" readonly value="{{ $data->id }}">
  	</div>

  	<div class="d-none">
        <label for="aims_partner_id" class="block mb-1 font-semibold text-gray-700">aims_partner_id</label>
        <input type="text" id="aims_partner_id" name="aims_partner_id"
          class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-400" readonly value="{{ $data->aims_partner_id }}">
  	</div>

  	<div class="d-none">
        <label for="aims_area_id" class="block mb-1 font-semibold text-gray-700">aims_area_id</label>
        <input type="text" id="aims_area_id" name="aims_area_id"
          class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-400" readonly value="{{ $data->aims_area_id }}">
  	</div>


  	<div class="text-center mt-[20px]">
        <button type="button" onclick="submitOfficerForm()"
          class="bg-blue-600 text-white px-6 py-2 rounded-md font-semibold hover:bg-blue-700 transition duration-300">ลงทะเบียน</button>
  	</div>
</div>

<script>

// แปลงค่า Blade เป็น JavaScript
const info = @json($info);

window.onload = () => {
	if (info.old_data === 'มีข้อมูลเดิม') {
	  	if (info.old_unit === 'คนละหน่วย') {
	    	document.getElementById('modalOtherUnit').classList.remove('hidden');
	  	} else if (info.old_unit === 'หน่วยเดิม') {
	    	document.getElementById('modalSameUnit').classList.remove('hidden');
	    	setTimeout(() => {
	      		window.location.href = "{{ url('/officer_change_status') }}";
	    	}, 4000);
	  	}
	}
};

function closeModal(id) {
	document.getElementById(id).classList.add('hidden');
}

async function submitOfficerForm() {
	const name_officer = document.getElementById("name_officer").value.trim();
    const level = document.getElementById("level").value.trim();
    const user_id = document.getElementById("user_id").value;
    const aims_operating_unit_id = document.getElementById("aims_operating_unit_id").value;
    const aims_partner_id = document.getElementById("aims_partner_id").value;
    const aims_area_id = document.getElementById("aims_area_id").value;

    let vehicle_type = "";

    const select = document.getElementById("vehicle_type");
    if (select.value === "other") {
      	const other = document.getElementById("vehicle_other").value.trim();
      	vehicle_type = other;
    } else {
      	vehicle_type = select.value;
    }

    const formData = {
      	name_officer,
      	level,
      	user_id,
      	aims_operating_unit_id,
      	aims_partner_id,
      	aims_area_id,
      	vehicle_type,
    };

    try {
      	const response = await fetch("{{ url('/') }}/api/officer_reg_to_unit", {
        	method: "POST",
        	headers: {
          		"Content-Type": "application/json",
          		"X-CSRF-TOKEN": "{{ csrf_token() }}" // สำหรับ Laravel
        	},
        	body: JSON.stringify(formData)
      	});

      	const result = await response.json();

      	if (response.ok) {
		  	// แสดง Modal
		  	document.getElementById("successModal").classList.remove("hidden");

		  	setTimeout(() => {
		    	window.location.href = "{{ url('/officer_change_status') }}";
		  	}, 2000);
		} else {
        	alert("เกิดข้อผิดพลาด: " + (result.message || "ไม่สามารถบันทึกข้อมูลได้"));
      	}
    } catch (error) {
      	alert("เกิดข้อผิดพลาดขณะส่งข้อมูล");
      	console.error(error);
    }
}
</script>


@endsection
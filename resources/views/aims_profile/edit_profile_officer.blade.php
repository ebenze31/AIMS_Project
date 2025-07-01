@extends('layouts.theme_aims_officer')

@section('content')

<style>
	.d-none{
		display: none;
	}
</style>

<div class="flex justify-center mb-4 mt-3">
    <div class="grid grid-cols-2 w-80 gap-px">
        <!-- ปุ่มข้อมูลทั่วไป -->
        <button id="btn-general" class="py-2 text-sm font-medium rounded-l-md bg-blue-500 text-white border border-blue-500">
            ข้อมูลทั่วไป
        </button>

        <!-- ปุ่มข้อมูลปฏิบัติการ -->
        <button id="btn-operation" class="py-2 text-sm font-medium rounded-r-md bg-white text-blue-500 border border-blue-500">
            ข้อมูลปฏิบัติการ
        </button>
    </div>
</div>

<form id="officerForm">
	<!-- ส่วนข้อมูล -->
	<div id="section-general" class="block">
	    <!-- ข้อมูลทั่วไป -->
	    <div class="p-6 rounded-md bg-white w-full max-w-3xl mx-auto">
		    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">

		    	<!-- photo -->
				<div class="text-center">
				    <!-- พื้นที่แสดงรูปภาพ -->
				    <div class="flex justify-center">
				        @if (!empty($data_officer->photo))
				            <img id="photoPreview" src="{{ url('/storage/' . $data_officer->photo) }}"
				                class="w-50 h-50 object-cover rounded-full border border-gray-300 shadow" alt="Profile Preview">
				        @else
				            <div id="photoPreviewContainer"
				                class="w-50 h-50 flex items-center justify-center text-gray-500 text-xs bg-gray-100 rounded-full border border-gray-300 shadow">
				                ไม่มีรูปภาพ
				            </div>
				        @endif
				    </div>

				    <!-- ปุ่มเลือกไฟล์ -->
				    <div class="mt-3">
				        <button type="button" id="btnSelectPhoto"
				            class="px-4 py-1 text-sm bg-blue-600 text-white rounded hover:bg-blue-700">
				            เลือกรูปภาพ
				        </button>
				    </div>

				    <!-- input ซ่อนไว้ -->
				    <input type="file" id="photoInput" name="photo" accept="image/*" class="hidden">
				</div>


		        <!-- name -->
		        <div>
		            <label class="block text-sm font-medium text-gray-700">ชื่อ</label>
		            <input type="text" name="name" value="{{ $data_officer->name ?? '' }}"
		                class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-400">
		        </div>

		        <!-- phone -->
		        <div>
		            <label class="block text-sm font-medium text-gray-700">เบอร์โทร</label>
		            <input type="tel" name="phone" value="{{ $data_officer->phone ?? '' }}"
		                class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-400">
		        </div>

		        <!-- birthday -->
		        <div>
		            <label class="block text-sm font-medium text-gray-700">วันเกิด</label>
		            <input type="date" name="birthday" value="{{ $data_officer->birthday ?? '' }}"
		                class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-400">
		        </div>

		        <!-- sex -->
		        <div>
		            <label class="block text-sm font-medium text-gray-700">เพศ</label>
		            <select name="sex" class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-400">
		                <option value="">-- เลือกเพศ --</option>
		                <option value="ชาย" {{ $data_officer->sex == 'ชาย' ? 'selected' : '' }}>ชาย</option>
		                <option value="หญิง" {{ $data_officer->sex == 'หญิง' ? 'selected' : '' }}>หญิง</option>
		                <option value="อื่นๆ" {{ $data_officer->sex == 'อื่นๆ' ? 'selected' : '' }}>อื่นๆ</option>
		            </select>
		        </div>

		        @php
				    $languages = [
					    'th' => 'Thai',
					    'en' => 'English',
					    'zh' => 'Chinese',
					    'es' => 'Spanish',
					    'fr' => 'French',
					    'de' => 'German',
					    'ja' => 'Japanese',
					    'ko' => 'Korean',
					    'ar' => 'Arabic',
					    'hi' => 'Hindi',
					    'ru' => 'Russian',
					    'pt' => 'Portuguese',
					    'bn' => 'Bengali',
					    'ur' => 'Urdu',
					    'vi' => 'Vietnamese',
					    'Other' => 'Other'
					];

				    $nationalities = [
				        'Thai', 'American', 'British', 'Chinese', 'Japanese', 'Indian', 'French', 'German',
				        'Australian', 'Canadian', 'Vietnamese', 'South Korean', 'Indonesian', 'Malaysian', 'Filipino', 'Other'
				    ];

				    $selectedLanguage = $data_officer->language ?? '';
				    $selectedNationality = $data_officer->nationalitie ?? '';

				    $isOtherLanguage = !array_key_exists($selectedLanguage, $languages);
				    $isOtherNationality = !in_array($selectedNationality, $nationalities);
				@endphp

				<!-- ภาษา -->
				<div>
				    <label class="block text-sm font-medium text-gray-700">ภาษา</label>

				    <select name="language" id="language_select"
				        class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-400"
				        onchange="toggleLanguageInput(this)">
				        <option value="">-- กรุณาเลือกภาษา --</option>
				        @foreach ($languages as $code => $name)
				            <option value="{{ $code }}" {{ $selectedLanguage == $code ? 'selected' : '' }}>
				                {{ $name }}
				            </option>
				        @endforeach
				    </select>

				    <input id="language_input" type="text" name="language_other"
				        value="{{ $isOtherLanguage ? $selectedLanguage : '' }}"
				        class="d-none mt-2 w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-400"
				        placeholder="ระบุภาษาอื่น ๆ">
				</div>

				<!-- สัญชาติ -->
				<div class="mt-4">
				    <label class="block text-sm font-medium text-gray-700">สัญชาติ</label>

				    <select id="nationality_select" name="nationalitie"
				        class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-400"
				        onchange="toggleNationalityInput(this)">
				        <option value="">-- กรุณาเลือกสัญชาติ --</option>
				        @foreach ($nationalities as $nation)
				            <option value="{{ $nation }}" {{ $selectedNationality == $nation ? 'selected' : '' }}>
				                {{ $nation }}
				            </option>
				        @endforeach
				    </select>

				    <input id="nationality_input" type="text" name="nationalitie_other"
				        value="{{ $isOtherNationality ? $selectedNationality : '' }}"
				        class="d-none mt-2 w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-400"
				        placeholder="ระบุสัญชาติอื่น ๆ">
				</div>

		        <!-- time_zone -->
				<div class="d-none">
				    <label class="block text-sm font-medium text-gray-700">Time Zone</label>
				    <input type="text" name="time_zone" 
				        value="{{ $data_officer->time_zone ?? $ip_data['timezone'] ?? '' }}" 
				        readonly 
				        class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-400">
				</div>

				<!-- country -->
				<div class="d-none">
				    <label class="block text-sm font-medium text-gray-700">ประเทศ</label>
				    <input type="text" name="country" 
				        value="{{ $data_officer->country ?? $ip_data['countryCode'] ?? '' }}" 
				        readonly 
				        class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-400">
				</div>


		        <!-- IP Address -->
				<div class="d-none">
				    @if($ip_data)
					    <textarea class="w-full h-48 border p-2 rounded" readonly>{{ json_encode($ip_data, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE) }}</textarea>
					@else
					    <p class="text-red-500">ไม่สามารถดึงข้อมูล IP ได้</p>
					@endif

				</div>

		    </div>
		</div>
	</div>

	<div id="section-operation" class="hidden">
	    <!-- ข้อมูลปฏิบัติการ -->
	    <div class="p-6 rounded-md bg-white w-full max-w-3xl mx-auto">
	    	<div class="grid grid-cols-1 md:grid-cols-2 gap-4">
	            <!-- name_officer -->
		        <div>
		            <label class="block text-sm font-medium text-gray-700">ชื่อเจ้าหน้าที่ (แสดงตอนช่วยเหลือ)</label>
		            <input type="text" name="name_officer" value="{{ $data_officer->name_officer ?? '' }}"
		                class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-400">
		        </div>

		        <!-- level -->
		        <div>
		            <label class="block text-sm font-medium text-gray-700">Level</label>
		            <input type="text" name="level" value="{{ $data_officer->level ?? '' }}"
		                class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-400">
		        </div>

		        <!-- vehicle_type -->
		        @php
				    $vehicleOptions = [
				        'รถยนต์' => 'รถยนต์',
				        'รถจักรยานยนต์' => 'รถจักรยานยนต์',
				        'รถพยาบาล' => 'รถพยาบาล',
				        'เรือ' => 'เรือ',
				        'เฮลิคอปเตอร์' => 'เฮลิคอปเตอร์',
				    ];

				    $selectedVehicle = $data_officer->vehicle_type ?? '';
				    $isOtherVehicle = !array_key_exists($selectedVehicle, $vehicleOptions);
				@endphp

				<div>
				    <label class="block text-sm font-medium text-gray-700">ประเภทยานพาหนะ</label>

				    <select name="vehicle_type" id="vehicle_select"
				        class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-400"
				        onchange="toggleVehicleInput(this)">
				        <option value="">กรุณาเลือกยานพาหนะ</option>
				        @foreach ($vehicleOptions as $value => $label)
				            <option value="{{ $value }}" {{ (!$isOtherVehicle && $selectedVehicle == $value) ? 'selected' : '' }}>
				                {{ $label }}
				            </option>
				        @endforeach
				        <option value="other" {{ $isOtherVehicle ? 'selected' : '' }}>อื่นๆ</option>
				    </select>

				    <input id="vehicle_input" type="text" name="vehicle_type_other"
				        value="{{ $isOtherVehicle ? $selectedVehicle : '' }}"
				        class="mt-2 w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-400 {{ $isOtherVehicle ? '' : 'd-none' }}"
				        placeholder="ระบุประเภทยานพาหนะอื่น ๆ">
				</div>
	        </div>
	    </div>
	</div>

	<!-- ปุ่มบันทึก -->
	<div class="flex justify-center mb-4 mt-2">
	    <button type="button" onclick="submitOfficerForm()" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
	        บันทึกข้อมูล
	    </button>
	</div>
</form>


<script>
    const btnGeneral = document.getElementById('btn-general');
    const btnOperation = document.getElementById('btn-operation');
    const sectionGeneral = document.getElementById('section-general');
    const sectionOperation = document.getElementById('section-operation');

    btnGeneral.addEventListener('click', function () {
        // แสดง general, ซ่อน operation
        sectionGeneral.classList.remove('hidden');
        sectionGeneral.classList.add('block');
        sectionOperation.classList.add('hidden');

        // ปรับปุ่ม
        btnGeneral.classList.add('bg-blue-500', 'text-white');
        btnGeneral.classList.remove('bg-white', 'text-blue-500');

        btnOperation.classList.remove('bg-blue-500', 'text-white');
        btnOperation.classList.add('bg-white', 'text-blue-500');
    });

    btnOperation.addEventListener('click', function () {
        // แสดง operation, ซ่อน general
        sectionOperation.classList.remove('hidden');
        sectionOperation.classList.add('block');
        sectionGeneral.classList.add('hidden');

        // ปรับปุ่ม
        btnOperation.classList.add('bg-blue-500', 'text-white');
        btnOperation.classList.remove('bg-white', 'text-blue-500');

        btnGeneral.classList.remove('bg-blue-500', 'text-white');
        btnGeneral.classList.add('bg-white', 'text-blue-500');
    });
</script>

<script>
document.getElementById('btnSelectPhoto').addEventListener('click', function () {
    document.getElementById('photoInput').click();
});

document.getElementById('photoInput').addEventListener('change', function (event) {
    const file = event.target.files[0];

    if (file) {
        const reader = new FileReader();
        reader.onload = function (e) {
            const existingImg = document.getElementById('photoPreview');
            const existingContainer = document.getElementById('photoPreviewContainer');

            if (existingImg) {
                // ถ้ามี img อยู่แล้ว แค่เปลี่ยน src
                existingImg.src = e.target.result;
            } else if (existingContainer) {
                // ถ้ายังเป็น div (ไม่มีรูป) → แปลงเป็น <img>
                const img = document.createElement('img');
                img.id = "photoPreview";
                img.src = e.target.result;
                img.className = "w-50 h-50 object-cover rounded-full border border-gray-300 shadow";
                img.alt = "Profile Preview";

                existingContainer.replaceWith(img);
            }
        }
        reader.readAsDataURL(file);
    }
});

function toggleLanguageInput(select) {
    const input = document.getElementById('language_input');
    if (select.value === 'Other') {
        input.classList.remove('d-none');
    } else {
        input.classList.add('d-none');
        input.value = '';
    }
}

function toggleNationalityInput(select) {
    const input = document.getElementById('nationality_input');
    if (select.value === 'Other') {
        input.classList.remove('d-none');
    } else {
        input.classList.add('d-none');
        input.value = '';
    }
}

function toggleVehicleInput(select) {
    const input = document.getElementById('vehicle_input');
    if (select.value === 'other') {
        input.classList.remove('d-none');
    } else {
        input.classList.add('d-none');
        input.value = '';
    }
}

function submitOfficerForm() {
  const form = document.getElementById('officerForm');
  const formData = new FormData();

  const ipDataText = document.getElementById('ip_data_json')?.value || '{}';
  const ip_data = JSON.parse(ipDataText);

  const data_user = {
    name: form.name.value,
    phone: form.phone.value,
    birthday: form.birthday.value,
    sex: form.sex.value,
    language: form.language.value === 'Other' ? form.language_other.value : form.language.value,
    nationalitie: form.nationalitie.value === 'Other' ? form.nationalitie_other.value : form.nationalitie.value,
    time_zone: form.time_zone?.value ?? '',
    country: form.country?.value ?? '',
    ip_address: ip_data,
  };

  const data_officer = {
    name_officer: form.name_officer.value,
    level: form.level.value,
    vehicle_type: form.vehicle_type.value === 'other' ? form.vehicle_type_other.value : form.vehicle_type.value,
  };

  formData.append('data_user', JSON.stringify(data_user));
  formData.append('data_officer', JSON.stringify(data_officer));
  formData.append('user_id', "{{ Auth::user()->id }}");

  const photoFile = form.photo.files[0];
  if (photoFile) {
    formData.append('photo', photoFile);
  }

  fetch("{{ url('/') }}/api/cf_edit_profile_officer", {
    method: 'POST',
    body: formData,
  })
    .then(response => {
      if (!response.ok) throw new Error(`HTTP error! status: ${response.status}`);
      return response.json();
    })
    .then(data => {
        window.location.href = "{{ url('/home_for_officer') }}";
    })
    .catch(error => {
      console.error('Error:', error);
      // แจ้งเตือน error
    });
}
</script>



@endsection
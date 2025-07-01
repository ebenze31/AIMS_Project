@extends('layouts.theme_aims_officer')

@section('content')

<div class="max-w-md mx-auto bg-white rounded-xl overflow-hidden mt-2">
  <!-- รูปภาพและชื่อ -->
  <div class="flex flex-col items-center p-6">
    <div class="w-50 h-50 rounded-full overflow-hidden">
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
    <h2 class="mt-4 text-xl font-bold text-gray-800">{{ $data_officer->name ?? '' }}</h2>
    <p class="text-sm text-gray-500">ชื่อแสดงขณะช่วยเหลือ : {{ $data_officer->name_officer ?? '' }}</p>
    <p class="text-sm text-gray-500">ระดับ : {{ $data_officer->level ?? '' }} | ยานพาหนะ : {{ $data_officer->vehicle_type ?? '' }}</p>
  </div>

  <!-- รายละเอียดเพิ่มเติม -->
  <div class="px-6 pb-6">
    <div class="border-t border-gray-200 mb-4"></div>
    <ul class="space-y-2 text-sm text-gray-700">
      <li class="flex justify-between">
        <span class="font-medium">เบอร์โทร</span>
        <span>{{ $data_officer->phone ?? '' }}</span>
      </li>
      <li class="flex justify-between">
        <span class="font-medium">วันเกิด</span>
        <span>{{ $data_officer->birthday ?? '' }}</span>
      </li>
      <li class="flex justify-between">
        <span class="font-medium">เพศ</span>
        <span>{{ $data_officer->sex ?? '' }}</span>
      </li>
      <li class="flex justify-between">
        <span class="font-medium">ภาษา</span>
        <span>{{ $data_officer->language ?? '' }}</span>
      </li>
      <li class="flex justify-between">
        <span class="font-medium">สัญชาติ</span>
        <span>{{ $data_officer->nationalitie ?? '' }}</span>
      </li>
    </ul>
  </div>
</div>


@endsection
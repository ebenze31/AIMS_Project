@extends('layouts.theme_aims_officer')

@section('content')

<div class="max-w-md mx-auto bg-white rounded-xl shadow-md overflow-hidden mt-8 border border-gray-200">
  <!-- รูปภาพและชื่อ -->
  <div class="flex flex-col items-center p-6">
    <div class="w-24 h-24 rounded-full border-4 border-purple-500 overflow-hidden">
      <img src="" alt="Profile" class="w-full h-full object-cover">
    </div>
    <h2 class="mt-4 text-xl font-bold text-gray-800">สมชาย ใจดี</h2>
    <p class="text-sm text-gray-500">ชื่อแสดงขณะช่วยเหลือ : สมชาย</p>
    <p class="text-sm text-gray-500">ระดับ : ALS | ยานพาหนะ : รถพยาบาล</p>
  </div>

  <!-- รายละเอียดเพิ่มเติม -->
  <div class="px-6 pb-6">
    <div class="border-t border-gray-200 mb-4"></div>
    <ul class="space-y-2 text-sm text-gray-700">
      <li class="flex justify-between">
        <span class="font-medium">เบอร์โทร:</span>
        <span>081-234-5678</span>
      </li>
      <li class="flex justify-between">
        <span class="font-medium">วันเกิด:</span>
        <span>01/01/1990</span>
      </li>
      <li class="flex justify-between">
        <span class="font-medium">เพศ:</span>
        <span>ชาย</span>
      </li>
      <li class="flex justify-between">
        <span class="font-medium">ประเทศ:</span>
        <span>ไทย</span>
      </li>
      <li class="flex justify-between">
        <span class="font-medium">ภาษา:</span>
        <span>ไทย, อังกฤษ</span>
      </li>
      <li class="flex justify-between">
        <span class="font-medium">Time Zone:</span>
        <span>GMT+7</span>
      </li>
      <li class="flex justify-between">
        <span class="font-medium">IP Address:</span>
        <span>192.168.1.1</span>
      </li>
      <li class="flex justify-between">
        <span class="font-medium">สัญชาติ:</span>
        <span>ไทย</span>
      </li>
    </ul>
  </div>
</div>


@endsection
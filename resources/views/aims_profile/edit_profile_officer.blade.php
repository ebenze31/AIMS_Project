@extends('layouts.theme_aims_officer')

@section('content')

<div class="flex justify-center mb-4">
    <div class="grid grid-cols-2 w-64 gap-px">
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

<!-- ส่วนข้อมูล -->
<div id="section-general" class="block">
    <!-- ข้อมูลทั่วไป -->
    <div class="p-6 rounded-md">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <div>
                <label class="block text-sm font-medium text-gray-700">ชื่อ</label>
                <input type="text" name="name" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm" required>
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700">เบอร์โทร</label>
                <input type="tel" name="phone" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700">วันเกิด</label>
                <input type="date" name="birthday" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700">เพศ</label>
                <select name="sex" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
                    <option value="">-- เลือกเพศ --</option>
                    <option value="male">ชาย</option>
                    <option value="female">หญิง</option>
                    <option value="other">อื่นๆ</option>
                </select>
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700">รูปภาพ</label>
                <input type="file" name="photo" accept="image/*" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700">ประเทศ</label>
                <input type="text" name="country" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700">ภาษา</label>
                <input type="text" name="language" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700">Time Zone</label>
                <input type="text" name="time_zone" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700">IP Address</label>
                <input type="text" name="ip_address" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm" readonly>
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700">สัญชาติ</label>
                <input type="text" name="nationalitie" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
            </div>
        </div>
    </div>
</div>

<div id="section-operation" class="hidden">
    <!-- ข้อมูลปฏิบัติการ -->
    <div class="p-6 rounded-md">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <div>
                <label class="block text-sm font-medium text-gray-700">ชื่อแสดงขณะช่วยเหลือ</label>
                <input type="text" name="name_officer" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700">ระดับ (Level)</label>
                <input type="text" name="level" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
            </div>
            <div class="md:col-span-2">
                <label class="block text-sm font-medium text-gray-700">ประเภทพาหนะ</label>
                <input type="text" name="vehicle_type" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
            </div>
        </div>
    </div>
</div>


<!-- ปุ่มบันทึก -->
<div class="flex justify-center mb-4 mt-2">
    <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
        บันทึกข้อมูล
    </button>
</div>

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


@endsection
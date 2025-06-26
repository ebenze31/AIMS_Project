@extends('layouts.theme_aims_officer')

@section('content')
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">

<div class="p-4">
    <h2 class="text-xl font-bold mb-4">สแกนหรือเลือกรูป QR Code</h2>

    <!-- แสดงผลลัพธ์ -->
    <div class="mb-4">
        <label class="block font-medium mb-1">ผลลัพธ์จาก QR Code:</label>
        <textarea id="qr_result" class="w-full p-2 border rounded" rows="3" readonly></textarea>
    </div>

    <!-- ปุ่มเปิดกล้อง -->
    <div class="mb-4">
        <video id="qr_video" width="100%" class="rounded border" autoplay></video>
        <button onclick="startCamera()" class="mt-2 px-4 py-2 bg-blue-600 text-white rounded">เปิดกล้อง</button>
    </div>

    <!-- อัปโหลดรูป QR Code -->
    <div class="mb-4">
        <label class="block font-medium mb-1">หรือเลือกรูป QR Code:</label>
        <input type="file" accept="image/*" onchange="handleFile(this)" class="block w-full">
        <canvas id="qr_canvas" class="hidden mt-2 border rounded"></canvas>
    </div>
</div>

<!-- jsQR -->
<script src="https://cdn.jsdelivr.net/npm/jsqr/dist/jsQR.js"></script>

<script>
    let video = document.getElementById('qr_video');
    let canvas = document.getElementById('qr_canvas');
    let ctx = canvas.getContext('2d');
    let resultBox = document.getElementById('qr_result');

    // ฟังก์ชันเปิดกล้อง
    function startCamera() {
        navigator.mediaDevices.getUserMedia({ video: { facingMode: 'environment' } })
            .then((stream) => {
                video.srcObject = stream;
                scanFromCamera();
            })
            .catch((err) => {
                alert('ไม่สามารถเข้าถึงกล้องได้: ' + err);
            });
    }

    // อ่าน QR จากกล้อง
    function scanFromCamera() {
        const interval = setInterval(() => {
            if (video.readyState === video.HAVE_ENOUGH_DATA) {
                canvas.width = video.videoWidth;
                canvas.height = video.videoHeight;
                ctx.drawImage(video, 0, 0, canvas.width, canvas.height);
                let imageData = ctx.getImageData(0, 0, canvas.width, canvas.height);
                let code = jsQR(imageData.data, imageData.width, imageData.height);
                if (code) {
                    resultBox.value = code.data;
                    clearInterval(interval);
                }
            }
        }, 500);
    }

    // อ่าน QR จากไฟล์รูปภาพ
    function handleFile(input) {
        let file = input.files[0];
        if (!file) return;

        let reader = new FileReader();
        reader.onload = function (e) {
            let img = new Image();
            img.onload = function () {
                canvas.classList.remove('hidden');
                canvas.width = img.width;
                canvas.height = img.height;
                ctx.drawImage(img, 0, 0);
                let imageData = ctx.getImageData(0, 0, canvas.width, canvas.height);
                let code = jsQR(imageData.data, imageData.width, imageData.height);
                if (code) {
                    resultBox.value = code.data;
                } else {
                    resultBox.value = 'ไม่พบ QR Code';
                }
            };
            img.src = e.target.result;
        };
        reader.readAsDataURL(file);
    }
</script>
@endsection

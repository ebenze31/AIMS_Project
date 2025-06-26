@extends('layouts.theme_aims_officer')

@section('content')
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">

<style>
    #qr_wrapper {
        position: relative;
        width: 100%;
        max-width: 400px;
        aspect-ratio: 1/1;
        margin: auto;
    }

    #qr_crop_area {
        position: relative;
        width: 100%;
        padding-top: 100%; /* สร้างกรอบสี่เหลี่ยมจัตุรัส */
        overflow: hidden;
        border-radius: 16px;
    }

    #qr_video {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        object-fit: cover;
    }

    #scan-frame {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        border: 4px solid rgba(255, 100, 100, 0.9);
        border-radius: 16px;
        box-shadow: 0 0 20px rgba(255, 100, 100, 0.4);
        pointer-events: none;
        z-index: 10;
    }

    #result_container {
        max-width: 400px;
        margin: 20px auto;
    }
</style>

<div class="p-4 text-center">
    <h2 class="text-xl font-bold mb-4">สแกน QR Code</h2>

    <!-- กล้องเต็มกรอบ -->
    <div id="qr_wrapper">
        <div id="qr_crop_area">
            <video id="qr_video" autoplay muted playsinline></video>
            <div id="scan-frame"></div>
        </div>
    </div>

    <!-- แสดงผลลัพธ์ -->
    <div id="result_container" class="hidden">
        <label class="block font-medium mt-4 mb-1">ผลลัพธ์จาก QR Code:</label>
        <textarea id="qr_result" class="w-full p-2 border rounded" rows="3" readonly></textarea>
    </div>

    <!-- อัปโหลดรูป QR Code -->
    <div class="mt-4 max-w-md mx-auto">
        <label class="block font-medium mb-1">หรือเลือกรูป QR Code:</label>
        <input type="file" accept="image/*" onchange="handleFile(this)" class="block w-full">
        <canvas id="qr_canvas" class="hidden mt-2 border rounded"></canvas>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/jsqr/dist/jsQR.js"></script>

<script>
    const video = document.getElementById('qr_video');
    const canvas = document.getElementById('qr_canvas');
    const ctx = canvas.getContext('2d');
    const resultBox = document.getElementById('qr_result');
    const resultContainer = document.getElementById('result_container');

    let videoStream = null;
    let scanInterval = null;

    async function startCameraAndScan() {
        try {
            videoStream = await navigator.mediaDevices.getUserMedia({ video: { facingMode: 'environment' } });
            video.srcObject = videoStream;

            scanInterval = setInterval(() => {
                if (video.readyState === video.HAVE_ENOUGH_DATA) {
                    canvas.width = video.videoWidth;
                    canvas.height = video.videoHeight;
                    ctx.drawImage(video, 0, 0, canvas.width, canvas.height);
                    const imageData = ctx.getImageData(0, 0, canvas.width, canvas.height);
                    const code = jsQR(imageData.data, imageData.width, imageData.height);

                    if (code) {
                        showResult(code.data);
                        stopCamera();
                        clearInterval(scanInterval);
                    }
                }
            }, 500);
        } catch (err) {
            alert('ไม่สามารถเปิดกล้องได้: ' + err.message);
        }
    }

    function stopCamera() {
        if (videoStream) {
            videoStream.getTracks().forEach(track => track.stop());
            video.srcObject = null;
        }
    }

    function showResult(text) {
        resultBox.value = text;
        resultContainer.classList.remove('hidden');
    }

    function handleFile(input) {
        const file = input.files[0];
        if (!file) return;

        const reader = new FileReader();
        reader.onload = function (e) {
            const img = new Image();
            img.onload = function () {
                canvas.classList.remove('hidden');
                canvas.width = img.width;
                canvas.height = img.height;
                ctx.drawImage(img, 0, 0);
                const imageData = ctx.getImageData(0, 0, canvas.width, canvas.height);
                const code = jsQR(imageData.data, imageData.width, imageData.height);
                if (code) {
                    showResult(code.data);
                    stopCamera();
                    clearInterval(scanInterval);
                } else {
                    resultBox.value = 'ไม่พบ QR Code';
                    resultContainer.classList.remove('hidden');
                }
            };
            img.src = e.target.result;
        };
        reader.readAsDataURL(file);
    }

    document.addEventListener('DOMContentLoaded', startCameraAndScan);
</script>
@endsection

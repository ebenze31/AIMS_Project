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

    #qr_image {
	    position: absolute;
	    top: 0;
	    left: 0;
	    width: 100%;
	    height: 100%;
	    object-fit: cover;
	    border-radius: 16px;
	    display: none;
	}

</style>

<div class="p-4 text-center">

    <!-- กล้องเต็มกรอบ -->
    <div id="qr_wrapper">
    	<h2 class="text-xl font-bold mb-4">สแกน QR Code</h2>
        <div id="qr_crop_area">
		    <video id="qr_video" autoplay muted playsinline></video>
		    <img id="qr_image" alt="Uploaded QR Image" />
		    <div id="scan-frame"></div>
		</div>
    </div>

    <!-- แสดงผลลัพธ์ -->
    <div id="result_container" class="hidden">
        <!-- <label class="block font-medium mt-4 mb-1">ผลลัพธ์จาก QR Code:</label> -->
        <p id="qr_result" class="w-full p-2"></p>
    </div>

    <!-- อัปโหลดรูป QR Code -->
	<div class="mt-4 max-w-md mx-auto">
	    <!-- ปุ่มแทน input -->
	    <button onclick="document.getElementById('qr_file_input').click()"
		    class="bg-blue-600 text-white text-sm px-3 py-1 rounded hover:bg-blue-700">
		    เลือกรูป
		</button>


	    <!-- input ซ่อน -->
	    <input type="file" id="qr_file_input" accept="image/*" onchange="handleFile(this)" class="hidden">

	    <!-- canvas ซ่อนเพื่อ decode -->
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

            // ✅ ซ่อนผลลัพธ์ตอนเริ่มต้นกล้อง
            resultBox.innerHTML = '';
            resultContainer.classList.add('hidden');

            scanInterval = setInterval(() => {
                if (video.readyState === video.HAVE_ENOUGH_DATA) {
                    canvas.width = video.videoWidth;
                    canvas.height = video.videoHeight;
                    ctx.drawImage(video, 0, 0, canvas.width, canvas.height);
                    const imageData = ctx.getImageData(0, 0, canvas.width, canvas.height);
                    const code = jsQR(imageData.data, imageData.width, imageData.height);

                    if (code) {
                        stopCamera();
                        clearInterval(scanInterval);

                        if (code.data.includes('officer_register_unit')) {
                            window.location.href = code.data;
                        } else {
                            showResult('QR Code ไม่ถูกต้อง');
                        }
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
        resultBox.innerHTML = text;
        resultContainer.classList.remove('hidden');
        document.querySelector('#qr_wrapper').classList.add('hidden');
    }

    function handleFile(input) {
        const file = input.files[0];
        if (!file) return;

        // ✅ ซ่อนผลลัพธ์ก่อนเสมอ
        resultBox.innerHTML = '';
        resultContainer.classList.add('hidden');

        const reader = new FileReader();
        reader.onload = function (e) {
            const img = new Image();
            img.onload = function () {
                canvas.width = img.width;
                canvas.height = img.height;
                ctx.drawImage(img, 0, 0);
                const imageData = ctx.getImageData(0, 0, canvas.width, canvas.height);
                const code = jsQR(imageData.data, imageData.width, imageData.height);

                const qrImageEl = document.getElementById('qr_image');
                const qrVideoEl = document.getElementById('qr_video');

                if (code) {
                    stopCamera();
                    clearInterval(scanInterval);
                    qrImageEl.style.display = 'none';

                    if (code.data.includes('officer_register_unit')) {
                        window.location.href = code.data;
                    } else {
                        qrImageEl.src = e.target.result;
                        qrImageEl.style.display = 'block';
                        qrVideoEl.style.display = 'none';

                        showResult('QR Code ไม่ถูกต้อง');
                    }
                } else {
                    // ไม่พบ QR → แสดงรูปภาพแทน
                    qrImageEl.src = e.target.result;
                    qrImageEl.style.display = 'block';
                    qrVideoEl.style.display = 'none';

                    showResult('ไม่พบ QR Code');
                }
            };
            img.src = e.target.result;
        };
        reader.readAsDataURL(file);
    }

    document.addEventListener('DOMContentLoaded', startCameraAndScan);
</script>

@endsection

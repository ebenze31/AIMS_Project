@extends('layouts.partners.theme_partner_new')

@section('content')
    
<div class="card radius-10 border-top border-0 border-4 border-secondary">
    <div class="card-body p-3">
        <div class="card-title d-flex align-items-center">
            <h5 class="mb-0">
                หน่วย : {{ $aims_operating_unit->name_unit }}
            </h5>
        </div>
        <hr>
        <div class="row">
            <div class="col-12 col-md-3">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex flex-column align-items-center text-center">
                            <!-- Container สำหรับ QR -->
                            <div id="qrcode"></div>

                            <div class="mt-3">
                                <p class="text-secondary mb-1">QR-Code สำหรับลงทะเบียนเจ้าหน้าที่</p>
                                <button class="btn btn-sm btn-primary" style="width: 100%;" onclick="downloadQR()">
                                    ดาวน์โหลด
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-12 col-md-9">
                
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/qrcodejs@1.0.0/qrcode.min.js"></script>

<script>
    const qrUrl = "{{ url('/officer_register_unit') }}/{{ $aims_operating_unit->id }}";

    // สร้าง QR Code
    const qrcode = new QRCode(document.getElementById("qrcode"), {
        text: qrUrl,
        width: 200,
        height: 200
    });

    // ฟังก์ชันดาวน์โหลด
    function downloadQR() {
        const qrCanvas = document.querySelector('#qrcode canvas');
        if (!qrCanvas) return;

        const imgData = qrCanvas.toDataURL("image/png");

        const link = document.createElement('a');
        link.href = imgData;
        link.download = 'qr_register_'+"{{ $aims_operating_unit->id }}"+'.png';
        link.click();
    }
</script>

@endsection

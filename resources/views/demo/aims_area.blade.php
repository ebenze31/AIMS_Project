@extends('layouts.partners.theme_partner_new')

@section('content')
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, 'Helvetica Neue', Arial, sans-serif;
            background: #f5f7fa;
            min-height: 100vh;
            padding: 20px;
            color: #1a1a1a;
        }

        .container {
            max-width: 1400px;
            margin: 0 auto;
        }

        .card {
            background: white;
            border-radius: 12px;
            border: 1px solid #e5e7eb;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.05);
            overflow: hidden;
        }

        .card-header {
            padding: 24px;
            border-bottom: none !important;
            background-color: #fff !important;
            padding-bottom: 0 !important;
        }

        .card-header h1 {
            font-size: 24px;
            font-weight: 700;
            color: #1a1a1a;
            margin-bottom: 4px;
        }

        .card-header p {
            font-size: 14px;
            color: #6b7280;
        }

        .card-content {
            padding: 24px;
        }

        .controls {
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 16px;
            margin-bottom: 24px;
            flex-wrap: wrap;
        }

        .search-wrapper {
            position: relative;
            flex: 1;
            min-width: 280px;
            max-width: 400px;
        }

        .search-icon {
            position: absolute;
            left: 12px;
            top: 50%;
            transform: translateY(-50%);
            width: 18px;
            height: 18px;
            color: #9ca3af;
        }

        .search-input {
            width: 100%;
            padding: 10px 12px 10px 40px;
            border: 1px solid #e5e7eb;
            border-radius: 8px;
            font-size: 14px;
            transition: all 0.2s;
            background: white;
        }

        .search-input:focus {
            outline: none;
            border-color: #3b82f6;
            box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.1);
        }

        .btn-add {
            background: #3b82f6;
            color: white;
            border: none;
            padding: 10px 20px;
            border-radius: 8px;
            cursor: pointer;
            font-size: 14px;
            font-weight: 500;
            display: flex;
            align-items: center;
            gap: 6px;
            transition: background 0.2s;
            white-space: nowrap;
        }

        .btn-add:hover {
            background: #2563eb;
        }

        .btn-add svg {
            width: 16px;
            height: 16px;
        }

        .table-container {
            border: 1px solid #e5e7eb;
            border-radius: 8px;
            overflow: hidden;
        }

        .table-wrapper {
            overflow-x: auto;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        thead {
            background: #f9fafb;
        }

        thead th {
            padding: 12px 16px;
            text-align: left;
            font-weight: 600;
            font-size: 13px;
            color: #6b7280;
            border-bottom: 1px solid #e5e7eb;
            white-space: nowrap;
        }

        thead th.text-center {
            text-align: center;
        }

        thead th.text-right {
            text-align: right;
        }

        tbody tr {
            border-bottom: 1px solid #f3f4f6;
            transition: background 0.15s;
        }

        tbody tr:hover {
            background: #f9fafb;
        }

        tbody tr:last-child {
            border-bottom: none;
        }

        tbody td {
            padding: 16px;
            font-size: 14px;
            color: #1f2937;
        }

        tbody td.text-center {
            text-align: center;
        }

        tbody td.text-right {
            text-align: right;
        }

        .area-name {
            font-weight: 500;
            color: #1a1a1a;
        }

        .badge {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            padding: 6px 12px;
            border-radius: 9999px;
            font-size: 13px;
            font-weight: 500;
        }

        .badge-primary {
            background: rgba(59, 130, 246, 0.1);
            color: #3b82f6;
        }

        .badge-success {
            background: rgba(16, 185, 129, 0.1);
            color: #10b981;
        }

        .badge-warning {
            background: rgba(245, 158, 11, 0.1);
            color: #f59e0b;
        }

        .badge-muted {
            background: #f3f4f6;
            color: #6b7280;
        }

        .badge svg {
            width: 16px;
            height: 16px;
        }

        .tools {
            display: flex;
            gap: 8px;
            justify-content: flex-end;
        }

        .btn-tool {
            border: 1px solid #e5e7eb;
            background: white;
            cursor: pointer;
            padding: 8px 12px;
            border-radius: 6px;
            font-size: 13px;
            font-weight: 500;
            display: inline-flex;
            align-items: center;
            gap: 6px;
            transition: all 0.2s;
        }

        .btn-tool svg {
            width: 16px;
            height: 16px;
        }

        .btn-edit {
            color: #6b7280;
        }

        .btn-edit:hover {
            background: #f9fafb;
            border-color: #d1d5db;
        }

        .btn-delete {
            background: #ef4444;
            color: white;
            border-color: #ef4444;
        }

        .btn-delete:hover {
            background: #dc2626;
            border-color: #dc2626;
        }

        .btn-tool-text {
            display: none;
        }

        .empty-state {
            text-align: center;
            padding: 60px 20px;
            color: #9ca3af;
        }

        /* Modal */
        .modal {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.4);
            z-index: 1000;
            align-items: center;
            justify-content: center;
        }

        .modal.active {
            display: flex;
        }

        .modal-content {
            background: white;
            padding: 32px;
            border-radius: 12px;
            max-width: 500px;
            width: 90%;
            box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1);
        }

        .modal-header {
            margin-bottom: 24px;
        }

        .modal-header h2 {
            color: #1a1a1a;
            font-size: 20px;
            font-weight: 600;
        }

        .form-group {
            margin-bottom: 20px;
        }

        .form-group label {
            display: block;
            margin-bottom: 8px;
            color: #374151;
            font-weight: 500;
            font-size: 14px;
        }

        .form-group input,
        .form-group select {
            width: 100%;
            padding: 10px 12px;
            border: 1px solid #e5e7eb;
            border-radius: 8px;
            font-size: 14px;
            transition: all 0.2s;
        }

        .form-group input:focus,
        .form-group select:focus {
            outline: none;
            border-color: #3b82f6;
            box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.1);
        }

        .form-group input[readonly] {
            background: #f9fafb;
            color: #6b7280;
            cursor: not-allowed;
        }

        .select-with-button {
            display: flex;
            gap: 8px;
            align-items: center;
        }

        .select-with-button select {
            flex: 1;
        }

        .btn-otp {
            background: #10b981;
            color: white;
            border: none;
            padding: 10px 16px;
            border-radius: 8px;
            cursor: pointer;
            font-size: 14px;
            font-weight: 500;
            transition: all 0.2s;
            white-space: nowrap;
            display: none;
        }

        .btn-otp.show {
            display: block;
        }

        .btn-otp:hover {
            background: #059669;
        }

        .btn-otp:disabled {
            background: #9ca3af;
            cursor: not-allowed;
        }

        .otp-section {
            display: none;
            margin-top: 16px;
            padding: 16px;
            background: #f0fdf4;
            border: 1px solid #86efac;
            border-radius: 8px;
        }

        .otp-section.show {
            display: block;
        }

        .otp-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 12px;
        }

        .otp-header h4 {
            font-size: 14px;
            font-weight: 600;
            color: #166534;
            margin: 0;
        }

        .otp-timer {
            font-size: 13px;
            color: #16a34a;
            font-weight: 500;
        }

        .otp-input-group {
            display: flex;
            justify-content: space-around;
            gap: 8px;
            margin-bottom: 12px;
        }

        .otp-input {
            width: 50px;
            height: 50px;
            text-align: center;
            font-size: 20px;
            font-weight: 600;
            border: 2px solid #86efac;
            border-radius: 8px;
            transition: all 0.2s;
        }

        .otp-input:focus {
            outline: none;
            border-color: #10b981;
            box-shadow: 0 0 0 3px rgba(16, 185, 129, 0.1);
        }

        .otp-message {
            font-size: 13px;
            color: #16a34a;
            margin-bottom: 12px;
        }

        .btn-verify-otp {
            background: #10b981;
            color: white;
            border: none;
            padding: 10px 20px;
            border-radius: 8px;
            cursor: pointer;
            font-size: 14px;
            font-weight: 500;
            transition: background 0.2s;
            width: 100%;
        }

        .btn-verify-otp:hover {
            background: #059669;
        }

        .btn-verify-otp:disabled {
            background: #9ca3af;
            cursor: not-allowed;
        }

        .btn-resend-otp {
            background: transparent;
            color: #10b981;
            border: none;
            padding: 8px;
            cursor: pointer;
            font-size: 13px;
            font-weight: 500;
            text-decoration: underline;
            transition: color 0.2s;
        }

        .btn-resend-otp:hover {
            color: #059669;
        }

        .btn-resend-otp:disabled {
            color: #9ca3af;
            cursor: not-allowed;
            text-decoration: none;
        }

        .verified-badge {
            display: none;
            align-items: center;
            gap: 6px;
            padding: 6px 12px;
            background: #d1fae5;
            color: #065f46;
            border-radius: 6px;
            font-size: 13px;
            font-weight: 500;
            margin-top: 8px;
        }

        .verified-badge.show {
            display: inline-flex;
        }

        .verified-badge svg {
            width: 16px;
            height: 16px;
        }

        .modal-actions {
            display: flex;
            gap: 10px;
            justify-content: flex-end;
            margin-top: 24px;
        }

        .btn-cancel {
            background: white;
            color: #6b7280;
            border: 1px solid #e5e7eb;
            padding: 10px 20px;
            border-radius: 8px;
            cursor: pointer;
            font-size: 14px;
            font-weight: 500;
            transition: all 0.2s;
        }

        .btn-cancel:hover {
            background: #f9fafb;
            border-color: #d1d5db;
        }

        .btn-save {
            background: #3b82f6;
            color: white;
            border: none;
            padding: 10px 20px;
            border-radius: 8px;
            cursor: pointer;
            font-size: 14px;
            font-weight: 500;
            transition: background 0.2s;
        }

        .btn-save:hover {
            background: #2563eb;
        }

        .btn-save:disabled {
            background: #9ca3af;
            cursor: not-allowed;
        }

        /* Responsive */
        @media (min-width: 640px) {
            .btn-tool-text {
                display: inline;
            }
        }

        @media (max-width: 768px) {
            body {
                padding: 12px;
            }

            .card-header {
                padding: 20px;
            }

            .card-header h1 {
                font-size: 20px;
            }

            .card-content {
                padding: 20px;
            }

            .controls {
                flex-direction: column;
                align-items: stretch;
            }

            .search-wrapper {
                max-width: none;
            }

            .btn-add {
                justify-content: center;
            }

            .table-wrapper {
                margin: 0 -20px;
                padding: 0 20px;
            }

            table {
                min-width: 800px;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="card">
            <div class="card-header">
                <h1>รายชื่อพื้นที่บริการ</h1>
                <p>จัดการพื้นที่บริการทั้งหมด</p>
            </div>

            <div class="card-content">
                <div class="controls">
                    <div class="search-wrapper">
                        <svg class="search-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <circle cx="11" cy="11" r="8"></circle>
                            <path d="m21 21-4.3-4.3"></path>
                        </svg>
                        <input type="text" class="search-input" id="searchInput" placeholder="ค้นหาพื้นที่บริการ หรือกลุ่มไลน์..." onkeyup="searchTable()">
                    </div>
                    <button class="btn-add" onclick="openModal()">
                        <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-width="2" d="M12 4v16m8-8H4"></path>
                        </svg>
                        เพิ่มพื้นที่บริการ
                    </button>
                </div>

                <div class="table-container">
                    <div class="table-wrapper">
                        <table>
                            <thead>
                                <tr>
                                    <th>ชื่อพื้นที่บริการ</th>
                                    <th>ชื่อกลุ่มไลน์</th>
                                    <th class="text-center">พื้นที่ปัจจุบัน</th>
                                    <th class="text-center">รอการตรวจสอบ</th>
                                    <th class="text-right">เครื่องมือ</th>
                                </tr>
                            </thead>
                            <tbody id="tableBody">
                                <!-- Data will be populated here -->
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal" id="modal">
        <div class="modal-content">
            <div class="modal-header">
                <h2 id="modalTitle">เพิ่มพื้นที่บริการใหม่</h2>
            </div>
            <form id="serviceForm">
                <div class="form-group">
                    <label>ชื่อพาร์ทเนอร์</label>
                    <input type="text" id="partnerName" readonly value="2บี กรีน จำกัด">
                </div>
                <div class="form-group">
                    <label>เบอร์</label>
                    <input type="text" id="phoneNumber" readonly value="020277856">
                </div>
                <div class="form-group">
                    <label>อีเมล</label>
                    <input type="text" id="email" readonly value="thanakorn.tnk12@gmail.com">
                </div>
                <div class="form-group">
                    <label>เลือกกลุ่มไลน์</label>
                    <div class="select-with-button">
                        <select id="lineGroup" required>
                            <option value="">-- เลือกกลุ่มไลน์ --</option>
                            <option value="กลุ่มไลน์ A">กลุ่มไลน์ A</option>
                            <option value="กลุ่มไลน์ B">กลุ่มไลน์ B</option>
                            <option value="กลุ่มไลน์ C">กลุ่มไลน์ C</option>
                            <option value="กลุ่มไลน์ C">กลุ่มไลน์ D</option>
                        </select>
                        <button type="button" class="btn-otp" id="btnSendOtp" onclick="sendOtp()">ส่ง OTP</button>
                    </div>
                    
                    <div class="verified-badge" id="verifiedBadge">
                        <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-width="2" d="M9 12.75 11.25 15 15 9.75M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z"></path>
                        </svg>
                        ยืนยัน OTP สำเร็จ
                    </div>
                </div>

                <div class="otp-section" id="otpSection">
                    <div class="otp-header">
                        <h4>กรอกรหัส OTP</h4>
                        <span class="otp-timer" id="otpTimer">05:00</span>
                    </div>
                    <p class="otp-message">รหัส OTP ถูกส่งไปที่ <strong id="otpDestination"></strong></p>
                    <div class="otp-input-group">
                        <input type="text" class="otp-input" maxlength="1" id="otp1" onkeyup="moveToNext(this, 'otp2')" onpaste="handlePaste(event)">
                        <input type="text" class="otp-input" maxlength="1" id="otp2" onkeyup="moveToNext(this, 'otp3')">
                        <input type="text" class="otp-input" maxlength="1" id="otp3" onkeyup="moveToNext(this, 'otp4')">
                        <input type="text" class="otp-input" maxlength="1" id="otp4" onkeyup="moveToNext(this, 'otp5')">
                        <input type="text" class="otp-input" maxlength="1" id="otp5" onkeyup="moveToNext(this, 'otp6')">
                        <input type="text" class="otp-input" maxlength="1" id="otp6" onkeyup="checkOtpComplete()">
                    </div>
                    <button type="button" class="btn-verify-otp" id="btnVerifyOtp" onclick="verifyOtp()" disabled>ยืนยัน OTP</button>
                    <div style="text-align: center; margin-top: 12px;">
                        <button type="button" class="btn-resend-otp" id="btnResendOtp" onclick="resendOtp()" disabled>ส่ง OTP อีกครั้ง</button>
                    </div>
                </div>

                <div class="modal-actions">
                    <button type="button" class="btn-cancel" onclick="closeModal()">ยกเลิก</button>
                    <button type="submit" class="btn-save" id="btnSave" disabled>บันทึก</button>
                </div>
            </form>
        </div>
    </div>

    <script>
        let serviceAreas = [
            { id: 1, name: 'ViiCHECK นครนายก', lineGroup: 'กลุ่มไลน์ A', currentActive: true, pendingActive: true },
            { id: 2, name: 'ViiCHECK จตุจักร', lineGroup: 'กลุ่มไลน์ B', currentActive: true, pendingActive: false },
            { id: 3, name: 'ViiCHECK พระนครศรีอยุธยา', lineGroup: 'กลุ่มไลน์ C', currentActive: false, pendingActive: true },
            { id: 4, name: 'ViiCHECK สระบุรี', lineGroup: 'กลุ่มไลน์ D', currentActive: true, pendingActive: false }
        ];
        
        let editingId = null;
        let otpTimer = null;
        let otpTimeLeft = 300; // 5 minutes
        let isOtpVerified = false;

        // Show/Hide OTP button when line group is selected
        document.getElementById('lineGroup').addEventListener('change', function() {
            const btnSendOtp = document.getElementById('btnSendOtp');
            const verifiedBadge = document.getElementById('verifiedBadge');
            
            if (this.value) {
                btnSendOtp.classList.add('show');
            } else {
                btnSendOtp.classList.remove('show');
                verifiedBadge.classList.remove('show');
                hideOtpSection();
            }
            
            updateSaveButton();
        });

        function sendOtp() {
            const lineGroup = document.getElementById('lineGroup').value;
            const email = document.getElementById('email').value;
            
            if (!lineGroup) {
                alert('กรุณาเลือกกลุ่มไลน์');
                return;
            }

            // Show OTP section
            document.getElementById('otpSection').classList.add('show');
            document.getElementById('otpDestination').textContent = lineGroup;
            
            // Start timer
            startOtpTimer();
            
            // Clear OTP inputs
            clearOtpInputs();
            
            // Focus first input
            document.getElementById('otp1').focus();
            
            // Simulate OTP sent (in real app, call API here)
            console.log('OTP sent to:', email, 'for line group:', lineGroup);
        }

        function startOtpTimer() {
            otpTimeLeft = 300; // Reset to 5 minutes
            const btnResendOtp = document.getElementById('btnResendOtp');
            btnResendOtp.disabled = true;
            
            if (otpTimer) {
                clearInterval(otpTimer);
            }
            
            otpTimer = setInterval(() => {
                otpTimeLeft--;
                
                const minutes = Math.floor(otpTimeLeft / 60);
                const seconds = otpTimeLeft % 60;
                document.getElementById('otpTimer').textContent = 
                    `${minutes.toString().padStart(2, '0')}:${seconds.toString().padStart(2, '0')}`;
                
                if (otpTimeLeft <= 0) {
                    clearInterval(otpTimer);
                    btnResendOtp.disabled = false;
                }
            }, 1000);
        }

        function resendOtp() {
            sendOtp();
        }

        function moveToNext(current, nextId) {
            if (current.value.length === 1) {
                if (nextId) {
                    document.getElementById(nextId).focus();
                }
            }
            
            // Enable backspace to previous
            current.addEventListener('keydown', function(e) {
                if (e.key === 'Backspace' && !current.value) {
                    const inputs = ['otp1', 'otp2', 'otp3', 'otp4', 'otp5', 'otp6'];
                    const currentIndex = inputs.indexOf(current.id);
                    if (currentIndex > 0) {
                        document.getElementById(inputs[currentIndex - 1]).focus();
                    }
                }
            });
            
            checkOtpComplete();
        }

        function handlePaste(e) {
            e.preventDefault();
            const paste = (e.clipboardData || window.clipboardData).getData('text');
            const otpDigits = paste.replace(/\D/g, '').slice(0, 6);
            
            for (let i = 0; i < otpDigits.length; i++) {
                document.getElementById(`otp${i + 1}`).value = otpDigits[i];
            }
            
            if (otpDigits.length === 6) {
                document.getElementById('otp6').focus();
            }
            
            checkOtpComplete();
        }

        function checkOtpComplete() {
            const otp1 = document.getElementById('otp1').value;
            const otp2 = document.getElementById('otp2').value;
            const otp3 = document.getElementById('otp3').value;
            const otp4 = document.getElementById('otp4').value;
            const otp5 = document.getElementById('otp5').value;
            const otp6 = document.getElementById('otp6').value;
            
            const btnVerifyOtp = document.getElementById('btnVerifyOtp');
            
            if (otp1 && otp2 && otp3 && otp4 && otp5 && otp6) {
                btnVerifyOtp.disabled = false;
            } else {
                btnVerifyOtp.disabled = true;
            }
        }

        function verifyOtp() {
            const otp = 
                document.getElementById('otp1').value +
                document.getElementById('otp2').value +
                document.getElementById('otp3').value +
                document.getElementById('otp4').value +
                document.getElementById('otp5').value +
                document.getElementById('otp6').value;
            
            // Simulate OTP verification (in real app, call API here)
            // For demo, accept "123456" as valid OTP
            if (otp === '123456') {
                isOtpVerified = true;
                
                // Hide OTP section
                hideOtpSection();
                
                // Show verified badge
                document.getElementById('verifiedBadge').classList.add('show');
                
                // Hide send OTP button
                document.getElementById('btnSendOtp').classList.remove('show');
                
                // Enable save button
                updateSaveButton();
                
                alert('ยืนยัน OTP สำเร็จ!');
            } else {
                alert('รหัส OTP ไม่ถูกต้อง กรุณาลองใหม่อีกครั้ง');
                clearOtpInputs();
                document.getElementById('otp1').focus();
            }
        }

        function clearOtpInputs() {
            document.getElementById('otp1').value = '';
            document.getElementById('otp2').value = '';
            document.getElementById('otp3').value = '';
            document.getElementById('otp4').value = '';
            document.getElementById('otp5').value = '';
            document.getElementById('otp6').value = '';
            document.getElementById('btnVerifyOtp').disabled = true;
        }

        function hideOtpSection() {
            document.getElementById('otpSection').classList.remove('show');
            if (otpTimer) {
                clearInterval(otpTimer);
            }
            clearOtpInputs();
        }

        function updateSaveButton() {
            const lineGroup = document.getElementById('lineGroup').value;
            const btnSave = document.getElementById('btnSave');
            
            if (lineGroup && isOtpVerified) {
                btnSave.disabled = false;
            } else {
                btnSave.disabled = true;
            }
        }

        function renderTable() {
            const tbody = document.getElementById('tableBody');
            
            if (serviceAreas.length === 0) {
                tbody.innerHTML = `
                    <tr>
                        <td colspan="5">
                            <div class="empty-state">
                                <p>ยังไม่มีข้อมูลพื้นที่บริการ</p>
                            </div>
                        </td>
                    </tr>
                `;
                return;
            }

            tbody.innerHTML = serviceAreas.map(area => `
                <tr>
                    <td><span class="area-name">${area.name}</span></td>
                    <td>
                        <span class="badge badge-primary">${area.lineGroup}</span>
                    </td>
                    <td class="text-center">
                        ${area.currentActive ? `
                            <span class="badge badge-success">
                                <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-width="2" d="M20 6 9 17l-5-5"></path>
                                </svg>
                                มี
                            </span>
                        ` : `
                            <span class="badge badge-muted">
                                <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-width="2" d="M18 6 6 18M6 6l12 12"></path>
                                </svg>
                                ไม่มี
                            </span>
                        `}
                    </td>
                    <td class="text-center">
                        ${area.pendingActive ? `
                            <span class="badge badge-warning">
                                <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-width="2" d="M20 6 9 17l-5-5"></path>
                                </svg>
                                มี
                            </span>
                        ` : `
                            <span class="badge badge-muted">
                                <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-width="2" d="M18 6 6 18M6 6l12 12"></path>
                                </svg>
                                ไม่มี
                            </span>
                        `}
                    </td>
                    <td class="text-right">
                        <div class="tools">
                            <button class="btn-tool btn-edit" onclick="editArea(${area.id})">
                                <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-width="2" d="M21.174 6.812a1 1 0 0 0-3.986-3.987L3.842 16.174a2 2 0 0 0-.5.83l-1.321 4.352a.5.5 0 0 0 .623.622l4.353-1.32a2 2 0 0 0 .83-.497z"></path>
                                    <path stroke-width="2" d="m15 5 4 4"></path>
                                </svg>
                                <span class="btn-tool-text">แก้ไข</span>
                            </button>
                            <button class="btn-tool btn-delete" onclick="deleteArea(${area.id})">
                                <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-width="2" d="M3 6h18M19 6v14c0 1-1 2-2 2H7c-1 0-2-1-2-2V6M8 6V4c0-1 1-2 2-2h4c1 0 2 1 2 2v2"></path>
                                    <line stroke-width="2" x1="10" x2="10" y1="11" y2="17"></line>
                                    <line stroke-width="2" x1="14" x2="14" y1="11" y2="17"></line>
                                </svg>
                                <span class="btn-tool-text">ลบ</span>
                            </button>
                        </div>
                    </td>
                </tr>
            `).join('');
        }

        function openModal(id = null) {
            const modal = document.getElementById('modal');
            const modalTitle = document.getElementById('modalTitle');
            const form = document.getElementById('serviceForm');
            
            // Reset OTP state
            isOtpVerified = false;
            hideOtpSection();
            document.getElementById('verifiedBadge').classList.remove('show');
            document.getElementById('btnSendOtp').classList.remove('show');
            
            if (id) {
                editingId = id;
                const area = serviceAreas.find(a => a.id === id);
                modalTitle.textContent = 'แก้ไขพื้นที่บริการ';
                document.getElementById('lineGroup').value = area.lineGroup;
                
                // For edit, assume OTP is already verified
                isOtpVerified = true;
                document.getElementById('verifiedBadge').classList.add('show');
            } else {
                editingId = null;
                modalTitle.textContent = 'เพิ่มพื้นที่บริการใหม่';
                form.reset();
            }
            
            updateSaveButton();
            modal.classList.add('active');
        }

        function closeModal() {
            const modal = document.getElementById('modal');
            modal.classList.remove('active');
            editingId = null;
            hideOtpSection();
            isOtpVerified = false;
        }

        function editArea(id) {
            openModal(id);
        }

        function deleteArea(id) {
            if (confirm('คุณต้องการลบพื้นที่บริการนี้ใช่หรือไม่?')) {
                serviceAreas = serviceAreas.filter(area => area.id !== id);
                renderTable();
            }
        }

        function searchTable() {
            const input = document.getElementById('searchInput').value.toLowerCase();
            const rows = document.querySelectorAll('#tableBody tr');
            
            rows.forEach(row => {
                const text = row.textContent.toLowerCase();
                row.style.display = text.includes(input) ? '' : 'none';
            });
        }

        document.getElementById('serviceForm').addEventListener('submit', function(e) {
            e.preventDefault();
            
            const lineGroup = document.getElementById('lineGroup').value;
            
            if (!isOtpVerified) {
                alert('กรุณายืนยัน OTP ก่อนบันทึก');
                return;
            }
            
            if (editingId) {
                const index = serviceAreas.findIndex(a => a.id === editingId);
                serviceAreas[index] = { 
                    ...serviceAreas[index], 
                    lineGroup
                };
            } else {
                const newId = serviceAreas.length > 0 ? Math.max(...serviceAreas.map(a => a.id)) + 1 : 1;
                // Use partner name as area name
                const name = document.getElementById('partnerName').value;
                serviceAreas.push({ 
                    id: newId, 
                    name, 
                    lineGroup, 
                    currentActive: true,
                    pendingActive: false
                });
            }
            
            renderTable();
            closeModal();
        });

        document.getElementById('modal').addEventListener('click', function(e) {
            if (e.target === this) {
                closeModal();
            }
        });

        renderTable();
    </script> 
@endsection
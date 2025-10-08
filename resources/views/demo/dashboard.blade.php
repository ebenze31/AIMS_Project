@extends('layouts.partners.theme_partner_new')

@section('content')

<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=IBM+Plex+Sans+Thai:wght@300;400;500;600&display=swap" rel="stylesheet">

<style>
    * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
    }

    body {
        font-family: 'IBM Plex Sans Thai', -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
        background: #f8fafc;
        color: #1e293b;
        line-height: 1.6;
    }

    main {
        width: 100%;
        padding: 24px;
        max-width: 1600px;
        margin: 0 auto;
    }

    /* Header */
    .header {
        margin-bottom: 32px;
        display: flex;
        justify-content: space-between;
        align-items: center;
        flex-wrap: wrap;
        gap: 16px;
    }

    .header h1 {
        font-size: 28px;
        font-weight: 700;
        color: #0f172a;
        margin-bottom: 4px;
    }

    .header p {
        color: #64748b;
        font-size: 15px;
    }

    .date-filter {
        display: flex;
        gap: 6px;
        background-color: #f1f5f9;
        padding: 4px;
        border-radius: 10px;
    }

    .date-filter button {
        background: none;
        border: none;
        padding: 8px 16px;
        border-radius: 8px;
        cursor: pointer;
        font-family: 'IBM Plex Sans Thai', sans-serif;
        font-weight: 500;
        color: #64748b;
        transition: all 0.2s ease;
        font-size: 14px;
    }

    .date-filter button.active,
    .date-filter button:hover {
        background-color: white;
        color: #0f172a;
        box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
    }

    /* Stats Cards */
    .stats {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(240px, 1fr));
        gap: 20px;
        margin-bottom: 32px;
    }

    .stat-card {
        background: white;
        padding: 24px;
        border-radius: 16px;
        box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
        transition: transform 0.2s, box-shadow 0.2s;
    }

    .stat-card:hover {
        transform: translateY(-2px);
        box-shadow: 0 8px 16px rgba(0, 0, 0, 0.1);
    }

    .stat-icon {
        width: 48px;
        height: 48px;
        border-radius: 12px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 24px;
        margin-bottom: 16px;
    }

    .stat-value {
        font-size: 32px;
        font-weight: 700;
        margin-bottom: 4px;
    }

    .stat-label {
        color: #64748b;
        font-size: 14px;
        margin-bottom: 8px;
    }

    .stat-trend {
        font-size: 13px;
        font-weight: 600;
    }

    .trend-up {
        color: #10b981;
    }

    .trend-down {
        color: #ef4444;
    }

    /* Content Grid */
    .content-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(320px, 1fr));
        gap: 24px;
        margin-bottom: 32px;
    }

    .card {
        background: white;
        padding: 28px;
        border-radius: 16px;
        box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
    }

    .card-title {
        font-size: 18px;
        font-weight: 600;
        margin-bottom: 20px;
        color: #0f172a;
    }

    /* Chart Bars */
    .chart-bar {
        margin-bottom: 20px;
    }

    .chart-label {
        display: flex;
        justify-content: space-between;
        margin-bottom: 8px;
        font-size: 14px;
    }

    .chart-label-name {
        color: #475569;
        font-weight: 500;
    }

    .chart-label-value {
        color: #0f172a;
        font-weight: 600;
    }

    .bar-track {
        height: 8px;
        background: #e2e8f0;
        border-radius: 8px;
        overflow: hidden;
    }

    .bar-fill {
        height: 100%;
        border-radius: 8px;
        transition: width 0.8s ease;
    }

    /* Progress Circles */
    .progress-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(100px, 1fr));
        gap: 24px;
        text-align: center;
    }

    .progress-item {
        display: flex;
        flex-direction: column;
        align-items: center;
    }

    .progress-circle {
        width: 100px;
        height: 100px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 20px;
        font-weight: 700;
        margin-bottom: 12px;
        position: relative;
    }

    .progress-label {
        font-size: 13px;
        color: #64748b;
        font-weight: 500;
    }

    .progress-count {
        font-size: 14px;
        color: #0f172a;
        font-weight: 600;
        margin-top: 4px;
    }

    /* Table */
    table {
        width: 100%;
        border-collapse: collapse;
    }

    th {
        text-align: left;
        padding: 12px;
        font-size: 12px;
        font-weight: 600;
        color: #64748b;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        border-bottom: 2px solid #e2e8f0;
    }

    td {
        padding: 16px 12px;
        font-size: 14px;
        border-bottom: 1px solid #f1f5f9;
    }

    tr:last-child td {
        border-bottom: none;
    }

    tbody tr:hover {
        background-color: #f8fafc;
    }

    .rank {
        font-size: 20px;
    }

    .status-badge {
        display: inline-block;
        padding: 4px 10px;
        border-radius: 6px;
        font-size: 12px;
        font-weight: 600;
    }

    .status-emergency {
        background: #fee2e2;
        color: #991b1b;
    }

    .status-severe {
        background: #fed7aa;
        color: #9a3412;
    }

    .status-non-severe {
        background: #d1fae5;
        color: #065f46;
    }

    .status-general {
        background: #dbeafe;
        color: #1e40af;
    }

          /* Heatmap */
        .heatmap {
            display: grid;
            grid-template-columns: 60px repeat(7, 1fr);
            gap: 6px;
            font-size: 12px;
        }

        .heatmap-cell {
            aspect-ratio: 18/9;
            border-radius: 8px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 600;
            color: white;
            font-size: 11px;
        }

        .heatmap-label {
            display: flex;
            align-items: center;
            color: #64748b;
            font-size: 11px;
            font-weight: 600;
        }

        .heatmap-header {
            display: flex;
            align-items: center;
            justify-content: center;
            color: #64748b;
            font-size: 11px;
            font-weight: 600;
            padding-bottom: 8px;
        }

    /* Timeline */
    .timeline-item {
        display: flex;
        gap: 16px;
        margin-bottom: 24px;
        position: relative;
    }

    .timeline-item:last-child {
        margin-bottom: 0;
    }

    .timeline-item:not(:last-child)::before {
        content: '';
        position: absolute;
        left: 16px;
        top: 36px;
        width: 2px;
        height: calc(100% - 12px);
        background: #e2e8f0;
    }

    .timeline-dot {
        width: 32px;
        height: 32px;
        border-radius: 50%;
        flex-shrink: 0;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 16px;
        z-index: 1;
    }

    .timeline-content {
        flex: 1;
        padding-top: 2px;
    }

    .timeline-title {
        font-weight: 600;
        font-size: 14px;
        margin-bottom: 4px;
        color: #0f172a;
    }

    .timeline-text {
        font-size: 13px;
        color: #64748b;
        line-height: 1.5;
    }

    .timeline-time {
        font-size: 12px;
        color: #94a3b8;
        margin-top: 4px;
    }

    /* Officer Status */
    .officer-item {
        display: flex;
        align-items: center;
        padding: 12px 0;
        border-bottom: 1px solid #f1f5f9;
    }

    .officer-item:last-child {
        border-bottom: none;
    }

    .status-dot {
        width: 10px;
        height: 10px;
        border-radius: 50%;
        margin-right: 12px;
        flex-shrink: 0;
    }

    .dot-available {
        background-color: #10b981;
    }

    .dot-busy {
        background-color: #f59e0b;
    }

    .dot-traveling {
        background-color: #3b82f6;
    }

    .officer-info {
        display: flex;
        flex-direction: column;
    }

    .officer-name {
        font-weight: 600;
        font-size: 14px;
        color: #0f172a;
    }

    .officer-details {
        font-size: 12px;
        color: #64748b;
        margin-top: 2px;
    }

    /* Full Width Card */
    .card-full {
        grid-column: 1 / -1;
    }

    /* Summary */
    .summary {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        color: white;
        padding: 32px;
        border-radius: 16px;
        margin-top: 32px;
    }

    .summary h2 {
        font-size: 22px;
        margin-bottom: 16px;
    }

    .summary p {
        font-size: 15px;
        line-height: 1.8;
        opacity: 0.95;
        margin-bottom: 12px;
    }

    .summary p:last-child {
        margin-bottom: 0;
    }

    /* Map Container */
    .map-container {
        display: flex;
        gap: 24px;
        margin-bottom: 32px;
    }

    .map-card {
        flex: 1;
        background: white;
        padding: 24px;
        border-radius: 16px;
        box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
        overflow: auto;
        max-height: 600px;
    }

    .map-placeholder {
        width: 100%;
        height: 400px;
        display: flex;
        align-items: center;
        justify-content: center;
        background: linear-gradient(rgba(0, 0, 0, 0.5), rgba(0, 0, 0, 0.5)), url('https://i.imgur.com/gK9p22Z.png');
        background-size: cover;
        background-position: center;
        border-radius: 12px;
        font-size: 24px;
        font-weight: bold;
        color: rgba(255, 255, 255, 0.9);
    }

    /* Responsive */
    @media (max-width: 1024px) {
        .map-container {
            flex-direction: column;
        }

        .content-grid {
            grid-template-columns: 1fr;
        }
    }

    @media (max-width: 768px) {
        main {
            padding: 16px;
        }

        .header h1 {
            font-size: 24px;
        }

        .stats {
            grid-template-columns: 1fr;
        }

        .stat-value {
            font-size: 28px;
        }

        .heatmap {
            grid-template-columns: 50px repeat(7, 1fr);
            gap: 4px;
        }

        .heatmap-cell {
            font-size: 9px;
        }

        .date-filter {
            width: 100%;
            justify-content: space-between;
        }

        .date-filter button {
            flex: 1;
            padding: 8px 12px;
        }
    }

    @media (max-width: 480px) {
        .progress-grid {
            grid-template-columns: repeat(2, 1fr);
        }

        .card {
            padding: 20px;
        }
    }
</style>

<main>
    <!-- Header -->
    <div class="header">
        <div>
            <h1> ภาพรวมและรายงาน</h1>
            <!-- <p>ข้อมูลสรุปประสิทธิภาพการทำงานทั้งหมด</p> -->
        </div>
        <div class="date-filter">
            <button>วันนี้</button>
            <button>สัปดาห์</button>
            <button class="active">เดือนนี้</button>
            <button>ปี</button>
        </div>
    </div>

    <!-- Key Stats -->
    <div class="stats">
        <div class="stat-card">
            <div class="stat-icon" style="background: #ede9fe; color: #7c3aed;">📋</div>
            <div class="stat-value" style="color: #7c3aed;">1,247</div>
            <div class="stat-label">คำขอทั้งหมด</div>
            <!-- <div class="stat-trend trend-up">↑ 15.3% จากเดือนที่แล้ว</div> -->
        </div>

        <div class="stat-card">
            <div class="stat-icon" style="background: #fce7f3; color: #db2777;">⚡</div>
            <div class="stat-value" style="color: #db2777;">11 นาที</div>
            <div class="stat-label">เวลาตอบสนองเฉลี่ย</div>
            <!-- <div class="stat-trend trend-up">↓ 22% เร็วขึ้น</div> -->
        </div>

        <div class="stat-card">
            <div class="stat-icon" style="background: #dbeafe; color: #2563eb;">✓</div>
            <div class="stat-value" style="color: #2563eb;">94.8%</div>
            <div class="stat-label">อัตราการเสร็จสิ้น</div>
            <!-- <div class="stat-trend trend-up">↑ 2.1% ดีขึ้น</div> -->
        </div>

        <div class="stat-card">
            <div class="stat-icon" style="background: #d1fae5; color: #059669;">⭐</div>
            <div class="stat-value" style="color: #059669;">4.7</div>
            <div class="stat-label">คะแนนเฉลี่ย</div>
            <!-- <div class="stat-trend trend-up">↑ 0.3 คะแนนสูงขึ้น</div> -->
        </div>
    </div>

    <!-- Map and Queue -->
    <div class="map-container">
        <div class="map-card" style="flex: 2;">
            <h2 class="card-title">คิวคำขอความช่วยเหลือ</h2>
            <table>
                <thead>
                    <tr>
                        <th>ID เคส</th>
                        <th>เวลาแจ้ง</th>
                        <th>ผู้ขอ</th>
                        <th>สถานะ</th>
                        <th>ความรุนแรง</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>2509-0021</td>
                        <td>08:57</td>
                        <td>ผู้ขอใหม่</td>
                        <td>ใหม่</td>
                        <td><span class="status-badge status-general">ทั่วไป</span></td>
                    </tr>
                    <tr>
                        <td>2509-0020</td>
                        <td>08:57</td>
                        <td>ผู้ขอใหม่</td>
                        <td>ใหม่</td>
                        <td><span class="status-badge status-general">ทั่วไป</span></td>
                    </tr>
                    <tr>
                        <td>2509-0019</td>
                        <td>08:57</td>
                        <td>ผู้ขอใหม่</td>
                        <td>ใหม่</td>
                        <td><span class="status-badge status-general">ทั่วไป</span></td>
                    </tr>
                    <tr>
                        <td>2509-0017</td>
                        <td>11:52</td>
                        <td>คุณวินัย</td>
                        <td>รอประเมิน</td>
                        <td><span class="status-badge status-emergency">ฉุกเฉิน</span></td>
                    </tr>
                    <tr>
                        <td>2509-0016</td>
                        <td>11:50</td>
                        <td>คุณสมศรี</td>
                        <td>รอประเมิน</td>
                        <td><span class="status-badge status-severe">รุนแรง</span></td>
                    </tr>
                    <tr>
                        <td>2509-0015</td>
                        <td>11:48</td>
                        <td>คุณมานะ</td>
                        <td>กำลังช่วยเหลือ</td>
                        <td><span class="status-badge status-non-severe">ไม่รุนแรง</span></td>
                    </tr>
                </tbody>
            </table>
        </div>

        <div class="map-card">
            <h2 class="card-title">แผนที่สด</h2>
            <div class="map-placeholder">LIVE MAP</div>
        </div>
    </div>

    <!-- Content Grid -->
    <div class="content-grid">
        <!-- Request Types -->
        <div class="card">
            <h2 class="card-title">ประเภทคำขอที่พบบ่อย</h2>
            <div class="chart-bar">
                <div class="chart-label">
                    <span class="chart-label-name">อุบัติเหตุรถยนต์</span>
                    <span class="chart-label-value">450</span>
                </div>
                <div class="bar-track">
                    <div class="bar-fill" style="width: 100%; background: #ef4444;"></div>
                </div>
            </div>
            <div class="chart-bar">
                <div class="chart-label">
                    <span class="chart-label-name">เจ็บป่วยฉุกเฉิน</span>
                    <span class="chart-label-value">320</span>
                </div>
                <div class="bar-track">
                    <div class="bar-fill" style="width: 71%; background: #3b82f6;"></div>
                </div>
            </div>
            <div class="chart-bar">
                <div class="chart-label">
                    <span class="chart-label-name">รถเสีย</span>
                    <span class="chart-label-value">180</span>
                </div>
                <div class="bar-track">
                    <div class="bar-fill" style="width: 40%; background: #f59e0b;"></div>
                </div>
            </div>
            <div class="chart-bar">
                <div class="chart-label">
                    <span class="chart-label-name">เหตุทะเลาะวิวาท</span>
                    <span class="chart-label-value">110</span>
                </div>
                <div class="bar-track">
                    <div class="bar-fill" style="width: 24%; background: #f97316;"></div>
                </div>
            </div>
            <div class="chart-bar">
                <div class="chart-label">
                    <span class="chart-label-name">ช่วยเหลือสัตว์</span>
                    <span class="chart-label-value">95</span>
                </div>
                <div class="bar-track">
                    <div class="bar-fill" style="width: 21%; background: #8b5cf6;"></div>
                </div>
            </div>
        </div>

        <!-- Severity Levels -->
        <div class="card">
            <h2 class="card-title">ระดับความรุนแรง</h2>
            <div class="progress-grid">
                <div class="progress-item">
                    <div class="progress-circle" style="background: linear-gradient(to top, #e2e8f0 82%, #ef4444 82%);">
                        18%
                    </div>
                    <div class="progress-label">ฉุกเฉิน</div>
                    <div class="progress-count">224</div>
                </div>
                <div class="progress-item">
                    <div class="progress-circle" style="background: linear-gradient(to top, #e2e8f0 72%, #f59e0b 72%);">
                        28%
                    </div>
                    <div class="progress-label">รุนแรง</div>
                    <div class="progress-count">349</div>
                </div>
                <div class="progress-item">
                    <div class="progress-circle" style="background: linear-gradient(to top, #e2e8f0 65%, #eab308 65%);">
                        35%
                    </div>
                    <div class="progress-label">ปานกลาง</div>
                    <div class="progress-count">436</div>
                </div>
                <div class="progress-item">
                    <div class="progress-circle" style="background: linear-gradient(to top, #e2e8f0 81%, #10b981 81%);">
                        19%
                    </div>
                    <div class="progress-label">ทั่วไป</div>
                    <div class="progress-count">238</div>
                </div>
            </div>
        </div>

        <!-- Officer Status -->
        <div class="card">
            <h2 class="card-title">สถานะเจ้าหน้าที่ภาคสนาม</h2>
            <div class="officer-item">
                <div class="status-dot dot-available"></div>
                <div class="officer-info">
                    <span class="officer-name">นาย A (สนาม-01)</span>
                    <span class="officer-details">หน่วย: กู้ภัย A | ประเภท: ปฐมพยาบาล</span>
                </div>
            </div>
            <div class="officer-item">
                <div class="status-dot dot-available"></div>
                <div class="officer-info">
                    <span class="officer-name">นาย B (สนาม-02)</span>
                    <span class="officer-details">หน่วย: ช่างเทคนิค | ประเภท: ยานยนต์</span>
                </div>
            </div>
            <div class="officer-item">
                <div class="status-dot dot-busy"></div>
                <div class="officer-info">
                    <span class="officer-name">นาย C (สนาม-03)</span>
                    <span class="officer-details">หน่วย: กู้ภัย A | ประเภท: อุปกรณ์ตัดถ่าง</span>
                </div>
            </div>
            <div class="officer-item">
                <div class="status-dot dot-traveling"></div>
                <div class="officer-info">
                    <span class="officer-name">นาย D (สนาม-04)</span>
                    <span class="officer-details">หน่วย: กู้ภัย B | ประเภท: ปฐมพยาบาล</span>
                </div>
            </div>
        </div>

        <!-- Top Performers -->
        <!-- <div class="card">
            <h2 class="card-title">เจ้าหน้าที่ยอดเยี่ยม</h2>
            <table>
                <thead>
                    <tr>
                        <th>อันดับ</th>
                        <th>ชื่อ</th>
                        <th>เคส</th>
                        <th>คะแนน</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td><span class="rank">🥇</span></td>
                        <td><strong>นาย A</strong></td>
                        <td>127</td>
                        <td>⭐ 5.0</td>
                    </tr>
                    <tr>
                        <td><span class="rank">🥈</span></td>
                        <td><strong>นาย B</strong></td>
                        <td>118</td>
                        <td>⭐ 4.9</td>
                    </tr>
                    <tr>
                        <td><span class="rank">🥉</span></td>
                        <td><strong>นาย C</strong></td>
                        <td>115</td>
                        <td>⭐ 4.9</td>
                    </tr>
                    <tr>
                        <td>4</td>
                        <td><strong>นาย D</strong></td>
                        <td>109</td>
                        <td>⭐ 4.8</td>
                    </tr>
                    <tr>
                        <td>5</td>
                        <td><strong>นาง E</strong></td>
                        <td>106</td>
                        <td>⭐ 4.8</td>
                    </tr>
                </tbody>
            </table>
        </div> -->
    </div>

    <!-- Response Time Performance -->
    <div class="content-grid">
        <div class="card">
            <h2 class="card-title">ประสิทธิภาพเวลาตอบสนอง</h2>
            <p style="color: #64748b; font-size: 13px; margin-bottom: 20px;">เวลาเฉลี่ยตามระดับความรุนแรง</p>
            <div class="chart-bar">
                <div class="chart-label">
                    <span class="chart-label-name">ฉุกเฉิน (0-5 นาที)</span>
                    <span class="chart-label-value">4.2 นาที</span>
                </div>
                <div class="bar-track">
                    <div class="bar-fill" style="width: 86%; background: linear-gradient(90deg, #10b981, #059669);"></div>
                </div>
                <div style="text-align: right; font-size: 12px; color: #10b981; font-weight: 600; margin-top: 4px;">86% ตรงเวลา</div>
            </div>
            <div class="chart-bar">
                <div class="chart-label">
                    <span class="chart-label-name">รุนแรง (0-10 นาที)</span>
                    <span class="chart-label-value">7.8 นาที</span>
                </div>
                <div class="bar-track">
                    <div class="bar-fill" style="width: 78%; background: linear-gradient(90deg, #10b981, #059669);"></div>
                </div>
                <div style="text-align: right; font-size: 12px; color: #10b981; font-weight: 600; margin-top: 4px;">78% ตรงเวลา</div>
            </div>
            <div class="chart-bar">
                <div class="chart-label">
                    <span class="chart-label-name">ปานกลาง (0-15 นาที)</span>
                    <span class="chart-label-value">12.6 นาที</span>
                </div>
                <div class="bar-track">
                    <div class="bar-fill" style="width: 84%; background: linear-gradient(90deg, #10b981, #059669);"></div>
                </div>
                <div style="text-align: right; font-size: 12px; color: #10b981; font-weight: 600; margin-top: 4px;">84% ตรงเวลา</div>
            </div>
            <div class="chart-bar">
                <div class="chart-label">
                    <span class="chart-label-name">ทั่วไป (0-30 นาที)</span>
                    <span class="chart-label-value">18.4 นาที</span>
                </div>
                <div class="bar-track">
                    <div class="bar-fill" style="width: 90%; background: linear-gradient(90deg, #10b981, #059669);"></div>
                </div>
                <div style="text-align: right; font-size: 12px; color: #10b981; font-weight: 600; margin-top: 4px;">90% ตรงเวลา</div>
            </div>
        </div>

        <!-- User Satisfaction -->
        <div class="card">
            <h2 class="card-title">การวิเคราะห์ความพึงพอใจ</h2>
            <p style="color: #64748b; font-size: 13px; margin-bottom: 20px;">การแจกแจงคะแนนผู้ใช้</p>
            <div class="chart-bar">
                <div class="chart-label">
                    <span class="chart-label-name">⭐⭐⭐⭐⭐ (5 ดาว)</span>
                    <span class="chart-label-value">804</span>
                </div>
                <div class="bar-track">
                    <div class="bar-fill" style="width: 68%; background: linear-gradient(90deg, #10b981, #059669);"></div>
                </div>
                <div style="text-align: right; font-size: 12px; color: #10b981; font-weight: 600; margin-top: 4px;">68%</div>
            </div>
            <div class="chart-bar">
                <div class="chart-label">
                    <span class="chart-label-name">⭐⭐⭐⭐ (4 ดาว)</span>
                    <span class="chart-label-value">248</span>
                </div>
                <div class="bar-track">
                    <div class="bar-fill" style="width: 21%; background: linear-gradient(90deg, #3b82f6, #2563eb);"></div>
                </div>
                <div style="text-align: right; font-size: 12px; color: #3b82f6; font-weight: 600; margin-top: 4px;">21%</div>
            </div>
            <div class="chart-bar">
                <div class="chart-label">
                    <span class="chart-label-name">⭐⭐⭐ (3 ดาว)</span>
                    <span class="chart-label-value">83</span>
                </div>
                <div class="bar-track">
                    <div class="bar-fill" style="width: 7%; background: linear-gradient(90deg, #f59e0b, #d97706);"></div>
                </div>
                <div style="text-align: right; font-size: 12px; color: #f59e0b; font-weight: 600; margin-top: 4px;">7%</div>
            </div>
            <div class="chart-bar">
                <div class="chart-label">
                    <span class="chart-label-name">⭐⭐ (2 ดาว)</span>
                    <span class="chart-label-value">35</span>
                </div>
                <div class="bar-track">
                    <div class="bar-fill" style="width: 3%; background: linear-gradient(90deg, #f97316, #ea580c);"></div>
                </div>
                <div style="text-align: right; font-size: 12px; color: #f97316; font-weight: 600; margin-top: 4px;">3%</div>
            </div>
            <div class="chart-bar">
                <div class="chart-label">
                    <span class="chart-label-name">⭐ (1 ดาว)</span>
                    <span class="chart-label-value">12</span>
                </div>
                <div class="bar-track">
                    <div class="bar-fill" style="width: 1%; background: linear-gradient(90deg, #ef4444, #dc2626);"></div>
                </div>
                <div style="text-align: right; font-size: 12px; color: #ef4444; font-weight: 600; margin-top: 4px;">1%</div>
            </div>
        </div>
    </div>

    <!-- Top Performers Table -->
    <div class="content-grid">
        <div class="card">
            <h2 class="card-title">เจ้าหน้าที่ภาคสนามยอดเยี่ยม</h2>
            <p style="color: #64748b; font-size: 13px; margin-bottom: 20px;">จัดอันดับตามอัตราความสำเร็จและคะแนน</p>
            <table>
                <thead>
                    <tr>
                        <th>อันดับ</th>
                        <th>ชื่อ</th>
                        <th>เสร็จสิ้น</th>
                        <th>คะแนน</th>
                        <th>เวลาเฉลี่ย</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td><span class="rank">🥇</span></td>
                        <td><strong>นาย อเล็กซ์</strong></td>
                        <td>127</td>
                        <td>⭐ 5.0</td>
                        <td>9.2 นาที</td>
                    </tr>
                    <tr>
                        <td><span class="rank">🥈</span></td>
                        <td><strong>นาง เอมิลี่</strong></td>
                        <td>118</td>
                        <td>⭐ 4.9</td>
                        <td>10.5 นาที</td>
                    </tr>
                    <tr>
                        <td><span class="rank">🥉</span></td>
                        <td><strong>นาย เดวิด</strong></td>
                        <td>115</td>
                        <td>⭐ 4.9</td>
                        <td>11.1 นาที</td>
                    </tr>
                    <tr>
                        <td>4</td>
                        <td><strong>นาง เจสสิก้า</strong></td>
                        <td>109</td>
                        <td>⭐ 4.8</td>
                        <td>10.8 นาที</td>
                    </tr>
                    <tr>
                        <td>5</td>
                        <td><strong>นาย ไมค์</strong></td>
                        <td>106</td>
                        <td>⭐ 4.8</td>
                        <td>12.3 นาที</td>
                    </tr>
                    <tr>
                        <td>6</td>
                        <td><strong>นาย คริส</strong></td>
                        <td>102</td>
                        <td>⭐ 4.8</td>
                        <td>11.9 นาที</td>
                    </tr>
                    <tr>
                        <td>7</td>
                        <td><strong>นาง ลิซ่า</strong></td>
                        <td>98</td>
                        <td>⭐ 4.9</td>
                        <td>10.2 นาที</td>
                    </tr>
                </tbody>
            </table>
        </div>

        <!-- Base Officer Performance -->
        <div class="card">
            <h2 class="card-title">ประสิทธิภาพเจ้าหน้าที่ฐาน</h2>
            <p style="color: #64748b; font-size: 13px; margin-bottom: 20px;">ตัวชี้วัดประสิทธิภาพการมอบหมาย</p>
            <table>
                <thead>
                    <tr>
                        <th>เจ้าหน้าที่</th>
                        <th>มอบหมาย</th>
                        <th>เวลาเฉลี่ย</th>
                        <th>อัตราสำเร็จ</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td><strong>คุณสาราห์</strong></td>
                        <td>342</td>
                        <td>2.1 นาที</td>
                        <td><span class="status-badge" style="background: #d1fae5; color: #065f46;">97.2%</span></td>
                    </tr>
                    <tr>
                        <td><strong>คุณเจมส์</strong></td>
                        <td>318</td>
                        <td>2.4 นาที</td>
                        <td><span class="status-badge" style="background: #d1fae5; color: #065f46;">96.8%</span></td>
                    </tr>
                    <tr>
                        <td><strong>คุณมาเรีย</strong></td>
                        <td>287</td>
                        <td>2.6 นาที</td>
                        <td><span class="status-badge" style="background: #d1fae5; color: #065f46;">95.9%</span></td>
                    </tr>
                    <tr>
                        <td><strong>คุณโรเบิร์ต</strong></td>
                        <td>265</td>
                        <td>2.3 นาที</td>
                        <td><span class="status-badge" style="background: #d1fae5; color: #065f46;">96.2%</span></td>
                    </tr>
                    <tr>
                        <td><strong>คุณลินดา</strong></td>
                        <td>243</td>
                        <td>2.8 นาที</td>
                        <td><span class="status-badge" style="background: #fef3c7; color: #92400e;">94.7%</span></td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>

    <!-- Comprehensive Analysis Table -->
    <div class="card card-full">
        <h2 class="card-title">การวิเคราะห์คำขอโดยละเอียด</h2>
        <p style="color: #64748b; font-size: 13px; margin-bottom: 20px;">รายละเอียดคำขอทั้งหมดใน 30 วันที่ผ่านมา</p>
        <div style="overflow-x: auto;">
            <table>
                <thead>
                    <tr>
                        <th>ตัวชี้วัด</th>
                        <th>ฉุกเฉิน</th>
                        <th>รุนแรง</th>
                        <th>ปานกลาง</th>
                        <th>ทั่วไป</th>
                        <th>รวม</th>
                        <th>เปอร์เซ็นต์</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td><strong>คำขอทั้งหมด</strong></td>
                        <td>224</td>
                        <td>349</td>
                        <td>436</td>
                        <td>238</td>
                        <td><strong>1,247</strong></td>
                        <td>100%</td>
                    </tr>
                    <tr>
                        <td><strong>เสร็จสิ้น</strong></td>
                        <td>218</td>
                        <td>336</td>
                        <td>412</td>
                        <td>216</td>
                        <td><strong>1,182</strong></td>
                        <td><span class="status-badge" style="background: #d1fae5; color: #065f46;">94.8%</span></td>
                    </tr>
                    <tr>
                        <td><strong>กำลังดำเนินการ</strong></td>
                        <td>4</td>
                        <td>8</td>
                        <td>12</td>
                        <td>8</td>
                        <td><strong>32</strong></td>
                        <td><span class="status-badge" style="background: #dbeafe; color: #1e40af;">2.6%</span></td>
                    </tr>
                    <tr>
                        <td><strong>ยกเลิก</strong></td>
                        <td>2</td>
                        <td>5</td>
                        <td>12</td>
                        <td>14</td>
                        <td><strong>33</strong></td>
                        <td><span class="status-badge" style="background: #fef3c7; color: #92400e;">2.6%</span></td>
                    </tr>
                    <tr>
                        <td><strong>เวลาตอบสนองเฉลี่ย</strong></td>
                        <td>4.2 นาที</td>
                        <td>7.8 นาที</td>
                        <td>12.6 นาที</td>
                        <td>18.4 นาที</td>
                        <td><strong>11.7 นาที</strong></td>
                        <td>-</td>
                    </tr>
                    <tr>
                        <td><strong>เวลาเสร็จสิ้นเฉลี่ย</strong></td>
                        <td>34.5 นาที</td>
                        <td>42.8 นาที</td>
                        <td>51.3 นาที</td>
                        <td>38.9 นาที</td>
                        <td><strong>43.2 นาที</strong></td>
                        <td>-</td>
                    </tr>
                    <tr>
                        <td><strong>คะแนนเฉลี่ย</strong></td>
                        <td>4.8</td>
                        <td>4.7</td>
                        <td>4.6</td>
                        <td>4.8</td>
                        <td><strong>4.7</strong></td>
                        <td>-</td>
                    </tr>
                    <tr>
                        <td><strong>คะแนน 5 ดาว</strong></td>
                        <td>156</td>
                        <td>218</td>
                        <td>268</td>
                        <td>162</td>
                        <td><strong>804</strong></td>
                        <td><span class="status-badge" style="background: #d1fae5; color: #065f46;">68%</span></td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>

    <!-- Activity Heatmap -->
    <div class="card card-full">
            <h2 class="card-title">Weekly Activity Pattern</h2>
            <div class="heatmap">
                <div></div>
                <div class="heatmap-header">Mon</div>
                <div class="heatmap-header">Tue</div>
                <div class="heatmap-header">Wed</div>
                <div class="heatmap-header">Thu</div>
                <div class="heatmap-header">Fri</div>
                <div class="heatmap-header">Sat</div>
                <div class="heatmap-header">Sun</div>

                <div class="heatmap-label">00-04</div>
                <div class="heatmap-cell" style="background: #d1fae5; color: #065f46;">12</div>
                <div class="heatmap-cell" style="background: #d1fae5; color: #065f46;">8</div>
                <div class="heatmap-cell" style="background: #d1fae5; color: #065f46;">11</div>
                <div class="heatmap-cell" style="background: #d1fae5; color: #065f46;">9</div>
                <div class="heatmap-cell" style="background: #d1fae5; color: #065f46;">15</div>
                <div class="heatmap-cell" style="background: #a7f3d0; color: #065f46;">18</div>
                <div class="heatmap-cell" style="background: #a7f3d0; color: #065f46;">22</div>

                <div class="heatmap-label">04-08</div>
                <div class="heatmap-cell" style="background: #a7f3d0; color: #065f46;">24</div>
                <div class="heatmap-cell" style="background: #a7f3d0; color: #065f46;">21</div>
                <div class="heatmap-cell" style="background: #a7f3d0; color: #065f46;">26</div>
                <div class="heatmap-cell" style="background: #a7f3d0; color: #065f46;">23</div>
                <div class="heatmap-cell" style="background: #6ee7b7; color: #065f46;">31</div>
                <div class="heatmap-cell" style="background: #6ee7b7; color: #065f46;">34</div>
                <div class="heatmap-cell" style="background: #6ee7b7; color: #065f46;">29</div>

                <div class="heatmap-label">08-12</div>
                <div class="heatmap-cell" style="background: #6ee7b7; color: #065f46;">42</div>
                <div class="heatmap-cell" style="background: #6ee7b7; color: #065f46;">45</div>
                <div class="heatmap-cell" style="background: #6ee7b7; color: #065f46;">48</div>
                <div class="heatmap-cell" style="background: #34d399; color: white;">52</div>
                <div class="heatmap-cell" style="background: #34d399; color: white;">51</div>
                <div class="heatmap-cell" style="background: #10b981; color: white;">58</div>
                <div class="heatmap-cell" style="background: #10b981; color: white;">55</div>

                <div class="heatmap-label">12-16</div>
                <div class="heatmap-cell" style="background: #10b981; color: white;">62</div>
                <div class="heatmap-cell" style="background: #059669; color: white;">68</div>
                <div class="heatmap-cell" style="background: #059669; color: white;">71</div>
                <div class="heatmap-cell" style="background: #047857; color: white;">74</div>
                <div class="heatmap-cell" style="background: #047857; color: white;">79</div>
                <div class="heatmap-cell" style="background: #065f46; color: white;">82</div>
                <div class="heatmap-cell" style="background: #059669; color: white;">65</div>

                <div class="heatmap-label">16-20</div>
                <div class="heatmap-cell" style="background: #047857; color: white;">86</div>
                <div class="heatmap-cell" style="background: #047857; color: white;">89</div>
                <div class="heatmap-cell" style="background: #065f46; color: white;">94</div>
                <div class="heatmap-cell" style="background: #065f46; color: white;">91</div>
                <div class="heatmap-cell" style="background: #064e3b; color: white;">98</div>
                <div class="heatmap-cell" style="background: #064e3b; color: white;">102</div>
                <div class="heatmap-cell" style="background: #047857; color: white;">88</div>

                <div class="heatmap-label">20-24</div>
                <div class="heatmap-cell" style="background: #34d399; color: white;">54</div>
                <div class="heatmap-cell" style="background: #34d399; color: white;">51</div>
                <div class="heatmap-cell" style="background: #6ee7b7; color: #065f46;">47</div>
                <div class="heatmap-cell" style="background: #6ee7b7; color: #065f46;">49</div>
                <div class="heatmap-cell" style="background: #10b981; color: white;">59</div>
                <div class="heatmap-cell" style="background: #059669; color: white;">67</div>
                <div class="heatmap-cell" style="background: #34d399; color: white;">53</div>
            </div>
        </div>

    <!-- Summary -->
    <!-- <div class="summary">
        <h2>📈 สรุปสำคัญ</h2>
        <p><strong>ประสิทธิภาพ:</strong> ระบบประมวลผลคำขอ 1,247 รายการ มีอัตราการเสร็จสิ้น 94.8% และเวลาตอบสนองเฉลี่ย 11.7 นาที ดีขึ้น 22% จากเดือนที่แล้ว</p>
        <p><strong>ความพึงพอใจ:</strong> คะแนนความพึงพอใจของลูกค้าอยู่ที่ 4.7/5.0 โดยมีผู้ใช้ 68% ให้คะแนน 5 ดาว</p>
        <p><strong>ช่วงเวลาที่มีความเคลื่อนไหวสูง:</strong> กิจกรรมสูงสุดเกิดในช่วงเย็น (16:00-20:00) ในวันธรรมดา โดยเฉพาะวันศุกร์และวันเสาร์</p>
        <p><strong>พื้นที่หลัก:</strong> ย่านใจกลางเมืองและเขตเหนือคิดเป็น 50% ของคำขอทั้งหมด โดยอุบัติเหตุรถยนต์เป็นประเภทที่พบมากที่สุดที่ 32%</p>
    </div> -->
</main>

@endsection
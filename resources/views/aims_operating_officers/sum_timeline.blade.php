@extends('layouts.theme_aims')

@section('content')
<div class="container mx-auto my-5">
    <style>
        :root {
            --primary-color: #0D6EFD;
            /* A slightly softer blue */
            --background-color: #F8F9FA;
            --card-background-color: #FFFFFF;
            --text-color: #212529;
            --label-color: #6C757D;
            --border-color: #E9ECEF;
            --pill-time-bg: #F0F5FD;
            --pill-time-text: #0D6EFD;
            --pill-distance-bg: #FFF4E5;
            --pill-distance-text: #E75800;
        }



        .main-container {
            width: 100%;
            max-width: 750px;
            margin: 0 auto;
        }

        .timeline {
            position: relative;
            padding: 0;
            list-style: none;
        }

        .timeline::before {
            content: '';
            position: absolute;
            top: 0;
            left: 20px;
            /* Center of the icon (40px width) */
            bottom: 0;
            width: 3px;
            background: var(--border-color);
            border-radius: 1.5px;
        }

        .timeline-item {
            position: relative;
            margin-bottom: 1.5rem;
            padding-left: 65px;
            /* Icon width + gap */
        }

        .timeline-item:last-of-type {
            margin-bottom: 0;
        }

        .timeline-icon {
            position: absolute;
            left: 0;
            top: 13px;
            width: 40px;
            height: 40px;
            border-radius: 50%;
            background-color: var(--primary-color);
            color: white;
            display: flex;
            align-items: center;
            justify-content: center;
            z-index: 1;
        }

        .timeline-icon svg {
            width: 22px;
            height: 22px;
        }

        .timeline-content {
            background-color: var(--card-background-color);
            padding: 1rem 1.5rem;
            border-radius: 12px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.05);
            border: 1px solid var(--border-color);
        }



        .timeline-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            flex-wrap: wrap;
        }

        .timeline-item:not(:first-child) .timeline-content .timeline-header {
            margin-bottom: 0.75rem;
            border-bottom: 1px #DEE2E6 dashed;
            padding-bottom: 0.75rem;


        }

        .timeline-title {
            font-size: 1.1rem;
            font-weight: 600;
            margin: 0;
        }

        .timeline-time {
            font-size: 1rem;
            font-weight: 500;
            color: var(--label-color);
            flex-shrink: 0;
            padding: 4px 12px;
            background-color: #F8F9FA;
            border-radius: 5px;
        }

        .timeline-details {
            display: flex;
            flex-direction: column;
            gap: 0.75rem;
        }

        .detail-item {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .detail-label {
            display: flex;
            align-items: center;
            gap: 0.5rem;
            color: var(--label-color);
            font-size: 0.95rem;
        }

        .detail-label svg {
            width: 16px;
            height: 16px;
        }

        .data-pill {
            font-size: 0.9rem;
            font-weight: 500;
            padding: 0.25rem 0.75rem;
            border-radius: 5px;
            white-space: nowrap;
        }

        .pill-time {
            background-color: var(--pill-time-bg);
            color: var(--pill-time-text);
        }

        .pill-distance {
            background-color: var(--pill-distance-bg);
            color: var(--pill-distance-text);
        }

        /* Summary Card */
        .summary-card {
            background-color: var(--pill-time-bg);
            padding: 1.5rem;
            border-radius: 16px;
            margin-top: 2.5rem;
            border: 1px solid #4A90E2;
        }

        .summary-title {
            font-size: 1.1rem;
            font-weight: 600;
            margin-top: 0;
            margin-bottom: 1.5rem;
            color: #5892E5;
        }

        .summary-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 1rem;
        }

        .summary-item {
            background-color: #fff;
            padding: 15px 10px;
            border-radius: 5px;
        }

        .summary-item .value {
            font-size: 1.5rem;
            font-weight: 600;
            color: var(--text-color);
            line-height: 1.2;
        }

        .summary-item .label {
            font-size: 1rem;
            color: var(--text-color);
            margin-top: 0.1rem;
        }

        .summary-item .sub-label {
            font-size: 0.85rem;
            color: var(--label-color);
        }

        /* Responsive */
        @media (max-width: 768px) {
            .main-container {
                padding: 0;
            }

            .timeline-content {
                padding: 1rem;
            }

            .summary-grid {
                grid-template-columns: 1fr;
                gap: 1.5rem;
            }

            .timeline-item {
                padding-left: 55px;
            }

            .timeline::before {
                left: 17px;
            }

            .timeline-icon {
                width: 34px;
                height: 34px;
            }

            .timeline-icon svg {
                width: 18px;
                height: 18px;
            }
        }

        @media (max-width: 1393px) {
            .summary-grid {
                grid-template-columns: 1fr;
                gap: 1.5rem;
            }

            .timeline-item {
                padding-left: 55px;
            }

            .timeline::before {
                left: 17px;
            }

            .timeline-icon {
                width: 34px;
                height: 34px;
            }

            .timeline-icon svg {
                width: 18px;
                height: 18px;
            }
        }
    </style>

    <div class="mx-3">

        <ul class="timeline">

        <!-- 1. รับแจ้งเหตุ -->
        @if(!empty($emergency->op_time_create_sos))
            <li class="timeline-item">
                <div class="timeline-icon"><i class="fa-regular fa-phone"></i></div>
                <div class="timeline-content">
                    <div class="timeline-header">
                        <h2 class="timeline-title">1. รับแจ้งเหตุ</h2>
                        <span class="timeline-time">{{ \Carbon\Carbon::parse($emergency->op_time_create_sos)->format('H:i น.') }}</span>
                    </div>
                </div>
            </li>
        @endif

        <!-- 2. สั่งการ -->
        @if(!empty($emergency->op_time_command))
            <li class="timeline-item">
                <div class="timeline-icon"><i class="fa-regular fa-paper-plane-top fa-rotate-by" style="--fa-rotate-angle: 312deg;"></i></div>
                <div class="timeline-content">
                    <div class="timeline-header">
                        <h2 class="timeline-title">2. สั่งการ</h2>
                        <span class="timeline-time">{{ \Carbon\Carbon::parse($emergency->op_time_command)->format('H:i น.') }}</span>
                    </div>
                    @if(!empty($emergency->op_time_create_sos))
                    <div class="timeline-details">
                        <div class="detail-item">
                            <span class="detail-label"><i class="fa-regular fa-clock"></i>ใช้เวลา</span>
                            <span class="data-pill pill-time">{{ \Carbon\Carbon::parse($emergency->op_time_command)->locale('th')->diffForHumans(\Carbon\Carbon::parse($emergency->op_time_create_sos), true) }}</span>
                        </div>
                    </div>
                    @endif
                </div>
            </li>
        @endif

        <!-- 3. ออกจากฐาน -->
        @if(!empty($emergency->op_time_go_to_help))
            <li class="timeline-item">
                <div class="timeline-icon"><i class="fa-regular fa-truck-medical"></i></div>
                <div class="timeline-content">
                    <div class="timeline-header">
                        <h2 class="timeline-title">3. ออกจากฐาน</h2>
                        <span class="timeline-time">{{ \Carbon\Carbon::parse($emergency->op_time_go_to_help)->format('H:i น.') }}</span>
                    </div>
                    <div class="timeline-details">
                        <!-- คำนวณเวลา -->
                        @if(!empty($emergency->op_time_command))
                        <div class="detail-item">
                            <span class="detail-label"><i class="fa-regular fa-clock"></i>ใช้เวลา</span>
                             <span class="data-pill pill-time">{{ \Carbon\Carbon::parse($emergency->op_time_go_to_help)->locale('th')->diffForHumans(\Carbon\Carbon::parse($emergency->op_time_command), true) }}</span>
                        </div>
                        @endif
                        <!-- แสดงเลขกิโลเมตร -->
                        @if(!empty($emergency->op_km_before))
                        <div class="detail-item">
                            <span class="detail-label"><i class="fa-regular fa-location-dot"></i>เลขกิโลเมตร</span>
                            <div>
                                <span class="data-pill pill-time">{{ number_format($emergency->op_km_before) }}</span>
                            </div>
                        </div>
                        @endif
                    </div>
                </div>
            </li>
        @endif

        <!-- 4. ถึงที่เกิดเหตุ -->
        @if(!empty($emergency->op_time_to_the_scene))
            <li class="timeline-item">
                <div class="timeline-icon"><i class="fa-regular fa-location-dot"></i></div>
                <div class="timeline-content">
                    <div class="timeline-header">
                        <h2 class="timeline-title">4. ถึงที่เกิดเหตุ</h2>
                        <span class="timeline-time">{{ \Carbon\Carbon::parse($emergency->op_time_to_the_scene)->format('H:i น.') }}</span>
                    </div>
                    <div class="timeline-details">
                        <!-- คำนวณเวลา -->
                        @if(!empty($emergency->op_time_go_to_help))
                            <div class="detail-item">
                                <span class="detail-label"><i class="fa-regular fa-clock"></i>ใช้เวลา</span>
                                <span class="data-pill pill-time">{{ \Carbon\Carbon::parse($emergency->op_time_to_the_scene)->locale('th')->diffForHumans(\Carbon\Carbon::parse($emergency->op_time_go_to_help), true) }}</span>
                            </div>
                        @endif
                        <!-- แสดงเลขกิโลเมตร และคำนวณผลรวม -->
                        @if(!empty($emergency->op_km_to_the_scene) && !empty($emergency->op_km_before))
                            <div class="detail-item">
                                <span class="detail-label"><i class="fa-regular fa-location-dot"></i>เลขกิโลเมตร</span>
                                <div>
                                    <span class="data-pill pill-time">{{ number_format($emergency->op_km_to_the_scene) }}</span>
                                    <span class="data-pill pill-distance">รวม {{ number_format($emergency->op_km_to_the_scene - $emergency->op_km_before) }} กม.</span>
                                </div>
                            </div>
                        @endif
                    </div>
                </div>
            </li>
        @endif

        <!-- 5. ออกจากที่เกิดเหตุ -->
        @if(!empty($emergency->op_time_leave_the_scene))
            <li class="timeline-item">
                <div class="timeline-icon"><i class="fa-regular fa-arrow-turn-left"></i></div>
                <div class="timeline-content">
                    <div class="timeline-header">
                        <h2 class="timeline-title">5. ออกจากที่เกิดเหตุ</h2>
                        <span class="timeline-time">{{ \Carbon\Carbon::parse($emergency->op_time_leave_the_scene)->format('H:i น.') }}</span>
                    </div>
                     @if(!empty($emergency->op_time_to_the_scene))
                    <div class="timeline-details">
                        <div class="detail-item">
                            <span class="detail-label"><i class="fa-regular fa-clock"></i>ใช้เวลา</span>
                             <span class="data-pill pill-time">{{ \Carbon\Carbon::parse($emergency->op_time_leave_the_scene)->locale('th')->diffForHumans(\Carbon\Carbon::parse($emergency->op_time_to_the_scene), true) }}</span>
                        </div>
                    </div>
                    @endif
                </div>
            </li>
        @endif

        <!-- 6. ถึงโรงพยาบาล (ถ้ามี) -->
        @if(!empty($emergency->op_time_hospital))
            <li class="timeline-item">
                <div class="timeline-icon"><i class="fa-regular fa-hospital"></i></div>
                <div class="timeline-content">
                    <div class="timeline-header">
                        <h2 class="timeline-title">6. ถึงโรงพยาบาล</h2>
                        <span class="timeline-time">{{ \Carbon\Carbon::parse($emergency->op_time_hospital)->format('H:i น.') }}</span>
                    </div>
                    <div class="timeline-details">
                         @if(!empty($emergency->op_time_leave_the_scene))
                            <div class="detail-item">
                                <span class="detail-label"><i class="fa-regular fa-clock"></i>ใช้เวลา</span>
                                <span class="data-pill pill-time">{{ \Carbon\Carbon::parse($emergency->op_time_hospital)->locale('th')->diffForHumans(\Carbon\Carbon::parse($emergency->op_time_leave_the_scene), true) }}</span>
                            </div>
                        @endif
                        @if(!empty($emergency->op_km_hospital) && !empty($emergency->op_km_to_the_scene))
                            <div class="detail-item">
                                <span class="detail-label"><i class="fa-regular fa-location-dot"></i>เลขกิโลเมตร</span>
                                <div>
                                    <span class="data-pill pill-time">{{ number_format($emergency->op_km_hospital) }}</span>
                                    <span class="data-pill pill-distance">รวม {{ number_format($emergency->op_km_hospital - $emergency->op_km_to_the_scene) }} กม.</span>
                                </div>
                            </div>
                        @endif
                    </div>
                </div>
            </li>
        @endif

        <!-- 7. ถึงฐาน (เสร็จสิ้น) -->
        @if(!empty($emergency->op_time_to_the_operating_base))
            <li class="timeline-item">
                <div class="timeline-icon">
                    <svg width="15" height="15" viewBox="0 0 15 15" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M5.0625 9.125L1 5.0625M1 5.0625L5.0625 1M1 5.0625H9.53125C10.1181 5.0625 10.6992 5.17809 11.2414 5.40266C11.7835 5.62724 12.2762 5.9564 12.6911 6.37137C13.1061 6.78633 13.4353 7.27896 13.6598 7.82113C13.8844 8.36331 14 8.94441 14 9.53125C14 10.1181 13.8844 10.6992 13.6598 11.2414C13.4353 11.7835 13.1061 12.2762 12.6911 12.6911C12.2762 13.1061 11.7835 13.4353 11.2414 13.6598C10.6992 13.8844 10.1181 14 9.53125 14H6.6875" stroke="white" stroke-linecap="round" stroke-linejoin="round" />
                    </svg>
                </div>
                <div class="timeline-content">
                    <div class="timeline-header">
                        <h2 class="timeline-title">7. ถึงฐาน</h2>
                        <span class="timeline-time">{{ \Carbon\Carbon::parse($emergency->op_time_to_the_operating_base)->format('H:i น.') }}</span>
                    </div>
                    <div class="timeline-details">
                        <!-- คำนวณเวลา -->
                        @php
                            // หาจุดเริ่มต้นของ chặng สุดท้าย
                            $last_departure_time = !empty($emergency->op_time_hospital) ? $emergency->op_time_hospital : $emergency->op_time_leave_the_scene;
                        @endphp
                        @if(!empty($last_departure_time))
                            <div class="detail-item">
                                <span class="detail-label"><i class="fa-regular fa-clock"></i>ใช้เวลาเดินทางกลับ</span>
                                <span class="data-pill pill-time">{{ \Carbon\Carbon::parse($emergency->op_time_to_the_operating_base)->locale('th')->diffForHumans(\Carbon\Carbon::parse($last_departure_time), true) }}</span>
                            </div>
                        @endif
                        <!-- แสดงเลขกิโลเมตร และคำนวณผลรวม -->
                        @if(!empty($emergency->op_km_operating_base))
                            @php
                                $last_km = !empty($emergency->op_km_hospital) ? $emergency->op_km_hospital : $emergency->op_km_to_the_scene;
                            @endphp
                            <div class="detail-item">
                                <span class="detail-label"><i class="fa-regular fa-location-dot"></i>เลขกิโลเมตร</span>
                                <div>
                                    <span class="data-pill pill-time">{{ number_format($emergency->op_km_operating_base) }}</span>
                                    @if(!empty($last_km))
                                    <span class="data-pill pill-distance">รวม {{ number_format($emergency->op_km_operating_base - $last_km) }} กม.</span>
                                    @endif
                                </div>
                            </div>
                        @endif
                    </div>
                </div>
            </li>
        @endif
    </ul>

    <style>
        .summary-item.bg-success-light {
            background-color: #e6ffed !important; /* สีเขียวอ่อน */
            border: 1px solid #b7e1c7;
        }
        .summary-item.bg-warning-light {
            background-color: #fff4e5 !important; /* สีเหลืองส้มอ่อน */
            border: 1px solid #ffdcb0;
        }
        .summary-item.bg-danger-light {
            background-color: #ffebee !important; /* สีแดงอ่อน */
            border: 1px solid #ffcdd2;
        }
    </style>

    <!-- แสดงส่วนสรุปภารกิจ ต่อเมื่อสถานะเป็น "เสร็จสิ้น" เท่านั้น -->
    @if($emergency->op_status == 'เสร็จสิ้น')
    <div class="summary-card">
        <h2 class="summary-title">สรุปภารกิจ</h2>
        <div class="summary-grid">
            @php
                $bgColorClass = '';
                if (!empty($emergency->op_time_sum_sos)) {
                    $minutes = intval($emergency->op_time_sum_sos);

                    // กำหนด class สีตามเงื่อนไข
                    if ($minutes > 0) {
                        if ($minutes <= 8) {
                            $bgColorClass = 'bg-success-light';
                        } elseif ($minutes <= 12) {
                            $bgColorClass = 'bg-warning-light';
                        } else {
                            $bgColorClass = 'bg-danger-light';
                        }
                    }
                }
            @endphp
            <div class="summary-item {{ $bgColorClass }}">
                <div class="label mb-2">เวลาในการช่วยเหลือ</div>
                <div class="value">{{ $emergency->op_time_sum_sos ?? '-' }}</div>
                <div class="sub-label">(ตั้งแต่ออกจากฐาน - เสร็จสิ้น)</div>
            </div>
            <div class="summary-item">
                <div class="label mb-2">เวลารวมทั้งหมด</div>
                <div class="value ">{{ $emergency->op_time_sum_to_base ?? '-' }}</div>
                <div class="sub-label">(ตั้งแต่ออกจากฐาน - กลับถึงฐาน)</div>
            </div>
            <div class="summary-item">
                <div class="label mb-2">ระยะทางทั้งหมด</div>
                <div class="value">{{ $emergency->op_km_sum ?? '-' }}</div>
                <div class="sub-label">(ออกจากฐาน - กลับถึงฐาน)</div>
            </div>
        </div>
    </div>
    @endif

    </div>
</div>
@endsection
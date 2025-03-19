@extends('layouts.partners.theme_partner_new')

<style>
    div.dataTables_wrapper div.dataTables_filter {
        display: none;
    }

    div.dataTables_filter {
        margin-top: 1rem;
    }

    button#advancedBtn {
        margin-top: 10px;
    }

    .col-1.mb-3 .btn {
        width: 50px;
        height: 100%;
    }

    #all_data_sos_1669_table_paginate ul.pagination {
        float: left !important;
    }

    .svg-loader {
        width: 2em;
        transform-origin: center;
        animation: rotate4 2s linear infinite;
    }

    .svg-loader circle {
        fill: none;
        stroke: #27a444;
        stroke-width: 4;
        stroke-dasharray: 1, 200;
        stroke-dashoffset: 0;
        stroke-linecap: round;
        animation: dash4 1.5s ease-in-out infinite;
    }

    @keyframes rotate4 {
        100% {
            transform: rotate(360deg);
        }
    }

    @keyframes dash4 {
        0% {
            stroke-dasharray: 1, 200;
            stroke-dashoffset: 0;
        }

        50% {
            stroke-dasharray: 90, 200;
            stroke-dashoffset: -35px;
        }

        100% {
            stroke-dashoffset: -125px;
        }
    }
</style>

@section('content')

<div class="card p-2">
    <div class="row">
        <div class="col-6">
            <h3 class="font-weight-bold float-start mb-0">
                ข้อมูลการขอความช่วยเหลือ
            </h3>
        </div>
    </div>

    <div id="" class="card-body">

        <!-- จบส่วนตัวกรอง -->
        <style>
            #all_data_sos_1669_table tr th {
                min-width: 200px;
            }
        </style>
        <div class="row mb-5">
            <div class="col-md-4">
                <label for="validationCustom01" class="form-label">เลือกปี</label>
                <select class="form-control" id="year" onchange="updateMonthOptions();change_get_data_sos()">
                    @foreach($data_sos as $item)
                    <option value="{{$item->year}}">{{$item->year}}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-8">
                <div class="d-flex">
                    <div class="w-100">
                        <label for="validationCustom01" class="form-label">เดือน</label>
                        <select class="form-control" id="month" onchange="change_get_data_sos()">
                            <option value="01">มกราคม</option>
                            <option value="02">กุมภาพันธ์</option>
                            <option value="03">มีนาคม</option>
                            <option value="04">เมษายน</option>
                            <option value="05">พฤษภาคม</option>
                            <option value="06">มิถุนายน</option>
                            <option value="07">กรกฎาคม</option>
                            <option value="08">สิงหาคม</option>
                            <option value="09">กันยายน</option>
                            <option value="10">ตุลาคม</option>
                            <option value="11">พฤศจิกายน</option>
                            <option value="12">ธันวาคม</option>
                        </select>
                    </div>
                    <span class="d-flex align-items-center mx-5">
                        <br>
                        ถึง
                    </span>
                    <div class="w-100">
                        <label for="validationCustom01" class="form-label">เดือน</label>
                        <select class="form-control" id="month2" onchange="change_get_data_sos('select_month_2')">
                            <!-- ตำแหน่งที่เลือกจาก select แรก และเดือนถัดไป 2 เดือน -->
                        </select>
                    </div>

                </div>

            </div>
            <div class="mt-2 d-none" id="loading_get_data_sos">
                <svg class="svg-loader" viewBox="25 25 50 50">
                    <circle r="20" cy="50" cx="50"></circle>
                </svg>
                <span>กำลังโหลดข้อมูล</span>
            </div>
        </div>

        <script>
            document.addEventListener("DOMContentLoaded", function() {
                // เรียกใช้งานเมื่อโหลดหน้าเว็บเสร็จสมบูรณ์
                let currentDate = new Date();
                let currentMonth = ('0' + (currentDate.getMonth() + 1)).slice(-2); // เดือนปัจจุบัน (ใส่ 0 ด้านหน้าหากเป็นเลขเดียว)
                let currentYear = currentDate.getFullYear(); // ปีปัจจุบัน
                select_year('first');
            });

            function select_year(param) {
                var selectElement = document.getElementById("year");

                // สร้างตัวแปรสำหรับเก็บค่าที่มากที่สุด
                var maxYear = 0;

                // วนลูปผ่านตัวเลือกทั้งหมดในรายการ select
                for (var i = 0; i < selectElement.options.length; i++) {
                    var optionValue = parseInt(selectElement.options[i].value);

                    // ตรวจสอบว่าค่าในตัวเลือกเป็นปีหรือไม่
                    if (!isNaN(optionValue)) {
                        // หาค่าที่มากที่สุด
                        if (optionValue > maxYear) {
                            maxYear = optionValue;
                        }
                    }
                }

                // พิมพ์ค่าที่มากที่สุดใน console
                document.getElementById("year").value = maxYear;
                updateMonthOptions(param);
                updateMonth2Options();
            }

            function updateMonthOptions(param) {

                let monthNames = [
                    "มกราคม",
                    "กุมภาพันธ์",
                    "มีนาคม",
                    "เมษายน",
                    "พฤษภาคม",
                    "มิถุนายน",
                    "กรกฎาคม",
                    "สิงหาคม",
                    "กันยายน",
                    "ตุลาคม",
                    "พฤศจิกายน",
                    "ธันวาคม"
                ];
                let monthSelect = document.getElementById("month");
                monthSelect.innerHTML = ""; // Clear existing options
                let Yearinput = parseInt(document.getElementById("year").value);
                let currentMonth = new Date().getMonth() + 1; // เดือนปัจจุบัน
                let lastMonthOfYear = (Yearinput === new Date().getFullYear()) ? currentMonth : 12; // เลือกเดือนสุดท้ายของปีปัจจุบัน หรือ 12 ถ้าเป็นปีอื่นๆ

                // เพิ่ม option เดือน 1 ถึงเดือนที่เลือกของปีปัจจุบัน
                for (let i = 1; i <= lastMonthOfYear; i++) {
                    let option = document.createElement("option");
                    option.text = monthNames[i - 1];
                    option.value = ('0' + i).slice(-2);
                    monthSelect.add(option);
                }

                if (param == 'first') {
                    let monthSelect = document.getElementById("month");
                    let currentMonthIndex = new Date().getMonth(); // เดือนปัจจุบัน (ลำดับ)
                    monthSelect.selectedIndex = currentMonthIndex;
                }
            }


            document.getElementById("month").addEventListener("change", updateMonth2Options);
            document.getElementById("year").addEventListener("change", updateMonth2Options);

            function updateMonth2Options() {
                let month1 = document.getElementById("month").value;
                let month2Select = document.getElementById("month2");
                month2Select.innerHTML = ""; // ล้าง options ใน select ที่ 2
                let nextMonths = getNextMonths(month1); // เรียกฟังก์ชันเพื่อรับเดือนที่เลือกและเดือนถัดไป 2 เดือน
                let currentYear = parseInt(document.getElementById("year").value);
                let currentMonth = new Date().getMonth() + 1; // เดือนปัจจุบัน

                nextMonths.forEach(function(month) {
                    // ตรวจสอบเงื่อนไขเพื่อตัดเดือนที่ยังไม่ถึง
                    if (currentYear === new Date().getFullYear() && parseInt(month.value) > currentMonth) {
                        return; // ไม่เพิ่มเดือนที่ยังไม่ถึงลงใน select ที่ 2
                    }
                    let option = document.createElement("option");
                    option.text = month.name;
                    option.value = month.value;
                    month2Select.add(option);
                });
            }


            function getNextMonths(month) {
                let currentYear = parseInt(document.getElementById("year").value);

                let months = [{
                        name: "มกราคม",
                        value: "01"
                    },
                    {
                        name: "กุมภาพันธ์",
                        value: "02"
                    },
                    {
                        name: "มีนาคม",
                        value: "03"
                    },
                    {
                        name: "เมษายน",
                        value: "04"
                    },
                    {
                        name: "พฤษภาคม",
                        value: "05"
                    },
                    {
                        name: "มิถุนายน",
                        value: "06"
                    },
                    {
                        name: "กรกฎาคม",
                        value: "07"
                    },
                    {
                        name: "สิงหาคม",
                        value: "08"
                    },
                    {
                        name: "กันยายน",
                        value: "09"
                    },
                    {
                        name: "ตุลาคม",
                        value: "10"
                    },
                    {
                        name: "พฤศจิกายน",
                        value: "11"
                    },
                    {
                        name: "ธันวาคม",
                        value: "12"
                    }
                ];

                let index = months.findIndex(function(item) {
                    return item.value === month;
                });

                let nextMonths = [];
                if (index !== -1) {
                    for (let i = 0; i < 3; i++) {
                        let nextIndex = (index + i) % months.length;
                        let nextMonth = months[nextIndex];
                        // console.log(month);
                        if (month === "11") {
                            if (i > 1) {
                                nextMonth.name += ' (' + (currentYear + 1) + ')';
                            } else {
                                nextMonth.name += ' (' + currentYear + ')';
                            }
                        } else if (month === "12") {
                            if (i < 1) {
                                nextMonth.name += ' (' + currentYear + ')';
                            } else {
                                nextMonth.name += ' (' + (currentYear + 1) + ')';
                            }
                        }


                        nextMonths.push(nextMonth);
                    }
                }

                return nextMonths;
            }






            function submitDate() {
                let month1 = document.getElementById("month").value;
                let month2 = document.getElementById("month2").value;
                let year = document.getElementById("year").value;
                alert("คุณเลือกเดือน " + month1 + " และ " + month2 + " ปี " + year);
                // คุณสามารถแทนที่ alert ด้วยการทำสิ่งที่คุณต้องการทำกับเดือนและปีที่ผู้ใช้เลือก
            }

            async function change_get_data_sos(param) {
                if (param != 'select_month_2') {
                    await updateMonth2Options();
                }
                await get_data_sos();
            }
        </script>
        <div class="table-responsive">
            <table id="all_data_sos_1669_table" class="table table-striped table-bordered align-middle">
                <thead>
                    <tr>
                        <th>รหัสเคส</th>
                        <th>สถานะ</th>
                        <th>หมายเหตุสถานะ</th>
                        <th>วันที่ / เวลา</th>
                        <th>Latitude</th>
                        <th>Longitude</th>
                        <th>สถานที่</th>
                        <th>รายละเอียดสถานที่</th>
                        <th>รับแจ้งเหตุทาง</th>
                        <th>ผู้ขอความช่วยเหลือ</th>
                        <th>เบอร์ติดต่อผู้ขอความช่วยเหลือ</th>
                        <th>สั่งการโดย</th>
                        <th>ชื่อหน่วยปฏบัติการ</th>
                        <th>เจ้าหน้าที่หน่วยปฏิบัติการ</th>
                        <th>ยานพาหนะ</th>
                        <th>ระดับเจ้าหน้าที่หน่วยปฏิบัติการ</th>
                        <th>อาการ</th>
                        <th>รายละเอียดอาการ</th>
                        <th>การให้รหัสความรุนแรง (IDC)</th>
                        <th>รหัสความรุนแรง ณ จุดเกิดเหตุ (RC)</th>
                        <th>รายละเอียดรหัสความรุนแรง ณ จุดเกิดเหตุ</th>
                        <th>รายละเอียดสถานที่เกิดเหตุจากเจ้าหน้าที่</th>
                        <th>เวลาสั่งการ</th>
                        <th>เวลาออกจากฐาน</th>
                        <th>เวลาถึงที่เกิดเหตุ</th>
                        <th>เวลาออกจากที่เกิดเหตุ</th>
                        <th>เวลาถึง รพ.</th>
                        <th>เวลากลับถึงฐาน</th>
                        <th>รวมเวลาในการช่วยเหลือ</th>

                        <th>เลข กม. ออกจากฐาน</th>
                        <th>เลข กม. ถึงที่เกิดเหตุ</th>
                        <th>เลข กม. ถึง รพ.</th>
                        <th>เลข กม. กลับถึงฐาน</th>
                        <th>รวมเลข กม.</th>

                        <th>การรักษา</th>
                        <th>รายละเอียดการรักษา</th>

                        <th>คะแนนความประทับใจ</th>
                        <th>คะแนนความรวดเร็ว</th>
                        <th>รวมคะแนนการช่วยเหลือ</th>
                        <th>ข้อความการประเมิน</th>

                        <th>หมายเหตุจากเจ้าหน้าที่</th>

                        <th>เคสนี้รับมาจาก</th>
                        <th>ส่งต่อเคสนี้ไปยัง</th>
                        <th>อุบัติเหตุร่วม/อุบัติเหตุหมู่</th>

                        <th>ชื่อ-สกุล (ผู้ป่วย 1)</th>
                        <th>อายุ (ผู้ป่วย 1)</th>
                        <th>HN (ผู้ป่วย 1)</th>
                        <th>เลขประจำตัวประชาชน (ผู้ป่วย 1)</th>
                        <th>นำส่งที่จังหวัด (ผู้ป่วย 1)</th>
                        <th>นำส่ง รพ. (ผู้ป่วย 1)</th>

                        <th>ชื่อ-สกุล (ผู้ป่วย 2)</th>
                        <th>อายุ (ผู้ป่วย 2)</th>
                        <th>HN (ผู้ป่วย 2)</th>
                        <th>เลขประจำตัวประชาชน (ผู้ป่วย 2)</th>
                        <th>นำส่งที่จังหวัด (ผู้ป่วย 2)</th>
                        <th>นำส่ง รพ. (ผู้ป่วย 2)</th>

                        <th>ชื่อ-สกุล (ผู้ป่วย 3)</th>
                        <th>อายุ (ผู้ป่วย 3)</th>
                        <th>HN (ผู้ป่วย 3)</th>
                        <th>เลขประจำตัวประชาชน (ผู้ป่วย 3)</th>
                        <th>นำส่งที่จังหวัด (ผู้ป่วย 3)</th>
                        <th>นำส่ง รพ. (ผู้ป่วย 3)</th>

                        <th>เกณฑ์การนำส่ง</th>
                        <th>การติดต่อสื่อสารกับเจ้าหน้าที่ รพ.</th>

                        <th>ทะเบียนรถหมวด</th>
                        <th>เลขทะเบียน</th>
                        <th>จังหวัด</th>
                        <th>เจ้าของ</th>

                        <th>เจ้าหน้าที่หน่วยปฏิบัติการที่ปฏิเสธเคสนี้</th>

                    </tr>
                </thead>

                <tfoot>
                    <tr>
                        <th>รหัสเคส</th>
                        <th>สถานะ</th>
                        <th>หมายเหตุสถานะ</th>
                        <th>วันที่ / เวลา</th>
                        <th>Latitude</th>
                        <th>Longitude</th>
                        <th>สถานที่</th>
                        <th>รายละเอียดสถานที่</th>
                        <th>รับแจ้งเหตุทาง</th>
                        <th>ผู้ขอความช่วยเหลือ</th>
                        <th>เบอร์ติดต่อผู้ขอความช่วยเหลือ</th>
                        <th>สั่งการโดย</th>
                        <th>ชื่อหน่วยปฏบัติการ</th>
                        <th>เจ้าหน้าที่หน่วยปฏิบัติการ</th>
                        <th>ยานพาหนะ</th>
                        <th>ระดับเจ้าหน้าที่หน่วยปฏิบัติการ</th>
                        <th>อาการ</th>
                        <th>รายละเอียดอาการ</th>
                        <th>การให้รหัสความรุนแรง (IDC)</th>
                        <th>รหัสความรุนแรง ณ จุดเกิดเหตุ (RC)</th>
                        <th>รายละเอียดรหัสความรุนแรง ณ จุดเกิดเหตุ</th>
                        <th>รายละเอียดสถานที่เกิดเหตุจากเจ้าหน้าที่</th>
                        <th>เวลาสั่งการ</th>
                        <th>เวลาออกจากฐาน</th>
                        <th>เวลาถึงที่เกิดเหตุ</th>
                        <th>เวลาออกจากที่เกิดเหตุ</th>
                        <th>เวลาถึง รพ.</th>
                        <th>เวลากลับถึงฐาน</th>
                        <th>รวมเวลาในการช่วยเหลือ</th>
                        <th>เลข กม. ออกจากฐาน</th>
                        <th>เลข กม. ถึงที่เกิดเหตุ</th>
                        <th>เลข กม. ถึง รพ.</th>
                        <th>เลข กม. กลับถึงฐาน</th>
                        <th>รวมเลข กม.</th>
                        <th>การรักษา</th>
                        <th>รายละเอียดการรักษา</th>
                        <th>คะแนนความประทับใจ</th>
                        <th>คะแนนความรวดเร็ว</th>
                        <th>รวมคะแนนการช่วยเหลือ</th>
                        <th>ข้อความการประเมิน</th>
                        <th>หมายเหตุจากเจ้าหน้าที่</th>
                        <th>เคสนี้รับมาจาก</th>
                        <th>ส่งต่อเคสนี้ไปยัง</th>
                        <th>อุบัติเหตุร่วม/อุบัติเหตุหมู่</th>
                        <th>ชื่อ-สกุล (ผู้ป่วย 1)</th>
                        <th>อายุ (ผู้ป่วย 1)</th>
                        <th>HN (ผู้ป่วย 1)</th>
                        <th>เลขประจำตัวประชาชน (ผู้ป่วย 1)</th>
                        <th>นำส่งที่จังหวัด (ผู้ป่วย 1)</th>
                        <th>นำส่ง รพ. (ผู้ป่วย 1)</th>
                        <th>ชื่อ-สกุล (ผู้ป่วย 2)</th>
                        <th>อายุ (ผู้ป่วย 2)</th>
                        <th>HN (ผู้ป่วย 2)</th>
                        <th>เลขประจำตัวประชาชน (ผู้ป่วย 2)</th>
                        <th>นำส่งที่จังหวัด (ผู้ป่วย 2)</th>
                        <th>นำส่ง รพ. (ผู้ป่วย 2)</th>
                        <th>ชื่อ-สกุล (ผู้ป่วย 3)</th>
                        <th>อายุ (ผู้ป่วย 3)</th>
                        <th>HN (ผู้ป่วย 3)</th>
                        <th>เลขประจำตัวประชาชน (ผู้ป่วย 3)</th>
                        <th>นำส่งที่จังหวัด (ผู้ป่วย 3)</th>
                        <th>นำส่ง รพ. (ผู้ป่วย 3)</th>
                        <th>เกณฑ์การนำส่ง</th>
                        <th>การติดต่อสื่อสารกับเจ้าหน้าที่ รพ.</th>
                        <th>ทะเบียนรถหมวด</th>
                        <th>เลขทะเบียน</th>
                        <th>จังหวัด</th>
                        <th>เจ้าของ</th>
                        <th>เจ้าหน้าที่หน่วยปฏิบัติการที่ปฏิเสธเคสนี้</th>

                    </tr>
                </tfoot>

            </table>
        </div>

    </div>
</div>

<!-- Bootstrap JS -->
<script src="{{ asset('partner_new/js/bootstrap.bundle.min.js') }}"></script>
<!--plugins-->
<script src="{{ asset('partner_new/js/jquery.min.js') }}"></script>

<script>
    // $(document).ready(function() {

    //     let title_theme = document.querySelector('#title_theme');
    //         title_theme.innerHTML = "ข้อมูลการขอความช่วยเหลือ" ;

    //     // เพิ่มโค้ดสำหรับการกรองข้อมูล
    //     let table = $('#all_data_sos_1669_table').DataTable(
    //         {
    //             lengthChange: true,
    //             buttons: ['excel']
    //         }
    //     );

    //     table.buttons().container()
    //         .appendTo( '#all_data_sos_1669_table_wrapper .col-md-6:eq(0) ' );
    // } );


    // $(document).ready(function () {
    //     //Only needed for the filename of export files.
    //     //Normally set in the title tag of your page.
    //     document.title = "ข้อมูลการขอความช่วยเหลือ";
    //     // Create search inputs in footer
    //     $("#all_data_sos_1669_table tfoot th").each(function () {
    //         let title = $(this).text();
    //         $(this).html('<input type="text" placeholder="Search ' + title + '" />');
    //     });
    //     // DataTable initialisation
    //     let table = $("#all_data_sos_1669_table").DataTable({
    //         dom: '<"dt-buttons"Bf><"clear">lirtp',
    //         paging: true,
    //         autoWidth: true,
    //         lengthChange: true,
    //         deferRender: true,
    //         buttons: [
    //             {
    //                 extend: "excelHtml5",
    //                 text: "Export Excel"  // เปลี่ยนข้อความในปุ่มที่นี่
    //             },
    //         ],
    //         initComplete: function (settings, json) {
    //             let footer = $("#all_data_sos_1669_table tfoot tr");
    //             $("#all_data_sos_1669_table thead").append(footer);
    //         }
    //     });

    //     document.querySelector('.dt-buttons').classList.add('mb-3');

    //     // Apply the search
    //     $("#all_data_sos_1669_table thead").on("keyup", "input", function () {
    //             table.column($(this).parent().index())
    //             .search(this.value)
    //             .draw();
    //         });
    // });
</script>

<script>
    document.addEventListener('DOMContentLoaded', (event) => {

        get_data_sos();
    });

    $(document).ready(function() {
        $('#your_table_id').DataTable();
    });
    // สมาชิกในทีมของทุกทีม

    async function get_data_sos() {

        await loading_get_data('loading');
        await get_all_data_sos();
    }
    // function get_data_sos() {

    function loading_get_data(status) {
        return new Promise(resolve => {
            if (status == 'loading') {
                document.querySelector('#loading_get_data_sos').classList.remove('d-none');
                document.getElementById("year").disabled = true;
                document.getElementById("month").disabled = true;
                document.getElementById("month2").disabled = true;

            } else {
                document.querySelector('#loading_get_data_sos').classList.add('d-none');
                document.getElementById("year").disabled = false;
                document.getElementById("month").disabled = false;
                document.getElementById("month2").disabled = false;
            }

            resolve();
        });
    }

    function get_all_data_sos() {
        document.title = "ข้อมูลการขอความช่วยเหลือ";
        // Create search inputs in footer
        $("#all_data_sos_1669_table tfoot th").each(function() {
            let title = $(this).text();
            $(this).html('<input type="text" placeholder="Search ' + title + '" />');
        });

        // DataTable initialisation
        let table = $("#all_data_sos_1669_table").DataTable({
            dom: '<"dt-buttons"Bf><"clear">lirtp',
            paging: true,
            autoWidth: true,
            lengthChange: false,
            bDestroy: true,
            deferRender: true,
            pageLength: 25,
            buttons: [{
                extend: "excelHtml5",
                text: "Export Excel" // เปลี่ยนข้อความในปุ่มที่นี่
            }],
            initComplete: function(settings, json) {
                let footer = $("#all_data_sos_1669_table tfoot tr");
                $("#all_data_sos_1669_table thead").append(footer);
            }
        });

        // Apply the search
        $("#all_data_sos_1669_table thead").on("keyup", "input", function() {
            table.column($(this).parent().index())
                .search(this.value)
                .draw();
        });

        let sub_organization = '{{Auth::user()->sub_organization}}';
        let month_start = document.getElementById("month").value;
        let month_end = document.getElementById("month2").value;
        let year = document.getElementById("year").value;

        // console.log(month_start);
        // console.log(month_end);
        // console.log(year);
        fetch("{{ url('/') }}/api/dashboard_1669_all_case_sos_show?user_sub_organization=" + sub_organization + "&year=" + year + "&month_start=" + month_start + "&month_end=" + month_end)
            .then(response => response.json())
            .then(result => {
                // console.log(result)
                return new Promise(resolve => {
                    table.clear().draw();

                    result.forEach(data => {
                        let createdAtDate = new Date(data.created_at);
                        let created_at = createdAtDate.toLocaleDateString('th-TH', {
                            year: 'numeric',
                            month: 'long',
                            day: 'numeric',
                        });

                        const sTimeSOSuccess = new Date(data.time_sos_success).getTime();
                        const sTimeCommand = new Date(data.time_command).getTime();

                        const sTimeDifference = Math.abs(sTimeSOSuccess - sTimeCommand) / 1000;

                        if (data.time_sos_success)
                            if (sTimeDifference >= 3600) {
                                const sHours = Math.floor(sTimeDifference / 3600);
                                const sRemainingMinutes = Math.floor((sTimeDifference % 3600) / 60);
                                const sRemainingSeconds = sTimeDifference % 60;

                                sTimeUnit = `${sHours} ชั่วโมง ${sRemainingMinutes} นาที ${sRemainingSeconds} วินาที`;
                            } else if (sTimeDifference >= 60) {
                            const sMinutes = Math.floor(sTimeDifference / 60);
                            const sSeconds = sTimeDifference % 60;

                            sTimeUnit = `${sMinutes} นาที ${sSeconds} วินาที`;
                        } else {
                            sTimeUnit = `${sTimeDifference} วินาที`;
                        } else {
                            sTimeUnit = "--"
                        }

                        let total_km = data.km_create_sos_to_go_to_help + data.km_to_the_scene_to_leave_the_scene + data.km_hospital + data.km_operating_base;


                        let row = [];
                        row.push(data.operating_code ? data.operating_code : "--");
                        row.push(data.status ? data.status : "--");
                        row.push(data.remark_status ? data.remark_status : "--");
                        row.push(data.created_at ? data.created_at : "--");
                        row.push(data.lat ? data.lat : "--");
                        row.push(data.lng ? data.lng : "--");
                        row.push(data.address ? data.address : "--");
                        row.push(data.location_sos ? data.location_sos : "--");
                        row.push(data.be_notified ? data.be_notified : "--");
                        row.push(data.name_user ? data.name_user : (result[i].name_officer_command ? data.name_officer_command + ' (เจ้าหน้าที่)' : "--"));
                        row.push(data.phone_user ? data.phone_user.substring(0, 3) + '-' + data.phone_user.substring(3, 6) + '-' + data.phone_user.substring(6) : "--");
                        row.push(data.name_officer_command ? data.name_officer_command : "--");
                        row.push(data.organization_helper ? data.organization_helper : "--");
                        row.push(data.name_helper ? data.name_helper : "--");
                        row.push(data.vehicle_type ? data.vehicle_type : "--");
                        row.push(data.operating_suit_type ? data.operating_suit_type : "--");
                        row.push(data.symptom ? data.symptom : "--");
                        row.push(data.symptom_other ? data.symptom_other : "--");
                        row.push(data.idc ? data.idc : "--");
                        row.push(data.rc ? data.rc : "--");
                        row.push(data.rc_black_text ? data.rc_black_text : "--");
                        row.push(data.remark_photo_sos ? data.remark_photo_sos : "--");
                        row.push(data.time_command ? data.time_command : "--");
                        row.push(data.time_go_to_help ? data.time_go_to_help : "--");
                        row.push(data.time_to_the_scene ? data.time_to_the_scene : "--");
                        row.push(data.time_leave_the_scene ? data.time_leave_the_scene : "--");
                        row.push(data.time_hospital ? data.time_hospital : "--");
                        row.push(data.time_to_the_operating_base ? data.time_to_the_operating_base : "--");
                        row.push(sTimeUnit);
                        row.push(data.km_create_sos_to_go_to_help ? data.km_create_sos_to_go_to_help : "--");
                        row.push(data.km_to_the_scene_to_leave_the_scene ? data.km_to_the_scene_to_leave_the_scene : "--");
                        row.push(data.km_hospital ? data.km_hospital : "--");
                        row.push(data.km_operating_base ? data.km_operating_base : "--");
                        row.push(total_km ? total_km : "--");
                        row.push(data.treatment ? data.treatment : "--");
                        row.push(data.sub_treatment ? data.sub_treatment : "--");
                        row.push(data.score_impression ? data.score_impression : "--");
                        row.push(data.score_period ? data.score_period : "--");
                        row.push(data.score_total ? data.score_total : "--");
                        row.push(data.comment_help ? data.comment_help : "--");
                        row.push(data.remark_helper ? data.remark_helper : "--");
                        row.push(data.forward_operating_form ? data.forward_operating_form : "--");
                        row.push(data.forward_operating_to ? data.forward_operating_to : "--");
                        row.push(data.joint_case ? data.joint_case : "--");
                        row.push(data.patient_name_1 ? data.patient_name_1 : "--");
                        row.push(data.patient_age_1 ? data.patient_age_1 : "--");
                        row.push(data.patient_hn_1 ? data.patient_hn_1 : "--");
                        row.push(data.patient_vn_1 ? data.patient_vn_1 : "--");
                        row.push(data.delivered_province_1 ? data.delivered_province_1 : "--");
                        row.push(data.delivered_hospital_1 ? data.delivered_hospital_1 : "--");
                        row.push(data.patient_name_2 ? data.patient_name_2 : "--");
                        row.push(data.patient_age_2 ? data.patient_age_2 : "--");
                        row.push(data.patient_hn_2 ? data.patient_hn_2 : "--");
                        row.push(data.patient_vn_2 ? data.patient_vn_2 : "--");
                        row.push(data.delivered_province_2 ? data.delivered_province_2 : "--");
                        row.push(data.delivered_hospital_2 ? data.delivered_hospital_2 : "--");
                        row.push(data.patient_name_3 ? data.patient_name_3 : "--");
                        row.push(data.patient_age_3 ? data.patient_age_3 : "--");
                        row.push(data.patient_hn_3 ? data.patient_hn_3 : "--");
                        row.push(data.patient_vn_3 ? data.patient_vn_3 : "--");
                        row.push(data.delivered_province_3 ? data.delivered_province_3 : "--");
                        row.push(data.delivered_hospital_3 ? data.delivered_hospital_3 : "--");
                        row.push(data.submission_criteria ? data.submission_criteria : "--");
                        row.push(data.communication_hospital ? data.communication_hospital : "--");
                        row.push(data.registration_category ? data.registration_category : "--");
                        row.push(data.registration_number ? data.registration_number : "--");
                        row.push(data.registration_province ? data.registration_province : "--");
                        row.push(data.owner_registration ? data.owner_registration : "--");
                        row.push(data.refuse ? data.refuse : "--");

                        table.row.add(row).draw(false); // เพิ่มแถวใหม่และแสดงผลบนตารางโดยไม่รีเรียกการวาดตาราง
                    });

                    loading_get_data('success');

                    resolve();
                });
            })
            .catch(error => {
                console.error('Error fetching data:', error);
            });


    }

    // }


    // // console.log('start here');
    // document.title = "ข้อมูลการขอความช่วยเหลือ";
    // // Create search inputs in footer
    // $("#all_data_sos_1669_table tfoot th").each(function() {
    //     let title = $(this).text();
    //     $(this).html('<input type="text" placeholder="Search ' + title + '" />');
    // });
    // // DataTable initialisation
    // let table = $("#all_data_sos_1669_table").DataTable({
    //     dom: '<"dt-buttons"Bf><"clear">lirtp',
    //     paging: true,
    //     autoWidth: true,
    //     lengthChange: false,
    //     bDestroy: true,
    //     buttons: [{
    //         extend: "excelHtml5",
    //         text: "Export Excel" // เปลี่ยนข้อความในปุ่มที่นี่
    //     }, ],
    //     initComplete: function(settings, json) {
    //         let footer = $("#all_data_sos_1669_table tfoot tr");
    //         $("#all_data_sos_1669_table thead").append(footer);
    //     }
    // });

    // // Apply the search
    // $("#all_data_sos_1669_table thead").on("keyup", "input", function() {
    //     table.column($(this).parent().index())
    //         .search(this.value)
    //         .draw();
    // });

    // let all_data_sos_1669_table = $('#all_data_sos_1669_table').DataTable();

    // let sub_organization = '{{Auth::user()->sub_organization}}';
    // // console.log(sub_organization);
    // fetch("{{ url('/') }}/api/dashboard_1669_all_case_sos_show?user_sub_organization=" + sub_organization)
    //     .then(response => response.json())
    //     .then(result => {

    //         // console.log(result);

    //         for (let i = 0; i < result.length; i++) {

    //             // console.log(result[i].id);
    //             let createdAtDate = new Date(result[i].created_at);
    //             let created_at = createdAtDate.toLocaleDateString('th-TH', {
    //                 year: 'numeric',
    //                 month: 'long',
    //                 day: 'numeric',
    //             });

    //             const sTimeSOSuccess = new Date(result[i].time_sos_success).getTime();
    //             const sTimeCommand = new Date(result[i].time_command).getTime();

    //             const sTimeDifference = Math.abs(sTimeSOSuccess - sTimeCommand) / 1000;

    //             if(result[i].time_sos_success)
    //                 if (sTimeDifference >= 3600) {
    //                     const sHours = Math.floor(sTimeDifference / 3600);
    //                     const sRemainingMinutes = Math.floor((sTimeDifference % 3600) / 60);
    //                     const sRemainingSeconds = sTimeDifference % 60;

    //                     sTimeUnit = `${sHours} ชั่วโมง ${sRemainingMinutes} นาที ${sRemainingSeconds} วินาที`;
    //                 } else if (sTimeDifference >= 60) {
    //                     const sMinutes = Math.floor(sTimeDifference / 60);
    //                     const sSeconds = sTimeDifference % 60;

    //                     sTimeUnit = `${sMinutes} นาที ${sSeconds} วินาที`;
    //                 } else {
    //                     sTimeUnit = `${sTimeDifference} วินาที`;
    //                 }
    //             else{
    //                 sTimeUnit =  "--"
    //             }

    //             let total_km = result[i].km_create_sos_to_go_to_help + result[i].km_to_the_scene_to_leave_the_scene
    //                         + result[i].km_hospital + result[i].km_operating_base;


    //             table.row.add([
    //                 result[i].operating_code ? result[i].operating_code : "--",
    //                 result[i].status ? result[i].status : "--",
    //                 result[i].remark_status ? result[i].remark_status : "--",
    //                 result[i].created_at ? result[i].created_at : "--",
    //                 result[i].lat ? result[i].lat : "--",
    //                 result[i].lng ? result[i].lng : "--",
    //                 result[i].address ? result[i].address : "--",
    //                 result[i].location_sos ? result[i].location_sos : "--",
    //                 result[i].be_notified ? result[i].be_notified : "--",
    //                 result[i].name_user ? result[i].name_user : (result[i].name_officer_command ? result[i].name_officer_command + ' (เจ้าหน้าที่)' : "--"),
    //                 result[i].phone_user ? result[i].phone_user.substring(0, 3) + '-' + result[i].phone_user.substring(3, 6) + '-' + result[i].phone_user.substring(6) : "--",
    //                 result[i].name_officer_command ? result[i].name_officer_command : "--",
    //                 result[i].organization_helper ? result[i].organization_helper : "--",
    //                 result[i].name_helper ? result[i].name_helper : "--",
    //                 result[i].vehicle_type ? result[i].vehicle_type : "--",
    //                 result[i].operating_suit_type ? result[i].operating_suit_type : "--",
    //                 result[i].symptom ? result[i].symptom : "--",
    //                 result[i].symptom_other ? result[i].symptom_other : "--",
    //                 result[i].idc ? result[i].idc : "--",
    //                 result[i].rc ? result[i].rc : "--",
    //                 result[i].rc_black_text ? result[i].rc_black_text : "--",
    //                 result[i].remark_photo_sos ? result[i].remark_photo_sos : "--",
    //                 result[i].time_command ? result[i].time_command : "--",
    //                 result[i].time_go_to_help ? result[i].time_go_to_help : "--",
    //                 result[i].time_to_the_scene ? result[i].time_to_the_scene : "--",
    //                 result[i].time_leave_the_scene ? result[i].time_leave_the_scene : "--",
    //                 result[i].time_hospital ? result[i].time_hospital : "--",
    //                 result[i].time_to_the_operating_base ? result[i].time_to_the_operating_base : "--",
    //                 sTimeUnit,
    //                 result[i].km_create_sos_to_go_to_help ? result[i].km_create_sos_to_go_to_help : "--",
    //                 result[i].km_to_the_scene_to_leave_the_scene ? result[i].km_to_the_scene_to_leave_the_scene : "--",
    //                 result[i].km_hospital ? result[i].km_hospital : "--",
    //                 result[i].km_operating_base ? result[i].km_operating_base : "--",
    //                 total_km ? total_km : "--",
    //                 result[i].treatment ? result[i].treatment : "--",
    //                 result[i].sub_treatment ? result[i].sub_treatment : "--",
    //                 result[i].score_impression ? result[i].score_impression : "--",
    //                 result[i].score_period ? result[i].score_period : "--",
    //                 result[i].score_total ? result[i].score_total : "--",
    //                 result[i].comment_help ? result[i].comment_help : "--",
    //                 result[i].remark_helper ? result[i].remark_helper : "--",
    //                 result[i].forward_operating_form ? result[i].forward_operating_form : "--",
    //                 result[i].forward_operating_to ? result[i].forward_operating_to : "--",
    //                 result[i].joint_case ? result[i].joint_case : "--",
    //                 result[i].patient_name_1 ? result[i].patient_name_1 : "--",
    //                 result[i].patient_age_1 ? result[i].patient_age_1 : "--",
    //                 result[i].patient_hn_1 ? result[i].patient_hn_1 : "--",
    //                 result[i].patient_vn_1 ? result[i].patient_vn_1 : "--",
    //                 result[i].delivered_province_1 ? result[i].delivered_province_1 : "--",
    //                 result[i].delivered_hospital_1 ? result[i].delivered_hospital_1 : "--",
    //                 result[i].patient_name_2 ? result[i].patient_name_2 : "--",
    //                 result[i].patient_age_2 ? result[i].patient_age_2 : "--",
    //                 result[i].patient_hn_2 ? result[i].patient_hn_2 : "--",
    //                 result[i].patient_vn_2 ? result[i].patient_vn_2 : "--",
    //                 result[i].delivered_province_2 ? result[i].delivered_province_2 : "--",
    //                 result[i].delivered_hospital_2 ? result[i].delivered_hospital_2 : "--",
    //                 result[i].patient_name_3 ? result[i].patient_name_3 : "--",
    //                 result[i].patient_age_3 ? result[i].patient_age_3 : "--",
    //                 result[i].patient_hn_3 ? result[i].patient_hn_3 : "--",
    //                 result[i].patient_vn_3 ? result[i].patient_vn_3 : "--",
    //                 result[i].delivered_province_3 ? result[i].delivered_province_3 : "--",
    //                 result[i].delivered_hospital_3 ? result[i].delivered_hospital_3 : "--",
    //                 result[i].submission_criteria ? result[i].submission_criteria : "--",
    //                 result[i].communication_hospital ? result[i].communication_hospital : "--",
    //                 result[i].registration_category ? result[i].registration_category : "--",
    //                 result[i].registration_number ? result[i].registration_number : "--",
    //                 result[i].registration_province ? result[i].registration_province : "--",
    //                 result[i].owner_registration ? result[i].owner_registration : "--",
    //                 result[i].refuse ? result[i].refuse : "--",
    //             ]).draw(false);
    //         };
    //     });
</script>



{{--
    <script>
        document.addEventListener('DOMContentLoaded', (event) => {
            let pagination_class = document.querySelector('.pagination');
            pagination_class.classList.add('float-start');
        });

    </script> --}}

@endsection
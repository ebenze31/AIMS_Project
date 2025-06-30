@extends('layouts.theme_aims')

@section('content')
<style>
    .gmnoprint *,
    .gm-style-mtc-bbw * {
        display: none !important;
    }

    body {
        width: 100%;
        height: 100dvh;
    }

    .nav-top {
        background: var(--background_primary);
        width: 100%;
        height: 79px;
        display: flex;
        align-items: center;
        padding: 0 20px;
        font-size: 22px;
        font-weight: bold;
        color: #fff;
    }

    .map-container {
        padding: 20px;
    }

    .number-item {
        display: flex;
        justify-content: space-between;
        padding: 10px;
        border-bottom: 1px solid #848484;
    }

    .contect .name {
        font-size: 16px;
        font-weight: bolder;
    }

    .contect .number {
        font-size: 14px;
        font-weight: lighter;
        color: #3f3939;
    }



    .btn-call {
        display: flex;
        align-items: center;
        justify-content: center;
        width: 45px;
        border-radius: 10px;
        border: 2px solid transparent;
        background: linear-gradient(to right, #fff, #fff),
            linear-gradient(260deg, rgba(40, 86, 250, 1) 0%, rgba(6, 162, 253, 1) 100%);
        background-clip: padding-box, border-box;
        -webkit-background-clip: padding-box, border-box;
        transition: all .15s ease-in-out;
    }

    .btn-call i {
        background: rgb(40, 86, 250);
        background: -moz-linear-gradient(260deg, rgba(40, 86, 250, 1) 0%, rgba(6, 162, 253, 1) 100%);
        background: -webkit-linear-gradient(260deg, rgba(40, 86, 250, 1) 0%, rgba(6, 162, 253, 1) 100%);
        background: linear-gradient(260deg, rgba(40, 86, 250, 1) 0%, rgba(6, 162, 253, 1) 100%);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        transition: all .15s ease-in-out;
    }

    .btn-call:hover,
    .btn-call:focus {
        color: #fff !important;
        background: var(--background_primary);
        border: none !important;
    }

    .btn-call:hover i,
    .btn-call:focus i {
        background: #fff;
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
    }

    .map {
        display: flex;
        justify-content: center;
        align-items: center;
        color: #fff;
    }

    @media (max-width: 900px) {
        .content {
            display: block;
        }

        .map {
            width: 100% !important;
            background-color: #2d2d2d;
            height: 250px;
            border-radius: 15px;
        }

        .header-phone-number {
            background: var(--background_primary);
            height: 56px;
            margin-left: 20px;
            display: flex;
            align-items: center;
            padding-left: 20px;
            font-weight: bold;
            border-radius: 10px 0 0 10px;
            color: #fff;
        }

        .phone-number {
            height: calc(100% - 426px);
            /* background-color: rgb(189, 189, 189); */
            padding: 20px 30px;
            overflow: auto;

        }

        .btn-sos-aims {
            position: fixed;
            bottom: 0px;
            padding: 20px;
            /* background-color: #000; */
            width: 100%;
            /* background: rgba(0,0,0,1);
            backdrop-filter: blur(50px); */
        }

        .btn-sos-aims button {
            background: var(--background_primary);
            width: 100%;
            height: 74px;
            border-radius: 10px;
            z-index: 3;
            position: relative;
            display: flex;
            text-align: center;
            padding: 20px;
        }

        .backdrop {
            position: absolute;
            bottom: 0;
            left: 0;
            width: 100%;
            height: calc(100% + 20px);
            background: linear-gradient(to bottom,
                    rgba(0, 0, 0, 0) 0%,
                    rgba(0, 0, 0, .8) 100%);
            pointer-events: none;
            /* เพื่อให้คลิกผ่านได้ */
            z-index: 2;
            /* กำหนดให้อยู่ด้านบนของเนื้อหา */
        }

        .phone-number .number-item:last-child {
            margin-bottom: 5em;
        }

    }

    @media (min-width: 900px) {
        .content {
            display: flex;
        }

        .map {
            width: 60dvw !important;
            background-color: #2d2d2d;
            height: calc(100dvh - 119px);
            border-radius: 15px;
        }

        .container-phone-number {
            width: 100%;
            padding: 0 10px;
            display: block;
            align-content: space-between;
        }

        .container-phone-number {
            width: 100%;
            padding: 20px;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            /* จัดให้อยู่บนสุดและล่างสุด */
            min-height: 100%;
            /* ให้ container เต็มหน้าจอ */
            max-height: 100%;
            /* ให้ container เต็มหน้าจอ */
        }

        .btn-sos-aims button {
            background: var(--background_primary);
            width: 100%;
            height: 74px;
            border-radius: 10px;
            z-index: 3;
            position: relative;
            display: flex;
            align-items: center;
            padding: 20px;
        }

        .phone-number {
            height: calc(100dvh - 240px);
            /* background-color: rgb(189, 189, 189); */
            padding: 20px 30px;
            overflow: auto;

        }

        .gmnoprint,
        .gm-style-mtc-bbw,
        .gm-style-mtc {
            display: none !important;
        }
    }
</style>

<nav class="nav-top">   
    <div style="width: 55px;height: 55px;padding: 5px;background-color: #fff;border-radius: 50px;" class="mr-3" >

        <img src="{{ asset('/partner_new/images/logo/aims full logo.png') }}" height="60" width="60"  alt="" >
    </div>

    <div class="">
        Privacy policy
    </div>
</nav>

<div class="container bg-white main-shadow" >
    <div class="row" style="margin: 15px ;">
        <div class="col-md-12" >
        	<h2 style="margin: 5px;">นโยบายเกี่ยวกับข้อมูลส่วนบุคคล เว็บไซต์ aims.viicheck.com</h2>
        	<hr>

    		<h5 style="text-decoration: underline; padding: 10px;">1. การยอมรับนโยบายเกี่ยวกับข้อมูลส่วนบุคคล</h5>
    		<p style="font-size: 16px; text-indent:30px;">บริษัท 2บี กรีน จำกัด (“บริษัท”) ให้บริการเว็บไซต์ aims.viicheck.Com (“บริการ”) แก่สมาชิก (“ท่าน”) เพื่อให้เป็นไปตามพระราชบัญญัติคุ้มครองข้อมูลส่วนบุคคล พ.ศ. 2562 บริษัทได้มีการปรับปรุงข้อตกลง และเงื่อนไขการให้บริการ โดยเพิ่มเติมสิทธิหน้าที่ของบริษัท และผู้ใช้บริการ ให้เป็นประโยชน์ของผู้ใช้บริการ และ มีความมั่นใจ ปลอดภัย จากการได้รับสิทธิ์คุ้มครองตามพระราชบัญญัติคุ้มครองข้อมูลส่วนบุคคล พ.ศ. 2562 สำหรับ “การเก็บรวบรวม การใช้ และ การเปิดเผย” ข้อมูลส่วนบุคคลของผู้ใช้บริการให้เป็นไปตามกฎหมาย ทั้งนี้ ขอให้ผู้ใช้บริการมั่นใจว่าบริษัท ได้ให้ความสำคัญอย่างมากในการปฏิบัติตามพระราชบัญญัติคุ้มครองข้อมูลส่วนบุคคล พ.ศ. 2562 และเพื่อช่วยให้ผู้ใช้งานได้ทราบถึงแนวทางปฏิบัติเกี่ยวกับนโยบายความเป็นส่วนตัว และทราบถึงทางเลือกเกี่ยวกับความเป็นส่วนตัวเมื่อเข้าใช้เว็บไซต์
			</p>

    		<h5 style="text-decoration: underline; padding: 10px;">2. วัตถุประสงค์ของการจัดเก็บข้อมูลส่วนบุคคลของบริษัท</h5>
			<p style="font-size: 16px;text-indent:30px;">บริษัทเก็บข้อมูลส่วนบุคคลของท่าน เพื่อยืนยันตัวตนของสมาชิก, การแจ้งเตือนด้านต่างๆ, โปรโมชั่นประจำเดือน, การลงประกาศขาย การขอสินเชื่อและการสืบค้นหาข้อมูลของยานพาหนะ จากนั้นจึงนำข้อมูลที่ได้มาวิเคราะห์และพัฒนาการให้บริการให้ดีขึ้น สอดคล้องกับความต้องการของผู้ใช้งานมากขึ้น โดยการเก็บรักษาข้อมูลส่วนบุคคลตามวัตถุประสงค์ของกฎหมาย และวัตถุประสงค์ในการดำเนินธุรกิจ</p>

			<h5 style="text-decoration: underline; padding: 10px;">3. บริษัทมีการคุ้มครองข้อมูลส่วนบุคคลอย่างไร</h5>
			<p style="font-size: 16px; text-indent:30px;">บริษัทมีมาตรการคุ้มครองความปลอดภัยของข้อมูลส่วนบุคคลของผู้ใช้บริการจากการเข้าถึงข้อมูลโดยไม่ได้รับอนุญาต การสูญหาย การใช้ข้อมูลในทางที่ผิดไปจากวัตถุประสงค์ในการจัดเก็บ การเปิดเผยและการเปลี่ยนแปลงแก้ไข เช่น FireWall, การควบคุมและการอนุญาตให้เข้าถึงข้อมูล แต่ไม่รวมถึงข้อมูลที่บริษัทได้รับอนุญาตจากผู้ใช้บริการให้เปิดเผยแก่บุคคลภายนอก</p>

			<h5 style="text-decoration: underline; padding: 10px;">4. ข้อมูลส่วนบุคคลที่บริษัทจัดเก็บ</h5>
			<p style="font-size: 16px; text-indent:30px;">4.1 ข้อมูลเกี่ยวกับการใช้บริการทั่วไป เช่น CooKies, ข้อมูลจราจรทางคอมพิวเตอร์ ซึ่งจัดเก็บเพื่อวิเคราะห์พฤติกรรมการใช้งาน เพื่อตอบสนองความต้องการเฉพาะบุคคลของผู้เข้าเยี่ยมชมหรือบริการเว็บไซต์ และอำนวยความสะดวกแก่ผู้ใช้งานเฉพาะบุคคลในการแสดงผล ซึ่งผู้ใช้งานอาจมีความสนใจเป็นพิเศษ<br>
			<p style="font-size: 16px; text-indent:30px;">4.2 ข้อมูลที่ผู้เข้าใช้บริการได้ลงทะเบียนสมัครสมาชิก เช่น คำนำหน้าชื่อ ชื่อ นามสกุล เพศ อายุ อาชีพ ตำแหน่งงาน ที่ทำงาน ตำแหน่ง การศึกษา สัญชาติ วันเกิด สถานภาพทางการสมรส ข้อมูลบนบัตรที่ออกโดยรัฐบาล (เช่น เลขที่บัตรประจำตัวประชาชน เลขหนังสือเดินทาง เลขประจำตัวผู้เสียภาษีอากร ข้อมูลใบอนุญาตขับขี่รถยนต์ เป็นต้น) ลายมือชื่อ การบันทึกเสียง การบันทึกการสนทนาทางโทรศัพท์ รูปถ่าย วันที่สมัครเข้าเป็นสมาชิก หรือเปลี่ยนแปลงแก้ไขข้อมูลสมาชิก รวมไปถึงรายละเอียดอื่นๆตามความจำเป็น โดยจัดเก็บเพื่อวัตถุประสงค์ในการยืนยันตัวบุคคลและป้องกันการปลอมแปลงตัวตน<br></p>
			<p style="font-size: 16px; text-indent:30px;">4.3 ข้อมูลที่ผู้เข้าใช้บริการ เลื่อนหรือลงประกาศขายยานพาหนะ หรือส่งข้อมูลข่าวสาร เช่น ชื่อ, นามสกุล, หมายเลขโทรศัพท์, ยี่ห้อ, รุ่น, ข้อมูลทะเบียนยานพาหนะ รวมไปถึงรายละเอียดอื่นๆตามความจำเป็น และเปลี่ยนแปลงแก้ไขข้อมูลเจ้าของและยานพาหนะ โดยจัดเก็บเพื่อวัตถุประสงค์ในการแสดงข้อมูลเลื่อนหรือลงประกาศขายยานพาหนะ หรือส่งข้อมูลข่าวสาร จัดเก็บเพื่อวัตถุประสงค์ในการแสดงตัวตนของเจ้าของรถ<br></p>
			<!-- <p style="font-size: 16px; text-indent:30px;">4.4 ข้อมูลที่ผู้เข้าใช้บริการได้ให้ความยินยอมในการขอสินเชื่อ เช่น บัตรประจำตัวประชาชน, ทะเบียนบ้าน, บัญชีเงินเดือน, สมุดบัญชีธนาคาร และสมุดทะเบียนรถที่ต้องการขอสินเชื่อ โดยจัดเก็บเพื่อวัตถุประสงค์ในการส่งข้อมูลต่อให้ธนาคารพิจารณาการขอสินเชื่อ อนึ่ง ข้อมูลเกี่ยวกับการขอสินเชื่อจะถูกเก็บไว้เป็นระยะเวลา 15 วันหลังจากส่งต่อให้ธนาคารแล้ว<br></p> -->
			<p style="font-size: 16px; text-indent:30px;">4.4 ข้อมูลเกี่ยวกับการเข้าใช้บริการอื่น ๆ เช่นข้อมูลข้อมูลจราจรทางคอมพิวเตอร์ ฯลฯ
			จะจัดเก็บตามข้อบังคับประกาศกระทรวงเทคโนโลยีสารสนเทศ และการสื่อสาร
			</p>

			<h5 style="text-decoration: underline; padding: 10px;">5. ระยะเวลาในการเก็บรวมรวบข้อมูลส่วนบุคคล</h5>
			<p style="font-size: 16px; text-indent:30px;">บริษัททำการจัดเก็บข้อมูลส่วนบุคคลตามหลักเกณฑ์ของพระราชบัญญัติว่าด้วยการกระทำความผิดเกี่ยวกับคอมพิวเตอร์ พ.ศ. 2550 โดยสำหรับข้อมูลเกี่ยวกับผู้เข้าใช้บริการซึ่งได้ลงทะเบียนสมัครสมาชิกจะถูกจัดเก็บไว้ตลอดระยะเวลาการเข้าใช้บริการ และสมาชิกที่ไม่มีการเข้าใช้บริการเกิน 1 ปี บริษัทจะระงับการเป็นสมาชิกโดยไม่ต้องแจ้งให้ทราบ แล้วทำการจัดเก็บข้อมูลไว้เป็นระยะเวลา 2 ปี ตามหลักเกณฑ์ของพระราชบัญญัติว่าด้วยการกระทำความผิดเกี่ยวกับคอมพิวเตอร์ (ฉบับที่ 2) พ.ศ. 2560</p>

			<h5 style="text-decoration: underline; padding: 10px;">6. การถอนความยินยอมในการจัดเก็บข้อมูลส่วนบุคคล</h5>
			<p style="font-size: 16px; text-indent:30px">เจ้าของข้อมูลส่วนบุคคลอาจถอนความยินยอมในการจัดเก็บข้อมูลส่วนบุคคลของตนเมื่อใดก็ได้ โดยการถอนความยินยอมในการจัดเก็บข้อมูลส่วนบุคคลจะมีผลเป็นการ "ระงับ (Deactivate)" สถานะสมาชิกซึ่งอาจทำให้ผู้เข้าใช้บริการไม่ได้รับประโยชน์ในการเข้าใช้บริการบางอย่าง ดังนี้<br></p>
			<p style="font-size: 16px; text-indent:30px;">6.1 ผู้เข้าใช้บริการจะไม่สามารถเข้าถึงหน้า "ข้อมูลสมาชิก (Profile)" ของตนเองได้<br></p>
			<p style="font-size: 16px; text-indent:30px;">6.2 ข้อมูลรถที่ลงประกาศขายจะถูกยกเลิก และนำออกจากระบบ<br></p>
			<p style="font-size: 16px; text-indent:30px;">6.3 ข้อมูลจราจรทางคอมพิวเตอร์ ซึ่งบริษัทจะต้องจัดเก็บตามกฎหมาย ยังคงต้องจัดเก็บอยู่ต่อไปตามข้อกำหนดของกฎหมาย<br></p>
			<p style="font-size: 16px; text-indent:30px;">6.4 ข้อมูลการขอสินเชื่อที่ส่งต่อไปยังธนาคารเรียบร้อยแล้ว ผู้ใช้บริการต้องขอข้อมูลส่วนบุคคลจากทางธนาคารโดยตรง<br></p>
			<p style="font-size: 16px; text-indent:30px;">6.5 ผู้เข้าใช้บริการสามารถ "ขอเปิดใช้ (Reactivate)" สถานะสมาชิกได้ ซึ่งจะทำให้สามารถเข้าถึงหน้า "ข้อมูลสมาชิก (Profile)" และ ใช้บริการได้ตามปกติ ภายในระยะเวลา 6 เดือน หลังจากทำการระงับ (Deactivate) ซึ่งหากหลังจาก 6 เดือนแล้วผู้เข้าใช้บริการจะต้องทำการสมัครสมาชิกใหม่</p>

			<h5 style="text-decoration: underline; padding: 10px;">7. การแลกเปลี่ยนข้อมูล</h5>
			<p style="font-size: 16px; text-indent:30px;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;บริษัทไม่มีนโยบายเปิดเผยข้อมูลส่วนบุคคลของผู้เข้าใช้บริการในลักษณะเจาะจงเป็นรายบุคคลแก่บุคคลภายนอก เว้นแต่จะต้องปฏิบัติตามข้อกำหนดของกฎหมาย อย่างไรก็ตาม บริษัทมีความจำเป็นต้องเปิดเผยข้อมูลส่วนบุคคล เฉพาะแต่ในกรณีดังต่อไปนี้<br>
			<p style="font-size: 16px; text-indent:30px;">7.1 กับบริษัทในเครือและพันธมิตรทางธุรกิจ เพื่อดำเนินไปตามธุรกิจของบริษัท ความสะดวกแก่ผู้ใช้บริการในการใช้บริการเว็บไซต์ หรือแอพพลิเคชั่นที่เกี่ยวข้องไปได้ในทันที<br>
			<!-- <p style="font-size: 16px; text-indent:30px;">7.2 กับธนาคารและสถาบันทางการเงิน เพื่อพิจารณาขอสินเชื่อ</p> -->

			<h5 style="text-decoration: underline; padding: 10px;">8. สิทธิของเจ้าของข้อมูลส่วนบุคคล</h5>
			<p style="font-size: 16px; text-indent:30px;">8.1 ผู้เข้าใช้บริการทั่วไปมีสิทธิขอรับสำเนาข้อมูลส่วนบุคคลที่เกี่ยวกับตน (CooKies) ได้โดยต้องนําอุปกรณ์ที่ใช้ในการเข้าถึงเว็บไซต์ aims.viicheck.com เช่น Notebook, PC, Tablet หรือ โทรศัพท์มือถือ มาที่บริษัทเพื่อขอรับสำเนาข้อมูลส่วนบุคคล<br></p>
			<p style="font-size: 16px; text-indent:30px;">8.2 ผู้เข้าใช้บริการที่ได้ลงทะเบียนสมัครสมาชิกมีสิทธิขอรับสำเนาข้อมูลส่วนบุคคลที่เกี่ยวกับตนได้ โดยนำสำเนาบัตรประชาชนและเอกสารยืนยันหมายเลขโทรศัพท์ที่ลงทะเบียนสมาชิก เป็นหลักฐานมาแสดง เพื่อยืนยันตัวตนสมาชิก</p>

			<h5 style="text-decoration: underline; padding: 10px;">9. ติอต่อบริษัทเกี่ยวกับข้อมูลส่วนบุคคล</h5>
			<p style="font-size: 16px; text-indent:30px;">เจ้าของข้อมูลส่วนบุคคลสามารถติดต่อในเรื่องข้อมูลส่วนบุคคลของตนเองได้ที่<br></p>
				<ol>
					<li style="font-weight: 400;"><span style="font-weight: 400;">อีเมล: </span><a href="mailto:contact.aims.viicheck@gmail.com"><span style="font-weight: 400;">contact.aims.viicheck@gmail.com</span></a></li>
					<li style="font-weight: 400;"><span style="font-weight: 400;">โทร: 02-027-7856</span></li>
					<li style="font-weight: 400;"><span style="font-weight: 400;">สถานที่ติดต่อ:บริษัท 2บี กรีน จำกัด เลขที่ 82/25 ถนนประชาชื่น แขวงลาดยาวเขตจตุจักร กรุงเทพมหานคร 10900</span></li>
				</ol>
		</div>
	</div>
</div>
<br><br><br>
@endsection







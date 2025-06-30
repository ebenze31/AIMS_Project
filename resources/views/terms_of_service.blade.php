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
        Terms of service
    </div>
</nav>

<div class="container bg-white main-shadow">
    <div class="row" style="margin: 15px ;">
        <div class="col-md-12">
        	<h2 style="margin: 5px;">ข้อกำหนดและเงื่อนไขการใช้บริการบน เว็บไซต์ aims.viicheck.com</h2>
        	<hr>

    		<h5 style="text-decoration: underline; padding: 10px;">1. การยอมรับในข้อกำหนดและเงื่อนไขการใช้บริการ aims.viicheck.com</h5>
    		<p style="font-size: 16px; text-indent:30px;">บริษัท 2บี กรีน จำกัด (“บริษัท”) ให้บริการเว็บไซต์ aims.viicheck.com หรือแอปพลิเคชันอื่นใดที่บริษัทให้บริการ หรือแอปพลิเคชันชื่ออื่นที่บริษัทเป็นผู้พัฒนา (“บริการ”) แก่สมาชิก (“ท่าน”) ภายใต้ข้อกำหนดและเงื่อนไขต่างๆ ที่บริษัทสามารถปรับปรุงให้ทันสมัยได้ตลอดเวลาโดยไม่ต้องบอกกล่าว ท่านต้องปฏิบัติตามข้อกำหนดและเงื่อนไขการใช้บริการอย่างเคร่งครัดตลอดเวลา
			</p>
	
			<h5 style="text-decoration: underline; padding: 10px;">2. ข้อกำหนดการสมัครเป็นสมาชิก</h5>
    		<p style="font-size: 16px; text-indent:30px;">ในการเปิดบัญชีสมาชิกให้แก่ท่าน ท่านตกลงที่จะให้ข้อมูลที่เป็นจริง ถูกต้อง และล่าสุดเกี่ยวกับตัวของท่านเองในการสมัครสมาชิก คงไว้ซึ่งความถูกต้องและเป็นจริงของข้อมูลของท่าน ในการลงทะเบียนหากท่านได้ให้ข้อมูลดังกล่าวที่ไม่เป็นจริง ไม่ถูกต้อง ไม่ใช่ข้อมูลล่าสุด หรือไม่สมบูรณ์ หรือหากบริษัทมีเหตุผลในการสงสัยว่าข้อมูลดังกล่าวที่ไม่เป็นจริง ไม่ถูกต้อง ไม่ใช่ข้อมูลล่าสุด หรือไม่สมบูรณ์ บริษัทมีสิทธิที่จะระงับหรือยกเลิกบัญชีของท่านโดยไม่ต้องบอกกล่าว และปฏิเสธที่จะให้บริการใดๆ ของบริษัทแก่ท่าน ท่านต้องรับผิดชอบในการรักษาความลับของรหัสผ่านและบัญชีของท่าน และรับผิดชอบในกิจกรรมทั้งหมดที่เกิดขึ้นภายใต้รหัสผ่านหรือบัญชีของท่าน รวมถึงอาจพิจารณาเรียกเก็บค่าใช้จ่ายสำหรับการใช้บริการนี้ไม่ว่ากรณีใด ๆ
			</p>
		
			<h5 style="text-decoration: underline; padding: 10px;">3. นโยบายความเป็นส่วนตัว (Privacy Policy)</h5>
    		<p style="font-size: 16px; text-indent:30px;">บริษัทมีนโยบายในการคุ้มครองข้อมูลส่วนบุคคลของผู้ใช้บริการทุกท่านอย่างดีที่สุด อย่างไรก็ตาม เพื่อความปลอดภัยในข้อมูลส่วนบุคคลของท่าน ท่านควรปฏิบัติตามข้อกำหนด และเงื่อนไขการให้บริการอย่างเคร่งครัด ในกรณีที่ข้อมูลส่วนบุคคลดังกล่าว ถูก hack (จารกรรมโดยวิธีการทางอิเล็กทรอนิกส์) หรือสูญหาย เสียหายอันเนื่องจากเหตุสุดวิสัยหรือไม่ว่ากรณีใดๆ ทั้งสิ้น บริษัทขอสงวนสิทธิในการปฏิเสธความรับผิดจากเหตุดังกล่าวทั้งหมด</p>
    		<p style="font-size: 16px; text-indent:30px;">เพื่อให้เป็นไปตามพระราชบัญญัติคุ้มครองข้อมูลส่วนบุคคล พ.ศ. 2562 บริษัทได้มีการปรับปรุงข้อตกลง และเงื่อนไขการให้บริการ โดยเพิ่มเติมสิทธิหน้าที่ของบริษัท และผู้ใช้บริการ ให้เป็นประโยชน์ของผู้ใช้บริการ และ มีความมั่นใจ ปลอดภัย จากการได้รับสิทธิ์คุ้มครองตามพระราชบัญญัติคุ้มครองข้อมูลส่วนบุคคล พ.ศ. 2562 สำหรับ “การเก็บรวบรวม การใช้ และ การเปิดเผย” ข้อมูลส่วนบุคคลของผู้ใช้บริการให้เป็นไปตามกฏหมาย ทั้งนี้ ขอให้ผู้ใช้บริการมั่นใจว่าบริษัทได้ให้ความสำคัญอย่างยิ่งยวดในการปฏิบัติตามพระราชบัญญัติคุ้มครองข้อมูลส่วนบุคคล พ.ศ. 2562
			</p>
			
			<h5 style="text-decoration: underline; padding: 10px;">4. ข้อจำกัดการใช้บริการ</h5>
    		<p style="font-size: 16px; text-indent:30px;">เพื่อความปลอดภัยในข้อมูลส่วนบุคคลของท่านและผู้ใช้บริการรายอื่น และเพื่อความเป็นระเบียบเรียบร้อยในการใช้บริการ ท่านต้องไม่กระทำการใดอันเป็นการล่วงละเมิดสิทธิส่วนบุคคลหรือสิทธิอื่นใดของบุคคลอื่น และ/หรือสิทธิในทรัพย์สินทางปัญญาของบริษัทหรือของบุคคลอื่น รวมทั้งต้องไม่กระทำการใดอันขัดต่อข้อตกลงและเงื่อนไขนี้ บริษัทสงวนสิทธิที่จะลบ (delete) ทำให้หยุดชั่วคราวหรือถาวร หรือนำเสนอและตรวจสอบข้อมูลส่วนบุคคลของท่านได้ตลอดเวลาตามความต้องการของกฎหมาย หรือเพื่อปกป้องและป้องกันสิทธิ ทรัพย์สิน หรือผลประโยชน์ของบริษัทและบุคคลภายนอก หรือเพื่อวัตถุประสงค์อื่นใดก็ตาม โดยไม่ต้องบอกกล่าวล่วงหน้า และบริษัทไม่ต้องรับผิดชอบในความเสียหายใดๆ ทั้งสิ้น</p>
    		<p style="font-size: 16px; text-indent:30px;">บริษัทเป็นเพียงผู้ให้บริการระบบและข้อมูล รวมถึงเผยแพร่ข้อมูลเพื่ออำนวยความสะดวกเท่านั้น บริษัทไม่อาจรับรองว่าข้อมูลมีความถูกต้อง สมบูรณ์ และปราศจากข้อบกพร่องใด ๆ โดยบริษัทเป็นเพียงสื่อกลางในการส่งผ่านข้อมูลเท่านั้น และบริษัทไม่มีความเกี่ยวข้องกับการทำธุรกรรมการซื้อขายที่ไม่ผ่านระบบของบริษัททั้งสิ้น
			</p>
				
			<h5 style="text-decoration: underline; padding: 10px;">5. การเปลี่ยนแปลงแก้ไข</h5>
    		
    		<p style="font-size: 16px; text-indent:30px;">บริษัทสงวนสิทธิในการพิจารณาแก้ไขเปลี่ยนแปลงข้อตกลงและเงื่อนไขการใช้บริการนี้เมื่อใด และอย่างใดก็ได้ตามความเหมาะสม และให้ถือว่าท่านที่ยังคงใช้บริการต่อไปตกลงยอมรับที่จะปฏิบัติตามระเบียบกฎเกณฑ์และเงื่อนไขที่แก้ไขเปลี่ยนแปลงนั้นโดยปริยาย และบริษัทสงวนสิทธิในการเปลี่ยนแปลง ปรับปรุง แก้ไข และระงับบริการไว้ชั่วคราวหรือถาวรได้ตลอดเวลา โดยไม่ต้องบอกกล่าวให้ทราบ และไม่ต้องรับผิดชอบในความสูญหายหรือเสียหายใดๆ ที่เกิดขึ้นทั้งสิ้น</p>
		
    		<h5 style="text-decoration: underline; padding: 10px;">6. ข้อจำกัดความรับผิด</h5>
    	
    		<p style="font-size: 16px; text-indent:30px;">หากเกิดความสูญหายหรือเสียหายขึ้นเนื่องจากการใช้บริการ บริษัทไม่ต้องรับผิดชอบใดๆ ทั้งสิ้นต่อท่าน และ/หรือบุคคลผู้เสียหายนั้น ท่านต้องรับผิดชอบและรับผลเสียหายที่เกิดขึ้นนั้นแต่เพียงผู้เดียว ทั้งนี้ ท่านตกลงสละสิทธิเรียกร้องให้บริษัทรับผิดในความสูญหายและเสียหายใดๆ ที่เกิดขึ้นจากการใช้บริการนี้ทั้งสิ้น</p>
    		<p style="font-size: 16px; text-indent:30px;">นอกจากนี้ ท่านต้องปกป้องมิให้บริษัท กรรมการ ผู้จัดการ ผู้บริหาร พนักงาน ลูกจ้าง ตัวแทน หรือที่ปรึกษาของบริษัท บริษัทในเครือและพันธมิตรทางธุรกิจ ต้องรับผิดหรือถูกฟ้องร้องจากบุคคลอื่นอันเนื่องมาจากบริการนี้ รวมทั้งจะต้องรับผิดชอบและชดใช้ค่าเสียหายต่างๆ ที่เกิดขึ้นเองทั้งสิ้น</p>
    		<h5 style="text-decoration: underline; padding: 10px;">7. การยกเลิกบริการ</h5>
    		<p style="font-size: 16px; text-indent:30px;">บริษัทมีสิทธิยกเลิก หรือระงับการให้บริการไว้ชั่วคราวหรือถาวร และลบข้อมูลเนื้อหาในบริการหรือข้อมูลของผู้ใช้บริการได้ทันที หากผู้ใช้บริการฝ่าฝืนหรือพยายามฝ่าฝืนข้อตกลงหรือเงื่อนไขนี้ข้อหนึ่งข้อใด โดยไม่ต้องแจ้งให้ทราบล่วงหน้า</p>
		</div>
	</div>
</div>
<br><br><br>
@endsection







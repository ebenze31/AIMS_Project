@extends('layouts.mail_to')

@section('content')
	<div class="container">
		<div class="row">
			<!-- คอม -->
			<div class="col-md-12">
				<div class="row">
					<div class="col-md-12" style="font-size:16px;">
						<h4>เรียน บริษัท <b>{{ $data["juristicNameTH"] }}</b></h4>
						<span>
							ทางเราได้รับการแจ้งปัญหาการขับขี่ยานพาหนะภายในองค์กรของท่าน
							<br><hr><br>
							<!-- ------------------------------------------------------------- -->
							<div>
								<img width="10%" src="{{ asset('/img/stickerline/PNG/37.2.png') }}"> 
							</div>
							<br><br>
							เมื่อเวลา {{ $data["datetime"] }}
							<br>
							หมายเลขทะเบียน <span style="font-size:18px;">{{ $data["registration_number"] }} {{ $data["province"] }} </span>
							<br>
							ปัญหาการขับขี่ที่ได้รับแจ้งคือ <span style="font-size:18px;color: red;">{{ $data["masseng"] }}</span>
							<br>
							@if(!empty($data["phone"]))
								เบอร์โทรศัพท์ติดต่อผู้แจ้ง 
								📞
								<a href="tel:{{ $data['phone'] }}">{{ $data["phone"] }}</a>
							@endif
							<br><br><hr><br>
							<!-- ------------------------------------------------------------- -->
							สอบถามข้อมูลเพิ่มเติมและติดต่อ ViiCHECK ทางนี้ได้เลยยยย 😆
							<br><br>
							📞 : <a href="tel:020277856">02 0277856</a>
							<br>
							📩 : <a href="mailto:contact.viicheck@gmail.com">contact.viicheck@gmail.com</a>
						</span>
					</div>
				</div>
			</div>
		</div>
	</div>   
	<script type="text/javascript">
              function googleTranslateElementInit() {
                new google.translate.TranslateElement({pageLanguage: 'th'}, 'google_translate_element');
              }
    </script>
    <script type="text/javascript" src="//translate.google.com/translate_a/element.js?cb=googleTranslateElementInit"></script>
@endsection

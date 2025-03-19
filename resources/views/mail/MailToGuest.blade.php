
<div class="container" style="box-shadow: 0 4px 4px 0 rgba(0, 0, 0, 0.15), 0 4px 10px 0 rgba(0, 0, 0, 0.15);border-radius: 10px;">
    <div class="row">
        <div class="col-12" style="border-style: solid;border-color: #ff0101;border-radius: 10px;background-color: #07375D;border-width: 5px;margin: 20px;padding: 20px;">
        	<div  class="col-12">
        		@if($data["postback_data"] == "wait")
	        		<center>
		        		<img width="70%" src="{{ asset('/img/logo/logo-flex-line.png') }}">
		        		<div class="col-11" style="border-style: solid;border-color: #ff0101;border-radius: 10px;background-color: #FAEBD7;border-width: 5px;padding: 20px;margin-top: -50px">
		        			<span style="color: #07375D;"><b>โปรดรอสักครู่</b></span>
		        			<br>
		        			<span style="color: #07375D;line-height: 2;">Please wait a moment</span>
		        			<br><br>
		        			<img width="65%" src="{{ asset('/img/stickerline/PNG/8.png') }}">
		        		</div>
		        		<hr style="border-style: solid;border-color: #FFFFFF;margin-top: 20px;margin-bottom: 20px;">
		        	</center>
		        	@endif
				@if($data["postback_data"] == "thx")
					<center>
		        		<img width="70%" src="{{ asset('/img/logo/logo-flex-line.png') }}">
		        		<div class="col-11" style="border-style: solid;border-color: #ff0101;border-radius: 10px;background-color: #FAEBD7;border-width: 5px;padding: 20px;margin-top: -50px">
		        			<span style="color: #07375D;"><b>ขอบคุณ</b></span>
		        			<br>
		        			<span style="color: #07375D;line-height: 2;">Thank you</span>
		        			<br><br>
		        			<img width="65%" src="{{ asset('/img/stickerline/PNG/14.png') }}">
		        		</div>
		        		<hr style="border-style: solid;border-color: #FFFFFF;margin-top: 20px;margin-bottom: 20px;">
		        	</center>
				@endif
	        	<h3 style="color: #FFFFFF">เวลาที่ตอบกลับ / Time</h3>
				<h4 style="color: #FFFFFF;line-height: 2;">{{ $data["datetime"] }}</h4>

				<hr style="border-style: solid;border-color: #FFFFFF;margin-top: 20px;margin-bottom: 20px;">

				<h3 style="color: #FFFFFF">เลขทะเบียน / Plate No.</h3>
				<h4 style="color: #FFFFFF;line-height: 2;">{{ $data["registration_number"] }} {{ $data["province"] }}</h4>
        	</div>
        </div>
    </div>
</div>
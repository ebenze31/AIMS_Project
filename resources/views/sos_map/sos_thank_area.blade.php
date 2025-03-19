@extends('layouts.viicheck')
@section('content')

@php
if(empty($link_line_oa)){
$link_line_oa = "https://lin.ee/xnFKMfc" ;
}

if(empty($id_sos_map)){
$id_sos_map = "1" ;
}
@endphp

<div class="d-none">
  <div class="form-group {{ $errors->has('user_id') ? 'has-error' : ''}}">
    <label for="user_id" class="control-label">{{ 'User Id' }}</label>
    <input class="form-control" name="user_id" type="number" id="user_id" value="{{ isset($sos_map->user_id) ? $sos_map->user_id : Auth::user()->id}}">
    {!! $errors->first('user_id', '<p class="help-block">:message</p>') !!}
  </div>
</div>
<input class="d-none" type="text" id="CountryCode" name="CountryCode" value="">
<!-- Button trigger modal -->
<button id="btn_modal" type="button" class="btn btn-primary d-none" data-toggle="modal" data-target="#modal">
  Launch static backdrop modal
</button>

<!-- Modal -->
<div class="modal fade" id="modal" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
    <div class="modal-content">
      <div class="modal-body" style="margin:-16.5px;">
        <center>
          <br>
          <h5 class="modal-title text-danger text-center" id="staticBackdropLabel"> <b>เจ้าหน้าที่กำลังเดินทางไปหาคุณ</b> <br><span style="font-size:18px;"> <b>โปรดรอสักครู่</b> </span></h5>
          <div style="position: relative;">


            <div id="sos_TH" class="d-">
              <img width="100%" src="{{ asset('/img/more/sos_thx/thx_th.png') }}">
            </div>
            <div id="sos_JP" class="d-none">
              <img width="100%" src="{{ asset('/img/more/sos_thx/thx_jp.png') }}">
            </div>
            <div id="sos_MM" class="d-none">
              <img width="100%" src="{{ asset('/img/more/sos_thx/thx_mr.png') }}">
            </div>
            <div id="sos_BN" class="d-none">
              <img width="100%" src="{{ asset('/img/more/sos_thx/thx_bn.png') }}">
            </div>
            <div id="sos_CN" class="d-none">
              <img width="100%" src="{{ asset('/img/more/sos_thx/thx_cn.png') }}">
            </div>
            <div id="sos_ID" class="d-none">
              <img width="100%" src="{{ asset('/img/more/sos_thx/thx_id.png') }}">
            </div>
            <div id="sos_KH" class="d-none">
              <img width="100%" src="{{ asset('/img/more/sos_thx/thx_kh.png') }}">
            </div>
            <div id="sos_KR" class="d-none">
              <img width="100%" src="{{ asset('/img/more/sos_thx/thx_kr.png') }}">
            </div>
            <div id="sos_LA" class="d-none">
              <img width="100%" src="{{ asset('/img/more/sos_thx/thx_la.png') }}">
            </div>
            <div id="sos_MY" class="d-none">
              <img width="100%" src="{{ asset('/img/more/sos_thx/thx_my.png') }}">
            </div>
            <div id="sos_PH" class="d-none">
              <img width="100%" src="{{ asset('/img/more/sos_thx/thx_ph.png') }}">
            </div>
            <div id="sos_SG" class="d-none">
              <img width="100%" src="{{ asset('/img/more/sos_thx/thx_sg.png') }}">
            </div>
            <div id="sos_VN" class="d-none">
              <img width="100%" src="{{ asset('/img/more/sos_thx/thx_vn.png') }}">
            </div>
            <style>
              @media (width < 345px) {
                .btn_line{
                  position:absolute;
                  bottom: 5%;  
                  left: 53%;
                  transform: translate(-50%, -50%); 
                  width: 100%;
                }
              }@media (width >= 345px) {
                .btn_line{
                  position:absolute;
                  bottom: 12%;  
                  left: 53%;
                  transform: translate(-50%, -50%); 
                  width: 100%;
                }
              }
            </style>
            <div class="row btn_line" >
              <div class="col-6 w-100 p-2 m-0">
                @if($tag_sos_or_repair != "tag_repair")
                  @if( $sos_name_content != 'สพฉ' )
                    <a href="{{ url('/sos_map/user_view_officer') . '/' . $id_sos_map }}" type="button" class="btn btn-block btn-primary main-shadow main-radius px-1">
                  @else
                    <a href="{{ url('/demo_sos_1669_api') }}" type="button" class="btn btn-block btn-primary main-shadow main-radius px-1">
                  @endif
                  <i class="fa-sharp fa-solid fa-map-location-dot mr-1"></i>
                  ตำแหน่งเจ้าหน้าที่
                </a>
                @else
                <a href="{{ url('/sos_map/report_repair_for_user') . '/' . $id_sos_map }}" type="button" class="btn btn-block btn-primary main-shadow main-radius px-1">
                  <i class="fa-solid fa-screwdriver-wrench mr-1"></i>
                  ดูรายละเอียด
                </a>
                @endif
              </div>
              <div class="col-6 w-100 p-2 m-0">
                <a href="{{ $link_line_oa }}" type="button" class="btn btn-block btn-success main-shadow main-radius">
                  <i class="fa-brands fa-line mr-1"></i>
                  กลับไปที่ไลน์
                </a>
              </div>



              <!-- <div class="col-12">
                <a href="{{ url('/sos_map/user_view_officer') . '/' . $id_sos_map }}" type="button" class="btn btn-primary main-shadow main-radius">
                  <i class="fa-sharp fa-solid fa-map-location-dot mr-1"></i>
                  ดูตำแหน่งเจ้าหน้าที่
                </a>
                <a href="{{ $link_line_oa }}" type="button" class="btn btn-success main-shadow main-radius">
                  <i class="fa-brands fa-line mr-1"></i>
                  กลับไปที่ไลน์
                </a>
              </div> -->
            </div>
          </div>
        </center>
        <br>
        <div style="padding: 0px 5px 0px 5px;">
          @include ('layouts.partner_2_row')
        </div>
        <br>
      </div>
      <div class="modal-footer d-none">
        <!-- <button type="button" class="btn btn-secondary" data-dismiss="modal">ปิด</button> -->
        <a id="a_line" href="{{ $link_line_oa }}">
          <button type="button" class="btn btn-success">เสร็จสิ้น</button>
        </a>
      </div>

    </div>
  </div>
</div>
<script>
  document.addEventListener('DOMContentLoaded', (event) => {

    document.getElementById("btn_modal").click();

    // var delayInMilliseconds = 5000; 

    // setTimeout(function() {
    //   document.getElementById("a_line").click();
    // }, delayInMilliseconds);
  });

  document.addEventListener('DOMContentLoaded', (event) => {
    // console.log("START");
    let user_id = document.querySelector('#user_id').value;

    fetch("{{ url('/') }}/api/check_sos_country/" + user_id)
      .then(response => response.json())
      .then(result => {
        // console.log(result);

        let countryCode = document.querySelector('#CountryCode');
        countryCode.value = result['countryCode'];

        if (result['countryCode']) {
          document.querySelector('#sos_' + result['countryCode']).classList.remove('d-none');
        }

      });

    for (var i = 0; i < 4; i++) {
      let num = Math.floor(Math.random() * 10);
      // console.log(num);
      document.querySelector('#logo_' + num).classList.remove('d-none');
    }

  });
</script>
@endsection
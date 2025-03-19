@extends('layouts.viicheck')

@section('content')

<form method="POST" action="{{ url('/') }}/api/edit_data_organization" accept-charset="UTF-8" class="form-horizontal" enctype="multipart/form-data">
    {{ csrf_field() }}

    <!-- Modal -->
    <div class="modal fade" id="modal_edit_data_organization" tabindex="-1" aria-labelledby="modal_edit_data_organizationLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="mt-3" style="font-family: 'Kanit', sans-serif;"><b>แก้ไขข้อมูลองค์กร</b> </h4>
                    <button type="button" class="close notranslate" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <input type="text" name="user_id" id="user_id" class="form-control d-none" readonly value="{{ Auth::user()->id }}">
                    <label  class="control-label">{{ 'เลือกองค์กร' }}</label>
                    <select name="name_partner" id="name_partner" class="form-control" onchange="change_organization();">
                        <option value="" selected> กรุณาเลือกองค์กร </option>
                        @foreach($data_all_organization as $item)
                            <option class="notranslate" value="{{ $item->id }}" > {{ $item->name }} </option>
                        @endforeach
                    </select>
                    <div id="div_name_selected" class="d-none notranslate">
                        <hr>
                        <center>
                            <span>คุณกำลังเลือก</span>
                            <br>
                            <h5 class="text-success" id="name_selected"></h5>
                        </center>
                    </div>
                </div>
                <div class="modal-footer">
                    <button style="width:20%;" type="button" class="btn btn-secondary" data-dismiss="modal">ปิด</button>
                    <input style="width:20%;" class="btn btn-primary" id="btn_submit_change_organization" type="submit" value="{{ 'ยืนยัน' }}" disabled>
                </div>
            </div>
        </div>
    </div>
</form>

<br><br><br><br><br>
<input type="hidden" name="type_cer" id="type_car" value="{{ $type_car }}">
<!-- ----------------------------------- แสดงผลเฉพาะคอม --------------------------------- -->
<div class="container d-none d-lg-block">
    <div class="row">
        <div class="col-12">
            <br><br>
            <a href="{{ url('/register_car/create') }}" class="btn btn-success main-shadow main-radius" title="Add New Register_car">
                <i class="fa fa-plus" aria-hidden="true"></i> เพิ่มรถคันใหม่
            </a>
            <div style="float:right;">
                <a href="{{ url('/profile') }}" type="button" class="btn btn-outline-danger text-danger main-shadow main-radius">ข้อมูลโปรไฟล์</a>
                <a href="{{ url('/register_car') }}" type="button" class="btn btn-outline-danger text-danger main-shadow main-radius">ข้อมูลรถของฉัน</a>
                @if(!empty($organization))
                    <a href="{{ url('/register_car_organization') }}" type="button" class="btn btn-danger text-white main-shadow main-radius">ข้อมูลรถองค์กร</a>
                @endif
            </div>
        </div>
    </div>
    <br>
    <div class="row">
        <div class="col-12">
            <div class="row">
                <div class="col-2">
                    <a href="{{ url('/register_car_organization') }}?type=all">
                        <button id="btn_type_all" style="width: 100%;"  class="btn btn-sm btn-danger main-shadow main-radius">
                            ทั้งหมด
                        </button>
                    </a>
                </div>
                <div class="col-2">
                    <a href="{{ url('/register_car_organization') }}?type=car">
                        <button id="btn_type_car" style="width: 100%;"  class="btn btn-sm btn-outline-danger main-shadow main-radius">
                            รถยนต์
                        </button>
                    </a>
                </div>
                <div class="col-lg-2 col-md-3">
                    <a href="{{ url('/register_car_organization') }}?type=motorcycle">
                        <button id="btn_type_motorcycle" style="width: 100%;"  class="btn btn-sm btn-outline-danger main-shadow main-radius">
                            รถจักรยานยนต์
                        </button>
                    </a>
                </div>
                <div class="col-lg-2 col-md-3">
                    <a href="{{ url('/register_car_organization') }}?type=other">
                        <button id="btn_type_other" style="width: 100%;"  class="btn btn-sm btn-outline-danger main-shadow main-radius">
                            อื่นๆ
                        </button>
                    </a>
                </div>
                <div class="col-12 text-center">
                    <div style="float:right;">
                        <img class="" id="img_show_car" style="width: 70px;height: 70px;object-fit: contain;"  src="{{ url('storage')}}/{{ $logo }}">
                        <p class="m-0 notranslate" style="font-family: 'Kanit', sans-serif;">{{$name_organizations}}</p>
                        <center>
                            <span style="margin-top:5px;font-family: 'Kanit', sans-serif;" class="btn btn-warning btn-sm text-white main-shadow main-radius" data-toggle="modal" data-target="#modal_edit_data_organization">
                                แก้ไของค์กร
                            </span>
                        </center>
                    </div>
                    <!-- <div style="float:right;">
                        <img class="" id="img_show_car" width="100" src="{{ url('/' ) }}/img/logo/Logo_Partner/{{ $juristicNameTH }}.png">
                        &nbsp;&nbsp;&nbsp;&nbsp;
                        @if(!empty($type_car))
                            @switch($type_car)
                                @case('all')
                                    <img class="" id="img_show_car" width="40" src="{{ url('/img/icon/menu_car.png' ) }}">
                                    &nbsp;&nbsp;
                                    <img class="" id="img_show_mortor" width="40" src="{{ url('/img/icon/menu_motorcycle.png' ) }}">
                                @break
                                @case('car')
                                    <img class="" id="img_show_car" width="40" src="{{ url('/img/icon/menu_car.png' ) }}">
                                @break
                                @case('motorcycle')
                                    <img class="" id="img_show_mortor" width="40" src="{{ url('/img/icon/menu_motorcycle.png' ) }}">
                                @break
                            @endswitch
                        @endif
                    </div> -->
                </div>
            </div>
        </div>
    </div>
    <br>
    <div class="row">
        <div class="col-12">
            <div class="row">
                @foreach($register_car as $item)
                <div class="col-4">
                    <div class="main-shadow" style="padding:15px;">
                        <div class="card  order-card">
                            <div class="card-block">
                                <button style="position:absolute;top:-15px;left:-16px;border-radius: 0px 20px 20px 0px;" type="button" class="btn btn-sm btn-primary main-shadow main-radius notranslate">
                                    <b>{{ $juristicNameTH }}</b>
                                </button>
                                <p class="text-right" style="font-size:15px">
                                    <a href="{{ url('/register_car/' . $item->id . '/edit') }}" class="text-right" style="margin: 5px 10px 0px 0px; font-size:15px">
                                        <u>แก้ไข</u>
                                    </a> 
                                </p>
                                <div class="row">
                                    <div class="col-12 col-md-12" style="margin-top:-15px;">
                                        <div class="row" style="margin:10px;">  
                                            <div class="d-none d-lg-block col-md-4" >
                                                <img width="50" style="margin:-5px 13px;" src="{{ asset('/img/logo_brand/logo-') }}{{ strtolower($item->brand) }}.png">
                                            </div> 
                                            <div class="col-7 col-md-8 notranslate">
                                                @if(!empty($item->brand))
                                                    <p style="font-size:24px;margin-top:-10px"><b>{{ $item->brand }}</b></p>
                                                    <p style="margin-top:-20px; font-size:16px">{{ $item->generation }} </p>
                                                @elseif(empty($item->brand) and !empty($item->brand_other))
                                                    <p style="font-size:24px;margin-top:-10px"><b>{{ $item->brand_other }}</b></p>
                                                    <p style="margin-top:-20px; font-size:16px">{{ $item->generation_other }} </p>
                                                @endif
                                            </div>
                                        </div>
                                        <center>
                                            <hr style="margin-top: -20px; width: 90%; height:0.3px; color:#BEBEBE;">
                                        </center>
                                        @if($item->car_type == "motorcycle")
                                            @php
                                                $reg = $item->registration_number ;
                                                $reg_text = preg_replace('/[0-9]+/', '', $reg);
                                                $reg_num = preg_replace('/[^A-Za-z0-9\-]/', ' ', $reg); 
                                                $reg_num_sp = explode(" ", $reg_num);
                                                $last_list_num = count($reg_num_sp) - 1 ;

                                                $reg_1 = $reg_num_sp[0] . $reg_text ;
                                                $reg_2 = $reg_num_sp[$last_list_num] ;
                                            @endphp
                                            <div class="row notranslate"  style="font-family: K2D, sans-serif;">
                                                <div class="col-12">
                                                    <center>
                                                        <p style="position: relative;top: 5px; z-index: 5; font-size:18px;">
                                                            <b>{{ $reg_1 }}</b>
                                                        </p>
                                                        <p style="position: relative;top: -10px; color: #000000; z-index: 5">
                                                            {{ $item->province }}
                                                            <br>
                                                            <b>{{ $reg_2 }}</b>
                                                        </p>
                                                        <!-- แท็บเล็ต -->
                                                        <img class="d-block d-lg-none" style="position: absolute;right: 101px;top: -5%;z-index: 2" width="130"src="{{ asset('/img/icon/ป้ายทะเบียนรถมอไซต์.png') }}">
                                                        <!-- pc -->
                                                        <img class="d-none d-lg-block" style="position: absolute;right: 108px;top: -5%;z-index: 2" width="130"src="{{ asset('/img/icon/ป้ายทะเบียนรถมอไซต์.png') }}">
                                                    </center>
                                                </div>
                                            </div>
                                        @else
                                            <div class="row notranslate"  style="font-family: K2D, sans-serif;">
                                                <div class="col-12">
                                                    <center>
                                                        <br>
                                                        <p style="position: relative;top: -5px; z-index: 5; font-size:18px;"><b>{{ $item->registration_number }}</b></p>
                                                        <p style="position: relative;top: -20px; color: #000000; z-index: 5">{{ $item->province }} </p>
                                                        <!-- แท็บเล็ต -->
                                                        <img class="d-block d-lg-none" style="position: absolute;right: 42px;top: 5%;z-index: 2" width="250"src="{{ asset('/img/icon/ป้ายทะเบียน.png') }}">
                                                        <!-- pc -->
                                                        <img class="d-none d-lg-block" style="position: absolute;right: 50px;top: 5%;z-index: 2" width="250"src="{{ asset('/img/icon/ป้ายทะเบียน.png') }}">
                                                    </center>
                                                </div>
                                            </div>
                                        @endif
                                        <br>
                                        
                                        <br>
                                        <center>
                                            <hr class="" style="margin-top: -50px; width: 90%; height:0.3px; color:#BEBEBE;">
                                        </center>
                                        <div class="row">
                                            <div class="col-6 col-md-6">
                                            <center>
                                                @if(!empty($item->act))
                                                    @if((strtotime($item->act) - strtotime($date_now))/  ( 60 * 60 * 24 ) <= 30 && (strtotime($item->act) - strtotime($date_now))/  ( 60 * 60 * 24 ) >= 1)
                                                        
                                                        <h5 style="text-align: center; margin-bottom:10px;">พรบ.</h5>
                                                        
                                                        <span style="font-size: 13px;">
                                                            <a class=" text-warning" href="{{ url('/register_car/' . $item->id . '/edit_act') }}"><b>{{ $item->act }}</b>&nbsp;<i class="fas fa-pencil-alt"></i></a>
                                                        </span>
                                                        <br>    
                                                            <!-- <td><b><a class=" text-warning" href="{{ url('/register_car/' . $item->id . '/edit_act') }}">{{ $item->act }}&nbsp;<i class="fas fa-pencil-alt"></i></a></b></td> -->
                                                    @elseif((strtotime($item->act) - strtotime($date_now))/  ( 60 * 60 * 24 ) <= 0)
                                                        
                                                        <h5 style="text-align: center; margin-bottom:10px;">พรบ.</h5>
                                                        
                                                        <span style="font-size: 13px;">
                                                            <a class=" text-danger" href="{{ url('/register_car/' . $item->id . '/edit_act') }}"><b>{{ $item->act }}</b>&nbsp;<i class="fas fa-pencil-alt"></i></a>
                                                        </span>
                                                        <br>
                                                                <!-- <td><b><a class=" text-danger" href="{{ url('/register_car/' . $item->id . '/edit_act') }}">{{ $item->act }}&nbsp;</a></b></td> -->
                                                    @else
                                                        <h5 style="text-align: center; margin-bottom:10px;">พรบ.</h5>
                                                        
                                                        <span style="font-size: 13px;">
                                                            <a class=" text-success" href="{{ url('/register_car/' . $item->id . '/edit_act') }}"><b>{{ $item->act }}</b>&nbsp;<i class="fas fa-pencil-alt"></i>
                                                            </a>
                                                        </span>
                                                        <br>
                                                        <!-- <td><b><a class=" text-success" href="{{ url('/register_car/' . $item->id . '/edit_act') }}">{{ $item->act }}&nbsp;<i class="fas fa-pencil-alt"></i></a></b></td> -->
                                                    @endif
                                                @else
                                                    <h5>
                                                        <span style="font-size: 13px; margin: 0px 10px;">
                                                            <a class="btn btn-warning btn-md  main-shadow main-radius " style="padding:2px 0px;  width: 90%;" href="{{ url('/register_car/' . $item->id . '/edit_act') }}">
                                                                <i class="fas fa-pencil-alt" style="font-size: 13px;">&nbsp;&nbsp;&nbsp;<b>พรบ.</b></i>
                                                            </a>
                                                        </span>
                                                    </h5>
                                                    <span style="font-size: 13px;">
                                                        <a class=" text-warning" >
                                                            &nbsp;
                                                        </a>
                                                    </span>
                                                    <br>
                                                @endif
                                            </center>  
                                            </div>
                                            <div class="col-6 col-md-6">
                                            <center>
                                                @if(!empty($item->insurance))
                                                    @if((strtotime($item->insurance) - strtotime($date_now))/  ( 60 * 60 * 24 ) <= 30 && (strtotime($item->insurance) - strtotime($date_now))/  ( 60 * 60 * 24 ) >= 1)
                                                    
                                                    <h5 style="text-align: center; margin-bottom:10px;">ประกัน</h5>
                                                    <span style="font-size: 13px;">
                                                        <a class="text-warning" href="{{ url('/register_car/' . $item->id . '/edit_act') }}"><b>{{ $item->insurance }}</b>&nbsp;<i class="fas fa-pencil-alt"></i>
                                                        </a>
                                                    </span>
                                                    <br>
                                                    <!-- <td><b><a class="text-warning" href="{{ url('/register_car/' . $item->id . '/edit_act') }}">{{ $item->insurance }}&nbsp;<i class="fas fa-pencil-alt"></i></a></b></td> -->
                                                    @elseif((strtotime($item->insurance) - strtotime($date_now))/  ( 60 * 60 * 24 ) <= 0)
                                                    <h5 style="text-align: center; margin-bottom:10px;">ประกัน</h5>
                                                    <span style="font-size: 13px;">
                                                        <a class="text-danger" href="{{ url('/register_car/' . $item->id . '/edit_act') }}"><b>{{ $item->insurance }}</b>&nbsp;<i class="fas fa-pencil-alt"></i>
                                                        </a>
                                                    </span>
                                                    <br>
                                                         <!-- <td><b><a class="text-danger" href="{{ url('/register_car/' . $item->id . '/edit_act') }}">{{ $item->insurance }}&nbsp;<i class="fas fa-pencil-alt"></i></a></b></td> -->
                                                     @else
                                                    <h5 style="text-align: center; margin-bottom:10px;">ประกัน</h5>
                                                    <span style="font-size: 13px;">
                                                        <a class="text-success" href="{{ url('/register_car/' . $item->id . '/edit_act') }}"><b>{{ $item->insurance }}</b>&nbsp;<i class="fas fa-pencil-alt"></i>
                                                        </a>
                                                    </span>
                                                    <br>
                                                        <!-- <td><b><a class="text-success" href="{{ url('/register_car/' . $item->id . '/edit_act') }}">{{ $item->insurance }}&nbsp;<i class="fas fa-pencil-alt"></i></a></b></td> -->
                                                    @endif
                                                @else
                                                    <h5>
                                                        <span style="font-size: 13px; ">
                                                            <a class="btn btn-warning btn-md  main-shadow main-radius" style="padding:2px 0px; width: 90%; margin: 0px 0px 0px -15px;" href="{{ url('/register_car/' . $item->id . '/edit_act') }}"><i class="fas fa-pencil-alt" style="font-size: 13px;">&nbsp;&nbsp;ประกัน</i>
                                                            </a>
                                                        </span>
                                                    </h5>
                                                    <span style="font-size: 13px;">
                                                        <a class=" text-warning" >
                                                            &nbsp;
                                                        </a>
                                                    </span>
                                                    <br>
                                                @endif
                                                </center>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div style="float:right;">
                                    <div>
                                        <a style="float:right;margin-right: 10px;margin-bottom: 10px;" data-toggle="collapse" data-target="#collapseExample{{ $item->id }}" aria-expanded="false" aria-controls="collapseExample{{ $item->id }}">
                                            <i class="fas fa-sort-down"></i>
                                        </a>
                                    </div>
                                    <br>
                                    <div style="margin-top:10px;" class="collapse" id="collapseExample{{ $item->id }}">
                                        <a href="{{ url('/register_car/' . $item->id ) }}">
                                            <button type="button" class="btn btn-success main-shadow main-radius"style="font-size: 14px; margin: 0px 0px 20px 20px; padding: 4px 12px;  width: 90px;">
                                                <b><i class="fas fa-hand-holding-usd" ></i>&nbsp;ขาย   </b>
                                            </button>
                                        </a>
                                        <a href="#">
                                            <button type="button" class="btn btn-primary main-shadow main-radius" style=" width: 90px; font-size: 14px; margin-top: -20px; padding: 4px 12px ">
                                                <b><i class="fas fa-donate"></i> &nbsp;สินเชื่อ</b>
                                            </button>
                                        </a>
                                        <form method="POST" action="{{ url('/register_car/' . $item->id ) }}?type=organization" accept-charset="UTF-8" style="display:inline">
                                            {{ method_field('DELETE') }}
                                            {{ csrf_field() }}
                                            <button type="submit" class="btn btn-sm btn-danger main-shadow main-radius float-right" style="font-size: 14px; margin: 0px 20px; padding: 4px 12px"  title="Delete registercar" onclick="return confirm(&quot;Confirm delete?&quot;)">
                                                <i class="fa fa-trash"  aria-hidden="true"></i>
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <br>
                </div>
                @endforeach
            </div>
        </div>
    </div>
</div>
<br>
<!-- ----------------------------------- สิ้นสุดแสดงผลเฉพาะคอม --------------------------------- -->

<!-- ----------------------------------- แสดงผลเฉพาะมือถือ --------------------------------- -->
<div class="container d-block d-md-none">
    <div class="row">
        <div class="col-12">
            <div class="row" style="float:right;">
                <div class="col-12">
                    <a href="{{ url('/profile') }}">
                        <button class="btn btn-outline-danger text-danger">โปรไฟล์</button>
                    </a>
                    <a href="{{ url('/register_car') }}">
                        <button class="btn btn-outline-danger text-danger">
                            รถของฉัน
                        </button>
                    </a>
                    @if(!empty($organization))
                    <a href="{{ url('/register_car_organization') }}">
                        <button class="btn btn-danger text-white main-shadow main-radius">
                            รถองค์กร
                        </button>
                    </a>
                    @endif
                </div>
            </div>
        </div>
        <div class="col-12">
            <br>

            <div class="row">
                <div class="col-12 text-center">
                    <img class="" id="img_show_car" width="50" style="object-fit: contain;" src="{{ url('storage')}}/{{ $logo }}">
                    <p class="notranslate p-0 m-0" style="font-family: 'Kanit', sans-serif;">
                       {{$name_organizations}}
                        <a style="margin-top:5px;" class=" text-warning" data-toggle="modal" data-target="#modal_edit_data_organization">
                           <b><i class="fa-solid fa-pen-to-square"></i> <u>แก้ไข</u> </b> 
                        </a>

                    </p>
                  
                </div>
                <div class="col-12 flex-row-reverse mt-3">
                    <a style="float:right;" href="{{ url('/register_car/create') }}" class="btn btn-success main-shadow main-radius" title="Add New Register_car">
                        <i class="fa fa-plus" aria-hidden="true"></i> เพิ่มรถคันใหม่
                    </a>
                </div>
            </div>
            

          

           
        </div>
    </div>
    <br>
    <div class="row">
        <div class="col-12">
            <div class="row">
                <div class="col-6" style="padding:5px;">
                    <a href="{{ url('/register_car_organization') }}?type=all">
                        <button id="btn_type_all_mobile" style="width: 100%;"  class="btn btn-sm btn-danger main-shadow main-radius">
                            ทั้งหมด
                        </button>
                    </a>
                </div>
                <div class="col-6" style="padding:5px;">
                    <a href="{{ url('/register_car_organization') }}?type=car">
                        <button id="btn_type_car_mobile" style="width: 100%;"  class="btn btn-sm btn-outline-danger main-shadow main-radius">
                            รถยนต์
                        </button>
                    </a>
                </div>
                <div class="col-6" style="padding:5px;">
                    <a href="{{ url('/register_car_organization') }}?type=motorcycle">
                        <button id="btn_type_motorcycle_mobile" style="width: 100%;"  class="btn btn-sm btn-outline-danger main-shadow main-radius">
                            จักรยานยนต์
                        </button>
                    </a>
                </div>
                <div class="col-6" style="padding:5px;">
                    <a href="{{ url('/register_car_organization') }}?type=other">
                        <button id="btn_type_other_mobile" style="width: 100%;"  class="btn btn-sm btn-outline-danger main-shadow main-radius">
                            อื่นๆ
                        </button>
                    </a>
                </div>
            </div>
        </div>
    </div>
    <br>
    <div class="row">
        <div class="col-12">
            <div class="row">
                @foreach($register_car as $item)
                <div class="col-12">
                    <div class="main-shadow" style="padding:15px;">
                        <div class="card  order-card">
                            <div class="card-block">
                                <button style="position:absolute;top:-15px;left:-16px;border-radius: 0px 20px 20px 0px;" type="button" class="btn btn-sm btn-success main-shadow main-radius notranslate">
                                    <b>{{ $juristicNameTH }}</b>
                                </button>
                                <p class="text-right" style="font-size:15px">
                                    <a href="{{ url('/register_car/' . $item->id . '/edit') }}" class="text-right" style="margin: 5px 10px 0px 0px; font-size:15px">
                                        <u>แก้ไข</u>
                                    </a> 
                                </p>
                                <div class="row">
                                    <div class="col-12" style="margin-top:-15px;">
                                        <div class="row" style="margin:10px;">  
                                            <div class="col-4" >
                                                <img width="50" style="margin:-5px 13px;" src="{{ asset('/img/logo_brand/logo-') }}{{ strtolower($item->brand) }}.png">
                                            </div> 
                                            <div class="col-8 notranslate">
                                                @if(!empty($item->brand))
                                                    <p style="font-size:24px;margin-top:-10px"><b>{{ $item->brand }}</b></p>
                                                    <p style="margin-top:-20px; font-size:16px">{{ $item->generation }} </p>
                                                @elseif(empty($item->brand) and !empty($item->brand_other))
                                                    <p style="font-size:24px;margin-top:-10px"><b>{{ $item->brand_other }}</b></p>
                                                    <p style="margin-top:-20px; font-size:16px">{{ $item->generation_other }} </p>
                                                @endif
                                            </div>
                                        </div>
                                        <center>
                                            <hr style="margin-top: -20px; width: 90%; height:0.3px; color:#BEBEBE;">
                                        </center>
                                        @if($item->car_type == "motorcycle")
                                            @php
                                                $reg = $item->registration_number ;
                                                $reg_text = preg_replace('/[0-9]+/', '', $reg);
                                                $reg_num = preg_replace('/[^A-Za-z0-9\-]/', ' ', $reg); 
                                                $reg_num_sp = explode(" ", $reg_num);
                                                $last_list_num = count($reg_num_sp) - 1 ;

                                                $reg_1 = $reg_num_sp[0] . $reg_text ;
                                                $reg_2 = $reg_num_sp[$last_list_num] ;
                                            @endphp
                                            <div class="row notranslate"  style="font-family: K2D, sans-serif;">
                                                <div class="col-12">
                                                    <center>
                                                        <p style="position: relative;top: 5px; z-index: 5; font-size:18px;">
                                                            <b>{{ $reg_1 }}</b>
                                                        </p>
                                                        <p style="position: relative;top: -10px; color: #000000; z-index: 5">
                                                            {{ $item->province }}
                                                            <br>
                                                            <b>{{ $reg_2 }}</b>
                                                        </p>
                                                        <img style="position: absolute;right: 100px;top: -5%;z-index: 2" width="130"src="{{ asset('/img/icon/ป้ายทะเบียนรถมอไซต์.png') }}">
                                                    </center>
                                                </div>
                                            </div>
                                        @else
                                            <div class="row notranslate"  style="font-family: K2D, sans-serif;">
                                                <div class="col-12">
                                                    <center>
                                                        <br>
                                                        <p style="position: relative;top: -5px; z-index: 5; font-size:18px;"><b>{{ $item->registration_number }}</b></p>
                                                        <p style="position: relative;top: -20px; color: #000000; z-index: 5">{{ $item->province }} </p>
                                                        <img style="position: absolute;right: 40px;top: 5%;z-index: 2" width="250"src="{{ asset('/img/icon/ป้ายทะเบียน.png') }}">
                                                    </center>
                                                </div>
                                            </div>
                                        @endif
                                        <br>
                                        
                                        <br>
                                        <center>
                                            <hr class="" style="margin-top: -50px; width: 90%; height:0.3px; color:#BEBEBE;">
                                        </center>
                                        <div class="row">
                                            <div class="col-6 col-md-6">
                                            <center>
                                                @if(!empty($item->act))
                                                    @if((strtotime($item->act) - strtotime($date_now))/  ( 60 * 60 * 24 ) <= 30 && (strtotime($item->act) - strtotime($date_now))/  ( 60 * 60 * 24 ) >= 1)
                                                        
                                                        <h5 style="text-align: center; margin-bottom:10px;">พรบ.</h5>
                                                        
                                                        <span style="font-size: 13px;">
                                                            <a class=" text-warning" href="{{ url('/register_car/' . $item->id . '/edit_act') }}"><b>{{ $item->act }}</b>&nbsp;<i class="fas fa-pencil-alt"></i></a>
                                                        </span>
                                                        <br>    
                                                            <!-- <td><b><a class=" text-warning" href="{{ url('/register_car/' . $item->id . '/edit_act') }}">{{ $item->act }}&nbsp;<i class="fas fa-pencil-alt"></i></a></b></td> -->
                                                    @elseif((strtotime($item->act) - strtotime($date_now))/  ( 60 * 60 * 24 ) <= 0)
                                                        
                                                        <h5 style="text-align: center; margin-bottom:10px;">พรบ.</h5>
                                                        
                                                        <span style="font-size: 13px;">
                                                            <a class=" text-danger" href="{{ url('/register_car/' . $item->id . '/edit_act') }}"><b>{{ $item->act }}</b>&nbsp;<i class="fas fa-pencil-alt"></i></a>
                                                        </span>
                                                        <br>
                                                                <!-- <td><b><a class=" text-danger" href="{{ url('/register_car/' . $item->id . '/edit_act') }}">{{ $item->act }}&nbsp;</a></b></td> -->
                                                    @else
                                                        <h5 style="text-align: center; margin-bottom:10px;">พรบ.</h5>
                                                        
                                                        <span style="font-size: 13px;">
                                                            <a class=" text-success" href="{{ url('/register_car/' . $item->id . '/edit_act') }}"><b>{{ $item->act }}</b>&nbsp;<i class="fas fa-pencil-alt"></i>
                                                            </a>
                                                        </span>
                                                        <br>
                                                        <!-- <td><b><a class=" text-success" href="{{ url('/register_car/' . $item->id . '/edit_act') }}">{{ $item->act }}&nbsp;<i class="fas fa-pencil-alt"></i></a></b></td> -->
                                                    @endif
                                                @else
                                                    <h5>
                                                        <span style="font-size: 13px; margin: 0px 10px;">
                                                            <a class="btn btn-warning btn-md  main-shadow main-radius " style="padding:2px 0px;  width: 90%;" href="{{ url('/register_car/' . $item->id . '/edit_act') }}">
                                                                <i class="fas fa-pencil-alt" style="font-size: 13px;">&nbsp;&nbsp;&nbsp;<b>พรบ.</b></i>
                                                            </a>
                                                        </span>
                                                    </h5>
                                                    <span style="font-size: 13px;">
                                                        <a class=" text-warning" >
                                                            &nbsp;
                                                        </a>
                                                    </span>
                                                    <br>
                                                @endif
                                            </center>  
                                            </div>
                                            <div class="col-6 col-md-6">
                                            <center>
                                                @if(!empty($item->insurance))
                                                    @if((strtotime($item->insurance) - strtotime($date_now))/  ( 60 * 60 * 24 ) <= 30 && (strtotime($item->insurance) - strtotime($date_now))/  ( 60 * 60 * 24 ) >= 1)
                                                    
                                                    <h5 style="text-align: center; margin-bottom:10px;">ประกัน</h5>
                                                    <span style="font-size: 13px;">
                                                        <a class="text-warning" href="{{ url('/register_car/' . $item->id . '/edit_act') }}"><b>{{ $item->insurance }}</b>&nbsp;<i class="fas fa-pencil-alt"></i>
                                                        </a>
                                                    </span>
                                                    <br>
                                                    <!-- <td><b><a class="text-warning" href="{{ url('/register_car/' . $item->id . '/edit_act') }}">{{ $item->insurance }}&nbsp;<i class="fas fa-pencil-alt"></i></a></b></td> -->
                                                    @elseif((strtotime($item->insurance) - strtotime($date_now))/  ( 60 * 60 * 24 ) <= 0)
                                                    <h5 style="text-align: center; margin-bottom:10px;">ประกัน</h5>
                                                    <span style="font-size: 13px;">
                                                        <a class="text-danger" href="{{ url('/register_car/' . $item->id . '/edit_act') }}"><b>{{ $item->insurance }}</b>&nbsp;<i class="fas fa-pencil-alt"></i>
                                                        </a>
                                                    </span>
                                                    <br>
                                                         <!-- <td><b><a class="text-danger" href="{{ url('/register_car/' . $item->id . '/edit_act') }}">{{ $item->insurance }}&nbsp;<i class="fas fa-pencil-alt"></i></a></b></td> -->
                                                     @else
                                                    <h5 style="text-align: center; margin-bottom:10px;">ประกัน</h5>
                                                    <span style="font-size: 13px;">
                                                        <a class="text-success" href="{{ url('/register_car/' . $item->id . '/edit_act') }}"><b>{{ $item->insurance }}</b>&nbsp;<i class="fas fa-pencil-alt"></i>
                                                        </a>
                                                    </span>
                                                    <br>
                                                        <!-- <td><b><a class="text-success" href="{{ url('/register_car/' . $item->id . '/edit_act') }}">{{ $item->insurance }}&nbsp;<i class="fas fa-pencil-alt"></i></a></b></td> -->
                                                    @endif
                                                @else
                                                    <h5>
                                                        <span style="font-size: 13px; ">
                                                            <a class="btn btn-warning btn-md  main-shadow main-radius" style="padding:2px 0px; width: 90%; margin: 0px 0px 0px -15px;" href="{{ url('/register_car/' . $item->id . '/edit_act') }}"><i class="fas fa-pencil-alt" style="font-size: 13px;">&nbsp;&nbsp;ประกัน</i>
                                                            </a>
                                                        </span>
                                                    </h5>
                                                    <span style="font-size: 13px;">
                                                        <a class=" text-warning" >
                                                            &nbsp;
                                                        </a>
                                                    </span>
                                                    <br>
                                                @endif
                                                </center>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div style="float:right;">
                                    <div>
                                        <a style="float:right;margin-right: 10px;margin-bottom: 10px;" data-toggle="collapse" data-target="#collapseExample{{ $item->id }}" aria-expanded="false" aria-controls="collapseExample{{ $item->id }}">
                                            <i class="fas fa-sort-down"></i>
                                        </a>
                                    </div>
                                    <br>
                                    <div style="margin-top:10px;" class="collapse" id="collapseExample{{ $item->id }}">
                                        <a href="{{ url('/register_car/' . $item->id ) }}">
                                            <button type="button" class="btn btn-success main-shadow main-radius"style="font-size: 14px; margin: 0px 0px 20px 20px; padding: 4px 12px;  width: 90px;">
                                                <b><i class="fas fa-hand-holding-usd" ></i>&nbsp;ขาย   </b>
                                            </button>
                                        </a>
                                        <a href="#">
                                            <button type="button" class="btn btn-primary main-shadow main-radius" style=" width: 90px; font-size: 14px; margin-top: -20px; padding: 4px 12px ">
                                                <b><i class="fas fa-donate"></i> &nbsp;สินเชื่อ</b>
                                            </button>
                                        </a>
                                        <form method="POST" action="{{ url('/register_car/' . $item->id ) }}?type=organization" accept-charset="UTF-8" style="display:inline">
                                            {{ method_field('DELETE') }}
                                            {{ csrf_field() }}
                                            <button type="submit" class="btn btn-sm btn-danger main-shadow main-radius float-right" style="font-size: 14px; margin: 0px 20px; padding: 4px 12px"  title="Delete registercar" onclick="return confirm(&quot;Confirm delete?&quot;)">
                                                <i class="fa fa-trash"  aria-hidden="true"></i>
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <br>
                </div>
                @endforeach
            </div>
        </div>
    </div>
</div>
<br>
<!-- ----------------------------------- สิ้นสุดแสดงผลเฉพาะมือถือ --------------------------------- -->

<script>
    document.addEventListener('DOMContentLoaded', (event) => {
        // console.log("START");
        add_color();
        
    });

    function change_organization(){
        let op_name_selected = document.querySelector('#name_partner');
        let name_select_day = op_name_selected.options[op_name_selected.selectedIndex].text ;

        document.querySelector('#div_name_selected').classList.remove('d-none');
        document.querySelector('#name_selected').innerHTML = name_select_day ;

        if (op_name_selected.value) {
            document.querySelector('#btn_submit_change_organization').disabled = false ;
        }else{
            document.querySelector('#btn_submit_change_organization').disabled = true ;
        }
    }

    function add_color(){
        // console.log("START");
        let type_car = document.querySelector('#type_car').value;
        // คอม
        let btn_type_all = document.querySelector('#btn_type_all');
        let btn_type_car = document.querySelector('#btn_type_car');
        let btn_type_motorcycle = document.querySelector('#btn_type_motorcycle');
        // มือถือ
        let btn_type_all_mobile = document.querySelector('#btn_type_all_mobile');
        let btn_type_car_mobile = document.querySelector('#btn_type_car_mobile');
        let btn_type_motorcycle_mobile = document.querySelector('#btn_type_motorcycle_mobile');

        switch(type_car) {
            case 'all':
                // คอม
                btn_type_all.classList.add('btn-danger');
                btn_type_car.classList.remove('btn-danger');
                btn_type_motorcycle.classList.remove('btn-danger');
                btn_type_other.classList.remove('btn-danger');

                btn_type_all.classList.remove('btn-outline-danger');
                btn_type_car.classList.add('btn-outline-danger');
                btn_type_motorcycle.classList.add('btn-outline-danger');
                btn_type_other.classList.add('btn-outline-danger');

                // มือถือ
                btn_type_all_mobile.classList.add('btn-danger');
                btn_type_car_mobile.classList.remove('btn-danger');
                btn_type_motorcycle_mobile.classList.remove('btn-danger');
                btn_type_other_mobile.classList.remove('btn-danger');

                btn_type_all_mobile.classList.remove('btn-outline-danger');
                btn_type_car_mobile.classList.add('btn-outline-danger');
                btn_type_motorcycle_mobile.classList.add('btn-outline-danger');
                btn_type_other_mobile.classList.add('btn-outline-danger');
             break;
            case 'car':
                // คอม
                btn_type_all.classList.remove('btn-danger');
                btn_type_car.classList.add('btn-danger');
                btn_type_motorcycle.classList.remove('btn-danger');
                btn_type_other.classList.remove('btn-danger');

                btn_type_all.classList.add('btn-outline-danger');
                btn_type_car.classList.remove('btn-outline-danger');
                btn_type_motorcycle.classList.add('btn-outline-danger');
                btn_type_other.classList.add('btn-outline-danger');

                // มือถือ
                btn_type_all_mobile.classList.remove('btn-danger');
                btn_type_car_mobile.classList.add('btn-danger');
                btn_type_motorcycle_mobile.classList.remove('btn-danger');
                btn_type_other_mobile.classList.remove('btn-danger');

                btn_type_all_mobile.classList.add('btn-outline-danger');
                btn_type_car_mobile.classList.remove('btn-outline-danger');
                btn_type_motorcycle_mobile.classList.add('btn-outline-danger');
                btn_type_other_mobile.classList.add('btn-outline-danger');
                break;
            case 'motorcycle':
                // คอม
                btn_type_all.classList.remove('btn-danger');
                btn_type_car.classList.remove('btn-danger');
                btn_type_other.classList.remove('btn-danger');
                btn_type_motorcycle.classList.add('btn-danger');

                btn_type_all.classList.add('btn-outline-danger');
                btn_type_car.classList.add('btn-outline-danger');
                btn_type_other.classList.add('btn-outline-danger');
                btn_type_motorcycle.classList.remove('btn-outline-danger');

                // มือถือ
                btn_type_all_mobile.classList.remove('btn-danger');
                btn_type_car_mobile.classList.remove('btn-danger');
                btn_type_other_mobile.classList.remove('btn-danger');
                btn_type_motorcycle_mobile.classList.add('btn-danger');

                btn_type_all_mobile.classList.add('btn-outline-danger');
                btn_type_car_mobile.classList.add('btn-outline-danger');
                btn_type_other_mobile.classList.add('btn-outline-danger');
                btn_type_motorcycle_mobile.classList.remove('btn-outline-danger');
                break;
            case 'other':
                // คอม
                btn_type_all.classList.remove('btn-danger');
                btn_type_car.classList.remove('btn-danger');
                btn_type_motorcycle.classList.remove('btn-danger');
                btn_type_other.classList.add('btn-danger');

                btn_type_all.classList.add('btn-outline-danger');
                btn_type_car.classList.add('btn-outline-danger');
                btn_type_motorcycle.classList.add('btn-outline-danger');
                btn_type_other.classList.remove('btn-outline-danger');

                // มือถือ
                btn_type_all_mobile.classList.remove('btn-danger');
                btn_type_car_mobile.classList.remove('btn-danger');
                btn_type_motorcycle_mobile.classList.remove('btn-danger');
                btn_type_other_mobile.classList.add('btn-danger');

                btn_type_all_mobile.classList.add('btn-outline-danger');
                btn_type_car_mobile.classList.add('btn-outline-danger');
                btn_type_motorcycle_mobile.classList.add('btn-outline-danger');
                btn_type_other_mobile.classList.remove('btn-outline-danger');
                break;
        }
    }
</script>
@endsection
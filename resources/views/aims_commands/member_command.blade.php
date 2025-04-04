@extends('layouts.partners.theme_partner_new')
@section('content')

<style>
    .btn-outline-delete{
        color: #db2d2e !important;
        border: none !important;
        padding: .5rem 1rem !important;
        border-radius: 5px !important;
    }.btn-outline-delete:hover{
        background-color: #db2d2e !important;
        color: #fff !important;

    }
    div {
        font-family: 'Mitr', sans-serif;
    }
    label {
    width: 100%;
    font-size: 1rem;
    }
    .card-input-element+.card {
        height: calc(36px + 2*1rem);
        color: #0d6efd;
        -webkit-box-shadow: none;
        box-shadow: none;
        border: 2px solid transparent;
        border-radius: 10px;
        outline: #0d6efd 1px solid;
    }

    .card-input-element+.card:hover {
        cursor: pointer;
    }

    .card-input-element:checked+.card {
        border: 2px solid #0d6efd;
        color: #fff !important;
        background-color: #0d6efd !important;
        -webkit-transition: border .3s;
        -o-transition: border .3s;
        transition: border .3s;
    }

    .card-input-element:checked+.card::after {
        content: '\f00c';
        color: #AFB8EA;
        font-family: 'Font Awesome\ 5 Free';
        font-weight: 900; /* Fix version 5.0.9 */
        font-size: 24px;
        -webkit-animation-name: fadeInCheckbox;
        animation-name: fadeInCheckbox;
        -webkit-animation-duration: .5s;
        animation-duration: .5s;
        -webkit-animation-timing-function: cubic-bezier(0.4, 0, 0.2, 1);
        animation-timing-function: cubic-bezier(0.4, 0, 0.2, 1);
    }

    @-webkit-keyframes fadeInCheckbox {
        from {
            opacity: 0;
            -webkit-transform: rotateZ(-20deg);
        }

        to {
            opacity: 1;
            -webkit-transform: rotateZ(0deg);
        }
    }

    @keyframes fadeInCheckbox {
        from {
            opacity: 0;
            transform: rotateZ(-20deg);
        }

        to {
            opacity: 1;
            transform: rotateZ(0deg);
        }
    }

    .card-input-red{
        outline: #db2d2e 1px solid !important;
        width: 100% !important;
    }
    .card-input-red:checked+.card {
        

        border: 2px solid #db2d2e !important;
        background-color: #db2d2e !important;
        color: #fff !important;
        -webkit-transition: border .3s;
        -o-transition: border .3s;
        transition: border .3s;
    }
    .btn-close-modal{
        position: absolute;
        top: 1rem;
        right: 1rem;
        z-index: 99;
    }
    .text-nocopy {
      -webkit-user-select: none;   
      -moz-user-select: none;     
      -ms-user-select: none;   
      user-select: none;          
    }.customers-list {
        height: auto !important;
    }
    .badge-offline {
        background-color: #817e81;
        font-size: 11px;
        width: 10px;
        height: 10px;
        border-radius: 50%; 
        
    }


    .badge-online {
        background-color: #11c77c;
        font-size: 11px;
        width: 10px;
        height: 10px;
        border-radius: 50%; animation-name: wave;
        animation-duration: 1s;
        animation-timing-function: linear;
        animation-iteration-count: infinite;
        
    }
    .badge-online + .textStatusOffilcer{
        color: #11c77c;
    }
    @keyframes wave {
        0% {box-shadow: 0 0 0px 0px rgb(17, 199, 124 , 0.5);}
        100% {box-shadow: 0 0 0px 10px rgba(245, 66, 78, 0);}
    }

    .badge-busy {
        background-color: #f5424e;
        font-size: 11px;
        width: 10px;
        height: 10px;
        border-radius: 50%; animation-name: busy;
        animation-duration: 1s;
        animation-timing-function: linear;
        animation-iteration-count: infinite;
        
    }
    .badge-busy + .textStatusOffilcer{
        color: #f5424e;
    }
    @keyframes busy {
        0% {box-shadow: 0 0 0px 0px rgb(245, 66, 78 ,0.5);}
        100% {box-shadow: 0 0 0px 10px rgba(245, 66, 78, 0);}
    }

    .textStatusOffilcer{
        margin-left: 0.7rem;
    }
</style>

<div class="card radius-10">
    <div class="card-header bg-transparent row">
        <div class="col-6">
            <h4 class="mb-0 my-2 font-weight-bold">
                สมาชิกศูนย์ควบคุม
            </h4>
        </div>
        <div class="col-6">
            <button style="margin-left: 10px;margin-right: 10px;" type="button" class="btn btn-white radius-10 float-end ms-auto" data-toggle="modal" data-target="#exampleModal">
                <i class="bx bx-user-plus"></i>สร้างบัญชีผู้ใช้ใหม่
            </button>
        </div>
    </div>
    <div class="table-responsive p-3">
        <table class="table mb-0">
            <thead>
                <tr class="text-center">
                    <th>พื้นที่</th>
                    <th>ลำดับ</th>
                    <th>เจ้าหน้าที่</th>
                    <th>สถานะ</th>
                    @if( $officer_role != "operator-area")
                        <th>จัดการ</th>
                    @endif
                </tr>
            </thead>
            <tbody>
                @foreach( $member_commands as $item )
                    <tr>
                        <td>
                            <div class="mt-3 d-flex align-items-center justify-content-center">
                                <span class=""><b>{{ $item->name_area }}</b></span> 
                            </div>
                        </td>
                        <td>
                            <div class="mt-3 d-flex align-items-center justify-content-center">
                                <span class="">{{ $item->number }}</span> 
                            </div>
                        </td>
                        <td>
                            <div class="customers-list">
                                <div class="customers-list-item d-flex align-items-center p-2 cursor-pointer">
                                    <div class="">
                                        @if(!empty($item->user_photo))
                                            <img src="{{ url('/storage') .'/'. $item->user_photo  }}"  class="rounded-circle" width="46" height="46" alt="">
                                        @else
                                            <img src="{{ url('/partner/images/user/profile.png') }}"  class="rounded-circle" width="46" height="46" alt="">
                                        @endif
                                    </div>
                                    <div class="ms-2">
                                        <h6 class="mb-1 font-15"><b>{{ $item->name_officer_command }}</b></h6>
                                        <p class="mb-0 font-14 text-secondary">
                                            @if( $item->officer_role == "admin-area" )
                                                แอดมินพื้นที่
                                            @elseif( $item->officer_role == "operator-area" )
                                                เจ้าหน้าที่สั่งการ
                                            @endif
                                        </p>
                                        <p class="mb-0 font-13 text-secondary">{{ $item->user_phone }}</p>
                                    </div>
                                </div>
                            </div>
                        </td>
                        @if( $item->status == "Standby" )
                            <td>
                                <div class="mt-3 d-flex align-items-center justify-content-center">
                                    <div class="badge-online"></div> 
                                    <span class="textStatusOffilcer">พร้อมช่วยเหลือ</span> 
                                </div>
                            </td>
                        @elseif( $item->status == "Helping" )
                            <td>
                                <div class="mt-3 d-flex align-items-center justify-content-center">
                                    <div class="badge-busy"></div> 
                                    <span class="textStatusOffilcer" style="color: #f5424e;">กำลังช่วยเหลือ</span> 
                                </div>
                            </td>
                        @else
                            <td>
                                <div class="mt-3 d-flex align-items-center justify-content-center">
                                    <div class="badge-offline"></div> 
                                    <span class="textStatusOffilcer">ไม่อยู่</span> 
                                </div>
                            </td>
                        @endif

                        @if( $officer_role != "operator-area")
                        <td style="width: 1%; white-space: nowrap;" class="text-center">
                            <button class="btn-outline-delete">
                                <i class="fa-solid fa-trash-can"></i> ยกเลิกสถานะ
                            </button>
                        </td>
                        @endif
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

@endsection

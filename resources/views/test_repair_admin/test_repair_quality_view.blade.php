@extends('layouts.partners.theme_partner_new')
<style>
    *:not(i) {
        font-family: 'Kanit', sans-serif;

    }

    .status-repair {
        position: absolute;
        top: 40px;
        right: 10px;
        transform: translate(-50%, -50%);
    }  .overflow {
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
        width: calc(100% - 80px);

    }
    .overflow-2 {
        display: -webkit-box;
        -webkit-line-clamp: 2;
        -webkit-box-orient: vertical;
        overflow: hidden;
        text-overflow: ellipsis;
    }
/* 
    .overflow:hover {
        white-space: normal; 
        overflow: visible; 
        text-overflow: unset; 
    } */
</style>

@section('content')
<div class="container-fluid">
    <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
        <div class="breadcrumb-title pe-3">การประเมินคุณภาพการซ่อม</div>
        <div class="ps-3">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0 p-0">
                    <li class="breadcrumb-item"><a href="javascript:;">เจ้าหน้าที่</a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">{ name_officer }</li>
                </ol>
            </nav>
        </div>
        <div class="ms-auto">
            <span class="d-flex align-items-center justify-content-between btn btn-success radius-10 px-4" style="cursor: text;">ดำเนินการทั้งหมด&nbsp;&nbsp;
                <b style="font-size: 25px;">278</b>
            </span>

        </div>
    </div>
    <div class="row row-cols-1 row-cols-md-2 row-cols-lg-2 row-cols-xl-4">
     
        <div class="col">
            <div class="card radius-15">
                <div class="card-body text-center">
                    <div class="p-4 border radius-15">
                        <span class="badge bg-danger status-repair">แจ้งซ่อม</span>
                        <img src="{{url('img/stickerline/PNG/1.png')}}" width="110" height="110" class="rounded-circle shadow" alt="" style="object-fit: cover;">
                        <h5 class="mb-0 mt-2"><b>{name_user}</b></h5>
                        <p class="mb-3 mt-0">{date}</p>
                        <div class="d-flex w-100 ">
                            <dt class="me-1">ซ่อมบำรุง : </dt>
                            <dd class="overflow">คอมพิวเตอร์คอมพิวเตอร์คอมพิวเตอร์คอมพิวเตอร์คอมพิวเตอร์คอมพิวเตอร์คอมพิวเตอร์คอมพิวเตอร์คอมพิวเตอร์คอมพิวเตอร์คอมพิวเตอร์คอมพิวเตอร์</dd>
                        </div>
                       
                        <div class=" overflow-2">
                            <span class="me-1 "><b>รายละเอียด : </b></ห>
                            <span class="">เปิดไม่ติดเปิดไม่ติดเปิดไม่ติดเปิดไม่ติดเปิดไม่ติดเปิดไม่ติดเปิดไม่ติดเปิดไม่ติดเปิดไม่ติดเปิดไม่ติดเปิดไม่ติดเปิดไม่ติดเปิดไม่ติด</ห>
                        </div>
                        <hr>
                        <div class="d-flex align-items-center">
                            <div class="fm-file-box bg-light-primary text-primary"><i class="fa-duotone fa-solid fa-medal"></i>
                            </div>
                            <div class="flex-grow-1 ms-2">
                                <h6 class=" text-start mb-0"><b>คุณภาพ</b></h6>
                                <div class="d-flex">
                                    <i class="fa-solid fa-star" style="color:#FFD058"></i>
                                    <i class="fa-solid fa-star" style="color:#FFD058"></i>
                                    <i class="fa-solid fa-star" style="color:#FFD058"></i>
                                    <i class="fa-solid fa-star" style="color:#FFD058"></i>
                                    <i class="fa-solid fa-star" style="color:#FFD058"></i>
                                </div>
                            </div>
                            <h6 class="text-primary mb-0">5 คะแนน</h6>
                        </div>
                        <div class="d-flex align-items-center mt-3">
                            <div class="fm-file-box bg-light-success text-success"><i class="fa-solid fa-person-running-fast"></i>
                            </div>
                            <div class="flex-grow-1 ms-2">
                                <h6 class=" text-start mb-0"><b>ความเร็ว</b></h6>
                                <div class="d-flex">
                                    <i class="fa-solid fa-star" style="color:#FFD058"></i>
                                    <i class="fa-solid fa-star" style="color:#FFD058"></i>
                                    <i class="fa-solid fa-star" style="color:#FFD058"></i>
                                    <i class="fa-solid fa-star" style="color:#FFD058"></i>
                                    <i class="fa-duotone fa-star" style="color:#FFD058"></i>
                                </div>
                            </div>
                            <h6 class="text-primary mb-0">4 คะแนน</h6>
                        </div>
                        <div class="d-flex align-items-center mt-3">
                            <div class="fm-file-box bg-light-danger text-danger"><i class="fa-solid fa-face-smile-beam"></i>
                            </div>
                            <div class="flex-grow-1 ms-2">
                                <h6 class=" text-start mb-0"><b>พึงพอใจ</b></h6>
                                <div class="d-flex">
                                    <i class="fa-solid fa-star" style="color:#FFD058"></i>
                                    <i class="fa-solid fa-star" style="color:#FFD058"></i>
                                    <i class="fa-solid fa-star" style="color:#FFD058"></i>
                                    <i class="fa-duotone fa-star" style="color:#FFD058"></i>
                                    <i class="fa-duotone fa-star" style="color:#FFD058"></i>
                                </div>
                            </div>
                            <h6 class="text-primary mb-0">3 คะแนน</h6>
                        </div>
                        <div class="d-flex align-items-center mt-3">
                            <div class="fm-file-box bg-light-info text-info"><i class="fa-solid fa-stars"></i>
                            </div>
                            <div class="flex-grow-1 ms-2">
                                <h6 class=" text-start mb-0"><b>รวม</b></h6>
                                <div class="d-flex">
                                    <i class="fa-solid fa-star" style="color:#FFD058"></i>
                                    <i class="fa-solid fa-star" style="color:#FFD058"></i>
                                    <i class="fa-solid fa-star" style="color:#FFD058"></i>
                                    <i class="fa-solid fa-star" style="color:#FFD058"></i>
                                    <i class="fa-duotone fa-star" style="color:#FFD058"></i>
                                </div>
                            </div>
                            <h6 class="text-primary mb-0">4 คะแนน</h6>
                        </div>
                        <a class="btn btn-outline-primary w-100 mt-3" href="{{url('/demo_detail_repair_quality')}}">
                            ดูเพิ่มเติม
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@extends('layouts.news')

@section('meta')
<meta charset="UTF-8">
<meta name="description" content="HVAC Template">
<meta name="keywords" content="HVAC, unica, creative, html">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta http-equiv="X-UA-Compatible" content="ie=edge">
<link rel="shortcut icon" href="{{ asset('/img/logo/logo_x-icon.png') }}" type="image/x-icon" />
<!-- CSRF Token -->
<meta name="csrf-token" content="{{ csrf_token() }}">

<title>viicheck News</title>
@endsection

@section('content')
<br>
<div class="container">
    <div class="row">
        <div class="col-12 col-md-12">
            <div style="border : none;" class="card">
                <div class="row">
                    <div class="col-md-6">
                        <h4 style="padding-top: 7px;" class="text-info">ข่าวของฉัน</h4>
                    </div>
                    <div class="col-12 col-md-6">
                        <div class="btn-group float-right " role="group" aria-label="Basic example">
                            <a href="{{ url('/news') }}" style="background-color: #d62e31;color: #fff" class="btn btn-sm"><i class="far fa-newspaper"></i> &nbsp;ข่าวทั้งหมด</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<br>

<!-- ข่าวของฉัน -->
<div id="all_news" class="container">
    <br>
    <div class="row">
        @foreach($my_news as $item)
        <div class="col-12 col-md-4">
            <div class="card" style="width: 22rem;">
                <img src="{{ url('/') .'/'. $item->cover_photo }}" class="card-img-top" >
                <div class="card-body">
                    <!-- <h5 class="card-title">Card title</h5> -->
                    <p style="display: -webkit-box;-webkit-line-clamp: 2;-webkit-box-orient: vertical;overflow: hidden;" class="card-text">{{ $item->content }}</p>
                    <hr>
                    <p><b>REPORTER :</b> {{ $item->name }}</p>
                    <a class="text-danger">Report : {{ $item->report }}</a>
                    <!-- <a href="#" class="btn btn-primary float-right">อ่านเพิ่มเติม..</a> -->
                    <a href="{{ url('/news/' . $item->id) }}" title="อ่านเพิ่มเติม.."><button class="float-right btn btn-primary btn-sm"><i class="fa fa-eye" aria-hidden="true"></i> อ่านเพิ่มเติม..</button></a>
                </div>
            </div>
            <br>
        </div>
        @endforeach
    </div>
    <hr>
</div>
@endsection

@extends('layouts.viicheck')

@section('content')

<style>

    body{
        font-family: Helvetica;
        -webkit-font-smoothing: antialiased;
        background: rgba( 71, 147, 227, 1);
    }


    /* Table Styles */

    .table-wrapper{
        margin: 10px 70px 70px;
        box-shadow: 0px 35px 50px rgba( 0, 0, 0, 0.2 );
        
    }

    .fl-table {
        border-radius: 5px;
        font-size: 12px;
        font-weight: normal;
        border: none;
        border-collapse: collapse;
        width: 100%;
        max-width: 100%;
        white-space: nowrap;
        background-color: white;
    }

    .fl-table td, .fl-table th {
        text-align: center;
        padding: 8px;
        font-size: 18px;
        
    }

    .fl-table td {
        border-right: 1px solid #f8f8f8;
        font-size: 18px;
    }

    .fl-table thead th {
        color: #ffffff;
        background: #324960;
    }


    .fl-table thead th:nth-child(odd) {
        color: #ffffff;
        background: #324960;
    }

    .fl-table tr:nth-child(even) {
        background: #F8F8F8;
    }

    /* Responsive */
</style>
<br><br><br><br><br><br><br>
    <div class="container">
        <div class="row">
            <div class="col-md-12 p-md-0">
                <div class="card">
                    <div class="card-header">
                        <h3 style="margin-top:5px;">ราคากลางกรมขนส่งทางบก
                            <img id="img_show_car" style="float:right;" width="40" src="{{ url('/img/icon/menu_car.png' ) }}">
                            
                        </h3>
                                          

                        <!--<form method="GET" action="{{ url('/middle_price_car') }}" accept-charset="UTF-8" class="form-inline my-2 my-lg-0 float-right" role="search">
                                <div class="input-group">
                                    <input type="text" class="form-control" name="search" placeholder="Search..." value="{{ request('search') }}">
                                    <span class="input-group-append">
                                        <button class="btn btn-secondary" type="submit">
                                            <i class="fa fa-search"></i>
                                        </button>
                                    </span>
                                </div>
                            </form>-->
                            
                        <a href="{{ url('/middle_price_car/create') }}" class="d-none float-right btn btn-success btn-sm" title="Add New Middle_price_car">
                                <i class="fa fa-plus" aria-hidden="true"></i> Add New
                            </a>
                        
                    </div><br>
                        <div class="col-md-12">
                                <button id="btn_car" class="btn btn-outline-danger;" style="width: 125px;">
                                    <a id="btn_a_car" href="{{ url('/middle_price_car' ) }}">รถยนต์</a>
                                </button>
                                <button id="btn_motorcycle" class="btn btn-outline-danger" >
                                    <a id="btn_a_motorcycle" href="{{ url('/middle_price_motorcycle' ) }}">รถจักรยานยนต์</a>
                                </button>
                        </div>
                        <br>
                    <div class="row" style="margin-left: 2px;">
                            <div class="col-sm-3 col-12" > 
                            <form action="{{URL::to('/middle_price_car')}}" method="get">
                                <select name="brand" class=" form-control notranslate" id="input_car_brand"  onchange="showCar_model();
                                    if(this.value=='อื่นๆ'){ 
                                        document.querySelector('#brand_input').classList.remove('d-none'),
                                        document.querySelector('#generation_input').classList.remove('d-none'),
                                        document.querySelector('#brand_input').focus();
                                    }else{ 
                                        document.querySelector('#brand_input').classList.add('d-none'),
                                        document.querySelector('#generation_input').classList.add('d-none');}">
                                        ;}">
                                    @if(!empty($xx))
                                        @foreach($xx as $item)
                                        <option value="{{ $item->brand }}" selected>{{ $item->brand }}</option>
                                        @endforeach
                                    @else
                                        <option class="translate" value="" selected>All car brands</option> 
                                    @endif
                                   
                                    {!! $errors->first('brand', '<p class="help-block">:message</p>') !!}
                                </select>
                            </div>

                            <div class="col-sm-3 col-12"> 
                            <br class="d-block d-md-none">
                            <select name="model" id="input_car_model" class=" form-control notranslate"  onchange="if(this.value=='อื่นๆ'){ 
                                        document.querySelector('#model_input').classList.remove('d-none'),
                                        document.querySelector('#model_input').focus();
                                    }else{ 
                                        document.querySelector('#model_input').classList.add('d-none');}">
                                    <option class="translate" value="" selected>All car models</option>     
                                        
                                        {!! $errors->first('model', '<p class="help-block">:message</p>') !!}             
                                </select>
                            </div>
                           
                            <div class="col-sm-3 col-12"> 
                               <br class="d-block d-md-none">  <input class="form-control" type="text" name="submodel" id="submodel" placeholder="Submodel" value="{{ request('sub_model') }}">
                            </div>
                            <div class="col-sm-3 col-12 p-md-0" > <br class="d-block d-md-none">
                            <button type="submit" style="font-size: 1em; color:#fff" class="btn btn-danger btn-sm "> ค้นหา  </button>
                            <a class="btn btn-danger btn-sm"  style="font-size: 1em; color:#fff" href="{{URL::to('/middle_price_car')}}" >ล้างการค้นหา  </a>
                            </div>
                        </form>
                    </div>
          
                    <!-- <div class="col-11 col-md-11" style="margin-top:-20px;">
                            <ul class="nav nav-pills nav-pills-danger mt-4"   role="tablist" >
                                    <li class="nav-item" >
                                        <a class="active btn btn-outline-danger" href="#" role="tab" data-toggle="tab" style=" width: 115px;" onclick="
                                            document.querySelector('#show_car').classList.remove('d-none'),
                                            document.querySelector('#show_mortor').classList.add('d-none');">
                                            <b style="font-size: 15px; text-align: center;">รถยนต์</b>
                                        </a>
                                    </li>
                                    &nbsp;&nbsp;
                                    <li class="nav-item ">
                                        <a class="btn btn-outline-danger" href="#" role="tab" data-toggle="tab" onclick="
                                                document.querySelector('#show_car').classList.add('d-none'),
                                                document.querySelector('#show_mortor').classList.remove('d-none');">
                                        <b style="font-size: 15px;text-align: center;">รถจักรยานยนต์</b>
                                        </a>
                                    </li>
                                </ul>
                            </div> -->
                           
                        
             
                            <!----------------------------------------------------------mobile--------------------------------------------------------->
                            
                            <br class="d-block d-md-none">
                        <div id="show_car">
                            <div class="d-block d-md-none">
                                @foreach($Middle_price_car as $item)
                                    <div class="row" style="margin-top:10px">
                                        <div class="col-10 card main-shadow" style="margin-left:30px; border-radius: 20px 20px 0px 0px;padding: 7px;">
                                            <div class="row ">    
                                                <div class="col-3 ">
                                                    <img style="margin-top:15px;" width="50"src="{{ asset('/img/logo_brand/logo-') }}{{ strtolower($item->brand) }}.png">
                                                </div>
                                                <div class="col-9 notranslate">
                                                    <h5 style="margin-bottom:0px">&nbsp;<b>{{ $item->brand }}</b></h5>
                                                    <p style="margin-bottom:0px; margin-left:5px;">{{ $item->model }} , {{ $item->submodel }}</p>
                                                    <p style="margin-bottom:0px">&nbsp;ปี {{ $item->year }} </p>
                                                </div>
                                            </div>
                                        </div>
                                        <br>

                                        <div class="col-10 card main-shadow" style="margin-left:30px; border-radius: 0px 0px 20px 20px; padding:6.5px; ">
                                            @php
                                                $price_2 = "";

                                                $price_explode = explode("-",$item->price);
                                                $price_1 = $price_explode[0];

                                                    if (!empty($price_explode[1])) {
                                                        $price_2 = $price_explode[1];
                                                    }
                                            @endphp
                                            @if($price_2 != "")
                                                <center><td><b style="color: #FF0000;font-size: 17px;">{{ number_format($price_1) }} - {{ number_format($price_2) }} บาท</b></td></center>
                                            @else
                                            <center><td><b style="color: #FF0000;font-size: 17px;">{{ number_format($price_1) }} บาท</b></td></center>
                                            @endif
                                        </div>
                                    </div>
                                @endforeach
                                <br>
                                <div class="colpagination-wrapper"> 
                                        {!! $Middle_price_car->appends([
                                        'motor_brand' => Request::get('motor_brand'),
                                        'motor_generation' => Request::get('motor_generation'),
                                        'submodel' => Request::get('submodel'),
                                        ])->render() !!} 
                                    </div>
                            </div>
                                
                                <!---------------------------------------------pc--------------------------------------------------------->
                                <br>
                                <div class="table-responsive d-none d-sm-block p-md-0">
                                    <table class="fl-table">
                                        <thead>
                                            <tr>
                                                <th>ยี่ห้อ</th>
                                                <th>รุ่น</th>
                                                <th>รุ่นย่อย</th>
                                                <th>ปี</th>
                                                <th>ราคา</th>
                                                <th class="d-none">Actions</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($Middle_price_car as $item)
                                                <tr>
                                                    <td class="notranslate">{{ $item->brand }}</td>
                                                    <td class="notranslate">{{ $item->model }}</td>
                                                    <td class="notranslate">{{ $item->submodel }}</td>
                                                    <td class="notranslate">{{ $item->year }}</td>
                                                    
                                            @php
                                                $price_2 = "";

                                                $price_explode = explode("-",$item->price);
                                                $price_1 = $price_explode[0];

                                                    if (!empty($price_explode[1])) {
                                                        $price_2 = $price_explode[1];
                                                    }
                                            @endphp

                                                    @if($price_2 != "")
                                                        <td style="text-align: right;">{{ number_format($price_1) }} - {{ number_format($price_2) }} บาท</td>
                                                    @else
                                                        <td style="text-align: right;">{{ number_format($price_1) }} บาท</td>
                                                    @endif
                                                
                                                    <td class="d-none">
                                                        <a href="{{ url('/middle_price_car/' . $item->id) }}" title="View Middle_price_car"><button class="btn btn-info btn-sm"><i class="fa fa-eye" aria-hidden="true"></i> View</button></a>
                                                        <a href="{{ url('/middle_price_car/' . $item->id . '/edit') }}" title="Edit Middle_price_car"><button class="btn btn-primary btn-sm"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit</button></a>

                                                        <form method="POST" action="{{ url('/middle_price_car' . '/' . $item->id) }}" accept-charset="UTF-8" style="display:inline">
                                                            {{ method_field('DELETE') }}
                                                            {{ csrf_field() }}
                                                            <button type="submit" class="btn btn-danger btn-sm" title="Delete Middle_price_car" onclick="return confirm(&quot;Confirm delete?&quot;)"><i class="fa fa-trash-o" aria-hidden="true"></i> Delete</button>
                                                        </form>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>                             
                                    </table>
                                    <br>
                                    <div class="colpagination-wrapper"> 
                                        {!! $Middle_price_car->appends([
                                        'motor_brand' => Request::get('motor_brand'),
                                        'motor_generation' => Request::get('motor_generation'),
                                        'submodel' => Request::get('submodel'),
                                        ])->render() !!} 
                                    </div>
                                </div> 
                        </div> 

                    <br>
                </div><br>
            </div>
        </div>
    </div>

<script>
document.addEventListener('DOMContentLoaded', (event) => {
        // console.log("START");
        showCar_brand(); 
    });
    function showCar_brand(){
        //PARAMETERS
        fetch("{{ url('/') }}/api/brand_middle_price")
            .then(response => response.json())
            .then(result => {
                // console.log(result);
                //UPDATE SELECT OPTION
                // let input_car_brand = document.querySelector("#input_car_brand");
                    // input_car_brand.innerHTML = "";

                for(let item of result){
                    let option = document.createElement("option");
                    option.text = item.brand;
                    option.value = item.brand;
                    input_car_brand.add(option);
                }
                let option = document.createElement("option");
                    option.text = "อื่นๆ";
                    option.value = "อื่นๆ";
                    input_car_brand.add(option); 

                    let option_class = document.createAttribute("class");
                        option_class.value = "translate";
                     
                    option.setAttributeNode(option_class); 

                //QUERY model
                showCar_model();
            });
            return input_car_brand.value;
    }
    function showCar_model(){
        // console.log(input_car_model.options.length);
        while (input_car_model.options.length > 1) {
                input_car_model.remove(1);
            } 
        let input_car_brand = document.querySelector("#input_car_brand");
        fetch("{{ url('/') }}/api/brand_middle_price/"+input_car_brand.value+"/model")
            .then(response => response.json())
            .then(result => {
                // console.log(result);
                // //UPDATE SELECT OPTION
                // let input_car_model = document.querySelector("#input_car_model");
                //     input_car_model.innerHTML = "";
                for(let item of result){
                    let option = document.createElement("option");
                    option.text = item.model;
                    option.value = item.model;
                    input_car_model.add(option);                
                } 
                let option = document.createElement("option");
                    option.text = "other";
                    option.value = "other";
                    input_car_model.add(option);  
            });
    }
    document.addEventListener('DOMContentLoaded', (event) => {
        console.log("START");
        add_color();
        
    });
    function add_color(){
        console.log("add_color");
        document.querySelector('#btn_car').classList.add('btn-danger');
        document.querySelector('#btn_car').classList.remove('btn-outline-danger');
        document.querySelector('#btn_a_car').classList.add('text-white');
        document.querySelector('#btn_a_car').classList.remove('text-danger');
    }

</script>
@endsection
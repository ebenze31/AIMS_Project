
<div id="div_organization" class="">
    <span style="font-size: 22px;" class="control-label">{{ 'ข้อมูลองค์กร' }}</span><span style="color: #FF0033;"> *<br><br></span>

    @if(empty($organization))
        <div id="empty_juristicID">
            <div class="row" id="div_selest_organization_1">
                <div class="col-12 col-md-4">
                    <label  class="control-label">{{ 'เลขทะเบียนนิติบุคคล' }}</label><span style="color: #FF0033;"> *</span>
                </div>
            </div>
            <div class="row" id="div_selest_organization_2">
                <div class="col-12 col-md-4">
                    <div class="form-group">
                        <input class="form-control" name="selest_organization" type="text" id="selest_organization" value=""  pattern="[0-9]{13}" onchange="change_selest_organization();" placeholder="เลขทะเบียนนิติบุคคล">
                    </div>
                </div>
                <div class="col-12 col-md-4">
                    @if(!empty(Auth::user()->role))
                    <div class="form-group">
                        <button type="button" class="btn btn-success" onclick="click_btn_organization_new();">ลงทะเบียนองค์กรใหม่</button>
                    </div>
                    @endif
                </div>
            </div>
            <div id="div_input_juristicID" class="d-none">
                <div class="row">
                    <div class="col-12 col-md-4">
                        <label  class="control-label">{{ 'เลขทะเบียนนิติบุคคล' }}</label><span style="color: #FF0033;"> *</span>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12 col-md-4">
                        <div class="form-group {{ $errors->has('juristicID') ? 'has-error' : ''}}">
                            <input class="form-control" name="juristicID" type="text" id="juristicID" value="{{ isset($register_car->juristicID) ? $register_car->juristicID :  '' }}"  pattern="[0-9]{13}" onchange="juristic();" placeholder="เลขทะเบียนนิติบุคคล">
                            {!! $errors->first('juristicID', '<p class="help-block">:message</p>') !!}
                        </div>
                    </div>
                    <div class="col-12 col-md-4">
                        <div class="form-group text-success">
                            <div id="div_spinner" class="d-none">
                                <div class="spinner-border text-success"></div> &nbsp;&nbsp;กำลังตรวจสอบ..
                            </div>
                            <div id="div_wrong" class="text-danger d-none">
                                <i class="fas fa-times-circle"></i>&nbsp;&nbsp;ไม่พบข้อมูล กรุณาตรวจสอบความถูกต้อง
                            </div> 
                            <div id="div_not_open" class="text-danger d-none">
                                <i class="fas fa-times-circle"></i>&nbsp;&nbsp;กิจการไม่ได้ดำเนินการอยู่
                            </div> 
                        </div>
                    </div>
                </div>
            </div>

            <div id="div_data_organization" class="d-none data_organization">
                <div class="row">
                    <div class="col-12 col-md-4 d-none d-lg-block">
                        <label  class="control-label">{{ 'ชื่อองค์กร' }}</label><span style="color: #FF0033;"> *</span>
                    </div>
                    <div class="col-12 col-md-4 d-none d-lg-block">
                        <label  class="control-label">{{ 'อำเภอ' }}</label><span style="color: #FF0033;"> *</span>
                    </div>
                    <div class="col-12 col-md-4 d-none d-lg-block">
                        <label  class="control-label">{{ 'จังหวัด' }}</label><span style="color: #FF0033;"> *</span>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12 col-md-4">
                        <div class="form-group {{ $errors->has('juristicNameTH') ? 'has-error' : ''}}">
                            <input class="form-control" name="juristicNameTH" type="text" id="juristicNameTH" value="{{ isset($not_comfor->juristicNameTH) ? $not_comfor->juristicNameTH : ''}}"  placeholder="ชื่อองค์กร" readonly>
                            {!! $errors->first('juristicNameTH', '<p class="help-block">:message</p>') !!}
                        </div>
                    </div>
                    <div class="col-12 col-md-4">
                        <div class="form-group {{ $errors->has('location_A_2') ? 'has-error' : ''}}">
                            <input class="form-control" name="location_A_2" type="text" id="location_A_2" value="{{ isset($register_car->location_A_2) ? $register_car->location_A_2 :  '' }}"  placeholder="อำเภอ"readonly>
                            {!! $errors->first('location_A_2', '<p class="help-block">:message</p>') !!}
                        </div>
                    </div>
                    <div class="col-12 col-md-4">
                        <div class="form-group {{ $errors->has('location_P_2') ? 'has-error' : ''}}">
                            <input class="form-control" name="location_P_2" type="text" id="location_P_2" value="{{ isset($register_car->location_P_2) ? $register_car->location_P_2 :  '' }}"  placeholder="จังหวัด" onchange="change_location_2();"readonly>
                            {!! $errors->first('location_P_2', '<p class="help-block">:message</p>') !!}
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12 col-md-4 d-none d-lg-block">
                        <label  class="control-label">{{ 'อีเมล' }}</label><span style="color: #FF0033;"> *</span>
                    </div>
                    <div class="col-12 col-md-4 d-none d-lg-block">
                        <label  class="control-label">{{ 'เบอร์โทรศัพท์' }}</label><span style="color: #FF0033;"> *</span>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12 col-md-4">
                        <div class="form-group {{ $errors->has('organization_mail') ? 'has-error' : ''}}">
                            <input class="form-control" name="organization_mail" type="email" id="organization_mail" value="{{ isset($register_car->organization_mail) ? $register_car->organization_mail :  '' }}"   placeholder="อีเมล">
                            {!! $errors->first('organization_mail', '<p class="help-block">:message</p>') !!}
                        </div>
                    </div>
                    <div class="col-12 col-md-4">
                        <div class="form-group {{ $errors->has('phone_2') ? 'has-error' : ''}}">
                            <input class="form-control" name="phone_2" type="phone_2" id="phone_2" value="{{ $juristicPhone }}"  placeholder="กรุณาใส่เบอร์ติดต่อ" pattern="[0-9]{9-10}">
                            {!! $errors->first('phone_2', '<p class="help-block">:message</p>') !!}
                        </div>
                    </div>
                </div>
                <input type="checkbox" name="checkbox" onchange="if(this.checked){
                            document.querySelector('#show_branch_empty').classList.remove('d-none');
                            show_location_P_branch();
                        }else{
                            document.querySelector('#show_branch_empty').classList.add('d-none'); 
                            clear_input();
                        }">&nbsp;&nbsp;&nbsp;ไม่ใช่สำนักงานใหญ่
                <br><br>

                <div id="show_branch_empty" class="row d-none">
                    <div class="col-12 col-md-4">
                        <div class="form-group {{ $errors->has('branch') ? 'has-error' : ''}}">
                            <input class="form-control" name="branch" type="text" id="branch" value="{{ isset($register_car->branch) ? $register_car->branch :  '' }}"  placeholder="สาขา">
                            {!! $errors->first('branch', '<p class="help-block">:message</p>') !!}
                        </div>
                    </div>
                    <div class="col-12 col-md-4">
                        <div class="form-group {{ $errors->has('branch_province') ? 'has-error' : ''}}">
                            <select name="branch_province" id="branch_province" class="form-control"  onchange="show_location_A_branch();change_location_branch();">
                                    <option value="" selected > - กรุณาเลือกจังหวัด - </option> 
                            </select>
                            {!! $errors->first('branch_province', '<p class="help-block">:message</p>') !!}
                        </div>
                    </div>
                    <div class="col-12 col-md-4">
                        <div class="form-group {{ $errors->has('branch_district') ? 'has-error' : ''}}">
                            <select name="branch_district" id="branch_district" class="form-control" >
                                    <option value="" selected > - กรุณาเลือกอำเภอ - </option> 
                                                                       
                            </select>
                            {!! $errors->first('branch_district', '<p class="help-block">:message</p>') !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endif

    @if(!empty($organization))
        <div id="not_empty_juristicID">
            <!-- <div class="row">
                <div class="col-12 col-md-4 d-none d-lg-block">
                    <label  class="control-label">{{ 'เลขทะเบียนนิติบุคคล' }}</label><span style="color: #FF0033;"> *</span>
                </div>
            </div>
            <div class="row">
                <div class="col-12 col-md-4">
                    <div class="form-group {{ $errors->has('juristicID') ? 'has-error' : ''}}">
                        <input class="form-control" name="juristicID" type="text" id="juristicID" value=""  pattern="[0-9]{13}" readonly>
                        {!! $errors->first('juristicID', '<p class="help-block">:message</p>') !!}
                    </div>
                </div>
            </div> -->
            @foreach
            <div class="row">
                <div class="col-12 col-md-4 d-none d-lg-block">
                    <label  class="control-label">{{ 'ชื่อองค์กร' }}</label><span style="color: #FF0033;"> *</span>
                </div>
                <div class="col-12 col-md-4 d-none d-lg-block">
                    <label  class="control-label">{{ 'อำเภอ' }}</label><span style="color: #FF0033;"> *</span>
                </div>
                <div class="col-12 col-md-4 d-none d-lg-block">
                    <label  class="control-label">{{ 'จังหวัด' }}</label><span style="color: #FF0033;"> *</span>
                </div>
            </div>
            <div class="row">
                <div class="col-12 col-md-4">
                    <div class="form-group {{ $errors->has('juristicNameTH') ? 'has-error' : ''}}">
                        <input class="form-control" name="juristicNameTH" type="text" id="juristicNameTH" value="{{  }}"  readonly>
                        {!! $errors->first('juristicNameTH', '<p class="help-block">:message</p>') !!}
                    </div>
                </div>
                <div class="col-12 col-md-4">
                    <div class="form-group {{ $errors->has('location_A_2') ? 'has-error' : ''}}">
                        <input class="form-control" name="location_A_2" type="text" id="location_A_2" value="" readonly>
                        {!! $errors->first('location_A_2', '<p class="help-block">:message</p>') !!}
                    </div>
                </div>
                <div class="col-12 col-md-4">
                    <div class="form-group {{ $errors->has('location_P_2') ? 'has-error' : ''}}">
                         <input class="form-control" name="location_P_2" type="text" id="location_P_2" value=""  onchange="change_location_2();" readonly>
                        {!! $errors->first('location_P_2', '<p class="help-block">:message</p>') !!}
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-12 col-md-4 d-none d-lg-block">
                    <label  class="control-label">{{ 'อีเมล' }}</label><span style="color: #FF0033;"> *</span>
                </div>
                <div class="col-12 col-md-4 d-none d-lg-block">
                    <label  class="control-label">{{ 'เบอร์โทรศัพท์' }}</label><span style="color: #FF0033;"> *</span>
                </div>
            </div>
            <div class="row">
                <div class="col-12 col-md-4">
                    <div class="form-group {{ $errors->has('organization_mail') ? 'has-error' : ''}}">
                        <input class="form-control" name="organization_mail" type="email" id="organization_mail" value=""  readonly>
                        {!! $errors->first('organization_mail', '<p class="help-block">:message</p>') !!}
                    </div>
                </div>
                <div class="col-12 col-md-4">
                    <div class="form-group {{ $errors->has('phone_2') ? 'has-error' : ''}}">
                        <input class="form-control" name="phone_2" type="phone_2" id="phone_2" value=""  placeholder="กรุณาใส่เบอร์ติดต่อ" readonly pattern="[0-9]{9-10}">
                        {!! $errors->first('phone_2', '<p class="help-block">:message</p>') !!}
                    </div>
                </div>
            </div>
        </div>
        <!-- <label  class="control-label">{{ 'สาขา' }}</label>

        <div id="show_branch_notempty" class="row">
            <div class="col-12 col-md-4">
                <div class="form-group {{ $errors->has('branch') ? 'has-error' : ''}}">
                    <input class="form-control" name="branch" type="text" id="branch" value=""  placeholder="สาขา" readonly>
                    {!! $errors->first('branch', '<p class="help-block">:message</p>') !!}
                </div>
            </div>
            <div class="col-12 col-md-4">
                <div class="form-group {{ $errors->has('branch_province') ? 'has-error' : ''}}">
                    <input class="form-control" name="branch_province" type="text" id="branch_province" value=""  placeholder="จังหวัด" readonly>
                    {!! $errors->first('branch_province', '<p class="help-block">:message</p>') !!}
                </div>
            </div>
            <div class="col-12 col-md-4">
                <div class="form-group {{ $errors->has('branch_district') ? 'has-error' : ''}}">
                    <input class="form-control" name="branch_district" type="text" id="branch_district" value=""  placeholder="อำเภอ" readonly>
                    {!! $errors->first('branch_district', '<p class="help-block">:message</p>') !!}
                </div>
            </div>
        </div> -->
    @endif

<hr>
</div>

<script>
    
    function juristic(){
        document.querySelector('#div_data_organization').classList.add('d-none');
        document.querySelector('#div_wrong').classList.add('d-none');
        //PARAMETERS
        let juristicID = document.querySelector("#juristicID");
        let juristicNameTH = document.querySelector("#juristicNameTH");
        let location_P_2 = document.querySelector("#location_P_2");
        let location_A_2 = document.querySelector("#location_A_2");

        document.querySelector('#div_spinner').classList.remove('d-none');

        fetch("https://dataapi.moc.go.th/juristic?juristic_id="+juristicID.value)
            .then(response => response.json())
            .then(result => {
                console.log(result);

                fetch("{{ url('/') }}/api/juristic", {
                    method: 'post',
                    body: JSON.stringify(result),
                    headers: {
                        'Content-Type': 'application/json'
                    }
                }).then(function (response){
                    return response.text();
                }).then(function(text){
                    // console.log(text);
                }).catch(function(error){
                    // console.error(error);
                });

                if (result == null) {
                    document.querySelector('#div_spinner').classList.add('d-none');
                    document.querySelector('#div_wrong').classList.remove('d-none');
                }else if (result == "") {
                    document.querySelector('#div_spinner').classList.add('d-none');
                    document.querySelector('#div_wrong').classList.remove('d-none');
                }else if (result['juristicStatus'] != "ยังดำเนินกิจการอยู่") {
                    document.querySelector('#div_spinner').classList.add('d-none');
                    document.querySelector('#div_wrong').classList.add('d-none');
                    document.querySelector('#div_not_open').classList.remove('d-none');
                }
                else{ 
                    document.querySelector('#div_spinner').classList.add('d-none');
                    document.querySelector('#div_data_organization').classList.remove('d-none');
                }

                juristicNameTH.value = result['juristicNameTH'];
                location_P_2.value = result['addressDetail']['province'];
                location_A_2.value = result['addressDetail']['district'];

                let location = document.querySelector("#location");
                    location.value = result['addressDetail']['province'];

            });
    }

    // องค์กร

    function show_location_P_2(){
        fetch("{{ url('/') }}/api/location/show_location_P")
            .then(response => response.json())
            .then(result => {
                // console.log(result);
                //UPDATE SELECT OPTION
                let location_P_2 = document.querySelector("#location_P_2");
                    // location_P.innerHTML = "";

                for(let item of result){
                    let option = document.createElement("option");
                    option.text = item.province;
                    option.value = item.province;
                    location_P_2.add(option);
                }
                
            });
            
            return location_P_2.value;
    }

    function show_location_A_2(){
        let location_P_2 = document.querySelector("#location_P_2");
        fetch("{{ url('/') }}/api/location/"+location_P_2.value+"/show_location_A")
            .then(response => response.json())
            .then(result => {
                // console.log(result);
                //UPDATE SELECT OPTION
                let location_A_2 = document.querySelector("#location_A_2");
                    location_A_2.innerHTML = "";

                for(let item of result){
                    let option = document.createElement("option");
                    option.text = item.amphoe;
                    option.value = item.amphoe;
                    location_A_2.add(option);
                }
            });
            return location_A_2.value;
    }


    // สาขา
    function show_location_P_branch(){
        fetch("{{ url('/') }}/api/location/show_location_P")
            .then(response => response.json())
            .then(result => {
                // console.log(result);
                //UPDATE SELECT OPTION
                let branch_province = document.querySelector("#branch_province");
                    // location_P.innerHTML = "";

                for(let item of result){
                    let option = document.createElement("option");
                    option.text = item.province;
                    option.value = item.province;
                    branch_province.add(option);
                }
                
            });
            
            return branch_province.value;
    }

    function show_location_A_branch(){
        let branch_province = document.querySelector("#branch_province");
        fetch("{{ url('/') }}/api/location/"+branch_province.value+"/show_location_A")
            .then(response => response.json())
            .then(result => {
                // console.log(result);
                //UPDATE SELECT OPTION
                let branch_district = document.querySelector("#branch_district");
                    branch_district.innerHTML = "";

                for(let item of result){
                    let option = document.createElement("option");
                    option.text = item.amphoe;
                    option.value = item.amphoe;
                    branch_district.add(option);
                }
            });
            return branch_district.value;
    }

    function change_location_2(){
        let location = document.querySelector("#location");
        let location_P_2 = document.querySelector("#location_P_2");

        location.value = location_P_2.value;
        
    }

    function change_location_branch(){
        let location = document.querySelector("#location");
        let branch_province = document.querySelector("#branch_province");

        location.value = branch_province.value;
        
    }

    function clear_input(){
        let branch = document.querySelector("#branch");
        let branch_province = document.querySelector("#branch_province");
        let branch_district = document.querySelector("#branch_district");

        branch.value = "";
        branch_province.value = "";
        branch_district.value = "";
        
    }

    function click_btn_organization_new(){
        let div_selest_organization_1 = document.querySelector("#div_selest_organization_1");
        let div_selest_organization_2 = document.querySelector("#div_selest_organization_2");
        let selest_organization = document.querySelector("#selest_organization");

        let div_input_juristicID = document.querySelector("#div_input_juristicID");
        let juristicID = document.querySelector("#juristicID");

        div_selest_organization_1.classList.add('d-none');
        div_selest_organization_2.classList.add('d-none');
        selest_organization.classList.add('d-none');

        div_input_juristicID.classList.remove('d-none');

        juristicID.focus();

        juristicID.setAttributeNode(document.createAttribute('required'));
    }

    function change_selest_organization(){
        let selest_organization = document.querySelector("#selest_organization");
            // console.log(selest_organization.value);
        let juristicNameTH = document.querySelector("#juristicNameTH");
        let location_A_2 = document.querySelector("#location_A_2");
        let location_P_2 = document.querySelector("#location_P_2");
        let organization_mail = document.querySelector("#organization_mail");
        let phone_2 = document.querySelector("#phone_2");
        let juristicID = document.querySelector("#juristicID");

        fetch("{{ url('/') }}/api/selest_organization/"+selest_organization.value)
            .then(response => response.json())
            .then(result => {
                // console.log(result[0]);
                juristicNameTH.value = result[0].juristicNameTH;
                location_A_2.value = result[0].district;
                location_P_2.value = result[0].province;
                organization_mail.value = result[0].mail;
                phone_2.value = result[0].phone;
                juristicID.value = result[0].juristicID;

            });

        document.querySelector('#div_data_organization').classList.remove('d-none');
        organization_mail.setAttributeNode(document.createAttribute('readonly'));
        phone_2.setAttributeNode(document.createAttribute('readonly'));
    }

</script>
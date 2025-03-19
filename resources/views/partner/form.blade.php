
<div class="col-12">
    <div class="row">
        <div class="col-12">
            <div class="row">
                <div class="col-4">
                    <div class="form-group">
                        <label id="label_juristicID" class="control-label">{{ 'เลขทะเบียนนิติบุคคล' }}</label>
                        <input class="form-control" name="juristicID" type="text" id="juristicID" value="" pattern="[0-9]{13}">

                        <a href="{{ url('/partner_viicheck/create') }}" id="btn_re_id" style="margin-top: 7px;" class="btn byn-sm btn-success text-white d-none">
                        สร้างด้วยเลขทะเบียนนิติบุคคล
                    </a>
                    </div>
                </div>
                <div class="col-8">
                    <br>
                    <a id="btn_check_juristic" style="margin-top: 7px;" class="btn byn-sm btn-success text-white" onclick="juristic();">ตรวจสอบ</a>
                </div>
                <div class="col-12">
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
                <div class="col-12">
                    <a id="btn_re_not_id" style="margin-top: 7px;" class="btn byn-sm btn-secondary text-white col-2" onclick="partner_not_id();">
                        ไม่มีเลขทะเบียนนิติบุคคล
                    </a>
                </div>
            </div>
        </div>
        <div id="dic_data_juristicID" class="col-12 d-none">

        </div>
        <div id="div_mail_phone" class="col-12 d-none">
            <div class="row">
                <div class="col-4">
                    <div id="div_name_partner" class="d-none form-group {{ $errors->has('name') ? 'has-error' : ''}}">
                        <label for="name" class="control-label">{{ 'ชื่อพาร์ทเนอร์' }}</label>
                        <input class="form-control" name="name" type="text" id="name" value="{{ isset($partner->name) ? $partner->name : ''}}" required>
                        {!! $errors->first('name', '<p class="help-block">:message</p>') !!}
                    </div>
                </div>
                <div class="col-4">
                    <div class="form-group {{ $errors->has('phone') ? 'has-error' : ''}}">
                        <label for="phone" class="control-label">{{ 'เบอร์' }}</label>
                        <input class="form-control" name="phone" type="phone" id="phone" value="{{ isset($partner->phone) ? $partner->phone : ''}}" required pattern="[0-9]{9-10}">
                        {!! $errors->first('phone', '<p class="help-block">:message</p>') !!}
                    </div>
                </div>
                <div class="col-4">
                    <div class="form-group {{ $errors->has('mail') ? 'has-error' : ''}}">
                        <label for="mail" class="control-label">{{ 'เมล' }}</label>
                        <input class="form-control" name="mail" type="mail" id="mail" value="{{ isset($partner->mail) ? $partner->mail : ''}}" required>
                        {!! $errors->first('mail', '<p class="help-block">:message</p>') !!}
                    </div>
                </div>
                <div class="col-6 d-none">
                    <div class="form-group {{ $errors->has('line_group') ? 'has-error' : ''}}">
                        <label for="line_group" class="control-label">{{ 'เลือกกลุ่มไลน์' }}</label>
                        <br>
                        <select id="line_group" name="line_group" class="btn btn-sm btn-outline-success">
                            <option value="" selected>- เลือกกลุ่มไลน์ -</option>
                        </select>
                    </div>
                </div>
                <div class="col-4">
                    <div class="form-group {{ $errors->has('logo') ? 'has-error' : ''}}">
                        <label for="logo" class="control-label">{{ 'โลโก้' }}</label>
                        <input class="form-control" name="logo" type="file" id="logo" value="{{ isset($partner->logo) ? $partner->logo : ''}}" required>
                        {!! $errors->first('logo', '<p class="help-block">:message</p>') !!}
                    </div>
                </div>
                <div class="col-4">
                    <div class="form-group {{ $errors->has('type_partner') ? 'has-error' : ''}}">
                        <label for="type_partner" class="control-label">{{ 'ประเภทพาร์ทเนอร์' }}</label>

                        <select name="type_partner" class="form-control"  id="type_partner" required>
                                <option selected value="">กรุณาเลือก</option>
                                <option value="university">สถานศึกษา</option>
                                <option value="government">สถานที่ราชการ</option>
                                <option value="company">บริษัทเอกชน</option>
                                <option value="volunteer">อาสาสมัคร</option>
                                <option value="condo">คอนโด</option>
                                <option value="other">อื่นๆ</option>
                        </select>
                        {!! $errors->first('type_partner', '<p class="help-block">:message</p>') !!}
                    </div>
                </div>
                <div class="col-4">
                    <div class="form-group {{ $errors->has('type_partner') ? 'has-error' : ''}}">
                        <label for="full_name" class="control-label">{{ 'ชื่อเต็ม' }}</label>
                        <input class="form-control" name="full_name" type="text" id="full_name" value="{{ isset($partner->full_name) ? $partner->full_name : ''}}" required >
                        {!! $errors->first('full_name', '<p class="help-block">:message</p>') !!}
                    </div>
                </div>
            </div>
        </div>

        <div id="btn_submit_new_partner" class="form-group col-12 d-none">
            <br>
            <input class="btn btn-primary" type="submit" value="{{ $formMode === 'edit' ? 'Update' : 'Create' }}">
        </div>
    </div>
</div>

<!-- <div class="d-none form-group {{ $errors->has('line_group') ? 'has-error' : ''}}">
    <label for="line_group" class="control-label">{{ 'Line Group' }}</label>
    <input class="form-control" name="line_group" type="text" id="line_group" value="{{ isset($partner->line_group) ? $partner->line_group : ''}}" readonly>
    {!! $errors->first('line_group', '<p class="help-block">:message</p>') !!}
</div> -->

<script>

    document.addEventListener('DOMContentLoaded', (event) => {
        partner_not_id();
    });

    function partner_not_id()
    {
        document.querySelector('#juristicID').classList.add('d-none');
        document.querySelector('#btn_re_not_id').classList.add('d-none');
        document.querySelector('#label_juristicID').classList.add('d-none');
        document.querySelector('#btn_check_juristic').classList.add('d-none');

        // document.querySelector('#btn_re_id').classList.remove('d-none');
        document.querySelector('#div_name_partner').classList.remove('d-none');

        document.querySelector('#div_mail_phone').classList.remove('d-none');

        document.querySelector('#btn_submit_new_partner').classList.remove('d-none');
    }

    function juristic(){
        document.querySelector('#div_wrong').classList.add('d-none');
        //PARAMETERS
        let juristicID = document.querySelector("#juristicID");

        document.querySelector('#div_spinner').classList.remove('d-none');

        fetch("https://dataapi.moc.go.th/juristic?juristic_id="+juristicID.value)
            .then(response => response.json())
            .then(result => {
                // console.log(result);

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
                    document.querySelector('#btn_re_not_id').classList.add('d-none');

                    document.querySelector('#div_name_partner').classList.remove('d-none');
                    document.querySelector('#div_mail_phone').classList.remove('d-none');

                    let name_partner = document.querySelector('#name');
                        name_partner.value = result['juristicNameTH'] ;

                    let name_readonly = document.createAttribute("readonly");
                        name_readonly.value = "";
                        name_partner.setAttributeNode(name_readonly); 

                    document.querySelector('#btn_submit_new_partner').classList.remove('d-none');

                }

            });
    }


</script>




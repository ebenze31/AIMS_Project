@extends('layouts.partners.theme_partner_new')

@section('content')

<!-- Modal -->
<div class="modal fade" id="add_emergency_types" tabindex="-1" aria-labelledby="add_emergency_types" aria-hidden="true">
    <div class="modal-dialog modal-xl modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content">
            <div class="card border-top border-0 border-4 border-info">
                <div class="card-body">
                    <div class="border p-4 rounded">
                        <div class="card-title d-flex align-items-center">
                            <div>
                                <i class="fa-solid fa-messages-question me-1 font-22 text-info"></i>
                            </div>
                            <h5 class="mb-0 text-info">เพิ่มหัวข้อประเภทการช่วยเหลือ</h5>
                        </div>
                        <hr>
                        <div class="row mb-3">
                            <label for="name_emergency_type" class="col-sm-3 col-form-label">หัวข้อ</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control add_data" id="name_emergency_type" name="name_emergency_type" placeholder="เพิ่มหัวข้อ" oninput="check_title();">
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="status" class="col-sm-3 col-form-label">สถานะ</label>
                            <div class="col-sm-9">
                                <select class="form-select add_data" id="status" name="status">
                                    <option value="Active" selected>Active</option>
                                    <option value="Inactive">Inactive</option>
                                </select>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="status" class="col-sm-3 col-form-label">พื้นที่</label>
                            <div class="col-sm-9">
                                <h6 class="mt-2">
                                    {{ $data_for_add->name_partner }} : {{ $data_for_add->name_area }}
                                </h6>
                            </div>
                            <input type="text" class="d-none form-control add_data" id="aims_area_id" name="aims_area_id" readonly value="{{ $aims_area_id }}">
                                <input type="text" class="d-none form-control add_data" id="aims_partner_id" name="aims_partner_id" readonly value="{{ $aims_partner_id }}">
                        </div>

                        <div class="text-center mt-4">
                            <div class="d-inline-flex gap-3">
                                <button type="button" class="btn btn-secondary w-100" style="min-width: 120px;" data-dismiss="modal">ปิด</button>
                                <button id="btn_submit" disabled type="button" class="btn btn-success w-100" style="min-width: 120px;" onclick="submit_add_data();">ยืนยัน</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="card radius-10 d-none d-lg-block">
    <div class="card-header border-bottom-0 bg-transparent">
        <div class="d-flex align-items-center">
            <div class="col-12 mt-3">
                <span class="font-weight-bold h4 mb-0">
                    ประเภทการช่วยเหลือ
                </span>
                @if( $officer_role == "admin-area")
                <button class="btn btn-success btn-sm float-end float-right mb-0" data-toggle="modal" data-target="#add_emergency_types">
                    <i class="fa fa-plus"></i> เพิ่มหัวข้อ
                </button>
                @endif
            </div>
        </div>
    </div>
    <div class="card-body">
        <div class="card">
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-striped table-bordered">
                        <thead>
                            <tr>
                                <th style="text-align: center;">หัวข้อ</th>
                                <th style="text-align: center;">พื้นที่</th>
                                <th style="text-align: center;">สถานะ</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($aims_emergency_types as $item)
                                <tr>
                                    <td><h6><b>{{ $item->name_emergency_type }}</b></h6></td>
                                    <td><h6>{{ $item->name_area }}</h6></td>
                                    <td id="text_status_{{ $item->id }}" style="white-space: nowrap;width: 13%;">
                                        <i class="btn fa-regular fa-arrows-repeat" onclick="change_status('{{ $item->id }}','{{ $item->status }}')"></i>
                                        @if($item->status == "Active")
                                            <span class="text-success"><b>{{ $item->status }}</b></span>
                                        @else
                                            <span class="text-danger"><b>{{ $item->status }}</b></span>
                                        @endif
                                    </td>
                                    <td style="text-align: right; white-space: nowrap;width: 1%;">
                                        <form method="POST" action="{{ url('/aims_emergency_types' . '/' . $item->id) }}" accept-charset="UTF-8" style="display:inline">
                                            {{ method_field('DELETE') }}
                                            {{ csrf_field() }}
                                            <button type="submit" class="btn btn-danger btn-sm" title="Delete Aims_emergency_type" onclick="return confirm(&quot;Confirm delete?&quot;)"><i class="fa-solid fa-delete-right"></i> Delete</button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>   
    </div>
</div>

<script>

function change_status(id , old_status){

    let new_status = "" ;
    if(old_status == "Active"){
        new_status = "Inactive" ;
    }else{
        new_status = "Active" ;
    }

    fetch("{{ url('/') }}/api/change_status_emergency_type/" + id + "/" + new_status )
        .then(response => response.text())
        .then(result => {
            // console.log(result);

            if(result == "success"){
                let text_status = document.querySelector('#text_status_'+id);
                let html = ``;
                if(new_status == "Active"){
                    html = `
                        <i class="btn fa-regular fa-arrows-repeat" onclick="change_status('`+id+`','`+new_status+`')"></i>
                        <span class="text-success"><b>Active</b></span>
                    `;
                }
                else{
                    html = `
                        <i class="btn fa-regular fa-arrows-repeat" onclick="change_status('`+id+`','`+new_status+`')"></i>
                        <span class="text-danger"><b>Inactive</b></span>
                    `;
                }

                text_status.innerHTML = html ;
            }
        });

}

function check_title(){
    let title = document.querySelector('#name_emergency_type');
    let btn_submit = document.querySelector('#btn_submit');

    if (title.value.trim() !== "") {
        btn_submit.disabled = false;
    } else {
        btn_submit.disabled = true;
    }
}
    
function submit_add_data() {
    const elements = document.querySelectorAll('.add_data');
    const data = {};

    elements.forEach((element, index) => {
        // ใช้ name หรือ id เป็น key หรือใช้ index ถ้าไม่มี name/id
        const key = element.name || element.id || `field_${index}`;
        data[key] = element.value;
    });

    // console.log(data);

    fetch("{{ url('/') }}/api/cf_add_emergency_type", {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
            },
            body: JSON.stringify(data),
        })
        .then(response => response.text())
        .then(result => {
            // console.log(result);

            if (result == "success") {
                window.location.href = "{{ url('/aims_emergency_types') }}";
            }
        })
        .catch(error => console.error('Error:', error));
}

</script>

@endsection

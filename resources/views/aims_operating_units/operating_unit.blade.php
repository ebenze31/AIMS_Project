@extends('layouts.partners.theme_partner_new')

@section('content')

<div class="card radius-10 d-none d-lg-block">
    <div class="card-header border-bottom-0 bg-transparent">
        <div class="d-flex align-items-center">
            <div class="col-12 mt-3">
                <span class="font-weight-bold h4 mb-0">
                    หน่วยปฏิบัติการ
                </span>
                <a href="{{ url('/') }}" class="btn btn-success btn-sm float-end float-right mb-0" >
                    <i class="fa fa-plus"></i> เพิ่มหน่วยปฏิบัติการ
                </a>
            </div>
        </div>
    </div>
    <div class="card-body">
        <div class="card">
            <div class="card-body">
                <div class="table-responsive">
					<table id="example2555" class="table table-striped table-bordered">
						<thead>
							<tr>
								<th>ชื่อ</th>
                                <th>ประเภท</th>
                                <th>พื้นที่</th>
                                <th>สถานะ</th>
								<th></th>
							</tr>
						</thead>
						<tbody>
                            @foreach($operating_unit as $item)
                                <tr>
                                    <td><h6>{{ $item->name_unit }}</h6></td>
                                    <td>{{ $item->name_type_unit }}</td>
                                    <td>{{ $item->name_area }}</td>
                                    <td>{{ $item->status }}</td>
                                    <td style="width: 1%; white-space: nowrap;">
                                        <div class="float-end">
                                            <a href="">
                                                <button class="btn btn-info btn-sm">
                                                    <i class="fa fa-eye" aria-hidden="true"></i> รายละเอียด
                                                </button>
                                            </a>
                                            <a href="">
                                                <button class="btn btn-warning btn-sm">
                                                    <i class="fa-solid fa-user-pen"></i> แก้ไข
                                                </button>
                                            </a>
                                        </div>
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
        
        document.addEventListener('DOMContentLoaded', (event) => {

            
            var table = $('#example2555').DataTable( {
                
				lengthChange: false,
				buttons: [ 'copy', 'excel', 'pdf', 'print']
			} );
		 
			table.buttons().container()
				.appendTo( '#example2_wrapper .col-md-6:eq(0)' );
	  });
	</script>
@endsection
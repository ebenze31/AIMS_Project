<div class="col-xl-3 col-md-6">
  <div class="card card-stats">
    <!-- Card body -->
    <div class="card-body">
      <div class="row">
        <div class="col">
          <p class="card-title text-muted mb-0">รถลงทะเบียน</p>
          <span class="h4 font-weight-bold mb-0">{{ number_format($new_vmove) }}</span>
          <span>คัน</span>
        </div>
        <div class="col-auto">
          <div class="icon icon-shape bg-gradient-orange text-white rounded-circle shadow">
            <i class="fas fa-arrows-alt"></i>
          </div>
        </div>
      </div>
      <p class="mt-3 mb-0 text-sm">
        <span class="text-success mr-2"><b> {{ number_format(($new_vmove/$count_vmove)*100,1) }} %</b></span>
        <span class="text-nowrap">จากทั้งหมด <b class="text-danger">{{ number_format($count_vmove) }}</b> คัน</span>
      </p>
    </div>
  </div>
</div>
<div class="col-xl-3 col-md-6">
  <div class="card card-stats">
    <!-- Card body -->
    <div class="card-body">
      <div class="row">
        <div class="col">
          <p class="card-title text-muted mb-0">แจ้งเตือนเจ้าของรถ</p>
          <span class="h4 font-weight-bold mb-0">{{ number_format($new_vmove_report) }}</span>
        <span>ครั้ง</span>
        </div>
        <div class="col-auto">
          <div class="icon icon-shape bg-gradient-green text-white rounded-circle shadow">
            <i class="fas fa-car-crash"></i>
          </div>
        </div>
      </div>
      <p class="mt-3 mb-0 text-sm">
        <span class="text-success mr-2"><b> @if(!empty($new_vmove_report) and !empty($count_vmove_report)){{ number_format(($new_vmove_report/$count_vmove_report)*100,1) }} % @endif</b></span>
        <span class="text-nowrap">จากทั้งหมด <b class="text-danger">{{ number_format($count_vmove_report) }}</b> ครั้ง</span>

      </p>
    </div>
  </div>
</div>
<div class="col-xl-3 col-md-6">
  <div class="card card-stats">
    <!-- Card body -->
    <div class="card-body">
      <div class="row">
        <div class="col">
          <p class="card-title text-muted mb-0">ขอความช่วยเหลือ</p>
          <span class="h4 font-weight-bold mb-0">{{ number_format($new_sos) }}</span>
        <span>ครั้ง</span>
        </div>
        <div class="col-auto">
          <div class="icon icon-shape bg-gradient-info text-white rounded-circle shadow">
            <i class="fas fa-bell"></i>
          </div>
        </div>
      </div>
      <p class="mt-3 mb-0 text-sm">
        <span class="text-success mr-2"><b> {{ number_format(($new_sos/$count_sos)*100,1) }} %</b></span>
        <span class="text-nowrap">จากทั้งหมด <b class="text-danger">{{ number_format($count_sos) }}</b> ครั้ง</span>
      </p>
    </div>
  </div>
</div>
<div class="col-xl-3 col-md-6">
  <div class="card card-stats">
    <div class="card-body">
      <div class="row">
        <div class="col">
          <p class="card-title text-muted mb-0">รถลงประกาศขาย</p>
          <span class="h4 font-weight-bold mb-0">{{ number_format($new_car) }}</span>
          <span>คัน</span>
        </div>
        <div class="col-auto">
          <div class="icon icon-shape bg-gradient-red text-white rounded-circle shadow">
            <i class="icofont-car-alt-4"></i>
          </div>
        </div>
      </div>
      <p class="mt-3 mb-0 text-sm">
        @if($count_car != 0)
        <span class="text-success mr-2"><b> {{ number_format(($new_car/$count_car)*100,1) }} %</b></span>
        @else
        <span class="text-success mr-2"><b>0</b></span>
        @endif
        <span class="text-nowrap">จากทั้งหมด <b class="text-danger">{{ number_format($count_car) }}</b> คัน</span>
      </p>
    </div>
  </div>
</div>
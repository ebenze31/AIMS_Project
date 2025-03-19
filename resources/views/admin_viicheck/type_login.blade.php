<div class="row">
  <div class="col-md-12">
    <div class="card">
      <div class="card-header border-0">
        <div class="row align-items-center">
          <div class="col">
            <h3 class="mb-0">ประเภทการลงชื่อเข้าใช้งาน</h3>
          </div>
        </div>
      </div>
      <div class="row">
      <div class="table-responsive col-8">
        <!-- Projects table -->
        <table class="table align-items-center table-flush">
          <thead class="thead-light">
            <tr>
              <th scope="col">
                <b>ประเภท</b><br>
                Type
              </th>
              <th scope="col">
                <b>จำนวน</b><br>
                Amount
              </th>
              <th scope="col">
                <div class="col text-right">
                  <p class="btn btn-sm">ทั้งหมด : {{ $all_user }}</p>
                    <!-- <a href="#!" class="btn btn-sm btn-primary">See all</a> -->
                </div>
              </th>
            </tr>
          </thead>
          <tbody>
            <tr>
              <th scope="row">
                <i class="fab fa-line text-success"></i> Line 
              </th>
              <td>
                {{ $count_line }}
              </td>
              <td>
                <div class="d-flex align-items-center">
                  <span class="mr-2">{{ number_format(($count_line/$all_user)*100,1) }} %</span>
                  <div>
                    <div class="progress">
                      <div class="progress-bar bg-gradient-success" role="progressbar" aria-valuenow="70" aria-valuemin="0" aria-valuemax="100" style="width: {{ number_format(($count_line/$all_user)*100,1) }}%;"></div>
                    </div>
                  </div>
                </div>
              </td>
            </tr>
            <tr>
              <th scope="row">
                <i class="fab fa-facebook-square text-primary"></i> Facebook 
              </th>
              <td>
                {{ $count_facebook }}
              </td>
              <td>
                <div class="d-flex align-items-center">
                  <span class="mr-2">{{ number_format(($count_facebook/$all_user)*100,1) }} %</span>
                  <div>
                    <div class="progress">
                      <div class="progress-bar bg-gradient-primary" role="progressbar" aria-valuenow="70" aria-valuemin="0" aria-valuemax="100" style="width: {{ number_format(($count_facebook/$all_user)*100,1) }}%;"></div>
                    </div>
                  </div>
                </div>
              </td>
            </tr>
            <tr>
              <th scope="row">
                <i class="fab fa-google text-danger"></i> Google 
              </th>
              <td>
                {{ $count_google }}
              </td>
              <td>
                <div class="d-flex align-items-center">
                  <span class="mr-2">{{ number_format(($count_google/$all_user)*100,1) }} %</span>
                  <div>
                    <div class="progress">
                      <div class="progress-bar bg-gradient-danger" role="progressbar" aria-valuenow="70" aria-valuemin="0" aria-valuemax="100" style="width: {{ number_format(($count_google/$all_user)*100,1) }}%;"></div>
                    </div>
                  </div>
                </div>
              </td>
            </tr>
            <tr>
              <th scope="row">
                <i class="fas fa-globe" style="color: #5F9EA0"></i> Web Viicheck 
              </th>
              <td>
                {{ $count_web }}
              </td>
              <td>
                <div class="d-flex align-items-center">
                  <span class="mr-2">{{ number_format(($count_web/$all_user)*100,1) }} %</span>
                  <div>
                    <div class="progress">
                      <div class="progress-bar bg-gradient-dark" role="progressbar" aria-valuenow="70" aria-valuemin="0" aria-valuemax="100" style="width: {{ number_format(($count_web/$all_user)*100,1) }}%;"></div>
                    </div>
                  </div>
                </div>
              </td>
            </tr>
          </tbody>
        </table>
      </div>
      <div class="col-4">
          <br>
          <img style="padding: 15px;" width="100%" src="https://market.viicheck.com/img/logo/VII-check-LOGO-W-v1.png">
      </div>
    </div>
    </div>
  </div>
</div>
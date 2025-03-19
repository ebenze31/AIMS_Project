<style>
  @keyframes bouncing-loader {
    to {
      opacity: 0.1;
      transform: translate3d(0, -0.5rem, 0);
    }
  }

  .bouncing-loader {
    display: flex;
    justify-content: center;
  }

  .bouncing-loader>div {
    width: 0.3rem;
    height: 0.3rem;
    margin: 1rem 0.2rem;
    background: #8385aa;
    border-radius: 50%;
    animation: bouncing-loader 0.6s infinite alternate;
  }

  .bouncing-loader>div:nth-child(3) {
    animation-delay: 0.2s;
  }

  .bouncing-loader>div:nth-child(4) {
    animation-delay: 0.4s;
  }
</style>




<div class="modal fade" id="btn-loading" tabindex="-1" role="dialog" aria-labelledby="btn-loading" aria-hidden="true" data-backdrop="static" data-keyboard="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content" style="border-radius: 25px;">
      <div class="modal-body text-center">
        <img class="mt-3" width="60%" src="{{ url('/img/icon/cars.gif') }}">
        <br>
        <center style="margin-top:15px;">
          <div class="bouncing-loader">
            <span style="font-family: 'Kanit', sans-serif;"> <b>กำลังโหลด โปรดรอสักครู่</b> </span>
            <div></div>
            <div></div>
            <div></div>
          </div>
        </center>
        <h4 class="mt-3" style="font-family: 'Kanit', sans-serif;"><b>สนับสนุนโดย</b> </h4>
        <div class="row">
          <div class="col-12 mt-3">
            <div class=" owl-4-style">
              <div class="owl-carousel owl-4 ">
                <!-- <span id="foot_logo_partner"></span> -->
                @php
                $partner = \App\Models\Partner::where(['show_homepage' => 'show'])->get()
                @endphp
                @foreach($partner as $item)
                @if($loop->iteration % 2 == 0)
                <div class="item" style="padding:0px;z-index:-1;">
                  <img class="p-md-2 p-lg-2" style="width: 100%;object-fit: contain;max-height: 112px;" src="{{ url('storage/'.$item->logo )}}">
                </div>
                @endif
                @endforeach
              </div>
            </div>
          </div>
          <div class="col-12 d-block d-md-none"><br> <br></div>
          <div class="col-12 mt-3">
            <div class=" owl-4-style">
              <div class="owl-carousel owl-4 ">
                @foreach($partner as $item)
                @if($loop->iteration % 2 != 0)
                <div class="item" style="padding:0px;z-index:-1;">
                  <img class="p-md-2 p-lg-2" style="width: 100%;object-fit: contain;max-height: 112px;" src="{{ url('storage/'.$item->logo )}}">
                </div>
                @endif
                @endforeach
              </div>
            </div>
          </div>
          <div class="col-12 d-block d-md-none"><br> <br></div>
        </div>
      </div>
    </div>
  </div>
  </div>


  <div class="modal fade" id="btn-loading-test" tabindex="-1" role="dialog" aria-labelledby="btn-loading" aria-hidden="true" data-backdrop="static" data-keyboard="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content" style="border-radius: 25px;">
      <div class="modal-body text-center">
        <img class="mt-3" width="60%" src="{{ url('/img/icon/cars.gif') }}">
        <br>
        <center style="margin-top:15px;">
          <div class="bouncing-loader">
            <span style="font-family: 'Kanit', sans-serif;"> <b>กำลังโหลด โปรดรอสักครู่</b> </span>
            <div></div>
            <div></div>
            <div></div>
          </div>
        </center>
        <h4 class="mt-3" style="font-family: 'Kanit', sans-serif;"><b>สนับสนุนโดย</b> </h4>
        <div class="row">
        <div class="col-12 mt-3">
            <div class=" owl-4-style">
              <div class="owl-carousel owl-4 ">
                <!-- <span id="foot_logo_partner"></span> -->
                @php
                $partner = \App\Models\Partner::where(['show_homepage' => 'show'])->get()
                @endphp
                @foreach($partner as $item)
                @if($loop->iteration % 2 == 0)
                <div class="item" style="padding:0px;z-index:-1;">
                  <img class="p-md-2 p-lg-2" style="width: 100%;object-fit: contain;max-height: 112px;" src="{{ url('storage/'.$item->logo )}}">
                </div>
                @endif
                @endforeach
              </div>
            </div>
          </div>
          <div class="col-12 d-block d-md-none"><br> <br></div>
          <div class="col-12 mt-3">
            <div class=" owl-4-style">
              <div class="owl-carousel owl-4 ">
                @foreach($partner as $item)
                @if($loop->iteration % 2 != 0)
                <div class="item" style="padding:0px;z-index:-1;">
                  <img class="p-md-2 p-lg-2" style="width: 100%;object-fit: contain;max-height: 112px;" src="{{ url('storage/'.$item->logo )}}">
                </div>
                @endif
                @endforeach
              </div>
            </div>
          </div>
          <div class="col-12 d-block d-md-none"><br> <br></div>

      </div>
    </div>
  </div>
  </div>
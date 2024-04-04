@extends('layouts.user_type.guest')

@section('content')

  <main class="main-content  mt-0">
    <section>
      <div class="page-header min-vh-75">
        <div class="container">
          <div class="row">
            <div class="col-xl-4 col-lg-5 col-md-6 d-flex flex-column mx-auto">
              <div class="card card-plain">
                <div class="card-header py-0 text-left bg-transparent">
                  <h3 class="font-weight-bolder text-info text-gradient">Ekosfera</h3>
                  <p class="mb-0">Hush kelibsiz</p>
                </div>
                <div class="card-body">
                  <form role="form" method="POST" action="/session">
                      @csrf
                      <label>Telefon Raqam</label>
                      <div class="input-group">
                          <div class="input-group-text">+998</div>
                          <input type="number" class="form-control px-2" name="phone_number" id="phone_number" placeholder="" value="{{ old('phone_number') ?? session('last_phone_number') }}">
                      </div>
                      @error('phone_number')
                          <p class="text-danger text-xs p-0 m-0">{{ $message }}</p>
                      @enderror
                      <label class="mt-5">Tasdiqlash kodi</label> 
                      <div class="mb-3">
                          <input type="number" class="form-control" name="password" id="password" placeholder="####"  aria-label="Password" aria-describedby="password-addon">
                          @error('password')
                              <p class="text-danger text-xs mt-2">{{ $message }}</p>
                          @enderror
                      </div>
                      <div class="text-center">
                          <button type="submit" class="btn bg-gradient-info w-100 mt-2 mb-0">Kirish</button>
                      </div>
                  </form>
              
                  <form style="margin-top: -180px" class="d-flex" action="{{ route('send.otp') }}" id="sendOtpForm" method="POST">
                      @csrf
                      <input type="hidden" name="phone_number" id="otpPhoneNumber">
                      <button type="button" class="btn btn-sm shadow-none border px-2 py-0 mt-2" id="sendOtpBtn">SMS yuborish</button>
                      <small id="timer" style="display: none; margin:6px"></small>
                  </form>
                </div>
              </div>
            </div>
            <div class="col-md-6">
              <div class="oblique position-absolute top-0 h-100 d-md-block d-none me-n8">
                <div class="oblique-image bg-cover position-absolute fixed-top ms-auto h-100 z-index-0 ms-n6" style="background-image:url('../assets/img/curved-images/curved6.jpg')"></div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
  </main>

@endsection
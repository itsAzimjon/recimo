@extends('layouts.user_type.guest')

@section('content')

  <main class="main-content  mt-0">
    <section>
      <div class="page-header min-vh-75">
        <div class="container">
          <div class="row">
            <div class="col-xl-4 col-lg-5 col-md-6 d-flex flex-column mx-auto">
              <div class="card card-plain mt-4">
                <div class="card-header pb-0 text-left bg-transparent">
                  <h3 class="font-weight-bolder text-info text-gradient">Ekosfera</h3>
                  <p class="mb-0"><br>Hush kelibsiz</p>
                  <p class="mb-0"><br></p>
                </div>
                <div class="card-body">
                  <form role="form" method="POST" action="/session">
                    @csrf
                    <label>Telefon Raqam</label>
                    <div class="mb-3">
                      <input type="tel" class="form-control" name="phone_number" id="phone_number" placeholder="+998 91 311 22" value="913112233" aria-label="phone_number" aria-describedby="email-addon">
                      @error('phone_number')
                        <p class="text-danger text-xs mt-2">{{ $message }}</p>
                      @enderror
                    </div>
                    <label>Parol</label>
                    <div class="mb-3">
                      <input type="password" class="form-control" name="password" id="password" placeholder="Parol" value="secret" aria-label="Password" aria-describedby="password-addon">
                      @error('password')
                        <p class="text-danger text-xs mt-2">{{ $message }}</p>
                      @enderror
                    </div>
                    <div class="text-center">
                      <button type="submit" class="btn bg-gradient-info w-100 mt-4 mb-0">Kirish</button>
                    </div>
                  </form>
                </div>
                <div class="card-footer text-center pt-0 px-lg-2 px-1">
                  {{-- <small class="text-muted">Forgot you password? Reset you password 
                    <a href="/login/forgot-password" class="text-info text-gradient font-weight-bold">here</a>
                  </small> --}}
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
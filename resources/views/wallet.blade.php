@extends('layouts.user_type.auth')

@section('content')
  <div class="row">
    <div class="col-lg-5">
      <div class="row">
        <div class="col-xl-12 mb-xl-0 mb-4">
          <div class="card bg-transparent shadow-xl">
            <div class="overflow-hidden position-relative border-radius-xl" style="background-image: url('../assets/img/curved-images/curved14.jpg');">
              <span class="mask bg-gradient-dark"></span>
              <div class="card-body position-relative z-index-1 p-3">
                <i class="fas fa-wifi text-white p-2"></i>
                <h5 class="text-white mt-4 mb-5 pb-2">{{ substr(chunk_split($user->wallet->wallet_number, 4, ' '), 0, -1) }}</h5>
                <div class="d-flex">
                  <div class="d-flex">
                    <div class="me-4">
                      <p class="text-white text-sm opacity-8 mb-0">{{ $user->name }}</p>
                      <h5 class="mb-0 metallic-text">{{ number_format($user->wallet->money) }} so‘m</h5>
                    </div>
                  </div>
                  <div class="ms-auto w-20 d-flex align-items-end justify-content-end">
                    <img class="w-60 mt-2" src="../assets/img/logos/mastercard.png" alt="logo">
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        {{-- <div class="col-xl-6">
          <div class="row">
            <div class="col-md-12">
              <div class="card px-3">
                <div class="card-header p-3 ">
                  <div class="icon icon-shape icon-lg bg-gradient-primary shadow text-center border-radius-lg">
                    <i class="fas fa-landmark opacity-10"></i>
                  </div>
                </div>
                <div class="card-body pt-0 p-3 ">
                  <h6 class=" mb-0">Hamyon</h6>
                  <span class="text-xs">Joriy balans</span>
                  <hr class="horizontal dark my-3">
                  <h5 class="mb-0">{{ $user->wallet->money }} so‘m</h5>
                </div>
              </div>
            </div>
            
          </div>
        </div>
        <div class="col-md-12 mb-lg-0 mb-4">
          <div class="card mt-4">
            <div class="card-header pb-0 p-3">
              <div class="row">
                <div class="col-6 d-flex align-items-center">
                  <h6 class="mb-0">Payment Method</h6>
                </div>
                <div class="col-6 text-end">
                  <a class="btn bg-gradient-dark mb-0" href="javascript:;"><i class="fas fa-plus"></i>&nbsp;&nbsp;Add New Card</a>
                </div>
              </div>
            </div>
            <div class="card-body p-3">
              <div class="row">
                <div class="col-md-6 mb-md-0 mb-4">
                  <div class="card card-body border card-plain border-radius-lg d-flex align-items-center flex-row">
                    <img class="w-10 me-3 mb-0" src="../assets/img/logos/mastercard.png" alt="logo">
                    <h6 class="mb-0">****&nbsp;&nbsp;&nbsp;****&nbsp;&nbsp;&nbsp;****&nbsp;&nbsp;&nbsp;7852</h6>
                    <i class="fas fa-pencil-alt ms-auto text-dark cursor-pointer" data-bs-toggle="tooltip" data-bs-placement="top" title="Edit Card"></i>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="card card-body border card-plain border-radius-lg d-flex align-items-center flex-row">
                    <img class="w-10 me-3 mb-0" src="../assets/img/logos/visa.png" alt="logo">
                    <h6 class="mb-0">****&nbsp;&nbsp;&nbsp;****&nbsp;&nbsp;&nbsp;****&nbsp;&nbsp;&nbsp;5248</h6>
                    <i class="fas fa-pencil-alt ms-auto text-dark cursor-pointer" data-bs-toggle="tooltip" data-bs-placement="top" title="Edit Card"></i>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div> --}}
      </div>
    </div>
    <div class="col-lg-7 opacity-5">
      <div class="card h-100">
        <div class="card-header pb-0 p-3">
          <div class="row">
            <div class="col-6 d-flex align-items-center">
              <h4 style="position: absolute; left: 15px">Ishlab chiqilmoqda</h4>
              <h6 class="mb-0"></h6>
            </div>
            <div class="col-6 text-end">
              <button class="btn shadow-none text-primary btn-sm mb-0">Oylik hisobotlar</button>
            </div>
          </div>
        </div>
        <div class="card-body p-3 pb-0">
          <ul class="list-group">
            <li class="list-group-item border-0 d-flex justify-content-between ps-0 mb-2 border-radius-lg">
              <div class="d-flex flex-column">
                <h6 class="mb-1 text-dark font-weight-bold text-sm">Mart, 2024</h6>
                <span class="text-xs">#MS-415646</span>
              </div>
              <div class="d-flex align-items-center text-sm">
                180
                <button class="btn btn-link text-dark text-sm mb-0 px-0 ms-4"><i class="fas fa-file-pdf text-lg me-1"></i> PDF</button>
              </div>
            </li>
            <li class="list-group-item border-0 d-flex justify-content-between ps-0 mb-2 border-radius-lg">
              <div class="d-flex flex-column">
                <h6 class="text-dark mb-1 font-weight-bold text-sm">Febral, 2024</h6>
                <span class="text-xs">#RV-126749</span>
              </div>
              <div class="d-flex align-items-center text-sm">
                250
                <button class="btn btn-link text-dark text-sm mb-0 px-0 ms-4"><i class="fas fa-file-pdf text-lg me-1"></i> PDF</button>
              </div>
            </li>
          </ul>
        </div>
      </div>
    </div>
  </div>
  <div class="row">
    
    <div class="col-md-12 mt-4">
      <div class="card h-100 mb-4">
        <div class="card-header pb-0 px-3">
          <div class="row">
            <div class="col-md-6">
              <h6 class="mb-0">Barcha Tranzaktsiyalar</h6>
            </div>
            <div class="col-md-6 d-flex justify-content-end align-items-center">
              <i class="far fa-calendar-alt me-2"></i>
              {{-- <small>23 - 30 March 2020?</small> --}}
            </div>
          </div>
        </div>
        <div class="card-body pt-4 p-3">
          <ul class="list-group">
            @foreach ($user->transactions()->orderByDesc('id')->get() as $transaction)
              <li class="list-group-item border-0 d-flex justify-content-between ps-0 mb-2 border-radius-lg">
                <div class="d-flex align-items-center">
                  <button class="btn btn-icon-only btn-rounded {{ $transaction->in_out == 1 ? 'btn-outline-success' : 'btn-outline-danger' }} mb-0 me-3 btn-sm d-flex align-items-center justify-content-center"></button>
                  <div class="d-flex flex-column">
                    <h6 class="mb-1 text-dark text-sm">{{ \App\Models\User::where('id', $transaction->client_id)->value('name') }}
                    </h6>
                    <span class="text-xs">{{ $transaction->created_at }}</span>
                  </div>
                </div>
                <div>
                  <div class="d-flex align-items-center {{ $transaction->in_out == 1 ? 'text-success' : 'text-danger' }} text-gradient text-sm font-weight-bold">
                    {{ number_format($transaction->amount) }} so‘m
                  </div>
                  <div class="float-end text-sm font-weight-bold">{{ $transaction->method == 1 ? 'Karta' : 'Naqt' }}</div>
                </div>
              </li>                
            @endforeach
          </ul>
        </div>
      </div>
    </div>
  </div> 
@endsection


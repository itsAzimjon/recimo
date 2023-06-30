@extends('layouts.user_type.auth')

@section('content')

  <div class="container-fluid py-4">
    <div class="row">
      <div class="col-12 mt-4">
        <div class="card h-100 mb-4">
          <div class="card-header pb-0 px-3">
            <div class="row">
              <div class="col-md-12">
                <h6 class="mb-2">Ombordagi Mahsulotlar</h6>
              </div>
            </div>
          </div>
          <hr>
          <div class="card-body pt-4 p-3">
            <h6 class="text-uppercase text-s font-weight-bolder mb-3 px-3 py-1 bg-info">Plastik</h6>
            <ul class="list-group">
              <li class="list-group-item border-0 d-flex justify-content-between ps-0 mb-2 border-radius-lg">
                <div class="d-flex align-items-center">
                  <div class="d-flex flex-column">
                    <h6 class="mb-1 text-sm">Baklashka</h6>
                  </div>
                </div>
                <div class="d-flex align-items-center text-success text-sm font-weight-bold">
                  2,500 kg
                </div>
              </li>
              <li class="list-group-item border-0 d-flex justify-content-between ps-0 mb-2 border-radius-lg">
                <div class="d-flex align-items-center">
                  <div class="d-flex flex-column">
                    <h6 class="mb-1 text-dark text-sm">Plastmassa</h6>
                  </div>
                </div>
                <div class="d-flex align-items-center text-success text-sm font-weight-bold">
                  2,300 kg
                </div>
              </li>
            </ul>
            <h6 class="text-uppercase text-s font-weight-bolder my-3 px-3 py-1 bg-warning">Maklatura</h6>
            <ul class="list-group">
              <li class="list-group-item border-0 d-flex justify-content-between ps-0 mb-2 border-radius-lg">
                <div class="d-flex align-items-center">
                  <div class="d-flex flex-column">
                    <h6 class="mb-1 text-dark text-sm">Stripe</h6>
                  </div>
                </div>
                <div class="d-flex align-items-center text-success text-sm font-weight-bold">
                  3,500 kg
                </div>
              </li>
            </ul>
          </div>
        </div>
      </div>
    </div>
  </div>
 
@endsection


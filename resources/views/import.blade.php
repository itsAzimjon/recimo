@extends('layouts.user_type.auth')

@section('content')

  <main class="main-content position-relative max-height-vh-100 h-100 mt-1 border-radius-lg ">
    <div class="container-fluid py-4">
      <div class="row">
        <div class="col-12">
          <div class="card mb-4">
            <div class="row d-flex justify-content-between">
              <div class="col">
                <div class="card-header pb-0">
                  <h6>Sotuv Ro‘yxati</h6>
                </div>
              </div>
              <div class="col-2 mt-4">
                <div class="">
                  <a href="#" data-bs-toggle="modal" data-bs-target="#exampleModal" class=" btn bg-gradient-primary btn-sm justify-content-end" type="button">+&nbsp; Qo'shish</a>
                  <!-- Modal -->
                  <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-lg">
                      <div class="modal-content">
                        <div class="modal-header">
                          <h1 class="modal-title fs-5" id="exampleModalLabel">Hamkor yaratish</h1>
                          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                          <x-create>M.Ch.J</x-create>
                        </div>
                      </div>
                    </div>
                  </div>       
              </div> 
              </div>
            </div>
            <div class="card-body px-0 pt-0 pb-2">
              <div class="table-responsive p-0">
                <table class="table align-items-center mb-0">
                  <thead>
                    <tr>
                      <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Tashkilot</th>
                      <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Vazn & Summa</th>
                      <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Tur</th>
                      <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Sana</th>
                      <th class="text-secondary opacity-7"></th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr>
                      <td>
                        <div class="d-flex px-2 py-1">
                          <div>
                            <img src="../assets/img/team-2.jpg" class="avatar avatar-sm me-3" alt="user1">
                          </div>
                          <div class="d-flex flex-column justify-content-center">
                            <h6 class="mb-0 text-sm">Reproduction MCHJ</h6>
                            <p class="text-xs text-secondary mb-0">Zargarlik MFY</p>
                          </div>
                        </div>
                      </td>
                      <td>
                        <p class="text-xs font-weight-bold mb-0">2150 kg</p>
                        <p class="text-xs text-secondary mb-0">2 400 000 Sum</p>
                      </td>
                      <td class="align-middle text-center text-sm">
                        <span class="badge badge-sm bg-gradient-success">Plastik</span>
                        <p class="text-xs text-secondary mb-0">Blok paketlar</p>

                      </td>
                      <td class="align-middle text-center">
                        <span class="text-secondary text-xs font-weight-bold">23/04/18</span>
                      </td>
                      <td class="align-middle">
                        <a href="javascript:;" class="text-secondary font-weight-bold text-xs" data-toggle="tooltip" data-original-title="Edit user">
                          <i class="fas fa-pencil-alt text-secondry me-2" aria-hidden="true"></i>
                        </a>
                      </td>
                    </tr>
                    <tr>
                      <td>
                        <div class="d-flex px-2 py-1">
                          <div>
                            <img src="../assets/img/team-3.jpg" class="avatar avatar-sm me-3" alt="user2">
                          </div>
                          <div class="d-flex flex-column justify-content-center">
                            <h6 class="mb-0 text-sm">Reproduction MCHJ</h6>
                            <p class="text-xs text-secondary mb-0">Zargarlik MFY</p>
                          </div>
                        </div>
                      </td>
                      <td>
                        <p class="text-xs font-weight-bold mb-0">2150 kg</p>
                        <p class="text-xs text-secondary mb-0">2 400 000 Sum</p>
                      </td>
                      <td class="align-middle text-center text-sm">
                        <span class="badge badge-sm bg-gradient-success">Plastik</span>
                        <p class="text-xs text-secondary mb-0">Blok paketlar</p>

                      </td>
                      <td class="align-middle text-center">
                        <span class="text-secondary text-xs font-weight-bold">23/04/18</span>
                      </td>
                      <td class="align-middle">
                        <a href="javascript:;" class="text-secondary font-weight-bold text-xs" data-toggle="tooltip" data-original-title="Edit user">
                          <i class="fas fa-pencil-alt text-secondry me-2" aria-hidden="true"></i>
                        </a>
                      </td>
                    </tr>
                    <tr>
                      <td>
                        <div class="d-flex px-2 py-1">
                          <div>
                            <img src="../assets/img/team-4.jpg" class="avatar avatar-sm me-3" alt="user3">
                          </div>
                          <div class="d-flex flex-column justify-content-center">
                            <h6 class="mb-0 text-sm">Reproduction MCHJ</h6>
                            <p class="text-xs text-secondary mb-0">Zargarlik MFY</p>
                          </div>
                        </div>
                      </td>
                      <td>
                        <p class="text-xs font-weight-bold mb-0">2150 kg</p>
                        <p class="text-xs text-secondary mb-0">2 400 000 Sum</p>
                      </td>
                      <td class="align-middle text-center text-sm">
                        <span class="badge badge-sm bg-gradient-success">Plastik</span>
                        <p class="text-xs text-secondary mb-0">Blok paketlar</p>

                      </td>
                      <td class="align-middle text-center">
                        <span class="text-secondary text-xs font-weight-bold">23/04/18</span>
                      </td>
                      <td class="align-middle">
                        <a href="javascript:;" class="text-secondary font-weight-bold text-xs" data-toggle="tooltip" data-original-title="Edit user">
                          <i class="fas fa-pencil-alt text-secondry me-2" aria-hidden="true"></i>
                        </a>
                      </td>
                    </tr>
                    <tr>
                      <td>
                        <div class="d-flex px-2 py-1">
                          <div>
                            <img src="../assets/img/team-3.jpg" class="avatar avatar-sm me-3" alt="user4">
                          </div>
                          <div class="d-flex flex-column justify-content-center">
                            <h6 class="mb-0 text-sm">Reproduction MCHJ</h6>
                            <p class="text-xs text-secondary mb-0">Zargarlik MFY</p>
                          </div>
                        </div>
                      </td>
                      <td>
                        <p class="text-xs font-weight-bold mb-0">2150 kg</p>
                        <p class="text-xs text-secondary mb-0">2 400 000 Sum</p>
                      </td>
                      <td class="align-middle text-center text-sm">
                        <span class="badge badge-sm bg-gradient-warning">Maklatura</span>
                        <p class="text-xs text-secondary mb-0">Karton</p>

                      </td>
                      <td class="align-middle text-center">
                        <span class="text-secondary text-xs font-weight-bold">23/04/18</span>
                      </td>
                      <td class="align-middle">
                        <a href="javascript:;" class="text-secondary font-weight-bold text-xs" data-toggle="tooltip" data-original-title="Edit user">
                          <i class="fas fa-pencil-alt text-secondry me-2" aria-hidden="true"></i>
                        </a>
                      </td>
                    </tr>
                    <tr>
                      <td>
                        <div class="d-flex px-2 py-1">
                          <div>
                            <img src="../assets/img/team-2.jpg" class="avatar avatar-sm me-3" alt="user5">
                          </div>
                          <div class="d-flex flex-column justify-content-center">
                            <h6 class="mb-0 text-sm">Reproduction MCHJ</h6>
                            <p class="text-xs text-secondary mb-0">Zargarlik MFY</p>
                          </div>
                        </div>
                      </td>
                      <td>
                        <p class="text-xs font-weight-bold mb-0">2150 kg</p>
                        <p class="text-xs text-secondary mb-0">2 400 000 Sum</p>
                      </td>
                      <td class="align-middle text-center text-sm">
                        <span class="badge badge-sm bg-gradient-secondary">Metallom</span>
                        <p class="text-xs text-secondary mb-0">List</p>

                      </td>
                      <td class="align-middle text-center">
                        <span class="text-secondary text-xs font-weight-bold">23/04/18</span>
                      </td>
                      <td class="align-middle">
                        <a href="javascript:;" class="text-secondary font-weight-bold text-xs" data-toggle="tooltip" data-original-title="Edit user">
                          <i class="fas fa-pencil-alt text-secondry me-2" aria-hidden="true"></i>
                        </a>
                      </td>
                    </tr>
                    <tr>
                      <td>
                        <div class="d-flex px-2 py-1">
                          <div>
                            <img src="../assets/img/team-4.jpg" class="avatar avatar-sm me-3" alt="user6">
                          </div>
                          <div class="d-flex flex-column justify-content-center">
                            <h6 class="mb-0 text-sm">Reproduction MCHJ</h6>
                            <p class="text-xs text-secondary mb-0">Zargarlik MFY</p>
                          </div>
                        </div>
                      </td>
                      <td>
                        <p class="text-xs font-weight-bold mb-0">2150 kg</p>
                        <p class="text-xs text-secondary mb-0">2 400 000 Sum</p>
                      </td>
                      <td class="align-middle text-center text-sm">
                        <span class="badge badge-sm bg-gradient-success">Plastik</span>
                        <p class="text-xs text-secondary mb-0">Blok paketlar</p>

                      </td>
                      <td class="align-middle text-center">
                        <span class="text-secondary text-xs font-weight-bold">23/04/18</span>
                      </td>
                      <td class="align-middle">
                        <a href="javascript:;" class="text-secondary font-weight-bold text-xs" data-toggle="tooltip" data-original-title="Edit user">
                          <i class="fas fa-pencil-alt text-secondry me-2" aria-hidden="true"></i>
                        </a>
                      </td>
                    </tr>
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </main>
  
  @endsection

@extends('layouts.user_type.auth')

@section('content')

<div>
    <div class="alert alert-secondary mx-4" role="alert">
        <span class="text-white">
            <strong>Agentlar va Shaxobchalar</strong>
        </span>
    </div>

    <div class="row">
        <div class="col-12">
            <div class="card mb-4 mx-4">
                <div class="card-header pb-0">
                    <div class="d-flex flex-row justify-content-between">
                        <div>
                            <h5 class="mb-0">Agentlar</h5>
                        </div>
                        <div class="d-flex  staff-slct">
                                <select class="form-select form-select-sm mx-2" aria-label=".form-select-sm example">
                                    <option disabled selected>F.I.O</option>
                                    <option value="1">One</option>
                                    <option value="2">Two</option>
                                    <option value="3">yashna obod mahallsi</option>
                                </select>
                            <select class="form-select form-select-sm" aria-label=".form-select-sm example">
                                <option disabled selected>Passort</option>
                                <option value="1">ac asfjjasj</option>
                                <option value="2">Two</option>
                                <option value="3">Three</option>
                            </select>
                            <select class="form-select form-select-sm mx-2" aria-label=".form-select-sm example">
                                <option disabled selected>Stir</option>
                                <option value="1">One</option>
                                <option value="2">Two</option>
                                <option value="3">Three</option>
                            </select>
                            <select class="form-select form-select-sm" aria-label=".form-select-sm example">
                                <option disabled selected>Maznil</option>
                                <option value="1">One</option>
                                <option value="2">Two</option>
                                <option value="3">Three</option>
                            </select>
                            <select class="form-select form-select-sm mx-2" aria-label=".form-select-sm example">
                                <option disabled selected>Yo'nalish</option>
                                <option value="1">One</option>
                                <option value="2">Two</option>
                                <option value="3">Three</option>
                            </select>
                            <select class="form-select form-select-sm" aria-label=".form-select-sm example">
                                <option disabled selected>Zahira</option>
                                <option value="1">One</option>
                                <option value="2">Two</option>
                                <option value="3">Three</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="card-body px-0 pt-0 pb-2">
                    <div class="table-responsive p-0">
                        <table class="table align-items-center mb-0">
                            <thead>
                                <tr>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        ID
                                    </th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                        Foto
                                    </th>
                                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        Ism <br> Manzil
                                    </th>
                                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        Passport <br>  Stir
                                    </th>
                                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        Yo‘nalish
                                    </th>
                                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        Zahira
                                    </th>
                                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        Telefon <br> Yaratilgan sana
                                    </th>
                                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        Tahrir
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td class="ps-4">
                                        <p class="text-xs font-weight-bold mb-0">1</p>
                                    </td>
                                    <td>
                                        <div>
                                            <img src="../assets/img/team-2.jpg" class="avatar avatar-sm me-3">
                                        </div>
                                    </td>
                                    <td class="text-center">
                                        <p class="text-xs  text-dark font-weight-bold mb-0">Admin Asqarov</p>
                                        <p class="text-xs text-secondary mb-0">Zargarlik MFY</p>
                                    </td>
                                    <td class="text-center">
                                        <p class="text-xs  text-dark font-weight-bold mb-0">AC1685545</p>
                                        <p class="text-xs text-secondary mb-0">30922445566</p>

                                    </td>
                                    <td class="text-center">
                                        <p class="text-xs text-dark font-weight-bold mb-0">Maklatura</p>
                                        <p class="text-xs font-weight-bold mb-0">Plastik</p>
                                    </td>
                                    <td class="text-center">
                                        <p class="text-xs text-secondary mb-0">800kg</p>
                                        <p class="text-xs text-secondary mb-0">1200kg</p>

                                    </td>
                                    <td class="text-center">
                                        <a class="text-xs font-weight-bold mb-0" href="tel:+998901234567">+998901234567</a>
                                        <p class="text-secondary text-xs font-weight-bold">16/06/18</p>
                                    </td>
                                   <td class="text-center">
                                        <a href="{{route('show')}}" class="mx-3" data-bs-toggle="tooltip" data-bs-original-title="Edit user">
                                            <i class="fas fa-user-edit text-secondary"></i>
                                        </a>
                                        <span>
                                            <i class="cursor-pointer fas fa-trash text-secondary"></i>
                                        </span>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="ps-4">
                                        <p class="text-xs font-weight-bold mb-0">2</p>
                                    </td>
                                    <td>
                                        <div>
                                            <img src="/assets/img/team-1.jpg" class="avatar avatar-sm me-3">
                                        </div>
                                    </td>
                                    <td class="text-center">
                                        <p class="text-xs  text-dark font-weight-bold mb-0">Creator</p>
                                        <p class="text-xs text-secondary mb-0">Zargarlik MFY</p>
                                    </td>
                                    <td class="text-center">
                                        <p class="text-xs  text-dark font-weight-bold mb-0">AC1685545</p>
                                        <p class="text-xs text-secondary mb-0">30922445566</p>

                                    </td>
                                    <td class="text-center">
                                        <p class="text-xs text-dark font-weight-bold mb-0">Maklatura</p>
                                        <p class="text-xs font-weight-bold mb-0">Plastik</p>
                                    </td>
                                    <td class="text-center">
                                        <p class="text-xs text-secondary mb-0">700kg</p>
                                        <p class="text-xs text-secondary mb-0">90kg</p>

                                    </td>
                                    <td class="text-center">
                                        <a class="text-xs font-weight-bold mb-0" href="tel:+998901234567">+998901234567</a>
                                        <p class="text-secondary text-xs font-weight-bold">16/06/18</p>
                                    </td>
                                    <td class="text-center">
                                        <a href="{{route('show')}}" class="mx-3" data-bs-toggle="tooltip" data-bs-original-title="Edit user">
                                            <i class="fas fa-user-edit text-secondary"></i>
                                        </a>
                                        <span>
                                            <i class="cursor-pointer fas fa-trash text-secondary"></i>
                                        </span>
                                        
                                    </td>
                                </tr>
                                <tr>
                                    <td class="ps-4">
                                        <p class="text-xs font-weight-bold mb-0">3</p>
                                    </td>
                                    <td>
                                        <div>
                                            <img src="/assets/img/team-3.jpg" class="avatar avatar-sm me-3">
                                        </div>
                                    </td>
                                    <td class="text-center">
                                        <p class="text-xs  text-dark font-weight-bold mb-0">Member</p>
                                        <p class="text-xs text-secondary mb-0">Zargarlik MFY</p>
                                    </td>
                                    <td class="text-center">
                                        <p class="text-xs  text-dark font-weight-bold mb-0">AC1685545</p>
                                        <p class="text-xs text-secondary mb-0">30922445566</p>

                                    </td>
                                    <td class="text-center">
                                        <p class="text-xs text-dark font-weight-bold mb-0">Maklatura</p>
                                        <p class="text-xs font-weight-bold mb-0">Plastik</p>
                                    </td>
                                    <td class="text-center">
                                        <p class="text-xs text-secondary mb-0">1100kg</p>
                                        <p class="text-xs text-secondary mb-0">900kg</p>

                                    </td>
                                    <td class="text-center">
                                        <a class="text-xs font-weight-bold mb-0" href="tel:+998901234567">+998901234567</a>
                                        <p class="text-secondary text-xs font-weight-bold">16/06/18</p>
                                    </td>
                                    <td class="text-center">
                                        <a href="{{route('show')}}" class="mx-3" data-bs-toggle="tooltip" data-bs-original-title="Edit user">
                                            <i class="fas fa-user-edit text-secondary"></i>
                                        </a>
                                        <span>
                                            <i class="cursor-pointer fas fa-trash text-secondary"></i>
                                        </span>
                                        
                                    </td>
                                </tr>
                                <tr>
                                    <td class="ps-4">
                                        <p class="text-xs font-weight-bold mb-0">4</p>
                                    </td>
                                    <td>
                                        <div>
                                            <img src="/assets/img/team-4.jpg" class="avatar avatar-sm me-3">
                                        </div>
                                    </td>
                                    <td class="text-center">
                                        <p class="text-xs  text-dark font-weight-bold mb-0">Peterson Creator</p>
                                        <p class="text-xs text-secondary mb-0">Zargarlik MFY</p>
                                    </td>
                                    <td class="text-center">
                                        <p class="text-xs  text-dark font-weight-bold mb-0">AC1685545</p>
                                        <p class="text-xs text-secondary mb-0">30922445566</p>

                                    </td>
                                    <td class="text-center">
                                        <p class="text-xs text-dark font-weight-bold mb-0">Maklatura</p>
                                        <p class="text-xs font-weight-bold mb-0">Shisha</p>
                                    </td>
                                    <td class="text-center">
                                        <p class="text-xs text-secondary mb-0">2100kg</p>
                                        <p class="text-xs text-secondary mb-0">700kg</p>

                                    </td>
                                    <td class="text-center">
                                        <a class="text-xs font-weight-bold mb-0" href="tel:+998901234567">+998901234567</a>
                                        <p class="text-secondary text-xs font-weight-bold">16/06/18</p>
                                    </td>
                                    <td class="text-center">
                                        <a href="{{route('show')}}" class="mx-3" data-bs-toggle="tooltip" data-bs-original-title="Edit user">
                                            <i class="fas fa-user-edit text-secondary"></i>
                                        </a>
                                        <span>
                                            <i class="cursor-pointer fas fa-trash text-secondary"></i>
                                        </span>
                                        
                                    </td>
                                </tr>
                                <tr>
                                    <td class="ps-4">
                                        <p class="text-xs font-weight-bold mb-0">5</p>
                                    </td>
                                    <td>
                                        <div>
                                            <img src="/assets/img/marie.jpg" class="avatar avatar-sm me-3">
                                        </div>
                                    </td>
                                    <td class="text-center">
                                        <p class="text-xs  text-dark font-weight-bold mb-0">Creator</p>
                                        <p class="text-xs text-secondary mb-0">Zargarlik MFY</p>
                                    </td>
                                    <td class="text-center">
                                        <p class="text-xs  text-dark font-weight-bold mb-0">AC1685545</p>
                                        <p class="text-xs text-secondary mb-0">30922445566</p>

                                    </td>
                                    <td class="text-center">
                                        <p class="text-xs text-dark font-weight-bold mb-0">Maklatura</p>
                                        <p class="text-xs font-weight-bold mb-0">Plastik</p>
                                    </td>
                                    <td class="text-center">
                                        <p class="text-xs text-secondary mb-0">400kg</p>
                                        <p class="text-xs text-secondary mb-0">880kg</p>

                                    </td>
                                    <td class="text-center">
                                        <a class="text-xs font-weight-bold mb-0" href="tel:+998901234567">+998901234567</a>
                                        <p class="text-secondary text-xs font-weight-bold">16/06/18</p>
                                    </td>
                                    <td class="text-center">
                                        <a href="{{route('show')}}" class="mx-3" data-bs-toggle="tooltip" data-bs-original-title="Edit user">
                                            <i class="fas fa-user-edit text-secondary"></i>
                                        </a>
                                        <span>
                                            <i class="cursor-pointer fas fa-trash text-secondary"></i>
                                        </span>
                                        
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="container d-flex">
                <a href="#" data-bs-toggle="modal" data-bs-target="#exampleModal" class="col-md-3 btn bg-gradient-primary btn-sm justify-content-end" type="button">+&nbsp; Qo'shish</a>
                <!-- Modal -->
                <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                  <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h1 class="modal-title fs-5" id="exampleModalLabel">Hamkor yaratish</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                      </div>
                      <div class="modal-body">
                        <x-create>F.I.O</x-create>
                      </div>
                    </div>
                  </div>
                </div>       
            </div>    
        </div>
    </div>
</div>
 
@endsection
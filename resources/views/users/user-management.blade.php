@extends('layouts.user_type.auth')

@section('content')

<div>
    <div class="alert alert-secondary mx-4" role="alert">
        <span class="text-white">
            <strong>Mijozlar ro‘yxati</strong>
        </span>
    </div>

    <div class="row">
        <div class="col-12">
            <div class="card mb-4 mx-4">
                <div class="card-header pb-0">
                    <div class="d-flex flex-row justify-content-between">
                        <div></div>
                        <div class="d-flex  staff-slct">
                            <select class="form-select form-select-sm" aria-label=".form-select-sm example">
                                <option disabled selected>F.I.O</option>
                                <option value="1">One</option>
                                <option value="2">Two</option>
                                <option value="3">yashna obod mahallsi</option>
                            </select>
                            <select class="form-select form-select-sm mx-2" aria-label=".form-select-sm example">
                                <option disabled selected>Maznil</option>
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
                <div class="card-body mt-4 px-0 pt-0 pb-2">
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
                                        Ism
                                    </th>
                                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        Manzil
                                    </th>
                                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        Telefon
                                    </th>
                                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        Yaratilgan
                                    </th>
                                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        Tahrir
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($users as $user)    
                                    @if ($user->role_id == 5) 
                                    <tr>
                                        <td class="ps-4">
                                            <p class="text-xs font-weight-bold mb-0">{{$user->id}}</p>
                                            </td>
                                            <td>
                                                <div>
                                                    <img src="https://source.boringavatars.com/beam/120/" class="avatar avatar-sm me-3">
                                                </div>
                                            </td>
                                            <td class="text-center">
                                                <p class="text-xs font-weight-bold mb-0">{{$user->name}}</p>
                                            </td>
                                            <td class="text-center">
                                                <p class="text-xs font-weight-bold mb-0">{{$user->address}}</p>
                                            </td>
                                            <td class="text-center">
                                                <p class="text-xs font-weight-bold mb-0">{{$user->phone_number}}</p>
                                            </td>
                                            <td class="text-center">
                                                <span class="text-secondary text-xs font-weight-bold">{{ ($user->created_at->format('m/d/Y')) }}</span>
                                            </td>
                                            <td class="d-flex justify-content-center align-items-center">
                                                <form class="col-1 mx-2 p-0" action="{{ route('user.destroy', $user->id) }}" method="POST">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="border border-white bg-white btn-lg shadow-none p-0" onclick="return confirm('{{ $user->id }} O‘chirishni tasdiqlaysizmi?')">
                                                        <i class="cursor-pointer fas fa-trash text-secondary"></i>
                                                    </button>
                                                </form>
                                                
                                            </td>
                                        </tr>
                                        @endif
                                    @endforeach

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="container d-flex">
                <a href="#" class="col-md-3 btn bg-gradient-primary btn-sm justify-content-end" type="button">+&nbsp; Qo'shish</a>
            </div>  
        </div>
    </div>
</div>


@endsection

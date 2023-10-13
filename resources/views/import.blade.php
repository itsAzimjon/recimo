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
                                <h6>Tushum Ro‘yxati</h6>
                            </div>
                        </div>
                        <div class="col-2 mt-4">
                            <div class="">
                                <a href="#" data-bs-toggle="modal" data-bs-target="#exampleModal"
                                    class=" btn bg-gradient-primary btn-sm justify-content-end" type="button">+&nbsp;
                                    Qo'shish</a>
                                <!-- Modal -->
                                <div class="modal fade" id="exampleModal" tabindex="-1"
                                    aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog modal-lg">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h1 class="modal-title fs-5" id="exampleModalLabel">Hamkor yaratish</h1>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                    aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <x-base-create :user="$user" :users="$users" :types="$types"></x-base-create>
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
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                            Agentlar</th>
                                        <th
                                            class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                            Vazn &
                                            Summa</th>
                                        <th
                                            class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                            Tur</th>
                                        <th
                                            class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                            Sana</th>
                                        <th class="text-secondary opacity-7"></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($bases as $index => $base)
                                        @if ($user->id == $base->user_id && $base->import > 0)

                                        {{-- Retrieve the type information for the current base --}}
                                        @php
                                        $bType = \DB::table('types')->where('id', $base->type_id)->first();
                                        $client = \DB::table('users')->where('id', $base->client_id)->first();

                                        // Retrieve the category associated with the type
                                        $category = \DB::table('categories')->where('id', $bType->category_id)->first();

                                        $categoryColors = [
                                        1 => 'bg-info',
                                        2 => 'bg-secondary',
                                        3 => 'bg-warning',
                                        4 => 'bg-danger',
                                        5 => 'bg-success',
                                        6 => 'bg-primary',
                                        ];

                                        // Get the background color based on the category's ID
                                        $backgroundColor = $categoryColors[$category->id] ?? '';
                                        @endphp

                                        <tr>
                                            <td>
                                                <div class="d-flex px-2 py-1">
                                                    <div>
                                                        @if ($client->photo)
                                                            <img src="{{ asset('storage/'.$client->photo) }}" alt="User's Photo" class="avatar avatar-sm me-3">
                                                        @else
                                                            <img src="{{ asset('assets/img/avatar.jpg') }}" alt="Default Avatar" class="avatar avatar-sm me-3">
                                                        @endif
                                                    </div>
                                                    <div class="d-flex flex-column justify-content-center">
                                                        <h6 class="mb-0 text-sm">{{$client->name}}</h6>
                                                        @foreach ($areas as $area)
                                                            @if ($client->area_id == $area->id )      
                                                                <p class="text-xs text-secondary mb-0"> {{$area->name }}</p>
                                                            @endif
                                                        @endforeach
                                                    </div>
                                                </div>
                                            </td>
                                            <td>
                                                    <p class="text-xs font-weight-bold mb-0">{{ $base->import }} kg</p>
                                                    <p class="text-xs text-secondary mb-0">{{ number_format($base->import * $bType->price, 0, '.', ',') }} som</p>
                                            </td>
                                            <td class="align-middle text-center text-sm">
                                                <span class="badge badge-sm {{ $backgroundColor }}">{{ $category->name }}</span>
                                                <p class="text-xs text-secondary mb-0">{{ $bType->name }}</p>
                                            </td>
                                            <td  class="align-middle text-center">
                                                <span
                                                    class="text-secondary text-xs font-weight-bold">{{ $base->created_at }}</span>
                                            </td>
                                            <td class="align-middle">
                                                <a href="javascript:;" class="text-secondary font-weight-bold text-xs"
                                                    data-toggle="tooltip" data-original-title="Edit user">
                                                    <i class="fas fa-pencil-alt text-secondary me-2" aria-hidden="true"></i>
                                                </a>
                                            </td>
                                        </tr>
                                        @endif
                                    @endforeach
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
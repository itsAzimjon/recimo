@extends('layouts.user_type.auth')

@section('content')

<div>
    <div class="alert alert-secondary mx-4" role="alert">
        <span class="text-white">
            <strong>Korxonalar va Zavodlar ro‘yxati</strong>
        </span>
    </div>

    <div class="row">
        <div class="col-12">
            <div class="card mb-4 mx-4">
                <div class="card-header pb-0">
                    <div class="d-flex flex-row justify-content-between mb-3">
                        <div>
                            <h5 class="mb-0">Hamkorlar</h5>
                        </div>
                        <div class="d-flex staff-slct">
                            <form id="search-form" action="{{ route('search.results') }}" method="GET" class="d-flex">
                                @csrf
                                <div class="input-group">
                                    <input type="text" name="search" class="form-control" placeholder="Search users..." aria-label="Search users">
                                    <input class="d-block" type="hidden" name="role_id" value="2"> 
                                    <button type="submit" class="border border-secondary bg-secondary text-white px-2 btn-lg shadow-none p-0">Search</button>
                                </div>
                            </form>
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
                                @foreach ($users as $user)
                                    @if ($user->role_id == 2) 
                                    <tr>
                                        <td class="ps-4">
                                            <p class="text-xs font-weight-bold mb-0">{{$user->id}}</p>
                                        </td>
                                        <td>
                                            <div class="avatar avatar-xl position-relative">
                                                @if ($user->photo)
                                                    <img src="{{ asset('storage/'.$user->photo) }}" alt="User's Photo" class="avatar avatar-sm me-3">
                                                @else
                                                    <img src="{{ asset('assets/img/avatar.jpg') }}" alt="Default Avatar" class="avatar avatar-sm me-3">
                                                @endif
                                            </div>     
                                        </td>
                                        <td class="text-center">
                                            <p class="text-xs  text-dark font-weight-bold mb-0">{{$user->name}}</p>
                                            @if ($user->area)
                                                <p class="text-xs text-secondary mb-0">{{$user->area->name}}</p>
                                            @endif
                                        </td>
                                        <td class="text-center">
                                            <p class="text-xs  text-dark font-weight-bold mb-0">{{$user->passport}}</p>
                                            <p class="text-xs text-secondary mb-0">{{$user->inn}}</p>

                                        </td>
                                        <td class="text-center">
                                            @foreach ($user->types()->where('user_id', $user->id)->get()->unique('category_id') as $type)
                                                <p class="text-xs text-dark font-weight-bold mb-0">{{$type->category->name}}</p>                                            
                                            @endforeach
                                        </td>
                                        
                                        <td class="text-center">
                                            @php
                                                $totalImport = $user->bases()->where('user_id', $user->id)->sum('import');
                                            @endphp
                                            <p class="text-xs text-secondary mb-0">{{$totalImport}}kg</p>
                                        </td>
                                        
                                        <td class="text-center">
                                            <a class="text-xs font-weight-bold mb-0" href="tel:{{ $user->phone_number}}">{{ $user->phone_number}}</a>
                                            <p class="text-secondary text-xs font-weight-bold">{{ ($user->created_at->format('m/d/Y')) }}</p>
                                        </td>
                                        <td class="justify-content-center align-items-center">
                                            <div class="d-flex">
                                                <a  href="{{ route('user.edit', $user->id) }}" class="mx-3" data-bs-toggle="tooltip" data-bs-original-title="Edit user">
                                                    <i class="fas fa-user-edit text-secondary"></i>
                                                </a>
                                                <form class="col-1 mx-2 p-0" action="{{ route('user.destroy', $user->id) }}" method="POST">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="border border-white bg-white btn-lg shadow-none p-0" onclick="return confirm('{{ $user->id }} O‘chirishni tasdiqlaysizmi?')">
                                                        <i class="cursor-pointer fas fa-trash text-secondary"></i>
                                                    </button>
                                                </form>                                                
                                            </div>
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
                        <x-create :types="$types"  :areas="$areas">
                            <x-slot name="fio">M.CH.J</x-slot>
                            <x-slot name="role_id">2</x-slot>
                        </x-create>
                      </div>
                    </div>
                  </div>
                </div>       
            </div>    
        </div>
    </div>
</div>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
  $(document).ready(function() {
    $('#search-form').submit(function(event) {
        event.preventDefault(); // Prevent the form from submitting traditionally

        var formData = $(this).serialize(); // Serialize the form data
        var url = $(this).attr('action'); // Get the form action URL

        $.get(url, formData, function(data) {
            $('#search-results').html(data); // Update the 'search-results' div with the search results
        });
    });
});

 
@endsection
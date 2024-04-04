{{-- agent hamkor create --}}
<div class="card">
    <div class="card-header pb-0 px-3">
        <h6 class="mb-0">{{ __('Profil') }}</h6>
    </div>
    <div class="card-body pt-4 p-3">
        <form action="{{ route('user.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            @if($errors->any())
            <div class="mt-3  alert alert-primary alert-dismissible fade show" role="alert">
                <span class="alert-text text-white">
                    {{$errors->first()}}</span>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">
                    <i class="fa fa-close" aria-hidden="true"></i>
                </button>
            </div>
            @endif
       
            @if(session('success'))
            <div class="m-3  alert alert-success alert-dismissible fade show" id="alert-success"
                role="alert">
                <span class="alert-text text-white">
                    {{ session('success') }}</span>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">
                    <i class="fa fa-close" aria-hidden="true"></i>
                </button>
            </div>
            @endif
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="user-name" class="form-control-label">{{ $fio }}</label>
                        <div class="@error('user.name')border border-danger rounded-3 @enderror">
                            <input class="form-control" type="text"
                                placeholder="Name" id="user-name" name="name">
                            @error('name')
                            <p class="text-danger text-xs mt-2">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                </div>
                <input type="hidden" name="role_id" value="{{ $role_id }}">
                <div class="col-md-6">
                    <label for="photo" class="form-control-label">Surat</label>
                    <div class="input-group mb-3">
                        <input type="file" name="photo" class="form-control col-12" id="inputGroupFile02" accept="image/*" capture="camera">
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="user.phone" class="form-control-label">Telefon</label>
                        <div class="@error('user.phone')border border-danger rounded-3 @enderror">
                            <div class="input-group">
                                <div class="input-group-text">+998</div>
                                <input class="form-control" type="number" placeholder="" id="number" name="phone_number">
                                @error('phone')
                                <p class="text-danger text-xs mt-2">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="user-inn" class="form-control-label">Stir</label>
                        <div class="@error('inn')border border-danger rounded-3 @enderror">
                            <input class="form-control" type="number"
                                placeholder="307546789" id="user-inn" name="inn">
                            @error('inn')
                            <p class="text-danger text-xs mt-2">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="user.location" class="form-control-label">Hudud</label>
                        <div class="@error('area_id') border border-danger rounded-3 @enderror">
                            <select class="form-select" aria-label="Default select example" name="area_id">
                                @foreach ($areas as $area)
                                    <option value="{{ $area->id }}">{{ $area->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="user.location" class="form-control-label">Manzil</label>
                        <div class="@error('user.location') border border-danger rounded-3 @enderror">
                            <input class="form-control" type="text" placeholder="Location" id="name"
                                name="address">
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="user-Passport" class="form-control-label">Passport raqam</label>
                        <div class="@error('Passport')border border-danger rounded-3 @enderror">
                            <input class="form-control" type="text"
                                placeholder="AB 1112233" id="user-Passport" name="passport">
                            @error('Passport')
                            <p class="text-danger text-xs mt-2">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        <label for="user-commission" class="form-control-label">Komissiya foizi</label>
                        <div class="@error('commission')border border-danger rounded-3 @enderror">
                            <input id="numberInput" class="form-control" type="text" value="0.02"
                             name="commission">
                            @error('commission')
                            <p class="text-danger text-xs mt-2">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        <label for="user-amount" class="form-control-label">Balansni to‘ldirish</label>
                        <div class="@error('amount')border border-danger rounded-3 @enderror">
                            <input class="form-control" type="number" placeholder="00 000"
                                id="user-amount" name="amount">
                            @error('amount')
                            <p class="text-danger text-xs mt-2">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                </div>
            </div>
           
            <div class="row mx-1 mt-3">
                @foreach ($types->groupBy('category_id') as $categoryID => $categoryTypes)
                    @php
                        $category = \DB::table('categories')->where('id', $categoryID)->first();
                    @endphp
                    <hr class="mt-3">
                    <p class="m-3" style="color: #000">{{ $category->name }}</p>
                    @foreach ($categoryTypes as $index => $item)
                        <div class="form-check col-sm-6 col-md-3 col-lg-3">
                            <input class="form-check-input" name="types[]" type="checkbox" value="{{ $item->id }}" id="fcustomCheck{{ $index }}">
                            <label class="custom-control-label px-2" for="customCheck{{ $index }}">{{ $item->name }}</label>
                        </div>
                    @endforeach
                @endforeach
            </div>
            
            <div class="d-flex justify-content-end">
                <button type="submit" class="btn bg-gradient-dark btn-md mt-4 mb-4">{{ 'Saqlash'}}</button>
            </div>
        </form>

    </div>
</div>
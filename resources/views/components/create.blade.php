<div class="card-header pb-0 px-3">
    <h6 class="mb-0">Profil Malumotlari</h6>
</div>
<div class="card-body pt-4 p-3">
    <form action="/user-profile" method="POST" role="form text-left">
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
            <div class="m-3  alert alert-success alert-dismissible fade show" id="alert-success" role="alert">
                <span class="alert-text text-white">
                {{ session('success') }}</span>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">
                    <i class="fa fa-close" aria-hidden="true"></i>
                </button>
            </div>
        @endif
        <div class="row">
            <div class="col-md-12">
                <div class="form-group">
                    <label for="user-photo" class="form-control-label">Surat</label>
                    <div class="@error('photo')border border-danger rounded-3 @enderror">
                        <input class="form-control" value="{{ auth()->user()->photo }}" type="file" id="user-photo" name="photo">
                            @error('photo')
                                <p class="text-danger text-xs mt-2">{{ $message }}</p>
                            @enderror
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label for="user-name" class="form-control-label">{{ $slot }}</label>
                    <div class="@error('user.name')border border-danger rounded-3 @enderror">
                        <input class="form-control" value="{{ auth()->user()->name }}" type="text" placeholder="Name" id="user-name" name="name">
                            @error('name')
                                <p class="text-danger text-xs mt-2">{{ $message }}</p>
                            @enderror
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label for="user-Passport" class="form-control-label">Passport raqam</label>
                    <div class="@error('Passport')border border-danger rounded-3 @enderror">
                        <input class="form-control" value="{{ auth()->user()->Passport }}" type="text" placeholder="AB 1112233" id="user-Passport" name="Passport">
                            @error('Passport')
                                <p class="text-danger text-xs mt-2">{{ $message }}</p>
                            @enderror
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label for="user.phone" class="form-control-label">Telefon</label>
                    <div class="@error('user.phone')border border-danger rounded-3 @enderror">
                        <input class="form-control" type="tel" placeholder="+998901234567" id="number" name="phone" value="{{ auth()->user()->phone }}">
                            @error('phone')
                                <p class="text-danger text-xs mt-2">{{ $message }}</p>
                            @enderror
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label for="user-inn" class="form-control-label">Stir</label>
                    <div class="@error('inn')border border-danger rounded-3 @enderror">
                        <input class="form-control" value="{{ auth()->user()->inn }}" type="text" placeholder="307546789" id="user-inn" name="inn">
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
                    <label for="user.location" class="form-control-label">Manzil</label>
                    <div class="@error('user.location') border border-danger rounded-3 @enderror">
                        <input class="form-control" type="text" placeholder="Location" id="name" name="Manzil" value="{{ auth()->user()->location }}">
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label for="user-password" class="form-control-label">Parol</label>
                    <div class="@error('password')border border-danger rounded-3 @enderror">
                        <input class="form-control"  type="password" placeholder="******" id="user-password" name="password">
                            @error('password')
                                <p class="text-danger text-xs mt-2">{{ $message }}</p>
                            @enderror
                    </div>
                </div>
            </div>
        </div>

        <div class="row mx-1">
            <label for="user-email" class="form-control-label">Plastik</label>
            <div class="form-check col-sm-6 col-md-3 col-lg-3">
                <input class="form-check-input" type="checkbox" value="" id="fcustomCheck1">
                <label class="custom-control-label px-2" for="customCheck1">Check</label>
            </div>
            <div class="form-check col-sm-6 col-md-3 col-lg-3">
                <input class="form-check-input" type="checkbox" value="" id="fcustomCheck1">
                <label class="custom-control-label px-2" for="customCheck1">Check this  checkbox</label>
            </div>
            <div class="form-check col-sm-6 col-md-3 col-lg-3">
                <input class="form-check-input" type="checkbox" value="" id="fcustomCheck1">
                <label class="custom-control-label px-2" for="customCheck1">Check this custom checkbox</label>
            </div>
            <div class="form-check col-sm-6 col-md-3 col-lg-3">
                <input class="form-check-input" type="checkbox" value="" id="fcustomCheck1">
                <label class="custom-control-label px-2" for="customCheck1">Check this custom checkbox</label>
            </div>
            <div class="form-check col-sm-6 col-md-3 col-lg-3">
                <input class="form-check-input" type="checkbox" value="" id="fcustomCheck1">
                <label class="custom-control-label px-2" for="customCheck1">Custom check</label>
            </div>
            <div class="form-check col-sm-6 col-md-3 col-lg-3">
                <input class="form-check-input" type="checkbox" value="" id="fcustomCheck1">
                <label class="custom-control-label px-2" for="customCheck1">Check this  checkbox</label>
            </div>
            <div class="form-check col-sm-6 col-md-3 col-lg-3">
                <input class="form-check-input" type="checkbox" value="" id="fcustomCheck1">
                <label class="custom-control-label px-2" for="customCheck1">This custom checkbox</label>
            </div>
            <div class="form-check col-sm-6 col-md-3 col-lg-3">
                <input class="form-check-input" type="checkbox" value="" id="fcustomCheck1">
                <label class="custom-control-label px-2" for="customCheck1">Check this custom checkbox</label>
            </div>
        </div>
        
        <div class="d-flex justify-content-end">
            <button type="button" class="btn bg-gradient-secondary  btn-md mt-4 mb-4 mx-3" data-bs-dismiss="modal">Yopish</button>
            <button type="submit" class="btn bg-gradient-primary btn-md mt-4 mb-4">Saqlash</button>
        </div>
    </form>

</div>

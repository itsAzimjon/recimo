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
    </form>

</div>

<div class="card">
    <div class="card-header pb-0 px-3">
        <h6 class="mb-0">{{ __('Profile Information') }}</h6>
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
                            <input class="form-control" type="tel" placeholder="+998901234567" id="number" name="phone_number">
                            @error('phone')
                            <p class="text-danger text-xs mt-2">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>
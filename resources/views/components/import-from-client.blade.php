<div class="card">
    <div class="card-body pt-4 p-3">
        <form action="{{ route('importFromClient') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label for="client_id">Mijozni tanlang</label>
                <input type="text" id="client_search" class="form-control form-control-sm" placeholder="Mijozni izlash...">
                <select name="client_id" class="form-select" aria-label="Default select example" required>
                    <option selected disabled>Mijoz</option>
                    @foreach ($users as $user)
                        @if ($user->role_id == 5 && auth()->user()->can('agent')) 
                            <option value="{{ $user->id }}">{{ $user->phone_number }} ( {{ $user->id }} )</option>
                        @endif
                        <!--@if ($user->role_id != 5 && $user->role_id != auth()->user()->id) -->
                        <!--    <option value="{{ $user->id }}">{{ $user->name }} {{ $user->id }}</option>-->
                        <!--@endif-->
                    @endforeach
                </select>
            </div>
            <div class="form-gr">
                <input type="hidden" name="user_id" value="{{ auth()->user()->id }}">
            </div>
            <div id="product-rows">
                <div class="row product-row mb-3">
                    <div class="col-8">
                        <label for="type_id" class="form-label">Mahsulot turini tanlang</label>
                        <div class="input-gr">
                            <input type="text" class="d-none form-control form-control-sm type-search" placeholder="Mahsulot turnini izlash...">
                            <select required name="type_id[]" class="form-select type-id" aria-label="Default select example">
                                <option selected disabled>Tur</option>
                                @foreach ($types as $type)
                                    <option value="{{ $type->id }}">{{ $type->name }} {{ $type->id }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-4">
                        <label for="sale" class="form-label">KG</label>
                        <input required type="number" name="sale[]" class="form-control sale">
                    </div>
                </div>
            </div>
            <div class="row mb-3 justify-content-between">
                <div class="col-md-6">
                    <div class="row">
                        <div class="col-md-6">
                            <button id="add-row" class="btn btn-sm btn-info w-100">Qo‘shish</button>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="d-flex justify-content-end">
                        <button type="submit" class="btn btn-md bg-gradient-dark w-100">Saqlash</button>
                    </div>
                </div>
            </div>
        </form>        
    </div>
</div>
            
  
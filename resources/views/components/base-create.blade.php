<div class="card">
    <div class="card-body pt-4 p-3">-
        <form action="{{ route('sale.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label for="client_id">Mijozni tanlang</label>
                <input type="text" id="client_search" class="form-control form-control-sm" placeholder="Mijozni izlash...">
                <select name="client_id" id="client_select" class="form-select" aria-label="Default select example" required>
                    <option selected disabled>Mijoz</option>
                    @foreach ($users as $user)
                        @if ($user->role_id == 5 && auth()->user()->can('agent')) 
                            <option value="{{ $user->id }}">{{ $user->phone_number }}</option>
                        @endif
                        @if ($user->id != auth()->user()->id) 
                            <option value="{{ $user->id }}">{{ $user->phone_number }}</option>
                        @endif
                    @endforeach
                </select>
            </div>                            
            <div class="form-group">
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
                                    <option value="{{ $type->id }}" data-price="{{ $type->price }}">{{ $type->name }} {{ $type->id }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-4">
                        <label for="sale" class="form-label">KG</label>
                        <input required type="number" name="sale[]" class="form-control sale" data-price="">
                    </div>
                    <small class="text-muted">Narxi: <span class="calculated-price">0.00</span></div>
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
                <div class="col-md-6">
                    <div class="d-flex justify-content-end">
                        <input type="hidden" name="money_switch" id="money_switch_value" value="1"> 
                        <button type="submit" class="btn btn-md btn-success  w-100" onclick="setMoneySwitchValue(1)">Hamyondan to‘lash</button>
                        <div class="mx-1"></div>
                        <button type="submit" class="btn btn-md bg-gradient-dark w-100" onclick="setMoneySwitchValue(0)">Naqt to‘lash</button>
                    </div>
                </div>
            </div>
            <div>Umumiy narx: <span id="total-price">0</span></div>
            <input type="hidden" name="total" id="total-price-input" value="0">
        </form>
    </div>
</div>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const input = document.getElementById('client_search');
        const select = document.getElementById('client_select');
        
        input.addEventListener('input', function () {
            const searchText = input.value.trim().toLowerCase();
            const options = select.getElementsByTagName('option');
            
            for (let option of options) {
                if (option.textContent.toLowerCase().includes(searchText)) {
                    option.selected = true;
                    return;
                }
            }
            
            // If no matching option found, deselect any selected option
            select.selectedIndex = -1;
        });
    });
</script>
            
  
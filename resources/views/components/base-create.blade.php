<div class="card">
    <div class="card-header pb-0 px-3">
        <h6 class="mb-0">{{ __('Profile Information') }}</h6>
    </div>
    <div class="card-body pt-4 p-3">
        <form action="{{ route('sale.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <input type="hidden" name="user_id" value="{{$user->id}}">
            </div>
            <div class="form-group">
                <label for="type_id">Select Type</label>
                <input type="text" id="type_search" class="form-control form-control-sm" placeholder="Search for a type...">
                <select required name="type_id" class="form-select" aria-label="Default select example">
                    <option selected disabled>type</option>
                    @foreach ($types as $type)
                        <option value="{{ $type->id }}">{{ $type->name }} {{ $type->id }}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label for="client_id">Select Client</label>
                <input type="text" id="client_search" class="form-control form-control-sm" placeholder="Search for a client...">
                <select name="client_id" class="form-select" aria-label="Default select example" required>
                    <option selected disabled>client</option>
                    @foreach ($users as $user)
                        @if ($user->role_id == 5 && auth()->user()->can('agent')) 
                            <option value="{{ $user->id }}">{{ $user->name }} {{ $user->id }}</option>
                        @endif
                        @if ($user->role_id != 5 && $user->role_id != auth()->user()->id) 
                            <option value="{{ $user->id }}">{{ $user->name }} {{ $user->id }}</option>
                        @endif
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label for="sale">Mahsulot vazni</label>
                <input required type="number" name="sale" class="form-control">
            </div>
            <div class="d-flex justify-content-end">
                <button type="submit" class="btn bg-gradient-dark btn-md mt-4 mb-4">{{ 'Save Changes' }}</button>
            </div>
        </form>        
    </div>
</div>
<script>
    const typeSearchInput = document.getElementById('type_search');
    const clientSearchInput = document.getElementById('client_search');

    const typeSelectElement = document.querySelector('select[name="type_id"]');
    const clientSelectElement = document.querySelector('select[name="client_id"]');

    const typeOptions = Array.from(typeSelectElement.options);
    const clientOptions = Array.from(clientSelectElement.options);

    function updateOptions(inputElement, selectElement, options) {
        const searchValue = inputElement.value.toLowerCase();

        const filteredOptions = options.filter(option => option.textContent.toLowerCase().includes(searchValue));

        selectElement.innerHTML = '';

        filteredOptions.forEach(option => {
            selectElement.appendChild(option.cloneNode(true));
        });
    }

    typeSearchInput.addEventListener('input', function() {
        updateOptions(typeSearchInput, typeSelectElement, typeOptions);
    });

    clientSearchInput.addEventListener('input', function() {
        updateOptions(clientSearchInput, clientSelectElement, clientOptions);
    });
</script>


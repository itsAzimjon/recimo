<div class="card">
    <div class="card-header pb-0 px-3">
        <h6 class="mb-0">{{ __('Profile Information') }}</h6>
    </div>
    <div class="card-body pt-4 p-3">
        <form action="{{ route('createNewProduct') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <input type="hidden" name="user_id" value="{{$user->id}}">
            </div>
            <div class="form-group">
                <label for="type_id">Select Type</label>
                <input type="text" id="type_search" class="form-control form-control-sm" placeholder="Search for a type...">
                <select name="type_id" class="form-select" aria-label="Default select example">
                    <option selected disabled>type</option>
                    @foreach ($types as $type)
                        <option value="{{ $type->id }}">{{ $type->name }} {{ $type->id }}</option>
                    @endforeach
                </select>
            </div>
           
            <div class="form-group">
                <label for="sale">Mahsulot vazni</label>
                <input type="number" name="sale" class="form-control">
            </div>
            <div class="d-flex justify-content-end">
                <button type="submit" class="btn bg-gradient-dark btn-md mt-4 mb-4">{{ 'Save Changes' }}</button>
            </div>
        </form>        
    </div>
</div>
<script>
    const typeSearchInput = document.getElementById('type_search');

    const typeSelectElement = document.querySelector('select[name="type_id"]');

    const typeOptions = Array.from(typeSelectElement.options);

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
</script>


<div class="card">
    <div class="card-header pb-0 px-3">
        <h6 class="mb-0">{{ __('Buyurtmachi malumotlari') }}</h6>
    </div>
    <div class="card-body pt-4 p-3">
        <form action="{{ route('order-store') }}" method="POST">
            @csrf
            <div class="form-group d-none">
                <input type="hidden" name="user_id" value="{{ auth()->user()->id }}">
                <input type="hidden" name="area" value="{{ auth()->user()->area->name }}">
                <input type="hidden" name="address" value="{{ auth()->user()->address }}">
            </div>
            <ul class="list-group mb-4">
                <li class="list-group-item">Ism: {{ auth()->user()->name }}</li>
                <li class="list-group-item">Hudud: {{ auth()->user()->area->name }}</li>
                <li class="list-group-item">Manzil: {{ auth()->user()->address }}</li>
            </ul>
            <div class="form-group">
                <label for="type_id">Select Type</label>
                <input type="text" id="type_search" class="form-control form-control-sm" placeholder="Search for a type...">
                <select name="category_id" class="form-select" aria-label="Default select example">
                    <option selected disabled>type</option>
                    @foreach ($categories as $category)
                        <option value="{{ $category->id }}">{{ $category->name }} {{ $category->id }}</option>
                    @endforeach
                </select>
            </div>
           
            <div class="form-group">
                <label for="weight">Mahsulot vazni</label>
                <input type="number" name="weight" class="form-control">
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


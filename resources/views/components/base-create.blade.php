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
                <select name="type_id" class="form-select" aria-label="Default select example">
                    <option selected disabled>type</option>
                    @foreach ($types as $type)
                        <option value="{{ $type->id }}">{{ $type->name }} {{ $type->id }}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label for="client_id">Select Client</label>
                <input type="text" id="client_search" class="form-control form-control-sm" placeholder="Search for a client...">
                <select name="client_id" class="form-select" aria-label="Default select example">
                    <option selected disabled>client</option>
                    @foreach ($users as $user)
                        <option value="{{ $user->id }}">{{ $user->name }} {{ $user->id }}</option>
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
    // Get the input and select elements
    const searchInput = document.getElementById('search');
    const selectElement = document.querySelector('select');

    // Create an array to store all option elements
    const options = Array.from(selectElement.options);

    // Listen for input in the search box
    searchInput.addEventListener('input', function() {
        const searchValue = searchInput.value.toLowerCase();

        // Filter and update the options based on the search value
        const filteredOptions = options.filter(option => option.textContent.toLowerCase().includes(searchValue));
        
        // Clear the select element
        selectElement.innerHTML = '';

        // Append the filtered options to the select element
        filteredOptions.forEach(option => {
            selectElement.appendChild(option);
        });
    });
</script>

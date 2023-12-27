@extends('layouts.user_type.auth')

@section('content')

<div class="card h-100 mb-4">
    <div class="card-header pb-0 px-3">
        <div class="row">
            <div class="col-md-12">
                <h6 class="mb-2">Ombordagi Mahsulotlar</h6>
            </div>
        </div>
    </div>
    <hr>
    <div class="card-body pt-4 p-3">
        @php
        // Define an array of background colors for each category ID
        $categoryColors = [
            1 => 'bg-info',
            2 => 'bg-secondary',
            3 => 'bg-warning',
            4 => 'bg-danger',
            5 => 'bg-success',
            6 => 'bg-primary', 
        ];
        
        // Get all unique category names and IDs for the user
        $categories = $user->bases()
            ->join('types', 'bases.type_id', '=', 'types.id')
            ->join('categories', 'types.category_id', '=', 'categories.id')
            ->select('categories.id as category_id', 'categories.name as category_name')
            ->distinct()
            ->get();
        @endphp
        
        @foreach ($categories as $category)
            {{-- Assign a background color based on the category's ID --}}
            @php
            $backgroundColor = $categoryColors[$category->category_id];
            
            $typeImport = $user->bases()
                ->join('types', 'bases.type_id', '=', 'types.id')
                ->join('categories', 'types.category_id', '=', 'categories.id')
                ->where('types.category_id', $category->category_id)
                ->where('bases.status', 1)
                ->sum('import');
            
            $typeExport = $user->bases()
                ->join('types', 'bases.type_id', '=', 'types.id')
                ->join('categories', 'types.category_id', '=', 'categories.id')
                ->where('types.category_id', $category->category_id)
                ->where('bases.status', 1)
                ->sum('export');
            
            $net = $typeImport - $typeExport; // Calculate the net result
            @endphp
            
            <h6 class="text-uppercase text-s font-weight-bolder mb-3 px-3 py-1 {{ $backgroundColor }} d-flex justify-content-between">
                <span>{{ $category->category_name }}</span>
                <span>{{ $net }} kg</span>
            </h6>
            
            @php
            // Get all unique type names within the current category
            $typeNames = $user->bases()
                ->join('types', 'bases.type_id', '=', 'types.id')
                ->join('categories', 'types.category_id', '=', 'categories.id')
                ->where('categories.id', $category->category_id)
                ->select('types.name as type_name')
                ->distinct()
                ->pluck('type_name');
            @endphp
        
            @foreach ($typeNames as $typeName)
                <ul class="list-group">
                    <li
                        class="list-group-item border-0 d-flex justify-content-between ps-0 mb-2 border-radius-lg">
                        <div class="d-flex align-items-center">
                            <div class="d-flex flex-column">
                                <h6 class="mb-1 text-dark text-sm">{{ $typeName }}</h6>
                            </div>
                        </div>
                        @php
                            $typeImportSum = $user->bases()
                                ->join('types', 'bases.type_id', '=', 'types.id')
                                ->join('categories', 'types.category_id', '=', 'categories.id')
                                ->where('categories.id', $category->category_id)
                                ->where('types.name', $typeName)
                                ->where('bases.status', 1)
                                ->sum('import');

            
                            $typeExportSum = $user->bases()
                                ->join('types', 'bases.type_id', '=', 'types.id')
                                ->join('categories', 'types.category_id', '=', 'categories.id')
                                ->where('categories.id', $category->category_id)
                                ->where('types.name', $typeName)
                                ->where('bases.status', 1)
                                ->sum('export');

            
                            $netResult = $typeImportSum - $typeExportSum;
                        @endphp
        
                        <div class="d-flex align-items-center text-dark text-sm font-weight-bold">
                            {{ $netResult }} <span class="mx-2">kg</span>
                        </div>
                    </li>
                </ul>
            @endforeach
        @endforeach
        
        </ul>
    </div>
</div>
@endsection


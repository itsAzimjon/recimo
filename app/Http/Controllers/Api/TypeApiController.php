<?php

namespace App\Http\Controllers\Api;
use App\Http\Controllers\Controller;

use App\Http\Resources\TypeResource;
use App\Models\Area;
use App\Models\Category;
use App\Models\Type;
use Illuminate\Http\Request;

class TypeApiController extends Controller
{
    public function index()
    {
        $types = Type::all();

        return TypeResource::collection($types);
    }

    public function category()
    {
        return  Category::all();
    }

    public function area()
    {
        return  Area::all();
    }
}

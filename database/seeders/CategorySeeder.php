<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $categories = [
            ['name' => 'Пластик'],
            ['name' => 'Металлом'],
            ['name' => 'Макалатура'],
            ['name' => 'Шиша'],
            ['name' => 'Ёгоч'],
            ['name' => 'Газламалар']
        ];

        Category::insert($categories);
    }
}

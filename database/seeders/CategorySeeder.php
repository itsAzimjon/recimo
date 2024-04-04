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
            ['name' => 'Polimer'],
            ['name' => 'Metallom'],
            ['name' => 'Maklatura'],
            ['name' => 'Shisha'],
            ['name' => 'Yog‘och'],
            ['name' => 'Gazlama']
        ];

        Category::insert($categories);
    }
}

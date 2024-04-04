<?php

namespace Database\Seeders;

use App\Models\Area;
use App\Models\Region;
use Illuminate\Database\Seeder;

class AreaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $region = ['name' => 'Jizzax'];
        $regionId = Region::insertGetId($region);
    
        $area = [['region_id' => $regionId]];
        Area::insert($area);
    }    
}

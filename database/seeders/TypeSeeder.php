<?php

namespace Database\Seeders;

use App\Models\Type;
use Illuminate\Database\Seeder;

class TypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $tags = [
            ['category_id' => '1', 'name' => 'Baklashka', 'price' => '2000'],
            ['category_id' => '1', 'name' => 'Plastik', 'price' => '2000'],
            ['category_id' => '1', 'name' => 'Avtobufer', 'price' => '1000'],
            ['category_id' => '1', 'name' => 'Plastik va dekorlar', 'price' => '700'],
            ['category_id' => '1', 'name' => 'Alukobond qoplamalar', 'price' => '500'],
            ['category_id' => '1', 'name' => 'Santexnika va kanalizatsiya quvurlari', 'price' => '500'],
            ['category_id' => '1', 'name' => 'Rezina basseyn', 'price' => '500'],
            ['category_id' => '1', 'name' => 'Rangli rezina shlang', 'price' => '500'],
            ['category_id' => '1', 'name' => 'Rezina o‘yinchoqlar', 'price' => '500'],
            ['category_id' => '1', 'name' => 'Yumshoq selofan paketlar', 'price' => '500'],
            ['category_id' => '1', 'name' => 'Metraj selofan', 'price' => '1500'],
            ['category_id' => '1', 'name' => 'Qichirloq selofan va paketlar', 'price' => '200'],
            ['category_id' => '1', 'name' => 'Blok paketlar', 'price' => '5000'],
            ['category_id' => '1', 'name' => 'Penaplast', 'price' => '1000'],
            ['category_id' => '2', 'name' => 'Metallom', 'price' => '1200'],
            ['category_id' => '2', 'name' => 'Alyumin bankalar', 'price' => '1500'],
            ['category_id' => '2', 'name' => 'Akfa, alyuminiy va boshqa romlar', 'price' => '3000'],
            ['category_id' => '2', 'name' => 'Orgtexnikalar', 'price' => '1000'],
            ['category_id' => '3', 'name' => 'Maklatura', 'price' => '1200'],
            ['category_id' => '4', 'name' => 'Xar-xil butilkalar', 'price' => '200'],
            ['category_id' => '4', 'name' => 'Siniq oynalar', 'price' => '100'],
            ['category_id' => '4', 'name' => 'Bo‘shagan qoplar', 'price' => '500'],
            ['category_id' => '5', 'name' => 'Yog‘och matryallar', 'price' => '150'],

        ];

        Type::insert($tags);
    }
}

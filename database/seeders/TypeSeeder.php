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
            ['category_id' => '1', 'name' => 'Баклашка', 'price' => '2000'],
            ['category_id' => '1', 'name' => 'Пластмасса', 'price' => '2000'],
            ['category_id' => '1', 'name' => 'Автобуфер', 'price' => '1000'],
            ['category_id' => '1', 'name' => 'Пластик ва декорлар', 'price' => '700'],
            ['category_id' => '1', 'name' => 'Алюкобонд копламалар', 'price' => '500'],
            ['category_id' => '1', 'name' => 'Сантехника ва каналиция трубалар', 'price' => '500'],
            ['category_id' => '1', 'name' => 'Резина бассейн', 'price' => '500'],
            ['category_id' => '1', 'name' => 'Рангли резина шланг', 'price' => '500'],
            ['category_id' => '1', 'name' => 'Резина ўйинчоқлар', 'price' => '500'],
            ['category_id' => '1', 'name' => 'Юмшок целлофан пакетлар', 'price' => '500'],
            ['category_id' => '1', 'name' => 'Метраж целлофан', 'price' => '1500'],
            ['category_id' => '1', 'name' => 'Кичирлок целлофан ва пакетлар', 'price' => '200'],
            ['category_id' => '1', 'name' => 'Блок пакетлар', 'price' => '5000'],
            ['category_id' => '1', 'name' => 'Пенапласт', 'price' => '1000'],
            ['category_id' => '2', 'name' => 'Металлом', 'price' => '1200'],
            ['category_id' => '2', 'name' => 'Алюмин банкалар', 'price' => '1500'],
            ['category_id' => '2', 'name' => 'Аква ва алюмин бошка ромлар', 'price' => '3000'],
            ['category_id' => '2', 'name' => 'Оргтехникалар', 'price' => '1000'],
            ['category_id' => '3', 'name' => 'Макалатура', 'price' => '1200'],
            ['category_id' => '4', 'name' => 'Ҳар ҳил бутилкалар', 'price' => '200'],
            ['category_id' => '4', 'name' => 'Синик ойналар', 'price' => '100'],
            ['category_id' => '4', 'name' => 'Бўшаган қоплар', 'price' => '500'],
            ['category_id' => '5', 'name' => 'Ёгоч материаллар', 'price' => '150'],

        ];

        Type::insert($tags);
    }
}

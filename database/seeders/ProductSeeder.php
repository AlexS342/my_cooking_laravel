<?php

namespace Database\Seeders;

use App\Enums\Recipe\ProductUnits;
use App\Models\Product;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $arr_products = [
            ['Помидоры', 400, ProductUnits::GRAM->value,],
            ['Картофель', 300, ProductUnits::GRAM->value,],
            ['Огурцы', 670, ProductUnits::GRAM->value,],
            ['Грецка', 120, ProductUnits::GRAM->value,],
            ['Рис', 350, ProductUnits::GRAM->value,],
            ['Баклажан', 200, ProductUnits::GRAM->value,],
            ['Свенина (Вырезка)', 250, ProductUnits::GRAM->value,],
            ['Осетр (филе)', 440, ProductUnits::GRAM->value,],
            ['Курица (Грудка)', 630, ProductUnits::GRAM->value,],
            ['Кролик (тушка)', 400, ProductUnits::GRAM->value,],
            ['Яблоки красные', 300, ProductUnits::GRAM->value,],
            ['Колбаса вареная "Докторская"', 150, ProductUnits::GRAM->value,],
            ['Огурцы маринованые (карнишоны)', 5, ProductUnits::SHT->value,],
            ['Перец красный острый свежий', 2, ProductUnits::SHT->value,],
            ['Перец балгарский сладкий', 6, ProductUnits::SHT->value,],
            ['Укроп (свежий)', 4, ProductUnits::SHT->value,],
            ['Укроп сушеный', null, ProductUnits::PVK->value,],
            ['Перец черный горошком', 3, ProductUnits::SHT->value,],
            ['Перец красный молотый', null, ProductUnits::PVK->value,],
            ['Соль', null, ProductUnits::PVK->value,],
        ];

        for ($i = 0; $i < 7; $i++)
        {
            $recipe_id = $i + 1;

            for ($j = 0; $j < 10; $j++)
            {
                $data['recipe_id'] = $recipe_id;

                $product = $arr_products[array_rand($arr_products, 1)];

                $data['name'] = $product[0];
                $data['quantity'] = $product[1];
                $data['units'] = $product[2];

                DB::table('products')->insert($data);
            }

        }

    }
}

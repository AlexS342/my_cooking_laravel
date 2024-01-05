<?php

namespace Database\Seeders;

use App\Enums\Recipe\ActionUnits;
use App\Models\Action;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ActionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $arr_products = [
            ['Нарезать помидорки тонкими круглишками', 3, ActionUnits::MN->value,],
            ['Отмарить картофеть в мундире', 5, ActionUnits::MN->value,],
            ['Нарезать огуцы соломкой', 7, ActionUnits::MN->value,],
            ['Отварить гречку в большой кастрюле', 15, ActionUnits::MN->value,],
            ['Отварить рис в большой кастрюле', 36, ActionUnits::MN->value,],
            ['Нарезать баклажаны колечками и уложить на них натертый сыр', 200, ActionUnits::SK->value,],
            ['Обжарить в кипящем масле', 25, ActionUnits::MN->value,],
            ['Посолить и дать постоять в маринаде', 440, ActionUnits::SK->value,],
            ['Запекать в духовке до румяной корочки', 2, ActionUnits::MN->value,],
            ['Тушить на медленом огне, периодически помешивая', 1, ActionUnits::DN->value,],
            ['На тереть на мелкой терке и отжать сок в марле. нужна мякоть без сока', 300, ActionUnits::MN->value,],
            ['Нарезать мелкими кусочками разной формы и размера', 150, ActionUnits::SK->value,],
            ['Нарезать карнишоны мелкими кубиками', 5, ActionUnits::MN->value,],
            ['Закинуть в кастрюлю красные перцы', 2, ActionUnits::MN->value,],
            ['Нарезать болгарский перец соломкой и добавить в зажарку', 6, ActionUnits::MN->value,],
            ['Мелко порезать укром и посыпать им блюдо', 4, ActionUnits::MN->value,],
            ['Добавить укоп и перец по вкусу', null, ActionUnits::MN->value,],
            ['Добавить перец', 3, ActionUnits::MN->value,],
            ['Добавить специи', null, ActionUnits::MN->value,],
            ['Посолить', null, ActionUnits::MN->value,],
        ];

        for ($i = 0; $i < 7; $i++)
        {
            $recipe_id = $i + 1;

            for ($j = 0; $j < 15; $j++)
            {
//                $product = $arr_products[array_rand($arr_products, 1)];
//                $name = $product[0];
//                $quantity = $product[1];
//                $units = $product[2];
//
//                Action::factory()->create([
//                    'recipe_id' => $recipe_id,
//                    'name' => $name,
//                    'quantity' => $quantity,
//                    'units' => $units,
//                ]);


                $data['recipe_id'] = $recipe_id;

                $product = $arr_products[array_rand($arr_products, 1)];

                $data['name'] = $product[0];
                $data['quantity'] = $product[1];
                $data['units'] = $product[2];

                DB::table('actions')->insert($data);
            }

        }

    }
}

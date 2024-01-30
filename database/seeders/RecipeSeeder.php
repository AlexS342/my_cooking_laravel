<?php

namespace Database\Seeders;

use App\Models\Recipe;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RecipeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $titles = [
            'Горячая слива',
            'Селёдка по африкански в ликёре',
            'Гартошка по деревенски с грибами',
            'Домашнее лечо с яблоком',
            'Салат "Испанская шляпа"',
            'Куропатка в томатном соусе',
            'Апетитные хрустяшки'
        ];
        $descriptions =[null,];
        $full_times = ['570 мин', '84 мин', '48 мин', '120 мин', '36 мин'];
        $portions = [4, 6, 5, 5, 3, 2, 8,];
        $type = ['горячее', 'холодное', 'другое', 'не указано'];
        $category = ['выпеска', 'гарниры', 'другое', 'десерты', 'мясо', 'напитки', 'не указано', 'овощи', 'рыба', 'салаты', 'супы', 'соусы', 'фрукты',];

        foreach ($titles as $item)
        {
            $data['user_id'] = rand(1,2);
            $data['description'] = $descriptions[0];
            $data['title'] = $item;
            $data['full_time'] = $full_times[rand(0, count($full_times)-1)];
            $data['portion'] = rand(0, count($portions)-1);
            $data['type'] = $type[rand(0, count($type)-1)];
            $data['category'] = $category[rand(0, count($category)-1)];

            DB::table('recipes')->insert($data);
        }
    }
}

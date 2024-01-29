<?php

namespace App\Enums\Recipe;

enum TypeRecipes: string
{
    CASE HOT = 'горячее';
    CASE COLT = 'холодное';

    CASE DR = 'другое';
    CASE NK = 'не указано';

    public static function getEnums() : array
    {
        return [
            self::HOT->value,
            self::COLT->value,
            self::DR->value,
            self::NK->value,
        ];
    }
}

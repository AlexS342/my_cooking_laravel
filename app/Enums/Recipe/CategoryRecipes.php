<?php

namespace App\Enums\Recipe;

enum CategoryRecipes: string
{
    CASE VP = 'выпеска';
    CASE GR = 'гарниры';
    CASE DR = 'другое';
    CASE DS = 'десерты';
    CASE MS = 'мясо';
    CASE NP = 'напитки';
    CASE NK = 'не указано';
    CASE OV = 'овощи';
    CASE RB = 'рыба';
    CASE SL = 'салаты';
    CASE SP = 'супы';
    CASE SO = 'соусы';
    CASE FR = 'фрукты';

    public static function getEnums() : array
    {
        return [
            self::VP->value,
            self::GR->value,
            self::DR->value,
            self::DS->value,
            self::MS->value,
            self::NP->value,
            self::NK->value,
            self::OV->value,
            self::RB->value,
            self::SP->value,
            self::SL->value,
            self::SO->value,
            self::FR->value,
        ];
    }
}

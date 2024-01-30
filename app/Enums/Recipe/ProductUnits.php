<?php

namespace App\Enums\Recipe;

enum ProductUnits:string
{
    CASE KG = 'кг';
    CASE GRAM = 'г.';
    CASE LITER = 'л.';
    CASE ML = 'мл';
    CASE SHT = 'шт';
    CASE STL = 'ст.л.';
    CASE DSL = 'дес.л.';
    CASE CHL = 'ч.л.';
    CASE ST = 'ст.';
    CASE UP = 'уп.';
    CASE PVK = 'по вкусу';

    public static function getEnums() : array
    {
        return [
            self::KG->value,
            self::GRAM->value,
            self::LITER->value,
            self::ML->value,
            self::SHT ->value,
            self::STL->value,
            self::DSL->value,
            self::CHL->value,
            self::ST->value,
            self::UP ->value,
            self::PVK ->value,
        ];
    }
}

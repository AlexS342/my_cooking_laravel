<?php

namespace App\Enums\Recipe;

enum ProductUnits:string
{
    CASE KG = 'кг';
    CASE GRAM = 'грамм';
    CASE LITER = 'литр';
    CASE ML = 'мил. литр';
    CASE SHT = 'шт.';
    CASE STL = 'ст.ложка';
    CASE DSL = 'дес.ложка';
    CASE CHL = 'ч.ложка';
    CASE ST = 'стакан';
    CASE UP = 'уп.';
    CASE PVK = 'по вкусу';

    public static function getEnums() : array
    {
        return [
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

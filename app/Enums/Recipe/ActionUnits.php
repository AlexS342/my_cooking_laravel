<?php

namespace App\Enums\Recipe;

enum ActionUnits:string
{
    CASE DN = 'д.';
    CASE CH = 'ч.';
    CASE MN = 'мин.';
    CASE SK = 'сек.';

    public static function getEnums() : array
    {
        return [
            self::DN->value,
            self::CH->value,
            self::MN->value,
            self::SK ->value,
        ];
    }
}

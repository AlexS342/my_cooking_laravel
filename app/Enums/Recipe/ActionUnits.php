<?php

namespace App\Enums\Recipe;

enum ActionUnits:string
{
    CASE DN = 'День';
    CASE CH = 'Час';
    CASE MN = 'Минута';
    CASE SK = 'Секунда';

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

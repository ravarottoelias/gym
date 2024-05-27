<?php

namespace App\Utils;

class FormatterUtilities
{
    public static function formatPrice($float)
    {
        $english_format_number = number_format($float, 2, '.', '');

        return $english_format_number;
    }
}
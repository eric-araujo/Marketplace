<?php

namespace App\Traits;

trait FormatMoney
{
    private function formatMoney($value)
    {
        $price = explode(',', $value);
        $price[0] = str_replace([',', '.'], '', $price[0]);
        
        return $price[0].'.'.$price[1];
    }

}
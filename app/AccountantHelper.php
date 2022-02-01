<?php

namespace App;

class AccountantHelper
{

    static function  findProfit($amount)
    {
        $profitPercent = 10;

        return ($profitPercent * $amount) / 100;
    }
}

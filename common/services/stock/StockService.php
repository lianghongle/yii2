<?php

namespace common\services\stock;

use common\models\stock\Stock;

class StockService
{
    public static function detail()
    {
        return Stock::findOne('000001');
    }
}
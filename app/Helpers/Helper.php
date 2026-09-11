<?php

namespace App\Helpers;

use Illuminate\Http\Request;


abstract class Helper
{
    public $defaultItemsPerPage = 20;

    public function dbInsertTime($dateTime = null)
    {
        if (!empty($dateTime)) {
            $now = date('Y-m-d H:i:s', strtotime($dateTime));
        } else {
            $now = date('Y-m-d H:i:s', time());
        }

        return $now;
    }

}

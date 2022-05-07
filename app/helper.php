<?php

use Carbon\Carbon;



if (!function_exists('dateSql2Uk')) {
    function dateSql2Uk($date)
    {
        return $date?Carbon::createFromFormat('Y-m-d', $date)->format('d/m/Y'):'';
    }
}
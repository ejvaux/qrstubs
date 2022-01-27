<?php

namespace App;

use Carbon\Carbon;

class CustomFunctions
{
    public static function generateExpirationDate($ctrl)
    {
        /*$co = substr($ctrl,9);*/
        $year = substr($ctrl,3,4);
        $month = substr($ctrl,7,2);
        if (substr($ctrl,9) == 'A') {
            $date = '16';
            $exp = $date.'-'.$month.'-'.$year;
        } else {
            $date = '01';
            $exp = $date.'/'.$month.'/'.$year;
            $exp = Carbon::createFromFormat('d/m/Y',$exp)->addMonth()->format('d-m-Y');
        }

        return $exp;
    }

    public static function generateControlNum(){
        $year = Carbon::now()->format('Y');
        $month = Carbon::now()->format('m');
        $day = Carbon::now()->format('d');
        $con = 'SPI'.$year.$month;
        if ($day <= 15) {
            $con = $con.'A';
        } else {
            $con = $con.'B';
        }
        return $con;
    }
}
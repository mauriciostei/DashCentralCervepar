<?php

namespace App\Traits;

trait AddTimeIntervals{
    public function toSecond($value){
        $hh = $mm = $ss = 0;
        sscanf( $value, '%d:%d:%d', $hh, $mm, $ss);

        return ($hh * 3600) + ($mm * 60) + $ss;
    }

    public function toInterval($value){
        $dd = $hh = $mm = $ss = 0;
        
        $ss = $value;
        $mm = floor( $ss / 60 ); $ss = $ss % 60;
        $hh = floor( $mm / 60 ); $mm = $mm % 60;
        $dd = floor( $hh / 24 ); $hh = $hh % 24;

        $hh = str_pad($hh, 2, "0", STR_PAD_LEFT);
        $mm = str_pad($mm, 2, "0", STR_PAD_LEFT);
        $ss = str_pad($ss, 2, "0", STR_PAD_LEFT);

        return "$dd días $hh:$mm:$ss horas";
    }

    public function toTime($value){
        $hh = $mm = $ss = 0;
        
        $ss = $value;
        $mm = floor( $ss / 60 ); $ss = $ss % 60;
        $hh = floor( $mm / 60 ); $mm = $mm % 60;

        $hh = str_pad($hh, 2, "0", STR_PAD_LEFT);
        $mm = str_pad($mm, 2, "0", STR_PAD_LEFT);
        $ss = str_pad($ss, 2, "0", STR_PAD_LEFT);

        return "$hh:$mm:$ss";
    }
}
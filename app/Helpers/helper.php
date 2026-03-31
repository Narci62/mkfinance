<?php

use Carbon\Carbon;

if(!function_exists('format_money')){
    function format_money($montant,$decimal=2,$devise = "F"){
        return number_format($montant,$decimal, ',',' ') . ' '. $devise;
    }
}

if(!function_exists('format_date')){
    function format_date($data){
        return Carbon::parse($data)->translatedFormat('l j Y');
    }
}
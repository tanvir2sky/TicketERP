<?php

use Carbon\Carbon;

if(!function_exists('formatDateForView')){
    function formatDateForView($date){
        if(is_null($date) || empty($date)) {
            return null;
        }
        try{
            $date = Carbon::parse($date);
        }catch (Exception $exception){
            return null;
        }

        return $date->toDayDateTimeString();
    }
}
if(!function_exists('formatDateForSortView')){
    function formatDateForSortView($date){
        if(is_null($date) || empty($date)) {
            return null;
        }
        try{
            $date = Carbon::parse($date);
        }catch (Exception $exception){
            return null;
        }

        return $date->diffForHumans();
    }
}


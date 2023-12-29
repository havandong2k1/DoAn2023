<?php
namespace App\Libraries;
class Utils
{
    //Các function sử dụng chung
    public function calculateSumPoints($mon1, $mon2, $mon3){
        try{
            //Check kiểu số nguyên
            return ($mon1 + $mon2 +$mon3);
        }catch (\Exception $e){
            //Log error: 0xUtilsx001
            return 0;
        }
    }
}
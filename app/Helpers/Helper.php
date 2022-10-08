<?php 

namespace App\Helpers;

class Helper 
{
    public static function api($data, $code = 200)
    {
        return response()->json($data, $code);
    }
}
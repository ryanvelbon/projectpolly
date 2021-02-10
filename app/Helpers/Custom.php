<?php


namespace App\Helpers;

class Custom
{

    public static function generateSlug($len)
    {
        $c = "1234567890abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ";
        $slug = "";

        for($i=0; $i<$len; $i++) {
            $slug .= $c[rand(0,strlen($c)-1)];
        }

        return $slug;
    }

}
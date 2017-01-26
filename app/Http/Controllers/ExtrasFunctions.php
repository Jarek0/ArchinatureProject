<?php
/**
 * Created by PhpStorm.
 * User: Dell
 * Date: 2016-12-23
 * Time: 18:58
 */

namespace Aska\Http\Controllers;


class ExtrasFunctions
{
public static function objectFinder($collection,$attribute){

    foreach($collection as $item) {
        if ($attribute == $item->id) {
            return $item;
            break;
        }
    }
    return null;
}
}
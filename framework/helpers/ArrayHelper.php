<?php

namespace framework\helpers;

class ArrayHelper
{
    public static function d($input)
    {
        echo '<pre>' . print_r($input, true) . '</pre>';
    }
}
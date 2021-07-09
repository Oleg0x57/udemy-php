<?php

namespace framework\helpers;

class UrlHelper
{
    public static function redirect($to)
    {
        header('location: ' . SITE_ROOT . '/' . $to);
    }
}
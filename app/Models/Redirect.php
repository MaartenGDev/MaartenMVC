<?php

namespace App\Models;


use App\Core\Config;

class Redirect
{
    const REDIRECT = 'redirect';
    const HTTP = 'http';
    public function __construct($sType,$sLocation = '')
    {
        switch($sType){
            case 'redirect':
                header('Location: ' . Config::$sBaseUrl . $sLocation);
                break;
            case 'http':
                header("HTTP/1.0 404 Not Found");
                break;
        }
    }
}
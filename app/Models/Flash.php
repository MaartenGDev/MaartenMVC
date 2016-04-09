<?php

namespace App\Models;

class Flash
{
    const REDIRECT_TYPE_ERROR = 'errors';
    const REDIRECT_TYPE_FLASH = 'flash';

    public function flush(){
        unset($_SESSION['flash']);
        unset($_SESSION['error']);
        return true;
    }
    public function setFlash($sRedirectType,$mData){
        if(!isset($_SESSION[$sRedirectType])){
            $_SESSION[$sRedirectType] = $mData;
        }
    }
    public function redirect($sLocation){
            header('Location: ' . $sLocation);
    }
}
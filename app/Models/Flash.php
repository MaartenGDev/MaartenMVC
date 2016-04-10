<?php

namespace App\Models;

class Flash
{
    const FLASH_SUCCESS = 'errors';
    const FLASH_ERROR = 'flash';

   public static function make($sErrorType,$sFlashMessage){
       $_SESSION['flash']['type'] = $sErrorType;
       $_SESSION['flash']['data'] = $sFlashMessage;
   }
    public static function get(){
        if(isset($_SESSION['flash'])){
            $aFlashSession = $_SESSION['flash'];
        }else{
            $aFlashSession = array();
        }
        unset($_SESSION['flash']);
        return $aFlashSession;
    }
}
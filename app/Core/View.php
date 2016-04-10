<?php

namespace App\Core;


class View
{
    public function __construct($sViewName,$data = array())
    {
        $aViewName = explode('.', $sViewName);
        if (count($aViewName) == 2) {
            $sCurrentViewPath = $_SERVER['DOCUMENT_ROOT'] . Config::$sBaseUrl. 'resources/Views/' . $aViewName[0] . '/' . $aViewName[1] . '.php';
            if (file_exists($sCurrentViewPath)) {
                include_once($sCurrentViewPath);
                return true;
            }else{
                if(file_exists($_SERVER['DOCUMENT_ROOT'] . Config::$sBaseUrl. 'resources/Views/errors/index.php')){
                    new View('errors.index',array('errorName' => 'Error 404 Not Found'));
                }else{
                    throw new \Exception('Incorrect path in config file.');
                }
            }
        }else{
            $sCurrentViewPath = $_SERVER['DOCUMENT_ROOT'] . Config::$sBaseUrl. 'resources/Views/' . $aViewName[0] . '.php';
            if (file_exists($sCurrentViewPath)) {
                include_once($sCurrentViewPath);
                return true;
            }else{
                return false;
            }
        }

    }
}
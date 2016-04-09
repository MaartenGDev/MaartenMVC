<?php

namespace App\Http;

use App\Core\View;

class Router extends Route
{
    public static $bFoundRouter = false;
    public function __construct()
    {

        Route::GET('page/{pageID}', 'HomeController@index');


        if(!self::$bFoundRouter){
           new View('errors.index',array('errorName' => 'Error 404 Not Found'));
        }
    }
}

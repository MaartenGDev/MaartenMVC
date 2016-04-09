<?php

namespace App\Controllers;

use App\Core\View;

class ErrorController
{
    public function errorNotFound(){
        return new View('errors.index',array('errorName' => '404 Not Found') );
    }
}
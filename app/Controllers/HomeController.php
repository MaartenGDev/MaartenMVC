<?php

namespace App\Controllers;

use App\Core\View;

class HomeController
{
    public function index($data = array()){
        return new View('home.index',$data);
    }
}
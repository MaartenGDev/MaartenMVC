<?php

namespace App\Models;


class Note extends Model
{

    protected $name;
    protected $email;
    protected $website;
    protected $message;

    public $aFields = array('name','email','website','message');
}
<?php

namespace App\Http;

use App\Core\View;

class Router extends Route
{
    public static $bFoundRouter = false;
    public function __construct()
    {

        Route::GET('notes', 'NoteController@listNotes');
        Route::GET('notes/add', 'NoteController@showForm');
        Route::POST('notes/add', 'NoteController@addNote');

        if(!self::$bFoundRouter){
           new View('errors.index',array('errorName' => 'Error 404 Not Found'));
        }
    }
}

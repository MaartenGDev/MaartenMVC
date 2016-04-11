<?php

namespace App\Controllers;

use App\Core\View;
use App\Models\Flash;
use App\Models\Note;
use App\Models\Redirect;
use App\Models\Validator;

class NoteController
{
    public function addPost()
    {

        $oValidator = Validator::make($_POST,
            array(
                'name' => 'min:2|max:50|alpha',
                'email' => 'min:2|max:50',
                'website' => 'min:2|max:50',
                'message' => 'min:2|max:150|alpha',
            )
        );
        if($oValidator !== true){
            Flash::make(Flash::FLASH_ERROR,$oValidator);
            return new Redirect(Redirect::REDIRECT,'/note/create');
        }

        $oNote = new Note();
        $oNote->name = $_POST['name'];
        $oNote->email = $_POST['email'];
        $oNote->website = $_POST['website'];
        $oNote->message = $_POST['message'];
        $oNote->save();

        Flash::make(Flash::FLASH_SUCCESS,array('Item has successfully been created'));
        return new Redirect(Redirect::REDIRECT,'/notes');
    }
    public function showForm(){
        return new View('note.add');
    }
    public function listNotes(){
        return new View('note.list');
    }
}
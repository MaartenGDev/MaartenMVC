<?php

namespace App\Controllers;

use App\Core\View;
use App\Models\Flash;
use App\Models\Note;
use App\Models\QueryBuilder;
use App\Models\Redirect;
use App\Models\Validator;

class NoteController
{
    public function addNote()
    {

        $oValidator = Validator::make($_POST,
            array(
                'name' => 'min:2|max:50|alpha',
                'email' => 'min:2|max:50|email',
                'website' => 'min:2|max:50|website',
                'message' => 'min:2|max:150|alpha',
            )
        );
        if($oValidator !== true){
            Flash::make(Flash::FLASH_ERROR,$oValidator);
            return new Redirect(Redirect::REDIRECT,'notes/add');
        }

        $oNote = new Note();
        $oNote->name = $_POST['name'];
        $oNote->email = $_POST['email'];
        $oNote->website = $_POST['website'];
        $oNote->message = $_POST['message'];
        $oNote->save();

        Flash::make(Flash::FLASH_SUCCESS,array('Item has successfully been created'));
        return new Redirect(Redirect::REDIRECT,'notes');
    }
    public function showForm(){
        return new View('note.add');
    }
    public function listNotes(){
        $oNotes = new QueryBuilder();
        $aNotes = $oNotes->select()->from('notes')->result();

        return new View('note.list',array('notes' =>$aNotes));
    }
}
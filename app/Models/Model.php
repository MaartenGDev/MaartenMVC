<?php

namespace App\Models;


class Model
{
    protected $aFields;
    public function __set($sKey,$sValue){
        $this->$sKey = $sValue;
    }
    public function save(){
        $oQuery = new QueryBuilder();
        $aResultList = array();
        foreach($this->aFields as $sFieldName){
            $aResultList[$sFieldName] = $this->$sFieldName;
        }
        $oQuery->insert($aResultList)->to(strtolower(str_replace('App\\Models\\','',get_class($this))) . 's')->result();
    }
}
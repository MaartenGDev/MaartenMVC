<?php

namespace App\Core;

use \PDO;

class Database
{
    private $conn;
    public function __construct()
    {
        $this->conn = new \PDO('mysql:host=' . Config::$aDatabase['host'].';dbname=' . Config::$aDatabase['database'], Config::$aDatabase['username'], Config::$aDatabase['password']);
        $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }
    public function Query($sQuery,$aFieldNames,$bReturnResult = false){
        try{
            $oCurrentQuery = $this->conn->prepare($sQuery);


            foreach($aFieldNames as $sFieldKey => &$sFieldValue){
                $oCurrentQuery->bindParam($sFieldKey,$sFieldValue);
            }
            if($oCurrentQuery->execute()){
                if($bReturnResult){
                    return $oCurrentQuery->fetchAll(PDO::FETCH_OBJ);
                }else{
                    return true;
                }
            }else{
                return false;
            }
        }catch (\PDOException $e){
            if(intval($e->getCode()) == 23000){
                return false;
            }
            return false;
        }
    }



}
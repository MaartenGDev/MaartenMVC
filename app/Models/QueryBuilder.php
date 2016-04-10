<?php
namespace App\Models;

use App\Core\Config;

class QueryBuilder
{
    private $sFieldNames = '*';
    private $sTableName;
    private $aBindParams = array();
    private $iLimit;
    private $oConn = null;
    private $sType = 'SELECT';

    public function __construct()
    {
        if (is_null($this->oConn)) {
            try {
                $this->oConn = new \PDO('mysql:host=' . Config::$aDatabase['host'] . ';dbname=' . Config::$aDatabase['database'], Config::$aDatabase['username'], Config::$aDatabase['password']);
            } catch (\PDOException $e) {
                throw new \Exception('Can\'t connect to the database, check your config file!');
            }
        }
    }

    public function insert($aData = array())
    {
        $this->aBindParams = $aData;
        $this->sType = 'INSERT';
        return $this;
    }

    public function to($sTableName)
    {
        $this->sTableName = $sTableName;
        return $this;
    }

    public function select($sFieldNames)
    {
        $this->sFieldNames = $sFieldNames;
        return $this;
    }

    public function from($sTableName)
    {
        $this->sTableName = $sTableName;
        return $this;
    }

    public function where($aWhere)
    {
        $this->aBindParams = $aWhere;
        return $this;
    }

    public function limit($limit)
    {
        $this->iLimit = intval($limit);
        return $this;
    }

    public function result()
    {
        try {

            $sQuery = '';

            switch ($this->sType) {
                case 'SELECT':
                    $bFirstKey = true;
                    $sQuery = 'SELECT ' . $this->sFieldNames . ' FROM ' . $this->sTableName;

                    foreach (array_keys($this->aBindParams) as $sKey) {
                        if ($bFirstKey) {
                            $sQuery .= ' WHERE ' . $sKey . ' = :' . $sKey;
                            $bFirstKey = false;
                        } else {
                            $sQuery .= ' AND ' . $sKey . ' = :' . $sKey;
                        }
                    }

                    break;
                case 'INSERT':
                    $bFirstKey = true;

                    $sFieldParameters = '';
                    foreach (array_keys($this->aBindParams) as $sKey) {
                        if ($bFirstKey) {
                            $sFieldParameters .= ':' . $sKey;
                            $bFirstKey = false;
                        } else {
                            $sFieldParameters .= ',:' . $sKey;
                        }
                    }

                    $sQuery = 'INSERT INTO ' . $this->sTableName . '(' . implode(',', array_keys($this->aBindParams)) . ') VALUES (' . $sFieldParameters . ')';
                    break;
                default:
                    break;
            }
            $oQuery = $this->oConn->prepare($sQuery);
            foreach ($this->aBindParams as $sFieldKey => &$sFieldValue) {
                $oQuery->bindParam(':' . $sFieldKey, $sFieldValue);
            }

            if ($oQuery->execute()) {
                switch ($this->sType) {
                    case 'SELECT':
                        return $oQuery->fetchAll(\PDO::FETCH_OBJ);
                        break;
                    default:
                        return true;
                        break;
                }
            } else {
                throw new \Exception('Something went wrong');
            }
        } catch (\PDOException $e) {
            var_dump($e->getMessage());
            throw new \Exception('Something went wrong.');
        }

    }
}
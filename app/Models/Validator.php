<?php

namespace App\Models;

class Validator
{
    private static $aValidatorErrors = array();
    public static function make($aData, $aRules)
    {
        foreach ($aRules as $sFieldValue => $sRules) {
            $aValidatorRules = explode('|', $sRules);

            foreach($aValidatorRules as $sValidatorRule){
                $aRuleData = explode(':', $sValidatorRule);

                if ($aRuleData[0] == 'max') {
                    if (!isset($aData[$sFieldValue]) || strlen($aData[$sFieldValue]) > intval($aRuleData[1])) {
                        array_push(self::$aValidatorErrors,$sFieldValue .' maximal length is ' . intval($aRuleData[1]));
                    }
                }
                if ($aRuleData[0] == 'min') {
                    if (!isset($aData[$sFieldValue]) || strlen($aData[$sFieldValue]) < intval($aRuleData[1])) {
                        array_push(self::$aValidatorErrors,$sFieldValue .' minimal length is ' . intval($aRuleData[1]));
                    }
                }
                if ($aRuleData[0] == 'alnum') {
                    if (!isset($aData[$sFieldValue]) || !ctype_alnum($aData[$sFieldValue])) {
                        array_push(self::$aValidatorErrors,$sFieldValue .' can only contain letters and numbers.');
                    }
                }
                if ($aRuleData[0] == 'alpha') {
                    if (!isset($aData[$sFieldValue]) || !ctype_alpha($aData[$sFieldValue])) {
                        array_push(self::$aValidatorErrors,$sFieldValue .' can only contain letters.');
                    }
                }
                if($aRuleData[0] == 'email'){
                    if(!preg_match('(^[a-zA-Z.]{1,}@[a-zA-Z.]{1,}\.[a-zA-Z]{1,}$)',$aData[$sFieldValue])){
                        array_push(self::$aValidatorErrors,$sFieldValue .' contains an invalid email address.');
                    }
                }
                if($aRuleData[0] == 'url'){
                    if(!preg_match('(^http(?:s?):\/\/{1,}[.A-Za-z]{1,}\.[a-zA-Z.]{1,}$)',$aData[$sFieldValue])){
                        array_push(self::$aValidatorErrors,$sFieldValue .' contains an invalid link.');
                    }
                }
            }
        }
        if (count(self::$aValidatorErrors) == 0) {
            return true;
        } else {
            return self::$aValidatorErrors;
        }
    }
}
<?php

namespace App\Models;

class Validator
{
    public static function make($aRules)
    {
        $aValidatorErrors = array();

        foreach ($aRules as $aRule) {
            $aValidatorRules = explode('|', $aRule['rules']);
            foreach ($aValidatorRules as $sRule) {
                if (strpos($sRule, 'max') !== false) {
                    $aRuleArguments = explode(':', $sRule);
                    if (strlen($aRule['data']) > intval($aRuleArguments[1])) {
                        array_push($aValidatorErrors, $aRule['name'] . ' mag maximaal ' . $aRuleArguments[1] . ' tekens zijn.');
                    }
                }
                if (strpos($sRule, 'min') !== false) {
                    $aRuleArguments = explode(':', $sRule);
                    if(strlen($aRule['data']) < intval($aRuleArguments[1])){
                        array_push($aValidatorErrors, $aRule['name'] . ' moet minimaal ' . $aRuleArguments[1] . ' tekens zijn.');
                    }
                }
            }
        }
        if (count($aValidatorErrors) == 0) {
            return true;
        } else {
            return $aValidatorErrors;
        }
    }
}
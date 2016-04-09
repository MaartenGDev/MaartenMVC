<?php
namespace App\Http;

use App\Core\Config;

use \Exception;

class Route
{

    public function GET($sRoute, $sAction)
    {
        return $this->handleRequest($sRoute, $sAction, 'GET');
    }

    public function POST($sRoute, $sAction)
    {
        return $this->handleRequest($sRoute, $sAction, 'POST');
    }

    public function handleRequest($sRouterURI, $sAction, $sRequestMethod)
    {
        if (Router::$bFoundRouter) {
            return false;
        }
        $aArguments = array();
        $sRequestURI = substr($_SERVER['REQUEST_URI'], strlen(Config::$sBaseUrl));

        // Check if the requested URL is the root of the site.    
        if($sRequestURI == ''){
          $sRequestURI = '/';
        }

        $aRouterArgs = explode('/', $sRouterURI);
        $aRequestArgs = explode('/', $sRequestURI);

        preg_match_all('({[A-Za-z]{1,}})', $sRouterURI, $aMatches);
        if (count($aMatches) > 0 && (count($aRouterArgs) == count($aRequestArgs))) {

            foreach ($aMatches[0] as $sMatch) {
                $iCurrentIndex = array_search($sMatch, $aRouterArgs);
                $aArguments[str_replace(array('{', '}'), '', $aRouterArgs[$iCurrentIndex])] = $aRequestArgs[$iCurrentIndex];
                unset($aRouterArgs[$iCurrentIndex]);
                unset($aRequestArgs[$iCurrentIndex]);
            }

            $sRouterURI = implode('', $aRouterArgs);
            $sRequestURI = implode('', $aRequestArgs);
        }
        if (($sRouterURI == $sRequestURI) && $sRequestMethod == $_SERVER['REQUEST_METHOD']) {
            try {
                list($sController, $sAction) = explode('@', $sAction);
                $sControllerPath = 'App\Controllers\\' . $sController;

                $oCurrentObject = new $sControllerPath();

                Router::$bFoundRouter = true;
                if (count($aArguments) > 0) {
                    return ($oCurrentObject->$sAction($aArguments));
                } else {
                    return ($oCurrentObject->$sAction());
                }

            } catch (Exception $e) {
                throw new Exception('2 arguments required');
            }
        } else {
            return false;
        }
    }

}

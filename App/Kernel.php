<?php
/**
 * Created by PhpStorm.
 * User: Fahre
 * Date: 23.01.2018
 * Time: 11:54
 */

namespace App;

use App;

class Kernel
{

    public $defaultControllerName = 'SiteController';
    public $defaultActionName = "index";

    /**
     * Parse route and launch action
     */
    public function start()
    {
        list($controllerName, $actionName, $params) = App::$router->parse();
        echo $this->launchAction($controllerName, $actionName, $params);
    }

    /**
     * Launch Controller Action
     * @param $controllerName
     * @param $actionName
     * @param $params
     * @return mixed
     * @throws Exceptions\InvalidRouteException
     */
    public function launchAction($controllerName, $actionName, $params)
    {

        $controllerName = empty($controllerName) ? $this->defaultControllerName : ucfirst($controllerName).'Controller';

        if(!file_exists(ROOTPATH.DIRECTORY_SEPARATOR.'Controllers'.DIRECTORY_SEPARATOR.$controllerName.'.php')){
            throw new \App\Exceptions\InvalidRouteException();
        }

        require_once ROOTPATH.DIRECTORY_SEPARATOR.'Controllers'.DIRECTORY_SEPARATOR.$controllerName.'.php';
        if(!class_exists("\\Controllers\\".ucfirst($controllerName))){
            throw new \App\Exceptions\InvalidRouteException();
        }

        $controllerName = "\\Controllers\\".ucfirst($controllerName);
        $controller = new $controllerName;
        $actionName = empty($actionName) ? $this->defaultActionName : $actionName;
        if (!method_exists($controller, $actionName)){
            throw new \App\Exceptions\InvalidRouteException();
        }

        return $controller->$actionName($params);

    }

}
<?php
/**
 * Created by PhpStorm.
 * User: Fahre
 * Date: 23.01.2018
 * Time: 11:53
 */
namespace App;

class Router

{

    /**
     * Parse Route
     * @return mixed
     */
    public function parse()
    {

        if(($pos = strpos($_SERVER['REQUEST_URI'], '?')) !== false){
            $route = substr($_SERVER['REQUEST_URI'], 0, $pos);
        }
        $route = is_null($route) ? $_SERVER['REQUEST_URI'] : $route;
        $route = explode('/', $route);
        array_shift($route);
        $result[0] = array_shift($route);
        $result[1] = array_shift($route);
        $result[2] = $route;
        return $result;

    }

}
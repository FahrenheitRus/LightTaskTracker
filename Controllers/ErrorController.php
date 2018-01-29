<?php
/**
 * Created by PhpStorm.
 * User: Fahre
 * Date: 23.01.2018
 * Time: 12:08
 */

namespace Controllers;


class ErrorController extends \App\Controller
{
    /**
     * @return string
     */
    public function error404()
    {
        return $this->view('Errors\Error404');
    }

    /**
     * @return string
     */
    public function error500()
    {
        return $this->view('Errors\Error500');
    }

}
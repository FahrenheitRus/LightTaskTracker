<?php
/**
 * Created by PhpStorm.
 * User: Fahre
 * Date: 23.01.2018
 * Time: 11:57
 */

namespace App;

use App;

class Controller
{

    public $layoutFile = 'Views/Layouts/Layout.php';

    /**
     * Render Layout File
     * @param $body
     * @return string
     */

    public function renderLayout($body)
    {
        ob_start();
        require $this->layoutFile;
        return ob_get_clean();
    }

    /**
     * Return View
     * @param $viewName
     * @param array $params
     * @return string
     */

    public function view($viewName, array $params = [])
    {
        $viewFile = ROOTPATH.DIRECTORY_SEPARATOR.'Views'.DIRECTORY_SEPARATOR.$viewName.'.php';
        extract($params);
        ob_start();
        require $viewFile;
        $body = ob_get_clean();
        ob_end_clean();
        if (defined(NO_LAYOUT)){
            return $body;
        }
        return $this->renderLayout($body);
    }

}
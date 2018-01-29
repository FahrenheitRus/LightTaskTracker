<?php
/**
 * Created by PhpStorm.
 * User: Fahre
 * Date: 23.01.2018
 * Time: 11:55
 */
function dd(){
    echo '<pre>';
    var_export(func_get_args());
    echo '</pre>';
    exit;
}

define('ROOTPATH', __DIR__);

require __DIR__.'/App/App.php';

App::init();
App::$kernel->start();



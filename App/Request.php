<?php
/**
 * Created by PhpStorm.
 * User: Fahre
 * Date: 23.01.2018
 * Time: 16:21
 */

namespace App;

class Request
{

    /* Input types */
    const R_ANY     = 0;
    const R_INT     = 1;
    const R_STRING  = 2;
    const R_DATE    = 3;
    const R_LIST    = 4;
    const R_FLOAT   = 5;
    const R_BOOL    = 6;
    const R_EMAIL   = 7;


    /* Actions */
    const A_REDIRECT = 'redirect';
    const A_ALERT    = 'alert';
    const A_CLOSURE  = 'closure';
    const A_JSON_ERR = 'json_err';


    /* Input Data Array */
    public static $input_data;

    /* Input Value */
    public static $input_value;

    /* Default Value */
    public static $input_default;

    /* Selected Type - Default - Any*/
    public static $input_type = self::R_ANY;

    /* Range Values */
    public static $input_range_min;
    public static $input_range_max;

    /* List Values */
    public static $input_list = [];

    /* Action */
    public static $input_action = self::A_ALERT;
    public static $input_action_param = 'Variable not passed';



    /*
    * Uses only GET Request
    */
    static public function get()
    {

        self::$input_data = $_GET;

        return new self;

    }

    /*
    * Uses only POST Request
    */
    static public function post()
    {

        self::$input_data = $_POST;

        return new self;

    }

    /*
    * Uses POST AND GET Request
    */
    static public function any()
    {

        self::$input_data = array_merge($_GET,$_POST);

        return new self;

    }

    /* |---------------| */
    /* | Short methods | */
    /* |---------------| */

    /*
    * Get all Data
    */
    static public function all()
    {

        if(self::$input_data === NULL){
            throw new \Exception('Missed mode: get() / post() / any()');
        }

        return self::$input_data;
    }

    /*
    * Check var exists
    */
    static public function has($var)
    {

        if(self::$input_data === NULL){
            throw new \Exception('Missed mode: get() / post() / any()');
        }

        return isset(self::$input_data[$var]);
    }

    static public function input($var,$default = NULL)
    {

        if(self::$input_data === NULL){
            throw new \Exception('Missed mode: get() / post() / any()');
        }

        if(isset(self::$input_data[$var])){
            return htmlspecialchars(self::$input_data[$var]);
        } else {
            return $default;
        }

    }

}

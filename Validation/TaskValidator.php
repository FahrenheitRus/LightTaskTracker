<?php

/**
 * Created by PhpStorm.
 * User: Fahre
 * Date: 23.01.2018
 * Time: 19:42
 */

namespace Validation;

class TaskValidator
{
    /**
     * Validate Task Data
     * @param $data
     * @return array
     */

    public static function validate($data)
    {

        $errors = [];

        if(empty($data->username)){
            $errors[] = 'Empty username';
        }

        if(empty($data->email) || !filter_var($data->email, FILTER_VALIDATE_EMAIL)){
            $errors[] =  'Incorrect email';
        }

        if(empty($data->description)){
            $errors[] = 'Empty Description';
        }

        if(!is_bool($data->is_completed)){
            $errors[] = 'Completed sign not bool';
        }

        if(empty($errors)){
            return ['valid' => true];
        } else {
            return ['valid' => false, 'errors' => $errors];
        }



    }

}
<?php
/**
 * Created by PhpStorm.
 * User: Fahre
 * Date: 23.01.2018
 * Time: 12:37
 */

namespace App;

use App;

class Db
{

    public $pdo;
    public $last_insert_id;

    /**
     * Db constructor.
     */

    public function __construct()
    {
        $settings = $this->getPDOSettings();
        $this->pdo = new \PDO($settings['dsn'], $settings['user'], $settings['pass'], NULL);
    }

    /**
     * Set PDO Settings
     * @return mixed
     */

    protected function getPDOSettings()
    {
        $config = include ROOTPATH.DIRECTORY_SEPARATOR.'Config'.DIRECTORY_SEPARATOR.'Db.php';
        $result['dsn']  = "{$config['type']}:host={$config['host']};dbname={$config['dbname']};charset={$config['charset']}";
        $result['user'] = $config['user'];
        $result['pass'] = $config['pass'];
        return $result;
    }

    /**
     * Execute query
     * @param $query
     * @param array|NULL $params
     * @return array
     */

    public function execute($query, array $params = NULL)
    {

        if(is_null($params)){
            $stmt = $this->pdo->query($query);
            return $stmt->fetchAll();
        }
        $stmt = $this->pdo->prepare($query);
        $stmt->execute($params);
        return $stmt->fetchAll();

    }

    /**
     * Return Last Insert ID
     * @return string
     */
    public function getLastInsertId()
    {
        return $this->pdo->lastInsertId();
    }

}
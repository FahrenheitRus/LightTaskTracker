<?php

/**
 * Created by PhpStorm.
 * User: Fahre
 * Date: 23.01.2018
 * Time: 12:58
 */

namespace App\Components;

use App;
use App\Db;

class DataMapper

{
    /**
     * @var object original attr
     */
    public $original_attributes;
    /**
     * @var string table name
     */
    protected $table;
    /**
     * @var object $data to DB
     */
    protected $data_to_db;

    private $db;

    /**
     * DataMapper constructor.
     */

    public function __construct()
    {
        $this->db = new Db();
    }

    /**
     * Select all records from table
     * @return array
     */

    protected function findAll()
    {
        $data = $this->db->execute('SELECT * FROM '. $this->table);
        return $data;
    }

    /**
     * Select records from table with limit,offset,sort,order
     * @param $limit
     * @param $offset
     * @param $sort
     * @param $order
     * @return array
     */

    protected function findRange($limit,$offset,$sort,$order)
    {
        $data = $this->db->execute('SELECT * FROM '. $this->table. " ORDER BY $sort $order LIMIT $limit OFFSET $offset");
        return $data;
    }

    /**
     * Select record by ID
     * @param $id
     * @return mixed
     */

    protected function findByID($id)
    {
        $data = $this->db->execute('SELECT * FROM '. $this->table. ' WHERE id = '.$id);
        return $data[0];
    }

    /**
     * Create or Updare record
     * @return string
     */

    protected function save()
    {

        if(is_null($this->data_to_db['id'])){
            return $this->create();
        } else {
            return $this->update();
        }

    }

    /**
     * Insert record to DB
     * @return string
     */
    private function create()
    {
        $sql = 'INSERT INTO '.$this->table.' SET ';

        // Prepare query and params
        $params = [];
        foreach ($this->data_to_db as $key => $val){
            if($val !== ''){
                $sql .= "$key = :$key, ";
                $params[":$key"] = $val;
            }

        }

        $sql = rtrim($sql, ', ');

        if($this->db->execute($sql,$params) !== false){
            return $this->db->getLastInsertId();
        }

    }

    /**
     * Update record in DB
     * @return mixed
     */

    private function update()
    {
        $sql = 'UPDATE '.$this->table.' SET ';

        // Prepare query and params
        $params = [];
        foreach ($this->data_to_db as $key => $val){
            if($val !== '' && $key !== 'id'){
                $sql .= "$key = :$key, ";
                $params[":$key"] = $val;
            }

        }

        $sql = rtrim($sql, ', ');
        $sql .= ' WHERE id = '.$this->data_to_db['id'];

        if($this->db->execute($sql,$params) !== false){
            return $this->data_to_db['id'];
        }

    }

}
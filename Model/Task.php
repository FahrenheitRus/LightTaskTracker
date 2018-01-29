<?php
/**
 * Created by PhpStorm.
 * User: Fahre
 * Date: 23.01.2018
 * Time: 13:13
 */

namespace Model;

use App\Components\DataMapper;

class Task extends DataMapper
{
    protected $table = 'tasks';

    public $id;
    /**
     * @var string user name
     */
    public $username = "";
    /**
     * @var string user е-mail
     */
    public $email = "";
    /**
     * @var string taks text
     */
    public $description = "";
    /**
     * @var string task image
     */
    public $image = "";
    /**
     * @var bool complete sign
     */
    public $is_completed = "";

    /**
     * Get Task by ID
     * @param $id
     * @return mixed
     */

    public function getByID($id)
    {

        $data = $this->findByID($id);

        $this->id           = $data['id'];
        $this->username     = $data['username'];
        $this->email        = $data['email'];
        $this->image        = $data['image'];
        $this->is_completed = $data['is_completed'];

        return $data;

    }

    /**
     * Get all tasks
     * @return array
     */

    public function getAllTasks()
    {
       return $this->findAll();
    }

    /**
     * Get Task with pagination and sort
     * @param $limit
     * @param $offset
     * @param $sort
     * @param $order
     * @return array
     */

    public function getRangeTasks($limit,$offset,$sort,$order)
    {
        return $this->findRange($limit,$offset,$sort,$order);
    }

    /**
     * Create or update task
     * @return string
     */

    public function saveTask()
    {
        $this->data_to_db = [
            'id'           => $this->id,
            'username'     => $this->username,
            'email'        => $this->email,
            'description'  => $this->description,
            'image'        => $this->image,
            'is_completed' => $this->is_completed,
        ];

        $this->id = $this->save();
        return $this->id;
    }



}
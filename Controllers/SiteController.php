<?php
/**
 * Created by PhpStorm.
 * User: Fahre
 * Date: 23.01.2018
 * Time: 13:15
 */

namespace Controllers;

use Model\Task;
use App\Request;
use App\Components\ImgResizer;
use Validation\TaskValidator;

class SiteController extends \App\Controller
{

    /**
     * Snow Admin Index Page
     * @return string
     */

    public function index(){
        return $this->view('Home');
    }

    /**
     * Get all task for ajax
     */

    public function getalltasks(){
        $Task = new Task();

        $limit  = Request::get()->input('limit',3);
        $offset = Request::get()->input('offset',0);
        $sort   = Request::get()->input('sort','id');
        $order  = Request::get()->input('order','asc');

        echo "{";
        echo '"total": ' . count($Task->getAllTasks()) . ',';
        echo '"rows": ';
        echo json_encode($Task->getRangeTasks($limit,$offset,$sort,$order));
        echo "}";

    }

    /**
     * Display add task page
     * @return string
     */

    public function addtaskpage(){
        return $this->view('AddTask');
    }

    /**
     * Add Task To DB And Save Image
     */

    public function addtask(){

        $Task = new Task();
        $Task->username     = Request::post()->input('username');
        $Task->email        = Request::post()->input('email');
        $Task->description  = Request::post()->input('description');
        $Task->is_completed = false;

        // Validation
        $valid = TaskValidator::validate($Task);

        if(!$valid['valid']){
            $_SESSION['errors'] = $valid['errors'];
            header ("Location: /site/addtaskpage");
            exit;
        }

        $id = $Task->saveTask();

        // upload file
        if($id && is_uploaded_file($_FILES['image']['tmp_name'])){

            $pic_type = strtolower(strrchr($_FILES['image']['name'],"."));
            $pic_name = "public/upload/images/task/{$id}"."$pic_type";

            move_uploaded_file($_FILES['image']['tmp_name'], $pic_name);

            if (true !== ($pic_error = ImgResizer::imageResize($pic_name, $pic_name, 320, 240))) {
                echo $pic_error;
                unlink($pic_name);
            } else {
                $Task = new Task();
                $Task->getByID($id);
                $Task->image = $id.$pic_type;
                $Task->saveTask();
            }

        }

        $_SESSION['save_success'] = true;
        header("Location: /");

    }
}
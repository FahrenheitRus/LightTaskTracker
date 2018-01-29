<?php
/**
 * Created by PhpStorm.
 * User: Fahre
 * Date: 23.01.2018
 * Time: 18:11
 */

namespace Controllers;

use App\Request;
use Model\Task;
use App\Components\ImgResizer;
use Validation\TaskValidator;

class AdminController extends \App\Controller
{

    /**
     * Snow Index Page
     * @return string
     */

    public function index()
    {
        // Render form
        if (Request::post()->has('submit')) {
            if (Request::post()->input('submit') == "login"){
                //Get Form Data
                $username = Request::post()->input('username');
                $password = Request::post()->input('password');

                $admin = include ROOTPATH.DIRECTORY_SEPARATOR.'Config'.DIRECTORY_SEPARATOR.'Admin.php';

                if ($password == $admin['password'] && $username == $admin['login']){
                    self::setAdmin();
                    // Redirect User
                    header("Location: /");
                }
                } else {
                    self::unsetAdmin();
                    header("Location: /");
                }
        }

        return $this->view('AdminLogin');

    }

    /**
     * Show Edit Page
     * @param $id
     * @return string
     */
    public function edit($params)
    {

        $id = $params[0];
        $Task = new Task();
        $data = $Task->getByID($id);

        return $this->view('EditTask',['data' => $data]);
    }


    /**
     * Edit task
     * Edit Task in DB And Save Image
     */

    public function edittask()
    {

        if(!self::checkAdmin()){
            header ("Location: /");
            exit;
        }

        $Task = new Task();
        $Task->id           = Request::post()->input('id');
        $Task->username     = Request::post()->input('username');
        $Task->email        = Request::post()->input('email');
        $Task->description  = Request::post()->input('description');
        $Task->is_completed = Request::post()->has('is_completed');


        // Validation
        $valid = TaskValidator::validate($Task);

        if(!$valid['valid']){
            $_SESSION['errors'] = $valid['errors'];
            header ("Location: /admin/edit/{$Task->id}");
            exit;
        }

        $id = $Task->saveTask();

        // upload file
        if($id && is_uploaded_file($_FILES['image']['tmp_name'])){

            $pic_type = strtolower(strrchr($_FILES['image']['name'],"."));
            $pic_name = "public/upload/images/task/{$id}"."$pic_type";

            move_uploaded_file($_FILES['image']['tmp_name'], $pic_name);

            if (true !== ($pic_error = ImgResizer::imageResize($pic_name, $pic_name, 320, 240, 0))) {
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


    /**
     * Check user is admin
     * @return boolean
     */

    public static function checkAdmin()
    {

        if (isset($_SESSION['X-Auth-Token'])) {
            if($_SESSION['X-Auth-Token'] == "admin123"){
                return true;
            }
        }
        return false;
    }

    /**
     * Set user as admin
     * @return boolean
     */

    private static function setAdmin()
    {
        $_SESSION['X-Auth-Token'] = "admin123";
    }

    /**
     * Unset user as admin
     * @return boolean
     */

    private static function unsetAdmin()
    {

        if (isset($_SESSION['X-Auth-Token'])) {
            unset($_SESSION['X-Auth-Token']);
        }
    }

}
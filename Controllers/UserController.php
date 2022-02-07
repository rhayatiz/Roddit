<?php
require_once(ROOT_FOLDER.'controllers' . DIRECTORY_SEPARATOR . 'Controller.php');
require_once(ROOT_FOLDER.'DAO' . DIRECTORY_SEPARATOR . 'UserDao.php');

class UserController extends Controller{

    // get unread messages
    public function all(){
        $users = (new UserDao)->list();
        return $users;
    }

    public function allExceptCurrent(){
        $users = (new UserDao)->findAllExcept(Auth::user()->id);
        return $users;
    }
}
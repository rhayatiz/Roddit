<?php
namespace Controllers;

use DAO\UserDao;
use helpers\Auth;

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
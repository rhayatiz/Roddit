<?php
require(ROOT_FOLDER.'controllers/Controller.php');
require(ROOT_FOLDER.'DAO/UserDao.php');
require(ROOT_FOLDER.'DAO/PostDao.php');

class HomeController extends Controller{

    public function secret(){
        echo 'hello there';
    }

    public function index(){

        $posts = (new PostDao)->list();
        $this->render('home', compact('posts'));
    }

    public function error($error){
        $this->render('error', compact('error'));
    }

    public function login($email, $password){
        if ($user = (new UserDao())->login($email, $password)){
            $_SESSION['userId'] = $user->id;
            header('Location: index.php');
            die();
        }else{
            $error = "Identifiants incorrects!";
            $this->render('login', compact('error'));
        }
    }

    public function logout(){
        $_SESSION['userId'] = null;
        $this->index();
    }

    public function showLoginForm(){
        $this->render('login');
    }

}
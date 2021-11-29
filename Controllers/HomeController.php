<?php
require(ROOT_FOLDER.'controllers/Controller.php');
require(ROOT_FOLDER.'DAO/UserDao.php');

class HomeController extends Controller{

    public function index(){
        // $this->render('home', compact('message', 'page_title', 'produits', 'categories'));
        $this->render('home');
    }

    public function error($error){
        $this->render('error', compact('error'));
    }

    public function login($email, $password){
        if ($user = (new UserDao())->auth($email, $password)){
            $_SESSION['user'] = $user;
            header('Location: index.php');
            die();
        }else{
            $error = "Identifiants incorrects!";
            $this->render('login', compact('error'));
        }
    }

    public function logout(){
        $_SESSION['user'] = null;
        $this->index();
    }

    public function showLoginForm(){
        $this->render('login');
    }

}
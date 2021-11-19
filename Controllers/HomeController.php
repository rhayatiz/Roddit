<?php
require(ROOT_FOLDER.'Controllers/Controller.php');
require(ROOT_FOLDER.'DAO/UserDao.php');

class HomeController extends Controller{

    public function index(){
        // $this->render('home', compact('message', 'page_title', 'produits', 'categories'));
        $this->render('home');
    }

    public function error($error){
        $this->render('error', compact('error'));
    }

    public function login(){
        // Tentative de connexion
        if(isset($_POST['loginForm'])){
            $email = $_POST['email'];
            $password = $_POST['password'];
            
            if ($user = (new UserDao())->auth($email, $password)){
                $_SESSION['user'] = $user;
                header('Location: index.php');
                die();
            }else{
                $error = "Identifiants incorrects!";
                $this->render('login', compact('error'));
            }
        // Première visite de la page, afficher le formulaire de connexion
        }else{
            $this->render('login');
        }
    }

    public function logout(){
        unset($_SESSION['user']);
        header('Location: index.php');
    }

}
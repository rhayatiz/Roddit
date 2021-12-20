<?php
require_once(ROOT_FOLDER.'controllers' . DIRECTORY_SEPARATOR . 'Controller.php');
require_once(ROOT_FOLDER.'DAO' . DIRECTORY_SEPARATOR . 'UserDao.php');
require_once(ROOT_FOLDER.'DAO' . DIRECTORY_SEPARATOR . 'PostDao.php');

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

    public function showRegisterForm(){
        $this->render('register');
    }

    public function showProfile($view){
        $user = (new UserDao())->findByUsername($_GET['user']);
        // Si l'utilisateur n'existe pas, renvoyer vers l'accueil
        if($user == null){
            $this->index();
            die();
        }

        switch ($view) {
            // Afficher les posts de l'utilisateur
            case 'posts':
                $page = 'posts';
                $posts = (new PostDao())->listByUser($user->id);
                $this->render('profile-posts', compact('user', 'posts', 'page'));
                break;
            
            // Afficher les likes (posts likés) de l'utilisateur
            case 'likes':
                $page = 'likes';
                $likes = [];
                $this->render('profile-likes', compact('user', 'likes', 'page'));
                break;

            // Afficher les likes (posts likés) de l'utilisateur
            case 'comments':
                $page = 'comments';
                $comments = [];
                $this->render('profile-comments', compact('user', 'comments', 'page'));
                break;

            default:
                $this->index();
                break;
        }
    }
    
    public function register($data){
        //Email existant, renvoyer une erreur à la page inscription
        if((new UserDao())->emailExists($data['email'])){
            $error = "Un compte existe avec ce mail";
            $this->render('register', compact('error'));
        //pseudo existant, renvoyer une erreur à la page inscription
        }else if((new UserDao())->usernameExists($data['username'])){
            $error = "Un compte existe avec ce pseudo";
            $this->render('register', compact('error'));
        }

        // Si OK, créer l'utilisateur, renvoyer vers accueil
        if(count($data) == 6){
            $userId = (new UserDao())->create($data);
            $_SESSION['userId'] = $userId;
            header('Location: index.php');
            die();
        }
    }


}
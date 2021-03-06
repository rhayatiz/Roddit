<?php
require_once('autoload.php');
/*********** Démarrer la session *********/
if(!isset($_SESSION)){session_start();};

/*********** Dependencies *********/
use Controllers\HomeController;
use Controllers\PostController;
use Controllers\LikeController;
use Controllers\MessageController;
use helpers\Auth;

/**************************************************************************
 ********************************** ROUTER ********************************
**************************************************************************/
if (isset($_GET['page'])){
    $page = $_GET['page'];
} else {
    $page = 'home';
}

//Si l'utilisateur n'est pas connecté, renvoyer vers la page de connexion
// if(!isset($_SESSION['user'])){
//     $controller = new HomeController();
//     $controller->login();
// }else{
    //Si l'utilisateur est connecté, appeler le controller qui va charger les données et la vue
switch ($page) {
    case 'profile':
        if(isset($_GET['show'])){
            (new HomeController())->showProfile($_GET['show']);
        }else{
            (new HomeController())->showProfile('posts');
        }
        break;
    case 'home':
        (new HomeController())->index();
        break;
    
    case 'login':
        // ---- POST (tentative de connexion)
        if(isset($_POST['loginForm'])){
            (new HomeController())->login($_POST['email'], $_POST['password']);
        // ----- GET (afficher la page de connexion)
        }else{
            (new HomeController)->showLoginForm();
        }
        break;

    case 'register':
        // ---- POST (tentative d'inscription)
        if(isset($_POST['registerForm'])){
            (new HomeController())->register([
                "nom" => $_POST['nom'],
                "prenom" => $_POST['prenom'],
                "dateNaissance" => $_POST['dateNaissance'],
                "username" => $_POST['username'],
                "password" => $_POST['password'],
                "email" => $_POST['email']
            ]);
        // ----- GET (afficher la page d'inscription)
        }else{
            (new HomeController)->showRegisterForm();
        }
        break;

    case 'logout':
        (new HomeController)->logout();
        break;
        

    case 'secret':
        if(Auth::user()){
            (new HomeController())->secret();
        }else{
            (new HomeController())->index();
        }
        break;

    //index.php?post={id}
    case 'post':
        if(isset($_GET['id'])){
            (new PostController())->show($_GET['id']);
        }
        break;

    case 'like':
        if(isset($_GET['idUser']) && isset($_GET['statut']) && $_GET['statut'] == 'getAll')
        {
            $data = (new LikeController())->getAllLikedPostByUser($_GET['idUser']);
            header('Content-type: application/json');
            echo json_encode($data);
        }
        elseif(isset($_GET['idPost']) && $_GET['idUser'] && $_GET['statut'])
        {
             $data = (new LikeController())->actionLikePost($_GET['idUser'], $_GET['idPost'], $_GET['statut']);
            header('Content-type: application/json');
            echo json_encode($data);
        }

        break;
    case 'newPost':
        if(Auth::user())
        {
            (new HomeController())->newPost();
        }
        else
        {
            (new HomeController())->index();
        }
        break;

    case 'creatPost':
        // ---- POST (tentative de connexion)
        if(isset($_POST['postForm']))
        {
            (new PostController())->createPost($_POST['titre'], $_POST['postText']);
        }
        
    /*****************
     *  Messages
    *****************/
    case 'messages-inbox':
        (new MessageController())->index();
        break;

    case 'messages-sent':
        (new MessageController())->listSent();
        break;

    case 'messages-new':
        (new MessageController())->showForm();
        break;
        
    case 'messages-deleted':
        (new MessageController())->listDeleted();
        break;
    case 'message':
        if(isset($_GET['id'])){
            (new MessageController())->get($_GET['id']);
            break;
        }


    default:
        $controller = new HomeController();
        $controller->error('Page Not Found');
        break;
}

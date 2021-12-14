<?php
define('ROOT_FOLDER', __DIR__ . DIRECTORY_SEPARATOR );

/*********** Démarrer la session *********/
if(!isset($_SESSION)){session_start();};





/*********** Dependencies *********/
require('helpers' . DIRECTORY_SEPARATOR . 'functions.php');
require('helpers' . DIRECTORY_SEPARATOR . 'Auth.php');
require('controllers' . DIRECTORY_SEPARATOR . 'HomeController.php');
require('controllers' . DIRECTORY_SEPARATOR . 'PostController.php');
require('controllers' . DIRECTORY_SEPARATOR . 'LikeController.php');
include(ROOT_FOLDER . 'DAO' . DIRECTORY_SEPARATOR . 'DatabasePDO.php');


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
        if(isset($_GET['idPost']) && $_GET['idUser'])
        {
            (new LikeController())->actionLikePost($_GET['idUser'], $_GET['idPost'], $_GET['statut']);
        }
        break;


    default:
        $controller = new HomeController();
        $controller->error('Page Not Found');
        break;
}
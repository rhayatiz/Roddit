<?php
define('ROOT_FOLDER', __DIR__ . DIRECTORY_SEPARATOR );

/*********** Démarrer la session *********/
if(!isset($_SESSION)){session_start();};

class Auth {
    /**
     * récupère l'utilisateur connecté, si user est défini dans la session
     *
     * @return User | null 
     */
    public static function user(){
        //TODO session['user'] doit contenir l'id de l'utilisateur
        //si défini, on doit appeler userDAO et récupérer l'user à partir de son id depuis la bdd
        if(isset($_SESSION['user'])){
            return new User('admin','admin','admin','admin@admin.com',19972112, 'admin',1);
        }else{
            return new User('admin','admin','admin','admin@admin.com',19972112, 'admin',1);
            return null;
        }
    }
}



/*********** Dependencies *********/
require('helpers' . DIRECTORY_SEPARATOR . 'functions.php');
require('controllers' . DIRECTORY_SEPARATOR . 'HomeController.php');
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
            

        default:
            $controller = new HomeController();
            $controller->error('Page Not Found');
            break;
    }
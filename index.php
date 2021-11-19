<?php
define('ROOT_FOLDER', __DIR__ . DIRECTORY_SEPARATOR );
if(!isset($_SESSION)){session_start();}
function dd($a){
    echo "<pre>";
    print_r($a);
    echo "</pre>";
    die();
}
/**
 * ROUTER 
 */
//REQUIRES
require('Controllers' . DIRECTORY_SEPARATOR . 'HomeController.php');
include(ROOT_FOLDER . 'DAO' . DIRECTORY_SEPARATOR . 'DatabasePDO.php');


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
            (new HomeController())->login();
            break;

        default:
            $controller = new HomeController();
            $controller->error('Page Not Found');
            break;
    }
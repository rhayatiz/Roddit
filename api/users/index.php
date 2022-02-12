<?php 
require_once('..' . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . 'autoload.php');
/*********** Démarrer la session *********/
if(!isset($_SESSION)){session_start();};

use Controllers\UserController;
use helpers\Auth;

// Répondre Que si l'utilisateur est connecté
if(!Auth::user()){ echo 'Unauthorized access'; die;}



if(!isset($_GET['get'])){

    // api/users
    header('Content-Type: application/json; charset=utf-8');
    echo json_encode((new UserController())->allExceptCurrent());
}else{
}   

?>
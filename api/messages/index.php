<?php 
/****redéfinir ROOT_FOLDER **/
// roddit/api/messages/ ==> roddit/
$temp_root =  __DIR__ . DIRECTORY_SEPARATOR;
$temp_root_array = explode(DIRECTORY_SEPARATOR, $temp_root);
// remove '/'   'messages'   '/'
array_splice($temp_root_array, -3);
$new_root = implode(DIRECTORY_SEPARATOR, $temp_root_array);
define('ROOT_FOLDER', $new_root . DIRECTORY_SEPARATOR);

/*********** Démarrer la session *********/
if(!isset($_SESSION)){session_start();};
/*********** Dependencies *********/
require('..' . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . 'helpers' . DIRECTORY_SEPARATOR . 'functions.php');
include(ROOT_FOLDER . 'DAO' . DIRECTORY_SEPARATOR . 'DatabasePDO.php');


header('Content-type: application/json');
$data = [
    'hello' => 'there'
];


echo json_encode($data);

?>
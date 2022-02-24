<?php 
require_once('..' . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . 'autoload.php');
/*********** Démarrer la session *********/
if(!isset($_SESSION)){session_start();};

use helpers\Auth;
use Controllers\MessageController;

// Répondre Que si l'utilisateur est connecté
// if(!Auth::user()){ echo 'Unauthorized access'; die;}

/*****************
 * POST
 *  */ 
// echo json_encode($_SERVER);
// exit;

if($_SERVER['REQUEST_METHOD'] === 'POST'){
    if(isset($_POST['body'])){
        $recipientId = $_POST['recipient_id'];
        $parentId = $_POST['parent_id'];
        $body = $_POST['body'];
        $res = (new MessageController)->newMessage($recipientId, $body, $parentId);
        echo json_encode([$res]);
    }

/*****************
 * GET
 *  */ 
}else if($_SERVER['REQUEST_METHOD'] === 'GET'){
    if(isset($_GET['get'])){
        switch ($_GET['get']) {
            // api/message/index.php?get=unread
            case 'unread':
                header('Content-type: application/json');
                echo json_encode([
                    'data' => (new MessageController)->getUnreadMessages()
                ]);
                break;
            // api/message/index.php?get=unreadCount
            case 'unreadCount':
                header('Content-type: application/json');
                echo json_encode([
                    'unreadCount' => (new MessageController)->getUnreadMessagesCount()
                ]);
                break;
            }
    /*****************
     * /api/messages
     * Tous les messages reçus par l'utilisateur
     *  */ 
    }else{
        $data = (new MessageController)->all();
        header('Content-type: application/json');
        echo json_encode([
            'data' => (new MessageController)->all()
        ]);
    }
}

?>
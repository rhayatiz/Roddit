<?php
require_once(ROOT_FOLDER.'controllers' . DIRECTORY_SEPARATOR . 'Controller.php');
require_once(ROOT_FOLDER.'DAO' . DIRECTORY_SEPARATOR . 'MessageDao.php');

class MessageController extends Controller{


    // get unread messages count
    // $messageCount = (new MessageDao)->getUnreadMessagesCount(Auth::user()->id);
    // return json_encode([
    //     'rowCount' =>$messageCount
    //     ]);

    public function index(){
        $this->render('messagerie');
    }

}
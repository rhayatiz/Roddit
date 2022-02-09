<?php
require_once(ROOT_FOLDER.'controllers' . DIRECTORY_SEPARATOR . 'Controller.php');
require_once(ROOT_FOLDER.'DAO' . DIRECTORY_SEPARATOR . 'MessageDao.php');

class MessageController extends Controller{

    // get unread messages count
    public function getUnreadMessagesCount(){
        $messageCount = (new MessageDao)->getUnreadMessagesCount(Auth::user()->id);
        return $messageCount;
    }

    // get unread messages
       public function getUnreadMessages(){
        $unreadMessages = (new MessageDao)->getUnreadMessages(Auth::user()->id);
        return $unreadMessages;
    }

    // get user messages
    public function all(){
        $messages = (new MessageDao)->getUserMessages(Auth::user()->id);
        return $messages;
    }

    // get specific message by id
    public function get($id){
        //Lire le message
        (new MessageDao)->read($id);
        $message = (new MessageDao)->get($id);
        $this->render('messagerie-message', compact('message'));
    }

    public function index(){
        $this->render('messagerie-inbox');
    }
    
    public function listSent(){
        $this->render('messagerie-sent');
    }
    
    public function listDeleted(){
        $this->render('messagerie-deleted');
    }
    
    public function showForm(){
        $this->render('messagerie-new-message');
    }

}
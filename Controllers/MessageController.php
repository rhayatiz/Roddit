<?php
namespace Controllers;

use DAO\MessageDao;
use helpers\Auth;

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
        $conversationMessages = [];
        (new MessageDao)->read($id);
        $ogMessage = (new MessageDao)->get($id);
        $conversationMessages[] = $ogMessage;
        if($ogMessage->parent_message_id != NULL){
            $conversationMessages = [];
            $result = (new MessageDao)->getAllConversationMessages($ogMessage);
            $conversationMessages = $result;
        }
        $sujet = $ogMessage->subject;
        $sender = $ogMessage->sender;
        $sender_id = $ogMessage->sender_id;
        $this->render('messagerie-message', compact('conversationMessages', 'sujet', 'sender', 'sender_id', 'ogMessage'));
    }

    public function newResponse($recipientId, $body, $parentId){
        $senderId = Auth::user()->id;
        return (new MessageDao)->createResponse($senderId, $recipientId, $body, $parentId);
    }

    public function newMessage($recipientId, $subject, $body){
        $senderId = Auth::user()->id;
        return (new MessageDao)->createMessage($senderId, $recipientId, $subject, $body);
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
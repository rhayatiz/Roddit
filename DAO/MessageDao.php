<?php
include(ROOT_FOLDER.'/models/Message.php');

/**
 * MessageDao : CRUD
 */
class MessageDao
{
        static $pdo=null;

        function __construct(){
                MessageDao::$pdo = DatabasePDO::getInstance();
        }

        function getUnreadMessagesCount($userId){
            $sql = 'SELECT * FROM messages WHERE recipient_id = ? and is_read = 0';
            $stm = self::$pdo->prepare($sql);
            $stm->execute([$userId]);
            return $stm->rowCount();
        }

        function getUnreadMessages($userId){
                $sql = 'SELECT * FROM messages WHERE recipient_id = ? and is_read = 0';
                $stm = self::$pdo->prepare($sql);
                $stm->execute([$userId]);
                $unreadMessages = $stm->fetchAll(PDO::FETCH_CLASS, 'Message'); //FETCH_BOTH - FETCH_CLASS - FETCH_ASSOC
                foreach ($unreadMessages as $k=>$message) {
                        //Ajouter le nom de l'utilisateur au post
                        $message->sender = (new UserDao)->get($message->sender_id)->username;
                }
                return $unreadMessages;

        }
}
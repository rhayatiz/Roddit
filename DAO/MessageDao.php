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
                        //Ajouter le nom de l'utilisateur au message
                        $message->sender = (new UserDao)->get($message->sender_id)->username;
                }
                return $unreadMessages;

        }

        function getUserMessages($userId){
                $sql = 'SELECT * FROM messages WHERE recipient_id = ?';
                $stm = self::$pdo->prepare($sql);
                $stm->execute([$userId]);
                $unreadMessages = $stm->fetchAll(PDO::FETCH_CLASS, 'Message'); //FETCH_BOTH - FETCH_CLASS - FETCH_ASSOC
                foreach ($unreadMessages as $k=>$message) {
                        //Ajouter le nom de l'utilisateur au message
                        $message->sender = (new UserDao)->get($message->sender_id)->username;
                }
                return $unreadMessages;

        }

        function get($id){
                $sql = 'SELECT * FROM messages WHERE id = ?';
                $stm = self::$pdo->prepare($sql);
                $stm->execute([$id]);
                if($stm->rowCount()>0){
                        return $stm->fetchAll(PDO::FETCH_CLASS, 'Message')[0]; 
                }
                return null;
        }

        function read($id){
                $sql = 'UPDATE messages SET is_read = 1 where id = ?';
                $stm = self::$pdo->prepare($sql);
                $stm->execute([$id]);
        }
}
